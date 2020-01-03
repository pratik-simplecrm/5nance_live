

<script>
{literal}
$(document).ready(function(){
$("ul.clickMenu").each(function(index, node){
$(node).sugarActionMenu();
});
});
{/literal}
</script>
<div class="clear"></div>
<form action="index.php" method="POST" name="{$form_name}" id="{$form_id}" {$enctype}>
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="dcQuickEdit">
<tr>
<td class="buttons">
<input type="hidden" name="module" value="{$module}">
{if isset($smarty.request.isDuplicate) && $smarty.request.isDuplicate eq "true"}
<input type="hidden" name="record" value="">
<input type="hidden" name="duplicateSave" value="true">
<input type="hidden" name="duplicateId" value="{$fields.id.value}">
{else}
<input type="hidden" name="record" value="{$fields.id.value}">
{/if}
<input type="hidden" name="isDuplicate" value="false">
<input type="hidden" name="action">
<input type="hidden" name="return_module" value="{$smarty.request.return_module}">
<input type="hidden" name="return_action" value="{$smarty.request.return_action}">
<input type="hidden" name="return_id" value="{$smarty.request.return_id}">
<input type="hidden" name="module_tab"> 
<input type="hidden" name="contact_role">
{if (!empty($smarty.request.return_module) || !empty($smarty.request.relate_to)) && !(isset($smarty.request.isDuplicate) && $smarty.request.isDuplicate eq "true")}
<input type="hidden" name="relate_to" value="{if $smarty.request.return_relationship}{$smarty.request.return_relationship}{elseif $smarty.request.relate_to && empty($smarty.request.from_dcmenu)}{$smarty.request.relate_to}{elseif empty($isDCForm) && empty($smarty.request.from_dcmenu)}{$smarty.request.return_module}{/if}">
<input type="hidden" name="relate_id" value="{$smarty.request.return_id}">
{/if}
<input type="hidden" name="offset" value="{$offset}">
{assign var='place' value="_HEADER"} <!-- to be used for id for buttons with custom code in def files-->
<input type="hidden" name="opportunity_id" value="{$smarty.request.opportunity_id}">   
<input type="hidden" name="case_id" value="{$smarty.request.case_id}">   
<input type="hidden" name="bug_id" value="{$smarty.request.bug_id}">   
<input type="hidden" name="email_id" value="{$smarty.request.email_id}">   
<input type="hidden" name="inbound_email_id" value="{$smarty.request.inbound_email_id}">   
{if !empty($smarty.request.contact_id)}<input type="hidden" name="reports_to_id" value="{$smarty.request.contact_id}">{/if}   
{if !empty($smarty.request.contact_name)}<input type="hidden" name="report_to_name" value="{$smarty.request.contact_name}">{/if}   
<div class="action_buttons">{if $bean->aclAccess("save")}<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="button primary" onclick="var _form = document.getElementById('form_QuickCreate_Contacts'); _form.action.value='Popup';return check_form('form_QuickCreate_Contacts')" type="submit" name="Contacts_popupcreate_save_button" id="Contacts_popupcreate_save_button" value="{$APP.LBL_SAVE_BUTTON_LABEL}">{/if}  <input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="toggleDisplay('addform');return false;" name="Contacts_popup_cancel_button" type="submit"id="Contacts_popup_cancel_button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}">  {if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=Contacts", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}<div class="clear"></div></div>
</td>
<td align='right'>
{$PAGINATION}
</td>
</tr>
</table>{sugar_include include=$includes}
<span id='tabcounterJS'><script>SUGAR.TabFields=new Array();//this will be used to track tabindexes for references</script></span>
<div id="form_QuickCreate_Contacts_tabs"
>
<div >
<div id="detailpanel_1" >
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table width="100%" border="0" cellspacing="1" cellpadding="0"  id='Default_{$module}_Subpanel'  class="yui3-skin-sam edit view panelContainer">
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='first_name_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FIRST_NAME' module='Contacts'}{/capture}
{$label|strip_semicolon}:
<span class="required">*</span>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
{html_options name="salutation" id="salutation" options=$fields.salutation.options selected=$fields.salutation.value}&nbsp;<input accesskey="7"  tabindex="0"  name="first_name" id="first_name" size="25" maxlength="25" type="text" value="{$fields.first_name.value}">
<td valign="top" id='account_name_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_ACCOUNT_NAME' module='Contacts'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

