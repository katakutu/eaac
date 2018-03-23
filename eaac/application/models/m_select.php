<?php 

class M_select extends CI_Model{
	function show_prov()
	{
		$this->db->order_by('provinsi','ASC');
		$provinces= $this->db->get('acuan_provinsi');
		return $provinces;
	}


	//function show_kota($prov = 'JAWA BARAT')
	function show_kota($prov)
	{

		$gimmeId = $this->db->get_where('acuan_provinsi',array('provinsi'=>$prov),1);
		foreach ($gimmeId->result_array() as $proo ){
			$idKota = $proo['id_provinsi'];
		}

		//$kabupaten="<option value='0'>--pilih--</pilih>";
		$this->db->order_by('kota','ASC');
		$kab= $this->db->get_where('acuan_kota',array('id_provinsi'=>$idKota));

		//foreach ($kab->result() as $kot ){$kabupaten.= "<option value='".$kot->kota."'>".$kot->kota."</option>";}

		return $kab->result_array();

	}

}