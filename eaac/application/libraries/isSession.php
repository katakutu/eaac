<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IsSession {

        function __construct(){
			parent::__construct();
			$this->load->helper('url');
			$this->load->library('session');
			$this->CI =& get_instance();

			$email          		= isset($_POST['email']) ? $_POST['email'] : '';
			$alamatkantor    		= isset($_POST['alamatkantor']) ? $_POST['alamatkantor'] : '';
			$infogedung    			= isset($_POST['infogedung']) ? $_POST['infogedung'] : '';
			$primarymsisdn 			= isset($_POST['primarymsisdn']) ? $_POST['primarymsisdn'] : '';
			$secondarymsisdn		= isset($_POST['secondarymsisdn']) ? $_POST['secondarymsisdn'] : '';
			$noktp 		   			= isset($_POST['noktp']) ? $_POST['noktp'] : '';
			$nokk  		  			= isset($_POST['nokk']) ? $_POST['nokk'] : '';
			$imagektp      			= isset($_POST['imagektp']) ? $_POST['imagektp'] : '';
			$imagepeg      			= isset($_POST['imagepeg']) ? $_POST['imagepeg'] : '';
			$fullname    			= isset($_POST['fullname']) ? $_POST['fullname'] : '';
			$alamat    				= isset($_POST['alamat']) ? $_POST['alamat'] : '';
			$provinsi    			= isset($_POST['provinsi']) ? $_POST['provinsi'] : '';
			$kota    				= isset($_POST['kota']) ? $_POST['kota'] : '';
			$kodepos    			= isset($_POST['kodepos']) ? $_POST['kodepos'] : '';
			$tanggallahir    		= isset($_POST['tanggallahir']) ? $_POST['tanggallahir'] : '';
			$tempatlahir    		= isset($_POST['tempatlahir']) ? $_POST['tempatlahir'] : '';
			$namaibu    			= isset($_POST['namaibu']) ? $_POST['namaibu'] : '';
			$phone    				= isset($_POST['phone']) ? $_POST['phone'] : '';
			$emailreferensi			= isset($_POST['emailreferensi']) ? $_POST['emailreferensi'] : '';

	        
		} 
}