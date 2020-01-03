<?php
//echo "noresha teset";exit;
if (!define('sugarEntry'))define('sugarEntry', true);
require_once('include/entryPoint.php');
require_once('custom/include/language/en_us.lang.php');
ini_set('display_errors','On');
global $db, $sugar_config;

$url = $sugar_config["webservice_url"];
$username = $sugar_config["webservice_username"];
$password = $sugar_config["webservice_password"];

$apiModule = array(
    'Leads',
    'Contacts',
);

$apiAction = array(
    'Create',
    'Update',
);
print_r($_SERVER);
if ($_SERVER['HTTP_AUTHORIZEDAPPLICATION'] == "5n@nc3" && in_array($_SERVER['HTTP_REQUESTEDMODULE'], $apiModule) && in_array($_SERVER['HTTP_REQUESTEDMETHOD'], $apiAction)) { 
 echo 'hi';  
    $module = $_SERVER['HTTP_REQUESTEDMODULE'];
	$action = $_SERVER['HTTP_REQUESTEDMETHOD'];
	$session_id = generateSession($username, $password, $url);
    $fp      = fopen('php://input', 'r');
    $rawData = json_decode(stream_get_contents($fp));
	print_r($rawData);exit;
    $salutation		 		= $rawData->salutation;
	$first_name       		= $rawData->first_name;
    $last_name       		= $rawData->last_name;
    $phone_mobile     		= $rawData->phone_mobile;
    $email1           		= $rawData->email1;
    $campaign_type_c  		= $rawData->campaign_type;
    $city             		= $rawData->city;
    $campaign_sub_type_c 	= $rawData->campaign_sub_type;
    $related_corporate_account_c    = $rawData->related_corporate_account;
    $related_kiosk_account_c        = $rawData->related_kiosk_account;
    $referred_by_c       			= $rawData->referred_by;
    $gateway_c        				= $rawData->gateway;
    $uniqueCustomerCode				= $rawData->unique_customer_code;
     $campaign				= $rawData->campaign;
    $utmcontent				= $rawData->utmcontent;
   $source				= $rawData->source;
    $subid				= $rawData->subid;
    $querystring				= $rawData->querystring;
    if(!(empty($last_name)))
		{
			$name_array = explode(" ", $last_name);
			$first_name = $name_array[0];
			$middle_name = $name_array[1];
			$last_name	 = $name_array[2];
			if(empty($last_name)){
				$last_name = $middle_name;
				$middle_name = '';
			}
		}
    if(!empty($city))
	{
		$fieldname = "city_c";
		$city = getdropdown($session_id,$module,$city,$fieldname,$url);
	}
	if(!empty($gateway_c))
		{
			$fieldname = "gateway_c";
			if($gateway_c == 'EXTERNALBO'){
				$gateway_c = 'Digital Marketing';
			}
			if(strpos($gateway_c,'-')!==false){
				$gateway_array = explode("-", $gateway_c);
				$gateway_c = $gateway_array[0];
			}
			$gateway_c = getdropdown($session_id,$module,$gateway_c,$fieldname,$url);
		}
		if(!empty($source))
		{
			$fieldname = 'campaign_sub_type_c';
			$campaign_sub_type = getdropdown_campaign($session_id,$module,$source,$fieldname,$url);
		}
	/*----------------First Check (Email ID)-----------------------------*/
	$select_email_address_leads = "select count(*) as count from leads join email_addr_bean_rel as ebr on ebr.bean_id=leads.id join email_addresses ea on ebr.email_address_id=ea.id where ebr.deleted=0 and leads.deleted=0 and ea.email_address='$email1'";
	$result_email_address = $db->query($select_email_address_leads);
	$row = $db->fetchByAssoc($result_email_address);
	$leadcount = $row['count'];
	if($leadcount == 0){
	   if ($module == "Leads" && $action == 'Create') {
				// $campaign_sub_type = $source.'_'.$GLOBALS['app_list_strings']['campaign_type_list'][$source];
			 $name_value_list = array(
					(isset($salutation) ? array('name' => 'salutation','value' => $salutation) : ''),
					(isset($first_name) ? array('name' => 'first_name','value' => trim($first_name)) : ''),
					(isset($middle_name) ? array('name' => 'middle_name_c','value' => trim($middle_name)) : ''),
					(isset($last_name) ? array('name' => 'last_name','value' => trim($last_name)) : ''),
					(isset($email1) ? array('name' => 'email1','value' => $email1) : ''),
					(isset($phone_mobile) ? array('name' => 'phone_mobile','value' => $phone_mobile) : ''),
					(isset($source) ? array('name' => 'campaign_type_c','value' => $source) : ''),
					(isset($campaign_sub_type) ? array('name' => 'campaign_sub_type_c','value' => $campaign_sub_type) : ''),
					(isset($city) ? array('name' => 'city_c','value' => $city) : ''),
					(isset($related_corporate_account_c) ? array('name' => 'related_corporate_account_c','value' => $related_corporate_account_c) : ''),
					(isset($related_kiosk_account_c) ? array('name' => 'related_kiosk_account_c','value' => $related_kiosk_account_c) : ''),
					(isset($referred_by_c) ? array('name' => 'referred_by_c','value' => $referred_by_c) : ''),
					array('name' => 'status','value' => 'Fresh'),
					array('name' => 'disposition_c','value' => 'Fresh_Fresh'),
					array('name' => 'gateway_c','value' => 'CRM-MARKETING'),
					array('name' => 'assigned_user_id','value' => 1),
					(isset($source) ? array('name' => 'source_c','value' => $source) : ''),
					(isset($subid) ? array('name' => 'subid_c','value' => $subid) : ''),
					(isset($querystring) ? array('name' => 'querystring_c','value' => $querystring) : ''),
			 );
			 
			 $leadresult = createrecord($session_id, 'Leads', $name_value_list, $url);
			 $lead_id = $leadresult->id;
				$msg = array(
					'Success' => true,
					'Message' => 'Lead Created Successfully',
					'Lead id' => $lead_id,
					//'data' => $leadresult
				);
		
		} else if ($module == "Contacts"  && $action == 'Create') {
			 $gateway_c = getdropdown($session_id,$module,$gateway_c,$fieldname,$url);
			  $name_value_list = array(
					array('name' => 'salutation','value' => $salutation),
					array('name' => 'first_name','value' => $first_name),
					array('name' => 'last_name','value' => $last_name),
					array('name' => 'email1','value' => $email1),
					array('name' => 'phone_mobile','value' => $phone_mobile),
					array('name' => 'campaign_type_c','value' => $campaign_type_c),
					array('name' => 'city_c','value' => $city),
					array('name' => 'campaign_sub_type_c','value' => $campaign_sub_type_c),
					array('name' => 'related_corporate_account_c','value' => $related_corporate_account_c),
					array('name' => 'related_kiosk_account_c','value' => $related_kiosk_account_c),
					array('name' => 'referred_by_c','value' => $referred_by_c),
					array('name' => 'status','value' => 'Fresh'),
					array('name' => 'gateway_c','value' => $gateway_c),
					array('name' => 'assigned_user_id','value' => 1),
					array('name' => 'unique_customer_code_c','value' => $uniqueCustomerCode),
			 );
			 
			 $contactresult = createrecord($session_id, 'Contacts', $name_value_list, $url);
			 $id = $contactresult->id;
						$gateway_c = getdropdown($session_id,'Leads',$gateway_c,$fieldname,$url);
			 /**********create lead***************/
				$name_value_list = array(
					array('name' => 'salutation','value' => $salutation),
					array('name' => 'first_name','value' => $first_name),
					array('name' => 'last_name','value' => $last_name),
					array('name' => 'email1','value' => $email1),
					array('name' => 'phone_mobile','value' => $phone_mobile),
					array('name' => 'campaign_type_c','value' => $campaign_type_c),
					array('name' => 'city_c','value' => $city),
					array('name' => 'campaign_sub_type_c','value' => $campaign_sub_type_c),
					array('name' => 'related_corporate_account_c','value' => $related_corporate_account_c),
					array('name' => 'related_kiosk_account_c','value' => $related_kiosk_account_c),
					array('name' => 'referred_by_c','value' => $referred_by_c),
					array('name' => 'status','value' => 'Fresh'),
					array('name' => 'gateway_c','value' => $gateway_c),
					array('name' => 'assigned_user_id','value' => 1),
					array('name' => 'status','value' => 'Valid'),
					array('name' => 'converted','value' => 1),
					array('name' => 'otp_c','value' => $rawData->otp),
					array('name' => 'contact_id','value' => $id),
			 );
			 
			 $leadidresult = createrecord($session_id, 'Leads', $name_value_list, $url);
			 $lead_id = $leadidresult->id;
			 
			 $msg = array(
					'Success' => true,
					'Message' => 'User Created Successfully',
					'User id' => $id,
				   // 'data' => $contactresult,
				   // 'data' => $leadid
				);
				
			}
        }else{
			 $msg = array(
				'Success' => false,
				'Message' => 'Data already existed'
			);
		}
} else {
    $msg = array(
        'Success' => false,
        'Message' => 'Oops! Something went wrong'
    );
}
echo json_encode($msg);
exit;

