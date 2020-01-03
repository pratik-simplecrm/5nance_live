<?php
if (!define('sugarEntry'))
    define('sugarEntry', true);
require_once('include/entryPoint.php');
require_once('config.php');
ini_set('display_errors','On');
global $db, $app_list_strings,$sugar_config;
echo date("Y-m-d H:i:s");
date_default_timezone_set('UTC');
echo "<br>".date("Y-m-d H:i:s");
$records_query    = "SELECT *
FROM contacts c
JOIN contacts_cstm cc ON c.id = cc.id_c
WHERE deleted = '0'
AND user_allocation_date_c
BETWEEN (CURDATE() - INTERVAL 3 DAY) AND CURDATE()
AND (
cast( cc.user_allocation_date_c AS time )
BETWEEN '22:00:00'
AND '23:59:59'
)";
	$records_result   = $db->query($records_query);
       echo "Total Records : ".$records_result->num_rows;
        while ($record_row = $db->fetchByAssoc($records_result)) {
       // print_r($record_row);
       echo "<br>";
    echo    $updated_date = date('Y-m-d H:i:s', strtotime('+5 hours  +30 minutes', strtotime($record_row['user_allocation_date_c'])));
         echo "<br>";
    echo    $update_query="UPDATE contacts_cstm SET user_allocation_date_c ='".$updated_date."'  WHERE id_c = '".$record_row['id']."'";
      // $updated_result   = $db->query($update_query);
        if($updated_result){
            echo "<br>Record Updated Successfully --->".$record_row['id']."------------->Old Date:".$record_row['user_allocation_date_c']."--->New Date :".$updated_date;
        }else{
            echo "<br>Record Not Updated Successfully --->".$record_row['id']."------------->Old Date :".$record_row['user_allocation_date_c'];
        }
       // exit;
        }
