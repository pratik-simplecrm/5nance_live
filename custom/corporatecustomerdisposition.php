<?php 


    if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
	global $db,$sugar_config,$current_user;
	 $GLOBALS['log']->fatal("Dispositionentry point  entry point from Corporate: " . print_r($_REQUEST, true));

	    $url = $sugar_config['webservice_url'];
	      $username = $sugar_config['asterisk_soapuser'];
	   $password = $sugar_config['asterisk_soappass'];
		//login --------------------------------------------Missed_Call--------- 
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
  //~ print_r($login_result);

		 $session_id = $login_result->id;
	//~ if($_REQUEST['DID']=='1323656565'){   Missed_Call
	if(($_REQUEST['dispositionName']=='Missed_Call')&&(($_REQUEST['callType']=='inbound.dial.customer')||($_REQUEST['callType']=='inbound.call.dial'))){
		echo"ok";
		//$GLOBALS['log']->fatal("The Missed Call in office hour from Ameyo: " . print_r($_REQUEST, true));
		require_once('config.php');
		global $sugar_config;
		$sugar_config['facebook_page_id'];
		$CS_EMail=	$sugar_config['cs_email'];
		// Logging into CRM 
		

	// Declaring global varibales
		global $db,$sugar_config;
		//$user_id = '669a52e8-8873-0aff-26c2-584e58ae1e86'; //Ashish 
		$user_id = 'a832061d-3f90-874b-49ae-584e5df4d84f'; //Anil chandani
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
	if(($dstPhone=='6733')||($dstPhone=='6713')){
		$callType =$callType.'.corporate';
		}
		
	/* **************** Call record creation =========*/
		// $getContactid = checkNumber($phone,$date_start,$user_id,$dispositionCode); // checking number is exist or not. If not creating contact	
		$query = "select id from contacts c where (c.phone_home = '$phone' or c.phone_mobile = '$phone' or "
			 . "c.phone_work = '$phone' or c.phone_other = '$phone') and c.deleted = 0 limit 1";         
		$result =$db->query($query);

		if($result->num_rows == 0) 
		{

		$query = "select id from leads l where (l.phone_mobile = '$phone' or l.phone_home = '$phone') and l.deleted = 0 limit 1";             
	    $leadResult =$db->query($query);
		    
			if($leadResult->num_rows == 0) 
			{
					$title = "Called after working hour " . $phone;			
					$lead_id = create_guid();
					$leadname = "New lead missed call from " . $phone." To Corporate DID";
					$date = $date_start;
					$createLeadQuery = "INSERT INTO leads(id,date_entered,date_modified,modified_user_id,created_by,description,deleted,assigned_user_id,last_name,title,phone_mobile) VALUES 
					('$lead_id','$date','$date','$user_id','$user_id','$title','0','$user_id','$leadname','$title','$phone')"; 				
					//$db->query($createLeadQuery);

					//$createLeadQuery1 = "INSERT INTO leads_cstm(id_c,disposition_c)VALUES ('$lead_id','$dispositionCode')";  
					//$db->query($createLeadQuery1);
					 $set_entry_parameters = array(
					 "session" => $session_id,
					 "module_name" => "Leads",
					 //Record attributes
					 "name_value_list" => array(
						  //to update a record, you will nee to pass in a record id as commented below
						  array("name" => "last_name", "value" => $leadname),
						  array("name" => "direction", "value" => "Inbound"),
						  array("name" => "modified_user_id", "value" => $user_id),
						  array("name" => "assigned_user_id", "value" => $user_id),
						  array("name" => "created_by", "value" => $user_id),
						  array("name" => "description", "value" => $title),
						  array("name" => "title", "value" => $title),
						  array("name" => "status", "value" => 'Missed'),
						  array("name" => "phone_mobile", "value" => $phone),
						  array("name" => "gateway_c", "value" => 'CRM-CORPORATE SALES'),
						  array("name" => "disposition_c", "value" => $dispositionCode),
						 
					 ),
					);

					$leadCreate = call("set_entry", $set_entry_parameters, $url);
					$lead_id = $leadCreate->id; 

					$parent_id = $lead_id;
					$parent_type = "Leads";
			}else{
				$row=$db->fetchByAssoc($leadResult);
				$parent_id = $row['id']; 
				$parent_type = "Leads";

				$query = "Select assigned_user_id,first_name, last_name from leads l where l.id='$parent_id' AND l.deleted = 0 limit 1";         
				$result =$db->query($query);	
				$row=$db->fetchByAssoc($result);
				$userId = $row['assigned_user_id']; 
				$first_name = $row['first_name']; 
				$last_name = $row['last_name']; 
				$customer_name = $first_name.' '.$last_name;

			}
		}else{							
			$row=$db->fetchByAssoc($result);
			$parent_id = $row['id']; 
			$parent_type = "Contacts";

			$query = "Select assigned_user_id,first_name, last_name from contacts c where c.id='$parent_id' AND c.deleted = 0 limit 1";         
			$result =$db->query($query);	
			$row=$db->fetchByAssoc($result);
			$userId = $row['assigned_user_id']; 
			$first_name = $row['first_name']; 
			$last_name = $row['last_name']; 
			$customer_name = $first_name.' '.$last_name;
		}

		if(!empty($languageOption)){
			$updatecontactlanguage = "Update contacts_cstm SET language_c = '$languageOption' WHERE id_c = '$parent_id'";
			//$GLOBALS['log']->fatal("Update Contact language Query disposition".$updatecontactlanguage);
			$resultupdatecontactlanguage = $db->query($updatecontactlanguage);
		}
		$callname = "Missed call in working hour by" . $phone;
		// $user_id=getcontactuserid($getContactid);

		//echo "-----------------Parent ID $parent_id     Parent Type $parent_type-------------";
              $GLOBALS['log']->fatal("-----------------Parent ID ".$parent_id."Parent Type".$parent_type."-------------");
		// $customer_name=getcontactname($getContactid);
		if(!empty($customerCRTId))
		{			echo "customerCRTId is present ";		

		$callRecordId = getcallid($customerCRTId);
		}elseif(!empty($crtObjectId))
		{	
		$customerCRTId=$crtObjectId;      //To save and update the ameyo call id in CRM 
		echo "crtObjectId is present $crtObjectId";		
		$callRecordId = getcallid($crtObjectId);
		}else{
		echo "create new call ";	
		}					//$GLOBALS['log']->fatal(" call record id ".$callRecordId);

		if(!empty($callRecordId))
		{	
		echo"--------Existing Cal Record "; 
			$updatequery = "UPDATE calls join calls_cstm ON calls.id = calls_cstm.id_c SET calls_cstm.phone_c ='$phone', calls.name = '$callname', calls.parent_type = $parent_type, calls.parent_id = '$parent_id', calls_cstm.dispositioncode_c ='$dispositionCode', calls_cstm.campaignid_c ='$campaignId', calls_cstm.dstphone_c ='$dstPhone', calls_cstm.calltype_c ='$callType', calls_cstm.recordingfileurl_c ='$recordingFileUrl', status ='Missed', calls_cstm.ringingtime_c ='$ringingTime', calls_cstm.srcphone_c ='$s_rcPhone', calls_cstm.ivrtime_c ='$ivrTime', calls_cstm.customerid_c ='$customerId',  calls_cstm.callid_c ='$callID', calls_cstm.setuptime_c ='$setupTime',  calls_cstm.systemdisposition_c ='$systemDisposition',calls_cstm.talktime_c ='$talkTime', calls.date_start ='$date_start', calls_cstm.non_office_menu_c ='$menuOption', calls_cstm.language_c ='$languageOption' WHERE calls_cstm.crtobjectid_c = '$customerCRTId' AND calls_cstm.asterisk_caller_id_c = '$phone'";
			$GLOBALS['log']->fatal("Update Missed called in working hour Query".$updatequery);
			$result = $db->query($updatequery);  
			
		}else{
					$GLOBALS['log']->fatal("create call record");
                                        $callname = "Missed call in working hour by" . $phone."To Corporate DID";
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
				  array("name" => "parent_type", "value" => $parent_type),
				  array("name" => "status", "value" => 'Missed'),
				  array("name" => "asterisk_caller_id_c", "value" => $phone),
				  array("name" => "phone_c", "value" => $phone),
				  array("name" => "parent_id", "value" => $parent_id),
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
		
		echo"New Cal Record $callRecordId "; 
			}
			
	//echo " callRecordId : $callRecordId";		
		update_securitygroup($user_id,$callRecordId);
			 $set_relationship_parameters = array(
			//session id
			'session' => $session_id,
			//The name of the module.
			'module_name' => $parent_type,
			//The ID of the specified module bean.
			'module_id' => $parent_id,
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

		sendMail($phone,$date_start,$CS_EMail,$customer_name);
		//Start Send SMS code   for missed call if DID is 6723
                
                $GLOBALS['log']->fatal("Update Missed called in working hour Query dstPhone".$dstPhone);
                    if($dstPhone=='6723'){
                        $callType =$callType.'.corporate';

                        /* =======Sorting the sms link url=====*/
                        //$smsMessage="Thanks for the missed call. E-file your ITR in 10 mins. Get a free meal & movie voucher for 1 couple worth Rs 800*limited period offer. Complete your journey on ";
                        $Url="http://www.5nance.com/routecampaign?UTMSource=taxcup&mob=$phone&call_id=$callRecordId";
                        //$Url='www.5nance.com/routecampaign?UTMSource=taxcup&mob={'.$phone.'}&call_id={'.$callRecordId.'}';
                        //$Url='https://www.5nance.com/home/loginregister?returnUrl=https%3A%2F%2Fwww.5nance.com%2Fproducts%2Fsystematic-investment-planning&refby=true&mob={'.$phone.'}&call_id={'.$callRecordId.'}';
                        $longUrl=urlencode($Url);
                        $bitly_access_token = $sugar_config['bitly_access_token'];
                        $bitly_access_token='69afcab7278e075622aec858780880e913ba8d07';
                        $bitlyurl = "https://api-ssl.bitly.com/v3/shorten?access_token=$bitly_access_token&longUrl=$longUrl";
                        $output = file_get_contents($bitlyurl);
                        $data=json_decode($output);  
                        $link=$data->data->url;

                        /* =======Send SMS to customer=====*/
                        //~ $smsMessage="Thanks for the missed call. E-file your ITR in 10 mins. Get a free meal & movie voucher for 1 couple worth Rs 800*limited period offer. Complete your journey on". {shorturl} 

                        //$smsMessage="Thanks for the missed call. E-file your ITR in 10 mins. Get a free meal & movie voucher for 1 couple worth Rs 800*limited period offer. Complete your journey on asap ".
                           $smsMessage="Get free advice to manage your financial goals. Our expert will help you decide the right SIP amt. you should be investing to achieve your no.".$link." Regards, Team 5nance";
  //$smsMessage="";

                        require_once('SendSMS.php');  
                        $smsObj = new SendSMS();  
                        $smsObj->send_sms_to_user($phone, $smsMessage);
                    }
		}else{
			echo"Not ok";
                        
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

	if(($dstPhone=='6733')||($dstPhone=='6713')){
		$callType =$callType.'.corporate';
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
    	$getparents_detail = checkpickedNumber($phone,$date_start,$user_id,$dispositionCode); // checking number is exist or not. If not creating contact	
    	//$getContactid = checkpickedNumber($phone,$date_start,$user_id,$dispositionCode); // checking number is exist or not. If not creating contact	
	
        $getParentid=$getparents_detail['parent_id'];
        $getParent_type=$getparents_detail['parent_type'];

        if(!empty($languageOption)){
		
            if($getParent_type=='Leads'){
               //Do nothing  
            }elseif($getParent_type=='Contacts'){
                $updatecontactlanguage = "Update contacts_cstm SET language_c = '$languageOption' WHERE id_c = '$getContactid'";
		//$GLOBALS['log']->fatal("Update Contact language Query disposition".$updatecontactlanguage);
		$resultupdatecontactlanguage = $db->query($updatecontactlanguage);
            }
             
	}
    
	$call_id = getcallid($customerCRTId);
	update_securitygroup($user_id,$call_id);
	$set_relationship_parameters = array(
        //session id
        'session' => $session_id,
        //The name of the module.
        'module_name' => $getParent_type,
        //The ID of the specified module bean.
        'module_id' => $getParentid,
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
   
    $updatequery = "update calls join calls_cstm on calls.id = calls_cstm.id_c set calls_cstm.phone_c ='$phone', calls.name = '$dispositionCode', calls.assigned_user_id = '$user_id', calls.parent_type = '$getParent_type', calls.parent_id = '$getParentid', calls_cstm.dispositioncode_c ='$dispositionCode', calls_cstm.campaignid_c ='$campaignId', calls_cstm.dstphone_c ='$dstPhone', calls_cstm.calltype_c ='$callType', calls_cstm.recordingfileurl_c ='$recordingFileUrl', status ='$Status', calls_cstm.ringingtime_c ='$ringingTime', calls_cstm.srcphone_c ='$s_rcPhone', calls_cstm.ivrtime_c ='$ivrTime', calls_cstm.customerid_c ='$customerId',  calls_cstm.callid_c ='$callID', calls_cstm.setuptime_c ='$setupTime',  calls_cstm.systemdisposition_c ='$systemDisposition',calls_cstm.talktime_c ='$talkTime', calls.date_start ='$date_start', calls_cstm.non_office_menu_c ='$menuOption', calls_cstm.language_c ='$languageOption' where calls_cstm.crtobjectid_c = '$customerCRTId' and calls_cstm.asterisk_caller_id_c = '$phone'";
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
    $lead_id = ''; 
    $contact_id = ''; 
	$query = "select id from contacts c where (c.phone_home = '$number' or c.phone_mobile = '$number' or "
			 . "c.phone_work = '$number' or c.phone_other = '$number') and c.deleted = 0 limit 1";         
	$result =$db->query($query);

	if($result->num_rows == 0) 
	{

	$query = "select id from leads l where (l.phone_mobile = '$number' or l.phone_home = '$number') and l.deleted = 0 limit 1";             
    $leadResult =$db->query($query);
	    
		if($leadResult->num_rows == 0) 
		{
				$title = "Called after working hour " . $number;			
				$lead_id = create_guid();
				$leadname = "New contact missed call from " . $number;
					
				$createLeadQuery = "INSERT INTO leads(id,date_entered,date_modified,modified_user_id,created_by,description,deleted,assigned_user_id,last_name,title,phone_mobile) VALUES 
				('$lead_id','$date','$date','$user_id','$user_id','$title','0','$user_id','$leadname','$title','$number')"; 				
				$db->query($createLeadQuery);

				$createLeadQuery1 = "INSERT INTO leads_cstm(id_c,disposition_c)VALUES ('$lead_id','$dispositionCode')";  
				$db->query($createLeadQuery1);
				$parent_id = $lead_id;
		}else{
			$row=$db->fetchByAssoc($leadResult);
			$parent_id = $row['id']; 
		}
	}else{							
		$row=$db->fetchByAssoc($result);
		$parent_id = $row['id']; 
	}
		
	return $parent_id; 			
}	
	
	//Call picked up by agent
function checkpickedNumber($number,$date,$user_id,$dispositionCode)
	{
	 
      global $db;
     $lead_id = ''; 
    $contact_id = ''; 
   $parents_detail=array();
			$query = "select id from contacts c where (c.phone_home = '$number' or c.phone_mobile = '$number' or "
					 . "c.phone_work = '$number' or c.phone_other = '$number') and c.deleted = 0 limit 1";         
			$result =$db->query($query);

			if($result->num_rows == 0) 
				{

                                    $query = "select id from leads l where (l.phone_mobile = '$number' or l.phone_home = '$number') and l.deleted = 0 limit 1";             
                                     $leadResult =$db->query($query);

                                    if($leadResult->num_rows == 0) 
                                        {
                                            $title = "Called picked up by agentfrom corporate DID in working hour " . $number;			
                                                        $lead_id = create_guid();
                                                        $leadname = "New lead of picking call from corporate DID " .$number;


                                                $createLeadQuery = "INSERT INTO leads(id,date_entered,date_modified,modified_user_id,created_by,description,deleted,assigned_user_id,last_name,title,phone_mobile) VALUES 
                                                ('$lead_id','$date','$date','$user_id','$user_id','$title','0','$user_id','$leadname','$title','$number')"; 				
                                                $db->query($createLeadQuery);

                                                $createLeadQuery1 = "INSERT INTO leads_cstm(id_c,disposition_c)VALUES ('$lead_id','$dispositionCode')";  
                                                $db->query($createLeadQuery1);
                                                $parent_id = $lead_id;
                                                $parent_type='Leads';
                                            }else{
                                            $row=$db->fetchByAssoc($leadResult);
                                            $parent_id = $row['id']; 
                                            $parent_type='Leads';
                                           }

                                }else{							
					$row=$db->fetchByAssoc($result);
					$contact_id = $row['id']; 
                                        $parent_id=$contact_id;
                                        $parent_type='Contacts';
                                        
				}
                                $parents_detail['parent_id']=$parent_id;
                                $parents_detail['parent_type']=$parent_type;
			return $parents_detail; 	
					
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

function sendMail($number,$date, $CS_EMail, $customer_name)
	{
	  $date = date('Y-m-d H:i:s', strtotime('5 hours', strtotime($date)));
	  $date = date('Y-m-d H:i:s a', strtotime('30 minutes', strtotime($date)));
      $sub = "Notification for Corporate Missed calls from ".$number;
      $body = "Contact Name : ".$customer_name." was calling at " . $date." from ".$number; 
//echo $CS_EMail;
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
      $mail->AddAddress($CS_EMail);  
      @$mail->Send(); 

	}	

?>
