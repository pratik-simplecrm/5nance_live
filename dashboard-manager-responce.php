<?php

if(!defined('sugarEntry')) define('sugarEntry', true);
require_once('include/entryPoint.php');
require_once('config.php');

require_once 'dashboard-manager-functions.php';


     $myfunction = new Mydashboard();
     $result = $myfunction->$_POST['call_function']($_POST['id'],$_POST['no']);
  	 echo $result;

?>
