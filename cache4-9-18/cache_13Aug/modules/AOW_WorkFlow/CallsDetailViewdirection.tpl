

{if is_string($fields.direction.options)}
<input type="hidden" class="sugar_field" id="{$fields.direction.name}" value="{ $fields.direction.options }">
{ $fields.direction.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.direction.name}" value="{ $fields.direction.value }">
{ $fields.direction.options[$fields.direction.value]}
{/if}
