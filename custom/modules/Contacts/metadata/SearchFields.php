<?php
// created: 2019-10-15 11:07:57
$searchFields['Contacts'] = array (
  'first_name' => 
  array (
    'query_type' => 'default',
  ),
  'last_name' => 
  array (
    'query_type' => 'default',
  ),
  'search_name' => 
  array (
    'query_type' => 'default',
    'db_field' => 
    array (
      0 => 'first_name',
      1 => 'last_name',
    ),
    'force_unifiedsearch' => true,
  ),
  'account_name' => 
  array (
    'query_type' => 'default',
    'db_field' => 
    array (
      0 => 'accounts.name',
    ),
  ),
  'lead_source' => 
  array (
    'query_type' => 'default',
    'operator' => '=',
    'options' => 'lead_source_dom',
    'template_var' => 'LEAD_SOURCE_OPTIONS',
  ),
  'do_not_call' => 
  array (
    'query_type' => 'default',
    'input_type' => 'checkbox',
    'operator' => '=',
  ),
  'phone' => 
  array (
    'query_type' => 'default',
    'db_field' => 
    array (
      0 => 'phone_mobile',
      1 => 'phone_work',
      2 => 'phone_other',
      3 => 'phone_fax',
      4 => 'assistant_phone',
    ),
  ),
  'email' => 
  array (
    'query_type' => 'default',
    'operator' => 'subquery',
    'subquery' => 'SELECT eabr.bean_id FROM email_addr_bean_rel eabr JOIN email_addresses ea ON (ea.id = eabr.email_address_id) WHERE eabr.deleted=0 AND ea.email_address LIKE',
    'db_field' => 
    array (
      0 => 'id',
    ),
  ),
  'favorites_only' => 
  array (
    'query_type' => 'format',
    'operator' => 'subquery',
    'subquery' => 'SELECT favorites.parent_id FROM favorites
			                    WHERE favorites.deleted = 0
			                        and favorites.parent_type = "Contacts"
			                        and favorites.assigned_user_id = "1") OR NOT ({0}',
    'db_field' => 
    array (
      0 => 'id',
    ),
  ),
  'assistant' => 
  array (
    'query_type' => 'default',
  ),
  'address_street' => 
  array (
    'query_type' => 'default',
    'db_field' => 
    array (
      0 => 'primary_address_street',
      1 => 'alt_address_street',
    ),
  ),
  'address_city' => 
  array (
    'query_type' => 'default',
    'db_field' => 
    array (
      0 => 'primary_address_city',
      1 => 'alt_address_city',
    ),
  ),
  'address_state' => 
  array (
    'query_type' => 'default',
    'db_field' => 
    array (
      0 => 'primary_address_state',
      1 => 'alt_address_state',
    ),
  ),
  'address_postalcode' => 
  array (
    'query_type' => 'default',
    'db_field' => 
    array (
      0 => 'primary_address_postalcode',
      1 => 'alt_address_postalcode',
    ),
  ),
  'address_country' => 
  array (
    'query_type' => 'default',
    'db_field' => 
    array (
      0 => 'primary_address_country',
      1 => 'alt_address_country',
    ),
  ),
  'current_user_only' => 
  array (
    'query_type' => 'default',
    'db_field' => 
    array (
      0 => 'assigned_user_id',
    ),
    'my_items' => true,
    'vname' => 'LBL_CURRENT_USER_FILTER',
    'type' => 'bool',
  ),
  'assigned_user_id' => 
  array (
    'query_type' => 'default',
  ),
  'account_id' => 
  array (
    'query_type' => 'default',
    'db_field' => 
    array (
      0 => 'accounts.id',
    ),
  ),
  'campaign_name' => 
  array (
    'query_type' => 'default',
  ),
  'range_date_entered' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'start_range_date_entered' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'end_range_date_entered' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'range_date_modified' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'start_range_date_modified' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'end_range_date_modified' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'is_email_verified_c' => 
  array (
    'query_type' => 'default',
  ),
  'is_mobile_number_verified_c' => 
  array (
    'query_type' => 'default',
  ),
  'date_entered' => 
  array (
    'query_type' => 'default',
  ),
  'email1' => 
  array (
    'query_type' => 'default',
  ),
  'phone_mobile' => 
  array (
    'query_type' => 'default',
  ),
  'primary_address_city' => 
  array (
    'query_type' => 'default',
  ),
  'range_user_allocation_date_c' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'start_range_user_allocation_date_c' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'end_range_user_allocation_date_c' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'range_next_call_planning_date_c' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'start_range_next_call_planning_date_c' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'end_range_next_call_planning_date_c' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'next_call_planning_date_c' => 
  array (
    'query_type' => 'default',
  ),
  'date_modified' => 
  array (
    'query_type' => 'default',
  ),
  'range_custom_date_modified' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'start_range_custom_date_modified' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'end_range_custom_date_modified' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'range_custom_date_modified_c' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'start_range_custom_date_modified_c' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
  'end_range_custom_date_modified_c' => 
  array (
    'query_type' => 'default',
    'enable_range_search' => true,
    'is_date_field' => true,
  ),
);