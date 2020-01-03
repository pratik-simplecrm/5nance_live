<?php
 // created: 2017-09-01 03:11:19
$layout_defs["scrm_Login_Audit"]["subpanel_setup"]['scrm_login_audit_scrm_login_history_1'] = array (
  'order' => 100,
  'module' => 'scrm_Login_History',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_SCRM_LOGIN_AUDIT_SCRM_LOGIN_HISTORY_1_FROM_SCRM_LOGIN_HISTORY_TITLE',
  'get_subpanel_data' => 'scrm_login_audit_scrm_login_history_1',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);
