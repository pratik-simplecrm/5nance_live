<?php
$module_name = 'scrm_Risk_Profile';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
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
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'riskprofileid_c',
            'label' => 'LBL_RISKPROFILEID',
          ),
          1 => 
          array (
            'name' => 'investment_name_c',
            'label' => 'LBL_INVESTMENT_NAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'allocation_c',
            'label' => 'LBL_ALLOCATION',
          ),
          1 => 
          array (
            'name' => 'advisorymoduleid_c',
            'label' => 'LBL_ADVISORYMODULEID',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'contacts_scrm_risk_profile_1_name',
          ),
          1 => 
          array (
            'name' => 'tenureportfoliofilterid_c',
            'label' => 'LBL_TENUREPORTFOLIOFILTERID',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'frominvestmentperiod_c',
            'label' => 'LBL_FROMINVESTMENTPERIOD',
          ),
          1 => 
          array (
            'name' => 'frominvestmentperiodinmonth_c',
            'label' => 'LBL_FROMINVESTMENTPERIODINMONTH',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'isactive_c',
            'studio' => 'visible',
            'label' => 'LBL_ISACTIVE',
          ),
          1 => 
          array (
            'name' => 'ismainforprofile_c',
            'studio' => 'visible',
            'label' => 'LBL_ISMAINFORPROFILE',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'portfolioid_c',
            'label' => 'LBL_PORTFOLIOID',
          ),
          1 => 
          array (
            'name' => 'toinvestmentperiod_c',
            'label' => 'LBL_TOINVESTMENTPERIOD',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'toinvestmentperiodinmonth_c',
            'label' => 'LBL_TOINVESTMENTPERIODINMONTH',
          ),
          1 => 
          array (
            'name' => 'amountportfoliofilterid_c',
            'label' => 'LBL_AMOUNTPORTFOLIOFILTERID',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'hideweightage_c',
            'studio' => 'visible',
            'label' => 'LBL_HIDEWEIGHTAGE',
          ),
          1 => 
          array (
            'name' => 'projecttypeid_c',
            'label' => 'LBL_PROJECTTYPEID',
          ),
        ),
      ),
    ),
  ),
);
?>
