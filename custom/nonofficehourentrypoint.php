<?php
	//$GLOBALS['log']->fatal("The Non office hour entry point parameter from Ameyo: " . print_r($_REQUEST, true));
	require_once('config.php');
	global $sugar_config;
	$sugar_config['facebook_page_id'];
	$NOH_EMail=	$sugar_config['noh_email'];
	// Logging into CRM 
     $url = $sugar_config['webservice_url'];
     $username = $sugar_config['asterisk_soapuser'];
     $password = $sugar_config['asterisk_soappass'];
    //login ----------------------------------------------------- 
    $login_parameters = array(
        "user_auth" => array(
            "user_name" => $username,
            "password" => md5($password),
            "version" => "1"
        ),
        "application_name" => "RestTest",
        "name_value_list" => array(),
    );

    $login_result = call("login", $login_parameters, $url);
    $session_id = $login_result->id;

// Declaring global varibales
	global $db,$sugar_config;
	global $define_key_words; 
	$define_key_words = array('1'=>'Invoage Inbound Campaign', '2'=>'Invoage Outbound Campaign','3'=>'Campaign No 3', '4'=>'Campaign No 4', 
'5'=>'Campaign No 5');
	$user_id = '669a52e8-8873-0aff-26c2-584e58ae1e86'; 
	$date_start=date('Y-m-d h:i:s a');
// Parameters getting from ameyo
    $phone = $_REQUEST['srcPhone'];
//	$crtObjectId = $_REQUEST['crtObjectId'];//not passing
	$customerCRTId = $_REQUEST['customerCRTId'];
    $non_office_menu = $_REQUEST['non_office_menu'];     // non_office_menu id For hindi and english value we are displaying blank 
    $campaignId =$_REQUEST['campaignId'];
    $languageOption =$_REQUEST['languageOption'];

    $getContactid = checkNumber($phone,$date_start,$user_id,$dispositionCode); // checking number is exist or not. If not creating contact
	if(!empty($languageOption)){
		$updatecontactlanguage = "Update contacts_cstm SET language_c = '$languageOption' WHERE id_c = '$getContactid'";
		//$GLOBALS['log']->fatal("Update Contact language Query nfs missed call".$updatecontactlanguage);
		$resultupdatecontactlanguage = $db->query($updatecontactlanguage);
	}
/* **************** Call record creation =========*/

	$callname = "Called after working hour " . $phone;
	$user_id=getcontactuserid($getContactid);
	$customer_name=getcontactname($getContactid);
    $set_entry_parameters = array(
         //session id
         "session" => $session_id,
         //The name of the module from which to retrieve records.
         "module_name" => "Calls",

         //Record attributes
         "name_value_list" => array(
              //to update a record, you will nee to pass in a record id as commented below
              array("name" => "name", "value" => $callname),
              array("name" => "direction", "value" => "Inbound"),
              array("name" => "assigned_user_id", "value" => $user_id),
              array("name" => "date_start", "value" => $date_start),
              array("name" => "parent_type", "value" => 'Contacts'),
              array("name" => "status", "value" => 'Missed'),
              array("name" => "asterisk_caller_id_c", "value" => $phone),
              array("name" => "phone_c", "value" => $phone),
              array("name" => "parent_id", "value" => $getContactid),
              array("name" => "date_start", "value" => $date_start),
              array("name" => "date_end", "value" => $date_start),
              array("name" => "crtobjectid_c", "value" => $customerCRTId),
              array("name" => "campaignid_c", "value" => $campaignId),
              array("name" => "non_office_menu_c", "value" => $non_office_menu),
              array("name" => "language_c", "value" => $languageOption),
         ),
    );

    $callCreate = call("set_entry", $set_entry_parameters, $url);
    $callRecordId = $callCreate->id;  

    // API ends here

    
         $set_relationship_parameters = array(
        //session id
        'session' => $session_id,
        //The name of the module.
        'module_name' => 'Contacts',
        //The ID of the specified module bean.
        'module_id' => $getContactid,
        //The relationship name of the linked field from which to relate records.
        'link_field_name' => 'calls',
        //The list of record ids to relate
        'related_ids' => array(
         $callRecordId,
        ),
        //Sets the value for relationship based fields
        //Whether or not to delete the relationship. 0:create, 1:delete
        'deleted'=> 0,
        );
        call("set_relationship", $set_relationship_parameters, $url);

