<?php /* Smarty version 2.6.11, created on 2018-01-29 17:22:14
         compiled from modules/Campaigns/WizardHome.html */ ?>
<!--
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.

 * SuiteCRM is an extension to SugarCRM Community Edition developed by Salesagility Ltd.
 * Copyright (C) 2011 - 2014 Salesagility Ltd.
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
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for  technical reasons, the Appropriate Legal Notices must
 * display the words  "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 ********************************************************************************/

/*********************************************************************************

 ********************************************************************************/
-->
<form id="wizform" name="wizform" method="POST" action="index.php">
	<input type="hidden" id="module" name="module" value="Campaigns">
	<input type="hidden" id="action" name="action" = "WizardHome">
	<input type="hidden" id="process_form" name="process_form" value='false' >		
	<input type="hidden" id="return_module" name="return_module" value="<?php echo $this->_tpl_vars['RETURN_MODULE']; ?>
">
	<input type="hidden" id="return_id" name="return_id" value="<?php echo $this->_tpl_vars['RETURN_ID']; ?>
">
	<input type="hidden" id="return_action" name="return_action" value="<?php echo $this->_tpl_vars['RETURN_ACTION']; ?>
">
	<input type="hidden" id="record" name="record" value="<?php echo $this->_tpl_vars['ID']; ?>
">	
	<input type="hidden" id="direct_step" name="direct_step" value="1">		
	<input type="hidden" id="campaign_id" name="campaign_id" value="">			
	<input type="hidden" id="wiz_mass" name="wiz_mass" value="">			
	<input type="hidden" id="mode" name="mode" value="">					



<table class='other view' cellspacing="1">
<tr>
<td rowspan='2' width='10%' scope='row' style='vertical-align: top;'>
<div id='nav' >
<?php echo $this->_tpl_vars['NAV_ITEMS']; ?>


</div>

</td>

<td class='edit view' rowspan='2' width='100%'>
<?php echo $this->_tpl_vars['CAMPAIGN_DIAGNOSTIC_LINK']; ?>
<p>
<table  width="100%" border="0" cellspacing="1" cellpadding="0" >
	<tr><td>
		<div id='campaign_summary'><?php echo $this->_tpl_vars['CAMPAIGN_TBL']; ?>
</div><p>
	</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>
		<p><div id='campaign_trackers'><?php echo $this->_tpl_vars['TRACKERS_TBL']; ?>
</div>
	</td></tr>
	<tr><td>&nbsp;</td></tr>			
	<tr><td>
		<p><div id='campaign_targets'><?php echo $this->_tpl_vars['TARGETS_TBL']; ?>
</div>
	</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>
		<p><div id='campaign_marketing'><?php echo $this->_tpl_vars['MARKETING_TBL']; ?>
</div>
	</td></tr>
</table>		

		
</td></tr></table>
<script>
<?php echo $this->_tpl_vars['MSG_SCRIPT']; ?>

</script>
</form>
		