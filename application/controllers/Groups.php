<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("user_model");
		$this->load->model("image_model");
		$this->load->model("feed_model");
		$this->load->model("page_model");
		$this->load->model("calendar_model");
		$this->load->model("home_model");
		$this->load->model("group_model");
		$this->load->model("marriage_model");

		$this->template->set_layout("client/themes/titan.php");
	}
	public function index() 
	{
		$this->template->loadData("activeLink", 
			array("admin" => array("user_groups" => 1)));
		$pagedata['allgroups'] = $this->group_model->get_user_groups()->result();
		$pagedata['usergroups'] = $this->group_model->get_group_against_user()->result();
		$pagedata['groupcat'] = $this->group_model->get_limited_group_categories()->result();
		$pagedata['ingroups'] = $this->group_model->get_user_joined_groups_groups()->result();
		$country =  $this->user->info->country;
		$state =  $this->user->info->state;
		$city =  $this->user->info->city;
		$pagedata['allcategoriesgroups'] = $this->group_model->get_group_categories()->result();
		$pagedata['sugesstedgroups'] = $this->group_model->get_sugested_groups($country , $state ,$city);
		$pagedata['friendsgroups'] = $this->group_model->get_friends_groups();
		$this->template->loadContent("groups/index.php", $pagedata);
	}


	public function suggestion()
	{
		$this->template->loadData("activeLink", 
			array("admin" => array("user_groups" => 1)));
		$pagedata['allgroups'] = $this->group_model->get_user_groups()->result();
		$pagedata['usergroups'] = $this->group_model->get_group_against_user()->result();
		$pagedata['ingroups'] = $this->group_model->get_user_joined_groups_groups()->result();
		$country =  $this->user->info->country;
		$state =  $this->user->info->state;
		$city =  $this->user->info->city;
		$pagedata['allcategoriesgroups'] = $this->group_model->get_group_categories()->result();
		$pagedata['sugesstedgroups'] = $this->group_model->get_all_sugested_groups($country , $state ,$city);
		$this->template->loadContent("groups/suggestions.php", $pagedata);
	}

    public function categories(){
       $this->template->loadData("activeLink", 
	   array("admin" => array("user_groups" => 1)));
		$pagedata['allgroups'] = $this->group_model->get_user_groups()->result();
		$pagedata['usergroups'] = $this->group_model->get_group_against_user()->result();
		$pagedata['ingroups'] = $this->group_model->get_user_joined_groups_groups()->result();
       	$pagedata['groupcat'] = $this->group_model->get_group_categories()->result();
       	$this->template->loadContent("groups/categories.php", $pagedata);
    }


    public function category_id($id)
    {
    	$this->template->loadData("activeLink", 
	   array("admin" => array("user_groups" => 1)));
		$pagedata['allgroups'] = $this->group_model->get_user_groups()->result();
		$pagedata['usergroups'] = $this->group_model->get_group_against_user()->result();
		$pagedata['ingroups'] = $this->group_model->get_user_joined_groups_groups()->result();
       	$pagedata['allcategoriesgroups'] = $this->group_model->allcategoriesgroups($id)->result();
       	$pagedata['getcategory'] = $this->group_model->getcategorybyid($id)->row();
       	$this->template->loadContent("groups/groupbycategorey.php", $pagedata);
    }


	public function view($id) 
	{
		if(!$this->settings->info->public_pages) {
			if(!$this->user->loggedin) {
				redirect(site_url("login"));
			}
		}
		if(is_numeric($id)) {
			$id = intval($id);
			$group =$this->group_model->get_user_group($id);
		} else {
			$id = $this->common->nohtml($id);
			$group = $this->group_model->get_group_by_groupid($id);
		}

		// Get group
		if($group->num_rows() == 0) {
			$this->template->error(lang("error_94"));
		}

		$group = $group->row();


		if($this->user->loggedin) {
			// Get group member
			$member = $this->group_model->get_group_user($group->ID, $this->user->info->ID);
			if($member->num_rows() == 0) {
				$member = null;
			} else {
				$member = $member->row();
			}
		} else {
			$member = null;
		}

		// Get member list (preview)
		$users = $this->group_model->get_group_users_preview($group->ID);

		// Get albums
		$albums = $this->image_model->get_group_albums_sample($group->ID);

		// Get upcoming events
		$startdt = new DateTime('now'); // setup a local datetime
		$startdt->setTimestamp(time()); // Set the date based on timestamp
		$format = $startdt->format('Y-m-d H:i:s');
		$events = $this->calendar_model->get_events_sample($group->ID, $format);

		$this->template->loadContent("groups/view.php", array(
			"group" => $group,
			"groupid" => $id,
			"member" => $member,
			"users" => $users,
			"albums" => $albums,
			"events" => $events,
			"postAsImg" => $this->user->info->avatar,
			)
		);
	}


	public function settings($id)
	{
		if(!$this->settings->info->public_pages) {
			if(!$this->user->loggedin) {
				redirect(site_url("login"));
			}
		}
		if(is_numeric($id)) {
			$id = intval($id);
			$group =$this->group_model->get_user_group($id);
		} else {
			$id = $this->common->nohtml($id);
			$group = $this->group_model->get_group_by_groupid($id);
		}

		// Get group
		if($group->num_rows() == 0) {
			$this->template->error(lang("error_94"));
		}

		$group = $group->row();

		if($this->user->loggedin) {
			// Get group member
			$member = $this->group_model->get_group_user($group->ID, $this->user->info->ID);
			if($member->num_rows() == 0) {
				$member = null;
			} else {
				$member = $member->row();
			}
		} else {
			$member = null;
		}

		// Get member list (preview)
		$users = $this->group_model->get_group_users_preview($group->ID);

		// Get albums
		$albums = $this->image_model->get_group_albums_sample($group->ID);

		// Get upcoming events
		$startdt = new DateTime('now'); // setup a local datetime
		$startdt->setTimestamp(time()); // Set the date based on timestamp
		$format = $startdt->format('Y-m-d H:i:s');
		$events = $this->calendar_model->get_events_sample($group->ID, $format);

		$this->template->loadContent("groups/settings.php", array(
			"group" => $group,
			"groupid" => $id,
			"member" => $member,
			"users" => $users,
			"albums" => $albums,
			"events" => $events,
			)
		);
	}


	public function rules($id)
	{
		if(!$this->settings->info->public_pages) {
			if(!$this->user->loggedin) {
				redirect(site_url("login"));
			}
		}
		if(is_numeric($id)) {
			$id = intval($id);
			$group =$this->group_model->get_user_group($id);
		} else {
			$id = $this->common->nohtml($id);
			$group = $this->group_model->get_group_by_groupid($id);
		}

		// Get group
		if($group->num_rows() == 0) {
			$this->template->error(lang("error_94"));
		}

		$group = $group->row();

		if($this->user->loggedin) {
			// Get group member
			$member = $this->group_model->get_group_user($group->ID, $this->user->info->ID);
			if($member->num_rows() == 0) {
				$member = null;
			} else {
				$member = $member->row();
			}
		} else {
			$member = null;
		}

		// Get member list (preview)
		$users = $this->group_model->get_group_users_preview($group->ID);

		// Get albums
		$albums = $this->image_model->get_group_albums_sample($group->ID);

		// Get upcoming events
		$startdt = new DateTime('now'); // setup a local datetime
		$startdt->setTimestamp(time()); // Set the date based on timestamp
		$format = $startdt->format('Y-m-d H:i:s');
		$events = $this->calendar_model->get_events_sample($group->ID, $format);

		$rules = $this->group_model->get_group_rules($group->ID)->result();

		$this->template->loadContent("groups/rules.php", array(
			"group" => $group,
			"groupid" => $id,
			"member" => $member,
			"users" => $users,
			"albums" => $albums,
			"events" => $events,
			"rules" => $rules,
			)
		);
	}


	public function  questions($id)
	{
		if(!$this->settings->info->public_pages) {
			if(!$this->user->loggedin) {
				redirect(site_url("login"));
			}
		}
		if(is_numeric($id)) {
			$id = intval($id);
			$group =$this->group_model->get_user_group($id);
		} else {
			$id = $this->common->nohtml($id);
			$group = $this->group_model->get_group_by_groupid($id);
		}

		// Get group
		if($group->num_rows() == 0) {
			$this->template->error(lang("error_94"));
		}

		$group = $group->row();

		// Get member list (preview)
		$users = $this->group_model->get_group_users_preview($group->ID);
		$rules = $this->group_model->get_group_rules($group->ID)->result();

		$rules = $this->group_model->get_group_rules($group->ID)->result();
		$this->template->loadContent("groups/question.php", array(
			"group" => $group,
			"rules" => $rules,
			"users" => $users,
			)
		);
	}


	public function about($id)
	{
		if(!$this->settings->info->public_pages) {
			if(!$this->user->loggedin) {
				redirect(site_url("login"));
			}
		}
		if(is_numeric($id)) {
			$id = intval($id);
			$group =$this->group_model->get_user_group($id);
		} else {
			$id = $this->common->nohtml($id);
			$group = $this->group_model->get_group_by_groupid($id);
		}

		// Get group
		if($group->num_rows() == 0) {
			$this->template->error(lang("error_94"));
		}

		$group = $group->row();

		// Get member list (preview)
		$users = $this->group_model->get_group_users_preview($group->ID);
		$rules = $this->group_model->get_group_rules($group->ID)->result();

		$rules = $this->group_model->get_group_rules($group->ID)->result();
		$this->template->loadContent("groups/about.php", array(
			"group" => $group,
			"rules" => $rules,
			"users" => $users,
			)
		);

	}

	public function user_groups() 
	{
		// if(!$this->user->info->admin && !$this->user->info->admin_members) {
		// 	$this->template->error(lang("error_2"));
		// }
		$this->template->loadData("activeLink", 
			array("admin" => array("user_groups" => 1)));
		$groups = $this->group_model->get_user_groups();
		$this->template->loadContent("groups/index.php", array(
			"groups" => $groups
			)
		);
	}

	public function add_group_pro() 
	{
		$groupid = rand(10000000,10000000000);
		$userid = $this->user->info->ID;
		$name = $this->common->nohtml($this->input->post("name"));
		$groupcat = $this->input->post("groupcatid");
		$description = $this->input->post("description");
		if (empty($name)) $this->template->error(lang("error_5"));
        $this->group_model->add_group(
			array(
				"ID" => $groupid,
				"name" =>$name,
				"default" => 0,
				"description" => $description,
				"timestamp" => time(),
				"userid" => $userid,
				"members" => 1,
				"group_categories" => $groupcat,
 				)
			);
	

        $this->group_model->add_group_user(array(
			"groupid" => $groupid,
			"userid" => $this->user->info->ID,
			"roleid" => 1
			)
		);

		$this->session->set_flashdata("globalmsg", lang("success_2"));
		redirect(site_url("groups/view/".$groupid));
	}

	public function edit_group($id) 
	{
		if(!$this->user->info->admin && !$this->user->info->admin_members) {
			$this->template->error(lang("error_2"));
		}
		$id = intval($id);
		$group = $this->group_model->get_user_group($id);
		if ($group->num_rows() == 0) $this->template->error(lang("error_4"));

		$this->template->loadData("activeLink", 
			array("admin" => array("user_groups" => 1)));

		$this->template->loadContent("groups/edit_group.php", array(
			"group" => $group->row()
			)
		);
	}

	public function edit_group_pro($id) 
	{
		if(!$this->user->info->admin && !$this->user->info->admin_members) {
			$this->template->error(lang("error_2"));
		}
		$id = intval($id);
		$group = $this->group_model->get_user_group($id);
		if ($group->num_rows() == 0) $this->template->error(lang("error_4"));

		$name = $this->common->nohtml($this->input->post("name"));
		$default = intval($this->input->post("default_group"));
		$description = $this->input->post("description");
		if (empty($name)) $this->template->error(lang("error_5"));

		$this->group_model->update_group($id, 
			array(
				"name" =>$name,
				"default" => $default,
				"description" => $description
				)
		);
		print_r($description);
		$this->session->set_flashdata("globalmsg", lang("success_3"));
		redirect(site_url("groups/user_groups"));
	}

	public function delete_group($id, $hash) 
	{
		if(!$this->user->info->admin && !$this->user->info->admin_members) {
			$this->template->error(lang("error_2"));
		}
		if ($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$group = $this->group_model->get_user_group($id);
		if ($group->num_rows() == 0) $this->template->error(lang("error_4"));

		$this->group_model->delete_group($id);
		// Delete all user groups from member
		$this->group_model->delete_users_from_group($id); 

		$this->session->set_flashdata("globalmsg", lang("success_4"));
		redirect(site_url("groups/user_groups"));
	}




	public function view_group($id, $group=0) 
	{
		if(!$this->user->info->admin && !$this->user->info->admin_members) {
			$this->template->error(lang("error_2"));
		}
		$this->template->loadData("activeLink", 
			array("admin" => array("user_groups" => 1)));
		$id = intval($id);
		$group = intval($group);
		$group = $this->group_model->get_user_group($id);
		if ($group->num_rows() == 0) $this->template->error(lang("error_4"));

		$users = $this->group_model->get_users_from_groups($id, $group);

		$this->load->library('pagination');
		$config['base_url'] = site_url("groups/view_group/" . $id);
		$config['total_rows'] = $this->group_model
			->get_total_user_group_members_count($id);
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;

		include (APPPATH . "/config/page_config.php");

		$this->pagination->initialize($config); 

		$this->template->loadContent("groups/view_groups.php", array(
			"group" => $group->row(),
			"users" => $users,
			"total_members" => $config['total_rows']
			)
		);

	}


	public function add_user_to_group_pro($id) 
	{
		if(!$this->user->info->admin && !$this->user->info->admin_members) {
			$this->template->error(lang("error_2"));
		}
		$id = intval($id);
		$group = $this->group_model->get_user_group($id);
		if ($group->num_rows() == 0) $this->template->error(lang("error_4"));

		$usernames = $this->common->nohtml($this->input->post("usernames"));
		$usernames = explode(",", $usernames);

		$users = array();
		foreach ($usernames as $username) {
			// $user = $this->group_model->get_user_by_username($username); 
			if($user->num_rows() == 0) $this->template->error(lang("error_3") 
				. $username );
			$users[] = $user->row();
		}

		foreach ($users as $user) {
			// Check not already a member
			$userc = $this->group_model->get_user_from_group($user->ID, $id);
			if ($userc->num_rows() == 0) {
				$this->group_model->add_user_to_group($user->ID, $id);
			}
		}

		$this->session->set_flashdata("globalmsg", lang("success_5"));
		redirect(site_url("groups/view_group/" . $id));
	}

	public function remove_user_from_group($userid, $id, $hash) 
	{
		if(!$this->user->info->admin && !$this->user->info->admin_members) {
			$this->template->error(lang("error_2"));
		}
		if ($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$userid = intval($userid);
		$group = $this->group_model->get_user_group($id);
		if ($group->num_rows() == 0) $this->template->error(lang("error_4"));

		$user = $this->group_model->get_user_from_group($userid, $id);
		if ($user->num_rows() == 0) $this->template->error(lang("error_7"));

		$this->group_model->delete_user_from_group($userid, $id);
		$this->session->set_flashdata("globalmsg", lang("success_6"));
		redirect(site_url("groups/view_group/" . $id));
	}
//add group cover//////////////////////////////////////
public function user_group_cover() 
	{
		if(!$this->user->info->admin && !$this->user->info->admin_settings) {
			$this->template->error(lang("error_2"));
		}
		$this->template->loadData("activeLink", 
			array("admin" => array("rotation_ads" => 1)));
		$this->template->loadContent("groups/user_group_cover.php", array(
			)
		);
	}


	public function user_group_cover_ad_page() 
	{
		$this->load->library("datatables");

		$this->datatables->set_default_order("user_group_cover.ID", "desc");

		// Set page ordering options that can be used
		$this->datatables->ordering(
			array(
				 0 => array(
				 	"user_group_cover.name" => 0
				 ),
				 1 => array(
				 	"user_group_cover.status" => 0
				 ),
				 2 => array(
				 	"user_group_cover.pageviews" => 0
				 ),
				 3 => array(
				 	"user_group_cover.username" => 0
				 ),
				 4 => array(
				 	"user_group_cover.timestamp" => 0
				 ),
				 
				  5 => array(
				 	"user_group_cover.link" => 0
				 ),
				   6 => array(
				 	"user_group_cover.image" => 0
				 ),
			)
		);

		$this->datatables->set_total_rows(
			$this->group_model
				->get_total_user_group_cover()
		);
		$ads = $this->home_model->get_user_group_cover_ad($this->datatables);

		foreach($ads->result() as $r) {

			$options = "";

			// if($r->status == 0) {
			// 	$status = lang("ctn_701");
			// 	$options .= '<a href="'.site_url("admin/accept_ad/" . $r->ID . "/" . $this->security->get_csrf_hash()).'" class="btn btn-success btn-xs">'.lang("ctn_623").'</a> <a href="'.site_url("admin/reject_ad/" . $r->ID . "/" . $this->security->get_csrf_hash()).'" class="btn btn-danger btn-xs">'.lang("ctn_624").'</a> ';
			// } elseif($r->status == 1) {
			// 	$status = lang("ctn_702");
			// } elseif($r->status == 2) {
			// 	$status = lang("ctn_703");
			// }

			 
			$this->datatables->data[] = array(
				$r->name,
				// $status,
				$r->pageviews,
				$r->image,
				$r->link,
                
				// $this->common->get_user_display(array("username" => $r->username, "avatar" => $r->avatar, "online_timestamp" => $r->online_timestamp, "first_name" => $r->first_name, "last_name" => $r->last_name)),
				// date($this->settings->info->date_format, $r->timestamp),



				// $options . '<a href="' . site_url("admin/edit_rotation_ad/" . $r->ID) .'" class="btn btn-warning btn-xs" title="'. lang("ctn_55").'"><span class="glyphicon glyphicon-cog"></span></a>  <a href="' . site_url("admin/delete_rotation_ad/" . $r->ID . "/" . $this->security->get_csrf_hash()) .'" onclick="return confirm(\'' . lang("ctn_86") . '\')" class="btn btn-danger btn-xs" title="'. lang("ctn_57") .'"><span class="glyphicon glyphicon-trash"></span></a>'



$options . '<a href="' . site_url("home/edit_user_group_cover/" . $r->ID) .'" class="btn btn-warning btn-xs" title="'. lang("ctn_55").'"><span class="glyphicon glyphicon-cog"></span></a>  <a href="' . site_url("home/delete_user_group_cover/" . $r->ID . "/" . $this->security->get_csrf_hash()) .'" onclick="return confirm(\'' . lang("ctn_86") . '\')" class="btn btn-danger btn-xs" title="'. lang("ctn_57") .'"><span class="glyphicon glyphicon-trash"></span></a>'

			);
		}
		echo json_encode($this->datatables->process());
	}

	public function add_user_group_cover_ad() 
	{
		if(!$this->user->info->admin && !$this->user->info->admin_settings) {
			$this->template->error(lang("error_2"));
		}
		$name = $this->common->nohtml($this->input->post("name"));
		$status = intval($this->input->post("status"));
		$pageviews = intval($this->input->post("pageviews"));
		//$image = ($this->input->post("image"));
		$link = ($this->input->post("link"));
		

		if(empty($name)) {
			$this->template->error(lang("error_157"));
		}
	

$this->load->library("upload");
//echo $_FILES['image'];
		if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
			$this->upload->initialize(array( 
		       "upload_path" => $this->settings->info->upload_path,
		       "overwrite" => FALSE,
		       "max_filename" => 300,
		       "encrypt_name" => TRUE,
		       "remove_spaces" => TRUE,
		       "allowed_types" => "gif|png|jpg|jpeg",
		       "max_size" => $this->settings->info->file_size,
		       "max_width" => 800,
		       "max_height" => 800
		    ));

		    if (!$this->upload->do_upload("image")) {
		    	$this->template->error(lang("error_21")
		    	.$this->upload->display_errors());
		    }

		    $data = $this->upload->data();

			    $image = $data['file_name'];
			} else {
				$image= 'ad.jpg';
			}


//echo $image;
//exit;
 // $image = $_FILES['image']['name'];
// echo $image;


		$this->home_model->user_group_cover(array(
			"name" => $name,
			// "status" => $status,
			"pageviews" => $pageviews,
			"image" =>     $image,
			"link"       => $link,
			"userid" => $this->user->info->ID,
			// "timestamp" => time()
			)
		);
    // exit;
		$this->session->set_flashdata("globalmsg", lang("success_93"));
		redirect(site_url("groups/user_group_cover"));
	}

	public function edit_user_group_cover($id) 
	{
		if(!$this->user->info->admin && !$this->user->info->admin_settings) {
			$this->template->error(lang("error_2"));
		}
		$id = intval($id);
		$ad = $this->group_model->get_user_group_cover($id);
		if($ad->num_rows() == 0) {
			$this->template->error(lang("error_158"));
		}
		$ad = $ad->row();

		$this->template->loadData("activeLink", 
			array("admin" => array("rotation_ads" => 1)));
		$this->template->loadContent("groups/user_group_cover.php", array(
			"ad" => $ad
			)
		);
	}

	public function edit_user_group_cover_ad($id) 
	{
		if(!$this->user->info->admin && !$this->user->info->admin_settings) {
			$this->template->error(lang("error_2"));
		}
		$id = intval($id);
		$ad = $this->group_model->get_user_group_cover_ad($id);
		if($ad->num_rows() == 0) {
			$this->template->error(lang("error_158"));
		}
		$ad = $ad->row();

		$name = $this->common->nohtml($this->input->post("name"));
		$advert = $this->lib_filter->go($this->input->post("advert"));
		$status = intval($this->input->post("status"));
		$pageviews = intval($this->input->post("pageviews"));
		$image = ($this->input->post("image"));
		$link = ($this->input->post("link"));

		if(empty($name)) {
			$this->template->error(lang("error_157"));
		}

		$this->group_model->update_user_group_cover($id, array(
			"name" => $name,
			// "advert" => $a,
			// "status" => $status,dvert,
			"pageviews" => $pageviews,
			"image" => $image,
			"link" =>$link
			)
		);

		$this->session->set_flashdata("globalmsg", lang("success_94"));
		redirect(site_url("groups/user_group_cover"));
	}

	public function delete_user_group_cover($id) 
	{
		if(!$this->user->info->admin && !$this->user->info->admin_settings) {
			$this->template->error(lang("error_2"));
		}
		$id = intval($id);
		$ad = $this->group_model->get_user_group_cover($id);
		if($ad->num_rows() == 0) {
			$this->template->error(lang("error_158"));
		}

		$this->group_model->delete_user_group_cover($id);
		$this->session->set_flashdata("globalmsg", lang("success_95"));
		redirect(site_url("groups/user_group_cover"));
	}
	


//////join group///////////

	public function join_groups($id, $hash, $ajax = 0) 
	{
		if(!$this->user->loggedin) {
			redirect(site_url("login"));
		}
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$group = $this->group_model->get_group($id);
		// Get group
		if($group->num_rows() == 0) {
			$this->template->error(lang("error_94"));
		}

		$group = $group->row();

		// Get group member
		$member = $this->group_model->get_group_user($id, $this->user->info->ID);
		if($member->num_rows() > 0) {
			$this->template->error(lang("error_123"));
		}

		// Check for invite
		$flag = 0;
		$invite = $this->group_model->get_group_invite($id, $this->user->info->ID);
		if($invite->num_rows() > 0) {
			$invite = $invite->row();
			$flag = 1;
			$this->group_model->delete_group_invite($invite->ID);
		}

		
		// Add User
	    	$this->group_model->add_group_user(array(
			"groupid" => $id,
			"userid" => $this->user->info->ID,
			"roleid" => 0
			)
		);

			$this->session->set_flashdata("globalmsg", lang("success_65"));
			redirect(site_url("groups/view/" . $id));
	}



	public function join_groupajax($id) 
	{
		if(!$this->user->loggedin) {
			redirect(site_url("login"));
		}
		$group = $this->group_model->get_group($id);
		if($group->num_rows() == 0) {
			$this->template->error(lang("error_94"));
		}
		$group = $group->row();

		$member = $this->group_model->get_group_user($id, $this->user->info->ID);
		if($member->num_rows() > 0) {
			$this->template->error(lang("error_123"));
		}

		$flag = 0;

		$invite = $this->group_model->get_group_invite($id, $this->user->info->ID);
		if($invite->num_rows() > 0) {
			$invite = $invite->row();
			$flag = 1;
			$this->group_model->delete_group_invite($invite->id);
		}

		$member = $this->group_model->get_groupmembers($id)->members;


		$this->group_model->update_user_groups($id, array(
			"members" => $member+1,
			)
		);


	    	$this->group_model->add_group_user(array(
			"groupid" => $id,
			"userid" => $this->user->info->ID,
			"roleid" => 0
			)
		);
	    	echo $member+1;
	}



	public function leave_groupajax($id)
	{
		$this->group_model->delete_users_group($id);
		$member = $this->group_model->get_groupmembers($id)->members;
		$this->group_model->update_user_groups($id, array(
			"members" => $member-1,
			)
		);
		echo $member-1;
	}

    public function add_user_for_group_invites($id) 
	{
		if(!$this->user->info->admin && !$this->user->info->admin_members) {
			$this->template->error(lang("error_2"));
		}
		$id = intval($id);
		$group = $this->group_model->get_user_group($id);
		if ($group->num_rows() == 0) $this->template->error(lang("error_4"));
		$usernames = $this->common->nohtml($this->input->post("usernames"));
		$usernames = explode(",", $usernames);
        $users = array();
		foreach ($usernames as $username) {
			$user = $this->group_model->get_user_by_username($username); 
			if($user->num_rows() == 0) $this->template->error(lang("error_3") 
				. $username );
			$users[] = $user->row();
		}

		foreach ($users as $user) {
			// Check not already a member
			$userc = $this->group_model->get_user_from_group($user->ID, $id);
			if ($userc->num_rows() == 0) {
				$this->group_model->add_user_to_group($user->ID, $id);
			}
		}

		$this->session->set_flashdata("globalmsg", lang("success_5"));
		redirect(site_url("groups/view_group/" . $id));
	}


	public function leave_page($id, $hash, $ajax = 0) 
	{
		if(!$this->user->loggedin) {
			redirect(site_url("login"));
		}
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$group = $this->group_model->get_group($id);
		// Get group
		if($group->num_rows() == 0) {
			$this->template->error(lang("error_94"));
		}

		$group = $group->row();

		// Get group member
		$member = $this->group_model->get_group_album_user($id, $this->user->info->ID);
		if($member->num_rows() == 0) {
			$this->template->error(lang("error_125"));
		}
		$member = $member->row();

		// Add User
		$this->group_model->delete_groups_invite($member->ID);

		// $this->update_user_pages($group->ID, $this->user->info->ID, false);
		
		if($ajax==0)
		{
			$this->session->set_flashdata("globalmsg", lang("success_67"));
			redirect(site_url("groups/view/" . $id));
		}
		else
		{
			echo json_encode(array(
				"success" => 1
				)
			);
			exit();
		}
		
	}


	public function cover_pic_upload($groupid=0) 
	{
		$userid = $this->user->info->ID;
		$uploadpath = $this->settings->info->upload_path;
		$coverphoto = $this->input->post("coverphoto");

		$fullpicture = md5('n_'.date('Ymdhis')).'.jpg';
		$newfile = $uploadpath.'/'.$fullpicture;
		copy($coverphoto, $newfile);


		$this->group_model->update_group($groupid, array(
			"profile_header" => $fullpicture
			)
		);

		$this->load->model('image_model');
		$this->load->model('feed_model');

		// Check for default feed album
		$album = $this->image_model->get_group_cover_album($groupid);
		if($album->num_rows() == 0) {
			// Create
			$albumid = $this->image_model->add_album(array(
				"groupid" => $groupid,
				"feed_album" => 3,
				"name" => lang("ctn_949"),
				"description" => lang("ctn_950"),
				"timestamp" => time()
				)
			);
		} else {
			$album = $album->row();
			$albumid = $album->ID;
		}


		$fileid = $this->feed_model->add_image(array(
        	"file_name" => $fullpicture,
        	"file_type" => 'Image',
        	"extension" => 'jpg',
        	"userid" => $this->user->info->ID,
        	"groupid" => $groupid,
        	"timestamp" => time(),
        	"albumid" => $albumid
        	)
        );
        // Update album count
        $this->image_model->increase_album_count($albumid);


        $this->user_model->increase_posts($this->user->info->ID);
		$postid = $this->feed_model->add_post(array(
			"userid" => $this->user->info->ID,
			"groupid" => $groupid,
			"hide_profile" => 1,
			"posttype" => "feed",
			"postfor" => 2,
			"timestamp" => time(),
			"imageid" => $fileid
			)
		);

		$this->group_model->update_group($groupid, array(
			"coverpic_postid" => $postid
			)
		);

		exit;
	}


	////////////////albums
	public function albums($id) 
	{
		if(!$this->settings->info->public_pages) {
			if(!$this->user->loggedin) {
				redirect(site_url("login"));
			}
		}
		if(is_numeric($id)) {
			$id = intval($id);
			$group = $this->group_model->get_group($id);
		} else {
			$id = $this->common->nohtml($id);
			$group = $this->group_model->get_page_by_group($id);
		}

		// Get group
		if($group->num_rows() == 0) {
			$this->template->error(lang("error_94"));
		}

		$group = $group->row();

		if($this->user->loggedin) {
			// Get group member
			$member = $this->group_model->get_group_album_user($group->ID, $this->user->info->ID);
			if($member->num_rows() == 0) {
				$member = null;
			} else {
				$member = $member->row();
			}
		} else {
			$member = null;
		}

		// if($group->nonmembers_view && $member == null) {
		// 	$this->template->error(lang("error_118"));
		// }

		// if($group->type == 1) {
		// 	// Check user is a member
		// 	if($member == null) {
		// 		if(!$this->common->has_permissions(array("admin", "page_admin"), $this->user)) {
		// 			$this->template->error(lang("error_102"));
		// 		}
		// 	}
		// }

		$this->template->loadContent("groups/albums.php", array(
			"group" => $group,
			"member" => $member,
			"groupid" => $id,
			)
		);

	}
	
	public function add_album($id) 
	{
		if(!$this->user->loggedin) {
			redirect(site_url("login"));
		}
		$id = intval($id);
		$group = $this->group_model->get_group($id);

		// Get page
		if($group->num_rows() == 0) {
			$this->template->error(lang("error_94"));
		}

		$group = $group->row();

		if(empty($group->groupid)) {
			$groupid = $id;
		} else {
			$groupid = $group->groupid;
		}

		// Get group member
		// Check user is a member of group
		$member = $this->group_model->get_group_album_user($group->ID, $this->user->info->ID);
		if($member->num_rows() == 0) {
			// Check role
			if(!$this->common->has_permissions(array("admin", "page_admin"), $this->user)) {
				$this->template->error(lang("error_117"));
			}
		} else {
			$member = $member->row();
			// Check role
			if($member->roleid != 1) {
				if(!$this->common->has_permissions(array("admin", "page_admin"), $this->user)) {
					$this->template->error(lang("error_117"));
				}
			}
		}

		$name = $this->common->nohtml($this->input->post("name"));
		$desc = $this->common->nohtml($this->input->post("description"));

		if(empty($name)) {
			$this->template->error(lang("error_126"));
		}

		$this->image_model->add_album(array(
			"groupid" => $group->ID,
			"name" => $name,
			"description" => $desc,
			"timestamp" => time()
			)
		);

		$this->session->set_flashdata("globalmsg", lang("success_68"));
		redirect(site_url("groups/albums/" . $slug));
	}

	public function edit_album($id) 
	{
		if(!$this->user->loggedin) {
			redirect(site_url("login"));
		}
		$id = intval($id);
		$album = $this->group_model->get_user_album($id);
		if($album->num_rows() == 0) {
			$this->template->errori(lang("error_127"));
		}
		$album = $album->row();

		$group = $this->group_model->get_group($album->groupid);

		// Get group
		if($group->num_rows() == 0) {
			$this->template->errori(lang("error_94"));
		}

		// Get group
		if($group->num_rows() == 0) {
			$this->template->error(lang("error_94"));
		}

		$group = $group->row();

		if(empty($group->groupid)) {
			$groupid = $id;
		} else {
			$groupid = $group->groupid;
		}

		// Check user is a member of page
		$member = $this->group_model->get_group_album_user($group->ID, $this->user->info->ID);
		if($member->num_rows() == 0) {
			// Check role
			if(!$this->common->has_permissions(array("admin", "page_admin"), $this->user)) {
				$this->template->error(lang("error_117"));
			}
		} else {
			$member = $member->row();
			// Check role
			if($member->roleid != 1) {
				if(!$this->common->has_permissions(array("admin", "page_admin"), $this->user)) {
					$this->template->error(lang("error_117"));
				}
			}
		}

		$this->template->loadAjax("groups/edit_album.php", array(
			"album" => $album
			),1
		);
		exit();
	}

	public function edit_album_pro($id) 
	{
		if(!$this->user->loggedin) {
			redirect(site_url("login"));
		}
		$id = intval($id);
		$album = $this->image_model->get_user_album($id);
		if($album->num_rows() == 0) {
			$this->template->errori(lang("error_127"));
		}
		$album = $album->row();

		$group = $this->group_model->get_group($album->groupid);

		// Get group
		if($group->num_rows() == 0) {
			$this->template->error(lang("error_94"));
		}

		$group = $group->row();

		if(empty($group->groupid)) {
			$groupid= $id;
		} else {
			$groupid = $group->groupid;
		}

		// Check user is a member of group
		$member = $this->group_model->get_group_album_user($group->ID, $this->user->info->ID);
		if($member->num_rows() == 0) {
			// Check role
			if(!$this->common->has_permissions(array("admin", "page_admin"), $this->user)) {
				$this->template->error(lang("error_117"));
			}
		} else {
			$member = $member->row();
			// Check role
			if($member->roleid != 1) {
				if(!$this->common->has_permissions(array("admin", "page_admin"), $this->user)) {
					$this->template->error(lang("error_117"));
				}
			}
		}

		$name = $this->common->nohtml($this->input->post("name"));
		$desc = $this->common->nohtml($this->input->post("description"));

		if(empty($name)) {
			$this->template->error(lang("error_126"));
		}

		$this->image_model->update_user_album($id, array(
			"name" => $name,
			"description" => $desc,
			)
		);

		$this->session->set_flashdata("globalmsg", lang("success_69"));
		redirect(site_url("groups/albums/" . $album->groupid));
	}


	public function view_album($id, $p=0) 
	{
		if(!$this->settings->info->public_pages) {
			if(!$this->user->loggedin) {
				redirect(site_url("login"));
			}
		}
		$p = intval($p);
		$this->template->loadExternal(
			'
			<script type="text/javascript">
			$(document).ready(function() {
			$(".album-images").viewer();
			});
			</script>
			'
		);

		$id = intval($id);
		// print_r($id);
		$album = $this->image_model->get_user_album($id);
		if($album->num_rows() == 0) {
			$this->template->error(lang("error_127"));
		}
		$album = $album->row();

		$group = $this->group_model->get_group($album->groupid);

		// Get page
		if($group->num_rows() == 0) {
			$this->template->error(lang("error_94"));
		}

		$group = $group->row();

		if($this->user->loggedin) {
			// Get group member
			$member = $this->group_model->get_group_album_user($group->ID, $this->user->info->ID);
			if($member->num_rows() == 0) {
				$member = null;
			} else {
				$member = $member->row();
			}
		} else {
			$member = null;
		}

		$images = $this->image_model->get_group_album_images($album->ID, $p);

		$this->load->library('pagination');
		$config['base_url'] = site_url("groups/view_album/" . $id);
		$config['total_rows'] = $this->image_model
			->get_total_album_images($id);
		$config['per_page'] = 50;
		$config['uri_segment'] = 4;

		include (APPPATH . "/config/page_config.php");

		$this->pagination->initialize($config); 

		$this->template->loadContent("groups/view_album.php", array(
			"group" => $group,
			"member" => $member,
			"album" => $album,
			"images" => $images
			)
		);
	}
	//edit or delete cover

	public function edit_image($id) 
	{
		if(!$this->user->loggedin) {
			redirect(site_url("login"));
		}
		$id = intval($id);
		$image = $this->image_model->get_image($id);
		if($image->num_rows() == 0) {
			$this->template->error(lang("error_130"));
		}
		$image = $image->row();

		$group = $this->group_model->get_group($image->groupid);

		// Get group
		if($group->num_rows() == 0) {
			$this->template->error(lang("error_94"));
		}

		$group = $group->row();

		if(empty($group->groupid)) {
			$groupid = $id;
		} else {
			$groupid = $group->$groupid;
		}

		// Check user is a member of group
		$member = $this->group_model->get_group_album_user($group->ID, $this->user->info->ID);
		if($member->num_rows() == 0) {
			// Check role
			if(!$this->common->has_permissions(array("admin", "page_admin"), $this->user)) {
				$this->template->error(lang("error_117"));
			}
		} else {
			$member = $member->row();
			// Check role
			if($member->roleid != 1) {
				if(!$this->common->has_permissions(array("admin", "page_admin"), $this->user)) {
					$this->template->error(lang("error_117"));
				}
			}
		}

		$albums = $this->image_model->get_group_albums_all($group->ID);

		$this->template->loadAjax("groups/edit_image.php", array(
			"image" => $image,
			"albums" => $albums
			),1
		);
		exit();
	}

	public function edit_image_pro($id) 
	{
		if(!$this->user->loggedin) {
			redirect(site_url("login"));
		}
		$id = intval($id);
		$image = $this->image_model->get_image($id);
		if($image->num_rows() == 0) {
			$this->template->error(lang("error_130"));
		}
		$image = $image->row();

		$group = $this->group_model->get_group($image->groupid);

		// Get group
		if($group->num_rows() == 0) {
			$this->template->error(lang("error_94"));
		}

		$group = $group->row();

		if(empty($group->groupid)) {
			$groupid = $id;
		} 
		else {
			$groupid = $group->$groupid;
		}

		// Check user is a member of group
		$member = $this->group_model->get_group_album_user($group->ID, $this->user->info->ID);
		if($member->num_rows() == 0) {
			// Check role
			if(!$this->common->has_permissions(array("admin", "page_admin"), $this->user)) {
				$this->template->error(lang("error_117"));
			}
		} else {
			$member = $member->row();
			// Check role
			if($member->roleid != 1) {
				if(!$this->common->has_permissions(array("admin", "page_admin"), $this->user)) {
					$this->template->error(lang("error_117"));
				}
			}
		}

		$image_url = $this->common->nohtml($this->input->post("image_url"));
		$name = $this->common->nohtml($this->input->post("name"));
		$description = $this->common->nohtml($this->input->post("description"));
		$albumid = intval($this->input->post("albumid"));

		// Check for valid album
		$album = $this->image_model->get_user_album($albumid);
		if($album->num_rows() == 0) {
			$this->template->error(lang("error_127"));
		}
		$album = $album->row();

		if($album->groupid != $group->ID) {
			$this->template->error(lang("error_131"));
		}


		if($albumid != $image->albumid) {
			// Changing albums
			$this->image_model->increase_album_count($albumid);
			$this->image_model->decrease_album_count($image->albumid);
		}

		$fileid = 0;
		if(!empty($image_url)) {
			 $fileid = $this->image_model->update_image($id, array(
            	"file_url" => $image_url,
            	"albumid" => $album->ID,
            	"name" => $name,
            	"description" => $description
            	)
            );

		} elseif(isset($_FILES['image_file']['size']) && $_FILES['image_file']['size'] > 0) {

			$this->load->library("upload");
			// Upload image
			$this->upload->initialize(array(
			   "upload_path" => $this->settings->info->upload_path,
		       "overwrite" => FALSE,
		       "max_filename" => 300,
		       "encrypt_name" => TRUE,
		       "remove_spaces" => TRUE,
		       "allowed_types" => "png|gif|jpeg|jpg",
		       "max_size" => $this->settings->info->file_size,
				)
			);

			if ( ! $this->upload->do_upload('image_file'))
            {
                    $error = array('error' => $this->upload->display_errors());

                    $this->template->jsonError(lang("error_95") . "<br /><br />" .
                    	 $this->upload->display_errors());
            }

            $data = $this->upload->data();

            $fileid = $this->image_model->update_image($id, array(
            	"file_name" => $data['file_name'],
            	"file_type" => $data['file_type'],
            	"extension" => $data['file_ext'],
            	"file_size" => $data['file_size'],
            	"albumid" => $album->ID,
            	"name" => $name,
            	"description" => $description,
            	"file_url" => ""
            	)
            );
		} else {
			$fileid = $this->image_model->update_image($id, array(
				"name" => $name,
            	"description" => $description,
            	"albumid" => $album->ID,
				)
			);
		}

		$this->session->set_flashdata("globalmsg", lang("success_73"));
		redirect(site_url("groups/view_album/" . $albumid));

	}

	public function delete_image($id, $hash) 
	{
		if(!$this->user->loggedin) {
			redirect(site_url("login"));
		}
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}

		$id = intval($id);
		$image = $this->image_model->get_image($id);
		if($image->num_rows() == 0) {
			$this->template->error(lang("error_130"));
		}
		$image = $image->row();

		$group = $this->group_model->get_group($image->groupid);

		// Get group
		if($group->num_rows() == 0) {
			//$this->template->error(lang("error_94"));
		}

		$group = $group->row();
		$coverphoto = $this->feed_model->get_imageid_by_postid($group->coverpic_postid);

		if($coverphoto == $id)
		{
			$this->template->error(lang("error_94"));
		}
		// Check user is a member of page
		$member = $this->group_model->get_group_user($group->ID, $this->user->info->ID);
		if($member->num_rows() == 0) {
			// Check role
			if(!$this->common->has_permissions(array("admin", "page_admin"), $this->user)) {
				$this->template->error(lang("error_117"));
			}
		} else {
			$member = $member->row();
			// Check role
			if($member->roleid != 1) {
				if(!$this->common->has_permissions(array("admin", "page_admin"), $this->user)) {
					$this->template->error(lang("error_117"));
				}
			}
		}

		// Delete
		if((!empty($image->file_url)))
		{

			$this->image_model->delete_image($id);
		}

		else {
			unlink($this->settings->info->upload_path . "/" . $image->file_name);
			$this->image_model->delete_image($id);
		}

		 $this->image_model->decrease_album_count($image->albumid);

		 // Delete any posts which the image are attached to
		$posts = $this->group_model->get_posts_with_image($image->ID);
		foreach($posts->result() as $r) {
			$this->feed_model->delete_post($r->ID);
		}

		$this->session->set_flashdata("globalmsg", lang("success_74"));
		redirect(site_url("groups/view_album/" . $image->albumid));
	}


    public function albums_groups($id) 
	{
		if(!$this->settings->info->public_pages) {
			if(!$this->user->loggedin) {
				redirect(site_url("login"));
			}
		}
		$id = intval($id);
		$group = $this->group_model->get_group($id);

		// Get page
		if($group->num_rows() == 0) {
			$this->template->error(lang("error_94"));
		}

		$group = $group->row();

		if($this->user->loggedin) {
			// Get page member
			$member = $this->group_model->get_group_user($group->ID, $this->user->info->ID);
			if($member->num_rows() == 0) {
				$member = null;
			} else {
				$member = $member->row();
			}
		} else {
			$member = null;
		}

		if($group->type == 1) {
			// Check user is a member
			if($member == null) {
				if(!$this->common->has_permissions(array("admin", "page_admin"), $this->user)) {
					$this->template->error(lang("error_102"));
				}
			}
		}

		$this->load->library("datatables");

		$this->datatables->set_default_order("user_albums.ID", "desc");

		// Set page ordering options that can be used
		$this->datatables->ordering(
			array(
				 1 => array(
				 	"user_albums.name" => 0
				 ),
				 2 => array(
				 	"user_albums.images" => 0
				 ),
				 3 => array(
				 	"user_albums.timestamp" => 0
				 )
			)
		);

		$this->datatables->set_total_rows(
			$this->image_model
				->get_total_group_albums($group->ID)
		);
		$albums = $this->image_model->get_group_albums($group->ID, $this->datatables);

		foreach($albums->result() as $r) {
			if($member != null && $member->roleid == 1) {
				$options = '<a href="'.site_url("groups/view_album/" . $r->ID).'" class="btn style="color:#FFF; background:#a41be3;" btn-xs">'.lang("ctn_657").'</a> <a href="javascript:void(0)" onclick="edit_album('.$r->ID.')" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-cog"></span></a> <a href="'.site_url("groups/delete_album/" . $r->ID . "/" . $this->security->get_csrf_hash()).'" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>';
			} else {
				$options = '<a style="color:#FFF; background-color:#a41be3;" href="'.site_url("groups/view_album/" . $r->ID).'" class="btn btn-xs">'.lang("ctn_657").'</a>';
			}
			if(isset($r->file_name)) {
				$image = '<img src="'. base_url() . $this->settings->info->upload_path_relative . '/' . $r->file_name .'" width="50">';
			} else {
				$image = '<img src="'. base_url() . $this->settings->info->upload_path_relative . '/default_album.png" width="50">';
			}
			$this->datatables->data[] = array(
				'<a href="'.site_url("groups/view_album/" . $r->ID).'">'.$image.'</a>',
				$r->name,
				$r->images,
				date($this->settings->info->date_format, $r->timestamp),
				$options
			);
		}
		echo json_encode($this->datatables->process());
	}

	
