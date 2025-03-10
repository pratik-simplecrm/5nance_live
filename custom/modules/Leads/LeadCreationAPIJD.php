<?php

if (!define('sugarEntry'))
    define('sugarEntry', true);
require_once('include/entryPoint.php');
require_once('custom/include/language/en_us.lang.php');
global $db, $sugar_config;

$url = $sugar_config["webservice_url"];
$username = $sugar_config["webservice_username"];
$password = $sugar_config["webservice_password"];
global $db, $sugar_config;
$session_id = generateSession($username, $password, $url);
$Unique_lead_id = $_REQUEST['leadid'];
$prefix = $_REQUEST['prefix'];
$fullname = $_REQUEST['name'];
$mobile = $_REQUEST['mobile'];
$email = $_REQUEST['email'];
$category = $_REQUEST['category'];
$city = $_REQUEST['city'];
$justDialleadcreation = 'WebsiteAPILogs/justdialleadcreation_log.txt';
$leadHandle = fopen($justDialleadcreation, 'a');
$timestamp = date('Y-m-d H:i:s', strtotime('+5 hours +30 minutes', strtotime('now')));
$logArray = print_r($_REQUEST, true);
$logMessage = "\n\nJUSTDIALLEADS DATA at $timestamp :- $logArray";
fwrite($leadHandle, $logMessage);
if ($fullname) {
    $fullname_array = explode(" ", $fullname);
    $first_name = $fullname_array[0];
    $middle_name = $fullname_array[1];
    $last_name = $fullname_array[2];
    if (empty($last_name)) {
        $last_name = $middle_name;
        $middle_name = '';
    }
}



if (!empty($city)) {
    $fieldname = "city_c";
    $city = getdropdown($session_id, 'Leads', $city, $fieldname, $url);
}
if (!empty($prefix)) {
    $fieldname = "salutation";
    $prefix = getdropdown($session_id, 'Leads', $prefix, $fieldname, $url);
}
//If category is blank so adding category is equal Personal Loans - changes by Roshan 20-08-2018
if(empty($category)){
    $category="Personal Loan"; 
}
if (!empty($category)) {

if (strpos($category,"Loan") !== false) {
     $product_interest = 'Loans';
     $fieldname = "product_sub_interest_c";
    $subproduct_interest = getdropdown($session_id, 'Leads', $category, $fieldname, $url);
} 
else {
    $fieldname = "product_interest_c";
    $product_interest = getdropdown($session_id, 'Leads', $category, $fieldname, $url);
}
}

//if (!empty($gateway_c)) {
//    $fieldname = "gateway_c";
//    if ($gateway_c == 'EXTERNALBO') {
//        $gateway_c = 'Digital Marketing';
//    }
//    if (strpos($gateway_c, '-') !== false) {
//        $gateway_array = explode("-", $gateway_c);
//        $gateway_c = $gateway_array[0];
//    }
//    $gateway_c = getdropdown($session_id, $module, $gateway_c, $fieldname, $url);
//}

// $date1 = date("Y-m-d");
// $time1 = date("H:i:s");
// $day = date("D");
// $holiday_query = "select holiday_date from scrm_holidays_list where deleted = 0 order by holiday_date Desc";
// $holiday_result = $db->query($holiday_query);
// $holiday_calender = array();
// while ($holiday_row = $db->fetchByAssoc($holiday_result)) {
//     $holiday_date = $holiday_row['holiday_date'];
//     $holiday_calender[] = strtotime($holiday_date);
//     $holiday = date("Y-m-d", strtotime($holiday_date));
//     if ($holiday == $date1) {
//         $is_holiday = true;
//     }
// }
// if ($time1 < date("H:i:s", strtotime("10:00:00")) || $time1 > date("H:i:s", strtotime("18:30:00"))) {
//     $not_working = true;
// }
// if ($is_holiday || $day == 'Sat' || $day == 'Sun' || $not_working) {

//     $query_user = $db->query("select id from users where user_name='Dharmesh' and deleted=0");
//     $result_user = $db->fetchByAssoc($query_user);
//     $assigned_user_id = $result_user['id'];
// } else {

//     $target = $sugar_config['users_assignment_target'];
   
//     //Product wise assignment changes by Roshan Sarode dt. 22-6-18 start
//     $product_assignment_query = "select * from assign_products where product_name='$product_interest'";
//     $product_assignment_result = $db->query($product_assignment_query);
//     $row_products_result = $db->fetchByAssoc($product_assignment_result);
//     $guid = unserialize(base64_decode($row_products_result['users_id']));
//     foreach ($guid as $uid) {

