<?php
$searchdefs ['Cases'] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      0 => 'name',
      1 => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
      ),
      2 => 
      array (
        'name' => 'open_only',
        'label' => 'LBL_OPEN_ITEMS',
        'type' => 'bool',
        'default' => false,
        'width' => '10%',
      ),
      3 => 
      array (
        'name' => 'favorites_only',
        'label' => 'LBL_FAVORITES_FILTER',
        'type' => 'bool',
      ),
    ),
    'advanced_search' => 
    array (
      'case_number' => 
      array (
        'name' => 'case_number',
        'default' => true,
        'width' => '10%',
      ),
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'source_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_SOURCE',
        'width' => '10%',
        'name' => 'source_c',
      ),
      'module_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_MODULE',
        'width' => '10%',
        'name' => 'module_c',
      ),
      'contacts_cases_1_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_CONTACTS_CASES_1_FROM_CONTACTS_TITLE',
        'id' => 'CONTACTS_CASES_1CONTACTS_IDA',
        'width' => '10%',
        'default' => true,
        'name' => 'contacts_cases_1_name',
      ),
      'email1' => 
      array (
        'type' => 'varchar',
        'studio' => 
        array (
          'editField' => true,
        ),
        'label' => 'LBL_EMAIL',
        'width' => '10%',
        'default' => true,
        'name' => 'email1',
      ),
      'mobile_number_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_MOBILE_NUMBER',
        'width' => '10%',
        'name' => 'mobile_number_c',
      ),
      'state' => 
      array (
        'type' => 'enum',
        'default' => true,
        'label' => 'LBL_STATE',
        'width' => '10%',
        'name' => 'state',
      ),
      'status' => 
      array (
        'name' => 'status',
        'default' => true,
        'width' => '10%',
      ),
      'priority' => 
      array (
        'name' => 'priority',
        'default' => true,
        'width' => '10%',
      ),
      'assigned_user_id' => 
      array (
        'name' => 'assigned_user_id',
        'type' => 'enum',
        'label' => 'LBL_ASSIGNED_TO',
        'function' => 
        array (
          'name' => 'get_user_array',
          'params' => 
          array (
            0 => false,
          ),
        ),
        'default' => true,
        'width' => '10%',
      ),
      'date_entered' => 
      array (
        'type' => 'datetime',
        'label' => 'LBL_DATE_ENTERED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_entered',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
?>
