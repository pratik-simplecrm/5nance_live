
{if strlen($fields.campaign_c.value) <= 0}
{assign var="value" value=$fields.campaign_c.default_value }
{else}
{assign var="value" value=$fields.campaign_c.value }
{/if}  
<input type='text' name='{$fields.campaign_c.name}' 
    id='{$fields.campaign_c.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''  tabindex='1'      >