<?php

class Home_Model extends CI_Model 
{

	public function get_home_stats() 
	{
		return $this->db->get("home_stats");
	}

	public function update_home_stats($stats) 
	{
		$this->db->where("ID", 1)->update("home_stats", array(
			"google_members" => $stats->google_members,
			"facebook_members" => $stats->facebook_members,
			"twitter_members" => $stats->twitter_members,
			"total_members" => $stats->total_members,
			"new_members" => $stats->new_members,
			"active_today" => $stats->active_today,
			"timestamp" => time()
			)
		);
	}
	public function add_group($data) 
	{
		$this->db->insert("user_groups", $data);
	}


	public function get_email_template($id) 
	{
		return $this->db->where("ID", $id)->get("email_templates");
	}

	public function get_email_template_hook($hook, $language) 
	{
		return $this->db->where("hook", $hook)
			->where("language", $language)->get("email_templates");
	}

	public function get_random_ad() 
	{
		return $this->db->where("pageviews >", 0)->where("status", 2)->order_by("RAND()")->get("rotation_ads");
	}

	public function get_random_ad_for_homepage()
	{
		if (!empty($this->user->info->country)) {
		  $country =  $this->user->info->country;
		  $this->db->select('id');
		  $this->db->where('name', $country);
		  $query = $this->db->get('countries'); 
		  $countryid = $query->row()->id;
		}
		  if (!empty($this->user->info->state)) {
		  $state =  $this->user->info->state;
		  $this->db->select('id');
		  $this->db->where('name', $state);
		  $this->db->where('country_id', $countryid);
		  $query = $this->db->get('states'); 
		  $stateid = $query->row()->id;
		}
		 if (!empty($this->user->info->city)) {
		 	  $city =  $this->user->info->city;
		 	  $this->db->select('id');
			  $this->db->where('name', $city);
			  $query = $this->db->get('cities'); 
			  $cityid = $query->row()->id;	
		}

		  if (!empty($countryid)) {
		  	  	$this->db->where('country_id' , $countryid);
		  	}
		  if (!empty($stateid)) {
		  		$this->db->where('state_id' , $stateid);
		  	}
		  if (!empty($cityid)) {
		  	$this->db->where('city_id' , $cityid);
		  }
		  $this->db->where('status' , 2);
		  $this->db->where('page' , 'home');
		  $this->db->order_by('rand()');
		  return  $this->db->get("rotation_ads");
	}

	public function get_random_ad_for_profile()
	{
		if (!empty($this->user->info->country)) {
		  $country =  $this->user->info->country;
		  $this->db->select('id');
		  $this->db->where('name', $country);
		  $query = $this->db->get('countries'); 
		  $countryid = $query->row()->id;
		}
		  if (!empty($this->user->info->state)) {
		  $state =  $this->user->info->state;
		  $this->db->select('id');
		  $this->db->where('name', $state);
		  $this->db->where('country_id', $countryid);
		  $query = $this->db->get('states'); 
		  $stateid = $query->row()->id;
		}
		 if (!empty($this->user->info->city)) {
		 	  $city =  $this->user->info->city;
		 	  $this->db->select('*');
			  $this->db->where('name', $city);
			  $query = $this->db->get('cities'); 
			  $cityid = $query->row()->id;	
		}

		  if (!empty($countryid)) {
		  	  	$this->db->where('country_id' , $countryid);
		  	}
		  if (!empty($stateid)) {
		  		$this->db->where('state_id' , $stateid);
		  	}
		  if (!empty($cityid)) {
		  	$this->db->where('city_id' , $cityid);
		  }
		  $this->db->where('status' , 2);
		  $this->db->where('page' , 'profile');
		  $this->db->order_by('rand()');
		  return  $this->db->get("rotation_ads");
	}


