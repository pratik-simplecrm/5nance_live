<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
//ini_set("display_errors","On");

class PartnerDataUpdateTo5nance{
  function PartnerDataUpdateTo5nance($bean,$event,$arguments){
    
    global $current_user;
    global $db,$sugar_config;
    //check partner details
    $bean_fetched = $bean->fetched_row;
    $assigned_user_new = $bean->assigned_user_id;
    $new_assigned_user_name = $bean->assigned_user_name;
    $UniqueCustomerCode = $bean->unique_customer_code_c;
    $partnerName = $bean->related_corporate_account_c;
    $partnerComments = $bean->partner_comments_c;
    $latest_disposition = $bean->disposition_c;
    $sales_stage = $bean->sales_stage_c;
    $latest_comments = $bean->next_call_planning_comments_c;
    $customer_comment_c = $bean->comment_c;
    $assistant_id = $bean->assistant_id_c;
    $contact_id = $bean->id;
  
  if(!empty($partnerName) && !empty($partnerComments))
  {
    /***************log file***************************/
      $schedulerLogFile = '/var/www/html/crm/partnernameupdate.txt';  
      $schedulerHandle = fopen($schedulerLogFile, 'a');
      $timestamp = date('Y-M-d H:m:s', strtotime('now'));
     /***********post data*****************/
     $data = array(
        'UniqueCustomerCode' => $UniqueCustomerCode,
        'AdvisorName' => $new_assigned_user_name,
        'AssistanceID' => $assistant_id,
        'FinanceRemarks' => $latest_comments,
        'Status' => $latest_disposition,
      );
     $postdata_parameters = json_encode($data);
     $length = strlen($postdata_parameters);
    $curl = curl_init();
    $url = $sugar_config['updatepartnerdetails'].'?UniqueCustomerCode='.urlencode($UniqueCustomerCode).'&AdvisorName='.urlencode($new_assigned_user_name).'&AssistanceID='.urlencode($assistant_id).'&FinanceRemarks='.urlencode($latest_comments).'&Status='.urlencode($latest_disposition);
    
curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "Content-Disposition: form-data; name=\"UniqueCustomerCode \"\r\n\r\n".urlencode($UniqueCustomerCode)."\r\n\r\nContent-Disposition: form-data; name=\"AdvisorName \"\r\n\r\n".urlencode($new_assigned_user_name)."\r\n\r\nContent-Disposition: form-data; name=\"AssistanceID \"\r\n\r\n".urlencode($assistant_id)."\r\n\r\nContent-Disposition: form-data; name=\"FinanceRemarks \"\r\n\r\n".urlencode($latest_comments)."\r\n\r\nContent-Disposition: form-data; name=\"Status \"\r\n\r\n".urlencode($latest_disposition)."\r\n",
    CURLOPT_HTTPHEADER => array(
     "authorization: Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI",
    "cache-control: no-cache",
    "content-type: multipart/form-data;",
    ),
  ));
  $response = curl_exec($curl);
  $err = curl_error($curl);

curl_close($curl);

// if ($err) {
//   echo "cURL Error #:" . $err;
// } else {
//   echo $response;
// }
//   $GLOBALS['log']->fatal($url."URL");
//   $GLOBALS['log']->fatal(print_r($response,true)."Response");
//   $GLOBALS['log']->fatal($err."ERR Response");
//   curl_close($curl);
  $updatepartnerdetails = json_decode($response, true);
    $GLOBALS['log']->fatal($url."API POST URL");
   $GLOBALS['log']->fatal($UniqueCustomerCode."Customer Code");
  $GLOBALS['log']->fatal(print_r($updatepartnerdetails, true)."Contact Partner Update");
 
  $logArray = print_r($updatepartnerdetails, true);
  $logMessage = "\n\nUpdatePartnerDetails at $timestamp :-\n$logArray";
  fwrite($schedulerHandle, $logMessage);
  $logArray = print_r($response, true);
  $logMessage = "\n\nUpdatePartnerDetails at $timestamp :-\n$logArray";
   fwrite($schedulerHandle, $logMessage);
  $logMessage = "\n\nUpdatePartnerDetails at $timestamp :-\n$url";
   fwrite($schedulerHandle, $logMessage);
    
    }
    
  
  }
//exit;
  }

