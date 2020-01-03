
{if strlen($fields.job_interval.value) <= 0}
{assign var="value" value=$fields.job_interval.default_value }
{else}
{assign var="value" value=$fields.job_interval.value }
{/if}  
<input type='text' name='{$fields.job_interval.name}' 
    id='{$fields.job_interval.name}' size='30' 
    maxlength='100' 
    value='{$value}' title=''  tabindex='1'      >