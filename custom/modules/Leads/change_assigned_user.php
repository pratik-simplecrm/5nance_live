<?php

if (!defined('sugarEntry') || !sugarEntry)
    die('Not A Valid Entry Point');
//ini_set("display_errors", "On");

class ChangedAssignedUserClass {

    public function ChangedAssignedUserMethod(&$bean, $event, $args) {
        global $db, $app_list_strings, $sugar_config, $current_user;
        /*         * *****************extract month from date_entered************* */
        $contactaftersaveLogFile = 'WebsiteAPILogs/leadproductassignedusertest.txt';
        $contactHandle = fopen($contactaftersaveLogFile, 'a');
        $timestamp = date('Y-m-d H:i:s', strtotime('+5 hours +30 minutes', strtotime('now')));
        $status = "Lead Before Save Logic Hook!";
        $logMessage = "\n\nLead Creation Result at $timestamp :- $status";
        fwrite($contactHandle, $logMessage);
        $date_created = $bean->fetched_row['date_entered'];
        if (!isset($date_created)) {
            $date_created = $bean->date_entered;
        }
       

$old_product_interest=array_filter(explode(",",$bean->product_interest_c));
foreach($old_product_interest as $v){
    $od_product_interest[]= trim($v,"^");
}
$od_product_interest=$od_product_interest[0];
$new_product_interest=array_filter(explode(",",$bean->fetched_row['product_interest_c']));
foreach($new_product_interest as $v){
    $nw_product_interest[]= trim($v,"^");
}
$nw_product_interest=$nw_product_interest[0];
        /* //Edited by noresha
          /******************Round Robin user Assignment Start here********************** */
        //  if (empty($bean->fetched_row) && $bean->created_by == '1') {
 $nwArray = print_r($nw_product_interest, true);
 $odArray = print_r($od_product_interest, true);
                    $logMessage = "\n\nNew and Old Product created by at $timestamp :-\n New $nwArray\n Old------$odArray";
                    fwrite($contactHandle, $logMessage);
        if ((empty($bean->fetched_row) && $bean->created_by == '1') || (!empty($od_product_interest) && ($nw_product_interest != $od_product_interest))) {
            //Handle Holidays list and Saturday and Sunday

            if ($nw_product_interest != $od_product_interest) {
                $is_product_changed = "true";
            }

            $date1 = date("Y-m-d");
            $time1 = date("H:i:s");
            $day = date("D");
            $holiday_query = "select holiday_date from scrm_holidays_list where deleted = 0 order by holiday_date Desc";
            $holiday_result = $db->query($holiday_query);

            $holiday_calender = array();
            while ($holiday_row = $db->fetchByAssoc($holiday_result)) {
                $holiday_date = $holiday_row['holiday_date'];
                $holiday_calender[] = strtotime($holiday_date);
                $holiday = date("Y-m-d", strtotime($holiday_date));
                if ($holiday == $date1) {
                    $is_holiday = true;
                }
            }
            if ($time1 < date("H:i:s", strtotime("10:00:00")) || $time1 > date("H:i:s", strtotime("18:30:00"))) {
                       $not_working = true;
            }

            //End Holiday list caculation
            $gateway_c = $bean->gateway_c;
                            $gateway_c = $bean->gateway_c;
                switch ($gateway_c) {
                    case 'CRM-5NANCE.COM': $gateway_c = '5nance.com';
                        break;
                    case 'CRM-CORPORATE': $gateway_c = 'Corporate Channel';
                        break;
                    case 'CRM-OFFLINE': $gateway_c = 'Offline Marketing';
                        break;
                    case 'CRM- M.P ONLINE': $gateway_c = 'CSC- M.P Online';
                        break;
                    case 'CRM-CSC': $gateway_c = 'CSC- Rajasthan emitra';
                        break;
                    case 'CRM-MARKETING': $gateway_c = 'Digital Marketing';
                        break;
                    case 'CRM-EMITRA': $gateway_c = 'CSC- Rajasthan emitra';
                        break;
                    case 'CRM-REFERENCE': $gateway_c = 'Digital Marketing';
                        break;
					case 'CRM-CORPORATE SALES': $gateway_c = 'Corporate Channel';
                       break;
                    default: $gateway_c = '';
                        break;
                }
              
            if ($bean->source_c=='Just Dial' && ((empty($bean->phone_mobile) && !empty($bean->email1)) || (empty($bean->phone_mobile) && empty($bean->email1))) && ((!empty($bean->first_name)) || (!empty($bean->middle_name_c)) || (!empty($bean->last_name)))){
                 $query_user = $db->query("select id from users where user_name='RahulM' and deleted=0");
                $result_user = $db->fetchByAssoc($query_user);
                $assigned_user_id = $result_user['id'];
            } else if ($gateway_c == 'CSC- M.P Online') {
                $query_user = $db->query("select id from users where user_name='abhishek' and deleted=0");
                $result_user = $db->fetchByAssoc($query_user);
                $assigned_user_id = $result_user['id'];
            } else if ($gateway_c == 'Offline Marketing') {
                $query_user = $db->query("select id from users where user_name='anil' and deleted=0");
                $result_user = $db->fetchByAssoc($query_user);
                $assigned_user_id = $result_user['id'];
            } else if ($gateway_c == 'Corporate Channel') {
				//START : Corporate channel changes 
				global $current_user;
				 $acl_role_obj = new ACLRole();
				$user_roles = $acl_role_obj->getUserRoles($current_user->id);
				if(in_array("Corporate Advisor",$user_roles)){
				  //Record will assigned to default assigned user 
				  }else{
					$query_user = $db->query("select id from users where user_name='anil' and deleted=0");
					$result_user = $db->fetchByAssoc($query_user);
					$assigned_user_id = $result_user['id'];
				  }
				//END : Corporate channel changes 
		   }  else if ($is_holiday || $day == 'Sat' || $day == 'Sun' || $not_working) {

                $query_user = $db->query("select id from users where user_name='Dharmesh' and deleted=0");
                $result_user = $db->fetchByAssoc($query_user);
                $assigned_user_id = $result_user['id'];
            } else {
                $target = $sugar_config['users_assignment_target'];
                //~ $target = 2;
                $query = "SELECT distinct(su.user_id) FROM securitygroups sg JOIN securitygroups_users su ON su.securitygroup_id = sg.id JOIN users u ON su.user_id=u.id JOIN users_cstm uc ON u.id=uc.id_c JOIN acl_roles_users aru on aru.user_id=u.id and aru.deleted=0 WHERE sg.name = '$gateway_c' AND u.status='Active'  AND uc.availability_status_c='Available' AND sg.deleted =0 AND su.deleted=0 AND u.deleted=0 and aru.role_id='a8ab8653-5860-d896-7a78-58466a429bee'";
                if (!empty($od_product_interest)) {
                    //Product wise assignment changes by Roshan Sarode dt. 22-6-18 start
                    $product_assignment_query = "select * from assign_products where product_name='" . $od_product_interest . "'";
                    $product_assignment_result = $db->query($product_assignment_query);
                    $row_products_result = $db->fetchByAssoc($product_assignment_result);
                    $guid = unserialize(base64_decode($row_products_result['users_id']));
                    foreach ($guid as $uid) {
  //If check user availability_status_c is aviailable start
                        $user_isavailable_query = "select * from users u JOIN users_cstm uc ON u.id=uc.id_c where id='" . $uid . "' and uc.availability_status_c='Available'";
                        $get_user_available_result = $db->query($user_isavailable_query);
                        if ($get_user_available_result->num_rows > 0) {
                            $allusers[] = $uid;
                        }
                       //If check user availability_status_c is aviailable end
                    }
                }
  $logArray = print_r($allusers, true);
                $logMessage = "\n\n  All Users at $timestamp :-\n$logArray";
                fwrite($contactHandle, $logMessage);
                //Product wise assignment changes by Roshan Sarode dt. 22-6-18 end

                $result = $db->query($query);
                $users_count = $result->num_rows;
                if ($users_count > 0) {

                    $assigned_array = array();
                    if (empty($allusers)) {
                        while ($users_row = $db->fetchByAssoc($result)) {
                            $assigned_array[] = $users_row['user_id'];
                            $GLOBALS['log']->fatal("in array users" . print_r($users_row['user_id'], true));
                        }
                    } else {
                        $assigned_array = $allusers;
                    }

                    $today = date('Y-m-d');
                    $assigned_user_count = array();
                    $assigned_user_contacts_count = array();
                    for ($i = 0; $i < sizeof($assigned_array); $i++) {
                        $records_query = "SELECT count(l.id) as count FROM leads l LEFT JOIN leads_cstm lc ON l.id = lc.id_c WHERE  l.deleted =0 AND l.assigned_user_id = '" . $assigned_array[$i] . "' AND (date(lc.user_allocation_date_c ) = '$today' OR lc.disposition_c = '')";
                        $records_result = $db->query($records_query);
                        $row_records_result = $db->fetchByAssoc($records_result);
                        $assigned_user_count[] = $row_records_result['count'];
                        $assigned_user_contacts_count[$row_records_result['count']] = $assigned_array[$i];
                    }

                    $get_least_count = min($assigned_user_count);

                    if ($get_least_count < $target) {

                        $assigned_user_id = $assigned_user_contacts_count[$get_least_count];

                        if (empty($assigned_user_id)) {
                            $assigned_user_id = $assigned_array[array_rand($assigned_array)];
                        }
                        if (empty($assigned_user_id)) {
                            $assigned_user_id = $current_user->id;
                        }
                    } else {

                        $query_user = $db->query("select id from users where user_name='Dharmesh' and deleted=0");
                        $result_user = $db->fetchByAssoc($query_user);
                        $assigned_user_id = $result_user['id'];
                    }
                } else {

                    $query_user = $db->query("select id from users where user_name='Dharmesh' and deleted=0");
                    $result_user = $db->fetchByAssoc($query_user);
                    $assigned_user_id = $result_user['id'];
                }
            }

            $old_assigned_user_id = $bean->assigned_user_id;

            if (isset($is_product_changed) && empty($allusers)) {
                $logArray = print_r($assigned_user_id, true);
                $logMessage = "\n\n  if at $timestamp :-\n$logArray";
                fwrite($contactHandle, $logMessage);
                if (empty($bean->fetched_row) && $bean->created_by == '1') {
                    $bean->assigned_user_id = $assigned_user_id;
                    $logArray = print_r($assigned_user_id, true);
                    $logMessage = "\n\n product is changed and allusers empty and created by at $timestamp :-\n$logArray";
                    fwrite($contactHandle, $logMessage);
                }
            } else if (isset($is_product_changed) && !empty($allusers)) {
                $logArray = print_r($assigned_user_id, true);
                $logMessage = "\n\n else if at $timestamp :-\n$logArray";
                fwrite($contactHandle, $logMessage);
                if (!in_array($bean->assigned_user_id, $allusers)) {
                    $bean->assigned_user_id = $assigned_user_id;
                    $logArray = print_r($assigned_user_id, true);
                    $logMessage = "\n\n product is changed and allusers not empty and user is not available in all users at $timestamp :-\n$logArray";
                    fwrite($contactHandle, $logMessage);
                }
            } else   if((empty($bean->fetched_row) && $bean->created_by == '1') ){
                $logArray = print_r($assigned_user_id, true);
                $logMessage = "\n\n else at $timestamp :-\n$logArray";
                fwrite($contactHandle, $logMessage);
                $bean->assigned_user_id = $assigned_user_id;
            }
            $get_assingedUser = array('Mobile No' => $bean->phone_mobile, 'Modified by name' => $bean->modified_by_name, 'Created by Name' => $bean->created_by_name, 'Old Assigned User Id' => $old_assigned_user_id, 'Old Assigned User Name' => $bean->assigned_user_name, 'New Assigned User Id' => $assigned_user_id, 'Custom Date Modified' => $bean->custom_date_modified_c, 'Product Interes' => $bean->product_interest_c, 'User Allocation Date' => $bean->fetched_row['user_allocation_date_c']);

            $logArray = print_r($get_assingedUser, true);
            $logMessage = "\n\n Before Save Result at $timestamp :-\n$logArray";
            fwrite($contactHandle, $logMessage);
        }

        /*         * **************************End of User Assignment********************************* */

        $assigned_user_id_fetched = $bean->fetched_row['assigned_user_id'];
        $assigned_user_id = $bean->assigned_user_id;
        if (strcmp($assigned_user_id, $assigned_user_id_fetched) != 0) {
             if (!$bean->do_not_run_logic_hook_c){
            $user_allocation_date_c = date("Y-m-d H:i:s");
            $user_allocation_date_c = date("Y-m-d H:i:s", strtotime("-5 hours, -30 minutes", strtotime($user_allocation_date_c)));
            $bean->user_allocation_date_c = $user_allocation_date_c;
        }
              $bean->do_not_run_logic_hook_c = "";
        }
      
    }

}
