
<script>
{literal}
	$(function() {
	var $dialog = $('<div></div>')
		.html(SUGAR.language.get('app_strings', 'LBL_SEARCH_HELP_TEXT'))
		.dialog({
			autoOpen: false,
			title: SUGAR.language.get('app_strings', 'LBL_SEARCH_HELP_TITLE'),
			width: 700
		});
		
		$('.help-search').click(function() {
		$dialog.dialog('open');
		// prevent the default action, e.g., following a link
	});
	
	});
{/literal}
</script>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
      
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
			<label for='first_name_advanced'>{sugar_translate label='LBL_FIRST_NAME' module='Contacts'}</label>
		</td>
	<td  nowrap="nowrap" width='25%'>
			
{if strlen($fields.first_name_advanced.value) <= 0}
{assign var="value" value=$fields.first_name_advanced.default_value }
{else}
{assign var="value" value=$fields.first_name_advanced.value }
{/if}  
<input type='text' name='{$fields.first_name_advanced.name}' 
    id='{$fields.first_name_advanced.name}' size='30' 
    maxlength='100' 
    value='{$value}' title=''      accesskey='9'  >
   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
			<label for='last_name_advanced'>{sugar_translate label='LBL_LAST_NAME' module='Contacts'}</label>
		</td>
	<td  nowrap="nowrap" width='25%'>
			
{if strlen($fields.last_name_advanced.value) <= 0}
{assign var="value" value=$fields.last_name_advanced.default_value }
{else}
{assign var="value" value=$fields.last_name_advanced.value }
{/if}  
<input type='text' name='{$fields.last_name_advanced.name}' 
    id='{$fields.last_name_advanced.name}' size='30' 
    maxlength='100' 
    value='{$value}' title=''      >
   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
		
		<label for='phone_advanced'>{sugar_translate label='LBL_ANY_PHONE' module='Contacts'}</label>
    	</td>
	<td  nowrap="nowrap" width='25%'>
			
{if strlen($fields.phone_advanced.value) <= 0}
{assign var="value" value=$fields.phone_advanced.default_value }
{else}
{assign var="value" value=$fields.phone_advanced.value }
{/if}  
<input type='text' name='{$fields.phone_advanced.name}' 
    id='{$fields.phone_advanced.name}' size='30' 
     
    value='{$value}' title=''      >
   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
		
		<label for='email_advanced'>{sugar_translate label='LBL_ANY_EMAIL' module='Contacts'}</label>
    	</td>
	<td  nowrap="nowrap" width='25%'>
			
{if strlen($fields.email_advanced.value) <= 0}
{assign var="value" value=$fields.email_advanced.default_value }
{else}
{assign var="value" value=$fields.email_advanced.value }
{/if}  
<input type='text' name='{$fields.email_advanced.name}' 
    id='{$fields.email_advanced.name}' size='30' 
     
    value='{$value}' title=''      >
   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
		
		<label for='no_of_attempts_c_advanced'>{sugar_translate label='LBL_NO_OF_ATTEMPTS' module='Contacts'}</label>
    	</td>
	<td  nowrap="nowrap" width='25%'>
			
{if strlen($fields.no_of_attempts_c_advanced.value) <= 0}
{assign var="value" value=$fields.no_of_attempts_c_advanced.default_value }
{else}
{assign var="value" value=$fields.no_of_attempts_c_advanced.value }
{/if}  
<input type='text' name='{$fields.no_of_attempts_c_advanced.name}' 
    id='{$fields.no_of_attempts_c_advanced.name}' size='30' 
     
    value='{$value}' title='' tabindex='' > 
   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
		
		<label for='unique_customer_code_c_advanced'>{sugar_translate label='LBL_UNIQUE_CUSTOMER_CODE' module='Contacts'}</label>
    	</td>
	<td  nowrap="nowrap" width='25%'>
			
{if strlen($fields.unique_customer_code_c_advanced.value) <= 0}
{assign var="value" value=$fields.unique_customer_code_c_advanced.default_value }
{else}
{assign var="value" value=$fields.unique_customer_code_c_advanced.value }
{/if}  
<input type='text' name='{$fields.unique_customer_code_c_advanced.name}' 
    id='{$fields.unique_customer_code_c_advanced.name}' size='30' 
    maxlength='100' 
    value='{$value}' title=''      >
   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
		
		<label for='campaign_type_c_advanced'>{sugar_translate label='LBL_CAMPAIGN_TYPE' module='Contacts'}</label>
    	</td>
	<td  nowrap="nowrap" width='25%'>
			
{if strlen($fields.campaign_type_c_advanced.value) <= 0}
{assign var="value" value=$fields.campaign_type_c_advanced.default_value }
{else}
{assign var="value" value=$fields.campaign_type_c_advanced.value }
{/if}  
<input type='text' name='{$fields.campaign_type_c_advanced.name}' 
    id='{$fields.campaign_type_c_advanced.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''      >
   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
		
		<label for='gateway_c_advanced'>{sugar_translate label='LBL_GATEWAY' module='Contacts'}</label>
    	</td>
	<td  nowrap="nowrap" width='25%'>
			
{html_options id='gateway_c_advanced' name='gateway_c_advanced[]' options=$fields.gateway_c_advanced.options size="6" style="width: 150px" multiple="1" selected=$fields.gateway_c_advanced.value}
   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
		
		<label for='sales_stage_c_advanced'>{sugar_translate label='LBL_SALES_STAGE' module='Contacts'}</label>
    	</td>
	<td  nowrap="nowrap" width='25%'>
			
{html_options id='sales_stage_c_advanced' name='sales_stage_c_advanced[]' options=$fields.sales_stage_c_advanced.options size="6" style="width: 150px" multiple="1" selected=$fields.sales_stage_c_advanced.value}
   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
		
		<label for='product_interest_c_advanced'>{sugar_translate label='LBL_PRODUCT_INTEREST' module='Contacts'}</label>
    	</td>
	<td  nowrap="nowrap" width='25%'>
			
{html_options id='product_interest_c_advanced' name='product_interest_c_advanced[]' options=$fields.product_interest_c_advanced.options size="6" style="width: 150px" multiple="1" selected=$fields.product_interest_c_advanced.value}
   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
		
		<label for='next_call_planning_date_c_advanced'>{sugar_translate label='LBL_NEXT_CALL_PLANNING_DATE' module='Contacts'}</label>
    	</td>
	<td  nowrap="nowrap" width='25%'>
			
