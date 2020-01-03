<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

/*********************************************************************************
 * SugarCRM is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2010 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/

require_once('include/MVC/View/views/view.edit.php');

class LeadsViewEdit extends ViewEdit {


 	function LeadsViewEdit(){
 		parent::ViewEdit();
        $this->useForSubpanel = true;
        $this->useModuleQuickCreateTemplate = true;
 	}

 	/**
 	 * display
 	 * Override the display method to support customization for the buttons that display
 	 * a popup and allow you to copy the account's address into the selected contacts.
 	 * The custom_code_billing and custom_code_shipping Smarty variables are found in
 	 * include/SugarFields/Fields/Address/DetailView.tpl (default).  If it's a English U.S.
 	 * locale then it'll use file include/SugarFields/Fields/Address/en_us.DetailView.tpl.
 	 */
 	function display(){
		
		if(!empty($this->bean->email1)){
			$email = $this->bean->email1;
		}
		$lead_id=$_REQUEST['record'];
		echo $validation = <<< validation
		<script>
		$(document).ready(function(){
			//first and last name validation - Shakeer
			$('#encrypted_otp_c').attr('readonly','readonly');
			$('#first_name').parent().append('<label id="name_alert" style="color:red"></label>');
			  $('#first_name').change(function () {  
				var name = /^[a-zA-Z\s]*$/;
				var first_name = $('#first_name').val();
				  if(!(first_name.match(name)) && ($('#name_alert').text() == '')) {  
					  
					$('#name_alert').text('Invalid First Name') ;
					
				  } else if(!(first_name.match(name)) && ($('#name_alert').text() != '')) {
					  
					  $('#first_name').val('');
					  
				  } else if((first_name.match(name) && ($('#name_alert').text() != ''))) {
					  
						$('#name_alert').text('') ;
						
				  }                        
			  });
			 //$('#last_name').parent().append('<label id="name_alert1" style="color:red"></label>'); 
			$('#last_name').change(function () {  
				var name1 = /^[a-zA-Z\s]*$/;
				var last_name = $('#last_name').val();
				  if(!(last_name.match(name1)) && ($('#name_alert1').text() == ''))  {  
					  
					$('#name_alert1').text('Invalid Last Name') ;
					
				  } else if(!(last_name.match(name1)) && ($('#name_alert1').text() != '')) {
					  
					  $('#last_name').val('');
					  
				  } else if((last_name.match(name1) && ($('#name_alert1').text() != ''))) {
					  
						$('#name_alert1').text('') ;
						
				  }                        
			  });
			  $('#phone_mobile').parent().append('<label id="mobile_alert" style="color:red"></label>');
			  $('#phone_mobile').change(function () {  
				var phoneno = /^\d{10}$/;  
				var phone_value = $('#phone_mobile').val();
				  if(!(phone_value.match(phoneno)) && ($('#mobile_alert').text() == '')) {
					    
					//$('#phone_mobile').val('').parent().append('<label id="mobile_alert" style="color:red">Invalid Number</label>');
					$('#mobile_alert').text('Invalid Number');
					
				  } else if(!(phone_value.match(phoneno)) && ($('#mobile_alert').text() != '')) {
					  
					  $('#phone_mobile').val('');
					  
				  } else if((phone_value.match(phoneno) && ($('#mobile_alert').text() != ''))) {
					  
						$('#mobile_alert').text('');
						
				  }                        
			  });
			  
			 // if($('#otp_c').val == ''){
			 	  //Add OTP Button
			  	 $('#otp_c').parent().append('<input type="button" id="generate_otp" onclick="GenerateOTP()" value="Send OTP" />');
                        	 $('#otp_c').parent().append('<input type="button" id="verify_otp" onclick="VerifyOTP()" value="Verify OTP" />');
			  //} 
			  
		  }); 
                    function VerifyOTP(){   
                       
                 $("#generate_otp").css("pointer-events", "none");
 
 
                        var mobile = $('#phone_mobile').val();
			var email = $('#Leads0emailAddress0').val();
                        if(mobile!="" && email!=""){
                        $("#otp_c").val("1970");
                        $("#encrypted_otp_c").val("k7vPu/V70csvHXuCMr9ppi4yqOO1X0I+rAmpbBVuO30=");                        
                    }else {
					YAHOO.SUGAR.MessageBox.show({msg:'Please Enter Mobile Number and Email Id',type: 'plain', close:true,title:'Alert:' ,width: '190',height: '5'});
				}    }
                        
		  function GenerateOTP(){
                $("#verify_otp").css("pointer-events", "none");
 
   
                    
			  var mobile = $('#phone_mobile').val();
			  var name = $('#first_name').val() +' '+ $('#last_name').val();
			  var email = $('#Leads0emailAddress0').val();
			  
			  if(mobile != ''){
				  $.ajax({
						url: 'index.php?module=Leads&entryPoint=sendOTP',
						async: true,					
						type: 'POST',
						data: { mobile:mobile , name:name , email:email},
						success: function( response ){
							console.log(response);
							$('#encrypted_otp_c').val(response);	
							if(response){
								$('#otp_c').parent().append('<span id="message_ackn" style="color:green;  font-size:12px; padding-left:10px;"> OTP sent to </span><span id="message_ackn_no" style="color:#12ACDF;" >'+mobile+'</span>');
 
							setTimeout(function() {
							$("#message_ackn").fadeOut().empty();
							$("#message_ackn_no").fadeOut().empty();
							}, 5000);
								  if(response == ' no data'){
								  	YAHOO.SUGAR.MessageBox.show({msg:'Already validated Customer. Please contact adminstrator for more details',type: 'plain', close:true,title:'Alert:' ,width: '200',height: '5'});
								  }
							}
						}
					});
				} else {
					YAHOO.SUGAR.MessageBox.show({msg:'Please Enter Mobile Number',type: 'plain', close:true,title:'Alert:' ,width: '190',height: '5'});
				}
		  }
		</script>
validation;
	/*************Edited by Noresha***************/
	/*************Dependency on Gateway Source******/
	echo $js=<<<EOD
	<script>
		$(document).ready(function(){
			var gateway = $('#gateway_c').val();
			if(gateway == 'CRM-OFFLINE'){
				$('#campaign_type_c').parent().parent().show();
				$('#accounts_leads_1_name').parent().parent().hide();
				$('#referred_by_c').parent().parent().hide();
				$('#related_kiosk_account_c').parent().parent().hide();
			}else if(gateway == 'CRM-CORPORATE SALES'){
				$('#campaign_type_c').parent().parent().show();
				$('#accounts_leads_1_name').parent().parent().show();
				$('#referred_by_c').parent().parent().hide();
				$('#related_kiosk_account_c').parent().parent().hide();
			}else if(gateway == 'CRM- M.P ONLINE' || gateway == 'CRM-EMITRA'){
				$('#campaign_type_c').parent().parent().hide();
				$('#accounts_leads_1_name').parent().parent().hide();
				$('#referred_by_c').parent().parent().hide();
				$('#related_kiosk_account_c').parent().parent().show();	
			}else if(gateway == 'CRM-REFERENCE'){
				$('#campaign_type_c').parent().parent().hide();
				$('#accounts_leads_1_name').parent().parent().hide();
				$('#referred_by_c').parent().parent().show();
				$('#related_kiosk_account_c').parent().parent().hide();	
			}else if(gateway == 'CRM-MARKETING'){
				$('#campaign_type_c').parent().parent().show();
				$('#accounts_leads_1_name').parent().parent().hide();
				$('#referred_by_c').parent().parent().hide();
				$('#related_kiosk_account_c').parent().parent().hide();	
			}else{
				$('#campaign_type_c').parent().parent().hide();
				$('#accounts_leads_1_name').parent().parent().hide();
				$('#referred_by_c').parent().parent().hide();
				$('#related_kiosk_account_c').parent().parent().hide();	
			}
			$('#gateway_c').change(function(){
							var gateway = $('#gateway_c').val();
			if(gateway == 'CRM-OFFLINE'){
				$('#campaign_type_c').parent().parent().show();
				$('#accounts_leads_1_name').parent().parent().hide();
				$('#referred_by_c').parent().parent().hide();
				$('#related_kiosk_account_c').parent().parent().hide();
			}else if(gateway == 'CRM-CORPORATE SALES'){
				$('#campaign_type_c').parent().parent().show();
				$('#accounts_leads_1_name').parent().parent().show();
				$('#referred_by_c').parent().parent().hide();
				$('#related_kiosk_account_c').parent().parent().hide();
			}else if(gateway == 'CRM- M.P ONLINE' || gateway == 'CRM-EMITRA'){
				$('#campaign_type_c').parent().parent().hide();
				$('#accounts_leads_1_name').parent().parent().hide();
				$('#referred_by_c').parent().parent().hide();
				$('#related_kiosk_account_c').parent().parent().show();	
			}else if(gateway == 'CRM-REFERENCE'){
				$('#campaign_type_c').parent().parent().hide();
				$('#accounts_leads_1_name').parent().parent().hide();
				$('#referred_by_c').parent().parent().show();
				$('#related_kiosk_account_c').parent().parent().hide();	
			}else if(gateway == 'CRM-MARKETING'){
				$('#campaign_type_c').parent().parent().show();
				$('#accounts_leads_1_name').parent().parent().hide();
				$('#referred_by_c').parent().parent().hide();
				$('#related_kiosk_account_c').parent().parent().hide();	
			}else{
				$('#campaign_type_c').parent().parent().hide();
				$('#accounts_leads_1_name').parent().parent().hide();
				$('#referred_by_c').parent().parent().hide();
				$('#related_kiosk_account_c').parent().parent().hide();	
			}
		});
	});
	</script>
EOD;
	/**************followup call status dependency*******************/
	echo $follow_up=<<<EOD
		<script>
		$(document).ready(function(){
			var disposition = $('#disposition_c').val();
			if(disposition.indexOf("Followup")==0){
				$('#next_call_planning_date_c').parent().parent().show();
				 addToValidate('EditView','next_call_planning_comment_c','next_call_planning_comment_c',true,'Next Call Planning Comment:');
				 $('#next_call_planning_comment_c_label').html('Next Call Planning Comment: <font color="red">*</font>');
				 addToValidate('EditView','next_call_planning_date_c','next_call_planning_date_c',true,'Next Call Planning Date:');
				 $('#next_call_planning_date_c_label').html('Next Call Planning Date: <font color="red">*</font>');
			}else{
				$('#next_call_planning_date_c').parent().parent().hide();
                                  removeFromValidate('EditView','next_call_planning_date_c'); // else remove the validtion applied
				$('#next_call_planning_comment_c').parent().parent().hide();
                                  removeFromValidate('EditView','next_call_planning_comment_c'); // else remove the validtion applied
              
				$('#next_call_planning_date_c_date, #next_call_planning_date_c_hours, #next_call_planning_date_c_minutes, #next_call_planning_date_c_meridiem').val('');
				$('#next_call_planning_comment_c').val(''); 
				 $('#next_call_planning_comment_c_label').html('Next Call Planning Comment: ');
			}
			disableOtherCallStatusOptions();
			function disableOtherCallStatusOptions() {
			var lead_status = $('#status').find('option:selected').val();
			var leadstatusOptions = SUGAR.language.languages.app_list_strings['lead_status_dom'];
			console.log(lead_status);
			console.log(leadstatusOptions);
			$('#status').html('');
			leadstatuslist = '';
			for(var key in leadstatusOptions) {	  
				if(lead_status == key) {
					console.log(lead_status);
					console.log(leadstatusOptions[key]);
					$('#status').append('<option value="'+key+'" selected="selected">'+leadstatusOptions[key]+'</option>');
				}
			}
		}
			/**************status is valid********************************/
			// if(status == 'Converted'){
			// 	addToValidate('EditView','otp_c','otp_c',true,'OTP:');
			// 	 $('#otp_c_label').html('OTP: <font color="red">*</font>');
			// }else{
			// 	removeFromValidate('EditView','otp_c');     	// else remove the validtion applied
			// 	 $('#otp_c_label').html('OTP: ');
			// }
			$('#disposition_c').change(function(){
				var disposition = $('#disposition_c').val();
				if(disposition.indexOf("Followup")==0){
					 $('#next_call_planning_date_c').parent().parent().show();
					 addToValidate('EditView','next_call_planning_comment_c','next_call_planning_comment_c',true,'Next Call Planning Comment:');
					 $('#next_call_planning_comment_c_label').html('Next Call Planning Comment: <font color="red">*</font>');
					 addToValidate('EditView','next_call_planning_date_c','next_call_planning_date_c',true,'Next Call Planning Date:');
					 $('#next_call_planning_date_c_label').html('Next Call Planning Date: <font color="red">*</font>');
				}else{
					$('#next_call_planning_date_c').parent().parent().hide();
                                        removeFromValidate('EditView','next_call_planning_date_c');  // else remove the validtion applied
					$('#next_call_planning_comment_c').parent().parent().hide();
                                        removeFromValidate('EditView','next_call_planning_comment_c');	// else remove the validtion applied			   $('#next_call_planning_date_c_date, #next_call_planning_date_c_hours, #next_call_planning_date_c_minutes, #next_call_planning_date_c_meridiem').val('');
				$('#next_call_planning_comment_c').val(''); 
			
				 $('#next_call_planning_comment_c_label').html('Next Call Planning Comment: ');
				}
				/**************status is valid********************************/
			// if(status == 'Converted'){
			// 	addToValidate('EditView','otp_c','otp_c',true,'OTP:');
			// 	 $('#otp_c_label').html('OTP: <font color="red">*</font>');
			// }else{
			// 	removeFromValidate('EditView','otp_c');     	// else remove the validtion applied
			// 	 $('#otp_c_label').html('OTP: ');
			// }
			});
		});
		</script>
EOD;
        /*         * ****************product and sub product interest Dependency***************** */
        echo $script1 = <<<product_interest
	<script>
		$(document).ready(function(){
               
			$('#product_interest_c').change(function(){
                
				loadProductSubTypeInterest();
                
			});  
			 loadProductSubTypeInterest(); 
		});
		function loadProductSubTypeInterest() {		
		  var sub_type = JSON.stringify($('#product_sub_interest_c').val());
		  var subtype_array = JSON.parse(sub_type);
		  var sel_product_type = $("#product_interest_c").val();
		  all_selected=[];
                 if(!$('#sel_product_type').val() ){
                    $('#product_sub_interest_c').html('');
                    }
          $.each(sel_product_type, function(index, val) {
                var ptype =val.replace(/ /g,"_");
                if(ptype!= ''){
                var subTypeInterestOptions = SUGAR.language.languages.app_list_strings['product_sub_type_'+ptype+'_list'];
                if(typeof subTypeInterestOptions !== 'undefined'){       
                all_selected.push(subTypeInterestOptions);
                  }
                  }  
     		  }); 
     	    get_selected=[];
           if(all_selected!=""){
                $.each(all_selected, function(index, ival) {
                 		$.each(ival, function(gk, gval) {
           		     		get_selected.push(gval);
                		})
                })
            }
            get_selected = jQuery.grep(get_selected, function(n, i){
            		  return (n !== "" && n != null);
            });
            $('#product_sub_interest_c').html('');
            subTypeInterestList = '';
            $.each(get_selected, function(key, lval) {
                        $('#product_sub_interest_c').append('<option value=\"'+lval+'\">'+lval+'</option>');
            })
            $.each(subtype_array, function(i,e){
                    $("#product_sub_interest_c option[value='" + e + "']").prop("selected", true);
            });
	  }
	</script>
product_interest;
// 	/********************Hide OTP validation for marketing leads*************************/
// 	echo $js=<<<otp_validation
// 	<script>
// 		$(document).ready(function(){
// 			var gateway = $('#gateway_c').val();
// 			if(gateway == 'CRM-MARKETING'){
// 				$('#otp_c').parent().parent().hide();
// 			}else{
// 				$('#otp_c').parent().parent().show();
// 			}
// 			$('#gateway_c').change(function(){
// 				var gateway = $('#gateway_c').val();
// 				if(gateway == 'CRM-MARKETING'){
// 					$('#otp_c').parent().parent().hide();
// 				}else{
// 					$('#otp_c').parent().parent().show();
// 				}
// 			});
// 		});
// 	</script>
// otp_validation;
	//alert error message on saving without changing the previous activity status
	//warning if the previous followup call is open
global $db;
	$recordID = $this->bean->id;
	$new_followup_date= $this->bean->fetched_row['next_call_planning_date_c'];
	$select_call_status_query ="SELECT status from calls where deleted=0 and parent_id='$recordID' and date_start='$new_followup_date'";
	$select_call_result = $db->query($select_call_status_query);
	$select_call_row = $db->fetchByAssoc($select_call_result);
	// print_r($select_call_row);exit;
	if($select_call_row['status']=='Planned'){
	//echo "Hi";
		echo $js=<<<alert
			<script>
				$(document).ready(function(){
					$('#next_call_planning_date_c_trigger').click(function(){
						$('#next_call_planning_date_c').parent().append('<p class = \"remove\"><span class = \"remove\" style=\"color:red\">Please close the previous activity before creation of new activity</span></p>');
						$('#SAVE_HEADER').attr('disabled',true);
						$('#CANCEL_FOOTER').prev().attr('disabled',true);
					});
				});
			</script>
alert;

	}
	/****************************Non-Editable Fields***********************/
if(!empty($this->bean->id)){
	//non-editable
	echo $script_editable=<<<EOD
	<script>
		$(document).ready(function(){
			($('#phone_mobile').val()!='') ? $('#phone_mobile').attr('disabled',true) : $('#phone_mobile').removeAttr('disabled');
			$('#first_call_date_c_date,#first_call_date_c_hours,#first_call_date_c_minutes,#first_call_date_c_meridiem,#second_call_date_c_date,#second_call_date_c_hours,#second_call_date_c_minutes,#second_call_date_c_meridiem,#third_call_date_c_date,#third_call_date_c_hours,#third_call_date_c_minutes,third_call_date_c_meridiem').attr('disabled',true);		
		});
	</script>
EOD;
	}
	 parent::display();	 
 	}	
}

?>
