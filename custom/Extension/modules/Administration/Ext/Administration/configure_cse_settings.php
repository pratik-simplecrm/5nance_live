<?php 

require_once('config.php');
// initialize a temp array that will hold the options we want to create
$links = array();
global $sugar_config;
// add button1 to $links

$links['Administration']['config_CSEmail_settings'] = array(
 
    // pick an image from /themes/Sugar5/images
    // and drop the file extension
    'cse3',
 
    // title of the link 
    'Click to Configure Corporate Sales Email',
 
    // description for the link
    'Here you can configure settings for Corporate Sales Email.',
 
    // where to send the user when the link is clicked
    './index.php?module=Administration&action=configureCSEmailSettings',
 
);
$admin_group_header []= array(
 
    // The title for the group of links
    '<b>Corporate Sales Email Configuration</b>', 
 
    // leave empty, it's used for something in /include/utils/layout_utils.php 
    // in the get_module_title() function
    '', 
 
    // set to false, it's used for something in /include/utils/layout_utils.php 
    // in the get_module_title() function
    false, 
 
    // the array of links that you created above
    // to be placed in this section
    $links, 
 
    // a description for what this section is about
    'Configure Corporate Sales Email Settings'
 
);

?>
