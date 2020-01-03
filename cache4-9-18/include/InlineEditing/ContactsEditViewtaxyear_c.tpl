
{if strlen($fields.taxyear_c.value) <= 0}
{assign var="value" value=$fields.taxyear_c.default_value }
{else}
{assign var="value" value=$fields.taxyear_c.value }
{/if}  
<input type='text' name='{$fields.taxyear_c.name}' 
    id='{$fields.taxyear_c.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''  tabindex='1'      >