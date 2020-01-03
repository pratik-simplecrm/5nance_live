<?php
$viewdefs ['Leads'] = 
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
          3 => 
          array (
            'customCode' => '{if $bean->aclAccess("edit") && !$DISABLE_CONVERT_ACTION}<input title="{$MOD.LBL_CONVERTLEAD_TITLE}" accessKey="{$MOD.LBL_CONVERTLEAD_BUTTON_KEY}" type="button" class="button" onClick="document.location=\'index.php?module=Leads&action=ConvertLead&record={$fields.id.value}\'" name="convert" value="{$MOD.LBL_CONVERTLEAD}">{/if}',
            'sugar_html' => 
            array (
              'type' => 'button',
              'value' => '{$MOD.LBL_CONVERTLEAD}',
              'htmlOptions' => 
              array (
                'title' => '{$MOD.LBL_CONVERTLEAD_TITLE}',
                'accessKey' => '{$MOD.LBL_CONVERTLEAD_BUTTON_KEY}',
                'class' => 'button',
                'onClick' => 'document.location=\'index.php?module=Leads&action=ConvertLead&record={$fields.id.value}\'',
                'name' => 'convert',
                'id' => 'convert_lead_button',
              ),
              'template' => '{if $bean->aclAccess("edit") && !$DISABLE_CONVERT_ACTION}[CONTENT]{/if}',
            ),
          ),
          4 => 'FIND_DUPLICATES',
          5 => 
          array (
            'customCode' => '<input title="{$APP.LBL_MANAGE_SUBSCRIPTIONS}" class="button" onclick="this.form.return_module.value=\'Leads\'; this.form.return_action.value=\'DetailView\';this.form.return_id.value=\'{$fields.id.value}\'; this.form.action.value=\'Subscriptions\'; this.form.module.value=\'Campaigns\'; this.form.module_tab.value=\'Leads\';" type="submit" name="Manage Subscriptions" value="{$APP.LBL_MANAGE_SUBSCRIPTIONS}">',
            'sugar_html' => 
            array (
              'type' => 'submit',
              'value' => '{$APP.LBL_MANAGE_SUBSCRIPTIONS}',
              'htmlOptions' => 
              array (
                'title' => '{$APP.LBL_MANAGE_SUBSCRIPTIONS}',
                'class' => 'button',
                'id' => 'manage_subscriptions_button',
                'onclick' => 'this.form.return_module.value=\'Leads\'; this.form.return_action.value=\'DetailView\';this.form.return_id.value=\'{$fields.id.value}\'; this.form.action.value=\'Subscriptions\'; this.form.module.value=\'Campaigns\'; this.form.module_tab.value=\'Leads\';',
                'name' => '{$APP.LBL_MANAGE_SUBSCRIPTIONS}',
              ),
            ),
          ),
          6 => 
          array (
            'customCode' => '<input title="{$APP.LBL_VCARD}" class="button" onclick="this.form.return_module.value=\'Leads\'; this.form.return_action.value=\'DetailView\';this.form.return_id.value=\'{$fields.id.value}\'; this.form.action.value=\'vCard\'; this.form.module_tab.value=\'Leads\';" type="submit" name="Download vCard" value="{$APP.LBL_VCARD}">',
            'sugar_html' => 
            array (
              'type' => 'button',
              'value' => 'Download vCard',
              'htmlOptions' => 
              array (
                'title' => '{$APP.LBL_VCARD}',
                'class' => 'button',
                'id' => 'btn_vCardButton',
                'onclick' => 'this.form.return_module.value=\'Leads\'; this.form.return_action.value=\'DetailView\';this.form.return_id.value=\'{$fields.id.value}\'; this.form.action.value=\'vCard\'; this.form.module_tab.value=\'Leads\';',
                'name' => '{$APP.LBL_VCARD}',
              ),
            ),
          ),
          'AOS_GENLET' => 
          array (
            'customCode' => '<input type="button" class="button" onClick="showPopup();" value="{$APP.LBL_GENERATE_LETTER}">',
          ),
          7 => 
          array (
            'customCode' => '<input  type="submit" class="button" name="create" id="create" value="Create Lead" onClick="document.location=\'index.php?module=Leads&action=EditView&return_module=Leads&return_action=DetailView\'">',
          ),
        ),
        'headerTpl' => 'modules/Leads/tpls/DetailViewHeader.tpl',
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
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'modules/Leads/Lead.js',
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
            'comment' => 'First name of the contact',
            'label' => 'LBL_FIRST_NAME',
          ),
          1 => 
          array (
            'name' => 'middle_name_c',
            'label' => 'LBL_MIDDLE_NAME',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'last_name',
            'comment' => 'Last name of the contact',
            'label' => 'LBL_LAST_NAME',
          ),
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
