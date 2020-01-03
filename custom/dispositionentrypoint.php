<?php 
    
    
    if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
	global $db,$sugar_config,$current_user;
	
        $GLOBALS['log']->fatal("Dispositionentry point  entry point old: " . print_r($_REQUEST, true));
	
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
	
	if(($_REQUEST['dispositionName']=='Missed_Call')&&($_REQUEST['callType']=='inbound.dial.customer')){
		//$GLOBALS['log']->fatal("The Missed Call in office hour from Ameyo: " . print_r($_REQUEST, true));
		require_once('config.php');
		global $sugar_config;
		$sugar_config['facebook_page_id'];
		$NOH_EMail=	$sugar_config['noh_email'];
		// Logging into CRM 
		

	// Declaring global varibales
		global $db,$sugar_config;
		$user_id = '669a52e8-8873-0aff-26c2-584e58ae1e86'; 
		$date_start=date('Y-m-d h:i:s a');
		$date_start = date('Y-m-d H:i:s', strtotime('-5 hours', strtotime($date_start)));
		$date_start = date('Y-m-d H:i:s', strtotime('-30 minutes', strtotime($date_start)));
	// Parameters getting from ameyo
		$phone = $_REQUEST['phone'];
		//~ $non_office_menu = $_REQUEST['non_office_menu'];     // non_office_menu  will be using only in non office hour call
		$menuOption = $_REQUEST['menuOption'];     // non_office_menu id
		$languageOption = $_REQUEST['languageOption'];     //language option
		$campaignId = $_REQUEST['campaignId'];
		$userCrtObjectId = $_REQUEST['userCrtObjectId'];
		$dispositionCode = $_REQUEST['dispositionCode'];
		$ameyosessionId = $_REQUEST['sessionId'];
		$agentId = $_REQUEST['userId'];
		$dispositionClass = $_REQUEST['dispositionClass'];
		$crtObjectId = $_REQUEST['crtObjectId'];
		$dstPhone=$_REQUEST['dstPhone'];
		$customerCRTId = $_REQUEST['customerCRTId'];
		$dispositionName = $_REQUEST['dispositionName'];
		$callType = $_REQUEST['callType'];
		$recordingFileUrl = $_REQUEST['recordingFileUrl'];
		$ringingTime = $_REQUEST['ringingTime'];
		$Status = $_REQUEST['last_Status'];
		$ivrTime = $_REQUEST['ivrTime'];
		$callID = $_REQUEST['callId'];
		$userAssociations = $_REQUEST['userAssociations']; 
		$setupTime = $_REQUEST['setupTime'];
		$dialedTime= $_REQUEST['dialedTime'];
		$customerId = $_REQUEST['customerId'];
		$talkTime = $_REQUEST['talkTime'];
		$systemDisposition = $_REQUEST['systemDisposition'];
		$s_rcPhone = $_REQUEST['s_rcPhone'];
		
	/* **************** Call record creation =========*/
		$getContactid = checkNumber($phone,$date_start,$user_id,$dispositionCode); // checking number is exist or not. If not creating contact	
		if(!empty($languageOption)){
			$updatecontactlanguage = "Update contacts_cstm SET language_c = '$languageOption' WHERE id_c = '$getContactid'";
			//$GLOBALS['log']->fatal("Update Contact language Query disposition".$updatecontactlanguage);
			$resultupdatecontactlanguage = $db->query($updatecontactlanguage);
		}
		$callname = "Missed called in working hour by" . $phone;
		$user_id=getcontactuserid($getContactid);
		$customer_name=getcontactname($getContactid);
		$callRecordId = getcallid($customerCRTId);
							//$GLOBALS['log']->fatal(" call record id ".$callRecordId);

		if(!empty($callRecordId))
		{	
			$updatequery = "UPDATE calls join calls_cstm ON calls.id = calls_cstm.id_c SET calls_cstm.phone_c ='$phone', calls.name = '$callname', calls.parent_type = 'Contacts', calls.parent_id = '$getContactid', calls_cstm.dispositioncode_c ='$dispositionCode', calls_cstm.campaignid_c ='$campaignId', calls_cstm.dstphone_c ='$dstPhone', calls_cstm.calltype_c ='$callType', calls_cstm.recordingfileurl_c ='$recordingFileUrl', status ='Missed', calls_cstm.ringingtime_c ='$ringingTime', calls_cstm.srcphone_c ='$s_rcPhone', calls_cstm.ivrtime_c ='$ivrTime', calls_cstm.customerid_c ='$customerId',  calls_cstm.callid_c ='$callID', calls_cstm.setuptime_c ='$setupTime',  calls_cstm.systemdisposition_c ='$systemDisposition',calls_cstm.talktime_c ='$talkTime', calls.date_start ='$date_start', calls_cstm.non_office_menu_c ='$menuOption', calls_cstm.language_c ='$languageOption' WHERE calls_cstm.crtobjectid_c = '$customerCRTId' AND calls_cstm.asterisk_caller_id_c = '$phone'";
			//$GLOBALS['log']->fatal("Update Missed called in working hour Query".$updatequery);
			$result = $db->query($updatequery);  
			
		}else{
						//$GLOBALS['log']->fatal("create call record");

			$set_entry_parameters = array(
			 "session" => $session_id,
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
				  array("name" => "campaignid_c", "value" => $campaignId),
				  array("name" => "crtobjectid_c", "value" => $customerCRTId),
				  array("name" => "non_office_menu_c", "value" => $non_office_menu),
				  array("name" => "dstphone_c", "value" => $dstPhone),
				  array("name" => "calltype_c", "value" => $callType),
				  array("name" => "recordingfileurl_c", "value" => $recordingFileUrl),
				  array("name" => "ringingtime_c", "value" => $ringingTime),
				  array("name" => "srcphone_c", "value" => $s_rcPhone),
				  array("name" => "ivrtime_c", "value" => $ivrTime),
				  array("name" => "systemdisposition_c", "value" => $systemDisposition),
				  array("name" => "talktime_c", "value" => $talktime_c),
				  array("name" => "asterisk_caller_id_c", "value" => $phone),
				  array("name" => "dispositioncode_c", "value" => $dispositionCode),
				  array("name" => "non_office_menu_c", "value" => $menuOption),
				  array("name" => "language_c", "value" => $languageOption),
			 ),
			);

		$callCreate = call("set_entry", $set_entry_parameters, $url);
		$callRecordId = $callCreate->id;  
			}
		update_securitygroup($user_id,$callRecordId);
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
		exit;	
		}
	
	//$GLOBALS['log']->fatal("The Disposition entry point parameter from Ameyo: " . print_r($_REQUEST, true));
	if($_REQUEST['customerCRTId']){
	$phone = $_REQUEST['phone'];
   //~ $non_office_menu = $_REQUEST['non_office_menu'];     // non_office_menu  will be using only in non office hour call
	$menuOption = $_REQUEST['menuOption'];     // non_office_menu id
	$languageOption = $_REQUEST['languageOption'];     //language option
    $campaignId =$_REQUEST['campaignId'];
    $userCrtObjectId = $_REQUEST['userCrtObjectId'];
    $dispositionCode = $_REQUEST['dispositionCode'];
    $ameyosessionId = $_REQUEST['sessionId'];
    $agentId = $_REQUEST['userId'];
    $dispositionClass = $_REQUEST['dispositionClass'];
    $crtObjectId = $_REQUEST['crtObjectId'];
    $dstPhone=$_REQUEST['dstPhone'];
    $customerCRTId = $_REQUEST['customerCRTId'];
    $dispositionName = $_REQUEST['dispositionName'];
    $callType = $_REQUEST['callType'];
    $recordingFileUrl = $_REQUEST['recordingFileUrl'];
    $ringingTime = $_REQUEST['ringingTime'];
    $last_Status = $_REQUEST['lastStatus'];
    if($last_Status=='Missed_Call'){
		$Status = "Missed";
		}else{
			$Status = "Held";
			}

    
    $ivrTime = $_REQUEST['ivrTime'];
    $callID = $_REQUEST['callId'];
    $userAssociations = $_REQUEST['userAssociations']; 
    $setupTime = $_REQUEST['setupTime'];
    $dialedTime= $_REQUEST['dialedTime'];
    $customerId = $_REQUEST['customerId'];
    $talkTime = $_REQUEST['talkTime'];
    $systemDisposition = $_REQUEST['systemDisposition'];
    $s_rcPhone = $_REQUEST['s_rcPhone'];
    $dispositionCode = $_REQUEST['dispositionCode'];
	$userAssociations = $_REQUEST['userAssociations'];
	//~ $userAssociations="[{&quot;userId&quot;:&quot;ashish&quot;,&quot;associtionType&quot;:&quot;manualdial.association&quot;,&quot;dispositionCode&quot;:&quot;Test Data&quot;,&quot;associationId&quot;:&quot;d825-59842b80--assoc--113493&quot;}]";
	$userAssociations=explode('&quot;',$userAssociations);
	$user_name = $userAssociations[3];
	$user_id = getuserid($user_name);
    $date_start=$_REQUEST['dialedTime'];
   
    //~ $date_start = date('Y-m-d H:i:s', strtotime('-5 hours', strtotime($date_start)));
    $date_start = date('Y-m-d H:i:s', strtotime('-5 hours', strtotime(substr($date_start, 0, 19))));
    $date_start = date('Y-m-d H:i:s', strtotime('-30 minutes', strtotime($date_start)));
   //Updaate contact language
    	$getContactid = checkpickedNumber($phone,$date_start,$user_id,$dispositionCode); // checking number is exist or not. If not creating contact	
	if(!empty($languageOption)){
		$updatecontactlanguage = "Update contacts_cstm SET language_c = '$languageOption' WHERE id_c = '$getContactid'";
		//$GLOBALS['log']->fatal("Update Contact language Query disposition".$updatecontactlanguage);
		$resultupdatecontactlanguage = $db->query($updatecontactlanguage);
	}
    
	$call_id = getcallid($customerCRTId);
	update_securitygroup($user_id,$call_id);
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
         $call_id,
        ),
        //Sets the value for relationship based fields
        //Whether or not to delete the relationship. 0:create, 1:delete
        'deleted'=> 0,
        );
        call("set_relationship", $set_relationship_parameters, $url);
   
    $updatequery = "update calls join calls_cstm on calls.id = calls_cstm.id_c set calls_cstm.phone_c ='$phone', calls.name = '$dispositionCode', calls.assigned_user_id = '$user_id', calls.parent_type = 'Contacts', calls.parent_id = '$getContactid', calls_cstm.dispositioncode_c ='$dispositionCode', calls_cstm.campaignid_c ='$campaignId', calls_cstm.dstphone_c ='$dstPhone', calls_cstm.calltype_c ='$callType', calls_cstm.recordingfileurl_c ='$recordingFileUrl', status ='$Status', calls_cstm.ringingtime_c ='$ringingTime', calls_cstm.srcphone_c ='$s_rcPhone', calls_cstm.ivrtime_c ='$ivrTime', calls_cstm.customerid_c ='$customerId',  calls_cstm.callid_c ='$callID', calls_cstm.setuptime_c ='$setupTime',  calls_cstm.systemdisposition_c ='$systemDisposition',calls_cstm.talktime_c ='$talkTime', calls.date_start ='$date_start', calls_cstm.non_office_menu_c ='$menuOption', calls_cstm.language_c ='$languageOption' where calls_cstm.crtobjectid_c = '$customerCRTId' and calls_cstm.asterisk_caller_id_c = '$phone'";
	//$GLOBALS['log']->fatal("Update Disposition Query 1".$updatequery);
    $result = $db->query($updatequery);
    
}
 
