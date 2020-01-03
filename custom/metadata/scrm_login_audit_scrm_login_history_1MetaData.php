<?php
// created: 2017-09-01 03:11:19
$dictionary["scrm_login_audit_scrm_login_history_1"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'scrm_login_audit_scrm_login_history_1' => 
    array (
      'lhs_module' => 'scrm_Login_Audit',
      'lhs_table' => 'scrm_login_audit',
      'lhs_key' => 'id',
      'rhs_module' => 'scrm_Login_History',
      'rhs_table' => 'scrm_login_history',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'scrm_login_audit_scrm_login_history_1_c',
      'join_key_lhs' => 'scrm_login_audit_scrm_login_history_1scrm_login_audit_ida',
      'join_key_rhs' => 'scrm_login_audit_scrm_login_history_1scrm_login_history_idb',
    ),
  ),
  'table' => 'scrm_login_audit_scrm_login_history_1_c',
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
      'name' => 'scrm_login_audit_scrm_login_history_1scrm_login_audit_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'scrm_login_audit_scrm_login_history_1scrm_login_history_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'scrm_login_audit_scrm_login_history_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'scrm_login_audit_scrm_login_history_1_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'scrm_login_audit_scrm_login_history_1scrm_login_audit_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'scrm_login_audit_scrm_login_history_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'scrm_login_audit_scrm_login_history_1scrm_login_history_idb',
      ),
    ),
  ),
);