<?php
// created: 2018-05-15 18:58:24
$dictionary["scrm_products_activities_1_calls"] = array (
  'relationships' => 
  array (
    'scrm_products_activities_1_calls' => 
    array (
      'lhs_module' => 'scrm_Products',
      'lhs_table' => 'scrm_products',
      'lhs_key' => 'id',
      'rhs_module' => 'Calls',
      'rhs_table' => 'calls',
      'rhs_key' => 'parent_id',
      'relationship_type' => 'one-to-many',
      'relationship_role_column' => 'parent_type',
      'relationship_role_column_value' => 'scrm_Products',
    ),
  ),
  'fields' => '',
  'indices' => '',
  'table' => '',
);