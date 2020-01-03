<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
include('custom/include/language/en_us.lang.php');
 global $db;

if($_SERVER['PHP_AUTH_USER'] == 'partner_api' && $_SERVER['PHP_AUTH_PW'] == '5n@nce@32!')
{
	$fp      = fopen('php://input', 'r');
 	$rawData = json_decode(stream_get_contents($fp));
	$uniqueCustomerCode = $rawData->uniqueCustomerCode;
	$PartnerName = $rawData->PartnerName;
 	$PartnerComments = $rawData->PartnerComments;
 	$ProductInterest = $rawData->ProductInterest;
 	$ProductSubInterest = $rawData->SubProductInterest;
 	$AssistantID = $rawData->AssistantID;
 	/******generating sugar session id*********/
 	global $db, $sugar_config;
	$username = $sugar_config["webservice_username"];
	$password = $sugar_config["webservice_password"];
	$loginResult = login($username, $password);
	$sessionID = $loginResult->id;
	if(!empty($ProductInterest))
		{
			$fieldname = "product_interest_c";			
			$ProductInterest = getdropdown($sessionID,"Contacts",$ProductInterest,$fieldname);
			
		}
	if(!empty($ProductSubInterest))
		{
			$fieldname = "product_sub_type_interest_c";			
			$ProductSubInterest = getdropdown($sessionID,"Contacts",$ProductSubInterest,$fieldname);
			
		}
  	
 	//check contact already exists
 	 $fetch_contact_details = "select id,product_interest_c,product_sub_type_interest_c,CONCAT(IFNULL(first_name,''),' ',IFNULL(last_name,'')) as customer_name,assigned_user_id,assistant_id_c from contacts join contacts_cstm on id=id_c where deleted=0 and unique_customer_code_c='$uniqueCustomerCode'";
 	$result_contact_details = $db->query($fetch_contact_details);
 	
 	if($result_contact_details->num_rows > 0){
 		$row_contact_details = $db->fetchByAssoc($result_contact_details);
 		$crm_product_interest = $row_contact_details['product_interest_c'];
 		$crm_sub_product_interest = $row_contact_details['product_sub_type_interest_c'];
 		$contact_assigned_user_id = $row_contact_details['assigned_user_id'];
  		$contact_name = $row_contact_details['customer_name'];
  		$contact_id = $row_contact_details['id'];
  		$crm_assistant_id = $row_contact_details['assistant_id_c'];
  		$name = $contact_name.' - '.$rawData->ProductInterest.' - '.$rawData->SubProductInterest;

 		if(empty($crm_assistant_id)){
 			//update partner details
 		$update_partner_details = $db->query("UPDATE contacts join contacts_cstm on id=id_c set related_corporate_account_c='$PartnerName', partner_comments_c='$PartnerComments',product_interest_c='$ProductInterest',product_sub_type_interest_c='$ProductSubInterest',assistant_id_c='$AssistantID' where deleted=0 and unique_customer_code_c='$uniqueCustomerCode'");
 		 if($update_partner_details){
		    $msg = array(
		                'Success' => true,
		                'Message' => 'Partner Details updated in CRM',
		                'customer_code' => $uniqueCustomerCode,
		            );
		  }
	 	}else if(!empty($crm_assistant_id) && ($AssistantID==$crm_assistant_id)){
	 				//update partner details
 		$update_partner_details = $db->query("UPDATE contacts join contacts_cstm on id=id_c set related_corporate_account_c='$PartnerName', partner_comments_c='$PartnerComments',product_interest_c='$ProductInterest',product_sub_type_interest_c='$ProductSubInterest' where deleted=0 and unique_customer_code_c='$uniqueCustomerCode'");
 		 if($update_partner_details){
		    $msg = array(
		                'Success' => true,
		                'Message' => 'Partner Details updated in CRM',
		                'customer_code' => $uniqueCustomerCode,
		            );
		  }
	 	}
	 	else{

	 			//create product interest under contact
	 		//insert product interest
	 		if(!empty($ProductInterest))
			{
				$fieldname = "product_interest_c";			
				$ProductInterest = getdropdown($sessionID,"scrm_Products",$ProductInterest,$fieldname);
				
			}
			if(!empty($ProductSubInterest))
			{
				$fieldname = "product_sub_type_interest_c";		
				$ProductSubInterest = getdropdown($sessionID,"scrm_Products",$ProductSubInterest,$fieldname);
				
			}
  		
	 		$today_time = date('Y-m-d H:i:s');
  			$product_interest_time = date('Y-m-d H:i:s',strtotime('-5 hours -30 minutes',strtotime($today_time)));
  			$product_interest_id = create_guid();
  			$insert_product_interest = "INSERT INTO `scrm_products`(`id`, `name`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `description`, `deleted`, `assigned_user_id`) VALUES ('$product_interest_id','$name','$product_interest_time','$product_interest_time','$contact_assigned_user_id','1','',0,'$contact_assigned_user_id')";
  			$result_product_interest = $db->query($insert_product_interest);
       // echo "INSERT INTO `scrm_products_cstm`(`id_c`, `product_interest_c`,`product_sub_type_interest_c`) VALUES ('$product_interest_id','$product_interest_name','$sub_product_interest_name')";
  			$insert_product_interest_cstm = "INSERT INTO `scrm_products_cstm`(`id_c`, `product_interest_c`,`product_sub_type_interest_c`,`partner_name_c`,`partner_comments_c`,`assistant_id_c`) VALUES ('$product_interest_id','".$ProductInterest."','".$ProductSubInterest."','$PartnerName','$PartnerComments','$AssistantID')";
  			$result_product_interest_cstm = $db->query($insert_product_interest_cstm);
  			$product_relationship = create_guid();
  			$insert_product_relationship = "INSERT INTO `contacts_scrm_products_1_c`(`id`, `date_modified`, `deleted`, `contacts_scrm_products_1contacts_ida`, `contacts_scrm_products_1scrm_products_idb`) VALUES ('$product_relationship',NOW(),0,'$contact_id','$product_interest_id')";
  			$result_product_relationship = $db->query($insert_product_relationship);
  			 if($insert_product_interest){
		    $msg = array(
		                'Success' => true,
		                'Message' => 'Partner Details updated in CRM under contact',
		                'customer_code' => $uniqueCustomerCode,
		            );
		  }
	 	}
 		
 		 
 	}

 	

  // //update partner details
  // $update_partner_details = $db->query("UPDATE contacts join contacts_cstm on id=id_c set related_corporate_account_c='$PartnerName', partner_comment_c='$PartnerComments' where deleted=0 and unique_customer_code_c='$uniqueCustomerCode'");
 
 
			
	}else{
			$msg = array(
					'Success' => false,
					'Message' => 'Invalid Data',
									
				);
	}

	echo json_encode($msg);
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
   // echo $module;
    $getdropdownresult = call('get_module_fields', $getContactFields)->module_fields;

    $getdropdownvalues = $getdropdownresult->$fieldname->options;
    //print_r($getdropdownvalues);

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
}

?>