<?php
	/*************************Leads Additonal Modules***********************/
$admin_option_defs = array();

$admin_option_defs['Administration']['accounts'] = array(
    'Accounts', 
    'Related Corporate Accounts', 
    'Manage and create corporate accounts', 
    './index.php?module=Accounts&action=index'
    );
$admin_option_defs['Administration']['campaign_source'] = array(
    'Campaigns', 
    'Campaign Source', 
    'Manage and create corporate accounts', 
    './index.php?module=scrm_Campaign_Source&action=index'
);


// add our new admin section to the main admin_group_header array
$admin_group_header[]= array(
 
    // The title for the group of links
    '<b>Leads Admin Modules</b>', 
 
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
    'To create campaign source and corporate account'
 
);
?>
