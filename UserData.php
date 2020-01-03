<?php
if(!defined('sugarEntry'))define('sugarEntry', true);
require_once('data/BeanFactory.php');
require_once('include/entryPoint.php');

ini_set("display_errors","Off");

//~ echo "UserData";
//~ exit;
//~ echo "hi";exit;
echo "hi";
$data = $_POST['data'];
$test_array = array();
foreach($data as $key=>$value){
	foreach($value as $i=>$p){
		$test_array[$i] = $p;
	}
}
//~ 
print_r($test_array);

