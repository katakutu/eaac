<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi extends CI_Controller {

	/**
	 * @author : YOUR MOM
	 */
	function __construct(){
		parent::__construct();
		$this->load->helper(array('url','file'));
		$this->load->library('session');
		$this->load->database();
		$this->load->library('upload');
		$this->load->model('m_select');
		date_default_timezone_set('Asia/Jakarta');
		if(! $isFirstEmailExistSession = $this->session->userdata('email')){	redirect(base_url());	}
		if(!$this->session->userdata('isOTP')){	redirect('otp');	}
	} 
	
	public function index()
	{
		$data['prov'] = $this->m_select->show_prov()->result();
		//$this->session->userdata['insertion']['trx_id'] = $this->session->userdata['trx_id'];
		$this->load->gotoPage('v_RegistrasiForm',$data);
		//echo "<pre>";print_r($this->session->all_userdata());echo "</pre>";
		//echo "<script type='text/javascript'>alert('$message');</script>";
	}
	    
	public function submit()
	{	//if ($this->input->post('REQUEST_METHOD') == 'POST') {
		# Halaman 1 Part 1/2
		$infoGed = $this->input->post('infogedung');
		$sepAlamat=explode('|',$this->input->post('alamatkantor'));
		  $alamatKantor=$sepAlamat[1].'.  '.$infoGed;  
		  $data['ketKantor']=array('account_id'=>$sepAlamat[0],'account_address'=>$sepAlamat[1],'office_region'=>$sepAlamat[2],'office_id'=>$sepAlamat[3]);
		$region = $sepAlamat[2];
		$primaryMSISDN = $this->input->post('primaryMSISDN');
		$secondaryMSISDN = $this->input->post('secondaryMSISDN');
		$sepPackage=explode('|',$this->input->post('packagetype'));
			$packageType=$sepPackage[0];
			$data['ketPaket']=array('prod_id'=>$sepPackage[0],'prod_name'=>$sepPackage[1],'region'=>$sepPackage[2]);
		# Halamat 1 Part 2/2
		$fullName = $this->input->post('fullname');
		$noKTP = $this->input->post('noktp');
		$imageKTP = $this->uploadFile('imagektp',$fullName,'ktp');//$imageKTP = $this->input->post('imagektp');
		$imageNIP = $this->uploadFile('imagepeg',$fullName,'nip');//$imagePegawai = $this->input->post('imagepeg');
		$noKK = $this->input->post('nokk');
		
		# Halamat 2 Part 1/1
		$alamat = $this->input->post('deliveryaddress');
		$provinsi = $this->input->post('deliveryprovince');  $kota = $this->input->post('deliverycity');
		$kodePos = $this->input->post('kodepos');
		$birthPlace = $this->input->post('birthplace');
		$birthDate = $this->input->post('date');  $monthDate = $this->input->post('month');  $yearDate = $this->input->post('year');
		$tanggel = array('d=>$birthDate','m=>$monthDate','y=>$yearDate');$this->session->set_userdata($tanggel);
		# Halaman 2 Part 2/2
		$momName = $this->input->post('ibuname');
		$phoneNo = $this->input->post('phoneno');
		$emailRef = $this->input->post('emailref');
		#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~``
		$tanggalLahir = "{$yearDate}-{$monthDate}-{$birthDate}";
		$uploadFile_error_list = array($imageKTP,$imageNIP); //error saat upload file (salah format, kegedean , dll)
		#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~``
		$data['insertion'] = array(	
			'alamatkantor' => $alamatKantor,			'infogedung' => $infoGed,				'primarymsisdn' => $primaryMSISDN,
			'secondarymsisdn' => $secondaryMSISDN,		'packagetype' => $packageType,			'noktp' => $noKTP,
			'imagektp' => $imageKTP["full_path"],		'imagepeg' => $imageNIP["full_path"],	'nokk' => $noKK,
			'email' => $this->session->userdata['email'],
			'fullname' => $fullName,					'alamat' => $alamat,					'provinsi' => $provinsi,
			'kota' => $kota,							'kodepos' => $kodePos,					'tanggallahir' => $tanggalLahir,
			'tempatlahir'=>$birthPlace,					'region' => $region,					'submit_time' => date('Y-m-d H:i:s'),
			'namaibu' => $momName,						'phone' => $phoneNo,					'emailreferensi' => $emailRef
		);
		//echo "<pre>";print_r($data);echo "</pre>";
		//$this->db->insert('eprofile',$data);
		
		$this->session->set_userdata($data);
		redirect('registrasi/konfirmasi');
	
	}
	
	public function uploadFile($inputTypeName, $fullName, $ket)
	{
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name'] 			= date("Y-m-d")."_".$fullName;
        $config['max_size']             = 3072;
        $uploadPath						= $_SERVER['DOCUMENT_ROOT'];#C:/xampp/htdocs

        if($ket == 'ktp')
        {
        	$config['upload_path']		= $uploadPath.'/eaac/uploads/KTP';
        	$this->upload->initialize($config);
        	if ( ! $this->upload->do_upload($inputTypeName))
        	{return $this->upload->display_errors();}
        	else {return $this->upload->data();}
        }
        if($ket == 'nip')
        {
        	$config['upload_path']		= $uploadPath.'/eaac/uploads/NIP';
        	$this->upload->initialize($config);
        	if ( ! $this->upload->do_upload($inputTypeName))
        	{return $this->upload->display_errors();}
        	else {return $this->upload->data();}
        }
	}

	public function konfirmasi()
	{
		if(!array_key_exists('insertion',$this->session->all_userdata() ) ) {redirect('registrasi');}
		echo "<pre>";print_r($this->session->all_userdata());echo "</pre>";

		$this->load->gotoPage('v_RegisKonfirm');

		// HIT DUKCAPIL the 2nd time | Either Success or (NIK/KK) dont match still go to CIS
		$NIK = $this->session->userdata['insertion']['noktp'];
		$KK = $this->session->userdata['insertion']['nokk'];
		$msisdn = $this->session->userdata['insertion']['secondarymsisdn'];

		$body=sprintf(BODY_DUKCAPIL,$NIK,$KK,$msisdn,$this->session->userdata['trx_id']);
		$respDukcapil = $this->API($body,API_DUKCAPIL);
        $objErrCode = new DOMDocument();
        $objErrCode->loadXML($respDukcapil);
        $errCode = $objErrCode->getElementsByTagName("errorCode")->item(0)->nodeValue;
        $errMsg = $objErrCode->getElementsByTagName("errorMessage")->item(0)->nodeValue;
        //echo json_encode(array('errCode'=>$errCode,'errMsg'=>$errMsg));
        $isCapil = array( 'iscapil'     => $errMsg  );
        $this->session->set_userdata($isCapil);

        // INSERT API LOG
        try{$req = API_DUKCAPIL;
			$toSess = $this->session->userdata;
			$respCap = "STATUS = %s | DESC = %s";$respCap = sprintf($respCap,$errCode,$errMsg);
	    	$insertLog = "Insert intO api_log (trx_id,email,msisdn,request,response,exec_time,api_name) values (?,?,?,?,?,now(),?)";
			$this->db->query($insertLog,array($toSess['trx_id'],$toSess['email'],$msisdn,$req,$respCap,"API_DUKCAPIL"));}
		catch (Exception $e) {echo 'Caught exception: ',  $e->getMessage();}
        #echo "<script type='text/javascript'>alert('$errMsg');</script>";
        ////////////////////////////////////////////////////////////////////////////////
	}

	public function konfirmBatal()
	{
		$deleteUploadedKTP = $this->session->userdata['insertion']['imagektp'];
		$deleteUploadedNIP = $this->session->userdata['insertion']['imagepeg'];
		unlink($deleteUploadedKTP);
		unlink($deleteUploadedNIP);
		redirect('registrasi');
	}

	public function konfirmOK()
	{	$toSess = $this->session->userdata;	$msisdn = $toSess['insertion']['secondarymsisdn'];
		$deleteUploadedKTP = $toSess['insertion']['imagektp'];$deleteUploadedNIP = $toSess['insertion']['imagepeg'];
		// HIT API MSISDN RESERVE & INSERT TO API_LOG
		try{
			$respReser = $this->API_MSISDN_Reserve();
			$insertLog = "Insert intO api_log (trx_id,email,msisdn,request,response,exec_time,api_name) values (?,?,?,?,?,now(),?)";
			$req = API_SRM_MSISDN_RESERVE;
			$this->db->query($insertLog,array($toSess['trx_id'],$toSess['email'],$msisdn,$req,$respReser,"API_RESERVE_MSISDN"));

		// HIT API INSERT CIS & INSERT TO API_LOG
			$respCIS = $this->API_Add_CIS();
			$insertLog = "Insert intO api_log (trx_id,email,msisdn,request,response,exec_time,api_name) values (?,?,?,?,?,now(),?)";
			$req = API_INSERT_CIS;
			$this->db->query($insertLog,array($toSess['trx_id'],$toSess['email'],$msisdn,$req,$respCIS,"API_INSERT_CIS"));

		// Check if two or more customer pick same msisdn at the same time
			foreach($this->m_select->check_secondTime($msisdn) as $rezzz) 
			  {$isAvai=$rezzz['status'];	$when=$rezzz['taken_time'];}

			if($isAvai == 'unavailable') {
			  unlink($deleteUploadedKTP);	unlink($deleteUploadedNIP);
			  $minutes = round(abs(strtotime(date('Y-m-d H:i:s')) - strtotime($when)) / 60,0);
			  $seconds = abs(strtotime(date('Y-m-d H:i:s')) - strtotime($when)) % 60;
			  $timeDiff = "$minutes minute, $seconds seconds";
			  //$timeDiff = round(abs(strtotime(date('Y-m-d H:i:s')) - strtotime($when)) / 60,2). " minute";
			  echo "<script>alert('The number ".$msisdn." has been taken ".$timeDiff." ago\\nYou will be redirected to the registration page');document.location='".base_url('registrasi')."'</script>";
			die();}

		// UPDATE ACUAN_NOMOR_CANTIK --> update acuan_nomor_cantik set status='unavailable' where msisdn=[$msisdn]
			$this->db->set(array('status'=>'unavailable' , 'taken_time'=>date('Y-m-d H:i:s') ) );
			$this->db->where('msisdn', $msisdn);
			$this->db->update('acuan_nomor_cantik');

		// INSERT FORM TO DB
			$this->session->userdata['insertion']['trx_id'] = $toSess['trx_id'];
			$DEJA_VU = $this->session->all_userdata();
			#echo "<pre>";print_r($DEJA_VU['insertion']);echo "</pre>";
			$this->db->set($DEJA_VU['insertion']);
			$this->db->insert('eprofile');

			// CLEAR CACHE/SESSION/ETC
			$this->load->driver('cache');
		    $this->session->sess_destroy();
		    $this->cache->clean();
		    ob_clean();

			$this->load->gotoPage('v_RegisEnd');}
		catch (Exception $e) {echo 'Caught exception: ',  $e->getMessage();}
	}

	public function berhasil()
	{
		redirect (base_url());
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
	
	public function API_Dukcapil()
	{
		// if 		(strpos($response,'Success') !== false) {$qwe = 'Valid';}
		// else if 	(strpos($response,'Sesuai' ) !== false) {$qwe = 'Invalid';}
		// else if 	(strpos($response,'Tidak Ditemukan' ) !== false) {$qwe = 'Tidak Ditemukan';}
		// else if 	(strpos($response,'9001') !== false) {$qwe = 'Timeout';}
		// else if 	(strpos($response,'OSB') !== false) {$qwe = 'Error OSB';}
		// else 												{$qwe = 'Unknown Error';}
		// return $qwe;
		$NIK = $this->input->post('ktp');
		$KK = $this->input->post('kk');
		$msisdn = '6282162345656';

		$body=sprintf(BODY_DUKCAPIL,$NIK,$KK,$msisdn,$this->session->userdata['trx_id']);
		$respDukcapil = $this->API($body,API_DUKCAPIL);
		//echo $respDukcapil;
        $objErrCode = new DOMDocument();
        $objErrCode->loadXML($respDukcapil);
        $errCode = $objErrCode->getElementsByTagName("errorCode")->item(0)->nodeValue;
        $errMsg = $objErrCode->getElementsByTagName("errorMessage")->item(0)->nodeValue;
        //echo json_encode(array('errCode'=>$errCode,'errMsg'=>$errMsg));
        $isCapil = array( 'iscapil'     => $errMsg  );
        $this->session->set_userdata($isCapil);
        echo "Something went wrong...\n".$errCode." - ".$errMsg;//."<br>".$errMsg;
	}

	public function API_MSISDN_Reserve()
	{
		$toSess = $this->session->userdata['insertion'];
		$MSISDN = '628112014807';$MSISDN = $toSess['secondarymsisdn'];
		$body=sprintf(BODY_SRM_MSISDN_RESERVE,$MSISDN);
		$respGet = $this->API($body,API_SRM_MSISDN_RESERVE);
		$objGetEmAll = new DOMDocument();
        $objGetEmAll->loadXML($respGet);

        $errCode = $objGetEmAll->getElementsByTagName("errorCode")->item(0)->nodeValue;
        $errMsg = $objGetEmAll->getElementsByTagName("errorMessage")->item(0)->nodeValue;
        $trxReserve = $objGetEmAll->getElementsByTagName("trx_id")->item(0)->nodeValue;

        try{
	        if($errCode == '0000' && $errMsg == 'Success' )
	        {
	        	// Response from API
	        	$response = "STATUS = %s | DESC = %s | RESERVE_ID = %s";
	        	$response = sprintf($response,$errCode,$errMsg,$trxReserve);
	        	$this->session->userdata['insertion']['reserve_id'] = $trxReserve;
	        	return $response;
	        }else{
	        	$response = "STATUS = ".$errCode." | DESC = ".$errMsg."";
	        	return $response;
	        }
    	}
        catch (Exception $e) {echo 'Caught exception: ',  $e->getMessage();}
		//$dataFinal = json_decode(json_encode((array)$body), TRUE); 
		
		####echo "<pre>";print_r($dataFinal);

		//echo json_encode($dataFinal);
	}

	public function API_Add_CIS()
	{	$mySess=$this->session->userdata;
		try{
			$myList = $mySess['insertion'];$trxku = $mySess['trx_id'];
			$NIK = base64_encode(file_get_contents($myList['imagektp']));
			$KK = base64_encode(file_get_contents($myList['imagepeg']));
			$accountID=$mySess['ketKantor']['account_id'];	$officeID=$mySess['ketKantor']['office_id'];
			$isCapil = ($mySess['iscapil'] == 'Success' ? 'VALID' : 'INVALID');
			$listInsert = array
			(
				$myList['packagetype'],$myList['email'],$myList['secondarymsisdn'],$myList['nokk'],$myList['noktp'],
				$myList['fullname'],$myList['namaibu'],$myList['alamat'],date('d-m-Y',strtotime($myList['tanggallahir'])),
				$myList['tempatlahir'],$myList['kota'],$myList['provinsi'],$myList['region'],$myList['kodepos'],$myList['phone'],
				$myList['emailreferensi'],($KK),($NIK),$isCapil,$trxku
			);//echo "<pre>";print_r($listInsert);die();
			$body=vsprintf(BODY_INSERT_CIS,$listInsert);
			$respGet = $this->API($body,API_INSERT_CIS);
			$objGetEmAll = new DOMDocument();
	        $objGetEmAll->loadXML($respGet);

	        $errCode = $objGetEmAll->getElementsByTagName("error_code")->item(0)->nodeValue;
	        $errMsg = $objGetEmAll->getElementsByTagName("error_msg")->item(0)->nodeValue;
	        $trxID = $objGetEmAll->getElementsByTagName("trx_id")->item(0)->nodeValue;
	        $message = $objGetEmAll->getElementsByTagName("message")->item(0)->nodeValue;
	        $request_id = $objGetEmAll->getElementsByTagName("request_id")->item(0)->nodeValue;

	        if($errCode == '0000' && $errMsg == 'Success' )
	        {
	        	// SEND EMAIL` REQUEST_ID TO CUSTOMER
				/*$ip = API_EMAIL_CLAUDIA;
				$to = $this->session->userdata['email'];
				$from = "noreply.EAAC@telkomsel.co.id";
				$cc = "";
				$subject = "REQUEST_ID";
				$message = sprintf(MSG_REQ,$to,$request_id);
				$API = urlencode(sprintf($ip,$to,$from,$cc,$subject,$message));
				$APIend = file_get_contents($API);*/

				// Response from API
	        	$response = "STATUS = %s | REQ_ID = %s | MESSAGE = %s | ACC_ID = %s | OFF_ID = %s";
	        	$response = sprintf($response,$errCode,$request_id,$message,$accountID,$officeID);
	        	$this->session->userdata['insertion']['req_id'] = $request_id;
	        	return $response;
	        }else{
	        	$response = "STATUS = ".$errCode." | DESC = ".$errMsg."";
	        	return $response;}
	    }
        catch (Exception $e) {echo 'Caught exception: ',  $e->getMessage();}
		//$dataFinal = json_decode(json_encode((array)$body), TRUE); 
		####echo "<pre>";print_r($dataFinal);
		//echo json_encode($dataFinal);
	}

	public function API_MSISDN_Get()
	{
		$wildNumber = $this->input->post('toserverFind');
		$region = $this->input->post('toserverFindz');
        $listNumber = $this->get_msisdn($wildNumber,$region);
        //$show5Msis = $this->m_select->show_msisdn($wildNumber);
		#####$listNumber = array('62812222001','62812222002','62812222003','62812222004','62812222005'
      	echo json_encode($listNumber);
	}
	function get_msisdn($wildNumber,$region)
    {		
    	# Search MSISDN through DB
		$show5Msis = $this->m_select->show_msisdn($wildNumber,$region);
    	if($show5Msis)
    	{ foreach($show5Msis as $msis){$listNumber[] = $msis['msisdn'];} }
    	else{$listNumber[] ="NO MSISDN FOUND";}
    	return $listNumber;
		
		# Search MSISDN through SRM
		/*$body=sprintf(BODY_SRM_MSISDN_LIST,$wildNumber);
		$respGet = $this->API($body,API_SRM_MSISDN_LIST);
		$objGetEmAll = new DOMDocument();
        $objGetEmAll->loadXML($respGet);
        $errCode = $objGetEmAll->getElementsByTagName("errorCode")->item(0)->nodeValue;
        $errMsg = $objGetEmAll->getElementsByTagName("errorMessage")->item(0)->nodeValue;
        //$isAvailable = $objGetEmAll->getElementsByTagName("status")->item(0)->nodeValue;
        if($errCode == '0000' && $errMsg == 'Success' )
        {
        	$numbers = $objGetEmAll->getElementsByTagName('value');
        	foreach ($numbers as $number) {$listNumber[] = $number->nodeValue;}
        }else if($errCode == '9999' && $errMsg == 'Failed') {
        		$listNumber[] = 'No Response';
        }else {$listNumber = array('NO MSISDN FOUNDs');}

        if(isset($listNumber)){
        	return $listNumber;
        } else{
        	return $listNumber = array('NO MSISDN FOUND');
        }*/
        //echo '<pre>';print_r($listNumber);echo '</pre>';
    }

    public function API_List_Package()
	{	$toSess = $this->session->userdata;
		$account_ID = $this->input->post('accID');

        $body=sprintf(BODY_SRM_OFFER_LIST,$account_ID,$toSess['trx_id']);
		$respGet = $this->API($body,API_SRM_OFFER_LIST);
		$objGetEmAll = new DOMDocument();
        $objGetEmAll->loadXML($respGet);

        $errCode = $objGetEmAll->getElementsByTagName("error_code")->item(0)->nodeValue;
        $errMsg = $objGetEmAll->getElementsByTagName("error_msg")->item(0)->nodeValue;
        $totalRow = $objGetEmAll->getElementsByTagName("total")->item(0)->nodeValue;

        if($errCode == '0000' && $errMsg == 'Success' && $totalRow > 0)
        {
        	// INSERT API LOG
			$respOff = "STATUS = %s | DESC = %s | ACC_ID = %s | TotalListOffer = %s";$respOff = sprintf($respOff,$errCode,$errMsg,$account_ID,$totalRow);
	    	$insertLog = "Insert intO api_log (trx_id,email,msisdn,request,response,exec_time,api_name) values (?,?,?,?,?,now(),?)";
			$req = API_SRM_OFFER_LIST;
			$this->db->query($insertLog,array($toSess['trx_id'],$toSess['email'],"NA",$req,$respOff,"API_LIST_OFFER"));

        	// AJAX
	        $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $respGet);
			$xml = new SimpleXMLElement($response);
			$body = $xml->xpath('//v1data');
			$dataFinal = json_decode(json_encode((array)$body), TRUE);

			// Normalisasi Array jika Hanya ada SATU JENIS PACKAGE (ex:sms saja / voice saja)
			foreach($dataFinal as $z=>$data){
				if(!isset($data['v1product_desc'][0]))
				{$dataFinal[$z]['v1product_desc']= array(array('v1name'=>$dataFinal[$z]['v1product_desc']['v1name'],'v1unit'=>$dataFinal[$z]['v1product_desc']['v1unit'],'v1value'=>$dataFinal[$z]['v1product_desc']['v1value']));}
			}

			// Normalisasi Array jika tidak ada elemen <v1unit> ATAU elemen <v1unit> bervalue 'null'
			foreach($dataFinal as $z=>$kill){
				foreach($kill['v1product_desc'] as $x=>$lol){
					$dataFinal[$z]['v1product_desc'][$x]['v1unit'] = (!isset($lol['v1value']) || $lol['v1unit']=='null' ) ? '' :  $lol['v1unit'];
				}
			}
			//echo "<pre>";print_r($dataFinal);die();
			echo json_encode($dataFinal);
		}
		else{echo json_encode(array("NO LIST OFFER"));}

		// HIT API MSISDN RESERVE
		#####$listNumber = array('62812222001','62812222002','62812222003','62812222004','62812222005'
      	#####echo json_encode($listNumber);
	}

    ################################ FOR SELECT  ######################

    function ambil_data()
    {
    	$id=$this->input->post('id');
        $query = $this->m_select->show_kota($id);
        $dataKota = array( 'kota'     => $query  );
		$this->session->set_userdata($dataKota);

        foreach ($query as $row)	{$data[] = $row['kota'];}
        ##$data = array('a','b','c');
        echo json_encode($data);
        #echo $id.' HOHO';
    }

    function storeMe()
    {
    	$HTMLOfferList=$this->input->post('storeMe');
    	$this->session->set_userdata(array('lastOfferList'=>$HTMLOfferList));
    	echo 'OK';
    }

}

