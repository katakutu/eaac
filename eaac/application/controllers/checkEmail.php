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
		$body=sprintf(BODY_SRM_CHECK_EMAIL,$email,$trx_ID);
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
		    //echo "<pre>";print_r($headlines);echo "<pre>";die();
		    if(!empty($headlines)) 
		    {
		    	$Final = array();	$dig = array();
		    	# INSERT API_LOG
				$respDom = "STATUS = %s | DESC = %s | TotalListAlamat = %s";$respDom = sprintf($respDom,$errCode,$errMsg,$totalRow);
		    	$insertLog = "Insert intO api_log (trx_id,email,msisdn,request,response,exec_time,api_name) values (?,?,?,?,?,now(),?)";
				$req = API_SRM_CHECK_EMAIL;
				$this->db->query($insertLog,array($trx_ID,$email,"NA",$req,$respDom,"API_CHECK_EMAIL"));

				$headlines = array(
				array(
				'v1:account_id'=>'123','v1:account_name'=>'asd','v1:domain_name'=>'domain_blabla','v1:address'=>'address_zxc','v1:region'=>'region_zxc','v1:office'=>
				array(
						array(
							"office_id"=> "23788",
							"office_name"=> "BANK MANDIRI array(Jl Kolonel Yos Sudarso)",
							"office_address"=> "Jl Kolonel Yos Sudarso, MEDAN BARAT, KOTA MEDAN",
							"office_city"=> "Kota Medan",
							"office_province"=> "SUMATERA UTARA",
							"office_region"=> "SUMBAGUT"
						),
						array(
							"office_id"=> "23789",
							"office_name"=> "BANK MANDIRI array(Jl Jalan Raden Saleh)",
							"office_address"=> "Jl Jalan Raden Saleh, MEDAN BARAT, KOTA MEDAN",
							"office_city"=> "Kota Medan",
							"office_province"=> "SUMATERA UTARA",
							"office_region"=> "SUMBAGUT"
						),
						array(
							"office_id"=> "23790",
							"office_name"=> "BANK MANDIRI array(Jl Krakatau Ujung)",
							"office_address"=> "Jl Krakatau Ujung, MEDAN DELI, KOTA MEDAN",
							"office_city"=> "Kota Medan",
							"office_province"=> "SUMATERA UTARA",
							"office_region"=> "SUMBAGUT"
						),
						array(
							"office_id"=> "23791",
							"office_name"=> "BANK MANDIRI array(Jl Jend AH Nasution)",
							"office_address"=> "Jl Jend AH Nasution, MEDAN JOHOR, KOTA MEDAN",
							"office_city"=> "Kota Medan",
							"office_province"=> "SUMATERA UTARA",
							"office_region"=> "SUMBAGUT"
						),
						array(
							"office_id"=> "23792",
							"office_name"=> "BANK MANDIRI array(Jl Cirebon)",
							"office_address"=> "Jl Cirebon, MEDAN KOTA, KOTA MEDAN",
							"office_city"=> "Kota Medan",
							"office_province"=> "SUMATERA UTARA",
							"office_region"=> "SUMBAGUT"
						),
						array(
							"office_id"=> "23793",
							"office_name"=> "BANK MANDIRI array(Jl Marelan)",
							"office_address"=> "Jl Marelan, MEDAN MARELAN, KOTA MEDAN",
							"office_city"=> "Kota Medan",
							"office_province"=> "SUMATERA UTARA",
							"office_region"=> "SUMBAGUT"
						),
						array(
							"office_id"=> "23795",
							"office_name"=> "BANK MANDIRI array(Jl Gatot Subroto Kampung Lalang)",
							"office_address"=> "Jl Gatot Subroto Kampung Lalang, MEDAN SUNGGAL, KOTA MEDAN",
							"office_city"=> "Kota Medan",
							"office_province"=> "SUMATERA UTARA",
							"office_region"=> "SUMBAGUT"
						),
						array(
							"office_id"=> "23796",
							"office_name"=> "BANK MANDIRI array(Jl Perintis Kemerdekaan)",
							"office_address"=> "Jl Perintis Kemerdekaan, MEDAN TIMUR, KOTA MEDAN",
							"office_city"=> "Kota Medan",
							"office_province"=> "SUMATERA UTARA",
							"office_region"=> "SUMBAGUT"
						),
						array(
							"office_id"=> "23950",
							"office_name"=> "BANK MANDIRI array(Jl. Setia Budi No.24)",
							"office_address"=> "Jl. Setia Budi No.24, Tj. Rejo, Medan Sunggal, Kota Medan, Sumatera Utara 20154, Indonesia",
							"office_city"=> "Kota Medan",
							"office_province"=> "SUMATERA UTARA",
							"office_region"=> "SUMBAGUT"
						),
						array(
							"office_id"=> "21153",
							"office_name"=> "Mandiri array(Jl. Kapten A. Rivai)",
							"office_address"=> "Jl. Kapten A. Rivai No. 100 B Palembang, 30135",
							"office_city"=> "Kota Palembang",
							"office_province"=> "SUMATERA SELATAN",
							"office_region"=> "SUMBAGSEL"
						),
						array(
							"office_id"=> "23670",
							"office_name"=> "BANK MANDIRI array(Jl Brigjen Pol Abdullah Kadir)",
							"office_address"=> "Jl Brigjen Pol Abdullah Kadir, ILIR TIMUR II, KOTA PALEMBANG",
							"office_city"=> "Kota Palembang",
							"office_province"=> "SUMATERA SELATAN",
							"office_region"=> "SUMBAGSEL"
						),
						array(
							"office_id"=> "23842",
							"office_name"=> "BANK MANDIRI array(Jl. Piere Tendean)",
							"office_address"=> "Jl. Piere Tendean, Sario Tumpaan, Sario, Kota Manado, Sulawesi Utara, Indonesia",
							"office_city"=> "Kota Manado",
							"office_province"=> "SULAWESI UTARA",
							"office_region"=> "SULAWESI"
						),
						array(
							"office_id"=> "23845",
							"office_name"=> "BANK MANDIRI array(Sario Tumpaan)",
							"office_address"=> "Jl. Piere Tendean, Sario Tumpaan, Sario, Kota Manado, Sulawesi Utara, Indonesia",
							"office_city"=> "Kota Manado",
							"office_province"=> "SULAWESI UTARA",
							"office_region"=> "SULAWESI"
						),
						array(
							"office_id"=> "23914",
							"office_name"=> "BANK MANDIRI array(Jl Kapt P Tendean)",
							"office_address"=> "Jl Kapt P Tendean, WENANG, MANADO",
							"office_city"=> "Kota Manado",
							"office_province"=> "SULAWESI UTARA",
							"office_region"=> "SULAWESI"
						),
						array(
							"office_id"=> "21151",
							"office_name"=> "Mandiri array(Jl. R.A. Kartini No. 12-14)",
							"office_address"=> "Jl. R.A. Kartini No. 12-14 Makassar, 70111",
							"office_city"=> "Kota Makassar",
							"office_province"=> "SULAWESI SELATAN",
							"office_region"=> "SULAWESI"
						),
						array(
							"office_id"=> "23512",
							"office_name"=> "BANK MANDIRI array(Jl. Boulevard No.2)",
							"office_address"=> "Jl. Boulevard No.2, Masale, Panakkukang, Kota Makassar, Sulawesi Selatan 90231, Indonesia",
							"office_city"=> "Kota Makassar",
							"office_province"=> "SULAWESI SELATAN",
							"office_region"=> "SULAWESI"
						),
						array(
							"office_id"=> "23513",
							"office_name"=> "BANK MANDIRI array(Jl. Toddopuli Raya Timur No.7)",
							"office_address"=> "Jl. Toddopuli Raya Timur No.7, Borong, Manggala, Kota Makassar, Sulawesi Selatan 90222, Indonesia",
							"office_city"=> "Kota Makassar",
							"office_province"=> "SULAWESI SELATAN",
							"office_region"=> "SULAWESI"
						),
						array(
							"office_id"=> "23518",
							"office_name"=> "BANK MANDIRI array(Jl. Ps. Daya Baru No.104A)",
							"office_address"=> "Jl. Ps. Daya Baru No.104A, Daya, Biring Kanaya, Kota Makassar, Sulawesi Selatan 90241, Indonesia",
							"office_city"=> "Kota Makassar",
							"office_province"=> "SULAWESI SELATAN",
							"office_region"=> "SULAWESI"
						),
						array(
							"office_id"=> "23553",
							"office_name"=> "BANK MANDIRI array(Jl. Perintis Kemerdekaan No.26)",
							"office_address"=> "Jl. Perintis Kemerdekaan No.26, Paccerakkang, Biring Kanaya, Kota Makassar, Sulawesi Selatan 90245, Indonesia",
							"office_city"=> "Kota Makassar",
							"office_province"=> "SULAWESI SELATAN",
							"office_region"=> "SULAWESI"
						),
						array(
							"office_id"=> "23563",
							"office_name"=> "BANK MANDIRI array(Jl. Andalas No.164)",
							"office_address"=> "Jl. Andalas No.164, Parang Layang, Bontoala, Kota Makassar, Sulawesi Selatan 90155, Indonesia",
							"office_city"=> "Kota Makassar",
							"office_province"=> "SULAWESI SELATAN",
							"office_region"=> "SULAWESI"
						),
						array(
							"office_id"=> "23782",
							"office_name"=> "BANK MANDIRI array(Jl Veteran Utara)",
							"office_address"=> "Jl Veteran Utara MAKASSAR, KOTA MAKASSAR",
							"office_city"=> "Kota Makassar",
							"office_province"=> "SULAWESI SELATAN",
							"office_region"=> "SULAWESI"
						),
						array(
							"office_id"=> "23806",
							"office_name"=> "BANK MANDIRI array(Jl A P Pettarani No 18F)",
							"office_address"=> "Jl A P Pettarani No 18F, PANAKKUKANG, KOTA MAKASSAR",
							"office_city"=> "Kota Makassar",
							"office_province"=> "SULAWESI SELATAN",
							"office_region"=> "SULAWESI"
						),
						array(
							"office_id"=> "23874",
							"office_name"=> "BANK MANDIRI array(Jl DG Tata Raya)",
							"office_address"=> "Jl DG Tata Raya, TAMALATE, KOTA MAKASSAR",
							"office_city"=> "Kota Makassar",
							"office_province"=> "SULAWESI SELATAN",
							"office_region"=> "SULAWESI"
						),
						array(
							"office_id"=> "23875",
							"office_name"=> "BANK MANDIRI array(Jl Landak Baru)",
							"office_address"=> "Jl Landak Baru, TAMALATE, KOTA MAKASSAR",
							"office_city"=> "Kota Makassar",
							"office_province"=> "SULAWESI SELATAN",
							"office_region"=> "SULAWESI"
						),
						array(
							"office_id"=> "23909",
							"office_name"=> "BANK MANDIRI array(Jl RA Kartini)",
							"office_address"=> "Jl RA Kartini, UJUNG PANDANG, KOTA MAKASSAR",
							"office_city"=> "Kota Makassar",
							"office_province"=> "SULAWESI SELATAN",
							"office_region"=> "SULAWESI"
						),
						array(
							"office_id"=> "23910",
							"office_name"=> "BANK MANDIRI array(Jl Arief Rate)",
							"office_address"=> "Jl Arief Rate, UJUNG PANDANG, KOTA MAKASSAR",
							"office_city"=> "Kota Makassar",
							"office_province"=> "SULAWESI SELATAN",
							"office_region"=> "SULAWESI"
						),
						array(
							"office_id"=> "23947",
							"office_name"=> "BANK MANDIRI array(Jl Dr Samratulangi)",
							"office_address"=> "Jl Dr Samratulangi, MAMAJANG, KOTA MAKASSAR",
							"office_city"=> "Kota Makassar",
							"office_province"=> "SULAWESI SELATAN",
							"office_region"=> "SULAWESI"
						),
						array(
							"office_id"=> "23973",
							"office_name"=> "BANK MANDIRI array(Ruko Jasper 2)",
							"office_address"=> "Ruko Jasper 2, Panakkukang, Kota Makassar, Sulawesi Selatan, Indonesia",
							"office_city"=> "Kota Makassar",
							"office_province"=> "SULAWESI SELATAN",
							"office_region"=> "SULAWESI"
						),
						array(
							"office_id"=> "21141",
							"office_name"=> "Mandiri array(Jl. Dr. Sutomo No. 1)",
							"office_address"=> "Jl. Dr. Sutomo No. 1 Jayapura, 99111",
							"office_city"=> "Kabupaten Yalimo",
							"office_province"=> "PAPUA",
							"office_region"=> "PUMA"
						),
						array(
							"office_id"=> "21150",
							"office_name"=> "Mandiri array(Jl. Dr. Sutomo)",
							"office_address"=> "Jl. Dr. Sutomo No. 1 Jayapura, 99111",
							"office_city"=> "Kota Jayapura",
							"office_province"=> "PAPUA",
							"office_region"=> "PUMA"
						),
						array(
							"office_id"=> "23530",
							"office_name"=> "BANK MANDIRI array(Jl. Raya Abepura)",
							"office_address"=> "Jl. Raya Abepura, Wai Mhorock, Abepura, Kota Jayapura, Papua 99225, Indonesia",
							"office_city"=> "Kota Jayapura",
							"office_province"=> "PAPUA",
							"office_region"=> "PUMA"
						),
						array(
							"office_id"=> "23531",
							"office_name"=> "BANK MANDIRI array(Jl. Filadelfia)",
							"office_address"=> "Jl. Filadelfia, Asano, Abepura, Kota Jayapura, Papua 99351, Indonesia",
							"office_city"=> "Kota Jayapura",
							"office_province"=> "PAPUA",
							"office_region"=> "PUMA"
						),
						array(
							"office_id"=> "23669",
							"office_name"=> "BANK MANDIRI array(Jl. Kambolker Perumnas III)",
							"office_address"=> "Jl. Kambolker Perumnas III, Yabansai, Heram, Kota Jayapura, Papua 99224, Indonesia",
							"office_city"=> "Kota Jayapura",
							"office_province"=> "PAPUA",
							"office_region"=> "PUMA"
						),
						array(
							"office_id"=> "23681",
							"office_name"=> "BANK MANDIRI array(Jl Perikanan Hamadi)",
							"office_address"=> "Jl Perikanan Hamadi, JAYAPURA SELATAN, JAYAPURA",
							"office_city"=> "Kota Jayapura",
							"office_province"=> "PAPUA",
							"office_region"=> "PUMA"
						),
						array(
							"office_id"=> "23682",
							"office_name"=> "BANK MANDIRI array(Jl Bhayangkara 1-7)",
							"office_address"=> "Jl Bhayangkara 1-7, JAYAPURA UTARA, JAYAPURA",
							"office_city"=> "Kota Jayapura",
							"office_province"=> "PAPUA",
							"office_region"=> "PUMA"
						),
						array(
							"office_id"=> "23688",
							"office_name"=> "BANK MANDIRI array(Jl Jend A Yani)",
							"office_address"=> "Jl Jend A Yani, JAYAPURA UTARA, JAYAPURA",
							"office_city"=> "Kota Jayapura",
							"office_province"=> "PAPUA",
							"office_region"=> "PUMA"
						),
						array(
							"office_id"=> "23566",
							"office_name"=> "BANK MANDIRI array(Jl. A. A Gede Ngurah No.48)",
							"office_address"=> "Jl. A. A Gede Ngurah No.48, Cilinaya, Cakranegara, Kota Mataram, Nusa Tenggara Bar. 83239, Indonesia",
							"office_city"=> "Kota Mataram",
							"office_province"=> "NUSA TENGGARA BARAT",
							"office_region"=> "BALI NUSRA"
						),
						array(
							"office_id"=> "23568",
							"office_name"=> "BANK MANDIRI array(Jl. Pejanggik No.67)",
							"office_address"=> "Jl. Pejanggik No.67, Cakranegara Bar., Cakranegara, Kota Mataram, Nusa Tenggara Bar. 83239, Indonesia",
							"office_city"=> "Kota Mataram",
							"office_province"=> "NUSA TENGGARA BARAT",
							"office_region"=> "BALI NUSRA"
						),
						array(
							"office_id"=> "23529",
							"office_name"=> "BANK MANDIRI array(Jl. Diponegoro No.31f)",
							"office_address"=> "Jl. Diponegoro No.31f, Sumur Batu, Tlk. Betung Utara, Kota Bandar Lampung, Lampung 35214, Indonesia",
							"office_city"=> "Kota Bandar Lampung",
							"office_province"=> "LAMPUNG",
							"office_region"=> "SUMBAGSEL"
						),
						array(
							"office_id"=> "23690",
							"office_name"=> "BANK MANDIRI array(Jl Raden Intan)",
							"office_address"=> "Jl Raden Intan, TANJUNG KARANG PUSAT, KOTA BANDAR LAMPUNG",
							"office_city"=> "Kota Bandar Lampung",
							"office_province"=> "LAMPUNG",
							"office_region"=> "SUMBAGSEL"
						),
						array(
							"office_id"=> "23691",
							"office_name"=> "BANK MANDIRI array(Jl Laks Malahayati)",
							"office_address"=> "Jl Laks Malahayati, TELUK BETUNG SELATAN, KOTA BANDAR LAMPUNG",
							"office_city"=> "Kota Bandar Lampung",
							"office_province"=> "LAMPUNG",
							"office_region"=> "SUMBAGSEL"
						),
						array(
							"office_id"=> "23692",
							"office_name"=> "BANK MANDIRI array(Jl Ki Maja)",
							"office_address"=> "Jl Ki Maja, KEDATON, KOTA BANDAR LAMPUNG",
							"office_city"=> "Kota Bandar Lampung",
							"office_province"=> "LAMPUNG",
							"office_region"=> "SUMBAGSEL"
						),
						array(
							"office_id"=> "23725",
							"office_name"=> "BANK MANDIRI array(Jl Teuku Umar)",
							"office_address"=> "Jl Teuku Umar, KEDATON, KOTA BANDAR LAMPUNG",
							"office_city"=> "Kota Bandar Lampung",
							"office_province"=> "LAMPUNG",
							"office_region"=> "SUMBAGSEL"
						),
						array(
							"office_id"=> "23838",
							"office_name"=> "BANK MANDIRI array(Jl Indra Bangsawan)",
							"office_address"=> "Jl Indra Bangsawan, RAJABASA, KOTA BANDAR LAMPUNG",
							"office_city"=> "Kota Bandar Lampung",
							"office_province"=> "LAMPUNG",
							"office_region"=> "SUMBAGSEL"
						),
						array(
							"office_id"=> "23883",
							"office_name"=> "BANK MANDIRI array(Jl Bukit Tinggi)",
							"office_address"=> "Jl Bukit Tinggi, TANJUNG KARANG PUSAT, KOTA BANDAR LAMPUNG",
							"office_city"=> "Kota Bandar Lampung",
							"office_province"=> "LAMPUNG",
							"office_region"=> "SUMBAGSEL"
						),
						array(
							"office_id"=> "23695",
							"office_name"=> "BANK MANDIRI array(Jl. Imam Bonjol-Nagoya)",
							"office_address"=> "Jl. Imam Bonjol-Nagoya, Lubuk Baja Kota, Lubuk Baja, Kota Batam, Kepulauan Riau 29444, Indonesia",
							"office_city"=> "Kota Batam",
							"office_province"=> "KEPULAUAN RIAU",
							"office_region"=> "SUMBAGTENG"
						),
						array(
							"office_id"=> "23535",
							"office_name"=> "BANK MANDIRI array(Jl. Jenderal Ahmad Yani No.19)",
							"office_address"=> "Jl. Jenderal Ahmad Yani No.19, Klandasan Ilir, Balikpapan Sel., Kota Balikpapan, Kalimantan Timur 76113, Indonesia",
							"office_city"=> "Kota Balikpapan",
							"office_province"=> "KALIMANTAN TIMUR",
							"office_region"=> "KALIMANTAN"
						),
						array(
							"office_id"=> "23567",
							"office_name"=> "BANK MANDIRI array(Jl. Jenderal Ahmad Yani No.22)",
							"office_address"=> "Jl. Jenderal Ahmad Yani No.22, Gunungsari Ilir, Balikpapan Tengah, Kota Balikpapan, Kalimantan Timur 76113, Indonesia",
							"office_city"=> "Kota Balikpapan",
							"office_province"=> "KALIMANTAN TIMUR",
							"office_region"=> "KALIMANTAN"
						),
						array(
							"office_id"=> "21148",
							"office_name"=> "Mandiri array(Jl. Lambung Mangkurat)",
							"office_address"=> "Jl. Lambung Mangkurat No. 3 Banjarmasin, 70111",
							"office_city"=> "Kota Banjarmasin",
							"office_province"=> "KALIMANTAN SELATAN",
							"office_region"=> "KALIMANTAN"
						),
						array(
							"office_id"=> "23540",
							"office_name"=> "BANK MANDIRI array(Jl. Lambung Mangkurat No.5)",
							"office_address"=> "Jl. Lambung Mangkurat No.5, Kertak Baru Ulu, Banjarmasin Tengah, Kota Banjarmasin, Provinsi Kalimantan Sel. 70231, Indonesia",
							"office_city"=> "Kota Banjarmasin",
							"office_province"=> "KALIMANTAN SELATAN",
							"office_region"=> "KALIMANTAN"
						),
						array(
							"office_id"=> "23687",
							"office_name"=> "BANK MANDIRI array(Jl. Lambung Mangkurat No.32)",
							"office_address"=> "Jl. Lambung Mangkurat No.32, Kertak Baru Ilir, Banjarmasin Tengah, Kota Banjarmasin, Provinsi Kalimantan Sel. 70111, Indonesia",
							"office_city"=> "Kota Banjarmasin",
							"office_province"=> "KALIMANTAN SELATAN",
							"office_region"=> "KALIMANTAN"
						),
						array(
							"office_id"=> "23693",
							"office_name"=> "BANK MANDIRI array(Jl. Ahmad Yani No.6)",
							"office_address"=> "Jl. Ahmad Yani No.6, Sungai Baru, Banjarmasin Tengah, Kota Banjarmasin, Provinsi Kalimantan Sel. 70122, Indonesia",
							"office_city"=> "Kota Banjarmasin",
							"office_province"=> "KALIMANTAN SELATAN",
							"office_region"=> "KALIMANTAN"
						),
						array(
							"office_id"=> "23694",
							"office_name"=> "BANK MANDIRI array(Jl. Lambung Mangkurat No.10)",
							"office_address"=> "Jl. Lambung Mangkurat No.10, Kertak Baru Ulu, Banjarmasin Tengah, Kota Banjarmasin, Provinsi Kalimantan Sel. 70123, Indonesia",
							"office_city"=> "Kota Banjarmasin",
							"office_province"=> "KALIMANTAN SELATAN",
							"office_region"=> "KALIMANTAN"
						),
						array(
							"office_id"=> "23697",
							"office_name"=> "BANK MANDIRI array(Jl Brigjen H Hasan Basri)",
							"office_address"=> "Jl Brigjen H Hasan Basri, BANJARMASIN UTARA, KOTA BANJARMASIN",
							"office_city"=> "Kota Banjarmasin",
							"office_province"=> "KALIMANTAN SELATAN",
							"office_region"=> "KALIMANTAN"
						),
						array(
							"office_id"=> "21155",
							"office_name"=> "Mandiri array(Jl. Basuki Rahmat)",
							"office_address"=> "Jl. Basuki Rahmat No. 129-137 Surabaya, 60271",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23462",
							"office_name"=> "BANK MANDIRI array(Jl. Semarang No.71B)",
							"office_address"=> "Jl. Semarang No.71B, Gundih, Bubutan, Kota SBY, Jawa Timur 60172, Indonesia",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23467",
							"office_name"=> "BANK MANDIRI array(Jl. Mayjen Sungkono No.143)",
							"office_address"=> "Jl. Mayjen Sungkono No.143, Gn. Sari, Dukuh Pakis, Kota SBY, Jawa Timur 60224, Indonesia",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23474",
							"office_name"=> "BANK MANDIRI array(Jl. Airlangga No.39,)",
							"office_address"=> "Jl. Airlangga No.39, Airlangga, Gubeng, Kota SBY, Jawa Timur 60286, Indonesia",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23475",
							"office_name"=> "BANK MANDIRI array(Jl. Prof. Dr. Mustopo No.217)",
							"office_address"=> "Jl. Prof. Dr. Mustopo No.217, Mojo, Gubeng, Kota SBY, Jawa Timur 60285, Indonesia",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23481",
							"office_name"=> "BANK MANDIRI array(Jl. Kedung Cowek No.377)",
							"office_address"=> "Jl. Kedung Cowek No.377, Tanah Kali Kedinding, Kenjeran, Kota SBY, Jawa Timur 60129, Indonesia",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23484",
							"office_name"=> "BANK MANDIRI array(Jl. Indrapura No.43)",
							"office_address"=> "Jl. Indrapura No.43, Kemayoran, Krembangan, Kota SBY, Jawa Timur 60176, Indonesia",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23496",
							"office_name"=> "BANK MANDIRI array(Jl. Kedung Doro No.84-F)",
							"office_address"=> "Jl. Kedung Doro No.84-F, Sawahan, Kec. Sawahan, Kota SBY, Jawa Timur 60251, Indonesia",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23497",
							"office_name"=> "BANK MANDIRI array(Jl. Kapasan No.167-184)",
							"office_address"=> "Jl. Kapasan No.167-184, Kapasan, Simokerto, Kota SBY, Jawa Timur 60141, Indonesia",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23498",
							"office_name"=> "BANK MANDIRI array(Jl. Kupang Jaya No.1-5)",
							"office_address"=> "Jl. Kupang Jaya No.1-5, Sonokwijenan, Suko Manunggal, Kota SBY, Jawa Timur 60189, Indonesia",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23499",
							"office_name"=> "BANK MANDIRI array(Jl. Klampis Jaya No.56)",
							"office_address"=> "Jl. Klampis Jaya No.56, Klampis Ngasem, Sukolilo, Kota SBY, Jawa Timur 60117, Indonesia",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23502",
							"office_name"=> "BANK MANDIRI array(Jl. Prof. Dr. Mustopo No.23)",
							"office_address"=> "Jl. Prof. Dr. Mustopo No.23, Pacar Keling, Tambaksari, Kota SBY, Jawa Timur 60131, Indonesia",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23503",
							"office_name"=> "BANK MANDIRI array(Jl. Rangkah II No.36)",
							"office_address"=> "Jl. Rangkah II No.36, Rangkah, Tambaksari, Kota SBY, Jawa Timur 60135, Indonesia",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23508",
							"office_name"=> "BANK MANDIRI array(Jl. Darmo Indah Timur Blok SS No.7)",
							"office_address"=> "Jl. Darmo Indah Timur Blok SS No.7, Tandes Kidul, Tandes, Kota SBY, Jawa Timur 60187, Indonesia",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23511",
							"office_name"=> "BANK MANDIRI array(Jl. Wiyung No.328)",
							"office_address"=> "Jl. Wiyung No.328, Wiyung, Kota SBY, Jawa Timur 60228, Indonesia",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23565",
							"office_name"=> "BANK MANDIRI array(Jl. Pahlawan No.34-36)",
							"office_address"=> "Jl. Pahlawan No.34-36, Alun-alun Contong, Bubutan, Kota SBY, Jawa Timur 60174, Indonesia",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23598",
							"office_name"=> "BANK MANDIRI array(Jl. Raya Sengkaling No.251-255)",
							"office_address"=> "Jl. Raya Sengkaling No.251-255, Mulyoagung, Dau, Malang, Jawa Timur 65151, Indonesia",
							"office_city"=> "Kabupaten Malang",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23661",
							"office_name"=> "BANK MANDIRI array(Jl. Ketintang No.73B)",
							"office_address"=> "Jl. Ketintang No.73B, Wonokromo, Kota SBY, Jawa Timur 60231, Indonesia",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23662",
							"office_name"=> "BANK MANDIRI array(Jl. Pemuda No.27)",
							"office_address"=> "Jl. Pemuda No.27, Embong Kaliasin, Genteng, Kota SBY, Jawa Timur 60271, Indonesia",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23664",
							"office_name"=> "BANK MANDIRI array(Jl. Irian Barat No.1)",
							"office_address"=> "Jl. Irian Barat No.1, Gubeng, Kota SBY, Jawa Timur 60281, Indonesia",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23665",
							"office_name"=> "BANK MANDIRI array(Jl. Pucang Anom Tim. No.16-18)",
							"office_address"=> "Jl. Pucang Anom Tim. No.16-18, Kertajaya, Gubeng, Kota SBY, Jawa Timur 60282, Indonesia",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23666",
							"office_name"=> "BANK MANDIRI array(Jl. Rungkut Industri Raya No.10)",
							"office_address"=> "Jl. Rungkut Industri Raya No.10, Kota SBY, Jawa Timur, Indonesia",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23696",
							"office_name"=> "BANK MANDIRI array(Jl Gajah Mada Ruko)",
							"office_address"=> "Jl Gajah Mada Ruko Rambipuji Kav 3, KALIWATES, JEMBER",
							"office_city"=> "Kabupaten Jember",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23739",
							"office_name"=> "BANK MANDIRI array(Jl Jend Basuki Rahmat)",
							"office_address"=> "Jl Jend Basuki Rahmat, KLOJEN, KOTA MALANG",
							"office_city"=> "Kota Malang",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23746",
							"office_name"=> "BANK MANDIRI array(Jl Jend Katamso)",
							"office_address"=> "Jl Jend Katamso, KOTA KEDIRI, KOTA KEDIRI",
							"office_city"=> "Kota Kediri",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23747",
							"office_name"=> "BANK MANDIRI array(Jl Samratulangi)",
							"office_address"=> "Jl Samratulangi, KOTA KEDIRI, KOTA KEDIRI",
							"office_city"=> "Kota Kediri",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23748",
							"office_name"=> "BANK MANDIRI array(Jl Hayam Wuruk)",
							"office_address"=> "Jl Hayam Wuruk, KOTA KEDIRI, KOTA KEDIRI",
							"office_city"=> "Kota Kediri",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23750",
							"office_name"=> "BANK MANDIRI array(Jl Rajawali)",
							"office_address"=> "Jl Rajawali, KREMBANGAN, KOTA SURABAYA",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23751",
							"office_name"=> "BANK MANDIRI array(Jl. Rajawali No.7)",
							"office_address"=> "Jl. Rajawali No.7, Krembangan Sel., Krembangan, Kota SBY, Jawa Timur 60175, Indonesia",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23752",
							"office_name"=> "BANK MANDIRI array(Jl. Rajawali)",
							"office_address"=> "Jl. Rajawali, Krembangan Sel., Krembangan, Kota SBY, Jawa Timur 60175, Indonesia",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23799",
							"office_name"=> "BANK MANDIRI array(Jl Kenjeran)",
							"office_address"=> "Jl Kenjeran, MULYOREJO, KOTA SURABAYA",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23800",
							"office_name"=> "BANK MANDIRI array(Jl Mulyosari)",
							"office_address"=> "Jl Mulyosari, MULYOREJO, KOTA SURABAYA",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23893",
							"office_name"=> "BANK MANDIRI array(Jl Darmo Raya)",
							"office_address"=> "Jl Darmo Raya, TEGALSARI, KOTA SURABAYA",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23991",
							"office_name"=> "BANK MANDIRI array(Jl. Kapas Krampung No.47-A)",
							"office_address"=> "Jl. Kapas Krampung No.47-A, Rangkah, Tambaksari, Kota SBY, Jawa Timur 60135, Indonesia",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23996",
							"office_name"=> "BANK MANDIRI array(Jl. Siwalankerto Utara No.50)",
							"office_address"=> "Jl. Siwalankerto Utara No.50, Siwalankerto, Wonocolo, Kota SBY, Jawa Timur 60236, Indonesia",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "23997",
							"office_name"=> "BANK MANDIRI array(Jl. Jemur Andayani No.1-2)",
							"office_address"=> "Jl. Jemur Andayani No.1-2, Jemur Wonosari, Wonocolo, Kota SBY, Jawa Timur 60237, Indonesia",
							"office_city"=> "Kota Surabaya",
							"office_province"=> "JAWA TIMUR",
							"office_region"=> "JAWA TIMUR"
						),
						array(
							"office_id"=> "21154",
							"office_name"=> "Mandiri array(Jl. Pemuda)",
							"office_address"=> "Jl. Pemuda No. 73 Semarang, 50139",
							"office_city"=> "Kota Semarang",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23532",
							"office_name"=> "BANK MANDIRI array(Jl. Semarang - Yogyakarta No.18)",
							"office_address"=> "Jl. Semarang - Yogyakarta No.18, Kupang, Ambarawa, Semarang, Jawa Tengah 50612, Indonesia",
							"office_city"=> "Kabupaten Semarang",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23539",
							"office_name"=> "BANK MANDIRI array(Jl. Gintungan Utara)",
							"office_address"=> "Jl. Gintungan Utara, Jetis, Bandungan, Semarang, Jawa Tengah 50614, Indonesia",
							"office_city"=> "Kabupaten Semarang",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23541",
							"office_name"=> "BANK MANDIRI array(Jl. Sriwijaya Utara III No.5)",
							"office_address"=> "Jl. Sriwijaya Utara III No.5, Nusukan, Banjarsari, Kota Surakarta, Jawa Tengah 57135, Indonesia",
							"office_city"=> "Kota Surakarta",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23542",
							"office_name"=> "BANK MANDIRI array(Jl. Kapten Piere Tendean No.89)",
							"office_address"=> "Jl. Kapten Piere Tendean No.89, Nusukan, Banjarsari, Kota Surakarta, Jawa Tengah 57135, Indonesia",
							"office_city"=> "Kota Surakarta",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23544",
							"office_name"=> "BANK MANDIRI array(Jl. Setiabudi No.144)",
							"office_address"=> "Jl. Setiabudi No.144, Sumurboto, Banyumanik, Kota Semarang, Jawa Tengah 50263, Indonesia",
							"office_city"=> "Kota Semarang",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23552",
							"office_name"=> "BANK MANDIRI array(Jl. Semarang - Yogyakarta)",
							"office_address"=> "Jl. Semarang - Yogyakarta, Karangjati, Bergas, Semarang, Jawa Tengah 50552, Indonesia",
							"office_city"=> "Kabupaten Semarang",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23663",
							"office_name"=> "BANK MANDIRI array(Jl. Raya Tuban - Semarang)",
							"office_address"=> "Jl. Raya Tuban - Semarang, Terboyo Kulon, Genuk, Kota Semarang, Jawa Tengah 50111, Indonesia",
							"office_city"=> "Kota Semarang",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23683",
							"office_name"=> "BANK MANDIRI array(Jl Mandurorejo Kajen)",
							"office_address"=> "Jl Mandurorejo Kajen, KAJEN, PEKALONGAN",
							"office_city"=> "Kabupaten Pekalongan",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23686",
							"office_name"=> "BANK MANDIRI array(Jl Achmad Yani)",
							"office_address"=> "Jl Achmad Yani, KARTASURA, SUKOHARJO",
							"office_city"=> "Kabupaten Sukoharjo",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23689",
							"office_name"=> "BANK MANDIRI array(Jl Imam Bonjol)",
							"office_address"=> "Jl Imam Bonjol, PEKALONGAN BARAT, KOTA PEKALONGAN",
							"office_city"=> "Kota Pekalongan",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23698",
							"office_name"=> "BANK MANDIRI array(Jl Gatot Subroto)",
							"office_address"=> "Jl Gatot Subroto, SERENGAN, KOTA SURAKARTA",
							"office_city"=> "Kota Surakarta",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23755",
							"office_name"=> "BANK MANDIRI array(Jl Agus Salim)",
							"office_address"=> "Jl Agus Salim, LAWEYAN, KOTA SURAKARTA",
							"office_city"=> "Kota Surakarta",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23819",
							"office_name"=> "BANK MANDIRI array(Jl. Majapahit Nomer No.337)",
							"office_address"=> "Jl. Majapahit Nomer No.337, Gemah, Pedurungan, Kota Semarang, Jawa Tengah 50246, Indonesia",
							"office_city"=> "Kota Semarang",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23820",
							"office_name"=> "BANK MANDIRI array(Jl Brigjen Sudiarto)",
							"office_address"=> "Jl Brigjen Sudiarto, PEDURUNGAN, KOTA SEMARANG",
							"office_city"=> "Kota Semarang",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23821",
							"office_name"=> "BANK MANDIRI array(Jl Raya Haya Wuruk)",
							"office_address"=> "Jl Raya Haya Wuruk, PEKALONGAN BARAT, KOTA PEKALONGAN",
							"office_city"=> "Kota Pekalongan",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23822",
							"office_name"=> "BANK MANDIRI array(Jl Alun-Alun)",
							"office_address"=> "Jl Alun-Alun, PEKALONGAN TIMUR, KOTA PEKALONGAN",
							"office_city"=> "Kota Pekalongan",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23846",
							"office_name"=> "BANK MANDIRI array(Jl Pahlawan)",
							"office_address"=> "Jl Pahlawan, SEMARANG BARAT, KOTA SEMARANG",
							"office_city"=> "Kota Semarang",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23847",
							"office_name"=> "BANK MANDIRI array(Jl Mataram)",
							"office_address"=> "Jl Mataram, SEMARANG BARAT, KOTA SEMARANG",
							"office_city"=> "Kota Semarang",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23848",
							"office_name"=> "BANK MANDIRI array(Jl Sugiopranoto)",
							"office_address"=> "Jl Sugiopranoto, SEMARANG SELATAN, KOTA SEMARANG",
							"office_city"=> "Kota Semarang",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23849",
							"office_name"=> "BANK MANDIRI array(Jl Pandanaran)",
							"office_address"=> "Jl Pandanaran, SEMARANG SELATAN, KOTA SEMARANG",
							"office_city"=> "Kota Semarang",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23850",
							"office_name"=> "BANK MANDIRI array(Jl. Pemuda No.77)",
							"office_address"=> "Jl. Pemuda No.77, Pandansari, Semarang Tengah, Kota Semarang, Jawa Tengah 50132, Indonesia",
							"office_city"=> "Kota Semarang",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23851",
							"office_name"=> "BANK MANDIRI array(Pandansari)",
							"office_address"=> "Jl. Pemuda No.77, Pandansari, Semarang Tengah, Kota Semarang, Jawa Tengah 50132, Indonesia",
							"office_city"=> "Kota Semarang",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23852",
							"office_name"=> "BANK MANDIRI array(Jl Gajah Mada)",
							"office_address"=> "Jl Gajah Mada, SEMARANG TENGAH, KOTA SEMARANG",
							"office_city"=> "Kota Semarang",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23853",
							"office_name"=> "BANK MANDIRI array(Jl MT Haryono)",
							"office_address"=> "Jl MT Haryono, SEMARANG TENGAH, KOTA SEMARANG",
							"office_city"=> "Kota Semarang",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23854",
							"office_name"=> "BANK MANDIRI array(Jl Merak)",
							"office_address"=> "Jl Merak, SEMARANG UTARA, KOTA SEMARANG",
							"office_city"=> "Kota Semarang",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23872",
							"office_name"=> "BANK MANDIRI array(Jl Raya Suruh Karang)",
							"office_address"=> "Jl Raya Suruh Karang, SURUH, SEMARANG",
							"office_city"=> "Kabupaten Semarang",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23911",
							"office_name"=> "BANK MANDIRI array(Jl Raya Jendral Gatot Subroto)",
							"office_address"=> "Jl Raya Jendral Gatot Subroto, UNGARAN BARAT, SEMARANG",
							"office_city"=> "Kabupaten Semarang",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23912",
							"office_name"=> "BANK MANDIRI array(Pasar Ungaran Bandarjo )",
							"office_address"=> "Pasar Ungaran Bandarjo, UNGARAN BARAT, SEMARANG",
							"office_city"=> "Kabupaten Semarang",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23913",
							"office_name"=> "BANK MANDIRI array(Psr Babat)",
							"office_address"=> "Psr Babat, UNGARAN BARAT, SEMARANG",
							"office_city"=> "Kabupaten Semarang",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23916",
							"office_name"=> "BANK MANDIRI array(Kompl Pasar Wiradesa)",
							"office_address"=> "Kompl Pasar Wiradesa, WIRADESA, PEKALONGAN",
							"office_city"=> "Kabupaten Pekalongan",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23983",
							"office_name"=> "BANK MANDIRI array(Jl. Jenderal Sudirman No.236)",
							"office_address"=> "Jl. Jenderal Sudirman No.236, Salamanmloyo, Semarang Bar., Kota Semarang, Jawa Tengah 50149, Indonesia",
							"office_city"=> "Kota Semarang",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23984",
							"office_name"=> "BANK MANDIRI array(Jl. Pandanaran No.109-115)",
							"office_address"=> "Jl. Pandanaran No.109-115, Mugassari, Semarang Sel., Kota Semarang, Jawa Tengah 50249, Indonesia",
							"office_city"=> "Kota Semarang",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23985",
							"office_name"=> "BANK MANDIRI array(Jl. Ahmad Yani No.143)",
							"office_address"=> "Jl. Ahmad Yani No.143, Pleburan, Semarang Tengah, Kota Semarang, Jawa Tengah 50241, Indonesia",
							"office_city"=> "Kota Semarang",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23986",
							"office_name"=> "BANK MANDIRI array(Jl. Pandanaran No.88)",
							"office_address"=> "Jl. Pandanaran No.88, Mugassari, Semarang Sel., Kota Semarang, Jawa Tengah 50249, Indonesia",
							"office_city"=> "Kota Semarang",
							"office_province"=> "JAWA TENGAH",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "21147",
							"office_name"=> "Mandiri array(Jl. Soekarno Hatta)",
							"office_address"=> "Jl. Soekarno Hatta No. 486 Bandung, 40266",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23517",
							"office_name"=> "BANK MANDIRI array(Jl. Raya Mayor Oking Jaya Atmaja No.18)",
							"office_address"=> "Jl. Raya Mayor Oking Jaya Atmaja No.18, Karang Asem Bar., Citeureup, Bogor, Jawa Barat 16810, Indonesia",
							"office_city"=> "Kabupaten Bogor",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23519",
							"office_name"=> "BANK MANDIRI array(Jl. Raya Cikaret No.1)",
							"office_address"=> "Jl. Raya Cikaret No.1, Harapan Jaya, Cibinong, Bogor, Jawa Barat 16914, Indonesia",
							"office_city"=> "Kabupaten Bogor",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23533",
							"office_name"=> "BANK MANDIRI array(Jl. Panjunan No.35)",
							"office_address"=> "Jl. Panjunan No.35, Panjunan, Astanaanyar, Kota Bandung, Jawa Barat 40242, Indonesia",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23534",
							"office_name"=> "BANK MANDIRI array(Jl. Otto Iskandar Dinata No.280-286)",
							"office_address"=> "Jl. Otto Iskandar Dinata No.280-286, Karanganyar, Astanaanyar, Kota Bandung, Jawa Barat 40241, Indonesia",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23536",
							"office_name"=> "BANK MANDIRI array(Jl. Terusan Buah Batu No.41)",
							"office_address"=> "Jl. Terusan Buah Batu No.41, Batununggal, Bandung Kidul, Kota Bandung, Jawa Barat 40266, Indonesia",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23537",
							"office_name"=> "BANK MANDIRI array(Jl. Ir. H.Djuanda No.28)",
							"office_address"=> "Jl. Ir. H.Djuanda No.28, Citarum, Bandung Wetan, Kota Bandung, Jawa Barat 40116, Indonesia",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23538",
							"office_name"=> "BANK MANDIRI array(Jl Laks RE Martadinata)",
							"office_address"=> "Jl Laks RE Martadinata, BANDUNG WETAN, KOTA BANDUNG",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23543",
							"office_name"=> "BANK MANDIRI array(Jl. Raya Narogong Blok Cd 12 No.1)",
							"office_address"=> "Jl. Raya Narogong Blok Cd 12 No.1, Bantargebang, Kota Bks, Jawa Barat 17151, Indonesia",
							"office_city"=> "Kota Bekasi",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23545",
							"office_name"=> "BANK MANDIRI array(Jl. Jendral Gatot Subroto No.166)",
							"office_address"=> "Jl. Jendral Gatot Subroto No.166, Maleer, Batununggal, Kota Bandung, Jawa Barat 40275, Indonesia",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23546",
							"office_name"=> "BANK MANDIRI array(Jl. Bintara Raya No.5)",
							"office_address"=> "Jl. Bintara Raya No.5, Bintara, Bekasi Bar., Kota Bks, Jawa Barat 17134, Indonesia",
							"office_city"=> "Kota Bekasi",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23547",
							"office_name"=> "BANK MANDIRI array(Jl. KH. Noer Ali)",
							"office_address"=> "Jl. KH. Noer Ali, Jakasampurna, Bekasi Bar., Kota Bks, Jawa Barat 17145, Indonesia",
							"office_city"=> "Kota Bekasi",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23548",
							"office_name"=> "BANK MANDIRI array(Jl. Taman Galaxi Raya Blok A No.300)",
							"office_address"=> "Jl. Taman Galaxi Raya Blok A No.300, Jaka Setia, Bekasi Sel., Kota Bks, Jawa Barat 17147, Indonesia",
							"office_city"=> "Kota Bekasi",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23549",
							"office_name"=> "BANK MANDIRI array(Jl. Pulo Ribung Blok A No.1)",
							"office_address"=> "Jl. Pulo Ribung Blok A No.1, Jaka Setia, Bekasi Sel., Kota Bks, Jawa Barat 17147, Indonesia",
							"office_city"=> "Kota Bekasi",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23550",
							"office_name"=> "BANK MANDIRI array(Jl. Jend. Ahmad Yani Blok A4 No.1)",
							"office_address"=> "Jl. Jend. Ahmad Yani Blok A4 No.1, Kayuringin Jaya, Bekasi Sel., Kota Bks, Jawa Barat 17144, Indonesia",
							"office_city"=> "Kota Bekasi",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23551",
							"office_name"=> "BANK MANDIRI array(Jl. Perjuangan No.30)",
							"office_address"=> "Jl. Perjuangan No.30, Tlk. Pucung, Bekasi Utara, Kota Bks, Jawa Barat 17121, Indonesia",
							"office_city"=> "Kota Bekasi",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23554",
							"office_name"=> "BANK MANDIRI array(Jl. Empang Gg. Murni 1)",
							"office_address"=> "Jl. Empang Gg. Murni 1, Empang, Bogor Sel., Kota Bogor, Jawa Barat 16132, Indonesia",
							"office_city"=> "Kota Bogor",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23555",
							"office_name"=> "BANK MANDIRI array(Jl. Pahlawan Blok Aut No.109)",
							"office_address"=> "Jl. Pahlawan Blok Aut No.109, Bondongan, Bogor Sel., Kota Bogor, Jawa Barat 16131, Indonesia",
							"office_city"=> "Kota Bogor",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23556",
							"office_name"=> "BANK MANDIRI array(Jl. Raya Tajur No.127)",
							"office_address"=> "Jl. Raya Tajur No.127, Sukasari, Bogor Tim., Kota Bogor, Jawa Barat 16134, Indonesia",
							"office_city"=> "Kota Bogor",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23557",
							"office_name"=> "BANK MANDIRI array(Jalan Raya Tajur No.99)",
							"office_address"=> "Jalan Raya Tajur No.99, Pakuan, Bogor Sel., Kota Bogor, Jawa Barat 16134, Indonesia",
							"office_city"=> "Kota Bogor",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23558",
							"office_name"=> "BANK MANDIRI array(Jl. Jend. Sudirman No.39)",
							"office_address"=> "Jl. Jend. Sudirman No.39, Sempur, Bogor Tengah, Kota Bogor, Jawa Barat 16121, Indonesia",
							"office_city"=> "Kota Bogor",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23559",
							"office_name"=> "BANK MANDIRI array(Jalan Raya Sukabumi - Bogor No.67)",
							"office_address"=> "Jalan Raya Sukabumi - Bogor No.67, Baranangsiang, Bogor Tim., Kota Bogor, Jawa Barat 16143, Indonesia",
							"office_city"=> "Kota Bogor",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23560",
							"office_name"=> "BANK MANDIRI array(Jl. Raya Bojong Gede No.64-80)",
							"office_address"=> "Jl. Raya Bojong Gede No.64-80, Bojonggede, Bojong Gede, Bogor, Jawa Barat 16923, Indonesia",
							"office_city"=> "Kabupaten Bogor",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23561",
							"office_name"=> "BANK MANDIRI array(Jl. Raya Bojong Gede No.27)",
							"office_address"=> "Jl. Raya Bojong Gede No.27, Bojonggede, Bojong Gede, Bogor, Jawa Barat 16320, Indonesia",
							"office_city"=> "Kabupaten Bogor",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23562",
							"office_name"=> "BANK MANDIRI array(Jl. Raya Bojongsoang No.79)",
							"office_address"=> "Jl. Raya Bojongsoang No.79, Bojongsoang, Bandung, Jawa Barat 40288, Indonesia",
							"office_city"=> "Kabupaten Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23564",
							"office_name"=> "BANK MANDIRI array(Jl. MTC Timur)",
							"office_address"=> "Jl. MTC Timur, Sekejati, Buahbatu, Kota Bandung, Jawa Barat 40286, Indonesia",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23570",
							"office_name"=> "BANK MANDIRI array(Jl. Raya Wr. Borong No.8)",
							"office_address"=> "Jl. Raya Wr. Borong No.8, Bojong Rangkas, Ciampea, Bogor, Jawa Barat 16620, Indonesia",
							"office_city"=> "Kabupaten Bogor",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23571",
							"office_name"=> "BANK MANDIRI array(Jl. PH.H. Mustofa No.37-39)",
							"office_address"=> "Jl. PH.H. Mustofa No.37-39, Neglasari, Cibeunying Kaler, Kota Bandung, Jawa Barat 40124, Indonesia",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23572",
							"office_name"=> "BANK MANDIRI array(Jl. Jendral Ahmad Yani No.350-355)",
							"office_address"=> "Jl. Jendral Ahmad Yani No.350-355, Kacapiring, Batununggal, Kota Bandung, Jawa Barat 40121, Indonesia",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23573",
							"office_name"=> "BANK MANDIRI array(Jl. Cikutra No.79a)",
							"office_address"=> "Jl. Cikutra No.79a, Cikutra, Cibeunying Kidul, Kota Bandung, Jawa Barat 40124, Indonesia",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23574",
							"office_name"=> "BANK MANDIRI array(Jl. Raya Setu Cikaret No.103)",
							"office_address"=> "Jl. Raya Setu Cikaret No.103, Harapan Jaya, Cibinong, Bogor, Jawa Barat 16914, Indonesia",
							"office_city"=> "Kabupaten Bogor",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23576",
							"office_name"=> "BANK MANDIRI array(Jl. Dr. Djunjunan No.155)",
							"office_address"=> "Jl. Dr. Djunjunan No.155, Pajajaran, Cicendo, Kota Bandung, Jawa Barat 40173, Indonesia",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23577",
							"office_name"=> "BANK MANDIRI array(Jl. Setiabudhi No.150)",
							"office_address"=> "Jl. Setiabudhi No.150, Hegarmanah, Cidadap, Kota Bandung, Jawa Barat 40153, Indonesia",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23578",
							"office_name"=> "BANK MANDIRI array(Jl. Perjuangan No.25)",
							"office_address"=> "Jl. Perjuangan No.25, Sukadanau, Cikarang Bar., Bekasi, Jawa Barat 17530, Indonesia",
							"office_city"=> "Kabupaten Bekasi",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23579",
							"office_name"=> "BANK MANDIRI array(Jl. Moh. H. Thamrin)",
							"office_address"=> "Jl. Moh. H. Thamrin, Cibatu, Cikarang Sel., Bekasi, Jawa Barat 17530, Indonesia",
							"office_city"=> "Kabupaten Bekasi",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23580",
							"office_name"=> "BANK MANDIRI array(Jl. Raya Cikarang Cibarusah No.16)",
							"office_address"=> "Jl. Raya Cikarang Cibarusah No.16, Sukaresmi, Cikarang Sel., Bekasi, Jawa Barat 17530, Indonesia",
							"office_city"=> "Kabupaten Bekasi",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23581",
							"office_name"=> "BANK MANDIRI array(Jl. Jababeka Raya)",
							"office_address"=> "Jl. Jababeka Raya, Pasirgombong, Cikarang Utara, Bekasi, Jawa Barat 17530, Indonesia",
							"office_city"=> "Kabupaten Bekasi",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23582",
							"office_name"=> "BANK MANDIRI array(Jl. Kapten Sumantri No.27)",
							"office_address"=> "Jl. Kapten Sumantri No.27, Cikarang Kota, Cikarang Utara, Bekasi, Jawa Barat 17530, Indonesia",
							"office_city"=> "Kabupaten Bekasi",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23583",
							"office_name"=> "BANK MANDIRI array(Jl. Kasuari Raya Blok S No.10)",
							"office_address"=> "Jl. Kasuari Raya Blok S No.10, Mekarmukti, Cikarang Utara, Bekasi, Jawa Barat 17530, Indonesia",
							"office_city"=> "Kabupaten Bekasi",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23594",
							"office_name"=> "BANK MANDIRI array(Jl. Raya Puncak - Cianjur No.54)",
							"office_address"=> "Jl. Raya Puncak - Cianjur No.54, Cisarua, Bogor, Jawa Barat 16750, Indonesia",
							"office_city"=> "Kabupaten Bogor",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23595",
							"office_name"=> "BANK MANDIRI array(Jl. Cihampelas No.180)",
							"office_address"=> "Jl. Cihampelas No.180, Cipaganti, Coblong, Kota Bandung, Jawa Barat 40131, Indonesia",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23596",
							"office_name"=> "BANK MANDIRI array(Jl. Ir. H.Djuanda No.185)",
							"office_address"=> "Jl. Ir. H.Djuanda No.185, Dago, Coblong, Kota Bandung, Jawa Barat 40135, Indonesia",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23599",
							"office_name"=> "BANK MANDIRI array(Jl. Raya Banjaran No.284)",
							"office_address"=> "Jl. Raya Banjaran No.284, Dayeuhkolot, Bandung, Jawa Barat 40258, Indonesia",
							"office_city"=> "Kabupaten Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23667",
							"office_name"=> "BANK MANDIRI array(Jl. Boulevard Kota Wisata Blok A No.2)",
							"office_address"=> "Jl. Boulevard Kota Wisata Blok A No.2, Ciangsana, Gn. Putri, Bogor, Jawa Barat 16968, Indonesia",
							"office_city"=> "Kabupaten Bogor",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23672",
							"office_name"=> "BANK MANDIRI array(Jl Raya Jati Makmur)",
							"office_address"=> "Jl Raya Jati Makmur, JATIASIH, KOTA BEKASI",
							"office_city"=> "Kota Bekasi",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23673",
							"office_name"=> "BANK MANDIRI array(Jl Raya Jati Asih)",
							"office_address"=> "Jl Raya Jati Asih, JATIASIH, KOTA BEKASI",
							"office_city"=> "Kota Bekasi",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23678",
							"office_name"=> "BANK MANDIRI array(Jl Raya Alternative Cibubur)",
							"office_address"=> "Jl Raya Alternative Cibubur, JATISAMPURNA, KOTA BEKASI",
							"office_city"=> "Kota Bekasi",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23679",
							"office_name"=> "BANK MANDIRI array(Jl. Alternatif Cibubur No.21)",
							"office_address"=> "Jl. Alternatif Cibubur No.21, Jatikarya, Jatisampurna, Kota Bks, Jawa Barat 17435, Indonesia",
							"office_city"=> "Kota Bekasi",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23736",
							"office_name"=> "BANK MANDIRI array(Jl Kiaracondong)",
							"office_address"=> "Jl Kiaracondong, KIARACONDONG, KOTA BANDUNG",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23737",
							"office_name"=> "BANK MANDIRI array(Jl. Jendral Ahmad Yani No.730)",
							"office_address"=> "Jl. Jendral Ahmad Yani No.730, Cicaheum, Kiaracondong, Kota Bandung, Jawa Barat 40272, Indonesia",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23756",
							"office_name"=> "BANK MANDIRI array(Jl Asia Afrika)",
							"office_address"=> "Jl Asia Afrika, LENGKONG, KOTA BANDUNG",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23757",
							"office_name"=> "BANK MANDIRI array(Jl Buah Batu)",
							"office_address"=> "Jl Buah Batu, LENGKONG, KOTA BANDUNG",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23758",
							"office_name"=> "BANK MANDIRI array(Jl Raya Leuwiliang)",
							"office_address"=> "Jl Raya Leuwiliang, LEUWILIANG, BOGOR",
							"office_city"=> "Kabupaten Bogor",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23787",
							"office_name"=> "BANK MANDIRI array(Jl Raya Soreang Kopo)",
							"office_address"=> "Jl Raya Soreang Kopo, MARGAHAYU, BANDUNG",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23794",
							"office_name"=> "BANK MANDIRI array(Jl Sultan Agung)",
							"office_address"=> "Jl Sultan Agung, MEDAN SATRIA, KOTA BEKASI",
							"office_city"=> "Kota Bekasi",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23839",
							"office_name"=> "BANK MANDIRI array(Jl Soekarno Hatta)",
							"office_address"=> "Jl Soekarno Hatta, RANCASARI, KOTA BANDUNG",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23840",
							"office_name"=> "BANK MANDIRI array(Jl Margasari)",
							"office_address"=> "Jl Margasari, RANCASARI, KOTA BANDUNG",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23841",
							"office_name"=> "BANK MANDIRI array(Jl Kemang Pratama Raya)",
							"office_address"=> "Jl Kemang Pratama Raya, RAWALUMBU, KOTA BEKASI",
							"office_city"=> "Kota Bekasi",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23868",
							"office_name"=> "BANK MANDIRI array(Jl Surya Sumantri Setrasari Mall)",
							"office_address"=> "Jl Surya Sumantri Setrasari Mall, SUKAJADI, KOTA BANDUNG",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23869",
							"office_name"=> "BANK MANDIRI array(Jl Pasteur)",
							"office_address"=> "Jl Pasteur, SUKAJADI, KOTA BANDUNG",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23870",
							"office_name"=> "BANK MANDIRI array(Jl Braga)",
							"office_address"=> "Jl Braga, SUMUR BANDUNG, KOTA BANDUNG",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23871",
							"office_name"=> "BANK MANDIRI array(Jl. Asia Afrika No.107-111)",
							"office_address"=> "Jl. Asia Afrika No.107-111, Kb. Pisang, Lengkong, Kota Bandung, Jawa Barat 40261, Indonesia",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23876",
							"office_name"=> "BANK MANDIRI array(Jl Sultan Hasanudin Ruko Metropolitan)",
							"office_address"=> "Jl Sultan Hasanudin Ruko Metropolitan, TAMBUN SELATAN, BEKASI",
							"office_city"=> "Kabupaten Bekasi",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23877",
							"office_name"=> "BANK MANDIRI array(Jl Salendra Iskandar)",
							"office_address"=> "Jl Salendra Iskandar, TANAH SEREAL, KOTA BOGOR",
							"office_city"=> "Kota Bogor",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23919",
							"office_name"=> "BANK MANDIRI array(Jl Sholeh Iskandar)",
							"office_address"=> "Jl Sholeh Iskandar, BOGOR BARAT, KOTA BOGOR",
							"office_city"=> "Kota Bogor",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23920",
							"office_name"=> "BANK MANDIRI array(Jl. Moh. A. Salamun)",
							"office_address"=> "Jl. Moh. A. Salamun, Cibogor, Bogor Tengah, Kota Bogor, Jawa Barat 16124, Indonesia",
							"office_city"=> "Kota Bogor",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23921",
							"office_name"=> "BANK MANDIRI array(Jl Pajajaran)",
							"office_address"=> "Jl Pajajaran, BOGOR TENGAH, KOTA BOGOR",
							"office_city"=> "Kota Bogor",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "EASTERN JABOTABEK"
						),
						array(
							"office_id"=> "23926",
							"office_name"=> "BANK MANDIRI array(Jl Surapati)",
							"office_address"=> "Jl Surapati, CIBEUNYING KALER, KOTA BANDUNG",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23927",
							"office_name"=> "BANK MANDIRI array(Jl Dr Setiabudi)",
							"office_address"=> "Jl Dr Setiabudi, CIDADAP, KOTA BANDUNG",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "23988",
							"office_name"=> "BANK MANDIRI array(Jl. Setiabudhi No.167)",
							"office_address"=> "Jl. Setiabudhi No.167, Gegerkalong, Sukasari, Kota Bandung, Jawa Barat 40153, Indonesia",
							"office_city"=> "Kota Bandung",
							"office_province"=> "JAWA BARAT",
							"office_region"=> "JAWA BARAT"
						),
						array(
							"office_id"=> "21143",
							"office_name"=> "Mandiri array(Jl, Jenderal Gatot Subroto)",
							"office_address"=> "Jl, Jenderal Gatot Subroto Kav. 36-38 Jakarta 12190 Indonesia",
							"office_city"=> "Kota Administratif Jakarta Pusat",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "21144",
							"office_name"=> "Mandiri array(Jl. Kebon Sirih No. 83)",
							"office_address"=> "Jl. Kebon Sirih No. 83 Jakarta Pusat, 10340",
							"office_city"=> "Kota Administratif Jakarta Pusat",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "21145",
							"office_name"=> "Mandiri array(Jl, Jenderal Gatot Subroto Kav. 36-38)",
							"office_address"=> "Jl, Jenderal Gatot Subroto Kav. 36-38 Jakarta 12190 Indonesia",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "21146",
							"office_name"=> "Mandiri array(Jl. Jend. Sudirman Kav. 54-55)",
							"office_address"=> "Jl. Jend. Sudirman Kav. 54-55 Jakarta Selatan, 12190",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23460",
							"office_name"=> "BANK MANDIRI array(Jl. Raya Kby. Lama No.178C)",
							"office_address"=> "Jl. Raya Kby. Lama No.178C, Cipulir, Kby. Lama, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12230, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23463",
							"office_name"=> "BANK MANDIRI array(Jl. Pulobuaran Raya Blok Ff No.1)",
							"office_address"=> "Jl. Pulobuaran Raya Blok Ff No.1, Jatinegara, Cakung, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13930, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23465",
							"office_name"=> "BANK MANDIRI array(Jl. Mabes Hankam No.10)",
							"office_address"=> "Jl. Mabes Hankam No.10, Ceger, Cipayung, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13820, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23466",
							"office_name"=> "BANK MANDIRI array(Jl. Raya Lap. Tembak Blok A No.1)",
							"office_address"=> "Jl. Raya Lap. Tembak Blok A No.1, Cibubur, Ciracas, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13720, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23468",
							"office_name"=> "BANK MANDIRI array(Jl. Pd. Kelapa Raya Blok D2 No.1)",
							"office_address"=> "Jl. Pd. Kelapa Raya Blok D2 No.1, Pd. Klp., Duren Sawit, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13450, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23469",
							"office_name"=> "BANK MANDIRI array(Jl. Kh. Hasyim Ashari No.9)",
							"office_address"=> "Jl. Kh. Hasyim Ashari No.9, Cideng, Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10150, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Pusat",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23470",
							"office_name"=> "BANK MANDIRI array(Jl. Imam Mahbud No.11)",
							"office_address"=> "Jl. Imam Mahbud No.11, Duri Pulo, Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10140, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Pusat",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23471",
							"office_name"=> "BANK MANDIRI array(Jl. Tanah Abang II No.57A)",
							"office_address"=> "Jl. Tanah Abang II No.57A, Petojo Sel., Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10160, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Pusat",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23476",
							"office_name"=> "BANK MANDIRI array(Jl. Matraman Raya No.232-240)",
							"office_address"=> "Jl. Matraman Raya No.232-240, Bali Mester, Jatinegara, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13310, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23477",
							"office_name"=> "BANK MANDIRI array(Jl. Jatinegara Bar. No.140)",
							"office_address"=> "Jl. Jatinegara Bar. No.140, Bidara Cina, Jatinegara, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13320, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23478",
							"office_name"=> "BANK MANDIRI array(Jl. Otto Iskandardinata No.64)",
							"office_address"=> "Jl. Otto Iskandardinata No.64, Kp. Melayu, Jatinegara, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13330, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23479",
							"office_name"=> "BANK MANDIRI array(Jl. DI. Panjaitan)",
							"office_address"=> "Jl. DI. Panjaitan, Cipinang Cempedak, Jatinegara, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13340, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23482",
							"office_name"=> "BANK MANDIRI array(Jl. Usaha No.45)",
							"office_address"=> "Jl. Usaha No.45, Cawang, Kramatjati, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13630, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23483",
							"office_name"=> "BANK MANDIRI array(Jl. Pondok Gede No.23)",
							"office_address"=> "Jl. Pondok Gede No.23, Dukuh, Kramatjati, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13550, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23485",
							"office_name"=> "BANK MANDIRI array(Jl. Matraman Raya No.29)",
							"office_address"=> "Jl. Matraman Raya No.29, Palmeriam, Matraman, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13140, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23486",
							"office_name"=> "BANK MANDIRI array(Jl. Pramuka Raya No.151)",
							"office_address"=> "Jl. Pramuka Raya No.151, Utan Kayu Utara, Matraman, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13120, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23488",
							"office_name"=> "BANK MANDIRI array(Jl. Mangga Dua Raya No.1)",
							"office_address"=> "Jl. Mangga Dua Raya No.1, Ancol, Pademangan, Kota Jkt Utara, Daerah Khusus Ibukota Jakarta 14430, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Utara",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23490",
							"office_name"=> "BANK MANDIRI array(Jl. T.B. Simatupang Blok Asam Baris 2 No.5)",
							"office_address"=> "Jl. T.B. Simatupang Blok Asam Baris 2 No.5, Gedong, Ps. Rebo, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13760, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23491",
							"office_name"=> "BANK MANDIRI array(Jl. Raya Bogor Blok Sawal No.5)",
							"office_address"=> "Jl. Raya Bogor Blok Sawal No.5, Pekayon, Ps. Rebo, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13710, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23492",
							"office_name"=> "BANK MANDIRI array(Jl. Pantai Indah Selatan 1 No.11)",
							"office_address"=> "Jl. Pantai Indah Selatan 1 No.11, Kamal Muara, Penjaringan, Kota Jkt Utara, Daerah Khusus Ibukota Jakarta 14470, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Utara",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23493",
							"office_name"=> "BANK MANDIRI array(Jl. Pakin No.8)",
							"office_address"=> "Jl. Pakin No.8, Penjaringan, Kota Jkt Utara, Daerah Khusus Ibukota Jakarta 14440, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Utara",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23494",
							"office_name"=> "BANK MANDIRI array(Jl. Pemuda No.23)",
							"office_address"=> "Jl. Pemuda No.23, Jati, Pulo Gadung, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13220, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23495",
							"office_name"=> "BANK MANDIRI array(Jl. Kartini No.55)",
							"office_address"=> "Jl. Kartini No.55, Kartini, Sawah Besar, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10750, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Pusat",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23507",
							"office_name"=> "BANK MANDIRI array(Jl. Jend. Sudirman Blok t No.40A)",
							"office_address"=> "Jl. Jend. Sudirman Blok t No.40A, Menteng, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10230, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Pusat",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23516",
							"office_name"=> "BANK MANDIRI array(Jl. Jenderal Sudirman)",
							"office_address"=> "Jl. Jenderal Sudirman, Karet Tengsin, Tanah Abang, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10250, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Pusat",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23528",
							"office_name"=> "BANK MANDIRI array(Jl. Batu Ampar III No.25)",
							"office_address"=> "Jl. Batu Ampar III No.25, Batu Ampar, Kramatjati, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13520, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23569",
							"office_name"=> "BANK MANDIRI array(Jl. Bekasi Raya No.22)",
							"office_address"=> "Jl. Bekasi Raya No.22, Ujung Menteng, Cakung, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13960, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23584",
							"office_name"=> "BANK MANDIRI array(Jl. Karang Tengah Raya No.25)",
							"office_address"=> "Jl. Karang Tengah Raya No.25, Lb. Bulus, Cilandak, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12440, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23585",
							"office_name"=> "BANK MANDIRI array(Jl. RS Fatmawati No.3)",
							"office_address"=> "Jl. RS Fatmawati No.3, Gandaria Sel., Cilandak, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12420, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23586",
							"office_name"=> "BANK MANDIRI array(Jl. Margasatwa No.59)",
							"office_address"=> "Jl. Margasatwa No.59, Pd. Labu, Cilandak, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12450, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23587",
							"office_name"=> "BANK MANDIRI array(Jl. Tipar Cakung No.1)",
							"office_address"=> "Jl. Tipar Cakung No.1, Semper Bar., Cilincing, Kota Jkt Utara, Daerah Khusus Ibukota Jakarta 14130, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Utara",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23605",
							"office_name"=> "BANK MANDIRI array(Kelapa Kopyor 14)",
							"office_address"=> "Kelapa Kopyor 14, Pd. Klp., Duren Sawit, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13450, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23656",
							"office_name"=> "BANK MANDIRI array(Jl. Raya Kalimalang No.3)",
							"office_address"=> "Jl. Raya Kalimalang No.3. B, Pd. Klp., Duren Sawit, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13450, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23657",
							"office_name"=> "BANK MANDIRI array(Jl. Teratai Putih No.32)",
							"office_address"=> "Jl. Teratai Putih No.32, Malaka Jaya, Duren Sawit, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13460, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23658",
							"office_name"=> "BANK MANDIRI array(Jl. Pd. Kelapa Raya Blok D2 No.8)",
							"office_address"=> "Jl. Pd. Kelapa Raya Blok D2 No.8, Pd. Klp., Duren Sawit, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13450, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23659",
							"office_name"=> "BANK MANDIRI array(Jl. RS Fatmawati No.36)",
							"office_address"=> "Jl. RS Fatmawati No.36, Cipete Utara, Kby. Baru, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12140, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23660",
							"office_name"=> "BANK MANDIRI array(Jl. Gandaria Tengah III No.23)",
							"office_address"=> "Jl. Gandaria Tengah III No.23, Kramat Pela, Kby. Baru, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12130, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23668",
							"office_name"=> "BANK MANDIRI array(Jl. Pakubuwono VI No.6)",
							"office_address"=> "Jl. Pakubuwono VI No.6, Gunung, Kby. Baru, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12120, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23671",
							"office_name"=> "BANK MANDIRI array(Jl Raya Lenteng Agung)",
							"office_address"=> "Jl Raya Lenteng Agung, JAGAKARSA, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23674",
							"office_name"=> "BANK MANDIRI array(Jl Matraman Raya)",
							"office_address"=> "Jl Matraman Raya, JATINEGARA, JAKARTA TIMUR",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23675",
							"office_name"=> "BANK MANDIRI array(Jl Gardu)",
							"office_address"=> "Jl Gardu, JATINEGARA, JAKARTA TIMUR",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23676",
							"office_name"=> "BANK MANDIRI array(Jl Kb Nanas)",
							"office_address"=> "Jl Kb Nanas, JATINEGARA, JAKARTA TIMUR",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23677",
							"office_name"=> "BANK MANDIRI array(Jl Cipinang Jaya)",
							"office_address"=> "Jl Cipinang Jaya, JATINEGARA, JAKARTA TIMUR",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23699",
							"office_name"=> "BANK MANDIRI array(Jl SD)",
							"office_address"=> "Jl SD, KEBAYORAN BARU, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23700",
							"office_name"=> "BANK MANDIRI array(Jl Ciledug Raya)",
							"office_address"=> "Jl Ciledug Raya, KEBAYORAN LAMA, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23701",
							"office_name"=> "BANK MANDIRI array(Jl Raya Kebayoran Lama)",
							"office_address"=> "Jl Raya Kebayoran Lama, KEBAYORAN LAMA, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23702",
							"office_name"=> "BANK MANDIRI array(Jl Sekolah Duta V)",
							"office_address"=> "Jl Sekolah Duta V, KEBAYORAN LAMA, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23703",
							"office_name"=> "BANK MANDIRI array(Jl Arteri Pondok Indah)",
							"office_address"=> "Jl Arteri Pondok Indah, KEBAYORAN LAMA, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23704",
							"office_name"=> "BANK MANDIRI array(Jl Kebayoran Lama)",
							"office_address"=> "Jl Kebayoran Lama, KEBAYORAN LAMA, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23719",
							"office_name"=> "BANK MANDIRI array(Jl Arteri Permata Hijau)",
							"office_address"=> "Jl Arteri Permata Hijau, KEBAYORAN LAMA, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23720",
							"office_name"=> "BANK MANDIRI array(Jl TB Simatupang)",
							"office_address"=> "Jl TB Simatupang, KEBAYORAN LAMA, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23721",
							"office_name"=> "BANK MANDIRI array(Jl Teuku Nyak Arif)",
							"office_address"=> "Jl Teuku Nyak Arif, KEBAYORAN LAMA, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23726",
							"office_name"=> "BANK MANDIRI array(Jl Bekasi Raya)",
							"office_address"=> "Jl Bekasi Raya, KELAPA GADING, JAKARTA UTARA",
							"office_city"=> "Kota Administratif Jakarta Utara",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23727",
							"office_name"=> "BANK MANDIRI array(Jl Garuda)",
							"office_address"=> "Jl Garuda, KEMAYORAN, JAKARTA PUSAT",
							"office_city"=> "Kota Administratif Jakarta Pusat",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23728",
							"office_name"=> "BANK MANDIRI array(Jl Letdjen Suprato)",
							"office_address"=> "Jl Letdjen Suprato, KEMAYORAN, JAKARTA PUSAT",
							"office_city"=> "Kota Administratif Jakarta Pusat",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23738",
							"office_name"=> "BANK MANDIRI array(Jl. Kyai Maja No.15)",
							"office_address"=> "Jl. Kyai Maja No.15, Kramat Pela, Kby. Baru, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12130, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23740",
							"office_name"=> "BANK MANDIRI array(Jl. Yos Sudarso No.56)",
							"office_address"=> "Jl. Yos Sudarso No.56, Kb. Bawang, Koja, Kota Jkt Utara, Daerah Khusus Ibukota Jakarta 14230, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Utara",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23741",
							"office_name"=> "BANK MANDIRI array(Jl. Yos Sudarso)",
							"office_address"=> "Jl Yos Sudarso, KOJA, JAKARTA UTARA",
							"office_city"=> "Kota Administratif Jakarta Utara",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23742",
							"office_name"=> "BANK MANDIRI array(Jl Alur Laut)",
							"office_address"=> "Jl Alur Laut, KOJA, JAKARTA UTARA",
							"office_city"=> "Kota Administratif Jakarta Utara",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23743",
							"office_name"=> "BANK MANDIRI array(Jl Plumpang Raya)",
							"office_address"=> "Jl Plumpang Raya, KOJA, JAKARTA UTARA",
							"office_city"=> "Kota Administratif Jakarta Utara",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23744",
							"office_name"=> "BANK MANDIRI array(Jl Kramat Jaya)",
							"office_address"=> "Jl Kramat Jaya, KOJA, JAKARTA UTARA",
							"office_city"=> "Kota Administratif Jakarta Utara",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23745",
							"office_name"=> "BANK MANDIRI array(Jl. Kramat Jaya Raya No.12-13)",
							"office_address"=> "Jl. Kramat Jaya Raya No.12-13, Tugu Utara, Koja, Kota Jkt Utara, Daerah Khusus Ibukota Jakarta 14260, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Utara",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23749",
							"office_name"=> "BANK MANDIRI array(Jl Condet Raya)",
							"office_address"=> "Jl Condet Raya, KRAMATJATI, JAKARTA TIMUR",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23759",
							"office_name"=> "BANK MANDIRI array(Jl Jati Waringin)",
							"office_address"=> "Jl Jati Waringin, MAKASAR, JAKARTA TIMUR",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23760",
							"office_name"=> "BANK MANDIRI array(Jl Seulawah Raya)",
							"office_address"=> "Jl Seulawah Raya, MAKASAR, JAKARTA TIMUR",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23783",
							"office_name"=> "BANK MANDIRI array(Jl Prapanca Raya)",
							"office_address"=> "Jl Prapanca Raya, MAMPANG PRAPATAN, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23784",
							"office_name"=> "BANK MANDIRI array(Jl Kemang Raya)",
							"office_address"=> "Jl Kemang Raya, MAMPANG PRAPATAN, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23785",
							"office_name"=> "BANK MANDIRI array(Jl. Kemang Selatan No.111H)",
							"office_address"=> "Jl. Kemang Selatan No.111H, Bangka, Mampang Prpt., Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12560, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23786",
							"office_name"=> "BANK MANDIRI array(Jl. Mampang Prpt. Raya No.61)",
							"office_address"=> "Jl. Mampang Prpt. Raya No.61, Mampang Prpt., Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12790, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23797",
							"office_name"=> "BANK MANDIRI array(Jl Melawai)",
							"office_address"=> "Jl Melawai, KEBAYORAN BARU, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23798",
							"office_name"=> "BANK MANDIRI array(Jl Melawai Raya)",
							"office_address"=> "Jl Melawai Raya, KEBAYORAN BARU, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23807",
							"office_name"=> "BANK MANDIRI array(Jl Warung Buncit Raya)",
							"office_address"=> "Jl Warung Buncit Raya, PANCORAN, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23808",
							"office_name"=> "BANK MANDIRI array(Jl. Warung Jati Barat No.139-201)",
							"office_address"=> "Jl. Warung Jati Barat No.139-201, Kalibata, Pancoran, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12740, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23809",
							"office_name"=> "BANK MANDIRI array(Jl MT Hariono)",
							"office_address"=> "Jl MT Hariono, PANCORAN, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23810",
							"office_name"=> "BANK MANDIRI array(Jl. Raya Pasar Minggu KM.17 No.29)",
							"office_address"=> "Jl. Raya Pasar Minggu KM.17 No.29, Kalibata, Pancoran, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12740, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23811",
							"office_name"=> "BANK MANDIRI array(Jl. Rawajati Timur No.12)",
							"office_address"=> "Jl. Rawajati Timur No.12, Rawajati, Pancoran, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12510, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23812",
							"office_name"=> "BANK MANDIRI array(Jl Panglima Polim)",
							"office_address"=> "Jl Panglima Polim, KEBAYORAN BARU, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23815",
							"office_name"=> "BANK MANDIRI array(Jl Cilandak)",
							"office_address"=> "Jl Cilandak, PASAR MINGGU, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23816",
							"office_name"=> "BANK MANDIRI array(Jl Ampera Raya)",
							"office_address"=> "Jl Ampera Raya, PASAR MINGGU, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23817",
							"office_name"=> "BANK MANDIRI array(Jl. T. B. Simatupang No.88)",
							"office_address"=> "Jl. T. B. Simatupang No.88, Kebagusan, Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12520, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23818",
							"office_name"=> "BANK MANDIRI array(Jl Raya Ragunan)",
							"office_address"=> "Jl Raya Ragunan, PASAR MINGGU, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23823",
							"office_name"=> "BANK MANDIRI array(Ruko Exclusive Bukit Golf Mediterania)",
							"office_address"=> "Ruko Exclusive Bukit Golf Mediterania, PENJARINGAN, JAKARTA UTARA",
							"office_city"=> "Kota Administratif Jakarta Utara",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23824",
							"office_name"=> "BANK MANDIRI array(Jl Pakin)",
							"office_address"=> "Jl Pakin, PENJARINGAN, JAKARTA UTARA",
							"office_city"=> "Kota Administratif Jakarta Utara",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23826",
							"office_name"=> "BANK MANDIRI array(Jl Ciledug)",
							"office_address"=> "Jl Ciledug, PESANGGRAHAN, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23827",
							"office_name"=> "BANK MANDIRI array(Jl. Bintaro Utama I No.14-15)",
							"office_address"=> "Jl. Bintaro Utama I No.14-15, Bintaro, Pesanggrahan, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12330, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23828",
							"office_name"=> "BANK MANDIRI array(Jl RC Veteran Bintaro)",
							"office_address"=> "Jl RC Veteran Bintaro, PESANGGRAHAN, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23833",
							"office_name"=> "BANK MANDIRI array(Jl Balai Pustaka)",
							"office_address"=> "Jl Balai Pustaka, PULOGADUNG, JAKARTA TIMUR",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23834",
							"office_name"=> "BANK MANDIRI array(Jl Penggambiran)",
							"office_address"=> "Jl Penggambiran, PULOGADUNG, JAKARTA TIMUR",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23837",
							"office_name"=> "BANK MANDIRI array(Jl Radio Dalam)",
							"office_address"=> "Jl Radio Dalam, KEBAYORAN BARU, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23855",
							"office_name"=> "BANK MANDIRI array(Jl Kramat Kwitang 1)",
							"office_address"=> "Jl Kramat Kwitang 1, SENEN, JAKARTA PUSAT",
							"office_city"=> "Kota Administratif Jakarta Pusat",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23862",
							"office_name"=> "BANK MANDIRI array(Jl. Jend. Gatot Subroto No.79)",
							"office_address"=> "Jl. Jend. Gatot Subroto No.79, Karet Semanggi, Kecamatan Setiabudi, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12930, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23863",
							"office_name"=> "BANK MANDIRI array(Jl. Jend. Gatot Subroto No.Kav 32-34)",
							"office_address"=> "Jl. Jend. Gatot Subroto No.Kav 32-34, Kuningan Tim., Kecamatan Setiabudi, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12950, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23864",
							"office_name"=> "BANK MANDIRI array(Jl Prof Dr Satrio)",
							"office_address"=> "Jl Prof Dr Satrio, SETIA BUDI, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23865",
							"office_name"=> "BANK MANDIRI array(Jl Minangkabau)",
							"office_address"=> "Jl Minangkabau, SETIA BUDI, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23867",
							"office_name"=> "BANK MANDIRI array(Jl. Jend. Sudirman No.61)",
							"office_address"=> "Jl. Jend. Sudirman No.61, Senayan, Kby. Baru, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12190, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23873",
							"office_name"=> "BANK MANDIRI array(Jl Suryo)",
							"office_address"=> "Jl Suryo, KEBAYORAN BARU, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23878",
							"office_name"=> "BANK MANDIRI array(Jl Palmerah)",
							"office_address"=> "Jl Palmerah, TANAHABANG, JAKARTA PUSAT",
							"office_city"=> "Kota Administratif Jakarta Pusat",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23879",
							"office_name"=> "BANK MANDIRI array( Jl. Jend. Sudirman No.9)",
							"office_address"=> "Ratu Plaza, Jl. Jend. Sudirman No.9, Gelora, Tanah Abang, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10270, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Pusat",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23880",
							"office_name"=> "BANK MANDIRI array(Jl Bendungan Hilir Raya)",
							"office_address"=> "Jl Bendungan Hilir Raya, TANAHABANG, JAKARTA PUSAT",
							"office_city"=> "Kota Administratif Jakarta Pusat",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23884",
							"office_name"=> "BANK MANDIRI array(Kb. Bawang)",
							"office_address"=> "Jl. Yos Sudarso, Kb. Bawang, Tj. Priok, Kota Jkt Utara, Daerah Khusus Ibukota Jakarta 14320, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Utara",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23885",
							"office_name"=> "BANK MANDIRI array(Jl Jen. Gatot Subroto)",
							"office_address"=> "Jl Jen. Gatot Subroto, TEBET, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23886",
							"office_name"=> "BANK MANDIRI array(Jl Raya Kasablanca)",
							"office_address"=> "Jl Raya Kasablanca, TEBET, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23887",
							"office_name"=> "BANK MANDIRI array(Jl Dr Saharjo)",
							"office_address"=> "Jl Dr Saharjo, TEBET, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23888",
							"office_name"=> "BANK MANDIRI array(Jl Tebet Barat Dalam IX)",
							"office_address"=> "Jl Tebet Barat Dalam IX, TEBET, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23889",
							"office_name"=> "BANK MANDIRI array(Jl Tebet Barat)",
							"office_address"=> "Jl Tebet Barat TEBET, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23890",
							"office_name"=> "BANK MANDIRI array(Jl. KH. Abdullah Syafei No.12-14)",
							"office_address"=> "Jl. KH. Abdullah Syafei No.12-14, Bukit Duri, Tebet, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12840, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23891",
							"office_name"=> "BANK MANDIRI array(Jl. Tebet Timur Dalam No.113-115)",
							"office_address"=> "Jl. Tebet Timur Dalam No.113-115, Tebet Tim., Tebet, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12820, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23892",
							"office_name"=> "BANK MANDIRI array(Jl Asem Baris Raya)",
							"office_address"=> "Jl Asem Baris Raya, TEBET, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23908",
							"office_name"=> "BANK MANDIRI array(Jl. Wolter Monginsidi No.120)",
							"office_address"=> "Jl. Wolter Monginsidi No.120, Petogogan, Kby. Baru, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12170, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23915",
							"office_name"=> "BANK MANDIRI array(Jl Wijaya)",
							"office_address"=> "Jl Wijaya, KEBAYORAN BARU, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23917",
							"office_name"=> "BANK MANDIRI array(Jl Tipar Cakung)",
							"office_address"=> "Jl Tipar Cakung, CILINCING, JAKARTA UTARA",
							"office_city"=> "Kota Administratif Jakarta Utara",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23918",
							"office_name"=> "BANK MANDIRI array(Jl Percetakan Negara Iia)",
							"office_address"=> "Jl Percetakan Negara Iia, JOHAR BARU, JAKARTA PUSAT",
							"office_city"=> "Kota Administratif Jakarta Pusat",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23922",
							"office_name"=> "BANK MANDIRI array(Jalan Bekasi Raya)",
							"office_address"=> "Jalan Bekasi Raya, CAKUNG, JAKARTA TIMUR",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23923",
							"office_name"=> "BANK MANDIRI array(Jl Sultan Hamengkubuwono IX)",
							"office_address"=> "Jl Sultan Hamengkubuwono IX, CAKUNG, JAKARTA TIMUR",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23924",
							"office_name"=> "BANK MANDIRI array(Jl Rawasari Selatan)",
							"office_address"=> "Jl Rawasari Selatan, CEMPAKA PUTIH, JAKARTA PUSAT",
							"office_city"=> "Kota Administratif Jakarta Pusat",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23929",
							"office_name"=> "BANK MANDIRI array(Jl. RS Fatmawati No.1)",
							"office_address"=> "Jl. RS Fatmawati No.1, Cilandak Bar., Cilandak, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12430, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23930",
							"office_name"=> "BANK MANDIRI array(Jl RS Fatmawati)",
							"office_address"=> "Jl RS Fatmawati, CILANDAK, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23931",
							"office_name"=> "BANK MANDIRI array(Jl Raya Lapangan Tembak)",
							"office_address"=> "Jl Raya Lapangan Tembak, CIRACAS, JAKARTA TIMUR",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23932",
							"office_name"=> "BANK MANDIRI array(Jl Pahlawan Revolusi)",
							"office_address"=> "Jl Pahlawan Revolusi, DUREN SAWIT, JAKARTA TIMUR",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23933",
							"office_name"=> "BANK MANDIRI array(Jl Kali Malang)",
							"office_address"=> "Jl Kali Malang, DUREN SAWIT, JAKARTA TIMUR",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23934",
							"office_name"=> "BANK MANDIRI array(Jl Teratai Putih Raya)",
							"office_address"=> "Jl Teratai Putih Raya, DUREN SAWIT, JAKARTA TIMUR",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23935",
							"office_name"=> "BANK MANDIRI array(Jl Cideng Barat)",
							"office_address"=> "Jl Cideng Barat, GAMBIR, JAKARTA PUSAT",
							"office_city"=> "Kota Administratif Jakarta Pusat",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23936",
							"office_name"=> "BANK MANDIRI array(Jl Pembangunan II)",
							"office_address"=> "Jl Pembangunan II, GAMBIR, JAKARTA PUSAT",
							"office_city"=> "Kota Administratif Jakarta Pusat",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23937",
							"office_name"=> "BANK MANDIRI array(Jl Pecenongan)",
							"office_address"=> "Jl Pecenongan, GAMBIR, JAKARTA PUSAT",
							"office_city"=> "Kota Administratif Jakarta Pusat",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23938",
							"office_name"=> "BANK MANDIRI array(Jl Bali Mester)",
							"office_address"=> "Jl Bali Mester, JATINEGARA, JAKARTA TIMUR",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23939",
							"office_name"=> "BANK MANDIRI array(Jl. Radio Dalam Raya No.61-99)",
							"office_address"=> "Jl. Radio Dalam Raya No.61-99, Gandaria Utara, Kby. Baru, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12140, Indonesia, Gandaria Utara, Kby. Baru, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12140, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23940",
							"office_name"=> "BANK MANDIRI array(Jl Kyai Maja)",
							"office_address"=> "Jl Kyai Maja, KEBAYORAN BARU, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23941",
							"office_name"=> "BANK MANDIRI array(Jl Iskandar Muda)",
							"office_address"=> "Jl Iskandar Muda, KEBAYORAN LAMA, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23942",
							"office_name"=> "BANK MANDIRI array(KEBAYORAN LAMA)",
							"office_address"=> "Jl Palmerah, KEBAYORAN LAMA, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23945",
							"office_name"=> "BANK MANDIRI array(Jl Kramat Jati)",
							"office_address"=> "Jl Kramat Jati, KRAMATJATI, JAKARTA TIMUR",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23948",
							"office_name"=> "BANK MANDIRI array(Jl Kapt Tendean)",
							"office_address"=> "Jl Kapt Tendean, MAMPANG PRAPATAN, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23949",
							"office_name"=> "BANK MANDIRI array(Jl Utan Kayu)",
							"office_address"=> "Jl Utan Kayu, MATRAMAN, JAKARTA TIMUR",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23951",
							"office_name"=> "BANK MANDIRI array(Jl MH Thamrin)",
							"office_address"=> "Jl MH Thamrin, MENTENG, JAKARTA PUSAT",
							"office_city"=> "Kota Administratif Jakarta Pusat",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23952",
							"office_name"=> "BANK MANDIRI array(Jl Cikini)",
							"office_address"=> "Jl Cikini, MENTENG, JAKARTA PUSAT",
							"office_city"=> "Kota Administratif Jakarta Pusat",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23953",
							"office_name"=> "BANK MANDIRI array(Jl Mangga Dua)",
							"office_address"=> "Jl Mangga Dua, PADEMANGAN, JAKARTA UTARA",
							"office_city"=> "Kota Administratif Jakarta Utara",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23974",
							"office_name"=> "BANK MANDIRI array(Jl Pasar Minggu Raya)",
							"office_address"=> "Jl Pasar Minggu Raya, PASAR MINGGU, JAKARTA SELATAN",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23975",
							"office_name"=> "BANK MANDIRI array(Jl. Condet Raya No.15)",
							"office_address"=> "Jl. Condet Raya No.15, Gedong, Ps. Rebo, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13760, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23976",
							"office_name"=> "BANK MANDIRI array(Jl. Raya Jakarta-Bogor No.89)",
							"office_address"=> "Jl. Raya Jakarta-Bogor No.89, Pekayon, Ps. Rebo, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13710, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23977",
							"office_name"=> "BANK MANDIRI array(Jl. Ciledug Raya No.8)",
							"office_address"=> "Jl. Ciledug Raya No.8, Petukangan Sel., Pesanggrahan, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12270, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23978",
							"office_name"=> "BANK MANDIRI array(Jl. Manyar Blok O No.3)",
							"office_address"=> "Jl. Manyar Blok O No.3, Bintaro, Pesanggrahan, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 15412, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23979",
							"office_name"=> "BANK MANDIRI array(Jl. Ciledug Raya No.1-22)",
							"office_address"=> "Jl. Ciledug Raya No.1-22, Ulujami, Pesanggrahan, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12250, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Selatan",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 1"
						),
						array(
							"office_id"=> "23980",
							"office_name"=> "BANK MANDIRI array(Jl. Pemuda Blok A No.79)",
							"office_address"=> "Jl. Pemuda Blok A No.79, Jati, Pulo Gadung, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13220, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Timur",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23981",
							"office_name"=> "BANK MANDIRI array(Jl. Pangeran Jayakarta No.116)",
							"office_address"=> "Jl. Pangeran Jayakarta No.116, Mangga Dua Sel., Sawah Besar, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10730, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Pusat",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23982",
							"office_name"=> "BANK MANDIRI array(Jl. Pintu Air Raya No.5)",
							"office_address"=> "Jl. Pintu Air Raya No.5, Ps. Baru, Sawah Besar, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10710, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Pusat",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23993",
							"office_name"=> "BANK MANDIRI array(Jl. Anggrek IV)",
							"office_address"=> "Jl. Anggrek IV, Kp. Bali, Tanah Abang, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10250, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Pusat",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23994",
							"office_name"=> "BANK MANDIRI array(Jl. K.H. Wahid Hasyim No.137b)",
							"office_address"=> "Jl. K.H. Wahid Hasyim No.137b, Kb. Kacang, Tanahabang, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10240, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Pusat",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23998",
							"office_name"=> "BANK MANDIRI array(Jl. Letjend Suprapto)",
							"office_address"=> "Ruko Cemp. Putih Permai, Jl. Letjend Suprapto, Cemp. Putih Tim., Cemp. Putih, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10510, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Pusat",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23999",
							"office_name"=> "BANK MANDIRI array(Jl. Camar 11/7 No.3A,)",
							"office_address"=> "Jl. Camar 11/7 No.3A, Semper Bar., Cilincing, Kota Jkt Utara, Daerah Khusus Ibukota Jakarta 14130, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Utara",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "24000",
							"office_name"=> "BANK MANDIRI array(Jl Sukarjo Wiryopranoto)",
							"office_address"=> "Jl. Sukarjo Wiryopranoto No.7, Kb. Klp., Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10120, Indonesia",
							"office_city"=> "Kota Administratif Jakarta Pusat",
							"office_province"=> "DKI JAKARTA",
							"office_region"=> "CENTRAL JABOTABEK 2"
						),
						array(
							"office_id"=> "23487",
							"office_name"=> "BANK MANDIRI array(Jl. Karel Sasuit Tubun No.48b)",
							"office_address"=> "Jl. Karel Sasuit Tubun No.48b, Ngampilan, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55261, Indonesia",
							"office_city"=> "Kota Yogyakarta",
							"office_province"=> "DI YOGYAKARTA",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "23510",
							"office_name"=> "BANK MANDIRI array(Jl. H.O.S. Cokroaminoto No.31a)",
							"office_address"=> "Jl. H.O.S. Cokroaminoto No.31a, Pakuncen, Wirobrajan, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55253, Indonesia",
							"office_city"=> "Kota Yogyakarta",
							"office_province"=> "DI YOGYAKARTA",
							"office_region"=> "JATENG & DIY"
						),
						array(
							"office_id"=> "21149",
							"office_name"=> "Mandiri array(Jl. Veteran)",
							"office_address"=> "Jl. Veteran No. 1 Denpasar, 80111",
							"office_city"=> "Kota Denpasar",
							"office_province"=> "BALI",
							"office_region"=> "BALI NUSRA"
						),
						array(
							"office_id"=> "23600",
							"office_name"=> "BANK MANDIRI array(Jl. Teuku Umar No.186)",
							"office_address"=> "Jl. Teuku Umar No.186, Dauh Puri Kauh, Denpasar Bar., Kota Denpasar, Bali 80113, Indonesia",
							"office_city"=> "Kota Denpasar",
							"office_province"=> "BALI",
							"office_region"=> "BALI NUSRA"
						),
						array(
							"office_id"=> "23601",
							"office_name"=> "BANK MANDIRI array(Jl. By Pass Ngurah Rai No.515)",
							"office_address"=> "Jl. By Pass Ngurah Rai No.515, Pedungan, Denpasar Sel., Kota Denpasar, Bali 80222, Indonesia",
							"office_city"=> "Kota Denpasar",
							"office_province"=> "BALI",
							"office_region"=> "BALI NUSRA"
						),
						array(
							"office_id"=> "23602",
							"office_name"=> "BANK MANDIRI array(Jl. Wage Rudolf Supratman No.276)",
							"office_address"=> "Jl. Wage Rudolf Supratman No.276, Kesiman Kertalangu, Denpasar Tim., Kota Denpasar, Bali 80237, Indonesia",
							"office_city"=> "Kota Denpasar",
							"office_province"=> "BALI",
							"office_region"=> "BALI NUSRA"
						),
						array(
							"office_id"=> "23603",
							"office_name"=> "BANK MANDIRI array(Jl. Wage Rudolf Supratman No.282)",
							"office_address"=> "Jl. Wage Rudolf Supratman No.282, Kesiman Kertalangu, Denpasar Tim., Kota Denpasar, Bali 80237, Indonesia",
							"office_city"=> "Kota Denpasar",
							"office_province"=> "BALI",
							"office_region"=> "BALI NUSRA"
						),
						array(
							"office_id"=> "23604",
							"office_name"=> "BANK MANDIRI array(Jl. Gajah Mada No.1)",
							"office_address"=> "Jl. Gajah Mada No.1, Dauh Puri Kangin, Denpasar Bar., Kota Denpasar, Bali 80232, Indonesia",
							"office_city"=> "Kota Denpasar",
							"office_province"=> "BALI",
							"office_region"=> "BALI NUSRA"
						)
				)),

				array(
				'v1:account_id'=>'456','v1:account_name'=>'zxc','v1:domain_name'=>'domain_zxc','v1:address'=>'address_qwe','v1:region'=>'region_ghj','v1:office'=>
				array(
					array(
							"office_id"=> "9999",
							"office_name"=> "BANK SAT",
							"office_address"=> "Jl 2ABDULRAHAN aSDASD",
							"office_city"=> "Kota Medan",
							"office_province"=> "SUMATERA UTARA",
							"office_region"=> "SUMBAGUT"
						),
					array(
							"office_id"=> "9998",
							"office_name"=> "BANK MANDIRI array(Jl Kolonel Yos Sudarso)",
							"office_address"=> "Jl 2ASDADASD",
							"office_city"=> "Kota Medan",
							"office_province"=> "SUMATERA UTARA",
							"office_region"=> "SUMBAGUT"
						),
					array(
							"office_id"=> "9997",
							"office_name"=> "BANK MANDIRI array(Jl Kolonel Yos Sudarso)",
							"office_address"=> "Jl 2BRIGADIR",
							"office_city"=> "Kota Medan",
							"office_province"=> "SUMATERA UTARA",
							"office_region"=> "SUMBAGUT"
						),
					array(
							"office_id"=> "9996",
							"office_name"=> "BANK MANDIRI array(Jl Kolonel Yos Sudarso)",
							"office_address"=> "Jl 2WTFMOMENT",
							"office_city"=> "Kota Medan",
							"office_province"=> "SUMATERA UTARA",
							"office_region"=> "SUMBAGUT"
						),
				)),

				array(
				'v1:account_id'=>'789','v1:account_name'=>'adsfasfd','v1:domain_name'=>'domain_zpoi','v1:address'=>'address_opo','v1:region'=>'region_uio','v1:office'=>
				array(
					array(
							"office_id"=> "8886",
							"office_name"=> "BANK MANDIRI array(Jl Kolonel Yos Sudarso)",
							"office_address"=> "Kota 3LASDKAFSASF",
							"office_city"=> "Kota Medan",
							"office_province"=> "SUMATERA UTARA",
							"office_region"=> "SUMBAGUT"
						),
					array(
							"office_id"=> "8885",
							"office_name"=> "BANK MANDIRI array(Jl Kolonel Yos Sudarso)",
							"office_address"=> "KAB 3DAPFOASPF",
							"office_city"=> "Kota Medan",
							"office_province"=> "SUMATERA UTARA",
							"office_region"=> "SUMBAGUT"
						),
				)),

				array(
				'v1:account_id'=>'987','v1:account_name'=>'zxc','v1:domain_name'=>'domain_zxc','v1:address'=>'address_qwe','v1:region'=>'region_ghj','v1:office'=>
				array(
					array(
							"office_id"=> "4444",
							"office_name"=> "BANK SAT",
							"office_address"=> "Jl 4ADSGFAGADSF",
							"office_city"=> "Kota Medan",
							"office_province"=> "SUMATERA UTARA",
							"office_region"=> "SUMBAGUT"
						),
					array(
							"office_id"=> "9448",
							"office_name"=> "BANK MANDIRI array(Jl Kolonel Yos Sudarso)",
							"office_address"=> "Jl 4dafoiaasdfad",
							"office_city"=> "Kota Medan",
							"office_province"=> "SUMATERA UTARA",
							"office_region"=> "SUMBAGUT"
						),
					array(
							"office_id"=> "9447",
							"office_name"=> "BANK MANDIRI array(Jl Kolonel Yos Sudarso)",
							"office_address"=> "Jl 4aofoeroqw",
							"office_city"=> "Kota Medan",
							"office_province"=> "SUMATERA UTARA",
							"office_region"=> "SUMBAGUT"
						)
				)),

				array(
				'v1:account_id'=>'666','v1:account_name'=>'NONE','v1:domain_name'=>'domain_NONE','v1:address'=>'address_NONE','v1:region'=>'region_NONE'),

				array(
				'v1:account_id'=>'777','v1:account_name'=>'NONE1','v1:domain_name'=>'domain_NONE1','v1:address'=>'address_NONE1','v1:region'=>'region_NONE1'),

				);
				// Normalisasi Array
				foreach($headlines as $normal){
					$dig['account_id'] = (isset($normal['v1:account_id'])) ? $normal['v1:account_id'] :  '';
					$dig['account_name'] = (isset($normal['v1:account_name'])) ? $normal['v1:account_name'] :  '';
					$dig['domain_name'] = (isset($normal['v1:domain_name'])) ? $normal['v1:domain_name'] :  '';
					$dig['address'] = (isset($normal['v1:address'])) ? $normal['v1:address'] :  '';
					$dig['region'] = (isset($normal['v1:region'])) ? $normal['v1:region'] :  '';
					$dig['office'] = (isset($normal['v1:office'])) ? $normal['v1:office'] :  array(array('office_address'=>$normal['v1:address'],'office_id'=>$normal['v1:account_id'],'office_province'=>$normal['v1:region'],'office_region'=>$normal['v1:region']));
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
