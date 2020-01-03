<?php
$module_name = 'scrm_Products';
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
        2 => 
        array (
          0 => 
          array (
            'name' => 'payment_type_c',
            'studio' => 'visible',
            'label' => 'LBL_PAYMENT_TYPE',
          ),
          1 => 
          array (
            'name' => 'source_c',
            'label' => 'LBL_SOURCE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'partner_name_c',
            'label' => 'LBL_PARTNER_NAME',
          ),
          1 => 
          array (
            'name' => 'partner_comments_c',
            'studio' => 'visible',
            'label' => 'LBL_PARTNER_COMMENTS_C',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'campaign_type_c',
            'label' => 'LBL_CAMPAIGN_TYPE',
          ),
          1 => 
          array (
            'name' => 'utm_campaign_id_c',
            'label' => 'LBL_UTM_CAMPAIGN_ID',
          ),
        ),
        5 => 
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
        6 => 
        array (
          0 => 
          array (
            'name' => 'investment_behaviour_segment_c',
            'studio' => 'visible',
            'label' => 'LBL_INVESTMENT_BEHAVIOUR_SEGMENT',
          ),
          1 => 
          array (
            'name' => 'no_of_attempts_c',
            'label' => 'LBL_NO_OF_ATTEMPTS',
          ),
        ),
        7 => 
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
        8 => 
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
        9 => 
        array (
          0 => 
          array (
            'name' => 'comment_c',
            'studio' => 'visible',
            'label' => 'LBL_COMMENT',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'contacts_scrm_products_1_name',
          ),
        ),
        11 => 
        array (
          0 => 'assigned_user_name',
          1 => '',
        ),
      ),
    ),
  ),
);
?>
