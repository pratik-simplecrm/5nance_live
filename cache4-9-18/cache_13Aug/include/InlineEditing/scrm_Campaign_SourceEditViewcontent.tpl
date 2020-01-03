
{if strlen($fields.content.value) <= 0}
{assign var="value" value=$fields.content.default_value }
{else}
{assign var="value" value=$fields.content.value }
{/if}  
<input type='text' name='{$fields.content.name}' 
    id='{$fields.content.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''  tabindex='1'      >