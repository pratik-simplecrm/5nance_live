<?php

if (!defined('sugarEntry') || !sugarEntry)
    die('Not A Valid Entry Point');
ini_set("display_errors", "On");

class ProductWiseAssignementClass {

    public function ProductWiseAssignementFunction(&$bean, $event, $args) {
        global $db, $app_list_strings, $sugar_config, $current_user;
        //Edited by Roshan
        /*         * ****************Round Robin user Assignment Start here********************** */
        if (empty($bean->fetched_row) && $bean->created_by == '1') {
            //Handle Holidays list and Saturday and Sunday
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
            if ($is_holiday || $day == 'Sat' || $day == 'Sun' || $not_working) {

                $query_user = $db->query("select id from users where user_name='Dharmesh' and deleted=0");
                $result_user = $db->fetchByAssoc($query_user);
                $assigned_user_id = $result_user['id'];
            } else {
                $target = $sugar_config['users_assignment_target'];
                //~ $target = 2;
                $query = "SELECT distinct(su.user_id) FROM securitygroups sg JOIN securitygroups_users su ON su.securitygroup_id = sg.id JOIN users u ON su.user_id=u.id JOIN users_cstm uc ON u.id=uc.id_c JOIN acl_roles_users aru on aru.user_id=u.id and aru.deleted=0 WHERE  u.status='Active'  AND uc.availability_status_c='Available' AND sg.deleted =0 AND su.deleted=0 AND u.deleted=0 and aru.role_id='a8ab8653-5860-d896-7a78-58466a429bee'";

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
                //Product wise assignment changes by Roshan Sarode dt. 22-6-18 end

                $result = $db->query($query);
                $users_count = $result->num_rows;
                if ($users_count > 0) {
                    $assigned_array = array();
                   if (empty($allusers)) {
                        while ($users_row = $db->fetchByAssoc($result)) {
                            $assigned_array[] = $users_row['user_id'];
                          
                        }
                    } else {
                        $assigned_array = $allusers;
                    }


                    $today = date('Y-m-d');
                    $assigned_user_count = array();
                    $assigned_user_contacts_count = array();
                    for ($i = 0; $i < sizeof($assigned_array); $i++) {
                        $records_query = "SELECT count(p.id) as count FROM scrm_Products p LEFT JOIN scrm_Products_cstm pc ON p.id = pc.id_c	WHERE  p.deleted =0 AND p.assigned_user_id = '" . $assigned_array[$i] . "' AND (date(pc.user_allocation_date_c ) = '$today' OR disposition_c = '')";
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
            $bean->assigned_user_id = $assigned_user_id;
        }
        /*         * **************************End of User Assignment********************************* */

        $assigned_user_id_fetched = $bean->fetched_row['assigned_user_id'];
        $assigned_user_id = $bean->assigned_user_id;

        if (strcmp($assigned_user_id, $assigned_user_id_fetched) != 0) {
            $user_allocation_date_c = date("Y-m-d H:i:s");
            $user_allocation_date_c = date("Y-m-d H:i:s", strtotime("-5 hours, -30 minutes", strtotime($user_allocation_date_c)));
            $bean->user_allocation_date_c = $user_allocation_date_c;
        }

        //  exit;
    }

}
