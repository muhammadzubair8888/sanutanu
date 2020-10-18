<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marriage extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("user_model");
		$this->load->model("image_model");
		$this->load->model("feed_model");
		$this->load->model("home_model");
		$this->load->model("marriage_model");
		
		// If the user does not have premium. 
		// -1 means they have unlimited premium
		if($this->settings->info->global_premium && 
			($this->user->info->premium_time != -1 && 
				$this->user->info->premium_time < time()) ) {
			$this->session->set_flashdata("globalmsg", lang("success_29"));
			redirect(site_url("funds/plans"));
		}

		$this->template->set_layout("client/themes/titan.php");
	}

	public function index() 
	{
		$page_data['description'] = $this->db->get_where('privacy', array('ID'=>1))->row()->description;
		$this->template->loadContent("privacy/index.php", $page_data );
	}

	public function get_states_against_country_for_add_rotation($country_id = "")
	{
		$get_states = $this->home_model->get_states_for_admin_insert_adds($country_id);
		foreach($get_states as $state)

		{
			echo '<option value="'.$state->id.'">'.$state->name.'</option>';
		}

	}

	public function get_city_against_country_for_add_rotation($state_id = "")
	{
		$get_cities = $this->home_model->get_city_for_admin_insert_adds($state_id);
		foreach($get_cities as $city)

		{
			echo '<option value="'.$city->id.'">'.$city->name.'</option>';
		}

	}



	public function profile($username="")
	{
		if(!$this->settings->info->public_profiles) {
			if(!$this->user->loggedin) {
				redirect(site_url("login"));
			}
		}
		$this->template->loadExternal(
			'
			<script type="text/javascript" src="'
			.base_url().'scripts/custom/profile.js" /></script>'
		);

		if(empty($username)) $this->template->error(lang("error_51"));
		$username = $this->common->nohtml($username);
		$user = $this->user_model->get_user_by_username($username);
		if($user->num_rows() == 0) $this->template->error(lang("error_52"));
		$user = $user->row();

		$role = $this->user_model->get_user_role($user->user_role);
		if($role->num_rows() == 0) {
			$role = lang("ctn_46");
		} else {
			$role = $role->row();
			$rolename = $role->name;
		}

		if(isset($role->banned)) {
        	if($role->banned) $this->template->error(lang("error_53"));
        }


		$groups = $this->user_model->get_user_groups($user->ID);
		$fields = $this->user_model->get_custom_fields_answers(array(
			"profile" => 1), $user->ID);


		// If user is not logged in and friend only profile, no dice.
		if($user->profile_view == 1 && !$this->user->loggedin) {
			$user->profile_header = "empty.png";
			$user->avatar = "default.png";

			$this->template->loadContent("profile/empty.php", array(
				"user" => $user,
				"friend_flag" => $flags['friend_flag'],
				"request_flag" => $flags['request_flag'],
				), 1
			);
		}



		$relationship_user = null;
		if($user->relationship_userid > 0) {
			$usern = $this->user_model->get_user_by_id($user->relationship_userid);
			if($usern->num_rows() > 0) {
				$usern = $usern->row();
				$relationship_user = $usern;
			}
		}
		

		$friends = $this->user_model->get_user_friends_sample($user->ID);
		$albums = $this->image_model->get_user_albums_sample($user->ID);
		$allprofiles = $this->marriage_model->getusermerrageprofiles($user->ID);
		$this->template->loadContent("marriage/index.php", array(
			"user" => $user,
			"groups" => $groups,
			"role" => $rolename,
			"fields" => $fields,
			"friends" => $friends,
			"albums" => $albums,
			"post_count" => 0,
			"relationship_user" => $relationship_user,
			"merrageprofiles" => $allprofiles,
			)
		);
	}


	public function view($id)
	{
		if(!$this->user->loggedin) {
				redirect(site_url("login"));
		}
		$pagedata['marriageprofile'] =  $this->marriage_model->get_marriage_profile($id)->row();
		$pagedata['patnerprofile'] =  $this->marriage_model->get_patner_profile($id)->row();
		$profileby_userid = $this->marriage_model->get_marriage_profile($id)->row()->users_id;
       
		if ($this->user->info->ID == $profileby_userid) {
			$this->template->loadContent("marriage/view.php" , $pagedata);
		}else{
			$this->template->loadContent("marriage/publicview.php" , $pagedata);
		}
	}


	public function findpartner()
	{
		if(!$this->user->loggedin) {
				redirect(site_url("login"));
		}
		$pagedata['country'] = $this->marriage_model->get_all_countries()->result();
		$pagedata['religions'] = $this->marriage_model->get_all_religions();
		$pagedata['newprofiles'] = $this->marriage_model->get_new_profiles();
		$pagedata['numberofrows'] = $this->marriage_model->get_new_profiles_all_rows()->num_rows();
		$this->template->loadContent("marriage/findpartner.php" , $pagedata);
	}
	public function createnew($id)
	{
		if(!$this->user->loggedin) {
				redirect(site_url("login"));
		}
		$pagedata['profileid'] = $id;
		$pagedata['religions'] = $this->marriage_model->get_all_religions();
		$pagedata['countries'] = $this->marriage_model->get_all_countries();
		$pagedata['months']    = $this->marriage_model->getmonths();
		$checkprofilestep      =  $this->marriage_model->get_marriage_profile($id)->row();
		if (empty($checkprofilestep)) {
			$this->template->loadContent("marriage/step1.php" , $pagedata);
		}else{
			$checkstep =  $this->marriage_model->get_marriage_profile($id)->row()->profile_status_step;
			if ($checkstep == 2) {
				$this->template->loadContent("marriage/step2.php" , $pagedata);
			}elseif ($checkstep == 3) {
				$this->template->loadContent("marriage/step3.php" , $pagedata);
			}elseif ($checkstep == 4) {
				$this->template->loadContent("marriage/step4.php" , $pagedata);
			}
			// elseif ($checkstep == 5) {
			// 	$this->template->loadContent("marriage/partnerprofile.php" , $pagedata);
			// }
		}
	}


	public function getcomunities($id)
	{
		$comunity = $this->marriage_model->get_all_comunities($id);
		foreach($comunity->result() as $r)

		{
			echo '<option value="'.$r->ID.'">'.$r->name.'</option>';
		}
	}
	public function insertprofile()
	{
		if(!$this->user->loggedin) {
				redirect(site_url("login"));
		}
		$profileid =  $this->input->post("profileid");
		$userid = $this->user->info->ID;
		$profile_status_step = 2;
		$this->load->library("upload");
		if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
			$this->upload->initialize(array( 
		       "upload_path" => $this->settings->info->upload_path,
		       "overwrite" => FALSE,
		       "max_filename" => 300,
		       "encrypt_name" => TRUE,
		       "remove_spaces" => TRUE,
		       "allowed_types" => "gif|png|jpg|jpeg",
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


			if (!empty($this->input->post("day") && $this->input->post("month") && $this->input->post("year"))) {
				 $dob=$this->input->post("day")."-".$this->input->post("month")."-".$this->input->post("year");
                 $age = (date('Y') - date('Y',strtotime($dob)));
			}
		    $blog_object = array(
			"profileimage" => $image,
            "users_id" => $userid,
            "profile_status_step" => $profile_status_step,
            "marriage_profile_id" => $this->input->post("profileid"),
            "status" => 1,
            "profile_by" => $this->input->post("createdby"),
            "last_name" => $this->input->post("last_name"),
            "gender" => $this->input->post("gender"),
            "first_name" => $this->input->post("first_name"),
            "year_of_birth" => $this->input->post("year"),
            "month_of_birth" => $this->input->post("month"),
            "relegion" => $this->input->post("religion"),
            "day_of_birth" => $this->input->post("day"),
            "relegion_comunity" => $this->input->post("comunity"),
            "country" => $this->input->post("country"),
            "city" => $this->input->post("city"),
            "age" => $age,
            // "contact_number" => $this->input->post("contact"),
            "marital_status" => $this->input->post("maritalstatus"),
            "having_children" => $this->input->post("havchildren"),
            "male_children" => $this->input->post("malechildren"),
            "female_children" => $this->input->post("femalechildren"),
            "height" => $this->input->post("height"),
            "weight" => $this->input->post("weight"),
            "blood_group" => $this->input->post("bloodgroup"),
            "body_type" => $this->input->post("bodytype"),
            "complexion" => $this->input->post("bodytypecomplexion"),
            "special_case" => $this->input->post("special_cases"),
            "other_caste" => $this->input->post("othercaste"),
            "mother_tounge" => $this->input->post("mother_tongue"),
            "family_values" => $this->input->post("family_values"),
            "country_of_birth" => $this->input->post("country_of_birth"),
            "state_of_birth" => $this->input->post("state_of_birth"),
            "city_of_birth" => $this->input->post("city_of_birth"),
            "star" => $this->input->post("star"),
            "moon_sign" => $this->input->post("moon_sign"),
            "manglink" => $this->input->post("manglik"),
            "education_in" => $this->input->post("education_in"),
            "education_to" => $this->input->post("education_to"),
            "education_description" => $this->input->post("educational_description"),
            "occupation" => $this->input->post("ocupation"),
            "occupation_description" => $this->input->post("ocupation_description"),
            "diet" => $this->input->post("diet"),
            "smoke" => $this->input->post("smoke"),
            "drink" => $this->input->post("drink"),
            "country_of_resedence" => $this->input->post("country_of_resedence"),
            "state_of_resedence" => $this->input->post("state_of_resedence"),
            "city_of_resedence" => $this->input->post("city_of_resedence"),
            "zip_code" => $this->input->post("zip_code"),
            "address_line_1" => $this->input->post("address_line_1"),
            "address_line_2" => $this->input->post("address_line_2"),
        );

        $this->db->insert('marriage_profile', $blog_object);
        $this->session->set_flashdata("globalmsg", lang("success_124"));
        redirect(site_url("marriage/createnew/".$profileid));
	}



	public function step2()
	{
		$marriage_profile_id =  $this->input->post("profileid");
		$blog_object = array(
        "profile_status_step" => 3,
        "relationshipwithmember" => $this->input->post("relationshipwithmember"),
        "contactpersonname" => $this->input->post("contactpersonname"),
        "othercontactnumber" => $this->input->post("othercontactnumber"),
        );
		$this->db->where('marriage_profile_id' , $marriage_profile_id)->update('marriage_profile', $blog_object);
		$this->session->set_flashdata("globalmsg", lang("success_124"));
        redirect(site_url("marriage/createnew/".$marriage_profile_id));
	}
	public function step3()
	{
		$marriage_profile_id =  $this->input->post("profileid");
		$blog_object = array(
        "profile_status_step" => 4,
        "describepersonality" => $this->input->post("describepersonality"),
        "familystatus" => $this->input->post("familystatus"),
        "fathername" => $this->input->post("fathername"),
        "father_occup" => $this->input->post("father_occup"),
        "mothername" => $this->input->post("mothername"),
        "mother_occup" => $this->input->post("mother_occup"),
        "havebrothers" => $this->input->post("havebrothers"),
        "marriedbrother" => $this->input->post("marriedbrother"),
        "unmarriedbrother" => $this->input->post("unmarriedbrother"),
        "havesisters" => $this->input->post("havesisters"),
        "marriedsister" => $this->input->post("marriedsister"),
        "unmarriedsister" => $this->input->post("unmarriedsister"),
        "describefamily" => $this->input->post("describefamily"),
        );
		$this->db->where('marriage_profile_id' , $marriage_profile_id)->update('marriage_profile', $blog_object);
		$this->session->set_flashdata("globalmsg", lang("success_124"));
        redirect(site_url("marriage/createnew/".$marriage_profile_id));
	}

	public function step4()
	{
		$marriage_profile_id =  $this->input->post("profileid");

		$hobbyarray['hobbies'] = json_encode($this->input->post("hobbies"));
		$intrestarray['intrest'] = json_encode($this->input->post("intrests"));
// print_r($hobbyarray['hobbies']);
// exit;
		$blog_object = array(
        "hobies" => $hobbyarray['hobbies'],
        "intrests" => $intrestarray['intrest'],
        "prefferddress" => $this->input->post("prefferddress"),
        "profile_status_step" => 5,
        );
		$this->db->where('marriage_profile_id' , $marriage_profile_id)->update('marriage_profile', $blog_object);
		$this->session->set_flashdata("globalmsg", lang("success_124"));
        redirect(site_url("marriage/profile/".$this->user->info->username));
	}

	public function partnerprofile()
	{
		$marriage_profile_id =  $this->input->post("profileid");
		$agerange = $this->input->post("yearfrom")." Years To ".$this->input->post("yearto")." Years ";
		$height = $this->input->post("heightfrom")." To ".$this->input->post("heightto");
		$education = $this->input->post("education_in")." IN ".$this->input->post("education_to");
		$blog_object = array(
        "marriage_profile_id" => $marriage_profile_id,
        "gender" => $this->input->post("gender"),
        "agerange" => $agerange,
        "maritalstatus	" => $this->input->post("maritalstatus"),
        "havchildren" => $this->input->post("havchildren"),
        "malechildren" => $this->input->post("malechildren"),
        "femalechildren" => $this->input->post("femalechildren"),
        "height" => $this->input->post("height"),
        "bodytype" => $this->input->post("bodytype"),
        "complexion" => $this->input->post("bodytypecomplexion"),
        "specialcases" => $this->input->post("specialcases"),
        "relijion" => $this->input->post("religion"),
        "comunity" => $this->input->post("comunity"),
        "mothertounge" => $this->input->post("mothertounge"),
        "familyvalues" => $this->input->post("family_values"),
        "education" => $education,
        "ocupation" => $this->input->post("ocupation"),
        "smoke" => $this->input->post("smoke"),
        "drink" => $this->input->post("drink"),
        "diet" => $this->input->post("diet"),
        "country" => $this->input->post("country"),
        "statename" => $this->input->post("state"),
        "cityname" => $this->input->post("city"),
        );
        $this->db->insert("partner_profile" , $blog_object);
        $this->session->set_flashdata("globalmsg", lang("success_124"));
        redirect(site_url("marriage/profile/".$this->user->info->username));
	}


	// Edit Functions

	public function editbasics($id)
	{
		if(!$this->user->loggedin) {
				redirect(site_url("login"));
		}
		$pagedata['months'] = $this->marriage_model->getmonths();
		$pagedata['bloodgroup'] = $this->marriage_model->getbloodgroup();
		$pagedata['marriageprofile'] =  $this->marriage_model->get_marriage_profile($id)->row();
		$this->template->loadContent("marriage/edit/editbasics.php" , $pagedata);
	}


	public function updatemybasics()
	{
	    $marriage_profile_id =  $this->input->post("marriage_profile_id");
		$updateddate = date('d-M-Y');
	
	    $blog_object = array(
		    "marriage_profile_id" => $this->input->post("marriage_profile_id"),
            "last_name" => $this->input->post("last_name"),
            "gender" => $this->input->post("gender"),
            "first_name" => $this->input->post("first_name"),
            "day_of_birth" => $this->input->post("day"),
            "month_of_birth" => $this->input->post("month"),
            "year_of_birth" => $this->input->post("year"),
            "marital_status" => $this->input->post("maritalstatus"),
            "having_children" => $this->input->post("havchildren"),
            "male_children" => $this->input->post("malechildren"),
            "female_children" => $this->input->post("femalechildren"),
            "height" => $this->input->post("height"),
            "weight" => $this->input->post("weight"),
            "blood_group" => $this->input->post("bloodgroup"),
            "body_type" => $this->input->post("bodytype"),
            "complexion" => $this->input->post("bodytypecomplexion"),
            "updatedat" => $updateddate,
        );

        $this->db->where('marriage_profile_id' , $marriage_profile_id)->update('marriage_profile', $blog_object);
		$this->session->set_flashdata("globalmsg", "Updated Succesfully");
        redirect(site_url("marriage/view/".$marriage_profile_id));
	} 

	public function edit_personalprofile($id)
	{
		if(!$this->user->loggedin) {
				redirect(site_url("login"));
		}
		$pagedata['months'] = $this->marriage_model->getmonths();
		$pagedata['bloodgroup'] = $this->marriage_model->getbloodgroup();
		$pagedata['marriageprofile'] =  $this->marriage_model->get_marriage_profile($id)->row();
		$this->template->loadContent("marriage/edit/edit_personalprofile.php" , $pagedata);
	}
	public function update_p_profile()
	{
	    $marriage_profile_id =  $this->input->post("marriage_profile_id");
		$updateddate = date('d-M-Y');
	
	    $blog_object = array(
		    "marriage_profile_id" => $this->input->post("marriage_profile_id"),
            "last_name" => $this->input->post("last_name"),
            "gender" => $this->input->post("gender"),
            "first_name" => $this->input->post("first_name"),
            "day_of_birth" => $this->input->post("day"),
            "month_of_birth" => $this->input->post("month"),
            "year_of_birth" => $this->input->post("year"),
            "marital_status" => $this->input->post("maritalstatus"),
            "having_children" => $this->input->post("havchildren"),
            "male_children" => $this->input->post("malechildren"),
            "female_children" => $this->input->post("femalechildren"),
            "height" => $this->input->post("height"),
            "weight" => $this->input->post("weight"),
            "blood_group" => $this->input->post("bloodgroup"),
            "body_type" => $this->input->post("bodytype"),
            "complexion" => $this->input->post("bodytypecomplexion"),
            "updatedat" => $updateddate,
        );

        $this->db->where('marriage_profile_id' , $marriage_profile_id)->update('marriage_profile', $blog_object);
		$this->session->set_flashdata("globalmsg", "Updated Succesfully");
        redirect(site_url("marriage/view/".$marriage_profile_id));
	}

	
	public function updatemypicture()
	{
		$marriage_profile_id =  $this->input->post("marriage_profile_id");
		$updateddate = date('d-M-Y');
	    $this->load->library("upload");
		if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
			$this->upload->initialize(array( 
		       "upload_path" => $this->settings->info->upload_path,
		       "overwrite" => FALSE,
		       "max_filename" => 300,
		       "encrypt_name" => TRUE,
		       "remove_spaces" => TRUE,
		       "allowed_types" => "gif|png|jpg|jpeg",
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
		    $blog_object = array(
              "profileimage" => $image,
               "marriage_profile_id" => $this->input->post("marriage_profile_id"),
               "updatedat" => $updateddate,
            
        );

        $this->db->where('marriage_profile_id' , $marriage_profile_id)->update('marriage_profile', $blog_object);
		$this->session->set_flashdata("globalmsg", "Updated Succesfully");
        redirect(site_url("marriage/view/".$marriage_profile_id));
	}


	public function edit_social($id)
	{
		if(!$this->user->loggedin) {
				redirect(site_url("login"));
		}
		$pagedata['religions'] =     $this->marriage_model->get_all_religions($id);
		$pagedata['comunitiesall'] = $this->marriage_model->getallcomunities();
		$pagedata['mothertounge'] =  $this->marriage_model->getmothertongue();
		$pagedata['marriageprofile'] =  $this->marriage_model->get_marriage_profile($id)->row();
		$this->template->loadContent("marriage/edit/edit_social.php" , $pagedata);
	}
	public function updatemysocial()
	{
		$marriage_profile_id =  $this->input->post("marriage_profile_id");
		$updateddate = date('d-M-Y');
		$blog_object = array(
             "relegion" => $this->input->post("religion"),
             "relegion_comunity" => $this->input->post("comunity"),
             "mother_tounge" => $this->input->post("mother_tongue"),
             "family_values" => $this->input->post("family_values"),
             "other_caste" => $this->input->post("othercaste"),
             "updatedat" => $updateddate,
            
        );

        $this->db->where('marriage_profile_id' , $marriage_profile_id)->update('marriage_profile', $blog_object);
		$this->session->set_flashdata("globalmsg", "Updated Succesfully");
        redirect(site_url("marriage/view/".$marriage_profile_id));
	}
	public function horscope($id)
	{
		if(!$this->user->loggedin) {
				redirect(site_url("login"));
		}
		$pagedata['countries'] = $this->marriage_model->get_all_countries();
	    $pagedata['star'] = $this->marriage_model->getstar();
	    $pagedata['moon_sign'] = $this->marriage_model->getmoonsign();
		$pagedata['marriageprofile'] =  $this->marriage_model->get_marriage_profile($id)->row();
		$this->template->loadContent("marriage/edit/horscope.php" , $pagedata);
	}
	public function updatehorscope()
	{
		$marriage_profile_id =  $this->input->post("marriage_profile_id");
		$updateddate = date('d-M-Y');
		$blog_object = array(
            "country_of_birth" => $this->input->post("country_of_birth"),
            "state_of_birth" => $this->input->post("state_of_birth"),
            "city_of_birth" => $this->input->post("city_of_birth"),
            "star" => $this->input->post("star"),
            "moon_sign" => $this->input->post("moon_sign"),
            "manglink" => $this->input->post("manglik"),
            "updatedat" => $updateddate,
        );


        $this->db->where('marriage_profile_id' , $marriage_profile_id)->update('marriage_profile', $blog_object);
		$this->session->set_flashdata("globalmsg", "Updated Succesfully");
        redirect(site_url("marriage/view/".$marriage_profile_id));
	}
	public function edit_career($id)
	{
		if(!$this->user->loggedin) {
				redirect(site_url("login"));
		}
		
		$pagedata['marriageprofile'] =  $this->marriage_model->get_marriage_profile($id)->row();
		$this->template->loadContent("marriage/edit/edit_career.php" , $pagedata);
	}
	public function updatemycareer()
	{
		$marriage_profile_id =  $this->input->post("marriage_profile_id");
		$updateddate = date('d-M-Y');
		$blog_object = array(
            "education_in" => $this->input->post("education_in"),
            "education_to" => $this->input->post("education_to"),
            "education_description" => $this->input->post("educational_description"),
            "occupation" => $this->input->post("ocupation"),
            "occupation_description" => $this->input->post("ocupation_description"),
             "occupation_description" => $this->input->post("ocupation_description"),
            "anual_income" => $this->input->post("anual_income"),
            "updatedat" => $updateddate,
        );

        $this->db->where('marriage_profile_id' , $marriage_profile_id)->update('marriage_profile', $blog_object);
		$this->session->set_flashdata("globalmsg", "Updated Succesfully");
        redirect(site_url("marriage/view/".$marriage_profile_id));
	}
	
	public function edit_lifestyle($id)
	{
		if(!$this->user->loggedin) {
				redirect(site_url("login"));
		}
		
		$pagedata['marriageprofile'] =  $this->marriage_model->get_marriage_profile($id)->row();
		$this->template->loadContent("marriage/edit/edit_lifestyle.php" , $pagedata);
	}

	public function updatelifestyle()
	{
		$marriage_profile_id =  $this->input->post("marriage_profile_id");
		$updateddate = date('d-M-Y');
		$blog_object = array(
            "diet" => $this->input->post("diet"),
            "smoke" => $this->input->post("smoke"),
            "drink" => $this->input->post("drink"),
             "updatedat" => $updateddate,
        );

        $this->db->where('marriage_profile_id' , $marriage_profile_id)->update('marriage_profile', $blog_object);
		$this->session->set_flashdata("globalmsg", "Updated Succesfully");
        redirect(site_url("marriage/view/".$marriage_profile_id));
	}
    
		public function edit_location($id)
	{
		if(!$this->user->loggedin) {
				redirect(site_url("login"));
		}
	
		$pagedata['countries'] = $this->marriage_model->get_all_countries($id);
		$pagedata['marriageprofile'] =  $this->marriage_model->get_marriage_profile($id)->row();
		$this->template->loadContent("marriage/edit/edit_location.php" , $pagedata);
	}
     public function updatelocation()
	{
		$marriage_profile_id =  $this->input->post("marriage_profile_id");
		$updateddate = date('d-M-Y');
		$blog_object = array(
            "country_of_resedence" => $this->input->post("country_of_resedence"),
            "state_of_resedence" => $this->input->post("state_of_resedence"),
            "city_of_resedence" => $this->input->post("city_of_resedence"),
            "zip_code" => $this->input->post("zip_code"),
            "address_line_1" => $this->input->post("address_line_1"),
            "address_line_2" => $this->input->post("address_line_2"),
            "updatedat" => $updateddate,
        );

        $this->db->where('marriage_profile_id' , $marriage_profile_id)->update('marriage_profile', $blog_object);
		$this->session->set_flashdata("globalmsg", "Updated Succesfully");
        redirect(site_url("marriage/view/".$marriage_profile_id));
	}

    public function edit_hobbies($id)
	{
		if(!$this->user->loggedin) {
				redirect(site_url("login"));
		}
		
		$pagedata['marriageprofile'] =  $this->marriage_model->get_marriage_profile($id)->row();
		$this->template->loadContent("marriage/edit/edit_hobbies.php" , $pagedata);
	}

	
	public function update_hobbies()
	{
		$marriage_profile_id =  $this->input->post("marriage_profile_id");
		$hobbyarray['hobbies'] = json_encode($this->input->post("hobbies"));
		$intrestarray['intrest'] = json_encode($this->input->post("intrests"));
		$updateddate = date('d-M-Y');
		$blog_object = array(
         "hobies" => $hobbyarray['hobbies'],
        "intrests" => $intrestarray['intrest'],
        "prefferddress" => $this->input->post("prefferddress"),
         "updatedat" => $updateddate,
       // "profile_status_step" => 5,
        );
		

        $this->db->where('marriage_profile_id' , $marriage_profile_id)->update('marriage_profile', $blog_object);
		$this->session->set_flashdata("globalmsg", "Updated Succesfully");
        redirect(site_url("marriage/view/".$marriage_profile_id));
	}



public function edit_family($id)
	{
		if(!$this->user->loggedin) {
				redirect(site_url("login"));
		}
		
		$pagedata['father_occup'] = $this->marriage_model->getfatheroccupation();
		$pagedata['mother_occup'] = $this->marriage_model->getmotheroccupation();
		$pagedata['marriageprofile'] =  $this->marriage_model->get_marriage_profile($id)->row();
		$this->template->loadContent("marriage/edit/edit_family.php" , $pagedata);
	}

    public function edit_familydescription($id)
	{
		if(!$this->user->loggedin) {
				redirect(site_url("login"));
		}
		//$pagedata['months'] = $this->marriage_model->getmonths();
		//$pagedata['bloodgroup'] = $this->marriage_model->getbloodgroup();
		$pagedata['marriageprofile'] =  $this->marriage_model->get_marriage_profile($id)->row();
		$this->template->loadContent("marriage/edit/edit_familydes.php" , $pagedata);
	}
	public function updatefamilydescription()
	{
		$marriage_profile_id =  $this->input->post("marriage_profile_id");
		$updateddate = date('d-M-Y');
		$blog_object = array(
        
        "describefamily" => $this->input->post("describefamily"),
          "updatedat" => $updateddate,
        );

        $this->db->where('marriage_profile_id' , $marriage_profile_id)->update('marriage_profile', $blog_object);
		$this->session->set_flashdata("globalmsg", "Updated Succesfully");
        redirect(site_url("marriage/view/".$marriage_profile_id));
	}
    public function edit_patner_profile($id)
	{
		if(!$this->user->loggedin) {
				redirect(site_url("login"));
		}
		
		$pagedata['patnerprofile']   =    $this->marriage_model->get_patner_profile($id)->row();
		$pagedata['marriageprofile'] =    $this->marriage_model->get_marriage_profile($id)->row();
		$this->template->loadContent("marriage/edit/edit_patner_profile.php" , $pagedata);
	}
	
	public function delete_profiles()
	{
     if(!$this->user->loggedin)
     {
		redirect(site_url("login"));
	}

     $id = $this->uri->segment(3);
     $partner_profile_id   =   $this->input->post("partner_profile_id");
	 $marriage_profile_id  =   $this->input->post("marriage_profile_id");
     $this->marriage_model->delete_profile_id($id);
     $this->db->where('marriage_profile_id' , $marriage_profile_id)->delete('marriage_profile');
     $this->session->set_flashdata("globalmsg", "Deleted Succesfully");
     redirect(site_url("marriage/profile/".$id));
	}
      public function hide_delete_profile($id)
	 {
		if(!$this->user->loggedin) {
		redirect(site_url("login"));
		}

		
		$pagedata['patnerprofile']   =   $this->marriage_model->get_patner_profile($id)->row();
		$pagedata['marriageprofile'] =   $this->marriage_model->get_marriage_profile($id)->row();
		$this->template->loadContent("marriage/edit/hide_delete_profile.php" , $pagedata);
	}
      public function hide_profile($id){

       if(!$this->user->loggedin) {
		redirect(site_url("login"));
		}

        
		$id = $this->uri->segment(3);
        $partner_profile_id   =   $this->input->post("partner_profile_id");
	    $marriage_profile_id  =   $this->input->post("marriage_profile_id");
		$updateddate = date('d-M-Y');
		$blog_object = array(
        "marriage_profile_id" => $this->input->post("marriage_profile_id"),
        "updatedat" => $updateddate,
        );
        $this->db->where('marriage_profile_id' , $marriage_profile_id)->update('marriage_profile', $blog_object);
		$this->session->set_flashdata("globalmsg", "Hide profile Succesfully");
        redirect(site_url("marriage/view/".$marriage_profile_id));
    }     
     public function show_profile($id){

       if(!$this->user->loggedin) {
		redirect(site_url("login"));
		}
		
		$id = $this->uri->segment(3);
        $partner_profile_id   =   $this->input->post("partner_profile_id");
	    $marriage_profile_id  =   $this->input->post("marriage_profile_id");
		$updateddate = date('d-M-Y');
		$blog_object = array(
        "marriage_profile_id" => $this->input->post("marriage_profile_id"),
        "updatedat" => $updateddate,
        );
        $this->db->where('marriage_profile_id' , $marriage_profile_id)->update('marriage_profile', $blog_object);
		$this->session->set_flashdata("globalmsg", "show profile Succesfully");
        redirect(site_url("marriage/view/".$marriage_profile_id));
    }

	   public function set_patner_profile($id)
	{
		if(!$this->user->loggedin) {
		redirect(site_url("login"));
		}
		
		$pagedata['patnerprofile'] =    $this->marriage_model->get_patner_profile($id)->row();
		$pagedata['marriageprofile'] =  $this->marriage_model->get_marriage_profile($id)->row();
		$this->template->loadContent("marriage/edit/set_patner_profile.php" , $pagedata);
	    $this->session->set_flashdata("globalmsg", "Updated Succesfully");
		$this->db->where('marriage_profile_id' , $marriage_profile_id)->update('partner_profile', $blog_object);
		 redirect(site_url("marriage/view/".$marriage_profile_id));
	}

		public function updateptnerprofile()

	{
	    $partner_profile_id = $this->input->post("partner_profile_id");
	    $marriage_profile_id =  $this->input->post("marriage_profile_id");
		$updateddate = date('d-M-Y');
		$agerange = $this->input->post("yearfrom")." Years To ".$this->input->post("yearto")." Years ";
		$height = $this->input->post("heightfrom")." To ".$this->input->post("heightto");
		$education = $this->input->post("education_in")." IN ".$this->input->post("education_to");
		$blog_object = array(
        "marriage_profile_id" =>  $this->input->post("marriage_profile_id"),
       // "partner_profile_id"  =>  $this->input->post("partner_profile_id"),
        "gender" => $this->input->post("gender"),
        "agerange" => $this->input->post("agerange"),
        "maritalstatus	" => $this->input->post("maritalstatus"),
        "havchildren" => $this->input->post("havchildren"),
        "malechildren" => $this->input->post("malechildren"),
        "femalechildren" => $this->input->post("femalechildren"),
        "height" => $this->input->post("height"),
        "bodytype" => $this->input->post("bodytype"),
        "complexion" => $this->input->post("complexion"),
        "specialcases" => $this->input->post("specialcases"),
        "updatedat" => $updateddate,
       );

        $this->db->where('marriage_profile_id' , $marriage_profile_id)->update('partner_profile', $blog_object);
		$this->session->set_flashdata("globalmsg", "Updated Succesfully");
        redirect(site_url("marriage/view/".$marriage_profile_id));
	}
	 public function updatefamily()
	 {
		$marriage_profile_id =  $this->input->post("marriage_profile_id");
		$updateddate = date('d-M-Y');
		$blog_object = array(
        "describepersonality" => $this->input->post("describepersonality"),
        "familystatus" => $this->input->post("familystatus"),
        "fathername" => $this->input->post("fathername"),
        "father_occup" => $this->input->post("father_occup"),
        "mothername" => $this->input->post("mothername"),
        "mother_occup" => $this->input->post("mother_occup"),
        "havebrothers" => $this->input->post("havebrothers"),
        "marriedbrother" => $this->input->post("marriedbrother"),
        "unmarriedbrother" => $this->input->post("unmarriedbrother"),
        "havesisters" => $this->input->post("havesisters"),
        "marriedsister" => $this->input->post("marriedsister"),
        "unmarriedsister" => $this->input->post("unmarriedsister"),
         "updatedat" => $updateddate,
       
        );

        $this->db->where('marriage_profile_id' , $marriage_profile_id)->update('marriage_profile', $blog_object);
		$this->session->set_flashdata("globalmsg", "Updated Succesfully");
        redirect(site_url("marriage/view/".$marriage_profile_id));
	}
    public function edit_p_social($id)
	{
		if(!$this->user->loggedin) {
				redirect(site_url("login"));
		}
		//$pagedata['months'] = $this->marriage_model->getmonths();
        $pagedata['relijion'] = $this->marriage_model->getreligionname($id);
		$pagedata['religions'] = $this->marriage_model->get_all_religions($id);
		$pagedata['patnerprofile'] =    $this->marriage_model->get_patner_profile($id)->row();
		$pagedata['marriageprofile'] =  $this->marriage_model->get_marriage_profile($id)->row();
		$this->template->loadContent("marriage/edit/edit_p_social.php" , $pagedata);
	}
		public function update_P_social()
	{  
	    $partner_profile_id = $this->input->post("partner_profile_id");
	    $marriage_profile_id =  $this->input->post("marriage_profile_id");
		$updateddate = date('d-M-Y');
		$blog_object = array(
		"marriage_profile_id" =>  $this->input->post("marriage_profile_id"),
       // "partner_profile_id"  =>  $this->input->post("partner_profile_id"),
        "relijion" => $this->input->post("religion"),
        "comunity" => $this->input->post("comunity"),
        "familyvalues" => $this->input->post("familyvalues"),
        "updatedat" => $updateddate,
            
        );

        $this->db->where('marriage_profile_id' , $marriage_profile_id)->update('partner_profile', $blog_object);
		$this->session->set_flashdata("globalmsg", "Updated Succesfully");
        redirect(site_url("marriage/view/".$marriage_profile_id));
	}

	 public function edit_p_lifestyle($id)
	 {
		if(!$this->user->loggedin) {
				redirect(site_url("login"));
		}
		//$pagedata['months'] = $this->marriage_model->getmonths();
		$pagedata['patnerprofile'] =  $this->marriage_model->get_patner_profile($id)->row();
		$pagedata['marriageprofile'] =  $this->marriage_model->get_marriage_profile($id)->row();
		$this->template->loadContent("marriage/edit/edit_p_lifestyle.php" , $pagedata);
	}
		public function update_p_lifestyle()
	{   $profileid =  $this->input->post("profileid");
		//$partner_profile_id =   $this->input->post("partner_profile_id");
		$marriage_profile_id =  $this->input->post("marriage_profile_id");
		$updateddate = date('d-M-Y');
		$blog_object = array(
		"marriage_profile_id" =>  $this->input->post("marriage_profile_id"),
        "partner_profile_id"  =>  $this->input->post("partner_profile_id"),
        "diet" => $this->input->post("diet"),
        "smoke" => $this->input->post("smoke"),
        "drink" => $this->input->post("drink"),
        "updatedat" => $updateddate,
        );

        $this->db->where('partner_profile_id' , $partner_profile_id)->update('partner_profile', $blog_object);
		$this->session->set_flashdata("globalmsg", "Updated Succesfully");
        redirect(site_url("marriage/view/".$marriage_profile_id));
	}
	 public function edit_p_location($id)
	{
		if(!$this->user->loggedin) {
				redirect(site_url("login"));
		}
	
		$pagedata['countries'] = $this->marriage_model->get_all_countries($id);
		$pagedata['patnerprofile'] =  $this->marriage_model->get_patner_profile($id)->row();
		$pagedata['marriageprofile'] =  $this->marriage_model->get_marriage_profile($id)->row();
		
		$this->template->loadContent("marriage/edit/edit_p_location.php" , $pagedata);
	}
  public function update_p_location()
	{
		 $profileid =  $this->input->post("profileid");
		$partner_profile_id =   $this->input->post("partner_profile_id");
		$marriage_profile_id =  $this->input->post("marriage_profile_id");
		$updateddate = date('d-M-Y');
		$blog_object = array(
		"marriage_profile_id" =>  $this->input->post("marriage_profile_id"),
        //"partner_profile_id"  =>  $this->input->post("partner_profile_id"),
        "country" => $this->input->post("country"),
        "statename" => $this->input->post("state"),
        "cityname" => $this->input->post("city"),
         "updatedat" => $updateddate,
        );

        $this->db->where('marriage_profile_id' , $marriage_profile_id)->update('partner_profile', $blog_object);
		$this->session->set_flashdata("globalmsg", "Updated Succesfully");
        redirect(site_url("marriage/view/".$marriage_profile_id));

	}	
	 public function edit_p_career($id)
	{
		if(!$this->user->loggedin) {
				redirect(site_url("login"));
		}
		$pagedata['patnerprofile'] =  $this->marriage_model->get_patner_profile($id)->row();
	
		$pagedata['marriageprofile'] =  $this->marriage_model->get_marriage_profile($id)->row();
		$this->template->loadContent("marriage/edit/edit_p_career.php" , $pagedata);
	}
	public function update_p_career()
	{   $profileid =  $this->input->post("profileid");
		$partner_profile_id =   $this->input->post("partner_profile_id");
		$marriage_profile_id =  $this->input->post("marriage_profile_id");
		$updateddate = date('d-M-Y');
		$blog_object = array(
		"marriage_profile_id" =>  $this->input->post("marriage_profile_id"),
       // "partner_profile_id"  =>  $this->input->post("partner_profile_id"),
		"education" => $education, 
       "education_in" => $this->input->post("education_in"),
       "education_to" => $this->input->post("education_to"),
        "ocupation" => $this->input->post("ocupation"),
        "updatedat" => $updateddate,
        );

        $this->db->where('marriage_profile_id' , $marriage_profile_id)->update('partner_profile', $blog_object);
		$this->session->set_flashdata("globalmsg", "Updated Succesfully");
        redirect(site_url("marriage/view/".$marriage_profile_id));
	}
	public function getmemberprofilesbysearchid($id)
	{
		$getmember = $this->marriage_model->get_marriage_profile($id)->row();
		if (!empty($getmember)) {
		echo '<div style="margin-top: 20px;" class="col-md-6 sfjksdfsidfhn">
		<div style="border: 1px solid #DDD; border-radius: 2px; display: flex;">
			<div style="width: 200px; height: 200px;">
				<img style="width: 100%;height: 100%; object-fit: contain;" src="'.base_url().$this->settings->info->upload_path_relative.'/'.$getmember->profileimage.'">
			</div>
			<div style="margin-left: 10px; padding: 10px;">
				<div style="padding: 5px;">
					<b style="color: red;">Profile ID:</b><span style="padding-left: 20px; color: red;">'.$getmember->marriage_profile_id.'</span>
				</div>
				<div style="padding: 5px;">
					<b>Name:</b><span style="padding-left: 35px;">'.$getmember->first_name.' '.$getmember->last_name.' </span>
				</div>
				<div style="padding: 5px;">
					<b>Age:</b><span style="padding-left: 50px;">'.$getmember->age.' Years</span>
				</div>
				<div style="text-align: right;" >
					<a class="btn btn-success" href="'.site_url("marriage/view/").$getmember->marriage_profile_id.'">View</a>
				</div>
			</div>
		</div>
	</div>';
	}else{ 
		echo '<div class="col-md-3"></div>
		<div class="col-md-9">
			<h4 style="color: red;border: 1px solid #DDD;text-align: center;padding: 10px; font-weight:bold;">Invalid ID</h4>
		</div></div>';
	}
	}



	public function quicksearch()
	{

		$look =	$this->input->post("look");
	 	$photo	=$this->input->post("photo");
		$agefrom =	$this->input->post("agefrom");
		$ageto	=$this->input->post("ageto");
		$religions	=$this->input->post("religions");
		$comunity	= $this->input->post("comunity");
	    $country	= $this->input->post("country");
	    
	    $getdata = $this->marriage_model->getquicksearch($look , $photo , $agefrom , $ageto , $religions , $comunity, $country);
	    if ($getdata->num_rows()>0) {
	    	foreach ($getdata->result() as $r) {
	    		if ($r->status == 1) {
	    			$status = '<span class="label label-info">Online </span>'; 
	    		} else {
	    			$status = '<span class="label label-danger">Ofline </span>'; 
	    		}
		echo '<div style="margin-top: 20px;" class="col-md-6">
		<div style="border: 1px solid #DDD; border-radius: 2px;">
			<div class="row">
				<div class="col-md-5">
					<div style="width: 100%; border-right: 1px solid #DDD;">
						<img style="width: 100%;height: 170px; object-fit: contain;" src="'.base_url().$this->settings->info->upload_path_relative.'/'.$r->profileimage.'">
					</div>
				</div>
				<div class="col-md-7">
					<div style="margin-left: 10px; padding: 10px;">
						<div style="padding: 5px;">
							<b style="color: red;">Profile ID:</b><span style="padding-left: 20px; color: red;">'.$r->marriage_profile_id.'</span>
						</div>
						<div style="padding: 5px;">
							<b>Name:</b><span style="padding-left: 35px;">'.$r->first_name.' '.$r->last_name.' </span>
						</div>
						<div style="padding: 5px;">
							<b>Age:</b><span style="padding-left: 50px;">'.$r->age.' Years</span>
						</div>
						<div style="padding: 5px;">
							<b>Religion:</b><span style="padding-left: 20px;">'.@$this->marriage_model->getreligionname($r->relegion)->row()->name.'</span>
						</div>
						<div>
							<b>Status:</b><span style="margin-left: 20px;">'.$status.'</span>
						</div>
						<div style="text-align: right;">
							<a class="btn btn-success btn-view-mprofile" href="'.site_url('marriage/view/') . $r->marriage_profile_id.'">View</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>';
	}
	}else{ 
		echo '<div class="col-md-3"></div>
		<div class="col-md-9">
			<h4 style="color: red;border: 1px solid #DDD;text-align: center;padding: 10px; font-weight:bold;">No Record Found</h4>
		</div></div>';
	}
	}

	public function marriageprofile($id)
	{
		if(!$this->user->loggedin) {
				redirect(site_url("login"));
		}
		$pagedata['marriageprofile'] =  $this->marriage_model->get_marriage_profile($id)->row();
		$this->template->loadContent("marriage/marriageprofile.php" , $pagedata);
	}
     public function marriageprofile_stats($id)
	{
		if(!$this->user->loggedin) {
				redirect(site_url("login"));
		}
		$pagedata['marriageprofile'] =  $this->marriage_model->get_marriage_profile($id)->row();
		$this->template->loadContent("marriage/profile_statistics.php" , $pagedata);
	}


	public function sendrequestforphotos()
	{
			$id =	$this->input->post("profileid");
			$msg =	$this->input->post("message");
			$frommarriageid =	$this->input->post("frommarriageid");

			$userid =  $this->marriage_model->get_marriage_profile($id)->row()->users_id;
			$firstname =  $this->marriage_model->get_marriage_profile($id)->row()->first_name;
			$lastname =  $this->marriage_model->get_marriage_profile($id)->row()->last_name;

			$this->user_model->add_notification(array(
			"userid" => $userid,
			"url" => "marriage/marriageprofile/" . $id,
			"timestamp" => time(),
			"message" => $this->user->info->first_name . " " . $this->user->info->last_name . " Request for Photos of " . $firstname." ". $lastname ." Marriage Profile",
			"status" => 0,
			"fromid" => $this->user->info->ID,
			"username" => $this->user->info->username
			)
		);
		$blog_object = array(    
	        "name" => 'Photos',
	         "user_id" => $userid,
	         "from_id" => $this->user->info->ID,
	         "to_marriage_profile_id" => $id,
	         "from_marriage_profile_id" => $frommarriageid,
	         "status" => 0,
	         "message" => $msg,
	        );
		$this->db->insert('marriage_requests', $blog_object);
		echo "Request Sended Successfully";
	}


	public function sendrequestforcontact()
	{
		$id =	$this->input->post("profileid");
		$msg =	$this->input->post("message");
		$frommarriageid =	$this->input->post("frommarriageid");

		$userid =  $this->marriage_model->get_marriage_profile($id)->row()->users_id;
		$firstname =  $this->marriage_model->get_marriage_profile($id)->row()->first_name;
		$lastname =  $this->marriage_model->get_marriage_profile($id)->row()->last_name;
		$this->user_model->increment_field($userid, "noti_count", 1);
		$this->user_model->add_notification(array(
			"userid" => $userid,
			"url" => "marriage/marriageprofile/" . $id,
			"timestamp" => time(),
			"message" => $this->user->info->first_name . " " . $this->user->info->last_name . " Request for Contact Details of " . $firstname." ". $lastname ." Marriage Profile",
			"status" => 0,
			"fromid" => $this->user->info->ID,
			"username" => $this->user->info->username
			)
		);
		$blog_object = array(    
         "name" => 'Contact',
         "user_id" => $userid,
         "from_id" => $this->user->info->ID,
         "to_marriage_profile_id" => $id,
         "from_marriage_profile_id" => $frommarriageid,
         "status" => 0,
         "message" => $msg,
        );
        $this->db->insert('marriage_requests', $blog_object);
		echo "Request Sended Successfully";
	}

	public function allrequests($id)
	{
		if(!$this->user->loggedin) {
				redirect(site_url("login"));
		}
		$userid =  $this->marriage_model->get_marriage_profile($id)->row()->users_id;

		if ($userid == $this->user->info->ID) {
		$pagedata['marriageprofile'] =  $this->marriage_model->get_marriage_profile($id)->row();
		$pagedata['requests'] =  $this->marriage_model->getphotorequests($id);
		$this->template->loadContent("marriage/photosrequests.php" , $pagedata);
		}else{
			redirect(site_url());
		}
	}


	public function getsinglerequests()
	{
		$id =	$this->input->post("profileid");
		$data = $this->db->where('ID' , $id)->get('marriage_requests')->row();
		echo json_encode($data);
	}



	public function getsinglecontact()
	{
		$id =	$this->input->post("id");
		$data = $this->db->where('ID' , $id)->get('data_against_requests')->row();
		echo json_encode($data);
	}

	public function sendphotos()
	{
	 	$toprofileid =	$this->input->post("toprofileid");
		$message =	$this->input->post("message");
		 $fromprofileid =	$this->input->post("fromprofileid");
		$this->load->library("upload");
		if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
			$this->upload->initialize(array( 
		       "upload_path" => $this->settings->info->upload_path,
		       "overwrite" => FALSE,
		       "max_filename" => 300,
		       "encrypt_name" => TRUE,
		       "remove_spaces" => TRUE,
		       "allowed_types" => "gif|png|jpg|jpeg",
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

	 $firstnamefrom =  $this->marriage_model->get_marriage_profile($toprofileid)->row()->first_name;
	 $lastnamefrom  =  $this->marriage_model->get_marriage_profile($toprofileid)->row()->last_name;
	 $userid  =        $this->marriage_model->get_marriage_profile($fromprofileid)->row()->users_id;
	 $this->user_model->increment_field($userid, "noti_count", 1);
		$this->user_model->add_notification(array(
			"userid" => $userid,
			"url" => "marriage/marriageprofile/" . $id,
			"timestamp" => time(),
			"message" => $this->user->info->first_name . " " . $this->user->info->last_name . " Sent Some Photos of " . $firstnamefrom." ". $lastnamefrom ." Marriage Profile",
			"status" => 0,
			"fromid" => $this->user->info->ID,
			"username" => $this->user->info->username
			)
		);

		$blog_object = array(    
	        "image" => $image,
	         "message" => $message,
	         "frommarriageid" => $toprofileid,
	         "tomarriageid" => $fromprofileid,
	         "timestamp" => time(),
	         "status" => 'photo',
	         "request_id" => $this->input->post("requestid"),
        );

		$this->db->set('status' , 1)->where('ID' , $this->input->post("requestid"))->update('marriage_requests');
        $this->db->insert('data_against_requests', $blog_object);
        $this->session->set_flashdata("globalmsg", "Photos Send Succesfully!");
		redirect(site_url('marriage/allrequests/'.$toprofileid));
	}


	public function sendcontact()
	{
		$toprofileid =	$this->input->post("toprofileid");
		$message =	$this->input->post("message");
		$fromprofileid =	$this->input->post("fromprofileid");
		$address =	$this->input->post("address");
		$contact =	$this->input->post("contactnumber");


		$firstnamefrom =  $this->marriage_model->get_marriage_profile($toprofileid)->row()->first_name;
	    $lastnamefrom  =  $this->marriage_model->get_marriage_profile($toprofileid)->row()->last_name;
	    $userid  =  $this->marriage_model->get_marriage_profile($fromprofileid)->row()->users_id;

	    $this->user_model->increment_field($userid, "noti_count", 1);
	    $this->user_model->add_notification(array(
			"userid" => $userid,
			"url" => "marriage/recievedcontacts/" . $toprofileid,
			"timestamp" => time(),
			"message" => $this->user->info->first_name . " " . $this->user->info->last_name . " Sent Contact Details of " . $firstnamefrom." ". $lastnamefrom ." Marriage Profile",
			"status" => 0,
			"fromid" => $this->user->info->ID,
			"username" => $this->user->info->username
			)
		);

		$this->db->set('status' , 1)->where('ID' , $this->input->post("requestid"))->update('marriage_requests');

		$blog_object = array(    
	        "contactnumber" => $contact,
	        "address" => $address,
	         "message" => $message,
	         "frommarriageid" => $toprofileid,
	         "tomarriageid" => $fromprofileid,
	         "timestamp" => time(),
	         "status" => 'contact',
	         "request_id" => $this->input->post("requestid"),
        );


		$this->db->insert('data_against_requests', $blog_object);
        $this->session->set_flashdata("globalmsg", "Contact Details Send Succesfully!");
		redirect(site_url('marriage/allrequests/'.$toprofileid));
	}



	public function recievedphotos($id)
	{
		if(!$this->user->loggedin) {
				redirect(site_url("login"));
		}
		$userid =  $this->marriage_model->get_marriage_profile($id)->row()->users_id;
		if ($userid == $this->user->info->ID) {
		$pagedata['marriageprofile'] =  $this->marriage_model->get_marriage_profile($id)->row();
		$pagedata['allphotos'] =  $this->marriage_model->getphoto($id);
		$this->template->loadContent("marriage/dataphoto.php" , $pagedata);
		}else{
			redirect(site_url());
		}
	}


	public function recievedcontacts($id)
	{
		if(!$this->user->loggedin) {
			redirect(site_url("login"));
		}
		$userid =  $this->marriage_model->get_marriage_profile($id)->row()->users_id;
		if ($userid == $this->user->info->ID) {
		$pagedata['marriageprofile'] =  $this->marriage_model->get_marriage_profile($id)->row();
		$pagedata['allcontacts'] =  $this->marriage_model->getcontact($id);
		$this->template->loadContent("marriage/datacontact.php" , $pagedata);
		}else{
			redirect(site_url());
		}
	}

	public function addfavourite()
	{
		$id =	$this->input->post("profileid");
		$msg =	$this->input->post("message");
		$frommarriageid =	$this->input->post("frommarriageid");

		$userid =  $this->marriage_model->get_marriage_profile($id)->row()->users_id;
		$firstname =  $this->marriage_model->get_marriage_profile($id)->row()->first_name;
		$lastname =  $this->marriage_model->get_marriage_profile($id)->row()->last_name;
		$this->user_model->increment_field($userid, "noti_count", 1);
		$this->user_model->add_notification(array(
			"userid" => $userid,
			"url" => "marriage/favourities/" . $id,
			"timestamp" => time(),
			"message" => $this->user->info->first_name . " " . $this->user->info->last_name . " Added Favourities Your " . $firstname." ". $lastname ." Marriage Profile",
			"status" => 0,
			"fromid" => $this->user->info->ID,
			"username" => $this->user->info->username
			)
		);
		$blog_object = array(    
         "formmarriageprofile" => $id,
         "tomarriageprofile" => $frommarriageid,
        );
        $this->db->insert('marriage_favourities', $blog_object);
		echo "Favourite Aded Successfully";
	}

	public function favourities($id)
	{
		if(!$this->user->loggedin) {
				redirect(site_url("login"));
		}
		$pagedata['marriageprofile'] =  $this->marriage_model->get_marriage_profile($id)->row();
		$pagedata['allfavourities'] =  $this->marriage_model->getfavourities($id);
		$this->template->loadContent("marriage/favourities.php" , $pagedata);
	}


	public function loadmoreprofiles()
	{
		 $pagenumber = $this->input->post("pagenumber");
		 $data = $this->marriage_model->get_new_profiles($pagenumber);
		 foreach ($data->result() as $r) { 
		 	if (!empty($r->country)) {
				 $countryname =  $this->marriage_model->getcountryname($r->country)->row()->name; 
				}else{
					$countryname =  " N/A ";
				}
				if (!empty($r->relegion)) { 
					$religionname = $this->marriage_model->getreligionname($r->relegion)->row()->name; 
				}
				else{
					$religionname = " N/A ";
				}

				if($r->status == 1){ 
					$test = '<span class="label label-info"> Online </span>';
				 }else { 
				  $test = '<span class="label label-danger">Ofline </span>';
				 } 
		 	echo 		'<div style="margin-top: 20px;" class="col-md-6 sfjksdfsidfhn">
		<div style="border: 1px solid #DDD; border-radius: 2px;">
			<div class="row">
				<div class="col-md-5">
					<div style="width: 100%; border-right: 1px solid #DDD;">
						<img style="width: 100%;height: 170px; object-fit:contain;" src="'.base_url().$this->settings->info->upload_path_relative.'/'.$r->profileimage.'">
					</div>
				</div>
				<div class="col-md-7">
					<div style="margin-left: 10px; padding: 10px;">
						<div >
							<b style="color: red;">Profile ID:</b><span style="padding-left: 20px; color: red;">'.$r->marriage_profile_id.'</span>
						</div>
						<div>
							<b>Name:</b><span style="padding-left: 35px;">'.$r->first_name.' '.$r->last_name.'</span>
						</div>
						<div >
							<b>Age:</b><span style="padding-left: 50px;">'.$r->age.' Years</span>
						</div>
						<div >
							<b>Religion:</b><span style="padding-left: 20px;">'.$religionname.'</span>
						</div>
						<div >
							<b>Status:</b><span style="margin-left: 20px;">'. $test.'</span>
						</div>
						<div style="text-align: right;" >
							<a class="btn btn-success" href="'.site_url("marriage/view/").$r->marriage_profile_id.'">View</a>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>';
		 }
 	} 


 	public function statusactive()
 	{
 		$userid = $this->user->info->ID;
 		$username = $this->user->info->username;
 		$blog_object = array(
        "status" => 1,
        );
		$this->db->where('users_id' , $userid)->update('marriage_profile', $blog_object);
		redirect(site_url("marriage/profile/".$username));
 	}
 	public function statusinactive()
 	{
 		$userid = $this->user->info->ID;
 		$username = $this->user->info->username;
 		$blog_object = array(
        "status" => 0,
        );
		$this->db->where('users_id' , $userid)->update('marriage_profile', $blog_object);
		redirect(site_url("marriage/profile/".$username));
 	}

}

?>