<?php

if (!defined('sugarEntry') || !sugarEntry)
    die('Not A Valid Entry Point');
ini_set("display_errors", "On");
require_once('custom/include/language/en_us.lang.php');

class GenrateNoOfAttempts {

    public function GenrateNoOfAttemptsMethod(&$bean, $event, $args) {
        global $db, $app_list_strings, $sugar_config;

       $bean2 = BeanFactory::getBean($bean->fetched_row['parent_type'], $bean->fetched_row['parent_id']);
      
      
        if ($bean->fetched_row['parent_type'] == 'scrm_Products') {
            if ($bean2->load_relationship('scrm_products_activities_1_calls')) {
                $my_calls = $bean2->get_linked_beans('scrm_products_activities_1_calls', 'Calls');
            }
        } else if ($bean->fetched_row['parent_type'] == 'Contacts') {
            if ($bean2->load_relationship('calls')) {
                $my_calls = $bean2->get_linked_beans('calls', 'Calls');
            }
        }
       // print_r($my_calls);
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
//         print_r($array_call);

        if (!empty($array_call)) {

            $no_of_attempts = count($array_call);
        } else {
            $no_of_attempts = 0;
        }

        if ($bean->fetched_row['parent_type'] == 'scrm_Products') {
            $update_query = "UPDATE scrm_products_cstm SET no_of_attempts_c ='" . $no_of_attempts . "'  WHERE id_c = '" . $bean->fetched_row['parent_id'] . "'";
        } else if ($bean->fetched_row['parent_type'] == 'Contacts') {
            $update_query = "UPDATE contacts_cstm SET no_of_attempts_c ='" . $no_of_attempts . "'  WHERE id_c = '" . $bean->fetched_row['parent_id'] . "'";
        }
//echo "<br>";

        $updated_result = $db->query($update_query);
        if ($updated_result) {
     //       echo "<br>Record Updated Successfully --->" . $bean->fetched_row['parent_id'] . "------------->Parent Type:" .$bean->fetched_row['parent_type']."--------->Call Id:". $bean->fetched_row['id'];
        
        } else {
      //      echo "<br>Record Not Updated Successfully --->" . $bean->fetched_row['parent_id'] . "------------->Parent Type:" .$bean->fetched_row['parent_type']."--------->Call Id:". $bean->fetched_row['id'];
        }
        
       
       //exit;
    }

}
