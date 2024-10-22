<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

require_once("PasswordHash.php");

class Common 
{

    public function nohtml($message) 
    {
        $message = trim($message);
        $message = strip_tags($message);
        $message = htmlspecialchars($message, ENT_QUOTES);
        return $message;
    }

	public function encrypt($password) 
    {
        $phpass = new PasswordHash(12, false);
        $hash = $phpass->HashPassword($password);
    	return $hash;
    }

    public function get_user_role($user) 
    {
        if(isset($user->user_role_name)) {
            return $user->user_role_name;
        } else {
            return lang("ctn_46");
        }
    }

    public function randomPassword() 
    {
    	$letters = array(
            "a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q",
            "r","s","t","u","v","w","x","y","z"
        );
    	$pass = "";
    	for($i=0;$i<10;$i++) {
    		shuffle($letters);
    		$letter = $letters[0];
    		if(rand(1,2) == 1) {
	    		$pass .= $letter;
    		} else {
	    		$pass .= strtoupper($letter);
    		}
    		if(rand(1,3)==1) {
    			$pass .= rand(1,9);
    		}
    	}
    	return $pass;
    }

    public function checkAccess($level, $required) 
    {
        $CI =& get_instance();
        if($level < $required) {
            $CI->template->error(
                "You do not have the required access to use this page. 
                You must be a ". $this->getAccessLevel($required)
                . "to use this page."
            );
        }
    }

    public function send_email($subject, $body, $emailt) 
    {
        $CI =& get_instance();
        $CI->load->library('email');

        $config = array();
        $config['protocol']     = 'smtp';
        $config['smtp_host']    = 'mail.sanutanu.com';
        $config['smtp_port']    = '587';//465
        $config['smtp_user']    = 'no-reply@sanutanu.com';
        $config['smtp_pass']    = 'sanutanu@1234';
        $config['charset']      = 'utf-8';
        $config['mailtype']     = 'html';

        $CI->email->initialize($config);
        $CI->email->set_newline("\r\n");
        //$CI->settings->info->site_email
        $CI->email->from('no-reply@sanutanu.com', $CI->settings->info->site_name);
        $CI->email->to($emailt);

        $CI->email->subject($subject);
        $CI->email->message($body);

        $CI->email->send();
    }

    public function check_mime_type($file) 
    {
        return true;
    }

    public function replace_keywords($array, $message) 
    {
        foreach($array as $k=>$v) {
            $message = str_replace($k, $v, $message);
        }
        return $message;
    }

    public function convert_time($timestamp) 
    {
        $time = $timestamp - time();
        if($time <=0) {
            $days = 0;
            $hours = 0;
            $mins = 0;
            $secs = 0;
        } else {
            $days = intval($time / (3600 * 24));
            $hours = intval( ($time - ($days * (3600*24))) / 3600);
            $mins = intval( ($time - ($days * (3600*24)) - ($hours * 3600) ) 
                    / 60);
            $secs = intval( ($time - ($days * (3600*24)) - ($hours * 3600) 
                    - ($mins * 60)) );
        }
        return array(
            "days" => $days, 
            "hours" => $hours, 
            "mins" => $mins, 
            "secs" => $secs
        );
    }

