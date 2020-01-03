<?php
 /**
 * 
 * 
 * @package 
 * @copyright SalesAgility Ltd http://www.salesagility.com
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU AFFERO GENERAL PUBLIC LICENSE
 * along with this program; if not, see http://www.gnu.org/licenses
 * or write to the Free Software Foundation,Inc., 51 Franklin Street,
 * Fifth Floor, Boston, MA 02110-1301  USA
 *
 * @author Salesagility Ltd <support@salesagility.com>
 */
require_once('include/MVC/View/views/view.edit.php');
require_once('include/SugarTinyMCE.php');

class CasesViewEdit extends ViewEdit {

    function CasesViewEdit(){
        parent::ViewEdit();
    }

    function display(){
        
        global $sugar_config;
        $site_url=$sugar_config['site_url'];
        $new = empty($this->bean->id);
        if($new){
            ?>
            <script>
                $(document).ready(function(){
                    $('#update_text').closest('td').html('');
                    $('#update_text_label').closest('td').html('');
                    $('#internal').closest('td').html('');
                    $('#internal_label').closest('td').html('');
                    $('#addFileButton').closest('td').html('');
                    $('#case_update_form_label').closest('td').html('');
                });
            </script>
        <?php
        }
        $tiny = new SugarTinyMCE();
        echo $tiny->getInstance('update_text,description', 'email_compose_light');

echo $javscript =<<<EOD
		<script>
		$(document).ready(function(){
			$('#internal_notes_log_c').attr('readonly', 'readonly');
		var state = $('#state').val();
		if(state =='Closed')
		{
					addToValidate('EditView','resolution','resolution',true,'resolution');
					 $('#resolution_label').html('Resolution: <font color="red">*</font>');
		}
		else
			{
					removeFromValidate('EditView','resolution'); // else remove the validtion applied
						 $('#resolution_label').html('Resolution: ');
			}
		$('#state').change(function(){
		var state = $('#state').val();
		if(state =='Closed')
		{
					addToValidate('EditView','resolution','resolution',true,'resolution');
					 $('#resolution_label').html('Resolution: <font color="red">*</font>');
		}
		else
			{
					removeFromValidate('EditView','resolution'); // else remove the validtion applied
						 $('#resolution_label').html('Resolution: ');
			}
		
		});
		
		});
		</script>
EOD;



	//Custom Code for dependent dropdown by Shakeer
	
	echo $js=<<<EOD
		<script>
			$(document).ready(function(){
				$('#module_c').change(function(){
					loadSubModuleOptions();
					loadManufacturerOptions();
				});
				loadSubModuleOptions();
				loadManufacturerOptions();
			});
			
			function loadSubModuleOptions() {
		  
				  var sub_module = $('#sub_module_c option:selected').text();
				  
				  var module = $("#module_c").find("option:selected").val().replace(/ /g,"_");
				  
				  var subModuleOptions = SUGAR.language.languages.app_list_strings['sub_module_'+module+'_list'];
						//console.log(subModuleOptions);
				  $('#sub_module_c').html('');
				  subModuleList = '';
				  for(var key in subModuleOptions) {	  
					  if(sub_module == subModuleOptions[key]) {
						  subModuleList += '<option value="'+key+'" selected="selected">'+subModuleOptions[key]+'</option>';
					  } else {
						  subModuleList += '<option value="'+key+'">'+subModuleOptions[key]+'</option>';
					  }
				  }
				  $('#sub_module_c').append(subModuleList);
			  }
			function loadManufacturerOptions() {
		  
					var manufacturer_name = $('#manufacturer_name_c option:selected').text();
				  
				  var module = $("#module_c").find("option:selected").val().replace(/ /g,"_");
				  
				  var manufacturerOptions = SUGAR.language.languages.app_list_strings['manufacturer_name_'+module+'_list'];
				  $('#manufacturer_name_c').html('');
				  
				  manufacturerList = '';
				  for(var key in manufacturerOptions) {	  
					  if(manufacturer_name == manufacturerOptions[key]) {
						  manufacturerList += '<option value="'+key+'" selected="selected">'+manufacturerOptions[key]+'</option>';
					  } else {
						  manufacturerList += '<option value="'+key+'">'+manufacturerOptions[key]+'</option>';
					  }
				  }
				  $('#manufacturer_name_c').append(manufacturerList);
			  }
			
		</script>
EOD;

	/***************Autopopulate contact details - Noresha**************************/
	echo $script=<<<autopopulate
	<script>
	function contact_details(){
		var contact_id = $('#contacts_cases_1contacts_ida').val();
		if(contact_id){
				$.ajax({
					url:'$site_url/index.php?entryPoint=autopopulate',
					type:'GET',
					async:false,
					data:{
						contact_id:contact_id,
					},
				}).done(function(data){
					response = jQuery.parseJSON(data);		
					console.log(response.phone_mobile);		
					console.log(response.email_address);		
					//console.log(response["phone_mobile"]);	
				});
				$('#mobile_number_c').val(response.phone_mobile);
				$('#Cases0emailAddress0').val(response.email_address);
			}
		
	}
	</script>
autopopulate;
	
	parent::display();

    }

}
