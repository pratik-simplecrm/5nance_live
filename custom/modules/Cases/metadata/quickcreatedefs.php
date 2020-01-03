<?php
$viewdefs ['Cases'] = 
array (
  'QuickCreate' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'LBL_CASE_INFORMATION' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'lbl_case_information' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'case_number',
            'comment' => 'Visual unique identifier',
            'studio' => 
            array (
              'quickcreate' => false,
            ),
            'label' => 'LBL_NUMBER',
          ),
          1 => 'priority',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'source_c',
            'studio' => 'visible',
            'label' => 'LBL_SOURCE',
          ),
          1 => 
          array (
            'name' => 'query_type_c',
            'studio' => 'visible',
            'label' => 'LBL_QUERY_TYPE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'module_c',
            'studio' => 'visible',
            'label' => 'LBL_MODULE',
          ),
          1 => 
          array (
            'name' => 'sub_module_c',
            'studio' => 'visible',
            'label' => 'LBL_SUB_MODULE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'manufacturer_name_c',
            'studio' => 'visible',
            'label' => 'LBL_MANUFACTURER_NAME',
          ),
          1 => 
          array (
            'name' => 'registrar_c',
            'studio' => 'visible',
            'label' => 'LBL_REGISTRAR',
          ),
        ),
        4 => 
        array (
          0 => 'name',
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'state',
            'comment' => 'The state of the case (i.e. open/closed)',
            'label' => 'LBL_STATE',
          ),
          1 => 'status',
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'contacts_cases_1_name',
            'label' => 'LBL_CONTACTS_CASES_1_FROM_CONTACTS_TITLE',
          ),
        ),
        7 => 
        array (
          0 => '',
          1 => 
          array (
            'name' => 'mobile_number_c',
            'label' => 'LBL_MOBILE_NUMBER',
          ),
        ),
        8 => 
        array (
          0 => 'description',
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'internal_notes_c',
            'studio' => 'visible',
            'label' => 'LBL_INTERNAL_NOTES',
          ),
          1 => 
          array (
            'name' => 'resolution',
            'comment' => 'The resolution of the case',
            'label' => 'LBL_RESOLUTION',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'internal_notes_log_c',
            'studio' => 'visible',
            'label' => 'LBL_INTERNAL_NOTES_LOG',
          ),
          1 => 'assigned_user_name',
        ),
      ),
    ),
  ),
);
?>
