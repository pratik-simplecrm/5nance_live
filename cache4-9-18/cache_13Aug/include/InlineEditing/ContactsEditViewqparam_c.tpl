
{if strlen($fields.qparam_c.value) <= 0}
{assign var="value" value=$fields.qparam_c.default_value }
{else}
{assign var="value" value=$fields.qparam_c.value }
{/if}  
<input type='text' name='{$fields.qparam_c.name}' 
    id='{$fields.qparam_c.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''  tabindex='1'      >