<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scrap extends CI_Controller {

	 public function __construct() 
	{
		parent::__construct();
		$this->load->model("login_model");
		$this->load->model("user_model");
		$this->load->model("home_model");
		$this->load->model("register_model");
	}

	public function index($ok=0)
    { 
    	ini_set('max_execution_time', 0);
    	$email = 'mr.tanveer007@gmail.com';
		$password = '123456';
		// initial login page which redirects to correct sign in page, sets some cookies
		$URL = 'https://www.yellowpages.no/accounts/login/';
//if($ok==0):
		$ch = curl_init($URL);
		curl_setopt($ch,CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch,CURLOPT_TIMEOUT, 20);
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_FAILONERROR,true);
		curl_setopt($ch, CURLOPT_COOKIEJAR, 'F:\xampp\tmp\cookies.txt');  //could be empty, but cause problems on some hosts
		curl_setopt($ch, CURLOPT_COOKIEFILE, 'F:\xampp\tmp\cookies.txt');  //could be empty, but cause problems on some hosts
		//$answer = curl_exec($ch);
		$page = curl_exec($ch); // Execute the curl command options
		//curl_close($ch);
		/*if (curl_error($ch)) {
		    echo curl_error($ch);
		}
		print_r($answer);*/
		//curl_close($ch);
		//var_dump($page);exit; // Un-comment beginning of line to see the output of the variables from Curl. 

if($ok==0):
		libxml_use_internal_errors(true);
        $dom1 = new DOMDocument();
        $dom1->preserveWhiteSpace = false;
		$dom1->formatOutput       = true;
        $dom1->loadHTML($page);
        libxml_use_internal_errors(false);

        $forms = $dom1->getElementsByTagName('form');
        //$divs = $dom->getElementsByTagName('div');
        $action =  "https://www.yellowpages.no".$forms[0]->getAttribute("action");
        $inputs = $forms[0]->getElementsByTagName('input');
        $postFields = array();
        foreach ($inputs as $input) {
        	$type = $input->getAttribute("type");
        	if($type=='hidden')
        	{
        		$n = $input->getAttribute("name");
        		$v = $input->getAttribute("value");
        		$postFields[$n] = $v;
        	}
        	//echo ' => '.$input->getAttribute("name").' : '.$input->getAttribute("value");
        }
        //print($forms);
        //print_r($form[0]->getAttribute('action'));

		$URL2 = $action; // this is our new post url
		//echo $URL2;

		$postFields['login'] = $email;
		$postFields['password'] = $password;
		//print_r($postFields);
		$post = '';

		// convert array to string, form will not accept multipart/form-data, only application/x-www-form-urlencoded
		foreach($postFields as $key => $value) {
			$post .= $key . '=' . urlencode($value) . '&';
		}

		$post = substr($post, 0, -1);

		// set additional curl options using our previous options
		curl_setopt($ch, CURLOPT_URL, $URL2);
		curl_setopt($ch, CURLOPT_REFERER, $URL);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

		$page = curl_exec($ch); // Execute curl and make request to login

		//var_dump($page); // should be logged in. The output will be HTML CODE you will have to decipher code to see if it has login details. 

endif;		
//endif;
//exit;
if($ok>0):
    	$v = 'https://www.yellowpages.no/places/NO/company';
    	$pageno = 1;
    	$haspages = 2;
    	$ln=0;
    	$m=1;
    	//$v = 'https://www.yellowpages.no/places/NO/skole/'.$pageno.'.html';
    	for($loop=1; $loop<=20; $loop++):
    		$pageno++;
	    	//$ch = curl_init($v);
	    	//curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIE_FILE); 
			//curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIE_FILE); 
			curl_setopt($ch,CURLOPT_URL, $v);
	        curl_setopt($ch,CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	        curl_setopt($ch,CURLOPT_TIMEOUT, 20);
	        curl_setopt($ch,CURLOPT_FOLLOWLOCATION, true);
	        curl_setopt($ch,CURLOPT_RETURNTRANSFER, TRUE);
	        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);
	        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($ch,CURLOPT_FAILONERROR,true);

	        $html = curl_exec($ch);
	         if(curl_errno($ch)) {
	            $debug_string = "Curl Error No: " . curl_errno($ch);
	            if($debug) {
	                echo $debug_string;
	                exit();
	            }
	            return false;
	        }
	        //curl_close($ch);

	        //$html = file_get_contents($v);

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
	        $dom->preserveWhiteSpace = false;
			$dom->formatOutput       = true;
	        $dom->loadHTML($html);
	        libxml_use_internal_errors(false);

	        $atag = $dom->getElementsByTagName('a');
	        $divs = $dom->getElementsByTagName('div');
	        if(!$divs || $divs->length == 0) {
	            $debug_string = "No Div tags";
	            if($debug) {
	                echo $debug_string;
	                exit();
	            }
	            return false;
	        }
	        $i=1;
	        foreach($divs as $div) 
	        {
	            if($div->hasAttribute('class') && $div->getAttribute("class") == "cc-content") {
	                //$title = $tag->getAttribute('content');
	                $ln++;
	                echo '<pre>';
	                //echo $dom->ownerDocument->saveHTML($div);
	                $node = $div->getElementsByTagName('h2')[0];
	                $name = $node->getElementsByTagName('a')[0]->textContent;
	                $address = $div->getElementsByTagName('address')[0]->textContent;
	                //print_r($node);
	                //echo htmlspecialchars($dom->saveHtml($n));
	                //echo $ln .' '.$name.': '.$address.'<br>';
	                //echo '</pre>';
	                $formdata = array();
	                $formdata['name'] = $name;
	                $formdata['address'] = $address;
	                $formdata['type'] = '2';
	                //$this->db->insert('places',$formdata);
	            }
	        }
	        //print_r($atag);
	        //echo '<pre>';
	        $haspages = 0;
	        foreach($atag as $tag)
	        {
	        	if($tag->getAttribute('href')=='https://www.yellowpages.no/places/NO/company/'.$pageno.'.html')
	        	{
	        		$haspages++;
	        	}
	        	/*foreach($tag->attributes as $attr)
	        	{
	        		echo $attr->nodeName.' : '.$attr->nodeValue.'<br>';
	        	}*/
	        	//echo '<hr>';
	        }
	        $v = 'https://www.yellowpages.no/places/NO/company/'.$pageno.'.html';

	        //echo '<hr>'.$m++;
	        //echo '</pre>';
	    endfor;
	    echo $ln.' rows inserted..';
endif;


        //echo '<pre>';
        //print_r($html);
        //echo '</pre>';
    	/*$data = file_get_contents('https://www.yellowpages.no/listing/places/?bbox=71.183746339%2C4.640777588%2C57.97952652%2C31.133167456&d=&l=Norway&lat=&lon=&q=school');
    	//class="card__primary"

		preg_match('/<title>([^<]+)<\/title>/i', $data, $matches);
		$title = $matches[1];

		preg_match('/<img[^>]*src=[\'"]([^\'"]+)[\'"][^>]*>/i', $data, $matches);
		$img = $matches[1];

		echo $title."<br>\n";
		echo $img;*/
	}
}

/* End of file Controllername.php */
?>