<?php
 // created: 2017-09-25 11:42:51
$layout_defs["scrm_Campaign_Source"]["subpanel_setup"]['leads_scrm_campaign_source_1'] = array (
  'order' => 100,
  'module' => 'Leads',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_LEADS_SCRM_CAMPAIGN_SOURCE_1_FROM_LEADS_TITLE',
  'get_subpanel_data' => 'leads_scrm_campaign_source_1',
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
