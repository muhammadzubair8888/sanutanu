<?php
class Apis extends CI_Controller
{
public function __construct()
{
parent::__construct();
$this->load->model('Api_model');
$this->load->helper('text');
$this->load->model("user_model");
		$this->load->model("page_model");
		$this->load->model("admin_model");
		$this->load->model("home_model");
         $this->load->database();
		if(!$this->user->loggedin) $this->template->error(lang("error_1"));
		
		$this->template->loadData("activeLink", 
			array("settings" => array("general" => 1)));
		$this->template->set_layout("client/themes/titan.php");
}

public function login() {
        // Get the post data
        $username = $this->input->get('username');
        $password =  $this->input->get('password');
        $query = $this->Api_model->login_api($username,$password);
        echo json_encode($query);
        

                $token = $this->Api_model->insertToken($userInfo->id);                    
                $qstring = base64_encode($token);                    
                $url = site_url() . '/main/reset_password/token/' . $qstring;
                $link = '<a href="' . $url . '">' . $url . '</a>'; 

                $message .= '<strong>Kiran here:</strong> ' . $link;             

                echo $token;
                exit;

    



}


    


}
?>