{assign var="id" value=$fields.next_call_planning_date_c_advanced.name }

{if isset($smarty.request.next_call_planning_date_c_advanced_range_choice)}
{assign var="starting_choice" value=$smarty.request.next_call_planning_date_c_advanced_range_choice}
{else}
{assign var="starting_choice" value="="}
{/if}

<div style="white-space:nowrap !important;">
<select id="{$id}_range_choice" name="{$id}_range_choice" style="width:125px !important;" onchange="{$id}_range_change(this.value);">
{html_options options=$fields.next_call_planning_date_c_advanced.options selected=$starting_choice}
</select>
</div>

<div id="{$id}_range_div" style="{if preg_match('/^\[/', $smarty.request.range_next_call_planning_date_c_advanced)  || $starting_choice == 'between'}display:none{else}display:''{/if};">
<input autocomplete="off" type="text" name="range_{$id}" id="range_{$id}" value='{if empty($smarty.request.range_next_call_planning_date_c_advanced) && !empty($smarty.request.next_call_planning_date_c_advanced)}{$smarty.request.next_call_planning_date_c_advanced}{else}{$smarty.request.range_next_call_planning_date_c_advanced}{/if}' title=''   size="11" style="width:100px !important;">
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$id}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "range_{$id}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$id}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
    
</div>

<div id="{$id}_between_range_div" style="{if $starting_choice=='between'}display:'';{else}display:none;{/if}">
{assign var=date_value value=$fields.next_call_planning_date_c_advanced.value }
<input autocomplete="off" type="text" name="start_range_{$id}" id="start_range_{$id}" value='{$smarty.request.start_range_next_call_planning_date_c_advanced }' title=''  tabindex='' size="11" style="width:100px !important;">
{capture assign="other_attributes"}align="absmiddle" border="0" id="start_range_{$id}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" alt="$APP.LBL_ENTER_DATE other_attributes=$other_attributes"}
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "start_range_{$id}",
daFormat : "{$CALENDAR_FORMAT}",
button : "start_range_{$id}_trigger",
singleClick : true,
dateStr : "{$date_value}",
step : 1,
weekNumbers:false
{rdelim}
);
</script>
 
{$APP.LBL_AND}
{assign var=date_value value=$fields.next_call_planning_date_c_advanced.value }
<input autocomplete="off" type="text" name="end_range_{$id}" id="end_range_{$id}" value='{$smarty.request.end_range_next_call_planning_date_c_advanced }' title=''  tabindex='' size="11" style="width:100px !important;" maxlength="10">
{capture assign="other_attributes"}align="absmiddle" border="0" id="end_range_{$id}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" alt="$APP.LBL_ENTER_DATE other_attributes=$other_attributes"}
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "end_range_{$id}",
daFormat : "{$CALENDAR_FORMAT}",
button : "end_range_{$id}_trigger",
singleClick : true,
dateStr : "{$date_value}",
step : 1,
weekNumbers:false
{rdelim}
);
</script>
 
</div>


<script type='text/javascript'>

function {$id}_range_change(val) 
{ldelim}
  if(val == 'between') {ldelim}
     document.getElementById("range_{$id}").value = '';  
     document.getElementById("{$id}_range_div").style.display = 'none';
     document.getElementById("{$id}_between_range_div").style.display = ''; 
  {rdelim} else if (val == '=' || val == 'not_equal' || val == 'greater_than' || val == 'less_than') {ldelim}
     if((/^\[.*\]$/).test(document.getElementById("range_{$id}").value))
     {ldelim}
     	document.getElementById("range_{$id}").value = '';
     {rdelim}
     document.getElementById("start_range_{$id}").value = '';
     document.getElementById("end_range_{$id}").value = '';
     document.getElementById("{$id}_range_div").style.display = '';
     document.getElementById("{$id}_between_range_div").style.display = 'none';
  {rdelim} else {ldelim}
     document.getElementById("range_{$id}").value = '[' + val + ']';    
     document.getElementById("start_range_{$id}").value = '';
     document.getElementById("end_range_{$id}").value = ''; 
     document.getElementById("{$id}_range_div").style.display = 'none';
     document.getElementById("{$id}_between_range_div").style.display = 'none';         
  {rdelim}
{rdelim}

var {$id}_range_reset = function()
{ldelim}
{$id}_range_change('=');
{rdelim}

YAHOO.util.Event.onDOMReady(function() {ldelim}
if(document.getElementById('search_form_clear'))
{ldelim}
YAHOO.util.Event.addListener('search_form_clear', 'click', {$id}_range_reset);
{rdelim}

{rdelim});

YAHOO.util.Event.onDOMReady(function() {ldelim}
 	if(document.getElementById('search_form_clear_advanced'))
 	 {ldelim}
 	     YAHOO.util.Event.addListener('search_form_clear_advanced', 'click', {$id}_range_reset);
 	 {rdelim}

{rdelim});

YAHOO.util.Event.onDOMReady(function() {ldelim}
    //register on basic search form button if it exists
    if(document.getElementById('search_form_submit'))
     {ldelim}
         YAHOO.util.Event.addListener('search_form_submit', 'click',{$id}_range_validate);
     {rdelim}
    //register on advanced search submit button if it exists
   if(document.getElementById('search_form_submit_advanced'))
    {ldelim}
        YAHOO.util.Event.addListener('search_form_submit_advanced', 'click',{$id}_range_validate);
    {rdelim}

{rdelim});

// this function is specific to range date searches and will check that both start and end date ranges have been
// filled prior to submitting search form.  It is called from the listener added above.
function {$id}_range_validate(e){ldelim}
    if (
            (document.getElementById("start_range_{$id}").value.length >0 && document.getElementById("end_range_{$id}").value.length == 0)
          ||(document.getElementById("end_range_{$id}").value.length >0 && document.getElementById("start_range_{$id}").value.length == 0)
       )
    {ldelim}
        e.preventDefault();
        alert('{$APP.LBL_CHOOSE_START_AND_END_DATES}');
        if (document.getElementById("start_range_{$id}").value.length == 0) {ldelim}
            document.getElementById("start_range_{$id}").focus();
        {rdelim}
        else {ldelim}
            document.getElementById("end_range_{$id}").focus();
        {rdelim}
    {rdelim}

