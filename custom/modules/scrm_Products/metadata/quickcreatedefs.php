<?php
$module_name = 'scrm_Products';
$viewdefs [$module_name] = 
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
          0 => 
          array (
            'name' => 'product_interest_c',
            'studio' => 'visible',
            'label' => 'LBL_PRODUCT_INTEREST',
          ),
          1 => 
          array (
            'name' => 'product_sub_type_interest_c',
            'studio' => 'visible',
            'label' => 'LBL_PRODUCT_SUB_TYPE_INTEREST',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'payment_type_c',
            'studio' => 'visible',
            'label' => 'LBL_PAYMENT_TYPE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'opportunity_value_c',
            'label' => 'LBL_OPPORTUNITY_VALUE',
          ),
          1 => 
          array (
            'name' => 'opportunity_horizon_c',
            'label' => 'LBL_OPPORTUNITY_HORIZON',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'investment_behaviour_segment_c',
            'studio' => 'visible',
            'label' => 'LBL_INVESTMENT_BEHAVIOUR_SEGMENT',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'sales_stage_c',
            'studio' => 'visible',
            'label' => 'LBL_SALES_STAGE',
          ),
          1 => 
          array (
            'name' => 'disposition_c',
            'studio' => 'visible',
            'label' => 'LBL_DISPOSITION',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'next_call_planning_date_c',
            'label' => 'LBL_NEXT_CALL_PLANNING_DATE',
          ),
          1 => 
          array (
            'name' => 'next_call_planning_comments_c',
            'studio' => 'visible',
            'label' => 'LBL_NEXT_CALL_PLANNING_COMMENTS',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'contacts_scrm_products_1_name',
            'label' => 'LBL_CONTACTS_SCRM_PRODUCTS_1_FROM_CONTACTS_TITLE',
          ),
        ),
        7 => 
        array (
          0 => 'assigned_user_name',
          1 => '',
        ),
      ),
    ),
  ),
);
?>
