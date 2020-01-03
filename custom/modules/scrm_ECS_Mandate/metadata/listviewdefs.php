<?php
$module_name = 'scrm_ECS_Mandate';
$listViewDefs [$module_name] = 
array (
  'UNIQUECUSTOMERCODE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_UNIQUECUSTOMERCODE',
    'width' => '10%',
    'default' => true,
  ),
  'CONTACTS_SCRM_ECS_MANDATE_1_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CONTACTS_SCRM_ECS_MANDATE_1_FROM_CONTACTS_TITLE',
    'id' => 'CONTACTS_SCRM_ECS_MANDATE_1CONTACTS_IDA',
    'width' => '10%',
    'default' => true,
  ),
  'INVESTORNAME' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_INVESTORNAME',
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
  'REFERENCENO' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_REFERENCENO',
    'width' => '10%',
    'default' => true,
  ),
  'MANDATEAMOUNT' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_MANDATEAMOUNT',
    'currency_format' => true,
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
  'VERIFICATIONREMARK' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_VERIFICATIONREMARK',
    'width' => '10%',
    'default' => true,
  ),
  'VERIFIEDSTATUS' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_VERIFIEDSTATUS',
    'width' => '10%',
    'default' => true,
  ),
  'INVESTORECSMANDATEDETAILID' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_INVESTORECSMANDATEDETAILID',
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
