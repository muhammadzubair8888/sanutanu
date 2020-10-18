<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() 
	{
		parent::__construct();
		$this->load->model("login_model");
		$this->load->model("user_model");
		$this->load->model("home_model");
		$this->load->model("register_model");
	}
	public function index()
    {
        //print_r($this->user->loggedin);
        if($this->user->loggedin){
			redirect(base_url('index.php/home/index')); 
        }else{
            $this->load->view('index_welcome');
        }
	}
}

/* End of file Controllername.php */
?>