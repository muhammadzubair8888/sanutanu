<?php

class Admin_Model extends CI_Model 
{
	public function updateSettings($data) 
	{
		$this->db->where("ID", 1)->update("site_settings", $data);
	}

	public function add_ipblock($ip, $reason) 
	{
		$this->db->insert("ip_block", array(
			"IP" => $ip,
			"reason" => $reason,
			"timestamp" => time()
			)
		);
	}
   public function get_contact_us_report($datatable) 
	{
		$datatable->db_order('contact_us.title');
		$this->db
			->select("contact_us.*, users.username, users.first_name, users.last_name, users.avatar, users.online_timestamp")
			->join("users", "users.ID = contact_us.userid");
		$qry = $datatable->get("contact_us");
		return $qry;
	}
	public function get_contact_us() 
	{
		return $this->db->from("contact_us")->count_all_results();
	}

	public function get_ip_blocks() 
	{
		return $this->db->get("ip_block");
	}

	public function get_ip_block($id) 
	{
		return $this->db->where("ID", $id)->get("ip_block");
	}

	public function get_rotation_addby_id($id)
	{
		return $this->db->where("ID", $id)->get("rotation_ads");
	}

	public function delete_ipblock($id) {
		$this->db->where("ID", $id)->delete("ip_block");
	}

	public function get_email_template($id) 
	{
		return $this->db->where("ID", $id)->get("email_templates");
	}

	public function add_email_template($data) 
	{
		$this->db->insert("email_templates", $data);
	}

	public function update_email_template($id, $data) 
	{
		$this->db->where("ID", $id)->update("email_templates", $data);
	}

	public function delete_email_template($id) 
	{
		$this->db->where("ID", $id)->delete("email_templates");
	}
	
	public function get_user_groups() 
	{
		return $this->db->get("user_groups");
	}

	public function add_group($data) 
	{
		$this->db->insert("user_groups", $data);
	}

	public function get_user_group($id) 
	{
		return $this->db->where("ID", $id)->get("user_groups");
	}

	public function delete_group($id) {
		$this->db->where("ID", $id)->delete("user_groups");
	}

	public function delete_users_from_group($id) 
	{
		$this->db->where("groupid", $id)->delete("user_group_users");
	}

	public function update_group($id, $data) 
	{
		$this->db->where("ID", $id)->update("user_groups", $data);
	}

	public function update_papulation($id,$data)
	{
		$this->db->where("id", $id)->update("countries", $data);
	}

	public function update_city_papulation($id,$data)
	{
		$this->db->where("id", $id)->update("cities", $data);
	}

