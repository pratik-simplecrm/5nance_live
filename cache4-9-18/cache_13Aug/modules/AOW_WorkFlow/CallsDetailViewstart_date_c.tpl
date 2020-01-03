

    {if strlen($fields.start_date_c.value) <= 0}
        {assign var="value" value=$fields.start_date_c.default_value }
    {else}
        {assign var="value" value=$fields.start_date_c.value }
    {/if}



<span class="sugar_field" id="{$fields.start_date_c.name}">{$value}</span>
