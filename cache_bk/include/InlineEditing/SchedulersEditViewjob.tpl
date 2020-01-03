
{if strlen($fields.job.value) <= 0}
{assign var="value" value=$fields.job.default_value }
{else}
{assign var="value" value=$fields.job.value }
{/if}  
<input type='text' name='{$fields.job.name}' 
    id='{$fields.job.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''  tabindex='1'      >