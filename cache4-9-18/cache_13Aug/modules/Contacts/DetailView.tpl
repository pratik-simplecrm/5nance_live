

<script language="javascript">
{literal}
SUGAR.util.doWhen(function(){
    return $("#contentTable").length == 0;
}, SUGAR.themes.actionMenu);
{/literal}
</script>
<ul id="detail_header_action_menu" class="clickMenu fancymenu" ><li class="sugar_action_button" >{if $bean->aclAccess("edit")}<input title="{$APP.LBL_EDIT_BUTTON_TITLE}" accessKey="{$APP.LBL_EDIT_BUTTON_KEY}" class="button primary" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Contacts'; _form.return_action.value='DetailView'; _form.return_id.value='{$id}'; _form.action.value='EditView';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Edit" id="edit_button" value="{$APP.LBL_EDIT_BUTTON_LABEL}">{/if} <ul id class="subnav" ><li>{if $bean->aclAccess("edit")}<input title="{$APP.LBL_DUPLICATE_BUTTON_TITLE}" accessKey="{$APP.LBL_DUPLICATE_BUTTON_KEY}" class="button" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Contacts'; _form.return_action.value='DetailView'; _form.isDuplicate.value=true; _form.action.value='EditView'; _form.return_id.value='{$id}';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Duplicate" value="{$APP.LBL_DUPLICATE_BUTTON_LABEL}" id="duplicate_button">{/if} </li><li>{if $bean->aclAccess("delete")}<input title="{$APP.LBL_DELETE_BUTTON_TITLE}" accessKey="{$APP.LBL_DELETE_BUTTON_KEY}" class="button" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Contacts'; _form.return_action.value='ListView'; _form.action.value='Delete'; if(confirm('{$APP.NTC_DELETE_CONFIRMATION}')) SUGAR.ajaxUI.submitForm(_form);" type="submit" name="Delete" value="{$APP.LBL_DELETE_BUTTON_LABEL}" id="delete_button">{/if} </li><li>{if $bean->aclAccess("edit") && $bean->aclAccess("delete")}<input title="{$APP.LBL_DUP_MERGE}" class="button" onclick="var _form = document.getElementById('formDetailView'); _form.return_module.value='Contacts'; _form.return_action.value='DetailView'; _form.return_id.value='{$id}'; _form.action.value='Step1'; _form.module.value='MergeRecords';SUGAR.ajaxUI.submitForm(_form);" type="button" name="Merge" value="{$APP.LBL_DUP_MERGE}" id="merge_duplicate_button">{/if} </li><li><input class="button" id="manage_subscriptions_button" title="{$APP.LBL_MANAGE_SUBSCRIPTIONS}" onclick="var _form = document.getElementById('formDetailView');_form.return_module.value='Contacts'; _form.return_action.value='DetailView'; _form.return_id.value='{$fields.id.value}'; _form.action.value='Subscriptions'; _form.module.value='Campaigns'; _form.module_tab.value='Contacts';_form.submit();" name="Manage Subscriptions" type="button" value="{$APP.LBL_MANAGE_SUBSCRIPTIONS}"/></li><li><input type="button" class="button" onClick="showPopup();" value="{$APP.LBL_GENERATE_LETTER}"/></li><li>{if !$fields.joomla_account_id.value && $AOP_PORTAL_ENABLED}<input title="{$MOD.LBL_CREATE_PORTAL_USER}" class="button" onclick="var _form = document.getElementById('formDetailView');_form.action.value='createPortalUser';_form.submit();" name="buttonCreatePortalUser" id="createPortalUser_button" type="button" value="{$MOD.LBL_CREATE_PORTAL_USER}"/>{/if}</li><li>{if $fields.joomla_account_id.value && !$fields.portal_account_disabled.value && $AOP_PORTAL_ENABLED}<input title="{$MOD.LBL_DISABLE_PORTAL_USER}" class="button" onclick="var _form = document.getElementById('formDetailView');_form.action.value='disablePortalUser';_form.submit();" name="buttonDisablePortalUser" id="disablePortalUser_button" type="button" value="{$MOD.LBL_DISABLE_PORTAL_USER}"/>{/if}</li><li>{if $fields.joomla_account_id.value && $fields.portal_account_disabled.value && $AOP_PORTAL_ENABLED}<input title="{$MOD.LBL_ENABLE_PORTAL_USER}" class="button" onclick="var _form = document.getElementById('formDetailView');_form.action.value='enablePortalUser';_form.submit();" name="buttonENablePortalUser" id="enablePortalUser_button" type="button" value="{$MOD.LBL_ENABLE_PORTAL_USER}"/>{/if}</li><li><input type="submit" class="button" 
name="create" id="create" value="Create Contact" onClick="document.location='index.php?module=Contacts&action=EditView&return_module=Contacts&return_action=DetailView'"/></li><li>{if $bean->aclAccess("detail")}{if !empty($fields.id.value) && $isAuditEnabled}<input id="btn_view_change_log" title="{$APP.LNK_VIEW_CHANGE_LOG}" class="button" onclick='open_popup("Audit", "600", "400", "&record={$fields.id.value}&module_name=Contacts", true, false,  {ldelim} "call_back_function":"set_return","form_name":"EditView","field_to_name_array":[] {rdelim} ); return false;' type="button" value="{$APP.LNK_VIEW_CHANGE_LOG}">{/if}{/if}</li></ul></li></ul>
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
</form>{sugar_include include=$includes}
<div id="Contacts_detailview_tabs"
class="yui-navset detailview_tabs"
>

<ul class="yui-nav">

<li><a id="tab0" href="javascript:void(0)"><em>{sugar_translate label='LBL_CONTACT_INFORMATION' module='Contacts'}</em></a></li>


<li><a id="tab1" href="javascript:void(0)"><em>{sugar_translate label='LBL_EDITVIEW_PANEL1' module='Contacts'}</em></a></li>

<li><a id="tab2" href="javascript:void(0)"><em>{sugar_translate label='LBL_EDITVIEW_PANEL2' module='Contacts'}</em></a></li>

<li><a id="tab3" href="javascript:void(0)"><em>{sugar_translate label='LBL_PANEL_ADVANCED' module='Contacts'}</em></a></li>

<li><a id="tab4" href="javascript:void(0)"><em>{sugar_translate label='LBL_EDITVIEW_PANEL3' module='Contacts'}</em></a></li>

<li><a id="tab5" href="javascript:void(0)"><em>{sugar_translate label='LBL_EDITVIEW_PANEL4' module='Contacts'}</em></a></li>

<li><a id="tab6" href="javascript:void(0)"><em>{sugar_translate label='LBL_EDITVIEW_PANEL5' module='Contacts'}</em></a></li>




<li><a id="tab7" href="javascript:void(0)"><em>{sugar_translate label='LBL_EDITVIEW_PANEL9' module='Contacts'}</em></a></li>

