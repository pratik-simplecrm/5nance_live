<?php
$dashletData['LeadsDashlet']['searchFields'] = array (
  'date_entered' => 
  array (
    'default' => '',
  ),
  'title' => 
  array (
    'default' => '',
  ),
  'primary_address_country' => 
  array (
    'default' => '',
  ),
  'disposition_c' => 
  array (
    'default' => '',
  ),
  'status' => 
  array (
    'default' => '',
  ),
  'assigned_user_name' => 
  array (
    'default' => '',
  ),
  'online_activity_status_c' => 
  array (
    'default' => '',
  ),
  'assigned_user_id' => 
  array (
    'default' => '',
  ),
);
$dashletData['LeadsDashlet']['columns'] = array (
  'name' => 
  array (
    'width' => '10%',
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
  'phone_work' => 
  array (
    'width' => '20%',
    'label' => 'LBL_OFFICE_PHONE',
    'default' => true,
    'name' => 'phone_work',
  ),
  'email1' => 
  array (
    'width' => '10%',
    'label' => 'LBL_EMAIL_ADDRESS',
    'sortable' => false,
    'customCode' => '{$EMAIL1_LINK}{$EMAIL1}</a>',
    'default' => true,
    'name' => 'email1',
  ),
  'gateway_c' => 
  array (
    'label' => 'LBL_GATEWAY',
    'type' => 'enum',
    'width' => '10%',
    'default' => true,
    'name' => 'gateway_c',
  ),
  'date_modified' => 
  array (
    'width' => '15%',
    'label' => 'LBL_DATE_MODIFIED',
    'name' => 'date_modified',
    'default' => true,
  ),
  'date_entered' => 
  array (
    'width' => '15%',
    'label' => 'LBL_LIST_DATE_ENTERED',
    'name' => 'date_entered',
    'default' => true,
  ),
  'lead_source' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LEAD_SOURCE',
    'name' => 'lead_source',
    'default' => false,
  ),
  'modified_by_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_MODIFIED_NAME',
    'id' => 'MODIFIED_USER_ID',
    'width' => '10%',
    'default' => false,
    'name' => 'modified_by_name',
  ),
  'first_name' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_FIRST_NAME',
    'width' => '10%',
    'default' => false,
    'name' => 'first_name',
  ),
  'status' => 
  array (
    'width' => '10%',
    'label' => 'LBL_STATUS',
    'name' => 'status',
    'default' => false,
  ),
  'do_not_call' => 
  array (
    'type' => 'bool',
    'default' => false,
    'label' => 'LBL_DO_NOT_CALL',
    'width' => '10%',
    'name' => 'do_not_call',
  ),
  'annual_income_c' => 
  array (
    'type' => 'currency',
    'default' => false,
    'label' => 'LBL_ANNUAL_INCOME',
    'currency_format' => true,
    'width' => '10%',
    'name' => 'annual_income_c',
  ),
  'family_members_number_c' => 
  array (
    'type' => 'int',
    'default' => false,
    'label' => 'LBL_FAMILY_MEMBERS_NUMBER',
    'width' => '10%',
    'name' => 'family_members_number_c',
  ),
  'best_time_to_speak_to_c' => 
  array (
    'type' => 'datetimecombo',
    'default' => false,
    'label' => 'LBL_BEST_TIME_TO_SPEAK_TO',
    'width' => '10%',
    'name' => 'best_time_to_speak_to_c',
  ),
  'description' => 
  array (
    'type' => 'text',
    'label' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => '10%',
    'default' => false,
    'name' => 'description',
  ),
  'title' => 
  array (
    'width' => '20%',
    'label' => 'LBL_TITLE',
    'default' => false,
    'name' => 'title',
  ),
  'primary_address_street_2' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_PRIMARY_ADDRESS_STREET_2',
    'width' => '10%',
    'default' => false,
    'name' => 'primary_address_street_2',
  ),
  'account_name' => 
  array (
    'width' => '40%',
    'label' => 'LBL_ACCOUNT_NAME',
    'name' => 'account_name',
    'default' => false,
  ),
  'phone_home' => 
  array (
    'width' => '10%',
    'label' => 'LBL_HOME_PHONE',
    'name' => 'phone_home',
    'default' => false,
  ),
  'phone_mobile' => 
  array (
    'width' => '10%',
    'label' => 'LBL_MOBILE_PHONE',
    'name' => 'phone_mobile',
    'default' => false,
  ),
  'phone_other' => 
  array (
    'width' => '10%',
    'label' => 'LBL_OTHER_PHONE',
    'name' => 'phone_other',
    'default' => false,
  ),
  'created_by' => 
  array (
    'width' => '8%',
    'label' => 'LBL_CREATED',
    'name' => 'created_by',
    'default' => false,
  ),
  'assigned_user_name' => 
  array (
    'width' => '8%',
    'label' => 'LBL_LIST_ASSIGNED_USER',
    'name' => 'assigned_user_name',
    'default' => false,
  ),
);
