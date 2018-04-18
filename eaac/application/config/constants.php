<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| My Constants API
|--------------------------------------------------------------------------
|
| I don't have any idea what these are for
| 
*/
define('kill', 'I am number One');
define('the', 'I am number Two');
define('God', 'I am number Three');


/*
|--------------------------------------------------------------------------
| LIST OF API 
|--------------------------------------------------------------------------
|
| These API are used when user about to fill the registration form on
| controller 'checkEmail' & 'registrasi' . Total API --> 7 APIs in order :
| 1 Check Email 		--> req : email | resp : account_id,account_name,domain_name,address,province
| 2 Get List MSISDN 	--> req : %[0-9]% | resp : 5 elements of <VALUE> 
| 3 Get List Offer 		--> req : account_id | resp : n elements of <data>
| 4 Reserve MSISDN 		--> req : account_id | resp : n elements of <data>
| 5 Check Dukcapil 		--> req : NIK & KK | resp : n elements of <data>
| 6 Insert to CIS 		--> req : xxxxxxxxxx | resp : x elements of <xxxx>
| 7 CHECK PESANAN 		--> req : request_id | resp : element of <status>
*/
#API Query list MSISDN to SRM
/*Developmentdefine('API_SRM_MSISDN_LIST','http://10.250.195.155:8011/Amdocs/SRM/Service/Number');*/
/*Productiion*/ define('API_SRM_MSISDN_LIST','http://10.251.38.178:7477/Amdocs/SRM/Service/Number');

#API Reservasi MSISDN to SRM
/*Development*/define('API_SRM_MSISDN_RESERVE','http://10.250.195.155:8011/Amdocs/SRM/Service/Number');
/*Production define('API_SRM_MSISDN_RESERVE','http://10.251.38.178:7477/Amdocs/SRM/Service/Number');*/

#API Checking KK & NIK to Dukcapil
/*Developmentdefine('API_DUKCAPIL','http://10.250.195.155:8011/CivilRegistry/service/NIKInfoGet');*/
/*Production */define('API_DUKCAPIL','http://10.251.38.178:7477/CivilRegistry/service/NIKInfoGet');

#API Checking Domain/Email
/*Development*/define('API_SRM_CHECK_EMAIL','http://10.250.195.155:8011/CIS/Service/cis_domain_check');
/*Production define('API_SRM_CHECK_EMAIL','http://??.????.???.???:????/CIS/Service/cis_domain_check');*/

#API Query List Offer
/*Development*/define('API_SRM_OFFER_LIST','http://10.250.195.155:8011/CIS/Service/cis_product_get');
/*Production define('API_SRM_OFFER_LIST','http://??.????.???.???:????/CIS/Service/cis_product_get');*/

#API Check Pesanan
/*Development*/define('API_SRM_CHECK_PESANAN','http://10.250.195.155:8011/CIS/Service/cis_eaac_check');
/*Production define('API_SRM_CHECK_PESANAN','http://??.????.???.???:????/CIS/Service/cis_eaac_check');*/

#API Insert to CIS
/*Development*/define('API_INSERT_CIS','http://10.250.195.155:8011/CIS/Service/cis_eeac_add');
/*Production define('API_INSERT_CIS','http://??.????.???.???:????/CIS/Service/cis_eaac_add');*/

