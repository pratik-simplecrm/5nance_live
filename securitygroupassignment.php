<?php
if (!define('sugarEntry'))
    define('sugarEntry', true);
require_once('include/entryPoint.php');
require_once('config.php');
require_once('custom/include/language/en_us.lang.php');

global $db,$app_list_strings;

/****************fetch contacts********************/
$select_contacts_data = $db->query("select gateway_c,id from contacts join contacts_cstm on contacts.id=contacts_cstm.id_c where contacts.deleted=0 and contacts.assigned_user_id<>'68ec618f-d98b-8f63-e0ad-584e574eabc7' and !(contacts.id IN (select record_id from securitygroups_records where deleted=0 and module='Contacts'))");
while($row_contacts_data = $db->fetchByAssoc($select_contacts_data)){
	echo $gateway = $GLOBALS['app_list_strings']['gateway_list'][$row_contacts_data['gateway_c']];
	echo $contact_id = $row_contacts_data['id'];
	/***********fetch securitygroup id from securitygroups*******************/
	$fetch_group_id = $db->query("select id from securitygroups where deleted=0 and name='$gateway'");
	$row_group_id = $db->fetchByAssoc($fetch_group_id);
	echo $group_id = $row_group_id['id'];
	
	/***************adding group to contacts**************/
	$add_groups = "insert into securitygroups_records(id,securitygroup_id,record_id,module,date_modified,deleted) values( UUID(),'$group_id','$contact_id','Contacts',NOW(),0)";
	$db->query($add_groups);
	//exit;
	
}
