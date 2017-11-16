<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct()
    {
    	parent::__construct();
     	$sessiondata = $this->session->userdata("login_user");
		if(!empty($sessiondata))
		{
			redirect(base_url()."index.php/home", refresh);
		}
    }

	public function index()
	{
		$this->load->view('login');
	}
}
