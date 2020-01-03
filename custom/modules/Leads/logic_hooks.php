<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['before_save'] = Array(); 
$hook_array['before_save'][] = Array(77, 'updateGeocodeInfo', 'custom/modules/Leads/LeadsJjwg_MapsLogicHook.php','LeadsJjwg_MapsLogicHook', 'updateGeocodeInfo'); 
$hook_array['before_save'][] = Array(2, 'call status update', 'custom/modules/Leads/leadstatusupdate.php','leadstatusupdate', 'leadstatusupdate'); 
$hook_array['before_save'][] = Array(1, 'Leads push feed', 'modules/Leads/SugarFeeds/LeadFeed.php','LeadFeed', 'pushFeed'); 
$hook_array['before_save'][] = Array(6, 'Changed Assigned User', 'custom/modules/Leads/change_assigned_user.php','ChangedAssignedUserClass', 'ChangedAssignedUserMethod'); 
$hook_array['after_save'] = Array(); 
$hook_array['after_save'][] = Array(10, 'follow up calls creation', 'custom/modules/Leads/AfterSaveLead.php','followupcall_class', 'createFollowupCall'); 
//$hook_array['after_save'][] = Array(2, 'Auto Conversion', 'custom/modules/Leads/AutoConversion.php','ConversionClass', 'ConversionMethod'); 
$hook_array['after_save'][] = Array(4, 'lead generation in users', 'custom/modules/Leads/lead_user_creation.php','UserCreation', 'usercreationmethod'); 
$hook_array['after_save'][] = Array(5, 'leads campaign linking', 'custom/modules/Leads/campaign_relation.php','campaignsource', 'campaignsource'); 
$hook_array['process_record'] = Array(); 
$hook_array['process_record'][] = Array(1, 'Update full name', 'custom/modules/Leads/Updatefullname_Leads.php','Updatefullname_leads', 'Updatefullname_method_leads'); 



?>