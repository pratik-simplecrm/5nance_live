
{if strlen($fields.aadharcard_no_c.value) <= 0}
{assign var="value" value=$fields.aadharcard_no_c.default_value }
{else}
{assign var="value" value=$fields.aadharcard_no_c.value }
{/if}  
<input type='text' name='{$fields.aadharcard_no_c.name}' 
    id='{$fields.aadharcard_no_c.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''  tabindex='1'      >