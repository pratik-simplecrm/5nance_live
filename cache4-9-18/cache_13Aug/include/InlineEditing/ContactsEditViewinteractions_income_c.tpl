
{if strlen($fields.interactions_income_c.value) <= 0}
{assign var="value" value=$fields.interactions_income_c.default_value }
{else}
{assign var="value" value=$fields.interactions_income_c.value }
{/if}  
<input type='text' name='{$fields.interactions_income_c.name}' 
    id='{$fields.interactions_income_c.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''  tabindex='1'      >