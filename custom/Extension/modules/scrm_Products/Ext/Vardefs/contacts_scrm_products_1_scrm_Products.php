<?php
// created: 2018-05-15 18:55:36
$dictionary["scrm_Products"]["fields"]["contacts_scrm_products_1"] = array (
  'name' => 'contacts_scrm_products_1',
  'type' => 'link',
  'relationship' => 'contacts_scrm_products_1',
  'source' => 'non-db',
  'module' => 'Contacts',
  'bean_name' => 'Contact',
  'vname' => 'LBL_CONTACTS_SCRM_PRODUCTS_1_FROM_CONTACTS_TITLE',
  'id_name' => 'contacts_scrm_products_1contacts_ida',
);
$dictionary["scrm_Products"]["fields"]["contacts_scrm_products_1_name"] = array (
  'name' => 'contacts_scrm_products_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_CONTACTS_SCRM_PRODUCTS_1_FROM_CONTACTS_TITLE',
  'save' => true,
  'id_name' => 'contacts_scrm_products_1contacts_ida',
  'link' => 'contacts_scrm_products_1',
  'table' => 'contacts',
  'module' => 'Contacts',
  'rname' => 'name',
  'db_concat_fields' => 
  array (
    0 => 'first_name',
    1 => 'last_name',
  ),
);
$dictionary["scrm_Products"]["fields"]["contacts_scrm_products_1contacts_ida"] = array (
  'name' => 'contacts_scrm_products_1contacts_ida',
  'type' => 'link',
  'relationship' => 'contacts_scrm_products_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_CONTACTS_SCRM_PRODUCTS_1_FROM_SCRM_PRODUCTS_TITLE',
);
