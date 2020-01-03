<?php

if (!defined('sugarEntry') || !sugarEntry)
	die('Not A Valid Entry Point');
require_once('include/entryPoint.php');
include_once('include/SugarPHPMailer.php');
include_once('include/utils/db_utils.php');
include('custom/include/language/en_us.lang.php');
/*
 * Author: Noresha Ankani
 * Purpose: Case to Contact Relation
 */

class CaseContact {

	function CaseContactRelation($bean, $event, $arguments) {
    	global $db, $current_user, $sugar_config;
    	//$GLOBALS['log']->fatal($bean->description."INBOUND EMAIL BEAN");
    	$text = strtolower($bean->description);
    	$schedulerLogFile = '/var/www/html/crm/WebsiteAPILogs/ticketcreation.txt';
    	$schedulerHandle = fopen($schedulerLogFile, 'a');
    	$timestamp = date('Y-m-d H:i:s', strtotime('+5 hours +30 minutes', strtotime('now')));

    	/*
      	foreach (explode(' ', $text) as $text) {
      	$patterns .= '"'.$text.'",';
      	}
      	$patterns = substr($patterns,0,-1);
      	$GLOBALS['log']->fatal($patterns."noresh tesst");
     	*/
    	/*     	* *************fetch email keywords******************** */
    	/*
      	$sql = '';
      	$count = 0;
      	foreach(explode(' ', $text) as $text)
      	{
      	if($count > 0)
      	$sql = $sql."UNION Select name,module_c,sub_module_c From scrm_email_keywords join scrm_email_keywords_cstm on scrm_email_keywords.id=scrm_email_keywords_cstm.id_c  WHERE deleted=0 and name LIKE '%$text%'";
      	else
      	$sql = $sql."Select name,module_c,sub_module_c From scrm_email_keywords join scrm_email_keywords_cstm on scrm_email_keywords.id=scrm_email_keywords_cstm.id_c WHERE deleted=0 and name LIKE '%$text%'";

      	$count++;
      	}
      	$GLOBALS['log']->fatal($sql."query");
      	$result_email_keywords = $db->query($sql);
      	while($row_email_keywords = $db->fetchByAssoc($result_email_keywords)){
      	$data_array['name'] = $row_email_keywords['module_c']['sub_module_c'];
      	}
      	$GLOBALS['log']->fatal(print_r($data_array,true)."data array");
      	$GLOBALS['log']->fatal($data_array['name'][0]."data array1");
      	$module = $row_email_keywords['module_c'];
      	$sub_module = $row_email_keywords['sub_module_c'];
     	*/
    	/*     	* **************fetch email keywords********************* */
    	$fetch_email_keywords = "select name,sub_module_c from scrm_email_keywords join scrm_email_keywords_cstm on scrm_email_keywords.id=scrm_email_keywords_cstm.id_c where scrm_email_keywords.deleted=0";
    	$result_email_keywords = $db->query($fetch_email_keywords);
    	$email_keywords_array = array();
    	while ($row_email_keywords = $db->fetchByAssoc($result_email_keywords)) {
        	if (strpos($row_email_keywords['name'], ',') >= 0) {
            	$email_keywords_ = explode(",", $row_email_keywords['name']);
            	if (isset($email_keywords_[2])) {
                	$email_keywords_array[$email_keywords_[0]] = $row_email_keywords['sub_module_c'];
                	$email_keywords_array[$email_keywords_[1]] = $row_email_keywords['sub_module_c'];
                	$email_keywords_array[$email_keywords_[2]] = $row_email_keywords['sub_module_c'];
            	} else {
                	$email_keywords_array[$email_keywords_[0]] = $row_email_keywords['sub_module_c'];
                	$email_keywords_array[$email_keywords_[1]] = $row_email_keywords['sub_module_c'];
            	}
        	} else {
            	$email_keywords_array[$row_email_keywords['name']] = $row_email_keywords['sub_module_c'];
        	}
    	}

    	//	$GLOBALS['log']->fatal(print_r($email_keywords_array,true)."data array");
    	// create regular expression by using alternation
    	// of all given words
    	$re = '/\b(?:' . join('|', array_map(function($keyword) {
                        	return preg_quote($keyword, '/');
                    	}, array_keys($email_keywords_array))) . ')\b/i';

    	preg_match_all($re, $text, $matches);
    	foreach (array_filter($matches[0]) as $keyword) {
        	//echo $keyword, " ", $email_keywords_array[$keyword], "\n";
        	$sub_module = $email_keywords_array[$keyword];
        	$fetch_module = $db->query("select module_c from scrm_email_keywords_cstm where sub_module_c='$sub_module'");
        	$result_module = $db->fetchByAssoc($fetch_module);
        	$module = $result_module['module_c'];


        	$logMessage = "\n\nKeyword module Result at $timestamp :-" . $module . "<pre>";
        	fwrite($schedulerHandle, $logMessage);
    	}
        $bean_fields = array('parent_id' => $bean->parent_id, 'fetched_row' => $bean->fetched_row, 'parent_type' => $bean->parent_type, 'status' => $bean->status,'from_address'=>$bean->from_addr,'type'=>$bean->type, 'description' => $bean->description);
    	$logArray = print_r($bean_fields, true);
    	$logMessage = "\n\n Bean Fields at $timestamp :-\n $logArray";
    	fwrite($schedulerHandle, $logMessage);

    	$today = date('Y-m-d');
//        if ((strpos($bean->description, 'Address not found') !== false) || (date('Y-m-d',strtotime($bean->date_sent)) != $today)) {
  
          if ((strpos($bean->description, 'Address not found') !== false) || (strtotime($bean->date_sent) < strtotime('-5 day'))) {
        	$logMessage = "\n\nAddress Not Found Exit at $timestamp :-\n";
        	fwrite($schedulerHandle, $logMessage);
        	exit;
    	} else {

        	$logMessage = "\n\n Else condition at $timestamp :-\n";
        	fwrite($schedulerHandle, $logMessage);
        	// if the email is related to a case, it is inbound and unread
            if (!empty($bean->parent_id) && !empty($bean->fetched_row) && $bean->parent_type == 'Cases' && $bean->type == 'inbound' && $bean->status == 'unread') {
//             if ($bean->type == 'inbound' && $bean->status == 'unread') {
            	//$GLOBALS['log']->fatal(print_r($bean,true)."INBOUND EMAIL BEAN");
            	$logMessage = "\n\n Inside condition at $timestamp :";
            	fwrite($schedulerHandle, $logMessage);
            	$GLOBALS['log']->fatal($bean->name . "INBOUND EMAIL BEAN");
            	$from_address_customers = $bean->from_addr;
            	//fetching exact email address from contacts module
            	$fetching_exact_email_addresss = "select * from email_addresses as ea,email_addr_bean_rel as eb,contacts as c where ea.email_address='$from_address_customers' and ea.id=eb.email_address_id and eb.bean_module='Contacts' and eb.deleted=0 and c.id=eb.bean_id and c.deleted=0";
            	$result_exact_email_address = $db->query($fetching_exact_email_addresss);
            	$row_exact_email_address = $db->fetchByAssoc($result_exact_email_address);
            	$email_address_contact_id = $row_exact_email_address['bean_id'];   //contact id
            	//$GLOBALS['log']->fatal($email_address_contact_id."contact id");

            	$logMessage = "\n\nContact Id at :-\n" . $email_address_contact_id;
            	fwrite($schedulerHandle, $logMessage);
            	$case = BeanFactory::getBean('Cases', $bean->parent_id);
            	$bean_parent_id = $bean->parent_id;
            	//$GLOBALS['log']->fatal(print_r($case,true)."CASE BEAN");
            	$logMessage = "\n\nBean Ticket Id :-\n" . $bean_parent_id;
            	fwrite($schedulerHandle, $logMessage);
            	$case->email1 = $bean->from_addr;
            	$case->module_c = $module;
            	$case->sub_module_c = $sub_module;
            	$case->source_c = 'Inbound_Email';
            	$case->status = 'Open_New';
            	$case->departments_c = 'Operations Team';
            	if (!empty($email_address_contact_id)) {
                	$case->contacts_cases_1contacts_ida = $email_address_contact_id;
                	//$cont = BeanFactory::getBean('Contacts', $email_address_contact_id);
                	$cont = new Contact();
                	$cont->retrieve($email_address_contact_id);
                	//$GLOBALS['log']->fatal(print_r($cont,true)."BEAN");
                	$case->contacts_cases_1_name = $cont->first_name . ' ' . $cont->last_name;
            	}
            	//	$case->user_name_c = $cont->first_name.' '.$cont->last_name;
            	$case->mobile_number_c = $cont->phone_mobile;
            	$case_values = array('email1' => $bean->from_addr, 'module_c' => $module, 'sub_module_c' => $sub_module, 'source_c' => 'Inbound_Email', 'status' => 'Open_New', 'departments_c' => 'Operations Team', 'contacts_cases_1_name' => $cont->first_name . ' ' . $cont->last_name, 'mobile_number_c' => $cont->phone_mobile);
            	$logArray = print_r($case_values, true);
            	$logMessage = "\n\nCase array at $timestamp :-\n$logArray";
            	fwrite($schedulerHandle, $logMessage);
            	$case->save();
        	}
    	}
    	$logMessage = "\n\n Logic Hook Ended at $timestamp :\n-----------------------------------------------------------******-------------------------------------------------------------------------";
    	fwrite($schedulerHandle, $logMessage);
	}

}
?>





