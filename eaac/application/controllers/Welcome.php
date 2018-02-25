<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Time is always on the winning Side ...
	 */
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
	} 
	 
	public function index()
	{
		$this->session->sess_destroy();
		$this->load->view('welcome_message');
	}
	
}
