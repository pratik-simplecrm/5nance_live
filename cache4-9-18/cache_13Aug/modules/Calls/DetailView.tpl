

{if $fields.recurring_source.value != '' && $fields.recurring_source.value != 'Sugar'}
<div class="clear"></div>
<div class="error">{$MOD.LBL_SYNCED_RECURRING_MSG}</div>
{/if}

<script language="javascript">
{literal}
SUGAR.util.doWhen(function(){
    return $("#contentTable").length == 0;
}, SUGAR.themes.actionMenu);
{/literal}
</script>
<ul id="detail_header_action_menu" class="clickMenu fancymenu" ><li class="sugar_action_button" >{if $bean->aclAccess("edit")}<input title="{$APP.LBL_EDIT_BUTTON_TITLE}" accessKey="{$APP.LBL_EDIT_BUTTON_KEY}" class="button primary" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Calls'; _form.return_action.value='DetailView'; _form.return_id.value='{$id}'; _form.action.value='EditView';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Edit" id="edit_button" value="{$APP.LBL_EDIT_BUTTON_LABEL}">{/if} <ul id class="subnav" ><li>{if $bean->aclAccess("edit")}<input title="{$APP.LBL_DUPLICATE_BUTTON_TITLE}" accessKey="{$APP.LBL_DUPLICATE_BUTTON_KEY}" class="button" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Calls'; _form.return_action.value='DetailView'; _form.isDuplicate.value=true; _form.action.value='EditView'; _form.return_id.value='{$id}';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Duplicate" value="{$APP.LBL_DUPLICATE_BUTTON_LABEL}" id="duplicate_button">{/if} </li><li>{if $bean->aclAccess("delete")}<input title="{$APP.LBL_DELETE_BUTTON_TITLE}" accessKey="{$APP.LBL_DELETE_BUTTON_KEY}" class="button" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Calls'; _form.return_action.value='ListView'; _form.action.value='Delete'; if(confirm('{$APP.NTC_DELETE_CONFIRMATION}')) SUGAR.ajaxUI.submitForm(_form);" type="submit" name="Delete" value="{$APP.LBL_DELETE_BUTTON_LABEL}" id="delete_button">{/if} </li><li>{if $fields.status.value != "Held" && $bean->aclAccess("edit")}<input title="{$APP.LBL_CLOSE_AND_CREATE_BUTTON_TITLE}" class="button" onclick="var _form = document.getElementById('formDetailView');_form.isSaveFromDetailView.value=true; _form.status.value='Held'; _form.action.value='Save';_form.return_module.value='Calls';_form.isDuplicate.value=true;_form.isSaveAndNew.value=true;_form.return_action.value='EditView'; _form.return_id.value='{$fields.id.value}';_form.submit();" name="button" id="close_create_button" type="button" value="{$APP.LBL_CLOSE_AND_CREATE_BUTTON_TITLE}"/>{/if}</li><li>{if $fields.status.value != "Held" && $bean->aclAccess("edit")}<input title="{$APP.LBL_CLOSE_BUTTON_TITLE}" accesskey="{$APP.LBL_CLOSE_BUTTON_KEY}" class="button" onclick="var _form = document.getElementById('formDetailView');_form.status.value='Held'; _form.action.value='Save';_form.return_module.value='Calls';_form.isSave.value=true;_form.return_action.value='DetailView'; _form.return_id.value='{$fields.id.value}';_form.isSaveFromDetailView.value=true;_form.submit();" name="button1" id="close_button" type="button" value="{$APP.LBL_CLOSE_BUTTON_TITLE}"/>{/if}</li><li>{if $fields.status.value != "Held"}<input title="{$MOD.LBL_RESCHEDULE}" class="button" onclick="get_form();" name="Reschedule" id="reschedule_button" value="{$MOD.LBL_RESCHEDULE}" type="button"/>{/if}</li><li><input type="submit" class="button" name="create" id="create" value="Create Call" onClick="document.location='index.php?module=Calls&action=EditView&return_module=Calls&return_action=DetailView'"/></li><li>{if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=Calls", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}</li></ul></li></ul>
{$ADMIN_EDIT}
{$PAGINATION}
</div>
<form action="index.php" method="post" name="DetailView" id="formDetailView">
<input type="hidden" name="module" value="{$module}">
<input type="hidden" name="record" value="{$fields.id.value}">
<input type="hidden" name="return_action">
<input type="hidden" name="return_module">
<input type="hidden" name="return_id">
<input type="hidden" name="module_tab">
<input type="hidden" name="isDuplicate" value="false">
<input type="hidden" name="offset" value="{$offset}">
<input type="hidden" name="action" value="EditView">
<input type="hidden" name="sugar_body_only">
<input type="hidden" name="isSaveAndNew">
<input type="hidden" name="status">
<input type="hidden" name="isSaveFromDetailView">
<input type="hidden" name="isSave">
</form>{sugar_include include=$includes}
<div id="Calls_detailview_tabs"
class="yui-navset detailview_tabs"
>

<ul class="yui-nav">

<li><a id="tab0" href="javascript:void(0)"><em>{sugar_translate label='LBL_CALL_INFORMATION' module='Calls'}</em></a></li>

<li><a id="tab1" href="javascript:void(0)"><em>{sugar_translate label='LBL_RESCHEDULE_PANEL' module='Calls'}</em></a></li>

<li><a id="tab2" href="javascript:void(0)"><em>{sugar_translate label='LBL_PANEL_ASSIGNMENT' module='Calls'}</em></a></li>
</ul>
<div class="yui-content">
<div id='tabcontent0'>
<div id='detailpanel_1' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table id='LBL_CALL_INFORMATION' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SUBJECT' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="name" field="name" width='37.5%'  >
{if !$fields.name.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.name.value) <= 0}
{assign var="value" value=$fields.name.default_value }
{else}
{assign var="value" value=$fields.name.value }
{/if} 
<span class="sugar_field" id="{$fields.name.name}">{$fields.name.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.direction.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_STATUS' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="direction" width='37.5%'  >
{if !$fields.direction.hidden}
{counter name="panelFieldCount"}
<span id="direction" class="sugar_field">{$fields.direction.options[$fields.direction.value]} {$fields.status.options[$fields.status.value]}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.date_start.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DATE_TIME' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="datetimecombo" field="date_start" width='37.5%'  >
{if !$fields.date_start.hidden}
{counter name="panelFieldCount"}
<span id="date_start" class="sugar_field">{$fields.date_start.value} {$fields.time_start.value}&nbsp;</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.parent_name.hidden}
{sugar_translate label='LBL_MODULE_NAME' module=$fields.parent_type.value}
{/if}
</td>
<td class="inlineEdit" type="parent" field="parent_name" width='37.5%'  >
{if !$fields.parent_name.hidden}
{counter name="panelFieldCount"}

