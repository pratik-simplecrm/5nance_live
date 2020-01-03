<?php
	

if(!defined('sugarEntry'))define('sugarEntry', true);
require_once('include/entryPoint.php');

require_once('include/database/DBManager.php');
require_once('config.php');
global $sugar_config;
$url = $sugar_config['site_url'];
switch($_GET['report']) {

	default:
	include_once("custom_report.php");
	break;	

}
		
?>

