<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

class Login_Api extends REST_Controller {
		     
    function userlogin_post()
    {  
		$LoginResponseObject = new LoginResponse();
	 	$this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[32]|alpha_numeric');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[32]');
		if ($this->form_validation->run() == FALSE)
		{
			$LoginResponseObject->ErrorMessage = validation_errors();
			$LoginResponseObject->ResponseType = false;
		}
		else
		{
			$this->load->model("Login_Model");
			$logindata = $this->Login_Model->get_login_details($this->post('username'), md5($this->post('password')));
			if(empty($logindata))
			{
				$LoginResponseObject->ResponseType = false;
				$LoginResponseObject->ErrorMessage = "Invalid login details. Please try again.";
			}
			else
			{
				$logindata[0]["logid"] = $this->Login_Model->insert_audit_login($logindata[0]["userid"]);
				$this->session->set_userdata("login_user", $logindata);
				$LoginResponseObject->ResponseType = true;
				$LoginResponseObject->ErrorMessage = "Login successful.";
			}
		}
		
        $data = array($LoginResponseObject);
        $this->response(json_encode($data));
    }
}

class LoginResponse
{
	var $ResponseType;
	var $ErrorMessage;
}