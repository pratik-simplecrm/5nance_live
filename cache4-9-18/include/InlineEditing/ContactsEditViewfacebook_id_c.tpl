
{if strlen($fields.facebook_id_c.value) <= 0}
{assign var="value" value=$fields.facebook_id_c.default_value }
{else}
{assign var="value" value=$fields.facebook_id_c.value }
{/if}  
<input type='text' name='{$fields.facebook_id_c.name}' 
    id='{$fields.facebook_id_c.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''  tabindex='1'      >