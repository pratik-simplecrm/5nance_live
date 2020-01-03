<?php

if(!defined('sugarEntry')) define('sugarEntry',true);
require_once('include/utils.php');
require_once('include/entryPoint.php');
global $db;

/**
 * check mail inbox scheduler struck in the job queue more than 10 mins. 
 * If yes, update the status to done
 * @author Mohammad Shakeer
 * @date 29/03/2019
 */

$query = "SELECT scheduler_id, date_add(execute_time, interval 550 minute) as execute_time
			FROM job_queue
			WHERE STATUS = 'running'";
			
$result = $db->query($query);


while($row = $db->fetchByAssoc($result)) {
	
	
	$execute_time = $row['execute_time'];
	$scheduler_id = $row['scheduler_id'];
	
	$current_time = date('Y-m-d H:i:s');

	$execute_time = new DateTime($execute_time);
	$current_time = new DateTime($current_time);

	$interval = $current_time->diff($execute_time);
	
	if($interval->i > 20 ) {
	
		$update_query = "update job_queue set status='done', resolution='success' where STATUS = 'running' AND scheduler_id = '$scheduler_id'";
		
		$db->query($update_query);
	
	}
		
}

return true;
 
?>
