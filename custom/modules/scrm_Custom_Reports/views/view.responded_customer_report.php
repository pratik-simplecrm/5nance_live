<?php

if (!defined('sugarEntry'))
    define('sugarEntry', true);
require_once('include/SugarCharts/SugarChartFactory.php');
require_once('config.php');

class scrm_Custom_ReportsViewresponded_customer_report extends SugarView {
private $chartV;

    function __construct(){    
        parent::SugarView();
    }
   

    function display() {
        global $sugar_config, $db, $app_list_strings;
        $url = $sugar_config['site_url'];
        $current_date = date('d/m/Y');
        $start_date = date('01/m/Y');
 

        echo ' <link rel="stylesheet" type="text/css" href="custom/modules/scrm_Custom_Reports/jquery.dataTables.min.css">
            <link rel="stylesheet" href="custom/modules/scrm_Custom_Reports/Report.css" type="text/css">
        <link rel="stylesheet" type="text/css" href="custom/modules/scrm_Custom_Reports/multi_disposition_report.css">
       
<script type="text/javascript" src="custom/modules/scrm_Custom_Reports/jquery.dataTables.min.js">   </script>';



        echo '
<form name = "run" method = "post" action = "">
<center>
<h2 style="font-size: 22px;color: #181818;">Responded Customer Report</h2>
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
                    </script></td>
</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td>                                        

</tr></table>

<br>

 
  <button type="submit" name="state" id ="submit" class="btn btn-primary">Run</button>
&nbsp&nbsp&nbsp&nbsp
<span id="clear"  class="btn btn-primary">Clear</span> 
&nbsp&nbsp&nbsp&nbsp<button type="submit" id="Export" name="Export" value="Export"  class="btn btn-primary">Export</button> 
<br>
</div>


</form>
';

	$data = '';
	$rows_list = $this->getMatrixData();
	//print_r($rows_list);
	$date_record_filter='';
	if(!empty($_POST['from_date']) && !empty($_POST['to_date']))
					{
						$date_record_filter='&start_range_date_entered_advanced='.$_POST['from_date'].'&date_entered_advanced_range_choice=between&end_range_date_entered_advanced='.$_POST['to_date'];
					}
	foreach($rows_list as $row){
	 
			$data .= '<tr>';		
				$data .='<td>'.$row['name'].'</td>';
				$data .='<td>'.$row['email_address'].'</td>';
				$data .='<td>'.$row['phone_mobile'].'</td>';
				$data .='<td>'.$row['parent_type'].'</td>';
				$data .='<td>'.$row['campaign_c'].'</td>';
				$data .='<td>'.$row['source_c'].'</td>';
				$data .='<td>'.$row['call_datetime'].'</td>';
				$data .='<td>'.$row['linkclicked_date_c'].'</td>';
				$data .='<td>'.$row['registration_date_c'].'</td>';
				$data .='<td>'.$row['corporate_name'].'</td>';
			$data .= '</tr>';
	}
	$subtitle= 'Noumber of leads by status:'.$_POST['from_date'].' To '.$_POST['to_date'];
	if(empty($_POST['from_date']) && empty($_POST['to_date'])){
		$subtitle= 'Please click on Run button';
		}

		echo $html =<<<HTML
			<style>
			td,th
			{ text-align:center !important;}
			</style>

			<script type="text/javascript" language="javascript" class="init">
			</script>
		</head>
	
		<body class="dt-example">
			<div class="container table-responsive" style="padding-top:40px;" >
			<table id="example" class="table table-bordered display" >
						<thead>
	 					<tr>
								<td><b>Name</b></td>
								<td><b>Email Address</b></td>
								<td><b>Mobile</b></td>
								<td><b>Type</b></td>
								<td><b>Campaign</b></td>
								<td><b>Source</b></td>
								<td><b>Call Datetime</b></td>
								<td><b>Link Clicked Date</b></td>
								<td><b>Resgistered Date</b></td>
								<td><b>Corporate Name</b></td>
							</tr>
						</thead>


						<tbody>
							$data
						</tbody>
					</table>
			</div>

		</body>
		 <script>
		  $(document).ready(function(){
			var table = $('#example').DataTable( {
				dom: 'Bfrtip',
				//paging:   false,
				ordering: false,
				//info:     false,
				// scrollY:   "400px",
				//scrollCollapse:true,
				buttons: [
            	
        		]
        		 		
			} );
		    
		    
		    $('a.toggle-vis').on( 'click', function (e) {
		        e.preventDefault();
		 
		        // Get the column API object
		        var column = table.column( $(this).attr('data-column') );
		 
		        // Toggle the visibility
		        column.visible( ! column.visible() );
		    } );

		  	$('.select2').select2();


			});
		  </script>
		</html>
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
			$("#from_date").val(" ");
			$("#to_date").val(" ");
			$('select option').removeAttr("selected");
			// alert("OK");
			return false;
		
		});
	});	
	</script>
