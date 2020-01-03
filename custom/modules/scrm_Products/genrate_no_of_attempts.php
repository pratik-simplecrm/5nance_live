<?php

if (!defined('sugarEntry') || !sugarEntry)
    die('Not A Valid Entry Point');
ini_set("display_errors", "On");
require_once('custom/include/language/en_us.lang.php');

class GenrateProductsNoOfAttempts {

    public function GenrateProductsNoOfAttemptsMethod(&$bean, $event, $args) {
        global $db, $app_list_strings, $sugar_config;
//echo "<pre>";
    
            if ($bean->load_relationship('scrm_products_activities_1_calls')) {
        $my_calls = $bean->get_linked_beans('scrm_products_activities_1_calls', 'Calls');
    }
       
         //   print_r($my_calls);
        $disposition_list = $GLOBALS['app_list_strings']['disposition_list'];
        $old_disposition_list = $GLOBALS['app_list_strings']['old_disposition_list'];
        $disposition_list = array_merge($disposition_list, $old_disposition_list);
        $array_call = '';

        foreach ($my_calls as $calls) {
            if (($calls->status == "Held" || $calls->status == "Missed" || $calls->status == "Not Held" ) && $calls->created_by != '1' && in_array(trim($calls->name), $disposition_list)) {

                $array_call[] = array(
                    "name" => $calls->name,
                    "date_start" => date('Y-m-d H:i:s', strtotime('+5 hours +30 minutes', strtotime(($calls->fetched_row['date_modified'])))),
                        // "date_start" => $calls->date_start,
                );
            }
        }
        //   print_r($array_call);

        if (!empty($array_call)) {

            $no_of_attempts = count($array_call);
        } else {
            $no_of_attempts = 0;
        }

     
                 $update_query="UPDATE scrm_products_cstm SET no_of_attempts_c ='".$no_of_attempts."'  WHERE id_c = '".$bean->id."'";
  
//echo "<br>";

        $updated_result = $db->query($update_query);
        if ($updated_result) {
          //  echo "<br>Record Updated Successfully --->" . $bean->id ;

        } else {
          //  echo "<br>Record Not Updated Successfully --->" . $bean->id;
        }


      
    }

}