//         $allusers[] = $uid;
//     }
//    // print_r($allusers);
//     //Product wise assignment changes by Roshan Sarode dt. 22-6-18 end

//     // $result = $db->query($query);
//     // $users_count = $result->num_rows;
//     // if ($users_count > 0) {
//     //     $assigned_array = array();
//     //     while ($users_row = $db->fetchByAssoc($result)) {
//     //         //Product wise assignment changes by Roshan Sarode dt. 22-6-18 start

//     //         if (in_array($users_row['user_id'], $allusers)) {
//     //             $assigned_array[] = $users_row['user_id'];
//     //         }

//     //         //Product wise assignment changes by Roshan Sarode dt. 22-6-18 end
//     //     }

//         $today = date('Y-m-d');
//         $assigned_user_count = array();
//         $assigned_user_contacts_count = array();
//         for ($i = 0; $i < sizeof($allusers); $i++) {
//             $records_query = "SELECT count(l.id) as count FROM leads l LEFT JOIN leads_cstm lc ON l.id = lc.id_c WHERE  l.deleted =0 AND l.assigned_user_id = '" . $allusers[$i] . "' AND (date(lc.user_allocation_date_c ) = '$today' OR lc.disposition_c = '')";
//             $records_result = $db->query($records_query);
//             $row_records_result = $db->fetchByAssoc($records_result);
//             $assigned_user_count[] = $row_records_result['count'];
//             $assigned_user_contacts_count[$row_records_result['count']] = $allusers[$i];
//         }
//         $get_least_count = min($assigned_user_count);
//         if ($get_least_count < $target) {
//             $assigned_user_id = $assigned_user_contacts_count[$get_least_count];
//             if (empty($assigned_user_id)) {
//                 $assigned_user_id = $allusers[array_rand($allusers)];
//             }
//         } else {
//             $query_user = $db->query("select id from users where user_name='Dharmesh' and deleted=0");
//             $result_user = $db->fetchByAssoc($query_user);
//             $assigned_user_id = $result_user['id'];
//         }
    
// }
//echo $assigned_user_id;

if (!empty($fullname) && !empty($mobile) && !empty($email)) {

    $name_value_list = array(
        (isset($prefix) ? array('name' => 'salutation', 'value' => trim($prefix)) : ''),
        (isset($first_name) ? array('name' => 'first_name', 'value' => trim($first_name)) : ''),
        (isset($middle_name) ? array('name' => 'middle_name_c', 'value' => trim($middle_name)) : ''),
        (isset($last_name) ? array('name' => 'last_name', 'value' => trim($last_name)) : ''),
        (isset($email) ? array('name' => 'email1', 'value' => $email) : ''),
        (isset($mobile) ? array('name' => 'phone_mobile', 'value' => $mobile) : ''),
        (isset($assigned_user_id) ? array('name' => 'assigned_user_id', 'value' => $assigned_user_id) : ''),
        array('name' => 'status', 'value' => 'Valid'),
        array('name' => 'disposition_c', 'value' => 'Valid_Interested_Candidate'),
        array('name' => 'converted', 'value' => 0),
        array('name' => 'gateway_c', 'value' => 'CRM-MARKETING'),
        array('name' => 'source_c', 'value' => 'Just Dial'),
        //array('name' => 'assigned_user_id','value' => 1),
        array('name' => 'leadid_c', 'value' => $Unique_lead_id),
        array('name' => 'justdial_category_c', 'value' => $category),
        array('name' => 'campaign_type_c', 'value' => "JUSTDIAL"),
        array('name' => 'campaign_sub_type_c', 'value' => "JUSTDIAL_" . $category),
        array('name' => 'product_interest_c', 'value' => $product_interest),
        array('name' => 'product_sub_interest_c', 'value' => $subproduct_interest),
        array('name' => 'otp_c', 'value' => '1970'),
        array('name' => 'encrypted_otp_c', 'value' => 'k7vPu/V70csvHXuCMr9ppi4yqOO1X0I+rAmpbBVuO30='),
    );

} else {
    $name_value_list = array(
        (isset($prefix) ? array('name' => 'salutation', 'value' => trim($prefix)) : ''),
        (isset($first_name) ? array('name' => 'first_name', 'value' => trim($first_name)) : ''),
        (isset($middle_name) ? array('name' => 'middle_name_c', 'value' => trim($middle_name)) : ''),
        (isset($last_name) ? array('name' => 'last_name', 'value' => trim($last_name)) : ''),
        (isset($email) ? array('name' => 'email1', 'value' => $email) : ''),
        (isset($mobile) ? array('name' => 'phone_mobile', 'value' => $mobile) : ''),
        (isset($assigned_user_id) ? array('name' => 'assigned_user_id', 'value' => $assigned_user_id) : ''),
        array('name' => 'status', 'value' => 'Fresh'),
        array('name' => 'disposition_c', 'value' => 'Fresh_Fresh'),
        array('name' => 'gateway_c', 'value' => 'CRM-MARKETING'),
         array('name' => 'source_c', 'value' => 'Just Dial'),
         array('name' => 'justdial_category_c', 'value' => $category),
       array('name' => 'leadid_c', 'value' => $Unique_lead_id),
        array('name' => 'campaign_type_c', 'value' => "JUSTDIAL"),
        array('name' => 'campaign_sub_type_c', 'value' => "JUSTDIAL_" . $category),
        array('name' => 'product_interest_c', 'value' => $product_interest),
        array('name' => 'product_sub_interest_c', 'value' => $subproduct_interest),
    );
}
//

