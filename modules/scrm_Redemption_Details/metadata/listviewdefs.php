<?php
$module_name = 'scrm_Redemption_Details';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'INVESTOR_EMAIL_ID' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_INVESTOR_EMAIL_ID',
    'width' => '10%',
    'default' => true,
  ),
  'REDEMPTION_DATE' => 
  array (
    'type' => 'datetimecombo',
    'label' => 'LBL_REDEMPTION_DATE',
    'width' => '10%',
    'default' => true,
  ),
  'SCHEME_NAME' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_SCHEME_NAME',
    'width' => '10%',
    'default' => true,
  ),
  'FOLIO_NUMBER' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_FOLIO_NUMBER',
    'width' => '10%',
    'default' => true,
  ),
  'REDEMPTION_AMOUNT' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_REDEMPTION_AMOUNT',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
);
?>