    public function get_time_string($time) 
    {
        if(isset($time['days']) && 
            ($time['days'] > 1 || $time['days'] == 0)) {
            $days = lang("ctn_294");
        } else {
            $days = lang("ctn_295");
        }
        if(isset($time['hours']) && 
            ($time['hours'] > 1 || $time['hours'] == 0)) {
            $hours = lang("ctn_296");
        } else {
            $hours = lang("ctn_297");
        }
        if(isset($time['mins']) && 
            ($time['mins'] > 1 || $time['mins'] == 0)) {
            $mins = lang("ctn_298");
        } else {
            $mins = lang("ctn_299");
        }
        if(isset($time['secs']) && 
            ($time['secs'] > 1 || $time['secs'] == 0)) {
            $secs = lang("ctn_300");
        } else {
            $secs = lang("ctn_301");
        }

        // Create string
        $timeleft = "";
        if(isset($time['days'])) {
            $timeleft = $time['days'] . " " . $days;
        }

        if(isset($time['hours'])) {
            if(!empty($timeleft)) {
                if(!isset($time['mins'])) {
                    $timeleft .= " ".lang("ctn_302")." " . $time['hours'] . " " 
                    . $hours;
                } else {
                    $timeleft .= ", " . $time['hours'] . " " . $hours;
                }
            } else {
                $timeleft .= $time['hours'] . " " . $hours;
            }
        }

        if(isset($time['mins'])) {
            if(!empty($timeleft)) {
                if(!isset($time['secs'])) {
                    $timeleft .= " ".lang("ctn_302")." " . $time['mins'] . " " 
                    . $mins;
                } else {
                    $timeleft .= ", " . $time['mins'] . " " . $mins;
                }
            } else {
                $timeleft .= $time['mins'] . " " . $mins;
            }
        }

        if(isset($time['secs'])) {
            if(!empty($timeleft)) {
                $timeleft .= " ".lang("ctn_302")." " . $time['secs'] . " " 
                . $secs;
            } else {
                $timeleft .= $time['secs'] . " " . $secs;
            }
        }

        return $timeleft;
    }

    public function has_permissions($required, $user) 
    {
        if(!isset($user->info->user_role_id)) return 0;
        foreach($required as $permission) {
            if(isset($user->info->{$permission}) && $user->info->{$permission}) {
                return 1;
            }
        }
        return 0;
    }

    public function get_user_display($data) 
    {
        if(empty($data['username'])) return "";
        if(isset($data['online_timestamp']) > 0) {
            if($data['online_timestamp'] > time() - (60*15)) {
                $class = "online-dot-user";
                $title = lang("ctn_334");
            } else {
                $class = "offline-dot-user";
                $title = lang("ctn_335");
            }
        } else {
            $class = "online-dot-user";
        }

        $name = "";
        if(isset($data['first_name']) && isset($data['last_name'])) {
            $name = $data['first_name'] . " " . $data['last_name'];
        }
        $CI =& get_instance();
        $html = '<div class="user-box-avatar">
                <div class="'.$class.'" data-toggle="tooltip" data-placement="bottom" title="'.$title.'"></div>
                <a href="'.site_url("profile/" . $data['username']).'"><img src="'. base_url() . $CI->settings->info->upload_path_relative .'/'. $data['avatar'] .'" title="'.$data['username'].'" data-toggle="tooltip" data-placement="right" /></a>
                </div>';
        if($name) {
            $html .='<div class="user-box-name"><p>'.$name.'</p><p class="user-box-username">@<a href="'.site_url("profile/" . $data['username']).'">'.$data['username'].'</a></p></div>';
        }
        return $html;
    }

    public function get_time_string_simple($time) 
    {
        $CI =& get_instance();
        if(isset($time['days']) && 
            ($time['days'] > 1 || $time['days'] == 0)) {
            $days = lang("ctn_294");
        } else {
            $days = lang("ctn_295");
        }
        if(isset($time['hours']) && 
            ($time['hours'] > 1 || $time['hours'] == 0)) {
            $hours = lang("ctn_296");
        } else {
            $hours = lang("ctn_297");
        }
        if(isset($time['mins']) && 
            ($time['mins'] > 1 || $time['mins'] == 0)) {
            $mins = lang("ctn_298");
        } else {
            $mins = lang("ctn_299");
        }
        if(isset($time['secs']) && 
            ($time['secs'] > 1 || $time['secs'] == 0)) {
            $secs = lang("ctn_300");
        } else {
            $secs = lang("ctn_301");
        }

        if($time['days'] > 7) {
            return date($CI->settings->info->date_format, $time['timestamp']);
        } else {
            if($time['days'] > 0) {
                return $time['days'] . " " . $days . " ago";
            } elseif($time['hours'] > 0) {
                return $time['hours'] . " " . $hours . " ago";
            } elseif($time['mins'] > 0) {
                return $time['mins'] . " " . $mins . " ago";
            } elseif($time['secs'] > 0) {
                return $time['secs'] . " " . $secs . " ago";
            } else {
                return "0 " . lang("ctn_300") . " ago";
            }
        }
    }

