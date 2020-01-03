<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will
// be automatically rebuilt in the future.
 $hook_version = 1;
$hook_array = Array();
// position, file, function
$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(77, 'updateGeocodeInfo', 'custom/modules/Contacts/ContactsJjwg_MapsLogicHook.php','ContactsJjwg_MapsLogicHook', 'updateGeocodeInfo');
$hook_array['before_save'][] = Array(1, 'Contacts push feed', 'modules/Contacts/SugarFeeds/ContactFeed.php','ContactFeed', 'pushFeed');
$hook_array['before_save'][] = Array(5, 'Update planned call assignment', 'custom/modules/Contacts/UpdateCallAssignment.php','UpdateCallAssignment', 'UpdateCallAssignment');
$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(77, 'updateRelatedMeetingsGeocodeInfo', 'custom/modules/Contacts/ContactsJjwg_MapsLogicHook.php','ContactsJjwg_MapsLogicHook', 'updateRelatedMeetingsGeocodeInfo');
$hook_array['after_save'][] = Array(1, 'Update Portal', 'custom/modules/Contacts/updatePortal.php','updatePortal', 'updateUser');

$hook_array['after_save'][] = Array(2, 'Create a call based on selected Desposition option', 'custom/modules/Contacts/AfterSave.php','AfterSave', 'createDespositionCall');
$hook_array['after_save'][] = Array(3, 'Update case details', 'custom/modules/Contacts/Contacts_Relationship.php','contactrelationship', 'contactrelationship');

$hook_array['after_save'][] = Array(6, 'Update Custom Date Modified', 'custom/modules/Contacts/Add_Custom_Date_Modified.php','AddCustomDateModifiedClass', 'AddCustomDateModifiedFunction');

$hook_array['after_save'][] = Array(7, 'Genrate No. of Attempts for Contacts', 'custom/modules/Contacts/genrate_no_of_attempts.php','GenrateContactsNoOfAttempts', 'GenrateContactsNoOfAttemptsMethod');
$hook_array['after_save'][] = Array(7, 'Reverse feed of partner details', 'custom/modules/Contacts/PartnerDataUpdateTo5nance.php','PartnerDataUpdateTo5nance', 'PartnerDataUpdateTo5nance');
$hook_array['before_save'][] = Array(1, 'Update sales stage based on disposition', 'custom/modules/Contacts/BeforeSave.php','BeforeSave', 'change_sales_stage_for_disposition');
$hook_array['process_record'] = Array();
//$hook_array['process_record'][] = Array(1,'add phoneicon to assigned users number','custom/modules/Contacts/GetAssignedUser.php','GetAssignedUser','getAssignedUser');
$hook_array['after_relationship_add'] = Array();
$hook_array['after_relationship_add'][] = Array(4, 'Update summary account', 'custom/modules/Contacts/orders_summarization.php','myorders', 'myorders_summary');
//~ $hook_array['process_record'][] = Array(1, 'Update full name', 'custom/modules/Contacts/Updatefullname.php','Updatefullname', 'Updatefullname_method');

//~ $hook_array['before_save'][] = Array(2,'Update security group based on the lead source','custom/modules/Contacts/UpdateSecurityGroups.php','UpdateSecurityGroups','Update_group');
?>