<input type="hidden" class="sugar_field" id="{$fields.parent_name.name}" value="{$fields.parent_name.value}">
<input type="hidden" class="sugar_field" id="parent_id" value="{$fields.parent_id.value}">
<a href="index.php?module={$fields.parent_type.value}&action=DetailView&record={$fields.parent_id.value}" class="tabDetailViewDFLink">{$fields.parent_name.value}</a>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.duration_hours.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DURATION' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="int" field="duration_hours" width='37.5%'  >
{if !$fields.duration_hours.hidden}
{counter name="panelFieldCount"}
<span id="duration_hours" class="sugar_field">{$fields.duration_hours.value}{$MOD.LBL_HOURS_ABBREV} {$fields.duration_minutes.value}{$MOD.LBL_MINSS_ABBREV}&nbsp;</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.reminder_time.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_REMINDER' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="reminder_time" width='37.5%'  >
{if !$fields.reminder_time.hidden}
{counter name="panelFieldCount"}
<span id="reminder_time" class="sugar_field">{include file="modules/Meetings/tpls/reminders.tpl"}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.non_office_menu_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_NON_OFFICE_MENU' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="non_office_menu_c" width='37.5%'  >
{if !$fields.non_office_menu_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.non_office_menu_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.non_office_menu_c.name}" value="{ $fields.non_office_menu_c.options }">
{ $fields.non_office_menu_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.non_office_menu_c.name}" value="{ $fields.non_office_menu_c.value }">
{ $fields.non_office_menu_c.options[$fields.non_office_menu_c.value]}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.language_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_LANGUAGE' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="" type="enum" field="language_c" width='37.5%'  >
{if !$fields.language_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.language_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.language_c.name}" value="{ $fields.language_c.options }">
{ $fields.language_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.language_c.name}" value="{ $fields.language_c.value }">
{ $fields.language_c.options[$fields.language_c.value]}
{/if}
{/if}
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.recordingfileurl_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_RECORDINGFILEURL' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="" type="url" field="recordingfileurl_c" width='37.5%'  >
{if !$fields.recordingfileurl_c.hidden}
{counter name="panelFieldCount"}

