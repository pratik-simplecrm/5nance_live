<?php
//availiability_status_c, AND (date(cc.user_allocation_date_c ) = '$today' OR disposition_c = ''), 
if (!define('sugarEntry'))
    define('sugarEntry', true);
require_once('include/entryPoint.php');
require_once('config.php');
ini_set('display_errors','On');
date_default_timezone_set('UTC');
exit;
ReassignmentData();
function ReassignmentData(){
     $schedulerLogFile = 'WebsiteAPILogs/reassignmentdata.txt';
    $schedulerHandle = fopen($schedulerLogFile, 'a');
    $timestamp = date('Y-m-d H:i:s', strtotime('+5 hours +30 minutes', strtotime('now')));
    $status = "CRON Run Successful! - ReassignmentData";
    $logMessage = "\n\nScheduler Result at $timestamp :- $status";
    fwrite($schedulerHandle, $logMessage);
	global $db, $app_list_strings,$sugar_config;
	date_default_timezone_set('UTC');
	$target = $sugar_config['users_assignment_target']; 
				
	//Handle Holidays list and Saturday and Sunday
	$date1            = date("Y-m-d");
	$time1            = date("H:i:s");
	//$yesterday        = date("Y-m-d", strtotime('yesterday'));
	 //If day equal monday then need to check from firday - Roshan Sarode
    $timestamp = time();
    if (date('D', $timestamp) === 'Mon') {
        $friday = strtotime('last Friday');
        $yesterday = date("Y-m-d", date('W', $friday) == date('W') ? $friday - 7 * 86400 : $friday);
    } else {
        $yesterday = date("Y-m-d", strtotime('yesterday'));
    }
	$day              = date("D");
	$holiday_query    = "select holiday_date from scrm_holidays_list where deleted = 0 order by holiday_date Desc";
	$holiday_result   = $db->query($holiday_query);
	
	$holiday_calender = array();
	while ($holiday_row = $db->fetchByAssoc($holiday_result)) {
		$holiday_date       = $holiday_row['holiday_date'];
		$holiday_calender[] = strtotime($holiday_date);
		$holiday = date("Y-m-d",strtotime($holiday_date));
		          if($holiday == $date1)
		          {
					  $is_holiday = true;
				  }
	}
	//~ if($time1 < date("H:i:s",strtotime("10:00:00")) || $time1 > date("H:i:s",strtotime("18:30:00")))	{
			   //~ $not_working = true;
	//~ }	
	if ($is_holiday || $day == 'Sat' || $day == 'Sun' ) {
		     return true;
	 }
	
		
	//End Holiday list caculation
		/*******************fetch the contact ids & respective gateway which are assigned to Dharmesh*******************/
	$fetch_contacts_data = $db->query("select contacts.id,contacts_cstm.gateway_c,contacts_cstm.product_interest_c from contacts join contacts_cstm on contacts.id=contacts_cstm.id_c where contacts.assigned_user_id='f084f5af-6e63-6490-371e-59ad17d73b2a' and contacts.date_entered>='$yesterday 13:00:00' AND contacts.date_entered <='$date1 04:29:59' and contacts.created_by='1' and contacts_cstm.gateway_c!='' and contacts_cstm.gateway_c NOT IN ('Corporate Channel','CSC- M.P Online','Offline Marketing') and contacts.deleted=0 order by date_entered desc");
	
	//$fetch_contacts_data = $db->query("select contacts.id,contacts_cstm.gateway_c from contacts join contacts_cstm on contacts.id=contacts_cstm.id_c where contacts.id='a8498467-6539-4ec5-306b-586c9aa7a5c9' and contacts.deleted=0 ");
	//$fetch_contacts_data = $db->query("select contacts.id,contacts_cstm.gateway_c from contacts join contacts_cstm on contacts.id=contacts_cstm.id_c where contacts.assigned_user_id='68ec618f-d98b-8f63-e0ad-584e574eabc7' and contacts.date_entered>='$yesterday 13:00:00' AND contacts.date_entered <='$date1 04:29:59' and contacts.created_by='1' and contacts_cstm.gateway_c!='' and contacts_cstm.gateway_c NOT IN ('Corporate Channel','CSC- M.P Online') and contacts.deleted=0 order by date_entered desc");
	while($result_contacts_data = $db->fetchByAssoc($fetch_contacts_data)){
		 $contact_id = $result_contacts_data['id'];
		 $contact_gateway = $result_contacts_data['gateway_c'];
                  $pro_interest = $result_contacts_data['product_interest_c']; 
		  $query = "SELECT distinct(su.user_id) FROM securitygroups sg JOIN securitygroups_users su ON su.securitygroup_id = sg.id JOIN users u ON su.user_id=u.id JOIN users_cstm uc ON u.id=uc.id_c JOIN acl_roles_users aru on aru.user_id=u.id and aru.deleted=0 WHERE sg.name = '$contact_gateway' AND u.status='Active' AND uc.availability_status_c='Available' AND sg.deleted =0 AND su.deleted=0 AND u.deleted=0 and aru.role_id='a8ab8653-5860-d896-7a78-58466a429bee'";
		 $result = $db->query($query);		
		 $users_count = $result->num_rows;
		 if($users_count > 0){
                            if (!empty($pro_interest)) {
                $product_assignment_query = "select * from assign_products where product_name='" . $pro_interest . "'";
                $product_assignment_result = $db->query($product_assignment_query);
                $row_products_result = $db->fetchByAssoc($product_assignment_result);
                $guid = unserialize(base64_decode($row_products_result['users_id']));

                $allusers = array();
                foreach ($guid as $uid) {
                    $allusers[] = $uid;
                }
             
                $logArray = print_r($allusers, true);
                $logMessage = "\n\nAll Users of product wise assignement for product $pro_interest at $timestamp :-\n$logArray";
                fwrite($schedulerHandle, $logMessage);
              
            }
            //Product wise assignment changes by Roshan Sarode dt. 22-6-18 end
			$assigned_array = array();
            if (!empty($allusers)) {
                        $assigned_array = $allusers;
                } else {
            while ($users_row = $db->fetchByAssoc($result)) {
                //Product wise assignment changes by Roshan Sarode dt. 22-6-18 start
				$assigned_array[] = $users_row['user_id'];
                //Product wise assignment changes by Roshan Sarode dt. 22-6-18 end
			} 
        }
            $logArray = print_r($assigned_array, true);
            $logMessage = "\n\nProduct assigned Array at $timestamp :-\n$logArray";
            fwrite($schedulerHandle, $logMessage);
            $today = gmdate('Y-m-d');
			$assigned_user_count = array();
			$assigned_user_contacts_count = array();
			for($i=0;$i<sizeof($assigned_array);$i++){
				//select count of contacts assigned to each user_id 
				$records_query = "SELECT count(c.id) as count FROM contacts c LEFT JOIN contacts_cstm cc ON c.id = cc.id_c	WHERE  c.deleted =0 AND c.assigned_user_id = '".$assigned_array[$i]."' AND (date(cc.user_allocation_date_c) = '$today' OR disposition_c = '')";	
			//	$GLOBALS['log']->fatal($records_query);
				$records_result = $db->query($records_query);
				$row_records_result = $db->fetchByAssoc($records_result);
				//$assigned_user_contacts_count[$row_records_result['assigned_user_id']] = $row_records_result['count'];
				$assigned_user_count[] = $row_records_result['count'];
				$assigned_user_contacts_count[$row_records_result['count']] = $assigned_array[$i];
			}
			// exit;
			//$GLOBALS['log']->fatal(print_r($assigned_user_contacts_count,true)."user assignment testing");
			$get_least_count = min($assigned_user_count);
			if($get_least_count < $target){
				$assigned_user_id = $assigned_user_contacts_count[$get_least_count];
				if(empty($assigned_user_id)){
					$assigned_user_id=$assigned_array[array_rand($assigned_array)];
				}
				
		        //$user_allocation_date_c = date("Y-m-d H:i:s", strtotime("-5 hours, -30 minutes"));
		        $user_allocation_date_c = date("Y-m-d H:i:s");
				//$user_allocation_date_c = date("Y-m-d H:i:s", strtotime("+5 hours, +30 minutes", strtotime($user_allocation_date_c))); 
				//$db->query("update contacts join contacts_cstm on contacts.id=contacts_cstm.id_c set contacts.assigned_user_id='$assigned_user_id',contacts_cstm.user_allocation_date_c='$user_allocation_date_c' where contacts.id='$contact_id' and contacts.deleted=0");
				$contact  = BeanFactory::getBean('Contacts', $contact_id);
				$contact->assigned_user_id = $assigned_user_id;
				$contact->user_allocation_date_c = $user_allocation_date_c;
				$contact->do_not_run_logic_hook_c = true;
				$contact->save();
 $logArray = print_r($contact->assigned_user_id, true);
                $logMessage = "\n\nContact assigned to at $timestamp :-\n$logArray";
                fwrite($schedulerHandle, $logMessage);				
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
				$query_user = $db->query("select id from users where user_name='Dharmesh' and deleted=0");
				$result_user = $db->fetchByAssoc($query_user);
				$assigned_user_id = $result_user['id'];
				$db->query("UPDATE contacts c  SET c.assigned_user_id =  '$assigned_user_id' WHERE  c.deleted =0 AND c.id='$contact_id' ");
			}
		}
		else{
				$query_user = $db->query("select id from users where user_name='Dharmesh' and deleted=0");
				$result_user = $db->fetchByAssoc($query_user);
			    $assigned_user_id = $result_user['id'];
                $db->query("UPDATE contacts c  SET c.assigned_user_id =  '$assigned_user_id' WHERE  c.deleted =0 AND c.id='$contact_id' ");
				//exit; 
		}
	}
		return true; 

}?>
