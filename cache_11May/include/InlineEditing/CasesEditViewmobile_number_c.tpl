
{if strlen($fields.mobile_number_c.value) <= 0}
{assign var="value" value=$fields.mobile_number_c.default_value }
{else}
{assign var="value" value=$fields.mobile_number_c.value }
{/if}  
<input type='text' name='{$fields.mobile_number_c.name}' 
    id='{$fields.mobile_number_c.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''  tabindex='1'      >