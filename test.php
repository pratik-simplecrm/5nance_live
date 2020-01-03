<?php

if(!defined('sugarEntry')) define('sugarEntry',true);
require_once('include/utils.php');
require_once('include/entryPoint.php');
global $db;

	$rows_list = getContactsData();
	
	
	 $timestamp = date('Y_m_d_His');
	ob_end_clean();
	ob_start();
	// output headers so that the file is downloaded rather than displayed
	//header('Content-Type: text/csv; charset=utf-8');
	//header("Content-Disposition: attachment; filename=Multidispositionreport{$timestamp}.csv");

	// create a file pointer connected to the output stream
	$path = "/var/www/html/crm/upload_reports/Multidispositionreport{$timestamp}.csv";
	$output = fopen($path, 'w') or die("can't open file");

	fputcsv($output, array('Lead ID', 'First Name', 'Last Name', 'Email Address', 'Mobile Number', 'Gateway (Source)', 'Campaign Type', 'Sales Advisor', 'Product Interest', 'Product Sub Interest', 'Referral Type','Age','Income','Occupation','Bank Account','Pan Card','First Time Investor','Internet Banking','UTM Content', 'Source Campaign', 'Source', 'Publisher Sub ID', 'User Creation Date', 'Advisor Assignment Date/Time', 'Assignment TAT', 'Sales Stage', 'Comments', 'Latest Disposition', 'First Call TAT','Last Modified','Disposition 1', 'Date & Time', 'Disposition 2', 'Date & Time', 'Disposition 3', 'Date & Time', 'Disposition 4', 'Date & Time', 'Disposition 5', 'Date & Time', 'Disposition 6', 'Date & Time', 'Disposition 7', 'Date & Time', 'Disposition 8', 'Date & Time', 'Disposition 9', 'Date & Time', 'Disposition 10', 'Date & Time', 'End to End TAT'));
	foreach ($rows_list as $v) {
		unset($v['from_date']);
		unset($v['to_date']);

		fputcsv($output, $v);
	}
	
	
	//send email
	require_once('include/SugarPHPMailer.php'); 
	
	$emailObj = new Email();
	$defaults = $emailObj->getSystemDefaultEmail();
	$mail = new SugarPHPMailer();
	$mail->setMailerForSystem();
	$mail->From = $defaults['email'];
	$mail->FromName = $defaults['name'];
	
	$mail->Subject = " Multi Disposition report";
	
	$body_html = '<b> MultiDisposition report</b>';
	$mail->Body_html = from_html($body_html);
	$mail->Body = from_html($body_html);
	$mail->isHTML(true);
	$mail->AddAttachment($path);
	
	$mail->prepForOutbound();
	$mail->AddAddress('shakeer@simplecrm.com.sg');
	$mail->addCC('smshakir85@gmail.com');
	$mail->addBCC('');
	$mail->Send();
	if(is_file($path))
	{
		unlink($path);
		//return true;
	}
	
	
            


    function getContactsData() {

        global $db, $current_user, $app_list_strings;

        
        
        
        $gateway = '';
        $from_date = date("Y-m-01");
		$from_date = date("Y-m-d", strtotime("-3 months", strtotime($from_date)));
		$from_date = date("Y-m-d H:i:s", strtotime("-5 hours, -30 minutes", strtotime($from_date)));
		
		$to_date = date("Y-m-d");
		$to_date = date("Y-m-d H:i:s", strtotime("-5 hours, -30 minutes", strtotime($to_date)));
        

     $date_filter = " c.date_entered between '" . $from_date . "' AND '" . $to_date . "' $gateway AND";


        //fetch user role
//        $select_role_query = "select id from contacts where deleted=0";
//        $select_role = $db->query($select_role_query);
//        $select_role_row = $db->fetchByAssoc($select_role);
//        $contact_id = $select_role_row['id'];

        $data = get_users_data($date_filter);

        return $data;
    }
    
    
    
    
        function get_users_data($date_filter) {
        global $db, $app_list_strings;
        $data = array();
        $r = 0;

       $contacts_query = "SELECT c.id as id, c.first_name as first_name, c.last_name as last_name, cc.leadid_c as unique_customer_code_c, ea.email_address as email_address, c.phone_mobile as phone_mobile, cc.gateway_c as gateway_c, cc.campaign_type_c as campaign_type_c, u.user_name as user_name, cc.product_interest_c as product_interest_c, cc.product_sub_type_interest_c as product_sub_type_interest_c, c.date_entered as date_entered, cc.sales_stage_c as sales_stage_c, cc.next_call_planning_comments_c as next_call_planning_comments_c, cc.user_allocation_date_c as user_allocation_date_c, cc.disposition_c as latest_disposition,cc.qparam_c as publisher_subid,cc.custom_date_modified_c as date_modified, cc.utm_content_c as utm_content_c,cc.referral_type_c as referral_type_c,cc.interactions_age_c as interactions_age_c, cc.interactions_income_c as interactions_income_c, cc.investor_occupation_c as investor_occupation_c, cc.bank_account_c as bank_account_c, cc.pan_card_c as pan_card_c, cc.first_time_investor_c as first_time_investor_c, cc.internet_banking_c as internet_banking_c,cc.campaign_c as campaign_c, cc.source_c as source_c FROM contacts c LEFT JOIN contacts_cstm cc ON c.id = cc.id_c join users u on u.id = c.assigned_user_id LEFT JOIN email_addr_bean_rel eabl  ON eabl.bean_id = c.id AND eabl.bean_module = 'Contacts' and eabl.primary_address = 1 and eabl.deleted=0 LEFT JOIN email_addresses ea ON (ea.id = eabl.email_address_id) where $date_filter c.deleted=0 AND u.user_name !='poorti' AND cc.gateway_c!='' ORDER BY c.date_entered DESC";
        $contact_result = $db->query($contacts_query);
        $disposition_list = $GLOBALS['app_list_strings']['disposition_list'];
        $old_disposition_list = $GLOBALS['app_list_strings']['old_disposition_list'];
        $disposition_list = array_merge($disposition_list, $old_disposition_list);

//        echo 'testing';
//        print_r($disposition_list);
       // print_r($contact_row);
        while ($contact_row = $db->fetchByAssoc($contact_result)) {
            $data[$r]['unique_customer_code_c'] = $contact_row['unique_customer_code_c'];
            $data[$r]['first_name'] = $contact_row['first_name'];
            $data[$r]['last_name'] = $contact_row['last_name'];
            $data[$r]['email_address'] = $contact_row['email_address'];
            $data[$r]['phone_mobile'] = $contact_row['phone_mobile'];
            $data[$r]['gateway_c'] = $contact_row['gateway_c'];
            $data[$r]['campaign_type_c'] = $contact_row['campaign_type_c'];
            $data[$r]['user_name'] = $contact_row['user_name'];
            $data[$r]['product_interest_c'] = $contact_row['product_interest_c'];
            $data[$r]['product_sub_type_interest_c'] = $contact_row['product_sub_type_interest_c'];
            $data[$r]['referral_type_c'] = $GLOBALS['app_list_strings']['referral_type_list'][$contact_row['referral_type_c']];
            $data[$r]['interactions_age_c'] = $contact_row['interactions_age_c'];
            $data[$r]['interactions_income_c'] = $contact_row['interactions_income_c'];
            $data[$r]['investor_occupation_c'] = $GLOBALS['app_list_strings']['investor_occupation_list'][$contact_row['investor_occupation_c']];
            $data[$r]['bank_account_c'] = $contact_row['bank_account_c'];
            $data[$r]['pan_card_c'] = $contact_row['pan_card_c'];
            $data[$r]['first_time_investor_c'] = $contact_row['first_time_investor_c'];
            $data[$r]['internet_banking_c'] = $contact_row['internet_banking_c'];

            $data[$r]['utm_content_c'] = $contact_row['utm_content_c'];
            $data[$r]['campaign_c'] = $contact_row['campaign_c'];
            $data[$r]['source_c'] = $contact_row['source_c'];

            
            $data[$r]['publisher_subid'] = $contact_row['publisher_subid'];
            $data[$r]['date_entered'] = date('d/m/Y h:i a ', strtotime('+5 hours  +30 minutes', strtotime($contact_row['date_entered'])));
            $data[$r]['user_allocation_date_c'] = (!empty($contact_row['user_allocation_date_c']) ? date('d/m/Y h:i a ', strtotime('+5 hours  +30 minutes', strtotime($contact_row['user_allocation_date_c']))) : '');

            if (!empty($contact_row['user_allocation_date_c'])) {
        $seconds = strtotime($contact_row['user_allocation_date_c']) - strtotime($contact_row['date_entered']);

        if (strtotime($contact_row['user_allocation_date_c']) > strtotime($contact_row['date_entered'])) {

            $hours = floor($seconds / 3600);
            $minutes = floor(($seconds / 60) % 60);
            $second = $seconds % 60;
        } else {
            $hours = "00";
            $minutes = "00";
            $second = "00";
        }
        $assignment_tat = $hours . ":" . $minutes . ":" . $second;
    }
            $data[$r]['assignment_tat'] = (!empty($contact_row['user_allocation_date_c'])) ? $assignment_tat : '';
            $data[$r]['sales_stage_c'] = $contact_row['sales_stage_c'];
            $data[$r]['next_call_planning_comments_c'] = utf8_encode($contact_row['next_call_planning_comments_c']);


            $bean = BeanFactory::getBean('Contacts', $contact_row['id']);

            //If relationship is loaded
            if ($bean->load_relationship('calls')) {
                $my_calls = $bean->get_linked_beans('calls', 'Calls');
            }

            $array_call = '';
            $get_first_call='';
            foreach ($my_calls as $calls) {

                  if ($calls->status == "Held" || $calls->status == "Missed" || $calls->status == "Not Held") {
   if($calls->direction == "Inbound")
                {
                $firstcall_date='date_modified';
                }else
                {
                 $firstcall_date='date_entered';
                }

            $get_first_call[] = array(
                "name" => $calls->name,
                "date_start" => date('Y-m-d H:i:s', strtotime('+5 hours +30 minutes', strtotime(($calls->fetched_row[$firstcall_date])))));
        }
        if (($calls->status == "Held" || $calls->status == "Missed" || $calls->status == "Not Held") && $calls->created_by!='1' && in_array(trim($calls->name), $disposition_list)) {

            $array_call[] = array(
                "name" => $calls->name,
                "date_start" => date('Y-m-d H:i:s', strtotime('+5 hours +30 minutes', strtotime(($calls->fetched_row['date_modified'])))),
                    // "date_start" => $calls->date_start,
            );
        }
            }
           
          if (!empty($array_call)) {
        $name = 'date_start';
        usort($array_call, function($a, $b) {
            $ad = new DateTime($a['date_start']);
            $bd = new DateTime($b['date_start']);

            if ($ad == $bd) {
                return 0;
            }

            return $ad < $bd ? -1 : 1;
        });
    }

            if (!empty($get_first_call)) {
        usort($get_first_call, function($a, $b) {
            $ad = new DateTime($a['date_start']);
            $bd = new DateTime($b['date_start']);

            if ($ad == $bd) {
                return 0;
            }

            return $ad < $bd ? -1 : 1;
        });
    }

          if (!empty($array_call)) {
        $array_call = array_reverse($array_call);
        $end_disposition_date = end($array_call);
     //    $array_call = array_pop($array_call);
    }
            // $first_disposition_date = end($array_call_next);
            //  $row[] = $array_call[0]['name'];
// print_r($end_disposition_date);
// print_r($first_disposition_date);


            $data[$r]['latestdisposition'] = $contact_row['latest_disposition'];


            if (!empty($get_first_call[0]['date_start']) && !empty($contact_row['user_allocation_date_c'])) {
                  $first_call_second = strtotime('-5 hours -30 minutes', strtotime($get_first_call[0]['date_start'])) - strtotime($contact_row['user_allocation_date_c']);


        if (strtotime('-5 hours -30 minutes', strtotime($get_first_call[0]['date_start'])) > strtotime($contact_row['user_allocation_date_c'])) {
            $first_call_hours = floor($first_call_second / 3600);
            $first_call_minutes = floor(($first_call_second / 60) % 60);
            $first_call_seconds = $first_call_second % 60;
        } else {
            $first_call_hours = "00";
            $first_call_minutes = "00";
            $first_call_seconds = "00";
        }
        $first_call_tat = $first_call_hours . ":" . $first_call_minutes . ":" . $first_call_seconds;
            }
            $data[$r]['first_call_tat'] = (!empty($get_first_call[0]['date_start'])) ? $first_call_tat : '';
            $data[$r]['date_modified'] = date('d/m/Y h:i a ', strtotime('+5 hours  +30 minutes', strtotime($contact_row['date_modified'])));
            $data[$r]['disposition1'] = (!empty($array_call[0]['name'])) ? $array_call[0]['name'] : '';
            $data[$r]['disposition1_date_time'] = (!empty($array_call[0]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[0]['date_start']))) : '';
            $data[$r]['disposition2'] = (!empty($array_call[1]['name'])) ? $array_call[1]['name'] : '';
            $data[$r]['disposition2_date_time'] = (!empty($array_call[1]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[1]['date_start']))) : '';
            $data[$r]['disposition3'] = (!empty($array_call[2]['name'])) ? $array_call[2]['name'] : '';
            $data[$r]['disposition3_date_time'] = (!empty($array_call[2]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[2]['date_start']))) : '';
            $data[$r]['disposition4'] = (!empty($array_call[3]['name'])) ? $array_call[3]['name'] : '';
            $data[$r]['disposition4_date_time'] = (!empty($array_call[3]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[3]['date_start']))) : '';
            $data[$r]['disposition5'] = (!empty($array_call[4]['name'])) ? $array_call[4]['name'] : '';
            $data[$r]['disposition5_date_time'] = (!empty($array_call[4]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[4]['date_start']))) : '';
            $data[$r]['disposition6'] = (!empty($array_call[5]['name'])) ? $array_call[5]['name'] : '';
            $data[$r]['disposition6_date_time'] = (!empty($array_call[5]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[5]['date_start']))) : '';
            $data[$r]['disposition7'] = (!empty($array_call[6]['name'])) ? $array_call[6]['name'] : '';
            $data[$r]['disposition7_date_time'] = (!empty($array_call[6]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[6]['date_start']))) : '';
            $data[$r]['disposition8'] = (!empty($array_call[7]['name'])) ? $array_call[7]['name'] : '';
            $data[$r]['disposition8_date_time'] = (!empty($array_call[7]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[7]['date_start']))) : '';
            $data[$r]['disposition9'] = (!empty($array_call[8]['name'])) ? $array_call[8]['name'] : '';
            $data[$r]['disposition9_date_time'] = (!empty($array_call[8]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[8]['date_start']))) : '';
            $data[$r]['disposition10'] = (!empty($array_call[9]['name'])) ? $array_call[9]['name'] : '';
            $data[$r]['disposition10_date_time'] = (!empty($array_call[9]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[9]['date_start']))) : '';

            if (!empty($end_disposition_date['date_start'])) {
        $end_to_end_tat_seconds = strtotime('-5 hours -30 minutes', strtotime($end_disposition_date['date_start'])) - strtotime($contact_row['date_entered']);


        if (strtotime('-5 hours -30 minutes', strtotime($end_disposition_date['date_start'])) > strtotime($contact_row['date_entered'])) {
            $end_to_end_tat_hours = floor($end_to_end_tat_seconds / 3600);
            $end_to_end_tat_minutes = floor(($end_to_end_tat_seconds / 60) % 60);
            $end_to_end_tat_second = $end_to_end_tat_seconds % 60;
        } else {
            $end_to_end_tat_hours = "00";
            $end_to_end_tat_minutes = "00";
            $end_to_end_tat_second = "00";
        }
        $end_to_end_tat = $end_to_end_tat_hours . ":" . $end_to_end_tat_minutes . ":" . $end_to_end_tat_second;
    }
            $data[$r]['end_to_end_tat'] = (!empty($end_disposition_date['date_start'])) ? $end_to_end_tat : '';


            unset($array_call);
            unset($end_disposition_date['date_start']);
            $r++;
        } 
        return $data;
    }
    
    
    
       

 
?>
