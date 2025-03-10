<?php

if(!defined('sugarEntry')) define('sugarEntry', true);

require_once('include/entryPoint.php');

class LeadsController extends SugarController{

	function LeadsController(){
		parent::SugarController();
	}
	function pre_editview(){
		//IF we have a prospect id leads convert it to a lead
		if (empty($this->bean->id) && !empty($_REQUEST['return_module']) &&$_REQUEST['return_module'] == 'Prospects' ) {
			
			$prospect=new Prospect();
			$prospect->retrieve($_REQUEST['return_id']);
			foreach($prospect->field_defs as $key=>$value)
			{
				if ($key == 'id' or $key=='deleted' )continue;
				if (isset($this->bean->field_defs[$key])) {
					$this->bean->$key = $prospect->$key;
				} 
			}
			$_POST['is_converted']=true;
		}
		return true;	
	}
	function action_editview(){
		$this->view = 'edit';
		return true;
	}
	
	protected function callLegacyCode(){
    	if(strtolower($this->do_action) == 'convertlead'){
        	if(file_exists('modules/Leads/ConvertLead.php') && !file_exists('custom/modules/Leads/metadata/convertdefs.php')){
	        	if(!empty($_REQUEST['emailAddressWidget'])) {
				   foreach($_REQUEST as $key=>$value) {
				   	  if(preg_match('/^Leads.*?emailAddress[\d]+$/', $key)) {
				   	  	 $_REQUEST['Leads_email_widget_id'] = 0;
				   	  	 break;
				   	  }
				   }
				}
        		$this->action_default();
                $this->_processed = true;
            }else{
            	$this->view = 'convertlead';
                $this->_processed = true;
            }
  		}else{
                parent::callLegacyCode();
        }
	}

	public function action_create_records (){

		global $sugar_config; 
		global $db;

		$module             = $_REQUEST['module'];
		$action             = $_REQUEST['action'];
		$to_pdf             = $_REQUEST['to_pdf'];
		$first_name         = $_REQUEST['first_name'];
		$last_name          = $_REQUEST['last_name'];
		$twitter_handle_c   = $_REQUEST['twitter_handle_c'];
		$lead_source        = $_REQUEST['lead_source'];
		$description        = $_REQUEST['description'];
		$lead_status        = $_REQUEST['lead_status'];	
		$status_id          = $_REQUEST['status_id'];

		$lead = new Lead();

		$lead->first_name              = $first_name;
		$lead->last_name               = $last_name;
		$lead->status                  = $lead_status;
		$lead->lead_source             = $lead_source;
		$lead->description             = $description;  
		$lead->tweet_id_c              = $status_id; 
		$lead->twitter_handle_c        = $twitter_handle_c;   


		$query1  =   "SELECT id_c FROM leads_cstm, leads WHERE id = id_c AND deleted = 0 AND  twitter_handle_c =  '$twitter_handle_c' AND lead_source = '$lead_source'"; // first_name and last_name for more meaningful filtering

		$value1  =   $db->query($query1);
		$check1  =   $get_values_row1  = $db->fetchByAssoc($value1);

		if(!$check1){
			$lead->save();	
			$created = "y";
		}

		if($check1){
			$created = "n";
		}		

		$sql = "SELECT id_c FROM leads_cstm, leads WHERE id = id_c AND deleted = 0 AND  twitter_handle_c =  '$twitter_handle_c' AND lead_source = '$lead_source'";

		$result = $db->query($sql);
		if($row6 = $db->fetchByAssoc($result)){
			$id_c = $row6['id_c'];                    
		}

		$data2= array();
		$data2['id_c']                = $id_c;
		$data2['created']             = $created;

		echo json_encode($data2);

	}   

} 
