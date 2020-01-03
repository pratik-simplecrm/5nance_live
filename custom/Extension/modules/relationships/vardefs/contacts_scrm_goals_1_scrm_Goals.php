<?php
// created: 2017-09-16 14:10:30
$dictionary["scrm_Goals"]["fields"]["contacts_scrm_goals_1"] = array (
  'name' => 'contacts_scrm_goals_1',
  'type' => 'link',
  'relationship' => 'contacts_scrm_goals_1',
  'source' => 'non-db',
  'module' => 'Contacts',
  'bean_name' => 'Contact',
  'vname' => 'LBL_CONTACTS_SCRM_GOALS_1_FROM_CONTACTS_TITLE',
  'id_name' => 'contacts_scrm_goals_1contacts_ida',
);
$dictionary["scrm_Goals"]["fields"]["contacts_scrm_goals_1_name"] = array (
  'name' => 'contacts_scrm_goals_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_CONTACTS_SCRM_GOALS_1_FROM_CONTACTS_TITLE',
  'save' => true,
  'id_name' => 'contacts_scrm_goals_1contacts_ida',
  'link' => 'contacts_scrm_goals_1',
  'table' => 'contacts',
  'module' => 'Contacts',
  'rname' => 'name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["scrm_Goals"]["fields"]["contacts_scrm_goals_1contacts_ida"] = array (
  'name' => 'contacts_scrm_goals_1contacts_ida',
  'type' => 'link',
  'relationship' => 'contacts_scrm_goals_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_CONTACTS_SCRM_GOALS_1_FROM_SCRM_GOALS_TITLE',
);
