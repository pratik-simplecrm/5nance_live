<?php
$module_name = 'scrm_Bank_Details';
$listViewDefs [$module_name] = 
array (
  'UNIQUECUSTOMERCODE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_UNIQUECUSTOMERCODE',
    'width' => '10%',
    'default' => true,
  ),
  'INVESTORBANKACCOUNTDETAILID' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_INVESTORBANKACCOUNTDETAILID',
    'width' => '10%',
    'default' => true,
  ),
  'INVESTORID' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_INVESTORID',
    'width' => '10%',
    'default' => true,
  ),
  'BANKNAME' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_BANKNAME',
    'width' => '10%',
    'default' => true,
  ),
  'ACCOUNTNO' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_ACCOUNTNO',
    'width' => '10%',
    'default' => true,
  ),
  'DOCUMENTUPLOADED' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_DOCUMENTUPLOADED',
    'width' => '10%',
  ),
  'CONTACTS_SCRM_BANK_DETAILS_1_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CONTACTS_SCRM_BANK_DETAILS_1_FROM_CONTACTS_TITLE',
    'id' => 'CONTACTS_SCRM_BANK_DETAILS_1CONTACTS_IDA',
    'width' => '10%',
    'default' => true,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => false,
  ),
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => false,
    'link' => true,
  ),
);
?>
