<?php

/*
 * Script:    DataTables server-side script for PHP and MySQL
 * Copyright: 2010 - Allan Jardine
 * License:   GPL v2 or BSD (3-point)
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

/* Array of database columns which should be read and sent back to DataTables. Use a space where
 * you want to insert a non-database field (for example a counter or static image)
 */
if (!defined('sugarEntry'))
    define('sugarEntry', true);
require_once('include/entryPoint.php');
require_once('config.php');

global $db, $sugar_config, $app_list_strings;
$aColumns = array(unique_customer_code_c, first_name, last_name, email_address, phone_mobile, gateway_c, campaign_type_c, user_name, product_interest_c, product_sub_type_interest_c, date_entered, sales_stage_c, next_call_planning_comments_c, user_allocation_date_c, custom_date_modified_c, utm_content_c, referral_type_c,interactions_age_c,interactions_income_c,investor_occupation_c,bank_account_c,pan_card_c,first_time_investor_c,internet_banking_c,campaign_c, source_c);

$whereColumns = array('c.id', 'c.first_name', 'c.last_name', 'cc.unique_customer_code_c', 'ea.email_address', 'c.phone_mobile', 'cc.gateway_c', 'cc.campaign_type_c', 'u.user_name', 'cc.product_interest_c', 'cc.product_sub_type_interest_c', 'c.date_entered', 'cc.sales_stage_c', 'cc.next_call_planning_comments_c', 'cc.user_allocation_date_c', 'cc.disposition_c', 'cc.qparam_c','cc.custom_date_modified_c','cc.utm_content_c','cc.referral_type_c','cc.interactions_age_c','cc.interactions_income_c','cc.investor_occupation_c','cc.bank_account_c','cc.pan_card_c','cc.first_time_investor_c','cc.internet_banking_c', 'cc.campaign_c', 'cc.source_c');

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "id";

/* DB table to use */
$sTable = "contacts";

/* Database connection information */

//$gaSql['user'] = $sugar_config['dbconfig']['db_user_name'];
//$gaSql['password'] = $sugar_config['dbconfig']['db_password'];
//$gaSql['db'] = $sugar_config['dbconfig']['db_name'];
//$gaSql['server'] = $sugar_config['dbconfig']['db_host_name'];


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
 * no need to edit below this line
 */

/*
 * MySQL connection
 */
//$gaSql['link'] = mysql_connect($gaSql['server'], $gaSql['user'], $gaSql['password']) or
//        die('Could not open connection to server');
//
//mysql_select_db($gaSql['db'], $gaSql['link']) or
//        die('Could not select database ' . $gaSql['db']);


/*
 * Paging
 */

$sLimit = "";
if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
    $sLimit = " LIMIT " . addslashes($_GET['iDisplayStart']) . ", " .
            addslashes($_GET['iDisplayLength']);
}


/*
 * Ordering
 */

if (isset($_GET['iSortCol_0'])) {
    $sOrder = " ORDER BY  ";
    for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
        if (!empty($whereColumns[intval($_GET['iSortCol_' . $i])])) {
            if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
                $sOrder .= $whereColumns[intval($_GET['iSortCol_' . $i])] . " " . addslashes($_GET['sSortDir_' . $i]) . ", ";
            }
        }
    }

    $sOrder = substr_replace($sOrder, "", -2);
    if ($sOrder == "ORDER BY") {
        $sOrder = "";
    }
}


/*
 * Filtering
 * NOTE this does not match the built-in DataTables filtering which does it
 * word by word on any field. It's possible to do here, but concerned about efficiency
 * on very large tables, and MySQL's regex functionality is very limited
 */