HTML;

echo $_POST['Export'];
echo $_REQUEST['Export'];
		if(!empty($_POST['Export']))
		{
			$timestamp = date('Y_m_d_His'); 
			ob_end_clean();
			ob_start();	
			// output headers so that the file is downloaded rather than displayed
			header('Content-Type: text/csv; charset=utf-8');
			header("Content-Disposition: attachment; filename=Responded_Customer_Report{$timestamp}.csv");

			// create a file pointer connected to the output stream
			$output = fopen('php://output', 'w');
			fputcsv($output,array('Name', 'Email Address' , 'Mobile' , 'Type' , 'Campaign' , 'Source', 'Call Datetime', 'Link Clicked Date', 'Resgistered Date','Corporate Name'));
				foreach ($rows_list as $v) {
					//~ 
				//~ if(!($v['name'])){
					//~ $v['name']='test';
					//~ };
				//~ 
			    //~ unset($v['from_date']);
			    //~ unset($v['to_date']); 
			    //~ unset($v['to_date']);  
			    //~ unset($v['user_id']);
			    //~ unset($v['l_id']);
			    //~ unset($v['op_id']);
			    //~ unset($v['first_name']);
			    //~ unset($v['last_name']);
			 	
				fputcsv($output,$v);
			}
				exit;
					
		}
		
   
	}
	
	
	function getMatrixData()
	{
		
		global $db;	
		
				//From Date & To Date filter Condition
		  if(empty($_REQUEST['from_date'])){
			  $_REQUEST['from_date']=date('01/m/Y');
			  			  }
          if(empty($_REQUEST['to_date'])){
			  $_REQUEST['to_date']=date('d/m/Y');		  
			  }
		
		
		
		$from_date = $_REQUEST['from_date'];
		
		if(!empty($from_date))
		{
			$tmp = explode("/",$from_date);
			if( count($tmp) == 3)
			{
				$from_date = $tmp[2].'-'.$tmp[1].'-'.$tmp[0];
			} else 
			$from_date = '';
		}
		if(!empty($from_date))
		{
            
             $from_date = date('Y-m-d H:i:s', strtotime('-5 hours', strtotime($from_date)));
             $from_date = date('Y-m-d H:i:s', strtotime('-30 minutes', strtotime($from_date)));
             
			$from_date = " and c.date_entered >= '$from_date' ";
		}
		$to_date = $_REQUEST['to_date'];
		if(!empty($to_date))
		{
			$tmp = explode("/",$to_date);
			if( count($tmp) == 3)
			{
				$to_date = $tmp[2].'-'.$tmp[1].'-'.($tmp[0]);
				$to_date = date('Y-m-d', strtotime($to_date. ' + 1 days'));
				//$to_date = $tmp[2].'-'.$tmp[1].'-'.($tmp[0]+1);
			} else 
			$to_date = '';
		}
		if(!empty($to_date))
		{
             $to_date = date('Y-m-d H:i:s', strtotime('-5 hours', strtotime($to_date)));
             $to_date = date('Y-m-d H:i:s', strtotime('-30 minutes', strtotime($to_date)));
             
			$to_date = " and c.date_entered <= '$to_date' ";
		}
		
		

		global $current_user;
		//AND registration_date_c IS NOT NULL       
		 $query_main = "SELECT c.id as call_id ,c.name as name , c.parent_type as parent_type, c.parent_id as parent_id, cc.linkclicked_date_c as linkclicked_date_c, cc.registration_date_c as registration_date_c, c.date_entered as call_datetime FROM calls c , calls_cstm cc WHERE c.id=cc.id_c AND c.deleted=0 AND cc.dstphone_c='6723' $to_date $from_date   ";

		$result_main = $db->query($query_main);
		while($row_main = $db->fetchByAssoc($result_main))
		{	
					$call_name = $row_main['name'];
					$call_id = $row_main['call_id'];
					$parent_type = $row_main['parent_type'];
					$parent_id = $row_main['parent_id'];
					$linkclicked_date_c = $row_main['linkclicked_date_c'];
					$registration_date_c = $row_main['registration_date_c'];			
					$call_datetime = $row_main['call_datetime'];			
					$call_datetime = date('Y-m-d h:i:s A', strtotime('+330 minutes', strtotime($call_datetime)));

					if($parent_type=='Contacts'){
						$parentQuery = "SELECT c.first_name as first_name, c.last_name as last_name, cc.leadid_c as unique_customer_code_c, ea.email_address as email_address, c.phone_mobile as phone_mobile, cc.campaign_type_c as campaign_type_c,cc.campaign_c as campaign_c, cc.source_c as source_c, a.name as corporate_name FROM contacts c LEFT JOIN contacts_cstm cc ON c.id = cc.id_c LEFT JOIN email_addr_bean_rel eabl  ON eabl.bean_id = c.id AND eabl.bean_module = 'Contacts' and eabl.primary_address = 1 and eabl.deleted=0 LEFT JOIN email_addresses ea ON (ea.id = eabl.email_address_id) LEFT JOIN accounts_contacts ac ON ac.contact_id=c.id AND ac.deleted=0 LEFT JOIN accounts a ON a.id=ac.account_id where c.id='$parent_id' AND c.deleted=0 ";

						$parentResult = $db->query($parentQuery);
						while($parentRow = $db->fetchByAssoc($parentResult)){
								$first_name = $parentRow['first_name'];
								$last_name = $parentRow['last_name'];
								$unique_customer_code_c = $parentRow['unique_customer_code_c'];
								$email_address = $parentRow['email_address'];
								$phone_mobile = $parentRow['phone_mobile'];
								$campaign_type_c = $parentRow['campaign_type_c'];
								$campaign_c = $parentRow['campaign_c'];
								$source_c = $parentRow['source_c'];
								$corporate_name = $parentRow['corporate_name'];
							}
					}elseif($parent_type=='Leads'){
						$parentQuery = "SELECT l.first_name as first_name, l.last_name as last_name, ea.email_address as email_address, l.phone_mobile as phone_mobile, a.name as corporate_name FROM leads l LEFT JOIN leads_cstm lc ON l.id = lc.id_c LEFT JOIN email_addr_bean_rel eabl  ON eabl.bean_id = l.id AND eabl.bean_module = 'Leads' and eabl.primary_address = 1 and eabl.deleted=0 LEFT JOIN email_addresses ea ON (ea.id = eabl.email_address_id) LEFT JOIN accounts a ON a.id=l.account_id where l.id='$parent_id' AND l.deleted=0 ";

						$parentResult = $db->query($parentQuery);
						while($parentRow = $db->fetchByAssoc($parentResult)){
								$first_name = $parentRow['first_name'];
								$last_name = $parentRow['last_name'];
								$email_address = $parentRow['email_address'];
								$phone_mobile = $parentRow['phone_mobile'];
								$campaign_type_c = '';
								$campaign_c = '';
								$source_c = '';
								$corporate_name = $parentRow['corporate_name'];
							}
					}
					//$data[$r]['unique_customer_code_c']		 	= $unique_customer_code_c;
					
					if($first_name){
						$name="$first_name $last_name";
						}else{
							$name=$last_name;
							}
					$data[$r]['name']		 			= $name;
					$data[$r]['email_address']			= $email_address;
					$data[$r]['phone_mobile']		 	= $phone_mobile;
					$data[$r]['parent_type']		 		= $parent_type;
					$data[$r]['campaign_c']		 		= $campaign_c;
					$data[$r]['source_c']		 		= $source_c;
					$data[$r]['call_datetime']			= $call_datetime;	
					$data[$r]['linkclicked_date_c']		= $linkclicked_date_c;	
					$data[$r]['registration_date_c']	= $registration_date_c;	
					$data[$r]['corporate_name']			= $corporate_name;	
					$r++;
			}		
		return $data;
	}
 }
