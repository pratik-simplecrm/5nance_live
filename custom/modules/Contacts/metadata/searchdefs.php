<?php
$searchdefs ['Contacts'] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'search_name' => 
      array (
        'name' => 'search_name',
        'label' => 'LBL_NAME',
        'type' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'phone_mobile' => 
      array (
        'type' => 'phone',
        'label' => 'LBL_MOBILE_PHONE',
        'width' => '10%',
        'default' => true,
        'name' => 'phone_mobile',
      ),
      'current_user_only' => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
        'default' => true,
        'width' => '10%',
      ),
      'favorites_only' => 
      array (
        'name' => 'favorites_only',
        'label' => 'LBL_FAVORITES_FILTER',
        'type' => 'bool',
        'default' => true,
        'width' => '10%',
      ),
      'unique_customer_code_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_UNIQUE_CUSTOMER_CODE',
        'width' => '10%',
        'name' => 'unique_customer_code_c',
      ),
    ),
    'advanced_search' => 
    array (
      'first_name' => 
      array (
        'name' => 'first_name',
        'default' => true,
        'width' => '10%',
      ),
      'last_name' => 
      array (
        'name' => 'last_name',
        'default' => true,
        'width' => '10%',
      ),
      'phone' => 
      array (
        'name' => 'phone',
        'label' => 'LBL_ANY_PHONE',
        'type' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'unique_customer_code_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_UNIQUE_CUSTOMER_CODE',
        'width' => '10%',
        'name' => 'unique_customer_code_c',
      ),
      'email' => 
      array (
        'name' => 'email',
        'label' => 'LBL_ANY_EMAIL',
        'type' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'no_of_attempts_c' => 
      array (
        'type' => 'int',
        'default' => true,
        'label' => 'LBL_NO_OF_ATTEMPTS',
        'width' => '10%',
        'name' => 'no_of_attempts_c',
      ),
      'campaign_type_c' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_CAMPAIGN_TYPE',
        'width' => '10%',
        'default' => true,
        'name' => 'campaign_type_c',
      ),
      'gateway_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_GATEWAY',
        'width' => '10%',
        'name' => 'gateway_c',
      ),
      'sales_stage_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_SALES_STAGE',
        'width' => '10%',
        'name' => 'sales_stage_c',
      ),
      'product_interest_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_PRODUCT_INTEREST',
        'width' => '10%',
        'name' => 'product_interest_c',
      ),
      'next_call_planning_date_c' => 
      array (
        'type' => 'datetimecombo',
        'label' => 'LBL_NEXT_CALL_PLANNING_DATE',
        'width' => '10%',
        'default' => true,
        'name' => 'next_call_planning_date_c',
      ),
      'disposition_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_DISPOSITION',
        'width' => '10%',
        'name' => 'disposition_c',
      ),
      'age_c' => 
      array (
        'type' => 'int',
        'default' => true,
        'label' => 'LBL_AGE',
        'width' => '10%',
        'name' => 'age_c',
      ),
      'publisher_name_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_PUBLISHER_NAME',
        'width' => '10%',
        'name' => 'publisher_name_c',
      ),
      'date_entered' => 
      array (
        'type' => 'datetime',
        'label' => 'LBL_DATE_ENTERED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_entered',
      ),
      'user_allocation_date_c' => 
      array (
        'type' => 'datetimecombo',
        'default' => true,
        'label' => 'LBL_USER_ALLOCATION_DATE',
        'width' => '10%',
        'name' => 'user_allocation_date_c',
      ),
      'assigned_user_id' => 
      array (
        'name' => 'assigned_user_id',
        'type' => 'enum',
        'label' => 'LBL_ASSIGNED_TO',
        'function' => 
        array (
          'name' => 'get_user_array',
          'params' => 
          array (
            0 => false,
          ),
        ),
        'default' => true,
        'width' => '10%',
      ),
      'related_corporate_account_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_RELATED_CORPORATE_ACCOUNT',
        'width' => '10%',
        'name' => 'related_corporate_account_c',
      ),
      'campaign_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_CAMPAIGN',
        'width' => '10%',
        'name' => 'campaign_c',
      ),
      'user_type_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_USER_TYPE',
        'width' => '10%',
        'name' => 'user_type_c',
      ),
      'is_1st_time_investor_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_IS_1ST_TIME_INVESTOR',
        'width' => '10%',
        'name' => 'is_1st_time_investor_c',
      ),
      'source_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_SOURCE',
        'width' => '10%',
        'name' => 'source_c',
      ),
      'city_c' => 
      array (
        'type' => 'dynamicenum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_CITY',
        'width' => '10%',
        'name' => 'city_c',
      ),
      'campaign_city_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_CAMPAIGN_CITY',
        'width' => '10%',
        'name' => 'campaign_city_c',
      ),
      'annual_income_c' => 
      array (
        'type' => 'currency',
        'default' => true,
        'label' => 'LBL_ANNUAL_INCOME',
        'currency_format' => true,
        'width' => '10%',
        'name' => 'annual_income_c',
      ),
      'contact_priority_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_CONTACT_PRIORITY_C',
        'width' => '10%',
        'name' => 'contact_priority_c',
      ),
      'source_of_income_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_SOURCE_OF_INCOME',
        'width' => '10%',
        'name' => 'source_of_income_c',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
?>