public function albums_group($id) 
	{
		if(!$this->settings->info->public_pages) {
			if(!$this->user->loggedin) {
				redirect(site_url("login"));
			}
		}
		$id = intval($id);
		$group = $this->group_model->get_group($id);

		// Get group
		if($group->num_rows() == 0) {
			$this->template->error(lang("error_94"));
		}

		$group = $group->row();

		if($this->user->loggedin) {
			// Get group member
			$member = $this->group_model->get_groups_user($group->ID, $this->user->info->ID);
			if($member->num_rows() == 0) {
				$member = null;
			} else {
				$member = $member->row();
			}
		} else {
			$member = null;
		}

		if($group->type == 1) {
			// Check user is a member
			if($member == null) {
				if(!$this->common->has_permissions(array("admin", "page_admin"), $this->user)) {
					$this->template->error(lang("error_102"));
				}
			}
		}

		$this->load->library("datatables");

		$this->datatables->set_default_order("user_albums.ID", "desc");

		// Set page ordering options that can be used
		$this->datatables->ordering(
			array(
				 1 => array(
				 	"user_albums.name" => 0
				 ),
				 2 => array(
				 	"user_albums.images" => 0
				 ),
				 3 => array(
				 	"user_albums.timestamp" => 0
				 )
			)
		);

		$this->datatables->set_total_rows(
			$this->image_model
				->get_total_group_albums($group->ID)
		);
		$albums = $this->image_model->get_group_albums($group->ID, $this->datatables);

		foreach($albums->result() as $r) {
			if($member != null && $member->roleid == 1) {
				$options = '<a href="'.site_url("groups/view_album/" . $r->ID).'" class="btn style="color:#FFF; background:#a41be3;" btn-xs">'.lang("ctn_657").'</a> <a href="javascript:void(0)" onclick="edit_album('.$r->ID.')" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-cog"></span></a> <a href="'.site_url("groups/delete_album/" . $r->ID . "/" . $this->security->get_csrf_hash()).'" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>';
			} else {
				$options = '<a style="color:#FFF; background-color:#a41be3;" href="'.site_url("groups/view_album/" . $r->ID).'" class="btn btn-xs">'.lang("ctn_657").'</a>';
			}
			if(isset($r->file_name)) {
				$image = '<img src="'. base_url() . $this->settings->info->upload_path_relative . '/' . $r->file_name .'" width="50">';
			} else {
				$image = '<img src="'. base_url() . $this->settings->info->upload_path_relative . '/default_album.png" width="50">';
			}
			$this->datatables->data[] = array(
				'<a href="'.site_url("groups/view_album/" . $r->ID).'">'.$image.'</a>',
				$r->name,
				$r->images,
				date($this->settings->info->date_format, $r->timestamp),
				$options
			);
		}

		echo json_encode($this->datatables->process());
	}


	////////MEMBERS/////////

	public function members($id) 
	{
		if(!$this->settings->info->public_pages) {
			if(!$this->user->loggedin) {
				redirect(site_url("login"));
			}
		}
		if(is_numeric($id)) {
			$id = intval($id);
			$group =$this->group_model->get_user_group($id);
		} else {
			$id = $this->common->nohtml($id);
			$group = $this->group_model->get_group_by_groupid($id);
		}

		// Get group
		if($group->num_rows() == 0) {
			$this->template->error(lang("error_94"));
		}

		$group = $group->row();

		if($this->user->loggedin) {
			$member = $this->group_model->get_group_user($group->ID, $this->user->info->ID);
			if($member->num_rows() == 0) {
				$member = null;
			} else {
				$member = $member->row();
			}
		} else {
			$member = null;
		}

		// Get member list (preview)
		$users = $this->group_model->get_group_users_preview_for_members($group->ID);

		// Get albums
		$albums = $this->image_model->get_group_albums_sample($group->ID);

		// Get upcoming events
		$startdt = new DateTime('now'); // setup a local datetime
		$startdt->setTimestamp(time()); // Set the date based on timestamp
		$format = $startdt->format('Y-m-d H:i:s');
		$events = $this->calendar_model->get_events_sample($group->ID, $format);

		$country =  $this->user->info->country;
		$state =  $this->user->info->state;
		$city =  $this->user->info->city;

		$suggestedgroups = $this->group_model->get_sugested_groups_for_members_page($country , $state ,$city);


		$this->template->loadContent("groups/members.php", array(
			"group" => $group,
			"groupid" => $id,
			"member" => $member,
			"users" => $users,
			"albums" => $albums,
			"events" => $events,
			"postAsImg" => $this->user->info->avatar,
			"groupid" => $group->ID,
			"sugestedgroups" => $suggestedgroups
			)
		);

	}
