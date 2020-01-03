<?php 
 $GLOBALS["dictionary"]["Case"]=array (
  'table' => 'cases',
  'audited' => true,
  'unified_search' => true,
  'full_text_search' => true,
  'unified_search_default_enabled' => true,
  'duplicate_merge' => true,
  'comment' => 'Cases are issues or problems that a customer asks a support representative to resolve',
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
      'vname' => 'LBL_SUBJECT',
      'type' => 'name',
      'link' => true,
      'dbType' => 'varchar',
      'len' => 255,
      'audited' => true,
      'unified_search' => true,
      'full_text_search' => 
      array (
        'boost' => 3,
      ),
      'comment' => 'The short description of the bug',
      'merge_filter' => 'selected',
      'required' => true,
      'importable' => 'required',
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
      'relationship' => 'cases_created_by',
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
      'relationship' => 'cases_modified_user',
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
      'relationship' => 'cases_assigned_user',
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
    'SecurityGroups' => 
    array (
      'name' => 'SecurityGroups',
      'type' => 'link',
      'relationship' => 'securitygroups_cases',
      'module' => 'SecurityGroups',
      'bean_name' => 'SecurityGroup',
      'source' => 'non-db',
      'vname' => 'LBL_SECURITYGROUPS',
    ),
    'case_number' => 
    array (
      'name' => 'case_number',
      'vname' => 'LBL_NUMBER',
      'type' => 'int',
      'readonly' => true,
      'len' => 11,
      'required' => true,
      'auto_increment' => true,
      'unified_search' => true,
      'full_text_search' => 
      array (
        'boost' => 3,
      ),
      'comment' => 'Visual unique identifier',
      'duplicate_merge' => 'disabled',
      'disable_num_format' => true,
      'studio' => 
      array (
        'quickcreate' => false,
      ),
      'inline_edit' => false,
    ),
    'type' => 
    array (
      'name' => 'type',
      'vname' => 'LBL_TYPE',
      'type' => 'enum',
      'options' => 'case_type_dom',
      'len' => 100,
      'comment' => 'The type of issue (ex: issue, feature)',
      'merge_filter' => 'disabled',
      'default' => 'Minor_Defect',
      'inline_edit' => true,
      'massupdate' => 0,
      'comments' => 'The type of issue (ex: issue, feature)',
    ),
    'status' => 
    array (
      'name' => 'status',
      'vname' => 'LBL_STATUS',
      'type' => 'dynamicenum',
      'options' => 'case_status_dom',
      'len' => 100,
      'audited' => true,
      'comment' => 'The status of the case',
      'dbtype' => 'enum',
      'parentenum' => 'state',
      'inline_edit' => true,
      'massupdate' => '1',
      'comments' => 'The status of the case',
      'merge_filter' => 'disabled',
    ),
    'priority' => 
    array (
      'name' => 'priority',
      'vname' => 'LBL_PRIORITY',
      'type' => 'enum',
      'options' => 'case_priority_dom',
      'len' => 100,
      'audited' => true,
      'comment' => 'The priority of the case',
    ),
    'resolution' => 
    array (
      'name' => 'resolution',
      'vname' => 'LBL_RESOLUTION',
      'type' => 'text',
      'comment' => 'The resolution of the case',
      'rows' => 6,
      'cols' => 80,
    ),
    'work_log' => 
    array (
      'name' => 'work_log',
      'vname' => 'LBL_WORK_LOG',
      'type' => 'text',
      'comment' => 'Free-form text used to denote activities of interest',
    ),
    'suggestion_box' => 
    array (
      'name' => 'suggestion_box',
      'vname' => 'LBL_SUGGESTION_BOX',
      'type' => 'readonly',
      'source' => 'non-db',
    ),
    'account_name' => 
    array (
      'name' => 'account_name',
      'rname' => 'name',
      'id_name' => 'account_id',
      'vname' => 'LBL_ACCOUNT_NAME',
      'type' => 'relate',
      'link' => 'accounts',
      'table' => 'accounts',
      'join_name' => 'accounts',
      'isnull' => 'true',
      'module' => 'Accounts',
      'dbType' => 'varchar',
      'len' => 100,
      'source' => 'non-db',
      'unified_search' => true,
      'comment' => 'The name of the account represented by the account_id field',
      'required' => true,
      'importable' => 'required',
    ),
    'account_name1' => 
    array (
      'name' => 'account_name1',
      'source' => 'non-db',
      'type' => 'text',
      'len' => 100,
      'importable' => 'false',
      'studio' => 
      array (
        'formula' => false,
      ),
    ),
    'account_id' => 
    array (
      'name' => 'account_id',
      'type' => 'relate',
      'dbType' => 'id',
      'rname' => 'id',
      'module' => 'Accounts',
      'id_name' => 'account_id',
      'reportable' => false,
      'vname' => 'LBL_ACCOUNT_ID',
      'audited' => true,
      'massupdate' => false,
      'comment' => 'The account to which the case is associated',
    ),
    'state' => 
    array (
      'name' => 'state',
      'vname' => 'LBL_STATE',
      'type' => 'enum',
      'options' => 'case_state_dom',
      'len' => 100,
      'audited' => true,
      'comment' => 'The state of the case (i.e. open/closed)',
      'default' => 'Open',
      'parentenum' => 'status',
      'merge_filter' => 'disabled',
      'inline_edit' => true,
      'massupdate' => '1',
      'comments' => 'The state of the case (i.e. open/closed)',
    ),
    'case_attachments_display' => 
    array (
      'required' => false,
      'name' => 'case_attachments_display',
      'vname' => 'LBL_CASE_ATTACHMENTS_DISPLAY',
      'type' => 'function',
      'source' => 'non-db',
      'massupdate' => 0,
      'studio' => 'visible',
      'importable' => 'false',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => 0,
      'audited' => false,
      'reportable' => false,
      'function' => 
      array (
        'name' => 'display_case_attachments',
        'returns' => 'html',
        'include' => 'modules/AOP_Case_Updates/Case_Updates.php',
      ),
    ),
    'case_update_form' => 
    array (
      'required' => false,
      'name' => 'case_update_form',
      'vname' => 'LBL_CASE_UPDATE_FORM',
      'type' => 'function',
      'source' => 'non-db',
      'massupdate' => 0,
      'studio' => 'visible',
      'importable' => 'false',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => 0,
      'audited' => false,
      'reportable' => false,
      'function' => 
      array (
        'name' => 'display_update_form',
        'returns' => 'html',
        'include' => 'modules/AOP_Case_Updates/Case_Updates.php',
      ),
    ),
    'contact_created_by' => 
    array (
      'name' => 'contact_created_by',
      'type' => 'link',
      'relationship' => 'cases_created_contact',
      'module' => 'Contacts',
      'bean_name' => 'Contact',
      'link_type' => 'one',
      'source' => 'non-db',
      'vname' => 'LBL_CONTACT_CREATED_BY',
      'side' => 'left',
      'id_name' => 'contact_created_by_id',
    ),
    'contact_created_by_name' => 
    array (
      'name' => 'contact_created_by_name',
      'type' => 'relate',
      'source' => 'non-db',
      'vname' => 'LBL_CONTACT_CREATED_BY_NAME',
      'save' => true,
      'id_name' => 'contact_created_by_id',
      'link' => 'cases_created_contact',
      'table' => 'Contacts',
      'module' => 'Contacts',
      'rname' => 'name',
    ),
    'contact_created_by_id' => 
    array (
      'name' => 'contact_created_by_id',
      'type' => 'id',
      'reportable' => false,
      'vname' => 'LBL_CONTACT_CREATED_BY_ID',
    ),
    'tasks' => 
    array (
      'name' => 'tasks',
      'type' => 'link',
      'relationship' => 'case_tasks',
      'source' => 'non-db',
      'vname' => 'LBL_TASKS',
    ),
    'notes' => 
    array (
      'name' => 'notes',
      'type' => 'link',
      'relationship' => 'case_notes',
      'source' => 'non-db',
      'vname' => 'LBL_NOTES',
    ),
    'meetings' => 
    array (
      'name' => 'meetings',
      'type' => 'link',
      'relationship' => 'case_meetings',
      'bean_name' => 'Meeting',
      'source' => 'non-db',
      'vname' => 'LBL_MEETINGS',
    ),
    'emails' => 
    array (
      'name' => 'emails',
      'type' => 'link',
      'relationship' => 'emails_cases_rel',
      'source' => 'non-db',
      'vname' => 'LBL_EMAILS',
    ),
    'documents' => 
    array (
      'name' => 'documents',
      'type' => 'link',
      'relationship' => 'documents_cases',
      'source' => 'non-db',
      'vname' => 'LBL_DOCUMENTS_SUBPANEL_TITLE',
    ),
    'calls' => 
    array (
      'name' => 'calls',
      'type' => 'link',
      'relationship' => 'case_calls',
      'source' => 'non-db',
      'vname' => 'LBL_CALLS',
    ),
    'bugs' => 
    array (
      'name' => 'bugs',
      'type' => 'link',
      'relationship' => 'cases_bugs',
      'source' => 'non-db',
      'vname' => 'LBL_BUGS',
    ),
    'contacts' => 
    array (
      'name' => 'contacts',
      'type' => 'link',
      'relationship' => 'contacts_cases',
      'source' => 'non-db',
      'vname' => 'LBL_CONTACTS',
    ),
    'accounts' => 
    array (
      'name' => 'accounts',
      'type' => 'link',
      'relationship' => 'account_cases',
      'link_type' => 'one',
      'side' => 'right',
      'source' => 'non-db',
      'vname' => 'LBL_ACCOUNT',
    ),
    'project' => 
    array (
      'name' => 'project',
      'type' => 'link',
      'relationship' => 'projects_cases',
      'source' => 'non-db',
      'vname' => 'LBL_PROJECTS',
    ),
    'update_text' => 
    array (
      'required' => false,
      'name' => 'update_text',
      'vname' => 'LBL_UPDATE_TEXT',
      'source' => 'non-db',
      'type' => 'text',
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
      'size' => '20',
      'studio' => 'visible',
      'rows' => 6,
      'cols' => 80,
      'id' => 'Casesupdate_text',
    ),
    'internal' => 
    array (
      'name' => 'internal',
      'source' => 'non-db',
      'vname' => 'LBL_INTERNAL',
      'type' => 'bool',
      'studio' => 'visible',
    ),
    'aop_case_updates_threaded' => 
    array (
      'required' => false,
      'name' => 'aop_case_updates_threaded',
      'vname' => 'LBL_AOP_CASE_UPDATES_THREADED',
      'type' => 'function',
      'source' => 'non-db',
      'massupdate' => 0,
      'studio' => 'visible',
      'importable' => 'false',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => 0,
      'audited' => false,
      'reportable' => false,
      'inline_edit' => 0,
      'function' => 
      array (
        'name' => 'display_updates',
        'returns' => 'html',
        'include' => 'modules/AOP_Case_Updates/Case_Updates.php',
      ),
    ),
    'aop_case_updates' => 
    array (
      'name' => 'aop_case_updates',
      'type' => 'link',
      'relationship' => 'cases_aop_case_updates',
      'source' => 'non-db',
      'id_name' => 'case_id',
      'vname' => 'LBL_AOP_CASE_UPDATES',
    ),
    'aop_case_events' => 
    array (
      'name' => 'aop_case_events',
      'type' => 'link',
      'relationship' => 'cases_aop_case_events',
      'source' => 'non-db',
      'id_name' => 'case_id',
      'vname' => 'LBL_AOP_CASE_EVENTS',
    ),
    'feedback_explaination_time_c' => 
    array (
      'inline_edit' => '',
      'labelValue' => 'Was the engineer able to clearly articulate the troubleshooting steps on the call?',
    ),
    'twitter_handle_c' => 
    array (
      'inline_edit' => '',
      'labelValue' => 'twitter handle',
    ),
    'feeback_case_id_c' => 
    array (
      'inline_edit' => '',
      'labelValue' => 'feeback case id',
    ),
    'post_from_id_c' => 
    array (
      'inline_edit' => '',
      'labelValue' => 'post from id',
    ),
    'post_from_first_name_c' => 
    array (
      'inline_edit' => '',
      'labelValue' => 'post from first name',
    ),
    'jjwg_maps_geocode_status_c' => 
    array (
      'inline_edit' => 1,
    ),
    'feedback_on_website_c' => 
    array (
      'inline_edit' => '',
      'labelValue' => 'Will you allow us to use these remarks as testimonial on our website and in print?',
    ),
    'feeback_service_rating_c' => 
    array (
      'inline_edit' => '',
      'labelValue' => 'How would you rate your overall satisfaction with SimpleCRM Support?',
    ),
    'escalation_level_2_checkbox_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'escalation level 2 checkbox',
    ),
    'escalation_level_1_checkbox_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'escalation level 1 checkbox',
    ),
    'feedback_recommend_friend_c' => 
    array (
      'inline_edit' => '',
      'labelValue' => 'How likely is it that you would recommend our company to friends or colleagues?',
    ),
    'source_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'Source',
    ),
    'jjwg_maps_address_c' => 
    array (
      'inline_edit' => 1,
    ),
    'contacts_cases_1' => 
    array (
      'name' => 'contacts_cases_1',
      'type' => 'link',
      'relationship' => 'contacts_cases_1',
      'source' => 'non-db',
      'module' => 'Contacts',
      'bean_name' => 'Contact',
      'vname' => 'LBL_CONTACTS_CASES_1_FROM_CONTACTS_TITLE',
      'id_name' => 'contacts_cases_1contacts_ida',
    ),
    'contacts_cases_1_name' => 
    array (
      'name' => 'contacts_cases_1_name',
      'type' => 'relate',
      'source' => 'non-db',
      'vname' => 'LBL_CONTACTS_CASES_1_FROM_CONTACTS_TITLE',
      'save' => true,
      'id_name' => 'contacts_cases_1contacts_ida',
      'link' => 'contacts_cases_1',
      'table' => 'contacts',
      'module' => 'Contacts',
      'rname' => 'name',
      'db_concat_fields' => 
      array (
        0 => 'first_name',
        1 => 'last_name',
      ),
    ),
    'contacts_cases_1contacts_ida' => 
    array (
      'name' => 'contacts_cases_1contacts_ida',
      'type' => 'link',
      'relationship' => 'contacts_cases_1',
      'source' => 'non-db',
      'reportable' => false,
      'side' => 'right',
      'vname' => 'LBL_CONTACTS_CASES_1_FROM_CASES_TITLE',
    ),
    'feedback_description_c' => 
    array (
      'inline_edit' => '',
      'labelValue' => 'Remarks/Comments',
    ),
    'feedback_submitted_c' => 
    array (
      'inline_edit' => '',
      'labelValue' => 'feedback submitted',
    ),
    'feedback_resolution_time_c' => 
    array (
      'inline_edit' => '',
      'labelValue' => 'Was your issue resolved the first time you reported it?',
    ),
    'posted_message_id_c' => 
    array (
      'inline_edit' => '',
      'labelValue' => 'posted message id',
    ),
    'feedback_resolution_result_c' => 
    array (
      'inline_edit' => '',
      'labelValue' => 'Were you able to understand the tech support engineer clearly?',
    ),
    'feeback_email_sent_c' => 
    array (
      'inline_edit' => '',
      'labelValue' => 'feeback email sent',
    ),
    'facebook_comment_id_c' => 
    array (
      'inline_edit' => '',
      'labelValue' => 'facebook comment id',
    ),
    'country_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'Country',
    ),
    'jjwg_maps_lng_c' => 
    array (
      'inline_edit' => 1,
    ),
    'escalation_level_3_checkbox_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'escalation level 3 checkbox',
    ),
    'region_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'Region',
    ),
    'feedback_recommendation_time_c' => 
    array (
      'inline_edit' => '',
      'labelValue' => 'Will you recommend our service to your contacts?',
    ),
    'tweet_id_c' => 
    array (
      'inline_edit' => '',
      'labelValue' => 'tweet id',
    ),
    'jjwg_maps_lat_c' => 
    array (
      'inline_edit' => 1,
    ),
    'closed_status_reply_c' => 
    array (
      'inline_edit' => '',
      'labelValue' => 'closed status reply',
    ),
    'add_comment_ids_c' => 
    array (
      'inline_edit' => '',
      'labelValue' => 'add comment ids',
    ),
    'feedback_date_entered_c' => 
    array (
      'inline_edit' => '',
      'labelValue' => 'feedback date entered',
    ),
    'post_from_last_name_c' => 
    array (
      'inline_edit' => '',
      'labelValue' => 'post from last name',
    ),
    'case_ageing_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'Aging',
    ),
    'assigned_time_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'Assigned Time',
    ),
    'customer_sms_open_case_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'Customer sms open Case',
    ),
    'customer_sms_sent_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'customer sms sent',
    ),
    'departments_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'Departments',
    ),
    'manufacturer_name_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'Manufacturer Name',
    ),
    'mobile_number_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'Mobile Number',
    ),
    'module_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'Module',
    ),
    'query_type_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'Query Type',
    ),
    'registrar_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'Registrar',
    ),
    'resolution_date_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'Resolution Date',
    ),
    'sub_module_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'Sub Module',
    ),
    'user_name_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'User Name',
    ),
    'internal_notes_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'Internal Notes',
    ),
    'internal_notes_log_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'Internal Notes Log',
    ),
    'email1' => 
    array (
      'name' => 'email1',
      'vname' => 'LBL_EMAIL',
      'group' => 'email1',
      'type' => 'varchar',
      'function' => 
      array (
        'name' => 'getEmailAddressWidget',
        'returns' => 'html',
      ),
      'source' => 'non-db',
      'studio' => 
      array (
        'editField' => true,
      ),
      'required' => true,
      'inline_edit' => true,
      'merge_filter' => 'disabled',
    ),
    'email_addresses_primary' => 
    array (
      'name' => 'email_addresses_primary',
      'type' => 'link',
      'relationship' => 'case_email_addresses_primary',
      'source' => 'non-db',
      'vname' => 'LBL_EMAIL_ADDRESS_PRIMARY',
      'duplicate_merge' => 'disabled',
    ),
    'email_addresses' => 
    array (
      'name' => 'email_addresses',
      'type' => 'link',
      'relationship' => 'case_email_addresses',
      'source' => 'non-db',
      'vname' => 'LBL_EMAIL_ADDRESSES',
      'reportable' => false,
      'unified_search' => true,
      'rel_fields' => 
      array (
        'primary_address' => 
        array (
          'type' => 'bool',
        ),
      ),
    ),
    'cases_scrm_sms_1' => 
    array (
      'name' => 'cases_scrm_sms_1',
      'type' => 'link',
      'relationship' => 'cases_scrm_sms_1',
      'source' => 'non-db',
      'module' => 'scrm_SMS',
      'bean_name' => 'scrm_SMS',
      'side' => 'right',
      'vname' => 'LBL_CASES_SCRM_SMS_1_FROM_SCRM_SMS_TITLE',
    ),
    'cases_scrm_escalation_audit_1' => 
    array (
      'name' => 'cases_scrm_escalation_audit_1',
      'type' => 'link',
      'relationship' => 'cases_scrm_escalation_audit_1',
      'source' => 'non-db',
      'module' => 'scrm_Escalation_Audit',
      'bean_name' => 'scrm_Escalation_Audit',
      'side' => 'right',
      'vname' => 'LBL_CASES_SCRM_ESCALATION_AUDIT_1_FROM_SCRM_ESCALATION_AUDIT_TITLE',
    ),
    'pending_counter_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'pending counter',
    ),
    'ticket_counter_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'Ticket Counter',
    ),
    'escalation_level_4_checkbox_c' => 
    array (
      'inline_edit' => '1',
      'labelValue' => 'escalation level 4 checkbox',
    ),
  ),
  'indices' => 
  array (
    'id' => 
    array (
      'name' => 'casespk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    'number' => 
    array (
      'name' => 'casesnumk',
      'type' => 'unique',
      'fields' => 
      array (
        0 => 'case_number',
      ),
    ),
    0 => 
    array (
      'name' => 'case_number',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'case_number',
      ),
    ),
    1 => 
    array (
      'name' => 'idx_case_name',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'name',
      ),
    ),
    2 => 
    array (
      'name' => 'idx_account_id',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'account_id',
      ),
    ),
    3 => 
    array (
      'name' => 'idx_cases_stat_del',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'assigned_user_id',
        1 => 'status',
        2 => 'deleted',
      ),
    ),
  ),
  'relationships' => 
  array (
    'cases_modified_user' => 
    array (
      'lhs_module' => 'Users',
      'lhs_table' => 'users',
      'lhs_key' => 'id',
      'rhs_module' => 'Cases',
      'rhs_table' => 'cases',
      'rhs_key' => 'modified_user_id',
      'relationship_type' => 'one-to-many',
    ),
    'cases_created_by' => 
    array (
      'lhs_module' => 'Users',
      'lhs_table' => 'users',
      'lhs_key' => 'id',
      'rhs_module' => 'Cases',
      'rhs_table' => 'cases',
      'rhs_key' => 'created_by',
      'relationship_type' => 'one-to-many',
    ),
    'cases_assigned_user' => 
    array (
      'lhs_module' => 'Users',
      'lhs_table' => 'users',
      'lhs_key' => 'id',
      'rhs_module' => 'Cases',
      'rhs_table' => 'cases',
      'rhs_key' => 'assigned_user_id',
      'relationship_type' => 'one-to-many',
    ),
    'securitygroups_cases' => 
    array (
      'lhs_module' => 'SecurityGroups',
      'lhs_table' => 'securitygroups',
      'lhs_key' => 'id',
      'rhs_module' => 'Cases',
      'rhs_table' => 'cases',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'securitygroups_records',
      'join_key_lhs' => 'securitygroup_id',
      'join_key_rhs' => 'record_id',
      'relationship_role_column' => 'module',
      'relationship_role_column_value' => 'Cases',
    ),
    'case_calls' => 
    array (
      'lhs_module' => 'Cases',
      'lhs_table' => 'cases',
      'lhs_key' => 'id',
      'rhs_module' => 'Calls',
      'rhs_table' => 'calls',
      'rhs_key' => 'parent_id',
      'relationship_type' => 'one-to-many',
      'relationship_role_column' => 'parent_type',
      'relationship_role_column_value' => 'Cases',
    ),
    'case_tasks' => 
    array (
      'lhs_module' => 'Cases',
      'lhs_table' => 'cases',
      'lhs_key' => 'id',
      'rhs_module' => 'Tasks',
      'rhs_table' => 'tasks',
      'rhs_key' => 'parent_id',
      'relationship_type' => 'one-to-many',
      'relationship_role_column' => 'parent_type',
      'relationship_role_column_value' => 'Cases',
    ),
    'case_notes' => 
    array (
      'lhs_module' => 'Cases',
      'lhs_table' => 'cases',
      'lhs_key' => 'id',
      'rhs_module' => 'Notes',
      'rhs_table' => 'notes',
      'rhs_key' => 'parent_id',
      'relationship_type' => 'one-to-many',
      'relationship_role_column' => 'parent_type',
      'relationship_role_column_value' => 'Cases',
    ),
    'case_meetings' => 
    array (
      'lhs_module' => 'Cases',
      'lhs_table' => 'cases',
      'lhs_key' => 'id',
      'rhs_module' => 'Meetings',
      'rhs_table' => 'meetings',
      'rhs_key' => 'parent_id',
      'relationship_type' => 'one-to-many',
      'relationship_role_column' => 'parent_type',
      'relationship_role_column_value' => 'Cases',
    ),
    'case_emails' => 
    array (
      'lhs_module' => 'Cases',
      'lhs_table' => 'cases',
      'lhs_key' => 'id',
      'rhs_module' => 'Emails',
      'rhs_table' => 'emails',
      'rhs_key' => 'parent_id',
      'relationship_type' => 'one-to-many',
      'relationship_role_column' => 'parent_type',
      'relationship_role_column_value' => 'Cases',
    ),
    'cases_created_contact' => 
    array (
      'lhs_module' => 'Contacts',
      'lhs_table' => 'contacts',
      'lhs_key' => 'id',
      'rhs_module' => 'Cases',
      'rhs_table' => 'cases',
      'rhs_key' => 'contact_created_by_id',
      'relationship_type' => 'one-to-many',
    ),
    'case_email_addresses' => 
    array (
      'lhs_module' => 'Case',
      'lhs_table' => 'case',
      'lhs_key' => 'id',
      'rhs_module' => 'EmailAddresses',
      'rhs_table' => 'email_addresses',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'email_addr_bean_rel',
      'join_key_lhs' => 'bean_id',
      'join_key_rhs' => 'email_address_id',
      'relationship_role_column' => 'bean_module',
      'relationship_role_column_value' => 'Case',
    ),
    'case_email_addresses_primary' => 
    array (
      'lhs_module' => 'Case',
      'lhs_table' => 'case',
      'lhs_key' => 'id',
      'rhs_module' => 'EmailAddresses',
      'rhs_table' => 'email_addresses',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'email_addr_bean_rel',
      'join_key_lhs' => 'bean_id',
      'join_key_rhs' => 'email_address_id',
      'relationship_role_column' => 'primary_address',
      'relationship_role_column_value' => '1',
    ),
  ),
  'optimistic_locking' => true,
  'templates' => 
  array (
    'issue' => 'issue',
    'security_groups' => 'security_groups',
    'assignable' => 'assignable',
    'basic' => 'basic',
  ),
);