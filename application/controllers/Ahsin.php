<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class Ahsin extends CI_Controller
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


    public function completesettingsapi()
    {
        $userid = $this->user->info->ID;
        $userdata = $this->db->where('ID' , $userid)->get('users')->row();
        echo json_encode($userdata);
    }

    public function updatesettingsapi()
    {
        $first_name = $this->common->nohtml($this->input->get("first_name"));
        $last_name = $this->common->nohtml($this->input->get("last_name"));
        $aboutme = $this->common->nohtml($this->input->get("aboutme"));
        $address_1 = $this->common->nohtml($this->input->get("address_1"));
        $address_2 = $this->common->nohtml($this->input->get("address_2"));
        $city = $this->common->nohtml($this->input->get("city"));
        $state = $this->common->nohtml($this->input->get("state"));
        $zipcode = $this->common->nohtml($this->input->get("zipcode"));
        $country = $this->common->nohtml($this->input->get("country"));
    }
}
?>