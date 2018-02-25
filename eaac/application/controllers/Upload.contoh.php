<?php

class Upload extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('url'));
                $this->load->library('upload');
        }

        public function index()
        {
                $this->load->view('upload_form', array('error' => ' ' ));
        }

        public function do_upload($inputTypeName, $fullName, $ket)
        {
                $config['file_name'] = date("Y-m-d")."_".$fullName;
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 30;
                $config['max_width']            = 48;
                $config['max_height']           = 38;

                if($ket == 'ktp')
                {
                        $config['upload_path']  = './uploads/KTP';
                        $this->upload->initialize($config);//$this->load->library('upload', $config);
                        if ( ! $this->upload->do_upload($inputTypeName))
                        {return $this->upload->display_errors();}
                        else {return $this->upload->data();}
                }

                if($ket == 'nip')
                {
                        $config['upload_path']  = './uploads/NIP';
                        $this->upload->initialize($config);//$this->load->library('upload', $config);
                        if ( ! $this->upload->do_upload($inputTypeName))
                        {return $this->upload->display_errors();}
                        else {return $this->upload->data();}
                }
        }

        public function asd()
        {
                $hehe = $this->do_upload('userfile','Budi Raharjo','ktp');
                $hoho = $this->do_upload('userfile2','JanCuk Jokowo','nip');
                //echo "<pre>";print_r($hehe["full_path"]);echo "</pre>";
                //echo $hehe["full_path"]."<br>".$hoho["full_path"];
                $another_list = array($hehe,$hoho);
                echo "<pre>";print_r($another_list);echo "</pre>";

                //echo "<pre>";print_r($hehe);echo "</pre>";
                //echo "<br><br>";
                //echo "<pre>";print_r($hoho);echo "</pre>";
        }
}
?>