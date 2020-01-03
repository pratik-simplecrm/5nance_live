
{if strlen($fields.historical_session_data_c.value) <= 0}
{assign var="value" value=$fields.historical_session_data_c.default_value }
{else}
{assign var="value" value=$fields.historical_session_data_c.value }
{/if}  
<input type='text' name='{$fields.historical_session_data_c.name}' 
    id='{$fields.historical_session_data_c.name}' size='30' 
    maxlength='150' 
    value='{$value}' title=''  tabindex='1'      >