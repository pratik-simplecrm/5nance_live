
{if empty($fields.resolution.value)}
{assign var="value" value=$fields.resolution.default_value }
{else}
{assign var="value" value=$fields.resolution.value }
{/if}  




<textarea  id='{$fields.resolution.name}' name='{$fields.resolution.name}'
rows="2" 
cols="32" 
title='' tabindex="1" 
 >{$value}</textarea>


