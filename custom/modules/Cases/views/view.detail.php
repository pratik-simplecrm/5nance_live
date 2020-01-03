<?php
//ini_set('display_errors','On');
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/MVC/View/views/view.detail.php');

class CasesViewDetail extends ViewDetail {


 	function CasesViewDetail(){
 		parent::ViewDetail();
 	}

 	function display(){
				
		if(empty($this->bean->id)){
			global $app_strings;
			sugar_die($app_strings['ERROR_NO_RECORD']);
		}

		$this->dv->process();
		global $mod_strings, $sugar_config;
		global $db;
		
        $record_id = $this->bean->id;
        $baseUrl   = $sugar_config['site_url'] . '/index.php';
        //~ echo $html = trim(from_html($this->bean->description));
          //~ $tiny = new SugarTinyMCE();
        //~ echo $tiny->getInstance('update_text,description', 'email_compose_light');
        
      	// Send SMS - start

		$id         = $this->bean->id;
		$mobile     = $this->bean->mobile_number_c;
		$full_name  = $this->bean->contacts_cases_1_name;
	
		$d = $this->view_object_map['d'];
		if($d=='2'){
			echo 'correct';
		}

		global $sugar_config;
		global $db;

		$query1="SELECT * FROM scrm_sms_template WHERE deleted=0";
		$result1 = $db->query($query1);
		$data1 = array();
		$a = 1;

		while($row1 = $db->fetchByAssoc($result1)){
			$data1[$a]['id'] = $row1['id'];
			$data1[$a]['name'] = $row1['name'];
			$data1[$a]['description'] = $row1['description'];
					$a++;           
		}

		$res_count = count($data1);

		for($i=1;$i<=$res_count;$i++){
			$d= $data1[$i][name];
		}

		$val1 = $data1[1][name];
		foreach($data1 as $dddd){
			$n = $dddd[name];
			$ro .= '<option value="'.$n.'">'.$n.'</option>';
		}

		echo $send_sms_detail_view = <<<POU
	<!--	<div id="dialog" title="Dialog Title"><span style="color:green; font-size:15px;"></span></div>-->
        <script src='cache/include/javascript/sugar_grp_yui_widgets.js'></script>
		<script type="text/javascript">
		$(document).ready(function(){


			var mob = '$mobile';
			if(mob){
				// If mobile number exist add mobile icon
				$('#mobile_number_c').prepend('&nbsp;<img src=\"custom/include/images/mob3.png\" style=\" width:10px;height:17px;\" ></img>&nbsp;');
			}
			      
        	var popup_data = '<div style="width:200px;padding-left:10px;"><br><input type="text" value="$mobile"  id="mobile" name="mobile" placeholder="Mobile No" style="width:100%;font-family: Helvetica, Arial, sans-serif; background:#FFFFEB;"><br><br><select style="width:100%; background:#FFFFEB;" id="sms_temp" name="sms_temp"><option selected="selected"  value="">Select SMS Template</option>$ro</select><br><br><textarea  rows="5" name="mob" id="mob"  style="width:100%;font-family: Helvetica, Arial, sans-serif; background:#FFFFEB;"></textarea><input type="button" value="Send" id="send_sms" style="font-family: Helvetica, Arial, sans-serif;background:green;color:white;margin-left:0%;margin-top:5%;margin-bottom:-5%;"><input type="button" value="Cancel" id="cancel_sms_send" style="font-family: Helvetica, Arial, sans-serif;background:#FF3535;color:white;margin-left:2%;margin-top:5%;margin-bottom:-5%;" onclick="YAHOO.SUGAR.MessageBox.hide();"></div>';


			$('#mobile_number_c').on('click',function(){

				$('#message_ackn').remove();
				$('#message_ackn_no').remove();     

				YAHOO.SUGAR.MessageBox.show({msg: popup_data, title: '<span style="padding-left:06%;"><font color="#ffffff">Send SMS</font></span>', });


				$('#sms_temp').on('change',function(){ 
					
					var drop_down_value = $(this).val();

					if(drop_down_value!=''){

						var module='Cases'; 
						var action='addTemplate';
						var to_pdf='true';

						$.ajax({

							type: "GET", 
							async: false,
							url: "index.php",
							data: 
							{ 	
							module:module,
							action:action,
							to_pdf:to_pdf,
							drop_down_value:drop_down_value,
							},//parameters	

							success: function(response)
							{
								//alert(response);
							objData  = jQuery.parseJSON(response);
							description     =       objData.description;
							$('#mob').val(description);
							}

						});

					}
					if(drop_down_value==''){
					$('#mob').val('');
					}

				});

				var dv = $('#sms_temp').val();
				var dv2 = $('#sms_temp :selected').text();

				$('#send_sms').on('click',function(){
			
					var mobile = '$mobile';  
					var id = '$id'; 
					var full_name = '$full_name'
					var name = '$name';
					var message = document.getElementById('mob').value;
					var dd_value=$('#sms_temp').val();
					

					if(mobile){
						var module='Cases'; 
						var action='sendSms';
						var to_pdf='true';

						$.ajax({

							type: "GET", 
							async: false,
							url: "index.php",
							data: 
							{ 	
							module:module,
							action:action,
							to_pdf:to_pdf,
							mobile:mobile,
							id:id,
							full_name:full_name,
							name:name, 
							message:message,
							dd_value:dd_value,

							},//parameters	

							success: function(response)
							{
								//alert(response);
							objData    =  jQuery.parseJSON(response);
							mobile     =  objData.mobile;
							}

						});

					} //if close

					YAHOO.SUGAR.MessageBox.hide();

					$('#mobile_number_c').append('<span id="message_ackn" style="color:green;  font-size:12px; padding-left:10px;"> SMS sent to </span><span id="message_ackn_no" style="color:#12ACDF;" >$mobile</span>');

							setTimeout(function() {
							$("#message_ackn").fadeOut().empty();
							$("#message_ackn_no").fadeOut().empty();
							}, 5000);

				});


			});

		
		});
		</script>
POU;
		// Send SMS - end
	parent::display();
 	}
}

?>
