<?php
$module_name = 'scrm_Nominees';
$listViewDefs [$module_name] = 
array (
  'UNIQUECUSTOMERCODE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_UNIQUECUSTOMERCODE',
    'width' => '10%',
    'default' => true,
  ),
  'CONTACTS_SCRM_NOMINEES_1_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CONTACTS_SCRM_NOMINEES_1_FROM_CONTACTS_TITLE',
    'id' => 'CONTACTS_SCRM_NOMINEES_1CONTACTS_IDA',
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
  'INVESTORNOMINEEID' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_INVESTORNOMINEEID',
    'width' => '10%',
    'default' => true,
  ),
  'FULLNAME' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_FULLNAME',
    'width' => '10%',
    'default' => true,
  ),
  'RELATIONSHIP' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_RELATIONSHIP',
    'width' => '10%',
    'default' => true,
  ),
);
?>
