<?php
// created: 2017-02-09 05:00:22
$dictionary["scrm_user_assignment_rule_users"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'scrm_user_assignment_rule_users' => 
    array (
      'lhs_module' => 'Users',
      'lhs_table' => 'users',
      'lhs_key' => 'id',
      'rhs_module' => 'scrm_User_Assignment_Rule',
      'rhs_table' => 'scrm_user_assignment_rule',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'scrm_user_assignment_rule_users_c',
      'join_key_lhs' => 'scrm_user_assignment_rule_usersusers_ida',
      'join_key_rhs' => 'scrm_user_assignment_rule_usersscrm_user_assignment_rule_idb',
    ),
  ),
  'table' => 'scrm_user_assignment_rule_users_c',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'id',
      'type' => 'varchar',
      'len' => 36,
    ),
    1 => 
    array (
      'name' => 'date_modified',
      'type' => 'datetime',
    ),
    2 => 
    array (
      'name' => 'deleted',
      'type' => 'bool',
      'len' => '1',
      'default' => '0',
      'required' => true,
    ),
    3 => 
    array (
      'name' => 'scrm_user_assignment_rule_usersusers_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'scrm_user_assignment_rule_usersscrm_user_assignment_rule_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'scrm_user_assignment_rule_usersspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'scrm_user_assignment_rule_users_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'scrm_user_assignment_rule_usersusers_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'scrm_user_assignment_rule_users_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'scrm_user_assignment_rule_usersscrm_user_assignment_rule_idb',
      ),
    ),
  ),
);