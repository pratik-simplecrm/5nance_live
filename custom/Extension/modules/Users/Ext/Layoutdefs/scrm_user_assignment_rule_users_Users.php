<?php
 // created: 2017-02-09 05:00:22
$layout_defs["Users"]["subpanel_setup"]['scrm_user_assignment_rule_users'] = array (
  'order' => 100,
  'module' => 'scrm_User_Assignment_Rule',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_SCRM_USER_ASSIGNMENT_RULE_USERS_FROM_SCRM_USER_ASSIGNMENT_RULE_TITLE',
  'get_subpanel_data' => 'scrm_user_assignment_rule_users',
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
