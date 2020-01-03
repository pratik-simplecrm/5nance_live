<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
//ini_set('display_errors','On');
class AfterSaveProducts{
	public function createDespositionCall($bean, $event, $arguments) {
		global $db, $app_list_strings;
		$old_disposition = $bean->fetched_row['disposition_c'];
		$actual_disposition =  $bean->disposition_c;
             
		
		$planning_date_old = $bean->fetched_row['next_call_planning_date_c'];
		$planning_date = $bean->next_call_planning_date_c;
		
		$planning_comments = $bean->next_call_planning_comments_c;
		 $callOptions = $GLOBALS['app_list_strings']['next_call_planning_comment_list'];
		
		if(((strcmp($old_disposition, $actual_disposition) != 0) && in_array($actual_disposition, $callOptions)) || (in_array($actual_disposition, $callOptions) && strtotime($planning_date) != strtotime($planning_date_old))) {
			$call = new Call();
			$call->name = $actual_disposition;
			$call->description = $planning_comments;
			$call->direction = "Outbound";
			$call->date_start = $planning_date; 			
                        $call->date_end = $planning_date; 
			$call->parent_type = "scrm_Products";   
			$call->parent_id =$bean->id;   
			$call->reminder_time  = "600";
			$call->email_reminder_time  = "600";
			$call->duration_minutes   = "15";					
			$call->status   = "Planned";		
                        $call->product_interest_c   = $bean->product_interest_c;		
			$call->assigned_user_id = $bean->assigned_user_id;   
			$call->assigned_user_name = $bean->assigned_user_name;					
			$call->created_by_link = $bean->assigned_user_id;
			$call_id = $call->save(); 
                        
			$bean->load_relationship('scrm_products_activities_1_calls');
          		$bean->scrm_products_activities_1_calls->add($call->id);
                       
//                        $insert_query_relationship = "INSERT INTO scrm_products_calls_1_c (id,date_modified, deleted, scrm_products_calls_1scrm_products_ida, scrm_products_calls_1calls_idb) VALUES (UUID(),now(),0,'$bean->contacts_scrm_products_1contacts_ida','$call_id')"; 
//			$insert_result_relationship = $db->query($insert_query_relationship);   
//                        
                       
			$assigned_user = $bean->assigned_user_id;
			$insert_query = "INSERT INTO calls_users (id,call_id, user_id, date_modified, deleted) VALUES (UUID(),'$call_id','$assigned_user',now(),0)"; 
			$insert_result = $db->query($insert_query);    
                     
                        
		}	 
           
	}
}

?>