{rdelim}

</script>
   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
		
		<label for='disposition_c_advanced'>{sugar_translate label='LBL_DISPOSITION' module='Contacts'}</label>
    	</td>
	<td  nowrap="nowrap" width='25%'>
			
{html_options id='disposition_c_advanced' name='disposition_c_advanced[]' options=$fields.disposition_c_advanced.options size="6" style="width: 150px" multiple="1" selected=$fields.disposition_c_advanced.value}
   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
		
		<label for='age_c_advanced'>{sugar_translate label='LBL_AGE' module='Contacts'}</label>
    	</td>
	<td  nowrap="nowrap" width='25%'>
			
{if strlen($fields.age_c_advanced.value) <= 0}
{assign var="value" value=$fields.age_c_advanced.default_value }
{else}
{assign var="value" value=$fields.age_c_advanced.value }
{/if}  
<input type='text' name='{$fields.age_c_advanced.name}' 
    id='{$fields.age_c_advanced.name}' size='30' 
     
    value='{$value}' title='' tabindex='' > 
   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
		
		<label for='publisher_name_c_advanced'>{sugar_translate label='LBL_PUBLISHER_NAME' module='Contacts'}</label>
    	</td>
	<td  nowrap="nowrap" width='25%'>
			
{if strlen($fields.publisher_name_c_advanced.value) <= 0}
{assign var="value" value=$fields.publisher_name_c_advanced.default_value }
{else}
{assign var="value" value=$fields.publisher_name_c_advanced.value }
{/if}  
<input type='text' name='{$fields.publisher_name_c_advanced.name}' 
    id='{$fields.publisher_name_c_advanced.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''      >
   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
		
		<label for='state_c_advanced'>{sugar_translate label='LBL_STATE' module='Contacts'}</label>
    	</td>
	<td  nowrap="nowrap" width='25%'>
			
{html_options id='state_c_advanced' name='state_c_advanced[]' options=$fields.state_c_advanced.options size="6" style="width: 150px" multiple="1" selected=$fields.state_c_advanced.value}
   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
		
		<label for='date_entered_advanced'>{sugar_translate label='LBL_DATE_ENTERED' module='Contacts'}</label>
    	</td>
	<td  nowrap="nowrap" width='25%'>
			
{assign var="id" value=$fields.date_entered_advanced.name }

{if isset($smarty.request.date_entered_advanced_range_choice)}
{assign var="starting_choice" value=$smarty.request.date_entered_advanced_range_choice}
{else}
{assign var="starting_choice" value="="}
{/if}

<div style="white-space:nowrap !important;">
<select id="{$id}_range_choice" name="{$id}_range_choice" style="width:125px !important;" onchange="{$id}_range_change(this.value);">
{html_options options=$fields.date_entered_advanced.options selected=$starting_choice}
</select>
</div>

<div id="{$id}_range_div" style="{if preg_match('/^\[/', $smarty.request.range_date_entered_advanced)  || $starting_choice == 'between'}display:none{else}display:''{/if};">
<input autocomplete="off" type="text" name="range_{$id}" id="range_{$id}" value='{if empty($smarty.request.range_date_entered_advanced) && !empty($smarty.request.date_entered_advanced)}{$smarty.request.date_entered_advanced}{else}{$smarty.request.range_date_entered_advanced}{/if}' title=''   size="11" style="width:100px !important;">
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$id}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "range_{$id}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$id}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
    
</div>

<div id="{$id}_between_range_div" style="{if $starting_choice=='between'}display:'';{else}display:none;{/if}">
{assign var=date_value value=$fields.date_entered_advanced.value }
<input autocomplete="off" type="text" name="start_range_{$id}" id="start_range_{$id}" value='{$smarty.request.start_range_date_entered_advanced }' title=''  tabindex='' size="11" style="width:100px !important;">
{capture assign="other_attributes"}align="absmiddle" border="0" id="start_range_{$id}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" alt="$APP.LBL_ENTER_DATE other_attributes=$other_attributes"}
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "start_range_{$id}",
daFormat : "{$CALENDAR_FORMAT}",
button : "start_range_{$id}_trigger",
singleClick : true,
dateStr : "{$date_value}",
step : 1,
weekNumbers:false
{rdelim}
);
</script>
 
{$APP.LBL_AND}
{assign var=date_value value=$fields.date_entered_advanced.value }
<input autocomplete="off" type="text" name="end_range_{$id}" id="end_range_{$id}" value='{$smarty.request.end_range_date_entered_advanced }' title=''  tabindex='' size="11" style="width:100px !important;" maxlength="10">
{capture assign="other_attributes"}align="absmiddle" border="0" id="end_range_{$id}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" alt="$APP.LBL_ENTER_DATE other_attributes=$other_attributes"}
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "end_range_{$id}",
daFormat : "{$CALENDAR_FORMAT}",
button : "end_range_{$id}_trigger",
singleClick : true,
dateStr : "{$date_value}",
step : 1,
weekNumbers:false
{rdelim}
);
</script>
 
</div>


<script type='text/javascript'>

function {$id}_range_change(val) 
{ldelim}
  if(val == 'between') {ldelim}
     document.getElementById("range_{$id}").value = '';  
     document.getElementById("{$id}_range_div").style.display = 'none';
     document.getElementById("{$id}_between_range_div").style.display = ''; 
  {rdelim} else if (val == '=' || val == 'not_equal' || val == 'greater_than' || val == 'less_than') {ldelim}
     if((/^\[.*\]$/).test(document.getElementById("range_{$id}").value))
     {ldelim}
     	document.getElementById("range_{$id}").value = '';
     {rdelim}
     document.getElementById("start_range_{$id}").value = '';
     document.getElementById("end_range_{$id}").value = '';
     document.getElementById("{$id}_range_div").style.display = '';
     document.getElementById("{$id}_between_range_div").style.display = 'none';
  {rdelim} else {ldelim}
     document.getElementById("range_{$id}").value = '[' + val + ']';    
     document.getElementById("start_range_{$id}").value = '';
     document.getElementById("end_range_{$id}").value = ''; 
     document.getElementById("{$id}_range_div").style.display = 'none';
     document.getElementById("{$id}_between_range_div").style.display = 'none';         
  {rdelim}
{rdelim}

