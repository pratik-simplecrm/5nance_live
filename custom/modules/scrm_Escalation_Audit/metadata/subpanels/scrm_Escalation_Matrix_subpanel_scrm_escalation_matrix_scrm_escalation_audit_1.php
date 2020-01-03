<?php
// created: 2017-04-22 08:19:13
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '45%',
    'default' => true,
  ),
  'modified_by_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_MODIFIED_NAME',
    'id' => 'MODIFIED_USER_ID',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Users',
    'target_record_key' => 'modified_user_id',
  ),
  'level_c' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'vname' => 'LBL_LEVEL',
    'width' => '10%',
  ),
  'date_modified' => 
  array (
    'vname' => 'LBL_DATE_MODIFIED',
    'width' => '45%',
    'default' => true,
  ),
  'cases_scrm_escalation_audit_1_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_CASES_SCRM_ESCALATION_AUDIT_1_FROM_CASES_TITLE',
    'id' => 'CASES_SCRM_ESCALATION_AUDIT_1CASES_IDA',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Cases',
    'target_record_key' => 'cases_scrm_escalation_audit_1cases_ida',
  ),
  'scrm_escalation_matrix_scrm_escalation_audit_1_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_SCRM_ESCALATION_MATRIX_SCRM_ESCALATION_AUDIT_1_FROM_SCRM_ESCALATION_MATRIX_TITLE',
    'id' => 'SCRM_ESCALA593_MATRIX_IDA',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'scrm_Escalation_Matrix',
    'target_record_key' => 'scrm_escala593_matrix_ida',
  ),
);