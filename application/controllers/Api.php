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

    function getuser()
    {
        $id = $this->input->post('id');
        $token = $this->input->post('token');
        if($this->api_model->checktoken($token) > 0)
        {
            $users = $this->user_model->get_user_by_id($id)->row();
            echo json_encode($users);
        }
        else
        {
            echo json_encode(array('Error'=>'Access token is not valid!'));
        }
    }
    public function change_password() 
    {
       // $this->load->helper('email');
         
        $username = $this->input->post("username", true);
        $current_password =  $this->common->nohtml($this->input->post("current_password"));
        $new_pass1 = $this->common->nohtml($this->input->post("new_password"));
        $new_pass2 = $this->common->nohtml($this->input->post("confirm_password"));
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

    public function add_post() 
    {   
        $id = $this->input->get('id');
        $token = $this->input->get('token');
        $userid   =  $this->input->get('userid');
        $username =  $this->input->get("username", true);
        $content  =  $this->common->nohtml($this->input->get( "content"));
        $image_url = $this->common->nohtml($this->input->get("image_url"));
        $youtube_url = $this->common->nohtml($this->input->get("youtube_url"));

        $targetid = intval($this->input->get("targetid"));
        $target_type = $this->common->nohtml($this->input->get("target_type"));
        $groupid = intval($this->input->get("groupid"));
        $postfor = intval($this->input->get("postfor"));
        $checkfeed = intval($this->input->get('checkfeed'));

        $storyfor = intval($this->input->get('storyfor'));
        $checkstory = intval($this->input->get('checkstory'));

        $extpostlink  = $this->input->get('ext-post-link');
        $extpostimage = $this->input->get('ext-post-image');
        $extposttitle = $this->input->get('ext-post-title');
        $extpostdesc  = $this->input->get('ext-post-desc');

      
        $with_users = ($this->input->get("with_users"));
        $post_as = $this->common->nohtml($this->input->get("post_as"));

        $members_only = intval($this->input->get("members_only"));


        $c = $this->common->get_user_tag_usernames($content);
        $content = $c['content'];
        $tagged_users = $c['users'];

        $location = $this->common->nohtml($this->input->get("location"));

        $question = $this->common->nohtml($this->input->get("poll_question"));
        $poll_type = intval($this->input->get("poll_type"));
      //exit;
        $users = array();
        $user_flag = 0;
        if(is_array($with_users)) {
        foreach($with_users as $username) {
         $username = $this->common->nohtml($username);
         $user = $this->api_model->get_user_by_username($username);
                
                if($user->num_rows() > 0) {
                    $user_flag = 1;
                    $user = $user->row();
                    $users[] = $user;
                }
            }
        }
         //$rw = $this->api_model->get_user_username($id,$username);
         //echo json_encode($rw);
         $r = $this->api_model->information($userid ,$username);
         //echo json_encode($r);
           if($checkfeed==1 && $checkstory==0)
        {
            $posttype = 'feed';
            $privacy = $postfor;
        }
        else if($checkfeed==0 && $checkstory==1)
        {
            $posttype = 'story';
            $privacy = 2;
        }
        else
        {
            $posttype = 'all';
            $privacy = $postfor;
        }

         //if values not empty
         if($r != $token)
         {

           //$userid = $r;
           echo "ok"; 
           $t= $this->api_model->checktoken($token);
           echo json_encode($t);
           if($this->api_model->checktoken($token) > 0)
            {
           // $users = $this->api_model->get_user_username($id,$username);
           // echo json_encode($users);
            if($this->api_model->get_user_username($id,$username) != "")
            {

           if($target_type == "page_profile") {
            // Validate page
            $page = $this->page_model->get_page($targetid);
         
            if($page->num_rows() == 0) {
            //$this->template->jsonError(lang("error_94"));
              $fail = lang("error_94");
              echo json_encode(array('Error',$fail));
            exit;
            }

        }

        $fileid = 0;
        if(!empty($image_url)) {

            // Check photo limit
            if($this->settings->info->limit_max_photos > 0) {
                $count = $this->image_model->get_total_user_images($this->user->info->ID);
                if($count >= $this->settings->info->limit_max_photos) {
                    //$this->template->error(lang("error_186"));
                      $fail = lang("error_186");
                      echo json_encode(array('Error',$fail));
                      exit;
                }
            }

            if($target_type == "page_profile") {
                // Check for default feed album
                $album = $this->image_model->get_page_feed_album($targetid);
                if($album->num_rows() == 0) {
                    // Create
                    $albumid = $this->image_model->add_album(array(
                        "pageid" => $targetid,
                        "feed_album" => 1,
                        "name" => lang("ctn_646"),
                        "description" => lang("ctn_647"),
                        "timestamp" => time()
                        )
                    );
                } else {
                    $album = $album->row();
                    $albumid = $album->ID;
                }
            } 
            else if($groupid>0)
            
            {
                $album = $this->image_model->get_group_feed_album($groupid);
                if($album->num_rows() == 0) {
                    // Create
                    $albumid = $this->image_model->add_album(array(
                        "groupid" => $groupid,
                        "feed_album" => 1,
                        "name" => lang("ctn_646"),
                        "description" => lang("ctn_647"),
                        "timestamp" => time()
                        )
                    );
                } else {
                    $album = $album->row();
                    $albumid = $album->ID;
                }
            }
             else
            {
                // Check for default feed album
                $album = $this->image_model->get_user_feed_album($this->user->info->ID);
                if($album->num_rows() == 0) {
                    // Create
                    $albumid = $this->image_model->add_album(array(
                        "userid" => $this->user->info->ID,
                        "feed_album" => 1,
                        "name" => lang("ctn_646"),
                        "description" => lang("ctn_648"),
                        "timestamp" => time(),
                        "groupid" => $groupid
                        )
                    );
                } else {
                    $album = $album->row();
                    $albumid = $album->ID;
                }
            }

             $fileid = $this->feed_model->add_image(array(
                "file_url" => $image_url,
                "userid" => $this->user->info->ID,
                "timestamp" => time(),
                "albumid" => $albumid,
                "privacy" => $privacy,
                "groupid" => $groupid
                )
            );
            // Update album count
            $this->image_model->increase_album_count($albumid);

        } elseif(isset($_FILES['image_file']['size']) && $_FILES['image_file']['size'] > 0) {
            if($this->settings->info->limit_max_photos > 0) {
                $count = $this->image_model->get_total_user_images($this->user->info->ID);
                if($count >= $this->settings->info->limit_max_photos) {
                    $this->template->error(lang("error_186"));
                }
            }
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

            if($target_type == "page_profile") {
                // Check for default feed album
                $album = $this->image_model->get_page_feed_album($targetid);
                if($album->num_rows() == 0) {
                    // Create
                    $albumid = $this->image_model->add_album(array(
                        "pageid" => $targetid,
                        "feed_album" => 1,
                        "name" => lang("ctn_646"),
                        "description" => lang("ctn_647"),
                        "timestamp" => time()
                        )
                    );
                } else {
                    $album = $album->row();
                    $albumid = $album->ID;
                }
            } else if($groupid > 0) {
                // Check for default feed album
                $album = $this->image_model->get_group_feed_album($groupid);
                if($album->num_rows() == 0) {
                    // Create
                    $albumid = $this->image_model->add_album(array(
                        "groupid" => $groupid,
                        "feed_album" => 1,
                        "name" => lang("ctn_646"),
                        "description" => lang("ctn_647"),
                        "timestamp" => time()
                        )
                    );
                } else {
                    $album = $album->row();
                    $albumid = $album->ID;
                }
            } else {
                // Check for default feed album
                $album = $this->image_model->get_user_feed_album($this->user->info->ID);
                if($album->num_rows() == 0) {
                    // Create
                    $albumid = $this->image_model->add_album(array(
                        "userid" => $this->user->info->ID,
                        "feed_album" => 1,
                        "name" => lang("ctn_646"),
                        "description" => lang("ctn_648"),
                        "timestamp" => time(),
                        "groupid" => $groupid
                        )
                    );
                } else {
                    $album = $album->row();
                    $albumid = $album->ID;
                }
            }


            $fileid = $this->feed_model->add_image(array(
                "file_name" => $data['file_name'],
                "file_type" => $data['file_type'],
                "extension" => $data['file_ext'],
                "file_size" => $data['file_size'],
                "userid" => $this->user->info->ID,
                "timestamp" => time(),
                "albumid" => $albumid,
                "privacy" => $privacy,
                "groupid" => $groupid
                )
            );
            // Update album count
            $this->image_model->increase_album_count($albumid);
        }

        // Video
        $videoid=0;
        if(!empty($youtube_url)) {
            $matches = array();
            preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $youtube_url, $matches);
            if(!isset($matches[0]) || empty($matches[0])) {
                //$this->template->jsonError(lang("error_96"));
                  $fail = lang("error_96");
                  echo json_encode(array('Error',$fail));
                  exit;
            }
            $youtube_id = $matches[0];
            // Add
            $videoid = $this->feed_model->add_video(array(
                "youtube_id" => $youtube_id,
                "userid" => $this->user->info->ID,
                "timestamp" => time()
                )
            );
        } elseif(isset($_FILES['video_file']['size']) && $_FILES['video_file']['size'] > 0) {
            $this->load->library("upload");
            // Upload image
            $this->upload->initialize(array(
               "upload_path" => $this->settings->info->upload_path,
               "overwrite" => FALSE,
               "max_filename" => 300,
               "encrypt_name" => TRUE,
               "remove_spaces" => TRUE,
               "allowed_types" => "avi|mp4|webm|ogv|ogg|3gp|flv",
               "max_size" => $this->settings->info->file_size,
                )
            );

            if ( ! $this->upload->do_upload('video_file'))
            {
                    $error = array('error' => $this->upload->display_errors());

                    $this->template->jsonError(lang("error_97") . "<br /><br />" .
                         $this->upload->display_errors() . "<br />" . mime_content_type($_FILES['video_file']['tmp_name']));
            }

            $data = $this->upload->data();

            $videoid = $this->feed_model->add_video(array(
                "file_name" => $data['file_name'],
                "file_type" => $data['file_type'],
                "extension" => $data['file_ext'],
                "file_size" => $data['file_size'],
                "userid" => $this->user->info->ID,
                "timestamp" => time()
                )
            );
        }


        if(empty($content) && $fileid == 0 && $videoid == 0 && empty($question)) {
            //$this->template->jsonError(lang("error_98"));
              $fail = lang("error_98");
              echo json_encode(array('Error',$fail));
              exit;
        }

        $site_flag = 0;
        $url_matches = array();
        preg_match_all('/[a-zA-Z]+:\/\/[0-9a-zA-Z;.\/\-?:@=_#&%~,+$]+/', 
            $content, $url_matches);

        if(isset($url_matches[0])) {
            $url_matches = $url_matches[0];
        }


        // Hashtags
        $hashtags = $this->common->get_hashtags($content);
        
        foreach($hashtags[0] as $r) {
            $r = trim($r);
            $tag = substr($r, 1, strlen($r));
            // Check it exists
            $tagi = $this->feed_model->get_hashtag($tag);
            if($tagi->num_rows() == 0) {
                $this->feed_model->add_hashtag(array(
                    "hashtag" => $tag,
                    "count" => 1
                    )
                );
            } else {
                $tagi = $tagi->row();
                $this->feed_model->increment_hashtag($tagi->ID);
            }
        }
        // Get urls in post
        $sites = array();
        foreach($url_matches as $k=>$v) {
            $s = $this->common->get_url_details($v);
            
            if(is_array($s)) {
                $sites[] = $s;
                $site_flag = 1;
            }
        }

        if($extpostlink!="")
        {
            $site_flag = 1;
        }

        // Set default postAs to user if empty
        if(empty($post_as)) {
            $post_as = "user";
        }

        if($target_type == "user_profile") {
            // Validate user
            $user = $this->user_model->get_user_by_id($targetid);
            if($user->num_rows() == 0) {
                //$this->template->jsonError(lang("error_85"));
                  $fail = lang("error_85");
              echo json_encode(array('Error',$fail));
            exit;
            }
            $user = $user->row();

            // Check the user's permissions
            $flags = $this->common->check_friend($this->user->info->ID, $user->ID);
            if( ($user->post_profile && ($this->user->info->ID == $user->ID 
                || $flags['friend_flag'])) || !$user->post_profile) {

            } else {
               // $this->template->jsonError(lang("error_99"));
                  $fail = lang("error_99");
                  echo json_encode(array('Error',$fail));
               exit;
            }

            
            $postid = $this->feed_model->add_post(array(
                "userid" => $targetid,
                "content" => $content,
                "timestamp" => time(),
                "imageid" => $fileid,
                "videoid" => $videoid,
                "location" => $location,
                "user_flag" => $user_flag,
                "profile_userid" => $this->user->info->ID,
                "site_flag" => $site_flag,
                "member_only" => $members_only,
                "postfor" => $postfor,
                "posttype" => $posttype,
                "storyfor" => $storyfor,
                "groupid" => $groupid
                )
            );
            $this->user_model->increase_posts($this->user->info->ID);
        } elseif($target_type == "page_profile") {
            // Validate page

            $page = $this->page_model->get_page($targetid);
            if($page->num_rows() == 0) {
               // $this->template->jsonError(lang("error_94"));
                  $fail = lang("error_94");
              echo json_encode(array('Error',$fail));
            exit;
            }

            $page = $page->row();

            // Get page member
            $member = $this->page_model->get_page_user($page->ID, $this->user->info->ID);

            if($member->num_rows() == 0) {
                $member = null;
            } else {
                $member = $member->row();
            }

            if(!$this->common->has_permissions(array("admin", "page_admin"), $this->user)) {
                if($post_as == "user") {
                    // fine
                    if($page->posting_status == 1 && $member == null) {
                       // $this->template->jsonError(lang("error_100"));
                          $fail = lang("error_100");
                          echo json_encode(array('Error',$fail));
                          exit;
                    } elseif($page->posting_status == 0 && ($member == null || !$member->roleid)) {
                       // $this->template->jsonError(lang("error_100"));
                          $fail = lang("error_100");
                          echo json_encode(array('Error',$fail));
                          exit;
                    }

              $u=  $this->user_model->increase_posts($this->user->info->ID);
              echo json_encode($u);
                } elseif($post_as == "page") {
                    // check they are admin of page
                    if(!isset($member->roleid)) {
                        $this->template->jsonError(lang("error_100"));
                          $fail = lang("error_94");
                          echo json_encode(array('Error',$fail));
                          exit;
                    } elseif($member->roleid != 1) {
                        //$this->template->jsonError(lang("error_100"));
                          $fail = lang("error_100");
                          echo json_encode(array('Error',$fail));
                          exit;
                    }
                    
                } else {
                   // $this->template->jsonError(lang("error_100"));
                      $fail = lang("error_100");
                      echo json_encode(array('Error',$fail));
                      exit;
                }
            }
            
            $postid = $this->feed_model->add_post(array(
                "userid" => $this->user->info->ID,
                "pageid" => $targetid,
                "content" => $content,
                "timestamp" => time(),
                "imageid" => $fileid,
                "videoid" => $videoid,
                "location" => $location,
                "user_flag" => $user_flag,
                "hide_profile" => 1, // stops it showing up in feed and profile page,
                "post_as" => $post_as,
                "site_flag" => $site_flag,
                "member_only" => $members_only,
                "postfor" => $postfor,
                "posttype" => $posttype,
                "storyfor" => $storyfor,
                "groupid" => $groupid
                )
            );

       } else {
          $v =   $this->api_model->get_users_data($id);
         // echo json_encode($v); 
            $this->user_model->increase_posts($this->user->info->ID);
            $postid = $this->feed_model->add_post(array(
                "userid" => $this->user->info->ID,
                "content" => $content,
                "timestamp" => time(),
                "imageid" => $fileid,
                "videoid" => $videoid,
                "location" => $location,
                "user_flag" => $user_flag,
                "site_flag" => $site_flag,
                "member_only" => $members_only,
                "postfor" => $postfor,
                "posttype" => $posttype,
                "storyfor" => $storyfor,
                "groupid" => $groupid
                )
            );
        }


        $this->feed_model->add_feed_subscriber(array(
            "postid" => $postid,
            "userid" => $this->user->info->ID
            )
        );

        if($extpostlink!="")
        {
            $this->feed_model->add_feed_site(array(
                "url" => $extpostlink,
                "title" => $extposttitle,
                "description" => $extpostdesc,
                "image" => $extpostimage,
                "postid" => $postid
                )
            );
        }

        /*foreach($sites as $site) 
        {
            $this->feed_model->add_feed_site(array(
                "url" => $site['url'],
                "title" => $site['title'],
                "description" => $site['description'],
                "image" => $site['image'],
                "postid" => $postid
                )
            );
        }*/

        foreach($tagged_users as $user) {
            // Notification
            $this->feed_model->add_tagged_user(array(
                "userid" => $user->ID,
                "postid" => $postid
                )
            );
            $this->user_model->increment_field($user->ID, "noti_count", 1);
            $this->user_model->add_notification(array(
                "userid" => $user->ID,
                "url" => "home/index/3?postid=" . $postid,
                "timestamp" => time(),
                "message" => $this->user->info->first_name . " " . $this->user->info->last_name . lang("ctn_649"),
                "status" => 0,
                "fromid" => $this->user->info->ID,
                "username" => $user->username,
                "email" => $user->email,
                "email_notification" => $user->email_notification
                )
            );

            $this->feed_model->add_feed_subscriber(array(
                "postid" => $postid,
                "userid" => $user->ID
                )
            );
        }

        foreach($users as $user) {
            $this->feed_model->add_feed_users(array(
                "userid" => $user->ID,
                "postid" => $postid
                )
            );

            // Check user is not already added to subscriber feed
            $sub = $this->feed_model->get_feed_subscriber($postid, $user->ID);
            if($sub->num_rows() == 0) {
                $this->feed_model->add_feed_subscriber(array(
                    "postid" => $postid,
                    "userid" => $user->ID
                    )
                );
            }

            // Notification
            $this->user_model->increment_field($user->ID, "noti_count", 1);
            $this->user_model->add_notification(array(
                "userid" => $user->ID,
                "url" => "home/index/3?postid=" . $postid,
                "timestamp" => time(),
                "message" => $this->user->info->first_name . " " . $this->user->info->last_name . " " . lang("ctn_650"),
                "status" => 0,
                "fromid" => $this->user->info->ID,
                "username" => $user->username,
                "email" => $user->email,
                "email_notification" => $user->email_notification
                )
            );
        }
       // Add Poll
       if(!empty($question)) {
            $poll_answers = intval($this->input->get("poll_answers"));

            $answers = array();
            for($i=0;$i<=$poll_answers;$i++) {
                if(isset($_POST['poll_answer_' . $i])) {
                    $answer = $this->common->nohtml($this->input->get("poll_answer_" . $i));
                    if(!empty($answer)) {
                        $answers[] = $answer;
                    }
                }
            }

            // Check answers are not empty
            if(count($answers) > 0) {
                // Add poll
                $pollid = $this->feed_model->add_feed_poll(array(
                    "postid" => $postid,
                    "question" => $question,
                    "type" => $poll_type,
                    )
                );

                foreach($answers as $answer) 
                {
                    $this->feed_model->add_feed_poll_answer(array(
                        "pollid" => $pollid,
                        "answer" => $answer
                        )
                    );
                }

                // Update post with pollid as ref
                $this->feed_model->update_post($postid, array(
                    "pollid" => $pollid
                    )
                );
            }
        }
       $this->session->set_flashdata("globalmsg", "Post posted!");
        // redirect(site_url());

        echo json_encode(array(
            "success" => 1
            )
        );
        exit();

        }
            else{
          echo "not okay";
          }
        }
        else
        {
            echo json_encode(array('Error'=>'Access token is not valid!'));
        }
        }
            else
            {
            echo json_encode(array('Error'=>'username not valid!'));            
        }    
    }
        
     public function delete_post() 
    {
        // $id = $this->input->get('id');
        $token = $this->input->get('token');
        $userid   =  $this->input->get('userid');
        $username =  $this->input->get("username", true);
       // $post = $this->feed_model->get_post($userid,$this->user->info->ID);

        $r = $this->api_model->information($userid ,$username);
       // $id = $this->uri->segment(3);
         if($r != $token)
         {
            echo "ok"; 
            $t = $this->api_model->checktoken($token);
            echo json_encode($t);
            if($this->api_model->checktoken($token) > 0)
            {
            $users = $this->api_model->get_user_username($id,$username);
           
             if($this->api_model->get_user_username($id,$username) != " ")
            {
                echo "user accessible";
                 $id = intval($id);
                 $i = $this->api_model->get_id($this->user->info->ID,$username);
                  //  echo json_encode($i);
                 $post = $this->feed_model->get_post($username, $this->user->info->ID);
                  // echo json_encode($post);
                 echo $this->user->info->ID;
                 echo $username;
                
                if($post->num_rows() == 0) {
                //$this->template->jsonError(lang("error_105"));
                     $fail = lang("error_105");
                     echo json_encode(array($fail));
                     exit;
            }
            $post = $post->row();

            if($post->pageid > 0 && $post->post_as == "page") {
            // Anyone who is admin of page can modify the post
            $member = $this->page_model->get_page_user($post->pageid, $this->user->info->ID);
            if($member->num_rows() == 0) {
                if(!$this->common->has_permissions(array("admin", "post_admin"), $this->user)) {
                   // $this->template->errori(lang("error_109"));
                     $fail = lang("error_109");
                     echo json_encode(array($fail));
                     exit;
                }
            } else {
                $member = $member->row();
                if($member->roleid != 1) {
                    if(!$this->common->has_permissions(array("admin", "post_admin"), $this->user)) {
                       // $this->template->errori(lang("error_109"));
                         $fail = lang("error_109");
                         echo json_encode(array($fail));
                         exit;
                    }
                }
            }

        } elseif($post->profile_userid > 0) {
            if($post->profile_userid != $this->user->info->ID) {
                if(!$this->common->has_permissions(array("admin", "post_admin"), $this->user)) {
                  //  $this->template->errori(lang("error_109"));
                     $fail = lang("error_109");
                     echo json_encode(array($fail));
                     exit;
                }
            }
            $this->user_model->decrease_posts($post->profile_userid);
        } else {
            if($post->userid != $this->user->info->ID) {
                if(!$this->common->has_permissions(array("admin", "post_admin"), $this->user)) {
                   // $this->template->errori(lang("error_109"));
                     $fail = lang("error_109");
                     echo json_encode(array($fail));
                     exit;
                }
            }

            $this->user_model->decrease_posts($post->userid);
        }
            $this->feed_model->delete_post($id);

            echo json_encode(array(
            "success" => 1
            )
        );
            exit();
            }
            else{
            echo "user not accessible";
            }

           }
           else{
           echo "token not valid";
          }
      }
          else{
          echo "username not found";
}
    }


