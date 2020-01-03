<?php
$module_name = 'scrm_SMS';
$viewdefs [$module_name] = 
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
          0 => 'date_entered',
          1 => 'date_modified',
        ),
        2 => 
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
        3 => 
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
        4 => 
        array (
          0 => 'description',
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'response',
            'studio' => 'visible',
            'label' => 'LBL_RESPONSE',
          ),
        ),
        6 => 
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
