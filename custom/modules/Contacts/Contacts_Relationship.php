<?php
	if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
	require_once('SendSMS.php');
	class contactrelationship{
		function contactrelationship($bean,$event,$arguments){
			global $db;
				/************contact email address******************/
				$contact_email_address = $bean->email1;
				/*************check this email address in the cases module*****************/
				$fetch_case_email_address = "select c.id as case_id from email_addresses as ea,email_addr_bean_rel as eb,cases as c where ea.email_address='$contact_email_address' and ea.id=eb.email_address_id and eb.bean_module='Cases' and eb.deleted=0 and c.id=eb.bean_id and c.deleted=0";
				$result_case_email_address = $db->query($fetch_case_email_address);
				if($result_case_email_address->num_rows > 0){
					while($row_case_email_address = $db->fetchByAssoc($result_case_email_address)){
						$case_id = $row_case_email_address['case_id'];
						$casebean = new aCase();
						$casebean->retrieve($case_id);
						$contact_id = $casebean->contacts_cases_1contacts_ida;
						if(empty($contact_id)){
							$db->query("INSERT into contacts_cases_1_c (id,contacts_cases_1contacts_ida,contacts_cases_1cases_idb,date_modified,deleted) VALUES (UUID(),'".$bean->id."','$case_id',NOW(),0)");
							$db->query("update cases_cstm set mobile_number_c='".$bean->phone_mobile."' where id_c='$case_id'");
							$mobile_no = $bean->phone_mobile;
							$mobile_no = "91" . substr($mobile_no, -10);
							if($casebean->status == 'Open_New' && $bean->customer_sms_open_case_c == 0){
								$result_cases_number = $db->query("select case_number from cases where id='$case_id' and deleted=0");
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
								$objsms->cases_scrm_sms_1cases_ida								 = $case_id;
								$objsms->save();	
								}

								// Update SMS flag
								$query2 = "UPDATE cases_cstm SET customer_sms_open_case_c = 1  WHERE id_c = '".$case_id."'"; 
								$result2 = $db->query($query2);

						}
					}
					
				}
		}
	}
}
?>
