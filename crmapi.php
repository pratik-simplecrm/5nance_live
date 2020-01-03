<?php
if (!define('sugarEntry'))
    define('sugarEntry', true);
require_once('include/entryPoint.php');
ini_set('display_errors','On');
global $db, $sugar_config;
$url = $sugar_config["webservice_url"];

$username = $sugar_config["webservice_username"];
$password = $sugar_config["webservice_password"];

$apiModule = array(
    'Leads',
    'Contacts',
);
$apiAction = array(
    'Create',
    'Update',
    'Fetch'
);

//~ print_r($_SERVER);

if ($_SERVER['HTTP_AUTHORIZEDAPPLICATION'] == "5n@nc3" && in_array($_SERVER['HTTP_REQUESTEDMODULE'], $apiModule) && in_array($_SERVER['HTTP_REQUESTEDMETHOD'], $apiAction)) {
    
    $module = $_SERVER['HTTP_REQUESTEDMODULE'];
    $action = $_SERVER['HTTP_REQUESTEDMETHOD'];
    
    $fp      = fopen('php://input', 'r');
    $rawData = json_decode(stream_get_contents($fp));
    
    $session_id = generateSession($username, $password, $url);
    
    if ($module == "Contacts" && $action == 'Create') {
        
        //~ $myfile = fopen("api_create_lead.txt", "w") or die("Unable to open file!");
        //~ $data = (array)$rawData;
        //~ fwrite($myfile, print_r($data,true)); 
        //~ fclose($myfile);
        $required_fileds = array(
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'phone_mobile' => 'Mobile Number',
			'email1' => 'Email ID',
        );
        
        $missing_fields = array();
        foreach($required_fileds as $key => $val){
			if(empty($rawData->$key) || !isset($rawData->$key))
				$missing_fields[] = $val;
		}
        
        if(!empty($missing_fields)){
			$error = "Missing Required fields: " . implode(",", $missing_fields);
			$msg = array(
                'Success' => false,
                'Message' => $error,
            );
		} else {
        
        
        
        
        //~ $first_name  = $rawData->first_name;
        //~ $last_name   = $rawData->last_name;
        //~ $mobile      = $rawData->mobile;
        //~ $email1      = $rawData->email1;
        //~ $lead_source = $rawData->lead_source;
        //~ $street      = $rawData->street;
        //~ $state       = $rawData->state;
        //~ $city        = $rawData->city;
        //~ $postalcode  = $rawData->postalcode;
        //~ $assigned_user_id = $rawData->assigned_user_id;
        
        
        
        $first_name = $rawData->first_name;
		$last_name = $rawData->last_name;
		$email1 = $rawData->email1;
		$phone_mobile = $rawData->phone_mobile;
		$primary_address_street = $rawData->primary_address_street;
		$primary_address_city = $rawData->primary_address_city;
		$primary_address_state = $rawData->primary_address_state;
		$primary_address_postalcode = $rawData->primary_address_postalcode;
		$primary_address_country = $rawData->primary_address_country;
		$alt_address_street = $rawData->alt_address_street;
		$alt_address_city = $rawData->alt_address_city;
		$alt_address_state = $rawData->alt_address_state;
		$alt_address_postalcode = $rawData->alt_address_postalcode;
		$alt_address_country = $rawData->alt_address_country;
		$lead_source = $rawData->lead_source;
		$birthdate = $rawData->birthdate;
		$assigned_user_id = $rawData->assigned_user_id;
		$adoption_percentage_c = $rawData->adoption_percentage_c;
		$age_c = $rawData->age_c;
		$annual_expenses_c = $rawData->annual_expenses_c;
		$annual_income_c = $rawData->annual_income_c;
		$best_time_to_speak_to_c = $rawData->best_time_to_speak_to_c;
		$category_c = $rawData->category_c;
		$comments_c = $rawData->comments_c;
		$courier_request_c = $rawData->courier_request_c;
		$current_company_details_c = $rawData->current_company_details_c;
		$exisiting_term_insurance_pre_c = $rawData->exisiting_term_insurance_pre_c;
		$exisiting_term_insurance_sum_c = $rawData->exisiting_term_insurance_sum_c;
		$exisitng_mi_premium_c = $rawData->exisitng_mi_premium_c;
		$existing_hi_premium_c = $rawData->existing_hi_premium_c;
		$existing_hi_sum_insured_c = $rawData->existing_hi_sum_insured_c;
		$existing_insurance_c = $rawData->existing_insurance_c;
		$existing_mi_sum_insured_c = $rawData->existing_mi_sum_insured_c;
		$expenses_details_c = $rawData->expenses_details_c;
		$facebook_id_c = $rawData->facebook_id_c;
		$first_transaction_date_c = $rawData->first_transaction_date_c;
		$gender_c = $rawData->gender_c;
		$historical_session_data_c = $rawData->historical_session_data_c;
		$investment_in_80c_c = $rawData->investment_in_80c_c;
		$investment_in_80d_c = $rawData->investment_in_80d_c;
		$loan_type_c = $rawData->loan_type_c;
		$monthly_expense_details_c = $rawData->monthly_expense_details_c;
		$monthly_income_details_c = $rawData->monthly_income_details_c;
		$online_activity_status_c = $rawData->online_activity_status_c;
		$opportunity_value_c = $rawData->opportunity_value_c;
		$partner_status_c = $rawData->partner_status_c;
		$payment_type_c = $rawData->payment_type_c;
		$posted_message_id_c = $rawData->posted_message_id_c;
		$post_from_id_c = $rawData->post_from_id_c;
		$prior_invesment_value_c = $rawData->prior_invesment_value_c;
		$risk_profiling_questions_c = $rawData->risk_profiling_questions_c;
		$saving_potential_c = $rawData->saving_potential_c;
		$tax_planning_c = $rawData->tax_planning_c;
		$twitter_c = $rawData->twitter_c;
		$type_c = $rawData->type_c;
		$unique_customer_code_c = $rawData->unique_customer_code_c;
		$location_through_ip_c = $rawData->location_through_ip_c;
		$dnc_status_c = $rawData->dnc_status_c;
		$campaign_sub_type_c = $rawData->campaign_sub_type_c;
		$campaign_type_c = $rawData->campaign_type_c;
		$activate_disposition_c = $rawData->activate_disposition_c;
		$user_allocation_date_c = $rawData->user_allocation_date_c;
		$classification_accoun_c = $rawData->classification_accoun_c;
		$gateway_c = $rawData->gateway_c;
		$related_corporate_account_c = $rawData->related_corporate_account_c;
		$related_kiosk_account_c = $rawData->related_kiosk_account_c;
		$user_type_c = $rawData->user_type_c;
		$educational_details_c = $rawData->educational_details_c;
		$product_interest_c = $rawData->product_interest_c;
		$product_sub_type_interest_c = $rawData->product_sub_type_interest_c;
		$opportunity_horizon_c = $rawData->opportunity_horizon_c;
		$investment_behaviour_segment_c = $rawData->investment_behaviour_segment_c;
		$occupational_details_c = $rawData->occupational_details_c;
		$total_employment_years_c = $rawData->total_employment_years_c;
		$financial_goals_c = $rawData->financial_goals_c;
		$exisiting_investments_c = $rawData->exisiting_investments_c;
		$existing_investment_gold_c = $rawData->existing_investment_gold_c;
		$existing_investment_silver_c = $rawData->existing_investment_silver_c;
		$existing_investment_re_c = $rawData->existing_investment_re_c;
		$existing_investments_deposit_c = $rawData->existing_investments_deposit_c;
		$existing_investments_bonds_c = $rawData->existing_investments_bonds_c;
		$life_stage_profiling_c = $rawData->life_stage_profiling_c;
		$family_members_number_c = $rawData->family_members_number_c;
		$structure_of_family_c = $rawData->structure_of_family_c;
        
        
        
        //~ if (!isset($last_name) or empty($last_name) or !isset($email1) or empty($email1) or !isset($mobile) or empty($mobile)) {
            //~ $msg = array(
                //~ 'Success' => false,
                //~ 'Message' => 'Mandatory field(s) are missing'
            //~ );
        //~ 
            
            $name_value_list = array(
				array('name' => 'first_name','value' => $first_name),
				array('name' => 'last_name','value' => $last_name),
				array('name' => 'email1','value' => $email1),
				array('name' => 'phone_mobile','value' => $phone_mobile),
				array('name' => 'primary_address_street','value' => $primary_address_street),
				array('name' => 'primary_address_city','value' => $primary_address_city),
				array('name' => 'primary_address_state','value' => $primary_address_state),
				array('name' => 'primary_address_postalcode','value' => $primary_address_postalcode),
				array('name' => 'primary_address_country','value' => $primary_address_country),
				array('name' => 'alt_address_street','value' => $alt_address_street),
				array('name' => 'alt_address_city','value' => $alt_address_city),
				array('name' => 'alt_address_state','value' => $alt_address_state),
				array('name' => 'alt_address_postalcode','value' => $alt_address_postalcode),
				array('name' => 'alt_address_country','value' => $alt_address_country),
				array('name' => 'lead_source','value' => $lead_source),
				array('name' => 'birthdate','value' => $birthdate),
				array('name' => 'assigned_user_id','value' => $assigned_user_id),

				array('name' => 'adoption_percentage_c','value' => $adoption_percentage_c),
				array('name' => 'age_c','value' => $age_c),
				array('name' => 'annual_expenses_c','value' => $annual_expenses_c),
				array('name' => 'annual_income_c','value' => $annual_income_c),
				array('name' => 'best_time_to_speak_to_c','value' => $best_time_to_speak_to_c),
				array('name' => 'category_c','value' => $category_c),
				array('name' => 'comments_c','value' => $comments_c),
				array('name' => 'courier_request_c','value' => $courier_request_c),
				array('name' => 'current_company_details_c','value' => $current_company_details_c),
				array('name' => 'exisiting_term_insurance_pre_c','value' => $exisiting_term_insurance_pre_c),
				array('name' => 'exisiting_term_insurance_sum_c','value' => $exisiting_term_insurance_sum_c),
				array('name' => 'exisitng_mi_premium_c','value' => $exisitng_mi_premium_c),
				array('name' => 'existing_hi_premium_c','value' => $existing_hi_premium_c),
				array('name' => 'existing_hi_sum_insured_c','value' => $existing_hi_sum_insured_c),
				array('name' => 'existing_insurance_c','value' => $existing_insurance_c),
				array('name' => 'existing_mi_sum_insured_c','value' => $existing_mi_sum_insured_c),
				array('name' => 'expenses_details_c','value' => $expenses_details_c),
				array('name' => 'facebook_id_c','value' => $facebook_id_c),
				array('name' => 'first_transaction_date_c','value' => $first_transaction_date_c),
				array('name' => 'gender_c','value' => $gender_c),
				array('name' => 'historical_session_data_c','value' => $historical_session_data_c),
				array('name' => 'investment_in_80c_c','value' => $investment_in_80c_c),
				array('name' => 'investment_in_80d_c','value' => $investment_in_80d_c),
				array('name' => 'loan_type_c','value' => $loan_type_c),
				array('name' => 'monthly_expense_details_c','value' => $monthly_expense_details_c),
				array('name' => 'monthly_income_details_c','value' => $monthly_income_details_c),
				array('name' => 'online_activity_status_c','value' => $online_activity_status_c),
				array('name' => 'opportunity_value_c','value' => $opportunity_value_c),
				array('name' => 'partner_status_c','value' => $partner_status_c),
				array('name' => 'payment_type_c','value' => $payment_type_c),
				array('name' => 'posted_message_id_c','value' => $posted_message_id_c),
				array('name' => 'post_from_id_c','value' => $post_from_id_c),
				array('name' => 'prior_invesment_value_c','value' => $prior_invesment_value_c),
				array('name' => 'risk_profiling_questions_c','value' => $risk_profiling_questions_c),
				array('name' => 'saving_potential_c','value' => $saving_potential_c),
				array('name' => 'tax_planning_c','value' => $tax_planning_c),
				array('name' => 'twitter_c','value' => $twitter_c),
				array('name' => 'type_c','value' => $type_c),
				array('name' => 'unique_customer_code_c','value' => $unique_customer_code_c),
				array('name' => 'sales_person_tagging_c','value' => $sales_person_tagging_c),
				array('name' => 'location_through_ip_c','value' => $location_through_ip_c),
				array('name' => 'dnc_status_c','value' => $dnc_status_c),
				array('name' => 'disposition_c','value' => $disposition_c),
				array('name' => 'campaign_sub_type_c','value' => $campaign_sub_type_c),
				array('name' => 'campaign_type_c','value' => $campaign_type_c),
				array('name' => 'activate_disposition_c','value' => $activate_disposition_c),
				array('name' => 'user_allocation_date_c','value' => $user_allocation_date_c),
				array('name' => 'classification_accoun_c','value' => $classification_accoun_c),
				array('name' => 'gateway_c','value' => $gateway_c),
				array('name' => 'related_corporate_account_c','value' => $related_corporate_account_c),
				array('name' => 'related_kiosk_account_c','value' => $related_kiosk_account_c),
				array('name' => 'user_type_c','value' => $user_type_c),
				array('name' => 'educational_details_c','value' => $educational_details_c),
				array('name' => 'product_interest_c','value' => $product_interest_c),
				array('name' => 'product_sub_type_interest_c','value' => $product_sub_type_interest_c),
				array('name' => 'opportunity_horizon_c','value' => $opportunity_horizon_c),
				array('name' => 'investment_behaviour_segment_c','value' => $investment_behaviour_segment_c),
				array('name' => 'occupational_details_c','value' => $occupational_details_c),
				array('name' => 'total_employment_years_c','value' => $total_employment_years_c),
				array('name' => 'financial_goals_c','value' => $financial_goals_c),
				array('name' => 'exisiting_investments_c','value' => $exisiting_investments_c),
				array('name' => 'existing_investment_gold_c','value' => $existing_investment_gold_c),
				array('name' => 'existing_investment_silver_c','value' => $existing_investment_silver_c),
				array('name' => 'existing_investment_re_c','value' => $existing_investment_re_c),
				array('name' => 'existing_investments_deposit_c','value' => $existing_investments_deposit_c),
				array('name' => 'existing_investments_bonds_c','value' => $existing_investments_bonds_c),
				array('name' => 'life_stage_profiling_c','value' => $life_stage_profiling_c),
				array('name' => 'family_members_number_c','value' => $family_members_number_c),
				array('name' => 'structure_of_family_c','value' => $structure_of_family_c),                
            );
            
            $id = createrecord($session_id, 'Contacts', $name_value_list, $url);
            
            $msg = array(
                'Success' => true,
                'Message' => 'User Created Successfully',
                'User id' => $id
            );
            
        }
    } else if ($module == "Contacts" && $action == 'Update') {
        
        $lead_id     = $rawData->lead_id; //Required
        $first_name = $rawData->first_name;
		$last_name = $rawData->last_name;
		$phone_home = $rawData->phone_home;
		$phone_mobile = $rawData->phone_mobile;
		$primary_address_street = $rawData->primary_address_street;
		$primary_address_city = $rawData->primary_address_city;
		$primary_address_state = $rawData->primary_address_state;
		$primary_address_postalcode = $rawData->primary_address_postalcode;
		$primary_address_country = $rawData->primary_address_country;
		$alt_address_street = $rawData->alt_address_street;
		$alt_address_city = $rawData->alt_address_city;
		$alt_address_state = $rawData->alt_address_state;
		$alt_address_postalcode = $rawData->alt_address_postalcode;
		$alt_address_country = $rawData->alt_address_country;
		$lead_source = $rawData->lead_source;
		$birthdate = $rawData->birthdate;
		$assigned_user_id = $rawData->assigned_user_id;
		$adoption_percentage_c = $rawData->adoption_percentage_c;
		$age_c = $rawData->age_c;
		$annual_expenses_c = $rawData->annual_expenses_c;
		$annual_income_c = $rawData->annual_income_c;
		$best_time_to_speak_to_c = $rawData->best_time_to_speak_to_c;
		$category_c = $rawData->category_c;
		$comments_c = $rawData->comments_c;
		$courier_request_c = $rawData->courier_request_c;
		$current_company_details_c = $rawData->current_company_details_c;
		$exisiting_term_insurance_pre_c = $rawData->exisiting_term_insurance_pre_c;
		$exisiting_term_insurance_sum_c = $rawData->exisiting_term_insurance_sum_c;
		$exisitng_mi_premium_c = $rawData->exisitng_mi_premium_c;
		$existing_hi_premium_c = $rawData->existing_hi_premium_c;
		$existing_hi_sum_insured_c = $rawData->existing_hi_sum_insured_c;
		$existing_insurance_c = $rawData->existing_insurance_c;
		$existing_mi_sum_insured_c = $rawData->existing_mi_sum_insured_c;
		$expenses_details_c = $rawData->expenses_details_c;
		$facebook_id_c = $rawData->facebook_id_c;
		$first_transaction_date_c = $rawData->first_transaction_date_c;
		$gender_c = $rawData->gender_c;
		$historical_session_data_c = $rawData->historical_session_data_c;
		$investment_in_80c_c = $rawData->investment_in_80c_c;
		$investment_in_80d_c = $rawData->investment_in_80d_c;
		$loan_type_c = $rawData->loan_type_c;
		$monthly_expense_details_c = $rawData->monthly_expense_details_c;
		$monthly_income_details_c = $rawData->monthly_income_details_c;
		$online_activity_status_c = $rawData->online_activity_status_c;
		$opportunity_value_c = $rawData->opportunity_value_c;
		$partner_status_c = $rawData->partner_status_c;
		$payment_type_c = $rawData->payment_type_c;
		$posted_message_id_c = $rawData->posted_message_id_c;
		$post_from_id_c = $rawData->post_from_id_c;
		$prior_invesment_value_c = $rawData->prior_invesment_value_c;
		$risk_profiling_questions_c = $rawData->risk_profiling_questions_c;
		$saving_potential_c = $rawData->saving_potential_c;
		$tax_planning_c = $rawData->tax_planning_c;
		$twitter_c = $rawData->twitter_c;
		$type_c = $rawData->type_c;
		$unique_customer_code_c = $rawData->unique_customer_code_c;
		$location_through_ip_c = $rawData->location_through_ip_c;
		$dnc_status_c = $rawData->dnc_status_c;
		$campaign_sub_type_c = $rawData->campaign_sub_type_c;
		$campaign_type_c = $rawData->campaign_type_c;
		$activate_disposition_c = $rawData->activate_disposition_c;
		$user_allocation_date_c = $rawData->user_allocation_date_c;
		$classification_accoun_c = $rawData->classification_accoun_c;
		$gateway_c = $rawData->gateway_c;
		$related_corporate_account_c = $rawData->related_corporate_account_c;
		$related_kiosk_account_c = $rawData->related_kiosk_account_c;
		$user_type_c = $rawData->user_type_c;
		$educational_details_c = $rawData->educational_details_c;
		$product_interest_c = $rawData->product_interest_c;
		$product_sub_type_interest_c = $rawData->product_sub_type_interest_c;
		$opportunity_horizon_c = $rawData->opportunity_horizon_c;
		$investment_behaviour_segment_c = $rawData->investment_behaviour_segment_c;
		$occupational_details_c = $rawData->occupational_details_c;
		$total_employment_years_c = $rawData->total_employment_years_c;
		$financial_goals_c = $rawData->financial_goals_c;
		$exisiting_investments_c = $rawData->exisiting_investments_c;
		$existing_investment_gold_c = $rawData->existing_investment_gold_c;
		$existing_investment_silver_c = $rawData->existing_investment_silver_c;
		$existing_investment_re_c = $rawData->existing_investment_re_c;
		$existing_investments_deposit_c = $rawData->existing_investments_deposit_c;
		$existing_investments_bonds_c = $rawData->existing_investments_bonds_c;
		$life_stage_profiling_c = $rawData->life_stage_profiling_c;
		$family_members_number_c = $rawData->family_members_number_c;
		$structure_of_family_c = $rawData->structure_of_family_c;
        
        if (!isset($lead_id) or empty($lead_id)) {
            $msg = array(
                'Success' => false,
                'Message' => 'Mandatory field(s) are missing'
            );
        } else {
            
            
            $name_value_list = array(
                array(
                    'name' => 'id',
                    'value' => $lead_id
                ), //Required
                (!empty($rawData->first_name) ? array('name' => 'first_name','value' => $first_name) : ''),
				(!empty($rawData->last_name) ? array('name' => 'last_name','value' => $last_name) : ''),
				(!empty($rawData->phone_home) ? array('name' => 'phone_home','value' => $phone_home) : ''),
				(!empty($rawData->phone_mobile) ? array('name' => 'phone_mobile','value' => $phone_mobile) : ''),
				(!empty($rawData->primary_address_street) ? array('name' => 'primary_address_street','value' => $primary_address_street) : ''),
				(!empty($rawData->primary_address_city) ? array('name' => 'primary_address_city','value' => $primary_address_city) : ''),
				(!empty($rawData->primary_address_state) ? array('name' => 'primary_address_state','value' => $primary_address_state) : ''),
				(!empty($rawData->primary_address_postalcode) ? array('name' => 'primary_address_postalcode','value' => $primary_address_postalcode) : ''),
				(!empty($rawData->primary_address_country) ? array('name' => 'primary_address_country','value' => $primary_address_country) : ''),
				(!empty($rawData->alt_address_street) ? array('name' => 'alt_address_street','value' => $alt_address_street) : ''),
				(!empty($rawData->alt_address_city) ? array('name' => 'alt_address_city','value' => $alt_address_city) : ''),
				(!empty($rawData->alt_address_state) ? array('name' => 'alt_address_state','value' => $alt_address_state) : ''),
				(!empty($rawData->alt_address_postalcode) ? array('name' => 'alt_address_postalcode','value' => $alt_address_postalcode) : ''),
				(!empty($rawData->alt_address_country) ? array('name' => 'alt_address_country','value' => $alt_address_country) : ''),
				(!empty($rawData->lead_source) ? array('name' => 'lead_source','value' => $lead_source) : ''),
				(!empty($rawData->birthdate) ? array('name' => 'birthdate','value' => $birthdate) : ''),
				(!empty($rawData->assigned_user_id) ? array('name' => 'assigned_user_id','value' => $assigned_user_id) : ''),

				(!empty($rawData->adoption_percentage_c) ? array('name' => 'adoption_percentage_c','value' => $adoption_percentage_c) : ''),
				(!empty($rawData->age_c) ? array('name' => 'age_c','value' => $age_c) : ''),
				(!empty($rawData->annual_expenses_c) ? array('name' => 'annual_expenses_c','value' => $annual_expenses_c) : ''),
				(!empty($rawData->annual_income_c) ? array('name' => 'annual_income_c','value' => $annual_income_c) : ''),
				(!empty($rawData->best_time_to_speak_to_c) ? array('name' => 'best_time_to_speak_to_c','value' => $best_time_to_speak_to_c) : ''),
				(!empty($rawData->category_c) ? array('name' => 'category_c','value' => $category_c) : ''),
				(!empty($rawData->comments_c) ? array('name' => 'comments_c','value' => $comments_c) : ''),
				(!empty($rawData->courier_request_c) ? array('name' => 'courier_request_c','value' => $courier_request_c) : ''),
				(!empty($rawData->current_company_details_c) ? array('name' => 'current_company_details_c','value' => $current_company_details_c) : ''),
				(!empty($rawData->exisiting_term_insurance_pre_c) ? array('name' => 'exisiting_term_insurance_pre_c','value' => $exisiting_term_insurance_pre_c) : ''),
				(!empty($rawData->exisiting_term_insurance_sum_c) ? array('name' => 'exisiting_term_insurance_sum_c','value' => $exisiting_term_insurance_sum_c) : ''),
				(!empty($rawData->exisitng_mi_premium_c) ? array('name' => 'exisitng_mi_premium_c','value' => $exisitng_mi_premium_c) : ''),
				(!empty($rawData->existing_hi_premium_c) ? array('name' => 'existing_hi_premium_c','value' => $existing_hi_premium_c) : ''),
				(!empty($rawData->existing_hi_sum_insured_c) ? array('name' => 'existing_hi_sum_insured_c','value' => $existing_hi_sum_insured_c) : ''),
				(!empty($rawData->existing_insurance_c) ? array('name' => 'existing_insurance_c','value' => $existing_insurance_c) : ''),
				(!empty($rawData->existing_mi_sum_insured_c) ? array('name' => 'existing_mi_sum_insured_c','value' => $existing_mi_sum_insured_c) : ''),
				(!empty($rawData->expenses_details_c) ? array('name' => 'expenses_details_c','value' => $expenses_details_c) : ''),
				(!empty($rawData->facebook_id_c) ? array('name' => 'facebook_id_c','value' => $facebook_id_c) : ''),
				(!empty($rawData->first_transaction_date_c) ? array('name' => 'first_transaction_date_c','value' => $first_transaction_date_c) : ''),
				(!empty($rawData->gender_c) ? array('name' => 'gender_c','value' => $gender_c) : ''),
				(!empty($rawData->historical_session_data_c) ? array('name' => 'historical_session_data_c','value' => $historical_session_data_c) : ''),
				(!empty($rawData->investment_in_80c_c) ? array('name' => 'investment_in_80c_c','value' => $investment_in_80c_c) : ''),
				(!empty($rawData->investment_in_80d_c) ? array('name' => 'investment_in_80d_c','value' => $investment_in_80d_c) : ''),
				(!empty($rawData->loan_type_c) ? array('name' => 'loan_type_c','value' => $loan_type_c) : ''),
				(!empty($rawData->monthly_expense_details_c) ? array('name' => 'monthly_expense_details_c','value' => $monthly_expense_details_c) : ''),
				(!empty($rawData->monthly_income_details_c) ? array('name' => 'monthly_income_details_c','value' => $monthly_income_details_c) : ''),
				(!empty($rawData->online_activity_status_c) ? array('name' => 'online_activity_status_c','value' => $online_activity_status_c) : ''),
				(!empty($rawData->opportunity_value_c) ? array('name' => 'opportunity_value_c','value' => $opportunity_value_c) : ''),
				(!empty($rawData->partner_status_c) ? array('name' => 'partner_status_c','value' => $partner_status_c) : ''),
				(!empty($rawData->payment_type_c) ? array('name' => 'payment_type_c','value' => $payment_type_c) : ''),
				(!empty($rawData->posted_message_id_c) ? array('name' => 'posted_message_id_c','value' => $posted_message_id_c) : ''),
				(!empty($rawData->post_from_id_c) ? array('name' => 'post_from_id_c','value' => $post_from_id_c) : ''),
				(!empty($rawData->prior_invesment_value_c) ? array('name' => 'prior_invesment_value_c','value' => $prior_invesment_value_c) : ''),
				(!empty($rawData->risk_profiling_questions_c) ? array('name' => 'risk_profiling_questions_c','value' => $risk_profiling_questions_c) : ''),
				(!empty($rawData->saving_potential_c) ? array('name' => 'saving_potential_c','value' => $saving_potential_c) : ''),
				(!empty($rawData->tax_planning_c) ? array('name' => 'tax_planning_c','value' => $tax_planning_c) : ''),
				(!empty($rawData->twitter_c) ? array('name' => 'twitter_c','value' => $twitter_c) : ''),
				(!empty($rawData->type_c) ? array('name' => 'type_c','value' => $type_c) : ''),
				(!empty($rawData->unique_customer_code_c) ? array('name' => 'unique_customer_code_c','value' => $unique_customer_code_c) : ''),
				(!empty($rawData->sales_person_tagging_c) ? array('name' => 'sales_person_tagging_c','value' => $sales_person_tagging_c) : ''),
				(!empty($rawData->location_through_ip_c) ? array('name' => 'location_through_ip_c','value' => $location_through_ip_c) : ''),
				(!empty($rawData->dnc_status_c) ? array('name' => 'dnc_status_c','value' => $dnc_status_c) : ''),
				(!empty($rawData->disposition_c) ? array('name' => 'disposition_c','value' => $disposition_c) : ''),
				(!empty($rawData->campaign_sub_type_c) ? array('name' => 'campaign_sub_type_c','value' => $campaign_sub_type_c) : ''),
				(!empty($rawData->campaign_type_c) ? array('name' => 'campaign_type_c','value' => $campaign_type_c) : ''),
				(!empty($rawData->activate_disposition_c) ? array('name' => 'activate_disposition_c','value' => $activate_disposition_c) : ''),
				(!empty($rawData->user_allocation_date_c) ? array('name' => 'user_allocation_date_c','value' => $user_allocation_date_c) : ''),
				(!empty($rawData->classification_accoun_c) ? array('name' => 'classification_accoun_c','value' => $classification_accoun_c) : ''),
				(!empty($rawData->gateway_c) ? array('name' => 'gateway_c','value' => $gateway_c) : ''),
				(!empty($rawData->related_corporate_account_c) ? array('name' => 'related_corporate_account_c','value' => $related_corporate_account_c) : ''),
				(!empty($rawData->related_kiosk_account_c) ? array('name' => 'related_kiosk_account_c','value' => $related_kiosk_account_c) : ''),
				(!empty($rawData->user_type_c) ? array('name' => 'user_type_c','value' => $user_type_c) : ''),
				(!empty($rawData->educational_details_c) ? array('name' => 'educational_details_c','value' => $educational_details_c) : ''),
				(!empty($rawData->product_interest_c) ? array('name' => 'product_interest_c','value' => $product_interest_c) : ''),
				(!empty($rawData->product_sub_type_interest_c) ? array('name' => 'product_sub_type_interest_c','value' => $product_sub_type_interest_c) : ''),
				(!empty($rawData->opportunity_horizon_c) ? array('name' => 'opportunity_horizon_c','value' => $opportunity_horizon_c) : ''),
				(!empty($rawData->investment_behaviour_segment_c) ? array('name' => 'investment_behaviour_segment_c','value' => $investment_behaviour_segment_c) : ''),
				(!empty($rawData->occupational_details_c) ? array('name' => 'occupational_details_c','value' => $occupational_details_c) : ''),
				(!empty($rawData->total_employment_years_c) ? array('name' => 'total_employment_years_c','value' => $total_employment_years_c) : ''),
				(!empty($rawData->financial_goals_c) ? array('name' => 'financial_goals_c','value' => $financial_goals_c) : ''),
				(!empty($rawData->exisiting_investments_c) ? array('name' => 'exisiting_investments_c','value' => $exisiting_investments_c) : ''),
				(!empty($rawData->existing_investment_gold_c) ? array('name' => 'existing_investment_gold_c','value' => $existing_investment_gold_c) : ''),
				(!empty($rawData->existing_investment_silver_c) ? array('name' => 'existing_investment_silver_c','value' => $existing_investment_silver_c) : ''),
				(!empty($rawData->existing_investment_re_c) ? array('name' => 'existing_investment_re_c','value' => $existing_investment_re_c) : ''),
				(!empty($rawData->existing_investments_deposit_c) ? array('name' => 'existing_investments_deposit_c','value' => $existing_investments_deposit_c) : ''),
				(!empty($rawData->existing_investments_bonds_c) ? array('name' => 'existing_investments_bonds_c','value' => $existing_investments_bonds_c) : ''),
				(!empty($rawData->life_stage_profiling_c) ? array('name' => 'life_stage_profiling_c','value' => $life_stage_profiling_c) : ''),
				(!empty($rawData->family_members_number_c) ? array('name' => 'family_members_number_c','value' => $family_members_number_c) : ''),
				(!empty($rawData->structure_of_family_c) ? array('name' => 'structure_of_family_c','value' => $structure_of_family_c) : ''),
            );
            
            $id = updaterecord($session_id, 'Contacts', $name_value_list, $url);
            
            $msg = array(
                'Success' => true,
                'Message' => 'User Updated Successfully'
            );
        }
        
    } else if ($module == "Lead" && $action == 'Fetch') {
        
        $status    = $rawData->status; //We are updating only status
        $from_date = $rawData->from_date; //We are updating only status
        $to_date   = $rawData->to_date;
        $user      = $rawData->user; //To assigned the lead to user
        $user_id   = $rawData->user_id; //To assigned the lead to user
        $lead_id   = $rawData->lead_id;
        
        //~ $myfile = fopen("api.txt", "w") or die("Unable to open file!");
        //~ fwrite($myfile, ); 
        //~ fwrite($myfile, $lead_id); 
        //~ fclose($myfile);
        
        if (!empty($from_date)) {
            $from_date = date('Y-m-d H:i:s', strtotime('-5 hours', strtotime($from_date)));
            $from_date = date('Y-m-d H:i:s', strtotime('-30 minutes', strtotime($from_date)));
            $from_date = "AND leads.date_entered >= '$from_date'";
        } else {
            $from_date = '';
        }
        
        $to_date = $rawData->to_date;
        
        if (!empty($to_date)) {
            $to_date = date('Y-m-d H:i:s', strtotime('-5 hours', strtotime($to_date)));
            $to_date = date('Y-m-d H:i:s', strtotime('-30 minutes', strtotime($to_date)));
            $to_date = "AND leads.date_entered <= '$to_date'";
        } else {
            $to_date = '';
        }
        
        if (!isset($status) or empty($status)) {
            $status = '';
        } else {
            $status = "AND leads.status = '$status'";
        }
        
        if (empty($user_id) && empty($user) && empty($lead_id)) {
            $msg = array(
                'Success' => 0,
                'Message' => 'Mandatory field(s) are missing'
            );
        } else {
            //Get user id based on requested user name for assigned user 
            if (empty($user_id) && !empty($user))
                $user_id = getUserId($session_id, 'Users', $user, $url);
            
            $leads_list = getLeads($session_id, 'Leads', $status, $user_id, $from_date, $to_date, $url, $lead_id);
            $msg        = array(
                'Success' => true,
                'Message' => 'Leads records',
                'Leads' => $leads_list
            );
            
        }
    }
    
} else {
    $msg = array(
        'Success' => false,
        'Message' => 'Oops! Something went wrong'
    );
}
echo json_encode($msg);
exit;