$sWhere = "";
if ($_GET['sSearch'] != "") {
    $sWhere = "(";
    for ($i = 0; $i < count($whereColumns); $i++) {

        $sWhere .= $whereColumns[$i] . " LIKE '%" . addslashes($_GET['sSearch']) . "%' OR ";
    }
//      $sWhere .= " (SELECT CONCAT( COALESCE(u.first_name,''), ' ', COALESCE(users.last_name,'') ) as rn from users where u.reports_to_id=users.id) LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
    $sWhere = substr_replace($sWhere, "", -3);
    $sWhere .= ') AND';
}

/* Individual column filtering */
for ($i = 0; $i < count($whereColumns); $i++) {
    if ($_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
        if ($sWhere == "") {
            $sWhere = " WHERE ";
        } else {
            $sWhere .= " AND ";
        }
        $sWhere .= $whereColumns[$i] . " LIKE '%" . addslashes($_GET['sSearch_' . $i]) . "%' ";
    }
}


/*
 * SQL queries
 * Get data to display
 */


$from_date = $_GET['from_date'];
$to_date = $_GET['to_date'];
$gateway = $_GET['Gateway'];


if (empty($to_date) && empty($from_date)) {
    $to_date = date("d/m/Y");
    $from_date = date("m/Y");
    $from_date = "01/" . $from_date;
}

if (!empty($from_date)) {
    $fdate = explode('/', $from_date);
    $from_date = $fdate[2] . "-" . $fdate[1] . "-" . $fdate[0] . " " . "00:00:00";
    // $from_date = $from_date . "00:00:00";
    //$from_date = date('Y-m-d H:i:s', strtotime('-5 hours', strtotime($from_date)));
    $from_date = date('Y-m-d H:i:s', strtotime('-330 minutes', strtotime($from_date)));

//           $from_date = " and c.date_entered >= '$from_date' ";
}

if (!empty($to_date)) {
    $fdate = explode('/', $to_date);
    $to_date = $fdate[2] . "-" . $fdate[1] . "-" . $fdate[0] . " " . "23:59:59";
    // $to_date = $to_date . "23:59:59";

   // $to_date = date('Y-m-d H:i:s', strtotime('-5 hours', strtotime($to_date)));
    $to_date = date('Y-m-d H:i:s', strtotime('-330 minutes', strtotime($to_date)));

    // $to_date = " and c.date_entered <= '$to_date' ";
}
if (!empty($gateway)) {
            if (is_array($gateway)) {
                    $tmp = '';
                foreach ($gateway as $b_id) {
                        if (!empty($b_id)) {
                            if (empty($tmp))
                                $tmp = "'" . $b_id . "'";
                            else
                                $tmp .= ",'" . $b_id . "'";
                        }
                    }
                if (!empty($tmp))
                    $gateway = "and cc.gateway_c in ($tmp)";
                else
    $gateway = '';
}
                }
//if (!empty($gateway)) {
//    $gateway = " AND cc.gateway_c ='" . $gateway . "' ";
//} else {
//    $gateway = '';
//}

$date_filter = " c.date_entered between '" . $from_date . "' AND '" . $to_date . "' $gateway AND";

$sQuery = "SELECT SQL_CALC_FOUND_ROWS DISTINCT c.id,c.id as id, c.first_name as first_name, c.last_name as last_name, cc.leadid_c as unique_customer_code_c, ea.email_address as email_address, c.phone_mobile as phone_mobile, cc.gateway_c as gateway_c, cc.campaign_type_c as campaign_type_c, u.user_name as user_name, cc.product_interest_c as product_interest_c, cc.product_sub_type_interest_c as product_sub_type_interest_c, c.date_entered as date_entered, cc.sales_stage_c as sales_stage_c, cc.next_call_planning_comments_c as next_call_planning_comments_c, cc.user_allocation_date_c as user_allocation_date_c, cc.disposition_c as latest_disposition,cc.qparam_c as publisher_subid,cc.custom_date_modified_c as date_modified, cc.utm_content_c as utm_content_c,cc.referral_type_c as referral_type_c,cc.interactions_age_c as interactions_age_c, cc.interactions_income_c as interactions_income_c, cc.investor_occupation_c as investor_occupation_c, cc.bank_account_c as bank_account_c, cc.pan_card_c as pan_card_c, cc.first_time_investor_c as first_time_investor_c, cc.internet_banking_c as internet_banking_c,cc.campaign_c as campaign_c, cc.source_c as source_c  FROM contacts c LEFT JOIN contacts_cstm cc ON c.id = cc.id_c join users u on u.id = c.assigned_user_id LEFT JOIN email_addr_bean_rel eabl  ON eabl.bean_id = c.id AND eabl.bean_module = 'Contacts' and eabl.primary_address = 1 and eabl.deleted=0 LEFT JOIN email_addresses ea ON (ea.id = eabl.email_address_id) where " . $sWhere . " $date_filter  c.deleted=0 AND u.user_name !='poorti' AND cc.gateway_c!=''" . $sOrder . $sLimit . "";