var {$id}_range_reset = function()
{ldelim}
{$id}_range_change('=');
{rdelim}

YAHOO.util.Event.onDOMReady(function() {ldelim}
if(document.getElementById('search_form_clear'))
{ldelim}
YAHOO.util.Event.addListener('search_form_clear', 'click', {$id}_range_reset);
{rdelim}

{rdelim});

YAHOO.util.Event.onDOMReady(function() {ldelim}
 	if(document.getElementById('search_form_clear_advanced'))
 	 {ldelim}
 	     YAHOO.util.Event.addListener('search_form_clear_advanced', 'click', {$id}_range_reset);
 	 {rdelim}

{rdelim});

YAHOO.util.Event.onDOMReady(function() {ldelim}
    //register on basic search form button if it exists
    if(document.getElementById('search_form_submit'))
     {ldelim}
         YAHOO.util.Event.addListener('search_form_submit', 'click',{$id}_range_validate);
     {rdelim}
    //register on advanced search submit button if it exists
   if(document.getElementById('search_form_submit_advanced'))
    {ldelim}
        YAHOO.util.Event.addListener('search_form_submit_advanced', 'click',{$id}_range_validate);
    {rdelim}

{rdelim});

// this function is specific to range date searches and will check that both start and end date ranges have been
// filled prior to submitting search form.  It is called from the listener added above.
function {$id}_range_validate(e){ldelim}
    if (
            (document.getElementById("start_range_{$id}").value.length >0 && document.getElementById("end_range_{$id}").value.length == 0)
          ||(document.getElementById("end_range_{$id}").value.length >0 && document.getElementById("start_range_{$id}").value.length == 0)
       )
    {ldelim}
        e.preventDefault();
        alert('{$APP.LBL_CHOOSE_START_AND_END_DATES}');
        if (document.getElementById("start_range_{$id}").value.length == 0) {ldelim}
            document.getElementById("start_range_{$id}").focus();
        {rdelim}
        else {ldelim}
            document.getElementById("end_range_{$id}").focus();
        {rdelim}
    {rdelim}

{rdelim}

</script>
   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
		
		<label for='user_allocation_date_c_advanced'>{sugar_translate label='LBL_USER_ALLOCATION_DATE' module='Contacts'}</label>
    	</td>
	<td  nowrap="nowrap" width='25%'>
			
{assign var="id" value=$fields.user_allocation_date_c_advanced.name }

{if isset($smarty.request.user_allocation_date_c_advanced_range_choice)}
{assign var="starting_choice" value=$smarty.request.user_allocation_date_c_advanced_range_choice}
{else}
{assign var="starting_choice" value="="}
{/if}

<div style="white-space:nowrap !important;">
<select id="{$id}_range_choice" name="{$id}_range_choice" style="width:125px !important;" onchange="{$id}_range_change(this.value);">
{html_options options=$fields.user_allocation_date_c_advanced.options selected=$starting_choice}
</select>
</div>

<div id="{$id}_range_div" style="{if preg_match('/^\[/', $smarty.request.range_user_allocation_date_c_advanced)  || $starting_choice == 'between'}display:none{else}display:''{/if};">
<input autocomplete="off" type="text" name="range_{$id}" id="range_{$id}" value='{if empty($smarty.request.range_user_allocation_date_c_advanced) && !empty($smarty.request.user_allocation_date_c_advanced)}{$smarty.request.user_allocation_date_c_advanced}{else}{$smarty.request.range_user_allocation_date_c_advanced}{/if}' title=''   size="11" style="width:100px !important;">
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$id}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "range_{$id}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$id}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
    
</div>

<div id="{$id}_between_range_div" style="{if $starting_choice=='between'}display:'';{else}display:none;{/if}">
{assign var=date_value value=$fields.user_allocation_date_c_advanced.value }
<input autocomplete="off" type="text" name="start_range_{$id}" id="start_range_{$id}" value='{$smarty.request.start_range_user_allocation_date_c_advanced }' title=''  tabindex='' size="11" style="width:100px !important;">
{capture assign="other_attributes"}align="absmiddle" border="0" id="start_range_{$id}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" alt="$APP.LBL_ENTER_DATE other_attributes=$other_attributes"}
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "start_range_{$id}",
daFormat : "{$CALENDAR_FORMAT}",
button : "start_range_{$id}_trigger",
singleClick : true,
dateStr : "{$date_value}",
step : 1,
weekNumbers:false
{rdelim}
);
</script>
 
{$APP.LBL_AND}
{assign var=date_value value=$fields.user_allocation_date_c_advanced.value }
<input autocomplete="off" type="text" name="end_range_{$id}" id="end_range_{$id}" value='{$smarty.request.end_range_user_allocation_date_c_advanced }' title=''  tabindex='' size="11" style="width:100px !important;" maxlength="10">
{capture assign="other_attributes"}align="absmiddle" border="0" id="end_range_{$id}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" alt="$APP.LBL_ENTER_DATE other_attributes=$other_attributes"}
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "end_range_{$id}",
daFormat : "{$CALENDAR_FORMAT}",
button : "end_range_{$id}_trigger",
singleClick : true,
dateStr : "{$date_value}",
step : 1,
weekNumbers:false
{rdelim}
);
</script>
 
</div>


<script type='text/javascript'>

function {$id}_range_change(val) 
{ldelim}
  if(val == 'between') {ldelim}
     document.getElementById("range_{$id}").value = '';  
     document.getElementById("{$id}_range_div").style.display = 'none';
     document.getElementById("{$id}_between_range_div").style.display = ''; 
  {rdelim} else if (val == '=' || val == 'not_equal' || val == 'greater_than' || val == 'less_than') {ldelim}
     if((/^\[.*\]$/).test(document.getElementById("range_{$id}").value))
     {ldelim}
     	document.getElementById("range_{$id}").value = '';
     {rdelim}
     document.getElementById("start_range_{$id}").value = '';
     document.getElementById("end_range_{$id}").value = '';
     document.getElementById("{$id}_range_div").style.display = '';
     document.getElementById("{$id}_between_range_div").style.display = 'none';
  {rdelim} else {ldelim}
     document.getElementById("range_{$id}").value = '[' + val + ']';    
     document.getElementById("start_range_{$id}").value = '';
     document.getElementById("end_range_{$id}").value = ''; 
     document.getElementById("{$id}_range_div").style.display = 'none';
     document.getElementById("{$id}_between_range_div").style.display = 'none';         
  {rdelim}
{rdelim}