if($_REQUEST['crtObjectId']){
    $userCrtObjectId = $_REQUEST['userCrtObjectId'];
    $phone = $_REQUEST['phone'];
    $campaignId = $_REQUEST['campaignId'];
    $dispositionClass = $_REQUEST['dispositionClass'];
    $crtObjectId = $_REQUEST['crtObjectId'];
    $dispositionCode = $_REQUEST['dispositionCode'];
    $userId = $_REQUEST['userId'];
    $customerId = $_REQUEST['customerId'];
    $Today = gmdate("Y-m-d H:i:s");
    $user_id = getuserid($userId);
    $call_id = getcallid($crtObjectId);
    update_securitygroup($user_id,$call_id);
    $updatequery = "Update calls join calls_cstm on calls.id = calls_cstm.id_c set calls.name = '$dispositionCode', calls_cstm.dispositioncode_c ='$dispositionCode', calls_cstm.phone_c ='$phone', calls_cstm.campaignid_c ='$campaignId', calls_cstm.dispositionclass_c ='$dispositionClass', calls.assigned_user_id = '$user_id', calls.date_modified = '$Today' where calls_cstm.crtobjectid_c = '$crtObjectId' and calls_cstm.asterisk_caller_id_c = '$phone'";
	//$GLOBALS['log']->fatal("Update Disposition Query 2".$updatequery);
    $result = $db->query($updatequery);
}

