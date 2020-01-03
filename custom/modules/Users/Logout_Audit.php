<?php

    if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
    date_default_timezone_set('UTC');
    class logout_audit_class
    {
        function after_logout_method($bean, $event, $arguments)
        {
        	
			 global $db, $app_list_strings,$current_user;
				
			$user_id = $current_user->id;
			
			//Updating Users once login to the system
			$query="UPDATE users_cstm SET login_flag_c='0' WHERE id_c='$user_id'";
			$result=$db->query($query);
			$GLOBALS['log']->fatal($result."after_logout");
			//Remote IP Address
			$ip = getenv("REMOTE_ADDR");
			
			$todaydate = gmdate('Y-m-d');
			
			//Checking whether its first time login?
			$user_login_details = "SELECT scrm_login_audit.id,scrm_login_audit.name FROM scrm_login_audit INNER JOIN users_scrm_login_audit_2_c ON scrm_login_audit.id=users_scrm_login_audit_2_c.users_scrm_login_audit_2scrm_login_audit_idb WHERE users_scrm_login_audit_2users_ida='$user_id' AND date_entered LIKE '$todaydate%' AND scrm_login_audit.deleted='0' AND users_scrm_login_audit_2_c.deleted='0'";
			$login_result = $db->query($user_login_details);
			$login_row = $db->fetchByAssoc($login_result);
			$login_id = $login_row['id'];
			$login_name = $login_row['name'];
			if(!empty($login_id)){
				//retrieving last histroy login id
				$last_login_history = "select scrm_login_history.id,scrm_login_history_cstm.login_time_c from scrm_login_history,scrm_login_audit_scrm_login_history_1_c,scrm_login_history_cstm where scrm_login_audit_scrm_login_history_1_c.scrm_login_audit_scrm_login_history_1scrm_login_audit_ida='$login_id' and scrm_login_audit_scrm_login_history_1_c.scrm_login_audit_scrm_login_history_1scrm_login_history_idb =scrm_login_history.id and scrm_login_history.id=scrm_login_history_cstm.id_c order by scrm_login_history.date_modified DESC LIMIT 1 ";
				$last_login_result = $db->query($last_login_history);
				$last_login_history_row = $db->fetchByAssoc($last_login_result);
				$last_login_history_id = $last_login_history_row['id'];
				$last_login_history_time = $last_login_history_row['login_time_c'];				
				$logoff_time= gmdate('Y-m-d H:i:s');
				
				//time difference
				$login_strttime=strtotime($last_login_history_time);
				$logoff_strtime=strtotime($logoff_time);
				$diff = $logoff_strtime - $login_strttime;
				$time_diff=abs($diff);
				$actual_diff=date('H:i:s',$time_diff);
				
				//updating logoff time
				$logout_time = "UPDATE scrm_login_history,scrm_login_history_cstm,scrm_login_audit_scrm_login_history_1_c SET scrm_login_history_cstm.logoff_time_c='$logoff_time',scrm_login_history_cstm.total_login_time_c='$actual_diff'  where scrm_login_audit_scrm_login_history_1_c.scrm_login_audit_scrm_login_history_1scrm_login_history_idb = '$last_login_history_id' and scrm_login_history.id=scrm_login_history_cstm.id_c and scrm_login_audit_scrm_login_history_1_c.scrm_login_audit_scrm_login_history_1scrm_login_history_idb = scrm_login_history.id";
				$logout_result = $db->query($logout_time);
				//~ $GLOBALS['log']->fatal($logout_time);
				
				
				//getting parent id and updating total time and total login attempts
				$login_history_ids = "select scrm_login_history.id from scrm_login_history,scrm_login_audit_scrm_login_history_1_c where scrm_login_audit_scrm_login_history_1_c.scrm_login_audit_scrm_login_history_1scrm_login_audit_ida='$login_id' and scrm_login_audit_scrm_login_history_1_c.scrm_login_audit_scrm_login_history_1scrm_login_history_idb =scrm_login_history.id"; 
				$result_login_history_ids = $db->query($login_history_ids);
				while($row_login_history_ids=$db->fetchByAssoc($result_login_history_ids)){
				$history_id=$row_login_history_ids['id'];
				$query_totaltime="SELECT total_login_time_c FROM scrm_login_history_cstm WHERE id_c='$history_id'";
				$result_totaltime=$db->query($query_totaltime);
				$row_totaltime=$db->fetchByAssoc($result_totaltime);
				//$GLOBALS['log']->fatal("total time is ".$totaltime);
				$totaltime+=strtotime($row_totaltime['total_login_time_c']);
			}
				$totaltime_loggedin=date('H:i:s',$totaltime);
				//~ $GLOBALS['log']->fatal("total time is ".$totaltime_loggedin);
				$query_update_loggedintime="UPDATE scrm_login_audit_cstm SET total_logged_in_time_c='$totaltime_loggedin' WHERE id_c='$login_id'";
				$result_update_loggedintime=$db->query($query_update_loggedintime);
		}else{
			
			}		
				
		}
	}
?>
