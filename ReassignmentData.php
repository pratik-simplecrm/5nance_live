<?php
if (!define('sugarEntry'))
    define('sugarEntry', true);
require_once('include/entryPoint.php');
require_once('config.php');
ini_set('display_errors','On');
ReassignmentData();
function ReassignmentData(){
	global $db, $app_list_strings,$sugar_config;
	$target = $sugar_config['users_assignment_target']; 		
	//If the Agent is failed to meet Target, Re Assign users back to Poorti
	//$db->query("UPDATE contacts c JOIN contacts_cstm cc ON cc.id_c = c.id SET c.assigned_user_id =  '68ec618f-d98b-8f63-e0ad-584e574eabc7' WHERE c.assigned_user_id <>  '68ec618f-d98b-8f63-e0ad-584e574eabc7' AND cc.sales_stage_c =  'User' AND cc.disposition_c =  '' AND c.deleted =0 AND cc.gateway_c!='Corporate Channel'");					
	//Handle Holidays list and Saturday and Sunday
	$date1            = strtotime(date("Y-m-d"));
	$day              = date("D");
	$holiday_query    = "select holiday_date from scrm_holidays_list where deleted = 0 order by holiday_date";
	$holiday_result   = $db->query($holiday_query);
	
	$holiday_calender = array();
	while ($holiday_row = $db->fetchByAssoc($holiday_result)) {
		$holiday_date       = $holiday_row['holiday_date'];
		$holiday_calender[] = strtotime($holiday_date);
	}	
	if ($day == 'Sat' || $day == 'Sun') {
		return true;
	}
	//End Holiday list caculation
	/*********************fetch the contacts data which are assigned to Poorti**************************/
	$fetch_contacts_data = $db->query("select contacts.id,contacts_cstm.gateway_c from contacts join contacts_cstm on contacts.id=contacts_cstm.id_c where contacts.assigned_user_id='68ec618f-d98b-8f63-e0ad-584e574eabc7' and contacts.created_by='1' and contacts_cstm.gateway_c!='' and contacts_cstm.gateway_c!='Corporate Channel' and contacts.deleted=0 order by date_entered desc");
	while($result_contacts_data = $db->fetchByAssoc($fetch_contacts_data)){
		 $contact_id = $result_contacts_data['id'];
		 $contact_gateway = $result_contacts_data['gateway_c'];
		 $query = "SELECT su.user_id FROM securitygroups sg JOIN securitygroups_users su ON su.securitygroup_id = sg.id JOIN users u ON su.user_id=u.id JOIN users_cstm uc ON u.id=uc.id_c AND su.deleted =0 WHERE sg.name = '$contact_gateway' AND sg.deleted =0 AND su.deleted=0 AND u.deleted=0 AND uc.gateway_assigned_c='1' AND u.status='Active'";
		 $result = $db->query($query);		
		 $users_count = $result->num_rows;
		 if($users_count > 0){
			$assigned_array = array();
			while($users_row = $db->fetchByAssoc($result)){
				$assigned_array[] = $users_row['user_id'];
			} 
			$today = gmdate('Y-m-d');
			$assigned_user_count = array();
			$assigned_user_contacts_count = array();
			for($i=0;$i<sizeof($assigned_array);$i++){
				$records_query = "SELECT count(c.id) as count FROM contacts c LEFT JOIN contacts_cstm cc ON c.id = cc.id_c	WHERE  cc.sales_stage_c	IN ('User', 'Suspect', 'Prospect', 'Hot Prospect') AND c.deleted =0 AND c.assigned_user_id = '".$assigned_array[$i]."' AND date(cc.user_allocation_date_c)='$today'";	
			//	$GLOBALS['log']->fatal($records_query);
				$records_result = $db->query($records_query);
				$row_records_result = $db->fetchByAssoc($records_result);
				//$assigned_user_contacts_count[$row_records_result['assigned_user_id']] = $row_records_result['count'];
				$assigned_user_count[] = $row_records_result['count'];
				$assigned_user_contacts_count[$row_records_result['count']] = $assigned_array[$i];
			}
			//$GLOBALS['log']->fatal(print_r($assigned_user_contacts_count,true)."user assignment testing");
			$get_least_count = min($assigned_user_count);
			if($get_least_count < $target){
				$assigned_user_id = $assigned_user_contacts_count[$get_least_count];
				if(empty($assigned_user_id)){
					$assigned_user_id=$assigned_array[array_rand($assigned_array)];
				}
				$user_allocation_date_c = date("Y-m-d H:i:s");
		
				//echo $user_allocation_date_c = date("Y-m-d H:i:s", strtotime("+5 hours, +30 minutes", strtotime($user_allocation_date_c)));
				$db->query("update contacts join contacts_cstm on contacts.id=contacts_cstm.id_c set contacts.assigned_user_id='$assigned_user_id',contacts_cstm.user_allocation_date_c='$user_allocation_date_c' where contacts.id='$contact_id' and contacts.deleted=0");
				
				$db->query("update contacts join contacts_cstm on contacts.id=contacts_cstm.id_c set contacts_cstm.allocated_time_c='$user_allocation_date_c' where contacts.id='$contact_id' and contacts.deleted=0 and contacts_cstm.allocated_time_c IS NULL");
				
				
				$gateway = $GLOBALS['app_list_strings']['gateway_list'][$result_contacts_data['gateway_c']];
				/***********fetch securitygroup id from securitygroups*******************/
				$fetch_group_id = $db->query("select id from securitygroups where deleted=0 and name='$gateway'");
				$row_group_id = $db->fetchByAssoc($fetch_group_id);
				$group_id = $row_group_id['id'];
			
				/***************adding group to contacts**************/
				$add_groups = "insert into securitygroups_records(id,securitygroup_id,record_id,module,date_modified,deleted) values( UUID(),'$group_id','$contact_id','Contacts',NOW(),0)";
				$db->query($add_groups);
			}else{
				$db->query("UPDATE contacts c  SET c.assigned_user_id =  '68ec618f-d98b-8f63-e0ad-584e574eabc7' WHERE  c.deleted =0 AND c.id='$contact_id' and c.assigned_user_id <>  '68ec618f-d98b-8f63-e0ad-584e574eabc7' ");
			}
		}
		

				//exit; 
		}
		return true; 
}

