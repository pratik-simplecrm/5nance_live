
{if strlen($fields.encrypted_otp_c.value) <= 0}
{assign var="value" value=$fields.encrypted_otp_c.default_value }
{else}
{assign var="value" value=$fields.encrypted_otp_c.value }
{/if}  
<input type='text' name='{$fields.encrypted_otp_c.name}' 
    id='{$fields.encrypted_otp_c.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''  tabindex='1'      >