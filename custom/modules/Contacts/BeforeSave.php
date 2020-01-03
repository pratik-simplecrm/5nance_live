<?php

if (!defined('sugarEntry') || !sugarEntry)
    die('Not A Valid Entry Point');

//~ ini_set("display_errors","On");

class BeforeSave {

    public function change_sales_stage_for_disposition(&$bean, $event, $args) {
        global $db, $app_list_strings, $sugar_config, $current_user;
        /*         * *****************extract month from date_entered************* */
        $contactaftersaveLogFile = 'WebsiteAPILogs/productassignedusertest.txt';
        $contactHandle = fopen($contactaftersaveLogFile, 'a');
        $timestamp = date('Y-m-d H:i:s', strtotime('+5 hours +30 minutes', strtotime('now')));
        $status = "Contact Before Save Logic Hook!";
        $logMessage = "\n\nContact Creation Result at $timestamp :- $status";
        fwrite($contactHandle, $logMessage);
        $date_created = $bean->fetched_row['date_entered'];
        if (!isset($date_created)) {
            $date_created = $bean->date_entered;
        }
        $month = date("F", strtotime($date_created));
        $bean->investor_acct_creation_month_c = $month;

        if (isset($bean->dateofactivation_c)) {
            $activation_date = $bean->dateofactivation_c;
        } else {
            $activation_date = $bean->fetched_row['dateofactivation_c'];
        }
        if (!empty($activation_date) && $activation_date != '0000-00-00 00:00:00') {
            $activation_date = date('Y-m-d H:i:s', strtotime('+5 hours +30 minutes', strtotime($activation_date)));
            $month_activation = date("F", strtotime($activation_date));
            $bean->account_activation_month_c = $month_activation;
        }
//		$GLOBALS['log']->fatal("bean fetched id".print_r($bean->fetched_row['id'],true)."created by".print_r($bean->created_by,true)."bean fetched row".print_r($bean->fetched_row['product_sub_type_interest_c'],true)."------bean product sub interest----->".print_r($bean->product_sub_type_interest_c,true)."bean fetched ".print_r($bean->fetched_row,true));
        /* //Edited by noresha
          /******************Round Robin user Assignment Start here********************** */
        //  if (empty($bean->fetched_row) && $bean->created_by == '1') {
        if ((empty($bean->fetched_row) && $bean->created_by == '1') || (!empty($bean->product_interest_c) && ($bean->fetched_row['product_interest_c'] != $bean->product_interest_c))) {
            //Handle Holidays list and Saturday and Sunday
            if ($bean->fetched_row['product_interest_c'] != $bean->product_interest_c) {
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
            if ($gateway_c == 'CSC- M.P Online') {
                $query_user = $db->query("select id from users where user_name='abhishek' and deleted=0");
                $result_user = $db->fetchByAssoc($query_user);
                $assigned_user_id = $result_user['id'];
            } else if ($gateway_c == 'Offline Marketing') {

                $query_user = $db->query("select id from users where user_name='pranay' and deleted=0");
                $result_user = $db->fetchByAssoc($query_user);
                $assigned_user_id = $result_user['id'];
            } else if ($gateway_c == 'Corporate Channel') {
                //START : Corporate channel changes 
                global $current_user;
                $acl_role_obj = new ACLRole();
                $user_roles = $acl_role_obj->getUserRoles($current_user->id);
                if (in_array("Corporate Advisor", $user_roles)) {
                    //Record will assigned to default assigned user 
                } else {
                    $query_user = $db->query("select id from users where user_name='anil' and deleted=0");
                    $result_user = $db->fetchByAssoc($query_user);
                    $assigned_user_id = $result_user['id'];
                }
                //END : Corporate channel changes 
            } else if ($is_holiday || $day == 'Sat' || $day == 'Sun' || $not_working) {

                $query_user = $db->query("select id from users where user_name='Dharmesh' and deleted=0");
                $result_user = $db->fetchByAssoc($query_user);
                $assigned_user_id = $result_user['id'];
            } else {
                $target = $sugar_config['users_assignment_target'];
                //~ $target = 2;
                $query = "SELECT distinct(su.user_id) FROM securitygroups sg JOIN securitygroups_users su ON su.securitygroup_id = sg.id JOIN users u ON su.user_id=u.id JOIN users_cstm uc ON u.id=uc.id_c JOIN acl_roles_users aru on aru.user_id=u.id and aru.deleted=0 WHERE sg.name = '$gateway_c' AND u.status='Active'  AND uc.availability_status_c='Available' AND sg.deleted =0 AND su.deleted=0 AND u.deleted=0 and aru.role_id='a8ab8653-5860-d896-7a78-58466a429bee'";
                if (!empty($bean->product_interest_c)) {
                    //Product wise assignment changes by Roshan Sarode dt. 22-6-18 start
                    $product_assignment_query = "select * from assign_products where product_name='" . $bean->product_interest_c . "'";
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
//$GLOBALS['log']->fatal("all users".print_r($allusers,true));
                //Product wise assignment changes by Roshan Sarode dt. 22-6-18 end

                $result = $db->query($query);
                $users_count = $result->num_rows;
                if ($users_count > 0) {
                    $assigned_array = array();
                    if ((empty($allusers) && empty($bean->product_interest_c))) {
                        while ($users_row = $db->fetchByAssoc($result)) {
                            $assigned_array[] = $users_row['user_id'];
                            //                            $GLOBALS['log']->fatal("in array users" . print_r($users_row['user_id'], true));
                        }
                    } else if (!empty($allusers)) {
                        $assigned_array = $allusers;
                    }

                    if (!empty($assigned_array)) {
                    $today = date('Y-m-d');
                    $assigned_user_count = array();
                    $assigned_user_contacts_count = array();
                    for ($i = 0; $i < sizeof($assigned_array); $i++) {
                        $records_query = "SELECT count(c.id) as count FROM contacts c LEFT JOIN contacts_cstm cc ON c.id = cc.id_c	WHERE  c.deleted =0 AND c.assigned_user_id = '" . $assigned_array[$i] . "' AND (date(cc.user_allocation_date_c ) = '$today' OR disposition_c = '')";
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
            } else if ((empty($bean->fetched_row) && $bean->created_by == '1')) {
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
            if (!$bean->do_not_run_logic_hook_c) {
                $user_allocation_date_c = date("Y-m-d H:i:s");
                $user_allocation_date_c = date("Y-m-d H:i:s", strtotime("-5 hours, -30 minutes", strtotime($user_allocation_date_c)));
                $bean->user_allocation_date_c = $user_allocation_date_c;
                $bean->allocated_time_c = $user_allocation_date_c;
            }
            $bean->do_not_run_logic_hook_c = "";
        }

        $sales_stage = $bean->sales_stage_c;
        $sales_option = str_replace(" ", "_", $sales_stage);

        $disposition = $bean->disposition_c;
        $product_interest = $bean->product_sub_type_interest_c;
        if ($product_interest == 'Personal Loan' && !empty($disposition)) {
            $disposition_list = $app_list_strings['disposition_' . $sales_option . '_list'];
            $sales_stage_dropped_list = $app_list_strings['sales_stage__Dropped_' . $sales_option . '_list'];

//                        echo "<pre>";
//                   //     print_r($disposition_list);
//                         print_r($sales_stage_dropped_list);

            $sales_stage__Moves_to_Customer_list = $app_list_strings['PL_sales_stage__Moves_to_Customer_list'];
            $sales_stage__moves_to_Interested_list = $app_list_strings['PL_sales_stage__moves_to_Interested_list'];
            $sales_stage__moves_to_Opportunity_list = $app_list_strings['PL_sales_stage__moves_to_Opportunity_list'];
            $sales_stage__moves_to_Not_Contactable_list = $app_list_strings['PL_sales_stage__moves_to_Not_Contactable_list'];
            $sales_stage__moves_to_Disqualified_list = $app_list_strings['PL_sales_stage__moves_to_Disqualified_list'];
            //$disposition_User_list = $app_list_strings['disposition_User_list'];

            if (in_array($disposition, $sales_stage_dropped_list)) {
                $bean->sales_stage_c = 'Dropped ' . $sales_stage;
            } else if (in_array($disposition, $sales_stage__Moves_to_Customer_list)) {
                $bean->sales_stage_c = 'Customer';
            } else if (in_array($disposition, $sales_stage__moves_to_Not_Contactable_list)) {

                $bean->sales_stage_c = 'Not_Contactable';
            } else if (in_array($disposition, $sales_stage__moves_to_Interested_list)) {
                $bean->sales_stage_c = 'Interested_Customer';
            } else if (in_array($disposition, $sales_stage__moves_to_Opportunity_list)) {
                $bean->sales_stage_c = 'Opportunity';
            } else if (in_array($disposition, $sales_stage__moves_to_Disqualified_list)) {
                $bean->sales_stage_c = 'Disqualified_Lead';
            } else if ($disposition == 'Callback/Follow up' && $sales_stage == 'Disqualified_Lead') {
                $bean->sales_stage_c = 'User';
            } else if ($disposition == 'Callback/Follow up' && $sales_stage == 'Not_Contactable') {
                $bean->sales_stage_c = 'User';
            }
        } else if (!empty($disposition)) {
            $disposition_list = $app_list_strings['disposition_' . $sales_option . '_list'];
            $sales_stage_dropped_list = $app_list_strings['sales_stage__Dropped_' . $sales_option . '_list'];

            $sales_stage__Moves_to_Customer_list = $app_list_strings['sales_stage__Moves_to_Customer_list'];
            $sales_stage__moves_to_Interested_list = $app_list_strings['sales_stage__moves_to_Interested_list'];
            $sales_stage__moves_to_Opportunity_list = $app_list_strings['sales_stage__moves_to_Opportunity_list'];
            $sales_stage__moves_to_Not_Contactable_list = $app_list_strings['sales_stage__moves_to_Not_Contactable_list'];
            $sales_stage__moves_to_Disqualified_list = $app_list_strings['sales_stage__moves_to_Disqualified_list'];
            $sales_stage__moves_to_Disqualified_list['Not Eligible - Salary credit in Cash/Cheque'] = 'Not Eligible - Salary credit in Cash/Cheque';

            //$disposition_User_list = $app_list_strings['disposition_User_list'];

            if (in_array($disposition, $sales_stage_dropped_list)) {
                $bean->sales_stage_c = 'Dropped ' . $sales_stage;
            } else if (in_array($disposition, $sales_stage__Moves_to_Customer_list)) {
                $bean->sales_stage_c = 'Customer';
            } else if (in_array($disposition, $sales_stage__moves_to_Not_Contactable_list)) {
                $bean->sales_stage_c = 'Not_Contactable';
            } else if (in_array($disposition, $sales_stage__moves_to_Interested_list)) {
                $bean->sales_stage_c = 'Interested_Customer';
            } else if (in_array($disposition, $sales_stage__moves_to_Opportunity_list)) {
                $bean->sales_stage_c = 'Opportunity';
            } else if (in_array($disposition, $sales_stage__moves_to_Disqualified_list)) {
                $bean->sales_stage_c = 'Disqualified_Lead';
            } else if ($disposition == 'Callback/Follow up' && $sales_stage == 'Disqualified_Lead') {
                $bean->sales_stage_c = 'User';
            } else if ($disposition == 'Callback/Follow up' && $sales_stage == 'Not_Contactable') {
                $bean->sales_stage_c = 'User';
            }
        }
    }

}
