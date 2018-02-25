<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi extends CI_Controller {

	/**
	 * @author : YOUR MOM
	 */
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->database();
		$this->load->library('upload');

		if(! $isFirstEmailExistSession = $this->session->userdata('email') )
        {	redirect(base_url());	}
        
	} 
	
	public function index()
	{
		$this->load->gotoPage('v_registrasiForm');
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
		$data = array(	
			'alamatkantor' => $alamatKantor,			'infogedung' => $infoGedung,			'primarymsisdn' => $primaryMSISDN,
			'secondarymsisdn' => $secondaryMSISDN,		'packagetype' => $packageType,			'noktp' => $noKTP,
			'imagektp' => $imageKTP["full_path"],		'imagepeg' => $imageNIP["full_path"],	'nokk' => $noKK,
			'email' => $this->session->userdata['email'],
			'fullname' => $fullName,					'alamat' => $alamat,					'provinsi' => $provinsi,
			'kota' => $kota,							'kodepos' => $kodePos,					'tanggallahir' => $tanggalLahir,'tempatlahir'=>$birthPlace,
			'namaibu' => $momName,						'phone' => $phoneNo,					'emailreferensi' => $emailRef
		);
		echo "<pre>";print_r($data);echo "</pre>";
		$this->db->insert('eprofile',$data);
		
		
		$this->load->gotoPage('v_RegisEnd');
	
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

	public function berhasil()
	{
		$this->load->driver('cache');
	    $this->session->sess_destroy();
	    $this->cache->clean();
	    ob_clean();
		redirect (base_url());
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



