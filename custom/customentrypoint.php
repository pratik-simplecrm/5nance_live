<?php

  session_start();
  if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
	
	global $db,$sugar_config,$current_user;

       
	$GLOBALS['log']->fatal("The Customentry point parameter from Ameyo old: " . print_r($_REQUEST, true));
    $phone = $_REQUEST['phone'];
    $crtObjectId = $_REQUEST['crtObjectId'];
    $userId = $_REQUEST['userId'];
    $ameyosessionId = $_REQUEST['sessionId'];
    $campaignId = $_REQUEST['campaignId'];
    $crmSessionId = $_REQUEST['crmSessionId'];
    $calltype = ($_REQUEST['callType'] == 'outbound.manual.dial')?'Outbound':'Inbound';
	$languageOption = $_REQUEST['languageOption']; 
    
    $query = "select id from contacts c where (c.phone_home = '$phone' or c.phone_mobile = '$phone' or "
             . "c.phone_work = '$phone' or c.phone_other = '$phone') and c.deleted = 0 limit 1";

             
    $result =$db->query($query);
    $row=$db->fetchByAssoc($result);
    $contact_id = $row['id'];         
	
	if(!empty($languageOption)){
			$updatecontactlanguage = "Update contacts_cstm SET language_c = '$languageOption' WHERE id_c = '$contact_id'";
			//$GLOBALS['log']->fatal("Update Contact language Query customentry point".$updatecontactlanguage);
			$resultupdatecontactlanguage = $db->query($updatecontactlanguage);
		}
   // Rest API to create the call record

    $getuserid = "select id from users where user_name = '$userId' AND deleted = '0'";
    $result =$db->query($getuserid);
    $row=$db->fetchByAssoc($result);
	  $user_id = $row['id'];   

    
    $url = $sugar_config['webservice_url'];
    $username = $sugar_config['asterisk_soapuser'];
    $password = $sugar_config['asterisk_soappass'];

    //login to generate session ID -------------   
    
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
    //get session id
    $session_id = $login_result->id;


    date_default_timezone_set("UTC");

    $set_entry_parameters = array(
         //session id
         "session" => $session_id,

         //The name of the module from which to retrieve records.
         "module_name" => "Calls",

         //Record attributes
         "name_value_list" => array(
              //to update a record, you will nee to pass in a record id as commented below
              array("name" => "name", "value" => "New call"),
              array("name" => "direction", "value" => $calltype),
              array("name" => "assigned_user_id", "value" => $user_id),
              array("name" => "date_start", "value" => date('Y-m-d H:i:s')),
              array("name" => "parent_type", "value" => 'Contacts' ),
              array("name" => "status", "value" => 'In Limbo'),
              array("name" => "asterisk_caller_id_c", "value" => $phone),
              array("name" => "phone_c", "value" => $phone),
              array("name" => "parent_id", "value" => $contact_id),
              array("name" => "crtobjectid_c", "value" => $crtObjectId),
         ),
    );

    
    $callRecordId = getcallid($crtObjectId, $set_entry_parameters, $url, $user_id);

    // API ends here

    
         $set_relationship_parameters = array(
        //session id
        'session' => $session_id,
        //The name of the module.
        'module_name' => 'Contacts',
        //The ID of the specified module bean.
        'module_id' => $contact_id,
        //The relationship name of the linked field from which to relate records.
        'link_field_name' => 'calls',
        //The list of record ids to relate
        'related_ids' => array(
         $callRecordId,
        ),
        //Sets the value for relationship based fields
        //Whether or not to delete the relationship. 0:create, 1:delete
        'delete'=> 0,
        );
        call("set_relationship", $set_relationship_parameters, $url);


	if(!empty($contact_id))
      {

		$queryParams = array(
			'module' => 'Contacts',
			'action' => 'DetailView',
			'record' => $contact_id,
		);
		

		SugarApplication::redirect('index.php?' . http_build_query($queryParams));
		
	  }else{
			$queryParams = array(
			'module' => 'Contacts',
			'action' => 'EditView',
			'return_module' => 'Contacts',
			'return_action' => 'index',
			'phone_mobile' => $phone,
			'language_c' => $languageOption,
		);
		SugarApplication::redirect('index.php?' . http_build_query($queryParams));  
		  
	  }	
    


      //function to make cURL request
    function call($method, $parameters, $url)
    {

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

function getcallid($crtObjectId, $set_entry_parameters, $url, $user_id){
	global $db;
	$Today = gmdate("Y-m-d H:i:s");
	$query = "SELECT id from calls, calls_cstm  WHERE calls.id = calls_cstm.id_c AND calls_cstm.crtobjectid_c = '$crtObjectId' AND calls.deleted = 0 limit 1";
    //$GLOBALS['log']->fatal("In custom entrypoint get the call ID ".$getcallid);
    $result =$db->query($query);

			if($result->num_rows == 0)
			{
				$callCreate = call("set_entry", $set_entry_parameters, $url);
				$callRecordId = $callCreate->id;	
				//$GLOBALS['log']->fatal("In custom entrypoint  call ID is not  present ".$callRecordId);

				}else{
					$row=$db->fetchByAssoc($result);
					$callRecordId = $row['id'];
					$updatequery = "Update calls join calls_cstm on calls.id = calls_cstm.id_c SET calls.assigned_user_id = '$user_id', calls.date_modified = '$Today' where calls_cstm.crtobjectid_c = '$crtObjectId' ";
					//$GLOBALS['log']->fatal("In custom entrypoint  call ID is present ".$callRecordId);

					}
			
			return $callRecordId; 
	}
  		
   

?>    
