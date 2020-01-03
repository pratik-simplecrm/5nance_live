<?php

if (!defined('sugarEntry'))
    define('sugarEntry', true);
require_once('include/SugarCharts/SugarChartFactory.php');
require_once('config.php');

class scrm_Custom_ReportsViewmultidispositionreportofproduct extends SugarView {

    private $chartV;

    function __construct() {
        parent::SugarView();
    }

    function display() {
        global $sugar_config, $db, $app_list_strings;
        $url = $sugar_config['site_url'];
        $current_date = date('d/m/Y');
        $start_date = date('01/m/Y');
        //Fetch Gateway
        $Gateway = '';
        if (!empty($GLOBALS['app_list_strings']['gateway_list'])) {
            foreach ($GLOBALS['app_list_strings']['gateway_list'] as $key => $val) {
                $flag = true;
                if (!empty($_REQUEST['Gateway'])) {

                    foreach ($_REQUEST['Gateway'] as $b_id) {
                        if ($b_id == $key) {
                            $val = $val;
                            $Gateway .= '<option label="' . $val . '" value="' . $key . '" selected >';
                            $Gateway .= $val;
                            $Gateway .= '</option>';
                            $flag = false;
                            break;
                        }
                    }
                }
                if ($flag) {
                    $val = ucwords($val);
                    $Gateway .= '<option label="' . $val . '" value="' . $key . '" >';
                    $Gateway .= $val;
                    $Gateway .= '</option>';
                }
            }
        }
        
         $productinterest = '';
        if (!empty($GLOBALS['app_list_strings']['product_interest_list'])) {
            foreach ($GLOBALS['app_list_strings']['product_interest_list'] as $key => $val) {
                $flag2 = true;
                if (!empty($_REQUEST['productinterest'])) {

                    foreach ($_REQUEST['productinterest'] as $b_id) {
                        if ($b_id == $key) {
                            $val = $val;
                            $productinterest .= '<option label="' . $val . '" value="' . $key . '" selected >';
                            $productinterest .= $val;
                            $productinterest .= '</option>';
                            $flag2 = false;
                            break;
                        }
                    }
                }
                if ($flag2) {
                    $val = ucwords($val);
                    $productinterest .= '<option label="' . $val . '" value="' . $key . '" >';
                    $productinterest .= $val;
                    $productinterest .= '</option>';
                }
            }
        }
        
           $salesadvisors = '';
        $select_advisor = "select u.user_name from users u LEFT JOIN users_cstm uc on u.id=uc.id_c  and u.deleted=0";
        $select_advistor_query = $db->query($select_advisor);
        while($get_advisor_row = $db->fetchByAssoc($select_advistor_query)){
           
     
            $flag3 = true;
                if (!empty($_REQUEST['salesadvisors'])) {


              
                if ($_REQUEST['salesadvisors']==$get_advisor_row['user_name']) {
                           $salesadvisors .= '<option label="' . $get_advisor_row['user_name'] . '" value="' . $get_advisor_row['user_name'] . '" selected >';
                            $salesadvisors .= $get_advisor_row['user_name'];
                            $salesadvisors .= '</option>';
               $flag3 = false;
                        
                }
                 }
                 if ($flag3) {
                    $salesadvisors .= '<option label="' . $get_advisor_row['user_name'] . '" value="' . $get_advisor_row['user_name'] . '" >';
                    $salesadvisors .= $get_advisor_row['user_name'];
                    $salesadvisors .= '</option>';
                 }
               
               
            }
        
        
       
                         
                
          

        echo ' <link rel="stylesheet" type="text/css" href="custom/modules/scrm_Custom_Reports/jquery.dataTables.min.css">
            <link rel="stylesheet" href="custom/modules/scrm_Custom_Reports/Report.css" type="text/css">
        <link rel="stylesheet" type="text/css" href="custom/modules/scrm_Custom_Reports/multi_disposition_report.css">
       
<script type="text/javascript" src="custom/modules/scrm_Custom_Reports/jquery.dataTables.min.js">	</script>';



        echo '
<form name = "run" method = "post" action = "">
<center>
<h2 style="font-size: 22px;color: #181818;">Multi Disposition Report of Products</h2>
</center>
<div style = "padding:22px; width:100%; background-color:#EEE;">


 <table><tr><td><strong>From: </strong><input type = "text" name = "from_date" id = "from_date" value="' . $_POST["from_date"] . '">&nbsp;<img border="0" src="themes/SuiteR/images/jscalendar.gif" id="fromb" align="absmiddle" />
					<script type="text/javascript">
						Calendar.setup({inputField   : "from_date",
						ifFormat      :    "%d/%m/%Y", 
						button       : "fromb",
						align        : "right"});
					</script></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td><strong>To: </strong><input type = "text" name = "to_date" id = "to_date" value="' . $_POST["to_date"] . '">&nbsp;<img border="0" src="themes/SuiteR/images/jscalendar.gif" id="tob" align="absmiddle" />
					<script type="text/javascript">
						Calendar.setup({inputField   : "to_date",
						ifFormat      :    "%d/%m/%Y", 
						button       : "tob",
						align        : "right"});
					</script>
</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td ><strong>Gateway (Source): </strong></td><td>
&nbsp;<select id="Gateway" name="Gateway[]" multiple style="height:150px">' . $Gateway . '</select>

</td>  
<td>&nbsp;&nbsp;</td>
<td ><strong>Product Interest: </strong></td><td>
&nbsp;<select id="productinterest" name="productinterest[]" multiple style="height:150px">' . $productinterest . '</select>

</td> 
<td>&nbsp;&nbsp;</td>
<td ><strong>No. of Attempts: </strong></td><td>
&nbsp;<input id="no_of_attempts" name="no_of_attempts" value=' . $_REQUEST['no_of_attempts'] . '>

</td> 
</tr>
<tr>
<td ><strong>Sales Advisors: </strong>
&nbsp;&nbsp;<select id="salesadvisors" name="salesadvisors" ><option value="" >Select Advisor</option>' . $salesadvisors . '</select>

</td> 
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
</table>

<br>

 
  <button type="submit" name="state" id ="submit" class="btn btn-primary">Run</button>
&nbsp&nbsp&nbsp&nbsp
<span id="clear"  class="btn btn-primary">Clear</span> 
&nbsp&nbsp&nbsp&nbsp<button type="submit" id="Export" name="Export" value="Export"  class="btn btn-primary">Export</button> 
<br>
</div>


</form>
';


//        $data = '';
//
        if (isset($_POST['Export'])) {
            $rows_list = $this->getContactsData();

            foreach ($rows_list as $row) {
                $data .= '<tr>';
                $data .= '<td>' . $row['unique_customer_code_c'] . '</td>';
                $data .= '<td>' . $row['first_name'] . '</td>';
                $data .= '<td>' . $row['last_name'] . '</td>';
                $data .= '<td>' . $row['email_address'] . '</td>';
                $data .= '<td>' . $row['phone_mobile'] . '</td>';
                $data .= '<td>' . $row['gateway_c'] . '</td>';
                $data .= '<td>' . $row['no_of_attempts_c'] . '</td>';
                $data .= '<td>' . $row['campaign_type_c'] . '</td>';
                $data .= '<td>' . $row['user_name'] . '</td>';
                $data .= '<td>' . $row['product_interest_c'] . '</td>';
                $data .= '<td>' . $row['product_sub_type_interest_c'] . '</td>';

                $data .= '<td>' . $row['utm_content_c'] . '</td>';
                $data .= '<td>' . $row['campaign_c'] . '</td>';
                $data .= '<td>' . $row['source_c'] . '</td>';

                $data .= '<td>' . $row['qparam_c'] . '</td>';
                $data .= '<td>' . $row['partner_name'] . '</td>';
                $data .= '<td>' . $row['partner_comment'] . '</td>';
                $data .= '<td>' . $row['date_entered'] . '</td>';
                $data .= '<td>' . $row['user_allocation_date_c'] . '</td>';
                $data .= '<td>' . $row['assignment_tat'] . '</td>';
                $data .= '<td>' . $row['sales_stage_c'] . '</td>';
                $data .= '<td>' . $row['next_call_planning_comments_c'] . '</td>';
                $data .= '<td>' . $row['latestdisposition'] . '</td>';
                $data .= '<td>' . $row['first_call_tat'] . '</td>';
                $data .= '<td>' . $row['date_modified'] . '</td>';
                $data .= '<td>' . $row['disposition1'] . '</td>';
                $data .= '<td>' . $row['disposition1_date_time'] . '</td>';
                $data .= '<td>' . $row['disposition2'] . '</td>';
                $data .= '<td>' . $row['disposition2_date_time'] . '</td>';
                $data .= '<td>' . $row['disposition3'] . '</td>';
                $data .= '<td>' . $row['disposition3_date_time'] . '</td>';
                $data .= '<td>' . $row['disposition4'] . '</td>';
                $data .= '<td>' . $row['disposition4_date_time'] . '</td>';
                $data .= '<td>' . $row['disposition5'] . '</td>';
                $data .= '<td>' . $row['disposition5_date_time'] . '</td>';
                $data .= '<td>' . $row['disposition6'] . '</td>';
                $data .= '<td>' . $row['disposition6_date_time'] . '</td>';
                $data .= '<td>' . $row['disposition7'] . '</td>';
                $data .= '<td>' . $row['disposition7_date_time'] . '</td>';
                $data .= '<td>' . $row['disposition8'] . '</td>';
                $data .= '<td>' . $row['disposition8_date_time'] . '</td>';
                $data .= '<td>' . $row['disposition9'] . '</td>';
                $data .= '<td>' . $row['disposition9_date_time'] . '</td>';
                $data .= '<td>' . $row['disposition10'] . '</td>';
                $data .= '<td>' . $row['disposition10_date_time'] . '</td>';
                $data .= '<td>' . $row['end_to_end_tat'] . '</td>';
                $data .= '</tr>';
            }
        }
        echo $html = <<<HTML
		
	<style>
	td,th
	{ text-align:center;}
	</style>
		<script type="text/javascript" language="javascript" class="init">



$(document).ready(function() {
                    
                   
		$('#dispositiontable').DataTable({
                    
		//"paging":   false,
        	"pageLength": 10,
                
                
		//"info":     false,
		"bLengthChange": true,
		"bProcessing": true,
		"bServerSide": true,
                  aoColumnDefs: [
        {bSortable: false,aTargets: [ -1 ]},
        {bSortable: false,aTargets: [ -2 ]}, 
        {bSortable: false,aTargets: [ -3 ]},
        {bSortable: false,aTargets: [ -4 ]}, 
        {bSortable: false,aTargets: [ -5 ]},
        {bSortable: false,aTargets: [ -6 ]},  
        {bSortable: false,aTargets: [ -7 ]},
        {bSortable: false,aTargets: [ -8 ]}, 
        {bSortable: false,aTargets: [ -9 ]},
        {bSortable: false,aTargets: [ -10 ]}, 
        {bSortable: false,aTargets: [ -11 ]},
        {bSortable: false,aTargets: [ -12 ]} ,
        {bSortable: false,aTargets: [ -13 ]},
        {bSortable: false,aTargets: [ -14 ]}, 
        {bSortable: false,aTargets: [ -15 ]},
        {bSortable: false,aTargets: [ -16 ]}, 
        {bSortable: false,aTargets: [ -17 ]},
        {bSortable: false,aTargets: [ -18 ]},  
        {bSortable: false,aTargets: [ -19 ]},
        {bSortable: false,aTargets: [ -20 ]}, 
        {bSortable: false,aTargets: [ -21 ]},
        {bSortable: false,aTargets: [ -22 ]},          
        {bSortable: false,aTargets: [ -23 ]},        
        
        {bSortable: false,aTargets: [ -27 ]}, 
        {bSortable: false,aTargets: [ -28 ]},  
        {bSortable: false,aTargets: [ -29 ]},        
           
                
],        
        sAjaxSource: "index.php?entryPoint=dispositions_report_server_processing_of_product",
        fnServerParams: function ( aoData ) {
		aoData.push( { "name": "from_date", "value": $("#from_date").val()},
		
                { "name": "to_date", "value": $("#to_date").val()},
                { "name": "Gateway", "value": $("#Gateway").val()},
                { "name": "productinterest", "value": $("#productinterest").val()},
                { "name": "no_of_attempts", "value": $("#no_of_attempts").val()},
                { "name": "salesadvisors", "value": $("#salesadvisors").val()},

		 );
		},
		"sPaginationType": "full_numbers",

		"oLanguage": {
		"sSearch": "Search all columns:",
		"oPaginate": {
		"sFirst": "<i class='fa fa-angle-double-left fa-2x ' aria-hidden='true'></i>",
		"sLast": "<i class='fa fa-angle-double-right fa-2x ' aria-hidden='true'></i>",
		"sNext": "<i class='fa fa-angle-right fa-2x ' aria-hidden='true'></i>",
		"sPrevious": "<i class='fa fa-angle-left fa-2x ' aria-hidden='true'></i>"
                }
                },
                
                "dom": 'Blfrtip',
        
                });
                });
	</script>
<br>
<div class="dt-example">
	<div class="col-sm-12" style="padding-top:12px;margin-left: 0px;">
		<section>
			
                        <div class="table-responsive">
			<table id="dispositiontable" class="table disposition-table display " cellspacing="0" width="100%">
				<thead>
					<tr height="20">
        
                       
                  <th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Lead ID </div></th>			
			<th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">First Name</div></th>			
			<th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Last Name</div></th>			
			<th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Email Address</div></th>			
			<th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Mobile Number</div></th>
			<th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Gateway (Source)</div></th>
                <th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">No. of Attempts</div></th>
			<th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Campaign Type</div></th>	
			<th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Sales Advisor</div></th>	
			<th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Product Interest	</div></th>
			<th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Product Sub Interest</div></th>
            <th data-toggle="true" scope="col">
                
                <div align="left" width="100%" style="white-space: normal;">UTM Content</div></th>
            <th data-toggle="true" scope="col">
                <div align="left" width="100%" style="white-space: normal;">Source Campaign</div></th>
            <th data-toggle="true" scope="col">
                <div align="left" width="100%" style="white-space: normal;">Source</div></th>
            <th data-toggle="true" scope="col">
                            <div align="left" width="100%" style="white-space: normal;">Publisher Sub ID</div></th>	
			<th data-toggle="true" scope="col">
                <div align="left" width="100%" style="white-space: normal;">Partner Name</div></th>
            <th data-toggle="true" scope="col">
                <div align="left" width="100%" style="white-space: normal;">Partner Comment</div></th>
			<th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">User Creation Date</div></th>	
            <th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Advisor Assignment Date/Time </div></th>			
			<th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Assignment TAT</div></th>			
			<th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Sales Stage</div></th>			
			<th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Comments</div></th>			
			<th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Latest Disposition</div></th>
			<th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">First Call TAT</div></th>
                        <th data-toggle="true" scope="col">
                                        <div align="left" width="100%" style="white-space: normal;">Last Modified</div></th>
                        <th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Disposition 1</div></th>
			<th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Date & Time</div></th>			
			<th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Disposition 2</div></th>	
			<th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Date & Time</div></th>	
			<th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Disposition 3</div></th>	
			<th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Date & Time</div></th>	
            <th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Disposition 4</div></th>	
			<th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Date & Time</div></th>	
            <th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Disposition 5</div></th>	
			<th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Date & Time</div></th>	
            <th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Disposition 6</div></th>	
			<th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Date & Time</div></th>	
            <th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Disposition 7</div></th>	
			<th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Date & Time</div></th>	
            <th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Disposition 8</div></th>	
			<th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Date & Time</div></th>	
            <th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Disposition 9</th>	</div>
			<th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Date & Time</div></th>	
            <th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Disposition 10</div></th>	
			<th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">Date & Time</div></th>	
            <th data-toggle="true" scope="col">
            				<div align="left" width="100%" style="white-space: normal;">End to End TAT</div></th>	
		    </tr>
				</thead>


				<tbody>
			
				</tbody>
			</table>
                </div>

			
				</div>

			</div>
		</section>
	</div>

</div>

	   <script>
  $(document).ready(function(){
	var from_date = $("#from_date").val();
	var to_date = $("#to_date").val();
	var current_date = '$current_date';
	var start_date = '$start_date';
	if((from_date=="")&&(to_date==""))
	{
	  $("#from_date").val(start_date);
	  $("#to_date").val(current_date);
	}   
	  
  	$("#clear").on("click",function(){
			$("#from_date").val("");
			$("#to_date").val("");
                $("#Gateway").val("");
                $("#productinterest").val("");
                $("#no_of_attempts").val("");
                
			return false;
		
		});
	});	
	</script>
HTML;
//        echo $_POST['Export'];
//        echo $_REQUEST['Export'];
        if (isset($_POST['Export'])) {
//            print_r($_POST['Gateway']);
//            echo "<pre>";
//            print_r($rows_list);

            $timestamp = date('Y_m_d_His');
            ob_end_clean();
            ob_start();
            // output headers so that the file is downloaded rather than displayed
            header('Content-Type: text/csv; charset=utf-8');
            header("Content-Disposition: attachment; filename=Multidispositionreport{$timestamp}.csv");

            // create a file pointer connected to the output stream
            $output = fopen('php://output', 'w');


            fputcsv($output, array('Lead ID', 'First Name', 'Last Name', 'Email Address', 'Mobile Number', 'Gateway (Source)','No. of Attempts', 'Campaign Type', 'Sales Advisor', 'Product Interest', 'Product Sub Interest', 'UTM Content', 'Source Campaign', 'Source', 'Publisher Sub ID','Partner Name','Partner Comment', 'User Creation Date', 'Advisor Assignment Date/Time', 'Assignment TAT', 'Sales Stage', 'Comments', 'Latest Disposition', 'First Call TAT', 'Last Modified', 'Disposition 1', 'Date & Time', 'Disposition 2', 'Date & Time', 'Disposition 3', 'Date & Time', 'Disposition 4', 'Date & Time', 'Disposition 5', 'Date & Time', 'Disposition 6', 'Date & Time', 'Disposition 7', 'Date & Time', 'Disposition 8', 'Date & Time', 'Disposition 9', 'Date & Time', 'Disposition 10', 'Date & Time', 'End to End TAT'));
            foreach ($rows_list as $v) {
                unset($v['from_date']);
                unset($v['to_date']);

                fputcsv($output, $v);
            }
            exit;
        }
    }

