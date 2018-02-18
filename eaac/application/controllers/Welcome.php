<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Time is always on the winning Side ...
	 */
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	} 
	 
	public function index()
	{
		$this->load->view('page1');
	}
	
}
