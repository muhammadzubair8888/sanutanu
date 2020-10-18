<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Settings extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("user_model");
		$this->load->model("page_model");
		$this->load->model("admin_model");
		$this->load->model("home_model");

		if(!$this->user->loggedin) $this->template->error(lang("error_1"));
		
		$this->template->loadData("activeLink", 
			array("settings" => array("general" => 1)));
		$this->template->set_layout("client/themes/titan.php");
	}

	public function index() 
	{
		$fields = $this->user_model->get_custom_fields_answers(array(
			"edit" => 1
			), $this->user->info->ID);


		$relationship_user = "";
		if($this->user->info->relationship_userid > 0) {
			$user = $this->user_model->get_user_by_id($this->user->info->relationship_userid);
			if($user->num_rows() > 0) {
				$user = $user->row();
				$relationship_user = $user->first_name . " " . $user->last_name;
			}
		}

		// Look for request
		$request = $this->user_model->get_relationship_request($this->user->info->ID);

		// Get invite requests
		$requests = $this->user_model->get_relationship_request_invites($this->user->info->ID);

		$this->template->loadContent("user_settings/index.php", array(
			"fields" => $fields,
			"relationship_user" => $relationship_user,
			"request" => $request,
			"requests" => $requests
			)
		);
	}

	public function pro() 
	{
		$this->load->model("register_model");
		$fields = $this->user_model->get_custom_fields_answers(array(
			"edit" => 1
			), $this->user->info->ID);
		
		$this->load->helper('email');
		$this->load->library("upload");
		$email = $this->common->nohtml($this->input->post("email"));
		$first_name = $this->common->nohtml($this->input->post("first_name"));
		$last_name = $this->common->nohtml($this->input->post("last_name"));
		$aboutme = $this->common->nohtml($this->input->post("aboutme"));

		$address_1 = $this->common->nohtml($this->input->post("address_1"));
		$address_2 = $this->common->nohtml($this->input->post("address_2"));
		$city = $this->common->nohtml($this->input->post("city"));
		$state = $this->common->nohtml($this->input->post("state"));
		$zipcode = $this->common->nohtml($this->input->post("zipcode"));
		$country = $this->common->nohtml($this->input->post("country"));

		$location_from = $this->common->nohtml($this->input->post("location_from"));
		$location_live = $this->common->nohtml($this->input->post("location_live"));

		$relationship_status = intval($this->input->post("relationship_status"));
		$relationship_user = intval($this->input->post("userid"));

		if($relationship_status < 0 || $relationship_status > 3) {
			$this->template->error(lang("error_144"));
		}

		$profile_comments = intval($this->input->post("profile_comments"));

		$this->load->helper('email');

		if (empty($email)) $this->template->error(lang("error_18"));

		if (!valid_email($email)) {
			$this->template->error(lang("error_47"));
		}

		if($email != $this->user->info->email) {
			if (!$this->register_model->checkEmailIsFree($email)) {
				$this->template->error(lang("error_20"));
			}
		}

		$enable_email_notification = 
			intval($this->input->post("enable_email_notification"));
		if($enable_email_notification > 1 || $enable_email_notification < 0) 
			$enable_email_notification = 0;

		if ($this->settings->info->avatar_upload) {
			if ($_FILES['userfile']['size'] > 0) {
				if(!$this->settings->info->resize_avatar) {
					$settings = array(
						"upload_path" => $this->settings->info->upload_path,
						"overwrite" => FALSE,
						"max_filename" => 300,
						"encrypt_name" => TRUE,
						"remove_spaces" => TRUE,
						"allowed_types" => $this->settings->info->file_types,
						"max_size" => $this->settings->info->file_size,
					);
					if($this->settings->info->avatar_width > 0) {
						$settings['max_width'] = $this->settings->info->avatar_width;
					}
					if($this->settings->info->avatar_height > 0) {
						$settings['max_height'] = $this->settings->info->avatar_height;
					}
					$this->upload->initialize($settings);

				    if (!$this->upload->do_upload()) {
				    	$this->template->error(lang("error_21")
				    	.$this->upload->display_errors());
				    }

				    $data = $this->upload->data();

				    $image = $data['file_name'];
				} else {
					$this->upload->initialize(array( 
				       "upload_path" => $this->settings->info->upload_path,
				       "overwrite" => FALSE,
				       "max_filename" => 300,
				       "encrypt_name" => TRUE,
				       "remove_spaces" => TRUE,
				       "allowed_types" => "gif|png|jpg|jpeg",
				       "max_size" => $this->settings->info->file_size,
				    ));

				    if (!$this->upload->do_upload()) {
				    	$this->template->error(lang("error_21")
				    	.$this->upload->display_errors());
				    }

				    $data = $this->upload->data();

				    $image = $data['file_name'];

					$config['image_library'] = 'gd2';
					$config['source_image'] =  $this->settings->info->upload_path . "/" . $image;
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = FALSE;
					$config['width']         = $this->settings->info->avatar_width;
					$config['height']       = $this->settings->info->avatar_height;

					$this->load->library('image_lib', $config);

					if ( ! $this->image_lib->resize()) {
					       $this->template->error(lang("error_21") . 
					       	$this->image_lib->display_errors());
					}
				}
			} else {
				$image= $this->user->info->avatar;
			}

			if ($_FILES['userfile_profile']['size'] > 0) {
				$this->upload->initialize(array( 
			       "upload_path" => $this->settings->info->upload_path,
			       "overwrite" => FALSE,
			       "max_filename" => 300,
			       "encrypt_name" => TRUE,
			       "remove_spaces" => TRUE,
			       "allowed_types" => "gif|png|jpg|jpeg",
			       "max_size" => $this->settings->info->file_size
			    ));

			    if (!$this->upload->do_upload("userfile_profile")) {
			    	$this->template->error(lang("error_21")
			    	.$this->upload->display_errors());
			    }

			    $data = $this->upload->data();

			    $profile_header = $data['file_name'];
			} else {
				$profile_header = $this->user->info->profile_header;
			}
		} else {
			$profile_header = $this->user->info->profile_header;
			$image= $this->user->info->avatar;
		}

		// Custom Fields
			// Process fields
			$answers = array();
			foreach($fields->result() as $r) {
				$answer = "";
				if($r->type == 0) {
					// Look for simple text entry
					$answer = $this->common->nohtml($this->input->post("cf_" . $r->ID));

					if($r->required && empty($answer)) {
						$this->template->error(lang("error_78") . $r->name);
					}
					// Add
					$answers[] = array(
						"fieldid" => $r->ID,
						"answer" => $answer
					);
				} elseif($r->type == 1) {
					// HTML
					$answer = $this->common->nohtml($this->input->post("cf_" . $r->ID));

					if($r->required && empty($answer)) {
						$this->template->error(lang("error_78") . $r->name);
					}
					// Add
					$answers[] = array(
						"fieldid" => $r->ID,
						"answer" => $answer
					);
				} elseif($r->type == 2) {
					// Checkbox
					$options = explode(",", $r->options);
					foreach($options as $k=>$v) {
						// Look for checked checkbox and add it to the answer if it's value is 1
						$ans = $this->common->nohtml($this->input->post("cf_cb_" . $r->ID . "_" . $k));
						if($ans) {
							if(empty($answer)) {
								$answer .= $v;
							} else {
								$answer .= ", " . $v;
							}
						}
					}

					if($r->required && empty($answer)) {
						$this->template->error(lang("error_78") . $r->name);
					}
					$answers[] = array(
						"fieldid" => $r->ID,
						"answer" => $answer
					);

				} elseif($r->type == 3) {
					// radio
					$options = explode(",", $r->options);
					if(isset($_POST['cf_radio_' . $r->ID])) {
						$answer = intval($this->common->nohtml($this->input->post("cf_radio_" . $r->ID)));
						
						$flag = false;
						foreach($options as $k=>$v) {
							if($k == $answer) {
								$flag = true;
								$answer = $v;
							}
						}
						if($r->required && !$flag) {
							$this->template->error(lang("error_78") . $r->name);
						}
						if($flag) {
							$answers[] = array(
								"fieldid" => $r->ID,
								"answer" => $answer
							);
						}
					}

				} elseif($r->type == 4) {
					// Dropdown menu
					$options = explode(",", $r->options);
					$answer = intval($this->common->nohtml($this->input->post("cf_" . $r->ID)));
					$flag = false;
					foreach($options as $k=>$v) {
						if($k == $answer) {
							$flag = true;
							$answer = $v;
						}
					}
					if($r->required && !$flag) {
						$this->template->error(lang("error_78") . $r->name);
					}
					if($flag) {
						$answers[] = array(
							"fieldid" => $r->ID,
							"answer" => $answer
						);
					}
				}
			}

		if($relationship_status > 1) {
			if($relationship_user > 0 && $this->user->info->relationship_userid != $relationship_user) {
				$user = $this->user_model->get_user_by_id($relationship_user);
				if($user->num_rows() == 0) {
					$this->template->error(lang("error_145"));
				}

				$user = $user->row();

				// They must be friends in order to send request
				$flags = $this->common->check_friend($this->user->info->ID, $user->ID);
				if(!$flags['friend_flag']) {
					$this->template->error(lang("error_146"));
				}

				// Check to see if user hasn't already sent this user a request
				$request = $this->user_model->check_relationship_request($user->ID, $this->user->info->ID);
				if($request->num_rows() == 0) {

					// Now delete any other requests from this user
					$this->user_model->delete_relationship_request_from_user($this->user->info->ID);

					// Send request
					$this->user_model->add_relationship_request(array(
						"userid" => $user->ID,
						"friendid" => $this->user->info->ID,
						"status" => 0,
						"relationship_status" => $relationship_status
						)
					);

					// Notification
					$this->user_model->increment_field($user->ID, "noti_count", 1);
					$this->user_model->add_notification(array(
						"userid" => $user->ID,
						"url" => "user_settings#relationship_part",
						"timestamp" => time(),
						"message" => $this->user->info->first_name . " " . $this->user->info->last_name . " " . lang("ctn_662"),
						"status" => 0,
						"fromid" => $this->user->info->ID,
						"username" => $user->username,
						"email" => $user->email,
						"email_notification" => $user->email_notification
						)
					);
				}
			}
		} else {
			if($this->user->info->relationship_userid > 0) {
				$this->user_model->update_user($this->user->info->relationship_userid, array(
					"relationship_userid" => 0
					)
				);
			}
			$this->user->info->relationship_userid = 0;

		}


		$this->user_model->update_user($this->user->info->ID, array(
			"email" => $email, 
			"first_name" => $first_name, 
			"last_name" => $last_name,
			"email_notification" => $enable_email_notification,
			"avatar" => $image,
			"aboutme" => $aboutme,
			"address_1" => $address_1,
			"address_2" => $address_2,
			"city" => $city,
			"state" => $state,
			"zipcode" => $zipcode,
			"country" => $country,
			"profile_comments" => $profile_comments,
			"profile_header" => $profile_header,
			"location_from" => $location_from,
			"location_live" => $location_live,
			"relationship_status" => $relationship_status,
			"relationship_userid" => $this->user->info->relationship_userid
			)
		);

		// Update CF
		// Add Custom Fields data
		foreach($answers as $answer) {
			// Check if field exists
			$field = $this->user_model->get_user_cf($answer['fieldid'], $this->user->info->ID);
			if($field->num_rows() == 0) {
				$this->user_model->add_custom_field(array(
					"userid" => $this->user->info->ID,
					"fieldid" => $answer['fieldid'],
					"value" => $answer['answer']
					)
				);
			} else {
				$this->user_model->update_custom_field($answer['fieldid'], 
					$this->user->info->ID, $answer['answer']);
			}
		}

		

		$this->session->set_flashdata("globalmsg", lang("success_22"));
		redirect(site_url("user_settings"));
	}


	public function change_password() 
	{
		$this->template->loadContent("user_settings/change_password.php", array(
			)
		);
	}

	public function change_password_pro() 
	{
		$current_password = 
			$this->common->nohtml($this->input->post("current_password"));
		$new_pass1 = $this->common->nohtml($this->input->post("new_pass1"));
		$new_pass2 = $this->common->nohtml($this->input->post("new_pass2"));

		if(empty($new_pass1)) $this->template->error(lang("error_45"));
		if($new_pass1 != $new_pass2) $this->template->error(lang("error_22"));

		$cp = $this->user->getPassword();

		if(!empty($cp)) {
			$phpass = new PasswordHash(12, false);
	    	if (!$phpass->CheckPassword($current_password, $cp)) {
	    		$this->template->error(lang("error_59"));
	    	}
	    }

    	$pass = $this->common->encrypt($new_pass1);
    	$this->user_model->update_user($this->user->info->ID, 
    		array("password" => $pass));

    	$this->session->set_flashdata("globalmsg", lang("success_23"));
    	redirect(site_url("user_settings/change_password"));
	}


	public function social_networks() 
	{
		$user_data = $this->user_model->get_user_data($this->user->info->ID);
		if($user_data->num_rows() == 0) {
			$this->user_model->add_user_data(array(
				"userid" => $this->user->info->ID
				)
			);
			$user_data = $this->user_model->get_user_data($this->user->info->ID);
		}
		$user_data = $user_data->row();
		$this->template->loadContent("user_settings/social_networks.php", array(
			"user_data" => $user_data
			)
		);
	}

	public function social_networks_pro() 
	{
		$twitter = $this->common->nohtml($this->input->post("twitter"));
		$google = $this->common->nohtml($this->input->post("google"));
		$facebook = $this->common->nohtml($this->input->post("facebook"));
		$linkedin = $this->common->nohtml($this->input->post("linkedin"));
		$website = $this->common->nohtml($this->input->post("website"));

		$user_data = $this->user_model->get_user_data($this->user->info->ID);
		if($user_data->num_rows() == 0) {
			$this->user_model->add_user_data(array(
				"userid" => $this->user->info->ID
				)
			);
			$user_data = $this->user_model->get_user_data($this->user->info->ID);
		}
		$user_data = $user_data->row();

		$this->user_model->update_user_data($user_data->ID, array(
			"twitter" => $twitter,
			"facebook" => $facebook,
			"google" => $google,
			"linkedin" => $linkedin,
			"website" => $website
			)
		);

		$this->session->set_flashdata("globalmsg", lang("success_47"));
		redirect(site_url("user_settings/social_networks"));
	}


	public function friend_requests() 
	{
		$requests = $this->user_model->get_friend_requests($this->user->info->ID);
		$this->template->loadContent("user_settings/requests.php", array(
			"requests" => $requests
			)
		);
	}

	public function friend_request($type, $id, $hash) 
	{
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$type = intval($type);
		$id = intval($id);
		$request = $this->user_model->get_friend_request($id, $this->user->info->ID);
		if($request->num_rows() == 0) {
			$this->template->error(lang("error_147"));
		}
		$request = $request->row();

		if($type == 0) {
			// Reject
			$this->user_model->delete_friend_request($id);
			// Notification
			$this->user_model->increment_field($request->userid, "noti_count", 1);
			$this->user_model->add_notification(array(
				"userid" => $request->userid,
				"url" => "home/index",
				"timestamp" => time(),
				"message" => $this->user->info->first_name . " " . $this->user->info->last_name . " " . lang("ctn_663"),
				"status" => 0,
				"fromid" => $this->user->info->ID,
				"username" => $request->username,
				"email" => $request->email,
				"email_notification" => $request->email_notification
				)
			);
			$this->session->set_flashdata("globalmsg", lang("success_82"));
		} elseif($type == 1) {
			// Accept
			$this->user_model->delete_friend_request($id);
			// Notification
			$this->user_model->increment_field($request->userid, "noti_count", 1);
			$this->user_model->add_notification(array(
				"userid" => $request->userid,
				"url" => "home/index",
				"timestamp" => time(),
				"message" => $this->user->info->first_name . " " . $this->user->info->last_name . " " . lang("ctn_664"),
				"status" => 0,
				"fromid" => $this->user->info->ID,
				"username" => $request->username,
				"email" => $request->email,
				"email_notification" => $request->email_notification
				)
			);

			$this->user_model->add_friend(array(
				"userid" => $request->userid,
				"friendid" => $this->user->info->ID,
				"timestamp" => time()
				)
			);

			$this->user_model->add_friend(array(
				"friendid" => $request->userid,
				"userid" => $this->user->info->ID,
				"timestamp" => time()
				)
			);

			// Now update the user's serialized friends list so we can get
			// the wall posts of all friends
			$friends = unserialize($this->user->info->friends);

			$friends[] = $request->userid;

			$this->user_model->update_user($this->user->info->ID, array(
				"friends" => serialize($friends)
				)
			);

			// Update other user
			$user = $this->user_model->get_user_by_id($request->userid);
			if($user->num_rows() > 0) {
				$user = $user->row();
				$friends = unserialize($user->friends);

				$friends[] = $this->user->info->ID;

				$this->user_model->update_user($user->ID, array(
					"friends" => serialize($friends)
					)
				);
			}


			$this->session->set_flashdata("globalmsg", lang("success_83"));
		}

		redirect(site_url("user_settings/friend_requests"));
	}

	public function advert($id = NULL) 
	{
		$page_data['alluserplans'] = $this->user_model->get_user_plans($this->user->info->ID)->result();
		$page_data['all_countries'] = $this->home_model->get_country_for_admin_insert_adds();
		$this->template->loadContent("user_settings/adevert_settings.php", $page_data);
	}
	public function alladverts($id = NULL) 
	{
		if(empty($id)){
			$adverts = $this->page_model->get_rotaion_adverts($this->user->info->ID);
			$this->template->loadContent("user_settings/alladverts.php", array(
			"adverts" => $adverts
			)
		);
		}else{
			$get_rotationadd_by_id = $this->admin_model->get_rotation_addby_id($id);
			$this->template->loadContent("user_settings/viesingleadvert.php", array(
			"singleadvert" => $get_rotationadd_by_id
			)
		);
		}
		
	}

	public function get_plansby_id($id = NULL)
	{
		$get_plan_by_id = $this->admin_model->get_ads_plan($id)->row()->plan_name;

		echo '<div ><button onclick="buyplan('.$id.')" class="form-control btn btn-primary">Buy '.$get_plan_by_id.' Plan</button></div>';
	}

	public function get_plansby_id_for_random($id = NULL)
	{
		$get_plan_by_id = $this->admin_model->get_ads_plan($id)->row()->plan_name;

		echo '<div ><button onclick="buyplan_for_random('.$id.')" class="form-control btn btn-primary">Buy '.$get_plan_by_id.' Plan</button></div>';
	}

	public function get_plansby_id_for_insertadd($id = NULL)
	{
		$get_plan_by_id = $this->admin_model->get_ads_plan($id)->row();
		echo json_encode($get_plan_by_id);
	}

	public function buyplan($id = NULL)
	{
		 $no_of_credits = $this->admin_model->get_ads_plan($id)->row()->no_of_credits;
		 $no_of_ads = $this->admin_model->get_ads_plan($id)->row()->no_of_ads;
		 $country_id = $this->admin_model->get_ads_plan($id)->row()->country_id;
		 $state_id = $this->admin_model->get_ads_plan($id)->row()->state_id;
		 $city_id = $this->admin_model->get_ads_plan($id)->row()->city_id;
		 $checkplan = $this->admin_model->get_buyplanfor_check_plan($id)->row();
		 $userpoints =  $this->user->info->points;
		 $userid =  $this->user->info->ID;
		 if (!empty($checkplan)) {
		 	echo 1;
		 }else{
		 if ($userpoints < $no_of_credits) {
		 	echo 2;
		 }else{
		 	$remainingpoints = $userpoints - $no_of_credits; 
		 	$data['points'] = $remainingpoints;
		 	$this->db->where('ID', $userid);
		 	$this->db->update('users',$data);
		 	$buy['users_id'] = $userid;
		 	$buy['ads_plans_id'] = $id;
		 	$buy['total_no_of_ads'] = $no_of_ads;
		 	$buy['remaining_adds'] = $no_of_ads;

		 	if (!empty($country_id)) { 	
		 	$buy['countries_id'] = $country_id;
		 	$buy['states_id'] = $state_id;
		 	$buy['cities_id'] = $city_id;
		 	}
		 	if ($this->db->insert('buy_ads_plan',$buy)) {
		 		echo 3;
		 	}
		 }
		 }



	}

	public function addadvert()
	{
		$page_data['alluserplans'] = $this->user_model->get_user_plans_no_remaining($this->user->info->ID)->result();
		$this->template->loadContent("user_settings/addadvert.php" ,$page_data);
	}

	public function get_all_plans($cityid = "")
	{
		$get_allplans = $this->home_model->get_plans_insert_adds($cityid);
		if (!empty($get_allplans)) {
			foreach($get_allplans as $p)
		{
			echo '<div id="'.$p->id.'" onclick="addborder('.$p->id.')" class=" theme_box"><div style="font-size:22px;">'.$p->plan_name.'</div><div style="margin-top:50px;"> <b> No Of Ads :</b>'.$p->no_of_ads.'</div><div style="margin-top:10px;"> <b> Credits :</b>'.$p->no_of_credits.'</div></div>';
		}
		}else{
			$get_allplansfor_adver = $this->home_model->get_all_plans_for_advert();
			foreach($get_allplansfor_adver as $p)
		{
			echo '<div id="'.$p->id.'" onclick="addborder('.$p->id.')" class=" theme_box"><div style="font-size:22px;">'.$p->plan_name.'</div><div style="margin-top:50px;"> <b> No Of Ads :</b>'.$p->no_of_ads.'</div><div style="margin-top:10px;"> <b> Credits :</b>'.$p->no_of_credits.'</div></div>';
		}
		}
		
	}


	public function page_invites() 
	{
		$invites = $this->page_model->get_page_invites($this->user->info->ID);
		$this->template->loadContent("user_settings/invites.php", array(
			"invites" => $invites
			)
		);
	}

	public function delete_page_invite($id, $hash) 
	{
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$invite = $this->page_model->get_page_invite_id($id);
		if($invite->num_rows() == 0) {
			$this->template->error(lang("error_148"));
		}

		$invite = $invite->row();
		if($invite->userid != $this->user->info->ID) {
			$this->template->error(lang("error_149"));
		}

		$this->page_model->delete_page_invite($id);
		$this->session->set_flashdata("globalmsg", lang("success_84"));
		redirect(site_url("user_settings/page_invites"));

	}

	public function privacy() 
	{
		$this->template->loadContent("user_settings/privacy.php", array(
			)
		);
	}

	public function privacy_pro() 
	{
		$profile_view = intval($this->input->post("profile_view"));
		$posts_view = intval($this->input->post("posts_view"));
		$post_profile = intval($this->input->post("post_profile"));
		$allow_friends = intval($this->input->post("allow_friends"));
		$allow_pages = intval($this->input->post("allow_pages"));
		$chat_option = intval($this->input->post("chat_option"));
		$tag_user = intval($this->input->post("tag_user"));

		$this->user_model->update_user($this->user->info->ID, array(
			"profile_view" => $profile_view,
			"posts_view" => $posts_view,
			"post_profile" => $post_profile,
			"allow_friends" => $allow_friends,
			"allow_pages" => $allow_pages,
			"chat_option" => $chat_option,
			"tag_user" => $tag_user
		));

		$this->session->set_flashdata("globalmsg", lang("success_85"));
		redirect(site_url("user_settings/privacy"));
	}

	public function cancel_request($id, $hash) 
	{
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$request = $this->user_model->get_relationship_request_id($id);
		if($request->num_rows() == 0) {
			$this->template->error(lang("error_147"));
		}
		$request = $request->row();

		if($request->friendid != $this->user->info->ID) {
			$this->template->error(lang("error_150"));
		}

		$this->user_model->delete_relationship_request($id);
		$this->session->set_flashdata("globalmsg", lang("success_86"));
		redirect(site_url("user_settings"));
	}

	public function relationship_request($id, $type, $hash) 
	{
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$request = $this->user_model->get_relationship_request_id($id);
		if($request->num_rows() == 0) {
			$this->template->error(lang("error_147"));
		}
		$request = $request->row();

		if($request->userid != $this->user->info->ID) {
			$this->template->error(lang("error_151"));
		}

		if($type == 1) {
			// Accept
			$this->user_model->delete_relationship_request($id);

			$this->user_model->update_user($this->user->info->ID, array(
				"relationship_status" => $request->relationship_status,
				"relationship_userid" => $request->friendid
				)
			);

			$this->user_model->update_user($request->friendid, array(
				"relationship_status" => $request->relationship_status,
				"relationship_userid" => $this->user->info->ID
				)
			);
			$this->session->set_flashdata("globalmsg", lang("success_87"));
		} else {
			// Reject
			$this->user_model->delete_relationship_request($id);
			$this->session->set_flashdata("globalmsg", lang("success_88"));
		}

		redirect(site_url("user_settings"));
	}

	public function verified() 
	{
		if(!$this->settings->info->enable_verified_requests) {
			$this->template->error(lang("error_166"));
		}
		$this->template->loadContent("user_settings/verified.php", array(
			)
		);
	}

	public function verified_pro() 
	{
		if(!$this->settings->info->enable_verified_requests) {
			$this->template->error(lang("error_166"));
		}
		$us = $this->user_model->get_verified_request($this->user->info->ID);
		if($us->num_rows() > 0) {
			$this->template->error(lang("error_169"));
		}

		if($this->user->info->verified) {
			$this->template->error(lang("error_167"));
		}

		$about = $this->common->nohtml($this->input->post("about"));

		$this->user_model->add_verified_request(array(
			"userid" => $this->user->info->ID,
			"about" => $about,
			"timestamp" => time()
			)
		);
		$this->session->set_flashdata("globalmsg", lang("success_102"));
		redirect(site_url("user_settings/verified"));
	}

	public function deauth($hash) 
	{
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		// Check user has a pw
		if(empty($this->user->getPassword())) {
			$this->template->error(lang("error_192"));
		}
		$config = $this->config->item("cookieprefix");
		$this->load->helper("cookie");
		delete_cookie($config. "provider");
		delete_cookie($config. "oauthid");
		delete_cookie($config. "oauthtoken");
		delete_cookie($config. "oauthsecret");
		delete_cookie($config. "acc");

		$this->user_model->update_user($this->user->info->ID, array(
			"oauth_provider" => "",
			"oauth_id" => "",
			"oauth_token" => "",
			"oauth_secret" => "",
			)
		);

		$this->session->set_flashdata("globalmsg", lang("success_116"));
		redirect(site_url("user_settings/social_networks"));
	}

	public function profile_pic_upload() 
	{
		$userid = $this->user->info->ID;
		$uploadpath = $this->settings->info->upload_path;
		$thumbnail = $this->input->post("capturedpic");
		$fullpic = $this->input->post("fullpic");
		$profile_imageid = $this->input->post("profile_imageid");

		$avatar = md5(date('Ymdhis')).'.jpg';
		$newfile = $uploadpath.'/'.$avatar;
		copy($thumbnail, $newfile);

		if($profile_imageid=="")
		{
			$fullpicture = md5('n_'.date('Ymdhis')).'.jpg';
			$newfile = $uploadpath.'/'.$fullpicture;
			copy($fullpic, $newfile);
		}
		else
		{
			$row_img = $this->db->get_where('user_images',array('ID'=>$profile_imageid))->row_array();
			$fullpicture = $row_img['file_name'];
		}

		$this->user_model->update_user($this->user->info->ID, array(
			"avatar" => $avatar
			)
		);

		$this->load->model('image_model');
		$this->load->model('feed_model');

		// Check for default feed album
		$album = $this->image_model->get_user_profile_album($this->user->info->ID);
		if($album->num_rows() == 0) {
			// Create
			$albumid = $this->image_model->add_album(array(
				"userid" => $this->user->info->ID,
				"feed_album" => 2,
				"name" => lang("ctn_946"),
				"description" => lang("ctn_948"),
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
        	"timestamp" => time(),
        	"albumid" => $albumid
        	)
        );

        // Update album count
        $this->image_model->increase_album_count($albumid);


        $this->user_model->increase_posts($this->user->info->ID);
		$postid = $this->feed_model->add_post(array(
			"userid" => $this->user->info->ID,
			"timestamp" => time(),
			"imageid" => $fileid
			)
		);

		$this->user_model->update_user($this->user->info->ID, array(
			"profilepic_postid" => $postid
			)
		);
exit;
	}


	public function cover_pic_upload() 
	{
		$userid = $this->user->info->ID;
		$uploadpath = $this->settings->info->upload_path;
		$coverphoto = $this->input->post("coverphoto");

		$fullpicture = md5('n_'.date('Ymdhis')).'.jpg';
		$newfile = $uploadpath.'/'.$fullpicture;
		copy($coverphoto, $newfile);


		$this->user_model->update_user($this->user->info->ID, array(
			"profile_header" => $fullpicture
			)
		);

		$this->load->model('image_model');
		$this->load->model('feed_model');

		// Check for default feed album
		$album = $this->image_model->get_user_cover_album($this->user->info->ID);
		if($album->num_rows() == 0) {
			// Create
			$albumid = $this->image_model->add_album(array(
				"userid" => $this->user->info->ID,
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
        	"timestamp" => time(),
        	"albumid" => $albumid
        	)
        );
        // Update album count
        $this->image_model->increase_album_count($albumid);


        $this->user_model->increase_posts($this->user->info->ID);
		$postid = $this->feed_model->add_post(array(
			"userid" => $this->user->info->ID,
			"timestamp" => time(),
			"imageid" => $fileid
			)
		);

		$this->user_model->update_user($this->user->info->ID, array(
			"coverpic_postid" => $postid
			)
		);






		exit;
	}


	function about_form()
	{
		$userid = $this->user->info->ID;
		if($userid==0)
		{
			exit;
		}
		$row = $this->db->get_where('user_data',array('userid'=>$userid))->row_array();
		$user = $this->db->get_where('users',array('ID'=>$userid))->row();
		?>
		<form action="<?php echo site_url('user_settings/about_form_save'); ?>" method="post">
			<table class="table table-striped table-bordered" align="center" style="width: 90%;">
              <tr>
                <th style="width: 160px;">About Me</th>
                <td>
                	<textarea class="form-control" name="aboutme" id="aboutme" rows="3"><?php echo $user->aboutme; ?></textarea>
                </td>
              </tr>
              <tr>
                <th style="width: 160px;">Work</th>
                <td>
                	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                  <input type="text" class="form-control autocomplete" name="work" id="work" value="<?php echo $row['work']; ?>" data-template="work" data-uri="places/2/" />
                </td>
              </tr>
              <tr>
                <th>College/University</th>
                <td>
                  <input type="text" class="form-control autocomplete" name="college" id="college" data-template="school" data-uri="places/1/" value="<?php echo $row['college']; ?>" style="min-width: 450px;" />
                </td>
              </tr>
              <tr>
                <th>High School</th>
                <td>
                  <input type="text" class="form-control autocomplete" name="school" id="school" value="<?php echo $row['school']; ?>"  data-template="school" data-uri="places/1/" />
                </td>
              </tr>
              <tr>
                <th>Address</th>
                <td>
                  <input type="text" class="form-control" name="address" id="address" value="<?php echo $row['address']; ?>" />
                </td>
              </tr>
              <tr>
                <th>City</th>
                <td>
                  <input type="text" class="form-control autocomplete" name="city" id="city" value="<?php echo $user->city; ?>" data-template="city" data-uri="locations/" />
                </td>
              </tr>
              <tr>
                <th>State</th>
                <td>
                  <input type="text" class="form-control autocomplete" name="state" id="state" value="<?php echo $user->state; ?>" data-template="state" data-uri="states/" />
                </td>
              </tr>
              <tr>
                <th>Country</th>
                <td>
                  <input type="text" class="form-control autocomplete" name="country" id="country" value="<?php echo $user->country; ?>" data-template="country" data-uri="countries/" />
                </td>
              </tr>
              <tr>
                <th>Mobile</th>
                <td>
                  <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo $row['mobile']; ?>" />
                </td>
              </tr>
              <tr>
                <th>Website</th>
                <td>
                  <input type="text" class="form-control" name="website" id="website" value="<?php echo $row['website']; ?>" />
                </td>
              </tr>
              <tr>
                <th>Gender</th>
                <td>
                  <select class="form-control" name="gender" id="gender" style="max-width: 180px;">
                      <option value="Male" <?php if($row['gender']=="Married")echo "selected"; ?> >Male</option>
                      <option value="Female" <?php if($row['gender']=="Married")echo "selected"; ?> >Female</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th>Birthday</th>
                <td>
                  <input type="date" class="form-control" name="birthday" id="birthday" value="<?php echo $row['birthday']; ?>" style="max-width: 180px;" />
                </td>
              </tr>
              <tr>
                <th>Religion</th>
                <td>
                  <input type="text" class="form-control" name="religion" id="religion" value="<?php echo $row['religion']; ?>" />
                </td>
              </tr>
              <tr>
                <th>Relationship</th>
                <td>
                  <select class="form-control" name="maritalstatus" id="maritalstatus" style="max-width: 180px;">
                      <option value="Single" <?php if($row['maritalstatus']=="Single")echo "selected"; ?> >Single</option>
                      <option value="Married" <?php if($row['maritalstatus']=="Married")echo "selected"; ?> >Married</option>
                  </select>
                </td>
              </tr>
            </table>  
            <center><button type="submit" class="btn btn-sm btn-success">Save</button></center>
        </form>

		<?php
		exit;
	}

	function about_form_save()
	{
		$userid = $this->user->info->ID;
		if($userid>0)
		{
			$rows = $this->db->get_where('user_data',array('userid'=>$userid))->num_rows();

			$data['userid'] = $userid;
			$data['work'] = $this->input->post('work');
			$data['college'] = $this->input->post('college');
			$data['school'] = $this->input->post('school');
			$data['address'] = $this->input->post('address');
			$data['mobile'] = $this->input->post('mobile');
			$data['website'] = $this->input->post('website');
			$data['gender'] = $this->input->post('gender');
			$data['birthday'] = $this->input->post('birthday');
			$data['religion'] = $this->input->post('religion');
			$data['maritalstatus'] = $this->input->post('maritalstatus');
			if($rows>0)
			{
				$this->db->where('userid',$userid);
				$this->db->update('user_data',$data);
			}
			else
			{
				$this->db->insert('user_data',$data);
			}

			$data2['aboutme'] = $this->input->post('aboutme');
			$data2['address_1'] = $this->input->post('address');
			$data2['city'] = $this->input->post('city');
			$data2['state'] = $this->input->post('state');
			$data2['country'] = $this->input->post('country');
			$data2['gender'] = $this->input->post('gender');
			$data2['birthday'] = $this->input->post('birthday');
			$this->db->where('ID',$userid);
			$this->db->update('users',$data2);
		}
		
		$this->load->library('user_agent');
        return redirect($this->agent->referrer());
	}

	function loadpicturesforprofile()
	{
		$userid = $this->user->info->ID;
		$pics = $this->db->order_by("ID", "desc")->group_by('file_name')->get_where('user_images',array('userid'=>$userid))->result_array();
		foreach ($pics as $pic) {
		    ?>
		<div class="col-lg-3 col-sm-4 col-xs-6" style="height: 100px;  overflow: hidden; margin-bottom: 6px;"><img class="thumbnail img-responsive profilethumbnail" onclick="set_imageid(<?php echo $pic['ID']; ?>);" src="<?php echo base_url() ?>/<?php echo $this->settings->info->upload_path_relative ?>/<?php echo $pic['file_name']; ?>" style="width: 100%; height: 100px; object-fit: cover; cursor: pointer;" ></div>
		    <?php
		}
	}




	function report_abuse_form($postid)
	{
		$userid = $this->user->info->ID;
		if($userid==0)
		{
			//$this->template->error(lang("error_1"));
			echo lang("error_1");
			exit;
		}
		?>
		<form action="<?php echo site_url('user_settings/about_form_save'); ?>" method="post" style="padding-left: 20px;padding-right: 20px;">
			<h4 style="font-weight:bold;">Please select a reason to report</h4>
			<hr>
			<input type="hidden" name="report_abuse_postid" id="report_abuse_postid" value="<?php echo $postid; ?>" />
			<div class="form-group">
				<?php $k=0; foreach($this->db->get('report_abuse_reasons')->result() as $r): $k++; ?>
					<div>
						<input type="radio" name="report_abuse_reason" id="report_abuse_reason<?php echo $r->ID; ?>" value="<?php echo $r->reason; ?>" <?php //if($k==1)echo 'checked'; ?> onclick="$('.btn-report-abuse').removeAttr('disabled');" > <label for="report_abuse_reason<?php echo $r->ID; ?>"><?php echo $r->reason; ?></label>
					</div>
				<?php endforeach; ?>
			</div> 
			<hr/>
            <center><button type="button" class="btn btn-sm btn-post btn-report-abuse" disabled onclick="report_abuse_post(<?php echo $postid; ?>);">Report</button></center>
        </form>
		<?php
		exit;
	}

	function report_bug()
	{
		$userid = $this->user->info->ID;
		if($userid==0)
		{
			$this->template->error(lang("error_1"));
		}

		$this->template->loadContent("user_settings/report_bug.php", array(
			)
		);
	}

	function report_bug_pro()
	{
		$userid = $this->user->info->ID;
		if($userid==0)
		{
			$this->template->error(lang("error_1"));
		}
		$this->load->library("upload");
		$subject = $this->common->nohtml( $this->input->post('subject') );
		$description = $this->common->nohtml( $this->input->post('description') );
		$os = $this->common->nohtml( $this->input->post('os') );
		//$screenshort = $this->input->post('screenshort');

		if ($_FILES['screenshort']['size'] > 0) {
				$this->upload->initialize(array( 
			       "upload_path" => $this->settings->info->upload_path,
			       "overwrite" => FALSE,
			       "max_filename" => 300,
			       "encrypt_name" => TRUE,
			       "remove_spaces" => TRUE,
			       "allowed_types" => "gif|png|jpg|jpeg",
			       "max_size" => $this->settings->info->file_size
			    ));
			    if (!$this->upload->do_upload("screenshort")) {
			    	$this->template->error(lang("error_21")
			    	.$this->upload->display_errors());
			    }
			    $data = $this->upload->data();
			    $screenshort = $data['file_name'];
			}
			else
			{
				$screenshort = '';
			}

		$formdata = array();
		$formdata['subject'] = $subject;
		$formdata['description'] = $description;
		$formdata['os'] = $os;
		$formdata['screenshort'] = $screenshort;
		$formdata['timestamp'] = strtotime(date('Y-m-d H:i:s'));
		$formdata['fromid'] = $userid;

		$this->db->insert('bug_report', $formdata );

		$this->session->set_flashdata("globalmsg", lang("success_118"));
		$this->load->library('user_agent');
        return redirect($this->agent->referrer());
	}
    //contact us
	public function contact_us($param1="")
	{
		# code...

		$userid = $this->user->info->ID;
		if($userid==0)
		{
			$this->template->error(lang("error_1"));
		}
		if($param1=='save')
		{
			$title = $this->common->nohtml( $this->input->post('title') );
			$description = $this->common->nohtml( $this->input->post('description') );
			
	        $formdata = array();
			$formdata['title'] = $title;
			$formdata['description'] = $description;
			$formdata['userid'] = $userid;
			$this->db->insert('contact_us', $formdata );

			$this->session->set_flashdata("globalmsg", lang("success_118"));
			$this->load->library('user_agent');
	        return redirect($this->agent->referrer());
	    }
       // return redirect('User_Settings/contact_us');
	   
		$this->template->loadContent("user_settings/contact_us.php", array());
	}

}

?>