<?php
// created: 2017-02-09 05:00:22
$dictionary["scrm_User_Assignment_Rule"]["fields"]["scrm_user_assignment_rule_users"] = array (
  'name' => 'scrm_user_assignment_rule_users',
  'type' => 'link',
  'relationship' => 'scrm_user_assignment_rule_users',
  'source' => 'non-db',
  'module' => 'Users',
  'bean_name' => 'User',
  'vname' => 'LBL_SCRM_USER_ASSIGNMENT_RULE_USERS_FROM_USERS_TITLE',
  'id_name' => 'scrm_user_assignment_rule_usersusers_ida',
);
$dictionary["scrm_User_Assignment_Rule"]["fields"]["scrm_user_assignment_rule_users_name"] = array (
  'name' => 'scrm_user_assignment_rule_users_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_SCRM_USER_ASSIGNMENT_RULE_USERS_FROM_USERS_TITLE',
  'save' => true,
  'id_name' => 'scrm_user_assignment_rule_usersusers_ida',
  'link' => 'scrm_user_assignment_rule_users',
  'table' => 'users',
  'module' => 'Users',
  'rname' => 'name',
);
$dictionary["scrm_User_Assignment_Rule"]["fields"]["scrm_user_assignment_rule_usersusers_ida"] = array (
  'name' => 'scrm_user_assignment_rule_usersusers_ida',
  'type' => 'link',
  'relationship' => 'scrm_user_assignment_rule_users',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_SCRM_USER_ASSIGNMENT_RULE_USERS_FROM_SCRM_USER_ASSIGNMENT_RULE_TITLE',
);
