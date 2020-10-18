<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Privacy extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		/*$this->load->model("user_model");
		$this->load->model("image_model");
		$this->load->model("feed_model");
		$this->load->model("blog_model");
		$this->load->model("home_model");

		
		// If the user does not have premium. 
		// -1 means they have unlimited premium
		if($this->settings->info->global_premium && 
			($this->user->info->premium_time != -1 && 
				$this->user->info->premium_time < time()) ) {
			$this->session->set_flashdata("globalmsg", lang("success_29"));
			redirect(site_url("funds/plans"));
		}*/

		$this->template->set_layout("client/themes/titan.php");

		/*if(!$this->settings->info->enable_blogs) {
			$this->template->error(lang("error_176"));
		}*/
	}

	public function index() 
	{
		$page_data['description'] = $this->db->get_where('privacy', array('ID'=>1))->row()->description;
		$this->template->loadContent("privacy/index.php", $page_data );
	}

}

?>