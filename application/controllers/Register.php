<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("register_model");
		$this->load->model("user_model");
		$this->load->model("home_model");
	}

	public function index($invite_code="")
	{

		if ($this->user_model->check_block_ip()) {
			$this->template->error(lang("error_26"));
		}

		$this->template->set_error_view("error/login_error.php");
		$this->template->set_layout("layout/login_layout.php");

		if(empty($invite_code)) {
			$invite_code = $this->input->post("code", true);
		}

		if(!empty($invite_code)) {
			$code = $this->register_model->get_invite_code($invite_code);
			if($code->num_rows() > 0) {
				$code = $code->row();
				if( ($code->status == 2 && $code->expire_upon_use) || $code->status == 3) {
					$this->template->error(lang("error_188"));
				}
			}

			if ($this->settings->info->register && !$code->bypass_register) {
				$this->template->error(lang("error_54"));
			}
		} else {
			if ($this->settings->info->register) {
				$this->template->error(lang("error_54"));
			}
		}

		$this->template->loadExternal(
			'<script src="https://www.google.com/recaptcha/api.js"></script>
			<script type="text/javascript" src="'
			.base_url().'scripts/custom/check_username.js" /></script>'
		);

		$fields = $this->user_model->get_custom_fields(array("register"=>1));

		if ($this->user->loggedin) {
			$this->template->error(
				lang("error_27")
			);
		}
		$this->load->helper('email');

		$email = "";
		$name = "";
		$username = "";
		$fail = "";
		$first_name = "";
		$last_name = "";

		if (isset($_POST['username'])) 
		{
			$email = $this->input->post("email", true);
			$first_name = $this->common->nohtml(
				$this->input->post("first_name", true));
			$last_name = $this->common->nohtml(
				$this->input->post("last_name", true));
			$pass = $this->common->nohtml(
				$this->input->post("password", true));
			$pass2 = $this->common->nohtml(
				$this->input->post("password2", true));
			$captcha = $this->input->post("captcha", true);
			$username = $this->common->nohtml(
				$this->input->post("username", true));

			$gender = $this->common->nohtml( $this->input->post('gender') );

			$dob_day = $this->input->post('dob_day');
			$dob_month = $this->input->post('dob_month');
			$dob_year = $this->input->post('dob_year');
			$country_id  = $this->input->post('countries');
			$country = $this->db->get_where('countries',array('id'=>$country_id))->row()->name;
			$city_id     = $this->input->post('cities');

			$birthday = date('Y-m-d',strtotime($dob_year.'-'.$dob_month.'-'.$dob_day));

			$allow_newsletter = intval($this->input->post('allow_newsletter'));



			if (strlen($username) < 3) $fail = "error_31";

			if (!preg_match("/^[a-z0-9_]+$/i", $username)) {
				$fail = lang("error_15");
			}

			if (!$this->register_model->check_username_is_free($username)) {
				$fail = lang("error_16");
			}

			if($this->settings->info->google_recaptcha) {
				require(APPPATH . 'third_party/autoload.php');
				$recaptcha = new \ReCaptcha\ReCaptcha(
					$this->settings->info->google_recaptcha_secret);
				$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
				if ($resp->isSuccess()) {
				    // verified!
				} else {
				    $errors = $resp->getErrorCodes();
				    $fail = lang("error_55");
				}
			}

			if (!$this->settings->info->disable_captcha) {
				if ($captcha != $_SESSION['sc']) {
					$fail = lang("error_55");
				}
			}
			if ($pass != $pass2) $fail = lang("error_22");

			if (strlen($pass) <= 5) {
				$fail = lang("error_17");
			}

			if (strlen($first_name) > 25) {
				$fail = lang("error_56");
			}
			if (strlen($last_name) > 30) {
				$fail = lang("error_57");
			}

			if (empty($first_name) || empty($last_name)) {
				$fail = lang("error_58");
			}

			if (empty($email)) {
				$fail = lang("error_18");
			}

			if($this->session->userdata("mobile_otp")){
				if ($email != '/^[0-9,]+$/') {
					$field_errors['email'] = lang("error_193");
				}
			}else{
				if (!valid_email($email)) {
					$field_errors['email'] = lang("error_193");
				}
			}

			

			if (!$this->register_model->checkEmailIsFree($email)) {
				$fail = lang("error_20");
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
						$fail = lang("error_78") . $r->name;
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
						$fail = lang("error_78") . $r->name;
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
						$fail = lang("error_78") . $r->name;
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
							$fail = lang("error_78") . $r->name;
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
						$fail = lang("error_78") . $r->name;
					}
					if($flag) {
						$answers[] = array(
							"fieldid" => $r->ID,
							"answer" => $answer
						);
					}
				}
			}

			if (empty($fail)) {



				$pass = $this->common->encrypt($pass);
				$active = 1;
				$activate_code = "";
				$success =  lang("success_20");
				if($this->settings->info->activate_account) {
					if($this->session->userdata("mobile_otp")){
						$active = 0;
						$success =  lang("success_117");
						mobile_otp($email);
					}else{
						$active = 0;
						$activate_code = md5(rand(1,10000000000) . "fhsf" . rand(1,100000));
						$success = lang("success_33");

						if(!isset($_COOKIE['language'])) {
							// Get first language in list as default
							$lang = $this->config->item("language");
						} else {
							$lang = $this->common->nohtml($_COOKIE["language"]);
						}

						// Send Email
						$email_template = $this->home_model
							->get_email_template_hook("email_activation", $lang);
						if($email_template->num_rows() == 0) {
							$this->template->error(lang("error_48"));
						}
						$email_template = $email_template->row();

						$email_template->message = $this->common->replace_keywords(array(
							"[NAME]" => $username,
							"[SITE_URL]" => site_url(),
							"[EMAIL_LINK]" => 
								site_url("register/activate_account/" . $activate_code . 
									"/" . $username),
							"[SITE_NAME]" =>  $this->settings->info->site_name
							),
						$email_template->message);

						$this->common->send_email($email_template->title, 
							$email_template->message, $email);
					}
					
				}

    			$new_arr[]= unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
	 			$ipcity = $new_arr[0]['geoplugin_city'];
	 			$ipstate = $new_arr[0]['geoplugin_region'];
				$ipcountry = $new_arr[0]['geoplugin_countryName'];


				$userid = $this->register_model->add_user(array(
					"username" => $username,
					"email" => $email,
					"first_name" => $first_name,
					"last_name" => $last_name,
					"password" => $pass,
					"user_role" => $this->settings->info->default_user_role,
					"IP" => $_SERVER['REMOTE_ADDR'],
					"joined" => time(),
					"joined_date" => date("n-Y"),
					"active" => $active,
					"activate_code" => $activate_code,
					"gender" => $gender,
					"ipcity" => $ipcity,
					"ipstate" => $ipstate,
					"ipcountry" => $ipcountry,
					"birthday" => $birthday,
					"allow_newsletter" => $allow_newsletter,
					"city"       => $city_id,
					"country"    => $country,
					"country_id" => $country_id
					)
				);

				$this->user_model->add_user_data(array(
					'userid' => $userid,
					'gender' => $gender,
					'birthday' => $birthday
					)
				);

				if(!empty($invite_code)) {

					if($code->expire_upon_use) {
						$status = 2;
					} else {
						$status = 1;
					}

					$this->register_model->update_invite($code->ID, array(
						"status" => $status,
						"user_registered" => $userid
						)
					);
				}

				// Check for any default user groups
				$default_groups = $this->user_model->get_default_groups();
				foreach($default_groups->result() as $r) {
					$this->user_model->add_user_to_group($userid, $r->ID);
				}

				// Add Custom Fields data
				foreach($answers as $answer) {
					$this->user_model->add_custom_field(array(
						"userid" => $userid,
						"fieldid" => $answer['fieldid'],
						"value" => $answer['answer']
						)
					);
				}
				$this->session->set_flashdata("globalmsg", $success);
				if($this->session->userdata("mobile_otp")){
					redirect(site_url("register/mobile_registration"));
				}else{
					redirect(site_url("login"));
				}
			}

		}


		$this->load->helper("captcha");
		$rand = rand(4000,100000);
		$_SESSION['sc'] = $rand;
		$vals = array(
		    'word' => $rand,
		    'img_path' => './images/captcha/',
    		'img_url' => base_url() . 'images/captcha/',
		    'img_width' => 150,
		    'img_height' => 30,
		    'expiration' => 7200
		    );

		$cap = create_captcha($vals);
		$this->template->loadContent("register/index.php", array(
			"cap" => $cap,
			"email" => $email,
			"first_name" => $first_name,
			"last_name" => $last_name,
		    'fail' => $fail,
		    "username" => $username,
		    "fields" => $fields,
		    "code" => $invite_code
		    )
		);
	}
 
	public function ajax_check_register() 
	{
		$formData = $this->input->post("formData");
		parse_str($formData, $data);

		if ($this->user_model->check_block_ip()) {
			$this->template->jsonError(lang("error_26"));
		}

		$invite_code = $data['code'];

		if(!empty($invite_code)) {
			$code = $this->register_model->get_invite_code($invite_code);
			if($code->num_rows() > 0) {
				$code = $code->row();
				if( ($code->status == 2 && $code->expire_upon_use) || $code->status == 3) {
					$this->template->jsonError(lang("ctn_188"));
				}
			}

			if ($this->settings->info->register && !$code->bypass_register) {
				$this->template->jsonError(lang("error_54"));
			}
		} else {
			if ($this->settings->info->register) {
				$this->template->jsonError(lang("error_54"));
			}
		}

		$fields = $this->user_model->get_custom_fields(array("register"=>1));

		if ($this->user->loggedin) {
			$this->template->jsonError(
				lang("error_27")
			);
		}
		$this->load->helper('email');


		$email = $data['email'];
		$pass = $this->common->nohtml($data['password']);
		$pass2 = $this->common->nohtml($data['password2']);
		$captcha = "";
		if(isset($data['captcha'])) {
			$captcha = $data['captcha'];
		}
		$username = $this->common->nohtml($data['username']);
		$first_name = $this->common->nohtml($data['first_name']);
		$last_name = $this->common->nohtml($data['last_name']);
		$countries = $this->common->nohtml($data['countries']);
		$cities = $this->common->nohtml($data['cities']);

		
		if (strlen($username) < 3) {
			$field_errors['username'] = lang("error_31");
		}

		if (!preg_match("/^[a-z0-9_]+$/i", $username)) {
			$field_errors['username'] = lang("error_15");
		}

		if (!$this->register_model->check_username_is_free($username)) {
			$field_errors['username'] = lang("error_16");
		}			

		if (!$this->settings->info->disable_captcha) {
			if ($captcha != $_SESSION['sc']) {
				$field_errors['captcha'] = lang("error_55");
			}
		}

		if (strlen($first_name) > 25) {
			$field_errors['first_name'] = lang("error_56");
		}
		if (strlen($last_name) > 30) {
			$field_errors['last_name'] = lang("error_57");
		}
		
		if ($pass != $pass2) {
			$field_errors['password'] = lang("error_22");
			$field_errors['password2'] = "";
		}

		if (strlen($pass) <= 5) {
			$field_errors['password'] = lang("error_17");
			$field_errors['password2'] = "";
		}


		if (empty($email)) {
			$field_errors['email'] = lang("error_18");
		}

		if($this->session->userdata("mobile_otp")){

		}else{
			if (!valid_email($email)) {
				$field_errors['email'] = lang("error_193");
			}
		}

		if (!$this->register_model->checkEmailIsFree($email)) {
			$field_errors['email'] = lang("error_20");
		}

		if($data['allow_privacypolicy']==0)
		{
			$field_errors['acceptprivacypolicy'] = $data['allow_privacypolicy'].' - '.lang("ctn_980");
		}

		// Custom Fields
		// Process fields
		$answers = array();
		foreach($fields->result() as $r) {
			$answer = "";
			if($r->type == 0) {
				// Look for simple text entry
				$answer = "";
				if(isset($data["cf_" . $r->ID])) {
					$answer = $this->common->nohtml($data["cf_" . $r->ID]);
				}

				if($r->required && empty($answer)) {
					$field_errors['cf_' . $r->ID] = lang("error_78") . $r->name;
				}
				// Add
				$answers[] = array(
					"fieldid" => $r->ID,
					" " => $answer
				);
			} elseif($r->type == 1) {
				// HTML
				$answer = "";
				if(isset($data["cf_" . $r->ID])) {
					$answer = $this->common->nohtml($data["cf_" . $r->ID]);
				}
				

				if($r->required && empty($answer)) {
					$field_errors['cf_' . $r->ID] = lang("error_78") . $r->name;
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
					$ans = "";
					if(isset($data["cf_cb_" . $r->ID . "_" . $k])) {
						$ans = $this->common->nohtml($data["cf_cb_" . $r->ID . "_" . $k]);
					}
					
					if($ans) {
						if(empty($answer)) {
							$answer .= $v;
						} else {
							$answer .= ", " . $v;
						}
					}
				}

				if($r->required && empty($answer)) {
					$field_errors['cf_' . $r->ID] = lang("error_78") . $r->name;
				}
				$answers[] = array(
					"fieldid" => $r->ID,
					"answer" => $answer
				);

			} elseif($r->type == 3) {
				// radio
				$options = explode(",", $r->options);
				if(isset($_data['cf_radio_' . $r->ID])) {
					$answer = intval($this->common->nohtml($data["cf_radio_" . $r->ID]));
					
					$flag = false;
					foreach($options as $k=>$v) {
						if($k == $answer) {
							$flag = true;
							$answer = $v;
						}
					}
					if($r->required && !$flag) {
						$field_errors['cf_radio_' . $r->ID] = lang("error_78") . $r->name;
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
				$answer = "";
				if(isset($data["cf_" . $r->ID])) {
					$answer = intval($this->common->nohtml($data["cf_" . $r->ID]));
				}
				
				$flag = false;
				foreach($options as $k=>$v) {
					if($k == $answer) {
						$flag = true;
						$answer = $v;
					}
				}
				if($r->required && !$flag) {
					$field_errors['cf_' . $r->ID] = lang("error_78") . $r->name;
				}
				if($flag) {
					$answers[] = array(
						"fieldid" => $r->ID,
						"answer" => $answer
					);
				}
			}
		}



		if(empty($field_errors)) {
			echo json_encode(array("success" => 1));
		} else {
			echo json_encode(array("field_errors" => 1,"fieldErrors" => $field_errors));
		}
		exit();
	}

	public function add_username() 
	{
		$this->template->loadExternal(
			'<script type="text/javascript" src="'
			.base_url().'scripts/custom/check_username.js" /></script>'
		);
		if (!$this->user->loggedin) {
			$this->template->error(
				lang("error_1")
			);
		}
		$this->template->loadContent("register/add_username.php", array());
	}

	public function add_username_pro() 
	{
		$this->load->helper('email');
		$email = $this->input->post("email", true);
		$username = $this->common->nohtml(
				$this->input->post("username", true));
		if (strlen($username) < 3) $fail = lang("error_14");

		if (!preg_match("/^[a-z0-9_]+$/i", $username)) {
			$fail = lang("error_15");
		}

		if (!$this->register_model->check_username_is_free($username)) {
			$fail = lang("error_16");
		}
		if (empty($email)) {
			$fail = lang("error_18");
		}

		if (!valid_email($email)) {
			$fail = lang("error_19");
		}

		if (!$this->register_model->checkEmailIsFree($email)) {
			$fail = lang("error_20");
		}

		if(!empty($fail)) $this->template->error($fail);

		$this->register_model
			->update_username($this->user->info->ID, $username, $email);
		$this->session->set_flashdata("globalmsg",  lang("success_21"));
		redirect(site_url());
	}

	public function check_email() 
	{	
		$this->load->helper('email');
		$email = $this->input->get("email");
		$email_input = explode("@",$email);
		$field_errors = array();
		if(count($email_input) > 1){
			if (empty($email)) {
				$field_errors['email'] = lang("error_18");
			}

			if (!valid_email($email)) {
				$field_errors['email'] = lang("error_19");
			}

			if (!$this->register_model->checkEmailIsFree($email)) {
				$field_errors['email'] = lang("error_20");
			}

			if(empty($field_errors)) {
				echo json_encode(array("success" => 1));
			} else {
				echo json_encode(array("field_errors" => 1,"fieldErrors" => $field_errors));
			}
		}else{
			if (empty($email)) {
				$field_errors['email'] = lang("error_18");
			}
			if(empty($field_errors)) {
				$this->session->unset_userdata("mobile_otp");
	        	$otp = rand(100000,999999);
				$this->session->set_userdata("mobile_otp",$otp);
				$this->session->set_userdata("mobile_number",$email);
				$this->session->mark_as_temp('mobile_otp', 60);
				echo json_encode(array("success" => 1));
			} else {
				echo json_encode(array("field_errors" => 1,"fieldErrors" => $field_errors));
			}
		}

		exit();
	}


	public function check_username() 
	{
		$username = $this->common->nohtml($this->input->get("username", true));
		$field_errors = array();

		if (strlen($username) < 3) {
			$field_errors['username'] = lang("error_14");
		}

		if (!preg_match("/^[a-z0-9_]+$/i", $username)) {
			$field_errors['username'] = lang("error_15");
		}

		if (!$this->register_model->check_username_is_free($username)) {
			$field_errors['username'] = "$username " . lang("ctn_243");
		}

		
		if(empty($field_errors)) {
			echo json_encode(array("success" => 1));
		} else {
			echo json_encode(array("field_errors" => 1,"fieldErrors" => $field_errors));
		}

		exit();
	}

	public function activate_account($code, $username) 
	{
		$code = $this->common->nohtml($code);
		$username = $this->common->nohtml($username);
		$code = $this->user_model->get_verify_user($code, $username);
		if($code->num_rows() == 0) {
			$this->template->error(lang("error_69"));
		}
		$code = $code->row();
		if($code->active) {
			$this->template->error(lang("error_69"));
		}

		$this->user_model->update_user($code->ID, array(
			"active" => 1, 
			"activate_code" => "", 
			"redirect" => 1 
			)
		);

		$this->session->set_flashdata("globalmsg", 
			lang("success_34"));
		redirect(site_url("login"));
	}

	public function send_activation_code($userid, $email) 
	{
		$userid = intval($userid);
		$email = $this->common->nohtml(urldecode($email));

		// Check request
		$request = $this->user_model->get_user_event("email_activation_request");
		if($request->num_rows() > 0) {
			$request = $request->row();
			if($request->timestamp + (15*60) > time()) {
				$this->template->error(lang("error_70"));
			}
		}

		$this->user_model->add_user_event(array(
			"event" => "email_activation_request",
			"IP" => $_SERVER['REMOTE_ADDR'],
			"timestamp" => time()
			)
		);

		// Resend
		$user = $this->user_model->get_user_by_id($userid);
		if($user->num_rows() == 0) {
			$this->template->error(lang("error_71"));
		}
		$user = $user->row();
		if($user->email != $email) 
		{
			$this->template->error(lang("error_71"));
		}
		if($user->active) {
			$this->template->error(lang("error_71"));
		}
		// Send email
		$this->load->model("home_model");
		if(!isset($_COOKIE['language'])) {
			// Get first language in list as default
			$lang = $this->config->item("language");
		} else {
			$lang = $this->common->nohtml($_COOKIE["language"]);
		}

		// Send Email
		$email_template = $this->home_model
			->get_email_template_hook("email_activation", $lang);
		if($email_template->num_rows() == 0) {
			$this->template->error(lang("error_48"));
		}
		$email_template = $email_template->row();

		$email_template->message = $this->common->replace_keywords(array(
			"[NAME]" => $user->username,
			"[SITE_URL]" => site_url(),
			"[EMAIL_LINK]" => 
				site_url("register/activate_account/" . $user->activate_code . 
					"/" . $user->username),
			"[SITE_NAME]" =>  $this->settings->info->site_name
			),
		$email_template->message);

		$this->common->send_email($email_template->title,
			 $email_template->message, $user->email);
		$this->session->set_flashdata("globalmsg", 
			lang("success_35"));
		redirect(site_url("login"));
	}
	public function mobile_registration(){
		print_r($this->session->userdata("mobile_otp"));
		$this->template->set_page_title("Login");
		$this->template->set_error_view("error/login_error.php");
		$this->template->set_layout("layout/login_layout.php");
		if ($this->user_model->check_block_ip()) {
			$this->template->error(lang("error_26"));
		}
		if ($this->user->loggedin) {
			redirect(base_url());
		}
		$this->template->loadContent("register/mobile_registration.php", array());
	}

	public function otp_varification(){
		$mobile_otp = $this->session->userdata("mobile_otp");
		$otp = $this->input->get("otpnumber");
		if (!$otp){
			echo lang("error_194");
		}else{
			if($mobile_otp == $otp){
				$mobile_no = $this->session->userdata("mobile_number");
				$this->db->where("email",$mobile_no);
				$this->db->update("users",array('active'=>1));
				echo "success";
				$this->session->unset_userdata("mobile_otp");
			}else{
				echo lang("error_194");
			}
		}
	}
	public function resend_otp(){
		$mobile_no = $this->session->userdata("mobile_number");
		$this->session->unset_userdata("mobile_otp");
    	$otp = rand(100000,999999);
		$this->session->set_userdata("mobile_otp",$otp);
		mobile_otp($mobile_no);
	}
}

?>