//function to make cURL request
function call($method, $parameters, $url) {
    
    ob_start();
    $curl_request = curl_init();
    
    curl_setopt($curl_request, CURLOPT_URL, $url);
    curl_setopt($curl_request, CURLOPT_POST, 1);
    curl_setopt($curl_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($curl_request, CURLOPT_HEADER, 1);
    curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl_request, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_request, CURLOPT_FOLLOWLOCATION, 0);
    
    $jsonEncodedData = json_encode($parameters);
    
    $post = array(
        "method" => $method,
        "input_type" => "JSON",
        "response_type" => "JSON",
        "rest_data" => $jsonEncodedData
    );
    
    curl_setopt($curl_request, CURLOPT_POSTFIELDS, $post);
    $result = curl_exec($curl_request);
    curl_close($curl_request);
    
    $result   = explode("\r\n\r\n", $result, 2);
    $response = json_decode($result[1]);
    ob_end_flush();
    
    return $response;
}


function createrecord($session_id, $module, $create_entry_parameters, $url) {
    
    $set_entry_parameters = array(
        //session id
        "session" => $session_id,
        
        "module_name" => $module,
        
        //Record attributes
        "name_value_list" => $create_entry_parameters
    );
    
    $set_entry_result = call("set_entry", $set_entry_parameters, $url);
    
    
    $record_id = $set_entry_result->id;
    return $record_id;
    
}

