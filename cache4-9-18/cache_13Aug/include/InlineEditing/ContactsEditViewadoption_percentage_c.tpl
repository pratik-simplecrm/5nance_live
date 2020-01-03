
{if strlen($fields.adoption_percentage_c.value) <= 0}
{assign var="value" value=$fields.adoption_percentage_c.default_value }
{else}
{assign var="value" value=$fields.adoption_percentage_c.value }
{/if}  
<input type='text' name='{$fields.adoption_percentage_c.name}'
id='{$fields.adoption_percentage_c.name}'
size='30'
maxlength='12'value='{sugar_number_format var=$value  }'
title=''
tabindex='1'
 
>