$rResult = $db->query($sQuery);

//$rResult = mysql_query($sQuery, $gaSql['link']) or die(mysql_error());

/* Data set length after filtering */
$sQuery = "SELECT FOUND_ROWS() as iFilteredTotal";
//$rResultFilterTotal = mysql_query($sQuery, $gaSql['link']) or die(mysql_error());
$rResultFilterTotal = $db->query($sQuery);
//$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
 $aResultFilterTotal = $db->fetchByAssoc($rResultFilterTotal);


 $iFilteredTotal = $aResultFilterTotal['iFilteredTotal'];

/* Total data set length */
$sQuery = "SELECT COUNT(c." . $sIndexColumn . ") as iTotal FROM contacts c LEFT JOIN users u on u.id = c.assigned_user_id where c.deleted=0 AND u.user_name !='poorti' ";

$rResultTotal = $db->query($sQuery);
//$rResultTotal = mysql_query($sQuery, $gaSql['link']) or die(mysql_error());
//$aResultTotal = mysql_fetch_array($rResultTotal);
$aResultTotal = $db->fetchByAssoc($rResultTotal);

$iTotal = $aResultTotal['iTotal'];
$disposition_list = $GLOBALS['app_list_strings']['disposition_list'];
$old_disposition_list = $GLOBALS['app_list_strings']['old_disposition_list'];
$disposition_list = array_merge($disposition_list, $old_disposition_list);

/*
 * Output
 */
$output = array(
    "sEcho" => intval($_GET['sEcho']),
    "iTotalRecords" => $iTotal,
    "iTotalDisplayRecords" => $iFilteredTotal,
    "aaData" => array()
);
// mysql_num_rows($rResult);