    public function convert_simple_time($time) 
    {
        $o_time = $time;
        $time = time() - $time;
        if($time <=0) {
            $days = 0;
            $hours = 0;
            $mins = 0;
            $secs = 0;
        } else {
            $days = intval($time / (3600 * 24));
            $hours = intval( ($time - ($days * (3600*24))) / 3600);
            $mins = intval( ($time - ($days * (3600*24)) - ($hours * 3600) ) 
                    / 60);
            $secs = intval( ($time - ($days * (3600*24)) - ($hours * 3600) 
                    - ($mins * 60)) );
        }
        return array(
            "days" => $days, 
            "hours" => $hours, 
            "mins" => $mins, 
            "secs" => $secs,
            "timestamp" => $o_time
        );
    }

    public function get_user_tag_usernames($content) 
    {
        $matches = array();
        // Looks for @[First Name Last Name](Username)
        preg_match_all('/@\[[A-Za-z ]+\]\([A-Za-z0-9_]+\)/u', $content, $matches);

        $usernames = array();


        // Once we have our matches, let's get the username.
        foreach($matches[0] as $r) {
            // Grab userid
            preg_match("/\(([A-Za-z0-9_]+)\)/", $r, $userid);

            $usernames[] = $userid[1];
        }

        $CI =& get_instance();

        // Check all users
        $users = array();
        foreach($usernames as $username) {
            $user = $CI->user_model->get_user_by_username($username);
            if($user->num_rows() == 0) {
                // Replace the content to nothing
                $content = preg_replace('/@\[[A-Za-z ]+\]\('.$username.'+\)/', "", $content);
            } else {
                $user = $user->row();
                if($user->tag_user) {
                    $flag = $this->check_friend($CI->user->info->ID, $user->ID);
                    if(!$flag['friend_flag']) {
                        $content = preg_replace('/@\[[A-Za-z ]+\]\('.$username.'+\)/', $user->first_name . " " . $user->last_name, $content);
                    } else {
                        $users[] = $user;
                    }
                } else {
                    $users[] = $user;
                }
            }
        }

        return array("content" => $content, "users" => $users);
    }

    public function get_hashtags($content) 
    {
        $hashtags = array();
        $hashtag = preg_match_all("/(^|[ ])#[A-Za-z0-9_-]+/", 
            $content, $hashtags);
        return $hashtags;
    }

    public function replace_hashtags($content) 
    {
        $content = preg_replace_callback("/(^|[ ])#[A-Za-z0-9_-]+/", 
            array(&$this, "replace_hashtags_cb"), $content);
        return $content;
    }

    public function replace_hashtags_cb($matches) 
    {
        foreach($matches as $m) {

            // Grab hashtag
            $name ="";
            preg_match("/(^|[ ])#([A-Za-z0-9-_]+)/", $m, $name);

            if(!isset($name[2])) {
                return "";
            }
            $space = "";
            if(isset($name[1])) {
                $space = $name[1];
            }

            $text = $space . '<a href="'.site_url("home/index/1/" . $name[2]).'">#' . $name[2] . '</a>';
            return $text;
        }
    }

    public function replace_user_tags($content) 
    {
        $content = preg_replace_callback("/@\[[A-Za-z ]+\]\([A-Za-z0-9_]+\)/u", 
            array(&$this, "replace_user_tags_cb"), $content);
        return $content;
    }

