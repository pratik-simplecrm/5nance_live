<?PHP

$hook_version = 1;
$hook_array = Array();

$hook_array['process_record'] = Array();
$hook_array['process_record'][] = Array(1, 'count', 'modules/Calls_Reschedule/reschedule_count.php', 'reschedule_count', 'count');
$hook_array['after_save'] =Array();
$hook_array['after_save'][] = Array(3, 'Genrate No. of Attempts for Contacts and Products', 'custom/modules/Calls/genrate_no_of_attempts.php','GenrateNoOfAttempts', 'GenrateNoOfAttemptsMethod');
