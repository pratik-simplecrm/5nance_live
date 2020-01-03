<?php
$viewdefs ['Contacts'] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'hidden' => 
        array (
          0 => '<input type="hidden" name="opportunity_id" value="{$smarty.request.opportunity_id}">',
          1 => '<input type="hidden" name="case_id" value="{$smarty.request.case_id}">',
          2 => '<input type="hidden" name="bug_id" value="{$smarty.request.bug_id}">',
          3 => '<input type="hidden" name="email_id" value="{$smarty.request.email_id}">',
          4 => '<input type="hidden" name="inbound_email_id" value="{$smarty.request.inbound_email_id}">',
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
      'useTabs' => true,
      'tabDefs' => 
      array (
        'LBL_CONTACT_INFORMATION' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_PANEL_ASSIGNMENT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL1' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL2' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_PANEL_ADVANCED' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL3' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL4' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL5' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL6' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL7' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL8' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL9' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL10' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL11' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'LBL_CONTACT_INFORMATION' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'first_name',
            'customCode' => '{html_options name="salutation" id="salutation" options=$fields.salutation.options selected=$fields.salutation.value}&nbsp;<input name="first_name"  id="first_name" size="25" maxlength="25" type="text" value="{$fields.first_name.value}">',
          ),
          1 => 
          array (
            'name' => 'middle_name_c',
            'label' => 'LBL_MIDDLE_NAME',
          ),
        ),
        1 => 
        array (
          0 => 'last_name',
          1 => 
          array (
            'name' => 'unique_customer_code_c',
            'label' => 'LBL_UNIQUE_CUSTOMER_CODE',
          ),
        ),
        2 => 
        array (
          0 => 'email1',
          1 => 
          array (
            'name' => 'is_email_verified_c',
            'label' => 'LBL_IS_EMAIL_VERIFIED',
          ),
        ),
        3 => 
        array (
          0 => 'phone_mobile',
          1 => 
          array (
            'name' => 'is_mobile_number_verified_c',
            'label' => 'LBL_IS_MOBILE_NUMBER_VERIFIED',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'gender_c',
            'studio' => 'visible',
            'label' => 'LBL_GENDER',
          ),
          1 => 
          array (
            'name' => 'age_of_the_user_c',
            'label' => 'LBL_AGE_OF_THE_USER',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'application_no_c',
            'label' => 'LBL_APPLICATION_NO',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'aadharcard_no_c',
            'label' => 'LBL_AADHARCARD_NO',
          ),
          1 => 
          array (
            'name' => 'isminor_c',
            'studio' => 'visible',
            'label' => 'LBL_ISMINOR',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'kyc_status_c',
            'studio' => 'visible',
            'label' => 'LBL_KYC_STATUS',
          ),
          1 => 
          array (
            'name' => 'language_c',
            'studio' => 'visible',
            'label' => 'LBL_LANGUAGE',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'classification_accoun_c',
            'studio' => 'visible',
            'label' => 'LBL_CLASSIFICATION_ACCOUN',
          ),
          1 => 
          array (
            'name' => 'dnc_status_c',
            'label' => 'LBL_DNC_STATUS',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'facebook_id_c',
            'label' => 'LBL_FACEBOOK_ID',
          ),
          1 => 
          array (
            'name' => 'twitter_c',
            'label' => 'LBL_TWITTER',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'educational_details_c',
            'studio' => 'visible',
            'label' => 'LBL_EDUCATIONAL_DETAILS',
          ),
          1 => 
          array (
            'name' => 'occupational_details_c',
            'studio' => 'visible',
            'label' => 'LBL_OCCUPATIONAL_DETAILS',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'total_employment_years_c',
            'studio' => 'visible',
            'label' => 'LBL_TOTAL_EMPLOYMENT_YEARS',
          ),
          1 => 
          array (
            'name' => 'current_company_details_c',
            'studio' => 'visible',
            'label' => 'LBL_CURRENT_COMPANY_DETAILS',
          ),
        ),
        12 => 
        array (
          0 => 
          array (
            'name' => 'date_entered',
            'comment' => 'Date record created',
            'label' => 'LBL_DATE_ENTERED',
          ),
          1 => 
          array (
            'name' => 'investor_acct_creation_month_c',
            'studio' => 'visible',
            'label' => 'LBL_INVESTOR_ACCT_CREATION_MONTH',
          ),
        ),
      ),
      'LBL_PANEL_ASSIGNMENT' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO',
          ),
          1 => 'lead_source',
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'address_c',
            'studio' => 'visible',
            'label' => 'LBL_ADDRESS',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'country_c',
            'studio' => 'visible',
            'label' => 'LBL_COUNTRY',
          ),
          1 => 
          array (
            'name' => 'state_c',
            'studio' => 'visible',
            'label' => 'LBL_STATE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'city_c',
            'studio' => 'visible',
            'label' => 'LBL_CITY',
          ),
          1 => 
          array (
            'name' => 'postalcode_c',
            'studio' => 'visible',
            'label' => 'LBL_POSTALCODE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'campaign_type_c',
            'label' => 'LBL_CAMPAIGN_TYPE',
          ),
          1 => 
          array (
            'name' => 'campaign_sub_type_c',
            'label' => 'LBL_CAMPAIGN_SUB_TYPE',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'gateway_c',
            'studio' => 'visible',
            'label' => 'LBL_GATEWAY',
          ),
          1 => 
          array (
            'name' => 'user_type_c',
            'studio' => 'visible',
            'label' => 'LBL_USER_TYPE',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'publisher_id_c',
            'label' => 'LBL_PUBLISHER_ID',
          ),
          1 => 
          array (
            'name' => 'publisher_name_c',
            'label' => 'LBL_PUBLISHER_NAME',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'related_corporate_account_c',
            'label' => 'LBL_RELATED_CORPORATE_ACCOUNT',
          ),
          1 => 
          array (
            'name' => 'related_kiosk_account_c',
            'label' => 'LBL_RELATED_KIOSK_ACCOUNT',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'birthdate',
            'comment' => 'The birthdate of the contact',
            'label' => 'LBL_BIRTHDATE',
          ),
          1 => 
          array (
            'name' => 'age_c',
            'label' => 'LBL_AGE',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'sales_person_tagging_c',
            'label' => 'LBL_SALES_PERSON_TAGGING',
          ),
          1 => 
          array (
            'name' => 'best_time_to_speak_to_c',
            'label' => 'LBL_BEST_TIME_TO_SPEAK_TO',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'location_through_ip_c',
            'label' => 'LBL_LOCATION_THROUGH_IP',
          ),
          1 => 
          array (
            'name' => 'qparam_c',
            'label' => 'LBL_QPARAM',
          ),
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'adoption_percentage_c',
            'label' => 'LBL_ADOPTION_PERCENTAGE',
          ),
          1 => 
          array (
            'name' => 'historical_session_data_c',
            'label' => 'LBL_HISTORICAL_SESSION_DATA',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'online_activity_status_c',
            'studio' => 'visible',
            'label' => 'LBL_ONLINE_ACTIVITY_STATUS',
          ),
          1 => '',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'product_interest_c',
            'studio' => 'visible',
            'label' => 'LBL_PRODUCT_INTEREST',
          ),
          1 => 
          array (
            'name' => 'product_sub_type_interest_c',
            'studio' => 'visible',
            'label' => 'LBL_PRODUCT_SUB_TYPE_INTEREST',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'payment_type_c',
            'studio' => 'visible',
            'label' => 'LBL_PAYMENT_TYPE',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'opportunity_value_c',
            'label' => 'LBL_OPPORTUNITY_VALUE',
          ),
          1 => 
          array (
            'name' => 'opportunity_horizon_c',
            'label' => 'LBL_OPPORTUNITY_HORIZON',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'investment_behaviour_segment_c',
            'studio' => 'visible',
            'label' => 'LBL_INVESTMENT_BEHAVIOUR_SEGMENT',
          ),
          1 => 
          array (
            'name' => 'no_of_attempts_c',
            'label' => 'LBL_NO_OF_ATTEMPTS',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'bank_account_c',
            'studio' => 'visible',
            'label' => 'LBL_BANK_ACCOUNT',
          ),
          1 => '',
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'pan_card_c',
            'studio' => 'visible',
            'label' => 'LBL_PAN_CARD',
          ),
          1 => 
          array (
            'name' => 'interactions_age_c',
            'label' => 'LBL_INTERACTIONS_AGE',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'first_time_investor_c',
            'studio' => 'visible',
            'label' => 'LBL_FIRST_TIME_INVESTOR',
          ),
          1 => 
          array (
            'name' => 'internet_banking_c',
            'studio' => 'visible',
            'label' => 'LBL_INTERNET_BANKING',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'investor_occupation_c',
            'studio' => 'visible',
            'label' => 'LBL_INVESTOR_OCCUPATION',
          ),
          1 => 
          array (
            'name' => 'interactions_income_c',
            'label' => 'LBL_INTERACTIONS_INCOME',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'sales_stage_c',
            'studio' => 'visible',
            'label' => 'LBL_SALES_STAGE',
          ),
          1 => 
          array (
            'name' => 'disposition_c',
            'studio' => 'visible',
            'label' => 'LBL_DISPOSITION',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'next_call_planning_date_c',
            'comment' => 'next call date time field',
            'studio' => 
            array (
              'visible' => true,
              'searchview' => true,
            ),
            'label' => 'LBL_NEXT_CALL_PLANNING_DATE',
          ),
          1 => 
          array (
            'name' => 'next_call_planning_comments_c',
            'comment' => 'next call date time field',
            'studio' => 
            array (
              'visible' => true,
              'searchview' => true,
            ),
            'label' => 'LBL_NEXT_CALL_PLANNING_COMMENTS',
          ),
        ),
        12 => 
        array (
          0 => 
          array (
            'name' => 'referral_type_c',
            'studio' => 'visible',
            'label' => 'LBL_REFERRAL_TYPE',
          ),
          1 => '',
        ),
        13 => 
        array (
          0 => 
          array (
            'name' => 'name_of_existing_customer_c',
            'label' => 'LBL_NAME_OF_EXISTING_CUSTOMER',
          ),
          1 => 
          array (
            'name' => 'existing_mobile_number_c',
            'label' => 'LBL_EXISTING_MOBILE_NUMBER',
          ),
        ),
        14 => 
        array (
          0 => 
          array (
            'name' => 'partner_comments_c',
            'studio' => 'visible',
            'label' => 'LBL_PARTNER_COMMENTS',
          ),
          1 => 
          array (
            'name' => 'status_c',
            'studio' => 'visible',
            'label' => 'LBL_STATUS_C ',
          ),
        ),
        15 => 
        array (
          0 => 
          array (
            'name' => 'rejection_reason_c',
            'studio' => 'visible',
            'label' => 'LBL_ REJECTION_REASON_C ',
          ),
          1 => 
          array (
            'name' => 'drop_stage1_c',
            'label' => 'LBL_DROP_STAGE1_C',
          ),
        ),
      ),
      'LBL_PANEL_ADVANCED' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'annual_income_c',
            'label' => 'LBL_ANNUAL_INCOME',
          ),
          1 => 
          array (
            'name' => 'annual_expenses_c',
            'label' => 'LBL_ANNUAL_EXPENSES',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'saving_potential_c',
            'label' => 'LBL_SAVING_POTENTIAL',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'financial_goals_c',
            'studio' => 'visible',
            'label' => 'LBL_FINANCIAL_GOALS',
          ),
          1 => 
          array (
            'name' => 'exisiting_investments_c',
            'studio' => 'visible',
            'label' => 'LBL_EXISITING_INVESTMENTS',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'existing_investment_mf_c',
            'label' => 'LBL_EXISTING_INVESTMENT_MF',
          ),
          1 => 
          array (
            'name' => 'existing_investment_equity_c',
            'label' => 'LBL_EXISTING_INVESTMENT_EQUITY',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'existing_investment_gold_c',
            'label' => 'LBL_EXISTING_INVESTMENT_GOLD',
          ),
          1 => 
          array (
            'name' => 'existing_investment_re_c',
            'label' => 'LBL_EXISTING_INVESTMENT_RE',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'existing_investment_silver_c',
            'label' => 'LBL_EXISTING_INVESTMENT_SILVER',
          ),
          1 => 
          array (
            'name' => 'existing_investments_bonds_c',
            'label' => 'LBL_EXISTING_INVESTMENTS_BONDS',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'existing_investments_deposit_c',
            'label' => 'LBL_EXISTING_INVESTMENTS_DEPOSIT',
          ),
          1 => 
          array (
            'name' => 'prior_invesment_value_c',
            'label' => 'LBL_PRIOR_INVESMENT_VALUE',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'tax_planning_c',
            'studio' => 'visible',
            'label' => 'LBL_TAX_PLANNING',
          ),
          1 => 
          array (
            'name' => 'investment_in_80c_c',
            'label' => 'LBL_INVESTMENT_IN_80C',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'investment_in_80d_c',
            'label' => 'LBL_INVESTMENT_IN_80D',
          ),
          1 => 
          array (
            'name' => 'life_stage_profiling_c',
            'studio' => 'visible',
            'label' => 'LBL_LIFE_STAGE_PROFILING',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'existing_insurance_c',
            'label' => 'LBL_EXISTING_INSURANCE',
          ),
          1 => 
          array (
            'name' => 'first_transaction_date_c',
            'label' => 'LBL_FIRST_TRANSACTION_DATE',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'family_members_number_c',
            'studio' => 'visible',
            'label' => 'LBL_FAMILY_MEMBERS_NUMBER',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'no_of_adults_c',
            'studio' => 'visible',
            'label' => 'LBL_NO_OF_ADULTS',
          ),
          1 => 
          array (
            'name' => 'no_of_children_c',
            'studio' => 'visible',
            'label' => 'LBL_NO_OF_CHILDREN',
          ),
        ),
      ),
      'lbl_editview_panel3' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'risk_profiling_questions_c',
            'studio' => 'visible',
            'label' => 'LBL_RISK_PROFILING_QUESTIONS',
          ),
          1 => 
          array (
            'name' => 'courier_request_c',
            'label' => 'LBL_COURIER_REQUEST',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'risk_profile_id_c',
            'label' => 'LBL_RISK_PROFILE_ID',
          ),
          1 => '',
        ),
      ),
      'lbl_editview_panel4' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'lead_generation_date_c',
            'label' => 'LBL_LEAD_GENERATION_DATE',
          ),
          1 => 
          array (
            'name' => 'validation_exe_assigned_c',
            'label' => 'LBL_VALIDATION_EXE_ASSIGNED',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'date_of_first_call_c',
            'label' => 'LBL_DATE_OF_FIRST_CALL',
          ),
          1 => 
          array (
            'name' => 'status_of_first_call_c',
            'label' => 'LBL_STATUS_OF_FIRST_CALL',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'date_of_second_call_c',
            'label' => 'LBL_DATE_OF_SECOND_CALL',
          ),
          1 => 
          array (
            'name' => 'status_of_second_call_c',
            'label' => 'LBL_STATUS_OF_SECOND_CALL',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'date_of_third_call_c',
            'label' => 'LBL_DATE_OF_THIRD_CALL',
          ),
          1 => 
          array (
            'name' => 'status_of_third_call_c',
            'label' => 'LBL_STATUS_OF_THIRD_CALL',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'date_of_validation_c',
            'label' => 'LBL_DATE_OF_VALIDATION',
          ),
          1 => 
          array (
            'name' => 'final_disposition_c',
            'label' => 'LBL_FINAL_DISPOSITION',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'preferred_date_of_call_c',
            'label' => 'LBL_PREFERRED_DATE_OF_CALL',
          ),
          1 => 
          array (
            'name' => 'preferred_time_of_call_c',
            'label' => 'LBL_PREFERRED_TIME_OF_CALL',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'leadid_c',
            'label' => 'LBL_LEADID',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'do_you_have_internet_banking_c',
            'studio' => 'visible',
            'label' => 'LBL_DO_YOU_HAVE_INTERNET_BANKING',
          ),
          1 => 
          array (
            'name' => 'pan_no_c',
            'label' => 'LBL_PAN_NO',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'campaign_c',
            'label' => 'LBL_CAMPAIGN',
          ),
          1 => 
          array (
            'name' => 'utm_content_c',
            'label' => 'LBL_UTM_CONTENT',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'agreed_to_assign_c',
            'label' => 'LBL_AGREED_TO_ASSIGN',
          ),
          1 => 
          array (
            'name' => 'comments_c',
            'studio' => 'visible',
            'label' => 'LBL_COMMENTS',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'is_1st_time_investor_c',
            'studio' => 'visible',
            'label' => 'LBL_IS_1ST_TIME_INVESTOR',
          ),
          1 => 
          array (
            'name' => 'monthly_income_details_c',
            'label' => 'LBL_MONTHLY_INCOME_DETAILS',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'source_of_income_c',
            'label' => 'LBL_SOURCE_OF_INCOME',
          ),
          1 => 
          array (
            'name' => 'campaign_city_c',
            'label' => 'LBL_CAMPAIGN_CITY',
          ),
        ),
        12 => 
        array (
          0 => 
          array (
            'name' => 'source_c',
            'label' => 'LBL_SOURCE',
          ),
          1 => 
          array (
            'name' => 'to_kown_about_5nance_c',
            'label' => 'LBL_TO_KOWN_ABOUT_5NANCE',
          ),
        ),
        13 => 
        array (
          0 => 
          array (
            'name' => 'justdial_category_c',
            'label' => 'LBL_JUSTDIAL_CATEGORY',
          ),
          1 => '',
        ),
      ),
      'lbl_editview_panel5' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'dateofactivation_c',
            'label' => 'LBL_DATEOFACTIVATION',
          ),
          1 => 
          array (
            'name' => 'account_activation_month_c',
            'studio' => 'visible',
            'label' => 'LBL_ACCOUNT_ACTIVATION_MONTH',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'date_of_registration_c',
            'label' => 'LBL_DATE_OF_REGISTRATION',
          ),
          1 => 
          array (
            'name' => 'document_submission_center_c',
            'label' => 'LBL_DOCUMENT_SUBMISSION_CENTER',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'auto_activation_c',
            'studio' => 'visible',
            'label' => 'LBL_AUTO_ACTIVATION',
          ),
          1 => 
          array (
            'name' => 'investorid_c',
            'label' => 'LBL_INVESTORID',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'total_sip_orders_c',
            'label' => 'LBL_TOTAL_SIP_ORDERS',
          ),
          1 => 
          array (
            'name' => 'summarizing_total_sip_amount_c',
            'label' => 'LBL_SUMMARIZING_TOTAL_SIP_AMOUNT',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'total_lumpsum_order_c',
            'label' => 'LBL_TOTAL_LUMPSUM_ORDER',
          ),
          1 => 
          array (
            'name' => 'summarizing_the_total_lumpsu_c',
            'label' => 'LBL_SUMMARIZING_THE_TOTAL_LUMPSU',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'summarizing_total_orders_c',
            'label' => 'LBL_SUMMARIZING_TOTAL_ORDERS',
          ),
          1 => 
          array (
            'name' => 'summarizing_total_amount_c',
            'label' => 'LBL_SUMMARIZING_TOTAL_AMOUNT',
          ),
        ),
      ),
      'lbl_editview_panel6' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'no_of_fd_investment_orders_c',
            'label' => 'LBL_NO_OF_FD_INVESTMENT_ORDERS',
          ),
          1 => 
          array (
            'name' => 'total_amount_fd_c',
            'label' => 'LBL_TOTAL_AMOUNT_FD',
          ),
        ),
      ),
      'lbl_editview_panel7' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'invoicedate_c',
            'label' => 'LBL_INVOICEDATE',
          ),
          1 => 
          array (
            'name' => 'transactionsubtype_c',
            'studio' => 'visible',
            'label' => 'LBL_TRANSACTIONSUBTYPE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'schemename_c',
            'label' => 'LBL_SCHEMENAME',
          ),
          1 => 
          array (
            'name' => 'amount_c',
            'label' => 'LBL_AMOUNT',
          ),
        ),
      ),
      'lbl_editview_panel8' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'cart_invoice_date_c',
            'label' => 'LBL_CART_INVOICE_DATE',
          ),
          1 => 
          array (
            'name' => 'cart_scheme_name_c',
            'label' => 'LBL_CART_SCHEME_NAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'cart_amount_c',
            'label' => 'LBL_CART_AMOUNT',
          ),
        ),
      ),
      'lbl_editview_panel9' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'investment_period_c',
            'studio' => 'visible',
            'label' => 'LBL_INVESTMENT_PERIOD',
          ),
          1 => 
          array (
            'name' => 'investment_type_c',
            'studio' => 'visible',
            'label' => 'LBL_INVESTMENT_TYPE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'investment_amount_c',
            'label' => 'LBL_INVESTMENT_AMOUNT',
          ),
          1 => '',
        ),
      ),
      'lbl_editview_panel10' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'taxyear_c',
            'label' => 'LBL_TAXYEAR',
          ),
          1 => 
          array (
            'name' => 'total_gross_salary_c',
            'label' => 'LBL_TOTAL_GROSS_SALARY',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'taxableincomeonhouserent_c',
            'label' => 'LBL_TAXABLEINCOMEONHOUSERENT',
          ),
          1 => 
          array (
            'name' => 'totaltaxtobepaid_c',
            'label' => 'LBL_TOTALTAXTOBEPAID',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'taxable_income_c',
            'label' => 'LBL_TAXABLE_INCOME',
          ),
          1 => 
          array (
            'name' => 'taxable_income_equity_c',
            'label' => 'LBL_TAXABLE_INCOME_EQUITY',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'taxable_income_sales_c',
            'label' => 'LBL_TAXABLE_INCOME_SALES',
          ),
          1 => 
          array (
            'name' => 'exemptions_from_80c_c',
            'label' => 'LBL_EXEMPTIONS_FROM_80C',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'exemptions_from_80d_c',
            'label' => 'LBL_EXEMPTIONS_FROM_80D',
          ),
          1 => 
          array (
            'name' => 'exemptions_80ccg_c',
            'label' => 'LBL_EXEMPTIONS_80CCG',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'exemptions_80ccd_c',
            'label' => 'LBL_EXEMPTIONS_80CCD',
          ),
          1 => 
          array (
            'name' => 'exemptions_80e_c',
            'label' => 'LBL_EXEMPTIONS_80E',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'exemptions_80g_c',
            'label' => 'LBL_EXEMPTIONS_80G',
          ),
          1 => 
          array (
            'name' => 'hra_c',
            'label' => 'LBL_HRA',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'interest_on_housing_loan_c',
            'label' => 'LBL_INTEREST_ON_HOUSING_LOAN',
          ),
          1 => 
          array (
            'name' => 'tax_deducted_at_source_c',
            'label' => 'LBL_TAX_DEDUCTED_AT_SOURCE',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'professional_tax_c',
            'label' => 'LBL_PROFESSIONAL_TAX',
          ),
          1 => 
          array (
            'name' => 'taxable_income_deduction_c',
            'label' => 'LBL_TAXABLE_INCOME_DEDUCTION',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'tax_liability_c',
            'label' => 'LBL_TAX_LIABILITY',
          ),
          1 => 
          array (
            'name' => 'tax_that_you_an_save_c',
            'label' => 'LBL_TAX_THAT_YOU_AN_SAVE',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'tax_to_be_paid_after_savin_c',
            'label' => 'LBL_TAX_TO_BE_PAID_AFTER_SAVIN',
          ),
          1 => '',
        ),
      ),
      'lbl_editview_panel11' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'intent_c',
            'label' => 'LBL_INTENT_C ',
          ),
          1 => 
          array (
            'name' => 'marital_status_c',
            'studio' => 'visible',
            'label' => 'LBL_MARITAL_STATUS_C ',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'loan_occupation_c',
            'label' => 'LBL_LOAN_OCCUPATION_C ',
          ),
          1 => 
          array (
            'name' => 'loan_income_c',
            'label' => 'LBL_LOAN_INCOME_C',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'loan_dob_c',
            'label' => 'LBL_LOAN_DOB_C ',
          ),
          1 => '',
        ),
      ),
    ),
  ),
);
?>
