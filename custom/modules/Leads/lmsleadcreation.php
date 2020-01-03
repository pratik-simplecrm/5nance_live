<?php

if (!define('sugarEntry'))define('sugarEntry', true);
require_once('include/entryPoint.php');
require_once('custom/include/language/en_us.lang.php');
//ini_set('display_errors','On');
global $db, $sugar_config;
$GLOBALS['log']->fatal("lms api :");
$url = $sugar_config["webservice_url"];
$username = $sugar_config["webservice_username"];
$password = $sugar_config["webservice_password"];
global $db,$sugar_config;

if($_SERVER['PHP_AUTH_USER'] == '5nance' && $_SERVER['PHP_AUTH_PW'] == '5n@nce#123!')
{
	 $fp      = fopen('php://input', 'r');

  
$GLOBALS['log']->fatal("lms inside api :");
    $session_id = generateSession($username, $password, $url);
	$rawData = json_decode(stream_get_contents($fp));
	
	$Unique_lead_id=$rawData->leadid;
	$fullname=$rawData->fullname;
	$city=$rawData->city;
	 if($fullname){
			$fullname_array = explode(" ", $fullname);
			$first_name = $fullname_array[0];
			$middle_name = $fullname_array[1];
			$last_name	 = $fullname_array[2];
			if(empty($last_name)){
				$last_name = $middle_name;
				$middle_name = '';
			}
		}
	
	  //-----START prepare name value list for lead 
    $select_column = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE TABLE_SCHEMA = '5nance_production' AND (`TABLE_NAME` = 'leads' || `TABLE_NAME` = 'leads_cstm') ";
	$result_column = $db->query($select_column);
	$row = $db->fetchByAssoc($result_column);
	$define_key_column= array();
	$define_name_value_list= array();
	$name_value_list_param= array();
	$name_value_list= array();
	while($row = $result_column->fetch_assoc()) {
     $define_key_column[$row["COLUMN_NAME"]]= $row["COLUMN_NAME"];
    }
   //print_r($define_key_column);exit;
	
	//Modify key of custom column
	foreach($define_key_column as $k=>$v) {
        if('_c'==substr($k,-2)){
			$define_key_column[substr($k , 0, (strlen($k)-2))]=$v;
			unset($define_key_column[$k]);
			}
    }
   //~ print_r($define_key_column);

    //Existing key define in current API 
    $define_existkey_column=array('fullname'=>'last_name','mobile'=>'phone_mobile','email'=>'email1');
	
	//Merge with define key column 
	$define_key_column=array_merge($define_key_column,$define_existkey_column);
	//print_r($define_key_column);
	
	function keyexist($key,$arr){
		foreach($arr as $k=>$v){
			if(!strcasecmp($k,$key)){
				return $k;
				}		 
			}
		} 

	//Preparing define_name_value_list of API data
	foreach($rawData as $key=>$value) {
		$k= keyexist($key,$define_key_column);
		$newkey=isset($k)?$define_key_column[$k]:$key;
		$define_name_value_list[$newkey]=$value;
    }
   
    if(!empty($city))
	{
		$fieldname = "city_c";
		$city = getdropdown($session_id,'Leads',$city,$fieldname,$url);
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

		//default_name_value_list_param for Lead
		$default_name_value_list_param=array('status'=>'Fresh','disposition_c'=>'Fresh_Fresh','gateway_c'=>'CRM-MARKETING','assigned_user_id'=> 1,'first_name'=>$first_name,'last_name'=>$last_name,'middle_name_c'=>$middle_name,'city_c'=>$city);

		//Merge default_name_value_list_param with define_name_value_list 
		$define_name_value_list=array_merge($define_name_value_list,$default_name_value_list_param);
		
                 $GLOBALS['log']->fatal("lmsleadcreation api :".print_r($define_name_value_list,true));
		//Preparing a name_value_list for create_lead_API
		$i=0;
		foreach($define_name_value_list as $k=>$v) {
			 $name_value_list[$i] =(isset($v) ? array('name' => $k,'value' => $v) : '');
			 $i++;
		}
		
		//echo $Unique_lead_id;
		$fetch_lead_query = "select * from leads join leads_cstm on id=id_c where deleted=0 and leadid_c='".$Unique_lead_id."'";
		$result_lead_query = $db->query($fetch_lead_query);
	
		if($result_lead_query->num_rows  == 0){
				 $leadresult = createrecord($session_id, 'Leads', $name_value_list, $url);
				 $leadresult_data = json_encode($leadresult);
			 $lead_id = $leadresult->id;
			 $msg = array(
					'Success' => true,
					'Message' => 'Lead Created Successfully',
					'crmleadid' => $lead_id,
					'data' => $leadresult_data
				);
		}else{
				$row_lead_query = $db->fetchByAssoc($result_lead_query);
				$name_value_list[] = array('name'=>'id','value'=>$row_lead_query['id']);
				$leadresult = createrecord($session_id, 'Leads', $name_value_list, $url);
			 $lead_id = $leadresult->id;
			 $msg = array(
					'Success' => true,
					'Message' => 'Lead Updated Successfully',
					'crmleadid' => $lead_id,
					
				);
 		}

		
			
		//	}

}else {
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
