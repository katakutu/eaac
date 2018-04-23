<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Time is always on the winning Side ...
	 */
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('curl');
		$this->load->model('m_select');
		$this->load->database();
		date_default_timezone_set('Asia/Jakarta');
	} 
	 
	public function index()
	{
		$this->session->sess_destroy();
		//echo kill ." - ". the ." - ". God;
		$data['prov'] = $this->m_select->show_prov()->result_array();
		//$data['kot'] = $this->m_select->show_kota();
		$this->load->gotoPage('templates/mencoba',$data);//$this->load->view('welcome_message');
	}

	function get_subkategori(){
        $id=$this->input->post('id');
        //$data=$this->m_select->get_subkategori($id);
        //$kill['LOL']=$this->m_select->get_subkategori($id)->result_array();$this->load->gotoPage('templates/mencoba',$kill);
        ##$dato = $this->m_select->show_kota();

        ##########$sql = "SELECT * FROM acuan_kota WHERE id_provinsi='$id'";
        ##########$query = $this->db->query($sql);
        //$query = $this->m_select->zzz($id);
        $query = $this->m_select->show_kota($id);
        foreach ($query as $row)	{$data[] = $row['kota'];}
        

        //$data = array('a','b','c');
        echo json_encode($data);
        #echo $data;
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
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;//echo API_DUKCAPIL;
	}

	function dukcapil($NIK = '6408042001770005' , $KK = '1104111007140002')
	{	
		$msisdn = '6282162345656';
		$body=sprintf(BODY_DUKCAPIL,$NIK,$KK,$msisdn);
		$respDukcapil = $this->API($body,API_DUKCAPIL);
		//echo $respDukcapil;
        $objErrCode = new DOMDocument();
        $objErrCode->loadXML($respDukcapil);
        $errCode = $objErrCode->getElementsByTagName("errorCode")->item(0)->nodeValue;
        $errMsg = $objErrCode->getElementsByTagName("errorMessage")->item(0)->nodeValue;
        echo $errCode."<br>".$errMsg;

    }

    function get_msisdn($pola = '%62811%')
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
						<ns1:pattern>%6255%</ns1:pattern>
						<ns1:AttributesData>
							<ns1:attrName>DEALER</ns1:attrName>
							<ns1:attrValue>002SNRSC</ns1:attrValue>
						</ns1:AttributesData>
					</ns1:UnifiedResourceCriteriaInfo>
					<ns1:PaginationInfo>
						<ns1:pageSize>8</ns1:pageSize>
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
        	foreach ($numbers as $number) {
			    $listNumber[] = $number->nodeValue;
			    //echo is_null($objGetEmAll->getElementsByTagName('value'))
			    //echo $number->nodeValue;
			}
        }else echo "WTF";
        //var_dump($numbers);
        if(isset($listNumber)){
        echo '<pre>';print_r($listNumber);echo '</pre>';}
        else echo 'ASDASD';
    }

    function reserve_msisdn($msisdn = '628112014807')
    {
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
				<ns1:NumberReserveReleaseRq
					xmlns:ns1='http://www.telkomsel.com/eai/AmdocsSRM/NumberReserveReleaseRq/v1.0'>
					<ns1:ApplicationID>T-Care</ns1:ApplicationID>
					<ns1:UnifiedResourceBulkActivityListInfo>
						<ns1:UnifiedResourceActivityInfo>
							<ns1:ActivityInfo>
								<ns1:activityName>RESERVE</ns1:activityName>
								<ns1:activityDate>2017-10-02+07:00</ns1:activityDate>
							</ns1:ActivityInfo>
							<ns1:RMEntityIdInfo>
								<ns1:type>MSISDN</ns1:type>
								<ns1:value>".$msisdn."</ns1:value>
								<ns1:poolId>5</ns1:poolId>
							</ns1:RMEntityIdInfo>
						</ns1:UnifiedResourceActivityInfo>
					</ns1:UnifiedResourceBulkActivityListInfo>
				</ns1:NumberReserveReleaseRq>
			</soapenv:Body>
		</soapenv:Envelope>
		";
		$respReserve = $this->API($body,API_SRM_MSISDN_RESERVE);
		//echo $respReserve;
		$objErrCode = new DOMDocument();
        $objErrCode->loadXML($respReserve);
        $errCode = $objErrCode->getElementsByTagName("errorCode")->item(0)->nodeValue;
        $errMsg = $objErrCode->getElementsByTagName("errorMessage")->item(0)->nodeValue;
        echo $errCode."<br>".$errMsg;
    }

    public function full_name()
    {
      $fname = $this->input->post('jancuk');

      $list_Number = array('6281324242','62814245242','62814242424','628192429424','628125215125','62814242424');
      
      $content = '';
		foreach ($list_Number as &$value) {
			$content .= 
			'<span>
			<input id="secondaryMSISDN" name="secondaryMSISDN" 
			class="radioSelectItemCustom radio-inline radio inline control-label radioSelectItem" 
			type="radio" 
			value="'.$value.'">
		 
			<label for="msisdn1">'.$value.'</label>
		 
			</span>';
		}

      echo $content;
    }

    function lol($wildNumber = '6281')
    {
    	$this->load->model('m_select');
    	$show5Msis = $this->m_select->show_msisdn($wildNumber);
    	if($show5Msis){
    		foreach($show5Msis as $msis){$listNumber[] = $msis['msisdn'];}
    	}else{$listNumber[] ="NO MSISDN FOUND";}
    	echo "<pre>";print_r($listNumber);
    }

    function getzzz()
	{	
		
		/*$json = file_get_contents('http://10.2.117.101/cis-api/check-domain/luwu.co.id');

		$dataJANCUK = json_decode($json,True);echo "<pre>";print_r($dataJANCUK);echo "</pre>";
		
		
		//echo ($dataJANCUK['data'][0]['account_id']);

		foreach ($dataJANCUK['data'] as $sub) {
			echo $sub['account_id'].'<br>';
		}*/

		echo date('Y-m-d H:i:s');
		//alert("Line 1\nLine 2");
		


		###$ch = curl_init();
	    ###$headers = array(
	    ###'Accept: application/json',
	    ###'Content-Type: application/json',

	    ###);
	    ###curl_setopt($ch, CURLOPT_URL, 'http://10.2.117.101/cis-api/check-domain/luwu.co.id');
	    ###curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    ###curl_setopt($ch, CURLOPT_HEADER, 0);
	    //$body = '{}';

	    ###curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
	    //curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
	    ###curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	    // Timeout in seconds
	    ###curl_setopt($ch, CURLOPT_TIMEOUT, 30);

	    ###$authToken = curl_exec($ch);

	    #return $authToken;
	    //echo "<pre>";print_r($authToken);echo "</pre>";
	    ###echo json_encode($authToken);
	}
}