var {$id}_range_reset = function()
{ldelim}
{$id}_range_change('=');
{rdelim}

YAHOO.util.Event.onDOMReady(function() {ldelim}
if(document.getElementById('search_form_clear'))
{ldelim}
YAHOO.util.Event.addListener('search_form_clear', 'click', {$id}_range_reset);
{rdelim}

{rdelim});

YAHOO.util.Event.onDOMReady(function() {ldelim}
 	if(document.getElementById('search_form_clear_advanced'))
 	 {ldelim}
 	     YAHOO.util.Event.addListener('search_form_clear_advanced', 'click', {$id}_range_reset);
 	 {rdelim}

{rdelim});

YAHOO.util.Event.onDOMReady(function() {ldelim}
    //register on basic search form button if it exists
    if(document.getElementById('search_form_submit'))
     {ldelim}
         YAHOO.util.Event.addListener('search_form_submit', 'click',{$id}_range_validate);
     {rdelim}
    //register on advanced search submit button if it exists
   if(document.getElementById('search_form_submit_advanced'))
    {ldelim}
        YAHOO.util.Event.addListener('search_form_submit_advanced', 'click',{$id}_range_validate);
    {rdelim}

{rdelim});

// this function is specific to range date searches and will check that both start and end date ranges have been
// filled prior to submitting search form.  It is called from the listener added above.
function {$id}_range_validate(e){ldelim}
    if (
            (document.getElementById("start_range_{$id}").value.length >0 && document.getElementById("end_range_{$id}").value.length == 0)
          ||(document.getElementById("end_range_{$id}").value.length >0 && document.getElementById("start_range_{$id}").value.length == 0)
       )
    {ldelim}
        e.preventDefault();
        alert('{$APP.LBL_CHOOSE_START_AND_END_DATES}');
        if (document.getElementById("start_range_{$id}").value.length == 0) {ldelim}
            document.getElementById("start_range_{$id}").focus();
        {rdelim}
        else {ldelim}
            document.getElementById("end_range_{$id}").focus();
        {rdelim}
    {rdelim}

{rdelim}

</script>
   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
		
		<label for='assigned_user_id_advanced'>{sugar_translate label='LBL_ASSIGNED_TO' module='Contacts'}</label>
    	</td>
	<td  nowrap="nowrap" width='25%'>
			
{html_options id='assigned_user_id_advanced' name='assigned_user_id_advanced[]' options=$fields.assigned_user_id_advanced.options size="6" style="width: 150px" multiple="1" selected=$fields.assigned_user_id_advanced.value}
   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
		
		<label for='related_corporate_account_c_advanced'>{sugar_translate label='LBL_RELATED_CORPORATE_ACCOUNT' module='Contacts'}</label>
    	</td>
	<td  nowrap="nowrap" width='25%'>
			
{if strlen($fields.related_corporate_account_c_advanced.value) <= 0}
{assign var="value" value=$fields.related_corporate_account_c_advanced.default_value }
{else}
{assign var="value" value=$fields.related_corporate_account_c_advanced.value }
{/if}  
<input type='text' name='{$fields.related_corporate_account_c_advanced.name}' 
    id='{$fields.related_corporate_account_c_advanced.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''      >
   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
		
		<label for='custom_date_modified_c_advanced'>{sugar_translate label='LBL_CUSTOM_DATE_MODIFIED' module='Contacts'}</label>
    	</td>
	<td  nowrap="nowrap" width='25%'>
			
{assign var="id" value=$fields.custom_date_modified_c_advanced.name }

{if isset($smarty.request.custom_date_modified_c_advanced_range_choice)}
{assign var="starting_choice" value=$smarty.request.custom_date_modified_c_advanced_range_choice}
{else}
{assign var="starting_choice" value="="}
{/if}

<div style="white-space:nowrap !important;">
<select id="{$id}_range_choice" name="{$id}_range_choice" style="width:125px !important;" onchange="{$id}_range_change(this.value);">
{html_options options=$fields.custom_date_modified_c_advanced.options selected=$starting_choice}
</select>
</div>

<div id="{$id}_range_div" style="{if preg_match('/^\[/', $smarty.request.range_custom_date_modified_c_advanced)  || $starting_choice == 'between'}display:none{else}display:''{/if};">
<input autocomplete="off" type="text" name="range_{$id}" id="range_{$id}" value='{if empty($smarty.request.range_custom_date_modified_c_advanced) && !empty($smarty.request.custom_date_modified_c_advanced)}{$smarty.request.custom_date_modified_c_advanced}{else}{$smarty.request.range_custom_date_modified_c_advanced}{/if}' title=''   size="11" style="width:100px !important;">
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{$id}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "range_{$id}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{$id}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
    
</div>

<div id="{$id}_between_range_div" style="{if $starting_choice=='between'}display:'';{else}display:none;{/if}">
{assign var=date_value value=$fields.custom_date_modified_c_advanced.value }
<input autocomplete="off" type="text" name="start_range_{$id}" id="start_range_{$id}" value='{$smarty.request.start_range_custom_date_modified_c_advanced }' title=''  tabindex='' size="11" style="width:100px !important;">
{capture assign="other_attributes"}align="absmiddle" border="0" id="start_range_{$id}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" alt="$APP.LBL_ENTER_DATE other_attributes=$other_attributes"}
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "start_range_{$id}",
daFormat : "{$CALENDAR_FORMAT}",
button : "start_range_{$id}_trigger",
singleClick : true,
dateStr : "{$date_value}",
step : 1,
weekNumbers:false
{rdelim}
);
</script>
 
