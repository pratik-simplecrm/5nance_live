<?php

if (!defined('sugarEntry') || !sugarEntry)
    die('Not A Valid Entry Point');

//ini_set('display_errors','On');
class AddCustomDateModifiedClass {

    public function AddCustomDateModifiedFunction($bean, $event, $arguments) {
        global $db, $current_user;
        if ($current_user->id != 1) {
//                $bean->custom_date_modified_c=$bean->date_modified;
//                $bean->user_id_c=$current_user->id;
            $custom_fields_update = "update contacts_cstm set custom_date_modified_c = '$bean->date_modified', user_id_c = '$current_user->id' where id_c = '" . $bean->id . "' ";
            $contact_result_update = $db->query($custom_fields_update);
            if (isset($contact_result_update)) {
               // echo "Custom Date Modified and Custom Modified User updated in contacts<br/>";
            }
        }

        //   exit;
    }

}

?>
