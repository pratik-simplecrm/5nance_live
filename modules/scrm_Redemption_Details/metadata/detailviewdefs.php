<?php
$module_name = 'scrm_Redemption_Details';
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
            'name' => 'investor_email_id',
            'label' => 'LBL_INVESTOR_EMAIL_ID',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'redemption_date',
            'label' => 'LBL_REDEMPTION_DATE',
          ),
          1 => 
          array (
            'name' => 'scheme_name',
            'label' => 'LBL_SCHEME_NAME',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'folio_number',
            'label' => 'LBL_FOLIO_NUMBER',
          ),
          1 => 
          array (
            'name' => 'redemption_amount',
            'label' => 'LBL_REDEMPTION_AMOUNT',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'redemption_status',
            'label' => 'LBL_REDEMPTION_STATUS',
          ),
          1 => '',
        ),
      ),
    ),
  ),
);
?>
