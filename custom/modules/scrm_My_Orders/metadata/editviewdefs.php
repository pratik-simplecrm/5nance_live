<?php
$module_name = 'scrm_My_Orders';
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
            'name' => 'transactionsubtype_c',
            'label' => 'LBL_TRANSACTIONSUBTYPE',
          ),
          1 => 
          array (
            'name' => 'contacts_scrm_my_orders_1_name',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'invoice_amount_c',
            'label' => 'LBL_INVOICE_AMOUNT',
          ),
          1 => '',
        ),
      ),
    ),
  ),
);
?>
