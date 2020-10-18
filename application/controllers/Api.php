<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api_model');
        $this->load->helper('text');
        $this->load->model("register_model");
        $this->load->model("user_model");
        $this->load->model("home_model");
        $this->load->model("image_model");
        $this->load->model('feed_model');
    }

    public function login()
     {
            // Get the post data
            $username = $this->common->nohtml($this->input->post('username'));
            $password =  $this->common->nohtml($this->input->post('password'));
            $query = $this->api_model->login_api($username,$password);
            echo json_encode($query);
            exit;
            //exit;
     }
       public function reg()
    {
        $this->load->helper('email');
        $this->load->helper("captcha");
        if ($this->user_model->check_block_ip()) {
            $fail = lang("error_26");
            echo json_encode(array('Error',$fail));
            exit;
        }
         if(empty($invite_code)) {
            $invite_code = $this->input->post("code", true);
        }
         if(!empty($invite_code)) {
            $code = $this->register_model->get_invite_code($invite_code);
            if($code->num_rows() > 0) {
                $code = $code->row();
                if( ($code->status == 2 && $code->expire_upon_use) || $code->status == 3) {
                    $fail = lang("error_188");
                    echo json_encode(array('Error',$fail));
                    exit;
                }
            }
            if ($this->settings->info->register && !$code->bypass_register) {
                //$this->template->error(lang("error_54"));
                $fail = lang("error_54");
                echo json_encode(array('Error',$fail));
                exit;
            }
        } else {
            if ($this->settings->info->register) {
                //$this->template->error(lang("error_54"));
                $fail = lang("error_54");
                echo json_encode(array('Error',$fail));
                exit;
            }
        }
         $fields = $this->user_model->get_custom_fields(array("register"=>1));

        /*if ($this->user->loggedin) {
           // $this->template->error( lang("error_27") );
            $fail = lang("error_27");
            echo json_encode(array('Error',$fail));
            exit;
        }*/
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

            $birthday = date('Y-m-d',strtotime($dob_year.'-'.$dob_month.'-'.$dob_day));

            $allow_newsletter = intval($this->input->post('allow_newsletter'));



            if (strlen($username) < 3) 
            {
                $fail = "error_31";
                echo json_encode(array('Error',$fail));
                exit;
            }

            if (!preg_match("/^[a-z0-9_]+$/i", $username)) {
                $fail = lang("error_15");
                echo json_encode(array('Error',$fail));
                exit;
            }

            if (!$this->register_model->check_username_is_free($username)) {
                $fail = lang("error_16");
                echo json_encode(array('Error',$fail));
                exit;
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
                    echo json_encode(array('Error',$fail));
                    exit;
                }
            }
            if (!$this->settings->info->disable_captcha) {
                if ($captcha != $_SESSION['sc']) {
                    $fail = lang("error_55");
                    echo json_encode(array('Error',$fail));
                    exit;
                }
            }

            if (strlen($pass) <= 5) {
                $fail = lang("error_17");
                echo json_encode(array('Error',$fail));
                exit;
            }

            if (strlen($first_name) > 25) {
                $fail = lang("error_56");
                echo json_encode(array('Error',$fail));
                exit;
            }
            if (strlen($last_name) > 30) {
                $fail = lang("error_57");
                echo json_encode(array('Error',$fail));
                exit;
            }

            if (empty($first_name) || empty($last_name)) {
                $fail = lang("error_58");
                echo json_encode(array('Error',$fail));
                exit;
            }

            if (empty($email)) {
                $fail = lang("error_18");
                echo json_encode(array('Error',$fail));
                exit;
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
                echo json_encode(array('Error',$fail));
                exit;
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
                        echo json_encode(array('Error',$fail));
                        exit;
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
                        echo json_encode(array('Error',$fail));
                        exit;
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
                        echo json_encode(array('Error',$fail));
                        exit;
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
                            echo json_encode(array('Error',$fail));
                            exit;
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
                        echo json_encode(array('Error',$fail));
                        exit;
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
                            //$this->template->error(lang("error_48"));
                            $fail = lang("error_48");
                            echo json_encode(array('Error',$fail));
                            exit;
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
                    "allow_newsletter" => $allow_newsletter
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
                    echo json_encode(array('success'=>'successfully Registerd.'));
                    exit;
                }else{
                    echo json_encode(array('success'=>'successfully Registerd.'));
                    exit;
                }
            }
         }
               echo json_encode(array('Error'=>'Some Problem in Registration!'));
               exit;
    }


    

    public function check_username() 
    {
        $username = $this->common->nohtml($this->input->get("username", true));
        $field_errors = array();
        if ($this->register_model->check_username_is_free($username) > 0) {
        if (strlen($username) < 3) {
            $field_errors['username'] = lang("error_14");

        }

        if (!preg_match("/^[a-z0-9_]+$/i", $username)) {
            $field_errors['username'] = lang("error_15");
        }

        if ($this->register_model->check_username_is_free($username)) {
            $field_errors['username'] = "$username " . lang("ctn_243");
        }

        
        if(empty($field_errors)) {
            echo json_encode(array("success" => 1));
        } 
        else 
        {
            echo json_encode(array("field_errors" => 1,"fieldErrors" => $field_errors));
        }

        exit();
     }
    else
     {
     echo json_encode(array('Error'=>'Access Name is not valid!'));
    }

    }

    function getuser()
    {
        $id = $this->input->post('id');
        $token = $this->input->post('token');
        if($this->api_model->checktoken($token)>0)
        {
            $users = $this->user_model->get_user_by_id($id)->row();
            echo json_encode($users);
        }
        else
        {
            echo json_encode(array('Error'=>'Access token is not valid!'));
        }
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

            if (!$this->api_model->checkEmailIsFree($email)) {
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
   
    public function change_password() 
    {
       // $this->load->helper('email');
         
        $username = $this->input->get("username", true);
        $current_password =  $this->common->nohtml($this->input->get("current_password"));
        $new_pass1 = $this->common->nohtml($this->input->get("new_password"));
        $new_pass2 = $this->common->nohtml($this->input->get("confirm_password"));
        $user = $this->api_model->login_api($username,$current_password);
        if(isset($user['ID']))
        {
            $id = $user['ID'];
            $message['msg'] = 'ok';
            if($new_pass1!='')
            {
                if($new_pass1!=$new_pass2)
                {
                    $message['msg'] = 'New password and confirm must be equal';
                }
                 else
                 {
                     //change password working will be here
                    $message['msg'] = 'password change successfully';
                 }
            }
            else
            {
                $message['msg'] = 'New password is empty';
            }
        }
            else
        {
            $message['msg'] = 'error';
        }
        echo json_encode($message);
       }

   
    public function privacy_pro() 

    {   
        $userid = $this->input->get("userid");
        $username = $this->common->nohtml($this->input->post('username'));
        $profile_view =   intval($this->input->post("profile_view"));
        $posts_view   =   intval($this->input->post("posts_view"));
        $post_profile =   intval($this->input->post("post_profile"));
        $allow_friends=   intval($this->input->post("allow_friends"));
        $allow_pages  =   intval($this->input->post("allow_pages"));
        $chat_option  =   intval($this->input->post("chat_option"));
        $tag_user     =   intval($this->input->post("tag_user"));

       // $user = $this->api_model->get_user_data($data);
       // print_r($user);
        $data = $this->user_model->update_user($this->user->info->ID, array(
            "profile_view"  => $profile_view,
            "posts_view"    => $posts_view,
            "post_profile"  => $post_profile,
            "allow_friends" => $allow_friends,
            "allow_pages"   => $allow_pages,
            "chat_option"   => $chat_option,
            "tag_user"      => $tag_user ));
     //$user= $this->api_model->get_user($username);
      //  print_r($user);
    if($this->api_model->get_users_data($data) > 0){
       // echo json_encode("ok");

    if(!$data){
    echo json_encode("privacy change successfully");
    }
    else
    {
    echo json_encode("Error occurred");
    }
    }
    else
    {
    echo json_encode("Error");
    }

 
 }
     public function social_networks() 
    {   $userid = $this->input->get("userid");
        $username = $this->common->nohtml($this->input->post('username'));
        $twitter  = $this->common->nohtml($this->input->post("twitter"));
        $google   = $this->common->nohtml($this->input->post("google"));
        $facebook = $this->common->nohtml($this->input->post("facebook"));
        $linkedin = $this->common->nohtml($this->input->post("linkedin"));
        $website  = $this->common->nohtml($this->input->post("website"));

        $user_data = $this->user_model->get_user_data($this->user->info->ID);
       
        if($user_data->num_rows() == 0) {
            $this->user_model->add_user_data(array(
                "userid" => $this->user->info->ID
                )
            );

        $user_data = $this->user_model->get_user_data($this->user->info->ID);
        }
        $user_data = $user_data->row();

        $network =  $this->user_model->update_user_data($user_data->ID, array(
            "twitter" => $twitter,
            "facebook" => $facebook,
            "google" => $google,
            "linkedin" => $linkedin,
            "website" => $website
            )
        );
        // if($nework ==""){
        //  $message['msg'] = 'privacy change successfully';
        // }
        // else
        // {
        // $message['msg'] = 'ok';
        // }

        // echo json_encode($message);
        // }

  }
  public function social_networks_pro() 
    {   
        $username = $this->common->nohtml($this->input->post('username'));
        $twitter = $this->common->nohtml($this->input->post("twitter"));
        $google = $this->common->nohtml($this->input->post("google"));
        $facebook = $this->common->nohtml($this->input->post("facebook"));
        $linkedin = $this->common->nohtml($this->input->post("linkedin"));
        $website = $this->common->nohtml($this->input->post("website"));
        $user_data = $this->api_model->get_user_data($this->user->info->ID);
        //print_r($user_data);
        if($user_data->num_rows() == 0)
        {
        $this->user_model->add_user_data(array(
                "userid" => $this->user->info->ID
                ));
        $user_data = $this->user_model->get_user_data($this->user->info->ID);
        }
        $user_data = $user_data->row();
       // print_r($user_data);
        if($user_data > 0 )
        {
        $message['msg'] = 'ok';
      
        }
       else
       {
         $message['msg'] = 'error';
       }
        echo json_encode($message);
        // $this->user_model->update_user_data($user_data->ID, array(
        //     "twitter" => $twitter,
        //     "facebook" => $facebook,
        //     "google" => $google,
        //     "linkedin" => $linkedin,
        //     "website" => $website
        //     )
        // );

      
}
}
?>