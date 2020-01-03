<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will
// be automatically rebuilt in the future.
 $hook_version = 1;
$hook_array = Array();
$hook_array['after_save'] = Array();
$hook_array['after_save'][] = Array(2, 'Create a call based on selected Desposition option', 'custom/modules/scrm_Products/AfterSave.php','AfterSaveProducts', 'createDespositionCall');
$hook_array['after_save'][] = Array(4, 'Genrate No. of Attempts for Contacts and Products', 'custom/modules/scrm_Products/genrate_no_of_attempts.php','GenrateProductsNoOfAttempts', 'GenrateProductsNoOfAttemptsMethod');
$hook_array['after_save'][] = Array(5, 'Reverse feed of partner details', 'custom/modules/scrm_Products/ProductPartnerUpdate.php','ProductPartnerUpdate', 'ProductPartnerUpdate');
$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(2, 'Change sales stage', 'custom/modules/scrm_Products/change_sales_stage.php','BeforeSaveProducts', 'ChangeSalesStage');
$hook_array['before_save'][] = Array(5, 'Product wise assignment', 'custom/modules/scrm_Products/productwiseassignment.php','ProductWiseAssignementClass', 'ProductWiseAssignementFunction');

?>
