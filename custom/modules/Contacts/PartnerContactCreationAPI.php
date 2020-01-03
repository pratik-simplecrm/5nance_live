<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
// require_once('include/entryPoint.php');
// include_once('include/SugarPHPMailer.php');
// include_once('include/utils/db_utils.php');
include('custom/include/language/en_us.lang.php');
// include('include/language/en_us.lang.php')
 global $db;
if($_SERVER['PHP_AUTH_USER'] == 'partner_contact' && $_SERVER['PHP_AUTH_PW'] == '5n@nce@32!')
{

	$fp      = fopen('php://input', 'r');
 	$rawData = json_decode(stream_get_contents($fp));
 	
 	/******generating sugar session id*********/
 	global $db, $sugar_config;
	$username = $sugar_config["webservice_username"];
	$password = $sugar_config["webservice_password"];
	$loginResult = login($username, $password);
	
	$sessionID = $loginResult->id;
	$module = "Contacts";

 	$uniqueCustomerCode = $rawData->uniqueCustomerCode;
  	$customername	= $rawData->name;
  	$customermobile	= $rawData->MobileNumber;
  	$customeremail	= $rawData->EmailID;
  	$gateway	= $rawData->gateway;
  	$AssistantID	= $rawData->AssistantID;
  
  	if(!empty($gateway))
		{
			$fieldname = "gateway_c";
			if($gateway == 'EXTERNALBO'){
				$gateway = 'Digital Marketing';
			}
			if(strpos($gateway,'-')!==false){
				$gateway_array = explode("-", $gateway);
				$gateway = $gateway_array[0];
			}
			$gateway = getdropdown($sessionID,"Contacts",$gateway,$fieldname);
			
		}
  	
  	$PartnerName = $rawData->PartnerName;
 	$PartnerComments = $rawData->PartnerComments;

 	if(!(empty($customername)))
		{
			$name_array = explode(" ", $customername);
			$first_name = $name_array[0];
			$middle_name = $name_array[1];
			$last_name	 = $name_array[2];
			if(empty($last_name)){
				$last_name = $middle_name;
				$middle_name = '';
			}
		}
		 $name_value_list = array(
					(!empty($first_name) ? array('name' => 'first_name','value' => trim($first_name)) : array('name' => 'first_name','value' => '')),
					(!empty($middle_name) ? array('name' => 'middle_name_c','value' => trim($middle_name)) : array('name' => 'middle_name_c','value' => '')),
					(!empty($last_name) ? array('name' => 'last_name','value' => trim($last_name)) : array('name' => 'last_name','value' => '')),
					(!empty($customeremail) ? array('name' => 'email1','value' => $customeremail) :  array('name' => 'email1','value' => '')),
					(!empty($customermobile) ? array('name' => 'phone_mobile','value' => $customermobile) : array('name' => 'phone_mobile','value' => '')),
					(!empty($gateway) ? array('name' => 'gateway_c','value' => $gateway) :  array('name' => 'gateway_c','value' => '')),
					(!empty($PartnerName) ? array('name' => 'related_corporate_account_c','value' => $PartnerName) :  array('name' => 'related_corporate_account_c','value' => '')),
					(!empty($PartnerComments) ? array('name' => 'partner_comments_c','value' => $PartnerComments) :  array('name' => 'partner_comment_c','value' => '')),
					(!empty($uniqueCustomerCode) ? array('name' => 'unique_customer_code_c','value' => $uniqueCustomerCode) : ''),
					(!empty($AssistantID) ? array('name' => 'assistant_id_c','value' => $AssistantID) : ''),
					
				);

		//fetch customer details
		$get_unique_code_query = $db->query("select id,date_modified,modified_user_id from contacts join contacts_cstm where id=id_c and deleted=0 and unique_customer_code_c = '$uniqueCustomerCode'");

		//create contact
		if($get_unique_code_query->num_rows == 0){
			
				$insert_customer_code = $db->query("INSERT INTO customer_code (customer_code) VALUES ('" . $uniqueCustomerCode . "')");
				$select_customer_code = $db->query("select customer_code from customer_code where customer_code = '" . $uniqueCustomerCode . "'");
				if ($select_customer_code->num_rows == 1) {
						$user_creation = create_user($sessionID,"Contacts",$name_value_list);
						$name_value_list[] = array('name' => 'disposition_c','value' => '');
						$user_creation_object = $user_creation->entry_list;						
						$contact_id = $user_creation_object->id->value;
					 	$contact_array = json_encode($user_creation);
					 	// print_r($user_creation_object);
					 	// print_r($name_value_list);
						if($contact_id){
							$msg = array(
			                'Success' => true,
			                'Message' => 'Contact - Partner created successfully',
			                'contact_id' => $contact_id,
			                 'contact data' => $contact_array,
			            	);
						}						
				  }
				}else{
					//echo 'inside test';
					$row_unique_code = $db->fetchByAssoc($get_unique_code_query);
						$name_value_list[] = array('name' => 'id','value' => $row_unique_code['id']);
						$user_creation = create_user($sessionID,"Contacts",$name_value_list);
						$user_creation_object = $user_creation->entry_list;
					 	$contact_code = $user_creation_object->unique_customer_code_c->value;
					 	$contact_array = json_encode($user_creation);
						if($contact_code){
					    $msg = array(
					                'Success' => true,
					                'Message' => 'Partner Details updated in CRM',
					                'contact_code' => $contact_code,
					                'contact data' => $contact_array,
					            );
					  }else{
					  	$msg = array(
					                'Success' => false,
					                'Message' => 'not updated',
					                'contact_code' => $contact_code,
					                'contact data' => $contact_array,
					            );
					  }
				}
			
	}else{
			$msg = array(
					'Success' => false,
					'Message' => 'Invalid Data',
									
				);
	}

	echo json_encode($msg);

//contact creation
function create_user($sessionID,$module,$name_value_list){		
	$createuser = array(
                    "session" => $sessionID,
                    "module_name" => $module,
                    "name_value_list" => $name_value_list,
                );
              $setuserEntryID = call("set_entry", $createuser);
			  return $setuserEntryID;
}
//function to make cURL request
function call($method, $parameters)
{
		global $sugar_config;
		ob_start();
		
		$curl_request = curl_init();
		$curlURL = $sugar_config["webservice_url"];
        curl_setopt($curl_request, CURLOPT_URL, $curlURL);
        curl_setopt($curl_request, CURLOPT_POST, 1);
        curl_setopt($curl_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($curl_request, CURLOPT_HEADER, 1);
        curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, 0);
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

        $result = explode("\r\n\r\n", $result, 2);
        $response = json_decode($result[1]);
        ob_end_flush();

        return $response;
}
//login ------------------------------     
function login($username,$password){
    $login_parameters = array(
         "user_auth" => array(
              "user_name" => $username,
              "password" => md5($password),
              "version" => "1"
         ),
         "application_name" => "RestTest",
         "name_value_list" => array(),
    );

    $login_result = call("login", $login_parameters);
    return $login_result;
}
function getdropdown($sessionID,$module, $needle,$fieldname) {
  
	
    $getContactFields = array(
        'session' => $sessionID,
        'module_name' => $module,
    );
    $getdropdownresult = call('get_module_fields', $getContactFields)->module_fields;

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
?>