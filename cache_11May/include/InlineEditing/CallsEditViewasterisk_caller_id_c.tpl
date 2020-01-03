
{if strlen($fields.asterisk_caller_id_c.value) <= 0}
{assign var="value" value=$fields.asterisk_caller_id_c.default_value }
{else}
{assign var="value" value=$fields.asterisk_caller_id_c.value }
{/if}  
<input type='text' name='{$fields.asterisk_caller_id_c.name}' 
    id='{$fields.asterisk_caller_id_c.name}' size='30' 
    maxlength='45' 
    value='{$value}' title='trimmed callerId'  tabindex='1'      >