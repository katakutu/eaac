<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class checkEmail extends CI_Controller {

	/**
	 * @author : YOUR MOM
	 */
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->database();
	} 
	 
	public function index()
	{
		$this->load->gotoPage('v_checkEmail');
	}
	
	public function isValid()
	{
		$email = $this->input->post('email');
		
		# kodinganCekAPIEmail
		// $responseAPI = $this->validationAPI($email);
		/*
				Doing API VALIDATION FROM SURROUNDING	
														*/
		$responseAPI = true;	// <-- HARDCODE
		
		#EmailNullCheck 
		if ($email)
		{
			#isFieldFilled
			if ($responseAPI)
			{
				// if VALID SHOW "SEND OTP PAGE"
				$dataEmail = array(
                   #'username'  => 'johndoe','logged_in' => TRUE
                   'email'     => $email 
				);
				$this->session->set_userdata($dataEmail);
				$this->firstOTP($email);
				redirect('otp');
			}else
			{
				$this->load->gotoPage('v_checkEmailGagal');
			}
		
			
		}else{
			#isFieldNull back to first page
			echo "<script>alert('ISI EMAIL NY MANA SEMPAK');</script>";
			redirect (base_url());
		}
	}
	
	public function validationAPI($theEmail)
	{
		//
	}
	
	public function firstOTP($theEmail)
	{
		/*
		1. Check of all email , if not exist   |  if exist
		2. Generate Token					   | 2. Generate Token
		3. Insert Email to DB				   | 3. Update field token
		*/
		$checkAll = "select email from email_token";
		$result = $this->db->query($checkAll);
		$allEmail = $result->result_array();
		
		if(!$this->in_array_r($theEmail, $allEmail)){
		//if (!in_array($theEmail, $allEmail)) {
			$Token = substr(uniqid(), 7);
			$insertEmail = "Insert intO email_token (email,token,update_time) values (?,?,now())";
			$this->db->query($insertEmail,array($theEmail,$Token));
		}else  {
			$Token = substr(uniqid(), 7);
			$updateToken = "UPDATE email_token SET token = ? , update_time=now() WHERE email = ? ";
			$this->db->query($updateToken,array($Token,$theEmail));
		}
		
	}
	
	function in_array_r($needle, $haystack, $strict = false) {
		foreach ($haystack as $item) {
			if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
				return true;
			}
		}
		return false;
	}

	#################
	#YG KURANG
	# - Validation server&client side
	# - API Check email
	# - Send token to Email via SMTP
	#################
}
