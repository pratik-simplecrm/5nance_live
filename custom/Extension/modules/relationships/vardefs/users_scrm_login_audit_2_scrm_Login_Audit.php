<?php
// created: 2017-09-01 12:43:25
$dictionary["scrm_Login_Audit"]["fields"]["users_scrm_login_audit_2"] = array (
  'name' => 'users_scrm_login_audit_2',
  'type' => 'link',
  'relationship' => 'users_scrm_login_audit_2',
  'source' => 'non-db',
  'module' => 'Users',
  'bean_name' => 'User',
  'vname' => 'LBL_USERS_SCRM_LOGIN_AUDIT_2_FROM_USERS_TITLE',
  'id_name' => 'users_scrm_login_audit_2users_ida',
);
$dictionary["scrm_Login_Audit"]["fields"]["users_scrm_login_audit_2_name"] = array (
  'name' => 'users_scrm_login_audit_2_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_USERS_SCRM_LOGIN_AUDIT_2_FROM_USERS_TITLE',
  'save' => true,
  'id_name' => 'users_scrm_login_audit_2users_ida',
  'link' => 'users_scrm_login_audit_2',
  'table' => 'users',
  'module' => 'Users',
  'rname' => 'name',
);
$dictionary["scrm_Login_Audit"]["fields"]["users_scrm_login_audit_2users_ida"] = array (
  'name' => 'users_scrm_login_audit_2users_ida',
  'type' => 'link',
  'relationship' => 'users_scrm_login_audit_2',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_USERS_SCRM_LOGIN_AUDIT_2_FROM_SCRM_LOGIN_AUDIT_TITLE',
);
