
{if strlen($fields.unique_customer_code_c.value) <= 0}
{assign var="value" value=$fields.unique_customer_code_c.default_value }
{else}
{assign var="value" value=$fields.unique_customer_code_c.value }
{/if}  
<input type='text' name='{$fields.unique_customer_code_c.name}' 
    id='{$fields.unique_customer_code_c.name}' size='30' 
    maxlength='100' 
    value='{$value}' title=''  tabindex='1'      >