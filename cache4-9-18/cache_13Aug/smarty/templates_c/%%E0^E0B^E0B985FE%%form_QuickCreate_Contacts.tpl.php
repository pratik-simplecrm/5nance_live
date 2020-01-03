<?php /* Smarty version 2.6.11, created on 2018-08-07 10:39:46
         compiled from cache/modules/Contacts/form_QuickCreate_Contacts.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_include', 'cache/modules/Contacts/form_QuickCreate_Contacts.tpl', 51, false),array('function', 'counter', 'cache/modules/Contacts/form_QuickCreate_Contacts.tpl', 57, false),array('function', 'sugar_translate', 'cache/modules/Contacts/form_QuickCreate_Contacts.tpl', 63, false),array('function', 'html_options', 'cache/modules/Contacts/form_QuickCreate_Contacts.tpl', 71, false),array('function', 'sugar_getimagepath', 'cache/modules/Contacts/form_QuickCreate_Contacts.tpl', 97, false),array('modifier', 'strip_semicolon', 'cache/modules/Contacts/form_QuickCreate_Contacts.tpl', 64, false),array('modifier', 'lookup', 'cache/modules/Contacts/form_QuickCreate_Contacts.tpl', 289, false),array('modifier', 'count', 'cache/modules/Contacts/form_QuickCreate_Contacts.tpl', 369, false),)), $this); ?>


<script>
<?php echo '
$(document).ready(function(){
$("ul.clickMenu").each(function(index, node){
$(node).sugarActionMenu();
});
});
'; ?>

</script>
<div class="clear"></div>
<form action="index.php" method="POST" name="<?php echo $this->_tpl_vars['form_name']; ?>
" id="<?php echo $this->_tpl_vars['form_id']; ?>
" <?php echo $this->_tpl_vars['enctype']; ?>
>
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="dcQuickEdit">
<tr>
<td class="buttons">
<input type="hidden" name="module" value="<?php echo $this->_tpl_vars['module']; ?>
">
<?php if (isset ( $_REQUEST['isDuplicate'] ) && $_REQUEST['isDuplicate'] == 'true'): ?>
<input type="hidden" name="record" value="">
<input type="hidden" name="duplicateSave" value="true">
<input type="hidden" name="duplicateId" value="<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
">
<?php else: ?>
<input type="hidden" name="record" value="<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
">
<?php endif; ?>
<input type="hidden" name="isDuplicate" value="false">
<input type="hidden" name="action">
<input type="hidden" name="return_module" value="<?php echo $_REQUEST['return_module']; ?>
">
<input type="hidden" name="return_action" value="<?php echo $_REQUEST['return_action']; ?>
">
<input type="hidden" name="return_id" value="<?php echo $_REQUEST['return_id']; ?>
">
<input type="hidden" name="module_tab"> 
<input type="hidden" name="contact_role">
<?php if (( ! empty ( $_REQUEST['return_module'] ) || ! empty ( $_REQUEST['relate_to'] ) ) && ! ( isset ( $_REQUEST['isDuplicate'] ) && $_REQUEST['isDuplicate'] == 'true' )): ?>
<input type="hidden" name="relate_to" value="<?php if ($_REQUEST['return_relationship']):  echo $_REQUEST['return_relationship'];  elseif ($_REQUEST['relate_to'] && empty ( $_REQUEST['from_dcmenu'] )):  echo $_REQUEST['relate_to'];  elseif (empty ( $this->_tpl_vars['isDCForm'] ) && empty ( $_REQUEST['from_dcmenu'] )):  echo $_REQUEST['return_module'];  endif; ?>">
<input type="hidden" name="relate_id" value="<?php echo $_REQUEST['return_id']; ?>
">
<?php endif; ?>
<input type="hidden" name="offset" value="<?php echo $this->_tpl_vars['offset']; ?>
">
<?php $this->assign('place', '_HEADER'); ?> <!-- to be used for id for buttons with custom code in def files-->
<input type="hidden" name="opportunity_id" value="<?php echo $_REQUEST['opportunity_id']; ?>
">   
<input type="hidden" name="case_id" value="<?php echo $_REQUEST['case_id']; ?>
">   
<input type="hidden" name="bug_id" value="<?php echo $_REQUEST['bug_id']; ?>
">   
<input type="hidden" name="email_id" value="<?php echo $_REQUEST['email_id']; ?>
">   
<input type="hidden" name="inbound_email_id" value="<?php echo $_REQUEST['inbound_email_id']; ?>
">   
<?php if (! empty ( $_REQUEST['contact_id'] )): ?><input type="hidden" name="reports_to_id" value="<?php echo $_REQUEST['contact_id']; ?>
"><?php endif; ?>   
<?php if (! empty ( $_REQUEST['contact_name'] )): ?><input type="hidden" name="report_to_name" value="<?php echo $_REQUEST['contact_name']; ?>
"><?php endif; ?>   
<div class="action_buttons"><?php if ($this->_tpl_vars['bean']->aclAccess('save')): ?><input title="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_KEY']; ?>
" class="button primary" onclick="var _form = document.getElementById('form_QuickCreate_Contacts'); _form.action.value='Popup';return check_form('form_QuickCreate_Contacts')" type="submit" name="Contacts_popupcreate_save_button" id="Contacts_popupcreate_save_button" value="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_LABEL']; ?>
"><?php endif; ?>  <input title="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_KEY']; ?>
" class="button" onclick="toggleDisplay('addform');return false;" name="Contacts_popup_cancel_button" type="submit"id="Contacts_popup_cancel_button" value="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
">  <?php if ($this->_tpl_vars['bean']->aclAccess('detail')):  if (! empty ( $this->_tpl_vars['fields']['id']['value'] ) && $this->_tpl_vars['isAuditEnabled']): ?><input id="btn_view_change_log" title="<?php echo $this->_tpl_vars['APP']['LNK_VIEW_CHANGE_LOG']; ?>
" class="button" onclick='open_popup("Audit", "600", "400", "&record=<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
&module_name=Contacts", true, false,  { "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] } ); return false;' type="button" value="<?php echo $this->_tpl_vars['APP']['LNK_VIEW_CHANGE_LOG']; ?>
"><?php endif;  endif; ?><div class="clear"></div></div>
</td>
<td align='right'>
<?php echo $this->_tpl_vars['PAGINATION']; ?>

</td>
</tr>
</table><?php echo smarty_function_sugar_include(array('include' => $this->_tpl_vars['includes']), $this);?>

<span id='tabcounterJS'><script>SUGAR.TabFields=new Array();//this will be used to track tabindexes for references</script></span>
<div id="form_QuickCreate_Contacts_tabs"
>
<div >
<div id="detailpanel_1" >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount','start' => 0,'print' => false,'assign' => 'panelFieldCount'), $this);?>

<table width="100%" border="0" cellspacing="1" cellpadding="0"  id='Default_<?php echo $this->_tpl_vars['module']; ?>
_Subpanel'  class="yui3-skin-sam edit view panelContainer">
<?php echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php ob_start(); ?>
<tr>
<td valign="top" id='first_name_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FIRST_NAME','module' => 'Contacts'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<span class="required">*</span>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<?php echo smarty_function_html_options(array('name' => 'salutation','id' => 'salutation','options' => $this->_tpl_vars['fields']['salutation']['options'],'selected' => $this->_tpl_vars['fields']['salutation']['value']), $this);?>
&nbsp;<input accesskey="7"  tabindex="0"  name="first_name" id="first_name" size="25" maxlength="25" type="text" value="<?php echo $this->_tpl_vars['fields']['first_name']['value']; ?>
">
<td valign="top" id='account_name_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ACCOUNT_NAME','module' => 'Contacts'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<input type="text" name="<?php echo $this->_tpl_vars['fields']['account_name']['name']; ?>
" class="sqsEnabled" tabindex="0" id="<?php echo $this->_tpl_vars['fields']['account_name']['name']; ?>
" size="" value="<?php echo $this->_tpl_vars['fields']['account_name']['value']; ?>
" title='' autocomplete="off"  	 >
<input type="hidden" name="<?php echo $this->_tpl_vars['fields']['account_name']['id_name']; ?>
" 
id="<?php echo $this->_tpl_vars['fields']['account_name']['id_name']; ?>
" 
value="<?php echo $this->_tpl_vars['fields']['account_id']['value']; ?>
">
<span class="id-ff multiple">
<button type="button" name="btn_<?php echo $this->_tpl_vars['fields']['account_name']['name']; ?>
" id="btn_<?php echo $this->_tpl_vars['fields']['account_name']['name']; ?>
" tabindex="0" title="<?php echo smarty_function_sugar_translate(array('label' => 'LBL_ACCESSKEY_SELECT_ACCOUNTS_TITLE'), $this);?>
" class="button firstChild" value="<?php echo smarty_function_sugar_translate(array('label' => 'LBL_ACCESSKEY_SELECT_ACCOUNTS_LABEL'), $this);?>
"
onclick='open_popup(
"<?php echo $this->_tpl_vars['fields']['account_name']['module']; ?>
", 
600, 
400, 
"", 
true, 
false, 
<?php echo '{"call_back_function":"set_return","form_name":"form_QuickCreate_Contacts","field_to_name_array":{"id":"account_id","name":"account_name"}}'; ?>
, 
"single", 
true
);' ><img src="<?php echo smarty_function_sugar_getimagepath(array('file' => "id-ff-select.png"), $this);?>
"></button><button type="button" name="btn_clr_<?php echo $this->_tpl_vars['fields']['account_name']['name']; ?>
" id="btn_clr_<?php echo $this->_tpl_vars['fields']['account_name']['name']; ?>
" tabindex="0" title="<?php echo smarty_function_sugar_translate(array('label' => 'LBL_ACCESSKEY_CLEAR_ACCOUNTS_TITLE'), $this);?>
"  class="button lastChild"
onclick="SUGAR.clearRelateField(this.form, '<?php echo $this->_tpl_vars['fields']['account_name']['name']; ?>
', '<?php echo $this->_tpl_vars['fields']['account_name']['id_name']; ?>
');"  value="<?php echo smarty_function_sugar_translate(array('label' => 'LBL_ACCESSKEY_CLEAR_ACCOUNTS_LABEL'), $this);?>
" ><img src="<?php echo smarty_function_sugar_getimagepath(array('file' => "id-ff-clear.png"), $this);?>
"></button>
</span>
<script type="text/javascript">
SUGAR.util.doWhen(
		"typeof(sqs_objects) != 'undefined' && typeof(sqs_objects['<?php echo $this->_tpl_vars['form_name']; ?>
_<?php echo $this->_tpl_vars['fields']['account_name']['name']; ?>
']) != 'undefined'",
		enableQS
);
</script>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php ob_start(); ?>
<tr>
<td valign="top" id='last_name_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_LAST_NAME','module' => 'Contacts'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<span class="required">*</span>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['last_name']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['last_name']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['last_name']['value']);  endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['last_name']['name']; ?>
' 
id='<?php echo $this->_tpl_vars['fields']['last_name']['name']; ?>
' size='30' 
maxlength='100' 
value='<?php echo $this->_tpl_vars['value']; ?>
' title=''      >
<td valign="top" id='phone_work_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_OFFICE_PHONE','module' => 'Contacts'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['phone_work']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['phone_work']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['phone_work']['value']);  endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['phone_work']['name']; ?>
' id='<?php echo $this->_tpl_vars['fields']['phone_work']['name']; ?>
' size='30' maxlength='100' value='<?php echo $this->_tpl_vars['value']; ?>
' title='' tabindex='0'	  class="phone" >
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php ob_start(); ?>
<tr>
<td valign="top" id='title_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_TITLE','module' => 'Contacts'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['title']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['title']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['title']['value']);  endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['title']['name']; ?>
' 
id='<?php echo $this->_tpl_vars['fields']['title']['name']; ?>
' size='30' 
maxlength='100' 
value='<?php echo $this->_tpl_vars['value']; ?>
' title=''      >
<td valign="top" id='phone_mobile_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_MOBILE_PHONE','module' => 'Contacts'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
<span class="required">*</span>
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['phone_mobile']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['phone_mobile']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['phone_mobile']['value']);  endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['phone_mobile']['name']; ?>
' id='<?php echo $this->_tpl_vars['fields']['phone_mobile']['name']; ?>
' size='30' maxlength='100' value='<?php echo $this->_tpl_vars['value']; ?>
' title='' tabindex='0'	  class="phone" >
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php ob_start(); ?>
<tr>
<td valign="top" id='phone_fax_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_FAX_PHONE','module' => 'Contacts'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strlen ( $this->_tpl_vars['fields']['phone_fax']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['phone_fax']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['phone_fax']['value']);  endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['phone_fax']['name']; ?>
' id='<?php echo $this->_tpl_vars['fields']['phone_fax']['name']; ?>
' size='30' maxlength='100' value='<?php echo $this->_tpl_vars['value']; ?>
' title='' tabindex='0'	  class="phone" >
<td valign="top" id='do_not_call_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_DO_NOT_CALL','module' => 'Contacts'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (strval ( $this->_tpl_vars['fields']['do_not_call']['value'] ) == '1' || strval ( $this->_tpl_vars['fields']['do_not_call']['value'] ) == 'yes' || strval ( $this->_tpl_vars['fields']['do_not_call']['value'] ) == 'on'): ?> 
<?php $this->assign('checked', 'CHECKED');  else:  $this->assign('checked', "");  endif; ?>
<input type="hidden" name="<?php echo $this->_tpl_vars['fields']['do_not_call']['name']; ?>
" value="0"> 
<input type="checkbox" id="<?php echo $this->_tpl_vars['fields']['do_not_call']['name']; ?>
" 
name="<?php echo $this->_tpl_vars['fields']['do_not_call']['name']; ?>
" 
value="1" title='' tabindex="0" <?php echo $this->_tpl_vars['checked']; ?>
 >
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php ob_start(); ?>
<tr>
<td valign="top" id='email1_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_EMAIL_ADDRESS','module' => 'Contacts'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>

<span id='email1_span'>
<?php echo $this->_tpl_vars['fields']['email1']['value']; ?>
</span>
<td valign="top" id='lead_source_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_LEAD_SOURCE','module' => 'Contacts'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' >
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<?php if (! isset ( $this->_tpl_vars['config']['enable_autocomplete'] ) || $this->_tpl_vars['config']['enable_autocomplete'] == false): ?>
<select name="<?php echo $this->_tpl_vars['fields']['lead_source']['name']; ?>
" 
id="<?php echo $this->_tpl_vars['fields']['lead_source']['name']; ?>
" 
title=''       
>
<?php if (isset ( $this->_tpl_vars['fields']['lead_source']['value'] ) && $this->_tpl_vars['fields']['lead_source']['value'] != ''):  echo smarty_function_html_options(array('options' => $this->_tpl_vars['fields']['lead_source']['options'],'selected' => $this->_tpl_vars['fields']['lead_source']['value']), $this);?>

<?php else:  echo smarty_function_html_options(array('options' => $this->_tpl_vars['fields']['lead_source']['options'],'selected' => $this->_tpl_vars['fields']['lead_source']['default']), $this);?>

<?php endif; ?>
</select>
<?php else:  $this->assign('field_options', $this->_tpl_vars['fields']['lead_source']['options']);  ob_start();  echo $this->_tpl_vars['fields']['lead_source']['value'];  $this->_smarty_vars['capture']['field_val'] = ob_get_contents(); ob_end_clean();  $this->assign('field_val', $this->_smarty_vars['capture']['field_val']);  ob_start();  echo $this->_tpl_vars['fields']['lead_source']['name'];  $this->_smarty_vars['capture']['ac_key'] = ob_get_contents(); ob_end_clean();  $this->assign('ac_key', $this->_smarty_vars['capture']['ac_key']); ?>
<select style='display:none' name="<?php echo $this->_tpl_vars['fields']['lead_source']['name']; ?>
" 
id="<?php echo $this->_tpl_vars['fields']['lead_source']['name']; ?>
" 
title=''          
>
<?php if (isset ( $this->_tpl_vars['fields']['lead_source']['value'] ) && $this->_tpl_vars['fields']['lead_source']['value'] != ''):  echo smarty_function_html_options(array('options' => $this->_tpl_vars['fields']['lead_source']['options'],'selected' => $this->_tpl_vars['fields']['lead_source']['value']), $this);?>

<?php else:  echo smarty_function_html_options(array('options' => $this->_tpl_vars['fields']['lead_source']['options'],'selected' => $this->_tpl_vars['fields']['lead_source']['default']), $this);?>

<?php endif; ?>
</select>
<input
id="<?php echo $this->_tpl_vars['fields']['lead_source']['name']; ?>
-input"
name="<?php echo $this->_tpl_vars['fields']['lead_source']['name']; ?>
-input"
size="30"
value="<?php echo ((is_array($_tmp=$this->_tpl_vars['field_val'])) ? $this->_run_mod_handler('lookup', true, $_tmp, $this->_tpl_vars['field_options']) : smarty_modifier_lookup($_tmp, $this->_tpl_vars['field_options'])); ?>
"
type="text" style="vertical-align: top;">
<span class="id-ff multiple">
<button type="button"><img src="<?php echo smarty_function_sugar_getimagepath(array('file' => "id-ff-down.png"), $this);?>
" id="<?php echo $this->_tpl_vars['fields']['lead_source']['name']; ?>
-image"></button><button type="button"
id="btn-clear-<?php echo $this->_tpl_vars['fields']['lead_source']['name']; ?>
-input"
title="Clear"
onclick="SUGAR.clearRelateField(this.form, '<?php echo $this->_tpl_vars['fields']['lead_source']['name']; ?>
-input', '<?php echo $this->_tpl_vars['fields']['lead_source']['name']; ?>
');sync_<?php echo $this->_tpl_vars['fields']['lead_source']['name']; ?>
()"><img src="<?php echo smarty_function_sugar_getimagepath(array('file' => "id-ff-clear.png"), $this);?>
"></button>
</span>
<?php echo '
<script>
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo ' = [];
'; ?>

<?php echo '
(function (){
var selectElem = document.getElementById("';  echo $this->_tpl_vars['fields']['lead_source']['name'];  echo '");
if (typeof select_defaults =="undefined")
select_defaults = [];
select_defaults[selectElem.id] = {key:selectElem.value,text:\'\'};
//get default
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value)
select_defaults[selectElem.id].text = selectElem.options[i].innerHTML;
}
//SUGAR.AutoComplete.{$ac_key}.ds = 
//get options array from vardefs
var options = SUGAR.AutoComplete.getOptionsArray("");
YUI().use(\'datasource\', \'datasource-jsonschema\',function (Y) {
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.ds = new Y.DataSource.Function({
source: function (request) {
var ret = [];
for (i=0;i<selectElem.options.length;i++)
if (!(selectElem.options[i].value==\'\' && selectElem.options[i].innerHTML==\'\'))
ret.push({\'key\':selectElem.options[i].value,\'text\':selectElem.options[i].innerHTML});
return ret;
}
});
});
})();
'; ?>

<?php echo '
YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters", "node","node-event-simulate", function (Y) {
'; ?>

SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.inputNode = Y.one('#<?php echo $this->_tpl_vars['fields']['lead_source']['name']; ?>
-input');
SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.inputImage = Y.one('#<?php echo $this->_tpl_vars['fields']['lead_source']['name']; ?>
-image');
SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.inputHidden = Y.one('#<?php echo $this->_tpl_vars['fields']['lead_source']['name']; ?>
');
<?php echo '
function SyncToHidden(selectme){
var selectElem = document.getElementById("';  echo $this->_tpl_vars['fields']['lead_source']['name'];  echo '");
var doSimulateChange = false;
if (selectElem.value!=selectme)
doSimulateChange=true;
selectElem.value=selectme;
for (i=0;i<selectElem.options.length;i++){
selectElem.options[i].selected=false;
if (selectElem.options[i].value==selectme)
selectElem.options[i].selected=true;
}
if (doSimulateChange)
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputHidden.simulate(\'change\');
}
//global variable 
sync_';  echo $this->_tpl_vars['fields']['lead_source']['name'];  echo ' = function(){
SyncToHidden();
}
function syncFromHiddenToWidget(){
var selectElem = document.getElementById("';  echo $this->_tpl_vars['fields']['lead_source']['name'];  echo '");
//if select no longer on page, kill timer
if (selectElem==null || selectElem.options == null)
return;
var currentvalue = SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.get(\'value\');
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.simulate(\'keyup\');
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value && document.activeElement != document.getElementById(\'';  echo $this->_tpl_vars['fields']['lead_source']['name']; ?>
-input<?php echo '\'))
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.set(\'value\',selectElem.options[i].innerHTML);
}
}
YAHOO.util.Event.onAvailable("';  echo $this->_tpl_vars['fields']['lead_source']['name'];  echo '", syncFromHiddenToWidget);
'; ?>

SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.minQLen = 0;
SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.queryDelay = 0;
SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.numOptions = <?php echo count($this->_tpl_vars['field_options']); ?>
;
if(SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.numOptions >= 300) <?php echo '{
'; ?>

SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.minQLen = 1;
SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.queryDelay = 200;
<?php echo '
}
'; ?>

if(SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.numOptions >= 3000) <?php echo '{
'; ?>

SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.minQLen = 1;
SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.queryDelay = 500;
<?php echo '
}
'; ?>

SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.optionsVisible = false;
<?php echo '
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.plug(Y.Plugin.AutoComplete, {
activateFirstItem: true,
'; ?>

minQueryLength: SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.minQLen,
queryDelay: SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.queryDelay,
zIndex: 99999,
<?php echo '
source: SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.ds,
resultTextLocator: \'text\',
resultHighlighter: \'phraseMatch\',
resultFilters: \'phraseMatch\',
});
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.expandHover = function(ex){
var hover = YAHOO.util.Dom.getElementsByClassName(\'dccontent\');
if(hover[0] != null){
if (ex) {
var h = \'1000px\';
hover[0].style.height = h;
}
else{
hover[0].style.height = \'\';
}
}
}
if('; ?>
SUGAR.AutoComplete.<?php echo $this->_tpl_vars['ac_key']; ?>
.minQLen<?php echo ' == 0){
// expand the dropdown options upon focus
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.on(\'focus\', function () {
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.ac.sendRequest(\'\');
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.optionsVisible = true;
});
}
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.on(\'click\', function(e) {
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputHidden.simulate(\'click\');
});
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.on(\'dblclick\', function(e) {
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputHidden.simulate(\'dblclick\');
});
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.on(\'focus\', function(e) {
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputHidden.simulate(\'focus\');
});
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.on(\'mouseup\', function(e) {
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputHidden.simulate(\'mouseup\');
});
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.on(\'mousedown\', function(e) {
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputHidden.simulate(\'mousedown\');
});
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.on(\'blur\', function(e) {
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputHidden.simulate(\'blur\');
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.optionsVisible = false;
var selectElem = document.getElementById("';  echo $this->_tpl_vars['fields']['lead_source']['name'];  echo '");
//if typed value is a valid option, do nothing
for (i=0;i<selectElem.options.length;i++)
if (selectElem.options[i].innerHTML==SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.get(\'value\'))
return;
//typed value is invalid, so set the text and the hidden to blank
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.set(\'value\', select_defaults[selectElem.id].text);
SyncToHidden(select_defaults[selectElem.id].key);
});
// when they click on the arrow image, toggle the visibility of the options
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputImage.ancestor().on(\'click\', function () {
if (SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.optionsVisible) {
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.blur();
} else {
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.focus();
}
});
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.ac.on(\'query\', function () {
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputHidden.set(\'value\', \'\');
});
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.ac.on(\'visibleChange\', function (e) {
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.expandHover(e.newVal); // expand
});
// when they select an option, set the hidden input with the KEY, to be saved
SUGAR.AutoComplete.';  echo $this->_tpl_vars['ac_key'];  echo '.inputNode.ac.on(\'select\', function(e) {
SyncToHidden(e.result.raw.key);
});
});
</script> 
'; ?>

<?php endif; ?>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif;  echo smarty_function_counter(array('name' => 'fieldsUsed','start' => 0,'print' => false,'assign' => 'fieldsUsed'), $this);?>

<?php ob_start(); ?>
<tr>
<td valign="top" id='assigned_user_name_label' width='12.5%' scope="col">
<?php ob_start();  echo smarty_function_sugar_translate(array('label' => 'LBL_ASSIGNED_TO','module' => 'Contacts'), $this); $this->_smarty_vars['capture']['label'] = ob_get_contents();  $this->assign('label', ob_get_contents());ob_end_clean();  echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('strip_semicolon', true, $_tmp) : smarty_modifier_strip_semicolon($_tmp)); ?>
:
</td>
<?php echo smarty_function_counter(array('name' => 'fieldsUsed'), $this);?>


<td valign="top" width='37.5%' colspan='3'>
<?php echo smarty_function_counter(array('name' => 'panelFieldCount'), $this);?>


<input type="text" name="<?php echo $this->_tpl_vars['fields']['assigned_user_name']['name']; ?>
" class="sqsEnabled" tabindex="0" id="<?php echo $this->_tpl_vars['fields']['assigned_user_name']['name']; ?>
" size="" value="<?php echo $this->_tpl_vars['fields']['assigned_user_name']['value']; ?>
" title='' autocomplete="off"  	 >
<input type="hidden" name="<?php echo $this->_tpl_vars['fields']['assigned_user_name']['id_name']; ?>
" 
id="<?php echo $this->_tpl_vars['fields']['assigned_user_name']['id_name']; ?>
" 
value="<?php echo $this->_tpl_vars['fields']['assigned_user_id']['value']; ?>
">
<span class="id-ff multiple">
<button type="button" name="btn_<?php echo $this->_tpl_vars['fields']['assigned_user_name']['name']; ?>
" id="btn_<?php echo $this->_tpl_vars['fields']['assigned_user_name']['name']; ?>
" tabindex="0" title="<?php echo smarty_function_sugar_translate(array('label' => 'LBL_ACCESSKEY_SELECT_USERS_TITLE'), $this);?>
" class="button firstChild" value="<?php echo smarty_function_sugar_translate(array('label' => 'LBL_ACCESSKEY_SELECT_USERS_LABEL'), $this);?>
"
onclick='open_popup(
"<?php echo $this->_tpl_vars['fields']['assigned_user_name']['module']; ?>
", 
600, 
400, 
"", 
true, 
false, 
<?php echo '{"call_back_function":"set_return","form_name":"form_QuickCreate_Contacts","field_to_name_array":{"id":"assigned_user_id","user_name":"assigned_user_name"}}'; ?>
, 
"single", 
true
);' ><img src="<?php echo smarty_function_sugar_getimagepath(array('file' => "id-ff-select.png"), $this);?>
"></button><button type="button" name="btn_clr_<?php echo $this->_tpl_vars['fields']['assigned_user_name']['name']; ?>
" id="btn_clr_<?php echo $this->_tpl_vars['fields']['assigned_user_name']['name']; ?>
" tabindex="0" title="<?php echo smarty_function_sugar_translate(array('label' => 'LBL_ACCESSKEY_CLEAR_USERS_TITLE'), $this);?>
"  class="button lastChild"
onclick="SUGAR.clearRelateField(this.form, '<?php echo $this->_tpl_vars['fields']['assigned_user_name']['name']; ?>
', '<?php echo $this->_tpl_vars['fields']['assigned_user_name']['id_name']; ?>
');"  value="<?php echo smarty_function_sugar_translate(array('label' => 'LBL_ACCESSKEY_CLEAR_USERS_LABEL'), $this);?>
" ><img src="<?php echo smarty_function_sugar_getimagepath(array('file' => "id-ff-clear.png"), $this);?>
"></button>
</span>
<script type="text/javascript">
SUGAR.util.doWhen(
		"typeof(sqs_objects) != 'undefined' && typeof(sqs_objects['<?php echo $this->_tpl_vars['form_name']; ?>
_<?php echo $this->_tpl_vars['fields']['assigned_user_name']['name']; ?>
']) != 'undefined'",
		enableQS
);
</script>
</tr>
<?php $this->_smarty_vars['capture']['tr'] = ob_get_contents();  $this->assign('tableRow', ob_get_contents());ob_end_clean();  if ($this->_tpl_vars['fieldsUsed'] > 0):  echo $this->_tpl_vars['tableRow']; ?>

<?php endif; ?>
</table>
</div>
<?php if ($this->_tpl_vars['panelFieldCount'] == 0): ?>
<script>document.getElementById("DEFAULT").style.display='none';</script>
<?php endif; ?>
</div></div>

<script language="javascript">
    var _form_id = '<?php echo $this->_tpl_vars['form_id']; ?>
';
    <?php echo '
    SUGAR.util.doWhen(function(){
        _form_id = (_form_id == \'\') ? \'EditView\' : _form_id;
        return document.getElementById(_form_id) != null;
    }, SUGAR.themes.actionMenu);
    '; ?>

</script>
<?php $this->assign('place', '_FOOTER'); ?> <!-- to be used for id for buttons with custom code in def files-->
<div class="buttons">
<div class="action_buttons"><?php if ($this->_tpl_vars['bean']->aclAccess('save')): ?><input title="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_KEY']; ?>
" class="button primary" onclick="var _form = document.getElementById('form_QuickCreate_Contacts'); _form.action.value='Popup';return check_form('form_QuickCreate_Contacts')" type="submit" name="Contacts_popupcreate_save_button" id="Contacts_popupcreate_save_button" value="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_LABEL']; ?>
"><?php endif; ?>  <input title="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_KEY']; ?>
" class="button" onclick="toggleDisplay('addform');return false;" name="Contacts_popup_cancel_button" type="submit"id="Contacts_popup_cancel_button" value="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
">  <?php if ($this->_tpl_vars['bean']->aclAccess('detail')):  if (! empty ( $this->_tpl_vars['fields']['id']['value'] ) && $this->_tpl_vars['isAuditEnabled']): ?><input id="btn_view_change_log" title="<?php echo $this->_tpl_vars['APP']['LNK_VIEW_CHANGE_LOG']; ?>
" class="button" onclick='open_popup("Audit", "600", "400", "&record=<?php echo $this->_tpl_vars['fields']['id']['value']; ?>
&module_name=Contacts", true, false,  { "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] } ); return false;' type="button" value="<?php echo $this->_tpl_vars['APP']['LNK_VIEW_CHANGE_LOG']; ?>
"><?php endif;  endif; ?><div class="clear"></div></div>
</div>
</form>
<?php echo $this->_tpl_vars['set_focus_block']; ?>

<script>SUGAR.util.doWhen("document.getElementById('EditView') != null",
function(){SUGAR.util.buildAccessKeyLabels();});
</script><script type="text/javascript">
YAHOO.util.Event.onContentReady("form_QuickCreate_Contacts",
    function () { initEditView(document.forms.form_QuickCreate_Contacts) });
//window.setTimeout(, 100);
window.onbeforeunload = function () { return onUnloadEditView(); };
// bug 55468 -- IE is too aggressive with onUnload event
if ($.browser.msie) {
$(document).ready(function() {
    $(".collapseLink,.expandLink").click(function (e) { e.preventDefault(); });
  });
}
</script><?php echo '
<script type="text/javascript">
addForm(\'form_QuickCreate_Contacts\');addToValidate(\'form_QuickCreate_Contacts\', \'name\', \'name\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_NAME','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'date_entered_date\', \'date\', false,\'User Creation Date\' );
addToValidate(\'form_QuickCreate_Contacts\', \'date_modified_date\', \'date\', false,\'Date Modified\' );
addToValidate(\'form_QuickCreate_Contacts\', \'modified_user_id\', \'assigned_user_name\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_MODIFIED','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'modified_by_name\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_MODIFIED_NAME','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'created_by\', \'assigned_user_name\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CREATED','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'created_by_name\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CREATED','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'description\', \'text\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_DESCRIPTION','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'deleted\', \'bool\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_DELETED','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'assigned_user_id\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ASSIGNED_TO_ID','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'assigned_user_name\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ASSIGNED_TO_NAME','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'salutation\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_SALUTATION','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'first_name\', \'varchar\', true,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_FIRST_NAME','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'last_name\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_LAST_NAME','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'full_name\', \'fullname\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_NAME','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'title\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TITLE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'photo\', \'image\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PHOTO','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'department\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_DEPARTMENT','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'do_not_call\', \'bool\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_DO_NOT_CALL','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'phone_home\', \'phone\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_HOME_PHONE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'email\', \'email\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ANY_EMAIL','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'phone_mobile\', \'phone\', true,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_MOBILE_PHONE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'phone_work\', \'phone\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_OFFICE_PHONE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'phone_other\', \'phone\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_OTHER_PHONE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'phone_fax\', \'phone\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_FAX_PHONE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'email1\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EMAIL_ADDRESS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'email2\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_OTHER_EMAIL_ADDRESS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'invalid_email\', \'bool\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_INVALID_EMAIL','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'email_opt_out\', \'bool\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EMAIL_OPT_OUT','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'primary_address_street\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PRIMARY_ADDRESS_STREET','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'primary_address_street_2\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PRIMARY_ADDRESS_STREET_2','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'primary_address_street_3\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PRIMARY_ADDRESS_STREET_3','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'primary_address_city\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PRIMARY_ADDRESS_CITY','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'primary_address_state\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PRIMARY_ADDRESS_STATE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'primary_address_postalcode\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PRIMARY_ADDRESS_POSTALCODE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'primary_address_country\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PRIMARY_ADDRESS_COUNTRY','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'alt_address_street\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ALT_ADDRESS_STREET','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'alt_address_street_2\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ALT_ADDRESS_STREET_2','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'alt_address_street_3\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ALT_ADDRESS_STREET_3','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'alt_address_city\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ALT_ADDRESS_CITY','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'alt_address_state\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ALT_ADDRESS_STATE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'alt_address_postalcode\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ALT_ADDRESS_POSTALCODE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'alt_address_country\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ALT_ADDRESS_COUNTRY','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'assistant\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ASSISTANT','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'assistant_phone\', \'phone\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ASSISTANT_PHONE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'email_addresses_non_primary\', \'email\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EMAIL_NON_PRIMARY','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'email_and_name1\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_NAME','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'lead_source\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_LEAD_SOURCE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'account_name\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ACCOUNT_NAME','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'account_id\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ACCOUNT_ID','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'opportunity_role_fields\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ACCOUNT_NAME','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'opportunity_role_id\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_OPPORTUNITY_ROLE_ID','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'opportunity_role\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_OPPORTUNITY_ROLE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'reports_to_id\', \'id\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_REPORTS_TO_ID','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'report_to_name\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_REPORTS_TO','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'birthdate\', \'date\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_BIRTHDATE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'campaign_id\', \'id\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CAMPAIGN_ID','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'campaign_name\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CAMPAIGN','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'c_accept_status_fields\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_LIST_ACCEPT_STATUS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'m_accept_status_fields\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_LIST_ACCEPT_STATUS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'accept_status_id\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_LIST_ACCEPT_STATUS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'accept_status_name\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_LIST_ACCEPT_STATUS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'sync_contact\', \'bool\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_SYNC_CONTACT','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'e_invite_status_fields\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CONT_INVITE_STATUS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'event_status_name\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_LIST_INVITE_STATUS_EVENT','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'event_invite_id\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_LIST_INVITE_STATUS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'e_accept_status_fields\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CONT_ACCEPT_STATUS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'event_accept_status\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_LIST_ACCEPT_STATUS_EVENT','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'event_status_id\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_LIST_ACCEPT_STATUS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'joomla_account_id\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_JOOMLA_ACCOUNT_ID','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'portal_account_disabled\', \'bool\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PORTAL_ACCOUNT_DISABLED','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'joomla_account_access\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_JOOMLA_ACCOUNT_ACCESS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'portal_user_type\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PORTAL_USER_TYPE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'investment_in_80d_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_INVESTMENT_IN_80D','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'type_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TYPE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'location_through_ip_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_LOCATION_THROUGH_IP','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'age_c\', \'int\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_AGE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'structure_of_family_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_STRUCTURE_OF_FAMILY','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'twitter_handle_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TWITTER_HANDLE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'payment_type_c\', \'dynamicenum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PAYMENT_TYPE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'exisitng_mi_premium_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EXISITNG_MI_PREMIUM','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'user_allocation_date_c_date\', \'date\', false,\'User Allocation Date\' );
addToValidate(\'form_QuickCreate_Contacts\', \'existing_hi_premium_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EXISTING_HI_PREMIUM','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'post_from_id_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_POST_FROM_ID','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'state_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_STATE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'online_activity_status_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ONLINE_ACTIVITY_STATUS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'opportunity_horizon_c\', \'date\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_OPPORTUNITY_HORIZON','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'existing_investment_silver_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EXISTING_INVESTMENT_SILVER','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'jjwg_maps_geocode_status_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_JJWG_MAPS_GEOCODE_STATUS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'unique_customer_code_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_UNIQUE_CUSTOMER_CODE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'facebook_id_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_FACEBOOK_ID','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'exisiting_term_insurance_pre_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EXISITING_TERM_INSURANCE_PRE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'financial_goals_c[]\', \'multienum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_FINANCIAL_GOALS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'campaign_sub_type_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CAMPAIGN_SUB_TYPE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'risk_profiling_questions_c\', \'text\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_RISK_PROFILING_QUESTIONS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'category_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CATEGORY','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'monthly_expense_details_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_MONTHLY_EXPENSE_DETAILS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'activate_disposition_c\', \'bool\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ACTIVATE_DISPOSITION','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'existing_investments_deposit_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EXISTING_INVESTMENTS_DEPOSIT','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'next_call_planning_date_c_date\', \'date\', false,\'Next Call Planning Date\' );
addToValidate(\'form_QuickCreate_Contacts\', \'investment_in_80c_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_INVESTMENT_IN_80C','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'existing_investments_bonds_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EXISTING_INVESTMENTS_BONDS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'next_call_planning_comments_c\', \'text\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_NEXT_CALL_PLANNING_COMMENTS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'middle_name_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_MIDDLE_NAME','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'exisiting_term_insurance_sum_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EXISITING_TERM_INSURANCE_SUM','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'historical_session_data_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_HISTORICAL_SESSION_DATA','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'publisher_id_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PUBLISHER_ID','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'product_interest_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PRODUCT_INTEREST','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'investment_behaviour_segment_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_INVESTMENT_BEHAVIOUR_SEGMENT','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'no_of_children_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_NO_OF_CHILDREN','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'annual_expenses_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ANNUAL_EXPENSES','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'expenses_details_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EXPENSES_DETAILS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'existing_mi_sum_insured_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EXISTING_MI_SUM_INSURED','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'portal_active_user_c\', \'bool\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PORTAL_ACTIVE_USER','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'currency_id\', \'currency_id\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CURRENCY','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'jjwg_maps_address_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_JJWG_MAPS_ADDRESS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'existing_hi_sum_insured_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EXISTING_HI_SUM_INSURED','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'existing_investment_gold_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EXISTING_INVESTMENT_GOLD','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'is_mobile_number_verified_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_IS_MOBILE_NUMBER_VERIFIED','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'existing_insurance_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EXISTING_INSURANCE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'gender_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_GENDER','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'occupational_details_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_OCCUPATIONAL_DETAILS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'posted_message_id_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_POSTED_MESSAGE_ID','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'user_type_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_USER_TYPE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'postalcode_c\', \'dynamicenum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_POSTALCODE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'related_kiosk_account_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_RELATED_KIOSK_ACCOUNT','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'dnc_status_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_DNC_STATUS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'prior_invesment_value_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PRIOR_INVESMENT_VALUE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'tax_planning_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TAX_PLANNING','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'twitter_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TWITTER','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'partner_status_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PARTNER_STATUS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'opportunity_value_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_OPPORTUNITY_VALUE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'campaign_type_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CAMPAIGN_TYPE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'current_company_details_c\', \'text\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CURRENT_COMPANY_DETAILS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'country_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_COUNTRY','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'password_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PASSWORD','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'user_name_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_USER_NAME','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'gateway_c\', \'enum\', true,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_GATEWAY','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'no_of_adults_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_NO_OF_ADULTS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'educational_details_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EDUCATIONAL_DETAILS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'india_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_INDIA','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'jjwg_maps_lng_c\', \'float\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_JJWG_MAPS_LNG','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'adoption_percentage_c\', \'decimal\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ADOPTION_PERCENTAGE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'family_members_number_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_FAMILY_MEMBERS_NUMBER','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'life_stage_profiling_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_LIFE_STAGE_PROFILING','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'address_c\', \'text\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ADDRESS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'loan_type_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_LOAN_TYPE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'annual_income_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ANNUAL_INCOME','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'related_corporate_account_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_RELATED_CORPORATE_ACCOUNT','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'product_sub_type_interest_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PRODUCT_SUB_TYPE_INTEREST','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'sales_stage_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_SALES_STAGE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'tweet_id_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TWEET_ID','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'best_time_to_speak_to_c_date\', \'date\', false,\'Best time to speak to\' );
addToValidate(\'form_QuickCreate_Contacts\', \'comments_c\', \'text\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_COMMENTS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'city_c\', \'dynamicenum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CITY','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'first_transaction_date_c\', \'date\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_FIRST_TRANSACTION_DATE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'jjwg_maps_lat_c\', \'float\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_JJWG_MAPS_LAT','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'sales_person_tagging_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_SALES_PERSON_TAGGING','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'existing_investment_re_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EXISTING_INVESTMENT_RE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'publisher_name_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PUBLISHER_NAME','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'courier_request_c\', \'date\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_COURIER_REQUEST','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'saving_potential_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_SAVING_POTENTIAL','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'classification_accoun_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CLASSIFICATION_ACCOUN','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'is_email_verified_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_IS_EMAIL_VERIFIED','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'total_employment_years_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TOTAL_EMPLOYMENT_YEARS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'exisiting_investments_c[]\', \'multienum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EXISITING_INVESTMENTS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'disposition_c\', \'enum\', true,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_DISPOSITION','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'monthly_income_details_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_MONTHLY_INCOME_DETAILS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'agreed_to_assign_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_AGREED_TO_ASSIGN','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'date_of_first_call_c_date\', \'date\', false,\'Date of First Call\' );
addToValidate(\'form_QuickCreate_Contacts\', \'date_of_second_call_c_date\', \'date\', false,\'Date of Second Call\' );
addToValidate(\'form_QuickCreate_Contacts\', \'date_of_third_call_c_date\', \'date\', false,\'Date of Third Call\' );
addToValidate(\'form_QuickCreate_Contacts\', \'date_of_validation_c_date\', \'date\', false,\'Date of Validation\' );
addToValidate(\'form_QuickCreate_Contacts\', \'final_disposition_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_FINAL_DISPOSITION','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'lead_generation_date_c_date\', \'date\', false,\'Lead Generation Date\' );
addToValidate(\'form_QuickCreate_Contacts\', \'preferred_date_of_call_c\', \'date\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PREFERRED_DATE_OF_CALL','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'preferred_time_of_call_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PREFERRED_TIME_OF_CALL','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'status_of_first_call_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_STATUS_OF_FIRST_CALL','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'status_of_second_call_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_STATUS_OF_SECOND_CALL','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'status_of_third_call_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_STATUS_OF_THIRD_CALL','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'validation_exe_assigned_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_VALIDATION_EXE_ASSIGNED','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'batch_id_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_BATCH_ID','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'age_of_the_user_c\', \'int\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_AGE_OF_THE_USER','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'allocated_time_c_date\', \'date\', false,\'Allocated Time\' );
addToValidate(\'form_QuickCreate_Contacts\', \'campaign_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CAMPAIGN','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'utm_content_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_UTM_CONTENT','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'sales_advisor_check_c\', \'bool\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_SALES_ADVISOR_CHECK','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'language_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_LANGUAGE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'application_no_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_APPLICATION_NO','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'pan_no_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PAN_NO','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'aadharcard_no_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_AADHARCARD_NO','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'isminor_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ISMINOR','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'kyc_status_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_KYC_STATUS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'investor_acct_creation_month_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_INVESTOR_ACCT_CREATION_MONTH','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'existing_investment_mf_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EXISTING_INVESTMENT_MF','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'existing_investment_equity_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EXISTING_INVESTMENT_EQUITY','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'risk_profile_id_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_RISK_PROFILE_ID','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'leadid_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_LEADID','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'dateofactivation_c_date\', \'date\', false,\'Investor account activation date\' );
addToValidate(\'form_QuickCreate_Contacts\', \'account_activation_month_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ACCOUNT_ACTIVATION_MONTH','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'date_of_registration_c_date\', \'date\', false,\'Date Of Registration\' );
addToValidate(\'form_QuickCreate_Contacts\', \'document_submission_center_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_DOCUMENT_SUBMISSION_CENTER','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'auto_activation_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_AUTO_ACTIVATION','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'investorid_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_INVESTORID','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'total_sip_orders_c\', \'int\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TOTAL_SIP_ORDERS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'summarizing_total_sip_amount_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_SUMMARIZING_TOTAL_SIP_AMOUNT','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'total_lumpsum_order_c\', \'int\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TOTAL_LUMPSUM_ORDER','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'summarizing_the_total_lumpsu_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_SUMMARIZING_THE_TOTAL_LUMPSU','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'summarizing_total_orders_c\', \'int\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_SUMMARIZING_TOTAL_ORDERS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'summarizing_total_amount_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_SUMMARIZING_TOTAL_AMOUNT','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'no_of_fd_investment_orders_c\', \'int\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_NO_OF_FD_INVESTMENT_ORDERS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'total_amount_fd_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TOTAL_AMOUNT_FD','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'cart_invoice_date_c\', \'date\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CART_INVOICE_DATE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'transactionsubtype_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TRANSACTIONSUBTYPE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'schemename_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_SCHEMENAME','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'amount_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_AMOUNT','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'invoicedate_c\', \'date\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_INVOICEDATE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'cart_scheme_name_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CART_SCHEME_NAME','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'cart_amount_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CART_AMOUNT','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'investment_period_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_INVESTMENT_PERIOD','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'investment_type_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_INVESTMENT_TYPE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'investment_amount_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_INVESTMENT_AMOUNT','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'taxyear_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TAXYEAR','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'total_gross_salary_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TOTAL_GROSS_SALARY','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'taxableincomeonhouserent_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TAXABLEINCOMEONHOUSERENT','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'totaltaxtobepaid_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TOTALTAXTOBEPAID','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'taxable_income_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TAXABLE_INCOME','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'taxable_income_equity_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TAXABLE_INCOME_EQUITY','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'taxable_income_sales_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TAXABLE_INCOME_SALES','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'exemptions_from_80c_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EXEMPTIONS_FROM_80C','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'exemptions_from_80d_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EXEMPTIONS_FROM_80D','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'exemptions_80ccg_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EXEMPTIONS_80CCG','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'exemptions_80ccd_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EXEMPTIONS_80CCD','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'exemptions_80e_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EXEMPTIONS_80E','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'exemptions_80g_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EXEMPTIONS_80G','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'hra_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_HRA','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'interest_on_housing_loan_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_INTEREST_ON_HOUSING_LOAN','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'tax_deducted_at_source_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TAX_DEDUCTED_AT_SOURCE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'professional_tax_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PROFESSIONAL_TAX','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'taxable_income_deduction_c\', \'currency\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TAXABLE_INCOME_DEDUCTION','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'tax_liability_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TAX_LIABILITY','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'tax_that_you_an_save_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TAX_THAT_YOU_AN_SAVE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'tax_to_be_paid_after_savin_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TAX_TO_BE_PAID_AFTER_SAVIN','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'uploaded_cheque_image_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_UPLOADED_CHEQUE_IMAGE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'kyc_verification_status_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_KYC_VERIFICATION_STATUS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'document_submitted_cente_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_DOCUMENT_SUBMITTED_CENTE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'cart_type_c\', \'int\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CART_TYPE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'qparam_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_QPARAM','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'is_1st_time_investor_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_IS_1ST_TIME_INVESTOR','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'source_of_income_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_SOURCE_OF_INCOME','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'campaign_city_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CAMPAIGN_CITY','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'source_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_SOURCE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'custom_date_modified_c_date\', \'date\', false,\'Date Modified\' );
addToValidate(\'form_QuickCreate_Contacts\', \'user_id_c\', \'id\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CUSTOM_MODIFIED_USER_USER_ID','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'custom_modified_user_c\', \'relate\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CUSTOM_MODIFIED_USER','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'do_not_run_logic_hook_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_DO_NOT_RUN_LOGIC_HOOK','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'to_kown_about_5nance_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_TO_KOWN_ABOUT_5NANCE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'customer_referral_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_CUSTOMER_REFERRAL','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'do_you_have_internet_banking_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_DO_YOU_HAVE_INTERNET_BANKING','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'referral_type_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_REFERRAL_TYPE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'name_of_existing_customer_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_NAME_OF_EXISTING_CUSTOMER','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'existing_mobile_number_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_EXISTING_MOBILE_NUMBER','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'bank_account_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_BANK_ACCOUNT','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'pan_card_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PAN_CARD','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'interactions_age_c\', \'int\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_INTERACTIONS_AGE','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'first_time_investor_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_FIRST_TIME_INVESTOR','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'internet_banking_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_INTERNET_BANKING','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'investor_occupation_c\', \'enum\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_INVESTOR_OCCUPATION','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'interactions_income_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_INTERACTIONS_INCOME','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'no_of_attempts_c\', \'int\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_NO_OF_ATTEMPTS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'partner_comments_c\', \'text\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_PARTNER_COMMENTS','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'assistant_id_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_ASSISTANT_ID','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidate(\'form_QuickCreate_Contacts\', \'justdial_category_c\', \'varchar\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'LBL_JUSTDIAL_CATEGORY','module' => 'Contacts','for_js' => true), $this); echo '\' );
addToValidateBinaryDependency(\'form_QuickCreate_Contacts\', \'assigned_user_name\', \'alpha\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'ERR_SQS_NO_MATCH_FIELD','module' => 'Contacts','for_js' => true), $this); echo ': ';  echo smarty_function_sugar_translate(array('label' => 'LBL_ASSIGNED_TO','module' => 'Contacts','for_js' => true), $this); echo '\', \'assigned_user_id\' );
addToValidateBinaryDependency(\'form_QuickCreate_Contacts\', \'account_name\', \'alpha\', false,\'';  echo smarty_function_sugar_translate(array('label' => 'ERR_SQS_NO_MATCH_FIELD','module' => 'Contacts','for_js' => true), $this); echo ': ';  echo smarty_function_sugar_translate(array('label' => 'LBL_ACCOUNT_NAME','module' => 'Contacts','for_js' => true), $this); echo '\', \'account_id\' );
</script><script language="javascript">if(typeof sqs_objects == \'undefined\'){var sqs_objects = new Array;}sqs_objects[\'form_QuickCreate_Contacts_account_name\']={"form":"form_QuickCreate_Contacts","method":"query","modules":["Accounts"],"group":"or","field_list":["name","id"],"populate_list":["form_QuickCreate_Contacts_account_name","account_id"],"conditions":[{"name":"name","op":"like_custom","end":"%","value":""}],"required_list":["account_id"],"order":"name","limit":"30","no_match_text":"No Match"};sqs_objects[\'form_QuickCreate_Contacts_assigned_user_name\']={"form":"form_QuickCreate_Contacts","method":"get_user_array","field_list":["user_name","id"],"populate_list":["assigned_user_name","assigned_user_id"],"required_list":["assigned_user_id"],"conditions":[{"name":"user_name","op":"like_custom","end":"%","value":""}],"limit":"30","no_match_text":"No Match"};</script>'; ?>
