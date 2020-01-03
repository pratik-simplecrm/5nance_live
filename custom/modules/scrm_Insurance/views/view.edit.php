<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
require_once('include/MVC/View/views/view.edit.php');

class scrm_InsuranceViewEdit extends ViewEdit {

 	function display(){
 		/******************hide and show panels on basis of policy type dropdown******************/
 		echo $script=<<<hiding_panels
 		<script>
 		$(document).ready(function(){
 			var policy_type = $('#policy_type').val();
 				var policy_sub_type = $('#policy_subtype').val();
 				if(policy_type == 'Health'){
 					$('#detailpanel_2').show();	
		 			$('#detailpanel_3').hide();	
		 			$('#detailpanel_4').hide();	
		 			$('#detailpanel_5').hide();	
		 			$('#detailpanel_6').hide();	
		 			$('#detailpanel_7').hide();	
		 			$('#detailpanel_8').hide();	
		 			$('#detailpanel_9').hide();	
		 			$('#detailpanel_10').hide();	
		 			$('#detailpanel_11').hide();	
		 			$('#detailpanel_12').hide();
 				}else if(policy_type == 'Term'){
 					$('#detailpanel_2').hide();	
		 			$('#detailpanel_3').show();	
		 			$('#detailpanel_4').hide();	
		 			$('#detailpanel_5').hide();	
		 			$('#detailpanel_6').hide();	
		 			$('#detailpanel_7').hide();	
		 			$('#detailpanel_8').hide();	
		 			$('#detailpanel_9').hide();	
		 			$('#detailpanel_10').hide();	
		 			$('#detailpanel_11').hide();	
		 			$('#detailpanel_12').hide();
 				}else if(policy_type == 'Two Wheeler'){
 					$('#detailpanel_2').hide();	
		 			$('#detailpanel_3').hide();	
		 			$('#detailpanel_4').show();	
		 			$('#detailpanel_5').hide();	
		 			$('#detailpanel_6').hide();	
		 			$('#detailpanel_7').hide();	
		 			$('#detailpanel_8').hide();	
		 			$('#detailpanel_9').hide();	
		 			$('#detailpanel_10').hide();	
		 			$('#detailpanel_11').hide();	
		 			$('#detailpanel_12').hide();
 				}else if(policy_type == 'Motor Vehicle'){
 					$('#detailpanel_2').hide();	
		 			$('#detailpanel_3').hide();	
		 			$('#detailpanel_4').hide();	
		 			$('#detailpanel_5').show();	
		 			$('#detailpanel_6').hide();	
		 			$('#detailpanel_7').hide();	
		 			$('#detailpanel_8').hide();	
		 			$('#detailpanel_9').hide();	
		 			$('#detailpanel_10').hide();	
		 			$('#detailpanel_11').hide();	
		 			$('#detailpanel_12').hide();
 				}else if(policy_type == 'Travel'){
 					$('#detailpanel_2').hide();	
		 			$('#detailpanel_3').hide();	
		 			$('#detailpanel_4').hide();	
		 			$('#detailpanel_5').hide();	
		 			$('#detailpanel_6').show();	
		 			$('#detailpanel_7').hide();	
		 			$('#detailpanel_8').hide();	
		 			$('#detailpanel_9').hide();	
		 			$('#detailpanel_10').hide();	
		 			$('#detailpanel_11').hide();	
		 			$('#detailpanel_12').hide();
 				}else if(policy_type == 'House Insurance'){
 					$('#detailpanel_2').hide();	
		 			$('#detailpanel_3').hide();	
		 			$('#detailpanel_4').hide();	
		 			$('#detailpanel_5').hide();	
		 			$('#detailpanel_6').hide();	
		 			$('#detailpanel_7').show();	
		 			$('#detailpanel_8').hide();	
		 			$('#detailpanel_9').hide();	
		 			$('#detailpanel_10').hide();	
		 			$('#detailpanel_11').hide();	
		 			$('#detailpanel_12').hide();
 				}else if(policy_type == 'Personal Accident'){
 					$('#detailpanel_2').hide();	
		 			$('#detailpanel_3').hide();	
		 			$('#detailpanel_4').hide();	
		 			$('#detailpanel_5').hide();	
		 			$('#detailpanel_6').hide();	
		 			$('#detailpanel_7').hide();	
		 			$('#detailpanel_8').show();	
		 			$('#detailpanel_9').hide();	
		 			$('#detailpanel_10').hide();	
		 			$('#detailpanel_11').hide();	
		 			$('#detailpanel_12').hide();
 				}else if(policy_type == 'Retirement Policy'){
 					$('#detailpanel_2').hide();	
		 			$('#detailpanel_3').hide();	
		 			$('#detailpanel_4').hide();	
		 			$('#detailpanel_5').hide();	
		 			$('#detailpanel_6').hide();	
		 			$('#detailpanel_7').hide();	
		 			$('#detailpanel_8').hide();	
		 			$('#detailpanel_9').show();	
		 			$('#detailpanel_10').hide();	
		 			$('#detailpanel_11').hide();	
		 			$('#detailpanel_12').hide();
 				}else if(policy_type == 'Endowment Policy'){
 					$('#detailpanel_2').hide();	
		 			$('#detailpanel_3').hide();	
		 			$('#detailpanel_4').hide();	
		 			$('#detailpanel_5').hide();	
		 			$('#detailpanel_6').hide();	
		 			$('#detailpanel_7').hide();	
		 			$('#detailpanel_8').hide();	
		 			$('#detailpanel_9').hide();	
		 			$('#detailpanel_10').show();	
		 			$('#detailpanel_11').hide();	
		 			$('#detailpanel_12').hide();
 				}else if(policy_type == 'Child Plan'){
 					$('#detailpanel_2').hide();	
		 			$('#detailpanel_3').hide();	
		 			$('#detailpanel_4').hide();	
		 			$('#detailpanel_5').hide();	
		 			$('#detailpanel_6').hide();	
		 			$('#detailpanel_7').hide();	
		 			$('#detailpanel_8').hide();	
		 			$('#detailpanel_9').hide();	
		 			$('#detailpanel_10').hide();	
		 			$('#detailpanel_11').show();	
		 			$('#detailpanel_12').hide();
 				}else if(policy_type == 'ULIP'){
 					$('#detailpanel_2').hide();	
		 			$('#detailpanel_3').hide();	
		 			$('#detailpanel_4').hide();	
		 			$('#detailpanel_5').hide();	
		 			$('#detailpanel_6').hide();	
		 			$('#detailpanel_7').hide();	
		 			$('#detailpanel_8').hide();	
		 			$('#detailpanel_9').hide();	
		 			$('#detailpanel_10').hide();	
		 			$('#detailpanel_11').hide();	
		 			$('#detailpanel_12').show();
 				}else{
 					$('#detailpanel_2').hide();	
		 			$('#detailpanel_3').hide();	
		 			$('#detailpanel_4').hide();	
		 			$('#detailpanel_5').hide();	
		 			$('#detailpanel_6').hide();	
		 			$('#detailpanel_7').hide();	
		 			$('#detailpanel_8').hide();	
		 			$('#detailpanel_9').hide();	
		 			$('#detailpanel_10').hide();	
		 			$('#detailpanel_11').hide();	
		 			$('#detailpanel_12').hide();
 				}
 			insurance_name_details();  			
 			$('#policy_type').change(function(){
 				var policy_type = $('#policy_type').val();
 				var policy_sub_type = $('#policy_subtype').val();
 				if(policy_type == 'Health'){
 					$('#subtype').parent().parent().hide();
 					$('#detailpanel_2').show();	
		 			$('#detailpanel_3').hide();	
		 			$('#detailpanel_4').hide();	
		 			$('#detailpanel_5').hide();	
		 			$('#detailpanel_6').hide();	
		 			$('#detailpanel_7').hide();	
		 			$('#detailpanel_8').hide();	
		 			$('#detailpanel_9').hide();	
		 			$('#detailpanel_10').hide();	
		 			$('#detailpanel_11').hide();	
		 			$('#detailpanel_12').hide();
 				}else if(policy_type == 'Term'){
 					$('#detailpanel_2').hide();	
		 			$('#detailpanel_3').show();	
		 			$('#detailpanel_4').hide();	
		 			$('#detailpanel_5').hide();	
		 			$('#detailpanel_6').hide();	
		 			$('#detailpanel_7').hide();	
		 			$('#detailpanel_8').hide();	
		 			$('#detailpanel_9').hide();	
		 			$('#detailpanel_10').hide();	
		 			$('#detailpanel_11').hide();	
		 			$('#detailpanel_12').hide();
 				}else if(policy_type == 'Two Wheeler'){
 					$('#detailpanel_2').hide();	
		 			$('#detailpanel_3').hide();	
		 			$('#detailpanel_4').show();	
		 			$('#detailpanel_5').hide();	
		 			$('#detailpanel_6').hide();	
		 			$('#detailpanel_7').hide();	
		 			$('#detailpanel_8').hide();	
		 			$('#detailpanel_9').hide();	
		 			$('#detailpanel_10').hide();	
		 			$('#detailpanel_11').hide();	
		 			$('#detailpanel_12').hide();
 				}else if(policy_type == 'Motor Vehicle'){
 					$('#detailpanel_2').hide();	
		 			$('#detailpanel_3').hide();	
		 			$('#detailpanel_4').hide();	
		 			$('#detailpanel_5').show();	
		 			$('#detailpanel_6').hide();	
		 			$('#detailpanel_7').hide();	
		 			$('#detailpanel_8').hide();	
		 			$('#detailpanel_9').hide();	
		 			$('#detailpanel_10').hide();	
		 			$('#detailpanel_11').hide();	
		 			$('#detailpanel_12').hide();
 				}else if(policy_type == 'Travel'){
 					$('#detailpanel_2').hide();	
		 			$('#detailpanel_3').hide();	
		 			$('#detailpanel_4').hide();	
		 			$('#detailpanel_5').hide();	
		 			$('#detailpanel_6').show();	
		 			$('#detailpanel_7').hide();	
		 			$('#detailpanel_8').hide();	
		 			$('#detailpanel_9').hide();	
		 			$('#detailpanel_10').hide();	
		 			$('#detailpanel_11').hide();	
		 			$('#detailpanel_12').hide();
 				}else if(policy_type == 'House Insurance'){
 					$('#detailpanel_2').hide();	
		 			$('#detailpanel_3').hide();	
		 			$('#detailpanel_4').hide();	
		 			$('#detailpanel_5').hide();	
		 			$('#detailpanel_6').hide();	
		 			$('#detailpanel_7').show();	
		 			$('#detailpanel_8').hide();	
		 			$('#detailpanel_9').hide();	
		 			$('#detailpanel_10').hide();	
		 			$('#detailpanel_11').hide();	
		 			$('#detailpanel_12').hide();
 				}else if(policy_type == 'Personal Accident'){
 					$('#detailpanel_2').hide();	
		 			$('#detailpanel_3').hide();	
		 			$('#detailpanel_4').hide();	
		 			$('#detailpanel_5').hide();	
		 			$('#detailpanel_6').hide();	
		 			$('#detailpanel_7').hide();	
		 			$('#detailpanel_8').show();	
		 			$('#detailpanel_9').hide();	
		 			$('#detailpanel_10').hide();	
		 			$('#detailpanel_11').hide();	
		 			$('#detailpanel_12').hide();
 				}else if(policy_type == 'Retirement Policy'){
 					$('#detailpanel_2').hide();	
		 			$('#detailpanel_3').hide();	
		 			$('#detailpanel_4').hide();	
		 			$('#detailpanel_5').hide();	
		 			$('#detailpanel_6').hide();	
		 			$('#detailpanel_7').hide();	
		 			$('#detailpanel_8').hide();	
		 			$('#detailpanel_9').show();	
		 			$('#detailpanel_10').hide();	
		 			$('#detailpanel_11').hide();	
		 			$('#detailpanel_12').hide();
 				}else if(policy_type == 'Endowment Policy'){
 					$('#detailpanel_2').hide();	
		 			$('#detailpanel_3').hide();	
		 			$('#detailpanel_4').hide();	
		 			$('#detailpanel_5').hide();	
		 			$('#detailpanel_6').hide();	
		 			$('#detailpanel_7').hide();	
		 			$('#detailpanel_8').hide();	
		 			$('#detailpanel_9').hide();	
		 			$('#detailpanel_10').show();	
		 			$('#detailpanel_11').hide();	
		 			$('#detailpanel_12').hide();
 				}else if(policy_type == 'Child Plan'){
 					$('#detailpanel_2').hide();	
		 			$('#detailpanel_3').hide();	
		 			$('#detailpanel_4').hide();	
		 			$('#detailpanel_5').hide();	
		 			$('#detailpanel_6').hide();	
		 			$('#detailpanel_7').hide();	
		 			$('#detailpanel_8').hide();	
		 			$('#detailpanel_9').hide();	
		 			$('#detailpanel_10').hide();	
		 			$('#detailpanel_11').show();	
		 			$('#detailpanel_12').hide();
 				}else if(policy_type == 'ULIP'){
 					$('#detailpanel_2').hide();	
		 			$('#detailpanel_3').hide();	
		 			$('#detailpanel_4').hide();	
		 			$('#detailpanel_5').hide();	
		 			$('#detailpanel_6').hide();	
		 			$('#detailpanel_7').hide();	
		 			$('#detailpanel_8').hide();	
		 			$('#detailpanel_9').hide();	
		 			$('#detailpanel_10').hide();	
		 			$('#detailpanel_11').hide();	
		 			$('#detailpanel_12').show();
 				}else{
 					$('#detailpanel_2').hide();	
		 			$('#detailpanel_3').hide();	
		 			$('#detailpanel_4').hide();	
		 			$('#detailpanel_5').hide();	
		 			$('#detailpanel_6').hide();	
		 			$('#detailpanel_7').hide();	
		 			$('#detailpanel_8').hide();	
		 			$('#detailpanel_9').hide();	
		 			$('#detailpanel_10').hide();	
		 			$('#detailpanel_11').hide();	
		 			$('#detailpanel_12').hide();
 				}
 			});		
 		});
 		function insurance_name_details(){
 			
 			$('#policy_type').change(function(){
 				var customer_name = $('#contacts_scrm_insurance_1_name').val();
	 			var policy_type = SUGAR.language.languages.app_list_strings['policy_type_list'][$('#policy_type').val()];
	 			var policy_subtype = SUGAR.language.languages.app_list_strings['policy_subtype_c_list'][$('#policy_subtype').val()];
	 			$('#name').val(customer_name + ' - ' + policy_type + ' - ' + policy_subtype );
			});
			$('#policy_subtype').change(function(){					
				var customer_name = $('#contacts_scrm_insurance_1_name').val();
	 			var policy_type = SUGAR.language.languages.app_list_strings['policy_type_list'][$('#policy_type').val()];
	 			var policy_subtype = SUGAR.language.languages.app_list_strings['policy_subtype_c_list'][$('#policy_subtype').val()];
				$('#name').val(customer_name + ' - ' + policy_type + ' - ' + policy_subtype );
			});
 		}
 		
 		</script>
hiding_panels;
		/**************number of members - Health Insurance*********************/
		echo $health_insurance=<<<health_insurance
		<script>
			$(document).ready(function(){

				var policy_subtype = $('#policy_subtype').val();
				if(policy_subtype == 'Health_Individual' || policy_subtype == 'Health_Family Floater'){
					$('#subtype').parent().parent().hide();
				}else{
					$('#subtype').parent().parent().show();
				}
				$('#policy_subtype').change(function(){
					loadnumberofmem();
					var policy_subtype = $('#policy_subtype').val();
					if(policy_subtype == 'Health_Individual' || policy_subtype == 'Health_Family Floater'){
						$('#subtype').parent().parent().hide();
					}else{
						$('#subtype').parent().parent().show();
						$('#subtype').change(function(){
							loadsubtypenoofmem();
						});
					}

				});
				//loadnumberofmem();
			});
			function loadnumberofmem(){
				var policy_subtype = $('#policy_subtype').find('option:selected').val();
				if(policy_subtype == 'Health_Individual'){
					var no_of_members = SUGAR.language.languages.app_list_strings['family_no_of_members_list'];
				}else if(policy_subtype == 'Health_Family Floater'){
					var no_of_members = SUGAR.language.languages.app_list_strings['individual_no_of_mem_list'];
				}
					$('#family_no_of_members').html('');
					familymemList = '';
					for(var key in no_of_members) {	  
						 if(policy_subtype == no_of_members[key]) {
							  familymemList += '<option value="'+key+'" selected="selected">'+no_of_members[key]+'</option>';
						  } else {
							  familymemList += '<option value="'+key+'">'+no_of_members[key]+'</option>';
						  }
					}
					 $('#family_no_of_members').append(familymemList);
			}
			function loadsubtypenoofmem(){
				var subtype = $('#subtype').find('option:selected').val();
				if(subtype == 'Individual'){
					var no_of_members = SUGAR.language.languages.app_list_strings['family_no_of_members_list'];
				}else if(subtype == 'Floater'){
					var no_of_members = SUGAR.language.languages.app_list_strings['individual_no_of_mem_list'];
				}
					$('#family_no_of_members').html('');
					familymemList = '';
					for(var key in no_of_members) {	  
						 if(policy_subtype == no_of_members[key]) {
							  familymemList += '<option value="'+key+'" selected="selected">'+no_of_members[key]+'</option>';
						  } else {
							  familymemList += '<option value="'+key+'">'+no_of_members[key]+'</option>';
						  }
					}
					 $('#family_no_of_members').append(familymemList);
			}
		</script>
health_insurance;
		echo $motor_insurance=<<<motor_insurance
			<script>
			$(document).ready(function(){
				$('#zero_depreciation').parent().parent().hide();
				$('#road_side_assistance').parent().parent().hide();
				$('#key_replacement').parent().parent().hide();
				$('#registered_member_of_aai').parent().parent().hide();
				$('#policy_subtype').change(function(){
					loadnumberofmem();
					var policy_subtype = $('#policy_subtype').val();
					if(policy_subtype == 'Motor Vehicle_Motor Vehicle'){
						$('#zero_depreciation').parent().parent().hide();
						$('#road_side_assistance').parent().parent().hide();
						$('#key_replacement').parent().parent().hide();
						$('#registered_member_of_aai').parent().parent().hide();
						$('#motor_policy_type').parent().parent().show();
						$('#previous_insurer').parent().parent().show();
						$('#motor_rto_location_city').parent().parent().show();
						$('#motor_manufacturing_year').parent().parent().show();
						$('#motor_model').parent().parent().show();
						$('#fuel_type').parent().parent().show();
						$('#motor_claim_status').parent().parent().show();
						$('#motor_addoncovers').parent().parent().show();
					}else if(policy_subtype == 'Motor Vehicle_Add-Ons'){
						$('#zero_depreciation').parent().parent().show();
						$('#road_side_assistance').parent().parent().show();
						$('#key_replacement').parent().parent().show();
						$('#registered_member_of_aai').parent().parent().hide();
						$('#motor_policy_type').parent().parent().hide();
						$('#previous_insurer').parent().parent().hide();
						$('#motor_rto_location_city').parent().parent().hide();
						$('#motor_manufacturing_year').parent().parent().hide();
						$('#motor_model').parent().parent().hide();
						$('#fuel_type').parent().parent().hide();
						$('#motor_claim_status').parent().parent().hide();
						$('#motor_addoncovers').parent().parent().hide();
					}else if(policy_subtype == 'Motor Vehicle_Discount Option'){
						$('#zero_depreciation').parent().parent().hide();
						$('#road_side_assistance').parent().parent().hide();
						$('#key_replacement').parent().parent().hide();
						$('#registered_member_of_aai').parent().parent().show();
						$('#motor_policy_type').parent().parent().hide();
						$('#previous_insurer').parent().parent().hide();
						$('#motor_rto_location_city').parent().parent().hide();
						$('#motor_manufacturing_year').parent().parent().hide();
						$('#motor_model').parent().parent().hide();
						$('#fuel_type').parent().parent().hide();
						$('#motor_claim_status').parent().parent().hide();
						$('#motor_addoncovers').parent().parent().hide();
					}

				});
			});
			</script>
motor_insurance;
	echo $Retirement_policy=<<<Retirement
	<script>
		$(document).ready(function(){
			var policy_subtype = $('#policy_subtype').val();
				if(policy_subtype == 'Retirement Policy_Retirement Policy'){
					$('#retirement_sum_insured').parent().parent().hide();
					$('#city_of_residence').parent().parent().hide();
					$('#pension_amount_per_month').parent().parent().show();
				}else if(policy_subtype == 'Retirement Policy_Pension Plan'){
					$('#retirement_sum_insured').parent().parent().show();
					$('#city_of_residence').parent().parent().show();
					$('#pension_amount_per_month').parent().parent().hide();
				}
			$('#policy_subtype').change(function(){
				var policy_subtype = $('#policy_subtype').val();
				if(policy_subtype == 'Retirement Policy_Retirement Policy'){
					$('#retirement_sum_insured').parent().parent().hide();
					$('#city_of_residence').parent().parent().hide();
					$('#pension_amount_per_month').parent().parent().show();
				}else if(policy_subtype == 'Retirement Policy_Pension Plan'){
					$('#retirement_sum_insured').parent().parent().show();
					$('#city_of_residence').parent().parent().show();
					$('#pension_amount_per_month').parent().parent().hide();
				}
			});
			
		});
	</script>
Retirement;
	 	parent::display();
 	}
 }