	public function get_random_ad_for_pages()
	{
		if (!empty($this->user->info->country)) {
		  $country =  $this->user->info->country;
		  $this->db->select('id');
		  $this->db->where('name', $country);
		  $query = $this->db->get('countries'); 
		  $countryid = $query->row()->id;
		}
		  if (!empty($this->user->info->state)) {
		  $state =  $this->user->info->state;
		  $this->db->select('id');
		  $this->db->where('name', $state);
		  $this->db->where('country_id', $countryid);
		  $query = $this->db->get('states'); 
		  $stateid = $query->row()->id;
		}
		 if (!empty($this->user->info->city)) {
		 	  $city =  $this->user->info->city;
		 	  $this->db->select('id');
			  $this->db->where('name', $city);
			  $query = $this->db->get('cities'); 
			  $cityid = $query->row()->id;	
		}

		  if (!empty($countryid)) {
		  	  	$this->db->where('country_id' , $countryid);
		  	}
		  if (!empty($stateid)) {
		  		$this->db->where('state_id' , $stateid);
		  	}
		  if (!empty($cityid)) {
		  	$this->db->where('city_id' , $cityid);
		  }
		  $this->db->where('status' , 2);
		  $this->db->where('page' , 'pages');
		  $this->db->order_by('rand()');
		  return  $this->db->get("rotation_ads");
	}

	public function decrease_ad_pageviews($id) 
	{
		$this->db->where("ID", $id)->set("pageviews", "pageviews-1", FALSE)->update("rotation_ads");
	}

	public function add_rotation_ad($data) 
	{
		$this->db->insert("rotation_ads", $data);
	}

	public function add_promoted_post($data) 
	{
		$this->db->insert("promoted_posts", $data);
	}

	public function get_promoted_post_by_postid($postid) 
	{
		return $this->db->where("postid", $postid)->get("promoted_posts");
	}
	 function get_country_for_admin_insert_adds()
	{
		$qry = "SELECT * FROM countries ORDER by name";
		$query = $this->db->query($qry)->result();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
	}
	function get_states_for_admin_insert_adds($id)
	{
		$qry = "SELECT * FROM states WHERE country_id = $id ORDER by name";
		$query = $this->db->query($qry)->result();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
	}

	function get_city_for_admin_insert_adds($id)
	{
		$qry = "SELECT * FROM cities WHERE state_id = $id ORDER by name";
		$query = $this->db->query($qry)->result();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
	}


	function get_plans_insert_adds($id)
	{
		$qry = "SELECT * FROM ads_plans WHERE city_id = '$id' AND status = 1";
		$query = $this->db->query($qry)->result();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
	}


	function get_all_plans_for_advert()
	{
		$qry = "SELECT * FROM ads_plans WHERE city_id = '0' AND status = 1";
		$query = $this->db->query($qry)->result();
        if(!empty($query)){
            return $query;
        }else{
            return false;
        }
	}

	function get_peoples_for_userside_insert_adds($id)
	{
		$qry = "SELECT COUNT(ID) as totalpeoples FROM users WHERE city = '$id'";
		return $this->db->query($qry);
	}

	function get_city($id)
	{
		$qry = "SELECT name FROM cities WHERE id = $id ORDER BY name";
		return $this->db->query($qry);
	}
	function get_state($id)
	{
		$qry = "SELECT name FROM states WHERE id = $id ORDER BY name";
		return $this->db->query($qry);
	}
	function get_country($id)
	{
		$qry = "SELECT name FROM countries WHERE id = $id ORDER BY name";
		return $this->db->query($qry);
	}

	function get_globe()
	{
		// $qry = "select c.name as c_name, s.name as s_name,ct.name as ct_name from `countries` as c inner join `states` as s on c.id = s.country_id inner join `cities` as ct on s.id = ct.state_id";
		$qry = "select  *  from countries";
		return $this->db->query($qry)->result();
	}

	function get_cities()
	{
		$qry = "select  *  from cities";
		return $this->db->query($qry)->result();
	}	

	function get_city_id($id)
	{
		$qry = 'Select c.name,c.id from cities as c inner join states as s on c.state_id = s.id where s.country_id =  '.$id.'';
		return $this->db->query($qry)->result(); 
	}


	function get_rate_country($id)
	{
		$qry = 'select rate_per  from countries where id = '.$id.'';
		return $this->db->query($qry)->result();
	}

	function get_papulation_city($id)
	{
		$qry = 'select papulation  from cities where id = '.$id.'';
		return $this->db->query($qry)->result();
	}	

}

?>