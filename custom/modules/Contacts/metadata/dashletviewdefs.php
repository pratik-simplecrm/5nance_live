<?php
$dashletData['ContactsDashlet']['searchFields'] = array (
  'date_entered' => 
  array (
    'default' => '',
  ),
  'date_modified' => 
  array (
    'default' => '',
  ),
  'user_allocation_date_c' => 
  array (
    'default' => '',
  ),
  'online_activity_status_c' => 
  array (
    'default' => '',
  ),
  'title' => 
  array (
    'default' => '',
  ),
  'cart_type_c' => 
  array (
    'default' => '',
  ),
  'cart_invoice_date_c' => 
  array (
    'default' => '',
  ),
  'invoicedate_c' => 
  array (
    'default' => '',
  ),
  'transactionsubtype_c' => 
  array (
    'default' => '',
  ),
  'primary_address_country' => 
  array (
    'default' => '',
  ),
  'uploaded_cheque_image_c' => 
  array (
    'default' => '',
  ),
  'document_submitted_cente_c' => 
  array (
    'default' => '',
  ),
  'kyc_verification_status_c' => 
  array (
    'default' => '',
  ),
  'modified_by_name' => 
  array (
    'default' => '',
  ),
  'assigned_user_id' => 
  array (
    'default' => '',
  ),
  'sales_stage_c' => 
  array (
    'default' => '',
  ),
  'disposition_c' => 
  array (
    'default' => '',
  ),
);
$dashletData['ContactsDashlet']['columns'] = array (
  'name' => 
  array (
    'width' => '16%',
    'label' => 'LBL_NAME',
    'link' => true,
    'default' => true,
    'related_fields' => 
    array (
      0 => 'first_name',
      1 => 'last_name',
      2 => 'salutation',
    ),
    'name' => 'name',
  ),
  'phone_mobile' => 
  array (
    'width' => '16%',
    'label' => 'LBL_MOBILE_PHONE',
    'name' => 'phone_mobile',
    'default' => true,
  ),
  'email1' => 
  array (
    'width' => '16%',
    'label' => 'LBL_EMAIL_ADDRESS',
    'sortable' => false,
    'customCode' => '{$EMAIL1_LINK}{$EMAIL1}</a>',
    'name' => 'email1',
    'default' => true,
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
  'user_allocation_date_c' => 
  array (
    'type' => 'datetimecombo',
    'default' => true,
    'label' => 'LBL_USER_ALLOCATION_DATE',
    'width' => '10%',
    'name' => 'user_allocation_date_c',
  ),
  'date_entered' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => true,
    'name' => 'date_entered',
  ),
  'assigned_user_name' => 
  array (
    'width' => '16%',
    'label' => 'LBL_LIST_ASSIGNED_USER',
    'default' => false,
    'name' => 'assigned_user_name',
  ),
  'sales_stage_c' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_SALES_STAGE',
    'width' => '16%',
    'name' => 'sales_stage_c',
  ),
  'cart_amount_c' => 
  array (
    'type' => 'currency',
    'default' => false,
    'label' => 'LBL_CART_AMOUNT',
    'currency_format' => true,
    'width' => '10%',
    'name' => 'cart_amount_c',
  ),
  'cart_scheme_name_c' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_CART_SCHEME_NAME',
    'width' => '10%',
    'name' => 'cart_scheme_name_c',
  ),
  'amount_c' => 
  array (
    'type' => 'currency',
    'default' => false,
    'label' => 'LBL_AMOUNT',
    'currency_format' => true,
    'width' => '10%',
    'name' => 'amount_c',
  ),
  'schemename_c' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_SCHEMENAME',
    'width' => '10%',
    'name' => 'schemename_c',
  ),
  'monthly_income_details_c' => 
  array (
    'type' => 'currency',
    'default' => false,
    'label' => 'LBL_MONTHLY_INCOME_DETAILS',
    'currency_format' => true,
    'width' => '10%',
    'name' => 'monthly_income_details_c',
  ),
  'transactionsubtype_c' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_TRANSACTIONSUBTYPE',
    'width' => '10%',
    'name' => 'transactionsubtype_c',
  ),
  'cart_invoice_date_c' => 
  array (
    'type' => 'date',
    'default' => false,
    'label' => 'LBL_CART_INVOICE_DATE',
    'width' => '10%',
    'name' => 'cart_invoice_date_c',
  ),
  'date_modified' => 
  array (
    'width' => '15%',
    'label' => 'LBL_DATE_MODIFIED',
    'name' => 'date_modified',
    'default' => false,
  ),
  'created_by' => 
  array (
    'width' => '8%',
    'label' => 'LBL_CREATED',
    'name' => 'created_by',
    'default' => false,
  ),
  'source_c' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_SOURCE',
    'width' => '10%',
    'name' => 'source_c',
  ),
  'campaign_c' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_CAMPAIGN',
    'width' => '10%',
    'name' => 'campaign_c',
  ),
  'monthly_expense_details_c' => 
  array (
    'type' => 'currency',
    'default' => false,
    'label' => 'LBL_MONTHLY_EXPENSE_DETAILS',
    'currency_format' => true,
    'width' => '10%',
    'name' => 'monthly_expense_details_c',
  ),
  'is_1st_time_investor_c' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_IS_1ST_TIME_INVESTOR',
    'width' => '10%',
    'name' => 'is_1st_time_investor_c',
  ),
  'campaign_city_c' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_CAMPAIGN_CITY',
    'width' => '10%',
    'name' => 'campaign_city_c',
  ),
  'source_of_income_c' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_SOURCE_OF_INCOME',
    'width' => '10%',
    'name' => 'source_of_income_c',
  ),
  'contact_priority_c' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_CONTACT_PRIORITY_C',
    'width' => '10%',
  ),
);
