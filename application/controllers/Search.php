<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		
		$this->template->loadData("activeLink", 
			array("home" => array("general" => 1)));
		$this->load->model("search_model");
		$this->load->model("user_model");
		$this->load->model("home_model");
		$this->load->model("page_model");
		$this->load->model("feed_model");
		if(!$this->user->loggedin) {
			redirect(site_url("login"));
		}
		$this->template->set_error_view("error/login_error.php");
		$this->template->set_layout("client/themes/titan.php");
		//$this->template->set_layout("layout/themes/titan_layout.php");
	}

	public function index($param = "")
	{
		$get = array();
		parse_str(urldecode($param),$get);
		$pages = $this->page_model->get_recent_pages();
		$hashtags = $this->feed_model->get_trending_hashtags(10);
		$users = $this->user_model->get_newest_users($this->user->info->ID);

		$postid = intval($this->input->get("postid"));
		$commentid = intval($this->input->get("commentid"));
		$replyid = intval($this->input->get("replyid"));

		$this->template->loadContent("search/index.php", array(
			"pages" => $pages,
			"users" => $users,
			"postid" => $postid,
			"commentid" => $commentid,
			"replyid" => $replyid,
			"get" => $get
			)
		);
	}

	public function search_suggession()
	{
		$q = addslashes($this->input->post('query'));
		$qry = " SELECT * FROM (
			SELECT ID,CONCAT(first_name,' ',last_name) as label from users WHERE CONCAT(first_name,' ',last_name) LIKE '%$q%'
			UNION
			SELECT ID,name as label from pages WHERE name LIKE '%$q%'
			UNION
			SELECT ID,name as label from user_groups WHERE name LIKE '%$q%'
		) s  order by label ASC limit 0,10 ";
		//$qry = " SELECT name FROM cities WHERE name LIKE '%$q%' order by name ASC limit 0,5 ";
		echo json_encode($this->db->query($qry)->result_array());
		exit;
	}

	public function locations()
	{
		$q = addslashes($this->input->post('query'));
		$qry = " SELECT c.id,c.name as city, s.name as state, con.name as country, c.name as label FROM cities c,states s, countries con WHERE c.state_id = s.id and s.country_id = con.id AND CONCAT(c.name,', ',s.name,', ',con.name) LIKE '%$q%'  order by c.name ASC, s.name ASC, con.name ASC limit 0,10 ";
		//$qry = " SELECT name FROM cities WHERE name LIKE '%$q%' order by name ASC limit 0,5 ";
		echo json_encode($this->db->query($qry)->result_array());
		exit;
	}


	public function states()
	{
		$q = addslashes($this->input->post('query'));
		$qry = " SELECT s.name as state, con.name as country, s.name as label FROM states s, countries con WHERE s.country_id = con.id AND (s.name LIKE '%$q%' OR con.name LIKE '%$q%' ) order by s.name ASC, con.name ASC limit 0,10 ";
		//$qry = " SELECT name FROM cities WHERE name LIKE '%$q%' order by name ASC limit 0,5 ";
		echo json_encode($this->db->query($qry)->result_array());
		exit;
	}

	public function countries()
	{
		$q = addslashes($this->input->post('query'));
		$qry = " SELECT con.name as country, con.name as label FROM countries con WHERE con.name LIKE '%$q%'  order by con.name ASC limit 0,10 ";
		//$qry = " SELECT name FROM cities WHERE name LIKE '%$q%' order by name ASC limit 0,5 ";
		echo json_encode($this->db->query($qry)->result_array());
		exit;
	}


	public function sources()
	{
		$q = addslashes($this->input->post('query'));
		$qry = " 
		SELECT * FROM ( 
		SELECT p.ID, p.profile_avatar as avatar, p.name as label, CONCAT(pc.name,' - ',members,' members') as detail, 'page' as type FROM pages p, page_categories pc WHERE p.categoryid = pc.ID 
		UNION 
		SELECT ID, avatar, CONCAT(first_name,' ',last_name) as label, '' as detail, 'user' as type FROM users 
		) sources 
		WHERE label LIKE '%$q%' order by label ASC limit 0,5 
		"; 
		//$qry = " SELECT name FROM cities WHERE name LIKE '%$q%' order by name ASC limit 0,5 "; 
		echo json_encode($this->db->query($qry)->result_array()); 
		exit; 
	}

	public function places($type=1)
	{
		$q = addslashes($this->input->post('query'));
		$qry = " SELECT *, CONCAT(name,', ',address) as label FROM places WHERE type = '$type'   
				AND CONCAT(name,', ',address) LIKE '%$q%' order by name ASC, address ASC limit 0,10 ";
				//echo $qry;
		echo json_encode($this->db->query($qry)->result_array());
		exit;
	}

	public function groups()
	{
		$q = addslashes($this->input->post('query'));
		$qry = " SELECT *, name as label FROM user_groups WHERE name LIKE '%$q%' order by name ASC limit 0,10 ";
				//echo $qry;
		echo json_encode($this->db->query($qry)->result_array());
		exit;
	}

	public function result()
	{
		$data = array();
		$data['q'] = $this->input->get('q');
		$data['searchtype'] = $this->input->get('searchtype');
		$data['from'] = $this->input->get('from');
		$data['fromtype'] = $this->input->get('fromtype');
		$data['type'] = $this->input->get('type');
		$data['group'] = $this->input->get('group');
		$data['city'] = $this->input->get('city');
		$data['date'] = $this->input->get('date');
		$data['fof'] = $this->input->get('fof');
		$data['edu'] = $this->input->get('edu');
		$data['work'] = $this->input->get('work');
		$data['vtype'] = $this->input->get('vtype');
		$data['vdate'] = $this->input->get('vdate');
		$data['pcat'] = $this->input->get('pcat');
		$page = intval($this->input->get("page"));
		$searchdata = $this->search_model->result($data, $page);
		//print_r($data);
		$page_data['searchdata'] = $searchdata;
		$page = $page + 5;
		$page_data['a_url'] = site_url("search/result/?".http_build_query($data)."&page=" . $page);
		$this->template->loadAjax("search/result.php", $page_data,1);
	}

	


}

?>