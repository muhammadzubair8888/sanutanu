<?php

class Group_Model extends CI_Model 
{    
	public function get_group_by_name($name) 
	{
		return $this->db->where("name", $name)->get("user_groups");
	}
	public function get_user_groups() 
	{
		return $this->db->get("user_groups");
	}
	public function get_group_categories() 
	{
		return $this->db->get("group_categories");
	}

	
	public function get_limited_group_categories()
	{
		return $this->db->limit(8)->get("group_categories");
	}

	public function getcategorybyid($id)
	{
		return $this->db->where('id' , $id)->get("group_categories");
	}

	public function get_group_against_user()
	{
		$userid = $this->user->info->ID;
		return $this->db->where("userid" , $userid)->get('user_groups');
	}


	public function checkgroupjoined($id)
	{
		$userid = $this->user->info->ID;
		return $this->db->where("userid" , $userid)->where("groupid", $id)->get('groups_user')->num_rows();
	}


	public function checkgroupadmin($id)
	{
		$userid = $this->user->info->ID;
		return $this->db->where("userid" , $userid)->where("groupid", $id)->get('groups_user')->row()->roleid;
	}

	public function checkusergroup($id)
	{
		$userid = $this->user->info->ID;
		return $this->db->where("userid" , $userid)->where("ID", $id)->get('user_groups')->num_rows();
	}


	public function checkusergroupjoined($one, $two)
	{
		return $this->db->query("SELECT * FROM groups_user WHERE groupid = $two AND userid = $one")->result();
	}

	public function get_group_rules($id)
	{
		$qry = "SELECT * FROM group_rules LEFT JOIN user_groups ON user_groups.ID = group_rules.group_id WHERE group_rules.group_id = '$id'";
		return $this->db->query($qry);
	}

	public function getrulesbyid($id)
	{
		return $this->db->query("SELECT * FROM group_rules WHERE group_rules_ID = $id")->row();
	}

	public function checkusergroupinvite($one , $two)
	{
		$result =  $this->db->query("SELECT * FROM groups_invites WHERE groupid = $two AND userid = $one")->row();
		if (empty($result)) {
			return 0;
		}else{
			return 1;
		}
	}

	public function get_user_joined_groups_groups()
	{
		$userid = $this->user->info->ID;
		$results = @$this->db->query("SELECT groupid FROM groups_user WHERE userid = '$userid'")->result();
		$groupids = "'-1'";
		foreach($results as $r)
		{
			$groupids .= ",'".$r->groupid."'";
		}

		$qry = "SELECT * FROM user_groups WHERE ID IN( $groupids ) ";
		return $this->db->query($qry);
	}

	/////group id
	public function get_group_user($id, $userid) 
	{
		return $this->db->where("groupid", $id)
			->where("userid", $userid)->get("groups_user");
	}


	public function get_group_members($id)
	{
		$qry = "SELECT * FROM groups_user WHERE groupid = $id";
		return $this->db->query($qry)->num_rows();
	}

