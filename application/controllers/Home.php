<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	var $userid;
	var $firstname;
	var $lastname;
	var $type;	
	var $logid;
	
	public function __construct()
    {
    	parent::__construct();
		$sessiondata = $this->session->userdata("login_user");	
		if(empty($sessiondata))
		{
			redirect(base_url(), refresh);
		}
		else
		{			
			$this->userid = $sessiondata[0]["userid"];
			$this->firstname = $sessiondata[0]["firstname"];
			$this->lastname = $sessiondata[0]["lastname"];
			$this->type = $sessiondata[0]["type"];
			$this->logid = $sessiondata[0]["logid"];
		}
    }

	public function index()
	{
		if($this->type == 1)
		{
			$this->load_admin_page();
		}
		else
		{
			$this->load_user_page();
		}
	}
	
	private function load_admin_page()
	{
		$this->load->view('template/header');
		$this->load->view('template/admin_menu');
		$this->load->view('template/footer');
	}
	
	private function load_user_page()
	{
		$this->load->view('template/header');
		$this->load->view('template/user_menu');
		$this->load->view('template/footer');
	}
}
