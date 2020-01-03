
{if strlen($fields.leadid_c.value) <= 0}
{assign var="value" value=$fields.leadid_c.default_value }
{else}
{assign var="value" value=$fields.leadid_c.value }
{/if}  
<input type='text' name='{$fields.leadid_c.name}' 
    id='{$fields.leadid_c.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''  tabindex='1'      >