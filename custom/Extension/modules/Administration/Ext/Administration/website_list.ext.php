<?php
/***************************WEBSITE MODULES*****************************/
$admin_option_defs = array();

$admin_option_defs['Administration']['orders'] = array(
    '', 
    'Orders', 
    'To view complete Orders', 
    './index.php?module=scrm_My_Orders&action=index'
    );
$admin_option_defs['Administration']['goals'] = array(
    '', 
    'Goals', 
    'To view complete Goals', 
    './index.php?module=scrm_Goals&action=index'
);
$admin_option_defs['Administration']['sip'] = array(
    '', 
    'SIP', 
    'To view complete SIP details', 
    './index.php?module=scrm_SIP&action=index'
);
$admin_option_defs['Administration']['mandate'] = array(
    '', 
    'ECS Mandate', 
    'To view complete ECS Mandate details', 
    './index.php?module=scrm_ECS_Mandate&action=index'
);
$admin_option_defs['Administration']['nominees'] = array(
    '', 
    'Nominees', 
    'To view complete Nominee details', 
    './index.php?module=scrm_Nominees&action=index'
);
$admin_option_defs['Administration']['riskprofile_allocation'] = array(
    '', 
    'Risk Profile Allocation', 
    'To view complete Risk Profile Allocation details', 
    './index.php?module=scrm_Risk_Profile&action=index'
);
$admin_option_defs['Administration']['investor_bank_detals'] = array(
    '', 
    'Investor Bank Account', 
    'To view complete Investor Bank Details', 
    './index.php?module=scrm_Bank_Details&action=index'
);
$admin_option_defs['Administration']['callback_request'] = array(
    '', 
    'Call Back Request', 
    'To view complete call back requests', 
    './index.php?module=scrm_Callback_Request&action=index'
);
$admin_option_defs['Administration']['loans'] = array(
    '', 
    'Loans', 
    'To view complete loans details', 
    './index.php?module=scrm_Loans&action=index'
);
$admin_option_defs['Administration']['insurance'] = array(
    '', 
    'Insurance', 
    'To view complete Insurance details', 
    './index.php?module=scrm_Insurance&action=index'
);


// add our new admin section to the main admin_group_header array
$admin_group_header[]= array(
 
    // The title for the group of links
    '<b>Website Modules</b>', 
 
    // leave empty, it's used for something in /include/utils/layout_utils.php 
    // in the get_module_title() function
    '', 
 
    // set to false, it's used for something in /include/utils/layout_utils.php 
    // in the get_module_title() function
    false, 
 
    // the array of links that you created above
    // to be placed in this section
    $admin_option_defs, 
 
    // a description for what this section is about
    'Additonal Modules'
 
);
?>