///

 
	public function membersearch( $groupid = 0, $s1 = '' )
	{
		$memberssearch  = $this->group_model->get_group_users_members_search($groupid, $s1);
		if ($memberssearch->num_rows()>0) {
   	 foreach($memberssearch->result() as $r):
     echo  	"<div class='row'>
          <div class='col-md-9 col-xs-9'>
            <div style='display: flex; padding: 10px;''>
              <div style='width: 70px; height: 70px;''>
                     <img src='".base_url().$this->settings->info->upload_path_relative."/".$r->avatar."' style='width: 100%;height: 100%;''>
              </div>
               <div style='margin-left: 10px; margin-top: 10px;''>
                <a href='".site_url('profile/').$r->username."'>".$r->first_name." ".$r->last_name."</a>
                <p>Lives In  ".$r->city."</p>
              </div>
            </div>
          </div>
          <div class='col-md-3 col-xs-3'>
            <div style='position: absolute; right: 30px; margin-top: 10px;'>
                  <button class='btn btn-default'>Add Friend</button>
              </div>
          </div>
      </div>";
    	 endforeach; 
    	}else{
    		echo "<div class='row'>
    			<div style='padding:10px; text-align:center;' class='col-md-12 col-xs-12'>
          		<div >No result For <b>"  .$s1.  "</b> </div>
          		</div>	
      		</div>";
    	}
	}


	public function members_page($id) 
	{
		if(!$this->user->loggedin) {
			redirect(site_url("login"));
		}
		$id = intval($id);
		$group = $this->group_model->get_group($id);
		// Get group
		if($group->num_rows() == 0) {
			$this->template->errori(lang("error_94"));
		}

		$group = $group->row();

		// Get group member
		$member = $this->group_model->get_group_users($id, $this->user->info->ID);
		if($member->num_rows() == 0) {
			$member = null;
		} else {
			$member = $member->row();
		}
		$this->load->library("datatables");

		$this->datatables->set_default_order("groups_user.ID", "desc");

		// Set page ordering options that can be used
		$this->datatables->ordering(
			array(
				 1 => array(
				 	"users.username" => 0
				 ),
				 2 => array(
				 	"users.first_name" => 0
				 ),
				 3 => array(
				 	"users.last_name" => 0
				 ),
				 4 => array(
				 	"groups_user.user_role" => 0
				 )
			)
		);

		$this->datatables->set_total_rows(
			$this->group_model
				->get_total_group_members($group->ID)
		);
		$users = $this->group_model->get_group_members_dt($group->ID, $this->datatables);

		foreach($users->result() as $r) {

			if($r->roleid == 1) {
				$user_role = lang("ctn_35");
			} elseif($r->roleid == 0) {
				$user_role = lang("ctn_34");
			}
			$options = "";
			if($member != null && $member->roleid == 1 || $this->common->has_permissions(array("admin", "page_admin"), $this->user)) {
				$options = '<a href="javascript:void(0)" onclick="edit_member('.$r->ID.')" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-cog"></span></a> <a href="'.site_url("groups/remove_member/" . $r->ID . "/" . $this->security->get_csrf_hash()).'" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>';
			}
			$this->datatables->data[] = array(
				$this->common->get_user_display(array("username" => $r->username, "avatar" => $r->avatar, "online_timestamp" => $r->online_timestamp)),
				$r->username,
				$r->first_name,
				$r->last_name,
				$user_role,
				$options
			);
		}
		echo json_encode($this->datatables->process());
	}

	public function edit_member($id) 
	{
		if(!$this->user->loggedin) {
			redirect(site_url("login"));
		}
		$id = intval($id);
		$user = $this->group_model->get_group_member($id);
		// Get group
		if($user->num_rows() == 0) {
			$this->template->error(lang("error_121"));
		}
		$user = $user->row();


		$group = $this->group_model->get_group($user->groupid);
		// Get group
		if($group->num_rows() == 0) {
			$this->template->error(lang("error_94"));
		}

		$group = $group->row();

		// Get group member
		$member = $this->group_model->get_group_users($group->ID, $this->user->info->ID);
		if($member->num_rows() == 0) {
			// Check role
			if(!$this->common->has_permissions(array("admin", "page_admin"), $this->user)) {
				$this->template->error(lang("error_117"));
			}
		} else {
			$member = $member->row();
			// Check role
			if($member->roleid != 1) {
				if(!$this->common->has_permissions(array("admin", "page_admin"), $this->user)) {
					$this->template->error(lang("error_117"));
				}
			}
		}

		$this->template->loadAjax("groups/edit_member.php", array(
			"user" => $user
			),1
		);
		exit();
	}

	public function edit_member_pro($id) 
	{
		if(!$this->user->loggedin) {
			redirect(site_url("login"));
		}
		$id = intval($id);
		$user = $this->group_model->get_group_users($id);
		// Get page
		if($user->num_rows() == 0) {
			$this->template->error(lang("error_121"));
		}
		$user = $user->row();


		$group = $this->group_model->get_group($user->groupid);
		// Get group
		if($group->num_rows() == 0) {
			$this->template->error(lang("error_94"));
		}

		$group = $group->row();

		// Check user is a member of group
		$member = $this->group_model->get_group_users($group->ID, $this->user->info->ID);
		if($member->num_rows() == 0) {
			// Check role
			if(!$this->common->has_permissions(array("admin", "page_admin"), $this->user)) {
				$this->template->error(lang("error_117"));
			}
		} else {
			$member = $member->row();
			// Check role
			if($member->roleid != 1) {
				if(!$this->common->has_permissions(array("admin", "page_admin"), $this->user)) {
					$this->template->error(lang("error_117"));
				}
			}
		}

		$roleid = intval($this->input->post("roleid"));
		if($roleid > 1) {
			$this->template->error(lang("error_122"));
		}

		$this->group_model->update_group_user($id, array(
			"roleid" => $roleid
			)
		);

		$this->session->set_flashdata("globalmsg", lang("success_64"));
		redirect(site_url("groups/members/" . $group->ID));
	}


    public function friends($userid) 
	{
		if(!$this->user->loggedin) {
			redirect(site_url("login"));
		}
		$this->template->loadExternal(
			'
			<script type="text/javascript" src="'
			.base_url().'scripts/custom/profile.js" /></script>'
		);
		$userid = intval($userid);
		$user = $this->user_model->get_user_by_id($userid);
		if($user->num_rows() == 0) {
			$this->template->error(lang("error_85"));
		}
		$user = $user->row();
		$this->template->loadContent("groups/members.php", array(
			"user" => $user,
			"friend_flag" => $friend_flag,
			"request_flag" => $request_flag,
			)
		);
	}

	public function friends_page($userid) 
	{
		if(!$this->user->loggedin) {
			redirect(site_url("login"));
		}
		$userid = intval($userid);
		$user = $this->user_model->get_user_by_id($userid);
		if($user->num_rows() == 0) {
			$this->template->error(lang("error_85"));
		}
		$user = $user->row();

		$flags = $this->check_friend($this->user->info->ID, $user->ID);

		if($user->profile_view == 1 && $user->ID != $this->user->info->ID) {
			// Only let's friends view profile.
			if(!$flags['friend_flag']) {

				$user->profile_header = "empty.png";
				$user->avatar = "default.png";

				$this->template->loadContent("groups/empty.php", array(
					"user" => $user,
					"friend_flag" => $flags['friend_flag'],
					"request_flag" => $flags['request_flag'],
					), 1
				);
			}
		}

		$this->load->library("datatables");

		$this->datatables->set_default_order("users.ID", "desc");

		// Set page ordering options that can be used
		$this->datatables->ordering(
			array(
				 1 => array(
				 	"users.username" => 0
				 ),
				 2 => array(
				 	"users.first_name" => 0
				 ),
				 3 => array(
				 	"users.last_name" => 0
				 ),
				 4 => array(
				 	"user_friends.timestamp" => 0
				 )
			)
		);

		$this->datatables->set_total_rows(
			$this->user_model
				->get_total_friends_count($user->ID)
		);
		$friends = $this->user_model->get_user_friends_dt($user->ID, $this->datatables);

	
			$this->datatables->data[] = array(
				$r->username,
				$r->first_name,
				$r->last_name,
				
				
			);
		
		echo json_encode($this->datatables->process());
	}

	public function deadd($id, $hash) 
	{
		if(!$this->user->loggedin) {
			redirect(site_url("login"));
		}
		$id = intval($id);
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}

		$friend = $this->user_model->get_user_friend_id($id, $this->user->info->ID);
		if($friend->num_rows() == 0) {
			$this->template->error(lang("error_85"));
		}
		$friend = $friend->row();

		// Delete both
		$this->user_model->delete_friend($this->user->info->ID, $friend->friendid);

		// Update their friends
		$friends = unserialize($this->user->info->friends);

		$newfriends = array();
		foreach($friends as $id) {
			if($id != $friend->friendid) {
				$newfriends[] = $id;
			}
		}

		$this->user_model->update_user($this->user->info->ID, array(
			"friends" => serialize($newfriends)
			)
		);

		// Now our friend
		$user = $this->user_model->get_user_by_id($friend->friendid);
		if($user->num_rows() > 0) {
			$user = $user->row();
			$friends = unserialize($user->friends);

			$newfriends = array();
			foreach($friends as $id) {
				if($id != $this->user->info->ID) {
					$newfriends[] = $id;
				}
			}

			$this->user_model->update_user($friend->friendid, array(
				"friends" => serialize($newfriends)
				)
			);
		}

		$this->session->set_flashdata("globalmsg", lang("success_80"));
		redirect(site_url("groups/members/" . $this->user->info->ID));
	}

	public function inviteuser($userid, $groupid)
	{
		if(!$this->user->loggedin) {
			redirect(site_url("login"));
		}
		$id = intval($groupid);
		$group = $this->group_model->get_group($id);

		// Get group
		if($group->num_rows() == 0) {
			$this->template->error(lang("error_94"));
		}



		$group = $group->row();

		if(empty($group->ID)) {
			$groupid = $id;
		} else {
			$groupid = $group->ID;
		}



		// Check user is a member of group
		$member = $this->group_model->get_group_user($group->ID, $this->user->info->ID);
		if($member->num_rows() == 0) {
							echo "string";
		exit;
			if(!$this->common->has_permissions(array("admin", "page_admin"), $this->user)) {
				$this->template->error(lang("error_117"));
			}
		} 
		else 
		{
			$member = $member->row();
			// Check role
			if($member->roleid != 1) {
				if(!$this->common->has_permissions(array("admin", "page_admin"), $this->user)) {
					$this->template->error(lang("error_117"));
				}
			}
		}
		// Check for invite
		$flag = 0;
		$invite = $this->group_model->get_group_invite($id, $this->user->info->ID);
		if($invite->num_rows() > 0) {
			$invite = $invite->row();
			$flag = 1;
			$this->group_model->groups_invites($invite->ID);
		}

		$is_member = $this->group_model->get_user_from_group($userid, $id)->num_rows();
		if($is_member==0)
		{
		// Send notification
			// Notification
			$this->user_model->add_notification(array(
				"userid" => $userid,
				"url" => "groups/view/" . $groupid,
				"timestamp" => time(),
				"message" => $this->user->info->first_name . " " . $this->user->info->last_name . lang("ctn_1036") . $group->name,
				"status" => 0,
				"fromid" => $this->user->info->ID,
				"username" => $this->user->info->username
				)
			);
			
			$data = array();
			$data['userid'] = $userid;
			$data['groupid'] = $groupid;
			$data['fromid'] = $this->user->info->ID;
			$data['timestamp'] = strtotime(date('Y-m-d H:i:s'));
			if($this->db->insert('groups_invites',$data))
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
		}
		else
		{
			echo 0;
		}	
	}
				
	
	public function add_user_for_group_invite($id) 
	{
		if(!$this->user->info->admin && !$this->user->info->admin_members) {
			$this->template->error(lang("error_2"));
		}
		$id = intval($id);
		$group = $this->group_model->get_user_group($id);
		if ($group->num_rows() == 0) $this->template->error(lang("error_4"));
		$usernames = $this->common->nohtml($this->input->post("usernames"));
		$usernames = explode(",", $usernames);
        $users = array();
		foreach ($usernames as $username) {
			$user = $this->group_model->get_user_by_username($username); 
			if($user->num_rows() == 0) $this->template->error(lang("error_3") 
				. $username );
			$users[] = $user->row();
		}

		foreach ($users as $user) {
			// Check not already a member
			$userc = $this->group_model->get_user_from_group($user->ID, $id);
			if ($userc->num_rows() == 0) {
				$this->group_model->add_user_to_group($user->ID, $id);
			}
		}

		$this->session->set_flashdata("globalmsg", lang("success_5"));
		redirect(site_url("groups/view_group/" . $id));
	}

	public function updategroupsettings()
	{
	 	$groupid = $this->input->post("groupid");
		$blog_object = array(
            "name" => $this->input->post("name"),
            "description" => $this->input->post("description"),
        );

		$this->db->where('ID' , $groupid)->update('user_groups',$blog_object);
		echo "Updated Successfully";
	}


	public function insertnewgrouprule()
	{
		$groupid = $this->input->post("groupid");
		$blog_object = array(
            "rule_name" => $this->input->post("grouprulename"),
            "rule" => $this->input->post("addgrouprule"),
            "group_id" => $groupid,
        );
        $this->db->where('group_id' , $groupid)->insert('group_rules',$blog_object);
        $this->session->set_flashdata("globalmsg", lang("ctn_1038"));
		redirect(site_url("groups/rules/" . $groupid));
	}


	public function updategrouprule($id = NULL)
	{
		$blog_object = array(
            "rule_name" => $this->input->post("grouprulename"),
            "rule" => $this->input->post("addgrouprule"),
        );


       $this->group_model->updategrouprule($blog_object, $id);

        $this->session->set_flashdata("globalmsg", lang("ctn_1038"));
		redirect(site_url("groups/rules/" . $id));
	}


	public function getrulebyid($id = NULL)
	{
    	$data = $this->group_model->getrulesbyid($id);
        echo json_encode($data);
	}

}

?>