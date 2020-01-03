<?php
$module_name = 'scrm_Products';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      0 => 'name',
      1 => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
      ),
    ),
    'advanced_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'no_of_attempts_c' => 
      array (
        'type' => 'int',
        'default' => true,
        'label' => 'LBL_NO_OF_ATTEMPTS',
        'width' => '10%',
        'name' => 'no_of_attempts_c',
      ),
      'product_interest_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_PRODUCT_INTEREST',
        'width' => '10%',
        'name' => 'product_interest_c',
      ),
      'product_sub_type_interest_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_PRODUCT_SUB_TYPE_INTEREST',
        'width' => '10%',
        'name' => 'product_sub_type_interest_c',
      ),
      'sales_stage_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_SALES_STAGE',
        'width' => '10%',
        'name' => 'sales_stage_c',
      ),
      'next_call_planning_date_c' => 
      array (
        'type' => 'datetimecombo',
        'default' => true,
        'label' => 'LBL_NEXT_CALL_PLANNING_DATE',
        'width' => '10%',
        'name' => 'next_call_planning_date_c',
      ),
      'investment_behaviour_segment_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_INVESTMENT_BEHAVIOUR_SEGMENT',
        'width' => '10%',
        'name' => 'investment_behaviour_segment_c',
      ),
      'next_call_planning_comments_c' => 
      array (
        'type' => 'text',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_NEXT_CALL_PLANNING_COMMENTS',
        'sortable' => false,
        'width' => '10%',
        'name' => 'next_call_planning_comments_c',
      ),
      'disposition_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_DISPOSITION',
        'width' => '10%',
        'name' => 'disposition_c',
      ),
      'assigned_user_id' => 
      array (
        'name' => 'assigned_user_id',
        'label' => 'LBL_ASSIGNED_TO',
        'type' => 'enum',
        'function' => 
        array (
          'name' => 'get_user_array',
          'params' => 
          array (
            0 => false,
          ),
        ),
        'default' => true,
        'width' => '10%',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
?>