function updaterecord($session_id, $module, $create_entry_parameters, $url) {
    
    $set_entry_parameters = array(
        //session id
        "session" => $session_id,
        
        "module_name" => $module,
        
        //Record attributes
        "name_value_list" => $create_entry_parameters
    );
    
    $set_entry_result = call("set_entry", $set_entry_parameters, $url);
    $record_id        = $set_entry_result->id;
    //~ $id =$set_entry_result->id;
    //~ $status =$set_entry_result->status;
    //~ $record_id = array('Success'=>true,'Message' => 'Record updated succesfully','Record Id'=>$id,'status'=>$status);
    return $record_id;
    
}

function getLeads($sessionID, $module, $lead_status, $user_id, $from_date, $to_date, $url, $lead_id) {
    
    if (!empty($lead_id)) {
        $query = "leads.id = '$lead_id'";
    } else {
        $query = " leads.assigned_user_id = '$user_id' $lead_status $from_date $to_date";
    }
    $get_entry_list_parameters = array(
        'session' => $sessionID,
        'module_name' => $module,
        'query' => $query,
        'order_by' => "",
        'offset' => 0,
        'select_fields' => array(
            'id',
            'first_name',
            'last_name',
            'phone_mobile',
            'email1',
            'lead_source',
            'date_entered',
            'primary_address_street',
            'primary_address_state',
            'primary_address_city',
            'primary_address_postalcode'
        ),
        'link_name_to_fields_array' => '',
        'deleted' => 0
    );
    
    $result = call("get_entry_list", $get_entry_list_parameters, $url);
    
    $Data  = $result->entry_list;
    $value = array();
    foreach ($Data as $item) {
        $value[] = $item->name_value_list;
    }
    return $value;
}

function generateSession($username, $password, $url) {
    $login_parameters = array(
        "user_auth" => array(
            "user_name" => $username,
            "password" => md5($password),
            "version" => "1"
        ),
        "application_name" => "Rest",
        "name_value_list" => array()
    );
    
    $login_result = call("login", $login_parameters, $url);
    
    //get session id
    $session_id = $login_result->id;
    return $session_id;
}
?>
