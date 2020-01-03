<?php
$viewdefs ['Leads'] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'hidden' => 
        array (
          0 => '<input type="hidden" name="prospect_id" value="{if isset($smarty.request.prospect_id)}{$smarty.request.prospect_id}{else}{$bean->prospect_id}{/if}">',
          1 => '<input type="hidden" name="account_id" value="{if isset($smarty.request.account_id)}{$smarty.request.account_id}{else}{$bean->account_id}{/if}">',
          2 => '<input type="hidden" name="contact_id" value="{if isset($smarty.request.contact_id)}{$smarty.request.contact_id}{else}{$bean->contact_id}{/if}">',
          3 => '<input type="hidden" name="opportunity_id" value="{if isset($smarty.request.opportunity_id)}{$smarty.request.opportunity_id}{else}{$bean->opportunity_id}{/if}">',
        ),
        'buttons' => 
        array (
          0 => 'SAVE',
          1 => 'CANCEL',
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
      'javascript' => '<script type="text/javascript" language="Javascript">function copyAddressRight(form)  {ldelim} form.alt_address_street.value = form.primary_address_street.value;form.alt_address_city.value = form.primary_address_city.value;form.alt_address_state.value = form.primary_address_state.value;form.alt_address_postalcode.value = form.primary_address_postalcode.value;form.alt_address_country.value = form.primary_address_country.value;return true; {rdelim} function copyAddressLeft(form)  {ldelim} form.primary_address_street.value =form.alt_address_street.value;form.primary_address_city.value = form.alt_address_city.value;form.primary_address_state.value = form.alt_address_state.value;form.primary_address_postalcode.value =form.alt_address_postalcode.value;form.primary_address_country.value = form.alt_address_country.value;return true; {rdelim} </script>',
      'useTabs' => true,
      'tabDefs' => 
      array (
        'LBL_CONTACT_INFORMATION' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL3' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL4' => 
        array (
          'newTab' => false,
          'panelDefault' => 'collapsed',
        ),
        'LBL_EDITVIEW_PANEL5' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_PANEL_ASSIGNMENT' => 
        array (
          'newTab' => false,
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
          1 => 'phone_mobile',
        ),
        2 => 
        array (
          0 => 'email1',
          1 => 
          array (
            'name' => 'accept_status_name',
            'label' => 'LBL_LIST_ACCEPT_STATUS',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'source_of_income_c',
            'label' => 'LBL_ SOURCE_OF_INCOME',
          ),
          1 => 
          array (
            'name' => 'authorize_to_call_c',
            'studio' => 'visible',
            'label' => 'LBL_AUTHORIZE_TO_CALL ',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'source_c',
            'label' => 'LBL_SOURCE',
          ),
          1 => 
          array (
            'name' => 'q_c',
            'label' => 'LBL_Q',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'is_1st_time_investor_c',
            'studio' => 'visible',
            'label' => 'LBL_IS_1ST_TIME_INVESTOR',
          ),
          1 => 
          array (
            'name' => 'leadsource_c',
            'label' => 'LBL_LEADSOURCE',
          ),
        ),
      ),
      'lbl_editview_panel3' => 
      array (
        0 => 
        array (
          0 => 'status',
          1 => 
          array (
            'name' => 'disposition_c',
            'studio' => 'visible',
            'label' => 'LBL_DISPOSITION',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'remarks_c',
            'studio' => 'visible',
            'label' => 'LBL_REMARKS',
          ),
          1 => '',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'next_call_planning_date_c',
            'label' => 'LBL_NEXT_CALL_PLANNING_DATE',
          ),
          1 => 
          array (
            'name' => 'next_call_planning_comment_c',
            'studio' => 'visible',
            'label' => 'LBL_NEXT_CALL_PLANNING_COMMENT',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'gateway_c',
            'label' => 'LBL_GATEWAY',
          ),
          1 => 
          array (
            'name' => 'justdial_category_c',
            'label' => 'LBL_JUSTDIAL_CATEGORY',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'related_kiosk_account_c',
            'label' => 'LBL_RELATED_KIOSK_ACCOUNT',
          ),
          1 => 
          array (
            'name' => 'encrypted_otp_c',
            'label' => 'LBL_ENCRYPTED_OTP',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'accounts_leads_1_name',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'otp_c',
            'label' => 'LBL_OTP',
            'customCode' => '<input name="otp_c" id="otp_c" size="5" maxlength = "5" type ="text" value ="{$fields.otp_c.value}">',
          ),
          1 => 
          array (
            'name' => 'city_c',
            'studio' => 'visible',
            'label' => 'LBL_CITY',
          ),
        ),
        7 => 
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
        8 => 
        array (
          0 => 'refered_by',
        ),
      ),
      'lbl_editview_panel4' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'first_call_date_c',
            'label' => 'LBL_FIRST_CALL_DATE',
          ),
          1 => 
          array (
            'name' => 'first_call_disposition_c',
            'label' => 'LBL_FIRST_CALL_DISPOSITION',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'second_call_date_c',
            'label' => 'LBL_SECOND_CALL_DATE',
          ),
          1 => 
          array (
            'name' => 'second_call_disposition_c',
            'label' => 'LBL_SECOND_CALL_DISPOSITION',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'third_call_date_c',
            'label' => 'LBL_THIRD_CALL_DATE',
          ),
          1 => 
          array (
            'name' => 'third_call_disposition_c',
            'label' => 'LBL_THIRD_CALL_DISPOSITION',
          ),
        ),
      ),
      'lbl_editview_panel5' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'product_interest_c',
            'studio' => 'visible',
            'label' => 'LBL_PRODUCT_INTEREST',
          ),
          1 => 
          array (
            'name' => 'product_sub_interest_c',
            'studio' => 'visible',
            'label' => 'LBL_PRODUCT_SUB_INTEREST',
          ),
        ),
      ),
      'LBL_PANEL_ASSIGNMENT' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'age_c',
            'label' => 'LBL_AGE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'state_c',
            'studio' => 'visible',
            'label' => 'LBL_STATE',
          ),
          1 => 
          array (
            'name' => 'city_dependent_c',
            'studio' => 'visible',
            'label' => 'LBL_CITY_DEPENDENT',
          ),
        ),
        2 => 
        array (
          0 => 'description',
          1 => 
          array (
            'name' => 'campaign_city_c',
            'label' => 'LBL_CAMPAIGN_CITY',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'annual_income_c',
            'label' => 'LBL_ANNUAL_INCOME',
          ),
          1 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'monthly_income_details_c',
            'label' => 'LBL_MONTHLY_INCOME_DETAILS',
          ),
          1 => 
          array (
            'name' => 'profession_c',
            'label' => 'LBL_PROFESSION',
          ),
        ),
      ),
    ),
  ),
);
?>
