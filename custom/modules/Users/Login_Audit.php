<?php

    if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
   
    class login_audit_class
    {
        function after_login_method($bean, $event, $arguments)
        {
			 global $db, $app_list_strings,$current_user;
			
			$user_id = $current_user->id;
			 if($user_id != '1'){
			$todayDate = date('Y-m-d');

			$checkLoggedinQuery = $db->query("select count(user_id) as count from users_audit_new where user_id = '$user_id' and logged_in_date = '$todayDate'");
			$checkLoggedinQueryrow = $db->fetchByAssoc($checkLoggedinQuery);
			$count = $checkLoggedinQueryrow['count'];

			if(empty($count)){
				$insertUserIDQuery = $db->query("insert into users_audit_new (user_id,logged_in_date) values ('$user_id','$todayDate')");
			}
			}
			
			
			
			//Updating Users once login to the system
			$query="UPDATE users_cstm SET login_flag_c='1' WHERE id_c='$user_id'";
			$result=$db->query($query);

			//Remote IP Address
			$ip = getenv("REMOTE_ADDR");
			if($ip !='192.168.1.108'){
			
			$todaydate = gmdate('Y-m-d');
			
			//Checking whether its first time login?
			$user_login_details = "SELECT scrm_login_audit.id,scrm_login_audit.name FROM scrm_login_audit INNER JOIN users_scrm_login_audit_2_c ON scrm_login_audit.id=users_scrm_login_audit_2_c.users_scrm_login_audit_2scrm_login_audit_idb WHERE users_scrm_login_audit_2users_ida='$user_id' AND date_entered LIKE '$todaydate%' AND scrm_login_audit.deleted='0' AND users_scrm_login_audit_2_c.deleted='0'";
			$login_result = $db->query($user_login_details);
			$login_row = $db->fetchByAssoc($login_result);
			$login_id = $login_row['id'];
			$login_name = $login_row['name'];
			if(empty($login_id)){
				//Creating Record in Login_Audit at very first time
				$tracker = new scrm_Login_Audit();
				$today = gmdate('d/m/Y');
				$tracker->name = $bean->name.' - '.$today;
				$tracker->users_sugar_id_c = $bean->user_name;
				$tracker->users_scrm_login_audit_2users_ida = $bean->id;
				$tracker->ip_address_c = $ip;				
				$tracker_id = $tracker->save();
				//Login History
				if($tracker->load_relationship('scrm_login_audit_scrm_login_history_1')){
				$login_history = new scrm_Login_History();
				$logged_in_time = gmdate('Y-m-d H:i:s');
				$login_history->login_time_c = $logged_in_time;
				$login_history->scrm_login_audit_scrm_login_history_1_name = $tracker->name;
				$login_history->scrm_login_audit_scrm_login_history_1scrm_login_audit_ida = $tracker_id;
				$login_history->ip_address_c = $ip;
				$login_history->save();
				$query_update_loggedintime="UPDATE scrm_login_audit_cstm SET logins_per_day_c='1' WHERE id_c='$tracker_id '";
				$result_update_loggedintime=$db->query($query_update_loggedintime);
			}
			}else{
				//Login History
				$login_history = new scrm_Login_History();
				$logged_in_time = gmdate('Y-m-d H:i:s');
				$login_history->login_time_c = $logged_in_time;
				$login_history->scrm_login_audit_scrm_login_history_1_name = $login_name;
				$login_history->scrm_login_audit_scrm_login_history_1scrm_login_audit_ida = $login_id;
				$login_history->ip_address_c = $ip;
				$login_history->save();
					
			}
			//total attempts per day
				$login_history_records_count= "select count(scrm_login_history.id) as count from scrm_login_history,scrm_login_audit_scrm_login_history_1_c where scrm_login_audit_scrm_login_history_1_c.scrm_login_audit_scrm_login_history_1scrm_login_audit_ida='$login_id' and scrm_login_audit_scrm_login_history_1_c.scrm_login_audit_scrm_login_history_1scrm_login_history_idb =scrm_login_history.id"; 
				$result_login_history_records_count = $db->query($login_history_records_count);
				$row_login_history_records_count = $db->fetchByAssoc($result_login_history_records_count);
				$total_attempts = $row_login_history_records_count['count'];
				$query_update_loggedintime="UPDATE scrm_login_audit_cstm SET logins_per_day_c='$total_attempts' WHERE id_c='$login_id'";
				$result_update_loggedintime=$db->query($query_update_loggedintime);
				//~ $GLOBALS['log']->fatal($login_history_records_count."Query for Login");
				//~ $GLOBALS['log']->fatal($total_attempts."Count for logins");
				//~ $GLOBALS['log']->fatal($query_update_loggedintime."UPDATE Query");
		}
			}
	}
?>
