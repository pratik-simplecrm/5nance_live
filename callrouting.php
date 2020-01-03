<?php

 if (!define('sugarEntry'))define('sugarEntry', true);
       require_once('include/entryPoint.php');
//ini_set('display_errors','On');
        global $db, $sugar_config;
    
    $agent_number = $_REQUEST['caller_number'];
    //$request_array = array();
    
    $query = "select users.user_name from users join users_cstm on users.id = users_cstm.id_c join contacts c on users_cstm.id_c = c.assigned_user_id where (c.phone_home = '$agent_number' or c.phone_mobile = '$agent_number' or c.phone_work = '$agent_number' or c.phone_other = '$agent_number') and c.deleted = 0 and users.deleted=0 and users.status ='Active'";

    $result =$db->query($query);
    $row=$db->fetchByAssoc($result);
    $routeusername = (!empty($row['user_name']))?$row['user_name']:' ';
    echo "<response><user_id>$routeusername</user_id></response>" ; exit;
	
?>
