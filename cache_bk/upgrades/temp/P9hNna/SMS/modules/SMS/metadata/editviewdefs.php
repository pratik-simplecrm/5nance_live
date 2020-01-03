<?php
$module_name = 'scrm_SMS';
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
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 'assigned_user_name',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'message_send_to',
            'studio' => 'visible',
            'label' => 'LBL_MESSAGE_SEND_TO',
          ),
          1 => 
          array (
            'name' => 'receipent_no',
            'label' => 'LBL_RECEIPENT_NO',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'scrm_sms_contacts_name',
          ),
          1 => 
          array (
            'name' => 'scrm_sms_accounts_name',
          ),
        ),
        3 => 
        array (
          0 => 'description',
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'response',
            'studio' => 'visible',
            'label' => 'LBL_RESPONSE',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'scrm_sms_scrm_sms_template_name',
          ),
        ),
      ),
    ),
  ),
);
?>
