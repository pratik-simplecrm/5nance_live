<?php
// created: 2017-09-18 05:13:27
$subpanel_layout['list_fields'] = array (
  'case_number' => 
  array (
    'vname' => 'LBL_LIST_NUMBER',
    'width' => '6%',
    'default' => true,
  ),
  'name' => 
  array (
    'vname' => 'LBL_LIST_SUBJECT',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '40%',
    'default' => true,
  ),
  'status' => 
  array (
    'vname' => 'LBL_LIST_STATUS',
    'width' => '10%',
    'default' => true,
  ),
  'source_c' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_SOURCE',
    'width' => '10%',
  ),
  'contacts_cases_1_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_CONTACTS_CASES_1_FROM_CONTACTS_TITLE',
    'id' => 'CONTACTS_CASES_1CONTACTS_IDA',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Contacts',
    'target_record_key' => 'contacts_cases_1contacts_ida',
  ),
  'assigned_user_name' => 
  array (
    'name' => 'assigned_user_name',
    'vname' => 'LBL_LIST_ASSIGNED_TO_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'target_record_key' => 'assigned_user_id',
    'target_module' => 'Employees',
    'width' => '10%',
    'default' => true,
  ),
  'date_entered' => 
  array (
    'vname' => 'LBL_LIST_DATE_CREATED',
    'width' => '15%',
    'default' => true,
  ),
);