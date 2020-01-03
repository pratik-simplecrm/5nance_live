<?php
// created: 2017-09-01 12:43:25
$dictionary["users_scrm_login_audit_2"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'users_scrm_login_audit_2' => 
    array (
      'lhs_module' => 'Users',
      'lhs_table' => 'users',
      'lhs_key' => 'id',
      'rhs_module' => 'scrm_Login_Audit',
      'rhs_table' => 'scrm_login_audit',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'users_scrm_login_audit_2_c',
      'join_key_lhs' => 'users_scrm_login_audit_2users_ida',
      'join_key_rhs' => 'users_scrm_login_audit_2scrm_login_audit_idb',
    ),
  ),
  'table' => 'users_scrm_login_audit_2_c',
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
      'name' => 'users_scrm_login_audit_2users_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'users_scrm_login_audit_2scrm_login_audit_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'users_scrm_login_audit_2spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'users_scrm_login_audit_2_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'users_scrm_login_audit_2users_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'users_scrm_login_audit_2_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'users_scrm_login_audit_2scrm_login_audit_idb',
      ),
    ),
  ),
);