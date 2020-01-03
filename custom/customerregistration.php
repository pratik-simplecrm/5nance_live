<?php
  session_start();
  if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
	 
	global $db,$sugar_config,$current_user;
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
 
 
	//~ $GLOBALS['log']->fatal("The customer registration parameter from 5nance: " . print_r($_REQUEST, true));
    //~ $phone = $_REQUEST['phone'];
    //~ $call_id = $_REQUEST['call_id'];
    //~ $linkclicked_date = $_REQUEST['linkclicked_date'];
    //~ $registration_date = $_REQUEST['registration_date'];
    //~ $secreate_key = $_REQUEST['secreate_key'];
       
    $fp      = fopen('php://input', 'r');
    $rawData = json_decode(stream_get_contents($fp));
    $GLOBALS['log']->fatal("The customer registration parameter from 5nance : " . print_r($rawData, true));
     
        $phone       			= $rawData->phone;
        $call_id     			= $rawData->call_id;
        $linkclicked_date       = $rawData->linkclicked_date;
        $registration_date      = $rawData->registration_date;
        $secreate_key           = $rawData->secreate_key;
    
    
    
  //http://161.202.21.7/5nance_prod/index.php?entryPoint=CustomerRegistration&phone=7709982939&call_id=a0664673-d576-7326-2b35-5b2cc2e20652&linkclicked_date=25072018&registration_date=25072018&secreate_key=5nancevishal
   echo $query = "SELECT id from calls c , calls_cstm cc WHERE c.id = '$call_id' AND cc.phone_c = '$phone' AND c.deleted = 0 limit 1";       
    $result =$db->query($query);
    $row=$db->fetchByAssoc($result);
     $callID = $row['id'];         

	// Rest API to update the call record
	


	$registration_date=gmdate("Y-m-d H:i:s",strtotime($registration_date));
	$linkclicked_date=gmdate("Y-m-d H:i:s",strtotime($linkclicked_date));
    $set_entry_parameters = array(
         //session id
         "session" => $session_id,

         //The name of the module from which to retrieve records.
         "module_name" => "Calls",

         //Record attributes
         "name_value_list" => array(
              //to update a record, you will nee to pass in a record id as commented below
              array("name" => "linkclicked_date_c", "value" => $linkclicked_date),
              array("name" => "registration_date_c", "value" => $registration_date),
              array("name" => "name", "value" => "is"),
              array("name" => "id", "value" => $callID),
         ),
    );

    $callupdate = call("set_entry", $set_entry_parameters, $url);
	echo $callRecordId = $callupdate->id;
  
    // API ends here

	if(empty($callID))
      {
		  
		$msg = array(
        'Success' => false,
        'Message' => 'Oops! Call ID is not present in the system'
		); 
	  }elseif(!empty($callRecordId)){
		  
		$msg = array(
        'Success' => true,
        'Message' => 'Details updated Successfully'
		);

		
	  }else{
		  
		$msg = array(
        'Success' => false,
        'Message' => 'Oops! Something went wrong'
		);  
	}
    print_r($msg);
    return json_encode($msg); 




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

   ?>