//function to make cURL request
function call($method, $parameters, $url) {
    
    ob_start();
    $curl_request = curl_init();
    
    curl_setopt($curl_request, CURLOPT_URL, $url);
    curl_setopt($curl_request, CURLOPT_POST, 1);
    curl_setopt($curl_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($curl_request, CURLOPT_HEADER, 1);
    curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl_request, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_request, CURLOPT_FOLLOWLOCATION, 0);
    
    $jsonEncodedData = json_encode($parameters);
    
    $post = array(
        "method" => $method,
        "input_type" => "JSON",
        "response_type" => "JSON",
        "rest_data" => $jsonEncodedData
    );
    
    curl_setopt($curl_request, CURLOPT_POSTFIELDS, $post);
    $result = curl_exec($curl_request);
    curl_close($curl_request);
    
    $result   = explode("\r\n\r\n", $result, 2);
    $response = json_decode($result[1]);
    ob_end_flush();
    
    return $response;
}


function createrecord($session_id, $module, $create_entry_parameters, $url) {
    
    $set_entry_parameters = array(
        //session id
        "session" => $session_id,
        
        "module_name" => $module,
        
        //Record attributes
        "name_value_list" => $create_entry_parameters
    );
    
    $set_entry_result = call("set_entry", $set_entry_parameters, $url);
    
    
    $record_id = $set_entry_result->id;
   
    return $set_entry_result;
    
}

