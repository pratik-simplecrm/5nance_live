<?php /* Smarty version 2.6.11, created on 2018-08-10 12:09:18
         compiled from include/SugarFields/Fields/Datetimecombo/SearchView.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugarvar', 'include/SugarFields/Fields/Datetimecombo/SearchView.tpl', 44, false),)), $this); ?>
{*
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

*}
<table border="0" cellpadding="0" cellspacing="0">
<tr valign="middle">
<td nowrap>
<input autocomplete="off" type="text" id="<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
_date" value="{$fields[<?php echo smarty_function_sugarvar(array('key' => 'name','stringFormat' => true), $this);?>
].value}" size="11" maxlength="10" title='<?php echo $this->_tpl_vars['vardef']['help']; ?>
' <?php if (! empty ( $this->_tpl_vars['tabindex'] )): ?> tabindex='<?php echo $this->_tpl_vars['tabindex']; ?>
' <?php endif; ?>  onblur="combo_<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
.update(); <?php if (isset ( $this->_tpl_vars['displayParams']['updateCallback'] )):  echo $this->_tpl_vars['displayParams']['updateCallback'];  endif; ?>">
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}&nbsp;
<?php if (empty ( $this->_tpl_vars['displayParams']['splitDateTime'] )): ?>
</td>
<td nowrap>
<?php else: ?>
<br>
<?php endif; ?>
<div id="<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
_time_section"></div>
<?php if ($this->_tpl_vars['displayParams']['showNoneCheckbox']): ?>
<script type="text/javascript">
function set_<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
_values(form) {ldelim}
 if(form.<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
_flag.checked)  {ldelim}
	form.<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
_flag.value=1;
	form.<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
.value="";
	form.<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
.readOnly=true;
 {rdelim} else  {ldelim}
	form.<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
_flag.value=0;
	form.<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
.readOnly=false;
 {rdelim}
{rdelim}
</script>
<?php endif; ?>
</td>
</tr>
<?php if ($this->_tpl_vars['displayParams']['showFormats']): ?>
<tr valign="middle">
<td nowrap>
<span class="dateFormat">{$USER_DATEFORMAT}</span>
</td>
<td nowrap>
<span class="dateFormat">{$TIME_FORMAT}</span>
</td>
</tr>
<?php endif; ?>
</table>
<input type="hidden" id="<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
" name="<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
" value="{$fields[<?php echo smarty_function_sugarvar(array('key' => 'name','stringFormat' => true), $this);?>
].value}">
<script type="text/javascript" src="{sugar_getjspath file='include/SugarFields/Fields/Datetimecombo/Datetimecombo.js'}"></script>
<script type="text/javascript">
var combo_<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
 = new Datetimecombo("{$fields[<?php echo smarty_function_sugarvar(array('key' => 'name','stringFormat' => true), $this);?>
].value}", "<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
", "{$TIME_FORMAT}", "<?php echo $this->_tpl_vars['tabindex']; ?>
", '<?php echo $this->_tpl_vars['displayParams']['showNoneCheckbox']; ?>
', '{$fields[<?php echo smarty_function_sugarvar(array('key' => 'name','stringFormat' => true), $this);?>
_flag].value}', true);
//Render the remaining widget fields
text = combo_<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
.html('<?php echo $this->_tpl_vars['displayParams']['updateCallback']; ?>
');
document.getElementById('<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
_time_section').innerHTML = text;

//Call eval on the update function to handle updates to calendar picker object
eval(combo_<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
.jsscript('<?php echo $this->_tpl_vars['displayParams']['updateCallback']; ?>
'));
</script>

<script type="text/javascript">
function update_<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
_available() {ldelim}
      YAHOO.util.Event.onAvailable("<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
_date", this.handleOnAvailable, this);
{rdelim}

update_<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
_available.prototype.handleOnAvailable = function(me) {ldelim}
	Calendar.setup ({ldelim}
	onClose : update_<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
,
	inputField : "<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
_date",
	ifFormat : "{$CALENDAR_FORMAT}",
	daFormat : "{$CALENDAR_FORMAT}",
	button : "<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
_trigger",
	singleClick : true,
	step : 1,
        startWeekday: {$CALENDAR_FDOW|default:'0'},
	weekNumbers:false
	{rdelim});

	//Call update for first time to round hours and minute values
	combo_<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
.update(false);
{rdelim}

var obj_<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
 = new update_<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
_available();
</script>