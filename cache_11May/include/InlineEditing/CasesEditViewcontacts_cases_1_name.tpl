
<input type="text" name="{$fields.contacts_cases_1_name.name}" class="sqsEnabled" tabindex="1" id="{$fields.contacts_cases_1_name.name}" size="" value="{$fields.contacts_cases_1_name.value}" title='' autocomplete="off"  	 >
<input type="hidden" name="{$fields.contacts_cases_1_name.id_name}" 
	id="{$fields.contacts_cases_1_name.id_name}" 
	value="{$fields.contacts_cases_1contacts_ida.value}">
<span class="id-ff multiple">
<button type="button" name="btn_{$fields.contacts_cases_1_name.name}" id="btn_{$fields.contacts_cases_1_name.name}" tabindex="1" title="{sugar_translate label="LBL_ACCESSKEY_SELECT_CONTACTS_TITLE"}" class="button firstChild" value="{sugar_translate label="LBL_ACCESSKEY_SELECT_CONTACTS_LABEL"}"
onclick='open_popup(
    "{$fields.contacts_cases_1_name.module}", 
	600, 
	400, 
	"", 
	true, 
	false, 
	{literal}{"call_back_function":"set_return","form_name":"EditView","field_to_name_array":{"id":{/literal}"{$fields.contacts_cases_1_name.id_name}"{literal},"name":{/literal}"{$fields.contacts_cases_1_name.name}"{literal}}}{/literal}, 
	"single", 
	true
);' ><img src="{sugar_getimagepath file="id-ff-select.png"}"></button><button type="button" name="btn_clr_{$fields.contacts_cases_1_name.name}" id="btn_clr_{$fields.contacts_cases_1_name.name}" tabindex="1" title="{sugar_translate label="LBL_ACCESSKEY_CLEAR_CONTACTS_TITLE"}"  class="button lastChild"
onclick="SUGAR.clearRelateField(this.form, '{$fields.contacts_cases_1_name.name}', '{$fields.contacts_cases_1_name.id_name}');"  value="{sugar_translate label="LBL_ACCESSKEY_CLEAR_CONTACTS_LABEL"}" ><img src="{sugar_getimagepath file="id-ff-clear.png"}"></button>
</span>
<script type="text/javascript">
SUGAR.util.doWhen(
		"typeof(sqs_objects) != 'undefined' && typeof(sqs_objects['{$form_name}_{$fields.contacts_cases_1_name.name}']) != 'undefined'",
		enableQS
);
</script>