/* ============= call record creation ends here ====*/

	sendMail($phone,$date_start,$NOH_EMail,$customer_name);




/* ======== function start here ==========*/ 

//function to make cURL request
function call($method, $parameters, $url) {
    ob_start();
    $curl_request = curl_init();

    curl_setopt($curl_request, CURLOPT_URL, $url);
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

// function for testing number is present or not

function checkNumber($number,$date,$user_id,$dispositionCode)
	{
	 
      global $db;
      $contact_id = ''; 
			$date = date('Y-m-d H:i:s', strtotime('-5 hours', strtotime($date)));
			$date = date('Y-m-d H:i:s', strtotime('-30 minutes', strtotime($date)));
			$query = "select id from contacts c where (c.phone_home = '$number' or c.phone_mobile = '$number' or "
					 . "c.phone_work = '$number' or c.phone_other = '$number') and c.deleted = 0 limit 1";         
			$result =$db->query($query);

			if($result->num_rows == 0) 
				{
					$title = "Called after working hour " . $number;			
					$contact_id = create_guid();
					$contactname = "New contact " . $number;
						
					$createcquery = "INSERT INTO contacts(id,date_entered,date_modified,modified_user_id,created_by,description,deleted,assigned_user_id,last_name,title,phone_mobile) VALUES 
					('$contact_id','$date','$date','$user_id','$user_id','$title','0','$user_id','$contactname','$title','$number')"; 				
					$createcresult = $db->query($createcquery);
		
					$createcquery1 = "INSERT INTO contacts_cstm(id_c,disposition_c)VALUES ('$contact_id','$dispositionCode')";  
					$createcresult1 = $db->query($createcquery1);
					
				}else{							
					$row=$db->fetchByAssoc($result);
					$contact_id = $row['id']; 
				
				}
			return $contact_id; 	
					
	}	
		
function getcontactuserid($contact_id)
	{
	 
      global $db;
			$query = "Select assigned_user_id from contacts c where c.id='$contact_id' AND c.deleted = 0 limit 1";         
			$result =$db->query($query);	
			$row=$db->fetchByAssoc($result);
			$userId = $row['assigned_user_id']; 
			return $userId; 	
					
	}		
 
function getcontactname($contact_id)
	{
	 
      global $db;
			$query = "Select first_name, last_name from contacts c where c.id='$contact_id' AND c.deleted = 0 limit 1";         
			$result =$db->query($query);	
			$row=$db->fetchByAssoc($result);
			$first_name = $row['first_name']; 
			$last_name = $row['last_name']; 
			return $first_name.' '.$last_name; 	
	}		

// function for sending email

function sendMail($number,$date, $NOH_EMail, $customer_name)

	{

	  $sub = "Notification for Missed calls after working hour by".$number;
      $body = "Contact Name : ".$customer_name." was calling at " . $date." from ".$number; 

      require_once('include/SugarPHPMailer.php');  
      $emailObj = new Email();  
      $defaults = $emailObj->getSystemDefaultEmail();  
      $mail = new SugarPHPMailer();  
      $mail->setMailerForSystem();  
      $mail->From = $defaults['email'];  
      $mail->FromName = $defaults['name'];  
      $mail->Subject = $sub;  
      $mail->Body = $body;
      $mail->prepForOutbound();  
      $mail->AddAddress($NOH_EMail);  
      @$mail->Send(); 

	}	

/* ========== functions ends here ===============*/

?>
