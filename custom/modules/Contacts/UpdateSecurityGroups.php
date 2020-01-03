<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
ini_set("display_errors","On");

class UpdateSecurityGroups{
  function Update_group($bean,$event,$arguments){
    global $current_user;
    global $db;
    $current_user_id = $current_user->id;
    $contact_id = $bean->id;
    $bean_fetched_lead_source= $bean->fetched_row['lead_source'];
  $lead_source = $bean->lead_source;
  if(($bean_fetched_lead_source!=$lead_source) && ($lead_source!=''))
  {
    //echo $lead_source;

    $security_group_name =$lead_source." ".'Group';
    $query_security_group_info = "SELECT id from securitygroups where name='$security_group_name' and deleted=0";
    $result_security_group_info = $db->query($query_security_group_info);
    $row_security_group_info = $db->fetchByAssoc($result_security_group_info);
    $securitygroup_id = $row_security_group_info['id'];
    $security_record_id = create_guid();
    $insert_security_group = "INSERT INTO `securitygroups_records`(`id`, `securitygroup_id`, `record_id`, `module`, `date_modified`, `modified_user_id`, `created_by`, `deleted`) VALUES ('$security_record_id','$securitygroup_id','$contact_id','Contacts',now(),'$current_user_id','$current_user_id','0')";
    $result_insert = $db->query($insert_security_group);

  }
//exit;
  }
}
