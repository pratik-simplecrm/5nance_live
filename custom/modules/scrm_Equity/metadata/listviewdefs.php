<?php
$module_name = 'scrm_Equity';
$listViewDefs [$module_name] = 
array (
  'UNIQUECUSTOMERCODE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_UNIQUECUSTOMERCODE',
    'width' => '10%',
    'default' => true,
  ),
  'NAME' => 
  array (
    'width' => '20%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'QUANTITY' => 
  array (
    'type' => 'int',
    'label' => 'LBL_QUANTITY',
    'width' => '10%',
    'default' => true,
  ),
  'PURCHASE_VALUE' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_PURCHASE_VALUE',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'PROFITLOSSRS' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_PROFITLOSSRS',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'CONTACTS_SCRM_EQUITY_1_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CONTACTS_SCRM_EQUITY_1_FROM_CONTACTS_TITLE',
    'id' => 'CONTACTS_SCRM_EQUITY_1CONTACTS_IDA',
    'width' => '10%',
    'default' => true,
  ),
);
?>
