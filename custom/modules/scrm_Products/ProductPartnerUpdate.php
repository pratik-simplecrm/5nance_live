<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
//ini_set("display_errors","On");

class ProductPartnerUpdate{
  function ProductPartnerUpdate($bean,$event,$arguments){
    
    global $current_user;
    global $db,$sugar_config;
    //check partner details
    $bean_fetched = $bean->fetched_row;
    $assigned_user_new = $bean->assigned_user_id;
    $new_assigned_user_name = $bean->assigned_user_name;
    
    $partnerName = $bean->partner_name_c;
    $latest_disposition = $bean->disposition_c;
    $sales_stage = $bean->sales_stage_c;
    $latest_comments = $bean->next_call_planning_comments_c;
    $customer_comment_c = $bean->comment_c;
    $assistant_id = $bean->assistant_id_c;
    $contact_id = $bean->rel_fields_before_value['contacts_scrm_products_1contacts_ida'];
    $contact_bean = BeanFactory::getBean('Contacts',$contact_id);
    $UniqueCustomerCode = $contact_bean->unique_customer_code_c;
  
  if(!empty($partnerName))
  {
    /***************log file***************************/
      $schedulerLogFile = '/var/www/html/crm/productpartnernameupdate.txt';  
      $schedulerHandle = fopen($schedulerLogFile, 'a');
      $timestamp = date('Y-M-d H:m:s', strtotime('now'));
     /***********post data*****************/
     $data = array(
        'UniqueCustomerCode' => $UniqueCustomerCode,
        'AdvisorName' => $new_assigned_user_name,
        'AssistanceID' => $assistant_id,
      );
     $postdata_parameters = json_encode($data);
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
   $updatepartnerdetails = json_decode($response, true);
 // $GLOBALS['log']->fatal(print_r($updatepartnerdetails, true)."Details response");
  $logArray = print_r($updatepartnerdetails, true);
  $logMessage = "\n\nUpdatePartnerDetails at $timestamp :-\n$logArray";
    $GLOBALS['log']->fatal($UniqueCustomerCode."Customer Code");
    $GLOBALS['log']->fatal($url."API POST URL");
//  $GLOBALS['log']->fatal(print_r($updatepartnerdetails, true)."Product Partner Update");
   $GLOBALS['log']->fatal($logMessage."Product Partner Update");
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

