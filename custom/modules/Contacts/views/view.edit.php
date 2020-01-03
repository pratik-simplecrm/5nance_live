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

class ContactsViewEdit extends ViewEdit {


 	function ContactsViewEdit(){
 		parent::ViewEdit();
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
		global $current_user,$app_list_strings;
    	$current_user_id = $current_user->id;
    	$is_admin = $current_user->is_admin;

    	$sales_stage_test = $app_list_strings['sales_stage_list'];

		$site_url = $sugar_config['site_url'];
		$api_url = $sugar_config['getidealportifolio'];
		echo $validation = <<< validation
		<script type='text/javascript' src='cache/include/javascript/sugar_grp_yui_widgets.js'></script>
		<script>
		$(document).ready(function(){
                        
                //If product interest field is not empty by Roshan Sarode
                if( $('#product_interest_c').val()!="" ) { 
                  $('#product_interest_c option:not(:selected)').attr('disabled', true);
                }
			/*************go button in investment advisory*********************/
			$('#investment_amount_c').parent().append('<tr><td style="text-align:center;" valign="top"><input type="button" name="go" id="go" value="GO"  style="padding: 10px 100px;border-radius: initial;margin-left: 255px;"></td></tr>');
			$('#go').click(function(){
				var investment_period = $('#investment_period_c').val();
				var investment_type = $('#investment_type_c').val();
				var investment_amount = $('#investment_amount_c').val();
				var risk_profile_id = $('#risk_profile_id_c').val();
				var api_url = '$api_url';
				if(investment_period == '' || investment_type=='' || investment_amount == '' || risk_profile_id==''){
					if(investment_period == ''){
						alert('Investment Period should not be empty');
						return false;
					}else if(investment_type==''){
						alert('Investment Type should not be empty');
						return false;
					}else if(investment_amount == ''){
						alert('Investment Amount should not be empty');
						return false;
					}else if(risk_profile_id==''){
						alert('Risk Profile ID should not be empty');
						return false;
					}					
				}else{
					investment_amount = parseInt(investment_amount);
					$.ajax({
					url:'$site_url/index.php?entryPoint=investmentadvisory',
					type:'GET',
					async:false,
					data:{
						investment_period : investment_period,
						investment_type : investment_type,
						investment_amount : investment_amount,
						risk_profile_id : risk_profile_id,
						api_url : api_url,
					}
				}).done(function(data){
					response = jQuery.parseJSON(data);	
					response = response.data;
					var dataHTML = '';	
					dataHTML += '<tr style="background-color: #3c8dbc;color: white;">';
					dataHTML += '<th>Asset</th>';
					dataHTML += '<th>Asset Allocation</th>';
					dataHTML += '<th>Provider</th>';
					dataHTML += '<th>Category</th>';
					dataHTML += '<th>Scheme Name</th>';
					dataHTML += '<th>Scheme Allocation(%)</th>';
					dataHTML += '<th>Scheme Allocation(₹)</th>';
					dataHTML += '<th>History Returns Since inception</th>';
					dataHTML += '<th>Performance in 3 Years(%)</th>';
					dataHTML += '</tr>';
			   		for(var i=0;i<response.length;i++){
							dataHTML += '<tr>';
							dataHTML += '<td>'+response[i]['assetType']+'</td>';
							dataHTML += '<td>'+response[i]['assetAllocation']+'% </td>';
							dataHTML += '<td>'+response[i]['providerType']+'</td>';
							dataHTML += '<td>'+response[i]['schemeCategory']+'</td>';
							dataHTML += '<td>'+response[i]['schemeName']+'</td>';
							dataHTML += '<td>'+response[i]['schemeAllocationPerc']+'</td>';
							dataHTML += '<td>'+response[i]['schemeAllocation']+'</td>';
							dataHTML += '<td>'+response[i]['historicalReturnsPerc']+'</td>';
							dataHTML += '<td>'+response[i]['performacePerc']+'</td>';
							dataHTML += '</tr>';
					}
					$('#advisorydata tbody').html(dataHTML);
					$('#investor_details').modal();
				});
				}
			});
			if(document.getElementById('next_call_planning_date_c_date')){
				 document.getElementById('next_call_planning_date_c_date').setAttribute('onchange',"callPlanningkDateValidation()");
			  }
			
			$('#next_call_planning_comments_c').parent().parent().hide();
			//enableDispositionDropdown();
			disableOtherSalesStageOptions();
			
			//first and last name validation - Shakeer
			  $('#first_name').change(function () {  
				var name = /^[a-zA-Z\s]*$/;
				var first_name = $('#first_name').val();
				  if(!(first_name.match(name)) && ($('#name_alert').text() == '')) {  
					  
					$('#first_name').val('').parent().append('<label id="name_alert" style="color:red">Invalid First Name</label>');
					
				  } else if(!(first_name.match(name)) && ($('#name_alert').text() != '')) {
					  
					  $('#first_name').val('');
					  
				  } else if((first_name.match(name) && ($('#name_alert').text() != ''))) {
					  
						$('#name_alert').text('') ;
						
				  }                        
			  });
			  
			$('#last_name').change(function () {  
				var name1 = /^[a-zA-Z\s]*$/;
				var last_name = $('#last_name').val();
				  if(!(last_name.match(name1)) && ($('#name_alert1').text() == ''))  {  
					  
					$('#last_name').val('').parent().append('<label id="name_alert1" style="color:red">Invalid Last Name</label>');
					
				  } else if(!(last_name.match(name1)) && ($('#name_alert1').text() != '')) {
					  
					  $('#last_name').val('');
					  
				  } else if((last_name.match(name1) && ($('#name_alert1').text() != ''))) {
					  
						$('#name_alert1').text('') ;
						
				  }                        
			  });
			  
			  $('#phone_mobile').change(function () {  
				var phoneno = /^\d{10}$/;  
				var phone_value = $('#phone_mobile').val();
				  if(!(phone_value.match(phoneno)) && ($('#mobile_alert').text() == '')) {
					    
					$('#phone_mobile').val('').parent().append('<label id="mobile_alert" style="color:red">Invalid Number</label>');
					
				  } else if(!(phone_value.match(phoneno)) && ($('#mobile_alert').text() != '')) {
					  
					  $('#phone_mobile').val('');
					  
				  } else if((phone_value.match(phoneno) && ($('#mobile_alert').text() != ''))) {
					  
						$('#mobile_alert').text('') ;
						
				  }                        
			  });
			  //~ $('#activate_disposition_c').change(function(){
				  //~ enableDispositionDropdown();
			  //~ });
			  
			  $('#disposition_c').change(function(){
				 showHideNextCallPanningDetails();
			  });
			  showHideNextCallPanningDetails();
			  
			$('#product_interest_c').change(function(){
				loadProductSubTypeInterest();
			});  
			 loadProductSubTypeInterest(); 
			 $('#product_sub_type_interest_c').change(function(){
					var sub_product = $('#product_sub_type_interest_c').val();
					if(sub_product == 'Personal Loan'){
						loadPersonalLoanDispositionDropdown();
					}				
				});  
			 
			if('$is_admin' == '0'){	 
   		 $('#sales_stage_c').change(function(){
   			 loadDispositionDropdown();
   		 });  
          var sub_product = $('#product_sub_type_interest_c').val();
            	console.log('test');
				console.log(sub_product);
				if(sub_product == 'Personal Loan'){
					console.log('inside');
					loadPersonalLoanDispositionDropdown();
				}else{
					loadDispositionDropdown();
				}
   		 // loadDispositionDropdown();  
            	
}
			 /****************edited - dropped user*******************/
			 $('#disposition_c').change(function(){
			    var sales_stage = $("#sales_stage_c").find("option:selected").val().replace(/ /g,"_");
			    var res = sales_stage.split('_');
			    if(res[0] == 'Dropped'){
			     var value = (res[1] == 'Hot' ? 'Hot Prospect' : res[1]);
			     $('#sales_stage_c').html('');
			     $('#sales_stage_c').append('<option value="'+value+'" selected="selected">'+value+'</option>');
			    } 
			  });
		}); 
		
		function disableOtherSalesStageOptions() {
			console.log('$sales_stage_test');

			var sales_stage = $('#sales_stage_c').find('option:selected').val();
			var salesStageOptions = SUGAR.language.languages.app_list_strings['sales_stage_list'];
			//satyam changes
			console.log(sales_stage);
			console.log(salesStageOptions);
			//end
			$('#sales_stage_c').html('');
			salesStageList = '';
			for(var key in salesStageOptions) {	  
				if(sales_stage == key) {
					$('#sales_stage_c').append('<option value="'+key+'" selected="selected">'+salesStageOptions[key]+'</option>');
				}
			}
		}
		
		function showHideNextCallPanningDetails() {
			var next_call_planning_comment_list = SUGAR.language.languages.app_list_strings['next_call_planning_comment_list'];
                        next_call_planning_comment_list.push("Converted to Customer");       
                
			var next_comment_list = SUGAR.language.languages.app_list_strings['next_comment_list'];
				  
			 var dispostion_selected = $('#disposition_c').find('option:selected').val();
			 
			 console.log(dispostion_selected);
			 
			 if(jQuery.inArray( dispostion_selected, next_call_planning_comment_list ) >= 0) {
				 $('#next_call_planning_comments_c').parent().parent().show();
				 $('#next_call_planning_date_c').prev().show();
				 addToValidate('EditView','next_call_planning_comments_c','next_call_planning_comments_c',true,'Next Call Planning Comments:');
				 $('#next_call_planning_comments_c_label').html('Next Call Planning Comments: <font color="red">*</font>');
				 addToValidate('EditView','next_call_planning_date_c','next_call_planning_date_c',true,'Next Call Planning Date:');
				 $('#next_call_planning_date_c_label').html('Next Call Planning Date: <font color="red">*</font>');
			 } else if(jQuery.inArray( dispostion_selected, next_comment_list) >= 0) {
				 $('#next_call_planning_comments_c').parent().parent().show();
				 $('#next_call_planning_date_c').prev().hide();
				 $('#next_call_planning_date_c_date, #next_call_planning_date_c_hours, #next_call_planning_date_c_minutes, #next_call_planning_date_c_meridiem').val('');
				 removeFromValidate('EditView','next_call_planning_date_c');     	// else remove the validtion applied
				 $('#next_call_planning_date_c_label').html('Next Call Planning Date: ');
				 addToValidate('EditView','next_call_planning_comments_c','next_call_planning_comments_c',true,'Next Call Planning Comments:');
				 $('#next_call_planning_comments_c_label').html('Next Call Planning Comments: <font color="red">*</font>');
			 } else {
				$('#next_call_planning_comments_c').parent().parent().hide();
				$('#next_call_planning_date_c_date, #next_call_planning_date_c_hours, #next_call_planning_date_c_minutes, #next_call_planning_date_c_meridiem').val('');
				$('#next_call_planning_comments_c').val(''); 
				 removeFromValidate('EditView','next_call_planning_comments_c');     	// else remove the validtion applied
				 $('#next_call_planning_comments_c_label').html('Next Call Planning Comments: ');
				 
			 }
		}
		  
		function callPlanningkDateValidation(){
				
			//Getting the callback date	
			var start_date = document.getElementById("next_call_planning_date_c_date").value;  
						 
			var arr = start_date.split("/");
			var selected_date = arr[0];
			var selected_month = arr[1];
			var selected_year = arr[2];       
			var actual_date = (selected_month + "/" + selected_date + "/" + selected_year);
			var newActualDate=new Date(actual_date).getTime();
			
			//For getting current date
			var today = new Date();   
			var cur_date = today.getDate();
			var cur_month = today.getMonth();	
			var cur_year = today.getFullYear();
			var current_date = ("0" + cur_date).slice(-2);		
			var current_month = ("0" + (cur_month + 1)).slice(-2);	
			var current_date = (current_month + "/" + current_date + "/" + cur_year);
			var newcurrent_date=new Date(current_date).getTime();
			
			if(newActualDate < newcurrent_date){
				$('#next_call_planning_date_c_date, #next_call_planning_date_c_hours, #next_call_planning_date_c_minutes, #next_call_planning_date_c_meridiem').val('');
				YAHOO.SUGAR.MessageBox.show({msg:'Call Back Date should not be past date!',type: 'plain', close:true,title:'Alert:' ,width: '190',height: '5'});			
			}			             
		}
	  
	  function enableDispositionDropdown() { 
		  
		  var checkbox = $('#activate_disposition_c').is(':checked')?true:false;	
		  if(checkbox) {
				$('#disposition_c').removeAttr('disabled');	
		  } else {
				$('#disposition_c').attr('disabled', true);
		  }
	  }
	  
	  function loadProductSubTypeInterest() {
		  
		  var sub_type = $('#product_sub_type_interest_c option:selected').text();
		  
		  var product_type = $("#product_interest_c").find("option:selected").val().replace(/ /g,"_");
		  
		  var subTypeInterestOptions = SUGAR.language.languages.app_list_strings['product_sub_type_'+product_type+'_list'];
				
		  $('#product_sub_type_interest_c').html('');
		  subTypeInterestList = '';
		  for(var key in subTypeInterestOptions) {	  
			  if(sub_type == subTypeInterestOptions[key]) {
				  subTypeInterestList += '<option value="'+key+'" selected="selected">'+subTypeInterestOptions[key]+'</option>';
			  } else {
				  subTypeInterestList += '<option value="'+key+'">'+subTypeInterestOptions[key]+'</option>';
			  }
		  }
		  $('#product_sub_type_interest_c').append(subTypeInterestList);
	  }
	  
	  
	  function loadDispositionDropdown() {
		  
		  var disposition = $('#disposition_c option:selected').text();
		  
		  var sales_stage = $("#sales_stage_c").find("option:selected").val().replace(/ /g,"_");

		  if(sales_stage == 'Dropped_User')
		    sales_stage = 'User';
		    else if(sales_stage == 'Dropped_Suspect')
		    sales_stage = 'Suspect';
		    else if(sales_stage == 'Dropped_Prospect')
		    sales_stage = 'Prospect'; 
		    else  if(sales_stage == 'Dropped_Hot_Prospect')
		    sales_stage = 'Hot_Prospect';
		  
		  var dispositionOptions = SUGAR.language.languages.app_list_strings['disposition_'+sales_stage+'_list'];
				
		  $('#disposition_c').html('');
		  dispositionList = '';
		  for(var key in dispositionOptions) {	  
			  if(disposition == dispositionOptions[key]) {
				  dispositionList += '<option value="'+key+'" selected="selected">'+dispositionOptions[key]+'</option>';
			  } else {
				  dispositionList += '<option value="'+key+'">'+dispositionOptions[key]+'</option>';
			  }
		  }
		  $('#disposition_c').append(dispositionList);
	  }
	  function loadPersonalLoanDispositionDropdown() {
		  
		  var disposition = $('#disposition_c option:selected').text();
		  
		  var sales_stage = $("#sales_stage_c").find("option:selected").val().replace(/ /g,"_");
		 
		  if(sales_stage == 'Dropped_User')
		    sales_stage = 'User';
		    else if(sales_stage == 'Dropped_Suspect')
		    sales_stage = 'Suspect';
		    else if(sales_stage == 'Dropped_Prospect')
		    sales_stage = 'Prospect'; 
		    else  if(sales_stage == 'Dropped_Hot_Prospect')
		    sales_stage = 'Hot_Prospect';
		  console.log(SUGAR.language.languages.app_list_strings['disposition_list']);
		  var dispositionOptions = SUGAR.language.languages.app_list_strings['disposition_Personal Loans_'+sales_stage+'_list'];
				console.log(dispositionOptions);
				
		  $('#disposition_c').html('');
		  dispositionList = '';
		  for(var key in dispositionOptions) {	
                
                            if(disposition == dispositionOptions[key] ) {
				  dispositionList += '<option value="'+key+'" selected="selected">'+dispositionOptions[key]+'</option>';
			  } else {
				  dispositionList += '<option value="'+key+'">'+dispositionOptions[key]+'</option>';
			  }
		  }
		  $('#disposition_c').append(dispositionList);
	  }
	</script>
validation;
echo '<div class="modal fade bd-example-modal-lg" id="investor_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
	     <div class="modal-header">
	        <h5 class="modal-title" id="investor_details_model">Investment Advisory</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
			     <table class="table" id="advisorydata">
			    	   	<tbody>
			    	 	</tbody>
			     </table>
	     </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>';
/***********Edited By A.Noresha*****************/
/****************strucure of family dependency***************/
//~ echo $dependency=<<<dependency
	//~ <script>
		//~ $(document).ready(function(){
			//~ var structure_of_family = $('#structure_of_family_c').val();
			//~ if(structure_of_family == 'Adults'){
				//~ $('#no_of_adults_c').parent().parent().show();
				//~ $('#no_of_children_c').parent().parent().hide();
			//~ }else if(structure_of_family == 'Children'){
				//~ $('#no_of_adults_c').parent().parent().hide();
				//~ $('#no_of_children_c').parent().parent().show();
			//~ }else{
				//~ $('#no_of_adults_c').parent().parent().hide();
				//~ $('#no_of_children_c').parent().parent().hide();
			//~ }
			//~ $('#structure_of_family_c').change(function(){
				//~ var structure_of_family = $('#structure_of_family_c').val();
				//~ if(structure_of_family == 'Adults'){
					//~ $('#no_of_adults_c').parent().parent().show();
					//~ $('#no_of_children_c').parent().parent().hide();
				//~ }else if(structure_of_family == 'Children'){
					//~ $('#no_of_adults_c').parent().parent().hide();
					//~ $('#no_of_children_c').parent().parent().show();
				//~ }else{
					//~ $('#no_of_adults_c').parent().parent().hide();
					//~ $('#no_of_children_c').parent().parent().hide();
				//~ }
			//~ });
		//~ });
	//~ </script>
//~ dependency;
        /*********************customer referral - added by noresha*************************/
        echo $customer_referal =<<<EOD
        <script>
        $(document).ready(function(){
        	var sales_stage = $('#sales_stage_c').val();
        	var disposition = $('#disposition_c').val();
        	if(disposition == 'Converted to Customer'){
        		$('#referral_type_c').parent().parent().show();
        		 addToValidate('EditView','referral_type_c','referral_type_c',true,'Referral Type:');
				 $('#referral_type_c_label').html('Referral Type: <font color="red">*</font>');
        	}else{
        		$('#referral_type_c').parent().parent().hide();
        		 removeFromValidate('EditView','referral_type_c');   				
        	}
        	$('#disposition_c').change(function(){
        		var sales_stage = $('#sales_stage_c').val();
        	var disposition = $('#disposition_c').val();
        	if(disposition == 'Converted to Customer'){
        		$('#referral_type_c').parent().parent().show();
        		 addToValidate('EditView','referral_type_c','referral_type_c',true,'Referral Type:');
				 $('#referral_type_c_label').html('Referral Type: <font color="red">*</font>');
        	}else{
        		$('#referral_type_c').parent().parent().hide();
        		 removeFromValidate('EditView','referral_type_c');   				
        	}
        	});
        });
        </script>
EOD;
/*************************Existing Customer Details****************************************/
echo $existing_customer=<<<EOD
	<script>
		$(document).ready(function(){
			var referral_type = $('#referral_type_c').val();
			if(referral_type == 'Existing_Customer_Reference'){
				$('#name_of_existing_customer_c').parent().parent().show();
			}else{
				$('#name_of_existing_customer_c').parent().parent().hide();
			}
			$('#referral_type_c').change(function(){
				var referral_type = $('#referral_type_c').val();
			if(referral_type == 'Existing_Customer_Reference'){
				$('#name_of_existing_customer_c').parent().parent().show();
			}else{
				$('#name_of_existing_customer_c').parent().parent().hide();
			}
			})
		});
	</script>
EOD;
/*************************Existing Customer Details****************************************/

/****************************Non-Editable Fields***********************/
if(!empty($this->bean->id)){
	//non-editable
	echo $script_editable=<<<EOD
	<script>
		$(document).ready(function(){
			($('#salutation').val()!='') ? $('#salutation').attr('disabled',true) : $('#salutation').removeAttr('disabled');
			($('#first_name').val()!='') ? $('#first_name').attr('disabled',true) : $('#first_name').removeAttr('disabled');
			($('#middle_name_c').val()!='') ? $('#middle_name_c').attr('disabled',true) : $('#middle_name_c').removeAttr('disabled');
			($('#last_name').val()!='') ? $('#last_name').attr('disabled',true) : $('#last_name').removeAttr('disabled');
			($('#Contacts0emailAddress0').val()!='') ? $('#Contacts0emailAddress0').attr('disabled',true) : $('#Contacts0emailAddress0').removeAttr('disabled');
			($('#phone_mobile').val()!='') ? $('#phone_mobile').attr('disabled',true) : $('#phone_mobile').removeAttr('disabled');
			($('#unique_customer_code_c').val()!='') ? $('#unique_customer_code_c').attr('disabled',true) : $('#unique_customer_code_c').removeAttr('disabled');
			($('#address_c').val()!='') ? $('#address_c').attr('disabled',true) : $('#address_c').removeAttr('disabled');
			($('#city_c').val()!='') ? $('#city_c').attr('disabled',true) : $('#city_c').removeAttr('disabled');
			($('#state_c').val()!='') ? $('#state_c').attr('disabled',true) : $('#state_c').removeAttr('disabled');
			($('#postalcode_c').val()!='') ? $('#postalcode_c').attr('disabled',true) : $('#postalcode_c').removeAttr('disabled');
			($('#gateway_c').val()!='') ? $('#gateway_c').attr('disabled',true) : $('#gateway_c').removeAttr('disabled');
			($('#campaign_type_c').val()!='') ? $('#campaign_type_c').attr('disabled',true) : $('#campaign_type_c').removeAttr('disabled');
			($('#campaign_sub_type_c').val()!='') ? $('#campaign_sub_type_c').attr('disabled',true) : $('#campaign_sub_type_c').removeAttr('disabled');
			($('#related_corporate_account_c').val()!='') ? $('#related_corporate_account_c').attr('disabled',true) : $('#related_corporate_account_c').removeAttr('disabled');
			($('#related_kiosk_account_c').val()!='') ? $('#related_kiosk_account_c').attr('disabled',true) : $('#related_kiosk_account_c').removeAttr('disabled');
			($('#user_type_c').val()!='') ? $('#user_type_c').attr('disabled',true) : $('#user_type_c').removeAttr('disabled');
			($('#adoption_percentage_c').val()!='') ? $('#adoption_percentage_c').attr('disabled',true) : $('#adoption_percentage_c').removeAttr('disabled');
			($('#classification_accoun_c').val()!='') ? $('#classification_accoun_c').attr('disabled',true) : $('#classification_accoun_c').removeAttr('disabled');
			($('#publisher_id_c').val()!='') ? $('#publisher_id_c').attr('disabled',true) : $('#publisher_id_c').removeAttr('disabled');
			($('#publisher_name_c').val()!='') ? $('#publisher_name_c').attr('disabled',true) : $('#publisher_name_c').removeAttr('disabled');
			($('#risk_profiling_questions_c').val()!='') ? $('#risk_profiling_questions_c').attr('disabled',true) : $('#risk_profiling_questions_c').removeAttr('disabled');
			($('#lead_generation_date_c_date').val()!='') ? $('#lead_generation_date_c_date').attr('disabled',true) : $('#lead_generation_date_c_date').removeAttr('disabled');
			($('#lead_generation_date_c_hours').val()!='') ? $('#lead_generation_date_c_hours').attr('disabled',true) : $('#lead_generation_date_c_hours').removeAttr('disabled');
			($('#lead_generation_date_c_minutes').val()!='') ? $('#lead_generation_date_c_minutes').attr('disabled',true) : $('#lead_generation_date_c_minutes').removeAttr('disabled');
			($('#lead_generation_date_c_meridiem').val()!='') ? $('#lead_generation_date_c_meridiem').attr('disabled',true) : $('#lead_generation_date_c_meridiem').removeAttr('disabled');
			($('#lead_generation_date_c_date').val()!='') ? $('#lead_generation_date_c_trigger').hide() : $('#lead_generation_date_c_trigger').show();
			($('#date_of_first_call_c_date').val()!='') ? $('#date_of_first_call_c_date').attr('disabled',true) : $('#date_of_first_call_c_date').removeAttr('disabled');
			($('#date_of_first_call_c_hours').val()!='') ? $('#date_of_first_call_c_hours').attr('disabled',true) : $('#date_of_first_call_c_hours').removeAttr('disabled');
			($('#date_of_first_call_c_minutes').val()!='') ? $('#date_of_first_call_c_minutes').attr('disabled',true) : $('#date_of_first_call_c_minutes').removeAttr('disabled');
			($('#date_of_first_call_c_meridiem').val()!='') ? $('#date_of_first_call_c_meridiem').attr('disabled',true) : $('#date_of_first_call_c_meridiem').removeAttr('disabled');
			($('#date_of_first_call_c_date').val()!='') ? $('#date_of_first_call_c_trigger').hide() : $('#date_of_first_call_c_trigger').show();
			($('#status_of_first_call_c').val()!='') ? $('#status_of_first_call_c').attr('disabled',true) : $('#status_of_first_call_c').removeAttr('disabled');
			($('#date_of_second_call_c_date').val()!='') ? $('#date_of_second_call_c_date').attr('disabled',true) : $('#date_of_second_call_c_date').removeAttr('disabled');
			($('#date_of_second_call_c_hours').val()!='') ? $('#date_of_second_call_c_hours').attr('disabled',true) : $('#date_of_second_call_c_hours').removeAttr('disabled');
			($('#date_of_second_call_c_minutes').val()!='') ? $('#date_of_second_call_c_minutes').attr('disabled',true) : $('#date_of_second_call_c_minutes').removeAttr('disabled');
			($('#date_of_second_call_c_meridiem').val()!='') ? $('#date_of_second_call_c_meridiem').attr('disabled',true) : $('#date_of_second_call_c_meridiem').removeAttr('disabled');
			($('#date_of_second_call_c_date').val()!='') ? $('#date_of_second_call_c_trigger').hide() : $('#date_of_second_call_c_trigger').show();
			($('#status_of_second_call_c').val()!='') ? $('#status_of_second_call_c').attr('disabled',true) : $('#status_of_second_call_c').removeAttr('disabled');
				($('#date_of_third_call_c_date').val()!='') ? $('#date_of_third_call_c_date').attr('disabled',true) : $('#date_of_third_call_c_date').removeAttr('disabled');
				($('#date_of_third_call_c_hours').val()!='') ? $('#date_of_third_call_c_hours').attr('disabled',true) : $('#date_of_third_call_c_hours').removeAttr('disabled');
				($('#date_of_third_call_c_minutes').val()!='') ? $('#date_of_third_call_c_minutes').attr('disabled',true) : $('#date_of_third_call_c_minutes').removeAttr('disabled');
				($('#date_of_third_call_c_meridiem').val()!='') ? $('#date_of_third_call_c_meridiem').attr('disabled',true) : $('#date_of_third_call_c_meridiem').removeAttr('disabled');
				($('#date_of_third_call_c_date').val()!='') ? $('#date_of_third_call_c_trigger').hide() : $('#date_of_third_call_c_trigger').show();
				($('#status_of_third_call_c').val()!='') ? $('#status_of_third_call_c').attr('disabled',true) : $('#status_of_third_call_c').removeAttr('disabled');
				($('#date_of_validation_c').val()!='') ? $('#date_of_validation_c').attr('disabled',true) : $('#date_of_validation_c').removeAttr('disabled');
				($('#date_of_validation_c_date').val()!='') ? $('#date_of_validation_c_date').attr('disabled',true) : $('#date_of_validation_c_date').removeAttr('disabled');
				($('#date_of_validation_c_hours').val()!='') ? $('#date_of_validation_c_hours').attr('disabled',true) : $('#date_of_validation_c_hours').removeAttr('disabled');
				($('#date_of_validation_c_minutes').val()!='') ? $('#date_of_validation_c_minutes').attr('disabled',true) : $('#date_of_validation_c_minutes').removeAttr('disabled');
				($('#date_of_validation_c_meridiem').val()!='') ? $('#date_of_validation_c_meridiem').attr('disabled',true) : $('#date_of_validation_c_meridiem').removeAttr('disabled');
				($('#date_of_validation_c_date').val()!='') ? $('#date_of_validation_c_trigger').hide() : $('#date_of_validation_c_trigger').show();
				($('#validation_exe_assigned_c').val()!='') ? $('#validation_exe_assigned_c').attr('disabled',true) : $('#validation_exe_assigned_c').removeAttr('disabled');
				($('#age_of_the_user_c').val()!='') ? $('#age_of_the_user_c').attr('disabled',true) : $('#age_of_the_user_c').removeAttr('disabled');
				($('#age_c').val()!='') ? $('#age_c').attr('disabled',true) : $('#age_c').removeAttr('disabled');
				($('#agreed_to_assign_c').val()!='') ? $('#agreed_to_assign_c').attr('disabled',true) : $('#agreed_to_assign_c').removeAttr('disabled');
				($('#preferred_date_to_call_c').val()!='') ? $('#preferred_date_to_call_c').attr('disabled',true) : $('#preferred_date_to_call_c').removeAttr('disabled');
				($('#preferred_date_to_call_c').val()!='') ? $('#preferred_date_to_call_c_trigger').hide() : $('#preferred_date_to_call_c_trigger').show();
				($('#final_disposition_c').val()!='') ? $('#final_disposition_c').attr('disabled',true) : $('#final_disposition_c').removeAttr('disabled');
				($('#comments_c').val()!='') ? $('#comments_c').attr('disabled',true) : $('#comments_c').removeAttr('disabled');
				($('#online_activity_status_c').val()!='') ? $('#online_activity_status_c').attr('disabled',true) : $('#online_activity_status_c').removeAttr('disabled');
				($('#first_transaction_date_c').val()!='') ? $('#first_transaction_date_c').attr('disabled',true) : $('#first_transaction_date_c').removeAttr('disabled');
				($('#first_transaction_date_c').val()!='') ? $('#first_transaction_date_c_trigger').hide : $('#first_transaction_date_c_trigger').show();
				($('#gender_c').val()!='') ? $('#gender_c').attr('disabled',true) : $('#gender_c').removeAttr('disabled');
				($('#risk_profile_id_c').val()!='') ? $('#risk_profile_id_c').attr('disabled',true) : $('#risk_profile_id_c').removeAttr('disabled');


		});
	</script>
EOD;
}
echo $disable_fields=<<<DOF
	    <script>
		$(document).ready(function(){
		$('#intent_c').prop("readonly", true);
		$('#loan_occupation_c').prop("readonly", true);
		$('#loan_income_c').prop("readonly", true);
		$('#loan_dob_c').prop("readonly", true);
		$('#marital_status_c').attr('disabled', true);
		$('#status_c').attr('disabled', true);
		$('#rejection_reason_c').prop("readonly", true);
		$('#drop_stage1_c').prop("readonly", true);
		});
		</script>
DOF;
	 parent::display();	
 	}	
}

?>
