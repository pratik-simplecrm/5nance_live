
{if empty($fields.next_call_planning_comments_c.value)}
{assign var="value" value=$fields.next_call_planning_comments_c.default_value }
{else}
{assign var="value" value=$fields.next_call_planning_comments_c.value }
{/if}  




<textarea  id='{$fields.next_call_planning_comments_c.name}' name='{$fields.next_call_planning_comments_c.name}'
rows="2" 
cols="32" 
title='' tabindex="1" 
 >{$value}</textarea>


