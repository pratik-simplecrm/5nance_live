
{if strlen($fields.opportunity_value_c.value) <= 0}
{assign var="value" value=$fields.opportunity_value_c.default_value }
{else}
{assign var="value" value=$fields.opportunity_value_c.value }
{/if}  
<input type='text' name='{$fields.opportunity_value_c.name}' 
id='{$fields.opportunity_value_c.name}' size='30' maxlength='26' value='{sugar_number_format var=$value}' title='' tabindex='1'
 >