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
		$this->load->gotoPage('v_checkEmail');//$this->load->gotoPage('v_checkEmail');
	}
	
	public function isValid()
	{
		$email = $this->input->post('email');
		
		# kodinganCekAPIEmail
		// $responseAPI = $this->validationAPI($email);
		/*
				Doing API VALIDATION FROM SURROUNDING	
														*/
		//$responseAPI1 = true;	// <-- HARDCODE

		$responseCheckEmail = $this->API_Check_Email($email);
		
		#EmailNullCheck 
		if ($email)
		{
			#isFieldFilled
			if ($responseCheckEmail)
			{
				// if VALID SHOW "SEND OTP PAGE"
				$dataEmail = array(
                   #'username'  => 'johndoe','logged_in' => TRUE
				   'isOTP' => FALSE,
				   'alamat_antor' => array('alamat1, provinsi A','alamat2, provinsi B','alamat3, provinsi C','alamat4, provinsi A','alamat5, provinsi C','alamat6, provinsi A','alamat7, provinsi D','alamat8, provinsi C','alamat9, provinsi C','alamat10, provinsi E','alamat11, provinsi A','alamat12, provinsi B','alamat13, provinsi D','alamat14, provinsi A','alamat15, provinsi C'),
				   'alamat_antorz' => $responseCheckEmail,
                   'email'     => $email ,
                   'paketz' => array(
						    array("label"=>"HaloKick", "info"=>"Halo MyPlan", "net"=>"1,5", "netmail"=>"500", 
							"callCUG"=>"1000", "callAll"=>"60", "SMSCUG"=>"1000", "SMSAll"=>"60")   ,
							
							array("label"=>"HaloPunch", "info"=>"Halo MyDream", "net"=>"1,5", "netmail"=>"500", 
							"callCUG"=>"1000", "callAll"=>"60", "SMSCUG"=>"1000", "SMSAll"=>"60")   ,
							
							array("label"=>"HaloBdg", "info"=>"Halo Bdg", "net"=>"1,5", "netmail"=>"500", 
							"callCUG"=>"1000", "callAll"=>"60", "SMSCUG"=>"1000", "SMSAll"=>"60")
						)
                   
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
			$Token = substr(uniqid(), 7);
			$insertEmail = "Insert intO email_token (email,token,update_time) values (?,?,now())";
			$this->db->query($insertEmail,array($theEmail,$Token));
		}else  {
			$Token = substr(uniqid(), 7);
			$updateToken = "UPDATE email_token SET token = ? , update_time=now() WHERE email = ? ";
			$this->db->query($updateToken,array($Token,$theEmail));
		}
		//$this->sendToken($theEmail);	UnComment when deployed
	}
	
	function in_array_r($needle, $haystack, $strict = false) {
		foreach ($haystack as $item) {
			if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
				return true;
			}
		}
		return false;
	}
	
	public function sendToken($theEmail)
	{
		$to = $theEmail;
		$title = "SUBJECT OF EMAIL HERE";
		$text = "CONTENT OF EMAIL HERE";

		$config['protocol'] = "smtp";
		$config['smtp_host'] = "10.54.13.242";  // GANTI
		$config['smtp_port'] = "25";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";
		$config['crlf'] = "\r\n";

		$this->load->library('email');

		$this->email->initialize($config);
		$this->email->to($to);
		$this->email->from('noreply.eaac@telkomsel.com');
		$this->email->subject($title);
		$this->email->message($text);

		$result = $this->email->send();
		var_dump($result);
	}

	################################ API CIS RENE NGISOR KABEH ######################

	function API($body,$url)
	{
		$this->load->library('curl');
		date_default_timezone_set("Asia/Bangkok");
		$curr_timestamp = date('Y-m-d H:i:s');
		//$po = $this->db->query("insert into log_hit (hitsoap) values ('$body')");
		//$this->writeHit($body);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout in seconds
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;//echo API_DUKCAPIL;
	}

	function API_Check_Email($email)
	{	
		$body="
		<soapenv:Envelope xmlns:soapenv='http://schemas.xmlsoap.org/soap/envelope/' xmlns:orac='http://www.oracle.com' xmlns:v1='http://www.telkomsel.com/eai/CIS/cis_domain_checkRq/v1.0'>
		   <soapenv:Header>
		      <orac:AuthenticationHeader>
		         <orac:UserName>osb</orac:UserName>
		         <orac:PassWord>welcome1</orac:PassWord>
		      </orac:AuthenticationHeader>
		   </soapenv:Header>
		   <soapenv:Body>
		      <v1:cis_domain_checkRq>
		         <v1:domain_name>".$email."</v1:domain_name>
		         <v1:channel>TC</v1:channel>
		         <v1:trx_id>test</v1:trx_id>
		      </v1:cis_domain_checkRq>
		   </soapenv:Body>
		</soapenv:Envelope>
		";
		$respDukcapil = $this->API($body,API_SRM_CHECK_EMAIL);
		//echo $respDukcapil;
        $obj = new DOMDocument();
        $obj->loadXML($respDukcapil);
        $errCode = $obj->getElementsByTagName("error_code")->item(0)->nodeValue;
        $errMsg = $obj->getElementsByTagName("error_msg")->item(0)->nodeValue;
        $totalRow = $obj->getElementsByTagName("total")->item(0)->nodeValue;

        if($errCode == '0000' && $errMsg == 'Success' && $totalRow > 0)
        {
        	$items = $obj->getElementsByTagName('data');//echo $errCode."<br>".$errMsg;
        	//echo "<pre>";echo "<pre>";
        	$headlines = array();
        	foreach($items as $item) 
        	{
		        $headline = array();
		       
		        if($item->childNodes->length) {
		            foreach($item->childNodes as $i) {
		                $headline[$i->nodeName] = $i->nodeValue;
		            }
		        }
		       
		        $headlines[] = $headline;
		    }
		    //echo "<pre>";print_r($headlines);echo "<pre>";
		    if(!empty($headlines)) 
		    {
		    	echo "123456";
		    	return $headlines;//foreach($headlines as $headline) {echo $headline['v1:account_id'];}

		    }
		}

    	else{return $headlines = array('NO RESPONSE FROM SERVER');/*echo "GAGAL";*/}

    }

    public function API_Check_Pesanan()
	{
		$TRX = $this->input->post('TRXku');
		$body="
		<soapenv:Envelope xmlns:soapenv='http://schemas.xmlsoap.org/soap/envelope/' xmlns:orac='http://www.oracle.com' xmlns:v1='http://www.telkomsel.com/eai/CIS/Resource/wsdlxsde/cis_eaac_checkRq/v1.0'>
		   <soapenv:Header>
		      <orac:AuthenticationHeader>
		         <orac:UserName>osb</orac:UserName>
		         <orac:PassWord>welcome1</orac:PassWord>
		      </orac:AuthenticationHeader>
		   </soapenv:Header>
		   <soapenv:Body>
		      <v1:cis_eaac_checkRq>
		         <v1:request_id>".$TRX."</v1:request_id>
		      </v1:cis_eaac_checkRq>
		   </soapenv:Body>
		</soapenv:Envelope>
		";
		$respGet = $this->API($body,API_SRM_CHECK_PESANAN);
		$objGetEmAll = new DOMDocument();
        $objGetEmAll->loadXML($respGet);

        $errCode = $objGetEmAll->getElementsByTagName("error_code")->item(0)->nodeValue;
        $errMsg = $objGetEmAll->getElementsByTagName("error_msg")->item(0)->nodeValue;
        if($errCode == '0000' && $errMsg == 'Success')
        {
        	$respReqId = $objGetEmAll->getElementsByTagName("request_id")->item(0)->nodeValue;
        	$respMSISDN = $objGetEmAll->getElementsByTagName("msisdn")->item(0)->nodeValue;
        	$respAccId = $objGetEmAll->getElementsByTagName("account_id")->item(0)->nodeValue;
        	$respAccName = $objGetEmAll->getElementsByTagName("account_name")->item(0)->nodeValue;
        	$respSTATUS = $objGetEmAll->getElementsByTagName("status")->item(0)->nodeValue;
        	$responze = array($respReqId,$respMSISDN,$respAccName,$respSTATUS);
        	echo json_encode($responze);
        }else { echo "ERROR at OSB";}
	}

	#################
	#YG KURANG
	# - Validation server&client side
	# - API Check email
	# - Send token to Email via SMTP
	# - if isset dataEmail --> make sure no route is bypass'd
	#################
	#METHOD LIST
	# - isValid			--> triggered by <form>
	# - validationAPI	--> API for email validation
	# - firstOTP		--> Generate token & access to DB
	# - in_array_r		--> only used by firstOTP()
	# - sendToken		--> Send Token to Email
	#################
}
