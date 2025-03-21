<?php 
 $GLOBALS["dictionary"]["scrm_Risk_Profile"]=array (
  'table' => 'scrm_risk_profile',
  'audited' => true,
  'inline_edit' => true,
  'duplicate_merge' => true,
  'fields' => 
  array (
    'id' => 
    array (
      'name' => 'id',
      'vname' => 'LBL_ID',
      'type' => 'id',
      'required' => true,
      'reportable' => true,
      'comment' => 'Unique identifier',
      'inline_edit' => false,
    ),
    'name' => 
    array (
      'name' => 'name',
      'vname' => 'LBL_NAME',
      'type' => 'name',
      'link' => true,
      'dbType' => 'varchar',
      'len' => 255,
      'unified_search' => true,
      'full_text_search' => 
      array (
        'boost' => 3,
      ),
      'required' => true,
      'importable' => 'required',
      'duplicate_merge' => 'enabled',
      'merge_filter' => 'selected',
    ),
    'date_entered' => 
    array (
      'name' => 'date_entered',
      'vname' => 'LBL_DATE_ENTERED',
      'type' => 'datetime',
      'group' => 'created_by_name',
      'comment' => 'Date record created',
      'enable_range_search' => true,
      'options' => 'date_range_search_dom',
      'inline_edit' => false,
    ),
    'date_modified' => 
    array (
      'name' => 'date_modified',
      'vname' => 'LBL_DATE_MODIFIED',
      'type' => 'datetime',
      'group' => 'modified_by_name',
      'comment' => 'Date record last modified',
      'enable_range_search' => true,
      'options' => 'date_range_search_dom',
      'inline_edit' => false,
    ),
    'modified_user_id' => 
    array (
      'name' => 'modified_user_id',
      'rname' => 'user_name',
      'id_name' => 'modified_user_id',
      'vname' => 'LBL_MODIFIED',
      'type' => 'assigned_user_name',
      'table' => 'users',
      'isnull' => 'false',
      'group' => 'modified_by_name',
      'dbType' => 'id',
      'reportable' => true,
      'comment' => 'User who last modified record',
      'massupdate' => false,
      'inline_edit' => false,
    ),
    'modified_by_name' => 
    array (
      'name' => 'modified_by_name',
      'vname' => 'LBL_MODIFIED_NAME',
      'type' => 'relate',
      'reportable' => false,
      'source' => 'non-db',
      'rname' => 'user_name',
      'table' => 'users',
      'id_name' => 'modified_user_id',
      'module' => 'Users',
      'link' => 'modified_user_link',
      'duplicate_merge' => 'disabled',
      'massupdate' => false,
      'inline_edit' => false,
    ),
    'created_by' => 
    array (
      'name' => 'created_by',
      'rname' => 'user_name',
      'id_name' => 'modified_user_id',
      'vname' => 'LBL_CREATED',
      'type' => 'assigned_user_name',
      'table' => 'users',
      'isnull' => 'false',
      'dbType' => 'id',
      'group' => 'created_by_name',
      'comment' => 'User who created record',
      'massupdate' => false,
      'inline_edit' => false,
    ),
    'created_by_name' => 
    array (
      'name' => 'created_by_name',
      'vname' => 'LBL_CREATED',
      'type' => 'relate',
      'reportable' => false,
      'link' => 'created_by_link',
      'rname' => 'user_name',
      'source' => 'non-db',
      'table' => 'users',
      'id_name' => 'created_by',
      'module' => 'Users',
      'duplicate_merge' => 'disabled',
      'importable' => 'false',
      'massupdate' => false,
      'inline_edit' => false,
    ),
    'description' => 
    array (
      'name' => 'description',
      'vname' => 'LBL_DESCRIPTION',
      'type' => 'text',
      'comment' => 'Full text of the note',
      'rows' => 6,
      'cols' => 80,
    ),
    'deleted' => 
    array (
      'name' => 'deleted',
      'vname' => 'LBL_DELETED',
      'type' => 'bool',
      'default' => '0',
      'reportable' => false,
      'comment' => 'Record deletion indicator',
    ),
    'created_by_link' => 
    array (
      'name' => 'created_by_link',
      'type' => 'link',
      'relationship' => 'scrm_risk_profile_created_by',
      'vname' => 'LBL_CREATED_USER',
      'link_type' => 'one',
      'module' => 'Users',
      'bean_name' => 'User',
      'source' => 'non-db',
    ),
    'modified_user_link' => 
    array (
      'name' => 'modified_user_link',
      'type' => 'link',
      'relationship' => 'scrm_risk_profile_modified_user',
      'vname' => 'LBL_MODIFIED_USER',
      'link_type' => 'one',
      'module' => 'Users',
      'bean_name' => 'User',
      'source' => 'non-db',
    ),
    'assigned_user_id' => 
    array (
      'name' => 'assigned_user_id',
      'rname' => 'user_name',
      'id_name' => 'assigned_user_id',
      'vname' => 'LBL_ASSIGNED_TO_ID',
      'group' => 'assigned_user_name',
      'type' => 'relate',
      'table' => 'users',
      'module' => 'Users',
      'reportable' => true,
      'isnull' => 'false',
      'dbType' => 'id',
      'audited' => true,
      'comment' => 'User ID assigned to record',
      'duplicate_merge' => 'disabled',
    ),
    'assigned_user_name' => 
    array (
      'name' => 'assigned_user_name',
      'link' => 'assigned_user_link',
      'vname' => 'LBL_ASSIGNED_TO_NAME',
      'rname' => 'user_name',
      'type' => 'relate',
      'reportable' => false,
      'source' => 'non-db',
      'table' => 'users',
      'id_name' => 'assigned_user_id',
      'module' => 'Users',
      'duplicate_merge' => 'disabled',
    ),
    'assigned_user_link' => 
    array (
      'name' => 'assigned_user_link',
      'type' => 'link',
      'relationship' => 'scrm_risk_profile_assigned_user',
      'vname' => 'LBL_ASSIGNED_TO_USER',
      'link_type' => 'one',
      'module' => 'Users',
      'bean_name' => 'User',
      'source' => 'non-db',
      'duplicate_merge' => 'enabled',
      'rname' => 'user_name',
      'id_name' => 'assigned_user_id',
      'table' => 'users',
    ),
    'contacts_scrm_risk_profile_1' => 
    array (
      'name' => 'contacts_scrm_risk_profile_1',
      'type' => 'link',
      'relationship' => 'contacts_scrm_risk_profile_1',
      'source' => 'non-db',
      'module' => 'Contacts',
      'bean_name' => 'Contact',
      'vname' => 'LBL_CONTACTS_SCRM_RISK_PROFILE_1_FROM_CONTACTS_TITLE',
      'id_name' => 'contacts_scrm_risk_profile_1contacts_ida',
    ),
    'contacts_scrm_risk_profile_1_name' => 
    array (
      'name' => 'contacts_scrm_risk_profile_1_name',
      'type' => 'relate',
      'source' => 'non-db',
      'vname' => 'LBL_CONTACTS_SCRM_RISK_PROFILE_1_FROM_CONTACTS_TITLE',
      'save' => true,
      'id_name' => 'contacts_scrm_risk_profile_1contacts_ida',
      'link' => 'contacts_scrm_risk_profile_1',
      'table' => 'contacts',
      'module' => 'Contacts',
      'rname' => 'name',
      'db_concat_fields' => 
      array (
        0 => 'first_name',
        1 => 'last_name',
      ),
    ),
    'contacts_scrm_risk_profile_1contacts_ida' => 
    array (
      'name' => 'contacts_scrm_risk_profile_1contacts_ida',
      'type' => 'link',
      'relationship' => 'contacts_scrm_risk_profile_1',
      'source' => 'non-db',
      'reportable' => false,
      'side' => 'right',
      'vname' => 'LBL_CONTACTS_SCRM_RISK_PROFILE_1_FROM_SCRM_RISK_PROFILE_TITLE',
    ),
    'toinvestmentperiod_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'To Investment Period',
      'required' => false,
      'source' => 'custom_fields',
      'name' => 'toinvestmentperiod_c',
      'vname' => 'LBL_TOINVESTMENTPERIOD',
      'type' => 'int',
      'massupdate' => '0',
      'default' => '',
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => '255',
      'size' => '20',
      'enable_range_search' => false,
      'disable_num_format' => '',
      'min' => false,
      'max' => false,
      'id' => 'scrm_Risk_Profiletoinvestmentperiod_c',
      'custom_module' => 'scrm_Risk_Profile',
    ),
    'riskprofileid_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'Risk Profile ID',
      'required' => false,
      'source' => 'custom_fields',
      'name' => 'riskprofileid_c',
      'vname' => 'LBL_RISKPROFILEID',
      'type' => 'int',
      'massupdate' => '0',
      'default' => '',
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => '255',
      'size' => '20',
      'enable_range_search' => false,
      'disable_num_format' => '',
      'min' => false,
      'max' => false,
      'id' => 'scrm_Risk_Profileriskprofileid_c',
      'custom_module' => 'scrm_Risk_Profile',
    ),
    'isactive_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'Is Active',
      'required' => false,
      'source' => 'custom_fields',
      'name' => 'isactive_c',
      'vname' => 'LBL_ISACTIVE',
      'type' => 'enum',
      'massupdate' => '0',
      'default' => '',
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => 100,
      'size' => '20',
      'options' => 'kyc',
      'studio' => 'visible',
      'dependency' => false,
      'id' => 'scrm_Risk_Profileisactive_c',
      'custom_module' => 'scrm_Risk_Profile',
    ),
    'portfolioid_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'Portfolio ID',
      'required' => false,
      'source' => 'custom_fields',
      'name' => 'portfolioid_c',
      'vname' => 'LBL_PORTFOLIOID',
      'type' => 'varchar',
      'massupdate' => '0',
      'default' => '',
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => '255',
      'size' => '20',
      'id' => 'scrm_Risk_Profileportfolioid_c',
      'custom_module' => 'scrm_Risk_Profile',
    ),
    'advisorymoduleid_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'Advisory Module ID',
      'required' => false,
      'source' => 'custom_fields',
      'name' => 'advisorymoduleid_c',
      'vname' => 'LBL_ADVISORYMODULEID',
      'type' => 'int',
      'massupdate' => '0',
      'default' => '',
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => '255',
      'size' => '20',
      'enable_range_search' => false,
      'disable_num_format' => '',
      'min' => false,
      'max' => false,
      'id' => 'scrm_Risk_Profileadvisorymoduleid_c',
      'custom_module' => 'scrm_Risk_Profile',
    ),
    'amountportfoliofilterid_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'amountPortfolioFilterID',
      'required' => false,
      'source' => 'custom_fields',
      'name' => 'amountportfoliofilterid_c',
      'vname' => 'LBL_AMOUNTPORTFOLIOFILTERID',
      'type' => 'int',
      'massupdate' => '0',
      'default' => '',
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => '255',
      'size' => '20',
      'enable_range_search' => false,
      'disable_num_format' => '',
      'min' => false,
      'max' => false,
      'id' => 'scrm_Risk_Profileamountportfoliofilterid_c',
      'custom_module' => 'scrm_Risk_Profile',
    ),
    'poid_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'Poid',
      'required' => false,
      'source' => 'custom_fields',
      'name' => 'poid_c',
      'vname' => 'LBL_POID',
      'type' => 'int',
      'massupdate' => '0',
      'default' => '',
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => '255',
      'size' => '20',
      'enable_range_search' => false,
      'disable_num_format' => '',
      'min' => false,
      'max' => false,
      'id' => 'scrm_Risk_Profilepoid_c',
      'custom_module' => 'scrm_Risk_Profile',
    ),
    'currency_id' => 
    array (
      'inline_edit' => 1,
      'required' => false,
      'source' => 'custom_fields',
      'name' => 'currency_id',
      'vname' => 'LBL_CURRENCY',
      'type' => 'currency_id',
      'massupdate' => '0',
      'default' => NULL,
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => '36',
      'size' => '20',
      'dbType' => 'id',
      'studio' => 'visible',
      'function' => 
      array (
        'name' => 'getCurrencyDropDown',
        'returns' => 'html',
      ),
      'id' => 'scrm_Risk_Profilecurrency_id',
      'custom_module' => 'scrm_Risk_Profile',
    ),
    'frominvestmentperiodinmonth_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'From Investment Period In Month',
      'required' => false,
      'source' => 'custom_fields',
      'name' => 'frominvestmentperiodinmonth_c',
      'vname' => 'LBL_FROMINVESTMENTPERIODINMONTH',
      'type' => 'int',
      'massupdate' => '0',
      'default' => '',
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => '255',
      'size' => '20',
      'enable_range_search' => false,
      'disable_num_format' => '',
      'min' => false,
      'max' => false,
      'id' => 'scrm_Risk_Profilefrominvestmentperiodinmonth_c',
      'custom_module' => 'scrm_Risk_Profile',
    ),
    'hideweightage_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'hideWeightage',
      'required' => false,
      'source' => 'custom_fields',
      'name' => 'hideweightage_c',
      'vname' => 'LBL_HIDEWEIGHTAGE',
      'type' => 'enum',
      'massupdate' => '0',
      'default' => '',
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => 100,
      'size' => '20',
      'options' => 'kyc',
      'studio' => 'visible',
      'dependency' => false,
      'id' => 'scrm_Risk_Profilehideweightage_c',
      'custom_module' => 'scrm_Risk_Profile',
    ),
    'tenureportfoliofilterid_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'tenurePortfolioFilterID',
      'required' => false,
      'source' => 'custom_fields',
      'name' => 'tenureportfoliofilterid_c',
      'vname' => 'LBL_TENUREPORTFOLIOFILTERID',
      'type' => 'int',
      'massupdate' => '0',
      'default' => '',
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => '255',
      'size' => '20',
      'enable_range_search' => false,
      'disable_num_format' => '',
      'min' => false,
      'max' => false,
      'id' => 'scrm_Risk_Profiletenureportfoliofilterid_c',
      'custom_module' => 'scrm_Risk_Profile',
    ),
    'minamount_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'Min Amount',
      'required' => false,
      'source' => 'custom_fields',
      'name' => 'minamount_c',
      'vname' => 'LBL_MINAMOUNT',
      'type' => 'currency',
      'massupdate' => '0',
      'default' => '',
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => '26',
      'size' => '20',
      'enable_range_search' => false,
      'precision' => 6,
      'id' => 'scrm_Risk_Profileminamount_c',
      'custom_module' => 'scrm_Risk_Profile',
    ),
    'investment_name_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'Investment Name',
      'required' => false,
      'source' => 'custom_fields',
      'name' => 'investment_name_c',
      'vname' => 'LBL_INVESTMENT_NAME',
      'type' => 'varchar',
      'massupdate' => '0',
      'default' => '',
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => '255',
      'size' => '20',
      'id' => 'scrm_Risk_Profileinvestment_name_c',
      'custom_module' => 'scrm_Risk_Profile',
    ),
    'ismainforprofile_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'Is main for Profile?',
      'required' => false,
      'source' => 'custom_fields',
      'name' => 'ismainforprofile_c',
      'vname' => 'LBL_ISMAINFORPROFILE',
      'type' => 'enum',
      'massupdate' => '0',
      'default' => '',
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => 100,
      'size' => '20',
      'options' => 'kyc',
      'studio' => 'visible',
      'dependency' => false,
      'id' => 'scrm_Risk_Profileismainforprofile_c',
      'custom_module' => 'scrm_Risk_Profile',
    ),
    'allocation_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'Allocation',
      'required' => false,
      'source' => 'custom_fields',
      'name' => 'allocation_c',
      'vname' => 'LBL_ALLOCATION',
      'type' => 'int',
      'massupdate' => '0',
      'default' => '',
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => '255',
      'size' => '20',
      'enable_range_search' => false,
      'disable_num_format' => '',
      'min' => false,
      'max' => false,
      'id' => 'scrm_Risk_Profileallocation_c',
      'custom_module' => 'scrm_Risk_Profile',
    ),
    'frominvestmentperiod_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'From Investment Period',
      'required' => false,
      'source' => 'custom_fields',
      'name' => 'frominvestmentperiod_c',
      'vname' => 'LBL_FROMINVESTMENTPERIOD',
      'type' => 'int',
      'massupdate' => '0',
      'default' => '',
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => '255',
      'size' => '20',
      'enable_range_search' => false,
      'disable_num_format' => '',
      'min' => false,
      'max' => false,
      'id' => 'scrm_Risk_Profilefrominvestmentperiod_c',
      'custom_module' => 'scrm_Risk_Profile',
    ),
    'maxamount_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'Max Amount',
      'required' => false,
      'source' => 'custom_fields',
      'name' => 'maxamount_c',
      'vname' => 'LBL_MAXAMOUNT',
      'type' => 'currency',
      'massupdate' => '0',
      'default' => '',
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => '26',
      'size' => '20',
      'enable_range_search' => false,
      'precision' => 6,
      'id' => 'scrm_Risk_Profilemaxamount_c',
      'custom_module' => 'scrm_Risk_Profile',
    ),
    'projecttypeid_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'projectTypeID',
      'required' => false,
      'source' => 'custom_fields',
      'name' => 'projecttypeid_c',
      'vname' => 'LBL_PROJECTTYPEID',
      'type' => 'int',
      'massupdate' => '0',
      'default' => '',
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => '255',
      'size' => '20',
      'enable_range_search' => false,
      'disable_num_format' => '',
      'min' => false,
      'max' => false,
      'id' => 'scrm_Risk_Profileprojecttypeid_c',
      'custom_module' => 'scrm_Risk_Profile',
    ),
    'id_profiling_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'ID',
      'required' => false,
      'source' => 'custom_fields',
      'name' => 'id_profiling_c',
      'vname' => 'LBL_ID_PROFILING',
      'type' => 'varchar',
      'massupdate' => '0',
      'default' => '',
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => '255',
      'size' => '20',
      'id' => 'scrm_Risk_Profileid_profiling_c',
      'custom_module' => 'scrm_Risk_Profile',
    ),
    'toinvestmentperiodinmonth_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'To Investment Period Month',
      'required' => false,
      'source' => 'custom_fields',
      'name' => 'toinvestmentperiodinmonth_c',
      'vname' => 'LBL_TOINVESTMENTPERIODINMONTH',
      'type' => 'int',
      'massupdate' => '0',
      'default' => '',
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => true,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => '255',
      'size' => '20',
      'enable_range_search' => false,
      'disable_num_format' => '',
      'min' => false,
      'max' => false,
      'id' => 'scrm_Risk_Profiletoinvestmentperiodinmonth_c',
      'custom_module' => 'scrm_Risk_Profile',
    ),
  ),
  'relationships' => 
  array (
    'scrm_risk_profile_modified_user' => 
    array (
      'lhs_module' => 'Users',
      'lhs_table' => 'users',
      'lhs_key' => 'id',
      'rhs_module' => 'scrm_Risk_Profile',
      'rhs_table' => 'scrm_risk_profile',
      'rhs_key' => 'modified_user_id',
      'relationship_type' => 'one-to-many',
    ),
    'scrm_risk_profile_created_by' => 
    array (
      'lhs_module' => 'Users',
      'lhs_table' => 'users',
      'lhs_key' => 'id',
      'rhs_module' => 'scrm_Risk_Profile',
      'rhs_table' => 'scrm_risk_profile',
      'rhs_key' => 'created_by',
      'relationship_type' => 'one-to-many',
    ),
    'scrm_risk_profile_assigned_user' => 
    array (
      'lhs_module' => 'Users',
      'lhs_table' => 'users',
      'lhs_key' => 'id',
      'rhs_module' => 'scrm_Risk_Profile',
      'rhs_table' => 'scrm_risk_profile',
      'rhs_key' => 'assigned_user_id',
      'relationship_type' => 'one-to-many',
    ),
  ),
  'optimistic_locking' => true,
  'unified_search' => true,
  'indices' => 
  array (
    'id' => 
    array (
      'name' => 'scrm_risk_profilepk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
  ),
  'templates' => 
  array (
    'assignable' => 'assignable',
    'basic' => 'basic',
  ),
  'custom_fields' => true,
);