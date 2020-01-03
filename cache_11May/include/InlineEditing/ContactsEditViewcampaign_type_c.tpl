
{if strlen($fields.campaign_type_c.value) <= 0}
{assign var="value" value=$fields.campaign_type_c.default_value }
{else}
{assign var="value" value=$fields.campaign_type_c.value }
{/if}  
<input type='text' name='{$fields.campaign_type_c.name}' 
    id='{$fields.campaign_type_c.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''  tabindex='1'      >