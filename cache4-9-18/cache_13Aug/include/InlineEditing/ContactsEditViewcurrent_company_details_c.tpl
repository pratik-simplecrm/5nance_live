
{if empty($fields.current_company_details_c.value)}
{assign var="value" value=$fields.current_company_details_c.default_value }
{else}
{assign var="value" value=$fields.current_company_details_c.value }
{/if}  




<textarea  id='{$fields.current_company_details_c.name}' name='{$fields.current_company_details_c.name}'
rows="2" 
cols="32" 
title='' tabindex="1" 
 >{$value}</textarea>


