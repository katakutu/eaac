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
		date_default_timezone_set('Asia/Jakarta');
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
			#isFieldFilled isValid
			if ($responseCheckEmail)
			{
				// if VALID SHOW "SEND OTP PAGE"
				$dataEmail = array(
                   #'username'  => 'johndoe','logged_in' => TRUE
				   'isOTP' => FALSE,
				   #'alamat_antor' => array('alamat1, provinsi A','alamat2, provinsi B','alamat3, provinsi C','alamat4, provinsi A','alamat5, provinsi C','alamat6, provinsi A','alamat7, provinsi D','alamat8, provinsi C','alamat9, provinsi C','alamat10, provinsi E','alamat11, provinsi A','alamat12, provinsi B','alamat13, provinsi D','alamat14, provinsi A','alamat15, provinsi C'),
				   'alamat_antorz' => $responseCheckEmail,
                   'email'     => $email ,
                   /*'paketz' => array(
						    array("label"=>"HaloKick", "info"=>"Halo MyPlan", "net"=>"1,5", "netmail"=>"500", 
							"callCUG"=>"1000", "callAll"=>"60", "SMSCUG"=>"1000", "SMSAll"=>"60")   ,
							
							array("label"=>"HaloPunch", "info"=>"Halo MyDream", "net"=>"1,5", "netmail"=>"500", 
							"callCUG"=>"1000", "callAll"=>"60", "SMSCUG"=>"1000", "SMSAll"=>"60")   ,
							
							array("label"=>"HaloBdg", "info"=>"Halo Bdg", "net"=>"1,5", "netmail"=>"500", 
							"callCUG"=>"1000", "callAll"=>"60", "SMSCUG"=>"1000", "SMSAll"=>"60")
						)*/
                   
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
			echo "<script>alert('Please fill the Email field.');</script>";
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
		
		try{
			if(!$this->in_array_r($theEmail, $allEmail)){
				$Token = substr(uniqid(), 7);
				$insertEmail = "Insert intO email_token (email,token,update_time) values (?,?,now())";
				$this->db->query($insertEmail,array($theEmail,$Token));
			}else  {
				$Token = substr(uniqid(), 7);
				$updateToken = "UPDATE email_token SET token = ? , update_time=now() WHERE email = ? ";
				$this->db->query($updateToken,array($Token,$theEmail));}
		}
		catch (Exception $e) {echo 'Caught exception: ',  $e->getMessage();}
		//$this->sendToken($theEmail,$Token);	UnComment when deployed
	}
	
	function in_array_r($needle, $haystack, $strict = false) {
		foreach ($haystack as $item) {
			if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
				return true;
			}
		}
		return false;
	}
	
	public function sendToken($theEmail,$Token)
	{
		/*$to = $theEmail;
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
		var_dump($result);*/
		#http://10.54.22.218:8091/sendEmail/submit?to=[to]&from=[from]&cc=[cc]&subject=[subject]&message=[message]
		#http://10.54.22.218:8091/sendEmail?to=afdhal_b_anugrah@telkomsel.co.id&title=INI_SUBJECT_LO&text=INI-MESSAGE-LO
		try{
		$ip = API_EMAIL_CLAUDIA;
		$to = $theEmail;
		$from = "noreply.EAAC@telkomsel.co.id";
		$cc = "";
		$subject = "TOKEN EMAIL";
		$message = sprintf(MSG_TOKEN,$theEmail,$Token);

		$API = urlencode(sprintf($ip,$to,$from,$cc,$subject,$message));
		$APIend = file_get_contents($API);}
		catch (Exception $e) {echo 'Caught exception: ',  $e->getMessage();}

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
		$trx_ID = "EA".time().substr(uniqid(mt_rand()),1,9);
        $this->session->set_userdata(array('trx_id' => $trx_ID));
		$body=sprintf(BODY_SRM_CHECK_EMAIL,$email);
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
		    	$Final = array();	$dig = array();
		    	# INSERT API_LOG
				$respDom = "STATUS = %s | DESC = %s | TotalListAlamat = %s";$respDom = sprintf($respDom,$errCode,$errMsg,$totalRow);
		    	$insertLog = "Insert intO api_log (trx_id,email,msisdn,request,response,exec_time,api_name) values (?,?,?,?,?,now(),?)";
				$req = API_SRM_CHECK_EMAIL;
				$this->db->query($insertLog,array($trx_ID,$email,"NA",$req,$respDom,"API_CHECK_EMAIL"));

				// Normalisasi Array
				foreach($headlines as $normal){
					$dig['account_id'] = (isset($normal['v1:account_id'])) ? $normal['v1:account_id'] :  '';
					$dig['account_name'] = (isset($normal['v1:account_name'])) ? $normal['v1:account_name'] :  '';
					$dig['domain_name'] = (isset($normal['v1:domain_name'])) ? $normal['v1:domain_name'] :  '';
					$dig['address'] = (isset($normal['v1:address'])) ? $normal['v1:address'] :  '';
					$dig['region'] = (isset($normal['v1:region'])) ? $normal['v1:region'] :  '';
					$dig['office'] = (isset($normal['v1:office'])) ? $normal['v1:office'] :  '';
					$Final[] = $dig;
				}
				//echo "<pre>";print_r($Final);die();
		    	return $Final;//foreach($headlines as $headline) {echo $headline['v1:account_id		    
			}
		}
		else
		{echo "<script>alert('Your Coorporate are not Valid');document.location='".base_url()."'</script>";/*return $headlines = array('NO RESPONSE FROM SERVER');echo "GAGAL";*/}



    }

    public function API_Check_Pesanan()
	{
		$TRX = $this->input->post('TRXku');
		$body=sprintf(BODY_SRM_CHECK_PESANAN,$TRX);
		$respGet = $this->API($body,API_SRM_CHECK_PESANAN);
		$objGetEmAll = new DOMDocument();
        $objGetEmAll->loadXML($respGet);

        $errCode = $objGetEmAll->getElementsByTagName("error_code")->item(0)->nodeValue;
        $errMsg = $objGetEmAll->getElementsByTagName("error_msg")->item(0)->nodeValue;
        if($errCode == '0000' && $errMsg == 'Success')
        {
        	$respReqId = $objGetEmAll->getElementsByTagName("request_id")->item(0)->nodeValue;
        	$respName = $objGetEmAll->getElementsByTagName("name")->item(0)->nodeValue;
        	$respEmail = $objGetEmAll->getElementsByTagName("email")->item(0)->nodeValue;
        	$respAccId = $objGetEmAll->getElementsByTagName("account_id")->item(0)->nodeValue;
        	$respAccName = $objGetEmAll->getElementsByTagName("account_name")->item(0)->nodeValue;
        	$respSTATUS = $objGetEmAll->getElementsByTagName("status")->item(0)->nodeValue;
        	$responze = array($respReqId,$respName,$respEmail,$respAccName,$respSTATUS);
        	echo json_encode($responze);
        }else { echo "Error";}
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

	function my_error_handler($error_no, $error_msg)
	{
	    echo "Opps, something went wrong:"."<br>";
	    echo "Error number: [$error_no]"."<br>";
	    echo "Error Description: [$error_msg]";
	}
}
