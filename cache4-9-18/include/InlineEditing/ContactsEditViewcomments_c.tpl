
{if empty($fields.comments_c.value)}
{assign var="value" value=$fields.comments_c.default_value }
{else}
{assign var="value" value=$fields.comments_c.value }
{/if}  




<textarea  id='{$fields.comments_c.name}' name='{$fields.comments_c.name}'
rows="2" 
cols="32" 
title='' tabindex="1" 
 >{$value}</textarea>