<input type="text" name="{$fields.account_name.name}" class="sqsEnabled" tabindex="0" id="{$fields.account_name.name}" size="" value="{$fields.account_name.value}" title='' autocomplete="off"  	 >
<input type="hidden" name="{$fields.account_name.id_name}" 
id="{$fields.account_name.id_name}" 
value="{$fields.account_id.value}">
<span class="id-ff multiple">
<button type="button" name="btn_{$fields.account_name.name}" id="btn_{$fields.account_name.name}" tabindex="0" title="{sugar_translate label="LBL_ACCESSKEY_SELECT_ACCOUNTS_TITLE"}" class="button firstChild" value="{sugar_translate label="LBL_ACCESSKEY_SELECT_ACCOUNTS_LABEL"}"
onclick='open_popup(
"{$fields.account_name.module}", 
600, 
400, 
"", 
true, 
false, 
{literal}{"call_back_function":"set_return","form_name":"form_QuickCreate_Contacts","field_to_name_array":{"id":"account_id","name":"account_name"}}{/literal}, 
"single", 
true
);' ><img src="{sugar_getimagepath file="id-ff-select.png"}"></button><button type="button" name="btn_clr_{$fields.account_name.name}" id="btn_clr_{$fields.account_name.name}" tabindex="0" title="{sugar_translate label="LBL_ACCESSKEY_CLEAR_ACCOUNTS_TITLE"}"  class="button lastChild"
onclick="SUGAR.clearRelateField(this.form, '{$fields.account_name.name}', '{$fields.account_name.id_name}');"  value="{sugar_translate label="LBL_ACCESSKEY_CLEAR_ACCOUNTS_LABEL"}" ><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
<script type="text/javascript">
SUGAR.util.doWhen(
		"typeof(sqs_objects) != 'undefined' && typeof(sqs_objects['{$form_name}_{$fields.account_name.name}']) != 'undefined'",
		enableQS
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='last_name_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_LAST_NAME' module='Contacts'}{/capture}
{$label|strip_semicolon}:
<span class="required">*</span>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.last_name.value) <= 0}
{assign var="value" value=$fields.last_name.default_value }
{else}
{assign var="value" value=$fields.last_name.value }
{/if}  
<input type='text' name='{$fields.last_name.name}' 
id='{$fields.last_name.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
<td valign="top" id='phone_work_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_OFFICE_PHONE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.phone_work.value) <= 0}
{assign var="value" value=$fields.phone_work.default_value }
{else}
{assign var="value" value=$fields.phone_work.value }
{/if}  
<input type='text' name='{$fields.phone_work.name}' id='{$fields.phone_work.name}' size='30' maxlength='100' value='{$value}' title='' tabindex='0'	  class="phone" >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='title_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_TITLE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.title.value) <= 0}
{assign var="value" value=$fields.title.default_value }
{else}
{assign var="value" value=$fields.title.value }
{/if}  
<input type='text' name='{$fields.title.name}' 
id='{$fields.title.name}' size='30' 
maxlength='100' 
value='{$value}' title=''      >
<td valign="top" id='phone_mobile_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_MOBILE_PHONE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
<span class="required">*</span>
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.phone_mobile.value) <= 0}
{assign var="value" value=$fields.phone_mobile.default_value }
{else}
{assign var="value" value=$fields.phone_mobile.value }
{/if}  
<input type='text' name='{$fields.phone_mobile.name}' id='{$fields.phone_mobile.name}' size='30' maxlength='100' value='{$value}' title='' tabindex='0'	  class="phone" >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='phone_fax_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_FAX_PHONE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strlen($fields.phone_fax.value) <= 0}
{assign var="value" value=$fields.phone_fax.default_value }
{else}
{assign var="value" value=$fields.phone_fax.value }
{/if}  
<input type='text' name='{$fields.phone_fax.name}' id='{$fields.phone_fax.name}' size='30' maxlength='100' value='{$value}' title='' tabindex='0'	  class="phone" >
<td valign="top" id='do_not_call_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_DO_NOT_CALL' module='Contacts'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if strval($fields.do_not_call.value) == "1" || strval($fields.do_not_call.value) == "yes" || strval($fields.do_not_call.value) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="hidden" name="{$fields.do_not_call.name}" value="0"> 
<input type="checkbox" id="{$fields.do_not_call.name}" 
name="{$fields.do_not_call.name}" 
value="1" title='' tabindex="0" {$checked} >
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='email1_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_EMAIL_ADDRESS' module='Contacts'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}
<span id='email1_span'>
{$fields.email1.value}</span>
<td valign="top" id='lead_source_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_LEAD_SOURCE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' >
{counter name="panelFieldCount"}