{$APP.LBL_AND}
{assign var=date_value value=$fields.custom_date_modified_c_advanced.value }
<input autocomplete="off" type="text" name="end_range_{$id}" id="end_range_{$id}" value='{$smarty.request.end_range_custom_date_modified_c_advanced }' title=''  tabindex='' size="11" style="width:100px !important;" maxlength="10">
{capture assign="other_attributes"}align="absmiddle" border="0" id="end_range_{$id}_trigger"{/capture}
{sugar_getimage name="jscalendar" ext=".gif" alt="$APP.LBL_ENTER_DATE other_attributes=$other_attributes"}
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "end_range_{$id}",
daFormat : "{$CALENDAR_FORMAT}",
button : "end_range_{$id}_trigger",
singleClick : true,
dateStr : "{$date_value}",
step : 1,
weekNumbers:false
{rdelim}
);
</script>
 
</div>


<script type='text/javascript'>

function {$id}_range_change(val) 
{ldelim}
  if(val == 'between') {ldelim}
     document.getElementById("range_{$id}").value = '';  
     document.getElementById("{$id}_range_div").style.display = 'none';
     document.getElementById("{$id}_between_range_div").style.display = ''; 
  {rdelim} else if (val == '=' || val == 'not_equal' || val == 'greater_than' || val == 'less_than') {ldelim}
     if((/^\[.*\]$/).test(document.getElementById("range_{$id}").value))
     {ldelim}
     	document.getElementById("range_{$id}").value = '';
     {rdelim}
     document.getElementById("start_range_{$id}").value = '';
     document.getElementById("end_range_{$id}").value = '';
     document.getElementById("{$id}_range_div").style.display = '';
     document.getElementById("{$id}_between_range_div").style.display = 'none';
  {rdelim} else {ldelim}
     document.getElementById("range_{$id}").value = '[' + val + ']';    
     document.getElementById("start_range_{$id}").value = '';
     document.getElementById("end_range_{$id}").value = ''; 
     document.getElementById("{$id}_range_div").style.display = 'none';
     document.getElementById("{$id}_between_range_div").style.display = 'none';         
  {rdelim}
{rdelim}

var {$id}_range_reset = function()
{ldelim}
{$id}_range_change('=');
{rdelim}

YAHOO.util.Event.onDOMReady(function() {ldelim}
if(document.getElementById('search_form_clear'))
{ldelim}
YAHOO.util.Event.addListener('search_form_clear', 'click', {$id}_range_reset);
{rdelim}

{rdelim});

YAHOO.util.Event.onDOMReady(function() {ldelim}
 	if(document.getElementById('search_form_clear_advanced'))
 	 {ldelim}
 	     YAHOO.util.Event.addListener('search_form_clear_advanced', 'click', {$id}_range_reset);
 	 {rdelim}

{rdelim});

YAHOO.util.Event.onDOMReady(function() {ldelim}
    //register on basic search form button if it exists
    if(document.getElementById('search_form_submit'))
     {ldelim}
         YAHOO.util.Event.addListener('search_form_submit', 'click',{$id}_range_validate);
     {rdelim}
    //register on advanced search submit button if it exists
   if(document.getElementById('search_form_submit_advanced'))
    {ldelim}
        YAHOO.util.Event.addListener('search_form_submit_advanced', 'click',{$id}_range_validate);
    {rdelim}

{rdelim});

// this function is specific to range date searches and will check that both start and end date ranges have been
// filled prior to submitting search form.  It is called from the listener added above.
function {$id}_range_validate(e){ldelim}
    if (
            (document.getElementById("start_range_{$id}").value.length >0 && document.getElementById("end_range_{$id}").value.length == 0)
          ||(document.getElementById("end_range_{$id}").value.length >0 && document.getElementById("start_range_{$id}").value.length == 0)
       )
    {ldelim}
        e.preventDefault();
        alert('{$APP.LBL_CHOOSE_START_AND_END_DATES}');
        if (document.getElementById("start_range_{$id}").value.length == 0) {ldelim}
            document.getElementById("start_range_{$id}").focus();
        {rdelim}
        else {ldelim}
            document.getElementById("end_range_{$id}").focus();
        {rdelim}
    {rdelim}

{rdelim}

</script>
   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
		
		<label for='custom_modified_user_c_advanced'>{sugar_translate label='LBL_CUSTOM_MODIFIED_USER' module='Contacts'}</label>
    	</td>
	<td  nowrap="nowrap" width='25%'>
			
<input type="text" name="{$fields.custom_modified_user_c_advanced.name}"  class="sqsEnabled"   id="{$fields.custom_modified_user_c_advanced.name}" size="" value="{$fields.custom_modified_user_c_advanced.value}" title='' autocomplete="off"  >
<input type="hidden"  id="{$fields.user_id_c_advanced.name}" value="{$fields.user_id_c_advanced.value}">
<span class="id-ff multiple">
<button type="button" name="btn_{$fields.custom_modified_user_c_advanced.name}"   title="{$APP.LBL_SELECT_BUTTON_TITLE}" class="button firstChild" value="{$APP.LBL_SELECT_BUTTON_LABEL}" onclick='open_popup("{$fields.custom_modified_user_c_advanced.module}", 600, 400, "", true, false, {literal}{"call_back_function":"set_return","form_name":"search_form","field_to_name_array":{"id":"user_id_c_advanced","name":"custom_modified_user_c_advanced"}}{/literal}, "single", true);'>{sugar_getimage alt=$app_strings.LBL_ID_FF_SELECT name="id-ff-select" ext=".png" other_attributes=''}</button><button type="button" name="btn_clr_{$fields.custom_modified_user_c_advanced.name}"   title="{$APP.LBL_CLEAR_BUTTON_TITLE}" class="button lastChild" onclick="this.form.{$fields.custom_modified_user_c_advanced.name}.value = ''; this.form.{$fields.user_id_c_advanced.name}.value = '';" value="{$APP.LBL_CLEAR_BUTTON_LABEL}">{sugar_getimage name="id-ff-clear" alt=$app_strings.LBL_ID_FF_CLEAR ext=".png" other_attributes=''}</button>
</span>

   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
		
		<label for='campaign_c_advanced'>{sugar_translate label='LBL_CAMPAIGN' module='Contacts'}</label>
    	</td>
	<td  nowrap="nowrap" width='25%'>
			
{if strlen($fields.campaign_c_advanced.value) <= 0}
{assign var="value" value=$fields.campaign_c_advanced.default_value }
{else}
{assign var="value" value=$fields.campaign_c_advanced.value }
{/if}  
<input type='text' name='{$fields.campaign_c_advanced.name}' 
    id='{$fields.campaign_c_advanced.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''      >
   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
		
		<label for='utm_content_c_advanced'>{sugar_translate label='LBL_UTM_CONTENT' module='Contacts'}</label>
    	</td>
	<td  nowrap="nowrap" width='25%'>
			
