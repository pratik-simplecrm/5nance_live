<?php

if (!define('sugarEntry'))
    define('sugarEntry', true);
require_once('include/entryPoint.php');
require_once('config.php');
//ini_set('display_errors','On');
exit;
LeadReassignmentData();

function LeadReassignmentData() {
    $schedulerLogFile = 'WebsiteAPILogs/leadreassignmentdata.txt';
    $schedulerHandle = fopen($schedulerLogFile, 'a');
    $timestamp = date('Y-m-d H:i:s', strtotime('+5 hours +30 minutes', strtotime('now')));
    $status = "CRON Run Successful! - ReassignmentData";
    $logMessage = "\n\nScheduler Result at $timestamp :- $status";
    fwrite($schedulerHandle, $logMessage);
    global $db, $app_list_strings, $sugar_config;
//	date_default_timezone_set('UTC');
    $target = $sugar_config['users_assignment_target'];

    //Handle Holidays list and Saturday and Sunday
    $date1 = date("Y-m-d");
    $time1 = date("H:i:s");
    //$yesterday        = date("Y-m-d", strtotime('yesterday'));
    //If day equal monday then need to check from firday - Roshan Sarode
    $timestamp = time();
    if (date('D', $timestamp) === 'Mon') {
        $friday = strtotime('last Friday');
        $yesterday = date("Y-m-d", date('W', $friday) == date('W') ? $friday - 7 * 86400 : $friday);
    } else {
        $yesterday = date("Y-m-d", strtotime('yesterday'));
    }
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
    if ($is_holiday || $day == 'Sat' || $day == 'Sun') {
        return true;
    }


    //End Holiday list caculation
    /*     * *****************fetch the contact ids & respective gateway which are assigned to Dharmesh****************** */
    $fetch_lead_query = "select leads.id,leads_cstm.gateway_c,leads_cstm.product_interest_c from leads join leads_cstm on leads.id=leads_cstm.id_c where leads.assigned_user_id='f084f5af-6e63-6490-371e-59ad17d73b2a' and leads.date_entered>='$yesterday 13:00:00' AND leads.date_entered <='$date1 04:29:59' and leads.created_by='1' and leads_cstm.gateway_c!='' and leads_cstm.gateway_c NOT IN ('CRM-CORPORATE','CRM- M.P ONLINE','CRM-OFFLINE') and leads.deleted=0 order by date_entered desc";
    $logMessage = "\n\n get Lead query at $timestamp :-\n$fetch_lead_query";
    fwrite($schedulerHandle, $logMessage);
    $fetch_leads_data = $db->query($fetch_lead_query);     //product
    while ($result_leads_data = $db->fetchByAssoc($fetch_leads_data)) {

        $logArray = print_r($result_leads_data, true);
        $logMessage = "\n\nLead Detail at $timestamp :-\n$logArray";
        fwrite($schedulerHandle, $logMessage);
        $lead_id = $result_leads_data['id'];
        $lead_gateway = $result_leads_data['gateway_c'];
        $gateway_c = $lead_gateway;
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
            default: $gateway_c = '';
                break;
        }


        $get_pro_interest = $result_leads_data['product_interest_c'];                                        //product
        $ld_product_interest = array_filter(explode(",", $get_pro_interest));
        foreach ($ld_product_interest as $v) {
            $od_product_interest[] = trim($v, "^");
        }
$pro_interest=$od_product_interest[0];
        $query = "SELECT distinct(su.user_id) FROM securitygroups sg JOIN securitygroups_users su ON su.securitygroup_id = sg.id JOIN users u ON su.user_id=u.id JOIN users_cstm uc ON u.id=uc.id_c JOIN acl_roles_users aru on aru.user_id=u.id and aru.deleted=0 WHERE sg.name = '$gateway_c' AND u.status='Active' AND uc.availability_status_c='Available' AND sg.deleted =0 AND su.deleted=0 AND u.deleted=0 and aru.role_id='a8ab8653-5860-d896-7a78-58466a429bee'";
        $result = $db->query($query);
        $users_count = $result->num_rows;
        if ($users_count > 0) {
            if (!empty($pro_interest)) {
                $product_assignment_query = "select * from assign_products where product_name='" . $pro_interest . "'";
                $product_assignment_result = $db->query($product_assignment_query);
                $row_products_result = $db->fetchByAssoc($product_assignment_result);
                $guid = unserialize(base64_decode($row_products_result['users_id']));

                $allusers = array();
                foreach ($guid as $uid) {
                    $allusers[] = $uid;
                }

                $logArray = print_r($allusers, true);
                $logMessage = "\n\nAll Users of product wise assignement for product $pro_interest at $timestamp :-\n$logArray";
                fwrite($schedulerHandle, $logMessage);
            }

            //Product wise assignment changes by Roshan Sarode dt. 22-6-18 end
            $assigned_array = array();
            if (!empty($allusers)) {
                $assigned_array = $allusers;
            } else {
                while ($users_row = $db->fetchByAssoc($result)) {
                    //Product wise assignment changes by Roshan Sarode dt. 22-6-18 start
                    $assigned_array[] = $users_row['user_id'];
                    //Product wise assignment changes by Roshan Sarode dt. 22-6-18 end
                }
            }

            $logArray = print_r($assigned_array, true);
            $logMessage = "\n\nProduct assigned Array at $timestamp :-\n$logArray";
            fwrite($schedulerHandle, $logMessage);
            $today = gmdate('Y-m-d');
            $assigned_user_count = array();
            $assigned_user_contacts_count = array();
            for ($i = 0; $i < sizeof($assigned_array); $i++) {
                //select count of contacts assigned to each user_id 
                $records_query = "SELECT count(l.id) as count FROM leads l LEFT JOIN leads_cstm lc ON l.id = lc.id_c	WHERE  l.deleted =0 AND l.assigned_user_id = '" . $assigned_array[$i] . "' AND (date(lc.user_allocation_date_c) = '$today' OR lc.disposition_c = 'Fresh_Fresh')";
                //	$GLOBALS['log']->fatal($records_query);
                $records_result = $db->query($records_query);
                $row_records_result = $db->fetchByAssoc($records_result);
                //$assigned_user_contacts_count[$row_records_result['assigned_user_id']] = $row_records_result['count'];
                $assigned_user_count[] = $row_records_result['count'];
                $assigned_user_contacts_count[$row_records_result['count']] = $assigned_array[$i];
            }
            // exit;
            //$GLOBALS['log']->fatal(print_r($assigned_user_contacts_count,true)."user assignment testing");
            $get_least_count = min($assigned_user_count);
            if ($get_least_count < $target) {
                $assigned_user_id = $assigned_user_contacts_count[$get_least_count];
                if (empty($assigned_user_id)) {
                    $assigned_user_id = $assigned_array[array_rand($assigned_array)];
                }

                //$user_allocation_date_c = date("Y-m-d H:i:s", strtotime("-5 hours, -30 minutes"));
                $user_allocation_date_c = date("Y-m-d H:i:s");
                //$user_allocation_date_c = date("Y-m-d H:i:s", strtotime("+5 hours, +30 minutes", strtotime($user_allocation_date_c))); 
                //$db->query("update contacts join contacts_cstm on contacts.id=contacts_cstm.id_c set contacts.assigned_user_id='$assigned_user_id',contacts_cstm.user_allocation_date_c='$user_allocation_date_c' where contacts.id='$contact_id' and contacts.deleted=0");
                $lead = BeanFactory::getBean('Leads', $lead_id);
                $lead->assigned_user_id = $assigned_user_id;
                $lead->user_allocation_date_c = $user_allocation_date_c;
				$lead->do_not_run_logic_hook_c = true;
                $lead->save();
                $logArray = print_r($lead->assigned_user_id, true);
                $logMessage = "\n\n Id : $lead_id Lead assigned to at $timestamp :-\n$logArray";
                fwrite($schedulerHandle, $logMessage);
//				$db->query("update leads join contacts_cstm on contacts.id=contacts_cstm.id_c set contacts_cstm.allocated_time_c='$user_allocation_date_c' where contacts.id='$contact_id' and contacts.deleted=0 and contacts_cstm.allocated_time_c IS NULL");


                $gateway = $GLOBALS['app_list_strings']['gateway_list'][$result_leads_data['gateway_c']];
                /*                 * *********fetch securitygroup id from securitygroups****************** */
                $fetch_group_id = $db->query("select id from securitygroups where deleted=0 and name='$gateway'");
                $row_group_id = $db->fetchByAssoc($fetch_group_id);
                $group_id = $row_group_id['id'];

                /*                 * *************adding group to contacts************* */
                $add_groups = "insert into securitygroups_records(id,securitygroup_id,record_id,module,date_modified,deleted) values( UUID(),'$group_id','$lead_id','Leads',NOW(),0)";
                $db->query($add_groups);
            } else {
                $query_user = $db->query("select id from users where user_name='Dharmesh' and deleted=0");
                $result_user = $db->fetchByAssoc($query_user);
                $assigned_user_id = $result_user['id'];
                $db->query("UPDATE leads l SET l.assigned_user_id =  '$assigned_user_id' WHERE  l.deleted =0 AND l.id='$lead_id' ");
            }
        } else {
            $query_user = $db->query("select id from users where user_name='Dharmesh' and deleted=0");
            $result_user = $db->fetchByAssoc($query_user);
            $assigned_user_id = $result_user['id'];
            $db->query("UPDATE leads l SET l.assigned_user_id =  '$assigned_user_id' WHERE  l.deleted =0 AND l.id='$lead_id' ");
            //exit; 
        }
    }
    return true;
}

?>