{if !isset($config.enable_autocomplete) || $config.enable_autocomplete==false}
<select name="{$fields.lead_source.name}" 
id="{$fields.lead_source.name}" 
title=''       
>
{if isset($fields.lead_source.value) && $fields.lead_source.value != ''}
{html_options options=$fields.lead_source.options selected=$fields.lead_source.value}
{else}
{html_options options=$fields.lead_source.options selected=$fields.lead_source.default}
{/if}
</select>
{else}
{assign var="field_options" value=$fields.lead_source.options }
{capture name="field_val"}{$fields.lead_source.value}{/capture}
{assign var="field_val" value=$smarty.capture.field_val}
{capture name="ac_key"}{$fields.lead_source.name}{/capture}
{assign var="ac_key" value=$smarty.capture.ac_key}
<select style='display:none' name="{$fields.lead_source.name}" 
id="{$fields.lead_source.name}" 
title=''          
>
{if isset($fields.lead_source.value) && $fields.lead_source.value != ''}
{html_options options=$fields.lead_source.options selected=$fields.lead_source.value}
{else}
{html_options options=$fields.lead_source.options selected=$fields.lead_source.default}
{/if}
</select>
<input
id="{$fields.lead_source.name}-input"
name="{$fields.lead_source.name}-input"
size="30"
value="{$field_val|lookup:$field_options}"
type="text" style="vertical-align: top;">
<span class="id-ff multiple">
<button type="button"><img src="{sugar_getimagepath file="id-ff-down.png"}" id="{$fields.lead_source.name}-image"></button><button type="button"
id="btn-clear-{$fields.lead_source.name}-input"
title="Clear"
onclick="SUGAR.clearRelateField(this.form, '{$fields.lead_source.name}-input', '{$fields.lead_source.name}');sync_{$fields.lead_source.name}()"><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
{literal}
<script>
SUGAR.AutoComplete.{/literal}{$ac_key}{literal} = [];
{/literal}
{literal}
(function (){
var selectElem = document.getElementById("{/literal}{$fields.lead_source.name}{literal}");
if (typeof select_defaults =="undefined")
select_defaults = [];
select_defaults[selectElem.id] = {key:selectElem.value,text:''};
//get default
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value)
select_defaults[selectElem.id].text = selectElem.options[i].innerHTML;
}
//SUGAR.AutoComplete.{$ac_key}.ds = 
//get options array from vardefs
var options = SUGAR.AutoComplete.getOptionsArray("");
YUI().use('datasource', 'datasource-jsonschema',function (Y) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds = new Y.DataSource.Function({
source: function (request) {
var ret = [];
for (i=0;i<selectElem.options.length;i++)
if (!(selectElem.options[i].value=='' && selectElem.options[i].innerHTML==''))
ret.push({'key':selectElem.options[i].value,'text':selectElem.options[i].innerHTML});
return ret;
}
});
});
})();
{/literal}
{literal}
YUI().use("autocomplete", "autocomplete-filters", "autocomplete-highlighters", "node","node-event-simulate", function (Y) {
{/literal}
SUGAR.AutoComplete.{$ac_key}.inputNode = Y.one('#{$fields.lead_source.name}-input');
SUGAR.AutoComplete.{$ac_key}.inputImage = Y.one('#{$fields.lead_source.name}-image');
SUGAR.AutoComplete.{$ac_key}.inputHidden = Y.one('#{$fields.lead_source.name}');
{literal}
function SyncToHidden(selectme){
var selectElem = document.getElementById("{/literal}{$fields.lead_source.name}{literal}");
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
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('change');
}
//global variable 
sync_{/literal}{$fields.lead_source.name}{literal} = function(){
SyncToHidden();
}
function syncFromHiddenToWidget(){
var selectElem = document.getElementById("{/literal}{$fields.lead_source.name}{literal}");
//if select no longer on page, kill timer
if (selectElem==null || selectElem.options == null)
return;
var currentvalue = SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.simulate('keyup');
for (i=0;i<selectElem.options.length;i++){
if (selectElem.options[i].value==selectElem.value && document.activeElement != document.getElementById('{/literal}{$fields.lead_source.name}-input{literal}'))
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value',selectElem.options[i].innerHTML);
}
}
YAHOO.util.Event.onAvailable("{/literal}{$fields.lead_source.name}{literal}", syncFromHiddenToWidget);
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 0;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 0;
SUGAR.AutoComplete.{$ac_key}.numOptions = {$field_options|@count};
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 300) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 200;
{literal}
}
{/literal}
if(SUGAR.AutoComplete.{$ac_key}.numOptions >= 3000) {literal}{
{/literal}
SUGAR.AutoComplete.{$ac_key}.minQLen = 1;
SUGAR.AutoComplete.{$ac_key}.queryDelay = 500;
{literal}
}
{/literal}
SUGAR.AutoComplete.{$ac_key}.optionsVisible = false;
{literal}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.plug(Y.Plugin.AutoComplete, {
activateFirstItem: true,
{/literal}
minQueryLength: SUGAR.AutoComplete.{$ac_key}.minQLen,
queryDelay: SUGAR.AutoComplete.{$ac_key}.queryDelay,
zIndex: 99999,
{literal}
source: SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.ds,
resultTextLocator: 'text',
resultHighlighter: 'phraseMatch',
resultFilters: 'phraseMatch',
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover = function(ex){
var hover = YAHOO.util.Dom.getElementsByClassName('dccontent');
if(hover[0] != null){
if (ex) {
var h = '1000px';
hover[0].style.height = h;
}
else{
hover[0].style.height = '';
}
}
}
if({/literal}SUGAR.AutoComplete.{$ac_key}.minQLen{literal} == 0){
// expand the dropdown options upon focus
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.sendRequest('');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = true;
});
}
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('click', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('click');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('dblclick', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('dblclick');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('focus', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('focus');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mouseup', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mouseup');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('mousedown', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('mousedown');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.on('blur', function(e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.simulate('blur');
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible = false;
var selectElem = document.getElementById("{/literal}{$fields.lead_source.name}{literal}");
//if typed value is a valid option, do nothing
for (i=0;i<selectElem.options.length;i++)
if (selectElem.options[i].innerHTML==SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.get('value'))
return;
//typed value is invalid, so set the text and the hidden to blank
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.set('value', select_defaults[selectElem.id].text);
SyncToHidden(select_defaults[selectElem.id].key);
});
// when they click on the arrow image, toggle the visibility of the options
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputImage.ancestor().on('click', function () {
if (SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.optionsVisible) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.blur();
} else {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.focus();
}
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('query', function () {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputHidden.set('value', '');
});
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('visibleChange', function (e) {
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.expandHover(e.newVal); // expand
});
// when they select an option, set the hidden input with the KEY, to be saved
SUGAR.AutoComplete.{/literal}{$ac_key}{literal}.inputNode.ac.on('select', function(e) {
SyncToHidden(e.result.raw.key);
});
});
</script> 
{/literal}
{/if}
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{capture name="tr" assign="tableRow"}
<tr>
<td valign="top" id='assigned_user_name_label' width='12.5%' scope="col">
{capture name="label" assign="label"}{sugar_translate label='LBL_ASSIGNED_TO' module='Contacts'}{/capture}
{$label|strip_semicolon}:
</td>
{counter name="fieldsUsed"}

<td valign="top" width='37.5%' colspan='3'>
{counter name="panelFieldCount"}

<input type="text" name="{$fields.assigned_user_name.name}" class="sqsEnabled" tabindex="0" id="{$fields.assigned_user_name.name}" size="" value="{$fields.assigned_user_name.value}" title='' autocomplete="off"  	 >
<input type="hidden" name="{$fields.assigned_user_name.id_name}" 
id="{$fields.assigned_user_name.id_name}" 
value="{$fields.assigned_user_id.value}">
<span class="id-ff multiple">
<button type="button" name="btn_{$fields.assigned_user_name.name}" id="btn_{$fields.assigned_user_name.name}" tabindex="0" title="{sugar_translate label="LBL_ACCESSKEY_SELECT_USERS_TITLE"}" class="button firstChild" value="{sugar_translate label="LBL_ACCESSKEY_SELECT_USERS_LABEL"}"
onclick='open_popup(
"{$fields.assigned_user_name.module}", 
600, 
400, 
"", 
true, 
false, 
{literal}{"call_back_function":"set_return","form_name":"form_QuickCreate_Contacts","field_to_name_array":{"id":"assigned_user_id","user_name":"assigned_user_name"}}{/literal}, 
"single", 
true
);' ><img src="{sugar_getimagepath file="id-ff-select.png"}"></button><button type="button" name="btn_clr_{$fields.assigned_user_name.name}" id="btn_clr_{$fields.assigned_user_name.name}" tabindex="0" title="{sugar_translate label="LBL_ACCESSKEY_CLEAR_USERS_TITLE"}"  class="button lastChild"
onclick="SUGAR.clearRelateField(this.form, '{$fields.assigned_user_name.name}', '{$fields.assigned_user_name.id_name}');"  value="{sugar_translate label="LBL_ACCESSKEY_CLEAR_USERS_LABEL"}" ><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
<script type="text/javascript">
SUGAR.util.doWhen(
		"typeof(sqs_objects) != 'undefined' && typeof(sqs_objects['{$form_name}_{$fields.assigned_user_name.name}']) != 'undefined'",
		enableQS
);
</script>
</tr>
{/capture}
{if $fieldsUsed > 0 }
{$tableRow}
{/if}
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("DEFAULT").style.display='none';</script>
{/if}
</div></div>

<script language="javascript">
    var _form_id = '{$form_id}';
    {literal}
    SUGAR.util.doWhen(function(){
        _form_id = (_form_id == '') ? 'EditView' : _form_id;
        return document.getElementById(_form_id) != null;
    }, SUGAR.themes.actionMenu);
    {/literal}
</script>
{assign var='place' value="_FOOTER"} <!-- to be used for id for buttons with custom code in def files-->
<div class="buttons">
<div class="action_buttons">{if $bean->aclAccess("save")}<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="button primary" onclick="var _form = document.getElementById('form_QuickCreate_Contacts'); _form.action.value='Popup';return check_form('form_QuickCreate_Contacts')" type="submit" name="Contacts_popupcreate_save_button" id="Contacts_popupcreate_save_button" value="{$APP.LBL_SAVE_BUTTON_LABEL}">{/if}  <input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="toggleDisplay('addform');return false;" name="Contacts_popup_cancel_button" type="submit"id="Contacts_popup_cancel_button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}">  {if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=Contacts", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}<div class="clear"></div></div>
</div>
</form>
{$set_focus_block}
<script>SUGAR.util.doWhen("document.getElementById('EditView') != null",
function(){ldelim}SUGAR.util.buildAccessKeyLabels();{rdelim});
</script><script type="text/javascript">
YAHOO.util.Event.onContentReady("form_QuickCreate_Contacts",
    function () {ldelim} initEditView(document.forms.form_QuickCreate_Contacts) {rdelim});
//window.setTimeout(, 100);
window.onbeforeunload = function () {ldelim} return onUnloadEditView(); {rdelim};
// bug 55468 -- IE is too aggressive with onUnload event
if ($.browser.msie) {ldelim}
$(document).ready(function() {ldelim}
    $(".collapseLink,.expandLink").click(function (e) {ldelim} e.preventDefault(); {rdelim});
  {rdelim});
{rdelim}
</script>{literal}
<script type="text/javascript">
addForm('form_QuickCreate_Contacts');addToValidate('form_QuickCreate_Contacts', 'name', 'name', false,'{/literal}{sugar_translate label='LBL_NAME' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'date_entered_date', 'date', false,'User Creation Date' );
addToValidate('form_QuickCreate_Contacts', 'date_modified_date', 'date', false,'Date Modified' );
addToValidate('form_QuickCreate_Contacts', 'modified_user_id', 'assigned_user_name', false,'{/literal}{sugar_translate label='LBL_MODIFIED' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'modified_by_name', 'relate', false,'{/literal}{sugar_translate label='LBL_MODIFIED_NAME' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'created_by', 'assigned_user_name', false,'{/literal}{sugar_translate label='LBL_CREATED' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'created_by_name', 'relate', false,'{/literal}{sugar_translate label='LBL_CREATED' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'description', 'text', false,'{/literal}{sugar_translate label='LBL_DESCRIPTION' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'deleted', 'bool', false,'{/literal}{sugar_translate label='LBL_DELETED' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'assigned_user_id', 'relate', false,'{/literal}{sugar_translate label='LBL_ASSIGNED_TO_ID' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'assigned_user_name', 'relate', false,'{/literal}{sugar_translate label='LBL_ASSIGNED_TO_NAME' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'salutation', 'enum', false,'{/literal}{sugar_translate label='LBL_SALUTATION' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'first_name', 'varchar', true,'{/literal}{sugar_translate label='LBL_FIRST_NAME' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'last_name', 'varchar', false,'{/literal}{sugar_translate label='LBL_LAST_NAME' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'full_name', 'fullname', false,'{/literal}{sugar_translate label='LBL_NAME' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'title', 'varchar', false,'{/literal}{sugar_translate label='LBL_TITLE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'photo', 'image', false,'{/literal}{sugar_translate label='LBL_PHOTO' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'department', 'varchar', false,'{/literal}{sugar_translate label='LBL_DEPARTMENT' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'do_not_call', 'bool', false,'{/literal}{sugar_translate label='LBL_DO_NOT_CALL' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'phone_home', 'phone', false,'{/literal}{sugar_translate label='LBL_HOME_PHONE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'email', 'email', false,'{/literal}{sugar_translate label='LBL_ANY_EMAIL' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'phone_mobile', 'phone', true,'{/literal}{sugar_translate label='LBL_MOBILE_PHONE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'phone_work', 'phone', false,'{/literal}{sugar_translate label='LBL_OFFICE_PHONE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'phone_other', 'phone', false,'{/literal}{sugar_translate label='LBL_OTHER_PHONE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'phone_fax', 'phone', false,'{/literal}{sugar_translate label='LBL_FAX_PHONE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'email1', 'varchar', false,'{/literal}{sugar_translate label='LBL_EMAIL_ADDRESS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'email2', 'varchar', false,'{/literal}{sugar_translate label='LBL_OTHER_EMAIL_ADDRESS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'invalid_email', 'bool', false,'{/literal}{sugar_translate label='LBL_INVALID_EMAIL' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'email_opt_out', 'bool', false,'{/literal}{sugar_translate label='LBL_EMAIL_OPT_OUT' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'primary_address_street', 'varchar', false,'{/literal}{sugar_translate label='LBL_PRIMARY_ADDRESS_STREET' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'primary_address_street_2', 'varchar', false,'{/literal}{sugar_translate label='LBL_PRIMARY_ADDRESS_STREET_2' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'primary_address_street_3', 'varchar', false,'{/literal}{sugar_translate label='LBL_PRIMARY_ADDRESS_STREET_3' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'primary_address_city', 'varchar', false,'{/literal}{sugar_translate label='LBL_PRIMARY_ADDRESS_CITY' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'primary_address_state', 'varchar', false,'{/literal}{sugar_translate label='LBL_PRIMARY_ADDRESS_STATE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'primary_address_postalcode', 'varchar', false,'{/literal}{sugar_translate label='LBL_PRIMARY_ADDRESS_POSTALCODE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'primary_address_country', 'varchar', false,'{/literal}{sugar_translate label='LBL_PRIMARY_ADDRESS_COUNTRY' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'alt_address_street', 'varchar', false,'{/literal}{sugar_translate label='LBL_ALT_ADDRESS_STREET' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'alt_address_street_2', 'varchar', false,'{/literal}{sugar_translate label='LBL_ALT_ADDRESS_STREET_2' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'alt_address_street_3', 'varchar', false,'{/literal}{sugar_translate label='LBL_ALT_ADDRESS_STREET_3' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'alt_address_city', 'varchar', false,'{/literal}{sugar_translate label='LBL_ALT_ADDRESS_CITY' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'alt_address_state', 'varchar', false,'{/literal}{sugar_translate label='LBL_ALT_ADDRESS_STATE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'alt_address_postalcode', 'varchar', false,'{/literal}{sugar_translate label='LBL_ALT_ADDRESS_POSTALCODE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'alt_address_country', 'varchar', false,'{/literal}{sugar_translate label='LBL_ALT_ADDRESS_COUNTRY' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'assistant', 'varchar', false,'{/literal}{sugar_translate label='LBL_ASSISTANT' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'assistant_phone', 'phone', false,'{/literal}{sugar_translate label='LBL_ASSISTANT_PHONE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'email_addresses_non_primary', 'email', false,'{/literal}{sugar_translate label='LBL_EMAIL_NON_PRIMARY' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'email_and_name1', 'varchar', false,'{/literal}{sugar_translate label='LBL_NAME' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'lead_source', 'enum', false,'{/literal}{sugar_translate label='LBL_LEAD_SOURCE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'account_name', 'relate', false,'{/literal}{sugar_translate label='LBL_ACCOUNT_NAME' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'account_id', 'relate', false,'{/literal}{sugar_translate label='LBL_ACCOUNT_ID' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'opportunity_role_fields', 'relate', false,'{/literal}{sugar_translate label='LBL_ACCOUNT_NAME' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'opportunity_role_id', 'varchar', false,'{/literal}{sugar_translate label='LBL_OPPORTUNITY_ROLE_ID' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'opportunity_role', 'enum', false,'{/literal}{sugar_translate label='LBL_OPPORTUNITY_ROLE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'reports_to_id', 'id', false,'{/literal}{sugar_translate label='LBL_REPORTS_TO_ID' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'report_to_name', 'relate', false,'{/literal}{sugar_translate label='LBL_REPORTS_TO' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'birthdate', 'date', false,'{/literal}{sugar_translate label='LBL_BIRTHDATE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'campaign_id', 'id', false,'{/literal}{sugar_translate label='LBL_CAMPAIGN_ID' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'campaign_name', 'relate', false,'{/literal}{sugar_translate label='LBL_CAMPAIGN' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'c_accept_status_fields', 'relate', false,'{/literal}{sugar_translate label='LBL_LIST_ACCEPT_STATUS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'm_accept_status_fields', 'relate', false,'{/literal}{sugar_translate label='LBL_LIST_ACCEPT_STATUS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'accept_status_id', 'varchar', false,'{/literal}{sugar_translate label='LBL_LIST_ACCEPT_STATUS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'accept_status_name', 'enum', false,'{/literal}{sugar_translate label='LBL_LIST_ACCEPT_STATUS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'sync_contact', 'bool', false,'{/literal}{sugar_translate label='LBL_SYNC_CONTACT' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'e_invite_status_fields', 'relate', false,'{/literal}{sugar_translate label='LBL_CONT_INVITE_STATUS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'event_status_name', 'enum', false,'{/literal}{sugar_translate label='LBL_LIST_INVITE_STATUS_EVENT' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'event_invite_id', 'varchar', false,'{/literal}{sugar_translate label='LBL_LIST_INVITE_STATUS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'e_accept_status_fields', 'relate', false,'{/literal}{sugar_translate label='LBL_CONT_ACCEPT_STATUS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'event_accept_status', 'enum', false,'{/literal}{sugar_translate label='LBL_LIST_ACCEPT_STATUS_EVENT' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'event_status_id', 'varchar', false,'{/literal}{sugar_translate label='LBL_LIST_ACCEPT_STATUS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'joomla_account_id', 'varchar', false,'{/literal}{sugar_translate label='LBL_JOOMLA_ACCOUNT_ID' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'portal_account_disabled', 'bool', false,'{/literal}{sugar_translate label='LBL_PORTAL_ACCOUNT_DISABLED' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'joomla_account_access', 'varchar', false,'{/literal}{sugar_translate label='LBL_JOOMLA_ACCOUNT_ACCESS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'portal_user_type', 'enum', false,'{/literal}{sugar_translate label='LBL_PORTAL_USER_TYPE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'investment_in_80d_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_INVESTMENT_IN_80D' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'type_c', 'enum', false,'{/literal}{sugar_translate label='LBL_TYPE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'location_through_ip_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_LOCATION_THROUGH_IP' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'age_c', 'int', false,'{/literal}{sugar_translate label='LBL_AGE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'structure_of_family_c', 'enum', false,'{/literal}{sugar_translate label='LBL_STRUCTURE_OF_FAMILY' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'twitter_handle_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_TWITTER_HANDLE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'payment_type_c', 'dynamicenum', false,'{/literal}{sugar_translate label='LBL_PAYMENT_TYPE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'exisitng_mi_premium_c', 'currency', false,'{/literal}{sugar_translate label='LBL_EXISITNG_MI_PREMIUM' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'user_allocation_date_c_date', 'date', false,'User Allocation Date' );
addToValidate('form_QuickCreate_Contacts', 'existing_hi_premium_c', 'currency', false,'{/literal}{sugar_translate label='LBL_EXISTING_HI_PREMIUM' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'post_from_id_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_POST_FROM_ID' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'state_c', 'enum', false,'{/literal}{sugar_translate label='LBL_STATE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'online_activity_status_c', 'enum', false,'{/literal}{sugar_translate label='LBL_ONLINE_ACTIVITY_STATUS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'opportunity_horizon_c', 'date', false,'{/literal}{sugar_translate label='LBL_OPPORTUNITY_HORIZON' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'existing_investment_silver_c', 'currency', false,'{/literal}{sugar_translate label='LBL_EXISTING_INVESTMENT_SILVER' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'jjwg_maps_geocode_status_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_JJWG_MAPS_GEOCODE_STATUS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'unique_customer_code_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_UNIQUE_CUSTOMER_CODE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'facebook_id_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_FACEBOOK_ID' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'exisiting_term_insurance_pre_c', 'currency', false,'{/literal}{sugar_translate label='LBL_EXISITING_TERM_INSURANCE_PRE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'financial_goals_c[]', 'multienum', false,'{/literal}{sugar_translate label='LBL_FINANCIAL_GOALS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'campaign_sub_type_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_CAMPAIGN_SUB_TYPE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'risk_profiling_questions_c', 'text', false,'{/literal}{sugar_translate label='LBL_RISK_PROFILING_QUESTIONS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'category_c', 'enum', false,'{/literal}{sugar_translate label='LBL_CATEGORY' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'monthly_expense_details_c', 'currency', false,'{/literal}{sugar_translate label='LBL_MONTHLY_EXPENSE_DETAILS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'activate_disposition_c', 'bool', false,'{/literal}{sugar_translate label='LBL_ACTIVATE_DISPOSITION' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'existing_investments_deposit_c', 'currency', false,'{/literal}{sugar_translate label='LBL_EXISTING_INVESTMENTS_DEPOSIT' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'next_call_planning_date_c_date', 'date', false,'Next Call Planning Date' );
addToValidate('form_QuickCreate_Contacts', 'investment_in_80c_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_INVESTMENT_IN_80C' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'existing_investments_bonds_c', 'currency', false,'{/literal}{sugar_translate label='LBL_EXISTING_INVESTMENTS_BONDS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'next_call_planning_comments_c', 'text', false,'{/literal}{sugar_translate label='LBL_NEXT_CALL_PLANNING_COMMENTS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'middle_name_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_MIDDLE_NAME' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'exisiting_term_insurance_sum_c', 'currency', false,'{/literal}{sugar_translate label='LBL_EXISITING_TERM_INSURANCE_SUM' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'historical_session_data_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_HISTORICAL_SESSION_DATA' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'publisher_id_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_PUBLISHER_ID' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'product_interest_c', 'enum', false,'{/literal}{sugar_translate label='LBL_PRODUCT_INTEREST' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'investment_behaviour_segment_c', 'enum', false,'{/literal}{sugar_translate label='LBL_INVESTMENT_BEHAVIOUR_SEGMENT' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'no_of_children_c', 'enum', false,'{/literal}{sugar_translate label='LBL_NO_OF_CHILDREN' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'annual_expenses_c', 'currency', false,'{/literal}{sugar_translate label='LBL_ANNUAL_EXPENSES' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'expenses_details_c', 'currency', false,'{/literal}{sugar_translate label='LBL_EXPENSES_DETAILS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'existing_mi_sum_insured_c', 'currency', false,'{/literal}{sugar_translate label='LBL_EXISTING_MI_SUM_INSURED' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'portal_active_user_c', 'bool', false,'{/literal}{sugar_translate label='LBL_PORTAL_ACTIVE_USER' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'currency_id', 'currency_id', false,'{/literal}{sugar_translate label='LBL_CURRENCY' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'jjwg_maps_address_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_JJWG_MAPS_ADDRESS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'existing_hi_sum_insured_c', 'currency', false,'{/literal}{sugar_translate label='LBL_EXISTING_HI_SUM_INSURED' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'existing_investment_gold_c', 'currency', false,'{/literal}{sugar_translate label='LBL_EXISTING_INVESTMENT_GOLD' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'is_mobile_number_verified_c', 'enum', false,'{/literal}{sugar_translate label='LBL_IS_MOBILE_NUMBER_VERIFIED' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'existing_insurance_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_EXISTING_INSURANCE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'gender_c', 'enum', false,'{/literal}{sugar_translate label='LBL_GENDER' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'occupational_details_c', 'enum', false,'{/literal}{sugar_translate label='LBL_OCCUPATIONAL_DETAILS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'posted_message_id_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_POSTED_MESSAGE_ID' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'user_type_c', 'enum', false,'{/literal}{sugar_translate label='LBL_USER_TYPE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'postalcode_c', 'dynamicenum', false,'{/literal}{sugar_translate label='LBL_POSTALCODE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'related_kiosk_account_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_RELATED_KIOSK_ACCOUNT' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'dnc_status_c', 'enum', false,'{/literal}{sugar_translate label='LBL_DNC_STATUS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'prior_invesment_value_c', 'currency', false,'{/literal}{sugar_translate label='LBL_PRIOR_INVESMENT_VALUE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'tax_planning_c', 'enum', false,'{/literal}{sugar_translate label='LBL_TAX_PLANNING' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'twitter_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_TWITTER' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'partner_status_c', 'enum', false,'{/literal}{sugar_translate label='LBL_PARTNER_STATUS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'opportunity_value_c', 'currency', false,'{/literal}{sugar_translate label='LBL_OPPORTUNITY_VALUE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'campaign_type_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_CAMPAIGN_TYPE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'current_company_details_c', 'text', false,'{/literal}{sugar_translate label='LBL_CURRENT_COMPANY_DETAILS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'country_c', 'enum', false,'{/literal}{sugar_translate label='LBL_COUNTRY' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'password_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_PASSWORD' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'user_name_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_USER_NAME' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'gateway_c', 'enum', true,'{/literal}{sugar_translate label='LBL_GATEWAY' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'no_of_adults_c', 'enum', false,'{/literal}{sugar_translate label='LBL_NO_OF_ADULTS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'educational_details_c', 'enum', false,'{/literal}{sugar_translate label='LBL_EDUCATIONAL_DETAILS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'india_c', 'enum', false,'{/literal}{sugar_translate label='LBL_INDIA' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'jjwg_maps_lng_c', 'float', false,'{/literal}{sugar_translate label='LBL_JJWG_MAPS_LNG' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'adoption_percentage_c', 'decimal', false,'{/literal}{sugar_translate label='LBL_ADOPTION_PERCENTAGE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'family_members_number_c', 'enum', false,'{/literal}{sugar_translate label='LBL_FAMILY_MEMBERS_NUMBER' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'life_stage_profiling_c', 'enum', false,'{/literal}{sugar_translate label='LBL_LIFE_STAGE_PROFILING' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'address_c', 'text', false,'{/literal}{sugar_translate label='LBL_ADDRESS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'loan_type_c', 'enum', false,'{/literal}{sugar_translate label='LBL_LOAN_TYPE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'annual_income_c', 'currency', false,'{/literal}{sugar_translate label='LBL_ANNUAL_INCOME' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'related_corporate_account_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_RELATED_CORPORATE_ACCOUNT' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'product_sub_type_interest_c', 'enum', false,'{/literal}{sugar_translate label='LBL_PRODUCT_SUB_TYPE_INTEREST' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'sales_stage_c', 'enum', false,'{/literal}{sugar_translate label='LBL_SALES_STAGE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'tweet_id_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_TWEET_ID' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'best_time_to_speak_to_c_date', 'date', false,'Best time to speak to' );
addToValidate('form_QuickCreate_Contacts', 'comments_c', 'text', false,'{/literal}{sugar_translate label='LBL_COMMENTS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'city_c', 'dynamicenum', false,'{/literal}{sugar_translate label='LBL_CITY' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'first_transaction_date_c', 'date', false,'{/literal}{sugar_translate label='LBL_FIRST_TRANSACTION_DATE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'jjwg_maps_lat_c', 'float', false,'{/literal}{sugar_translate label='LBL_JJWG_MAPS_LAT' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'sales_person_tagging_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_SALES_PERSON_TAGGING' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'existing_investment_re_c', 'currency', false,'{/literal}{sugar_translate label='LBL_EXISTING_INVESTMENT_RE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'publisher_name_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_PUBLISHER_NAME' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'courier_request_c', 'date', false,'{/literal}{sugar_translate label='LBL_COURIER_REQUEST' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'saving_potential_c', 'currency', false,'{/literal}{sugar_translate label='LBL_SAVING_POTENTIAL' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'classification_accoun_c', 'enum', false,'{/literal}{sugar_translate label='LBL_CLASSIFICATION_ACCOUN' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'is_email_verified_c', 'enum', false,'{/literal}{sugar_translate label='LBL_IS_EMAIL_VERIFIED' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'total_employment_years_c', 'enum', false,'{/literal}{sugar_translate label='LBL_TOTAL_EMPLOYMENT_YEARS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'exisiting_investments_c[]', 'multienum', false,'{/literal}{sugar_translate label='LBL_EXISITING_INVESTMENTS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'disposition_c', 'enum', true,'{/literal}{sugar_translate label='LBL_DISPOSITION' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'monthly_income_details_c', 'currency', false,'{/literal}{sugar_translate label='LBL_MONTHLY_INCOME_DETAILS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'agreed_to_assign_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_AGREED_TO_ASSIGN' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'date_of_first_call_c_date', 'date', false,'Date of First Call' );
addToValidate('form_QuickCreate_Contacts', 'date_of_second_call_c_date', 'date', false,'Date of Second Call' );
addToValidate('form_QuickCreate_Contacts', 'date_of_third_call_c_date', 'date', false,'Date of Third Call' );
addToValidate('form_QuickCreate_Contacts', 'date_of_validation_c_date', 'date', false,'Date of Validation' );
addToValidate('form_QuickCreate_Contacts', 'final_disposition_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_FINAL_DISPOSITION' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'lead_generation_date_c_date', 'date', false,'Lead Generation Date' );
addToValidate('form_QuickCreate_Contacts', 'preferred_date_of_call_c', 'date', false,'{/literal}{sugar_translate label='LBL_PREFERRED_DATE_OF_CALL' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'preferred_time_of_call_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_PREFERRED_TIME_OF_CALL' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'status_of_first_call_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_STATUS_OF_FIRST_CALL' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'status_of_second_call_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_STATUS_OF_SECOND_CALL' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'status_of_third_call_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_STATUS_OF_THIRD_CALL' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'validation_exe_assigned_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_VALIDATION_EXE_ASSIGNED' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'batch_id_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_BATCH_ID' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'age_of_the_user_c', 'int', false,'{/literal}{sugar_translate label='LBL_AGE_OF_THE_USER' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'allocated_time_c_date', 'date', false,'Allocated Time' );
addToValidate('form_QuickCreate_Contacts', 'campaign_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_CAMPAIGN' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'utm_content_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_UTM_CONTENT' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'sales_advisor_check_c', 'bool', false,'{/literal}{sugar_translate label='LBL_SALES_ADVISOR_CHECK' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'language_c', 'enum', false,'{/literal}{sugar_translate label='LBL_LANGUAGE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'application_no_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_APPLICATION_NO' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'pan_no_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_PAN_NO' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'aadharcard_no_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_AADHARCARD_NO' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'isminor_c', 'enum', false,'{/literal}{sugar_translate label='LBL_ISMINOR' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'kyc_status_c', 'enum', false,'{/literal}{sugar_translate label='LBL_KYC_STATUS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'investor_acct_creation_month_c', 'enum', false,'{/literal}{sugar_translate label='LBL_INVESTOR_ACCT_CREATION_MONTH' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'existing_investment_mf_c', 'currency', false,'{/literal}{sugar_translate label='LBL_EXISTING_INVESTMENT_MF' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'existing_investment_equity_c', 'currency', false,'{/literal}{sugar_translate label='LBL_EXISTING_INVESTMENT_EQUITY' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'risk_profile_id_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_RISK_PROFILE_ID' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'leadid_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_LEADID' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'dateofactivation_c_date', 'date', false,'Investor account activation date' );
addToValidate('form_QuickCreate_Contacts', 'account_activation_month_c', 'enum', false,'{/literal}{sugar_translate label='LBL_ACCOUNT_ACTIVATION_MONTH' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'date_of_registration_c_date', 'date', false,'Date Of Registration' );
addToValidate('form_QuickCreate_Contacts', 'document_submission_center_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_DOCUMENT_SUBMISSION_CENTER' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'auto_activation_c', 'enum', false,'{/literal}{sugar_translate label='LBL_AUTO_ACTIVATION' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'investorid_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_INVESTORID' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'total_sip_orders_c', 'int', false,'{/literal}{sugar_translate label='LBL_TOTAL_SIP_ORDERS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'summarizing_total_sip_amount_c', 'currency', false,'{/literal}{sugar_translate label='LBL_SUMMARIZING_TOTAL_SIP_AMOUNT' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'total_lumpsum_order_c', 'int', false,'{/literal}{sugar_translate label='LBL_TOTAL_LUMPSUM_ORDER' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'summarizing_the_total_lumpsu_c', 'currency', false,'{/literal}{sugar_translate label='LBL_SUMMARIZING_THE_TOTAL_LUMPSU' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'summarizing_total_orders_c', 'int', false,'{/literal}{sugar_translate label='LBL_SUMMARIZING_TOTAL_ORDERS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'summarizing_total_amount_c', 'currency', false,'{/literal}{sugar_translate label='LBL_SUMMARIZING_TOTAL_AMOUNT' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'no_of_fd_investment_orders_c', 'int', false,'{/literal}{sugar_translate label='LBL_NO_OF_FD_INVESTMENT_ORDERS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'total_amount_fd_c', 'currency', false,'{/literal}{sugar_translate label='LBL_TOTAL_AMOUNT_FD' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'cart_invoice_date_c', 'date', false,'{/literal}{sugar_translate label='LBL_CART_INVOICE_DATE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'transactionsubtype_c', 'enum', false,'{/literal}{sugar_translate label='LBL_TRANSACTIONSUBTYPE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'schemename_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_SCHEMENAME' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'amount_c', 'currency', false,'{/literal}{sugar_translate label='LBL_AMOUNT' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'invoicedate_c', 'date', false,'{/literal}{sugar_translate label='LBL_INVOICEDATE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'cart_scheme_name_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_CART_SCHEME_NAME' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'cart_amount_c', 'currency', false,'{/literal}{sugar_translate label='LBL_CART_AMOUNT' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'investment_period_c', 'enum', false,'{/literal}{sugar_translate label='LBL_INVESTMENT_PERIOD' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'investment_type_c', 'enum', false,'{/literal}{sugar_translate label='LBL_INVESTMENT_TYPE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'investment_amount_c', 'currency', false,'{/literal}{sugar_translate label='LBL_INVESTMENT_AMOUNT' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'taxyear_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_TAXYEAR' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'total_gross_salary_c', 'currency', false,'{/literal}{sugar_translate label='LBL_TOTAL_GROSS_SALARY' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'taxableincomeonhouserent_c', 'currency', false,'{/literal}{sugar_translate label='LBL_TAXABLEINCOMEONHOUSERENT' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'totaltaxtobepaid_c', 'currency', false,'{/literal}{sugar_translate label='LBL_TOTALTAXTOBEPAID' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'taxable_income_c', 'currency', false,'{/literal}{sugar_translate label='LBL_TAXABLE_INCOME' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'taxable_income_equity_c', 'currency', false,'{/literal}{sugar_translate label='LBL_TAXABLE_INCOME_EQUITY' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'taxable_income_sales_c', 'currency', false,'{/literal}{sugar_translate label='LBL_TAXABLE_INCOME_SALES' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'exemptions_from_80c_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_EXEMPTIONS_FROM_80C' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'exemptions_from_80d_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_EXEMPTIONS_FROM_80D' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'exemptions_80ccg_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_EXEMPTIONS_80CCG' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'exemptions_80ccd_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_EXEMPTIONS_80CCD' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'exemptions_80e_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_EXEMPTIONS_80E' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'exemptions_80g_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_EXEMPTIONS_80G' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'hra_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_HRA' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'interest_on_housing_loan_c', 'currency', false,'{/literal}{sugar_translate label='LBL_INTEREST_ON_HOUSING_LOAN' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'tax_deducted_at_source_c', 'currency', false,'{/literal}{sugar_translate label='LBL_TAX_DEDUCTED_AT_SOURCE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'professional_tax_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_PROFESSIONAL_TAX' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'taxable_income_deduction_c', 'currency', false,'{/literal}{sugar_translate label='LBL_TAXABLE_INCOME_DEDUCTION' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'tax_liability_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_TAX_LIABILITY' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'tax_that_you_an_save_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_TAX_THAT_YOU_AN_SAVE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'tax_to_be_paid_after_savin_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_TAX_TO_BE_PAID_AFTER_SAVIN' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'uploaded_cheque_image_c', 'enum', false,'{/literal}{sugar_translate label='LBL_UPLOADED_CHEQUE_IMAGE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'kyc_verification_status_c', 'enum', false,'{/literal}{sugar_translate label='LBL_KYC_VERIFICATION_STATUS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'document_submitted_cente_c', 'enum', false,'{/literal}{sugar_translate label='LBL_DOCUMENT_SUBMITTED_CENTE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'cart_type_c', 'int', false,'{/literal}{sugar_translate label='LBL_CART_TYPE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'qparam_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_QPARAM' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'is_1st_time_investor_c', 'enum', false,'{/literal}{sugar_translate label='LBL_IS_1ST_TIME_INVESTOR' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'source_of_income_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_SOURCE_OF_INCOME' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'campaign_city_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_CAMPAIGN_CITY' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'source_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_SOURCE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'custom_date_modified_c_date', 'date', false,'Date Modified' );
addToValidate('form_QuickCreate_Contacts', 'user_id_c', 'id', false,'{/literal}{sugar_translate label='LBL_CUSTOM_MODIFIED_USER_USER_ID' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'custom_modified_user_c', 'relate', false,'{/literal}{sugar_translate label='LBL_CUSTOM_MODIFIED_USER' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'do_not_run_logic_hook_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_DO_NOT_RUN_LOGIC_HOOK' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'to_kown_about_5nance_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_TO_KOWN_ABOUT_5NANCE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'customer_referral_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_CUSTOMER_REFERRAL' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'do_you_have_internet_banking_c', 'enum', false,'{/literal}{sugar_translate label='LBL_DO_YOU_HAVE_INTERNET_BANKING' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'referral_type_c', 'enum', false,'{/literal}{sugar_translate label='LBL_REFERRAL_TYPE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'name_of_existing_customer_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_NAME_OF_EXISTING_CUSTOMER' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'existing_mobile_number_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_EXISTING_MOBILE_NUMBER' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'bank_account_c', 'enum', false,'{/literal}{sugar_translate label='LBL_BANK_ACCOUNT' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'pan_card_c', 'enum', false,'{/literal}{sugar_translate label='LBL_PAN_CARD' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'interactions_age_c', 'int', false,'{/literal}{sugar_translate label='LBL_INTERACTIONS_AGE' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'first_time_investor_c', 'enum', false,'{/literal}{sugar_translate label='LBL_FIRST_TIME_INVESTOR' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'internet_banking_c', 'enum', false,'{/literal}{sugar_translate label='LBL_INTERNET_BANKING' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'investor_occupation_c', 'enum', false,'{/literal}{sugar_translate label='LBL_INVESTOR_OCCUPATION' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'interactions_income_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_INTERACTIONS_INCOME' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'no_of_attempts_c', 'int', false,'{/literal}{sugar_translate label='LBL_NO_OF_ATTEMPTS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'partner_comments_c', 'text', false,'{/literal}{sugar_translate label='LBL_PARTNER_COMMENTS' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'assistant_id_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_ASSISTANT_ID' module='Contacts' for_js=true}{literal}' );
addToValidate('form_QuickCreate_Contacts', 'justdial_category_c', 'varchar', false,'{/literal}{sugar_translate label='LBL_JUSTDIAL_CATEGORY' module='Contacts' for_js=true}{literal}' );
addToValidateBinaryDependency('form_QuickCreate_Contacts', 'assigned_user_name', 'alpha', false,'{/literal}{sugar_translate label='ERR_SQS_NO_MATCH_FIELD' module='Contacts' for_js=true}{literal}: {/literal}{sugar_translate label='LBL_ASSIGNED_TO' module='Contacts' for_js=true}{literal}', 'assigned_user_id' );
addToValidateBinaryDependency('form_QuickCreate_Contacts', 'account_name', 'alpha', false,'{/literal}{sugar_translate label='ERR_SQS_NO_MATCH_FIELD' module='Contacts' for_js=true}{literal}: {/literal}{sugar_translate label='LBL_ACCOUNT_NAME' module='Contacts' for_js=true}{literal}', 'account_id' );
</script><script language="javascript">if(typeof sqs_objects == 'undefined'){var sqs_objects = new Array;}sqs_objects['form_QuickCreate_Contacts_account_name']={"form":"form_QuickCreate_Contacts","method":"query","modules":["Accounts"],"group":"or","field_list":["name","id"],"populate_list":["form_QuickCreate_Contacts_account_name","account_id"],"conditions":[{"name":"name","op":"like_custom","end":"%","value":""}],"required_list":["account_id"],"order":"name","limit":"30","no_match_text":"No Match"};sqs_objects['form_QuickCreate_Contacts_assigned_user_name']={"form":"form_QuickCreate_Contacts","method":"get_user_array","field_list":["user_name","id"],"populate_list":["assigned_user_name","assigned_user_id"],"required_list":["assigned_user_id"],"conditions":[{"name":"user_name","op":"like_custom","end":"%","value":""}],"limit":"30","no_match_text":"No Match"};</script>{/literal}
