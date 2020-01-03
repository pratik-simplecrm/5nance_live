


<script language="javascript">
{literal}
SUGAR.util.doWhen(function(){
    return $("#contentTable").length == 0;
}, SUGAR.themes.actionMenu);
{/literal}
</script>
<ul id="detail_header_action_menu" class="clickMenu fancymenu" ><li class="sugar_action_button" >{if $bean->aclAccess("edit")}<input title="{$APP.LBL_EDIT_BUTTON_TITLE}" accessKey="{$APP.LBL_EDIT_BUTTON_KEY}" class="button primary" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Leads'; _form.return_action.value='DetailView'; _form.return_id.value='{$id}'; _form.action.value='EditView';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Edit" id="edit_button" value="{$APP.LBL_EDIT_BUTTON_LABEL}">{/if} <ul id class="subnav" ><li>{if $bean->aclAccess("edit")}<input title="{$APP.LBL_DUPLICATE_BUTTON_TITLE}" accessKey="{$APP.LBL_DUPLICATE_BUTTON_KEY}" class="button" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Leads'; _form.return_action.value='DetailView'; _form.isDuplicate.value=true; _form.action.value='EditView'; _form.return_id.value='{$id}';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Duplicate" value="{$APP.LBL_DUPLICATE_BUTTON_LABEL}" id="duplicate_button">{/if} </li><li>{if $bean->aclAccess("delete")}<input title="{$APP.LBL_DELETE_BUTTON_TITLE}" accessKey="{$APP.LBL_DELETE_BUTTON_KEY}" class="button" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Leads'; _form.return_action.value='ListView'; _form.action.value='Delete'; if(confirm('{$APP.NTC_DELETE_CONFIRMATION}')) SUGAR.ajaxUI.submitForm(_form);" type="submit" name="Delete" value="{$APP.LBL_DELETE_BUTTON_LABEL}" id="delete_button">{/if} </li><li>{if $bean->aclAccess("edit") && $bean->aclAccess("delete")}<input title="{$APP.LBL_DUP_MERGE}" class="button" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Leads'; _form.return_action.value='DetailView'; _form.return_id.value='{$id}'; _form.action.value='Step1'; _form.module.value='MergeRecords';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Merge" value="{$APP.LBL_DUP_MERGE}" id="merge_duplicate_button">{/if} </li><li>{if $bean->aclAccess("edit") && !$DISABLE_CONVERT_ACTION}<input title="{$MOD.LBL_CONVERTLEAD_TITLE}" accessKey="{$MOD.LBL_CONVERTLEAD_BUTTON_KEY}" class="button" onClick="document.location='index.php?module=Leads&action=ConvertLead&record={$fields.id.value}'" name="convert" id="convert_lead_button" type="button" value="{$MOD.LBL_CONVERTLEAD}"/>{/if}</li><li><input title="{$APP.LBL_MANAGE_SUBSCRIPTIONS}" class="button" id="manage_subscriptions_button" onclick="var _form = document.getElementById('formDetailView');_form.return_module.value='Leads'; _form.return_action.value='DetailView';_form.return_id.value='{$fields.id.value}'; _form.action.value='Subscriptions'; _form.module.value='Campaigns'; _form.module_tab.value='Leads';_form.submit();" name="{$APP.LBL_MANAGE_SUBSCRIPTIONS}" type="button" value="{$APP.LBL_MANAGE_SUBSCRIPTIONS}"/></li><li><input title="{$APP.LBL_VCARD}" class="button" id="btn_vCardButton" onclick="var _form = document.getElementById('formDetailView');_form.return_module.value='Leads'; _form.return_action.value='DetailView';_form.return_id.value='{$fields.id.value}'; _form.action.value='vCard'; _form.module_tab.value='Leads';_form.submit();" name="{$APP.LBL_VCARD}" type="button" value="Download vCard"/></li><li><input type="button" class="button" onClick="showPopup();" value="{$APP.LBL_GENERATE_LETTER}"/></li><li><input type="submit" class="button" name="create" id="create" value="Create Lead" onClick="document.location='index.php?module=Leads&action=EditView&return_module=Leads&return_action=DetailView'"/></li><li>{if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=Leads", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}</li></ul></li></ul>
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
</form>{assign var=preForm value="<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td><table width='100%'><tr><td>"}
{assign var=displayPreform value=false}
{if isset($bean->contact_id) && !empty($bean->contact_id)}
{assign var=displayPreform value=true}
{assign var=preForm value=$preForm|cat:$MOD.LBL_CONVERTED_CONTACT}
{assign var=preForm value=$preForm|cat:"&nbsp;<a href='index.php?module=Contacts&action=DetailView&record="}
{assign var=preForm value=$preForm|cat:$bean->contact_id}
{assign var=preForm value=$preForm|cat:"'>"}
{assign var=preForm value=$preForm|cat:$bean->contact_name}
{assign var=preForm value=$preForm|cat:"</a>"}
{/if}
{assign var=preForm value=$preForm|cat:"</td><td>"}
{if isset($bean->account_id) && !empty($bean->account_id)}
{assign var=displayPreform value=true}
{assign var=preForm value=$preForm|cat:$MOD.LBL_CONVERTED_ACCOUNT}
{assign var=preForm value=$preForm|cat:"&nbsp;<a href='index.php?module=Accounts&action=DetailView&record="}
{assign var=preForm value=$preForm|cat:$bean->account_id}
{assign var=preForm value=$preForm|cat:"'>"}
{assign var=preForm value=$preForm|cat:$bean->account_name}
{assign var=preForm value=$preForm|cat:"</a>"}
{/if}
{assign var=preForm value=$preForm|cat:"</td><td>"}
{if isset($bean->opportunity_id) && !empty($bean->opportunity_id)}
{assign var=displayPreform value=true}
{assign var=preForm value=$preForm|cat:$MOD.LBL_CONVERTED_OPP}
{assign var=preForm value=$preForm|cat:"&nbsp;<a href='index.php?module=Opportunities&action=DetailView&record="}
{assign var=preForm value=$preForm|cat:$bean->opportunity_id}
{assign var=preForm value=$preForm|cat:"'>"}
{assign var=preForm value=$preForm|cat:$bean->opportunity_name}
{assign var=preForm value=$preForm|cat:"</a>"}
{/if}
{assign var=preForm value=$preForm|cat:"</td></tr></table></td></tr></table>"}
{if $displayPreform}
{$preForm}
<br>
{/if}
{sugar_include include=$includes}
<div id="Leads_detailview_tabs"
class="yui-navset detailview_tabs"
>