    public function replace_user_tags_cb($matches) 
    {
        foreach($matches as $m) {

            // Grab userid
            $name ="";
            $userid = 0; // Actually username
            preg_match("/@\[([A-Za-z ]+)\]/u", $m, $name);
            preg_match("/\(([A-Za-z0-9]+)\)/", $m, $userid);

            if(!isset($name[1])) {
                return "";
            }
            if(!isset($userid[1])) {
                return "";
            }

            $text = '<a href="'.site_url("profile/" . $userid[1]).'">' . $name[1] . '</a>';
            
            return $text;
        }
    }

    public function date_php_to_momentjs($date)
    {
        $formats = array(
            'd' => 'DD', // 01-31
            'D' => '',  // mon-sun
            'j' => 'D',  // 1-31
            'l' => '', // Monday-Sunday
            'N' => '',   // day of the week number [1-7]
            'S' => 'o',   // English suffix e.g st, nd, rd
            'w' => '',   // day of the week number [0-6]
            'z' => '',  // day of the year 0-365
            // Week
            'W' => '',   // week number
            // Month
            'F' => 'MMMM', // January - December
            'm' => 'MM', // 01-12
            'M' => 'MMM',  // Jan - Dec
            'n' => 'M',  // 1-12
            't' => '',   // days in a month i.e 28,31
            // Year
            'L' => '',   // Leap year 1 or 0
            'o' => '',   // iso year
            'Y' => 'YYYY', // 1999-2003
            'y' => 'YY',  // 99-03
            // Time
            'a' => 'a',   // am or pm
            'A' => 'A',   // AM or PM
            'B' => '',   // swatch internet time 000-999
            'g' => 'h',   // 1-12 hour format
            'G' => 'H',   // 1-24 hour format
            'h' => 'hh',   // 01-12 hour format
            'H' => 'HH',   // 01-24 hour format
            'i' => 'mm',   // 00-59 minutes
            's' => 'ss',   // 00-59 seconds
            'u' => 'SSS'    // micro seconds
        );
        $str = "";
        for($i=0;$i<strlen($date);$i++) {
            $flag= false;
            foreach($formats as $php=>$jquery) {
                if($date[$i] == $php) {
                    $str .= $jquery;
                    $flag = true;
                }
            }
            if(!$flag) {
                $str .= $date[$i];
            }
        }
        return $str;  
    }

    public function check_friend($userid, $friendid) 
    {
        $CI =& get_instance();
        // check user is friend
        $friend_flag = 0;
        $request_flag = 0;
        $friend = $CI->user_model->get_user_friend($userid, $friendid);
        if($friend->num_rows() > 0) {
            // Friends
            $friend_flag = 1;
        } else {
            // Check for a request
            $request = $CI->user_model->check_friend_request($userid, $friendid);
            if($request->num_rows() > 0) {
                // Request sent
                $request_flag = 1;
            }
        }

        return array("friend_flag" => $friend_flag, "request_flag" => $request_flag);
    }

