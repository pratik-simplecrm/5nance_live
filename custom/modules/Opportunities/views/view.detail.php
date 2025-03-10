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

/*********************************************************************************

 * Description: This file is used to override the default Meta-data DetailView behavior
 * to provide customization specific to the Campaigns module.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/


require_once('include/MVC/View/views/view.detail.php');

class OpportunitiesViewDetail extends ViewDetail {

 	function OpportunitiesViewDetail(){
 		parent::ViewDetail();
 	}
 	
 	function display() {
	    
	    $currency = new Currency();
	    if(isset($this->bean->currency_id) && !empty($this->bean->currency_id))
	    {
	    	$currency->retrieve($this->bean->currency_id);
	    	if( $currency->deleted != 1){
	    		$this->ss->assign('CURRENCY', $currency->iso4217 .' '.$currency->symbol);
	    	}else {
	    	    $this->ss->assign('CURRENCY', $currency->getDefaultISO4217() .' '.$currency->getDefaultCurrencySymbol());	
	    	}
	    }else{
	    	$this->ss->assign('CURRENCY', $currency->getDefaultISO4217() .' '.$currency->getDefaultCurrencySymbol());
	    }
	    
echo $js=<<<EOF
			<script>
			$(document).ready(function(){
				var sales_stage  = $('#sales_stage').val();
				if(sales_stage == 'Closed Lost')
				{
					$('#reason_for_lost_c').parent().prev().show();
					$('#reason_for_lost_c').parent().show();
					$('#date_lost_c').parent().prev().show();
					$('#date_lost_c').parent().show();
				}
				else if(sales_stage == 'Closed Won')
				{
					$('#reason_for_lost_c').parent().parent().append('<td></td><td></td><td><td></td></td>');
				$('#reason_for_lost_c').parent().prev().hide();
				$('#reason_for_lost_c').parent().hide();
				$('#date_lost_c').parent().parent().append('<td></td><td></td><td><td></td></td>');
				$('#date_lost_c').parent().prev().hide();
				$('#date_lost_c').parent().hide();
				$('#actual_date_closed_c').parent().prev().show();
				$('#actual_date_closed_c').parent().show();
				}
				else
				{
				$('#reason_for_lost_c').parent().parent().append('<td></td><td></td><td><td></td></td>');
				$('#reason_for_lost_c').parent().prev().hide();
				$('#reason_for_lost_c').parent().hide();
				$('#date_lost_c').parent().parent().append('<td></td><td></td><td><td></td></td>');
				$('#date_lost_c').parent().prev().hide();
				$('#date_lost_c').parent().hide();
				$('#actual_date_closed_c').parent().parent().append('<td></td><td></td><td><td></td></td>');
				$('#actual_date_closed_c').parent().prev().hide();
				$('#actual_date_closed_c').parent().hide();
				}
			});
			</script>
EOF;







        if(empty($this->bean->id)){
            sugar_die($GLOBALS['app_strings']['ERROR_NO_RECORD']);
        }				
        $this->dv->process();
        echo $this->dv->display();

 	}
 	
}
?>