while ($contact_row = $db->fetchByAssoc($rResult)) {
//while ($contact_row = mysql_fetch_array($rResult)) {    
//		$row = array();
//		for ( $i=0 ; $i<count($aColumns) ; $i++ )
//		{
//			if ( $aColumns[$i] != ' ' )
//			{
//				/* General output */
//				$row[] = $aRow[ $aColumns[$i] ];
//			}
//		}

    $row[] = $contact_row['unique_customer_code_c'];
    $row[] = $contact_row['first_name'];
    $row[] = $contact_row['last_name'];
    $row[] = $contact_row['email_address'];
    $row[] = $contact_row['phone_mobile'];
    $row[] = $contact_row['gateway_c'];
    $row[] = $contact_row['campaign_type_c'];
    $row[] = $contact_row['user_name'];
    $row[] = $contact_row['product_interest_c'];
    $row[] = $contact_row['product_sub_type_interest_c'];
  $row[] = $GLOBALS['app_list_strings']['referral_type_list'][$contact_row['referral_type_c']];
    $row[] = $contact_row['interactions_age_c'];
    $row[] = $contact_row['interactions_income_c'];
    $row[] = $GLOBALS['app_list_strings']['investor_occupation_list'][$contact_row['investor_occupation_c']];
    $row[] = $contact_row['bank_account_c'];
    $row[] = $contact_row['pan_card_c'];
    $row[] = $contact_row['first_time_investor_c'];
    $row[] = $contact_row['internet_banking_c'];
 $row[] = $contact_row['utm_content_c'];
    $row[] = $contact_row['campaign_c'];
    $row[] = $contact_row['source_c'];


    $row[] = $contact_row['publisher_subid'];

    $row[] = date('d/m/Y h:i a ', strtotime('+5 hours  +30 minutes', strtotime($contact_row['date_entered'])));
    $row[] = (!empty($contact_row['user_allocation_date_c']) ? date('d/m/Y h:i a ', strtotime('+5 hours  +30 minutes', strtotime($contact_row['user_allocation_date_c']))) : '');

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
    $row[] = (!empty($contact_row['user_allocation_date_c'])) ? $assignment_tat : '';
    $row[] = $contact_row['sales_stage_c'];
    $row[] = utf8_encode($contact_row['next_call_planning_comments_c']);

    $row[] = $contact_row['latest_disposition'];
    $bean = BeanFactory::getBean('Contacts', $contact_row['id']);

    //If relationship is loaded
    if ($bean->load_relationship('calls')) {
        $my_calls = $bean->get_linked_beans('calls', 'Calls');
    }

    $array_call = '';
    $get_first_call = '';
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

//print_r($array_call);
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

//$array_call = array_pop($array_call);
    }
    // $array_call[] = $get_first_call[0];
    //  $row[] = $array_call[0]['name'];

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
    $row[] = (!empty($get_first_call[0]['date_start'])) ? $first_call_tat : '';
    $row[] = date('d/m/Y h:i a ', strtotime('+5 hours  +30 minutes', strtotime($contact_row['date_modified'])));
    $row[] = (!empty($array_call[0]['name'])) ? $array_call[0]['name'] : '';
    $row[] = (!empty($array_call[0]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[0]['date_start']))) : '';
//    $row[] = $array_call[0]['name'];
//    $row[] = (!empty($array_call[0]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[0]['date_start']))) : '';
    $row[] = (!empty($array_call[1]['name'])) ? $array_call[1]['name'] : '';
    $row[] = (!empty($array_call[1]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[1]['date_start']))) : '';
    $row[] = (!empty($array_call[2]['name'])) ? $array_call[2]['name'] : '';
    $row[] = (!empty($array_call[2]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[2]['date_start']))) : '';
    $row[] = (!empty($array_call[3]['name'])) ? $array_call[3]['name'] : '';
    $row[] = (!empty($array_call[3]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[3]['date_start']))) : '';
    $row[] = (!empty($array_call[4]['name'])) ? $array_call[4]['name'] : '';
    $row[] = (!empty($array_call[4]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[4]['date_start']))) : '';
    $row[] = (!empty($array_call[5]['name'])) ? $array_call[5]['name'] : '';
    $row[] = (!empty($array_call[5]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[5]['date_start']))) : '';
    $row[] = (!empty($array_call[6]['name'])) ? $array_call[6]['name'] : '';
    $row[] = (!empty($array_call[6]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[6]['date_start']))) : '';
    $row[] = (!empty($array_call[7]['name'])) ? $array_call[7]['name'] : '';
    $row[] = (!empty($array_call[7]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[7]['date_start']))) : '';
    $row[] = (!empty($array_call[8]['name'])) ? $array_call[8]['name'] : '';
    $row[] = (!empty($array_call[8]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[8]['date_start']))) : '';
    $row[] = (!empty($array_call[9]['name'])) ? $array_call[9]['name'] : '';
    $row[] = (!empty($array_call[9]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[9]['date_start']))) : '';

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

    $row[] = (!empty($end_disposition_date['date_start'])) ? $end_to_end_tat : '';


    $output['aaData'][] = $row;
    unset($row);
    unset($array_call);
    unset($end_disposition_date['date_start']);
}
//print_r($output);
//print_r(error_get_last());
echo json_encode($output, true);
?>
