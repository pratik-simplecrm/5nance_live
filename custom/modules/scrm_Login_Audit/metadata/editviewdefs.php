<?php
$module_name = 'scrm_Login_Audit';
$viewdefs [$module_name] = 
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
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'name',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'total_logged_in_time_c',
            'label' => 'LBL_TOTAL_LOGGED_IN_TIME',
          ),
          1 => 
          array (
            'name' => 'users_sugar_id_c',
            'label' => 'LBL_USERS_SUGAR_ID',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'users_scrm_login_audit_2_name',
          ),
        ),
      ),
    ),
  ),
);
?>
