<?php
$module_name = 'scrm_SIP';
$listViewDefs [$module_name] = 
array (
  'WISHLISTID' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_WISHLISTID',
    'width' => '10%',
    'default' => true,
  ),
  'UNIQUECUSTOMERCODE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_UNIQUECUSTOMERCODE',
    'width' => '10%',
    'default' => true,
  ),
  'CONTACTS_SCRM_SIP_1_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CONTACTS_SCRM_SIP_1_FROM_CONTACTS_TITLE',
    'id' => 'CONTACTS_SCRM_SIP_1CONTACTS_IDA',
    'width' => '10%',
    'default' => true,
  ),
  'FIRSTINVESTORNAME' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_FIRSTINVESTORNAME',
    'width' => '10%',
    'default' => true,
  ),
  'EMAIL' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_EMAIL',
    'width' => '10%',
    'default' => true,
  ),
  'CYCLEDATE' => 
  array (
    'type' => 'int',
    'label' => 'LBL_CYCLEDATE',
    'width' => '10%',
    'default' => true,
  ),
  'FREQUENCY' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_FREQUENCY',
    'width' => '10%',
    'default' => true,
  ),
  'STARTDATE' => 
  array (
    'type' => 'date',
    'label' => 'LBL_STARTDATE',
    'width' => '10%',
    'default' => true,
  ),
  'ENDDATE' => 
  array (
    'type' => 'date',
    'label' => 'LBL_ENDDATE',
    'width' => '10%',
    'default' => true,
  ),
  'SCHEMECODE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_SCHEMECODE',
    'width' => '10%',
    'default' => true,
  ),
  'SCHEMENAME' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_SCHEMENAME',
    'width' => '10%',
    'default' => true,
  ),
  'AMOUNT' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_AMOUNT',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'FOLIONUMBER' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_FOLIONUMBER',
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