function getcallid($crtObjectId){
	global $db;
	$getcallid = "SELECT id from calls, calls_cstm  WHERE calls.id = calls_cstm.id_c AND calls_cstm.crtobjectid_c = '$crtObjectId' AND calls.deleted = '0'";
   // $GLOBALS['log']->fatal("get the call ID ".$getcallid);
    $result =$db->query($getcallid);
    $row=$db->fetchByAssoc($result);
    return $row['id'];
	}
	
function getuserid($user_name){
	global $db;
	$getuserid = "SELECT id FROM users WHERE user_name = '$user_name' AND deleted = '0'";
   //$GLOBALS['log']->fatal("get the user ID ".$getuserid);
    $result =$db->query($getuserid);
    $row=$db->fetchByAssoc($result);
    return $row['id'];
	}

function update_securitygroup($user_id,$call_id){
	global $db;
	$getsecuritygroupid = "SELECT `securitygroup_id`  FROM `securitygroups_users` WHERE `user_id` = '$user_id' AND `deleted`='0'";
    //$GLOBALS['log']->fatal("select securitygroups_record Query".$getsecuritygroupid);

    $result =$db->query($getsecuritygroupid);
    while($row=$db->fetchByAssoc($result)) {
		$securitygroup_id = $row['securitygroup_id'];
		$securitygroups_records_id=create_guid();
		$Today=gmdate("Y-m-d H:i:s");
		$securitygroups_recordsquery = "INSERT INTO `securitygroups_records`(`id`, `securitygroup_id`, `record_id`, `module`, `date_modified`, `modified_user_id`, `created_by`, `deleted`) VALUES ('$securitygroups_records_id','$securitygroup_id','$call_id','Calls','$Today','$user_id','$user_id','0')";
		//$GLOBALS['log']->fatal("Update calls securitygroups_record Query".$securitygroups_recordsquery);
		$result = $db->query($securitygroups_recordsquery);
		}
	}
	
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
			$query = "select id from contacts c where (c.phone_home = '$number' or c.phone_mobile = '$number' or "
					 . "c.phone_work = '$number' or c.phone_other = '$number') and c.deleted = 0 limit 1";         
			$result =$db->query($query);

			if($result->num_rows == 0) 
				{
					$title = "Called after working hour " . $number;			
					$contact_id = create_guid();
					$contactname = "New contact missed call from " . $number;
						
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
	
	//Call picked up by agent
function checkpickedNumber($number,$date,$user_id,$dispositionCode)
	{
	 
      global $db;
      $contact_id = ''; 
			$query = "select id from contacts c where (c.phone_home = '$number' or c.phone_mobile = '$number' or "
					 . "c.phone_work = '$number' or c.phone_other = '$number') and c.deleted = 0 limit 1";         
			$result =$db->query($query);

			if($result->num_rows == 0) 
				{
					$title = "Called picked up by agent in working hour " . $number;			
					$contact_id = create_guid();
					$contactname = "New contact of picking call from " .$number;
						
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
	  $date = date('Y-m-d H:i:s', strtotime('5 hours', strtotime($date)));
	  $date = date('Y-m-d H:i:s a', strtotime('30 minutes', strtotime($date)));
      $sub = "Notification for Missed calls from ".$number;
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
?>
