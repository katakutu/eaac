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
	} 
	 
	public function index()
	{
		$this->session->sess_destroy();
		//echo kill ." - ". the ." - ". God;
		$this->load->view('zzz');//$this->load->view('welcome_message');
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

	function dukcapil($NIK = '6408042001770008' , $KK = '1104111007140002')
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
				<v1:NIKInfoGetRq
					xmlns:v1='http://www.telkomsel.com/eai/CivilRegistry/NIKInfoGetRq/v1.0'>
					<v1:NIK>".$NIK."</v1:NIK>
					<v1:NO_KK>".$KK."</v1:NO_KK>
					<v1:MSISDN>6282162345656</v1:MSISDN>
					<v1:channel>TC</v1:channel>
					<v1:trx_id>Testing12345</v1:trx_id>
				</v1:NIKInfoGetRq>
			</soapenv:Body>
		</soapenv:Envelope>
		";
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
						<ns1:pattern>%628115%</ns1:pattern>
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
        $isAvailable = $objGetEmAll->getElementsByTagName("status")->item(0)->nodeValue;
        if($errCode == '0000' && $errMsg == 'Success')
        {
        	$numbers = $objGetEmAll->getElementsByTagName('value');
        	foreach ($numbers as $number) {
			    $listNumber[] = $number->nodeValue;
			}
        }
        echo '<pre>';print_r($listNumber);echo '</pre>';
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
	
}

