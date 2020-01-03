<?php
 // created: 2017-09-01 12:43:25
$layout_defs["Users"]["subpanel_setup"]['users_scrm_login_audit_2'] = array (
  'order' => 100,
  'module' => 'scrm_Login_Audit',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_USERS_SCRM_LOGIN_AUDIT_2_FROM_SCRM_LOGIN_AUDIT_TITLE',
  'get_subpanel_data' => 'users_scrm_login_audit_2',
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
