<?php
// created: 2017-09-25 11:42:51
$dictionary["leads_scrm_campaign_source_1"] = array (
  'true_relationship_type' => 'many-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'leads_scrm_campaign_source_1' => 
    array (
      'lhs_module' => 'Leads',
      'lhs_table' => 'leads',
      'lhs_key' => 'id',
      'rhs_module' => 'scrm_Campaign_Source',
      'rhs_table' => 'scrm_campaign_source',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'leads_scrm_campaign_source_1_c',
      'join_key_lhs' => 'leads_scrm_campaign_source_1leads_ida',
      'join_key_rhs' => 'leads_scrm_campaign_source_1scrm_campaign_source_idb',
    ),
  ),
  'table' => 'leads_scrm_campaign_source_1_c',
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
      'name' => 'leads_scrm_campaign_source_1leads_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'leads_scrm_campaign_source_1scrm_campaign_source_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'leads_scrm_campaign_source_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'leads_scrm_campaign_source_1_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'leads_scrm_campaign_source_1leads_ida',
        1 => 'leads_scrm_campaign_source_1scrm_campaign_source_idb',
      ),
    ),
  ),
);