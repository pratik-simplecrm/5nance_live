
{if strlen($fields.age_of_the_user_c.value) <= 0}
{assign var="value" value=$fields.age_of_the_user_c.default_value }
{else}
{assign var="value" value=$fields.age_of_the_user_c.value }
{/if}  
<input type='text' name='{$fields.age_of_the_user_c.name}' 
id='{$fields.age_of_the_user_c.name}' size='30' maxlength='255' value='{sugar_number_format precision=0 var=$value}' title='' tabindex='1'    >