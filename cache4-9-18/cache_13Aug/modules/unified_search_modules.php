<?php
// created: 2018-08-06 18:30:00
$unified_search_modules = array (
  'AOD_Index' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'AOD_IndexEvent' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'AOK_Knowledge_Base_Categories' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'AOP_Case_Events' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'AOP_Case_Updates' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'AOR_Reports' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'AOR_Scheduled_Reports' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'AOS_Contracts' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'AOS_Invoices' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'AOS_PDF_Templates' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'AOS_Product_Categories' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'AOS_Products' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'AOS_Quotes' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'AOW_Processed' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'AOW_WorkFlow' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'Accounts' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
      'phone' => 
      array (
        'query_type' => 'default',
        'db_field' => 
        array (
          0 => 'phone_office',
        ),
        'vname' => 'LBL_ANY_PHONE',
      ),
      'email' => 
      array (
        'query_type' => 'default',
        'operator' => 'subquery',
        'subquery' => 'SELECT eabr.bean_id FROM email_addr_bean_rel eabr JOIN email_addresses ea ON (ea.id = eabr.email_address_id) WHERE eabr.deleted=0 AND ea.email_address LIKE',
        'db_field' => 
        array (
          0 => 'id',
        ),
        'vname' => 'LBL_ANY_EMAIL',
      ),
    ),
    'default' => true,
  ),
  'Bugs' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
      'bug_number' => 
      array (
        'query_type' => 'default',
        'operator' => 'in',
      ),
    ),
    'default' => false,
  ),
  'Calls' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => true,
  ),
  'Calls_Reschedule' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'Campaigns' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'Cases' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
      'case_number' => 
      array (
        'query_type' => 'default',
        'operator' => 'in',
      ),
      'account_name' => 
      array (
        'query_type' => 'default',
        'db_field' => 
        array (
          0 => 'accounts.name',
        ),
      ),
    ),
    'default' => true,
  ),
  'Contacts' => 
  array (
    'fields' => 
    array (
      'first_name' => 
      array (
        'query_type' => 'default',
      ),
      'last_name' => 
      array (
        'query_type' => 'default',
      ),
      'phone' => 
      array (
        'query_type' => 'default',
        'db_field' => 
        array (
          0 => 'phone_mobile',
          1 => 'phone_work',
          2 => 'phone_other',
          3 => 'phone_fax',
          4 => 'assistant_phone',
        ),
      ),
      'assistant' => 
      array (
        'query_type' => 'default',
      ),
      'email' => 
      array (
        'query_type' => 'default',
        'operator' => 'subquery',
        'subquery' => 'SELECT eabr.bean_id FROM email_addr_bean_rel eabr JOIN email_addresses ea ON (ea.id = eabr.email_address_id) WHERE eabr.deleted=0 AND ea.email_address LIKE',
        'db_field' => 
        array (
          0 => 'id',
        ),
      ),
      'account_name' => 
      array (
        'query_type' => 'default',
        'db_field' => 
        array (
          0 => 'accounts.name',
        ),
      ),
      'search_name' => 
      array (
        'query_type' => 'default',
        'db_field' => 
        array (
          0 => 'first_name',
          1 => 'last_name',
        ),
        'force_unifiedsearch' => true,
      ),
    ),
    'default' => true,
  ),
  'Documents' => 
  array (
    'fields' => 
    array (
      'document_name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => true,
  ),
  'FP_Event_Locations' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'FP_events' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'Leads' => 
  array (
    'fields' => 
    array (
      'first_name' => 
      array (
        'query_type' => 'default',
      ),
      'last_name' => 
      array (
        'query_type' => 'default',
      ),
      'phone' => 
      array (
        'query_type' => 'default',
        'db_field' => 
        array (
          0 => 'phone_mobile',
          1 => 'phone_work',
          2 => 'phone_other',
          3 => 'phone_fax',
          4 => 'phone_home',
        ),
      ),
      'assistant' => 
      array (
        'query_type' => 'default',
      ),
      'account_name' => 
      array (
        'query_type' => 'default',
        'db_field' => 
        array (
          0 => 'leads.account_name',
        ),
      ),
      'email' => 
      array (
        'query_type' => 'default',
        'operator' => 'subquery',
        'subquery' => 'SELECT eabr.bean_id FROM email_addr_bean_rel eabr JOIN email_addresses ea ON (ea.id = eabr.email_address_id) WHERE eabr.deleted=0 AND ea.email_address LIKE',
        'db_field' => 
        array (
          0 => 'id',
        ),
      ),
      'search_name' => 
      array (
        'query_type' => 'default',
        'db_field' => 
        array (
          0 => 'first_name',
          1 => 'last_name',
        ),
        'force_unifiedsearch' => true,
      ),
    ),
    'default' => true,
  ),
  'Meetings' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => true,
  ),
  'Notes' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => true,
  ),
  'Opportunities' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
      'account_name' => 
      array (
        'query_type' => 'default',
        'db_field' => 
        array (
          0 => 'accounts.name',
        ),
      ),
    ),
    'default' => true,
  ),
  'Project' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'ProjectTask' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'ProspectLists' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'Prospects' => 
  array (
    'fields' => 
    array (
      'first_name' => 
      array (
        'query_type' => 'default',
      ),
      'last_name' => 
      array (
        'query_type' => 'default',
      ),
      'phone' => 
      array (
        'query_type' => 'default',
        'db_field' => 
        array (
          0 => 'phone_mobile',
          1 => 'phone_work',
          2 => 'phone_other',
          3 => 'phone_fax',
          4 => 'phone_home',
        ),
      ),
      'assistant' => 
      array (
        'query_type' => 'default',
      ),
      'search_name' => 
      array (
        'query_type' => 'default',
        'db_field' => 
        array (
          0 => 'first_name',
          1 => 'last_name',
        ),
        'force_unifiedsearch' => true,
      ),
    ),
    'default' => false,
  ),
  'Tasks' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
      'contact_name' => 
      array (
        'query_type' => 'default',
        'db_field' => 
        array (
          0 => 'contacts.first_name',
          1 => 'contacts.last_name',
        ),
        'force_unifiedsearch' => true,
      ),
    ),
    'default' => false,
  ),
  'dash_dashboard_manager' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'jjwg_Address_Cache' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'jjwg_Areas' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'jjwg_Maps' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'jjwg_Markers' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'scrm_Bank_Details' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'scrm_Callback_Request' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'scrm_Campaign_Source' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'scrm_Custom_Reports' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'scrm_ECS_Mandate' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'scrm_Email_Keywords' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'scrm_Equity' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'scrm_Escalation_Audit' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'scrm_Escalation_Matrix' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'scrm_Goals' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'scrm_Holidays_List' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'scrm_Insurance' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'scrm_Loans' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'scrm_Login_Audit' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'scrm_Login_History' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'scrm_My_Orders' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'scrm_Nominees' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'scrm_Products' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'scrm_Risk_Profile' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'scrm_SIP' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'scrm_SMS' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'scrm_SMS_Template' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'scrm_User_Assignment_Rule' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'scrm_User_Creation_Log' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
  'simpl_Cloud_Agent' => 
  array (
    'fields' => 
    array (
      'name' => 
      array (
        'query_type' => 'default',
      ),
    ),
    'default' => false,
  ),
);