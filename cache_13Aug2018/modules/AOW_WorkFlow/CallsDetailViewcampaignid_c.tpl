

{if is_string($fields.campaignid_c.options)}
<input type="hidden" class="sugar_field" id="{$fields.campaignid_c.name}" value="{ $fields.campaignid_c.options }">
{ $fields.campaignid_c.options }
{else}
<input type="hidden" class="sugar_field" id="{$fields.campaignid_c.name}" value="{ $fields.campaignid_c.value }">
{ $fields.campaignid_c.options[$fields.campaignid_c.value]}
{/if}
