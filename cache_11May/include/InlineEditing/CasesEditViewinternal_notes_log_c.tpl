
{if empty($fields.internal_notes_log_c.value)}
{assign var="value" value=$fields.internal_notes_log_c.default_value }
{else}
{assign var="value" value=$fields.internal_notes_log_c.value }
{/if}  




<textarea  id='{$fields.internal_notes_log_c.name}' name='{$fields.internal_notes_log_c.name}'
rows="2" 
cols="32" 
title='' tabindex="1" 
 >{$value}</textarea>


