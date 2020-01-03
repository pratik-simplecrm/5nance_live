<?php
$module_name = 'scrm_Risk_Profile';
$listViewDefs [$module_name] = 
array (
  'RISKPROFILEID_C' => 
  array (
    'type' => 'int',
    'default' => true,
    'label' => 'LBL_RISKPROFILEID',
    'width' => '10%',
  ),
  'INVESTMENT_NAME_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_INVESTMENT_NAME',
    'width' => '10%',
  ),
  'ALLOCATION_C' => 
  array (
    'type' => 'int',
    'default' => true,
    'label' => 'LBL_ALLOCATION',
    'width' => '10%',
  ),
  'ADVISORYMODULEID_C' => 
  array (
    'type' => 'int',
    'default' => true,
    'label' => 'LBL_ADVISORYMODULEID',
    'width' => '10%',
  ),
  'MINAMOUNT_C' => 
  array (
    'type' => 'currency',
    'default' => true,
    'label' => 'LBL_MINAMOUNT',
    'currency_format' => true,
    'width' => '10%',
  ),
  'MAXAMOUNT_C' => 
  array (
    'type' => 'currency',
    'default' => true,
    'label' => 'LBL_MAXAMOUNT',
    'currency_format' => true,
    'width' => '10%',
  ),
  'PROJECTTYPEID_C' => 
  array (
    'type' => 'int',
    'default' => true,
    'label' => 'LBL_PROJECTTYPEID',
    'width' => '10%',
  ),
  'ISACTIVE_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_ISACTIVE',
    'width' => '10%',
  ),
  'CONTACTS_SCRM_RISK_PROFILE_1_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CONTACTS_SCRM_RISK_PROFILE_1_FROM_CONTACTS_TITLE',
    'id' => 'CONTACTS_SCRM_RISK_PROFILE_1CONTACTS_IDA',
    'width' => '10%',
    'default' => true,
  ),
  'PORTFOLIOID_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_PORTFOLIOID',
    'width' => '10%',
  ),
  'DATE_MODIFIED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'default' => true,
  ),
);
?>
