<?php
 // created: 2017-09-16 14:15:29
$layout_defs["Contacts"]["subpanel_setup"]['contacts_scrm_insurance_1'] = array (
  'order' => 100,
  'module' => 'scrm_Insurance',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_CONTACTS_SCRM_INSURANCE_1_FROM_SCRM_INSURANCE_TITLE',
  'get_subpanel_data' => 'contacts_scrm_insurance_1',
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
