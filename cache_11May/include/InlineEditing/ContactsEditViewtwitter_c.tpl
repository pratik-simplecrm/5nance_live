
{if strlen($fields.twitter_c.value) <= 0}
{assign var="value" value=$fields.twitter_c.default_value }
{else}
{assign var="value" value=$fields.twitter_c.value }
{/if}  
<input type='text' name='{$fields.twitter_c.name}' 
    id='{$fields.twitter_c.name}' size='30' 
    maxlength='255' 
    value='{$value}' title=''  tabindex='1'      >