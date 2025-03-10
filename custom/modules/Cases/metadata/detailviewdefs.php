<?php
$viewdefs ['Cases'] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 'FIND_DUPLICATES',
          4 => 
          array (
            'customCode' => '<input  type="submit" class="button" name="create" id="create" value="Create Case" onClick="document.location=\'index.php?module=Cases&action=EditView&return_module=Cases&return_action=DetailView\'">',
          ),
        ),
      ),
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
            'label' => 'LBL_CASE_NUMBER',
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
            'label' => 'LBL_SUBJECT',
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
            'customCode' => '{$fields.description.value|html_entity_decode}',
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
          1 => 'resolution',
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'internal_notes_log_c',
            'studio' => 'visible',
            'label' => 'LBL_INTERNAL_NOTES_LOG',
          ),
          1 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'date_entered',
            'customCode' => '{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}',
          ),
          1 => '',
        ),
      ),
    ),
  ),
);
?>
