<?php
//ini_set("display_errors", "on");

 if (!define('sugarEntry'))define('sugarEntry', true);
       require_once('include/entryPoint.php');
        global $db, $sugar_config;

    $agent_number = $_REQUEST['caller_number'];
    $GLOBALS['log']->fatal('call routing start'. $agent_number);

    //$request_array = array();
    $r=0;
    //Check for Contact 
    
    $query = "select users.user_name from users join users_cstm on users.id = users_cstm.id_c join contacts c on users_cstm.id_c = c.assigned_user_id where (c.phone_home = '$agent_number' or c.phone_mobile = '$agent_number' or c.phone_work = '$agent_number' or c.phone_other = '$agent_number') and c.deleted = 0 and users.deleted=0 and users.status ='Active'";

    $result =$db->query($query);
    $row=$db->fetchByAssoc($result);
    $routeusername = (!empty($row['user_name']))?$row['user_name']:' ';
    $response ='<user_id>'.$routeusername.'</user_id>';

    if(empty($row['user_name'])){
	
	//Check for Leads	
	$query = "select users.user_name from users join users_cstm on users.id = users_cstm.id_c join leads l on users_cstm.id_c = l.assigned_user_id where (l.phone_home = '$agent_number' or l.phone_mobile = '$agent_number' or l.phone_work = '$agent_number' or l.phone_other = '$agent_number') and l.deleted = 0 and users.deleted=0 and users.status ='Active'";

    $result =$db->query($query);
    $row=$db->fetchByAssoc($result);
    $routeusername = (!empty($row['user_name']))?$row['user_name']:' ';	
    $response ='<user_id>'.$routeusername.'</user_id>';
	}else{
		//Do Nothing Check the security group
		}
	
	
	$team_name="AND ((s.name='Corporate Customer Agent')||(s.name='Corporate Channel'))";
	//Check for Corporate Customer Agent
	$query = "SELECT u.user_name as user_name FROM users u JOIN securitygroups_users su ON u.id = su.user_id JOIN securitygroups s ON s.id = su.securitygroup_id WHERE s.deleted =0 AND u.deleted =0 AND u.status =  'Active' AND su.deleted =0 $team_name";
    $result =$db->query($query);
    //~ $row=$db->fetchByAssoc($result);
    while($row=$db->fetchByAssoc($result)){
		    $routeusername = (!empty($row['user_name']))?$row['user_name']:' ';	
			$r++;
			$response.='<user_id'.$r.'>'.$routeusername.'</user_id'.$r.'>';		
		}
   //Check for username
		echo "<response>$response</response>" ;
                    $GLOBALS['log']->fatal('<response>'.$response.'</response>');
                        $GLOBALS['log']->fatal('call routing end');


 exit;
	
?>