    public function convert_smiles($text) 
    {
        $text = preg_replace("/(^|[ ])\:\)/", "&#x1F60A;", $text);
        $text = preg_replace("/(^|[ ])\;\)/", "&#x1F609;", $text);
        $text = preg_replace("/(^|[ ])\:D/", "&#x1F601;", $text);
        $text = preg_replace("/(^|[ ])\:joy\:/", "&#x1F602;", $text);
        $text = preg_replace("/(^|[ ])\:sweatsmile\:/", "&#x1F605;", $text);
        $text = preg_replace("/(^|[ ])XD/", "&#x1F606;", $text);
        $text = preg_replace("/(^|[ ])\:innocent\:/", "&#x1F607;", $text);
        $text = preg_replace("/(^|[ ])\:smileimp\:/", "&#x1F608;", $text);
        $text = preg_replace("/(^|[ ])\:relieved\:/", "&#x1F60C;", $text);
        $text = preg_replace("/(^|[ ])\:hearteyes\:/", "&#x1F60D;", $text);
        $text = preg_replace("/(^|[ ])8\)/", "&#x1F60E;", $text);
        $text = preg_replace("/(^|[ ])\:P/", "&#x1F60B;", $text);
        $text = preg_replace("/(^|[ ])\:\|/", "&#x1F610;", $text);
        $text = preg_replace("/(^|[ ])\-\_\-/", "&#x1F611;", $text);

        $text = preg_replace("/(^|[ ])\:sweat\:/", "&#x1F613;", $text);

        $text = preg_replace("/(^|[ ])\:\//", "&#x1F615;", $text);
        $text = preg_replace("/(^|[ ])\:kissingheart\:/", "&#x1F618;", $text);
        $text = preg_replace("/(^|[ ])\:kissingclosedeyes\:/", "&#x1F61A;", $text);
        $text = preg_replace("/(^|[ ])\:stuckouttonguewinking\:/", "&#x1F61C;", $text);
        $text = preg_replace("/(^|[ ])\:\(/", "&#x1F61E;", $text);
        $text = preg_replace("/(^|[ ])\:crossedeyestongue\:/", "&#x1F61D;", $text);
        $text = preg_replace("/(^|[ ])\:rage\:/", "&#x1F621;", $text);
        $text = preg_replace("/(^|[ ])\:tearface\:/", "&#x1F622;", $text);
        $text = preg_replace("/(^|[ ])\:fuming\:/", "&#x1F624;", $text);
        $text = preg_replace("/(^|[ ])\:o/", "&#x1F62F;", $text);
        $text = preg_replace("/(^|[ ])\:weary\:/", "&#x1F62B;", $text);
        $text = preg_replace("/(^|[ ])\:sleepy\:/", "&#x1F634;", $text);
        $text = preg_replace("/(^|[ ])\:mask\:/", "&#x1F637;", $text);
        return $text;
    }

    public function get_smiles() 
    {
        $array = array(
            "&#128512;" => "&#128512;",
            "&#128513;" => "&#128513;",
            "&#128514;" => "&#128514;",
            "&#128515;" => "&#128515;",
            "&#128516;" => "&#128516;",
            "&#128517;" => "&#128517;",
            "&#128518;" => "&#128518;",
            "&#128519;" => "&#128519;",
            "&#128520;" => "&#128520;",
            "&#128521;" => "&#128521;",
            "&#128522;" => "&#128522;",
            "&#128523;" => "&#128523;",
            "&#128524;" => "&#128524;",
            "&#128525;" => "&#128525;",
            "&#128526;" => "&#128526;",
            "&#128527;" => "&#128527;",
            "&#128528;" => "&#128528;",
            "&#128529;" => "&#128529;",
            "&#128530;" => "&#128530;",
            "&#128531;" => "&#128531;",
            "&#128532;" => "&#128532;",
            "&#128533;" => "&#128533;",
            "&#128534;" => "&#128534;",
            "&#128535;" => "&#128535;",
            "&#128536;" => "&#128536;",
            "&#128537;" => "&#128537;",
            "&#128538;" => "&#128538;",
            "&#128539;" => "&#128539;",
            "&#128540;" => "&#128540;",
            "&#128541;" => "&#128541;",
            "&#128542;" => "&#128542;",
            "&#128543;" => "&#128543;",
            "&#128544;" => "&#128544;",
            "&#128545;" => "&#128545;",
            "&#128546;" => "&#128546;",
            "&#128547;" => "&#128547;",
            "&#128548;" => "&#128548;",
            "&#128549;" => "&#128549;",
            "&#128550;" => "&#128550;",
            "&#128551;" => "&#128551;",
            "&#128552;" => "&#128552;",
            "&#128553;" => "&#128553;",
            "&#128554;" => "&#128554;",
            "&#128555;" => "&#128555;",
            "&#128556;" => "&#128556;",
            "&#128557;" => "&#128557;",
            "&#128558;" => "&#128558;",
            "&#128559;" => "&#128559;",
            "&#128560;" => "&#128560;",
            "&#128561;" => "&#128561;",
            "&#128562;" => "&#128562;",
            "&#128563;" => "&#128563;",
            "&#128564;" => "&#128564;",
            "&#128565;" => "&#128565;",
            "&#128566;" => "&#128566;",
            "&#128567;" => "&#128567;",
            "&#128568;" => "&#128568;",
            "&#128569;" => "&#128569;",
            "&#128570;" => "&#128570;",
            "&#128571;" => "&#128571;",
            "&#128572;" => "&#128572;",
            "&#128573;" => "&#128573;",
            "&#128574;" => "&#128574;",
            "&#128575;" => "&#128575;",
            "&#128576;" => "&#128576;",
            "&#128577;" => "&#128577;",
            "&#128578;" => "&#128578;"
        ); 

        return $array; 
    }

