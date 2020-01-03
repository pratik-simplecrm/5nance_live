<?php
$viewdefs ['Cases'] = 
array (
  'EditView' => 
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
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'include/javascript/bindWithDelay.js',
        ),
        1 => 
        array (
          'file' => 'modules/AOK_KnowledgeBase/AOK_KnowledgeBase_SuggestionBox.js',
        ),
        2 => 
        array (
          'file' => 'include/javascript/qtip/jquery.qtip.min.js',
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
      'form' => 
      array (
        'enctype' => 'multipart/form-data',
      ),
      'syncDetailEditViews' => true,
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
            'type' => 'readonly',
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
          0 => 
          array (
            'name' => 'name',
            'displayParams' => 
            array (
              'size' => 75,
            ),
          ),
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
            'displayParams' => 
            array (
              'field' => 
              array (
                'onblur' => 'contact_details()',
              ),
              'javascript' => 
              array (
                'btn' => 'onblur = "contact_details()"',
              ),
            ),
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'email1',
            'studio' => 'false',
            'label' => 'LBL_EMAIL_ADDRESS',
          ),
          1 => 
          array (
            'name' => 'mobile_number_c',
            'label' => 'LBL_MOBILE_NUMBER',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'nl2br' => true,
          ),
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
            'nl2br' => true,
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
        11 => 
        array (
          0 => 
          array (
            'name' => 'date_entered',
            'comment' => 'Date record created',
            'label' => 'LBL_DATE_ENTERED',
          ),
          1 => '',
        ),
      ),
    ),
  ),
);
?>