public function edit_post(){
    // $id = $this->input->get('id');
        $token = $this->input->get('token');
        $userid   =  $this->input->get('userid');
        $username =  $this->input->get("username", true);
        $content  =  $this->common->nohtml($this->input->get( "content"));
        $image_url = $this->common->nohtml($this->input->get("image_url"));
        $youtube_url = $this->common->nohtml($this->input->get("youtube_url"));

        $targetid = intval($this->input->get("targetid"));
        $target_type = $this->common->nohtml($this->input->get("target_type"));
        $groupid = intval($this->input->get("groupid"));
        $postfor = intval($this->input->get("postfor"));
        $checkfeed = intval($this->input->get('checkfeed'));

        $storyfor = intval($this->input->get('storyfor'));
        $checkstory = intval($this->input->get('checkstory'));

        $extpostlink  = $this->input->get('ext-post-link');
        $extpostimage = $this->input->get('ext-post-image');
        $extposttitle = $this->input->get('ext-post-title');
        $extpostdesc  = $this->input->get('ext-post-desc');
        $with_users = ($this->input->get("with_users"));
        $post_as = $this->common->nohtml($this->input->get("post_as"));

        $members_only = intval($this->input->get("members_only"));
        $c = $this->common->get_user_tag_usernames($content);
        $content = $c['content'];
        $tagged_users = $c['users'];

        $location = $this->common->nohtml($this->input->get("location"));

        $question = $this->common->nohtml($this->input->get("poll_question"));
        $poll_type = intval($this->input->get("poll_type"));
       // $post = $this->feed_model->get_post($id,$this->user->info->ID);
      //exit;
        $users = array();
        $user_flag = 0;
        if(is_array($with_users)) {
        foreach($with_users as $username) {
         $username = $this->common->nohtml($username);
         $user = $this->api_model->get_user_by_username($username);
                
                if($user->num_rows() > 0) {
                    $user_flag = 1;
                    $user = $user->row();
                    $users[] = $user;
                }
            }
        }
           if($checkfeed==1 && $checkstory==0)
        {
            $posttype = 'feed';
            $privacy = $postfor;
        }
        else if($checkfeed==0 && $checkstory==1)
        {
            $posttype = 'story';
            $privacy = 2;
        }
        else
        {
            $posttype = 'all';
            $privacy = $postfor;
        }
         $r = $this->api_model->information($userid ,$username);
         //echo json_encode($r);
         if($r != $token)
         {
            //$userid = $r;
            echo "ok"; 
            $t= $this->api_model->checktoken($token);
            echo json_encode($t);
            if($this->api_model->checktoken($token) > 0)
            {
            $users = $this->api_model->get_user_username($userid,$username);
            // echo json_encode($users);
             if($this->api_model->get_user_username($userid,$username) != "")
            {
        echo "user accessible";
        $post = $this->api_model->get_id($this->user->info->ID,$username);
      //  echo json_encode($i);
       // $post = $this->feed_model->get_post($userid, $this->user->info->ID);
       // echo json_encode($post);
       // echo $this->user->info->ID;
       // echo $username;
        if($post->num_rows() != 0) {
          //  $this->template->jsonError(lang("error_105"));
                     $fail = lang("error_105");
                     echo json_encode(array($fail));
                     exit;
        }
        $post = $post->row();

        if($post->pageid > 0 && $post->post_as == "page") {
            // Anyone who is admin of page can modify the post
            $member = $this->page_model->get_page_user($post->pageid, $this->user->info->ID);
            if($member->num_rows() == 0) {
                if(!$this->common->has_permissions(array("admin", "post_admin"), $this->user)) {
                    //$this->template->errori(lang("error_109"));
                      $fail = lang("error_109");
                     echo json_encode(array($fail));
                     exit;
                }
            } else {
                $member = $member->row();
                if($member->roleid != 1) {
                    if(!$this->common->has_permissions(array("admin", "post_admin"), $this->user)) {
                      //  $this->template->errori(lang("error_109"));
                          $fail = lang("error_109");
                          echo json_encode(array($fail));
                          exit;
                    }
                }
            }

        } else {
            if($post->userid != $this->user->info->ID) {
                if(!$this->common->has_permissions(array("admin", "post_admin"), $this->user)) {
                   // $this->template->errori(lang("error_109"));
                      $fail = lang("error_109");
                     echo json_encode(array($fail));
                     exit;
                }
            }
        }

        $content = $this->common->nohtml($this->input->get("content"));
        $location = $this->common->nohtml($this->input->get("location"));
        $image_url = $this->common->nohtml($this->input->get("image_url"));
        $youtube_url = $this->common->nohtml($this->input->get("youtube_url"));
        $members_only = intval($this->input->get("members_only"));
        $with_users = ($this->input->get("with_users"));

        $question = $this->common->nohtml($this->input->get("poll_question"));
        $poll_type = intval($this->input->get("poll_type"));

        $postfor = intval($this->input->get("postfor"));
        $privacy = $postfor;


        $c = $this->common->get_user_tag_usernames($content);
        $content = $c['content'];
        $tagged_users = $c['users'];

        $users = array();
        $user_flag = 0;
        if(is_array($with_users)) {
            foreach($with_users as $username) {
                $username = $this->common->nohtml($username);
                $user = $this->user_model->get_user_by_username($username);
                if($user->num_rows() > 0) {
                    $user_flag = 1;
                    $user = $user->row();
                    $users[] = $user;
                }
            }
        }

        $fileid = $post->imageid;
        if(!empty($image_url)) {
             $fileid = $this->feed_model->add_image(array(
                "file_url" => $image_url,
                "userid" => $this->user->info->ID,
                "timestamp" => time(),
                "privacy" => $privacy
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

            $fileid = $this->feed_model->add_image(array(
                "file_name" => $data['file_name'],
                "file_type" => $data['file_type'],
                "extension" => $data['file_ext'],
                "file_size" => $data['file_size'],
                "userid" => $this->user->info->ID,
                "timestamp" => time(),
                "privacy" => $privacy
                )
            );
        }

        // Video
        $videoid=0;
        if(!empty($youtube_url)) {
            $matches = array();
            preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $youtube_url, $matches);
            if(!isset($matches[0]) || empty($matches[0])) {
                $this->template->error(lang("error_96"));
            }
            $youtube_id = $matches[0];
            // Add
            $videoid = $this->feed_model->add_video(array(
                "youtube_id" => $youtube_id,
                "userid" => $this->user->info->ID,
                "timestamp" => time()
                )
            );
        } elseif(isset($_FILES['video_file']['size']) && $_FILES['video_file']['size'] > 0) {
            $this->load->library("upload");
            // Upload image
            $this->upload->initialize(array(
               "upload_path" => $this->settings->info->upload_path,
               "overwrite" => FALSE,
               "max_filename" => 300,
               "encrypt_name" => TRUE,
               "remove_spaces" => TRUE,
               "allowed_types" => "avi|mp4|webm|ogv|ogg|3gp|flv",
               "max_size" => $this->settings->info->file_size,
                )
            );

            if ( ! $this->upload->do_upload('video_file'))
            {
                    $error = array('error' => $this->upload->display_errors());

                    $this->template->error(lang("error_97") . "<br /><br />" .
                         $this->upload->display_errors() . "<br />" . mime_content_type($_FILES['video_file']['tmp_name']));
            }

            $data = $this->upload->data();

            $videoid = $this->feed_model->add_video(array(
                "file_name" => $data['file_name'],
                "file_type" => $data['file_type'],
                "extension" => $data['file_ext'],
                "file_size" => $data['file_size'],
                "userid" => $this->user->info->ID,
                "timestamp" => time()
                )
            );
        }

        if(empty($content) && $fileid == 0 && $videoid == 0 && empty($question)) 
           // $this->template->jsonError(lang("error_98"));
             $fail = lang("error_109");
                     echo json_encode(array($fail));
                     exit;

        $this->feed_model->update_post($id, array(
            "content" => $content,
            "location" => $location,
            "imageid" => $fileid,
            "videoid" => $videoid,
            "user_flag" => $user_flag,
            "member_only" => $members_only,
            "postfor" => $postfor
            )
        );

        foreach($tagged_users as $user) {
            // Check the user wasn't already tagged
            $tag = $this->feed_model->get_feed_tag($id, $user->ID);
            if($tag->num_rows() == 0) {

                // Notification
                $this->feed_model->add_tagged_user(array(
                    "userid" => $user->ID,
                    "postid" => $id
                    )
                );
                $this->user_model->increment_field($user->ID, "noti_count", 1);
                $this->user_model->add_notification(array(
                    "userid" => $user->ID,
                    "url" => "home/index/3?postid=" . $id,
                    "timestamp" => time(),
                    "message" => $this->user->info->first_name . " " . $this->user->info->last_name . " " . lang("ctn_649"),
                    "status" => 0,
                    "fromid" => $this->user->info->ID,
                    "username" => $user->username,
                    "email" => $user->email,
                    "email_notification" => $user->email_notification
                    )
                );

                // Check user is not already added to subscriber feed
                $sub = $this->feed_model->get_feed_subscriber($id, $user->ID);
                if($sub->num_rows() == 0) {
                    $this->feed_model->add_feed_subscriber(array(
                        "postid" => $id,
                        "userid" => $user->ID
                        )
                    );
                }

            }

        }

        // Delete feed users
        $this->feed_model->delete_feed_users($id);

        $users = array_unique($users);

        foreach($users as $user) {
            $this->feed_model->add_feed_users(array(
                "userid" => $user->ID,
                "postid" => $id
                )
            );

            // Check user is not already added to subscriber feed
            $sub = $this->feed_model->get_feed_subscriber($id, $user->ID);
            if($sub->num_rows() == 0) {
                $this->feed_model->add_feed_subscriber(array(
                    "postid" => $id,
                    "userid" => $user->ID
                    )
                );
            }

        }

        // update poll
        if(!empty($question)) {
            $poll_answers = intval($this->input->post("poll_answers"));

            if($post->pollid > 0) {
                // Already has a poll
                $this->feed_model->update_feed_poll($post->pollid, array(
                    "question" => $question,
                    "type" => $poll_type
                    )
                );

                // Current answers
                $current_answers = $this->feed_model->get_poll_answers($post->pollid, $this->user->info->ID);
                foreach($current_answers->result() as $r) {
                    if(isset($_POST['poll_answer_e_' . $r->ID])) {
                        $answer = $this->common->nohtml($this->input->post("poll_answer_e_" . $r->ID));
                        if(empty($answer)) {
                            // Delete it
                            $this->feed_model->delete_poll_answer($r->ID);
                            // update poll total votes
                            $this->feed_model->update_feed_poll($post->pollid, array(
                                "votes" => $post->poll_votes - $r->votes
                                )
                            );
                        } else {
                            // Update it
                            $this->feed_model->update_poll_answer($r->ID, array(
                                "answer" => $answer
                                )
                            );
                        }
                    } else {
                        // Delete it
                        $this->feed_model->delete_poll_answer($r->ID);

                        // update poll total votes
                        $this->feed_model->update_feed_poll($post->pollid, array(
                            "votes" => $post->poll_votes - $r->votes
                            )
                        );
                    }
                }

                // New answers
                $answers = array();
                for($i=0;$i<=$poll_answers;$i++) {
                    if(isset($_POST['poll_answer_' . $i])) {
                        $answer = $this->common->nohtml($this->input->post("poll_answer_" . $i));
                        if(!empty($answer)) {
                            $answers[] = $answer;
                        }
                    }
                }

                foreach($answers as $answer) 
                {
                    $this->feed_model->add_feed_poll_answer(array(
                        "pollid" => $post->pollid,
                        "answer" => $answer
                        )
                    );
                }
            } else {
                // New poll
                $answers = array();
                for($i=0;$i<=$poll_answers;$i++) {
                    if(isset($_POST['poll_answer_' . $i])) {
                        $answer = $this->common->nohtml($this->input->post("poll_answer_" . $i));
                        if(!empty($answer)) {
                            $answers[] = $answer;
                        }
                    }
                }

                // Check answers are not empty
                if(count($answers) > 0) {
                    // Add poll
                    $pollid = $this->feed_model->add_feed_poll(array(
                        "postid" => $id,
                        "question" => $question,
                        "type" => $poll_type,
                        )
                    );

                    foreach($answers as $answer) 
                    {
                        $this->feed_model->add_feed_poll_answer(array(
                            "pollid" => $pollid,
                            "answer" => $answer
                            )
                        );
                    }

                    // Update post with pollid as ref
                    $this->feed_model->update_post($id, array(
                        "pollid" => $pollid
                        )
                    );
                }

            }
        } else {
            if($post->pollid > 0) {
                // Has a poll, lets delete it
                $this->feed_model->delete_feed_poll($post->pollid);
                $this->feed_model->delete_feed_poll_answers($post->pollid);

                // Update post with pollid as ref
                $this->feed_model->update_post($id, array(
                    "pollid" => 0
                    )
                );
            }
        }

        // Get the post for display
        $post = $this->feed_model->get_post($id, $this->user->info->ID);
        if($post->num_rows() == 0) {
           // $this->template->jsonError(lang("error_105"));
             $fail = lang("error_109");
                     echo json_encode(array($fail));
                     exit;
        }
        $post = $post->row();

        $ajax = $this->template->returnAjax("feed/feed_single.php", array(
            "r" => $post
            )
        );
         echo json_encode(array(
            "success" => 1,
            "post" => $ajax,
            "id" => $id
            )
        );
        exit();

       
         
            }
            else{
            echo "user not accessible";
            }

           }
           else{
           echo "token not valid";
          }}
          else{
          echo "username not found";
}
}
        public function profile(){
         $token = $this->input->get('token');
         $userid   =  $this->input->get('userid');
         $username =  $this->input->get("username", true);

         $r = $this->api_model->information($userid ,$username);
         //echo json_encode($r);
          if($r != $token)
          {
            //$userid = $r;
            echo "ok"; 
            $t= $this->api_model->checktoken($token);
             echo json_encode($t);
            if($this->api_model->checktoken($token) > 0)
            {
            $users = $this->api_model->get_user_username($userid,$username);
             //echo json_encode($users);
             if($this->api_model->get_user_username($userid,$username) != "")
             {
             echo "user accessible";
            // $post = $this->api_model->get_id($this->user->info->ID,$username);
            if(empty($username)) 
            $this->template->error(lang("error_51"));
            
            $username = $this->common->nohtml($username);
            $user =     $this->api_model->get_id($userid,$username);
            echo json_encode($user);
            if($user->num_rows() == 0)
            $this->template->error(lang("error_52"));
              
            $user = $user->row();

            $role = $this->user_model->get_user_role($user->user_role);
            if($role->num_rows() == 0) {
            $role = lang("ctn_46");
            } else {
            $role = $role->row();
            $rolename = $role->name;
            }

            if(isset($role->banned)) {
            if($role->banned) 
                $this->template->error(lang("error_53"));
                
            }
           $groups = $this->user_model->get_user_groups($user->ID);
           $fields = $this->user_model->get_custom_fields_answers(array(
            "profile" => 1), $user->ID);

          // Update profile views
          $this->user_model->increase_profile_views($user->ID);
 
          $user_data = $this->user_model->get_user_data($user->ID);
          if($user_data->num_rows() == 0) {
            $user_data = null;
          } else {
            $user_data = $user_data->row();
          }

         // If user is not logged in and friend only profile, no dice.
          if($user->profile_view == 1 && !$this->user->loggedin) {
            $user->profile_header = "empty.png";
            $user->avatar = "default.png";
          if($this->user->loggedin) {
            if($user->profile_view == 1 && $user->ID != $this->user->info->ID) {
                // Only let's friends view profile.
                // if(!$flags['friend_flag']) {

                //  $user->profile_header = "empty.png";
                //  $user->avatar = "default.png";

                //  $this->template->loadContent("profile/empty.php", array(
                //      "user" => $user,
                //      "friend_flag" => $flags['friend_flag'],
                //      "request_flag" => $flags['request_flag'],
                //      ), 1
                //  );
                // }
            }
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
        $albums = $this->image_model->get_user_albums_sample($this->user->info->ID);
        echo json_encode($albums);
        echo json_encode(array(
            "success" => 1
            )
        );
            exit();
       
              }
             else{
                 echo "user not found";
        }}
        else{
            echo "token not valid";
        }}
        else{
            echo "user not accessible";
        }
   
}
}}
?>