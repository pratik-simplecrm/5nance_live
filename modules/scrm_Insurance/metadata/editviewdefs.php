<?php
$module_name = 'scrm_Insurance';
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
        'LBL_EDITVIEW_PANEL1' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL2' => 
        array (
          'newTab' => false,
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
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL5' => 
        array (
          'newTab' => false,
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
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL10' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL11' => 
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
          0 => 
          array (
            'name' => 'policy_type',
            'studio' => 'visible',
            'label' => 'LBL_POLICY_TYPE',
          ),
          1 => 
          array (
            'name' => 'policy_subtype',
            'studio' => 'visible',
            'label' => 'LBL_POLICY_SUBTYPE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'name',
            'label' => 'LBL_NAME',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'subtype',
            'studio' => 'visible',
            'label' => 'LBL_SUBTYPE',
          ),
          1 => 
          array (
            'name' => 'gender',
            'studio' => 'visible',
            'label' => 'LBL_GENDER',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'family_no_of_members',
            'studio' => 'visible',
            'label' => 'LBL_FAMILY_NO_OF_MEMBERS',
          ),
          1 => 
          array (
            'name' => 'sum_insured',
            'label' => 'LBL_SUM_INSURED',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'type',
            'studio' => 'visible',
            'label' => 'LBL_TYPE',
          ),
          1 => 
          array (
            'name' => 'pincode',
            'label' => 'LBL_PINCODE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'tenure',
            'studio' => 'visible',
            'label' => 'LBL_TENURE',
          ),
          1 => 
          array (
            'name' => 'premium_amount',
            'label' => 'LBL_PREMIUM_AMOUNT',
          ),
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'annual_income',
            'label' => 'LBL_ANNUAL_INCOME',
          ),
          1 => 
          array (
            'name' => 'term_gender',
            'studio' => 'visible',
            'label' => 'LBL_TERM_GENDER',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'smoker',
            'studio' => 'visible',
            'label' => 'LBL_SMOKER',
          ),
          1 => 
          array (
            'name' => 'date_of_birth',
            'label' => 'LBL_DATE_OF_BIRTH',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'term_tenure',
            'studio' => 'visible',
            'label' => 'LBL_TERM_TENURE',
          ),
          1 => 
          array (
            'name' => 'premium_frequency',
            'studio' => 'visible',
            'label' => 'LBL_PREMIUM_FREQUENCY',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'premium_paying_options',
            'studio' => 'visible',
            'label' => 'LBL_PREMIUM_PAYING_OPTIONS',
          ),
          1 => 
          array (
            'name' => 'term_premium_amount',
            'label' => 'LBL_TERM_PREMIUM_AMOUNT',
          ),
        ),
      ),
      'lbl_editview_panel3' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'two_wheeler_type',
            'studio' => 'visible',
            'label' => 'LBL_TWO_WHEELER_TYPE',
          ),
          1 => 
          array (
            'name' => 'vehicle_registration_number',
            'label' => 'LBL_VEHICLE_REGISTRATION_NUMBER',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'rto_location_city',
            'label' => 'LBL_RTO_LOCATION_CITY',
          ),
          1 => 
          array (
            'name' => 'date_of_inception',
            'label' => 'LBL_DATE_OF_INCEPTION',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'manufacturing_year',
            'studio' => 'visible',
            'label' => 'LBL_MANUFACTURING_YEAR',
          ),
          1 => 
          array (
            'name' => 'manufacturer_make',
            'label' => 'LBL_MANUFACTURER_MAKE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'model',
            'label' => 'LBL_MODEL',
          ),
          1 => 
          array (
            'name' => 'variant',
            'label' => 'LBL_VARIANT',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'policy_status',
            'studio' => 'visible',
            'label' => 'LBL_POLICY_STATUS',
          ),
          1 => 
          array (
            'name' => 'claim_status',
            'studio' => 'visible',
            'label' => 'LBL_CLAIM_STATUS',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'insured_declared_value',
            'label' => 'LBL_INSURED_DECLARED_VALUE',
          ),
          1 => 
          array (
            'name' => 'addon_covers',
            'label' => 'LBL_ADDON_COVERS',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'long_term_renewable_option',
            'studio' => 'visible',
            'label' => 'LBL_LONG_TERM_RENEWABLE_OPTION',
          ),
          1 => 
          array (
            'name' => 'two_wheeler_premium_amount',
            'label' => 'LBL_TWO_WHEELER_PREMIUM_AMOUNT',
          ),
        ),
      ),
      'lbl_editview_panel4' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'motor_policy_type',
            'studio' => 'visible',
            'label' => 'LBL_MOTOR_POLICY_TYPE',
          ),
          1 => 
          array (
            'name' => 'existing_policy_number',
            'label' => 'LBL_EXISTING_POLICY_NUMBER',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'previous_insurer',
            'label' => 'LBL_PREVIOUS_INSURER',
          ),
          1 => 
          array (
            'name' => 'motor_vehicle_registration_num',
            'label' => 'LBL_MOTOR_VEHICLE_REGISTRATION_NUM',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'motor_rto_location_city',
            'label' => 'LBL_MOTOR_RTO_LOCATION_CITY',
          ),
          1 => 
          array (
            'name' => 'motor_date_of_inception',
            'label' => 'LBL_MOTOR_DATE_OF_INCEPTION',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'motor_manufacturing_year',
            'studio' => 'visible',
            'label' => 'LBL_MOTOR_MANUFACTURING_YEAR',
          ),
          1 => 
          array (
            'name' => 'motor_manufacturer_make',
            'label' => 'LBL_MOTOR_MANUFACTURER_MAKE',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'motor_model',
            'label' => 'LBL_MOTOR_MODEL',
          ),
          1 => 
          array (
            'name' => 'motor_variant',
            'label' => 'LBL_MOTOR_VARIANT',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'fuel_type',
            'studio' => 'visible',
            'label' => 'LBL_FUEL_TYPE',
          ),
          1 => 
          array (
            'name' => 'motor_policy_status',
            'studio' => 'visible',
            'label' => 'LBL_MOTOR_POLICY_STATUS',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'motor_claim_status',
            'studio' => 'visible',
            'label' => 'LBL_MOTOR_CLAIM_STATUS',
          ),
          1 => 
          array (
            'name' => 'motor_insured_declared_value',
            'label' => 'LBL_MOTOR_INSURED_DECLARED_VALUE ',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'motor_addoncovers',
            'label' => 'LBL_MOTOR_ADDONCOVERS',
          ),
          1 => 
          array (
            'name' => 'motor_long_term_renewable',
            'studio' => 'visible',
            'label' => 'LBL_MOTOR_LONG_TERM_RENEWABLE',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'motor_premium_amount',
            'label' => 'LBL_MOTOR_PREMIUM_AMOUNT',
          ),
          1 => '',
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'zero_depreciation',
            'label' => 'LBL_ZERO_DEPRECIATION',
          ),
          1 => 
          array (
            'name' => 'return_to_invoice',
            'label' => 'LBL_RETURN_TO_INVOICE',
          ),
        ),
        10 => 
        array (
          0 => 
          array (
            'name' => 'road_side_assistance',
            'label' => 'LBL_ROAD_SIDE_ASSISTANCE',
          ),
          1 => 
          array (
            'name' => 'engine_protector',
            'label' => 'LBL_ENGINE_PROTECTOR',
          ),
        ),
        11 => 
        array (
          0 => 
          array (
            'name' => 'key_replacement',
            'label' => 'LBL_KEY_REPLACEMENT',
          ),
          1 => 
          array (
            'name' => 'etc',
            'label' => 'LBL_ETC',
          ),
        ),
        12 => 
        array (
          0 => 
          array (
            'name' => 'registered_member_of_aai',
            'label' => 'LBL_REGISTERED_MEMBER_OF_AAI',
          ),
          1 => 
          array (
            'name' => 'theft_alarm',
            'label' => 'LBL_THEFT_ALARM',
          ),
        ),
      ),
      'lbl_editview_panel5' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'destination_travellocation',
            'label' => 'LBL_DESTINATION_TRAVELLOCATION',
          ),
          1 => '',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'trip_start_date',
            'label' => 'LBL_TRIP_START_DATE',
          ),
          1 => 
          array (
            'name' => 'trip_end_date',
            'label' => 'LBL_TRIP_END_DATE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'trip_duration',
            'label' => 'LBL_TRIP_DURATION',
          ),
          1 => 
          array (
            'name' => 'number_of_travellers',
            'label' => 'LBL_NUMBER_OF_TRAVELLERS',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'age_of_travellers',
            'label' => 'LBL_AGE_OF_TRAVELLERS',
          ),
          1 => 
          array (
            'name' => 'dob_of_travellers',
            'label' => 'LBL_DOB_OF_TRAVELLERS',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'relation_of_travellers',
            'studio' => 'visible',
            'label' => 'LBL_RELATION_OF_TRAVELLERS',
          ),
          1 => 
          array (
            'name' => 'maximum_single_trip_duration',
            'label' => 'LBL_MAXIMUM_SINGLE_TRIP_DURATION',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'travel_sum_insured',
            'label' => 'LBL_TRAVEL_SUM_INSURED',
          ),
          1 => 
          array (
            'name' => 'travel_premium_amount',
            'label' => 'LBL_TRAVEL_PREMIUM_AMOUNT',
          ),
        ),
      ),
      'lbl_editview_panel6' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'is_your_house_rented',
            'studio' => 'visible',
            'label' => 'LBL_IS_YOUR_HOUSE_RENTED',
          ),
          1 => 
          array (
            'name' => 'age_of_the_property',
            'label' => 'LBL_AGE_OF_THE_PROPERTY',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'type_of_property',
            'label' => 'LBL_TYPE_OF_PROPERTY',
          ),
          1 => 
          array (
            'name' => 'risks_to_be_covered_for',
            'label' => 'LBL_RISKS_TO_BE_COVERED_FOR',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'house_sum_insured',
            'label' => 'LBL_HOUSE_SUM_INSURED',
          ),
          1 => 
          array (
            'name' => 'house_premium_amount',
            'label' => 'LBL_HOUSE_PREMIUM_AMOUNT',
          ),
        ),
      ),
      'lbl_editview_panel7' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'occupation',
            'label' => 'LBL_OCCUPATION ',
          ),
          1 => 
          array (
            'name' => 'members_of_the_family',
            'studio' => 'visible',
            'label' => 'LBL_MEMBERS_OF_THE_FAMILY',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'personal_annual_income',
            'label' => 'LBL_PERSONAL_ANNUAL_INCOME',
          ),
          1 => 
          array (
            'name' => 'personal_sum_insured',
            'label' => 'LBL_PERSONAL_SUM_INSURED',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'personal_variation',
            'label' => 'LBL_PERSONAL_VARIATION',
          ),
          1 => 
          array (
            'name' => 'personal_premium_amount',
            'label' => 'LBL_PERSONAL_PREMIUM_AMOUNT',
          ),
        ),
      ),
      'lbl_editview_panel8' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'pension_amount_per_month',
            'label' => 'LBL_PENSION_AMOUNT_PER_MONTH',
          ),
          1 => 
          array (
            'name' => 'retirment_age',
            'label' => 'LBL_RETIRMENT_AGE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'retirement_sum_insured',
            'label' => 'LBL_RETIREMENT_SUM_INSURED',
          ),
          1 => 
          array (
            'name' => 'retirement_date_of_birth',
            'label' => 'LBL_RETIREMENT_DATE_OF_BIRTH',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'city_of_residence',
            'label' => 'LBL_CITY_OF_RESIDENCE',
          ),
          1 => '',
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'retirement_premium_amount',
            'label' => 'LBL_RETIREMENT_PREMIUM_AMOUNT',
          ),
        ),
      ),
      'lbl_editview_panel9' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'endowment_sum_insured',
            'label' => 'LBL_ENDOWMENT_SUM_INSURED',
          ),
          1 => 
          array (
            'name' => 'endowment_date_of_birth',
            'label' => 'LBL_ENDOWMENT_DATE_OF_BIRTH',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'endowment_city_of_residence',
            'label' => 'LBL_ENDOWMENT_CITY_OF_RESIDENCE',
          ),
          1 => 
          array (
            'name' => 'endowment_tenure_term',
            'studio' => 'visible',
            'label' => 'LBL_ENDOWMENT_TENURE_TERM',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'endowment_premium_amount',
            'label' => 'LBL_ENDOWMENT_PREMIUM_AMOUNT',
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
            'name' => 'child_sum_insured',
            'label' => 'LBL_CHILD_SUM_INSURED',
          ),
          1 => 
          array (
            'name' => 'parents_date_of_birth',
            'label' => 'LBL_PARENTS_DATE_OF_BIRTH',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'childs_date_of_birth',
            'label' => 'LBL_CHILDS_DATE_OF_BIRTH',
          ),
          1 => 
          array (
            'name' => 'childplan_tenure',
            'studio' => 'visible',
            'label' => 'LBL_CHILDPLAN_TENURE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'childplan_city_of_residence',
            'label' => 'LBL_CHILDPLAN_CITY_OF_RESIDENCE',
          ),
          1 => 
          array (
            'name' => 'chidplan_premium_amount',
            'label' => 'LBL_CHIDPLAN_PREMIUM_AMOUNT',
          ),
        ),
      ),
      'lbl_editview_panel11' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'annual_premium',
            'label' => 'LBL_ANNUAL_PREMIUM',
          ),
          1 => 
          array (
            'name' => 'ulip_date_of_birth',
            'label' => 'LBL_ULIP_DATE_OF_BIRTH',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'ulip_city_of_residence',
            'label' => 'LBL_ULIP_CITY_OF_RESIDENCE',
          ),
          1 => 
          array (
            'name' => 'ulip_sum_insured',
            'label' => 'LBL_ULIP_SUM_INSURED',
          ),
        ),
      ),
    ),
  ),
);
?>