<ul class="yui-nav">

<li><a id="tab0" href="javascript:void(0)"><em>{sugar_translate label='LBL_CONTACT_INFORMATION' module='Leads'}</em></a></li>




</ul>
<div class="yui-content">
<div id='tabcontent0'>
<div id='detailpanel_1' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table id='LBL_CONTACT_INFORMATION' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.first_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FIRST_NAME' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="first_name" width='37.5%'  >
{if !$fields.first_name.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.first_name.value) <= 0}
{assign var="value" value=$fields.first_name.default_value }
{else}
{assign var="value" value=$fields.first_name.value }
{/if} 
<span class="sugar_field" id="{$fields.first_name.name}">{$fields.first_name.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.middle_name_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_MIDDLE_NAME' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="middle_name_c" width='37.5%'  >
{if !$fields.middle_name_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.middle_name_c.value) <= 0}
{assign var="value" value=$fields.middle_name_c.default_value }
{else}
{assign var="value" value=$fields.middle_name_c.value }
{/if} 
<span class="sugar_field" id="{$fields.middle_name_c.name}">{$fields.middle_name_c.value}</span>
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
{if !$fields.last_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_LAST_NAME' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="last_name" width='37.5%'  >
{if !$fields.last_name.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.last_name.value) <= 0}
{assign var="value" value=$fields.last_name.default_value }
{else}
{assign var="value" value=$fields.last_name.value }
{/if} 
<span class="sugar_field" id="{$fields.last_name.name}">{$fields.last_name.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.phone_mobile.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_MOBILE_PHONE' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="phone" field="phone_mobile" width='37.5%'  class="phone">
{if !$fields.phone_mobile.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.phone_mobile.value)}
{assign var="phone_value" value=$fields.phone_mobile.value }
{sugar_phone value=$phone_value usa_format="0"}
{/if}
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
{if !$fields.email1.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EMAIL_ADDRESS' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="email1" width='37.5%'  >
{if !$fields.email1.hidden}
{counter name="panelFieldCount"}
<span id='email1_span'>
{$fields.email1.value}
</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.accept_status_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_LIST_ACCEPT_STATUS' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="accept_status_name" width='37.5%'  >
{if !$fields.accept_status_name.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.accept_status_name.options)}
<input type="hidden" class="sugar_field" id="{$fields.accept_status_name.name}" value="{ $fields.accept_status_name.options }">
{ $fields.accept_status_name.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.accept_status_name.name}" value="{ $fields.accept_status_name.value }">
{ $fields.accept_status_name.options[$fields.accept_status_name.value]}
{/if}
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
{if !$fields.source_of_income_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ SOURCE_OF_INCOME' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="source_of_income_c" width='37.5%'  >
{if !$fields.source_of_income_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.source_of_income_c.value) <= 0}
{assign var="value" value=$fields.source_of_income_c.default_value }
{else}
{assign var="value" value=$fields.source_of_income_c.value }
{/if} 
<span class="sugar_field" id="{$fields.source_of_income_c.name}">{$fields.source_of_income_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.authorize_to_call_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_AUTHORIZE_TO_CALL ' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="authorize_to_call_c" width='37.5%'  >
{if !$fields.authorize_to_call_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.authorize_to_call_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.authorize_to_call_c.name}" value="{ $fields.authorize_to_call_c.options }">
{ $fields.authorize_to_call_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.authorize_to_call_c.name}" value="{ $fields.authorize_to_call_c.value }">
{ $fields.authorize_to_call_c.options[$fields.authorize_to_call_c.value]}
{/if}
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
{if !$fields.source_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SOURCE' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="source_c" width='37.5%'  >
{if !$fields.source_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.source_c.value) <= 0}
{assign var="value" value=$fields.source_c.default_value }
{else}
{assign var="value" value=$fields.source_c.value }
{/if} 
<span class="sugar_field" id="{$fields.source_c.name}">{$fields.source_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.q_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_Q' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="q_c" width='37.5%'  >
{if !$fields.q_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.q_c.value) <= 0}
{assign var="value" value=$fields.q_c.default_value }
{else}
{assign var="value" value=$fields.q_c.value }
{/if} 
<span class="sugar_field" id="{$fields.q_c.name}">{$fields.q_c.value}</span>
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
<script>document.getElementById("LBL_CONTACT_INFORMATION").style.display='none';</script>
{/if}
<div id='detailpanel_2' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<h4>
<a href="javascript:void(0)" class="collapseLink" onclick="collapsePanel(2);">
<img border="0" id="detailpanel_2_img_hide" src="{sugar_getimagepath file="basic_search.gif"}"></a>
<a href="javascript:void(0)" class="expandLink" onclick="expandPanel(2);">
<img border="0" id="detailpanel_2_img_show" src="{sugar_getimagepath file="advanced_search.gif"}"></a>
{sugar_translate label='LBL_EDITVIEW_PANEL3' module='Leads'}
<script>
document.getElementById('detailpanel_2').className += ' expanded';
</script>
</h4>
<table id='LBL_EDITVIEW_PANEL3' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.status.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_STATUS' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="status" width='37.5%'  >
{if !$fields.status.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.status.options)}
<input type="hidden" class="sugar_field" id="{$fields.status.name}" value="{ $fields.status.options }">
{ $fields.status.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.status.name}" value="{ $fields.status.value }">
{ $fields.status.options[$fields.status.value]}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.disposition_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DISPOSITION' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="dynamicenum" field="disposition_c" width='37.5%'  >
{if !$fields.disposition_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.disposition_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.disposition_c.name}" value="{ $fields.disposition_c.options }">
{ $fields.disposition_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.disposition_c.name}" value="{ $fields.disposition_c.value }">
{ $fields.disposition_c.options[$fields.disposition_c.value]}
{/if}
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
{if !$fields.remarks_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_REMARKS' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="text" field="remarks_c" width='37.5%'  >
{if !$fields.remarks_c.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.remarks_c.name|escape:'html'|url2html|nl2br}">{$fields.remarks_c.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
&nbsp;
</td>
<td class="inlineEdit" type="" field="" width='37.5%'  >
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
{if !$fields.next_call_planning_date_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_NEXT_CALL_PLANNING_DATE' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="datetimecombo" field="next_call_planning_date_c" width='37.5%'  >
{if !$fields.next_call_planning_date_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.next_call_planning_date_c.value) <= 0}
{assign var="value" value=$fields.next_call_planning_date_c.default_value }
{else}
{assign var="value" value=$fields.next_call_planning_date_c.value }
{/if} 
<span class="sugar_field" id="{$fields.next_call_planning_date_c.name}">{$fields.next_call_planning_date_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.next_call_planning_comment_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_NEXT_CALL_PLANNING_COMMENT' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="text" field="next_call_planning_comment_c" width='37.5%'  >
{if !$fields.next_call_planning_comment_c.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.next_call_planning_comment_c.name|escape:'html'|url2html|nl2br}">{$fields.next_call_planning_comment_c.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
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
{if !$fields.gateway_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_GATEWAY' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="gateway_c" width='37.5%'  >
{if !$fields.gateway_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.gateway_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.gateway_c.name}" value="{ $fields.gateway_c.options }">
{ $fields.gateway_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.gateway_c.name}" value="{ $fields.gateway_c.value }">
{ $fields.gateway_c.options[$fields.gateway_c.value]}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.justdial_category_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_JUSTDIAL_CATEGORY' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="justdial_category_c" width='37.5%'  >
{if !$fields.justdial_category_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.justdial_category_c.value) <= 0}
{assign var="value" value=$fields.justdial_category_c.default_value }
{else}
{assign var="value" value=$fields.justdial_category_c.value }
{/if} 
<span class="sugar_field" id="{$fields.justdial_category_c.name}">{$fields.justdial_category_c.value}</span>
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
{if !$fields.related_kiosk_account_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_RELATED_KIOSK_ACCOUNT' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="related_kiosk_account_c" width='37.5%'  >
{if !$fields.related_kiosk_account_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.related_kiosk_account_c.value) <= 0}
{assign var="value" value=$fields.related_kiosk_account_c.default_value }
{else}
{assign var="value" value=$fields.related_kiosk_account_c.value }
{/if} 
<span class="sugar_field" id="{$fields.related_kiosk_account_c.name}">{$fields.related_kiosk_account_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.encrypted_otp_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ENCRYPTED_OTP' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="encrypted_otp_c" width='37.5%'  >
{if !$fields.encrypted_otp_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.encrypted_otp_c.value) <= 0}
{assign var="value" value=$fields.encrypted_otp_c.default_value }
{else}
{assign var="value" value=$fields.encrypted_otp_c.value }
{/if} 
<span class="sugar_field" id="{$fields.encrypted_otp_c.name}">{$fields.encrypted_otp_c.value}</span>
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
{if !$fields.accounts_leads_1_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ACCOUNTS_LEADS_1_FROM_ACCOUNTS_TITLE' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="relate" field="accounts_leads_1_name" width='37.5%' colspan='3' >
{if !$fields.accounts_leads_1_name.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.accounts_leads_1accounts_ida.value)}
{capture assign="detail_url"}index.php?module=Accounts&action=DetailView&record={$fields.accounts_leads_1accounts_ida.value}{/capture}
<a href="{sugar_ajax_url url=$detail_url}">{/if}
<span id="accounts_leads_1accounts_ida" class="sugar_field" data-id-value="{$fields.accounts_leads_1accounts_ida.value}">{$fields.accounts_leads_1_name.value}</span>
{if !empty($fields.accounts_leads_1accounts_ida.value)}</a>{/if}
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
{if !$fields.otp_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_OTP' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="otp_c" width='37.5%'  >
{if !$fields.otp_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.otp_c.value) <= 0}
{assign var="value" value=$fields.otp_c.default_value }
{else}
{assign var="value" value=$fields.otp_c.value }
{/if} 
<span class="sugar_field" id="{$fields.otp_c.name}">{$fields.otp_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.city_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CITY' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="city_c" width='37.5%'  >
{if !$fields.city_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.city_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.city_c.name}" value="{ $fields.city_c.options }">
{ $fields.city_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.city_c.name}" value="{ $fields.city_c.value }">
{ $fields.city_c.options[$fields.city_c.value]}
{/if}
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
{if !$fields.campaign_type_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CAMPAIGN_TYPE' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="campaign_type_c" width='37.5%'  >
{if !$fields.campaign_type_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.campaign_type_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.campaign_type_c.name}" value="{ $fields.campaign_type_c.options }">
{ $fields.campaign_type_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.campaign_type_c.name}" value="{ $fields.campaign_type_c.value }">
{ $fields.campaign_type_c.options[$fields.campaign_type_c.value]}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.campaign_sub_type_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CAMPAIGN_SUB_TYPE' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="campaign_sub_type_c" width='37.5%'  >
{if !$fields.campaign_sub_type_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.campaign_sub_type_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.campaign_sub_type_c.name}" value="{ $fields.campaign_sub_type_c.options }">
{ $fields.campaign_sub_type_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.campaign_sub_type_c.name}" value="{ $fields.campaign_sub_type_c.value }">
{ $fields.campaign_sub_type_c.options[$fields.campaign_sub_type_c.value]}
{/if}
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
{if !$fields.refered_by.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_REFERED_BY' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="refered_by" width='37.5%' colspan='3' >
{if !$fields.refered_by.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.refered_by.value) <= 0}
{assign var="value" value=$fields.refered_by.default_value }
{else}
{assign var="value" value=$fields.refered_by.value }
{/if} 
<span class="sugar_field" id="{$fields.refered_by.name}">{$fields.refered_by.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
</table>
<script type="text/javascript">SUGAR.util.doWhen("typeof initPanel == 'function'", function() {ldelim} initPanel(2, 'expanded'); {rdelim}); </script>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_EDITVIEW_PANEL3").style.display='none';</script>
{/if}
<div id='detailpanel_3' class='detail view  detail508 collapsed'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<h4>
<a href="javascript:void(0)" class="collapseLink" onclick="collapsePanel(3);">
<img border="0" id="detailpanel_3_img_hide" src="{sugar_getimagepath file="basic_search.gif"}"></a>
<a href="javascript:void(0)" class="expandLink" onclick="expandPanel(3);">
<img border="0" id="detailpanel_3_img_show" src="{sugar_getimagepath file="advanced_search.gif"}"></a>
{sugar_translate label='LBL_EDITVIEW_PANEL4' module='Leads'}
<script>
document.getElementById('detailpanel_3').className += ' collapsed';
</script>
</h4>
<table id='LBL_EDITVIEW_PANEL4' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.first_call_date_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FIRST_CALL_DATE' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="datetimecombo" field="first_call_date_c" width='37.5%'  >
{if !$fields.first_call_date_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.first_call_date_c.value) <= 0}
{assign var="value" value=$fields.first_call_date_c.default_value }
{else}
{assign var="value" value=$fields.first_call_date_c.value }
{/if} 
<span class="sugar_field" id="{$fields.first_call_date_c.name}">{$fields.first_call_date_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.first_call_disposition_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FIRST_CALL_DISPOSITION' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="first_call_disposition_c" width='37.5%'  >
{if !$fields.first_call_disposition_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.first_call_disposition_c.value) <= 0}
{assign var="value" value=$fields.first_call_disposition_c.default_value }
{else}
{assign var="value" value=$fields.first_call_disposition_c.value }
{/if} 
<span class="sugar_field" id="{$fields.first_call_disposition_c.name}">{$fields.first_call_disposition_c.value}</span>
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
{if !$fields.second_call_date_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SECOND_CALL_DATE' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="datetimecombo" field="second_call_date_c" width='37.5%'  >
{if !$fields.second_call_date_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.second_call_date_c.value) <= 0}
{assign var="value" value=$fields.second_call_date_c.default_value }
{else}
{assign var="value" value=$fields.second_call_date_c.value }
{/if} 
<span class="sugar_field" id="{$fields.second_call_date_c.name}">{$fields.second_call_date_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.second_call_disposition_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SECOND_CALL_DISPOSITION' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="second_call_disposition_c" width='37.5%'  >
{if !$fields.second_call_disposition_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.second_call_disposition_c.value) <= 0}
{assign var="value" value=$fields.second_call_disposition_c.default_value }
{else}
{assign var="value" value=$fields.second_call_disposition_c.value }
{/if} 
<span class="sugar_field" id="{$fields.second_call_disposition_c.name}">{$fields.second_call_disposition_c.value}</span>
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
{if !$fields.third_call_date_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_THIRD_CALL_DATE' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="datetimecombo" field="third_call_date_c" width='37.5%'  >
{if !$fields.third_call_date_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.third_call_date_c.value) <= 0}
{assign var="value" value=$fields.third_call_date_c.default_value }
{else}
{assign var="value" value=$fields.third_call_date_c.value }
{/if} 
<span class="sugar_field" id="{$fields.third_call_date_c.name}">{$fields.third_call_date_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.third_call_disposition_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_THIRD_CALL_DISPOSITION' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="third_call_disposition_c" width='37.5%'  >
{if !$fields.third_call_disposition_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.third_call_disposition_c.value) <= 0}
{assign var="value" value=$fields.third_call_disposition_c.default_value }
{else}
{assign var="value" value=$fields.third_call_disposition_c.value }
{/if} 
<span class="sugar_field" id="{$fields.third_call_disposition_c.name}">{$fields.third_call_disposition_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
</table>
<script type="text/javascript">SUGAR.util.doWhen("typeof initPanel == 'function'", function() {ldelim} initPanel(3, 'collapsed'); {rdelim}); </script>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_EDITVIEW_PANEL4").style.display='none';</script>
{/if}
<div id='detailpanel_4' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<h4>
<a href="javascript:void(0)" class="collapseLink" onclick="collapsePanel(4);">
<img border="0" id="detailpanel_4_img_hide" src="{sugar_getimagepath file="basic_search.gif"}"></a>
<a href="javascript:void(0)" class="expandLink" onclick="expandPanel(4);">
<img border="0" id="detailpanel_4_img_show" src="{sugar_getimagepath file="advanced_search.gif"}"></a>
{sugar_translate label='LBL_EDITVIEW_PANEL5' module='Leads'}
<script>
document.getElementById('detailpanel_4').className += ' expanded';
</script>
</h4>
<table id='LBL_EDITVIEW_PANEL5' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.product_interest_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PRODUCT_INTEREST' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="multienum" field="product_interest_c" width='37.5%'  >
{if !$fields.product_interest_c.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.product_interest_c.value) && ($fields.product_interest_c.value != '^^')}
<input type="hidden" class="sugar_field" id="{$fields.product_interest_c.name}" value="{$fields.product_interest_c.value}">
{multienum_to_array string=$fields.product_interest_c.value assign="vals"}
{foreach from=$vals item=item}
<li style="margin-left:10px;">{ $fields.product_interest_c.options.$item }</li>
{/foreach}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.product_sub_interest_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PRODUCT_SUB_INTEREST' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="multienum" field="product_sub_interest_c" width='37.5%'  >
{if !$fields.product_sub_interest_c.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.product_sub_interest_c.value) && ($fields.product_sub_interest_c.value != '^^')}
<input type="hidden" class="sugar_field" id="{$fields.product_sub_interest_c.name}" value="{$fields.product_sub_interest_c.value}">
{multienum_to_array string=$fields.product_sub_interest_c.value assign="vals"}
{foreach from=$vals item=item}
<li style="margin-left:10px;">{ $fields.product_sub_interest_c.options.$item }</li>
{/foreach}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
</table>
<script type="text/javascript">SUGAR.util.doWhen("typeof initPanel == 'function'", function() {ldelim} initPanel(4, 'expanded'); {rdelim}); </script>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_EDITVIEW_PANEL5").style.display='none';</script>
{/if}
<div id='detailpanel_5' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<h4>
<a href="javascript:void(0)" class="collapseLink" onclick="collapsePanel(5);">
<img border="0" id="detailpanel_5_img_hide" src="{sugar_getimagepath file="basic_search.gif"}"></a>
<a href="javascript:void(0)" class="expandLink" onclick="expandPanel(5);">
<img border="0" id="detailpanel_5_img_show" src="{sugar_getimagepath file="advanced_search.gif"}"></a>
{sugar_translate label='LBL_PANEL_ASSIGNMENT' module='Leads'}
<script>
document.getElementById('detailpanel_5').className += ' expanded';
</script>
</h4>
<table id='LBL_PANEL_ASSIGNMENT' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.age_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_AGE' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="int" field="age_c" width='37.5%' colspan='3' >
{if !$fields.age_c.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.age_c.name}">
{sugar_number_format precision=0 var=$fields.age_c.value}
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
{if !$fields.state_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_STATE' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="state_c" width='37.5%'  >
{if !$fields.state_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.state_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.state_c.name}" value="{ $fields.state_c.options }">
{ $fields.state_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.state_c.name}" value="{ $fields.state_c.value }">
{ $fields.state_c.options[$fields.state_c.value]}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.city_dependent_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CITY_DEPENDENT' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="dynamicenum" field="city_dependent_c" width='37.5%'  >
{if !$fields.city_dependent_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.city_dependent_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.city_dependent_c.name}" value="{ $fields.city_dependent_c.options }">
{ $fields.city_dependent_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.city_dependent_c.name}" value="{ $fields.city_dependent_c.value }">
{ $fields.city_dependent_c.options[$fields.city_dependent_c.value]}
{/if}
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
{if !$fields.description.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DESCRIPTION' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="text" field="description" width='37.5%'  >
{if !$fields.description.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.description.name|escape:'html'|url2html|nl2br}">{$fields.description.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.campaign_city_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CAMPAIGN_CITY' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="campaign_city_c" width='37.5%'  >
{if !$fields.campaign_city_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.campaign_city_c.value) <= 0}
{assign var="value" value=$fields.campaign_city_c.default_value }
{else}
{assign var="value" value=$fields.campaign_city_c.value }
{/if} 
<span class="sugar_field" id="{$fields.campaign_city_c.name}">{$fields.campaign_city_c.value}</span>
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
{if !$fields.annual_income_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ANNUAL_INCOME' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="annual_income_c" width='37.5%'  >
{if !$fields.annual_income_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.annual_income_c.name}'>
{sugar_number_format var=$fields.annual_income_c.value }
</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.assigned_user_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ASSIGNED_TO' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="relate" field="assigned_user_name" width='37.5%'  >
{if !$fields.assigned_user_name.hidden}
{counter name="panelFieldCount"}

<span id="assigned_user_id" class="sugar_field" data-id-value="{$fields.assigned_user_id.value}">{$fields.assigned_user_name.value}</span>
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
{if !$fields.monthly_income_details_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_MONTHLY_INCOME_DETAILS' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="monthly_income_details_c" width='37.5%'  >
{if !$fields.monthly_income_details_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.monthly_income_details_c.name}'>
{sugar_number_format var=$fields.monthly_income_details_c.value }
</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.profession_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PROFESSION' module='Leads'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="profession_c" width='37.5%'  >
{if !$fields.profession_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.profession_c.value) <= 0}
{assign var="value" value=$fields.profession_c.default_value }
{else}
{assign var="value" value=$fields.profession_c.value }
{/if} 
<span class="sugar_field" id="{$fields.profession_c.name}">{$fields.profession_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
</tr>
{/capture}
{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
{$tableRow}
{/if}
</table>
<script type="text/javascript">SUGAR.util.doWhen("typeof initPanel == 'function'", function() {ldelim} initPanel(5, 'expanded'); {rdelim}); </script>
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
var Leads_detailview_tabs = new YAHOO.widget.TabView("Leads_detailview_tabs");
Leads_detailview_tabs.selectTab(0);
</script>
<script type="text/javascript" src="include/InlineEditing/inlineEditing.js"></script>
<script type="text/javascript" src="modules/Favorites/favorites.js"></script>