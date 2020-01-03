<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
//ini_set("display_errors","On");

class UpdateCallAssignment{
  function UpdateCallAssignment($bean,$event,$arguments){
    
    global $current_user;
    global $db,$sugar_config;
    $bean_fetched = $bean->fetched_row;
    $assigned_user_new = $bean->assigned_user_id;
    $assigned_user_old = $bean->fetched_row['assigned_user_id'];
    $new_assigned_user_name = $bean->assigned_user_name;
    $old_assigned_user_name = $bean->fetched_row['assigned_user_name'];
    $UniqueCustomerCode = $bean->unique_customer_code_c;
    $contact_id = $bean->id;
  
 //if(empty($new_assigned_user_name)){
    $fetch_name = $db->query("select CONCAT(IFNULL(first_name,''),' ',IFNULL(last_name,'')) as user_name from users where id='$assigned_user_new' and deleted=0");
    $fetch_row = $db->fetchByAssoc($fetch_name);
    $new_assigned_user_name = $fetch_row['user_name'];
// }

 
  if($assigned_user_new!=$assigned_user_old)
  {
	  /***************log file***************************/
      $schedulerLogFile = '/var/www/html/crm/updateadvisorname_new.txt';  
      $schedulerHandle = fopen($schedulerLogFile, 'a');
      $timestamp = date('Y-M-d H:m:s', strtotime('now'));
     /***********post data*****************/
     $data = array(
        'UniqueCustomerCode' => $UniqueCustomerCode,
        'AdvisorName' => $new_assigned_user_name,
      );
     $postdata_parameters = json_encode($data);
    $curl = curl_init();
    $url = $sugar_config['updateadvisorname'].'?UniqueCustomerCode='.urlencode($UniqueCustomerCode).'&AdvisorName='.urlencode($new_assigned_user_name);
		//echo $url=urlencode($url);
	curl_setopt_array($curl, array(
	  CURLOPT_URL => $url,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "Content-Disposition: form-data; name=\"UniqueCustomerCode \"\r\n\r\n".urlencode($UniqueCustomerCode)."\r\n\r\nContent-Disposition: form-data; name=\"AdvisorName \"\r\n\r\n".urlencode($new_assigned_user_name)."\r\n",
	  CURLOPT_HTTPHEADER => array(
		 "authorization: Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI",
		"cache-control: no-cache",
		"content-type: multipart/form-data;",
		),
	));

	$response = curl_exec($curl);
	curl_close($curl);
	$updateadvisorname = json_decode($response, true);
      $logArray = print_r($postdata_parameters, true);
      $logMessage = "\n\nUpdateParameters at $timestamp :-\n$logArray";
      fwrite($schedulerHandle, $logMessage);
      $logArray = print_r($response, true);
      $logMessage = "\n\nUpdateAdvisorName at $timestamp :-\n$logArray";
      fwrite($schedulerHandle, $logMessage);
    /********************planned activities for old assigned user***************************/
    $fetch_followup_call = "select id, status from calls where status='Planned' and parent_id='$contact_id' and deleted=0 and assigned_user_id='$assigned_user_old'";
    $result_followup_call = $db->query($fetch_followup_call);
    if($result_followup_call->num_rows > 0){
        while($row_followup_call = $db->fetchByAssoc($result_followup_call)){
        $call_id = $row_followup_call['id'];
        $db->query("update calls set assigned_user_id='$assigned_user_new' where status='Planned' and parent_id='$contact_id' and deleted=0 and assigned_user_id='$assigned_user_old'");
        /***************update call users relationship with new user********************/
        $db->query("update calls_users set user_id='$assigned_user_new' where call_id='$call_id' and user_id='$assigned_user_old' and deleted=0");

      }
    }
    
  
  }
//exit;
  }
}
