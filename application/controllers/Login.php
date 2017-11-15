<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * DEFAULT LOGIN PAGE
	 */
	public function index()
	{
		$this->load->view('login');
	}
}
