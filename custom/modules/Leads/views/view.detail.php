<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/

require_once('include/MVC/View/views/view.detail.php');

class LeadsViewDetail extends ViewDetail {

 	function display(){

		global $sugar_config;

        require_once('modules/AOS_PDF_Templates/formLetter.php');
		formLetter::DVPopupHtml('Leads');

		//If the convert lead action has been disabled for already converted leads, disable the action link.
		$disableConvert = ($this->bean->status == 'Valid' && !empty($sugar_config['disable_convert_lead'])) ? TRUE : FALSE;
		$this->ss->assign("DISABLE_CONVERT_ACTION", $disableConvert);
		/*********************Hiding & Showing based on status and gateway values********************/
		echo $js=<<<EOD
		<script>
		$(document).ready(function(){
			var gateway = $('#gateway_c').val();
			if(gateway == 'CRM-OFFLINE'){
				$('#campaign_type_c').parent().parent().show();
				$('#accounts_leads_1accounts_ida').parent().parent().hide();
				$('#referred_by_c').parent().parent().hide();
				$('#related_kiosk_account_c').parent().parent().hide();
			}else if(gateway == 'CRM-CORPORATE SALES'){
				$('#campaign_type_c').parent().parent().show();
				$('#accounts_leads_1accounts_ida').parent().parent().show();
				$('#referred_by_c').parent().parent().hide();
				$('#related_kiosk_account_c').parent().parent().hide();
			}else if(gateway == 'CRM- M.P ONLINE' || gateway == 'CRM-EMITRA'){
				$('#campaign_type_c').parent().parent().hide();
				$('#accounts_leads_1accounts_ida').parent().parent().hide();
				$('#referred_by_c').parent().parent().hide();
				$('#related_kiosk_account_c').parent().parent().show();	
			}else if(gateway == 'CRM-REFERENCE'){
				$('#campaign_type_c').parent().parent().hide();
				$('#accounts_leads_1accounts_ida').parent().parent().hide();
				$('#referred_by_c').parent().parent().show();
				$('#related_kiosk_account_c').parent().parent().hide();	
			}else if(gateway == 'CRM-MARKETING'){
				$('#campaign_type_c').parent().parent().show();
				$('#accounts_leads_1accounts_ida').parent().parent().hide();
				$('#referred_by_c').parent().parent().hide();
				$('#related_kiosk_account_c').parent().parent().hide();	
			}else{
				$('#campaign_type_c').parent().parent().hide();
				$('#accounts_leads_1accounts_ida').parent().parent().hide();
				$('#referred_by_c').parent().parent().hide();
				$('#related_kiosk_account_c').parent().parent().hide();	
			}
			var status = $('#status').val();
			if(status=='Followup'){
				$('#next_call_planning_date_c').parent().parent().show();
				 
			}else{
				$('#next_call_planning_date_c').parent().parent().hide();
				$('#next_call_planning_comment_c').parent().parent().hide();
				
			}
			// if(gateway == 'CRM-MARKETING'){
			// 	$('#otp_c').parent().parent().hide();
			// }else{
			// 	$('#otp_c').parent().parent().show();
			// }
		});
		</script>
EOD;
		/********************Hide OTP validation for marketing leads*************************/
	
		parent::display();
 	}	
}

?>
