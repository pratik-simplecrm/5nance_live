
{if strlen($fields.final_disposition_c.value) <= 0}
{assign var="value" value=$fields.final_disposition_c.default_value }
{else}
{assign var="value" value=$fields.final_disposition_c.value }
{/if}  
<input type='text' name='{$fields.final_disposition_c.name}' 
    id='{$fields.final_disposition_c.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''  tabindex='1'      >