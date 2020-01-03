<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
class followupcall_class {
	public function createFollowupCall($bean, $event, $arguments) {
		global $db, $app_list_strings;
		$old_disposition = $bean->fetched_row['disposition_c'];
		$actual_disposition =  $bean->disposition_c;
	
		$planning_date = $bean->next_call_planning_date_c;
		
		$planning_comments = $bean->next_call_planning_comment_c;


		//if((strcmp($old_disposition, $actual_disposition) != 0) && $actual_disposition == 'Assigned_Call_Back') {
		if((strcmp($old_disposition, $actual_disposition) != 0) && $bean->status == 'Followup') {
			$call = new Call();
			$call->name = $app_list_strings['disposition_c_list'][$actual_disposition];
			$call->description = $planning_comments;
			$call->direction = "Outbound";
			$call->date_start = $planning_date; 
			$call->parent_type = "Leads";   
			$call->parent_id =$bean->id;   
			$call->reminder_time  = "600";
			$call->email_reminder_time  = "600";
			$call->duration_minutes   = "15";					
			$call->status   = "Planned";		
			$call->assigned_user_id = $bean->assigned_user_id;   
			$call->assigned_user_name = $bean->assigned_user_name;					
			$call->created_by_link = $bean->assigned_user_id;
			$call_id = $call->save();
			$bean->load_relationship('calls');
			$bean->calls->add($call->id);
			$assigned_user = $bean->assigned_user_id;
			$insert_query = "INSERT INTO  calls_users (id,call_id, user_id, date_modified, deleted) VALUES (UUID(),'$call_id','$assigned_user',now(),0)"; 
			$insert_result = $db->query($insert_query);    
		}
		
		if(empty($bean->first_call_date_c)){
					$first_call_date_c = $bean->next_call_planning_date_c;
					$first_call_disposition_c = $GLOBALS['app_list_strings']['disposition_c_list'][$bean->disposition_c];
					$db->query("update leads_cstm set first_call_date_c='".$first_call_date_c."',first_call_disposition_c='".$first_call_disposition_c."' where id_c='".$bean->id."'");
			}else if(empty($bean->second_call_date_c)){
					$second_call_date_c = $bean->next_call_planning_date_c;
					$second_call_disposition_c = $GLOBALS['app_list_strings']['disposition_c_list'][$bean->disposition_c];
					$db->query("update leads_cstm set second_call_date_c='".$second_call_date_c."',second_call_disposition_c='".$second_call_disposition_c."' where id_c='".$bean->id."'");
			}else if(empty($bean->third_call_date_c)){
					$third_call_date_c = $bean->next_call_planning_date_c;
					$third_call_disposition_c = $GLOBALS['app_list_strings']['disposition_c_list'][$bean->disposition_c];
					$db->query("update leads_cstm set third_call_date_c='".$third_call_date_c."',third_call_disposition_c='".$third_call_disposition_c."' where id_c='".$bean->id."'");
			}

			if((!empty($bean->first_call_date_c)) && (!empty($bean->second_call_date_c)) && (!empty($bean->third_call_date_c)) ){
					$db->query("update leads join leads_cstm on id=id_c set status='Invalid',disposition_c='Invalid_Not_Interested' where id_c='".$bean->id."'");
			}
		}
}

?>