<li><a id="tab8" href="javascript:void(0)"><em>{sugar_translate label='LBL_EDITVIEW_PANEL10' module='Contacts'}</em></a></li>
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
{capture name="label" assign="label"}{sugar_translate label='LBL_FIRST_NAME' module='Contacts'}{/capture}
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
{capture name="label" assign="label"}{sugar_translate label='LBL_MIDDLE_NAME' module='Contacts'}{/capture}
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
{capture name="label" assign="label"}{sugar_translate label='LBL_LAST_NAME' module='Contacts'}{/capture}
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
{if !$fields.unique_customer_code_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_UNIQUE_CUSTOMER_CODE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="unique_customer_code_c" width='37.5%'  >
{if !$fields.unique_customer_code_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.unique_customer_code_c.value) <= 0}
{assign var="value" value=$fields.unique_customer_code_c.default_value }
{else}
{assign var="value" value=$fields.unique_customer_code_c.value }
{/if} 
<span class="sugar_field" id="{$fields.unique_customer_code_c.name}">{$fields.unique_customer_code_c.value}</span>
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
{capture name="label" assign="label"}{sugar_translate label='LBL_EMAIL_ADDRESS' module='Contacts'}{/capture}
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
{if !$fields.is_email_verified_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_IS_EMAIL_VERIFIED' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="is_email_verified_c" width='37.5%'  >
{if !$fields.is_email_verified_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.is_email_verified_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.is_email_verified_c.name}" value="{ $fields.is_email_verified_c.options }">
{ $fields.is_email_verified_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.is_email_verified_c.name}" value="{ $fields.is_email_verified_c.value }">
{ $fields.is_email_verified_c.options[$fields.is_email_verified_c.value]}
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
{if !$fields.phone_mobile.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_MOBILE_PHONE' module='Contacts'}{/capture}
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
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.is_mobile_number_verified_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_IS_MOBILE_NUMBER_VERIFIED' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="is_mobile_number_verified_c" width='37.5%'  >
{if !$fields.is_mobile_number_verified_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.is_mobile_number_verified_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.is_mobile_number_verified_c.name}" value="{ $fields.is_mobile_number_verified_c.options }">
{ $fields.is_mobile_number_verified_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.is_mobile_number_verified_c.name}" value="{ $fields.is_mobile_number_verified_c.value }">
{ $fields.is_mobile_number_verified_c.options[$fields.is_mobile_number_verified_c.value]}
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
{if !$fields.gender_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_GENDER' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="gender_c" width='37.5%'  >
{if !$fields.gender_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.gender_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.gender_c.name}" value="{ $fields.gender_c.options }">
{ $fields.gender_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.gender_c.name}" value="{ $fields.gender_c.value }">
{ $fields.gender_c.options[$fields.gender_c.value]}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.age_of_the_user_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_AGE_OF_THE_USER' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="int" field="age_of_the_user_c" width='37.5%'  >
{if !$fields.age_of_the_user_c.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.age_of_the_user_c.name}">
{sugar_number_format precision=0 var=$fields.age_of_the_user_c.value}
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
{if !$fields.application_no_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_APPLICATION_NO' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="application_no_c" width='37.5%' colspan='3' >
{if !$fields.application_no_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.application_no_c.value) <= 0}
{assign var="value" value=$fields.application_no_c.default_value }
{else}
{assign var="value" value=$fields.application_no_c.value }
{/if} 
<span class="sugar_field" id="{$fields.application_no_c.name}">{$fields.application_no_c.value}</span>
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
{if !$fields.aadharcard_no_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_AADHARCARD_NO' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="aadharcard_no_c" width='37.5%'  >
{if !$fields.aadharcard_no_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.aadharcard_no_c.value) <= 0}
{assign var="value" value=$fields.aadharcard_no_c.default_value }
{else}
{assign var="value" value=$fields.aadharcard_no_c.value }
{/if} 
<span class="sugar_field" id="{$fields.aadharcard_no_c.name}">{$fields.aadharcard_no_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.isminor_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ISMINOR' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="isminor_c" width='37.5%'  >
{if !$fields.isminor_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.isminor_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.isminor_c.name}" value="{ $fields.isminor_c.options }">
{ $fields.isminor_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.isminor_c.name}" value="{ $fields.isminor_c.value }">
{ $fields.isminor_c.options[$fields.isminor_c.value]}
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
{if !$fields.kyc_status_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_KYC_STATUS' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="kyc_status_c" width='37.5%'  >
{if !$fields.kyc_status_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.kyc_status_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.kyc_status_c.name}" value="{ $fields.kyc_status_c.options }">
{ $fields.kyc_status_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.kyc_status_c.name}" value="{ $fields.kyc_status_c.value }">
{ $fields.kyc_status_c.options[$fields.kyc_status_c.value]}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.language_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_LANGUAGE' module='Contacts'}{/capture}
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
{if !$fields.classification_accoun_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CLASSIFICATION_ACCOUN' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="classification_accoun_c" width='37.5%'  >
{if !$fields.classification_accoun_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.classification_accoun_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.classification_accoun_c.name}" value="{ $fields.classification_accoun_c.options }">
{ $fields.classification_accoun_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.classification_accoun_c.name}" value="{ $fields.classification_accoun_c.value }">
{ $fields.classification_accoun_c.options[$fields.classification_accoun_c.value]}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.dnc_status_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DNC_STATUS' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="dnc_status_c" width='37.5%'  >
{if !$fields.dnc_status_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.dnc_status_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.dnc_status_c.name}" value="{ $fields.dnc_status_c.options }">
{ $fields.dnc_status_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.dnc_status_c.name}" value="{ $fields.dnc_status_c.value }">
{ $fields.dnc_status_c.options[$fields.dnc_status_c.value]}
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
{if !$fields.facebook_id_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FACEBOOK_ID' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="facebook_id_c" width='37.5%'  >
{if !$fields.facebook_id_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.facebook_id_c.value) <= 0}
{assign var="value" value=$fields.facebook_id_c.default_value }
{else}
{assign var="value" value=$fields.facebook_id_c.value }
{/if} 
<span class="sugar_field" id="{$fields.facebook_id_c.name}">{$fields.facebook_id_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.twitter_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_TWITTER' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="twitter_c" width='37.5%'  >
{if !$fields.twitter_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.twitter_c.value) <= 0}
{assign var="value" value=$fields.twitter_c.default_value }
{else}
{assign var="value" value=$fields.twitter_c.value }
{/if} 
<span class="sugar_field" id="{$fields.twitter_c.name}">{$fields.twitter_c.value}</span>
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
{if !$fields.educational_details_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EDUCATIONAL_DETAILS' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="educational_details_c" width='37.5%'  >
{if !$fields.educational_details_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.educational_details_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.educational_details_c.name}" value="{ $fields.educational_details_c.options }">
{ $fields.educational_details_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.educational_details_c.name}" value="{ $fields.educational_details_c.value }">
{ $fields.educational_details_c.options[$fields.educational_details_c.value]}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.occupational_details_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_OCCUPATIONAL_DETAILS' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="occupational_details_c" width='37.5%'  >
{if !$fields.occupational_details_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.occupational_details_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.occupational_details_c.name}" value="{ $fields.occupational_details_c.options }">
{ $fields.occupational_details_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.occupational_details_c.name}" value="{ $fields.occupational_details_c.value }">
{ $fields.occupational_details_c.options[$fields.occupational_details_c.value]}
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
{if !$fields.total_employment_years_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_TOTAL_EMPLOYMENT_YEARS' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="total_employment_years_c" width='37.5%'  >
{if !$fields.total_employment_years_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.total_employment_years_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.total_employment_years_c.name}" value="{ $fields.total_employment_years_c.options }">
{ $fields.total_employment_years_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.total_employment_years_c.name}" value="{ $fields.total_employment_years_c.value }">
{ $fields.total_employment_years_c.options[$fields.total_employment_years_c.value]}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.current_company_details_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CURRENT_COMPANY_DETAILS' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="text" field="current_company_details_c" width='37.5%'  >
{if !$fields.current_company_details_c.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.current_company_details_c.name|escape:'html'|url2html|nl2br}">{$fields.current_company_details_c.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
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
{if !$fields.date_entered.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DATE_ENTERED' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="" type="datetime" field="date_entered" width='37.5%'  >
{if !$fields.date_entered.hidden}
{counter name="panelFieldCount"}
<span id="date_entered" class="sugar_field">{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}</span>
{/if}
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.investor_acct_creation_month_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_INVESTOR_ACCT_CREATION_MONTH' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="investor_acct_creation_month_c" width='37.5%'  >
{if !$fields.investor_acct_creation_month_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.investor_acct_creation_month_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.investor_acct_creation_month_c.name}" value="{ $fields.investor_acct_creation_month_c.options }">
{ $fields.investor_acct_creation_month_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.investor_acct_creation_month_c.name}" value="{ $fields.investor_acct_creation_month_c.value }">
{ $fields.investor_acct_creation_month_c.options[$fields.investor_acct_creation_month_c.value]}
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
{sugar_translate label='LBL_PANEL_ASSIGNMENT' module='Contacts'}
<script>
document.getElementById('detailpanel_2').className += ' expanded';
</script>
</h4>
<table id='LBL_PANEL_ASSIGNMENT' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.assigned_user_name.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ASSIGNED_TO_NAME' module='Contacts'}{/capture}
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
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.lead_source.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_LEAD_SOURCE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="lead_source" width='37.5%'  >
{if !$fields.lead_source.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.lead_source.options)}
<input type="hidden" class="sugar_field" id="{$fields.lead_source.name}" value="{ $fields.lead_source.options }">
{ $fields.lead_source.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.lead_source.name}" value="{ $fields.lead_source.value }">
{ $fields.lead_source.options[$fields.lead_source.value]}
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
<script type="text/javascript">SUGAR.util.doWhen("typeof initPanel == 'function'", function() {ldelim} initPanel(2, 'expanded'); {rdelim}); </script>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_PANEL_ASSIGNMENT").style.display='none';</script>
{/if}
</div>    <div id='tabcontent1'>
<div id='detailpanel_3' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table id='LBL_EDITVIEW_PANEL1' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.address_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ADDRESS' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="text" field="address_c" width='37.5%' colspan='3' >
{if !$fields.address_c.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.address_c.name|escape:'html'|url2html|nl2br}">{$fields.address_c.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
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
{if !$fields.country_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_COUNTRY' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="country_c" width='37.5%'  >
{if !$fields.country_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.country_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.country_c.name}" value="{ $fields.country_c.options }">
{ $fields.country_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.country_c.name}" value="{ $fields.country_c.value }">
{ $fields.country_c.options[$fields.country_c.value]}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.state_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_STATE' module='Contacts'}{/capture}
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
{if !$fields.city_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CITY' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="dynamicenum" field="city_c" width='37.5%'  >
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
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.postalcode_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_POSTALCODE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="dynamicenum" field="postalcode_c" width='37.5%'  >
{if !$fields.postalcode_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.postalcode_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.postalcode_c.name}" value="{ $fields.postalcode_c.options }">
{ $fields.postalcode_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.postalcode_c.name}" value="{ $fields.postalcode_c.value }">
{ $fields.postalcode_c.options[$fields.postalcode_c.value]}
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
{capture name="label" assign="label"}{sugar_translate label='LBL_CAMPAIGN_TYPE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="campaign_type_c" width='37.5%'  >
{if !$fields.campaign_type_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.campaign_type_c.value) <= 0}
{assign var="value" value=$fields.campaign_type_c.default_value }
{else}
{assign var="value" value=$fields.campaign_type_c.value }
{/if} 
<span class="sugar_field" id="{$fields.campaign_type_c.name}">{$fields.campaign_type_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.campaign_sub_type_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CAMPAIGN_SUB_TYPE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="campaign_sub_type_c" width='37.5%'  >
{if !$fields.campaign_sub_type_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.campaign_sub_type_c.value) <= 0}
{assign var="value" value=$fields.campaign_sub_type_c.default_value }
{else}
{assign var="value" value=$fields.campaign_sub_type_c.value }
{/if} 
<span class="sugar_field" id="{$fields.campaign_sub_type_c.name}">{$fields.campaign_sub_type_c.value}</span>
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
{capture name="label" assign="label"}{sugar_translate label='LBL_GATEWAY' module='Contacts'}{/capture}
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
{if !$fields.user_type_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_USER_TYPE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="user_type_c" width='37.5%'  >
{if !$fields.user_type_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.user_type_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.user_type_c.name}" value="{ $fields.user_type_c.options }">
{ $fields.user_type_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.user_type_c.name}" value="{ $fields.user_type_c.value }">
{ $fields.user_type_c.options[$fields.user_type_c.value]}
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
{if !$fields.publisher_id_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PUBLISHER_ID' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="publisher_id_c" width='37.5%'  >
{if !$fields.publisher_id_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.publisher_id_c.value) <= 0}
{assign var="value" value=$fields.publisher_id_c.default_value }
{else}
{assign var="value" value=$fields.publisher_id_c.value }
{/if} 
<span class="sugar_field" id="{$fields.publisher_id_c.name}">{$fields.publisher_id_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.publisher_name_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PUBLISHER_NAME' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="publisher_name_c" width='37.5%'  >
{if !$fields.publisher_name_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.publisher_name_c.value) <= 0}
{assign var="value" value=$fields.publisher_name_c.default_value }
{else}
{assign var="value" value=$fields.publisher_name_c.value }
{/if} 
<span class="sugar_field" id="{$fields.publisher_name_c.name}">{$fields.publisher_name_c.value}</span>
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
{if !$fields.related_corporate_account_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_RELATED_CORPORATE_ACCOUNT' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="related_corporate_account_c" width='37.5%'  >
{if !$fields.related_corporate_account_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.related_corporate_account_c.value) <= 0}
{assign var="value" value=$fields.related_corporate_account_c.default_value }
{else}
{assign var="value" value=$fields.related_corporate_account_c.value }
{/if} 
<span class="sugar_field" id="{$fields.related_corporate_account_c.name}">{$fields.related_corporate_account_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.related_kiosk_account_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_RELATED_KIOSK_ACCOUNT' module='Contacts'}{/capture}
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
{if !$fields.birthdate.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_BIRTHDATE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="date" field="birthdate" width='37.5%'  >
{if !$fields.birthdate.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.birthdate.value) <= 0}
{assign var="value" value=$fields.birthdate.default_value }
{else}
{assign var="value" value=$fields.birthdate.value }
{/if}
<span class="sugar_field" id="{$fields.birthdate.name}">{$value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.age_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_AGE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="int" field="age_c" width='37.5%'  >
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
{if !$fields.sales_person_tagging_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SALES_PERSON_TAGGING' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="sales_person_tagging_c" width='37.5%'  >
{if !$fields.sales_person_tagging_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.sales_person_tagging_c.value) <= 0}
{assign var="value" value=$fields.sales_person_tagging_c.default_value }
{else}
{assign var="value" value=$fields.sales_person_tagging_c.value }
{/if} 
<span class="sugar_field" id="{$fields.sales_person_tagging_c.name}">{$fields.sales_person_tagging_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.best_time_to_speak_to_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_BEST_TIME_TO_SPEAK_TO' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="datetimecombo" field="best_time_to_speak_to_c" width='37.5%'  >
{if !$fields.best_time_to_speak_to_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.best_time_to_speak_to_c.value) <= 0}
{assign var="value" value=$fields.best_time_to_speak_to_c.default_value }
{else}
{assign var="value" value=$fields.best_time_to_speak_to_c.value }
{/if} 
<span class="sugar_field" id="{$fields.best_time_to_speak_to_c.name}">{$fields.best_time_to_speak_to_c.value}</span>
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
{if !$fields.location_through_ip_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_LOCATION_THROUGH_IP' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="location_through_ip_c" width='37.5%'  >
{if !$fields.location_through_ip_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.location_through_ip_c.value) <= 0}
{assign var="value" value=$fields.location_through_ip_c.default_value }
{else}
{assign var="value" value=$fields.location_through_ip_c.value }
{/if} 
<span class="sugar_field" id="{$fields.location_through_ip_c.name}">{$fields.location_through_ip_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.qparam_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_QPARAM' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="qparam_c" width='37.5%'  >
{if !$fields.qparam_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.qparam_c.value) <= 0}
{assign var="value" value=$fields.qparam_c.default_value }
{else}
{assign var="value" value=$fields.qparam_c.value }
{/if} 
<span class="sugar_field" id="{$fields.qparam_c.name}">{$fields.qparam_c.value}</span>
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
<script>document.getElementById("LBL_EDITVIEW_PANEL1").style.display='none';</script>
{/if}
</div>    <div id='tabcontent2'>
<div id='detailpanel_4' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table id='LBL_EDITVIEW_PANEL2' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.adoption_percentage_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ADOPTION_PERCENTAGE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="decimal" field="adoption_percentage_c" width='37.5%'  >
{if !$fields.adoption_percentage_c.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.adoption_percentage_c.name}">
{sugar_number_format var=$fields.adoption_percentage_c.value precision=2 }
</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.historical_session_data_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_HISTORICAL_SESSION_DATA' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="historical_session_data_c" width='37.5%'  >
{if !$fields.historical_session_data_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.historical_session_data_c.value) <= 0}
{assign var="value" value=$fields.historical_session_data_c.default_value }
{else}
{assign var="value" value=$fields.historical_session_data_c.value }
{/if} 
<span class="sugar_field" id="{$fields.historical_session_data_c.name}">{$fields.historical_session_data_c.value}</span>
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
{if !$fields.online_activity_status_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ONLINE_ACTIVITY_STATUS' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="online_activity_status_c" width='37.5%'  >
{if !$fields.online_activity_status_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.online_activity_status_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.online_activity_status_c.name}" value="{ $fields.online_activity_status_c.options }">
{ $fields.online_activity_status_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.online_activity_status_c.name}" value="{ $fields.online_activity_status_c.value }">
{ $fields.online_activity_status_c.options[$fields.online_activity_status_c.value]}
{/if}
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
{if !$fields.product_interest_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PRODUCT_INTEREST' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="product_interest_c" width='37.5%'  >
{if !$fields.product_interest_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.product_interest_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.product_interest_c.name}" value="{ $fields.product_interest_c.options }">
{ $fields.product_interest_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.product_interest_c.name}" value="{ $fields.product_interest_c.value }">
{ $fields.product_interest_c.options[$fields.product_interest_c.value]}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.product_sub_type_interest_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PRODUCT_SUB_TYPE_INTEREST' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="product_sub_type_interest_c" width='37.5%'  >
{if !$fields.product_sub_type_interest_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.product_sub_type_interest_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.product_sub_type_interest_c.name}" value="{ $fields.product_sub_type_interest_c.options }">
{ $fields.product_sub_type_interest_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.product_sub_type_interest_c.name}" value="{ $fields.product_sub_type_interest_c.value }">
{ $fields.product_sub_type_interest_c.options[$fields.product_sub_type_interest_c.value]}
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
{if !$fields.payment_type_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PAYMENT_TYPE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="dynamicenum" field="payment_type_c" width='37.5%' colspan='3' >
{if !$fields.payment_type_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.payment_type_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.payment_type_c.name}" value="{ $fields.payment_type_c.options }">
{ $fields.payment_type_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.payment_type_c.name}" value="{ $fields.payment_type_c.value }">
{ $fields.payment_type_c.options[$fields.payment_type_c.value]}
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
{if !$fields.opportunity_value_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_OPPORTUNITY_VALUE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="opportunity_value_c" width='37.5%'  >
{if !$fields.opportunity_value_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.opportunity_value_c.name}'>
{sugar_number_format var=$fields.opportunity_value_c.value }
</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.opportunity_horizon_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_OPPORTUNITY_HORIZON' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="date" field="opportunity_horizon_c" width='37.5%'  >
{if !$fields.opportunity_horizon_c.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.opportunity_horizon_c.value) <= 0}
{assign var="value" value=$fields.opportunity_horizon_c.default_value }
{else}
{assign var="value" value=$fields.opportunity_horizon_c.value }
{/if}
<span class="sugar_field" id="{$fields.opportunity_horizon_c.name}">{$value}</span>
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
{if !$fields.investment_behaviour_segment_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_INVESTMENT_BEHAVIOUR_SEGMENT' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="investment_behaviour_segment_c" width='37.5%'  >
{if !$fields.investment_behaviour_segment_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.investment_behaviour_segment_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.investment_behaviour_segment_c.name}" value="{ $fields.investment_behaviour_segment_c.options }">
{ $fields.investment_behaviour_segment_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.investment_behaviour_segment_c.name}" value="{ $fields.investment_behaviour_segment_c.value }">
{ $fields.investment_behaviour_segment_c.options[$fields.investment_behaviour_segment_c.value]}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.no_of_attempts_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_NO_OF_ATTEMPTS' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="int" field="no_of_attempts_c" width='37.5%'  >
{if !$fields.no_of_attempts_c.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.no_of_attempts_c.name}">
{sugar_number_format precision=0 var=$fields.no_of_attempts_c.value}
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
{if !$fields.bank_account_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_BANK_ACCOUNT' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="bank_account_c" width='37.5%'  >
{if !$fields.bank_account_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.bank_account_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.bank_account_c.name}" value="{ $fields.bank_account_c.options }">
{ $fields.bank_account_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.bank_account_c.name}" value="{ $fields.bank_account_c.value }">
{ $fields.bank_account_c.options[$fields.bank_account_c.value]}
{/if}
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
{if !$fields.pan_card_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PAN_CARD' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="pan_card_c" width='37.5%'  >
{if !$fields.pan_card_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.pan_card_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.pan_card_c.name}" value="{ $fields.pan_card_c.options }">
{ $fields.pan_card_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.pan_card_c.name}" value="{ $fields.pan_card_c.value }">
{ $fields.pan_card_c.options[$fields.pan_card_c.value]}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.interactions_age_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_INTERACTIONS_AGE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="int" field="interactions_age_c" width='37.5%'  >
{if !$fields.interactions_age_c.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.interactions_age_c.name}">
{sugar_number_format precision=0 var=$fields.interactions_age_c.value}
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
{if !$fields.first_time_investor_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FIRST_TIME_INVESTOR' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="first_time_investor_c" width='37.5%'  >
{if !$fields.first_time_investor_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.first_time_investor_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.first_time_investor_c.name}" value="{ $fields.first_time_investor_c.options }">
{ $fields.first_time_investor_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.first_time_investor_c.name}" value="{ $fields.first_time_investor_c.value }">
{ $fields.first_time_investor_c.options[$fields.first_time_investor_c.value]}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.internet_banking_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_INTERNET_BANKING' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="internet_banking_c" width='37.5%'  >
{if !$fields.internet_banking_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.internet_banking_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.internet_banking_c.name}" value="{ $fields.internet_banking_c.options }">
{ $fields.internet_banking_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.internet_banking_c.name}" value="{ $fields.internet_banking_c.value }">
{ $fields.internet_banking_c.options[$fields.internet_banking_c.value]}
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
{if !$fields.investor_occupation_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_INVESTOR_OCCUPATION' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="investor_occupation_c" width='37.5%'  >
{if !$fields.investor_occupation_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.investor_occupation_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.investor_occupation_c.name}" value="{ $fields.investor_occupation_c.options }">
{ $fields.investor_occupation_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.investor_occupation_c.name}" value="{ $fields.investor_occupation_c.value }">
{ $fields.investor_occupation_c.options[$fields.investor_occupation_c.value]}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.interactions_income_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_INTERACTIONS_INCOME' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="interactions_income_c" width='37.5%'  >
{if !$fields.interactions_income_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.interactions_income_c.value) <= 0}
{assign var="value" value=$fields.interactions_income_c.default_value }
{else}
{assign var="value" value=$fields.interactions_income_c.value }
{/if} 
<span class="sugar_field" id="{$fields.interactions_income_c.name}">{$fields.interactions_income_c.value}</span>
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
{if !$fields.sales_stage_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SALES_STAGE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="sales_stage_c" width='37.5%'  >
{if !$fields.sales_stage_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.sales_stage_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.sales_stage_c.name}" value="{ $fields.sales_stage_c.options }">
{ $fields.sales_stage_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.sales_stage_c.name}" value="{ $fields.sales_stage_c.value }">
{ $fields.sales_stage_c.options[$fields.sales_stage_c.value]}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.disposition_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DISPOSITION' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="disposition_c" width='37.5%'  >
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
{if !$fields.next_call_planning_date_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_NEXT_CALL_PLANNING_DATE' module='Contacts'}{/capture}
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
{if !$fields.next_call_planning_comments_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_NEXT_CALL_PLANNING_COMMENTS' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="text" field="next_call_planning_comments_c" width='37.5%'  >
{if !$fields.next_call_planning_comments_c.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.next_call_planning_comments_c.name|escape:'html'|url2html|nl2br}">{$fields.next_call_planning_comments_c.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
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
{if !$fields.referral_type_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_REFERRAL_TYPE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="referral_type_c" width='37.5%'  >
{if !$fields.referral_type_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.referral_type_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.referral_type_c.name}" value="{ $fields.referral_type_c.options }">
{ $fields.referral_type_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.referral_type_c.name}" value="{ $fields.referral_type_c.value }">
{ $fields.referral_type_c.options[$fields.referral_type_c.value]}
{/if}
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
{if !$fields.name_of_existing_customer_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_NAME_OF_EXISTING_CUSTOMER' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="name_of_existing_customer_c" width='37.5%'  >
{if !$fields.name_of_existing_customer_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.name_of_existing_customer_c.value) <= 0}
{assign var="value" value=$fields.name_of_existing_customer_c.default_value }
{else}
{assign var="value" value=$fields.name_of_existing_customer_c.value }
{/if} 
<span class="sugar_field" id="{$fields.name_of_existing_customer_c.name}">{$fields.name_of_existing_customer_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.existing_mobile_number_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EXISTING_MOBILE_NUMBER' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="existing_mobile_number_c" width='37.5%'  >
{if !$fields.existing_mobile_number_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.existing_mobile_number_c.value) <= 0}
{assign var="value" value=$fields.existing_mobile_number_c.default_value }
{else}
{assign var="value" value=$fields.existing_mobile_number_c.value }
{/if} 
<span class="sugar_field" id="{$fields.existing_mobile_number_c.name}">{$fields.existing_mobile_number_c.value}</span>
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
{if !$fields.partner_comments_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PARTNER_COMMENTS' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="text" field="partner_comments_c" width='37.5%'  >
{if !$fields.partner_comments_c.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.partner_comments_c.name|escape:'html'|url2html|nl2br}">{$fields.partner_comments_c.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
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
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_EDITVIEW_PANEL2").style.display='none';</script>
{/if}
</div>    <div id='tabcontent3'>
<div id='detailpanel_5' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table id='LBL_PANEL_ADVANCED' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.annual_income_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ANNUAL_INCOME' module='Contacts'}{/capture}
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
{if !$fields.annual_expenses_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ANNUAL_EXPENSES' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="annual_expenses_c" width='37.5%'  >
{if !$fields.annual_expenses_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.annual_expenses_c.name}'>
{sugar_number_format var=$fields.annual_expenses_c.value }
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
{if !$fields.saving_potential_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SAVING_POTENTIAL' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="saving_potential_c" width='37.5%' colspan='3' >
{if !$fields.saving_potential_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.saving_potential_c.name}'>
{sugar_number_format var=$fields.saving_potential_c.value }
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
{if !$fields.financial_goals_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FINANCIAL_GOALS' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="multienum" field="financial_goals_c" width='37.5%'  >
{if !$fields.financial_goals_c.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.financial_goals_c.value) && ($fields.financial_goals_c.value != '^^')}
<input type="hidden" class="sugar_field" id="{$fields.financial_goals_c.name}" value="{$fields.financial_goals_c.value}">
{multienum_to_array string=$fields.financial_goals_c.value assign="vals"}
{foreach from=$vals item=item}
<li style="margin-left:10px;">{ $fields.financial_goals_c.options.$item }</li>
{/foreach}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.exisiting_investments_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EXISITING_INVESTMENTS' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="multienum" field="exisiting_investments_c" width='37.5%'  >
{if !$fields.exisiting_investments_c.hidden}
{counter name="panelFieldCount"}

{if !empty($fields.exisiting_investments_c.value) && ($fields.exisiting_investments_c.value != '^^')}
<input type="hidden" class="sugar_field" id="{$fields.exisiting_investments_c.name}" value="{$fields.exisiting_investments_c.value}">
{multienum_to_array string=$fields.exisiting_investments_c.value assign="vals"}
{foreach from=$vals item=item}
<li style="margin-left:10px;">{ $fields.exisiting_investments_c.options.$item }</li>
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
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.existing_investment_mf_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EXISTING_INVESTMENT_MF' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="existing_investment_mf_c" width='37.5%'  >
{if !$fields.existing_investment_mf_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.existing_investment_mf_c.name}'>
{sugar_number_format var=$fields.existing_investment_mf_c.value }
</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.existing_investment_equity_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EXISTING_INVESTMENT_EQUITY' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="existing_investment_equity_c" width='37.5%'  >
{if !$fields.existing_investment_equity_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.existing_investment_equity_c.name}'>
{sugar_number_format var=$fields.existing_investment_equity_c.value }
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
{if !$fields.existing_investment_gold_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EXISTING_INVESTMENT_GOLD' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="existing_investment_gold_c" width='37.5%'  >
{if !$fields.existing_investment_gold_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.existing_investment_gold_c.name}'>
{sugar_number_format var=$fields.existing_investment_gold_c.value }
</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.existing_investment_re_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EXISTING_INVESTMENT_RE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="existing_investment_re_c" width='37.5%'  >
{if !$fields.existing_investment_re_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.existing_investment_re_c.name}'>
{sugar_number_format var=$fields.existing_investment_re_c.value }
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
{if !$fields.existing_investment_silver_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EXISTING_INVESTMENT_SILVER' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="existing_investment_silver_c" width='37.5%'  >
{if !$fields.existing_investment_silver_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.existing_investment_silver_c.name}'>
{sugar_number_format var=$fields.existing_investment_silver_c.value }
</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.existing_investments_bonds_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EXISTING_INVESTMENTS_BONDS' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="existing_investments_bonds_c" width='37.5%'  >
{if !$fields.existing_investments_bonds_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.existing_investments_bonds_c.name}'>
{sugar_number_format var=$fields.existing_investments_bonds_c.value }
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
{if !$fields.existing_investments_deposit_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EXISTING_INVESTMENTS_DEPOSIT' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="existing_investments_deposit_c" width='37.5%'  >
{if !$fields.existing_investments_deposit_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.existing_investments_deposit_c.name}'>
{sugar_number_format var=$fields.existing_investments_deposit_c.value }
</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.prior_invesment_value_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PRIOR_INVESMENT_VALUE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="prior_invesment_value_c" width='37.5%'  >
{if !$fields.prior_invesment_value_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.prior_invesment_value_c.name}'>
{sugar_number_format var=$fields.prior_invesment_value_c.value }
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
{if !$fields.tax_planning_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_TAX_PLANNING' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="tax_planning_c" width='37.5%'  >
{if !$fields.tax_planning_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.tax_planning_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.tax_planning_c.name}" value="{ $fields.tax_planning_c.options }">
{ $fields.tax_planning_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.tax_planning_c.name}" value="{ $fields.tax_planning_c.value }">
{ $fields.tax_planning_c.options[$fields.tax_planning_c.value]}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.investment_in_80c_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_INVESTMENT_IN_80C' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="investment_in_80c_c" width='37.5%'  >
{if !$fields.investment_in_80c_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.investment_in_80c_c.value) <= 0}
{assign var="value" value=$fields.investment_in_80c_c.default_value }
{else}
{assign var="value" value=$fields.investment_in_80c_c.value }
{/if} 
<span class="sugar_field" id="{$fields.investment_in_80c_c.name}">{$fields.investment_in_80c_c.value}</span>
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
{if !$fields.investment_in_80d_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_INVESTMENT_IN_80D' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="investment_in_80d_c" width='37.5%'  >
{if !$fields.investment_in_80d_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.investment_in_80d_c.value) <= 0}
{assign var="value" value=$fields.investment_in_80d_c.default_value }
{else}
{assign var="value" value=$fields.investment_in_80d_c.value }
{/if} 
<span class="sugar_field" id="{$fields.investment_in_80d_c.name}">{$fields.investment_in_80d_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.life_stage_profiling_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_LIFE_STAGE_PROFILING' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="life_stage_profiling_c" width='37.5%'  >
{if !$fields.life_stage_profiling_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.life_stage_profiling_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.life_stage_profiling_c.name}" value="{ $fields.life_stage_profiling_c.options }">
{ $fields.life_stage_profiling_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.life_stage_profiling_c.name}" value="{ $fields.life_stage_profiling_c.value }">
{ $fields.life_stage_profiling_c.options[$fields.life_stage_profiling_c.value]}
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
{if !$fields.existing_insurance_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EXISTING_INSURANCE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="existing_insurance_c" width='37.5%'  >
{if !$fields.existing_insurance_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.existing_insurance_c.value) <= 0}
{assign var="value" value=$fields.existing_insurance_c.default_value }
{else}
{assign var="value" value=$fields.existing_insurance_c.value }
{/if} 
<span class="sugar_field" id="{$fields.existing_insurance_c.name}">{$fields.existing_insurance_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.first_transaction_date_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FIRST_TRANSACTION_DATE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="date" field="first_transaction_date_c" width='37.5%'  >
{if !$fields.first_transaction_date_c.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.first_transaction_date_c.value) <= 0}
{assign var="value" value=$fields.first_transaction_date_c.default_value }
{else}
{assign var="value" value=$fields.first_transaction_date_c.value }
{/if}
<span class="sugar_field" id="{$fields.first_transaction_date_c.name}">{$value}</span>
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
{if !$fields.family_members_number_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FAMILY_MEMBERS_NUMBER' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="family_members_number_c" width='37.5%' colspan='3' >
{if !$fields.family_members_number_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.family_members_number_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.family_members_number_c.name}" value="{ $fields.family_members_number_c.options }">
{ $fields.family_members_number_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.family_members_number_c.name}" value="{ $fields.family_members_number_c.value }">
{ $fields.family_members_number_c.options[$fields.family_members_number_c.value]}
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
{if !$fields.no_of_adults_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_NO_OF_ADULTS' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="no_of_adults_c" width='37.5%'  >
{if !$fields.no_of_adults_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.no_of_adults_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.no_of_adults_c.name}" value="{ $fields.no_of_adults_c.options }">
{ $fields.no_of_adults_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.no_of_adults_c.name}" value="{ $fields.no_of_adults_c.value }">
{ $fields.no_of_adults_c.options[$fields.no_of_adults_c.value]}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.no_of_children_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_NO_OF_CHILDREN' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="no_of_children_c" width='37.5%'  >
{if !$fields.no_of_children_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.no_of_children_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.no_of_children_c.name}" value="{ $fields.no_of_children_c.options }">
{ $fields.no_of_children_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.no_of_children_c.name}" value="{ $fields.no_of_children_c.value }">
{ $fields.no_of_children_c.options[$fields.no_of_children_c.value]}
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
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_PANEL_ADVANCED").style.display='none';</script>
{/if}
</div>    <div id='tabcontent4'>
<div id='detailpanel_6' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table id='LBL_EDITVIEW_PANEL3' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.risk_profiling_questions_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_RISK_PROFILING_QUESTIONS' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="text" field="risk_profiling_questions_c" width='37.5%'  >
{if !$fields.risk_profiling_questions_c.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.risk_profiling_questions_c.name|escape:'html'|url2html|nl2br}">{$fields.risk_profiling_questions_c.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.courier_request_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_COURIER_REQUEST' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="date" field="courier_request_c" width='37.5%'  >
{if !$fields.courier_request_c.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.courier_request_c.value) <= 0}
{assign var="value" value=$fields.courier_request_c.default_value }
{else}
{assign var="value" value=$fields.courier_request_c.value }
{/if}
<span class="sugar_field" id="{$fields.courier_request_c.name}">{$value}</span>
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
{if !$fields.risk_profile_id_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_RISK_PROFILE_ID' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="risk_profile_id_c" width='37.5%'  >
{if !$fields.risk_profile_id_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.risk_profile_id_c.value) <= 0}
{assign var="value" value=$fields.risk_profile_id_c.default_value }
{else}
{assign var="value" value=$fields.risk_profile_id_c.value }
{/if} 
<span class="sugar_field" id="{$fields.risk_profile_id_c.name}">{$fields.risk_profile_id_c.value}</span>
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
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_EDITVIEW_PANEL3").style.display='none';</script>
{/if}
</div>    <div id='tabcontent5'>
<div id='detailpanel_7' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table id='LBL_EDITVIEW_PANEL4' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.lead_generation_date_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_LEAD_GENERATION_DATE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="datetimecombo" field="lead_generation_date_c" width='37.5%'  >
{if !$fields.lead_generation_date_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.lead_generation_date_c.value) <= 0}
{assign var="value" value=$fields.lead_generation_date_c.default_value }
{else}
{assign var="value" value=$fields.lead_generation_date_c.value }
{/if} 
<span class="sugar_field" id="{$fields.lead_generation_date_c.name}">{$fields.lead_generation_date_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.validation_exe_assigned_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_VALIDATION_EXE_ASSIGNED' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="validation_exe_assigned_c" width='37.5%'  >
{if !$fields.validation_exe_assigned_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.validation_exe_assigned_c.value) <= 0}
{assign var="value" value=$fields.validation_exe_assigned_c.default_value }
{else}
{assign var="value" value=$fields.validation_exe_assigned_c.value }
{/if} 
<span class="sugar_field" id="{$fields.validation_exe_assigned_c.name}">{$fields.validation_exe_assigned_c.value}</span>
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
{if !$fields.date_of_first_call_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DATE_OF_FIRST_CALL' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="datetimecombo" field="date_of_first_call_c" width='37.5%'  >
{if !$fields.date_of_first_call_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.date_of_first_call_c.value) <= 0}
{assign var="value" value=$fields.date_of_first_call_c.default_value }
{else}
{assign var="value" value=$fields.date_of_first_call_c.value }
{/if} 
<span class="sugar_field" id="{$fields.date_of_first_call_c.name}">{$fields.date_of_first_call_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.status_of_first_call_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_STATUS_OF_FIRST_CALL' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="status_of_first_call_c" width='37.5%'  >
{if !$fields.status_of_first_call_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.status_of_first_call_c.value) <= 0}
{assign var="value" value=$fields.status_of_first_call_c.default_value }
{else}
{assign var="value" value=$fields.status_of_first_call_c.value }
{/if} 
<span class="sugar_field" id="{$fields.status_of_first_call_c.name}">{$fields.status_of_first_call_c.value}</span>
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
{if !$fields.date_of_second_call_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DATE_OF_SECOND_CALL' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="datetimecombo" field="date_of_second_call_c" width='37.5%'  >
{if !$fields.date_of_second_call_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.date_of_second_call_c.value) <= 0}
{assign var="value" value=$fields.date_of_second_call_c.default_value }
{else}
{assign var="value" value=$fields.date_of_second_call_c.value }
{/if} 
<span class="sugar_field" id="{$fields.date_of_second_call_c.name}">{$fields.date_of_second_call_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.status_of_second_call_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_STATUS_OF_SECOND_CALL' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="status_of_second_call_c" width='37.5%'  >
{if !$fields.status_of_second_call_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.status_of_second_call_c.value) <= 0}
{assign var="value" value=$fields.status_of_second_call_c.default_value }
{else}
{assign var="value" value=$fields.status_of_second_call_c.value }
{/if} 
<span class="sugar_field" id="{$fields.status_of_second_call_c.name}">{$fields.status_of_second_call_c.value}</span>
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
{if !$fields.date_of_third_call_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DATE_OF_THIRD_CALL' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="datetimecombo" field="date_of_third_call_c" width='37.5%'  >
{if !$fields.date_of_third_call_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.date_of_third_call_c.value) <= 0}
{assign var="value" value=$fields.date_of_third_call_c.default_value }
{else}
{assign var="value" value=$fields.date_of_third_call_c.value }
{/if} 
<span class="sugar_field" id="{$fields.date_of_third_call_c.name}">{$fields.date_of_third_call_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.status_of_third_call_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_STATUS_OF_THIRD_CALL' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="status_of_third_call_c" width='37.5%'  >
{if !$fields.status_of_third_call_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.status_of_third_call_c.value) <= 0}
{assign var="value" value=$fields.status_of_third_call_c.default_value }
{else}
{assign var="value" value=$fields.status_of_third_call_c.value }
{/if} 
<span class="sugar_field" id="{$fields.status_of_third_call_c.name}">{$fields.status_of_third_call_c.value}</span>
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
{if !$fields.date_of_validation_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DATE_OF_VALIDATION' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="datetimecombo" field="date_of_validation_c" width='37.5%'  >
{if !$fields.date_of_validation_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.date_of_validation_c.value) <= 0}
{assign var="value" value=$fields.date_of_validation_c.default_value }
{else}
{assign var="value" value=$fields.date_of_validation_c.value }
{/if} 
<span class="sugar_field" id="{$fields.date_of_validation_c.name}">{$fields.date_of_validation_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.final_disposition_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_FINAL_DISPOSITION' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="final_disposition_c" width='37.5%'  >
{if !$fields.final_disposition_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.final_disposition_c.value) <= 0}
{assign var="value" value=$fields.final_disposition_c.default_value }
{else}
{assign var="value" value=$fields.final_disposition_c.value }
{/if} 
<span class="sugar_field" id="{$fields.final_disposition_c.name}">{$fields.final_disposition_c.value}</span>
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
{if !$fields.preferred_date_of_call_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PREFERRED_DATE_OF_CALL' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="date" field="preferred_date_of_call_c" width='37.5%'  >
{if !$fields.preferred_date_of_call_c.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.preferred_date_of_call_c.value) <= 0}
{assign var="value" value=$fields.preferred_date_of_call_c.default_value }
{else}
{assign var="value" value=$fields.preferred_date_of_call_c.value }
{/if}
<span class="sugar_field" id="{$fields.preferred_date_of_call_c.name}">{$value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.preferred_time_of_call_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PREFERRED_TIME_OF_CALL' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="preferred_time_of_call_c" width='37.5%'  >
{if !$fields.preferred_time_of_call_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.preferred_time_of_call_c.value) <= 0}
{assign var="value" value=$fields.preferred_time_of_call_c.default_value }
{else}
{assign var="value" value=$fields.preferred_time_of_call_c.value }
{/if} 
<span class="sugar_field" id="{$fields.preferred_time_of_call_c.name}">{$fields.preferred_time_of_call_c.value}</span>
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
{if !$fields.leadid_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_LEADID' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="leadid_c" width='37.5%' colspan='3' >
{if !$fields.leadid_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.leadid_c.value) <= 0}
{assign var="value" value=$fields.leadid_c.default_value }
{else}
{assign var="value" value=$fields.leadid_c.value }
{/if} 
<span class="sugar_field" id="{$fields.leadid_c.name}">{$fields.leadid_c.value}</span>
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
{if !$fields.do_you_have_internet_banking_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DO_YOU_HAVE_INTERNET_BANKING' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="do_you_have_internet_banking_c" width='37.5%'  >
{if !$fields.do_you_have_internet_banking_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.do_you_have_internet_banking_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.do_you_have_internet_banking_c.name}" value="{ $fields.do_you_have_internet_banking_c.options }">
{ $fields.do_you_have_internet_banking_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.do_you_have_internet_banking_c.name}" value="{ $fields.do_you_have_internet_banking_c.value }">
{ $fields.do_you_have_internet_banking_c.options[$fields.do_you_have_internet_banking_c.value]}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.pan_no_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PAN_NO' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="pan_no_c" width='37.5%'  >
{if !$fields.pan_no_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.pan_no_c.value) <= 0}
{assign var="value" value=$fields.pan_no_c.default_value }
{else}
{assign var="value" value=$fields.pan_no_c.value }
{/if} 
<span class="sugar_field" id="{$fields.pan_no_c.name}">{$fields.pan_no_c.value}</span>
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
{if !$fields.campaign_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CAMPAIGN' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="campaign_c" width='37.5%'  >
{if !$fields.campaign_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.campaign_c.value) <= 0}
{assign var="value" value=$fields.campaign_c.default_value }
{else}
{assign var="value" value=$fields.campaign_c.value }
{/if} 
<span class="sugar_field" id="{$fields.campaign_c.name}">{$fields.campaign_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.utm_content_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_UTM_CONTENT' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="utm_content_c" width='37.5%'  >
{if !$fields.utm_content_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.utm_content_c.value) <= 0}
{assign var="value" value=$fields.utm_content_c.default_value }
{else}
{assign var="value" value=$fields.utm_content_c.value }
{/if} 
<span class="sugar_field" id="{$fields.utm_content_c.name}">{$fields.utm_content_c.value}</span>
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
{if !$fields.agreed_to_assign_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_AGREED_TO_ASSIGN' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="agreed_to_assign_c" width='37.5%'  >
{if !$fields.agreed_to_assign_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.agreed_to_assign_c.value) <= 0}
{assign var="value" value=$fields.agreed_to_assign_c.default_value }
{else}
{assign var="value" value=$fields.agreed_to_assign_c.value }
{/if} 
<span class="sugar_field" id="{$fields.agreed_to_assign_c.name}">{$fields.agreed_to_assign_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.comments_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_COMMENTS' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="text" field="comments_c" width='37.5%'  >
{if !$fields.comments_c.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.comments_c.name|escape:'html'|url2html|nl2br}">{$fields.comments_c.value|escape:'html'|escape:'html_entity_decode'|url2html|nl2br}</span>
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
{if !$fields.is_1st_time_investor_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_IS_1ST_TIME_INVESTOR' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="is_1st_time_investor_c" width='37.5%'  >
{if !$fields.is_1st_time_investor_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.is_1st_time_investor_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.is_1st_time_investor_c.name}" value="{ $fields.is_1st_time_investor_c.options }">
{ $fields.is_1st_time_investor_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.is_1st_time_investor_c.name}" value="{ $fields.is_1st_time_investor_c.value }">
{ $fields.is_1st_time_investor_c.options[$fields.is_1st_time_investor_c.value]}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.monthly_income_details_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_MONTHLY_INCOME_DETAILS' module='Contacts'}{/capture}
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
{capture name="label" assign="label"}{sugar_translate label='LBL_SOURCE_OF_INCOME' module='Contacts'}{/capture}
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
{if !$fields.campaign_city_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CAMPAIGN_CITY' module='Contacts'}{/capture}
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
{if !$fields.source_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SOURCE' module='Contacts'}{/capture}
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
{if !$fields.to_kown_about_5nance_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_TO_KOWN_ABOUT_5NANCE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="to_kown_about_5nance_c" width='37.5%'  >
{if !$fields.to_kown_about_5nance_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.to_kown_about_5nance_c.value) <= 0}
{assign var="value" value=$fields.to_kown_about_5nance_c.default_value }
{else}
{assign var="value" value=$fields.to_kown_about_5nance_c.value }
{/if} 
<span class="sugar_field" id="{$fields.to_kown_about_5nance_c.name}">{$fields.to_kown_about_5nance_c.value}</span>
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
{if !$fields.justdial_category_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_JUSTDIAL_CATEGORY' module='Contacts'}{/capture}
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
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_EDITVIEW_PANEL4").style.display='none';</script>
{/if}
</div>    <div id='tabcontent6'>
<div id='detailpanel_8' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table id='LBL_EDITVIEW_PANEL5' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.dateofactivation_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DATEOFACTIVATION' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="datetimecombo" field="dateofactivation_c" width='37.5%'  >
{if !$fields.dateofactivation_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.dateofactivation_c.value) <= 0}
{assign var="value" value=$fields.dateofactivation_c.default_value }
{else}
{assign var="value" value=$fields.dateofactivation_c.value }
{/if} 
<span class="sugar_field" id="{$fields.dateofactivation_c.name}">{$fields.dateofactivation_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.account_activation_month_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_ACCOUNT_ACTIVATION_MONTH' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="account_activation_month_c" width='37.5%'  >
{if !$fields.account_activation_month_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.account_activation_month_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.account_activation_month_c.name}" value="{ $fields.account_activation_month_c.options }">
{ $fields.account_activation_month_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.account_activation_month_c.name}" value="{ $fields.account_activation_month_c.value }">
{ $fields.account_activation_month_c.options[$fields.account_activation_month_c.value]}
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
{if !$fields.date_of_registration_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DATE_OF_REGISTRATION' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="datetimecombo" field="date_of_registration_c" width='37.5%'  >
{if !$fields.date_of_registration_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.date_of_registration_c.value) <= 0}
{assign var="value" value=$fields.date_of_registration_c.default_value }
{else}
{assign var="value" value=$fields.date_of_registration_c.value }
{/if} 
<span class="sugar_field" id="{$fields.date_of_registration_c.name}">{$fields.date_of_registration_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.document_submission_center_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_DOCUMENT_SUBMISSION_CENTER' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="document_submission_center_c" width='37.5%'  >
{if !$fields.document_submission_center_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.document_submission_center_c.value) <= 0}
{assign var="value" value=$fields.document_submission_center_c.default_value }
{else}
{assign var="value" value=$fields.document_submission_center_c.value }
{/if} 
<span class="sugar_field" id="{$fields.document_submission_center_c.name}">{$fields.document_submission_center_c.value}</span>
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
{if !$fields.auto_activation_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_AUTO_ACTIVATION' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="auto_activation_c" width='37.5%'  >
{if !$fields.auto_activation_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.auto_activation_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.auto_activation_c.name}" value="{ $fields.auto_activation_c.options }">
{ $fields.auto_activation_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.auto_activation_c.name}" value="{ $fields.auto_activation_c.value }">
{ $fields.auto_activation_c.options[$fields.auto_activation_c.value]}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.investorid_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_INVESTORID' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="investorid_c" width='37.5%'  >
{if !$fields.investorid_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.investorid_c.value) <= 0}
{assign var="value" value=$fields.investorid_c.default_value }
{else}
{assign var="value" value=$fields.investorid_c.value }
{/if} 
<span class="sugar_field" id="{$fields.investorid_c.name}">{$fields.investorid_c.value}</span>
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
{if !$fields.total_sip_orders_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_TOTAL_SIP_ORDERS' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="int" field="total_sip_orders_c" width='37.5%'  >
{if !$fields.total_sip_orders_c.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.total_sip_orders_c.name}">
{sugar_number_format precision=0 var=$fields.total_sip_orders_c.value}
</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.summarizing_total_sip_amount_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SUMMARIZING_TOTAL_SIP_AMOUNT' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="summarizing_total_sip_amount_c" width='37.5%'  >
{if !$fields.summarizing_total_sip_amount_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.summarizing_total_sip_amount_c.name}'>
{sugar_number_format var=$fields.summarizing_total_sip_amount_c.value }
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
{if !$fields.total_lumpsum_order_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_TOTAL_LUMPSUM_ORDER' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="int" field="total_lumpsum_order_c" width='37.5%'  >
{if !$fields.total_lumpsum_order_c.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.total_lumpsum_order_c.name}">
{sugar_number_format precision=0 var=$fields.total_lumpsum_order_c.value}
</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.summarizing_the_total_lumpsu_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SUMMARIZING_THE_TOTAL_LUMPSU' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="summarizing_the_total_lumpsu_c" width='37.5%'  >
{if !$fields.summarizing_the_total_lumpsu_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.summarizing_the_total_lumpsu_c.name}'>
{sugar_number_format var=$fields.summarizing_the_total_lumpsu_c.value }
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
{if !$fields.summarizing_total_orders_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SUMMARIZING_TOTAL_ORDERS' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="int" field="summarizing_total_orders_c" width='37.5%'  >
{if !$fields.summarizing_total_orders_c.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.summarizing_total_orders_c.name}">
{sugar_number_format precision=0 var=$fields.summarizing_total_orders_c.value}
</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.summarizing_total_amount_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SUMMARIZING_TOTAL_AMOUNT' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="summarizing_total_amount_c" width='37.5%'  >
{if !$fields.summarizing_total_amount_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.summarizing_total_amount_c.name}'>
{sugar_number_format var=$fields.summarizing_total_amount_c.value }
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
<script>document.getElementById("LBL_EDITVIEW_PANEL5").style.display='none';</script>
{/if}
<div id='detailpanel_9' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<h4>
<a href="javascript:void(0)" class="collapseLink" onclick="collapsePanel(9);">
<img border="0" id="detailpanel_9_img_hide" src="{sugar_getimagepath file="basic_search.gif"}"></a>
<a href="javascript:void(0)" class="expandLink" onclick="expandPanel(9);">
<img border="0" id="detailpanel_9_img_show" src="{sugar_getimagepath file="advanced_search.gif"}"></a>
{sugar_translate label='LBL_EDITVIEW_PANEL6' module='Contacts'}
<script>
document.getElementById('detailpanel_9').className += ' expanded';
</script>
</h4>
<table id='LBL_EDITVIEW_PANEL6' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.no_of_fd_investment_orders_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_NO_OF_FD_INVESTMENT_ORDERS' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="int" field="no_of_fd_investment_orders_c" width='37.5%'  >
{if !$fields.no_of_fd_investment_orders_c.hidden}
{counter name="panelFieldCount"}

<span class="sugar_field" id="{$fields.no_of_fd_investment_orders_c.name}">
{sugar_number_format precision=0 var=$fields.no_of_fd_investment_orders_c.value}
</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.total_amount_fd_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_TOTAL_AMOUNT_FD' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="total_amount_fd_c" width='37.5%'  >
{if !$fields.total_amount_fd_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.total_amount_fd_c.name}'>
{sugar_number_format var=$fields.total_amount_fd_c.value }
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
<script type="text/javascript">SUGAR.util.doWhen("typeof initPanel == 'function'", function() {ldelim} initPanel(9, 'expanded'); {rdelim}); </script>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_EDITVIEW_PANEL6").style.display='none';</script>
{/if}
<div id='detailpanel_10' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<h4>
<a href="javascript:void(0)" class="collapseLink" onclick="collapsePanel(10);">
<img border="0" id="detailpanel_10_img_hide" src="{sugar_getimagepath file="basic_search.gif"}"></a>
<a href="javascript:void(0)" class="expandLink" onclick="expandPanel(10);">
<img border="0" id="detailpanel_10_img_show" src="{sugar_getimagepath file="advanced_search.gif"}"></a>
{sugar_translate label='LBL_EDITVIEW_PANEL7' module='Contacts'}
<script>
document.getElementById('detailpanel_10').className += ' expanded';
</script>
</h4>
<table id='LBL_EDITVIEW_PANEL7' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.invoicedate_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_INVOICEDATE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="date" field="invoicedate_c" width='37.5%'  >
{if !$fields.invoicedate_c.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.invoicedate_c.value) <= 0}
{assign var="value" value=$fields.invoicedate_c.default_value }
{else}
{assign var="value" value=$fields.invoicedate_c.value }
{/if}
<span class="sugar_field" id="{$fields.invoicedate_c.name}">{$value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.transactionsubtype_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_TRANSACTIONSUBTYPE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="transactionsubtype_c" width='37.5%'  >
{if !$fields.transactionsubtype_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.transactionsubtype_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.transactionsubtype_c.name}" value="{ $fields.transactionsubtype_c.options }">
{ $fields.transactionsubtype_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.transactionsubtype_c.name}" value="{ $fields.transactionsubtype_c.value }">
{ $fields.transactionsubtype_c.options[$fields.transactionsubtype_c.value]}
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
{if !$fields.schemename_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_SCHEMENAME' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="schemename_c" width='37.5%'  >
{if !$fields.schemename_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.schemename_c.value) <= 0}
{assign var="value" value=$fields.schemename_c.default_value }
{else}
{assign var="value" value=$fields.schemename_c.value }
{/if} 
<span class="sugar_field" id="{$fields.schemename_c.name}">{$fields.schemename_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.amount_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_AMOUNT' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="amount_c" width='37.5%'  >
{if !$fields.amount_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.amount_c.name}'>
{sugar_number_format var=$fields.amount_c.value }
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
<script type="text/javascript">SUGAR.util.doWhen("typeof initPanel == 'function'", function() {ldelim} initPanel(10, 'expanded'); {rdelim}); </script>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_EDITVIEW_PANEL7").style.display='none';</script>
{/if}
<div id='detailpanel_11' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<h4>
<a href="javascript:void(0)" class="collapseLink" onclick="collapsePanel(11);">
<img border="0" id="detailpanel_11_img_hide" src="{sugar_getimagepath file="basic_search.gif"}"></a>
<a href="javascript:void(0)" class="expandLink" onclick="expandPanel(11);">
<img border="0" id="detailpanel_11_img_show" src="{sugar_getimagepath file="advanced_search.gif"}"></a>
{sugar_translate label='LBL_EDITVIEW_PANEL8' module='Contacts'}
<script>
document.getElementById('detailpanel_11').className += ' expanded';
</script>
</h4>
<table id='LBL_EDITVIEW_PANEL8' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.cart_invoice_date_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CART_INVOICE_DATE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="date" field="cart_invoice_date_c" width='37.5%'  >
{if !$fields.cart_invoice_date_c.hidden}
{counter name="panelFieldCount"}


{if strlen($fields.cart_invoice_date_c.value) <= 0}
{assign var="value" value=$fields.cart_invoice_date_c.default_value }
{else}
{assign var="value" value=$fields.cart_invoice_date_c.value }
{/if}
<span class="sugar_field" id="{$fields.cart_invoice_date_c.name}">{$value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.cart_scheme_name_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CART_SCHEME_NAME' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="cart_scheme_name_c" width='37.5%'  >
{if !$fields.cart_scheme_name_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.cart_scheme_name_c.value) <= 0}
{assign var="value" value=$fields.cart_scheme_name_c.default_value }
{else}
{assign var="value" value=$fields.cart_scheme_name_c.value }
{/if} 
<span class="sugar_field" id="{$fields.cart_scheme_name_c.name}">{$fields.cart_scheme_name_c.value}</span>
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
{if !$fields.cart_amount_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_CART_AMOUNT' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="cart_amount_c" width='37.5%' colspan='3' >
{if !$fields.cart_amount_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.cart_amount_c.name}'>
{sugar_number_format var=$fields.cart_amount_c.value }
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
<script type="text/javascript">SUGAR.util.doWhen("typeof initPanel == 'function'", function() {ldelim} initPanel(11, 'expanded'); {rdelim}); </script>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_EDITVIEW_PANEL8").style.display='none';</script>
{/if}
</div>    <div id='tabcontent7'>
<div id='detailpanel_12' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table id='LBL_EDITVIEW_PANEL9' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.investment_period_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_INVESTMENT_PERIOD' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="investment_period_c" width='37.5%'  >
{if !$fields.investment_period_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.investment_period_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.investment_period_c.name}" value="{ $fields.investment_period_c.options }">
{ $fields.investment_period_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.investment_period_c.name}" value="{ $fields.investment_period_c.value }">
{ $fields.investment_period_c.options[$fields.investment_period_c.value]}
{/if}
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.investment_type_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_INVESTMENT_TYPE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="enum" field="investment_type_c" width='37.5%'  >
{if !$fields.investment_type_c.hidden}
{counter name="panelFieldCount"}


{if is_string($fields.investment_type_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.investment_type_c.name}" value="{ $fields.investment_type_c.options }">
{ $fields.investment_type_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.investment_type_c.name}" value="{ $fields.investment_type_c.value }">
{ $fields.investment_type_c.options[$fields.investment_type_c.value]}
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
{if !$fields.investment_amount_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_INVESTMENT_AMOUNT' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="investment_amount_c" width='37.5%'  >
{if !$fields.investment_amount_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.investment_amount_c.name}'>
{sugar_number_format var=$fields.investment_amount_c.value }
</span>
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
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_EDITVIEW_PANEL9").style.display='none';</script>
{/if}
</div>    <div id='tabcontent8'>
<div id='detailpanel_13' class='detail view  detail508 expanded'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
<table id='LBL_EDITVIEW_PANEL10' class="panelContainer" cellspacing='{$gridline}'>
{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
{capture name="tr" assign="tableRow"}
<tr>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.taxyear_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_TAXYEAR' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="taxyear_c" width='37.5%'  >
{if !$fields.taxyear_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.taxyear_c.value) <= 0}
{assign var="value" value=$fields.taxyear_c.default_value }
{else}
{assign var="value" value=$fields.taxyear_c.value }
{/if} 
<span class="sugar_field" id="{$fields.taxyear_c.name}">{$fields.taxyear_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.total_gross_salary_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_TOTAL_GROSS_SALARY' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="total_gross_salary_c" width='37.5%'  >
{if !$fields.total_gross_salary_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.total_gross_salary_c.name}'>
{sugar_number_format var=$fields.total_gross_salary_c.value }
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
{if !$fields.taxableincomeonhouserent_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_TAXABLEINCOMEONHOUSERENT' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="taxableincomeonhouserent_c" width='37.5%'  >
{if !$fields.taxableincomeonhouserent_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.taxableincomeonhouserent_c.name}'>
{sugar_number_format var=$fields.taxableincomeonhouserent_c.value }
</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.totaltaxtobepaid_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_TOTALTAXTOBEPAID' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="totaltaxtobepaid_c" width='37.5%'  >
{if !$fields.totaltaxtobepaid_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.totaltaxtobepaid_c.name}'>
{sugar_number_format var=$fields.totaltaxtobepaid_c.value }
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
{if !$fields.taxable_income_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_TAXABLE_INCOME' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="taxable_income_c" width='37.5%'  >
{if !$fields.taxable_income_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.taxable_income_c.name}'>
{sugar_number_format var=$fields.taxable_income_c.value }
</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.taxable_income_equity_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_TAXABLE_INCOME_EQUITY' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="taxable_income_equity_c" width='37.5%'  >
{if !$fields.taxable_income_equity_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.taxable_income_equity_c.name}'>
{sugar_number_format var=$fields.taxable_income_equity_c.value }
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
{if !$fields.taxable_income_sales_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_TAXABLE_INCOME_SALES' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="taxable_income_sales_c" width='37.5%'  >
{if !$fields.taxable_income_sales_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.taxable_income_sales_c.name}'>
{sugar_number_format var=$fields.taxable_income_sales_c.value }
</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.exemptions_from_80c_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EXEMPTIONS_FROM_80C' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="exemptions_from_80c_c" width='37.5%'  >
{if !$fields.exemptions_from_80c_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.exemptions_from_80c_c.value) <= 0}
{assign var="value" value=$fields.exemptions_from_80c_c.default_value }
{else}
{assign var="value" value=$fields.exemptions_from_80c_c.value }
{/if} 
<span class="sugar_field" id="{$fields.exemptions_from_80c_c.name}">{$fields.exemptions_from_80c_c.value}</span>
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
{if !$fields.exemptions_from_80d_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EXEMPTIONS_FROM_80D' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="exemptions_from_80d_c" width='37.5%'  >
{if !$fields.exemptions_from_80d_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.exemptions_from_80d_c.value) <= 0}
{assign var="value" value=$fields.exemptions_from_80d_c.default_value }
{else}
{assign var="value" value=$fields.exemptions_from_80d_c.value }
{/if} 
<span class="sugar_field" id="{$fields.exemptions_from_80d_c.name}">{$fields.exemptions_from_80d_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.exemptions_80ccg_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EXEMPTIONS_80CCG' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="exemptions_80ccg_c" width='37.5%'  >
{if !$fields.exemptions_80ccg_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.exemptions_80ccg_c.value) <= 0}
{assign var="value" value=$fields.exemptions_80ccg_c.default_value }
{else}
{assign var="value" value=$fields.exemptions_80ccg_c.value }
{/if} 
<span class="sugar_field" id="{$fields.exemptions_80ccg_c.name}">{$fields.exemptions_80ccg_c.value}</span>
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
{if !$fields.exemptions_80ccd_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EXEMPTIONS_80CCD' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="exemptions_80ccd_c" width='37.5%'  >
{if !$fields.exemptions_80ccd_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.exemptions_80ccd_c.value) <= 0}
{assign var="value" value=$fields.exemptions_80ccd_c.default_value }
{else}
{assign var="value" value=$fields.exemptions_80ccd_c.value }
{/if} 
<span class="sugar_field" id="{$fields.exemptions_80ccd_c.name}">{$fields.exemptions_80ccd_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.exemptions_80e_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EXEMPTIONS_80E' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="exemptions_80e_c" width='37.5%'  >
{if !$fields.exemptions_80e_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.exemptions_80e_c.value) <= 0}
{assign var="value" value=$fields.exemptions_80e_c.default_value }
{else}
{assign var="value" value=$fields.exemptions_80e_c.value }
{/if} 
<span class="sugar_field" id="{$fields.exemptions_80e_c.name}">{$fields.exemptions_80e_c.value}</span>
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
{if !$fields.exemptions_80g_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_EXEMPTIONS_80G' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="exemptions_80g_c" width='37.5%'  >
{if !$fields.exemptions_80g_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.exemptions_80g_c.value) <= 0}
{assign var="value" value=$fields.exemptions_80g_c.default_value }
{else}
{assign var="value" value=$fields.exemptions_80g_c.value }
{/if} 
<span class="sugar_field" id="{$fields.exemptions_80g_c.name}">{$fields.exemptions_80g_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.hra_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_HRA' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="hra_c" width='37.5%'  >
{if !$fields.hra_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.hra_c.value) <= 0}
{assign var="value" value=$fields.hra_c.default_value }
{else}
{assign var="value" value=$fields.hra_c.value }
{/if} 
<span class="sugar_field" id="{$fields.hra_c.name}">{$fields.hra_c.value}</span>
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
{if !$fields.interest_on_housing_loan_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_INTEREST_ON_HOUSING_LOAN' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="interest_on_housing_loan_c" width='37.5%'  >
{if !$fields.interest_on_housing_loan_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.interest_on_housing_loan_c.name}'>
{sugar_number_format var=$fields.interest_on_housing_loan_c.value }
</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.tax_deducted_at_source_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_TAX_DEDUCTED_AT_SOURCE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="tax_deducted_at_source_c" width='37.5%'  >
{if !$fields.tax_deducted_at_source_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.tax_deducted_at_source_c.name}'>
{sugar_number_format var=$fields.tax_deducted_at_source_c.value }
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
{if !$fields.professional_tax_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_PROFESSIONAL_TAX' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="professional_tax_c" width='37.5%'  >
{if !$fields.professional_tax_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.professional_tax_c.value) <= 0}
{assign var="value" value=$fields.professional_tax_c.default_value }
{else}
{assign var="value" value=$fields.professional_tax_c.value }
{/if} 
<span class="sugar_field" id="{$fields.professional_tax_c.name}">{$fields.professional_tax_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.taxable_income_deduction_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_TAXABLE_INCOME_DEDUCTION' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="currency" field="taxable_income_deduction_c" width='37.5%'  >
{if !$fields.taxable_income_deduction_c.hidden}
{counter name="panelFieldCount"}

<span id='{$fields.taxable_income_deduction_c.name}'>
{sugar_number_format var=$fields.taxable_income_deduction_c.value }
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
{if !$fields.tax_liability_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_TAX_LIABILITY' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="tax_liability_c" width='37.5%'  >
{if !$fields.tax_liability_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.tax_liability_c.value) <= 0}
{assign var="value" value=$fields.tax_liability_c.default_value }
{else}
{assign var="value" value=$fields.tax_liability_c.value }
{/if} 
<span class="sugar_field" id="{$fields.tax_liability_c.name}">{$fields.tax_liability_c.value}</span>
{/if}
<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>
</td>
{counter name="fieldsUsed"}
<td width='12.5%' scope="col">
{if !$fields.tax_that_you_an_save_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_TAX_THAT_YOU_AN_SAVE' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="tax_that_you_an_save_c" width='37.5%'  >
{if !$fields.tax_that_you_an_save_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.tax_that_you_an_save_c.value) <= 0}
{assign var="value" value=$fields.tax_that_you_an_save_c.default_value }
{else}
{assign var="value" value=$fields.tax_that_you_an_save_c.value }
{/if} 
<span class="sugar_field" id="{$fields.tax_that_you_an_save_c.name}">{$fields.tax_that_you_an_save_c.value}</span>
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
{if !$fields.tax_to_be_paid_after_savin_c.hidden}
{capture name="label" assign="label"}{sugar_translate label='LBL_TAX_TO_BE_PAID_AFTER_SAVIN' module='Contacts'}{/capture}
{$label|strip_semicolon}:
{/if}
</td>
<td class="inlineEdit" type="varchar" field="tax_to_be_paid_after_savin_c" width='37.5%'  >
{if !$fields.tax_to_be_paid_after_savin_c.hidden}
{counter name="panelFieldCount"}

{if strlen($fields.tax_to_be_paid_after_savin_c.value) <= 0}
{assign var="value" value=$fields.tax_to_be_paid_after_savin_c.default_value }
{else}
{assign var="value" value=$fields.tax_to_be_paid_after_savin_c.value }
{/if} 
<span class="sugar_field" id="{$fields.tax_to_be_paid_after_savin_c.name}">{$fields.tax_to_be_paid_after_savin_c.value}</span>
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
</table>
</div>
{if $panelFieldCount == 0}
<script>document.getElementById("LBL_EDITVIEW_PANEL10").style.display='none';</script>
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
var Contacts_detailview_tabs = new YAHOO.widget.TabView("Contacts_detailview_tabs");
Contacts_detailview_tabs.selectTab(0);
</script>
<script type="text/javascript" src="include/InlineEditing/inlineEditing.js"></script>
<script type="text/javascript" src="modules/Favorites/favorites.js"></script>