    public function get_url_details($v) 
    {
        $debug = 0;
        $debug_string = "";
        if(!function_exists('curl_version')) {
            $debug_string = "No Curl";
            if($debug) {
                echo $debug_string;
                exit();
            }
            return false;
        }
        $curl = curl_init($v);

        curl_setopt($curl,CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($curl,CURLOPT_TIMEOUT, 20);
        curl_setopt($curl,CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl,CURLOPT_FAILONERROR,true);

        $html = curl_exec($curl);

        if(curl_errno($curl)) {
            $debug_string = "Curl Error No: " . curl_errno($curl);
            if($debug) {
                echo $debug_string;
                exit();
            }
            return false;
        }
        curl_close($curl);


        if($html === false) {
            $debug_string = "Curl response failed";
            if($debug) {
                echo $debug_string;
                exit();
            }
            return false;
        }
        if(empty($html)) {
            $debug_string = "Curl response empty";
            if($debug) {
                echo $debug_string;
                exit();
            }
            return false;
        }

        libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        $dom->loadHTML($html);
        libxml_use_internal_errors(false);

        $meta = $dom->getElementsByTagName('meta');
        if(!$meta || $meta->length == 0) {
            $debug_string = "No Meta tags";
            if($debug) {
                echo $debug_string;
                exit();
            }
            return false;
        }

        $title = "";
        $image = "";
        $desc = "";
        foreach($meta as $tag) 
        {
            if($tag->hasAttribute('property') && $tag->getAttribute("property") == "og:title") {
                $title = $tag->getAttribute('content');
            }
            if($tag->hasAttribute('property') && $tag->getAttribute("property") == "og:image") {
                $image = $tag->getAttribute('content');
            }
            if($tag->hasAttribute('property') && $tag->getAttribute("property") == "og:description") {
                $desc = $tag->getAttribute('content');
            }
            if(empty($desc) && $tag->hasAttribute("name") && $tag->getAttribute("name") == "description") {
                $desc = $tag->getAttribute('content');
            }
        }

        if(empty($title)) {
            // Get <title> tag
            $titletag = $dom->getElementsByTagName('title');
            if($titletag->length > 0) {
                foreach($titletag as $t) {
                    $title = $t->nodeValue;
                }
            }
        }

        return array("title" => $title, "image" => $image, "description" => $desc, "url" => $v);
    }

    public function convert_links($content) 
    {
        $content = preg_replace_callback('/[a-zA-Z]+:\/\/[0-9a-zA-Z;.\/\-?:@=_#&%~,+$]+/', function($matches) { 
                
        $CI =& get_instance();
                // Just turn it into a hyper link
                $v = $this->nohtml($matches[0]);
                $v = $CI->security->xss_clean($v);

                return '<a href="'.$v.'" target="_blank">'.$v.'</a>';
        }, $content);
        return $content;
    }

}

?>