/*	- api insert cis | tambah trxreq | api log | 
	#################
	#YG KURANG
	# - Nyimpen path file ke MySQL 			X
	# - API Check mana mari
	# - Client & Server Side Validation
	CREATE TABLE `acuan_alamat_kantor` ( 
		`id_kantor` integer NOT NULL auto_increment , 
		`alamat_kantor` text NOT NULL, 
		constraint PK_KANTOR primary key (id_kantor) 
	) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=latin1


	CREATE TABLE `acuan_tipe_package` ( 
		`id_package` integer NOT NULL auto_increment , 
		`nama_package` varchar(255) NOT NULL, 
		constraint PK_PACKAGE primary key (id_package) 
	) ENGINE=InnoDB AUTO_INCREMENT=3000 DEFAULT CHARSET=latin1

	CREATE TABLE `acuan_nomor_cantik` ( 
	    `id_no_cantik` integer NOT NULL auto_increment , 
	     msisdn varchar(25) not null,
	    `status` enum('available','unavailable') NOT NULL  DEFAULT 'unavailable', 
	    constraint PK_NOCANTIK primary key (id_no_cantik) 
	) ENGINE=InnoDB AUTO_INCREMENT=8000 DEFAULT CHARSET=latin1
	#################
	CREATE TABLE `acuan_provinsi` (
	  `id_provinsi` int(11) NOT NULL auto_increment ,
	  `provinsi` varchar(255) NOT NULL,
	  `ibukota` varchar(255) NOT NULL,
	  constraint PK_PROFILE primary key (id_provinsi)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

	CREATE TABLE IF NOT EXISTS `acuan_kota` (
	  `id_kota` int(11) NOT NULL auto_increment,
	  `id_provinsi` int(11) NOT NULL,
	  `kota` varchar(255)  NOT NULL,
	  constraint PK_KOTA primary key (id_kota),
	  CONSTRAINT FK_KOTA_PROV FOREIGN KEY (`id_provinsi`) REFERENCES `acuan_provinsi` (`id_provinsi`)
	) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=latin1;
	#################
	INSERT INTO `acuan_provinsi` VALUES
	  ('11', 'ACEH'),
	  ('12', 'SUMATERA UTARA'),
	  ('13', 'SUMATERA BARAT'),
	  ('14', 'RIAU'),
	  ('15', 'JAMBI'),
	  ('16', 'SUMATERA SELATAN'),
	  ('17', 'BENGKULU'),
	  ('18', 'LAMPUNG'),
	  ('19', 'KEPULAUAN BANGKA BELITUNG'),
	  ('21', 'KEPULAUAN RIAU'),
	  ('31', 'DKI JAKARTA'),
	  ('32', 'JAWA BARAT'),
	  ('33', 'JAWA TENGAH'),
	  ('34', 'DI YOGYAKARTA'),
	  ('35', 'JAWA TIMUR'),
	  ('36', 'BANTEN'),
	  ('51', 'BALI'),
	  ('52', 'NUSA TENGGARA BARAT'),
	  ('53', 'NUSA TENGGARA TIMUR'),
	  ('61', 'KALIMANTAN BARAT'),
	  ('62', 'KALIMANTAN TENGAH'),
	  ('63', 'KALIMANTAN SELATAN'),
	  ('64', 'KALIMANTAN TIMUR'),
	  ('65', 'KALIMANTAN UTARA'),
	  ('71', 'SULAWESI UTARA'),
	  ('72', 'SULAWESI TENGAH'),
	  ('73', 'SULAWESI SELATAN'),
	  ('74', 'SULAWESI TENGGARA'),
	  ('75', 'GORONTALO'),
	  ('76', 'SULAWESI BARAT'),
	  ('81', 'MALUKU'),
	  ('82', 'MALUKU UTARA'),
	  ('91', 'PAPUA BARAT'),
	  ('94', 'PAPUA');
	insert into acuan_kota values
	('1101', '11', 'Kab. Simeulue'),
	('1102', '11', 'Kab. Aceh Singkil'),
	('1103', '11', 'Kab. Aceh Selatan'),
	('1104', '11', 'Kab. Aceh Tenggara'),
	('1105', '11', 'Kab. Aceh Timur'),
	('1106', '11', 'Kab. Aceh Tengah'),
	('1107', '11', 'Kab. Aceh Barat'),
	('1108', '11', 'Kab. Aceh Besar'),
	('1109', '11', 'Kab. Pidie'),
	('1110', '11', 'Kab. Bireuen'),
	('1111', '11', 'Kab. Aceh Utara'),
	('1112', '11', 'Kab. Aceh Barat Daya'),
	('1113', '11', 'Kab. Gayo Lues'),
	('1114', '11', 'Kab. Aceh Tamiang'),
	('1115', '11', 'Kab. Nagan Raya'),
	('1116', '11', 'Kab. Aceh Jaya'),
	('1117', '11', 'Kab. Bener Meriah'),
	('1118', '11', 'Kab. Pidie Jaya'),
	('1171', '11', 'Kota Banda Aceh'),
	('1172', '11', 'Kota Sabang'),
	('1173', '11', 'Kota Langsa'),
	('1174', '11', 'Kota Lhokseumawe'),
	('1175', '11', 'Kota Subulussalam'),
	('1201', '12', 'Kab. Nias'),
	('1202', '12', 'Kab. Mandailing Natal'),
	('1203', '12', 'Kab. Tapanuli Selatan'),
	('1204', '12', 'Kab. Tapanuli Tengah'),
	('1205', '12', 'Kab. Tapanuli Utara'),
	('1206', '12', 'Kab. Toba Samosir'),
	('1207', '12', 'Kab. Labuhan Batu'),
	('1208', '12', 'Kab. Asahan'),
	('1209', '12', 'Kab. Simalungun'),
	('1210', '12', 'Kab. Dairi'),
	('1211', '12', 'Kab. Karo'),
	('1212', '12', 'Kab. Deli Serdang'),
	('1213', '12', 'Kab. Langkat'),
	('1214', '12', 'Kab. Nias Selatan'),
	('1215', '12', 'Kab. Humbang Hasundutan'),
	('1216', '12', 'Kab. Pakpak Bharat'),
	('1217', '12', 'Kab. Samosir'),
	('1218', '12', 'Kab. Serdang Bedagai'),
	('1219', '12', 'Kab. Batu Bara'),
	('1220', '12', 'Kab. Padang Lawas Utara'),
	('1221', '12', 'Kab. Padang Lawas'),
	('1222', '12', 'Kab. Labuhan Batu Selatan'),
	('1223', '12', 'Kab. Labuhan Batu Utara'),
	('1224', '12', 'Kab. Nias Utara'),
	('1225', '12', 'Kab. Nias Barat'),
	('1271', '12', 'Kota Sibolga'),
	('1272', '12', 'Kota Tanjung Balai'),
	('1273', '12', 'Kota Pematang Siantar'),
	('1274', '12', 'Kota Tebing Tinggi'),
	('1275', '12', 'Kota Medan'),
	('1276', '12', 'Kota Binjai'),
	('1277', '12', 'Kota Padangsidimpuan'),
	('1278', '12', 'Kota Gunungsitoli'),
	('1301', '13', 'Kab. Kepulauan Mentawai'),
	('1302', '13', 'Kab. Pesisir Selatan'),
	('1303', '13', 'Kab. Solok'),
	('1304', '13', 'Kab. Sijunjung'),
	('1305', '13', 'Kab. Tanah Datar'),
	('1306', '13', 'Kab. Padang Pariaman'),
	('1307', '13', 'Kab. Agam'),
	('1308', '13', 'Kab. Lima Puluh Kota'),
	('1309', '13', 'Kab. Pasaman'),
	('1310', '13', 'Kab. Solok Selatan'),
	('1311', '13', 'Kab. Dharmasraya'),
	('1312', '13', 'Kab. Pasaman Barat'),
	('1371', '13', 'Kota Padang'),
	('1372', '13', 'Kota Solok'),
	('1373', '13', 'Kota Sawah Lunto'),
	('1374', '13', 'Kota Padang Panjang'),
	('1375', '13', 'Kota Bukittinggi'),
	('1376', '13', 'Kota Payakumbuh'),
	('1377', '13', 'Kota Pariaman'),
	('1401', '14', 'Kab. Kuantan Singingi'),
	('1402', '14', 'Kab. Indragiri Hulu'),
	('1403', '14', 'Kab. Indragiri Hilir'),
	('1404', '14', 'Kab. Pelalawan'),
	('1405', '14', 'Kab. Siak'),
	('1406', '14', 'Kab. Kampar'),
	('1407', '14', 'Kab. Rokan Hulu'),
	('1408', '14', 'Kab. Bengkalis'),
	('1409', '14', 'Kab. Rokan Hilir'),
	('1410', '14', 'Kab. Kepulauan Meranti'),
	('1471', '14', 'Kota Pekanbaru'),
	('1473', '14', 'Kota Dumai'),
	('1501', '15', 'Kab. Kerinci'),
	('1502', '15', 'Kab. Merangin'),
	('1503', '15', 'Kab. Sarolangun'),
	('1504', '15', 'Kab. Batang Hari'),
	('1505', '15', 'Kab. Muaro Jambi'),
	('1506', '15', 'Kab. Tanjung Jabung Timur'),
	('1507', '15', 'Kab. Tanjung Jabung Barat'),
	('1508', '15', 'Kab. Tebo'),
	('1509', '15', 'Kab. Bungo'),
	('1571', '15', 'Kota Jambi'),
	('1572', '15', 'Kota Sungai Penuh'),
	('1601', '16', 'Kab. Ogan Komering Ulu'),
	('1602', '16', 'Kab. Ogan Komering Ilir'),
	('1603', '16', 'Kab. Muara Enim'),
	('1604', '16', 'Kab. Lahat'),
	('1605', '16', 'Kab. Musi Rawas'),
	('1606', '16', 'Kab. Musi Banyuasin'),
	('1607', '16', 'Kab. Banyu Asin'),
	('1608', '16', 'Kab. Ogan Komering Ulu Selatan'),
	('1609', '16', 'Kab. Ogan Komering Ulu Timur'),
	('1610', '16', 'Kab. Ogan Ilir'),
	('1611', '16', 'Kab. Empat Lawang'),
	('1612', '16', 'Kab. Penukal Abab Lematang Ilir'),
	('1613', '16', 'Kab. Musi Rawas Utara'),
	('1671', '16', 'Kota Palembang'),
	('1672', '16', 'Kota Prabumulih'),
	('1673', '16', 'Kota Pagar Alam'),
	('1674', '16', 'Kota Lubuklinggau'),
	('1701', '17', 'Kab. Bengkulu Selatan'),
	('1702', '17', 'Kab. Rejang Lebong'),
	('1703', '17', 'Kab. Bengkulu Utara'),
	('1704', '17', 'Kab. Kaur'),
	('1705', '17', 'Kab. Seluma'),
	('1706', '17', 'Kab. Mukomuko'),
	('1707', '17', 'Kab. Lebong'),
	('1708', '17', 'Kab. Kepahiang'),
	('1709', '17', 'Kab. Bengkulu Tengah'),
	('1771', '17', 'Kota Bengkulu'),
	('1801', '18', 'Kab. Lampung Barat'),
	('1802', '18', 'Kab. Tanggamus'),
	('1803', '18', 'Kab. Lampung Selatan'),
	('1804', '18', 'Kab. Lampung Timur'),
	('1805', '18', 'Kab. Lampung Tengah'),
	('1806', '18', 'Kab. Lampung Utara'),
	('1807', '18', 'Kab. Way Kanan'),
	('1808', '18', 'Kab. Tulangbawang'),
	('1809', '18', 'Kab. Pesawaran'),
	('1810', '18', 'Kab. Pringsewu'),
	('1811', '18', 'Kab. Mesuji'),
	('1812', '18', 'Kab. Tulang Bawang Barat'),
	('1813', '18', 'Kab. Pesisir Barat'),
	('1871', '18', 'Kota Bandar Lampung'),
	('1872', '18', 'Kota Metro'),
	('1901', '19', 'Kab. Bangka'),
	('1902', '19', 'Kab. Belitung'),
	('1903', '19', 'Kab. Bangka Barat'),
	('1904', '19', 'Kab. Bangka Tengah'),
	('1905', '19', 'Kab. Bangka Selatan'),
	('1906', '19', 'Kab. Belitung Timur'),
	('1971', '19', 'Kota Pangkal Pinang'),
	('2101', '21', 'Kab. Karimun'),
	('2102', '21', 'Kab. Bintan'),
	('2103', '21', 'Kab. Natuna'),
	('2104', '21', 'Kab. Lingga'),
	('2105', '21', 'Kab. Kepulauan Anambas'),
	('2171', '21', 'Kota Batam'),
	('2172', '21', 'Kota Tanjung Pinang'),
	('3101', '31', 'Kab. Kepulauan Seribu'),
	('3171', '31', 'Kota Jakarta Selatan'),
	('3172', '31', 'Kota Jakarta Timur'),
	('3173', '31', 'Kota Jakarta Pusat'),
	('3174', '31', 'Kota Jakarta Barat'),
	('3175', '31', 'Kota Jakarta Utara'),
	('3201', '32', 'Kab. Bogor'),
	('3202', '32', 'Kab. Sukabumi'),
	('3203', '32', 'Kab. Cianjur'),
	('3204', '32', 'Kab. Bandung'),
	('3205', '32', 'Kab. Garut'),
	('3206', '32', 'Kab. Tasikmalaya'),
	('3207', '32', 'Kab. Ciamis'),
	('3208', '32', 'Kab. Kuningan'),
	('3209', '32', 'Kab. Cirebon'),
	('3210', '32', 'Kab. Majalengka'),
	('3211', '32', 'Kab. Sumedang'),
	('3212', '32', 'Kab. Indramayu'),
	('3213', '32', 'Kab. Subang'),
	('3214', '32', 'Kab. Purwakarta'),
	('3215', '32', 'Kab. Karawang'),
	('3216', '32', 'Kab. Bekasi'),
	('3217', '32', 'Kab. Bandung Barat'),
	('3218', '32', 'Kab. Pangandaran'),
	('3271', '32', 'Kota Bogor'),
	('3272', '32', 'Kota Sukabumi'),
	('3273', '32', 'Kota Bandung'),
	('3274', '32', 'Kota Cirebon'),
	('3275', '32', 'Kota Bekasi'),
	('3276', '32', 'Kota Depok'),
	('3277', '32', 'Kota Cimahi'),
	('3278', '32', 'Kota Tasikmalaya'),
	('3279', '32', 'Kota Banjar'),
	('3301', '33', 'Kab. Cilacap'),
	('3302', '33', 'Kab. Banyumas'),
	('3303', '33', 'Kab. Purbalingga'),
	('3304', '33', 'Kab. Banjarnegara'),
	('3305', '33', 'Kab. Kebumen'),
	('3306', '33', 'Kab. Purworejo'),
	('3307', '33', 'Kab. Wonosobo'),
	('3308', '33', 'Kab. Magelang'),
	('3309', '33', 'Kab. Boyolali'),
	('3310', '33', 'Kab. Klaten'),
	('3311', '33', 'Kab. Sukoharjo'),
	('3312', '33', 'Kab. Wonogiri'),
	('3313', '33', 'Kab. Karanganyar'),
	('3314', '33', 'Kab. Sragen'),
	('3315', '33', 'Kab. Grobogan'),
	('3316', '33', 'Kab. Blora'),
	('3317', '33', 'Kab. Rembang'),
	('3318', '33', 'Kab. Pati'),
	('3319', '33', 'Kab. Kudus'),
	('3320', '33', 'Kab. Jepara'),
	('3321', '33', 'Kab. Demak'),
	('3322', '33', 'Kab. Semarang'),
	('3323', '33', 'Kab. Temanggung'),
	('3324', '33', 'Kab. Kendal'),
	('3325', '33', 'Kab. Batang'),
	('3326', '33', 'Kab. Pekalongan'),
	('3327', '33', 'Kab. Pemalang'),
	('3328', '33', 'Kab. Tegal'),
	('3329', '33', 'Kab. Brebes'),
	('3371', '33', 'Kota Magelang'),
	('3372', '33', 'Kota Surakarta'),
	('3373', '33', 'Kota Salatiga'),
	('3374', '33', 'Kota Semarang'),
	('3375', '33', 'Kota Pekalongan'),
	('3376', '33', 'Kota Tegal'),
	('3401', '34', 'Kab. Kulon Progo'),
	('3402', '34', 'Kab. Bantul'),
	('3403', '34', 'Kab. Gunung Kidul'),
	('3404', '34', 'Kab. Sleman'),
	('3471', '34', 'Kota Yogyakarta'),
	('3501', '35', 'Kab. Pacitan'),
	('3502', '35', 'Kab. Ponorogo'),
	('3503', '35', 'Kab. Trenggalek'),
	('3504', '35', 'Kab. Tulungagung'),
	('3505', '35', 'Kab. Blitar'),
	('3506', '35', 'Kab. Kediri'),
	('3507', '35', 'Kab. Malang'),
	('3508', '35', 'Kab. Lumajang'),
	('3509', '35', 'Kab. Jember'),
	('3510', '35', 'Kab. Banyuwangi'),
	('3511', '35', 'Kab. Bondowoso'),
	('3512', '35', 'Kab. Situbondo'),
	('3513', '35', 'Kab. Probolinggo'),
	('3514', '35', 'Kab. Pasuruan'),
	('3515', '35', 'Kab. Sidoarjo'),
	('3516', '35', 'Kab. Mojokerto'),
	('3517', '35', 'Kab. Jombang'),
	('3518', '35', 'Kab. Nganjuk'),
	('3519', '35', 'Kab. Madiun'),
	('3520', '35', 'Kab. Magetan'),
	('3521', '35', 'Kab. Ngawi'),
	('3522', '35', 'Kab. Bojonegoro'),
	('3523', '35', 'Kab. Tuban'),
	('3524', '35', 'Kab. Lamongan'),
	('3525', '35', 'Kab. Gresik'),
	('3526', '35', 'Kab. Bangkalan'),
	('3527', '35', 'Kab. Sampang'),
	('3528', '35', 'Kab. Pamekasan'),
	('3529', '35', 'Kab. Sumenep'),
	('3571', '35', 'Kota Kediri'),
	('3572', '35', 'Kota Blitar'),
	('3573', '35', 'Kota Malang'),
	('3574', '35', 'Kota Probolinggo'),
	('3575', '35', 'Kota Pasuruan'),
	('3576', '35', 'Kota Mojokerto'),
	('3577', '35', 'Kota Madiun'),
	('3578', '35', 'Kota Surabaya'),
	('3579', '35', 'Kota Batu'),
	('3601', '36', 'Kab. Pandeglang'),
	('3602', '36', 'Kab. Lebak'),
	('3603', '36', 'Kab. Tangerang'),
	('3604', '36', 'Kab. Serang'),
	('3671', '36', 'Kota Tangerang'),
	('3672', '36', 'Kota Cilegon'),
	('3673', '36', 'Kota Serang'),
	('3674', '36', 'Kota Tangerang Selatan'),
	('5101', '51', 'Kab. Jembrana'),
	('5102', '51', 'Kab. Tabanan'),
	('5103', '51', 'Kab. Badung'),
	('5104', '51', 'Kab. Gianyar'),
	('5105', '51', 'Kab. Klungkung'),
	('5106', '51', 'Kab. Bangli'),
	('5107', '51', 'Kab. Karang Asem'),
	('5108', '51', 'Kab. Buleleng'),
	('5171', '51', 'Kota Denpasar'),
	('5201', '52', 'Kab. Lombok Barat'),
	('5202', '52', 'Kab. Lombok Tengah'),
	('5203', '52', 'Kab. Lombok Timur'),
	('5204', '52', 'Kab. Sumbawa'),
	('5205', '52', 'Kab. Dompu'),
	('5206', '52', 'Kab. Bima'),
	('5207', '52', 'Kab. Sumbawa Barat'),
	('5208', '52', 'Kab. Lombok Utara'),
	('5271', '52', 'Kota Mataram'),
	('5272', '52', 'Kota Bima'),
	('5301', '53', 'Kab. Sumba Barat'),
	('5302', '53', 'Kab. Sumba Timur'),
	('5303', '53', 'Kab. Kupang'),
	('5304', '53', 'Kab. Timor Tengah Selatan'),
	('5305', '53', 'Kab. Timor Tengah Utara'),
	('5306', '53', 'Kab. Belu'),
	('5307', '53', 'Kab. Alor'),
	('5308', '53', 'Kab. Lembata'),
	('5309', '53', 'Kab. Flores Timur'),
	('5310', '53', 'Kab. Sikka'),
	('5311', '53', 'Kab. Ende'),
	('5312', '53', 'Kab. Ngada'),
	('5313', '53', 'Kab. Manggarai'),
	('5314', '53', 'Kab. Rote Ndao'),
	('5315', '53', 'Kab. Manggarai Barat'),
	('5316', '53', 'Kab. Sumba Tengah'),
	('5317', '53', 'Kab. Sumba Barat Daya'),
	('5318', '53', 'Kab. Nagekeo'),
	('5319', '53', 'Kab. Manggarai Timur'),
	('5320', '53', 'Kab. Sabu Raijua'),
	('5321', '53', 'Kab. Malaka'),
	('5371', '53', 'Kota Kupang'),
	('6101', '61', 'Kab. Sambas'),
	('6102', '61', 'Kab. Bengkayang'),
	('6103', '61', 'Kab. Landak'),
	('6104', '61', 'Kab. Mempawah'),
	('6105', '61', 'Kab. Sanggau'),
	('6106', '61', 'Kab. Ketapang'),
	('6107', '61', 'Kab. Sintang'),
	('6108', '61', 'Kab. Kapuas Hulu'),
	('6109', '61', 'Kab. Sekadau'),
	('6110', '61', 'Kab. Melawi'),
	('6111', '61', 'Kab. Kayong Utara'),
	('6112', '61', 'Kab. Kubu Raya'),
	('6171', '61', 'Kota Pontianak'),
	('6172', '61', 'Kota Singkawang'),
	('6201', '62', 'Kab. Kotawaringin Barat'),
	('6202', '62', 'Kab. Kotawaringin Timur'),
	('6203', '62', 'Kab. Kapuas'),
	('6204', '62', 'Kab. Barito Selatan'),
	('6205', '62', 'Kab. Barito Utara'),
	('6206', '62', 'Kab. Sukamara'),
	('6207', '62', 'Kab. Lamandau'),
	('6208', '62', 'Kab. Seruyan'),
	('6209', '62', 'Kab. Katingan'),
	('6210', '62', 'Kab. Pulang Pisau'),
	('6211', '62', 'Kab. Gunung Mas'),
	('6212', '62', 'Kab. Barito Timur'),
	('6213', '62', 'Kab. Murung Raya'),
	('6271', '62', 'Kota Palangka Raya'),
	('6301', '63', 'Kab. Tanah Laut'),
	('6302', '63', 'Kab. Kota Baru'),
	('6303', '63', 'Kab. Banjar'),
	('6304', '63', 'Kab. Barito Kuala'),
	('6305', '63', 'Kab. Tapin'),
	('6306', '63', 'Kab. Hulu Sungai Selatan'),
	('6307', '63', 'Kab. Hulu Sungai Tengah'),
	('6308', '63', 'Kab. Hulu Sungai Utara'),
	('6309', '63', 'Kab. Tabalong'),
	('6310', '63', 'Kab. Tanah Bumbu'),
	('6311', '63', 'Kab. Balangan'),
	('6371', '63', 'Kota Banjarmasin'),
	('6372', '63', 'Kota Banjar Baru'),
	('6401', '64', 'Kab. Paser'),
	('6402', '64', 'Kab. Kutai Barat'),
	('6403', '64', 'Kab. Kutai Kartanegara'),
	('6404', '64', 'Kab. Kutai Timur'),
	('6405', '64', 'Kab. Berau'),
	('6409', '64', 'Kab. Penajam Paser Utara'),
	('6411', '64', 'Kab. Mahakam Hulu'),
	('6471', '64', 'Kota Balikpapan'),
	('6472', '64', 'Kota Samarinda'),
	('6474', '64', 'Kota Bontang'),
	('6501', '65', 'Kab. Malinau'),
	('6502', '65', 'Kab. Bulungan'),
	('6503', '65', 'Kab. Tana Tidung'),
	('6504', '65', 'Kab. Nunukan'),
	('6571', '65', 'Kota Tarakan'),
	('7101', '71', 'Kab. Bolaang Mongondow'),
	('7102', '71', 'Kab. Minahasa'),
	('7103', '71', 'Kab. Kepulauan Sangihe'),
	('7104', '71', 'Kab. Kepulauan Talaud'),
	('7105', '71', 'Kab. Minahasa Selatan'),
	('7106', '71', 'Kab. Minahasa Utara'),
	('7107', '71', 'Kab. Bolaang Mongondow Utara'),
	('7108', '71', 'Kab. Siau Tagulandang Biaro'),
	('7109', '71', 'Kab. Minahasa Tenggara'),
	('7110', '71', 'Kab. Bolaang Mongondow Selatan'),
	('7111', '71', 'Kab. Bolaang Mongondow Timur'),
	('7171', '71', 'Kota Manado'),
	('7172', '71', 'Kota Bitung'),
	('7173', '71', 'Kota Tomohon'),
	('7174', '71', 'Kota Kotamobagu'),
	('7201', '72', 'Kab. Banggai Kepulauan'),
	('7202', '72', 'Kab. Banggai'),
	('7203', '72', 'Kab. Morowali'),
	('7204', '72', 'Kab. Poso'),
	('7205', '72', 'Kab. Donggala'),
	('7206', '72', 'Kab. Toli-Toli'),
	('7207', '72', 'Kab. Buol'),
	('7208', '72', 'Kab. Parigi Moutong'),
	('7209', '72', 'Kab. Tojo Una-Una'),
	('7210', '72', 'Kab. Sigi'),
	('7211', '72', 'Kab. Banggai Laut'),
	('7212', '72', 'Kab. Morowali Utara'),
	('7271', '72', 'Kota Palu'),
	('7301', '73', 'Kab. Kepulauan Selayar'),
	('7302', '73', 'Kab. Bulukumba'),
	('7303', '73', 'Kab. Bantaeng'),
	('7304', '73', 'Kab. Jeneponto'),
	('7305', '73', 'Kab. Takalar'),
	('7306', '73', 'Kab. Gowa'),
	('7307', '73', 'Kab. Sinjai'),
	('7308', '73', 'Kab. Maros'),
	('7309', '73', 'Kab. Pangkajene Dan Kepulauan'),
	('7310', '73', 'Kab. Barru'),
	('7311', '73', 'Kab. Bone'),
	('7312', '73', 'Kab. Soppeng'),
	('7313', '73', 'Kab. Wajo'),
	('7314', '73', 'Kab. Sidenreng Rappang'),
	('7315', '73', 'Kab. Pinrang'),
	('7316', '73', 'Kab. Enrekang'),
	('7317', '73', 'Kab. Luwu'),
	('7318', '73', 'Kab. Tana Toraja'),
	('7322', '73', 'Kab. Luwu Utara'),
	('7325', '73', 'Kab. Luwu Timur'),
	('7326', '73', 'Kab. Toraja Utara'),
	('7371', '73', 'Kota Makassar'),
	('7372', '73', 'Kota Parepare'),
	('7373', '73', 'Kota Palopo'),
	('7401', '74', 'Kab. Buton'),
	('7402', '74', 'Kab. Muna'),
	('7403', '74', 'Kab. Konawe'),
	('7404', '74', 'Kab. Kolaka'),
	('7405', '74', 'Kab. Konawe Selatan'),
	('7406', '74', 'Kab. Bombana'),
	('7407', '74', 'Kab. Wakatobi'),
	('7408', '74', 'Kab. Kolaka Utara'),
	('7409', '74', 'Kab. Buton Utara'),
	('7410', '74', 'Kab. Konawe Utara'),
	('7411', '74', 'Kab. Kolaka Timur'),
	('7412', '74', 'Kab. Konawe Kepulauan'),
	('7413', '74', 'Kab. Muna Barat'),
	('7414', '74', 'Kab. Buton Tengah'),
	('7415', '74', 'Kab. Buton Selatan'),
	('7471', '74', 'Kota Kendari'),
	('7472', '74', 'Kota Baubau'),
	('7501', '75', 'Kab. Boalemo'),
	('7502', '75', 'Kab. Gorontalo'),
	('7503', '75', 'Kab. Pohuwato'),
	('7504', '75', 'Kab. Bone Bolango'),
	('7505', '75', 'Kab. Gorontalo Utara'),
	('7571', '75', 'Kota Gorontalo'),
	('7601', '76', 'Kab. Majene'),
	('7602', '76', 'Kab. Polewali Mandar'),
	('7603', '76', 'Kab. Mamasa'),
	('7604', '76', 'Kab. Mamuju'),
	('7605', '76', 'Kab. Mamuju Utara'),
	('7606', '76', 'Kab. Mamuju Tengah'),
	('8101', '81', 'Kab. Maluku Tenggara Barat'),
	('8102', '81', 'Kab. Maluku Tenggara'),
	('8103', '81', 'Kab. Maluku Tengah'),
	('8104', '81', 'Kab. Buru'),
	('8105', '81', 'Kab. Kepulauan Aru'),
	('8106', '81', 'Kab. Seram Bagian Barat'),
	('8107', '81', 'Kab. Seram Bagian Timur'),
	('8108', '81', 'Kab. Maluku Barat Daya'),
	('8109', '81', 'Kab. Buru Selatan'),
	('8171', '81', 'Kota Ambon'),
	('8172', '81', 'Kota Tual'),
	('8201', '82', 'Kab. Halmahera Barat'),
	('8202', '82', 'Kab. Halmahera Tengah'),
	('8203', '82', 'Kab. Kepulauan Sula'),
	('8204', '82', 'Kab. Halmahera Selatan'),
	('8205', '82', 'Kab. Halmahera Utara'),
	('8206', '82', 'Kab. Halmahera Timur'),
	('8207', '82', 'Kab. Pulau Morotai'),
	('8208', '82', 'Kab. Pulau Taliabu'),
	('8271', '82', 'Kota Ternate'),
	('8272', '82', 'Kota Tidore Kepulauan'),
	('9101', '91', 'Kab. Fakfak'),
	('9102', '91', 'Kab. Kaimana'),
	('9103', '91', 'Kab. Teluk Wondama'),
	('9104', '91', 'Kab. Teluk Bintuni'),
	('9105', '91', 'Kab. Manokwari'),
	('9106', '91', 'Kab. Sorong Selatan'),
	('9107', '91', 'Kab. Sorong'),
	('9108', '91', 'Kab. Raja Ampat'),
	('9109', '91', 'Kab. Tambrauw'),
	('9110', '91', 'Kab. Maybrat'),
	('9111', '91', 'Kab. Manokwari Selatan'),
	('9112', '91', 'Kab. Pegunungan Arfak'),
	('9171', '91', 'Kota Sorong'),
	('9401', '94', 'Kab. Merauke'),
	('9402', '94', 'Kab. Jayawijaya'),
	('9403', '94', 'Kab. Jayapura'),
	('9404', '94', 'Kab. Nabire'),
	('9408', '94', 'Kab. Kepulauan Yapen'),
	('9409', '94', 'Kab. Biak Numfor'),
	('9410', '94', 'Kab. Paniai'),
	('9411', '94', 'Kab. Puncak Jaya'),
	('9412', '94', 'Kab. Mimika'),
	('9413', '94', 'Kab. Boven Digoel'),
	('9414', '94', 'Kab. Mappi'),
	('9415', '94', 'Kab. Asmat'),
	('9416', '94', 'Kab. Yahukimo'),
	('9417', '94', 'Kab. Pegunungan Bintang'),
	('9418', '94', 'Kab. Tolikara'),
	('9419', '94', 'Kab. Sarmi'),
	('9420', '94', 'Kab. Keerom'),
	('9426', '94', 'Kab. Waropen'),
	('9427', '94', 'Kab. Supiori'),
	('9428', '94', 'Kab. Mamberamo Raya'),
	('9429', '94', 'Kab. Nduga'),
	('9430', '94', 'Kab. Lanny Jaya'),
	('9431', '94', 'Kab. Mamberamo Tengah'),
	('9432', '94', 'Kab. Yalimo'),
	('9433', '94', 'Kab. Puncak'),
	('9434', '94', 'Kab. Dogiyai'),
	('9435', '94', 'Kab. Intan Jaya'),
	('9436', '94', 'Kab. Deiyai'),
	('9471', '94', 'Kota Jayapura');

	https://github.com/edwardsamuel/Wilayah-Administratif-Indonesia/blob/master/mysql/indonesia.sql
*/		
?>