/*
|--------------------------------------------------------------------------
| My Constants API BODY
|--------------------------------------------------------------------------
|
| I don't have any idea what these are for
| 
*/
#BODY Checking Domain/Email
define('BODY_SRM_CHECK_EMAIL',
		"<soapenv:Envelope xmlns:soapenv='http://schemas.xmlsoap.org/soap/envelope/' xmlns:orac='http://www.oracle.com' xmlns:v1='http://www.telkomsel.com/eai/CIS/cis_domain_checkRq/v1.0'>
		   <soapenv:Header>
		      <orac:AuthenticationHeader>
		         <orac:UserName>osb</orac:UserName>
		         <orac:PassWord>welcome1</orac:PassWord>
		      </orac:AuthenticationHeader>
		   </soapenv:Header>
		   <soapenv:Body>
		      <v1:cis_domain_checkRq>
		         <v1:domain_name>%s</v1:domain_name>
		         <v1:channel>EAAC</v1:channel>
		         <v1:trx_id>TRXTesting12345</v1:trx_id>
		      </v1:cis_domain_checkRq>
		   </soapenv:Body>
		</soapenv:Envelope>");

#BODY Checking KK & NIK to Dukcapil
define('BODY_DUKCAPIL',
		"<soapenv:Envelope
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
					<v1:NIK>%s</v1:NIK>
					<v1:NO_KK>%s</v1:NO_KK>
					<v1:MSISDN>%s</v1:MSISDN>
					<v1:channel>EAAC</v1:channel>
					<v1:trx_id>Testing12345</v1:trx_id>
				</v1:NIKInfoGetRq>
			</soapenv:Body>
		</soapenv:Envelope>");

#BODY Check Pesanan
define('BODY_SRM_CHECK_PESANAN',
		"<soapenv:Envelope xmlns:soapenv='http://schemas.xmlsoap.org/soap/envelope/' xmlns:orac='http://www.oracle.com' xmlns:v1='http://www.telkomsel.com/eai/CIS/Resource/wsdlxsde/cis_eaac_checkRq/v1.0'>
		   <soapenv:Header>
		      <orac:AuthenticationHeader>
		         <orac:UserName>osb</orac:UserName>
		         <orac:PassWord>welcome1</orac:PassWord>
		      </orac:AuthenticationHeader>
		   </soapenv:Header>
		   <soapenv:Body>
		      <v1:cis_eaac_checkRq>
		         <v1:request_id>%s</v1:request_id>
		         <v1:channel>EAAC</v1:channel>
		         <v1:trx_id>TRXTesting12345</v1:trx_id>
		      </v1:cis_eaac_checkRq>
		   </soapenv:Body>
		</soapenv:Envelope>");

#BODY Query list MSISDN to SRM
define('BODY_SRM_MSISDN_LIST',
		"<soapenv:Envelope
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
						<ns1:pattern>%%%s%%</ns1:pattern>
						<ns1:AttributesData>
							<ns1:attrName>DEALER</ns1:attrName>
							<ns1:attrValue>002SNRSC</ns1:attrValue>
						</ns1:AttributesData>
					</ns1:UnifiedResourceCriteriaInfo>
					<ns1:PaginationInfo>
						<ns1:pageSize>5</ns1:pageSize>
						<ns1:pageNumber>1</ns1:pageNumber>
					</ns1:PaginationInfo>
				</ns1:NumberRetrieveRq>
			</soapenv:Body>
		</soapenv:Envelope>");

#BODY Query List Offer
define('BODY_SRM_OFFER_LIST',
		"<soapenv:Envelope xmlns:soapenv='http://schemas.xmlsoap.org/soap/envelope/' xmlns:orac='http://www.oracle.com' xmlns:v1='http://www.telkomsel.com/eai/CIS/cis_product_getRq/v1.0'>
		   <soapenv:Header>
		      <orac:AuthenticationHeader>
		         <orac:UserName>osb</orac:UserName>
		         <orac:PassWord>welcome1</orac:PassWord>
		      </orac:AuthenticationHeader>
		   </soapenv:Header>
		   <soapenv:Body>
		      <v1:cis_product_getRq>
		         <v1:account_id>%s</v1:account_id>
		         <v1:channel>EAAC</v1:channel>
		         <v1:trx_id>TRXTesting12345</v1:trx_id>
		      </v1:cis_product_getRq>
		   </soapenv:Body>
		</soapenv:Envelope>");

#BODY INsert CIS
define('BODY_INSERT_CIS',
		"<soapenv:Envelope xmlns:soapenv='http://schemas.xmlsoap.org/soap/envelope/' xmlns:orac='http://www.oracle.com' xmlns:v1='http://www.telkomsel.com/eai/CIS/cis_eaac_addRq/v1.0'>
		   <soapenv:Header>
		      <orac:AuthenticationHeader>
		         <orac:UserName>osb</orac:UserName>
		         <orac:PassWord>welcome1</orac:PassWord>
		      </orac:AuthenticationHeader>
		   </soapenv:Header>
		   <soapenv:Body>
		      <v1:cis_eaac_addRq>
		         <v1:product_id>%s</v1:product_id>
		         <v1:email>%s</v1:email>
		         <v1:msisdn>%s</v1:msisdn>
		         <v1:kk_number>%s</v1:kk_number>
		         <v1:id_number>%s</v1:id_number>
		         <v1:name>%s</v1:name>
		         <v1:mother_name>%s</v1:mother_name>
		         <v1:address>%s</v1:address>
		         <v1:birth_day>%s</v1:birth_day>
		         <v1:birth_place>%s</v1:birth_place>
		         <v1:city>%s</v1:city>
		         <v1:province>%s</v1:province>
		         <v1:region>DKI JAKARTA</v1:region>
		         <v1:postal_code>%s</v1:postal_code>
		         <v1:contact_person>%s</v1:contact_person>
		         <v1:email_pic>%s</v1:email_pic>
		         <v1:photo_id_number>%s</v1:photo_id_number>
		         <v1:photo_id_card>%s</v1:photo_id_card>
		         <v1:flag_dukcapil>VALID</v1:flag_dukcapil>
		         <v1:channel>EAAC</v1:channel>
		         <v1:trx_id>TRXTestingOracle13245</v1:trx_id>
		      </v1:cis_eaac_addRq>
		   </soapenv:Body>
		</soapenv:Envelope>");

#BODY MSISDN Reserve   628112014807
define('BODY_SRM_MSISDN_RESERVE',
		'<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
			<soap:Header xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
				<orac:AuthenticationHeader xmlns:orac="http://www.oracle.com">
					<orac:UserName>osb</orac:UserName>
					<orac:PassWord>welcome1</orac:PassWord>
				</orac:AuthenticationHeader>
			</soap:Header>
			<soapenv:Body>
				<ns1:NumberReserveReleaseRq xmlns:ns1="http://www.telkomsel.com/eai/AmdocsSRM/NumberReserveReleaseRq/v1.0">
					<ns1:ApplicationID>T-Care</ns1:ApplicationID>
					<ns1:UnifiedResourceBulkActivityListInfo>
						<ns1:UnifiedResourceActivityInfo>
							<ns1:ActivityInfo>
								<ns1:activityName>RESERVE</ns1:activityName>
								<ns1:activityDate>2017-10-02+07:00</ns1:activityDate>
							</ns1:ActivityInfo>
							<ns1:RMEntityIdInfo>
								<ns1:type>MSISDN</ns1:type>
								<ns1:value>%s</ns1:value>
								<ns1:poolId>5</ns1:poolId>
							</ns1:RMEntityIdInfo>
						</ns1:UnifiedResourceActivityInfo>
					</ns1:UnifiedResourceBulkActivityListInfo>
				</ns1:NumberReserveReleaseRq>
			</soapenv:Body>
		</soapenv:Envelope>');


/*
|--------------------------------------------------------------------------
| Content for Email
|--------------------------------------------------------------------------
|
| Configure the content of email when : 
| 1. Send Token  		--> after user enter their valid email/domain
| 2. Send REQUEST_ID 	--> after user confirm their form
|
*/
define('API_EMAIL_CLAUDIA','http://10.54.22.218:8091/sendEmail/index.php/welcome/submit?to=%s&from=%s&cc=%s&subject=%s&message=%s');

define('MSG_TOKEN', "<h2>Welcome to Telkomsel EAAC.</h2><br>Your email: <b>%s</b><br>Token code: <strong>%s</strong><br><br>If you have a problem with the email, you can ask customer service:<br><a href='https://www.telkomsel.com/support/contact-us'>https://www.telkomsel.com/support/contact-us</a><br><br><h3>Good luck</h3>With best regards <br><span>Telkomsel Team</span><br><br>");

define('MSG_REQ', "<h2>Thank You for Your Registration</h2><br>Your email: <i>%s</i><br>Request ID: <strong>%s</strong><br><br>You can check your request status:<br><a href='https://www.telkomsel.com'>https://www.telkomsel.com/support/contact-us</a><br><br><h3>Thank You :D</h3>With best regards <br><span>Telkomsel Team</span><br><br>");
/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
