<?php
 // created: 2017-04-19 13:31:32
$layout_defs["Cases"]["subpanel_setup"]['cases_scrm_sms_1'] = array (
  'order' => 100,
  'module' => 'scrm_SMS',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_CASES_SCRM_SMS_1_FROM_SCRM_SMS_TITLE',
  'get_subpanel_data' => 'cases_scrm_sms_1',
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
