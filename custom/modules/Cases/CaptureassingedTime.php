<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
class AssignedTime{
	
	function assignedtimemethod($bean, $event, $arguments){
		
		global $db;

		$assigned_time = $bean->assigned_time_c;
		$assigned_user = $bean->assigned_user_id;
		$assigned_user_name = $bean->assigned_user_name;
		$beanFetched = $bean->fetched_row;
		$oldassigned_user = $beanFetched['assigned_user_id'];
		$bean->assigned_time_c = $bean->date_modified;
		if(!empty($beanFetched)){
			if($oldassigned_user != $assigned_user){
				$db->query("update securitygroups_records set deleted=1 where record_id='".$bean->id."' and deleted=0");
				//if($assigned_time == ''){
					$bean->status = 'Open_Reassigned';
					$bean->ticket_counter_c = 0;
					if($bean->escalation_level_3_checkbox_c == 0){
						$bean->escalation_level_3_checkbox_c = 1;
						$bean->escalation_level_2_checkbox_c = 1;
						$bean->escalation_level_1_checkbox_c = 1;
					}else if($bean->escalation_level_2_checkbox_c == 0){
						$bean->escalation_level_2_checkbox_c = 1;
						$bean->escalation_level_1_checkbox_c = 1;
					}else if($bean->escalation_level_1_checkbox_c == 0){
						$bean->escalation_level_1_checkbox_c = 1;
					}
				//}
				
			}
		}
		
		if($bean->state == 'Closed'){
			$bean->resolution_date_c=$bean->date_modified;
		}
    }
}
?>
