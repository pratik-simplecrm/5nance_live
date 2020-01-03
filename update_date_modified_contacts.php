<?php

if (!define('sugarEntry'))
    define('sugarEntry', true);
require_once('include/entryPoint.php');
require_once('config.php');
ini_set('display_errors', 'On');
global $db, $app_list_strings, $sugar_config;

$get_contacts_data = "select id,date_modified,modified_user_id from contacts join contacts_cstm on id=id_c where deleted=0";
$result_contacts_data = $db->query($get_contacts_data);
$i=1;
while($row_contacts_data = $db->fetchByAssoc($result_contacts_data)){
	$contact_id = $row_contacts_data['id'];
	$contact_date_modified = $row_contacts_data['date_modified'];
	$contact_modified_by = $row_contacts_data['modified_user_id'];
	$contact_audit_id = $db->query("SELECT parent_id,id,date_created,created_by  FROM `contacts_audit` WHERE `parent_id`= '$contact_id' and created_by!='1' and field_name='date_modified' order by date_created DESC limit 1");
	if($contact_audit_id->num_rows > 0){
		$contacts_row = $db->fetchByAssoc($contact_audit_id);
	$custom_date_modified=$contacts_row['date_created'];
    $custom_created_by=$contacts_row['created_by'];
echo $i."<pre>";	
    print_r($contacts_row);
    echo "</pre>";
     echo "<br><br>";
    echo $contact_query_update = "update contacts_cstm set custom_date_modified_c ='$custom_date_modified', user_id_c = '$custom_created_by' where id_c = '$contact_id'";
    			$contact_result_update = $db->query($contact_query_update);
                       if(isset($contact_result_update)){
                           echo $i."-----audit updated<br>";
                          
                       }
     $i++;
                      echo "<br>"; 
	}else{
		 echo $contact_query_update = "update contacts_cstm set custom_date_modified_c ='$contact_date_modified', user_id_c = '$contact_modified_by' where id_c = '$contact_id'";
    			$contact_result_update = $db->query($contact_query_update);
                       if(isset($contact_result_update)){
                           echo $i."-----record updated<br>";
                          
                       }
	}
	
//exit;
}

// echo $contacts_query = "SELECT DISTINCT(c.id) AS contact_id, ca.id AS audit_id, c.first_name AS first_name, ca.after_value_string AS after_value_string, ca.date_created AS date_created, ca.created_by AS created_by
// FROM contacts AS c
// JOIN contacts_cstm AS cc ON c.id = cc.id_c
// JOIN contacts_audit AS ca ON c.id = ca.parent_id
// WHERE c.deleted =0
// AND ca.field_name = 'date_modified'
// AND cc.unique_customer_code_c != ''
// AND ca.created_by !=1 
// ORDER BY ca.date_created DESC ";

// echo $contacts_query = "SELECT DISTINCT(c.id) AS contact_id, ca.id AS audit_id, c.first_name AS first_name, ca.after_value_string AS after_value_string, ca.date_created AS date_created, ca.created_by AS created_by
// FROM contacts AS c
// JOIN contacts_cstm AS cc ON c.id = cc.id_c
// JOIN contacts_audit AS ca ON c.id = ca.parent_id
// WHERE c.deleted =0 AND ca.field_name = 'date_modified'
// AND cc.unique_customer_code_c != ''
// AND ca.created_by !=1 and c.id IN (select ca.parent_id from contacts_audit ca where ca.field_name='date_modified' and ca.created_by!='' order by ca.date_created DESC) group by c.id";
// $contacts_result = $db->query($contacts_query);
// $i=1;
// while ($contacts_row = $db->fetchByAssoc($contacts_result)) {

//     echo $i."<pre>";	
//     print_r($contacts_row);
//     echo "</pre>";
//      echo "<br><br>";
   
//      $contact_id=$contacts_row['contact_id'];
//     $custom_date_modified=$contacts_row['date_created'];
//      $custom_created_by=$contacts_row['created_by'];

//     		echo $contact_query_update = "update contacts_cstm set custom_date_modified_c ='$custom_date_modified', user_id_c = '$custom_created_by' where id_c = '$contact_id'";
// //			$contact_result_update = $db->query($contact_query_update);
// //                        if(isset($contact_result_update)){
// //                            echo $i."-----updated<br>";
// //                           
// //                        }
//                  $i++;
//                       echo "<br>"; 
                      
    
//}
?>