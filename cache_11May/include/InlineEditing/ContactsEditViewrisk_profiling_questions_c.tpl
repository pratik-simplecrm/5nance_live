
{if empty($fields.risk_profiling_questions_c.value)}
{assign var="value" value=$fields.risk_profiling_questions_c.default_value }
{else}
{assign var="value" value=$fields.risk_profiling_questions_c.value }
{/if}  




<textarea  id='{$fields.risk_profiling_questions_c.name}' name='{$fields.risk_profiling_questions_c.name}'
rows="2" 
cols="32" 
title='' tabindex="1" 
 >{$value}</textarea>