     public function get_group_users_preview($id) 
	{
		return $this->db->where("groups_user.groupid", $id)
			->select("users.ID as userid, users.username, users.city, users.state, users.country, users.avatar,
				users.first_name, users.last_name, users.online_timestamp,
				groups_user.ID")
			->join("users", "users.ID = groups_user.userid")
			->limit(5)
			->get("groups_user");
	}


	public function get_group_users_preview_for_members($id)
	{
		$userid = $this->user->info->ID;
		$qry = "SELECT * FROM groups_user LEFT JOIN users ON users.ID = groups_user.userid WHERE groups_user.groupid = '$id' AND  userid != $userid  GROUP BY users.ID";
		return $this->db->query($qry);
	}

	public function get_group_users_members_search($id , $word) 
	{
		$userid = $this->user->info->ID;
		$qry = "SELECT * FROM groups_user LEFT JOIN users ON users.ID = groups_user.userid WHERE groups_user.groupid = '$id' AND  userid != $userid AND CONCAT(users.first_name,' ',users.last_name) like '%".$word."%' GROUP BY users.ID";
		return $this->db->query($qry);
	}


	public function allcategoriesgroups($id)
	{
		return $this->db->where("group_categories", $id)->get("user_groups");
	}


	public function get_sugested_groups($country , $state ,$city)
	{
		$qry3  = "SELECT *,user_groups.ID as groupid, user_groups.profile_header as grouppicture FROM user_groups LEFT JOIN users ON user_groups.userid=users.ID WHERE users.city = '$city' ORDER BY RAND() LIMIT 4;";
		$city = $this->db->query($qry3)->result();
		$qry2  = "SELECT *,user_groups.ID as groupid, user_groups.profile_header as grouppicture FROM user_groups LEFT JOIN users ON user_groups.userid=users.ID WHERE users.state = '$state' ORDER BY RAND() LIMIT 4;";
		$state = $this->db->query($qry2)->result();
		$qry  = "SELECT *,user_groups.ID as groupid, user_groups.profile_header as grouppicture FROM user_groups LEFT JOIN users ON user_groups.userid=users.ID WHERE users.country = '$country' ORDER BY RAND() LIMIT 4;";
		$country = $this->db->query($qry)->result();
		$qry4 = "SELECT *,user_groups.ID as groupid, user_groups.profile_header as grouppicture FROM user_groups ORDER BY RAND() LIMIT 4;";
		$random = $this->db->query($qry4)->result();
		if (!empty($city)) {
			return $city;
		}else if(!empty($state)){
			return $state;
		}else if(!empty($country)){
			return $country;
		}else{
			return $random;
		}
	}


	public function get_all_sugested_groups($country , $state ,$city)
	{
		$qry3  = "SELECT *,user_groups.ID as groupid, user_groups.profile_header as grouppicture FROM user_groups LEFT JOIN users ON user_groups.userid=users.ID WHERE users.city = '$city' ORDER BY RAND();";
		$city = $this->db->query($qry3)->result();
		$qry2  = "SELECT *,user_groups.ID as groupid, user_groups.profile_header as grouppicture FROM user_groups LEFT JOIN users ON user_groups.userid=users.ID WHERE users.state = '$state' ORDER BY RAND();";
		$state = $this->db->query($qry2)->result();
		$qry  = "SELECT *,user_groups.ID as groupid, user_groups.profile_header as grouppicture FROM user_groups LEFT JOIN users ON user_groups.userid=users.ID WHERE users.country = '$country' ORDER BY RAND();";
		$country = $this->db->query($qry)->result();
		$qry4 = "SELECT *,user_groups.ID as groupid, user_groups.profile_header as grouppicture FROM user_groups ORDER BY RAND() LIMIT 4;";
		$random = $this->db->query($qry4)->result();
		if (!empty($city)) {
			return $city;
		}else if(!empty($state)){
			return $state;
		}else if(!empty($country)){
			return $country;
		}else{
			return $random;
		}
	}



	public function get_sugested_groups_for_members_page($country , $state ,$city)
	{
		$qry3  = "SELECT *,user_groups.ID as groupid, user_groups.profile_header as grouppicture FROM user_groups LEFT JOIN users ON user_groups.userid=users.ID WHERE users.city = '$city' ORDER BY RAND() LIMIT 3;";
		$city = $this->db->query($qry3)->result();
		$qry2  = "SELECT *,user_groups.ID as groupid, user_groups.profile_header as grouppicture FROM user_groups LEFT JOIN users ON user_groups.userid=users.ID WHERE users.state = '$state' ORDER BY RAND() LIMIT 3;";
		$state = $this->db->query($qry2)->result();
		$qry  = "SELECT *,user_groups.ID as groupid, user_groups.profile_header as grouppicture FROM user_groups LEFT JOIN users ON user_groups.userid=users.ID WHERE users.country = '$country' ORDER BY RAND() LIMIT 3;";
		$country = $this->db->query($qry)->result();
		$qry4 = "SELECT *,user_groups.ID as groupid, user_groups.profile_header as grouppicture FROM user_groups ORDER BY RAND() LIMIT 3;";
		$random = $this->db->query($qry4)->result();
		if (!empty($city)) {
			return $city;
		}else if(!empty($state)){
			return $state;
		}else if(!empty($country)){
			return $country;
		}else{
			return $random;
		}
	}

	public function get_friends_groups()
	{
		$userid = $this->user->info->ID;
		$results = @$this->db->query("SELECT friendid FROM user_friends WHERE userid = '$userid'")->result();
		$ids = "'-1'";
		foreach($results as $r)
		{
			$ids .= ",'".$r->friendid."'";
		}
		$qry = "SELECT *,user_groups.ID as groupid, user_groups.profile_header as grouppicture FROM user_groups WHERE userid IN( $ids ) ORDER BY RAND() LIMIT 4;";
		return $this->db->query($qry);
	}

	public function update_group($id, $data) 
	{
		$this->db->where("ID", $id)->update("user_groups", $data);
	}

	public function updategrouprule($blog_object, $id)
	{
		$this->db->where("group_rules_ID", $id)->update("group_rules", $blog_object);
	}

    public function get_group_by_groupid($groupid) 
	{
		return $this->db->where("groupid", $groupid)->get("groups_user");
	}
	public function update_group_user($id, $data) 
	{
		$this->db->where("ID", $id)->update("groups_user", $data);
	}

	// public function get_user_from_group($userid, $id) 
	// {
	// 	return $this->db->where("userid", $userid)
	// 		->where("groupid", $id)->get("user_group_users");
	// }
	public function get_user_from_group($userid, $id) 
	{
		return $this->db->where("userid", $userid)
			->where("groupid", $id)->get("user_group_users");
	}
    public function get_page_by_group($groupid) 
	{
		return $this->db->where("groupid", $groupid)->get("user_groups");
	}
	public function delete_user_from_group($userid, $id) 
	{
		$this->db->where("userid", $userid)
			->where("groupid", $id)->delete("user_group_users");
	}

    public function get_group_users($id, $userid) 
	{
		    return $this->db->where("groupid", $id)
			->where("userid", $userid)->get("groups_user");
	}
	public function get_total_group_members($groupid) 
	{
		return $this->db->where("groups_user.groupid", $groupid)
			->from("groups_user")->count_all_results();
	}
	public function get_groupmembers($id)
	{
		$this->db->where("user_groups.ID", $id);
		$this->db->select("user_groups.members");
		return $this->db->get("user_groups")->row();
	}
	public function get_group_members_dt($groupid, $datatable) 
	{
		$datatable->db_order();

		$datatable->db_search(array(
			"users.username",
			"users.first_name",
			"users.last_name",
			),
			true // Cache query
		);
		$this->db->where("groups_user.groupid", $groupid);
		$this->db->select("users.ID as userid, users.username, users.first_name,
			users.last_name, users.avatar, users.online_timestamp, 
			groups_user.ID, groups_user.roleid");
		$this->db->join("users", "users.ID = groups_user.userid");

		return $datatable->get("groups_user");
	}
    public function get_group_member($id) 
	{
		return $this->db->where("ID", $id)->get("groups_user");
	}
	public function add_group_invite($data) 
	{
		$this->db->insert("groups_invites", $data);
	}


	//get group invite
	public function get_group_invite($id, $userid) 
	{
		return $this->db->where("groupid", $id)
			->where("userid", $userid)->get("groups_invites");
	}
	public function delete_group_invite($id) 
	{
		$this->db->where("ID", $id)->delete("groups_invites");
	}
    public function get_group($id) 
	{
		return $this->db->where("ID", $id)->get("user_groups");
	}
	//// delete groups
	public function delete_groups_invite($id) 
	{
		$this->db->where("ID", $id)->delete("groups_invites");
	}
	/////
	public function add_group_user($data) 
	{
		$this->db->insert("groups_user", $data);
	}
      public function get_posts_with_image($id) 
	{
		return $this->db->where("imageid", $id)->get("feed_item");
	}
	public function get_user_group($id) 
	{
		return $this->db->where("ID", $id)->get("user_groups");
	}
	public function get_group_album_user($id, $userid) 
	{
		return $this->db->where("groupid", $id)
			->where("userid", $userid)->get("groups_user");
	} 
	 public function get_total_group_albums($groupid) 
    {
        return $this->db->where("groupid", $groupid)
            ->from("user_albums")->count_all_results();
    }
	public function get_group_albums_all($id) 
    {
        return $this->db->where("groupid", $id)->get("user_albums");
    }
    public function get_groups_user($id, $userid) 
	{
		return $this->db->where("groupid", $id)
			->where("userid", $userid)->get("groups_user");
	}

	public function delete_group($id) {
		$this->db->where("ID", $id)->delete("user_groups");
	}

	public function delete_users_from_group($id) 
	{
		$this->db->where("groupid", $id)->delete("user_group_users");
	}

	public function get_users_from_groups($id, $page) 
	{
		return $this->db->where("user_group_users.groupid", $id)
			->select("users.ID as userid, users.username, users.first_name, users.last_name, users.avatar, 
				user_groups.ID as groupid, user_groups.default")
			->join("users", "users.ID = user_group_users.userid")
			->join("user_groups", "user_groups.ID = user_group_users.groupid")
			->limit(20, $page)
			->get("user_group_users");
	}
	///for display new friends/////////////
	public function new_friends_display($id, $group) 
	{
		return $this->db->where("user_friends.ID ",$id)->select("users.ID as userid, users.username, users.first_name, users.last_name, users.avatar")->join("users", "users.ID =  user_friends.userid")->limit(20, $group)->get("user_friends");
	}
        //////////////////////
	// public function get_all_group_users($id) 
	// {
	// 	return $this->db->where("user_group_users.groupid", $id)
	// 		->select("users.ID as userid, users.email, users.username, 
	// 			user_groups.name, user_groups.ID as groupid, 
	// 			user_groups.default")
	// 		->join("users", "users.ID = user_group_users.userid")
	// 		->join("user_groups", "user_groups.ID = user_group_users.groupid")
	// 		->get("user_group_users");
	// }

	public function get_all_group_users($id) 
	{
		return $this->db->where("user_group_users.groupid", $id)
			->select("users.*, 
				user_groups.name, user_groups.ID as groupid, 
				user_groups.default")
			->join("users", "users.ID = user_group_users.userid")
			->join("user_groups", "user_groups.ID = user_group_users.groupid")
			->get("user_group_users");
	}


	public function get_total_user_group_members_count($groupid) 
	{
		$s= $this->db->where("groupid", $groupid)
			->select("COUNT(*) as num")
			->join("users", "users.ID = user_group_users.userid")
			->join("user_groups", "user_groups.ID = user_group_users.groupid")
			->get("user_group_users");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}
   
	// public function get_user_from_group($userid, $id) 
	// {
	// 	return $this->db->where("userid", $userid)
	// 		->where("groupid", $id)->get("user_group_users");
	// }
  

	
	public function delete_user_from_all_groups($userid) 
	{
		$this->db->where("userid", $userid)->delete("user_group_users");
	}

	public function add_user_to_group($userid, $id) 
	{
		$this->db->insert("user_group_users", 
			array(
			"userid" => $userid, 
			"groupid" => $id
			)
		);
	}
    public function get_user_by_username($username) 
	{
		return $this->db->where("username", $username)->get("users");
	}
public function get_user_by_firstname($first_name) 
	{
		return $this->db->where("first_name" ,$first_name)->get("users");
	}
	public function get_all_users() 
	{
		return $this->db->select("users.email, users.ID as userid")
			->get("users");
	}

   

	////group cover

	public function user_groups($data) 
	{
		$this->db->insert("user_groups", $data);
	}

	// public function get_user_groups_view($id) 
	// {
	// 	return $this->db->where("ID", $id)->get("user_groups");
	// }

	public function update_user_groups($id, $data) 
	{
		$this->db->where("ID", $id)->update("user_groups", $data);
	}

	public function delete_user_groups($id) 
	{
		$this->db->where("ID", $id)->delete("user_groups");
	}

	public function get_user_groups_count() 
	{
		return $this->db->from("user_groups")->count_all_results();
	}


	public function delete_users_group($id)
	{
		$userid = $this->user->info->ID;
		$this->db->where("groupid", $id)->where("userid", $userid)->delete("groups_user");
	}

	public function get_user_groups_data($datatable) 
	{
		$datatable->db_order();

		$datatable->db_search(array(
			"user_groups.name",
			"user_groups.status",
			"user_groups.link",
			"user_groups.image",
			),
			true // Cache query
		);

		$this->db->select("users.username, users.ID as userid,
			users.online_timestamp, users.first_name, users.last_name,
			users.avatar,
			user_groups.name, user_groups.timestamp, user_groups.pageviews,
			user_groups.status, user_groups.link, user_groups.image, user_groups.cost, user_groups.ID")
			->join("users", "users.ID = user_groups.userid", "left outer");
		
		return $datatable->get("user_groups");
	}
	public function get_ad_group()
	{
		return $this->db->get_where('user_groups',array('pageviews >'=>0,'status'=>2));
	}
    public function get_total_user_group_cover() 
	{
		return $this->db->from("user_group_cover")->count_all_results();
	}
	public function add_group($data) 
	{
		$this->db->insert("user_groups", $data);
	}
	public function get_user_group_cover_ad($datatable) 
	{
		$datatable->db_order();

		$datatable->db_search(array(
			"user_group_cover.name",
			"user_group_cover.status",
			"user_group_cover.link",
			"user_group_cover.image",
			),
			true // Cache query
		);

		$this->db->select("users.username, users.ID as userid,
			users.online_timestamp, users.first_name, users.last_name,
			users.avatar,
			user_group_cover.name, user_group_cover.timestamp, user_group_cover.pageviews,
			user_group_cover.status, user_group_cover.link, user_group_cover.image, user_group_cover.cost, user_group_cover.ID")
			->join("users", "users.ID = user_group_cover.userid", "left outer");
		
		return $datatable->get("user_group_cover");
	}
		public function update_user_group_cover($id, $data) 
	{
		$this->db->where("ID", $id)->update("user_group_cover", $data);
	}
	public function get_user_group_cover($id) 
	{
		return $this->db->where("ID", $id)->get("user_group_cover");
	}
	public function delete_user_group_cover($id) 
	{
		$this->db->where("ID", $id)->delete("user_group_cover");
	}

    public function get_group_cover_album($pageid) 
    {
        return $this->db->where("groupid", $pageid)->where('feed_album',3)->get("user_albums");
    }

    public function get_user_album($id) 
    {
    	return $this->db->where("ID",$id)->get("user_albums");
    }

}

?>