<?php

if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class Lead_Id
{

    function lead_id_fun($bean, $event, $arguments)
    {
		global $db;
		


		 if(empty($bean->fetched_row)) {




			
			global $db;
			$query = "SELECT lead_id1_c FROM  leads_cstm ORDER BY  lead_id1_c DESC limit 0,1";
			$result =$db->query($query);
			$row= $db->fetchByAssoc($result);
			$row_new_id = $row['lead_id1_c'];			
			if(empty($row_new_id))
			{
				//$id = $bean->lead_id_c;
				//$bean->lead_id_c = 'Lead-'.date(Y).'000001'; 
                                
                                $bean->lead_id1_c  = 'L-'.'000001'; 
			}
			else{
				$bean->lead_id1_c  = ++$row_new_id;
			}
		}



    }
}
?>
