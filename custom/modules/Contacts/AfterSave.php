<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
//ini_set('display_errors','On');
class AfterSave {
	public function createDespositionCall($bean, $event, $arguments) {
		global $db;
                
                
//                  $contactaftersaveLogFile = 'WebsiteAPILogs/productassigneduser.txt';
//    $contactHandle = fopen($contactaftersaveLogFile, 'a');
//    $timestamp = date('Y-m-d H:i:s', strtotime('+5 hours +30 minutes', strtotime('now')));
//    $status = "Contact After Save Logic Hook!";
//    $logMessage = "\n\nContact Creation Result at $timestamp :- $status";
//    fwrite($contactHandle, $logMessage);
		$old_disposition = $bean->fetched_row['disposition_c'];
		$actual_disposition =  $bean->disposition_c;
		
		$planning_date_old = $bean->fetched_row['next_call_planning_date_c'];
		$planning_date = $bean->next_call_planning_date_c;
		
		$planning_comments = $bean->next_call_planning_comments_c;
        array_push($GLOBALS['app_list_strings']['next_call_planning_comment_list'],"Converted to Customer");
		$callOptions = $GLOBALS['app_list_strings']['next_call_planning_comment_list'];
//         $GLOBALS['log']->fatal("Bean Id: ".$bean->id." Mobile No :" . $bean->phone_mobile);
//        $GLOBALS['log']->fatal("Old Disposition :" . $old_disposition);
//        $GLOBALS['log']->fatal("Actual Disposition :" . $actual_disposition);
//        $GLOBALS['log']->fatal("Next Planning Date :" . $planning_date_old);
//        $GLOBALS['log']->fatal("Actual Planning Date :" . $planning_date);
//        $GLOBALS['log']->fatal("Planning Comments :" . $planning_comments);
//        $GLOBALS['log']->fatal("Call Options :" . print_r($callOptions,true));

//                $get_assingedUser=array('ID'=>$bean->id,'Name'=>$bean->name,'Customer Code'=>$bean->unique_customer_code_c,'Mobile No'=>$bean->phone_mobile,'Date Entered'=>$bean->fetched_row['date_entered'],'Date Modified'=>$bean->fetched_row['date_modified'],'Modified by name'=>$bean->modified_by_name,'Created by Name'=>$bean->created_by_name,'Old Assigned User Id'=>$bean->assigned_user_id,'Old Assigned User Name'=>$bean->assigned_user_name,'New Assigned User Id'=>$bean->fetched_row['assigned_user_id'],'Custom Date Modified'=>$bean->custom_date_modified_c,'Product Interes'=>$bean->product_interest_c,'User Allocation Date'=>$bean->fetched_row['user_allocation_date_c']);
//               
//	 $logArray = print_r($get_assingedUser, true);
//    $logMessage = "\n\n Result at $timestamp :-\n$logArray";
//    fwrite($contactHandle, $logMessage);	
		if(((strcmp($old_disposition, $actual_disposition) != 0) && in_array($actual_disposition, $callOptions)) || (in_array($actual_disposition, $callOptions) && strtotime($planning_date) != strtotime($planning_date_old))) {
			$call = new Call();
			$call->name = $actual_disposition;
			$call->description = $planning_comments;
			$call->direction = "Outbound";
			$call->date_start = $planning_date; 
			$call->parent_type = "Contacts";   
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
			$bean->load_relationship('calls');
			$bean->calls->add($call->id);
			$assigned_user = $bean->assigned_user_id;
			$insert_query = "INSERT INTO  calls_users (id,call_id, user_id, date_modified, deleted) VALUES (UUID(),'$call_id','$assigned_user',now(),0)"; 
			$insert_result = $db->query($insert_query);    
		}	
	}
}

?>