    function getContactsData() {

        global $db, $current_user, $app_list_strings;

        //~ $to_date = date("Y-m-d");
        //~ $from_date = date("Y-m-d", strtotime("-1 month", strtotime($to_date)));
        $to_date = $_POST['to_date'];
        $from_date = $_POST['from_date'];
        $gateway = $_POST['Gateway'];
        $productinterest = $_POST['productinterest'];
        $no_of_attempts = $_POST['no_of_attempts'];
        $salesadvisors = $_POST['salesadvisors'];
        if (empty($to_date) && empty($from_date)) {
            $to_date = date("d/m/Y");
            $from_date = date("m/Y");
            $from_date = "01/" . $from_date;
        }

        if (!empty($from_date)) {
            $fdate = explode('/', $from_date);
            $from_date = $fdate[2] . "-" . $fdate[1] . "-" . $fdate[0] . " " . "00:00:00";

            $from_date = date('Y-m-d H:i:s', strtotime('-330 minutes', strtotime($from_date)));

//			 $from_date = " and c.date_entered >= '$from_date' ";
        }

        if (!empty($to_date)) {
            $fdate = explode('/', $to_date);
            $to_date = $fdate[2] . "-" . $fdate[1] . "-" . $fdate[0] . " " . "23:59:59";
            // $to_date = $to_date . "23:59:59";
            // $to_date = date('Y-m-d H:i:s', strtotime('-5 hours', strtotime($to_date)));
            $to_date = date('Y-m-d H:i:s', strtotime('-330 minutes', strtotime($to_date)));

            // $to_date = " and c.date_entered <= '$to_date' ";
        }

if (!empty($gateway)) {
    if (is_array($gateway)) {
        $tmp = '';
        foreach ($gateway as $b_id) {
            if (!empty($b_id)) {
                if (empty($tmp))
                    $tmp = "'" . $b_id . "'";
                else
                    $tmp .= ",'" . $b_id . "'";
            }
        }
        if (!empty($tmp))
        {
            $gateway = "and cc.gateway_c in ($tmp)";
           
        }
        else
        {
            $gateway = '';
       
            
        }
    }
}
if (!empty($productinterest)) {
    if (is_array($productinterest)) {
        $tmp2 = '';
        foreach ($productinterest as $b_id2) {
            if (!empty($b_id2)) {
                if (empty($tmp2))
                    $tmp2 = "'" . $b_id2 . "'";
                else
                    $tmp2 .= ",'" . $b_id2 . "'";
            }
        }
        if (!empty($tmp2)){
            $productinterest = " and pc.product_interest_c in ($tmp2) ";
            $contactproductinterest = " and cc.product_interest_c in ($tmp2)";
        }
        else{
            $productinterest = '';
            $contactproductinterest = '';
        }
    }
}
if (!empty($no_of_attempts)) {
      $pro_no_of_attempts = " and pc.no_of_attempts_c =$no_of_attempts ";
      $con_no_of_attempts = " and cc.no_of_attempts_c =$no_of_attempts";
}
if (!empty($salesadvisors)) {
      $pro_salesadvisors = " and u.user_name ='".$salesadvisors."'";
      $con_salesadvisors = " and u.user_name ='".$salesadvisors."'";
}
$full_filter = " c.date_entered between '" . $from_date . "' AND '" . $to_date . "' $gateway $contactproductinterest $con_no_of_attempts $con_salesadvisors AND";
$pro_full_filter = " c.date_entered between '" . $from_date . "' AND '" . $to_date . "' $gateway $productinterest $pro_no_of_attempts $pro_salesadvisors AND";

        //fetch user role
//        $select_role_query = "select id from contacts where deleted=0";
//        $select_role = $db->query($select_role_query);
//        $select_role_row = $db->fetchByAssoc($select_role);
//        $contact_id = $select_role_row['id'];

        $data = $this->get_users_data($full_filter,$pro_full_filter);

        return $data;
    }

