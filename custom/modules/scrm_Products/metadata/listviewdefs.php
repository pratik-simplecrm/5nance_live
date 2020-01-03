<?php
$module_name = 'scrm_Products';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'PRODUCT_INTEREST_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_PRODUCT_INTEREST',
    'width' => '10%',
  ),
  'PRODUCT_SUB_TYPE_INTEREST_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_PRODUCT_SUB_TYPE_INTEREST',
    'width' => '10%',
  ),
  'NO_OF_ATTEMPTS_C' => 
  array (
    'type' => 'int',
    'default' => true,
    'label' => 'LBL_NO_OF_ATTEMPTS',
    'width' => '10%',
  ),
  'SALES_STAGE_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_SALES_STAGE',
    'width' => '10%',
  ),
  'DISPOSITION_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_DISPOSITION',
    'width' => '10%',
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
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
    'type' => 'datetime',
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => true,
  ),
);
?>
