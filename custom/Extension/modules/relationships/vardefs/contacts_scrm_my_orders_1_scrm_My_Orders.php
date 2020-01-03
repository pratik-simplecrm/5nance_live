<?php
// created: 2017-09-16 14:08:50
$dictionary["scrm_My_Orders"]["fields"]["contacts_scrm_my_orders_1"] = array (
  'name' => 'contacts_scrm_my_orders_1',
  'type' => 'link',
  'relationship' => 'contacts_scrm_my_orders_1',
  'source' => 'non-db',
  'module' => 'Contacts',
  'bean_name' => 'Contact',
  'vname' => 'LBL_CONTACTS_SCRM_MY_ORDERS_1_FROM_CONTACTS_TITLE',
  'id_name' => 'contacts_scrm_my_orders_1contacts_ida',
);
$dictionary["scrm_My_Orders"]["fields"]["contacts_scrm_my_orders_1_name"] = array (
  'name' => 'contacts_scrm_my_orders_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_CONTACTS_SCRM_MY_ORDERS_1_FROM_CONTACTS_TITLE',
  'save' => true,
  'id_name' => 'contacts_scrm_my_orders_1contacts_ida',
  'link' => 'contacts_scrm_my_orders_1',
  'table' => 'contacts',
  'module' => 'Contacts',
  'rname' => 'name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["scrm_My_Orders"]["fields"]["contacts_scrm_my_orders_1contacts_ida"] = array (
  'name' => 'contacts_scrm_my_orders_1contacts_ida',
  'type' => 'link',
  'relationship' => 'contacts_scrm_my_orders_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_CONTACTS_SCRM_MY_ORDERS_1_FROM_SCRM_MY_ORDERS_TITLE',
);
