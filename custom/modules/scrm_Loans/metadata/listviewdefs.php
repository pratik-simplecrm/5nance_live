<?php
$module_name = 'scrm_Loans';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'EMAILID' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_EMAILID',
    'width' => '10%',
    'default' => true,
  ),
  'LOANTYPE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_LOANTYPE',
    'width' => '10%',
    'default' => true,
  ),
  'AMOUNTAPPLIEDFOR' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_AMOUNTAPPLIEDFOR',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'NUMBEROFYEARSAPPLIEDFOR' => 
  array (
    'type' => 'int',
    'label' => 'LBL_NUMBEROFYEARSAPPLIEDFOR',
    'width' => '10%',
    'default' => true,
  ),
  'INTERESTRATEINPUT' => 
  array (
    'type' => 'decimal',
    'label' => 'LBL_INTERESTRATEINPUT',
    'width' => '10%',
    'default' => true,
  ),
  'TYPEOFLOANSELECTED' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_TYPEOFLOANSELECTED',
    'width' => '10%',
    'default' => true,
  ),
  'LOANPROVIDERSELECTED' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_LOANPROVIDERSELECTED',
    'width' => '10%',
    'default' => true,
  ),
  'CITYNAME' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_CITYNAME',
    'width' => '10%',
    'default' => true,
  ),
  'PROPERTYCOST' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_PROPERTYCOST',
    'currency_format' => true,
    'width' => '10%',
    'default' => true,
  ),
  'CURRENTEMI' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_CURRENTEMI',
    'width' => '10%',
    'default' => true,
  ),
  'TOTALWORKEXPERIENCE' => 
  array (
    'type' => 'int',
    'label' => 'LBL_TOTALWORKEXPERIENCE',
    'width' => '10%',
    'default' => true,
  ),
  'COBORROWERNAME' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_COBORROWERNAME',
    'width' => '10%',
    'default' => true,
  ),
  'EMPLOYMENTTYPE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_EMPLOYMENTTYPE',
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
);
?>