{if strlen($fields.utm_content_c_advanced.value) <= 0}
{assign var="value" value=$fields.utm_content_c_advanced.default_value }
{else}
{assign var="value" value=$fields.utm_content_c_advanced.value }
{/if}  
<input type='text' name='{$fields.utm_content_c_advanced.name}' 
    id='{$fields.utm_content_c_advanced.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''      >
   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
		
		<label for='user_type_c_advanced'>{sugar_translate label='LBL_USER_TYPE' module='Contacts'}</label>
    	</td>
	<td  nowrap="nowrap" width='25%'>
			
{html_options id='user_type_c_advanced' name='user_type_c_advanced[]' options=$fields.user_type_c_advanced.options size="6" style="width: 150px" multiple="1" selected=$fields.user_type_c_advanced.value}
   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
		
		<label for='is_1st_time_investor_c_advanced'>{sugar_translate label='LBL_IS_1ST_TIME_INVESTOR' module='Contacts'}</label>
    	</td>
	<td  nowrap="nowrap" width='25%'>
			
{html_options id='is_1st_time_investor_c_advanced' name='is_1st_time_investor_c_advanced[]' options=$fields.is_1st_time_investor_c_advanced.options size="6" style="width: 150px" multiple="1" selected=$fields.is_1st_time_investor_c_advanced.value}
   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
		
		<label for='source_c_advanced'>{sugar_translate label='LBL_SOURCE' module='Contacts'}</label>
    	</td>
	<td  nowrap="nowrap" width='25%'>
			
{if strlen($fields.source_c_advanced.value) <= 0}
{assign var="value" value=$fields.source_c_advanced.default_value }
{else}
{assign var="value" value=$fields.source_c_advanced.value }
{/if}  
<input type='text' name='{$fields.source_c_advanced.name}' 
    id='{$fields.source_c_advanced.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''      >
   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
		
		<label for='city_c_advanced'>{sugar_translate label='LBL_CITY' module='Contacts'}</label>
    	</td>
	<td  nowrap="nowrap" width='25%'>
			
{html_options id='city_c_advanced' name='city_c_advanced[]' options=$fields.city_c_advanced.options size="6" style="width: 150px" multiple="1" selected=$fields.city_c_advanced.value}
   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
		
		<label for='campaign_city_c_advanced'>{sugar_translate label='LBL_CAMPAIGN_CITY' module='Contacts'}</label>
    	</td>
	<td  nowrap="nowrap" width='25%'>
			
{if strlen($fields.campaign_city_c_advanced.value) <= 0}
{assign var="value" value=$fields.campaign_city_c_advanced.default_value }
{else}
{assign var="value" value=$fields.campaign_city_c_advanced.value }
{/if}  
<input type='text' name='{$fields.campaign_city_c_advanced.name}' 
    id='{$fields.campaign_city_c_advanced.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''      >
   	   	</td>
    
      
	
	{counter assign=index}
	{math equation="left % right"
   		  left=$index
          right=$templateMeta.maxColumns
          assign=modVal
    }
	{if ($index % $templateMeta.maxColumns == 1 && $index != 1)}
        {if $isHelperShown==0}
            {assign var="isHelperShown" value="1"}
            <td class="helpIcon" width="*">
                <img alt="{$APP.LBL_SEARCH_HELP_TITLE}" id="helper_popup_image" border="0" src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
            </td>
        {else}
            <td>&nbsp;</td>
        {/if}
		</tr><tr>
	{/if}
	
	<td scope="row" nowrap="nowrap" width='8.3333333333333%' >
		
		<label for='source_of_income_c_advanced'>{sugar_translate label='LBL_SOURCE_OF_INCOME' module='Contacts'}</label>
    	</td>
	<td  nowrap="nowrap" width='25%'>
			
{if strlen($fields.source_of_income_c_advanced.value) <= 0}
{assign var="value" value=$fields.source_of_income_c_advanced.default_value }
{else}
{assign var="value" value=$fields.source_of_income_c_advanced.value }
{/if}  
<input type='text' name='{$fields.source_of_income_c_advanced.name}' 
    id='{$fields.source_of_income_c_advanced.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''      >
   	   	</td>
	</tr>
<tr>
	<td colspan='20'>
		&nbsp;
	</td>
</tr>	
{if $DISPLAY_SAVED_SEARCH}
<tr>
	<td colspan='2'>
		<a class='tabFormAdvLink' onhover href='javascript:toggleInlineSearch()'>
            {capture assign="alt_show_hide"}{sugar_translate label='LBL_ALT_SHOW_OPTIONS'}{/capture}
		{sugar_getimage alt=$alt_show_hide name="advanced_search" ext=".gif" other_attributes='border="0" id="up_down_img" '}&nbsp;{$APP.LNK_SAVED_VIEWS}
		</a><br>
		<input type='hidden' id='showSSDIV' name='showSSDIV' value='{$SHOWSSDIV}'><p>
	</td>
	<td scope='row' width='10%' nowrap="nowrap">
		{sugar_translate label='LBL_SAVE_SEARCH_AS' module='SavedSearch'}:
	</td>
	<td width='30%' nowrap>
		<input type='text' name='saved_search_name'>
		<input type='hidden' name='search_module' value=''>
		<input type='hidden' name='saved_search_action' value=''>
		<input title='{$APP.LBL_SAVE_BUTTON_LABEL}' value='{$APP.LBL_SAVE_BUTTON_LABEL}' class='button' type='button' name='saved_search_submit' onclick='SUGAR.savedViews.setChooser(); return SUGAR.savedViews.saved_search_action("save");'>
	</td>
	<td scope='row' width='10%' nowrap="nowrap">
	    {sugar_translate label='LBL_MODIFY_CURRENT_SEARCH' module='SavedSearch'}:
	</td>
	<td width='30%' nowrap>
        <input class='button' onclick='SUGAR.savedViews.setChooser(); return SUGAR.savedViews.saved_search_action("update")' value='{$APP.LBL_UPDATE}' title='{$APP.LBL_UPDATE}' name='ss_update' id='ss_update' type='button' >
		<input class='button' onclick='return SUGAR.savedViews.saved_search_action("delete", "{sugar_translate label='LBL_DELETE_CONFIRM' module='SavedSearch'}")' value='{$APP.LBL_DELETE}' title='{$APP.LBL_DELETE}' name='ss_delete' id='ss_delete' type='button'>
		<br><span id='curr_search_name'></span>
	</td>
