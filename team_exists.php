<?php
	
	if(!defined('sugarEntry')) define('sugarEntry',true);
	require_once('include/utils.php');
	require_once('include/entryPoint.php');
	global $db;
	$team=$_REQUEST['team'];
	$query="SELECT count(*) as total FROM scrm_escalation_matrix INNER JOIN scrm_escalation_matrix_cstm ON scrm_escalation_matrix.id=scrm_escalation_matrix_cstm.id_c WHERE deleted='0' AND teams_c='$team'";
	$result=$db->query($query);
	$row=$db->fetchByAssoc($result);
	$total=$row['total'];
	$query_id="SELECT id FROM scrm_escalation_matrix INNER JOIN scrm_escalation_matrix_cstm ON scrm_escalation_matrix.id=scrm_escalation_matrix_cstm.id_c WHERE deleted='0' AND teams_c='$team'";
	$result_id=$db->query($query_id);
	$row_id=$db->fetchByAssoc($result_id);
	$id=$row_id['id'];
	echo $total.','.$id;
?>
