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
$userID    = $rawData->userID;
$priority  = $rawData->priority;
$dropStage = $rawData->dropStage;

//TO Maintain Log
$data11 = array(
    'userID' => $userID,
    'priority' => $priority,
    'dropStage' => $dropStage
);
$myfile = fopen("CallOnPriorityLog.txt", "a");
fwrite($myfile, date('Y-m-d H:i:s'));
fwrite($myfile, print_r($data11, true));
fwrite($myfile, '---------------------');
$contactId = '';

// Check User Id exist or not in DB
$sql    = "select cc.id_c from contacts_cstm cc join contacts c on c.id = cc.id_c where cc.unique_customer_code_c = " . $userID;
$result = $db->query($sql);
while ($row = $db->fetchByAssoc($result)) {
    $contactId = $row['id_c'];
}

// if contactID and UserID is not null/blank then if block exceuted otherwise else block will be executed
if ($contactId != '' && $userID != '') {
    //Update contact priority and drop stage query
    $query1  = "UPDATE `contacts_cstm` SET `contact_priority_c`='$priority',`drop_stage1_c`='$dropStage' WHERE `id_c`='$contactId'";
    $result1 = $db->query($query1);
    if ($result1) {
        response($userID, $priority, $dropStage, $contactId, $myfile);
        
    }
} else {
    $msg = array(
        'Success' => false,
        'Message' => 'Invalid Customer Record -> Customer ID not found in record'
    );
    echo json_encode($msg);
}

function response($userID, $priority, $dropStage, $contactId, $myfile)
{
    //maintaining the log
    $set_entry_parameters = array(
        'UserID' => $userID,
        'priority' => $priority,
        'drop_stage1_c' => $dropStage,
        'id_c' => $contactId
    );
    fwrite($myfile, print_r($set_entry_parameters, true));
    fclose($myfile);
    $msg = array(
        'Success' => true,
        'Message' => 'Record Updated Successfully'
    );
    echo json_encode($msg);
}
?> 