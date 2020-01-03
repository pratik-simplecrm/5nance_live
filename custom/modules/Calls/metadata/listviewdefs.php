<?php
$listViewDefs ['Calls'] = 
array (
  'DIRECTION' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_DIRECTION',
    'link' => false,
    'default' => true,
  ),
  'NAME' => 
  array (
    'width' => '40%',
    'label' => 'LBL_LIST_SUBJECT',
    'link' => true,
    'default' => true,
  ),
  'STATUS' => 
  array (
    'width' => '10%',
    'label' => 'LBL_STATUS',
    'link' => false,
    'default' => true,
  ),
  'LANGUAGE_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_LANGUAGE',
    'width' => '10%',
  ),
  'PARENT_NAME' => 
  array (
    'width' => '20%',
    'label' => 'LBL_LIST_RELATED_TO',
    'dynamic_module' => 'PARENT_TYPE',
    'id' => 'PARENT_ID',
    'link' => true,
    'default' => true,
    'sortable' => false,
    'ACLTag' => 'PARENT',
    'related_fields' => 
    array (
      0 => 'parent_id',
      1 => 'parent_type',
    ),
  ),
  'PHONE_C' => 
  array (
    'type' => 'phone',
    'default' => true,
    'label' => 'LBL_PHONE',
    'width' => '10%',
  ),
  'CALLTYPE_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_CALLTYPE',
    'width' => '10%',
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '2%',
    'label' => 'LBL_LIST_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
  'CUSTOMERID_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_CUSTOMERID',
    'width' => '10%',
  ),
  'CAMPAIGNID_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_CAMPAIGNID',
    'width' => '10%',
  ),
  'TALKTIME_C' => 
  array (
    'type' => 'int',
    'default' => true,
    'label' => 'LBL_TALKTIME',
    'width' => '10%',
  ),
  'DATE_START' => 
  array (
    'width' => '15%',
    'label' => 'LBL_LIST_DATE',
    'link' => false,
    'default' => true,
    'related_fields' => 
    array (
      0 => 'time_start',
    ),
  ),
  'DATE_ENTERED' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DATE_ENTERED',
    'default' => true,
  ),
  'IVRTIME_C' => 
  array (
    'type' => 'int',
    'default' => false,
    'label' => 'LBL_IVRTIME',
    'width' => '10%',
  ),
  'SET_COMPLETE' => 
  array (
    'width' => '1%',
    'label' => 'LBL_LIST_CLOSE',
    'link' => true,
    'sortable' => false,
    'default' => false,
    'related_fields' => 
    array (
      0 => 'status',
    ),
  ),
  'CRTOBJECTID_C' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_CRTOBJECTID',
    'width' => '10%',
  ),
  'SRCPHONE_C' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_SRCPHONE',
    'width' => '10%',
  ),
  'RINGINGTIME_C' => 
  array (
    'type' => 'int',
    'default' => false,
    'label' => 'LBL_RINGINGTIME',
    'width' => '10%',
  ),
  'DISPOSITIONCODE_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_DISPOSITIONCODE',
    'width' => '10%',
  ),
  'SYSTEMDISPOSITION_C' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_SYSTEMDISPOSITION',
    'width' => '10%',
  ),
  'CALLID_C' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_CALLID',
    'width' => '10%',
  ),
  'CONTACT_NAME' => 
  array (
    'width' => '20%',
    'label' => 'LBL_LIST_CONTACT',
    'link' => true,
    'id' => 'CONTACT_ID',
    'module' => 'Contacts',
    'default' => false,
    'ACLTag' => 'CONTACT',
  ),
  'ACCEPT_STATUS' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_ACCEPT_STATUS',
    'width' => '10%',
    'default' => false,
  ),
  'RECORDINGFILEURL_C' => 
  array (
    'type' => 'url',
    'default' => false,
    'label' => 'LBL_RECORDINGFILEURL',
    'width' => '10%',
  ),
);
?>