{capture name=getLink assign=link}{$fields.recordingfileurl_c.value}{/capture}
{if !empty($link)}
{capture name=getStart assign=linkStart}{$link|substr:0:7}{/capture}
<span class="sugar_field" id="{$fields.recordingfileurl_c.name}">
<a href='{$link|to_url}' target='_self' >{$link}</a>
</span>
{/if}
{/if}
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.talktime_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_TALKTIME' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="" type="int" field="talktime_c" width='37.5%'  >
{if !$fields.talktime_c.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.talktime_c.name}">
{sugar_number_format precision=0 var=$fields.talktime_c.value}
</span>
{/if}
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.description.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DESCRIPTION' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="text" field="description" width='37.5%' colspan='3' >
{if !$fields.description.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.description.name|escape:'html'|url2html|nl2br}">{$fields.description.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.assigned_user_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ASSIGNED_TO' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="relate" field="assigned_user_name" width='37.5%'  >
{if !$fields.assigned_user_name.hidden}
{counter name="panelFieldCount"}
<span id="assigned_user_name" class="sugar_field">{$fields.assigned_user_name.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.created_by_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CREATED' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="" type="relate" field="created_by_name" width='37.5%'  >
{if !$fields.created_by_name.hidden}
{counter name="panelFieldCount"}

<span id="created_by" class="sugar_field" data-id-value="{$fields.created_by.value}">{$fields.created_by_name.value}</span>
{/if}
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.scrm_products_activities_1_calls_name.hidden}
&nbsp;
{/if}
</td>
<td class="inlineEdit" type="" field="" width='37.5%' colspan='3' >
{if !$fields.scrm_products_activities_1_calls_name.hidden}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_CALL_INFORMATION").style.display='none';</script>
{/if}
</div>    <div id='tabcontent1'>
<div id='detailpanel_2' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table id='LBL_RESCHEDULE_PANEL' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.reschedule_history.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_RESCHEDULE_HISTORY' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="reschedule_history" width='37.5%' colspan='3' >
{if !$fields.reschedule_history.hidden}
{counter name="panelFieldCount"}
<span id='reschedule_history_span'>
{$fields.reschedule_history.value}
</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_RESCHEDULE_PANEL").style.display='none';</script>
{/if}
</div>    <div id='tabcontent2'>
<div id='detailpanel_3' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table id='LBL_PANEL_ASSIGNMENT' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.date_entered.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DATE_ENTERED' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="" type="datetime" field="date_entered" width='37.5%'  >
{if !$fields.date_entered.hidden}
{counter name="panelFieldCount"}
<span id="date_entered" class="sugar_field">{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}&nbsp;</span>
{/if}
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.date_modified.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DATE_MODIFIED' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="" type="datetime" field="date_modified" width='37.5%'  >
{if !$fields.date_modified.hidden}
{counter name="panelFieldCount"}
<span id="date_modified" class="sugar_field">{$fields.date_modified.value} {$APP.LBL_BY} {$fields.modified_by_name.value}&nbsp;</span>
{/if}
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.customerid_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CUSTOMERID' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="customerid_c" width='37.5%'  >
{if !$fields.customerid_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.customerid_c.value) <= 0}
{assign var="value" value=$fields.customerid_c.default_value }
{else}
{assign var="value" value=$fields.customerid_c.value }
{/if} 
<span class="sugar_field" id="{$fields.customerid_c.name}">{$fields.customerid_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.callid_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CALLID' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="" type="varchar" field="callid_c" width='37.5%'  >
{if !$fields.callid_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.callid_c.value) <= 0}
{assign var="value" value=$fields.callid_c.default_value }
{else}
{assign var="value" value=$fields.callid_c.value }
{/if} 
<span class="sugar_field" id="{$fields.callid_c.name}">{$fields.callid_c.value}</span>
{/if}
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.ivrtime_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_IVRTIME' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="" type="int" field="ivrtime_c" width='37.5%'  >
{if !$fields.ivrtime_c.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.ivrtime_c.name}">
{sugar_number_format precision=0 var=$fields.ivrtime_c.value}
</span>
{/if}
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.ringingtime_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_RINGINGTIME' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="int" field="ringingtime_c" width='37.5%'  >
{if !$fields.ringingtime_c.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.ringingtime_c.name}">
{sugar_number_format precision=0 var=$fields.ringingtime_c.value}
</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.calltype_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CALLTYPE' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="" type="enum" field="calltype_c" width='37.5%'  >
{if !$fields.calltype_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.calltype_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.calltype_c.name}" value="{ $fields.calltype_c.options }">
{ $fields.calltype_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.calltype_c.name}" value="{ $fields.calltype_c.value }">
{ $fields.calltype_c.options[$fields.calltype_c.value]}
{/if}
{/if}
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.dispositioncode_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DISPOSITIONCODE' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="" type="enum" field="dispositioncode_c" width='37.5%'  >
{if !$fields.dispositioncode_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.dispositioncode_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.dispositioncode_c.name}" value="{ $fields.dispositioncode_c.options }">
{ $fields.dispositioncode_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.dispositioncode_c.name}" value="{ $fields.dispositioncode_c.value }">
{ $fields.dispositioncode_c.options[$fields.dispositioncode_c.value]}
{/if}
{/if}
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.dstphone_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DSTPHONE' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="phone" field="dstphone_c" width='37.5%'  class="phone">
{if !$fields.dstphone_c.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.dstphone_c.value)}
{assign var="phone_value" value=$fields.dstphone_c.value }
{sugar_phone value=$phone_value usa_format="0"}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.srcphone_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SRCPHONE' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="srcphone_c" width='37.5%'  >
{if !$fields.srcphone_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.srcphone_c.value) <= 0}
{assign var="value" value=$fields.srcphone_c.default_value }
{else}
{assign var="value" value=$fields.srcphone_c.value }
{/if} 
<span class="sugar_field" id="{$fields.srcphone_c.name}">{$fields.srcphone_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.campaignid_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CAMPAIGNID' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="" type="enum" field="campaignid_c" width='37.5%'  >
{if !$fields.campaignid_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.campaignid_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.campaignid_c.name}" value="{ $fields.campaignid_c.options }">
{ $fields.campaignid_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.campaignid_c.name}" value="{ $fields.campaignid_c.value }">
{ $fields.campaignid_c.options[$fields.campaignid_c.value]}
{/if}
{/if}
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.phone_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PHONE' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="" type="phone" field="phone_c" width='37.5%'  class="phone">
{if !$fields.phone_c.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.phone_c.value)}
{assign var="phone_value" value=$fields.phone_c.value }
{sugar_phone value=$phone_value usa_format="0"}
{/if}
{/if}
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.asterisk_caller_id_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ASTERISK_CALLER_ID' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="asterisk_caller_id_c" width='37.5%'  >
{if !$fields.asterisk_caller_id_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.asterisk_caller_id_c.value) <= 0}
{assign var="value" value=$fields.asterisk_caller_id_c.default_value }
{else}
{assign var="value" value=$fields.asterisk_caller_id_c.value }
{/if} 
<span class="sugar_field" id="{$fields.asterisk_caller_id_c.name}">{$fields.asterisk_caller_id_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.crtobjectid_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CRTOBJECTID' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="crtobjectid_c" width='37.5%'  >
{if !$fields.crtobjectid_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.crtobjectid_c.value) <= 0}
{assign var="value" value=$fields.crtobjectid_c.default_value }
{else}
{assign var="value" value=$fields.crtobjectid_c.value }
{/if} 
<span class="sugar_field" id="{$fields.crtobjectid_c.name}">{$fields.crtobjectid_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.linkclicked_date_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_LINKCLICKED_DATE' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="date" field="linkclicked_date_c" width='37.5%'  >
{if !$fields.linkclicked_date_c.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.linkclicked_date_c.value) <= 0}
{assign var="value" value=$fields.linkclicked_date_c.default_value }
{else}
{assign var="value" value=$fields.linkclicked_date_c.value }
{/if}
<span class="sugar_field" id="{$fields.linkclicked_date_c.name}">{$value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.registration_date_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_REGISTRATION_DATE' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="date" field="registration_date_c" width='37.5%'  >
{if !$fields.registration_date_c.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.registration_date_c.value) <= 0}
{assign var="value" value=$fields.registration_date_c.default_value }
{else}
{assign var="value" value=$fields.registration_date_c.value }
{/if}
<span class="sugar_field" id="{$fields.registration_date_c.name}">{$value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.dispositionclass_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DISPOSITIONCLASS' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="" type="varchar" field="dispositionclass_c" width='37.5%'  >
{if !$fields.dispositionclass_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.dispositionclass_c.value) <= 0}
{assign var="value" value=$fields.dispositionclass_c.default_value }
{else}
{assign var="value" value=$fields.dispositionclass_c.value }
{/if} 
<span class="sugar_field" id="{$fields.dispositionclass_c.name}">{$fields.dispositionclass_c.value}</span>
{/if}
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.systemdisposition_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SYSTEMDISPOSITION' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="" type="varchar" field="systemdisposition_c" width='37.5%'  >
{if !$fields.systemdisposition_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.systemdisposition_c.value) <= 0}
{assign var="value" value=$fields.systemdisposition_c.default_value }
{else}
{assign var="value" value=$fields.systemdisposition_c.value }
{/if} 
<span class="sugar_field" id="{$fields.systemdisposition_c.name}">{$fields.systemdisposition_c.value}</span>
{/if}
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.setuptime_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SETUPTIME' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="" type="int" field="setuptime_c" width='37.5%' colspan='3' >
{if !$fields.setuptime_c.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.setuptime_c.name}">
{sugar_number_format precision=0 var=$fields.setuptime_c.value}
</span>
{/if}
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.reminders.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_REMINDERS' module='Calls'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="function" field="reminders" width='37.5%' colspan='3' >
{if !$fields.reminders.hidden}
{counter name="panelFieldCount"}
<span id='reminders_span'>
{$fields.reminders.value}
</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_PANEL_ASSIGNMENT").style.display='none';</script>
{/if}
</div>
</div>
</div>

</form>
<script>SUGAR.util.doWhen("document.getElementById('form') != null",
function(){ldelim}SUGAR.util.buildAccessKeyLabels();{rdelim});
</script><script type='text/javascript' src='{sugar_getjspath file='include/javascript/popup_helper.js'}'></script>
<script type="text/javascript" src="{sugar_getjspath file='cache/include/javascript/sugar_grp_yui_widgets.js'}"></script>
<script type="text/javascript">
var Calls_detailview_tabs = new YAHOO.widget.TabView("Calls_detailview_tabs");
Calls_detailview_tabs.selectTab(0);
</script>
<script type="text/javascript" src="include/InlineEditing/inlineEditing.js"></script>
<script type="text/javascript" src="modules/Favorites/favorites.js"></script>