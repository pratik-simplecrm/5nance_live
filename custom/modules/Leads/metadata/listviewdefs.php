<?php
$listViewDefs ['Leads'] = 
array (
  'NAME' => 
  array (
    'width' => '50%',
    'label' => 'LBL_LIST_NAME',
    'link' => true,
    'orderBy' => 'name',
    'default' => true,
    'related_fields' => 
    array (
      0 => 'first_name',
      1 => 'last_name',
      2 => 'salutation',
    ),
  ),
  'LEADID_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_LEADID',
    'width' => '10%',
  ),
  'PHONE_MOBILE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_MOBILE_PHONE',
    'default' => true,
  ),
  'EMAIL1' => 
  array (
    'width' => '16%',
    'label' => 'LBL_LIST_EMAIL_ADDRESS',
    'sortable' => false,
    'customCode' => '{$EMAIL1_LINK}{$EMAIL1}</a>',
    'default' => true,
  ),
  'STATUS' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_STATUS',
    'default' => true,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '5%',
    'label' => 'LBL_LIST_ASSIGNED_USER',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
  'GATEWAY_C' => 
  array (
    'label' => 'LBL_GATEWAY',
    'type' => 'enum',
    'width' => '10%',
    'default' => true,
  ),
  'USER_ALLOCATION_DATE_C' => 
  array (
    'type' => 'datetimecombo',
    'default' => true,
    'label' => 'LBL_USER_ALLOCATION_DATE',
    'width' => '10%',
  ),
  'DATE_ENTERED' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DATE_ENTERED',
    'default' => true,
  ),
  'TITLE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_TITLE',
    'default' => false,
  ),
  'REFERED_BY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_REFERED_BY',
    'default' => false,
  ),
  'LEAD_SOURCE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LEAD_SOURCE',
    'default' => false,
  ),
  'PHONE_WORK' => 
  array (
    'width' => '15%',
    'label' => 'LBL_LIST_PHONE',
    'default' => false,
  ),
  'DEPARTMENT' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DEPARTMENT',
    'default' => false,
  ),
  'ACCOUNT_NAME' => 
  array (
    'width' => '15%',
    'label' => 'LBL_LIST_ACCOUNT_NAME',
    'default' => false,
    'related_fields' => 
    array (
      0 => 'account_id',
    ),
  ),
  'DO_NOT_CALL' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DO_NOT_CALL',
    'default' => false,
  ),
  'PHONE_HOME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_HOME_PHONE',
    'default' => false,
  ),
  'PHONE_OTHER' => 
  array (
    'width' => '10%',
    'label' => 'LBL_OTHER_PHONE',
    'default' => false,
  ),
  'PHONE_FAX' => 
  array (
    'width' => '10%',
    'label' => 'LBL_FAX_PHONE',
    'default' => false,
  ),
  'PRIMARY_ADDRESS_COUNTRY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_PRIMARY_ADDRESS_COUNTRY',
    'default' => false,
  ),
  'PRIMARY_ADDRESS_STREET' => 
  array (
    'width' => '10%',
    'label' => 'LBL_PRIMARY_ADDRESS_STREET',
    'default' => false,
  ),
  'PRIMARY_ADDRESS_CITY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_PRIMARY_ADDRESS_CITY',
    'default' => false,
  ),
  'PRIMARY_ADDRESS_STATE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_PRIMARY_ADDRESS_STATE',
    'default' => false,
  ),
  'PRIMARY_ADDRESS_POSTALCODE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_PRIMARY_ADDRESS_POSTALCODE',
    'default' => false,
  ),
  'ALT_ADDRESS_COUNTRY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_ALT_ADDRESS_COUNTRY',
    'default' => false,
  ),
  'ALT_ADDRESS_STREET' => 
  array (
    'width' => '10%',
    'label' => 'LBL_ALT_ADDRESS_STREET',
    'default' => false,
  ),
  'ALT_ADDRESS_CITY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_ALT_ADDRESS_CITY',
    'default' => false,
  ),
  'ALT_ADDRESS_STATE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_ALT_ADDRESS_STATE',
    'default' => false,
  ),
  'ALT_ADDRESS_POSTALCODE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_ALT_ADDRESS_POSTALCODE',
    'default' => false,
  ),
  'CREATED_BY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_CREATED',
    'default' => false,
  ),
  'MODIFIED_BY_NAME' => 
  array (
    'width' => '5%',
    'label' => 'LBL_MODIFIED',
    'default' => false,
  ),
);
?>
