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
	} 
	
	public function index()
	{
		$this->load->gotoPage('v_registrasiForm');
	}
	    
	public function submit()
	{	
		# Halaman 1 Part 1/2
		$alamatKantor = $this->input->post('alamatkantor');
		$infoGedung = $this->input->post('infogedung');
		$primaryMSISDN = $this->input->post('primaryMSISDN');
		$secondaryMSISDN = $this->input->post('secondaryMSISDN');
		$packageType = $this->input->post('packagetype');
		# Halamat 1 Part 2/2
		$noKTP = $this->input->post('noktp');
		$imageKTP = $this->input->post('imagektp');
		$imagePegawai = $this->input->post('imagepeg');
		$noKK = $this->input->post('nokk');
		
		# Halamat 2 Part 1/1
		$fullName = $this->input->post('fullname');
		$alamat = $this->input->post('deliveryaddress');
		$provinsi = $this->input->post('deliveryprovince');  $kota = $this->input->post('deliverycity');
		$kodePos = $this->input->post('kodepos');
		$birthPlace = $this->input->post('birthplace');
		$birthDate = $this->input->post('date');  $monthDate = $this->input->post('month');  $yearDate = $this->input->post('year');
		# Halaman 2 Part 2/2
		$momName = $this->input->post('ibuname');
		$phoneNo = $this->input->post('phoneno');
		$emailRef = $this->input->post('emailref');
		
		$tanggalLahir = "{$yearDate}-{$monthDate}-{$birthDate}";
		
		$data = array(	
			'alamatkantor' => $alamatKantor,			'infogedung' => $infoGedung,			'primarymsisdn' => $primaryMSISDN,
			'secondarymsisdn' => $secondaryMSISDN,		'packagetype' => $packageType,			'noktp' => $noKTP,
			'imagektp' => $imageKTP,					'imagepeg' => $imagePegawai,			'nokk' => $noKK,
			
			'fullname' => $fullName,					'alamat' => $alamat,					'provinsi' => $provinsi,
			'kota' => $kota,							'kodepos' => $kodePos,					'tanggallahir' => $tanggalLahir,'birthplace'=>$birthPlace,
			'namaibu' => $momName,						'otherphone' => $phoneNo,				'email' => $emailRef
		);
		echo "<pre>";print_r($data);echo "</pre>";
		#$this->db->insert('eprofile',$data);
		
		
		#$this->load->gotoPage('v_RegisKonfirm');
	}
	
	public function berhasil()
	{
		$this->load->gotoPage('v_RegisEnd');
	}
	
}

/*
MYSQL
CREATE TABLE `eprofile` (
  `id_profile` integer NOT NULL auto_increment ,
  `fullname` varchar(255) NOT NULL,
  `alamatkantor` text NOT NULL,
  `infogedung` varchar(255) NOT NULL,
  `primarymsisdn` varchar(15) NOT NULL,
  `secondarymsisdn` varchar(15) NOT NULL,
  `packagetype` varchar(200) NOT NULL,
  `nokk` varchar(16) NOT NULL,
  `noktp` varchar(16) NOT NULL,
  `alamat` text NOT NULL,
  `provinsi` varchar(200) NOT NULL,
  `kota` varchar(200) NOT NULL,
  `kodepos` varchar(10) NOT NULL,
  `tanggallahir` date NOT NULL,
  `namaibu` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `emailreferensi` varchar(255),
  `imagektp` varchar(255) NOT NULL,
  `imagepeg` varchar(255) NOT NULL,
  constraint PK_PROFILE primary key (id_profile)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	#################
	#YG KURANG
	# - Nyimpen path file ke MySQL
	# - API Check mana mari
	# - Client & Server Side Validation
	#################
*/		
?>



