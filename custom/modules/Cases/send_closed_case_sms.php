<?php

if (!define('sugarEntry'))define('sugarEntry', true);
require_once('SendSMS.php');
//
class SendSMS_customer{

function sendSMSFunction($bean, $event, $arguments){

global $db;
global $sugar_config;
global $current_user;
/*********update departments***************/
$record_id = $bean->id;
$db->query("update cases join cases_cstm on cases.id=cases_cstm.id_c join securitygroups_records on securitygroups_records.record_id=cases.id and securitygroups_records.module='Cases' join securitygroups on securitygroups.id=securitygroups_records.securitygroup_id set cases_cstm.departments_c=securitygroups.name where cases.deleted=0 and securitygroups_records.deleted=0 and securitygroups.deleted=0 and securitygroups_records.record_id='$record_id'");
$site_url =  $sugar_config['site_url'];
$site_url =  trim($site_url,"/");

$id                = $bean->id;
$status            = $bean->status;
$customer_sms_sent = $bean->customer_sms_sent;
$customer_sms_open = $bean->customer_sms_open_case_c;
$case_number       = $bean->case_number;
$customerName	= $bean->contacts_cases_1_name;
$mobile_number       = $bean->mobile_number_c;
$subject       = $bean->subject;
$mobile_no = "91" . substr($mobile_number, -10);
if(!empty($mobile_number)){
if($status == 'Open_New' && $customer_sms_open == 0){
	$result_cases_number = $db->query("select case_number from cases where id='".$bean->id."' and deleted=0");
	$case_number_row = $db->fetchByAssoc($result_cases_number);
	$case_number = $case_number_row['case_number'];
$message = "Dear User, Please note the ticket no. $case_number against your query registered with us. Kindly quote the same for future interactions. 5nance.com";
$sms = new SendSMS();
$result = $sms->send_sms_to_user($mobile_no, $message);
// Create SMS history record.
$current_user_id        = $current_user->id;
$current_user_full_name = $current_user->full_name;
date_default_timezone_set('Asia/Kolkata');
$time                   = date('d/m/Y @ H:i', time());
if($result){
$objsms = BeanFactory::getBean('scrm_SMS');
$objsms->name                                                    = "SMS - ".$customerName." on ".$time;
$objsms->description                                             = $message;
$objsms->assigned_user_name                                      = $current_user_full_name;
$objsms->assigned_user_id                                        = $current_user_id;
$objsms->receipient_no_c                                         = $mobile_no; 
$objsms->cases_scrm_sms_1cases_ida								 = $id;
$objsms->save();	
}

// Update SMS flag
$query2 = "UPDATE cases_cstm SET customer_sms_open_case_c = 1  WHERE id_c = '".$id."'"; 
$result2 = $db->query($query2);
}
}
if(!empty($mobile_number)){
if ($status == 'Closed_Closed' && $customer_sms_sent == 0){

$message = "Dear User, Kindly note, the service ticket no. $case_number  of your query stands resolved. 5nance.com";
$sms = new SendSMS();
$result = $sms->send_sms_to_user($mobile_no, $message);

// Update SMS flag
$query2 = "UPDATE cases_cstm SET customer_sms_sent_c = 1  WHERE id_c = '".$id."'"; 
$result2 = $db->query($query2);

// Create SMS history record.
$current_user_id        = $current_user->id;
$current_user_full_name = $current_user->full_name;
date_default_timezone_set('Asia/Kolkata');
$time                   = date('d/m/Y @ H:i', time());

if($result){
$objsms = BeanFactory::getBean('scrm_SMS');

$objsms->name                                                    = "SMS - ".$customerName." on ".$time;
$objsms->description                                             = $message;
$objsms->assigned_user_name                                      = $current_user_full_name;
$objsms->assigned_user_id                                        = $current_user_id;
$objsms->receipient_no_c                                         = $mobile_no; 
$objsms->cases_scrm_sms_1cases_ida								 = $id;
$objsms->save();	
}
}

}

}

}

//}

?>
