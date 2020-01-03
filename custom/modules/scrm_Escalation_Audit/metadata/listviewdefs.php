<?php
$module_name = 'scrm_Escalation_Audit';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'LEVEL_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_LEVEL',
    'width' => '10%',
  ),
  'SCRM_ESCALATION_MATRIX_SCRM_ESCALATION_AUDIT_1_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_SCRM_ESCALATION_MATRIX_SCRM_ESCALATION_AUDIT_1_FROM_SCRM_ESCALATION_MATRIX_TITLE',
    'id' => 'SCRM_ESCALA593_MATRIX_IDA',
    'width' => '10%',
    'default' => true,
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
