<?php
session_start();
if (!defined('sugarEntry') || !sugarEntry)
    die('Not A Valid Entry Point');


global $db, $sugar_config, $current_user;
$url      = $sugar_config['webservice_url'];
$username = $sugar_config['webservice_username'];
$password = $sugar_config['webservice_password'];

$fp      = fopen('php://input', 'r');
$rawData = json_decode(stream_get_contents($fp));


//Input Parameters
$userID          = $rawData->userID;           
$sql    = "select id_c from contacts_cstm where unique_customer_code_c = " . $userID;

 $get_sales_stage_status = "Select `sales_stage_c` from contacts_cstm where id_c = '" . $contactId . "'";

 $msg           = array(
        'sales_stage' => $get_sales_stage_status
    );
    echo json_encode($msg);
 
?>    