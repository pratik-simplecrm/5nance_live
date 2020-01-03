<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class UpdateDescriptionNote{

function updateDescriptionFunctionNote($bean, $event, $arguments){

 global $db;
 $record_id = $bean->id;
 $query1 ="UPDATE  notes SET description = REPLACE(description, ', Tweeted by :', '\r\nTweeted by :') WHERE id = '$record_id' AND deleted=0";
 $db->query($query1);

 $query2 ="UPDATE  notes SET description = REPLACE(description, ', Tweeted on :', '\r\nTweeted on :') WHERE id = '$record_id' AND deleted=0";
 $db->query($query2);


 $query3 ="UPDATE  notes SET description = REPLACE(description, ', Link to tweet :', '\r\nLink to tweet :') WHERE id = '$record_id' AND deleted=0";
 $db->query($query3);

 $query4 ="UPDATE  notes SET description = REPLACE(description, ', Posted On :', '\r\nPosted On :') WHERE id = '$record_id' AND deleted=0";
 $db->query($query4);

 $query5 ="UPDATE  notes SET description = REPLACE(description, ', Link to Facebook Profile :', '\r\nLink to Facebook Profile :') WHERE id = '$record_id' AND deleted=0";
 $db->query($query5);

 $query4 ="UPDATE  notes SET description = REPLACE(description, ', Link to Post :', '\r\nLink to Post :') WHERE id = '$record_id' AND deleted=0";
 $db->query($query4);

}

}



