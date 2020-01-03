<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['before_save'] = Array(); 
$hook_array['before_save'][] = Array(11, 'Internal Notes Log', 'custom/modules/Cases/InternalNotes.php','InternalNotes', 'internalnotesmethod'); 
$hook_array['before_save'][] = Array(12, 'Assignment Time', 'custom/modules/Cases/CaptureassingedTime.php','AssignedTime', 'assignedtimemethod'); 
$hook_array['before_save'][] = Array(1, 'Cases push feed', 'modules/Cases/SugarFeeds/CaseFeed.php','CaseFeed', 'pushFeed'); 
$hook_array['after_save'] = Array(); 
$hook_array['after_save'][] = Array(77, 'updateRelatedMeetingsGeocodeInfo', 'custom/modules/Cases/CasesJjwg_MapsLogicHook.php','CasesJjwg_MapsLogicHook', 'updateRelatedMeetingsGeocodeInfo'); 
$hook_array['after_save'][] = Array(10, 'Send contact case closure email', 'modules/AOP_Case_Updates/CaseUpdatesHook.php','CaseUpdatesHook', 'closureNotify'); 
$hook_array['after_save'][] = Array(11, 'Send contact case closure sms', 'custom/modules/Cases/send_closed_case_sms.php','SendSMS_customer', 'sendSMSFunction'); 
$hook_array['after_relationship_add'] = Array(); 
$hook_array['after_relationship_add'][] = Array(9, 'Assign account', 'modules/AOP_Case_Updates/CaseUpdatesHook.php','CaseUpdatesHook', 'assignAccount'); 
$hook_array['after_relationship_delete'] = Array(); 
$hook_array['after_relationship_delete'][] = Array(77, 'deleteRelationship', 'custom/modules/Cases/CasesJjwg_MapsLogicHook.php','CasesJjwg_MapsLogicHook', 'deleteRelationship'); 
$hook_array['after_retrieve'] = Array(); 
$hook_array['after_retrieve'][] = Array(77, 'Filter HTML', 'modules/AOP_Case_Updates/CaseUpdatesHook.php','CaseUpdatesHook', 'filterHTML'); 



?>