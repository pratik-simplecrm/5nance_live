<?php
$module_name = 'scrm_Campaign_Source';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'CAMPAIGN_SUBID' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_CAMPAIGN_SUBID',
    'width' => '10%',
    'default' => true,
  ),
  'SOURCE_ID' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_SOURCE_ID',
    'width' => '10%',
    'default' => true,
  ),
  'PUBLISHER' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_PUBLISHER',
    'width' => '10%',
    'default' => true,
  ),
  'CONTENT' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_CONTENT',
    'width' => '10%',
    'default' => true,
  ),
  'AGENCY_NAME' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_AGENCY_NAME',
    'width' => '10%',
    'default' => true,
  ),
  'AUTO_VALIDATED_C' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'LBL_AUTO_VALIDATED',
    'width' => '10%',
  ),
  'FINANCE_URL' => 
  array (
    'type' => 'url',
    'label' => 'LBL_FINANCE_URL',
    'width' => '10%',
    'default' => true,
  ),
);
?>
