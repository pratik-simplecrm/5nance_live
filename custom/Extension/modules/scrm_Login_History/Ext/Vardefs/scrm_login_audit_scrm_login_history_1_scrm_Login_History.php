<?php
// created: 2017-09-01 03:11:19
$dictionary["scrm_Login_History"]["fields"]["scrm_login_audit_scrm_login_history_1"] = array (
  'name' => 'scrm_login_audit_scrm_login_history_1',
  'type' => 'link',
  'relationship' => 'scrm_login_audit_scrm_login_history_1',
  'source' => 'non-db',
  'module' => 'scrm_Login_Audit',
  'bean_name' => 'scrm_Login_Audit',
  'vname' => 'LBL_SCRM_LOGIN_AUDIT_SCRM_LOGIN_HISTORY_1_FROM_SCRM_LOGIN_AUDIT_TITLE',
  'id_name' => 'scrm_login_audit_scrm_login_history_1scrm_login_audit_ida',
);
$dictionary["scrm_Login_History"]["fields"]["scrm_login_audit_scrm_login_history_1_name"] = array (
  'name' => 'scrm_login_audit_scrm_login_history_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_SCRM_LOGIN_AUDIT_SCRM_LOGIN_HISTORY_1_FROM_SCRM_LOGIN_AUDIT_TITLE',
  'save' => true,
  'id_name' => 'scrm_login_audit_scrm_login_history_1scrm_login_audit_ida',
  'link' => 'scrm_login_audit_scrm_login_history_1',
  'table' => 'scrm_login_audit',
  'module' => 'scrm_Login_Audit',
  'rname' => 'name',
);
$dictionary["scrm_Login_History"]["fields"]["scrm_login_audit_scrm_login_history_1scrm_login_audit_ida"] = array (
  'name' => 'scrm_login_audit_scrm_login_history_1scrm_login_audit_ida',
  'type' => 'link',
  'relationship' => 'scrm_login_audit_scrm_login_history_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_SCRM_LOGIN_AUDIT_SCRM_LOGIN_HISTORY_1_FROM_SCRM_LOGIN_HISTORY_TITLE',
);
