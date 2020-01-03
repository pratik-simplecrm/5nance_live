<?php
if (!define('sugarEntry'))
    define('sugarEntry', true);
require_once('include/entryPoint.php');
require_once('config.php');
//ini_set('display_errors', 'On');
global $db, $app_list_strings, $sugar_config;






echo  $calls_id_query = "SELECT count(*) as count,c.date_start,c.id,c.name,c.status,c.date_modified,c.direction,c.assigned_user_id,c.date_entered,cac.date_modified,cac.contact_id FROM calls AS c JOIN calls_cstm AS cc ON c.id = cc.id_c JOIN calls_contacts as cac ON c.id=cac.call_id WHERE c.deleted =0 and cac.deleted=0 AND date(c.date_entered) BETWEEN '2017-11-24' AND '2017-11-27' AND c.direction='Outbound' AND c.status='Planned' group by c.date_start,c.name,c.status,c.date_entered,c.assigned_user_id,cac.contact_id having count>1 order by c.date_modified desc";
  //AND c.date_entered BETWEEN '2017-11-24' AND '2017-11-27'
        $calls_id_result = $db->query($calls_id_query);
$i=1;
        while ($calls_id_row = $db->fetchByAssoc($calls_id_result)) {
            echo "<br/>Number : ".$i."<br/><pre>";
            print_r($calls_id_row);
            echo "<br/><br/>Count:".$calls_id_row['count']."-------------><br/>";
  echo            $mul_calls = "SELECT c.id,c.name,c.status,c.date_modified as call_date_modified,c.direction,c.date_entered,c.assigned_user_id,c.date_start,cac.date_modified as call_contact_date_modified,cac.contact_id FROM calls AS c JOIN calls_cstm AS cc ON c.id = cc.id_c JOIN calls_contacts as cac ON c.id=cac.call_id WHERE c.deleted =0 and cac.deleted=0 AND date(c.date_entered) BETWEEN '2017-11-24' AND '2017-11-27' AND c.direction='Outbound' AND c.status='Planned' and c.name='".$calls_id_row['name']."' and c.date_entered='".$calls_id_row['date_entered']."' and c.date_start='".$calls_id_row['date_start']."' and c.assigned_user_id='".$calls_id_row['assigned_user_id']."' and cac.contact_id='".$calls_id_row['contact_id']."' and c.id NOT IN ('".$calls_id_row['id']."')";
  //and c.id NOT IN ('".$calls_id_row['id']."')
        $mul_calls_result = $db->query($mul_calls);

        while ($get_calls_row = $db->fetchByAssoc($mul_calls_result)) {
           echo "<pre>";
            print_r($get_calls_row);
//             
//
//			
		exit;
            echo	 $call_contact_query_update = "update calls_contacts set deleted = 1, date_modified = NOW() where call_id = '".$get_calls_row['id']."' and contact_id = '".$get_calls_row['contact_id']."'";
			$call_contact_result_update = $db->query($call_contact_query_update);
                        if(isset($call_contact_result_update)){
                            echo "updated call contacts<br/>";
                        }
               echo "<br/><br/>";          
                     echo     $call_query_update = "update calls set deleted = 1, date_modified = NOW() where id = '".$get_calls_row['id']."'";
			$call_result_update = $db->query($call_query_update);
                        if(isset($update_call_result)){
                            echo "updated call<br/>";
                        }
        }
            $i++;
            //exit;
        }

?>
