<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['after_login'] = Array(); 
$hook_array['after_login'][] = Array(1, 'SugarFeed old feed entry remover', 'modules/SugarFeed/SugarFeedFlush.php','SugarFeedFlush', 'flushStaleEntries'); 
$hook_array['after_login'][] = Array(1, 'after_login', 'custom/modules/Users/Login_Audit.php','login_audit_class', 'after_login_method');
$hook_array['after_logout'] = Array(); 
$hook_array['after_logout'][] = Array(1, 'after_logout', 'custom/modules/Users/Logout_Audit.php','logout_audit_class', 'after_logout_method'); 


?>