<?php
$module_name = 'scrm_Callback_Request';
$listViewDefs [$module_name] = 
array (
  'UNIQUECUSTOMERCODE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_UNIQUECUSTOMERCODE',
    'width' => '10%',
    'default' => true,
  ),
  'CALLBACKID' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_CALLBACKID',
    'width' => '10%',
    'default' => true,
  ),
  'CONTACTS_SCRM_CALLBACK_REQUEST_1_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CONTACTS_SCRM_CALLBACK_REQUEST_1_FROM_CONTACTS_TITLE',
    'id' => 'CONTACTS_SCRM_CALLBACK_REQUEST_1CONTACTS_IDA',
    'width' => '10%',
    'default' => true,
  ),
  'MOBILENO' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_MOBILENO',
    'width' => '10%',
    'default' => true,
  ),
  'USERNAME' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_USERNAME',
    'width' => '10%',
    'default' => true,
  ),
  'EMAILID' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_EMAILID',
    'width' => '10%',
    'default' => true,
  ),
  'AREAOFINTEREST' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_AREAOFINTEREST',
    'width' => '10%',
    'default' => true,
  ),
  'SECTION' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_SECTION',
    'width' => '10%',
    'default' => true,
  ),
  'SUBSECTION' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_SUBSECTION',
    'width' => '10%',
    'default' => true,
  ),
  'CALLBACKDATETIME' => 
  array (
    'type' => 'datetimecombo',
    'label' => 'LBL_CALLBACKDATETIME',
    'width' => '10%',
    'default' => true,
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
