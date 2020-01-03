<?php
$module_name = 'scrm_Equity';
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
          1 => 
          array (
            'name' => 'quantity',
            'label' => 'LBL_QUANTITY',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'purchase_value',
            'label' => 'LBL_PURCHASE_VALUE',
          ),
          1 => 
          array (
            'name' => 'profitlossrs',
            'label' => 'LBL_PROFITLOSSRS',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'contacts_scrm_equity_1_name',
          ),
        ),
      ),
    ),
  ),
);
?>
