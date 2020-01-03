<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
	$contact_id  = $_REQUEST['contact_id'];
	global $db;
	$data = array();
	/*************fetch contact details***************/
	$fetch_contact_data = $db->query("select phone_mobile from contacts where id='$contact_id' and deleted=0");
	$result_contact_data = $db->fetchByAssoc($fetch_contact_data);
	$phone_mobile = $result_contact_data['phone_mobile'];
	$data['phone_mobile']=$phone_mobile;
	/**************fetch Email Address******************/
	$fetch_email_address = $db->query("select email_address from email_addresses as ea join email_addr_bean_rel as eabr on ea.id=eabr.email_address_id and eabr.deleted=0 where eabr.bean_id='$contact_id' and bean_module='Contacts'");
	$result_email_address = $db->fetchByAssoc($fetch_email_address);
	$email_address = $result_email_address['email_address'];
	$data['email_address'] = $email_address;
	echo json_encode($data);
	
	
?>
