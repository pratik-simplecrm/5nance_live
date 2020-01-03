

<table border="0" cellpadding="0" cellspacing="0" class="dateTime">
<tr valign="middle">
<td nowrap>
<input autocomplete="off" type="text" id="{$fields.next_call_planning_date_c.name}_date" value="{$fields[$fields.next_call_planning_date_c.name].value}" size="11" maxlength="10" title='' tabindex="1" onblur="combo_{$fields.next_call_planning_date_c.name}.update();" onchange="combo_{$fields.next_call_planning_date_c.name}.update(); "    >
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$fields.next_call_planning_date_c.name}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}&nbsp;
</td>
<td nowrap>
<div id="{$fields.next_call_planning_date_c.name}_time_section"></div>
</td>
</tr>
</table>
<input type="hidden" class="DateTimeCombo" id="{$fields.next_call_planning_date_c.name}" name="{$fields.next_call_planning_date_c.name}" value="{$fields[$fields.next_call_planning_date_c.name].value}">
<script type="text/javascript" src="{sugar_getjspath file="include/SugarFields/Fields/Datetimecombo/Datetimecombo.js"}"></script>
<script type="text/javascript">
var combo_{$fields.next_call_planning_date_c.name} = new Datetimecombo("{$fields[$fields.next_call_planning_date_c.name].value}", "{$fields.next_call_planning_date_c.name}", "{$TIME_FORMAT}", "1", '', false, true);
//Render the remaining widget fields
text = combo_{$fields.next_call_planning_date_c.name}.html('');
document.getElementById('{$fields.next_call_planning_date_c.name}_time_section').innerHTML = text;

//Call eval on the update function to handle updates to calendar picker object
eval(combo_{$fields.next_call_planning_date_c.name}.jsscript(''));

//bug 47718: this causes too many addToValidates to be called, resulting in the error messages being displayed multiple times
//    removing it here to mirror the Datetime SugarField, where the validation is not added at this level
//addToValidate('{$form_name}',"{$fields.next_call_planning_date_c.name}_date",'date',false,"{$fields.next_call_planning_date_c.name}");
addToValidateBinaryDependency('{$form_name}',"{$fields.next_call_planning_date_c.name}_hours", 'alpha', false, "{$APP.ERR_MISSING_REQUIRED_FIELDS} {$APP.LBL_HOURS}" ,"{$fields.next_call_planning_date_c.name}_date");
addToValidateBinaryDependency('{$form_name}', "{$fields.next_call_planning_date_c.name}_minutes", 'alpha', false, "{$APP.ERR_MISSING_REQUIRED_FIELDS} {$APP.LBL_MINUTES}" ,"{$fields.next_call_planning_date_c.name}_date");
addToValidateBinaryDependency('{$form_name}', "{$fields.next_call_planning_date_c.name}_meridiem", 'alpha', false, "{$APP.ERR_MISSING_REQUIRED_FIELDS} {$APP.LBL_MERIDIEM}","{$fields.next_call_planning_date_c.name}_date");

YAHOO.util.Event.onDOMReady(function()
{ldelim}

	Calendar.setup ({ldelim}
	onClose : update_{$fields.next_call_planning_date_c.name},
	inputField : "{$fields.next_call_planning_date_c.name}_date",
    form : "",
	ifFormat : "{$CALENDAR_FORMAT}",
	daFormat : "{$CALENDAR_FORMAT}",
	button : "{$fields.next_call_planning_date_c.name}_trigger",
	singleClick : true,
	step : 1,
	weekNumbers: false,
        startWeekday: {$CALENDAR_FDOW|default:'0'},
	comboObject: combo_{$fields.next_call_planning_date_c.name}
	{rdelim});

	//Call update for first time to round hours and minute values
	combo_{$fields.next_call_planning_date_c.name}.update(false);

{rdelim}); 
</script>