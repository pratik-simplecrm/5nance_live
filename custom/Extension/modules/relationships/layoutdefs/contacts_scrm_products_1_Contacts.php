<?php
 // created: 2018-05-15 18:55:36
$layout_defs["Contacts"]["subpanel_setup"]['contacts_scrm_products_1'] = array (
  'order' => 100,
  'module' => 'scrm_Products',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_CONTACTS_SCRM_PRODUCTS_1_FROM_SCRM_PRODUCTS_TITLE',
  'get_subpanel_data' => 'contacts_scrm_products_1',
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
