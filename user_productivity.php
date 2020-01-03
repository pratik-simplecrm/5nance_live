<?php
if(!define('sugarEntry')) define('sugarEntry', true);
require_once('include/entryPoint.php');
global $db;
$today = gmdate('Y-m-d');
$fetch_contacts_data = $db->query("SELECT count( c.id ) AS count, c.assigned_user_id, cc.user_allocation_date_c
FROM contacts c
JOIN contacts_cstm cc ON cc.id_c = c.id
WHERE c.deleted =0
AND date( cc.user_allocation_date_c ) = '$today'
GROUP BY assigned_user_id");

$assigned_array = array();
$r = 0;
while($result_contact_data = $db->fetchByAssoc($fetch_contacts_data)){
	 $assigned_array[$result_contact_data['assigned_user_id']][date('Y-m-d',strtotime($result_contact_data['user_allocation_date_c']))]['allocated_count'] = $result_contact_data['count'];
	$r++;
}
//echo $r;
$fetch_modified_data = "SELECT COUNT( c.id ) AS count, c.assigned_user_id, c.date_modified
FROM contacts c
JOIN contacts_cstm cc ON cc.id_c = c.id
WHERE c.deleted =0
AND DATE( c.date_modified ) =  '$today' AND DATE(cc.user_allocation_date_c) = '$today'
AND cc.disposition_c <>  ''
GROUP BY assigned_user_id";
$result_modified_data = $db->query($fetch_modified_data);
while($row_modified_data = $db->fetchByAssoc($result_modified_data)){
	$assigned_array[$row_modified_data['assigned_user_id']][date('Y-m-d',strtotime($row_modified_data['date_modified']))]['modified_count'] = $row_modified_data['count'];
	$r++;
}
foreach($assigned_array as $id=>$value){
	foreach($value as $date=>$count){
		$not_modified = $count['allocated_count'] - $count['modified_count'];
		$modified = $count['modified_count'];
		if(empty($modified)){
			$modified = '0';
		}
		//modified by pratik on 28112019 if value is blank default will be 0 not blank
		//$allocated = $count['allocated_count'];
		 $allocated = (is_int($count['allocated_count'])?$count['allocated_count']:0);
		// end 
		
		$fetch_user_data = "select id from scrm_user_assignment_rule where assigned_user_id='$id' and allocated_date='$date' and deleted=0";
		$result_user_data = $db->query($fetch_user_data);
		$row_user_data = $db->fetchByAssoc($result_user_data);
		$user_assignment_id = $row_user_data['id'];
		if(!empty($user_assignment_id)){
			$db->query("UPDATE scrm_user_assignment_rule set assigned_count='$allocated',modified_count='$modified',not_modfied_count='$not_modified' where id='$user_assignment_id' and deleted=0");
		}else{
		$db->query("INSERT INTO `scrm_user_assignment_rule`(`id`, `name`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `description`, `deleted`, `assigned_user_id`,`allocated_date`, `assigned_count`, `modified_count`, `not_modfied_count`) VALUES (UUID(),'$date - $allocated',now(),now(),1,1,'',0,'$id','$date','$allocated','$modified','$not_modified')");
	}
		
	}
}
echo '<pre>';
print_r($assigned_array);exit;
?>
