<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SoapXML {

        function __construct(){
			parent::__construct();
			$this->load->helper('url');
			$this->load->library('session');
			$this->CI =& get_instance();

			$email          		= isset($_POST['email']) ? $_POST['email'] : '';
			$alamatkantor    		= isset($_POST['alamatkantor']) ? $_POST['alamatkantor'] : '';
			$infogedung    			= isset($_POST['infogedung']) ? $_POST['infogedung'] : '';
			$primarymsisdn 			= isset($_POST['primarymsisdn']) ? $_POST['primarymsisdn'] : '';
			$secondarymsisdn		= isset($_POST['secondarymsisdn']) ? $_POST['secondarymsisdn'] : '';
			$noktp 		   			= isset($_POST['noktp']) ? $_POST['noktp'] : '';
			$nokk  		  			= isset($_POST['nokk']) ? $_POST['nokk'] : '';
			$imagektp      			= isset($_POST['imagektp']) ? $_POST['imagektp'] : '';
			$imagepeg      			= isset($_POST['imagepeg']) ? $_POST['imagepeg'] : '';
			$fullname    			= isset($_POST['fullname']) ? $_POST['fullname'] : '';
			$alamat    				= isset($_POST['alamat']) ? $_POST['alamat'] : '';
			$provinsi    			= isset($_POST['provinsi']) ? $_POST['provinsi'] : '';
			$kota    				= isset($_POST['kota']) ? $_POST['kota'] : '';
			$kodepos    			= isset($_POST['kodepos']) ? $_POST['kodepos'] : '';
			$tanggallahir    		= isset($_POST['tanggallahir']) ? $_POST['tanggallahir'] : '';
			$tempatlahir    		= isset($_POST['tempatlahir']) ? $_POST['tempatlahir'] : '';
			$namaibu    			= isset($_POST['namaibu']) ? $_POST['namaibu'] : '';
			$phone    				= isset($_POST['phone']) ? $_POST['phone'] : '';
			$emailreferensi			= isset($_POST['emailreferensi']) ? $_POST['emailreferensi'] : '';

	        
		} 

		function mungXML($xml)
		{
		    $obj = SimpleXML_Load_String($xml);
		    if ($obj === FALSE) return $xml;

		    // GET NAMESPACES, IF ANY
		    $nss = $obj->getNamespaces(TRUE);
		    if (empty($nss)) return $xml;

		    // CHANGE ns: INTO ns_
		    $nsm = array_keys($nss);
		    foreach ($nsm as $key)
		    {
		        // A REGULAR EXPRESSION TO MUNG THE XML
		        $rgx
		        = '#'               // REGEX DELIMITER
		        . '('               // GROUP PATTERN 1
		        . '\<'              // LOCATE A LEFT WICKET
		        . '/?'              // MAYBE FOLLOWED BY A SLASH
		        . preg_quote($key)  // THE NAMESPACE
		        . ')'               // END GROUP PATTERN
		        . '('               // GROUP PATTERN 2
		        . ':{1}'            // A COLON (EXACTLY ONE)
		        . ')'               // END GROUP PATTERN
		        . '#'               // REGEX DELIMITER
		        ;
		        // INSERT THE UNDERSCORE INTO THE TAG NAME
		        $rep
		        = '$1'          // BACKREFERENCE TO GROUP 1
		        //. '_'           // LITERAL UNDERSCORE IN PLACE OF GROUP 2
		        ;
		        // PERFORM THE REPLACEMENT
		        $xml =  preg_replace($rgx, $rep, $xml);
		    }
		    return $xml;
		}

		function mainXML()
	    {
	    	$xml ='<?xml version="1.0" encoding="utf-8"?>
	    	<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
	    <soapenv:Header xmlns:v1="http://www.telkomsel.com/eai/CIS/cis_product_getRq/v1.0" xmlns:orac="http://www.oracle.com"/>
	    <soapenv:Body xmlns:v1="http://www.telkomsel.com/eai/CIS/cis_product_getRq/v1.0" xmlns:orac="http://www.oracle.com">
			<root>
			    <v1:data>
	                <v1:account_id>5637</v1:account_id>
	                <v1:account_name>PEMERINTAH KABUPATEN LUWU TIMUR</v1:account_name>
	                <v1:product_id>f4dc8300-1f13-11e8-bfa43d4d9ee60f6b</v1:product_id>
	                <v1:product_name>Product Test Template PSB 10</v1:product_name>
	                <v1:product_desc>
	                    <v1:name>Validity</v1:name>
	                    <v1:unit>Month</v1:unit>
	                    <v1:value>10</v1:value>
	                </v1:product_desc>
	                <v1:product_desc>
	                    <v1:name>Data 4G Network</v1:name>
	                    <v1:unit>GB</v1:unit>
	                    <v1:value>6</v1:value>
	                </v1:product_desc>
	                <v1:product_desc>
	                    <v1:name>Voice</v1:name>
	                    <v1:unit>Minutes</v1:unit>
	                    <v1:value>30</v1:value>
	                </v1:product_desc>
	                <v1:product_desc>
	                    <v1:name>SMS</v1:name>
	                    <v1:unit>null</v1:unit>
	                    <v1:value>120</v1:value>
	                </v1:product_desc>
	                <v1:offer>
	                    <v1:offer_id>3575374</v1:offer_id>
	                    <v1:offer_name>Flash Corp B2B2C Bulk 50MB</v1:offer_name>
	                </v1:offer>
	            </v1:data>
	            <v1:data>
	                <v1:account_id>9999</v1:account_id>
	                <v1:account_name>KAB PAPUA TIMUR</v1:account_name>
	                <v1:product_id>XXXXXXXXXX</v1:product_id>
	                <v1:product_name>PRODUCT APA INI</v1:product_name>
	                <v1:product_desc>
	                    <v1:name>Validity</v1:name>
	                    <v1:unit>Month</v1:unit>
	                    <v1:value>99</v1:value>
	                </v1:product_desc>
	                <v1:product_desc>
	                    <v1:name>Data 9G Network</v1:name>
	                    <v1:unit>GB</v1:unit>
	                    <v1:value>999</v1:value>
	                </v1:product_desc>
	                <v1:product_desc>
	                    <v1:name>Voice</v1:name>
	                    <v1:unit>Minutes</v1:unit>
	                    <v1:value>999</v1:value>
	                </v1:product_desc>
	                <v1:product_desc>
	                    <v1:name>SMS</v1:name>
	                    <v1:unit>null</v1:unit>
	                    <v1:value>999</v1:value>
	                </v1:product_desc>
	                <v1:offer>
	                    <v1:offer_id>9999999</v1:offer_id>
	                    <v1:offer_name>Flash 9999MB</v1:offer_name>
	                </v1:offer>
	            </v1:data>
			</root>
			</soapenv:Body>
	</soapenv:Envelope>';
			      //$objGetEmAll = new DOMDocument();
			      //$objGetEmAll->loadXML($xml);


			      /*$response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $xml);
			$xml = new SimpleXMLElement($response);
			$body = $xml->xpath('//v1data');
			$array = json_decode(json_encode((array)$body), TRUE); 
			echo "<pre>";print_r($array);	*/
			$xml = $this->mungXML($xml);
			$arrayResult = json_decode(json_encode(SimpleXML_Load_String($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
			echo "<pre>";print_r($arrayResult);
			    //echo "<pre>";print_r($CallMe);echo "</pre>";	echo "<pre>";print_r($CallMe2);echo "</pre>"; 
	    }
}