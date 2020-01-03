<?php
$viewdefs ['Users'] = 
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
      'form' => 
      array (
        'headerTpl' => 'modules/Users/tpls/EditViewHeader.tpl',
        'footerTpl' => 'modules/Users/tpls/EditViewFooter.tpl',
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'LBL_USER_INFORMATION' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL1' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EMPLOYEE_INFORMATION' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => false,
    ),
    'panels' => 
    array (
      'LBL_USER_INFORMATION' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'user_name',
            'displayParams' => 
            array (
              'required' => true,
            ),
          ),
          1 => 'first_name',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'status',
            'customCode' => '{if $IS_ADMIN}@@FIELD@@{else}{$STATUS_READONLY}{/if}',
            'displayParams' => 
            array (
              'required' => true,
            ),
          ),
          1 => 'last_name',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'UserType',
            'customCode' => '{if $IS_ADMIN}{$USER_TYPE_DROPDOWN}{else}{$USER_TYPE_READONLY}{/if}',
          ),
          1 => 
          array (
            'name' => 'gateway_assigned_c',
            'label' => 'LBL_GATEWAY_ASSIGNED',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'availability_status_c',
            'studio' => 'visible',
            'label' => 'LBL_AVAILABILITY_STATUS_C',
          ),
          1 => '',
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'ameyosessionid_c',
            'label' => 'LBL_AMEYOSESSIONID',
          ),
          1 => '',
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'ameyo_campaign_id_c',
            'label' => 'LBL_AMEYO_CAMPAIGN_ID',
          ),
          1 => '',
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'asterisk_ext_c',
            'label' => 'LBL_ASTERISK_EXT',
          ),
          1 => 
          array (
            'name' => 'asterisk_inbound_c',
            'label' => 'LBL_ASTERISK_INBOUND',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'asterisk_outbound_c',
            'label' => 'LBL_ASTERISK_OUTBOUND',
          ),
          1 => 
          array (
            'name' => 'agent_id_c',
            'label' => 'LBL_AGENT_ID',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'agent_name_c',
            'label' => 'LBL_AGENT_NAME',
          ),
          1 => 
          array (
            'name' => 'agent_pin_c',
            'label' => 'LBL_AGENT_PIN',
          ),
        ),
      ),
      'LBL_EMPLOYEE_INFORMATION' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'employee_status',
            'customCode' => '{if $IS_ADMIN}@@FIELD@@{else}{$EMPLOYEE_STATUS_READONLY}{/if}',
          ),
          1 => 'show_on_employees',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'title',
            'customCode' => '{if $IS_ADMIN}@@FIELD@@{else}{$TITLE_READONLY}{/if}',
          ),
          1 => 'phone_work',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'department',
            'customCode' => '{if $IS_ADMIN}@@FIELD@@{else}{$DEPT_READONLY}{/if}',
          ),
          1 => 'phone_mobile',
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'reports_to_name',
            'customCode' => '{if $IS_ADMIN}@@FIELD@@{else}{$REPORTS_TO_READONLY}{/if}',
          ),
          1 => 'phone_other',
        ),
        4 => 
        array (
          0 => 'phone_fax',
        ),
        5 => 
        array (
          0 => 'phone_home',
        ),
        6 => 
        array (
          0 => 'messenger_type',
          1 => 'messenger_id',
        ),
        7 => 
        array (
          0 => 'address_street',
          1 => 'address_city',
        ),
        8 => 
        array (
          0 => 'address_state',
          1 => 'address_postalcode',
        ),
        9 => 
        array (
          0 => 'address_country',
        ),
        10 => 
        array (
          0 => 'description',
        ),
      ),
    ),
  ),
);
?>
