
{if empty($fields.address_c.value)}
{assign var="value" value=$fields.address_c.default_value }
{else}
{assign var="value" value=$fields.address_c.value }
{/if}  




<textarea  id='{$fields.address_c.name}' name='{$fields.address_c.name}'
rows="2" 
cols="32" 
title='' tabindex="1" 
 >{$value}</textarea>