	public function get_users_from_groups($id, $page) 
	{
		return $this->db->where("user_group_users.groupid", $id)
			->select("users.ID as userid, users.username, user_groups.name, 
				user_groups.ID as groupid, user_groups.default")
			->join("users", "users.ID = user_group_users.userid")
			->join("user_groups", "user_groups.ID = user_group_users.groupid")
			->limit(20, $page)
			->get("user_group_users");
	}

	public function get_all_group_users($id) 
	{
		return $this->db->where("user_group_users.groupid", $id)
			->select("users.ID as userid, users.email, users.username, 
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

	public function get_user_from_group($userid, $id) 
	{
		return $this->db->where("userid", $userid)
			->where("groupid", $id)->get("user_group_users");
	}

	public function delete_user_from_group($userid, $id) 
	{
		$this->db->where("userid", $userid)
			->where("groupid", $id)->delete("user_group_users");
	}

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

	public function get_all_users() 
	{
		return $this->db->select("users.email, users.ID as userid")
			->get("users");
	}

	public function add_payment_plan($data) 
	{
		$this->db->insert("payment_plans", $data);
	}

	public function get_payment_plans() 
	{
		return $this->db->get("payment_plans");
	}

	public function get_payment_plan($id) 
	{
		return $this->db->where("ID", $id)->get("payment_plans");
	}

	public function delete_payment_plan($id) 
	{
		$this->db->where("ID", $id)->delete("payment_plans");
	}

	public function update_payment_plan($id, $data)
	{
		$this->db->where("ID", $id)->update("payment_plans", $data);
	}

	public function get_payment_logs($datatable) 
	{
		$datatable->db_order();

		$datatable->db_search(array(
			"users.username",
			"payment_logs.email"
			)
		);
		return $this->db->select("users.ID as userid, users.username, users.email,
			users.avatar, users.online_timestamp,
			payment_logs.email, payment_logs.amount, payment_logs.timestamp, 
			payment_logs.ID, payment_logs.processor")
			->join("users", "users.ID = payment_logs.userid")
			->limit($datatable->length, $datatable->start)
			->get("payment_logs");
	}

	public function get_total_payment_logs_count() 
	{
		$s= $this->db
			->select("COUNT(*) as num")->get("payment_logs");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	public function get_user_roles() 
	{
		return $this->db->get("user_roles");
	}

	public function add_user_role($data) 
	{
		$this->db->insert("user_roles", $data);
	}

	public function get_user_role($id) 
	{
		return $this->db->where("ID", $id)->get("user_roles");
	}

	public function update_user_role($id, $data) 
	{
		$this->db->where("ID", $id)->update("user_roles", $data);
	}

	public function delete_user_role($id) 
	{
		$this->db->where("ID", $id)->delete("user_roles");
	}

	public function get_premium_users($datatable) 
	{
		$datatable->db_order();

		$datatable->db_search(array(
			"users.username",
			"users.email",
			"payment_plans.name"
			)
		);
		
		return $this->db->select("users.username, users.email, users.avatar,
		users.online_timestamp, users.first_name, 
			users.last_name, users.ID, users.joined, users.oauth_provider, 
			payment_plans.name, users.premium_time")
		->join("payment_plans", "payment_plans.ID = users.premium_planid")
		->where("users.premium_time >", time())
		->or_where("users.premium_time", -1)
		->limit($datatable->length, $datatable->start)
		->get("users");
	}

	public function get_total_premium_users_count() 
	{
		$s= $this->db
			->select("COUNT(*) as num")->where("premium_time >", time())
			->or_where("users.premium_time", -1)
			->join("payment_plans", "payment_plans.ID = users.premium_planid")
			->get("users");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	public function add_custom_field($data) 
	{
		$this->db->insert("custom_fields", $data);
	}

	public function get_custom_fields($data) 
	{
		if(isset($data['register'])) {
			$this->db->where("register", 1);
		}
		return $this->db->get("custom_fields");
	}

	public function get_custom_field($id) 
	{
		return $this->db->where("ID", $id)->get("custom_fields");
	}

	public function update_custom_field($id, $data) 
	{
		return $this->db->where("ID", $id)->update("custom_fields", $data);
	}

	public function delete_custom_field($id) 
	{
		$this->db->where("ID", $id)->delete("custom_fields");
	}

	public function get_layouts() 
	{
		return $this->db->get("site_layouts");
	}

	public function get_layout($id) 
	{
		return $this->db->where("ID", $id)->get("site_layouts");
	}

	public function get_user_role_permissions() 
	{
		return $this->db->get("user_role_permissions");
	}

	public function get_total_email_templates() 
	{
		$s = $this->db->select("COUNT(*) as num")->get("email_templates");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	public function get_email_templates($datatable) 
	{
		$datatable->db_order();

		$datatable->db_search(array(
			"email_templates.title",
			"email_templates.language"
			)
		);
		
		return $this->db
		->limit($datatable->length, $datatable->start)
		->get("email_templates");
	}

	public function add_page_category($data) 
	{
		$this->db->insert("page_categories", $data);
	}

	public function add_group_category($data) 
	{
		$this->db->insert("group_categories", $data);
	}

	public function get_page_category($id) 
	{
		return $this->db->where("ID", $id)->get("page_categories");
	}

	public function get_group_category($id) 
	{
		return $this->db->where("ID", $id)->get("group_categories");
	}

	

	public function delete_page_category($id) 
	{
		$this->db->where("ID", $id)->delete("page_categories");
	}

	public function delete_group_category($id) 
	{
		$this->db->where("id", $id)->delete("group_categories");
	}
	

	public function update_page_category($id, $data) 
	{
		$this->db->where("ID", $id)->update("page_categories", $data);
	}

	public function get_total_page_categories() 
	{
		return $this->db->from("page_categories")->count_all_results();
	}

	public function get_page_categories($datatable) 
	{
		$datatable->db_order();

		$datatable->db_search(array(
			"page_categories.name",
			),
			true // Cache query
		);
		return $datatable->get("page_categories");
	}

	public function get_group_categories($datatable) 
	{
		$datatable->db_order();

		$datatable->db_search(array(
			"group_categories.name",
			),
			true // Cache query
		);
		return $datatable->get("group_categories");
	}

	public function delete_report($id) 
	{
		$this->db->where("ID", $id)->delete("reports");
	}

	public function delete_report_abuse($id) 
	{
		$this->db->where("ID", $id)->delete("report_abuse_posts");
	}

	public function get_total_reports() 
	{
		return $this->db->from("reports")->count_all_results();
	}

	public function get_report($id) 
	{
		return $this->db->where("ID", $id)->get("reports");
	}

	public function get_reports($datatable) 
	{
		$datatable->db_order();

		$datatable->db_search(array(
			"reports.reason",
			"users.username",
			"pages.name",
			"g.username"
			),
			true // Cache query
		);
		$this->db
			->select("users.username as reported_username,
				users.first_name as reported_first_name, users.last_name as reported_last_name,
				users.avatar as reported_avatar, 
				users.online_timestamp as reported_online_timestamp,
				pages.ID as pageid, pages.name as page_name, pages.slug,
				g.username, g.avatar, g.first_name, g.last_name, g.online_timestamp,
				reports.ID, reports.timestamp, reports.reason")
			->join("users", "users.ID = reports.userid", "left outer")
			->join("pages", "pages.ID = reports.pageid", "left outer")
			->join("users as g", "g.ID = reports.fromid");

		return $datatable->get("reports");
	}

	public function get_report_abuse_posts($datatable) 
	{
		$datatable->db_order();

		$datatable->db_search(array(
			"report_abuse_posts.reason",
			"users.username",
			"report_abuse_posts.postid"
			),
			true // Cache query
		);
		$this->db
			->select("report_abuse_posts.ID,report_abuse_posts.postid, report_abuse_posts.reason, report_abuse_posts.timestamp, report_abuse_posts.fromid, users.username, users.first_name, users.last_name, users.avatar, users.online_timestamp")
			->join("users", "users.ID = report_abuse_posts.fromid");
		return $datatable->get("report_abuse_posts");
	}

	public function get_bug_report($datatable) 
	{
		$datatable->db_order();

		/*$datatable->db_search(array(
			"bug_report.subject",
			"users.username",
			"bug_report.description",
			"bug_report.os"
			),
			true // Cache query
		);*/
		$this->db
			->select("bug_report.*, users.username, users.first_name, users.last_name, users.avatar, users.online_timestamp")
			->join("users", "users.ID = bug_report.fromid");
		$qry = $datatable->get("bug_report");
		
		return $qry;
	}

	public function get_total_bug_reports() 
	{
		return $this->db->from("bug_report")->count_all_results();
	}

	public function add_rotation_ad($data) 
	{
		$this->db->insert("rotation_ads", $data);
	}

	public function add_rotation_plan($data) 
	{
		$this->db->insert("ads_plans", $data);
	}	

	public function get_rotation_ad($id) 
	{
		return $this->db->where("ID", $id)->get("rotation_ads");
	}

	public function get_ads_plan($id) 
	{
		return $this->db->where("id", $id)->get("ads_plans");
	}

	public function get_buy_adds_plan($id) 
	{
		$userid = $this->user->info->ID;
		$this->db->where("users_id", $userid);
		$this->db->where("ads_plans_id", $id);
		return $this->db->get("buy_ads_plan");
	}	

	public function get_buyplanfor_check_plan($id) 
	{
		$userid = $this->user->info->ID;
		$sql = "SELECT * FROM buy_ads_plan WHERE users_id = $userid AND ads_plans_id = $id AND remaining_adds > 0";
		return  $this->db->query($sql);
	}

	public function update_rotation_ad($id, $data) 
	{
		$this->db->where("ID", $id)->update("rotation_ads", $data);
	}


	public function update_rotation_plan($id , $data)
	{
		$this->db->where("id", $id)->update("ads_plans", $data);
	}

	public function delete_rotation_ad($id) 
	{
		$this->db->where("ID", $id)->delete("rotation_ads");
	}

	public function delete_ads_plan($id)
	{
		$this->db->where("ID", $id)->delete("ads_plans");
	}

	public function get_total_rotation_ads() 
	{
		return $this->db->from("rotation_ads")->count_all_results();
	}
	public function get_total_religion_ads() 
	{
		return $this->db->from("religions")->count_all_results();
	}
	 public function get_total_community_ads() 
	 {
	 	return $this->db->from("community")->count_all_results();
	}
	public function get_total_ads_plans() 
	{
		return $this->db->from("ads_plans")->count_all_results();
	}
	public function get_adds_plans($datatable)
	{
		$datatable->db_order();

		$datatable->db_search(array(
			"ads_plans.plan_name",
			"ads_plans.status",
			),
			true 
		);

		$this->db->select("*");
		return $datatable->get("ads_plans");
	}	
	public function get_rotation_ads($datatable) 
	{
		$datatable->db_order();

		$datatable->db_search(array(
			"rotation_ads.name",
			"rotation_ads.status",
			"rotation_ads.link",
			"rotation_ads.image",
			),
			true // Cache query
		);

		$this->db->select("users.username, users.ID as userid,
			users.online_timestamp, users.first_name, users.last_name,
			users.avatar,
			rotation_ads.name, rotation_ads.timestamp, rotation_ads.page,rotation_ads.add_duration,rotation_ads.city_id,rotation_ads.state_id,rotation_ads.country_id, rotation_ads.pageviews,
			rotation_ads.status, rotation_ads.link, rotation_ads.image, rotation_ads.cost, rotation_ads.ID")
			->join("users", "users.ID = rotation_ads.userid", "left outer");
		
		return $datatable->get("rotation_ads");
	}
	public function get_religions_ads($datatable) 
	{
		$datatable->db_order();
        $datatable->db_search(array(
			"religions.name"
			),
			true // Cache query
		);
            $this->db->select("religions.name, religions.ID")
			->join("users", "users.ID = religions.ID", "left outer");
		    return $datatable->get("religions");
	}
	
	public function get_community() 
	{
       return  $this->db->select("religions.name as religionname, religions.ID as religion_id ,
         	community.name as comunityname , community.ID , community.religion_id")
			->join("religions", "religions.ID = community.religion_id", "left outer")->get("community");

	}
	public function get_total_promoted_posts() 
	{
		return $this->db->from("promoted_posts")->count_all_results();
	}

	public function get_promoted_posts($datatable) 
	{
		$datatable->db_order();

		$datatable->db_search(array(
			"promoted_posts.status",
			),
			true // Cache query
		);

		$this->db->select("users.username, users.ID as userid,
			users.online_timestamp, users.first_name, users.last_name,
			users.avatar,
			promoted_posts.timestamp, promoted_posts.pageviews, 
			promoted_posts.postid,
			promoted_posts.status, promoted_posts.cost, promoted_posts.ID")
			->join("users", "users.ID = promoted_posts.userid", "left outer");
		
		return $datatable->get("promoted_posts");
	}

	public function get_promoted_post($id) 
	{
		return $this->db->where("ID", $id)->get("promoted_posts");
	}

	public function delete_promoted_post($id) 
	{
		$this->db->where("ID", $id)->delete("promoted_posts");
	}

	public function update_promoted_post($id, $data) 
	{
		$this->db->where("ID", $id)->update("promoted_posts", $data);
	}

	public function get_total_verified_requests()
	{
		return $this->db->from("verified_requests")->count_all_results();
	}

	public function get_verified_requests($datatable) 
	{
		$datatable->db_order();

		$datatable->db_search(array(
			"users.username",
			),
			true // Cache query
		);

		$this->db->select("users.username, users.ID as userid,
			users.online_timestamp, users.first_name, users.last_name,
			users.avatar,
			verified_requests.ID, verified_requests.about, verified_requests.timestamp")
			->join("users", "users.ID = verified_requests.userid", "left outer");
		
		return $datatable->get("verified_requests");
	}

	public function get_verified_request($id) 
	{
		return $this->db->where("ID", $id)->get("verified_requests");
	}

	public function delete_verified_request($id) 
	{
		$this->db->where("ID", $id)->delete("verified_requests");
	}

	public function get_total_blogs() 
	{
		return $this->db->from("user_blogs")->count_all_results();
	}

	public function get_blogs($datatable) 
	{
		$datatable->db_order();

		$datatable->db_search(array(
			"users.username",
			),
			true // Cache query
		);

		$this->db->select("users.username, users.ID as userid,
			users.online_timestamp, users.first_name, users.last_name,
			users.avatar,
			user_blogs.ID, user_blogs.title")
			->join("users", "users.ID = user_blogs.userid", "left outer");
		
		return $datatable->get("user_blogs");
	}

	public function get_total_blog_posts() 
	{
		return $this->db->from("user_blog_posts")->count_all_results();
	}

	public function get_blog_posts($datatable) 
	{
		$datatable->db_order();

		$datatable->db_search(array(
			"users.username",
			),
			true // Cache query
		);

		$this->db->select("users.username, users.ID as userid,
			users.online_timestamp, users.first_name, users.last_name,
			users.avatar,
			user_blog_posts.ID, user_blog_posts.title, user_blog_posts.status,
			user_blog_posts.timestamp, user_blog_posts.views, user_blog_posts.image")
			->join("user_blogs", "user_blogs.ID = user_blog_posts.blogid")
			->join("users", "users.ID = user_blogs.userid", "left outer");
		
		return $datatable->get("user_blog_posts");
	}

	public function add_invite($data) 
	{
		$this->db->insert("invites", $data);
	}
	public function add_religion($data) 
	{
		$this->db->insert("religions", $data);
	}
	public function add_communities($data) 
	{
		$this->db->insert("community", $data);
	}


	public function get_total_invites() 
	{
		return $this->db->from("invites")->count_all_results();
	}

	public function get_invites($datatable) 
	{
		$datatable->db_order();

		$datatable->db_search(array(
			"users.username",
			),
			true // Cache query
		);

		$this->db->select("invites.ID, invites.code, invites.status, invites.timestamp,
			invites.expires, invites.email,
			users.username")
			->join("users", "users.ID = invites.user_registered", "left outer");
		
		return $datatable->get("invites");
	}

	public function get_invite($id) 
	{
		return $this->db->where("ID", $id)->get("invites");
	}
	public function get_religion($ID) 
	{
		return $this->db->where("ID", $ID)->get("religions");
	}
	public function get_communities($id) 
	{
		return $this->db->where("ID", $id)->get("community");
	}



	public function delete_invite($id) 
	{
		$this->db->where("ID", $id)->delete("invites");
	}
    public function delete_religion($id) 
	{
		$this->db->where("ID", $ID)->delete("religions");
	}
	public function delete_communites($id) 
	{
		$this->db->where("ID", $id)->delete("community");
	}
	public function update_invite($id, $data) 
	{
		$this->db->where("ID", $id)->update("invites", $data);
	}
	public function update_religion($id, $data) 
	{
		$this->db->where("ID", $id)->update("religions", $data);
	}

    public function update_communities($id, $data) 
	{
		$this->db->where("ID", $id)->update("community", $data);
	}



	public function getpromotedpoststatusrows()
	{
		return $this->db->from("promoted_posts")->where("status", 0)->count_all_results();
	}
}

?>