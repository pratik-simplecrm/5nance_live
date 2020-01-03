<?php
if(!defined('sugarEntry')) die('Not a Valid Entry Point');

//require_once('modules/bhea_Reports/report_utils.php');

class scrm_Custom_ReportsController extends SugarController {
	
	
	
	//Multi Disposition Report
	function action_multi_disposition_report() {
        $this->view = 'multidispositionreport';
    }
    function action_multi_disposition_report_product() {
        $this->view = 'multidispositionreportofproduct';
    }
    //Responded Customer Report
    function action_responded_customer_report() {
        $this->view = 'responded_customer_report';
    }

}

?>
