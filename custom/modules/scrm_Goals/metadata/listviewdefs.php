<?php
$module_name = 'scrm_Goals';
$listViewDefs [$module_name] = 
array (
  'GOALID' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_GOALID',
    'width' => '10%',
    'default' => true,
  ),
  'CONTACTS_SCRM_GOALS_1_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CONTACTS_SCRM_GOALS_1_FROM_CONTACTS_TITLE',
    'id' => 'CONTACTS_SCRM_GOALS_1CONTACTS_IDA',
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
  'GOALNAME' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_GOALNAME',
    'width' => '10%',
    'default' => true,
  ),
  'GOALPLANNEDBY' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_GOALPLANNEDBY',
    'width' => '10%',
    'default' => true,
  ),
  'GOALSTATUS' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_GOALSTATUS',
    'width' => '10%',
    'default' => true,
  ),
  'GOALSTARTDATE' => 
  array (
    'type' => 'date',
    'label' => 'LBL_GOALSTARTDATE',
    'width' => '10%',
    'default' => true,
  ),
  'GOALTARGETDATE' => 
  array (
    'type' => 'date',
    'label' => 'LBL_GOALTARGETDATE',
    'width' => '10%',
    'default' => true,
  ),
  'GOALCURRENTVALUE' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_GOALCURRENTVALUE',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'GOALFUTUREVALUE' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_GOALFUTUREVALUE',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'MONTHLYINVESTMENTREQUIRED' => 
  array (
    'type' => 'bool',
    'default' => true,
    'label' => 'LBL_MONTHLYINVESTMENTREQUIRED',
    'width' => '10%',
  ),
  'ONETIMEINVESTMENTREQUIRED' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_ONETIMEINVESTMENTREQUIRED',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'MONTHLY_INVESTMENT_REQUIRED_C' => 
  array (
    'type' => 'currency',
    'default' => true,
    'label' => 'LBL_MONTHLY_INVESTMENT_REQUIRED',
    'currency_format' => true,
    'width' => '10%',
  ),
  'YEARLYINVESTMENTREQUIRED' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_YEARLYINVESTMENTREQUIRED',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'GOALDURATIONINMONTHS' => 
  array (
    'type' => 'int',
    'label' => 'LBL_GOALDURATIONINMONTHS',
    'width' => '10%',
    'default' => true,
  ),
);
?>
