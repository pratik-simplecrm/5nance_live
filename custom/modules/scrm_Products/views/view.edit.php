<?php

if (!defined('sugarEntry') || !sugarEntry)
    die('Not A Valid Entry Point');

/* * *******************************************************************************
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
 * ****************************************************************************** */

require_once('include/MVC/View/views/view.edit.php');

class scrm_ProductsViewEdit extends ViewEdit {

    function scrm_ProductsViewEdit() {
        parent::ViewEdit();

        $this->useForSubpanel = true;
    }

    /**
     * display
     * Override the display method to support customization for the buttons that display
     * a popup and allow you to copy the account's address into the selected contacts.
     * The custom_code_billing and custom_code_shipping Smarty variables are found in
     * include/SugarFields/Fields/Address/DetailView.tpl (default).  If it's a English U.S.
     * locale then it'll use file include/SugarFields/Fields/Address/en_us.DetailView.tpl.
     */
    function display() {
//    echo "<pre>";
//    print_r($_REQUEST);

        if ($_REQUEST['return_module'] == 'Contacts' && empty($this->bean->id)) {
            $this->bean->contacts_scrm_products_1_name = $_REQUEST['contact_name'];
            $this->bean->name = $_REQUEST['contact_name'];
            $this->bean->contacts_scrm_products_1contacts_ida = $_REQUEST['contact_id'];
        }


        /*         * ************followup call status dependency****************** */
        echo $follow_up = <<<EOD
		<script>
                function disableOtherSalesStageOptions() {
			var sales_stage = $('#sales_stage_c').find('option:selected').val();
			var salesStageOptions = SUGAR.language.languages.app_list_strings['sales_stage_list'];
			//console.log(sales_stage);
			//console.log(salesStageOptions);
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
			var next_comment_list = SUGAR.language.languages.app_list_strings['next_comment_list'];
				  
			 var dispostion_selected = $('#disposition_c').find('option:selected').val();
			 
			 if(jQuery.inArray( dispostion_selected, next_call_planning_comment_list ) >= 0) {
                                 $('#comment_c').closest("tr").hide();
                                 $('#comment_c').val("");
                                 removeFromValidate('EditView','comment_c');     	// else remove the validtion applied
				 $('#next_call_planning_comments_c').parent().parent().show();
				 $('#next_call_planning_date_c').prev().show();
				 addToValidate('EditView','next_call_planning_comments_c','next_call_planning_comments_c',true,'Next Call Planning Comments:');
				 $('#next_call_planning_comments_c_label').html('Next Call Planning Comments: <font color="red">*</font>');
				 addToValidate('EditView','next_call_planning_date_c','next_call_planning_date_c',true,'Next Call Planning Date:');
				 $('#next_call_planning_date_c_label').html('Next Call Planning Date: <font color="red">*</font>');
			 } else if(jQuery.inArray( dispostion_selected, next_comment_list) >= 0) {
              
				 $('#next_call_planning_comments_c').closest("tr").hide();
				 $('#next_call_planning_date_c_date, #next_call_planning_date_c_hours, #next_call_planning_date_c_minutes, #next_call_planning_date_c_meridiem').val('');
				 removeFromValidate('EditView','next_call_planning_date_c');     	// else remove the validtion applied
                                 removeFromValidate('EditView','next_call_planning_comments_c');     	// else remove the validtion applied
				 
                               $('#comment_c').closest("tr").show();
				 addToValidate('EditView','comment_c',true,'Comment:');
				
			 } else {
                                $('#comment_c').closest("tr").hide();
                                $('#comment_c').val("");
                                removeFromValidate('EditView','comment_c');     	// else remove the validtion applied
				$('#next_call_planning_comments_c').parent().parent().hide();
				$('#next_call_planning_date_c_date, #next_call_planning_date_c_hours, #next_call_planning_date_c_minutes, #next_call_planning_date_c_meridiem').val('');
				$('#next_call_planning_comments_c').val(''); 
				 removeFromValidate('EditView','next_call_planning_comments_c');     	// else remove the validtion applied
				 $('#next_call_planning_comments_c_label').html('Next Call Planning Comments: ');
			 }
		}
		$(document).ready(function(){
              
                if(document.getElementById('next_call_planning_date_c_date')){
				 document.getElementById('next_call_planning_date_c_date').setAttribute('onchange',"callPlanningkDateValidation()");
			  }
			
			$('#next_call_planning_comments_c').parent().parent().hide();
			//enableDispositionDropdown();
			disableOtherSalesStageOptions();
                  $('#disposition_c').change(function(){
				 showHideNextCallPanningDetails();
			  });
			  showHideNextCallPanningDetails();
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
		</script>
EOD;
        /*         * ****************editable, not editable, product and sub product interest Dependency***************** */

        if (!empty($_REQUEST['record'])) {

            echo $notetitable = <<<noteditable
                    <script>                   
                    $(document).ready(function(){
                     
                 $("#name").attr('readonly', true);
                $("#contacts_scrm_products_1_name").attr('disabled', true);
                $('#btn_contacts_scrm_products_1_name').attr('disabled',true);
                $('#btn_clr_contacts_scrm_products_1_name').attr('disabled',true);
                    
                    if($('#product_sub_type_interest_c').val()==""){
                        $('#product_sub_type_interest_c').change(function(){
                       genrate_name();
                        });  
                    }else{
                          $("#product_sub_type_interest_c").prop("disabled", true);
    
                    }
                     if($('#product_interest_c').val()==""){
			$('#product_interest_c').change(function(){
                        genrate_name();
			loadProductSubTypeInterest();
                    	});  
                    }else{
                          $("#product_interest_c").prop("disabled", true);
    
                    }
                     if($('#source_c').val()!=""){
			
                          $("#source_c").prop("disabled", true);
    
                    }
                     if($('#campaign_type_c').val()!=""){
			
                          $("#campaign_type_c").prop("disabled", true);
    
                    }
                     if($('#utm_campaign_id_c').val()!=""){
			
                          $("#utm_campaign_id_c").prop("disabled", true);
    
                    }
			 loadProductSubTypeInterest(); 
               
		});    
                    </script>
noteditable;
        } else {

            echo $editable = <<<editable
                    <script>
                    $(document).ready(function(){
                    
                 $("#name").attr('readonly', true);
              
                        $('#product_sub_type_interest_c').change(function(){
                         genrate_name();
                        });  	
			$('#product_interest_c').change(function(){
                        genrate_name();
                        loadProductSubTypeInterest();
                	});  
			loadProductSubTypeInterest(); 
               
		});    
                   
                    </script>
editable;
        }
        echo $script1 = <<<product_interest
	<script>
		function genrate_name(){
                
                     setTimeout( function(){ 
                       var contact_name = $('#contacts_scrm_products_1_name').val();
                        var product_interest = $('#product_interest_c').val();
                        var product_sub_type_interest = $('#product_sub_type_interest_c').val();
               
                        if(contact_name==null)
                        {
                        contact_name="";
                        }else if((product_interest || product_sub_type_interest)&& contact_name){
                            contact_name= contact_name+" - ";
                        }
                        if(product_interest==null)
                        {
                        product_interest="";
                        }else if(product_sub_type_interest){
                            product_interest= product_interest+" - ";
                        }
                        if(product_sub_type_interest==null)
                        {
                        product_sub_type_interest="";
                        }
                
                        $('#name').val(contact_name + product_interest + product_sub_type_interest );
                        }  , 1000 );   
                    }
		function loadProductSubTypeInterest() {	
                
		  var sub_type = JSON.stringify($('#product_sub_type_interest_c').val());
		  var subtype_array = JSON.parse(sub_type);
		  var sel_product_type = $("#product_interest_c").val();
		  all_selected=[];
               
                
         
                var ptype =sel_product_type.replace(/ /g,"_");
                
                if(ptype!= ''){
                var subTypeInterestOptions = SUGAR.language.languages.app_list_strings['product_sub_type_'+ptype+'_list'];
                if(typeof subTypeInterestOptions !== 'undefined'){       
                all_selected.push(subTypeInterestOptions);
              
                  }
                  }  
     		 
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
           $('#product_sub_type_interest_c').html('');
            subTypeInterestList = '';
            $.each(get_selected, function(key, lval) {
                        $('#product_sub_type_interest_c').append('<option value=\"'+lval+'\">'+lval+'</option>');
            })
            $.each(subtype_array, function(i,e){
                    $("#product_sub_type_interest_c option[value='" + e + "']").prop("selected", true);
            });
	  }
	</script>
product_interest;

        echo $script2 = <<<product_name
	<script>
		$(document).ready(function(){
                
               
                  $('#btn_contacts_scrm_products_1_name').click(function(){
    checkContactIdChange();
});
$('#contacts_scrm_products_1_name').blur(function(){
    checkContactIdChange();
});
                 });
function checkContactIdChange() {
    var theInterval = setInterval(function(){
        var oldId = $('#contacts_scrm_products_1contacts_ida').data('oldId');
        var newId = $('#contacts_scrm_products_1contacts_ida').val();
        if (oldId != newId && newId != '') {
            getAccountData(newId, theInterval);
      genrate_name();
        }

    }, 500);
}

function getAccountData(id, theInterval) {

    // do your custom js
    clearInterval(theInterval);

}

   </script>
product_name;


        parent::display();
    }

}

?>
