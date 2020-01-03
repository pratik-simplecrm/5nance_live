<?php
if (!define('sugarEntry'))
    define('sugarEntry', true);
require_once('include/entryPoint.php');
require_once('config.php');
ini_set('display_errors','On');
global $db, $app_list_strings,$sugar_config;


$forclose_query    = "SELECT * FROM cases WHERE date_entered = '2018-02-23 12:43:02' and deleted=0";
	$query_result   = $db->query($forclose_query);
        echo "Total Tickets :-";
        echo $count_record   = $query_result->num_rows;
        echo "<pre>";
        $i=1;
        while($get_row = $db->fetchByAssoc($query_result)) {
            echo "<br>Total Updated Record :-".$i."<br>";
            print_r($get_row);
            
                    $update_query="UPDATE cases SET deleted =1  WHERE id = '".$get_row['id']."' and deleted=0";
      $updated_result   = $db->query($update_query);
        if($updated_result){
            echo "<br>Record Updated Successfully --->".$get_row['id']."------------->Ticket Name:".$get_row['name'];
             $i++;
        }else{
            echo "<br>Record Not Updated Successfully --->".$get_row['id']."------------->Ticket Name :".$get_row['name'];
        }
        echo "<br>";
     
  
        }
?>