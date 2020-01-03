<?php
$module_name = 'scrm_Campaign_Source';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
          3 => 'FIND_DUPLICATES',
        ),
      ),
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 
          array (
            'name' => 'source_id',
            'label' => 'LBL_SOURCE_ID',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'publisher',
            'label' => 'LBL_PUBLISHER',
          ),
          1 => 
          array (
            'name' => 'campaign_subid',
            'label' => 'LBL_CAMPAIGN_SUBID',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'content',
            'label' => 'LBL_CONTENT',
          ),
          1 => 
          array (
            'name' => 'agency_name',
            'label' => 'LBL_AGENCY_NAME',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'finance_url',
            'label' => 'LBL_FINANCE_URL',
          ),
          1 => 'assigned_user_name',
        ),
        4 => 
        array (
          0 => 'description',
        ),
      ),
    ),
  ),
);
?>