</tr>

<tr>
<td colspan='6'>
<div style='{$DISPLAYSS}' id='inlineSavedSearch' >
	{$SAVED_SEARCH}
</div>
</td>
</tr>

{/if}
{if $displayType != 'popupView'}
<tr>
	<td colspan='5'>
        <input tabindex='2' title='{$APP.LBL_SEARCH_BUTTON_TITLE}' onclick='SUGAR.savedViews.setChooser()' class='button' type='submit' name='button' value='{$APP.LBL_SEARCH_BUTTON_LABEL}' id='search_form_submit_advanced'/>&nbsp;
        <input tabindex='2' title='{$APP.LBL_CLEAR_BUTTON_TITLE}'  onclick='SUGAR.searchForm.clear_form(this.form); document.getElementById("saved_search_select").options[0].selected=true; return false;' class='button' type='button' name='clear' id='search_form_clear_advanced' value='{$APP.LBL_CLEAR_BUTTON_LABEL}'/>
        {if $DOCUMENTS_MODULE}
        &nbsp;<input title="{$APP.LBL_BROWSE_DOCUMENTS_BUTTON_TITLE}" type="button" class="button" value="{$APP.LBL_BROWSE_DOCUMENTS_BUTTON_LABEL}" onclick='open_popup("Documents", 600, 400, "&caller=Documents", true, false, "");' />
        {/if}
        <a id="basic_search_link" href="javascript:void(0)" accesskey="{$APP.LBL_ADV_SEARCH_LNK_KEY}" >{$APP.LNK_BASIC_SEARCH}</a>
        <span class='white-space'>
            &nbsp;&nbsp;&nbsp;{if $SAVED_SEARCHES_OPTIONS}|&nbsp;&nbsp;&nbsp;<b>{$APP.LBL_SAVED_SEARCH_SHORTCUT}</b>&nbsp;
            {$SAVED_SEARCHES_OPTIONS} {/if}
            <span id='go_btn_span' style='display:none'><input tabindex='2' title='go_select' id='go_select'  onclick='SUGAR.searchForm.clear_form(this.form);' class='button' type='button' name='go_select' value=' {$APP.LBL_GO_BUTTON_LABEL} '/></span>	
        </span>
	</td>
	<td class="help">
	    {if $DISPLAY_SEARCH_HELP}
	    <img  border='0' src='{sugar_getimagepath file="help-dashlet.gif"}' class="help-search">
	    {/if}
    </td>
</tr>
{/if}
</table>

<script>
{literal}
	if(typeof(loadSSL_Scripts)=='function'){
		loadSSL_Scripts();
	}
{/literal}	
</script>
<script>
	{literal}
	$(document).ready(function () {
		$( '#basic_search_link' ).one( "click", function() {
			//alert( "This will be displayed only once." );
			SUGAR.searchForm.searchFormSelect('{/literal}{$module}{literal}|basic_search','{/literal}{$module}{literal}|advanced_search');
		});
	});
	{/literal}
</script>{literal}<script language="javascript">if(typeof sqs_objects == 'undefined'){var sqs_objects = new Array;}sqs_objects['search_form_modified_by_name_advanced']={"form":"search_form","method":"get_user_array","field_list":["user_name","id"],"populate_list":["modified_by_name_advanced","modified_user_id_advanced"],"required_list":["modified_user_id"],"conditions":[{"name":"user_name","op":"like_custom","end":"%","value":""}],"limit":"30","no_match_text":"No Match"};sqs_objects['search_form_created_by_name_advanced']={"form":"search_form","method":"get_user_array","field_list":["user_name","id"],"populate_list":["created_by_name_advanced","created_by_advanced"],"required_list":["created_by"],"conditions":[{"name":"user_name","op":"like_custom","end":"%","value":""}],"limit":"30","no_match_text":"No Match"};sqs_objects['search_form_assigned_user_name_advanced']={"form":"search_form","method":"get_user_array","field_list":["user_name","id"],"populate_list":["assigned_user_name_advanced","assigned_user_id_advanced"],"required_list":["assigned_user_id"],"conditions":[{"name":"user_name","op":"like_custom","end":"%","value":""}],"limit":"30","no_match_text":"No Match"};sqs_objects['search_form_account_name_advanced']={"form":"search_form","method":"query","modules":["Accounts"],"group":"or","field_list":["name","id"],"populate_list":["search_form_account_name_advanced","account_id_advanced"],"conditions":[{"name":"name","op":"like_custom","end":"%","value":""}],"required_list":["account_id"],"order":"name","limit":"30","no_match_text":"No Match"};sqs_objects['search_form_report_to_name_advanced']={"form":"search_form","method":"get_contact_array","modules":["Contacts"],"field_list":["salutation","first_name","last_name","id"],"populate_list":["report_to_name_advanced","reports_to_id_advanced","reports_to_id_advanced","reports_to_id_advanced"],"required_list":["reports_to_id"],"group":"or","conditions":[{"name":"first_name","op":"like_custom","end":"%","value":""},{"name":"last_name","op":"like_custom","end":"%","value":""}],"order":"last_name","limit":"30","no_match_text":"No Match"};sqs_objects['search_form_campaign_name_advanced']={"form":"search_form","method":"query","modules":["Campaigns"],"group":"or","field_list":["name","id"],"populate_list":["campaign_id_advanced","campaign_id_advanced"],"conditions":[{"name":"name","op":"like_custom","end":"%","value":""}],"required_list":["campaign_id"],"order":"name","limit":"30","no_match_text":"No Match"};sqs_objects['search_form_custom_modified_user_c_advanced']={"form":"search_form","method":"get_user_array","field_list":["user_name","id"],"populate_list":["custom_modified_user_c_advanced","user_id_c_advanced"],"required_list":["user_id_c"],"conditions":[{"name":"user_name","op":"like_custom","end":"%","value":""}],"limit":"30","no_match_text":"No Match"};</script>{/literal}