$fetch_lead_query = "select * from leads join leads_cstm on id=id_c where deleted=0 and leadid_c='" . $Unique_lead_id . "'";
$result_lead_query = $db->query($fetch_lead_query);

if ($result_lead_query->num_rows == 0) {
   //first check
    $check_mobile_number = $db->query("select * from leads join leads_cstm on id=id_c where deleted=0 and phone_mobile='".$mobile."'");
    if($check_mobile_number->num_rows == 0){
         $leadresult = createrecord($session_id, 'Leads', $name_value_list, $url);
        $lead_id = $leadresult->id;
       echo  $msg = "RECEIVED";
    }else{
        echo $msg ="FAILED";
    }
    
} else {
    $row_lead_query = $db->fetchByAssoc($result_lead_query);
    $name_value_list[] = array('name' => 'id', 'value' => $row_lead_query['id']);
    $leadresult = createrecord($session_id, 'Leads', $name_value_list, $url);
    $lead_id = $leadresult->id;
   // print_r($leadresult);
    // $msg = array(
    //     'Success' => true,
    //     'Message' => 'Lead Updated Successfully',
    //     'crmleadid' => $lead_id,
    // );
   echo $msg = "FAILED";
}
//function to make cURL request
function call($method, $parameters, $url) {

    ob_start();
    $curl_request = curl_init();

    curl_setopt($curl_request, CURLOPT_URL, $url);
    curl_setopt($curl_request, CURLOPT_POST, 1);
    curl_setopt($curl_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($curl_request, CURLOPT_HEADER, 1);
    curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl_request, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_request, CURLOPT_FOLLOWLOCATION, 0);

    $jsonEncodedData = json_encode($parameters);

    $post = array(
        "method" => $method,
        "input_type" => "JSON",
        "response_type" => "JSON",
        "rest_data" => $jsonEncodedData
    );

    curl_setopt($curl_request, CURLOPT_POSTFIELDS, $post);
    $result = curl_exec($curl_request);
    curl_close($curl_request);

    $result = explode("\r\n\r\n", $result, 2);
    $response = json_decode($result[1]);
    ob_end_flush();

    return $response;
}

function createrecord($session_id, $module, $create_entry_parameters, $url) {

    $set_entry_parameters = array(
        //session id
        "session" => $session_id,
        "module_name" => $module,
        //Record attributes
        "name_value_list" => $create_entry_parameters
    );

    $set_entry_result = call("set_entry", $set_entry_parameters, $url);

//print_r($set_entry_result);
    $record_id = $set_entry_result->id;

    return $set_entry_result;
}

function generateSession($username, $password, $url) {

    $login_parameters = array(
        "user_auth" => array(
            "user_name" => $username,
            "password" => md5($password),
            "version" => "1"
        ),
        "application_name" => "Rest",
        "name_value_list" => array()
    );

    $login_result = call("login", $login_parameters, $url);

    //get session id
    $session_id = $login_result->id;
    return $session_id;
}

function getdropdown($sessionID, $module, $needle, $fieldname, $url) {

//  echo $sessionID;echo $module;exit;
    $getContactFields = array(
        'session' => $sessionID,
        'module_name' => $module,
    );
    $getdropdownresult = call('get_module_fields', $getContactFields, $url)->module_fields;

    $getdropdownvalues = $getdropdownresult->$fieldname->options;

    foreach ($getdropdownvalues as $getdropdownKey => $getdropdownValue) {
        if (!empty($getdropdownValue->value)) {
            if (strpos(strtolower($getdropdownValue->value), strtolower($needle)) !== false || strpos(strtolower($needle), strtolower($getdropdownValue->value)) !== false) {
                return $getdropdownKey;
            } else {
                $return = '';
            }
        } else {
            $return = '';
        }
    }

    return $return;
}
