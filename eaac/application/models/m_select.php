<?php 

class M_select extends CI_Model{
	function show_prov()
	{
		//SELECT * FROM acuan_provinsi ORDER BY provinsi ASC  //to get province's name
		$this->db->order_by('provinsi','ASC');
		$provinces= $this->db->get('acuan_provinsi');
		return $provinces;
	}


	//function show_kota($prov = 'JAWA BARAT')
	function show_kota($prov)
	{
		//SELECT * FROM acuan_provinsi WHERE provinsi=[$prov]	//to get province's id
		$gimmeId = $this->db->get_where('acuan_provinsi',array('provinsi'=>$prov),1);
		foreach ($gimmeId->result_array() as $proo ){
			$idKota = $proo['id_provinsi'];
		}

		//SELECT * FROM acuan_kota WHERE id_provinsi=[$idKota] ORDER BY kota ASC
		$this->db->order_by('kota','ASC');
		$kab= $this->db->get_where('acuan_kota',array('id_provinsi'=>$idKota));

		return $kab->result_array();

	}

}