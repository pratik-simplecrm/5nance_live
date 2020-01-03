<?php
$listViewDefs ['Users'] = 
array (
  'NAME' => 
  array (
    'width' => '12%',
    'label' => 'LBL_LIST_NAME',
    'link' => true,
    'related_fields' => 
    array (
      0 => 'last_name',
      1 => 'first_name',
    ),
    'orderBy' => 'last_name',
    'default' => true,
  ),
  'USER_NAME' => 
  array (
    'width' => '12%',
    'label' => 'LBL_USER_NAME',
    'link' => true,
    'default' => true,
  ),
  'TITLE' => 
  array (
    'width' => '12%',
    'label' => 'LBL_TITLE',
    'link' => true,
    'default' => true,
  ),
  'REPORTS_TO_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_REPORTS_TO_NAME',
    'id' => 'REPORTS_TO_ID',
    'width' => '12%',
    'default' => true,
  ),
  'EMAIL1' => 
  array (
    'width' => '12%',
    'sortable' => false,
    'label' => 'LBL_LIST_EMAIL',
    'link' => true,
    'default' => true,
  ),
  'STATUS' => 
  array (
    'width' => '12%',
    'label' => 'LBL_STATUS',
    'link' => false,
    'default' => true,
  ),
  'AVAILABILITY_STATUS_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_AVAILABILITY_STATUS_C',
    'width' => '10%',
  ),
  'IS_ADMIN' => 
  array (
    'width' => '12%',
    'label' => 'LBL_ADMIN',
    'link' => false,
    'default' => true,
  ),
  'DATE_ENTERED' => 
  array (
    'type' => 'datetime',
    'studio' => 
    array (
      'editview' => false,
      'quickcreate' => false,
    ),
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => true,
  ),
  'DEPARTMENT' => 
  array (
    'width' => '15%',
    'label' => 'LBL_DEPARTMENT',
    'link' => true,
    'default' => false,
  ),
  'PHONE_WORK' => 
  array (
    'width' => '12%',
    'label' => 'LBL_LIST_PHONE',
    'link' => true,
    'default' => false,
  ),
  'GATEWAY_ASSIGNED_C' => 
  array (
    'type' => 'bool',
    'default' => false,
    'label' => 'LBL_GATEWAY_ASSIGNED',
    'width' => '12%',
  ),
  'IS_GROUP' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_GROUP',
    'link' => true,
    'default' => false,
  ),
);
?>
