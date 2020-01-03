<?php
$module_name = 'scrm_My_Orders';
$listViewDefs [$module_name] = 
array (
  'DATE_OF_TRANSACTION_C' => 
  array (
    'type' => 'datetimecombo',
    'default' => true,
    'label' => 'LBL_DATE_OF_TRANSACTION',
    'width' => '10%',
  ),
  'ORDER_NUMBER_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_ORDER_NUMBER',
    'width' => '10%',
  ),
  'CARTTYPE_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_CARTTYPE',
    'width' => '10%',
  ),
  'TRANSACTION_REFERENCE_NUMBER_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_TRANSACTION_REFERENCE_NUMBER',
    'width' => '10%',
  ),
  'INVOICE_AMOUNT_C' => 
  array (
    'type' => 'currency',
    'default' => true,
    'label' => 'LBL_INVOICE_AMOUNT',
    'currency_format' => true,
    'width' => '10%',
  ),
  'PAIDAMOUNT_C' => 
  array (
    'type' => 'currency',
    'default' => true,
    'label' => 'LBL_PAIDAMOUNT',
    'currency_format' => true,
    'width' => '10%',
  ),
  'PAYMENT_STATUS_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_PAYMENT_STATUS',
    'width' => '10%',
  ),
  'ACCOUNTNO_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_ACCOUNTNO',
    'width' => '10%',
  ),
  'ASSET_CLASS_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_ASSET_CLASS',
    'width' => '10%',
  ),
  'PAYMENTTYPE_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_PAYMENTTYPE',
    'width' => '10%',
  ),
  'TRANSACTIONSUBTYPE_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_TRANSACTIONSUBTYPE',
    'width' => '10%',
  ),
  'MANUFACTURER_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_MANUFACTURER',
    'width' => '10%',
  ),
  'SCHEME_NAME_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_SCHEME_NAME',
    'width' => '10%',
  ),
  'ORDER_AMOUNT_C' => 
  array (
    'type' => 'currency',
    'default' => true,
    'label' => 'LBL_ORDER_AMOUNT',
    'currency_format' => true,
    'width' => '10%',
  ),
  'ORDERSTATUS_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_ORDERSTATUS',
    'width' => '10%',
  ),
  'CONTACTS_SCRM_MY_ORDERS_1_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CONTACTS_SCRM_MY_ORDERS_1_FROM_CONTACTS_TITLE',
    'id' => 'CONTACTS_SCRM_MY_ORDERS_1CONTACTS_IDA',
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
