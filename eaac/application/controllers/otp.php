<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OTP extends CI_Controller {

	/**
	 * @author : YOUR MOM
	 */
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->database();
		date_default_timezone_set('Asia/Jakarta');
		if(! $this->session->userdata('email')){	redirect(base_url());	}
		if( $this->session->userdata('isOTP')){	redirect('registrasi');	}
	} 
	
	public function index()
	{
		$this->load->view('templates/v_OTP');echo "<pre>";print_r($this->session->all_userdata());echo "</pre>";
	}
	    
	public function validate()
	{
		if($email = $this->session->userdata('email'))
		{
			$token_input = $this->input->post('softtoken');
			$get_token = "SELECT * FROM email_token WHERE email = '$email'";
			$result = $this->db->query($get_token);			
			foreach ($result->result_array() as $row)
			{
				$token_validate = $row['token'];
			}
			
			if ($token_input == $token_validate)
			{
				# lek token e bener
				$this->session->set_userdata('isOTP', TRUE);			
				redirect('registrasi');
				//$this->load->gotoPage('v_regisEnd');
			}
				else
			{				
				# lek token e salah
				$baseee = base_url();
				echo "<script>alert('Token Salah');
				window.location.href='{$baseee}otp';</script>";
			}               
		}
		else
		{
			redirect (base_url());
		}
	}
		
	public function sendMail($usr, $msisdn, $token)
	{
		$ip = $this->config->item("ip_smsgw");
		$port = $this->config->item("port_smsgw");
		$user = $this->config->item("user_smsgw");
		$pass = $this->config->item("pwd_smsgw");
		$adn = $this->config->item("adn");
		$msg = urlencode("Token untuk username ".$usr." adalah ".$token);
		$url = "http://$ip:$port/cgi-bin/sendsms?user=$user&pass=$pass&from=$adn&to=$msisdn&text=$msg";
		$response = file_get_contents($url);
	}

	
}
		
?>



