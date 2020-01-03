
{if strlen($fields.name_of_existing_customer_c.value) <= 0}
{assign var="value" value=$fields.name_of_existing_customer_c.default_value }
{else}
{assign var="value" value=$fields.name_of_existing_customer_c.value }
{/if}  
<input type='text' name='{$fields.name_of_existing_customer_c.name}' 
    id='{$fields.name_of_existing_customer_c.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''  tabindex='1'      >