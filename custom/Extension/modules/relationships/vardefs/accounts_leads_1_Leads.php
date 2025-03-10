<?php
// created: 2017-09-11 11:41:22
$dictionary["Lead"]["fields"]["accounts_leads_1"] = array (
  'name' => 'accounts_leads_1',
  'type' => 'link',
  'relationship' => 'accounts_leads_1',
  'source' => 'non-db',
  'module' => 'Accounts',
  'bean_name' => 'Account',
  'vname' => 'LBL_ACCOUNTS_LEADS_1_FROM_ACCOUNTS_TITLE',
  'id_name' => 'accounts_leads_1accounts_ida',
);
$dictionary["Lead"]["fields"]["accounts_leads_1_name"] = array (
  'name' => 'accounts_leads_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_ACCOUNTS_LEADS_1_FROM_ACCOUNTS_TITLE',
  'save' => true,
  'id_name' => 'accounts_leads_1accounts_ida',
  'link' => 'accounts_leads_1',
  'table' => 'accounts',
  'module' => 'Accounts',
  'rname' => 'name',
);
$dictionary["Lead"]["fields"]["accounts_leads_1accounts_ida"] = array (
  'name' => 'accounts_leads_1accounts_ida',
  'type' => 'link',
  'relationship' => 'accounts_leads_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_ACCOUNTS_LEADS_1_FROM_LEADS_TITLE',
);