function updaterecord($session_id, $module, $create_entry_parameters, $url) {
    
    $set_entry_parameters = array(
        //session id
        "session" => $session_id,
        
        "module_name" => $module,
        
        //Record attributes
        "name_value_list" => $create_entry_parameters
    );
    
    $set_entry_result = call("set_entry", $set_entry_parameters, $url);
    $record_id        = $set_entry_result->id;
    //~ $id =$set_entry_result->id;
    //~ $status =$set_entry_result->status;
    //~ $record_id = array('Success'=>true,'Message' => 'Record updated succesfully','Record Id'=>$id,'status'=>$status);
    return $record_id;
    
}

function generateSession($username, $password, $url) {
	
    $login_parameters = array(
        "user_auth" => array(
            "user_name" => $username,
            "password" => md5($password),
            "version" => "1"
        ),
        "application_name" => "Rest",
        "name_value_list" => array()
    );
    
    $login_result = call("login", $login_parameters, $url);
    
    //get session id
    $session_id = $login_result->id;
    return $session_id;
}
function getdropdown($sessionID,$module, $needle,$fieldname,$url) {
  
//	echo $sessionID;echo $module;exit;
    $getContactFields = array(
        'session' => $sessionID,
        'module_name' => $module,
    );
    $getdropdownresult = call('get_module_fields', $getContactFields,$url)->module_fields;

    $getdropdownvalues = $getdropdownresult->$fieldname->options;

    foreach ($getdropdownvalues as $getdropdownKey => $getdropdownValue) {
		if(!empty($getdropdownValue->value))
		{
			if (strpos(strtolower($getdropdownValue->value), strtolower($needle)) !== false || strpos(strtolower($needle), strtolower($getdropdownValue->value)) !== false) {
				return $getdropdownKey;
			} else {
				$return = '';
			}
		}
		else
		{
			$return = '';
		}
    }

    return $return;
}
function getdropdown_campaign($sessionID,$module, $needle,$fieldname,$url) {
  
//	echo $sessionID;echo $module;exit;
    $getContactFields = array(
        'session' => $sessionID,
        'module_name' => $module,
    );
    $getdropdownresult = call('get_module_fields', $getContactFields,$url)->module_fields;

    $getdropdownvalues = $getdropdownresult->$fieldname->options;

    foreach ($getdropdownvalues as $getdropdownKey => $getdropdownValue) {
		if(!empty($getdropdownValue->value))
		{
			if (strpos(strtolower($getdropdownKey), strtolower($needle)) !== false || strpos(strtolower($needle), strtolower($getdropdownKey)) !== false) {
				return $getdropdownKey;
			} else {
				$return = '';
			}
		}
		else
		{
			$return = '';
		}
    }

    return $return;
}
?>