    function get_users_data($full_filter,$pro_full_filter) {
        global $db, $app_list_strings;
        $data = array();
        $r = 0;

        $contacts_query = "select SQL_CALC_FOUND_ROWS * from(SELECT c.id,'scrm_Products' as table_name,c.first_name,c.last_name, cc.leadid_c as unique_customer_code_c, ea.email_address as email_address, c.phone_mobile as phone_mobile, cc.gateway_c as gateway_c, pc.no_of_attempts_c as no_of_attempts_c,cc.campaign_type_c as campaign_type_c, u.user_name as user_name,pc.product_interest_c as product_interest_c,pc.product_sub_type_interest_c as product_sub_type_interest_c, p.date_entered as date_entered, pc.sales_stage_c as sales_stage_c, pc.next_call_planning_comments_c as next_call_planning_comments_c, cc.user_allocation_date_c as user_allocation_date_c, pc.disposition_c as latest_disposition,cc.qparam_c as publisher_subid,p.date_modified as date_modified,cc.utm_content_c as utm_content_c,cc.campaign_c as campaign_c, cc.source_c as source_c,cc.related_corporate_account_c as partner_name,cc.partner_comments_c as partner_comment, p.id as required_id
    FROM scrm_products p LEFT JOIN scrm_products_cstm pc on p.id=pc.id_c LEFT JOIN contacts_scrm_products_1_c cp on p.id=cp.contacts_scrm_products_1scrm_products_idb LEFT JOIN contacts c on c.id=cp.contacts_scrm_products_1contacts_ida LEFT JOIN contacts_cstm cc on c.id=cc.id_c LEFT JOIN users u on u.id = c.assigned_user_id LEFT JOIN email_addr_bean_rel eabl  ON eabl.bean_id = c.id AND eabl.bean_module = 'Contacts' and eabl.primary_address = 1 and eabl.deleted=0 LEFT JOIN email_addresses ea ON (ea.id = eabl.email_address_id) where $pro_full_filter  p.deleted=0 order by p.date_entered desc)a
union all
select * from(select c.id,'Contacts' as table_name,c.first_name,c.last_name,cc.leadid_c as unique_customer_code_c, ea.email_address as email_address, c.phone_mobile as phone_mobile, cc.gateway_c as gateway_c,cc.no_of_attempts_c as no_of_attempts_c, cc.campaign_type_c as campaign_type_c, u.user_name as user_name,cc.product_interest_c as product_interest_c,cc.product_sub_type_interest_c as product_sub_type_interest_c, c.date_entered as date_entered, cc.sales_stage_c as sales_stage_c, cc.next_call_planning_comments_c as next_call_planning_comments_c, cc.user_allocation_date_c as user_allocation_date_c, cc.disposition_c as latest_disposition,cc.qparam_c as publisher_subid,c.date_modified as date_modified,cc.utm_content_c as utm_content_c,cc.campaign_c as campaign_c, cc.source_c as source_c,cc.related_corporate_account_c as partner_name,cc.partner_comments_c as partner_comment,c.id as required_id from contacts c LEFT join contacts_cstm cc on c.id=cc.id_c LEFT join users u on u.id = c.assigned_user_id LEFT JOIN email_addr_bean_rel eabl  ON eabl.bean_id = c.id AND eabl.bean_module = 'Contacts' and eabl.primary_address = 1 and eabl.deleted=0 LEFT JOIN email_addresses ea ON (ea.id = eabl.email_address_id) where $full_filter  c.deleted=0 AND u.user_name !='poorti' AND cc.gateway_c!='' order by c.date_entered desc)b ";
        $contact_result = $db->query($contacts_query);
        $disposition_list = $GLOBALS['app_list_strings']['disposition_list'];
        $old_disposition_list = $GLOBALS['app_list_strings']['old_disposition_list'];
        $disposition_list = array_merge($disposition_list, $old_disposition_list);

//        echo 'testing';
//        print_r($disposition_list);
        // print_r($contact_row);
        while ($contact_row = $db->fetchByAssoc($contact_result)) {
            $data[$r]['unique_customer_code_c'] = $contact_row['unique_customer_code_c'];
           // $data[$r]['table_name'] = $contact_row['table_name'];

            $data[$r]['first_name'] = $contact_row['first_name'];
            $data[$r]['last_name'] = $contact_row['last_name'];
            $data[$r]['email_address'] = $contact_row['email_address'];
            $data[$r]['phone_mobile'] = $contact_row['phone_mobile'];
            $data[$r]['gateway_c'] = $contact_row['gateway_c'];
            $data[$r]['no_of_attempts_c'] = $contact_row['no_of_attempts_c'];
            $data[$r]['campaign_type_c'] = $contact_row['campaign_type_c'];
            $data[$r]['user_name'] = $contact_row['user_name'];
            $data[$r]['product_interest_c'] = $contact_row['product_interest_c'];
            $data[$r]['product_sub_type_interest_c'] = $contact_row['product_sub_type_interest_c'];

            $data[$r]['utm_content_c'] = $contact_row['utm_content_c'];
            $data[$r]['campaign_c'] = $contact_row['campaign_c'];
            $data[$r]['source_c'] = $contact_row['source_c'];

            $data[$r]['publisher_subid'] = $contact_row['publisher_subid'];
            $data[$r]['partner_name'] = $contact_row['partner_name'];
            $data[$r]['partner_comment'] = $contact_row['partner_comment'];
            $data[$r]['date_entered'] = date('d/m/Y h:i a ', strtotime('+5 hours  +30 minutes', strtotime($contact_row['date_entered'])));
            $data[$r]['user_allocation_date_c'] = (!empty($contact_row['user_allocation_date_c']) ? date('d/m/Y h:i a ', strtotime('+5 hours  +30 minutes', strtotime($contact_row['user_allocation_date_c']))) : '');

            if (!empty($contact_row['user_allocation_date_c'])) {
                $seconds = strtotime($contact_row['user_allocation_date_c']) - strtotime($contact_row['date_entered']);

                if (strtotime($contact_row['user_allocation_date_c']) > strtotime($contact_row['date_entered'])) {

                    $hours = floor($seconds / 3600);
                    $minutes = floor(($seconds / 60) % 60);
                    $second = $seconds % 60;
                } else {
                    $hours = "00";
                    $minutes = "00";
                    $second = "00";
                }
                $assignment_tat = $hours . ":" . $minutes . ":" . $second;
            }
            $data[$r]['assignment_tat'] = (!empty($contact_row['user_allocation_date_c'])) ? $assignment_tat : '';
            $data[$r]['sales_stage_c'] = $contact_row['sales_stage_c'];
            $data[$r]['next_call_planning_comments_c'] = utf8_encode($contact_row['next_call_planning_comments_c']);


            $bean = BeanFactory::getBean('Contacts', $contact_row['id']);

            //If relationship is loaded
            if ($bean->load_relationship('calls')) {
                $my_calls = $bean->get_linked_beans('calls', 'Calls');
            }
//            if ($bean->load_relationship('contacts_scrm_products_1')) {
//                $my_products = $bean->get_linked_beans('contacts_scrm_products_1', 'scrm_Products');
//            }

            $array_call = '';
            $get_first_call = '';
            foreach ($my_calls as $calls) {

                if ($calls->status == "Held" || $calls->status == "Missed" || $calls->status == "Not Held") {
                    if($calls->direction == "Inbound")
                {
                $firstcall_date='date_modified';
                }else
                {
                 $firstcall_date='date_entered';
                }
                    $get_first_call[] = array(
                        "name" => $calls->name,
                        "date_start" => date('Y-m-d H:i:s', strtotime('+5 hours +30 minutes', strtotime(($calls->fetched_row[$firstcall_date])))));
                }
                if (($calls->status == "Held" || $calls->status == "Missed" || $calls->status == "Not Held" )&& $calls->created_by != '1' && in_array(trim($calls->name), $disposition_list)) {

                    $array_call[] = array(
                        "name" => $calls->name,
                        "date_start" => date('Y-m-d H:i:s', strtotime('+5 hours +30 minutes', strtotime(($calls->fetched_row['date_modified'])))),
                            // "date_start" => $calls->date_start,
                    );
                }
            }

            if (!empty($array_call)) {
                $name = 'date_start';
                usort($array_call, function($a, $b) {
                    $ad = new DateTime($a['date_start']);
                    $bd = new DateTime($b['date_start']);

                    if ($ad == $bd) {
                        return 0;
                    }

                    return $ad < $bd ? -1 : 1;
                });
            }

            if (!empty($get_first_call)) {
                usort($get_first_call, function($a, $b) {
                    $ad = new DateTime($a['date_start']);
                    $bd = new DateTime($b['date_start']);

                    if ($ad == $bd) {
                        return 0;
                    }

                    return $ad < $bd ? -1 : 1;
                });
            }

            if (!empty($array_call)) {
                $array_call = array_reverse($array_call);
                $end_disposition_date = end($array_call);
            }
            // $first_disposition_date = end($array_call_next);
            //  $row[] = $array_call[0]['name'];
// print_r($end_disposition_date);
// print_r($first_disposition_date);


            $data[$r]['latestdisposition'] = $contact_row['latest_disposition'];


            if (!empty($get_first_call[0]['date_start']) && !empty($contact_row['user_allocation_date_c'])) {
                $first_call_second = strtotime('-5 hours -30 minutes', strtotime($get_first_call[0]['date_start'])) - strtotime($contact_row['user_allocation_date_c']);


                if (strtotime('-5 hours -30 minutes', strtotime($get_first_call[0]['date_start'])) > strtotime($contact_row['user_allocation_date_c'])) {
                    $first_call_hours = floor($first_call_second / 3600);
                    $first_call_minutes = floor(($first_call_second / 60) % 60);
                    $first_call_seconds = $first_call_second % 60;
                } else {
                    $first_call_hours = "00";
                    $first_call_minutes = "00";
                    $first_call_seconds = "00";
                }
                $first_call_tat = $first_call_hours . ":" . $first_call_minutes . ":" . $first_call_seconds;
            }
            $data[$r]['first_call_tat'] = (!empty($get_first_call[0]['date_start'])) ? $first_call_tat : '';
            $data[$r]['date_modified'] = date('d/m/Y h:i a ', strtotime('+5 hours  +30 minutes', strtotime($contact_row['date_modified'])));
            $data[$r]['disposition1'] = (!empty($array_call[0]['name'])) ? $array_call[0]['name'] : '';
            $data[$r]['disposition1_date_time'] = (!empty($array_call[0]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[0]['date_start']))) : '';
            $data[$r]['disposition2'] = (!empty($array_call[1]['name'])) ? $array_call[1]['name'] : '';
            $data[$r]['disposition2_date_time'] = (!empty($array_call[1]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[1]['date_start']))) : '';
            $data[$r]['disposition3'] = (!empty($array_call[2]['name'])) ? $array_call[2]['name'] : '';
            $data[$r]['disposition3_date_time'] = (!empty($array_call[2]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[2]['date_start']))) : '';
            $data[$r]['disposition4'] = (!empty($array_call[3]['name'])) ? $array_call[3]['name'] : '';
            $data[$r]['disposition4_date_time'] = (!empty($array_call[3]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[3]['date_start']))) : '';
            $data[$r]['disposition5'] = (!empty($array_call[4]['name'])) ? $array_call[4]['name'] : '';
            $data[$r]['disposition5_date_time'] = (!empty($array_call[4]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[4]['date_start']))) : '';
            $data[$r]['disposition6'] = (!empty($array_call[5]['name'])) ? $array_call[5]['name'] : '';
            $data[$r]['disposition6_date_time'] = (!empty($array_call[5]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[5]['date_start']))) : '';
            $data[$r]['disposition7'] = (!empty($array_call[6]['name'])) ? $array_call[6]['name'] : '';
            $data[$r]['disposition7_date_time'] = (!empty($array_call[6]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[6]['date_start']))) : '';
            $data[$r]['disposition8'] = (!empty($array_call[7]['name'])) ? $array_call[7]['name'] : '';
            $data[$r]['disposition8_date_time'] = (!empty($array_call[7]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[7]['date_start']))) : '';
            $data[$r]['disposition9'] = (!empty($array_call[8]['name'])) ? $array_call[8]['name'] : '';
            $data[$r]['disposition9_date_time'] = (!empty($array_call[8]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[8]['date_start']))) : '';
            $data[$r]['disposition10'] = (!empty($array_call[9]['name'])) ? $array_call[9]['name'] : '';
            $data[$r]['disposition10_date_time'] = (!empty($array_call[9]['date_start'])) ? (date('d/m/Y h:i a', strtotime($array_call[9]['date_start']))) : '';

            if (!empty($end_disposition_date['date_start'])) {
                $end_to_end_tat_seconds = strtotime('-5 hours -30 minutes', strtotime($end_disposition_date['date_start'])) - strtotime($contact_row['date_entered']);


                if (strtotime('-5 hours -30 minutes', strtotime($end_disposition_date['date_start'])) > strtotime($contact_row['date_entered'])) {
                    $end_to_end_tat_hours = floor($end_to_end_tat_seconds / 3600);
                    $end_to_end_tat_minutes = floor(($end_to_end_tat_seconds / 60) % 60);
                    $end_to_end_tat_second = $end_to_end_tat_seconds % 60;
                } else {
                    $end_to_end_tat_hours = "00";
                    $end_to_end_tat_minutes = "00";
                    $end_to_end_tat_second = "00";
                }
                $end_to_end_tat = $end_to_end_tat_hours . ":" . $end_to_end_tat_minutes . ":" . $end_to_end_tat_second;
            }
            $data[$r]['end_to_end_tat'] = (!empty($end_disposition_date['date_start'])) ? $end_to_end_tat : '';


            unset($array_call);
            unset($end_disposition_date['date_start']);
            $r++;
        }
        return $data;
    }

}
