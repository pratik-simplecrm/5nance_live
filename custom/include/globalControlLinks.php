<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

global $app_strings, $current_user;
global $sugar_config, $sugar_version, $sugar_flavor, $server_unique_key, $current_language, $action;

unset($global_control_links['training'] );      //hiding training link
unset($global_control_links['help'] );         //hiding help link
unset($global_control_links['about'] );       //hiding about link

?>
