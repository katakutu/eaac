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

		if(! $isFirstEmailExistSession = $this->session->userdata('email') )
        {	redirect(base_url());	}
        
	} 
	
	public function index()
	{
		$this->load->gotoPage('v_registrasiForm');
		//echo "<pre>";print_r($this->session->all_userdata());echo "</pre>";
	}
	    
	public function submit()
	{	//if ($this->input->post('REQUEST_METHOD') == 'POST') {
		# Halaman 1 Part 1/2
		$alamatKantor = $this->input->post('alamatkantor');
		$infoGedung = $this->input->post('infogedung');
		$primaryMSISDN = $this->input->post('primaryMSISDN');
		$secondaryMSISDN = $this->input->post('secondaryMSISDN');
		$packageType = $this->input->post('packagetype');
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
		# Halaman 2 Part 2/2
		$momName = $this->input->post('ibuname');
		$phoneNo = $this->input->post('phoneno');
		$emailRef = $this->input->post('emailref');
		#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~``
		$tanggalLahir = "{$yearDate}-{$monthDate}-{$birthDate}";
		$uploadFile_error_list = array($imageKTP,$imageNIP); //error saat upload file (salah format, kegedean , dll)
		#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~``
		$data['insertion'] = array(	
			'alamatkantor' => $alamatKantor,			'infogedung' => $infoGedung,			'primarymsisdn' => $primaryMSISDN,
			'secondarymsisdn' => $secondaryMSISDN,		'packagetype' => $packageType,			'noktp' => $noKTP,
			'imagektp' => $imageKTP["full_path"],		'imagepeg' => $imageNIP["full_path"],	'nokk' => $noKK,
			'email' => $this->session->userdata['email'],
			'fullname' => $fullName,					'alamat' => $alamat,					'provinsi' => $provinsi,
			'kota' => $kota,							'kodepos' => $kodePos,					'tanggallahir' => $tanggalLahir,'tempatlahir'=>$birthPlace,
			'namaibu' => $momName,						'phone' => $phoneNo,					'emailreferensi' => $emailRef
		);
		echo "<pre>";print_r($data);echo "</pre>";
		//$this->db->insert('eprofile',$data);
		
		$this->session->set_userdata($data);
		redirect('registrasi/konfirmasi');
	
	}
	
	public function uploadFile($inputTypeName, $fullName, $ket)
	{
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name'] 			= date("Y-m-d")."_".$fullName;
        $config['max_size']             = 5120;
        //$config['uploaxd_path']			= $_SERVER['DOCUMENT_ROOT'];D:/xampp/realFolder/htdocs/eaac/uploads/

        if($ket == 'ktp')
        {
        	$config['upload_path']		= './uploads/KTP';
        	$this->upload->initialize($config);
        	if ( ! $this->upload->do_upload($inputTypeName))
        	{return $this->upload->display_errors();}
        	else {return $this->upload->data();}
        }
        if($ket == 'nip')
        {
        	$config['upload_path']		= './uploads/NIP';
        	$this->upload->initialize($config);
        	if ( ! $this->upload->do_upload($inputTypeName))
        	{return $this->upload->display_errors();}
        	else {return $this->upload->data();}
        }
	}

	public function konfirmasi()
	{
		$this->load->gotoPage('v_RegisKonfirm');
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
	{
		$DEJA_VU = $this->session->all_userdata();
		//echo "<pre>";print_r($DEJA_VU['insertion']);echo "</pre>";
		
		$this->db->set($DEJA_VU['insertion']);
		$this->db->insert('eprofile');

		$this->load->driver('cache');
	    $this->session->sess_destroy();
	    $this->cache->clean();
	    ob_clean();

		$this->load->gotoPage('v_RegisEnd');
	}

	public function berhasil()
	{
		redirect (base_url());
	}

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
		#$str = "11041110071400026408042001770005M SADLIISLAMACEH TENGAH0KEBAYAKANWIRASWASTA0LORONG AMALTAKENGONSLTA/SEDERAJATNAIRIAHACEHPINANGANLaki-Laki1977-01-20true1null1true01true0000SuccessTesting12345http://10.250.195.155:8011/CivilRegistry/service/NIKInfoGet";
		#$str = "true1null1true01true02Data Tidak SesuaiTesting12345http://10.250.195.155:8011/CivilRegistry/service/NIKInfoGet";
		#$str = "false9001Can't reach service providerTesting12345http://10.250.195.155:8011/CivilRegistry/service/NIKInfoGet";
		#$str = "false0001Error DukcapilTesting12345";
		#$str = "true1null1true01true01NIK Tidak DitemukanTesting12345";
		if 			(strpos($response,'Success') !== false) {$qwe = 'Valid';}
		else if 	(strpos($response,'Sesuai' ) !== false) {$qwe = 'Invalid';}
		else if 	(strpos($response,'Tidak Ditemukan' ) !== false) {$qwe = 'Tidak Ditemukan';}
		else if 	(strpos($response,'9001') !== false) {$qwe = 'Timeout';}
		else if 	(strpos($response,'OSB') !== false) {$qwe = 'Error OSB';}
		else 												{$qwe = 'Unknown Error';}
		return $qwe;
	}

	public function API_MSISDN_Get()
	{
		#JF1-000231Validation of the unifiedResourceCriteriaInfo input parameter failed. The invalid fields are toValue.type,fromValue.type.064589fa-b0cd-4a41-9802-dfecdd02dabf
		
		$wildNumber = $this->input->post('toserverFind');

		/*// do something with wildNumber [for input to the body of API]
		$body="
		<soapenv:Envelope
			xmlns:soapenv='http://schemas.xmlsoap.org/soap/envelope/'>
			<soap:Header
				xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
				<orac:AuthenticationHeader
					xmlns:orac='http://www.oracle.com'>
					<orac:UserName>osb</orac:UserName>
					<orac:PassWord>welcome1</orac:PassWord>
				</orac:AuthenticationHeader>
			</soap:Header>
			<soapenv:Body>
				<ns1:NumberRetrieveRq
					xmlns:ns1='http://www.telkomsel.com/eai/AmdocsSRM/NumberRetrieveRq/v1.0'>
					<ns1:ApplicationID>T-Care</ns1:ApplicationID>
					<ns1:UnifiedResourceCriteriaInfo>
						<ns1:type>MSISDN</ns1:type>
						<ns1:status>AVAILABLE</ns1:status>
						<ns1:pattern>%".$wildNumber."%</ns1:pattern>
						<ns1:AttributesData>
							<ns1:attrName>DEALER</ns1:attrName>
							<ns1:attrValue>002SNRSC</ns1:attrValue>		<! -- THIS -->
						</ns1:AttributesData>
					</ns1:UnifiedResourceCriteriaInfo>
					<ns1:PaginationInfo>
						<ns1:pageSize>5</ns1:pageSize>
						<ns1:pageNumber>417</ns1:pageNumber>
					</ns1:PaginationInfo>
				</ns1:NumberRetrieveRq>
			</soapenv:Body>
		</soapenv:Envelope>
		";
		$respGet = $this->API($body,API_SRM_MSISDN_LIST);
		#echo $respGet;

        $objGetEmAll = new DOMDocument();
        $objGetEmAll->loadXML($respGet);
        $errCode = $objGetEmAll->getElementsByTagName("errorCode")->item(0)->nodeValue;
        $errMsg = $objGetEmAll->getElementsByTagName("errorMessage")->item(0)->nodeValue;
        $isAvailable = $objGetEmAll->getElementsByTagName("status")->item(0)->nodeValue;
        if($errCode == '0000' && $errMsg == 'Success')
        {
        	$numbers = $objGetEmAll->getElementsByTagName('value');
        	foreach ($numbers as $number) {
			    $listNumber[] = $number->nodeValue;
			}
        }*/
        ##### STUCK ABOVE #####
        ##### make a condition TIMEOUT #####
        //echo $errCode."<br>".$errMsg;
        $listNumber = $this->get_msisdn($wildNumber);
		#####$listNumber = array('62812222001','62812222002','62812222003','62812222004','62812222005');
		/*$content = "";
		foreach ($listNumber as &$value) {
			
			//$content .='<span><input id="secondaryMSISDN" name="secondaryMSISDN" type="radio" value="'.$value.'"><label for="msisdn1">'.$value.'</label></span>';
			
			$content .= '<label for="msisdn1">'.$value.'</label>';
		}*/
      	//echo $content;
      	echo json_encode($listNumber);
	}

	public function API_MSISDN_Reserve()
	{
		#0000Success11b0515221-7396-4921-adb0-3d53cfad716b
		#0000Success117ab7068c-a241-470a-8503-16335c65f200
	}

	function get_msisdn($wildNumber)
    {		//<! -- THIS -->
    	$body="
		<soapenv:Envelope
			xmlns:soapenv='http://schemas.xmlsoap.org/soap/envelope/'>
			<soap:Header
				xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
				<orac:AuthenticationHeader
					xmlns:orac='http://www.oracle.com'>
					<orac:UserName>osb</orac:UserName>
					<orac:PassWord>welcome1</orac:PassWord>
				</orac:AuthenticationHeader>
			</soap:Header>
			<soapenv:Body>
				<ns1:NumberRetrieveRq
					xmlns:ns1='http://www.telkomsel.com/eai/AmdocsSRM/NumberRetrieveRq/v1.0'>
					<ns1:ApplicationID>T-Care</ns1:ApplicationID>
					<ns1:UnifiedResourceCriteriaInfo>
						<ns1:type>MSISDN</ns1:type>
						<ns1:status>AVAILABLE</ns1:status>
						<ns1:pattern>%".$wildNumber."%</ns1:pattern>
						<ns1:AttributesData>
							<ns1:attrName>DEALER</ns1:attrName>
							<ns1:attrValue>002SNRSC</ns1:attrValue>
						</ns1:AttributesData>
					</ns1:UnifiedResourceCriteriaInfo>
					<ns1:PaginationInfo>
						<ns1:pageSize>5</ns1:pageSize>
						<ns1:pageNumber>417</ns1:pageNumber>
					</ns1:PaginationInfo>
				</ns1:NumberRetrieveRq>
			</soapenv:Body>
		</soapenv:Envelope>
		";
		$respGet = $this->API($body,API_SRM_MSISDN_LIST);
		$objGetEmAll = new DOMDocument();
        $objGetEmAll->loadXML($respGet);
        $errCode = $objGetEmAll->getElementsByTagName("errorCode")->item(0)->nodeValue;
        $errMsg = $objGetEmAll->getElementsByTagName("errorMessage")->item(0)->nodeValue;
        //$isAvailable = $objGetEmAll->getElementsByTagName("status")->item(0)->nodeValue;
        if($errCode == '0000' && $errMsg == 'Success')
        {
        	$numbers = $objGetEmAll->getElementsByTagName('value');
        	foreach ($numbers as $number) {$listNumber[] = $number->nodeValue;}
        }else if($errCode == '9999' && $errMsg == 'Failed') {
        		$listNumber[] = 'No Response';
        }

        if(isset($listNumber)){
        	return $listNumber;
        } else{
        	return $listNumber = array('NO MSISDN FOUND');
        }
        //echo '<pre>';print_r($listNumber);echo '</pre>';
    }
}

/*
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
*/		
?>



