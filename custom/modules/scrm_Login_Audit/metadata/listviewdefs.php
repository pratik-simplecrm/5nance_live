<?php
$module_name = 'scrm_Login_Audit';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'TOTAL_LOGGED_IN_TIME_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_TOTAL_LOGGED_IN_TIME',
    'width' => '10%',
  ),
  'IP_ADDRESS_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_IP_ADDRESS',
    'width' => '10%',
  ),
  'LOGINS_PER_DAY_C' => 
  array (
    'type' => 'int',
    'default' => true,
    'label' => 'LBL_LOGINS_PER_DAY',
    'width' => '10%',
  ),
  'USERS_SUGAR_ID_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_USERS_SUGAR_ID',
    'width' => '10%',
  ),
  'DATE_ENTERED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_ENTERED',
    'width' => '10%',
    'default' => true,
  ),
);
?>
