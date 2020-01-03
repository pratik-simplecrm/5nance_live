
{if strlen($fields.download_link_c.value) <= 0}
{assign var="value" value=$fields.download_link_c.default_value }
{else}
{assign var="value" value=$fields.download_link_c.value }
{/if}  
<input type='text' name='{$fields.download_link_c.name}' 
    id='{$fields.download_link_c.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''  tabindex='1'      >