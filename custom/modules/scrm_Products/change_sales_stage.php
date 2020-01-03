<?php

if (!defined('sugarEntry') || !sugarEntry)
    die('Not A Valid Entry Point');
//ini_set("display_errors", "On");

class BeforeSaveProducts {

    public function ChangeSalesStage(&$bean, $event, $args) {
        global $db, $app_list_strings, $sugar_config;
        $sales_stage = $bean->sales_stage_c;
        $sales_option = str_replace(" ", "_", $sales_stage);

        //print_r($sales_stage_dropped_list);
         $disposition = $bean->disposition_c;
        if (!empty($disposition)) {
            $disposition_list = $app_list_strings['disposition_' . $sales_option . '_list'];

            $sales_stage_dropped_list = $app_list_strings['sales_stage__Dropped_' . $sales_option . '_list'];

            $sales_stage__Moves_to_Customer_list = $app_list_strings['sales_stage__Moves_to_Customer_list'];
            $sales_stage__moves_to_Interested_list = $app_list_strings['sales_stage__moves_to_Interested_list'];
            $sales_stage__moves_to_Opportunity_list = $app_list_strings['sales_stage__moves_to_Opportunity_list'];
            $sales_stage__moves_to_Not_Contactable_list = $app_list_strings['sales_stage__moves_to_Not_Contactable_list'];
            $sales_stage__moves_to_Disqualified_list = $app_list_strings['sales_stage__moves_to_Disqualified_list'];
            //$disposition_User_list = $app_list_strings['disposition_User_list'];


            if (in_array($disposition, $sales_stage_dropped_list)) {
                $bean->sales_stage_c = 'Dropped ' . $sales_stage;
            } else if (in_array($disposition, $sales_stage__Moves_to_Customer_list)) {
                $bean->sales_stage_c = 'Customer';
            } else if (in_array($disposition, $sales_stage__moves_to_Not_Contactable_list)) {
                $bean->sales_stage_c = 'Not_Contactable';
            } else if (in_array($disposition, $sales_stage__moves_to_Interested_list)) {
                $bean->sales_stage_c = 'Interested_Customer';
            } else if (in_array($disposition, $sales_stage__moves_to_Opportunity_list)) {
                $bean->sales_stage_c = 'Opportunity';
            } else if (in_array($disposition, $sales_stage__moves_to_Disqualified_list)) {
                $bean->sales_stage_c = 'Disqualified_Lead';
            } else if ($disposition == 'Callback/Follow up' && $sales_stage == 'Disqualified_Lead') {
                $bean->sales_stage_c = 'User';
            } else if ($disposition == 'Callback/Follow up' && $sales_stage == 'Not_Contactable') {
                $bean->sales_stage_c = 'User';
            }
        }
        //exit;
    }

}
