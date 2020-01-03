<?php
// created: 2017-09-01 03:14:19
$subpanel_layout['list_fields'] = array (
  'login_time_c' => 
  array (
    'type' => 'datetimecombo',
    'default' => true,
    'vname' => 'LBL_LOGIN_TIME',
    'width' => '10%',
  ),
  'logoff_time_c' => 
  array (
    'type' => 'datetimecombo',
    'default' => true,
    'vname' => 'LBL_LOGOFF_TIME',
    'width' => '10%',
  ),
  'total_login_time_c' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'vname' => 'LBL_TOTAL_LOGIN_TIME',
    'width' => '10%',
  ),
  'ip_address_c' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'vname' => 'LBL_IP_ADDRESS',
    'width' => '10%',
  ),
  'scrm_login_audit_scrm_login_history_1_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_SCRM_LOGIN_AUDIT_SCRM_LOGIN_HISTORY_1_FROM_SCRM_LOGIN_AUDIT_TITLE',
    'id' => 'SCRM_LOGIN_AUDIT_SCRM_LOGIN_HISTORY_1SCRM_LOGIN_AUDIT_IDA',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'scrm_Login_Audit',
    'target_record_key' => 'scrm_login_audit_scrm_login_history_1scrm_login_audit_ida',
  ),
);