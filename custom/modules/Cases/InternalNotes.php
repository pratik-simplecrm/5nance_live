<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
class InternalNotes{
	
	function internalnotesmethod($bean, $event, $arguments){
		
		global $db;

		$assignedTo = $bean->modified_by_name;
    
		$qry = "SELECT concat(IFNULL(`first_name`,''),' ',IFNULL(`last_name`,'')) as Name FROM `users` WHERE `user_name`='$assignedTo' ";
		$result = $db->query($qry);
		$row = $db->fetchByAssoc($result);
		$assignedTo = $row['Name']; //~ $assignedToID = $bean->assigned_user_id;
		$comments = $bean->internal_notes_c;
        $lineSeperator = '--------------------------------------------------------------------------------';
        $beanFetched = $bean->fetched_row;

        $oldComments = $beanFetched['internal_notes_c'];
        $oldCommentsLog = $beanFetched['internal_notes_log_c'];
        $oldAssignedToID = $beanFetched['modified_user_id'];
        $userBean = BeanFactory::getBean('Users', $oldAssignedToID);
        $oldAssignedTo = $userBean->full_name;

        $date = date('d-M-Y h:m a', strtotime('now'));

        if (!empty($beanFetched)) {

            if ($comments != $oldComments) {
                if ($oldCommentsLog != '') {
                    $newCommentsLog = "$assignedTo - $date :- $comments\n$lineSeperator\n$oldCommentsLog";
                    $bean->internal_notes_log_c = $newCommentsLog;
                } else if ($oldCommentsLog == '') {
                    $newCommentsLog = "$assignedTo - $date :- $comments\n$lineSeperator";
                    $bean->internal_notes_log_c = $newCommentsLog;
                }
            }

          } else {
             if ($comments != '') {
                $newCommentsLog = "$assignedTo - $date :- $comments\n$lineSeperator";
                $bean->internal_notes_log_c = $newCommentsLog;
            }
        }
        /****************establishing relation to contacts****************/
        $contact_id = $bean->contacts_cases_1contacts_ida;
        $case_id = $bean->id;
        //echo "INSERT into contacts_cases ('id','contact_id','case_id','date_modified','deleted') VALUES (UUID(),'$contact_id','$case_id',NOW(),0)";exit;
        $db->query("INSERT into contacts_cases (id,contact_id,case_id,date_modified,deleted) VALUES (UUID(),'$contact_id','$case_id',NOW(),0)");
	}
}

?>
