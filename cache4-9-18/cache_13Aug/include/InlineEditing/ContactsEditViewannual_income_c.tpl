
{if strlen($fields.annual_income_c.value) <= 0}
{assign var="value" value=$fields.annual_income_c.default_value }
{else}
{assign var="value" value=$fields.annual_income_c.value }
{/if}  
<input type='text' name='{$fields.annual_income_c.name}' 
id='{$fields.annual_income_c.name}' size='30' maxlength='26' value='{sugar_number_format var=$value}' title='' tabindex='1'
 >