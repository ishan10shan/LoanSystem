<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Model extends CI_Model {
	
	public function __construct()
    {
    	parent::__construct();
     	// Your own constructor code
    }
	
	public function get_login_details($username, $encryptedpassword)
	{
		$this->db->select("userid, firstname, lastname, type");
		$this->db->where(array("username"=>$username, "password"=>$encryptedpassword));
		$result = $this->db->get('view_login_users');
		return $result->result_array();
	}
	
	public function insert_audit_login($userid)
	{
		$this->db->insert('user_logins', array("user"=>$userid, "login"=>date("Y-m-d H:i:s"))); 
		return $this->db->insert_id();
	}
}