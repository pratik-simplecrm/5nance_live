
{if strlen($fields.status_of_first_call_c.value) <= 0}
{assign var="value" value=$fields.status_of_first_call_c.default_value }
{else}
{assign var="value" value=$fields.status_of_first_call_c.value }
{/if}  
<input type='text' name='{$fields.status_of_first_call_c.name}' 
    id='{$fields.status_of_first_call_c.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''  tabindex='1'      >