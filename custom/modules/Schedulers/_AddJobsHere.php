<?php
/*
 * Author: Noresha Ankani
 * Date Created: 18/03/2016
 * Purpose: Case Escalation
 * 
 */
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
require_once('include/entryPoint.php');
include_once('include/SugarPHPMailer.php');
include_once('include/utils/db_utils.php');
include('custom/include/language/en_us.lang.php');
include('include/language/en_us.lang.php');
date_default_timezone_set('UTC');
//including custom scheduler
array_push($job_strings, 'Case_Escalation');
array_push($job_strings, 'Contact_Creation');
array_push($job_strings, 'Active_Users');
array_push($job_strings, 'GetState');
array_push($job_strings, 'GetCity');
array_push($job_strings, 'GetPincode');
array_push($job_strings, 'ReassignmentData');
array_push($job_strings, 'LeadReassignmentData');
array_push($job_strings, 'ProductReassignmentData');
array_push($job_strings, 'UserProductivity');
array_push($job_strings, 'caseAgeing');
array_push($job_strings, 'setuptimer_escalation');
array_push($job_strings, 'LoginAudit');
array_push($job_strings, 'Goals_Updation');
array_push($job_strings, 'SIP_Details');
array_push($job_strings, 'Adoption_Percentage');
array_push($job_strings, 'EcsMandate_Details');
array_push($job_strings, 'GetOrderDetails');
array_push($job_strings, 'GetNomineeDetails');
array_push($job_strings, 'GetCallBackDetailsForCRM');
array_push($job_strings, 'GetInvestorBankAccountForCRM');
array_push($job_strings, 'GetBudgetForCRM');
array_push($job_strings, 'GetLeadsForCRM');
array_push($job_strings, 'GetTaxSummaryForCRM');
array_push($job_strings, 'GetPaymentFailedForCRM');
array_push($job_strings, 'GetEquityHoldingForCRM');
array_push($job_strings, 'GetCartAbandonmentDetails');
function Contact_Creation()
{
	global $db, $sugar_config;
	$username = $sugar_config["webservice_username"];
	$password = $sugar_config["webservice_password"];
	date_default_timezone_set('UTC');
	/***************log file***************************/
	$schedulerLogFile = '/var/www/html/crm/WebsiteAPILogs/getuserdataforcrm.txt';  
	$schedulerHandle = fopen($schedulerLogFile, 'a');
	$timestamp = date('Y-m-d H:i:s',strtotime('+5 hours +30 minutes', strtotime('now')));
	$status = "CRON Run Successful! - CONTACT CREATION";
	$logMessage = "\n\nScheduler Result at $timestamp :- $status";
	fwrite($schedulerHandle, $logMessage);
	
	/*************curl for getting user data from 3rd party********************/
	$url = $sugar_config['getuserdataforcrm'];
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
	//curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization:Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI',
	curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization:Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI',
											'Content-Type: application/json',
											'Content-Length: ' . strlen($postData)));
	$result = curl_exec($ch);
	curl_close($ch);
	$GetUserDataforCRM = json_decode($result, true);
	$GetUserData = $GetUserDataforCRM['data'];
	$logArray = print_r($GetUserData, true);
    $logMessage = "\n\nScheduler Result at $timestamp :-\n$logArray";
    fwrite($schedulerHandle, $logMessage);
	if (empty($GetUserData)) 
	{
		$today_date= date('Y-m-d H:i:s');
		$id = create_guid();
		$insert_log_query = $db->query("INSERT INTO scrm_user_creation_log (id,name,date_entered,description,deleted)  VALUES ('$id','0 Users','$today_date','Empty Data',0)");
	   $GetUserDataCRMStatus = array(
            'notice' => 'Returned empty data array.'
        );
        $logArray = print_r($GetUserDataCRMStatus, true);
        $logMessage = "\n\nScheduler Result at $timestamp :-\n$logArray";
        fwrite($schedulerHandle, $logMessage);
        return true;
    }
	/******generating sugar session id*********/
	$loginResult = login($username, $password);
	$sessionID = $loginResult->id;
	$module = "Contacts";

$responseData = array();
$i = 0;

	$spamArray = array();
	$spam_userid = '68dfdd01-9d74-660b-4167-5cffb98ada95'; // assigned_user_id of spam user

	foreach($GetUserData as $GetUserSet){
		
		//$responseData = array();
		$spam_gateway = $GetUserSet['gateway'];
		$maritalStatus = $GetUserSet["maritalStatus"];
		$loan_occupation = $GetUserSet["occupation"];
		$loan_dob = $GetUserSet["dob"];
		$loan_income = $GetUserSet["income"];
		$loan_intent = $GetUserSet["intent"];
		$isSpam = $GetUserSet["isSpam"];

		// to maintain log of input params start
		$param_array = array('maritalStatus'=>$maritalStatus,'occupation'=>$loan_occupation,'dob'=>$loan_dob,'income'=>$loan_income,'loan_intent'=>$loan_intent,'isSpam'=>$isSpam);
		fwrite($schedulerHandle,print_r($param_array, true));
		// to maintain log of input params end

		$salutation = $GetUserSet["salutation"];
		$name = $GetUserSet["name"];	
		$emailID = $GetUserSet["emailID"];
		$mobileNumber = $GetUserSet["mobileNumber"];
		$uniqueCustomerCode = $GetUserSet["uniqueCustomerCode"];
		$classificationOfTheAccountForPotential = $GetUserSet["classificationOfTheAccountForPotential"];
		$address = $GetUserSet["address"];
		$city = $GetUserSet["city"];
		$state = $GetUserSet["state"];
		$country = $GetUserSet["country"];
		$pinCode = $GetUserSet["pinCode"];
		$gateway = $GetUserSet["gateway"];
		$campaignType = $GetUserSet["campaignType"];
		$campaignSubType = $GetUserSet["campaignSubType"];
		$relatedCorporateAccount = $GetUserSet["relatedCorporateAccount"];
		$relatedKioskAccount = $GetUserSet["relatedKioskAccount"];
		$userType = $GetUserSet["userType"];
		$adoptionPercentage = $GetUserSet["adoptionPercentage"];
		$userCreationDate = date('Y-m-d H:i:s',strtotime("-5 hours, -30 minutes", strtotime($GetUserSet["userCreationDate"])));
		$publisherID = $GetUserSet["publisherID"];
		$publisherName = $GetUserSet["publisherName"];
		$riskProfile = $GetUserSet["riskProfile"];
		$riskProfileID = $GetUserSet["riskProfileID"];
		$userDemographicID = $GetUserSet["userDemographicID"];
		$linkToParent = $GetUserSet["linkToParent"];
		$campaign = $GetUserSet["campaign"];
		$utmcontent = $GetUserSet["utmcontent"];
		$leadid = $GetUserSet["leadid"];
		$batchID = $GetUserSet["batchID"];
		$qparam = $GetUserSet["qparam"];
		$leadIsFirstTimeInvestor = $GetUserSet["leadIsFirstTimeInvestor"];
		$leadGrossMonthlyIncome = $GetUserSet["leadGrossMonthlyIncome"];
		$leadSourceofIncome = $GetUserSet["leadSourceofIncome"];
		$leadCityName = $GetUserSet["leadCityName"];
		$leadSource = $GetUserSet["leadSource"];
		$leadsPanNo = $GetUserSet["leadsPanNo"];
        $leadsIsInternetBanking = $GetUserSet["leadsIsInternetBanking"];
        $discovered_5nance_via = $GetUserSet["discovered_5nance_via"];
		if(isset($GetUserSet["leadDate"])){
			if($GetUserSet["leadDate"]== '1900-01-01T00:00:00'){
				$leadDate = '0000-00-00 00:00:00';
			}else{
				$leadDate = date('Y-m-d H:i:s',strtotime("-5 hours, -30 minutes", strtotime($GetUserSet["leadDate"])));
			}
		}else if(!isset($GetUserSet["leadDate"])){
			$leadDate = '0000-00-00 00:00:00';
		}
		if(isset($GetUserSet["firstCalledOn"])){
			$FirstCalledOn = date('Y-m-d H:i:s',strtotime("-5 hours, -30 minutes", strtotime($GetUserSet["firstCalledOn"])));
		}else if(!isset($GetUserSet["firstCalledOn"])){
			$FirstCalledOn = '0000-00-00 00:00:00';
		}
		$FirstDisposition = $GetUserSet["firstDisposition"];
		if(isset($GetUserSet["secondCalledOn"])){
			$SecondCalledOn = date('Y-m-d H:i:s',strtotime("-5 hours, -30 minutes", strtotime($GetUserSet["secondCalledOn"])));
		}else if(!isset($GetUserSet["secondCalledOn"])){
			$SecondCalledOn = '0000-00-00 00:00:00';
		}
		$SecondDisposition = $GetUserSet["secondDisposition"];
		if(isset($GetUserSet["thirdCalledOn"])){
			$ThirdCalledOn = date('Y-m-d H:i:s',strtotime("-5 hours, -30 minutes", strtotime($GetUserSet["thirdCalledOn"])));
		}else if(!isset($GetUserSet["thirdCalledOn"])){
			$ThirdCalledOn = '0000-00-00 00:00:00';
		}	
		$ThirdDisposition = $GetUserSet["thirdDisposition"];
		$DateOfValidation = $GetUserSet["dateOfValidation"];
		$Lastadvisor = $GetUserSet["lastadvisor"];
		$Age = $GetUserSet["age"];
		$AgreeToAssignAdvisor = $GetUserSet["agreeToAssignAdvisor"];
		$PrefferedDateToCall = date('Y-m-d',strtotime("-5 hours, -30 minutes", strtotime($GetUserSet["prefferedDateToCall"])));
		$PrefferedTimeToCall = date('H:i:s',strtotime("-5 hours, -30 minutes", strtotime($GetUserSet["prefferedDateToCall"])));
		$Gender = $GetUserSet["gender"];
		$comments = $GetUserSet["comments"];
		$lastDisposition = $GetUserSet["lastDisposition"];
		/**************************Investor Order Details**************************/
		$applicationNo = $GetUserSet["applicationNo"];
		$aadharCardNo = $GetUserSet["aadharCardNo"];
		$panno = $GetUserSet["panno"];
		$investorID = $GetUserSet["investorID"];
		$isMinor = $GetUserSet["isMinor"];
		$iskycCompliance = $GetUserSet["iskycCompliance"];
		$iscvlkraCompliance = $GetUserSet["iscvlkraCompliance"];
		$documentSubmissionCenter = $GetUserSet["documentSubmissionCenter"];
		$productInterest = $GetUserSet["productInterest"];

//		if($productInterest == 'Personal Loan'){
//			$product = 'Loans';
//		}else if($productInterest == 'Mutual Fund'){
//			$product = 'Mutual Funds';
//		}
                  if (!empty($productInterest)) {
            include('custom/include/language/en_us.lang.php');
            foreach ($GLOBALS['app_list_strings']['product_interest_list'] as $pkey => $pinterest) {
                if ($pinterest == 'Mutual Fund') {
                    $pinterest = "Mutual Funds";
                }
                
                if ($productInterest == 'Mutual Funds') {
                    $productInterest = "Mutual Fund";
                }
                
                $product_list_name = "product_sub_type_" . str_replace(" ", "_", $pinterest) . "_list";
                if(!empty($product_list_name)) {
					if (in_array($productInterest, $GLOBALS['app_list_strings'][$product_list_name])) {
						$product = $pinterest;
						break;
					}
				}
            }
        }
		if(isset($GetUserSet["dateofActivation"])){
			$dateofActivation = date('Y-m-d H:i:s',strtotime("-5 hours, -30 minutes", strtotime($GetUserSet["dateofActivation"])));
		}else if(!isset($GetUserSet["dateofActivation"])){
			$dateofActivation = '0000-00-00 00:00:00';
		}
		if(isset($GetUserSet["dateOfRegistration"])){
			if($GetUserSet["dateOfRegistration"]== '0001-01-01T00:00:00'){
				$dateOfRegistration = '0000-00-00 00:00:00';
			}else{
				$dateOfRegistration = date('Y-m-d H:i:s',strtotime("-5 hours, -30 minutes", strtotime($GetUserSet["dateOfRegistration"])));
			}
		}else if(!isset($GetUserSet["dateOfRegistration"])){
			$dateOfRegistration = '0000-00-00 00:00:00';
		}
		
		$lstRiskProfileAllocation = $GetUserSet["lstRiskProfileAllocation"];
		if(!empty($Gender)){
			Switch($Gender){
				case 'M':$Gender='Male';break;
				case 'F': $Gender = 'Female';break;
				default: $Gender='';break;
			}
		}
		if(isset($isMinor)){
			switch($isMinor){
				case 'true':$isMinor='Yes';break;
				case 'false': $isMinor = 'No';break;
				default: $isMinor='No';break;
			}
		}
		if(isset($iskycCompliance)){
			switch($iskycCompliance){
				case 'true':$iskycCompliance='Yes';break;
				case 'false': $iskycCompliance = 'No';break;
				default: $iskycCompliance='No';break;
			}
		}
		if(isset($iscvlkraCompliance)){
			switch($iscvlkraCompliance){
				case 'true':$iscvlkraCompliance='Yes';break;
				case 'false': $iscvlkraCompliance = 'No';break;
				default: $iscvlkraCompliance='No';break;
			}
		}
		if(isset($leadsIsInternetBanking)){
			switch($leadsIsInternetBanking){
				case 'true':$leadsIsInternetBanking='Yes';break;
				case 'false': $leadsIsInternetBanking = 'No';break;
				default: $leadsIsInternetBanking='No';break;
			}
		}
		if(!(empty($name)))
		{
			$name_array = explode(" ", $name);
			$first_name = $name_array[0];
			$middle_name = $name_array[1];
			$last_name	 = $name_array[2];
			if(empty($last_name)){
				$last_name = $middle_name;
				$middle_name = '';
			}
		}
		if(!empty($city))
		{
			$fieldname = "city_c";
			$get_city_code = getdropdown($sessionID,"Contacts",$city,$fieldname);
		}
		if(!empty($state))
		{
			$fieldname = "state_c";
			$get_state_code = getdropdown($sessionID,"Contacts",$state,$fieldname);
		}
		if(!empty($pincode))
		{
			$fieldname = "postalcode_c";
			$get_postal_code = getdropdown($sessionID,"Contacts",$pincode,$fieldname);
		}
		if(!empty($userType))
		{
			$fieldname = "user_type_c";
			$userType = getdropdown($sessionID,"Contacts",$userType,$fieldname);
		}
		if(!empty($gateway))
		{
			$fieldname = "gateway_c";
			
			if(strpos($gateway,'-')!==false){
				$gateway_array = explode("-", $gateway);
				$gateway = $gateway_array[0];
			}
                         
			$gateway = getdropdown($sessionID,"Contacts",$gateway,$fieldname);
                         
                          if($gateway==''){
		
                switch ($GetUserSet["gateway"]) {
                    case '5NANCE.COM': $gateway = '5nance.com';
                        break;
                    case 'CORPORATE': $gateway = 'Corporate Channel'; $relatedCorporateAccount = $GetUserSet["publisherName"];
                        break;
                    case 'CRM-OFFLINE': $gateway = 'Offline Marketing';
                        break;
                    case 'MPOnline': $gateway = 'CSC- M.P Online';
                        break;
                    case 'CRM-CSC': $gateway = 'CSC- Rajasthan emitra';
                        break;
                    case 'CRM-MARKETING': $gateway = 'Digital Marketing';
                        break;
                    case 'CRM-EMITRA': $gateway = 'CSC- Rajasthan emitra';
                        break;
                    case 'EXTERNALBO': $gateway = 'Digital Marketing';
                        break;
                    case 'CRM-CORPORATE SALES': $gateway = 'Corporate Channel'; $relatedCorporateAccount = $GetUserSet["publisherName"];
                       break;
		    case 'ANDROID': $gateway = 'Android APP';
                       break; 
		    case 'IOS': $gateway = 'iOS APP';
                       break; 					   
                    default: $gateway = '';
                        break;
						}
						}
               
//			if($gateway == 'Corporate Channel'){
//				$relatedCorporateAccount = $GetUserSet["publisherName"];
//				//$publisherName = '';
//			}
//                        if($GetUserSet["gateway"] == 'EXTERNALBO'){
//				$gateway = 'Digital Marketing';
//			}
		}
		if($GetUserSet["gateway"] == 'CRM-Marketing'){
				$name_value_list = array(
					(isset($salutation) ? array('name' => 'salutation','value' => $salutation) : ''),
					(isset($first_name) ? array('name' => 'first_name','value' => trim($first_name)) : ''),
					(isset($middle_name) ? array('name' => 'middle_name_c','value' => trim($middle_name)) : ''),
					(isset($last_name) ? array('name' => 'last_name','value' => trim($last_name)) : ''),
					(isset($emailID) ? array('name' => 'email1','value' => $emailID) : ''),
					(isset($mobileNumber) ? array('name' => 'phone_mobile','value' => $mobileNumber) : ''),
					(isset($uniqueCustomerCode) ? array('name' => 'unique_customer_code_c','value' => $uniqueCustomerCode) : ''),
					(isset($address) ? array('name' => 'address_c','value' => $address) : ''),
					(isset($city) ? array('name' => 'city_c','value' => $get_city_code) : ''),
					(isset($state) ? array('name' => 'state_c','value' => $get_state_code) : ''),
					(isset($pinCode) ? array('name' => 'postalcode_c','value' => $get_postal_code) : ''),
					(isset($gateway) ? array('name' => 'gateway_c','value' => 'Digital Marketing') : ''),
					(isset($relatedCorporateAccount) ? array('name' => 'related_corporate_account_c','value' => $relatedCorporateAccount) : ''),
					(isset($relatedKioskAccount) ? array('name' => 'related_kiosk_account_c','value' => $relatedKioskAccount) : ''),
					(isset($userType) ? array('name' => 'user_type_c','value' => $userType) : ''),
					(isset($adoptionPercentage) ? array('name' => 'adoption_percentage_c','value' => $adoptionPercentage) : ''),
					(isset($classificationOfTheAccountForPotential) ? array('name' => 'classification_accoun_c','value' => $classificationOfTheAccountForPotential) : ''),
					(isset($publisherID) ? array('name' => 'publisher_id_c','value' => $publisherID) : ''),
					(isset($publisherName) ? array('name' => 'publisher_name_c','value' => $publisherName) : ''),
					(isset($userCreationDate) ? array('name' => 'date_entered','value' => $userCreationDate) : ''),
					(isset($riskProfile) ? array('name' => 'risk_profiling_questions_c','value' => $riskProfile) : ''),
					
					(isset($DateOfValidation) ? array('name' => 'date_of_validation_c','value' => $DateOfValidation) : ''),
					(isset($Age) ? array('name' => 'age_of_the_user_c','value' => $Age) : ''),
					(isset($PrefferedDateToCall) ? array('name' => 'preferred_date_to_call_c','value' => $PrefferedDateToCall) : ''),
					(isset($PrefferedTimeToCall) ? array('name' => 'preferred_date_to_time_c','value' => $PrefferedTimeToCall) : ''),
					(isset($Gender) ? array('name' => 'gender_c','value' => $Gender) : ''),
								(isset($batchID) ? array('name' => 'batch_id_c','value' => $batchID) : ''),
					(isset($dateOfRegistration) ? array('name' => 'date_of_registration_c','value' => $dateOfRegistration) : ''),
					(isset($isMinor) ? array('name' => 'isminor_c','value' => $isMinor) : ''),
					//(isset($panno) ? array('name' => 'pan_no_c','value' => $panno) : ''),
					(isset($iskycCompliance) ? array('name' => 'kyc_status_c','value' => $iskycCompliance) : ''),
					(isset($iscvlkraCompliance) ? array('name' => 'auto_activation_c','value' => $iscvlkraCompliance) : ''),
					(isset($documentSubmissionCenter) ? array('name' => 'document_submission_center_c','value' => $documentSubmissionCenter) : ''),
					(isset($applicationNo) ? array('name' => 'application_no_c','value' => $applicationNo) : ''),
					(isset($aadharCardNo) ? array('name' => 'aadharcard_no_c','value' => $aadharCardNo) : ''),
					(isset($dateofActivation) ? array('name' => 'dateofactivation_c','value' => $dateofActivation) : ''),
					(isset($qparam) ? array('name' => 'qparam_c','value' => $qparam) : ''),
					(isset($leadIsFirstTimeInvestor) ? array('name' => 'is_1st_time_investor_c','value' => $leadIsFirstTimeInvestor) : ''),
					(isset($discovered_5nance_via) ? array('name' => 'to_kown_about_5nance_c', 'value' => $discovered_5nance_via) : ''),
					(isset($maritalStatus) ? array('name' => 'marital_status_c', 'value' => $maritalStatus) : ''),
           			(isset($loan_occupation) ? array('name' => 'loan_occupation_c', 'value' => $loan_occupation) : ''),
           			(isset($loan_dob) ? array('name' => 'loan_dob_c', 'value' => $loan_dob) : ''),
           			(isset($loan_income) ? array('name' => 'loan_income_c', 'value' => $loan_income) : ''),
           			(isset($loan_intent) ? array('name' => 'loan_intent_c', 'value' => $loan_intent) : ''),
           		);
		}else{
			$name_value_list = array(
					(isset($salutation) ? array('name' => 'salutation','value' => $salutation) : ''),
					(isset($first_name) ? array('name' => 'first_name','value' => trim($first_name)) : ''),
					(isset($middle_name) ? array('name' => 'middle_name_c','value' => trim($middle_name)) : ''),
					(isset($last_name) ? array('name' => 'last_name','value' => trim($last_name)) : ''),
					(isset($emailID) ? array('name' => 'email1','value' => $emailID) : ''),
					(isset($mobileNumber) ? array('name' => 'phone_mobile','value' => $mobileNumber) : ''),
					(isset($uniqueCustomerCode) ? array('name' => 'unique_customer_code_c','value' => $uniqueCustomerCode) : ''),
					(isset($address) ? array('name' => 'address_c','value' => $address) : ''),
					(isset($city) ? array('name' => 'city_c','value' => $get_city_code) : ''),
					(isset($state) ? array('name' => 'state_c','value' => $get_state_code) : ''),
					(isset($pinCode) ? array('name' => 'postalcode_c','value' => $get_postal_code) : ''),
					(isset($gateway) ? array('name' => 'gateway_c','value' => $gateway) : ''),
					(isset($campaignType) ? array('name' => 'campaign_type_c','value' => $campaignType) : ''),
					(isset($campaignSubType) ? array('name' => 'campaign_sub_type_c','value' => $campaignSubType) : ''),
					(isset($relatedCorporateAccount) ? array('name' => 'related_corporate_account_c','value' => $relatedCorporateAccount) : ''),
					(isset($relatedKioskAccount) ? array('name' => 'related_kiosk_account_c','value' => $relatedKioskAccount) : ''),
					(isset($userType) ? array('name' => 'user_type_c','value' => $userType) : ''),
					(isset($adoptionPercentage) ? array('name' => 'adoption_percentage_c','value' => $adoptionPercentage) : ''),
					(isset($classificationOfTheAccountForPotential) ? array('name' => 'classification_accoun_c','value' => $classificationOfTheAccountForPotential) : ''),
					(isset($publisherID) ? array('name' => 'publisher_id_c','value' => $publisherID) : ''),
					(isset($publisherName) ? array('name' => 'publisher_name_c','value' => $publisherName) : ''),
					(isset($userCreationDate) ? array('name' => 'date_entered','value' => $userCreationDate) : ''),
					(isset($riskProfile) ? array('name' => 'risk_profiling_questions_c','value' => $riskProfile) : ''),
					(isset($leadDate) ? array('name' => 'lead_generation_date_c','value' => $leadDate) : ''),
					(isset($FirstCalledOn) ? array('name' => 'date_of_first_call_c','value' => $FirstCalledOn) : '0000-00-00 00:00:00'),
					(isset($FirstDisposition) ? array('name' => 'status_of_first_call_c','value' => $FirstDisposition) : ''),
					(isset($SecondCalledOn) ? array('name' => 'date_of_second_call_c','value' => $SecondCalledOn) : '0000-00-00 00:00:00'),
					(isset($SecondDisposition) ? array('name' => 'status_of_second_call_c','value' => $SecondDisposition) : ''),
					(isset($ThirdCalledOn) ? array('name' => 'date_of_third_call_c','value' => $ThirdCalledOn) : '0000-00-00 00:00:00'),
					(isset($ThirdDisposition) ? array('name' => 'status_of_third_call_c','value' => $ThirdDisposition) : ''),
					(isset($DateOfValidation) ? array('name' => 'date_of_validation_c','value' => $DateOfValidation) : ''),
					(isset($Lastadvisor) ? array('name' => 'validation_exe_assigned_c','value' => $Lastadvisor) : ''),
					(isset($Age) ? array('name' => 'age_of_the_user_c','value' => $Age) : ''),
					(isset($Age) ? array('name' => 'age_c','value' => $Age) : ''),
					(isset($AgreeToAssignAdvisor) ? array('name' => 'agreed_to_assign_c','value' => $AgreeToAssignAdvisor) : ''),
					(isset($PrefferedDateToCall) ? array('name' => 'preferred_date_to_call_c','value' => $PrefferedDateToCall) : ''),
					(isset($PrefferedTimeToCall) ? array('name' => 'preferred_date_to_time_c','value' => $PrefferedTimeToCall) : ''),
					(isset($Gender) ? array('name' => 'gender_c','value' => $Gender) : ''),
					(isset($comments) ? array('name' => 'comments_c','value' => $comments) : ''),
					(isset($lastDisposition) ? array('name' => 'final_disposition_c','value' => $lastDisposition) : ''),
					(isset($batchID) ? array('name' => 'batch_id_c','value' => $batchID) : ''),
					(isset($campaign) ? array('name' => 'campaign_c','value' => $campaign) : ''),
					(isset($utmcontent) ? array('name' => 'utm_content_c','value' => $utmcontent) : ''),
					(isset($leadid) ? array('name' => 'leadid_c','value' => $leadid) : ''),
					(isset($dateOfRegistration) ? array('name' => 'date_of_registration_c','value' => $dateOfRegistration) : ''),
					(isset($isMinor) ? array('name' => 'isminor_c','value' => $isMinor) : ''),
					//(isset($panno) ? array('name' => 'pan_no_c','value' => $panno) : ''),
					(isset($iskycCompliance) ? array('name' => 'kyc_status_c','value' => $iskycCompliance) : ''),
					(isset($iscvlkraCompliance) ? array('name' => 'auto_activation_c','value' => $iscvlkraCompliance) : ''),
					(isset($documentSubmissionCenter) ? array('name' => 'document_submission_center_c','value' => $documentSubmissionCenter) : ''),
					(isset($applicationNo) ? array('name' => 'application_no_c','value' => $applicationNo) : ''),
					(isset($aadharCardNo) ? array('name' => 'aadharcard_no_c','value' => $aadharCardNo) : ''),
					(isset($dateofActivation) ? array('name' => 'dateofactivation_c','value' => $dateofActivation) : ''),
					(isset($qparam) ? array('name' => 'qparam_c','value' => $qparam) : ''),
					(isset($leadIsFirstTimeInvestor) ? array('name' => 'is_1st_time_investor_c','value' => $leadIsFirstTimeInvestor) : ''),
					(isset($leadGrossMonthlyIncome) ? array('name' => 'monthly_income_details_c','value' => $leadGrossMonthlyIncome) : ''),
					(isset($leadSourceofIncome) ? array('name' => 'source_of_income_c','value' => $leadSourceofIncome) : ''),
					(isset($leadCityName) ? array('name' => 'campaign_city_c','value' => $leadCityName) : ''),
					(isset($leadSource) ? array('name' => 'source_c','value' => $leadSource) : ''),
					(isset($discovered_5nance_via) ? array('name' => 'to_kown_about_5nance_c', 'value' => $discovered_5nance_via) : ''),
           			(isset($leadsPanNo) ? array('name' => 'pan_no_c', 'value' => $leadsPanNo) : ''),
           			(isset($leadsIsInternetBanking) ? array('name' => 'do_you_have_internet_banking_c', 'value' => $leadsIsInternetBanking) : ''),
           			(isset($productInterest) ? array('name' => 'product_sub_type_interest_c', 'value' => $productInterest) : ''),
           			(!empty($product) ? array('name' => 'product_interest_c', 'value' => $product) : ''),
           			(isset($maritalStatus) ? array('name' => 'marital_status_c', 'value' => $maritalStatus) : ''),
           			(isset($loan_occupation) ? array('name' => 'loan_occupation_c', 'value' => $loan_occupation) : ''),
           			(isset($loan_dob) ? array('name' => 'loan_dob_c', 'value' => $loan_dob) : ''),
           			(isset($loan_income) ? array('name' => 'loan_income_c', 'value' => $loan_income) : ''),
           			(isset($loan_intent) ? array('name' => 'loan_intent_c', 'value' => $loan_intent) : ''),
				);

		}
				/*************************check unique code exists or not******************************/
				if(!empty($uniqueCustomerCode))
				{
					$get_unique_code_query = $db->query("select id,date_modified,modified_user_id from contacts join contacts_cstm where id=id_c and deleted=0 and unique_customer_code_c = '$uniqueCustomerCode'");
					if($get_unique_code_query->num_rows == 0)
					{
						$name_value_list[] = array('name' => 'disposition_c','value' => '');
						$module1 = 'Contacts';
	            		$insert_customer_code = $db->query("INSERT INTO customer_code (customer_code) VALUES ('" . $uniqueCustomerCode . "')");
              
                		$select_customer_code = $db->query("select customer_code from customer_code where customer_code = '" . $uniqueCustomerCode . "'");
               
                		$status = "Inside 1st condition Inserted! - $insert_customer_code - Total Records : $select_customer_code->num_rows";
						$logMessage = "\n\nScheduler Result at $timestamp :- $status";
						fwrite($schedulerHandle, $logMessage);
                		if ($select_customer_code->num_rows == 1) 
                		{
							$user_creation = create_user($sessionID,"Contacts",$name_value_list);
							$user_creation_object = $user_creation->entry_list;
							if(isset($user_creation_object->unique_customer_code_c->value))
							{
								$created_user="Function Worked Successfully, Response Array : ".print_r($user_creation,true);
							}
							else
							{
								$created_user="Function Doesn't Worked Successfully, Response Array : ".print_r($user_creation,true);
							}
							$status = "User Created Successfully! - $name - $created_user";
							$logMessage = "\n\nScheduler Result at $timestamp :- $status";
							fwrite($schedulerHandle, $logMessage);
						}
						$user_creation_object = $user_creation->entry_list;
						$user_creation_id = $user_creation->id;
						
						if($isSpam == true)
						{			
							$spamArray[] = $user_creation_id;
						}
					}
					else
					{
						$row_unique_code = $db->fetchByAssoc($get_unique_code_query);
						$name_value_list[] = array('name' => 'id','value' => $row_unique_code['id']);
						$name_value_list[] = array('name' => 'date_modified','value' => $row_unique_code['date_modified']);
						$name_value_list[] = array('name' => 'modified_user_id','value' => $row_unique_code['modified_user_id']);
						$name_value_list[] = array('name' => 'update_date_modified','value' => 0);
						$name_value_list[] = array('name' => 'update_modified_by','value' => 0);
						
						// $GLOBALS['log']->fatal(print_r($name_value_list,true)."array name value list");
						$user_creation = create_user($sessionID,"Contacts",$name_value_list);
						$user_creation_object = $user_creation->entry_list;
						$status = "User Updated Successfully! - $name";
						$logMessage = "\n\nScheduler Result at $timestamp :- $status";
						fwrite($schedulerHandle, $logMessage);
					}
					$user_creation_object = $user_creation->entry_list;
					$user_creation_id = $user_creation->id;
					if($isSpam == true)
					{			
						$spamArray[] = $user_creation_id;
					}
				}
				else{
				}
				/**********************risk profiling***************************/
				if(isset($lstRiskProfileAllocation)){
						$status = "Risk Profile allocation! - ".print_r($lstRiskProfileAllocation,true);
						$logMessage = "\n\nScheduler Result at $timestamp :- $status";
						fwrite($schedulerHandle, $logMessage);
					foreach($lstRiskProfileAllocation as $Riskallocation){
						$status = "Risk Profile allocation ID! - ".$Riskallocation["riskProfileID"];
						$logMessage = "\n\nScheduler Result at $timestamp :- $status";
						fwrite($schedulerHandle, $logMessage);
							/*********************Risk Profiling******************************************/
							$riskProfileID=$Riskallocation["riskProfileID"];
							$fromInvestmentPeriod=$Riskallocation["fromInvestmentPeriod"];
							$toInvestmentPeriod=$Riskallocation["toInvestmentPeriod"];
							$fromInvestmentPeriodInMonth=$Riskallocation["fromInvestmentPeriodInMonth"];
							$toInvestmentPeriodInMonth=$Riskallocation["toInvestmentPeriodInMonth"];
							$investmentName=$Riskallocation["investmentName"];
							$allocation=$Riskallocation["allocation"];
							$isMainForProfile=$Riskallocation["isMainForProfile"];
							$advisoryModuleID=$Riskallocation["advisoryModuleID"];
							$minAmount=$Riskallocation["minAmount"];
							$maxAmount=$Riskallocation["maxAmount"];
							$portfolioID=$Riskallocation["portfolioID"];
							$poid=$Riskallocation["poid"];
							$amountPortfolioFilterID=$Riskallocation["amountPortfolioFilterID"];
							$tenurePortfolioFilterID=$Riskallocation["tenurePortfolioFilterID"];
							$hideWeightage=$Riskallocation["hideWeightage"];
							$isActive=$Riskallocation["isActive"];
							$entryTimeStamp=$Riskallocation["entryTimeStamp"];
							$entryTimeStamp = date('Y-m-d H:i:s',strtotime("-5 hours, -30 minutes", strtotime($entryTimeStamp))); 
							$projectTypeID=$Riskallocation["projectTypeID"];
							$id=$Riskallocation["id"];
							
							/*******************************end risk profile*****************************/
										/*********************subpanel risk profiling*******************************/
							$name_value_list_riskprofile = array(
								(isset($riskProfileID) ? Array('name' =>'riskprofileid_c','value'=>$riskProfileID) : ''),
								(isset($fromInvestmentPeriod) ? Array('name' =>' frominvestmentperiod_c','value'=>$fromInvestmentPeriod) : ''),
								(isset($toInvestmentPeriod) ? Array('name' =>'toinvestmentperiod_c','value'=>$toInvestmentPeriod) : ''),
								(isset($fromInvestmentPeriodInMonth) ? Array('name' =>'frominvestmentperiodinmonth_c','value'=>$fromInvestmentPeriodInMonth) : ''),
								(isset($toInvestmentPeriodInMonth) ? Array('name' =>'toinvestmentperiodinmonth_c','value'=>$toInvestmentPeriodInMonth) : ''),
								(isset($investmentName) ? Array('name' =>'investment_name_c','value'=>$investmentName) : ''),
								(isset($allocation) ? Array('name' =>'allocation_c','value'=>$allocation) : ''),
								(isset($isMainForProfile) ? Array('name' =>'ismainforprofile_c','value'=>$isMainForProfile) : ''),
								(isset($advisoryModuleID) ? Array('name' =>'advisorymoduleid_c','value'=>$advisoryModuleID) : ''),
								(isset($minAmount) ? Array('name' =>'minamount_c','value'=>$minAmount) : ''),
								(isset($maxAmount) ? Array('name' =>'maxamount_c','value'=>$maxAmount) : ''),
								(isset($portfolioID) ? Array('name' =>'portfolioid_c','value'=>$portfolioID) : ''),
								(isset($poid) ? Array('name' =>'poid_c','value'=>$poid) : ''),
								(isset($amountPortfolioFilterID) ? Array('name' =>'amountportfoliofilterid_c','value'=>$amountPortfolioFilterID) : ''),
								(isset($tenurePortfolioFilterID) ? Array('name' =>'tenureportfoliofilterid_c','value'=>$tenurePortfolioFilterID) : ''),
								(isset($hideWeightage) ? Array('name' =>'hideweightage_c','value'=>$hideWeightage) : ''),
								(isset($isActive) ? Array('name' =>'isactive_c','value'=>$isActive) : ''),
								(isset($entryTimeStamp) ? Array('name' =>'date_entered','value'=>$entryTimeStamp) : ''),
								(isset($entryTimeStamp) ? Array('name' =>'date_modified','value'=>$entryTimeStamp) : ''),
								(isset($projectTypeID) ? Array('name' =>'projecttypeid_c','value'=>$projectTypeID) : ''),
								(isset($id) ? Array('name' =>'id_profiling_c','value'=>$id) : ''),

							);
							/*******************duplicate check*********************/
							$get_unique_profile_query = $db->query("select scrm_risk_profile.id from scrm_risk_profile join scrm_risk_profile_cstm on scrm_risk_profile.id=scrm_risk_profile_cstm.id_c join contacts_scrm_risk_profile_1_c on contacts_scrm_risk_profile_1_c.contacts_scrm_risk_profile_1scrm_risk_profile_idb=scrm_risk_profile.id join contacts on contacts.id=contacts_scrm_risk_profile_1_c.contacts_scrm_risk_profile_1contacts_ida join contacts_cstm on contacts_cstm.id_c=contacts.id where scrm_risk_profile.deleted=0 and contacts.deleted=0 and contacts_scrm_risk_profile_1_c.deleted=0 and contacts_cstm.unique_customer_code_c = '$uniqueCustomerCode' and scrm_risk_profile_cstm.id_profiling_c='$id'");
							if($get_unique_profile_query->num_rows == 0){
								//echo 'hi';exit;
								$module = 'scrm_Risk_Profile';
								$status = "Risk Profile Array! - ".print_r($name_value_list_riskprofile,true);
								$logMessage = "\n\nScheduler Result at $timestamp :- $status";
								fwrite($schedulerHandle, $logMessage);
								$profile_allocation = create_user($sessionID,"scrm_Risk_Profile",$name_value_list_riskprofile);
								$profile_allocation_id = $profile_allocation->id;
								
								$status = "Risk Profile created Successfully! - ".$uniquecustomercode - $profile_allocation_id;
								$logMessage = "\n\nScheduler Result at $timestamp :- $status";
								fwrite($schedulerHandle, $logMessage);
								/**********Establish relationship***************/
								$linkname = 'contacts_scrm_risk_profile_1';
								$module = 'Contacts';
								$establish_relationship = establish_relationship($sessionID,"Contacts",$linkname,$profile_allocation_id,$user_creation_id);
								$status = "Risk Profile created relationship! - ".print_r($establish_relationship,true);
								$logMessage = "\n\nScheduler Result at $timestamp :- $status";
								fwrite($schedulerHandle, $logMessage);
							}else{
								$row_unique_profile_id = $db->fetchByAssoc($get_unique_profile_query);
								$name_value_list_riskprofile[] = array('name' => 'id','value' => $row_unique_profile_id['id']);												
								$module = 'scrm_Risk_Profile';
								$update_profile_allocation = create_user($sessionID,"scrm_Risk_Profile",$name_value_list_riskprofile);
								$status = "Risk Profile Updated Successfully! - ".$user_creation_id;
								$logMessage = "\n\nScheduler Result at $timestamp :- $status";
								fwrite($schedulerHandle, $logMessage);
							}
							
						}	
				}		
				if(isset($user_creation_object->id->value)){
				//~ $responseData[0]['batchID'] = $batchID;
				//~ $responseData[0]['uniqueCustomerCode'] = $uniqueCustomerCode;
				//~ $responseData[0]['UpdateType'] = '1';
				//~ $responseData[0]['uniqueID'] = '0';
				
				$responseData[$i]['batchID'] = $batchID;
				$responseData[$i]['uniqueCustomerCode'] = $uniqueCustomerCode;
				$responseData[$i]['UpdateType'] = '1';
				$responseData[$i]['uniqueID'] = '0';
				$i++; 
				
				//send_response_data($responseData);
			}
					
					
	}

	if(!empty($spamArray)){
		$spamArray = array_filter(array_unique($spamArray));
		$implode = "('".implode("','",$spamArray)."')";		
		$query = "UPDATE contacts 
			INNER JOIN contacts_cstm AS cstm ON cstm.id_c = contacts.id 
			SET contacts.assigned_user_id = '$spam_userid', cstm.is_spam_c =  '1' 
			WHERE contacts.deleted=0 and cstm.id_c IN $implode AND cstm.sales_stage_c !=  'Interested_Customer' AND cstm.sales_stage_c !=  'Opportunity' AND cstm.sales_stage_c != 'Customer'";
		$update_contacts = $db->query($query);
	}
	
	send_response_data($responseData);
	//$GLOBALS['log']->fatal("response data".print_r($responseData,true));
	$id = create_guid();
foreach($responseData as $responseSet){
	$user_code  .= $responseSet["uniqueCustomerCode"].',';
	$batchID = $responseSet["batchID"];
}
$today_date= date('Y-m-d H:i:s');
$user_code = substr($user_code,0,-1);
$insert_log_query = $db->query("INSERT INTO scrm_user_creation_log (id,name,date_entered,description,deleted)  VALUES ('$id','".sizeof($responseData)." Users','$today_date','Customer Codes - $user_code',0)");
$insert_custom_query = $db->query("INSERT INTO scrm_user_creation_log_cstm (id_c,batch_id_c)  VALUES ('$id','$batchID')");
	//$GLOBALS['log']->fatal("response data insert query ".$insert_log_query);
	return true;
}
/************************************Goals Updation****************************************/
function Goals_Updation()
{

	global $db, $sugar_config;
	$username = $sugar_config["webservice_username"];
	$password = $sugar_config["webservice_password"];	

	/***************log file***************************/
	$schedulerLogFile = '/var/www/html/crm/WebsiteAPILogs/getgoalslistdetails.txt';  
	$schedulerHandle = fopen($schedulerLogFile, 'a');
	$timestamp = date('Y-m-d H:i:s',strtotime('+5 hours +30 minutes', strtotime('now')));
	$status = "CRON Run Successful! - CONTACT CREATION";
	$logMessage = "\n\nScheduler Result at $timestamp :- $status";
	fwrite($schedulerHandle, $logMessage);
	/*************curl for getting goals data from 3rd party********************/
	$url = $sugar_config['getgoalslistdetails'];
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization:Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI',
											'Content-Type: application/json',
											'Content-Length: ' . strlen($postData)));
	$result = curl_exec($ch);
	curl_close($ch);
	$GetUserDataforCRM = json_decode($result, true);
	$GetUserData_Goals = $GetUserDataforCRM['data'];
	//echo '<pre>';print_r($GetUserData_Goals);exit;
	/******generating sugar session id*********/
	$loginResult = login($username, $password);
	$sessionID = $loginResult->id;
	$responseData  = array();
	$i=0;
	foreach($GetUserData_Goals as $GoalsSet){	
				$batchID = $GoalsSet["batchID"];
				$goalID = $GoalsSet["goalID"];
				$uniqueCustomerCode = $GoalsSet["uniqueCustomerCode"];
				$goalPlannedby = $GoalsSet["goalPlannedby"];
				$goalName = $GoalsSet["goalName"];
				$goalStartDate = $GoalsSet["goalStartDate"];
				$goalStartDate = date('Y-m-d', strtotime($goalStartDate));	
				$goalTargetDate = $GoalsSet["goalTargetDate"];
				$goalTargetDate = date('Y-m-d', strtotime($goalTargetDate));	
				$goalCurrentValue = $GoalsSet["goalCurrentValue"];
				$goalFutureValue = $GoalsSet["goalFutureValue"];
				$monthlyInvestmentRequired = $GoalsSet["monthlyInvestmentRequired"];
				$goalStatus = $GoalsSet["goalStatus"];
				$goalDurationInMonths = $GoalsSet["goalDurationInMonths"];
				$yearlyInvestmentRequired = $GoalsSet["yearlyInvestmentRequired"];
				$oneTimeInvestmentRequired = $GoalsSet["oneTimeInvestmentRequired"];		
				$goals_list = array(
					(isset($batchID)?Array('name'=>"batchid",'value'=>$batchID):''),
					(isset($goalID)?Array('name'=>"goalid",'value'=>$goalID):''),
					(isset($uniqueCustomerCode)?Array('name'=>"uniquecustomercode",'value'=>$uniqueCustomerCode):''),
					(isset($goalPlannedby)?Array('name'=>"goalplannedby",'value'=>$goalPlannedby):''),
					(isset($goalName)?Array('name'=>"goalname",'value'=>$goalName):''),
					(isset($goalStartDate)?Array('name'=>"goalstartdate",'value'=>$goalStartDate):''),
					(isset($goalTargetDate)?Array('name'=>"goaltargetdate",'value'=>$goalTargetDate):''),
					(isset($goalCurrentValue)?Array('name'=>"goalcurrentvalue",'value'=>$goalCurrentValue):''),
					(isset($goalFutureValue)?Array('name'=>"goalfuturevalue",'value'=>$goalFutureValue):''),
					(isset($monthlyInvestmentRequired)?Array('name'=>"monthly_investment_required_c",'value'=>$monthlyInvestmentRequired):''),
					(isset($goalStatus)?Array('name'=>"goalstatus",'value'=>$goalStatus):''),
					(isset($goalDurationInMonths)?Array('name'=>"goaldurationinmonths",'value'=>$goalDurationInMonths):''),
					(isset($yearlyInvestmentRequired)?Array('name'=>"yearlyinvestmentrequired",'value'=>$yearlyInvestmentRequired):''),
					(isset($oneTimeInvestmentRequired)?Array('name'=>"onetimeinvestmentrequired",'value'=>$oneTimeInvestmentRequired):''),
				);
				/****************fetch contact id using customer code******************************/
				$get_unique_code_query = $db->query("select id from contacts join contacts_cstm where id=id_c and deleted=0 and unique_customer_code_c = '$uniqueCustomerCode'");
				if($get_unique_code_query->num_rows > 0 ){
					echo $uniqueCustomerCode."<br/>";
					$row_customer_id = $db->fetchByAssoc($get_unique_code_query);
					$customer_id = $row_customer_id['id'];
					/*******************duplicate check*********************/
					$get_goals_query = $db->query("select scrm_goals.id from scrm_goals join contacts_scrm_goals_1_c on contacts_scrm_goals_1_c.contacts_scrm_goals_1scrm_goals_idb=scrm_goals.id join contacts on contacts.id=contacts_scrm_goals_1_c.contacts_scrm_goals_1contacts_ida join contacts_cstm on contacts_cstm.id_c=contacts.id where scrm_goals.deleted=0 and contacts.deleted=0 and contacts_scrm_goals_1_c.deleted=0 and contacts_cstm.unique_customer_code_c = '$uniqueCustomerCode' and scrm_goals.goalid='$goalID'");
					if($get_goals_query->num_rows == 0){			
						$module = 'scrm_Goals';
						$goals_list = create_user($sessionID,$module,$goals_list);
						$goal_id = $goals_list->id;
						$status = "Goal Updated!".$customer_id;
						$logMessage = "\n\nScheduler Result at $timestamp :- $status";
						fwrite($schedulerHandle, $logMessage);
						/**********Establish relationship***************/
						$linkname = 'contacts_scrm_goals_1';
						$module = 'Contacts';
						$establish_relationship = establish_relationship($sessionID,$module,$linkname,$goal_id,$customer_id);	
					}else{
						$row_goals_id = $db->fetchByAssoc($get_goals_query);
						$module = 'scrm_Goals';
						$goals_list[] = array('name' => 'id','value' => $row_goals_id['id']);
						$user_creation = create_user($sessionID,$module,$goals_list);
					}		
				$responseData[$i]['batchID'] = $batchID;
				$responseData[$i]['uniqueCustomerCode'] = $uniqueCustomerCode;
				$responseData[$i]['UpdateType'] = '2';
				$responseData[$i]['uniqueID'] = $goalID;			
				$i++;	
				//exit;	
				}
				
			}
				send_response_data($responseData);	
			
	
	return true;
}	
/************************************Goals Updation-END****************************************/
/************************************SIP****************************************/
function SIP_Details(){
	global $db, $sugar_config;
	$username = $sugar_config["webservice_username"];
	$password = $sugar_config["webservice_password"];
	/***************log file***************************/
	$schedulerLogFile = '/var/www/html/crm/WebsiteAPILogs/getsipsetupforcrm.txt';  
	$schedulerHandle = fopen($schedulerLogFile, 'a');
	$timestamp = date('Y-m-d H:i:s',strtotime('+5 hours +30 minutes', strtotime('now')));
	$status = "CRON Run Successful! - SIP Details";
	$logMessage = "\n\nScheduler Result at $timestamp :- $status";
	fwrite($schedulerHandle, $logMessage);
	
	/*************curl for getting goals data from 3rd party********************/
	$url = $sugar_config['getsipsetupforcrm'];
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization:Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI',
											'Content-Type: application/json',
											'Content-Length: ' . strlen($postData)));
	$result = curl_exec($ch);
	curl_close($ch);
	$GetUserDataforCRM = json_decode($result, true);
	$GetUserData_SIP = $GetUserDataforCRM['data'];
	// echo '<pre>';print_r($GetUserData_SIP);exit;
	/******generating sugar session id*********/
	$loginResult = login($username, $password);
	$sessionID = $loginResult->id;
	$i=0;
	$responseData = array();
	/****************get sip data from api********************/
	$api_sip_wishlistid = array();
	foreach($GetUserData_SIP as $sipdetails){
		/************check wishlist id is there in CRM***************************/
		$api_sip_wishlistid[] = $sipdetails["wishListID"];
	}
	/**********get sip data from crm**************************/
	$crm_sip_wishlistid = array();
	$fetch_sip_data = "select wishlistid from scrm_sip where deleted=0";
	$result_sip_data = $db->query($fetch_sip_data);
	while($row_sip_data = $db->fetchByAssoc($result_sip_data)){
		$crm_sip_wishlistid[] = $row_sip_data['wishlistid'];
	}
	$sip_difference_result=diff_recursive($crm_sip_wishlistid, $api_sip_wishlistid);
	$status = "SIP Result Array Difference -".print_r($sip_difference_result,true);
	$logMessage = "\n\nScheduler Result at $timestamp :- $status";
	fwrite($schedulerHandle, $logMessage);
	
	foreach($sip_difference_result as $key=>$value)
	{
		$delete_sip_crm = $db->query("Delete from scrm_sip where wishlistid='$value'");
		$status = "CRON Run Successful! - SIP Details NOT FOUND".$value;
		$logMessage = "\n\nScheduler Result at $timestamp :- $status";
		 fwrite($schedulerHandle, $logMessage);
	}

	foreach($GetUserData_SIP as $sipdetails){
		
			$batchID = $sipdetails["batchID"];
			$wishListID = $sipdetails["wishListID"];
			$uniqueCustomerCode = $sipdetails["uniqueCustomerCode"];
			$firstInvestorName = $sipdetails["firstInvestorName"];
			$email = $sipdetails["email"];
			$cycleDate = $sipdetails["cycleDate"];
			$frequency = $sipdetails["frequency"];
			$startDate = $sipdetails["startDate"];
			$startDate = date('Y-m-d', strtotime($startDate));	
			$endDate = $sipdetails["endDate"];
			$endDate = date('Y-m-d', strtotime($endDate));	
			$schemeCode = $sipdetails["schemeCode"];
			$schemeName = $sipdetails["schemeName"];
			$folioNumber = $sipdetails["folioNumber"];
			$amount = $sipdetails["amount"];
		
		$sip_list = array(
			(isset($batchID) ? Array('name' => "batchid",'value'=>$batchID) : ''),
			(isset($wishListID) ? Array('name' => "wishlistid",'value'=>$wishListID) : ''),
			(isset($uniqueCustomerCode) ? Array('name' => "uniquecustomercode",'value'=>$uniqueCustomerCode) : ''),
			(isset($firstInvestorName) ? Array('name' => "firstinvestorname",'value'=>$firstInvestorName) : ''),
			(isset($email) ? Array('name' => "email",'value'=>$email) : ''),
			(isset($cycleDate) ? Array('name' => "cycledate",'value'=>$cycleDate) : ''),
			(isset($frequency) ? Array('name' => "frequency",'value'=>$frequency) : ''),
			(isset($startDate) ? Array('name' => "startdate",'value'=>$startDate) : ''),
			(isset($endDate) ? Array('name' => "enddate",'value'=>$endDate) : ''),
			(isset($schemeCode) ? Array('name' => "schemecode",'value'=>$schemeCode) : ''),
			(isset($schemeName) ? Array('name' => "schemename",'value'=>$schemeName) : ''),
			(isset($folioNumber) ? Array('name' => "folionumber",'value'=>$folioNumber) : ''),
			(isset($amount) ? Array('name' => "amount",'value'=>$amount) : ''),


		);
		/****************fetch contact id using customer code******************************/
		$get_unique_code_query = $db->query("select id from contacts join contacts_cstm where id=id_c and deleted=0 and unique_customer_code_c = '$uniqueCustomerCode'");
		
		if($get_unique_code_query->num_rows > 0 ){
				
				$row_customer_id = $db->fetchByAssoc($get_unique_code_query);
				$customer_id = $row_customer_id['id'];
				/*******************duplicate check*********************/
				$get_sip_query = $db->query("select scrm_sip.id from scrm_sip join contacts_scrm_sip_1_c on contacts_scrm_sip_1_c.contacts_scrm_sip_1scrm_sip_idb=scrm_sip.id join contacts on contacts.id=contacts_scrm_sip_1_c.contacts_scrm_sip_1contacts_ida join contacts_cstm on contacts_cstm.id_c=contacts.id where scrm_sip.deleted=0 and contacts.deleted=0 and contacts_scrm_sip_1_c.deleted=0 and contacts_cstm.unique_customer_code_c = '$uniqueCustomerCode' and scrm_sip.wishlistid='$wishListID'");
							$status = "SIP Result Array -".print_r($get_sip_query,true);
							$logMessage = "\n\nScheduler Result at $timestamp :- $status";
							fwrite($schedulerHandle, $logMessage);
						if($get_sip_query->num_rows == 0){			
							$module = 'scrm_SIP';
							$sip_details_list = create_user($sessionID,$module,$sip_list);
							$sip_id = $sip_details_list->id;
							$status = "SIP Created -".$customer_id;
							$logMessage = "\n\nScheduler Result at $timestamp :- $status";
							fwrite($schedulerHandle, $logMessage);


							/**********Establish relationship***************/
							$linkname = 'contacts_scrm_sip_1';
							$module = 'Contacts';
							$establish_relationship = establish_relationship($sessionID,$module,$linkname,$sip_id,$customer_id);	
						}else{

							$row_sip_id = $db->fetchByAssoc($get_sip_query);
							$module = 'scrm_SIP';
							$sip_list[] = array('name' => 'id','value' => $row_sip_id['id']);
							$user_creation = create_user($sessionID,$module,$sip_list);
							$status = "SIP Result Update -$uniqueCustomerCode";
							$logMessage = "\n\nScheduler Result at $timestamp :- $status";
							fwrite($schedulerHandle, $logMessage);
						}		
					$responseData[$i]['batchID'] = $batchID;
					$responseData[$i]['uniqueCustomerCode'] = $uniqueCustomerCode;
					$responseData[$i]['UpdateType'] = '3';
					$responseData[$i]['uniqueID'] = $wishListID;	
				$i++;
			}
	}
	send_response_data($responseData);
	return true;
}
function diff_recursive($array1, $array2) {
							//echo "hi";
	$difference=array();
	foreach($array1 as $key => $value) {
		if(is_array($value) && isset($array2[$key])){ // it's an array and both have the key
			$new_diff = diff_recursive($value, $array2[$key]);
			if( !empty($new_diff) )
				$difference[$key] = $new_diff;
		} else if(is_string($value) && !in_array($value, $array2)) { // the value is a string and it's not in array B
			$difference[$key] = $value;
		} else if(!is_numeric($key) && !array_key_exists($key, $array2)) { // the key is not numberic and is missing from array B
			$difference[$key] = "Missing from the second array";
		}
	}
	return $difference;
}
/************************************SIP-END****************************************/
/************************************Adaption percentage****************************************/
function Adoption_Percentage(){
	global $db, $sugar_config;
	$username = $sugar_config["webservice_username"];
	$password = $sugar_config["webservice_password"];
	
	/*************curl for getting goals data from 3rd party********************/
	$url = $sugar_config['getuseradoptionpercentage'];
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization:Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI',
											'Content-Type: application/json',
											'Content-Length: ' . strlen($postData)));
	$result = curl_exec($ch);
	curl_close($ch);
	$GetUserDataforCRM = json_decode($result, true);
	$GetUserData_adoption = $GetUserDataforCRM['data'];
	//echo '<pre>';print_r($GetUserData_adoption);exit;
	/******generating sugar session id*********/
	$loginResult = login($username, $password);
	$sessionID = $loginResult->id;
	$responseData = array();
	$i = 0;
	foreach($GetUserData_adoption as $adoption){
			$batchID = $adoption["batchID"];
			$uniqueCustomerCode = $adoption["uniqueCustomerCode"];
			$adoptionPercentage = $adoption["adoptionPercentage"];
		$adoption = array(
			(isset($adoptionPercentage) ? Array('name' => "adoption_percentage_c",'value'=>$adoptionPercentage) : ''),

		);
		/****************fetch contact id using customer code******************************/
		$get_unique_code_query = $db->query("select id from contacts join contacts_cstm where id=id_c and deleted=0 and unique_customer_code_c = '$uniqueCustomerCode'");
		if($get_unique_code_query->num_rows == 1){
				echo $uniqueCustomerCode."<br/>";
				$row_unique_code = $db->fetchByAssoc($get_unique_code_query);
				$adoption[] = array('name' => 'id','value' => $row_unique_code['id']);
				$module = 'Contacts';
				$user_creation = create_user($sessionID,$module,$adoption);
				$responseData[$i]['batchID'] = $batchID;
				$responseData[$i]['uniqueCustomerCode'] = $uniqueCustomerCode;
				$responseData[$i]['UpdateType'] = '5';
				$responseData[$i]['uniqueID'] = '0';
				$i++;	
		}

	
	}
	send_response_data($responseData);
	return true;
}
/************************************Adaption percentage - END****************************************/
function EcsMandate_Details(){
	global $db, $sugar_config;
	$username = $sugar_config["webservice_username"];
	$password = $sugar_config["webservice_password"];
	/***************log file***************************/
	$schedulerLogFile = '/var/www/html/crm/WebsiteAPILogs/getecsmandatesetup.txt';  
	$schedulerHandle = fopen($schedulerLogFile, 'a');
	$timestamp = date('Y-m-d H:i:s',strtotime('+5 hours +30 minutes', strtotime('now')));
	$status = "CRON Run Successful! - ECS Mandate Details";
	$logMessage = "\n\nScheduler Result at $timestamp :- $status";
	fwrite($schedulerHandle, $logMessage);
	
	/*************curl for getting goals data from 3rd party********************/
	$url = $sugar_config['getecsmandatesetup'];
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization:Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI',
											'Content-Type: application/json',
											'Content-Length: ' . strlen($postData)));
	$result = curl_exec($ch);
	curl_close($ch);
	$GetUserDataforCRM = json_decode($result, true);
	$GetUserData_Mandate = $GetUserDataforCRM['data'];
	//echo '<pre>';print_r($GetUserData_Mandate);exit;
	/******generating sugar session id*********/
	$loginResult = login($username, $password);
	$sessionID = $loginResult->id;
	$responseData = array();
	$i = 0;
	foreach($GetUserData_Mandate as $mandate){
		
			$uniqueCustomerCode = $mandate["uniqueCustomerCode"];
			$batchID = $mandate["batchID"];
			$investorName = $mandate["investorName"];
			$email = $mandate["email"];
			$referenceNo = $mandate["referenceNo"];
			$mandateAmount = $mandate["mandateAmount"];
			$bankName = $mandate["bankName"];
			$verificationRemark = $mandate["verificationRemark"];
			$verifiedStatus = $mandate["verifiedStatus"];
			$investorECSMandateDetailID = $mandate["investorECSMandateDetailID"];

		
		$mandate_list = array(
			(isset($uniqueCustomerCode) ? Array('name' => "uniquecustomercode",'value'=>$uniqueCustomerCode) : ''),
			(isset($batchID) ? Array('name' => "batchid",'value'=>$batchID) : ''),
			(isset($investorName) ? Array('name' => "investorname",'value'=>$investorName) : ''),
			(isset($email) ? Array('name' => "email",'value'=>$email) : ''),
			(isset($referenceNo) ? Array('name' => "referenceno",'value'=>$referenceNo) : ''),
			(isset($mandateAmount) ? Array('name' => "mandateamount",'value'=>$mandateAmount) : ''),
			(isset($bankName) ? Array('name' => "bankname",'value'=>$bankName) : ''),
			(isset($verificationRemark) ? Array('name' => "verificationremark",'value'=>$verificationRemark) : ''),
			(isset($verifiedStatus) ? Array('name' => "verifiedstatus",'value'=>$verifiedStatus) : ''),
			(isset($investorECSMandateDetailID) ? Array('name' => "investorecsmandatedetailid",'value'=>$investorECSMandateDetailID) : ''),

		);
		/****************fetch contact id using customer code******************************/
		$get_unique_code_query = $db->query("select id from contacts join contacts_cstm where id=id_c and deleted=0 and unique_customer_code_c = '$uniqueCustomerCode'");
		if($get_unique_code_query->num_rows > 0 ){
			$row_customer_id = $db->fetchByAssoc($get_unique_code_query);
			$customer_id = $row_customer_id['id'];
			/*******************duplicate check*********************/
			$get_mandate_query = $db->query("select scrm_ecs_mandate.id from scrm_ecs_mandate join contacts_scrm_ecs_mandate_1_c on contacts_scrm_ecs_mandate_1_c.contacts_scrm_ecs_mandate_1scrm_ecs_mandate_idb=scrm_ecs_mandate.id join contacts on contacts.id=contacts_scrm_ecs_mandate_1_c.contacts_scrm_ecs_mandate_1contacts_ida join contacts_cstm on contacts_cstm.id_c=contacts.id where scrm_ecs_mandate.deleted=0 and contacts.deleted=0 and contacts_scrm_ecs_mandate_1_c.deleted=0 and contacts_cstm.unique_customer_code_c = '$uniqueCustomerCode' and scrm_ecs_mandate.investorecsmandatedetailid='$investorECSMandateDetailID'");
						if($get_mandate_query->num_rows == 0){			
							$module = 'scrm_ECS_Mandate';
							$mandate_details_list = create_user($sessionID,$module,$mandate_list);
							$mandate_id = $mandate_details_list->id;
							/**********Establish relationship***************/
							$linkname = 'contacts_scrm_ecs_mandate_1';
							$module = 'Contacts';
							$establish_relationship = establish_relationship($sessionID,$module,$linkname,$mandate_id,$customer_id);	
						}else{
							$row_mandate_id = $db->fetchByAssoc($get_mandate_query);
							$module = 'scrm_ECS_Mandate';
							$mandate_list[] = array('name' => 'id','value' => $row_mandate_id['id']);
							$user_creation = create_user($sessionID,$module,$mandate_list);
						}		
						$status = "ECS Mandate details - $uniqueCustomerCode";
						$logMessage = "\n\nScheduler Result at $timestamp :- $status";
						fwrite($schedulerHandle, $logMessage);
					$responseData[$i]['batchID'] = $batchID;
					$responseData[$i]['uniqueCustomerCode'] = $uniqueCustomerCode;
					$responseData[$i]['UpdateType'] = '6';
					$responseData[$i]['uniqueID'] = $investorECSMandateDetailID;	
				$i++;
			}
		
	}
	send_response_data($responseData);
	return true;
}
function GetOrderDetails(){
	global $db, $sugar_config;
	$username = $sugar_config["webservice_username"];
	$password = $sugar_config["webservice_password"];
	/***************log file***************************/
	$schedulerLogFile = '/var/www/html/crm/WebsiteAPILogs/getordersforcrm.txt';  
	$schedulerHandle = fopen($schedulerLogFile, 'a');
	$timestamp = date('Y-m-d H:i:s',strtotime('+5 hours +30 minutes', strtotime('now')));
	$status = "CRON Run Successful! - Get Orders";
	$logMessage = "\n\nScheduler Result at $timestamp :- $status";
	fwrite($schedulerHandle, $logMessage);
	/*************curl for getting goals data from 3rd party********************/
	$url = $sugar_config['getordersforcrm'];
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization:Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI',
											'Content-Type: application/json',
											'Content-Length: ' . strlen($postData)));
	$result = curl_exec($ch);
	curl_close($ch);
	$GetUserDataforCRM = json_decode($result, true);
	$GetUserData_Orders = $GetUserDataforCRM['data'];
	//echo '<pre>';print_r($GetUserData_Orders);exit;
	/******generating sugar session id*********/
	$loginResult = login($username, $password);
	$sessionID = $loginResult->id;
	$responseData = array();
	$i = 0;
	foreach($GetUserData_Orders as $order_details){
		
			$batchID = $order_details["batchID"];
			$wishListDetailID = $order_details["wishListDetailID"];
			$transactionSubType = $order_details["transactionSubType"];
			$isActive = $order_details["isActive"];
			$paymentType = $order_details["paymentType"];
			$cartType = $order_details["cartType"];
			$userDemographicID = $order_details["userDemographicID"];
			$transactionDate = $order_details["transactionDate"];
			$transactionDate = date('Y-m-d H:i:s',strtotime("-5 hours, -30 minutes", strtotime($transactionDate)));
			$assetClass = $order_details["assetClass"];
			$schemeSegmentType = $order_details["schemeSegmentType"];
			$schemeName = $order_details["schemeName"];
			$folioNumber = $order_details["folioNumber"];
			$price = $order_details["price"];
			$amount = $order_details["amount"];
			$wishListID = $order_details["wishListID"];
			$quantity = $order_details["quantity"];
			$cycleDate = $order_details["cycleDate"];
			$period = $order_details["period"];
			$isInitialPayment = $order_details["isInitialPayment"];
			$organizationName = $order_details["organizationName"];
			$schemeCode = $order_details["schemeCode"];
			$withdrawalOn = $order_details["withdrawalOn"];
			$assetType = $order_details["assetType"];
			$invoiceNumber = $order_details["invoiceNumber"];
			$invoiceDate = $order_details["invoiceDate"];
			$invoiceDate = date('Y-m-d',strtotime($invoiceDate));
			$transactionReferenceNo = $order_details["transactionReferenceNo"];
			$bankReferenceNo = $order_details["bankReferenceNo"];
			$invoiceAmount = $order_details["invoiceAmount"];
			$paidAmount = $order_details["paidAmount"];
			$nomineeFullName = $order_details["nomineeFullName"];
			$nomineePanNo = $order_details["nomineePanNo"];
			$nomineeRelationship = $order_details["nomineeRelationship"];
			$bankName = $order_details["bankName"];
			$ecsStatus = $order_details["ecsStatus"];
			$isFeedsGenerated = $order_details["isFeedsGenerated"];
			$feedsGenerateOn = $order_details["feedsGenerateOn"];
			$branchName = $order_details["branchName"];
			$chequeNo = $order_details["chequeNo"];
			$investorECSMandateDetailID = $order_details["investorECSMandateDetailID"];
			$remark = $order_details["remark"];
			$feedsStatus = $order_details["feedsStatus"];
			$noofNCD = $order_details["noofNCD"];
			$applicationNo = $order_details["applicationNo"];
			$frequency = $order_details["frequency"];
			$isSystematicTransactionStopped = $order_details["isSystematicTransactionStopped"];
			$utrno = $order_details["utrno"];
			$paymentGatway = $order_details["paymentGatway"];
			$isAdvisory = $order_details["isAdvisory"];
			$amcBankName = $order_details["amcBankName"];
			$amcAccountNo = $order_details["amcAccountNo"];
			$amcifscCode = $order_details["amcifscCode"];
			$projectType = $order_details["projectType"];
			$orderStatus = $order_details["orderStatus"];
			$accountno = $order_details["accountno"];
			$paymentStatus = $order_details["paymentStatus"];
			$uniqueCustomerCode = $order_details["uniqueCustomerCode"];

			if(isset($isActive)){
				switch($isActive){
					case 'true':$isActive=1;break;
					case 'false':$isActive =0;break;
					default: $isActive='';break;
				}
			}
		
		$order_details_list = array(
			(isset($batchID) ? Array('name' => "batchid_c",'value'=>$batchID) : ''),
			(isset($wishListDetailID) ? Array('name' => "wishlistdetailid_c",'value'=>$wishListDetailID) : ''),
			(isset($transactionSubType) ? Array('name' => "transactionsubtype_c",'value'=>$transactionSubType) : ''),
			(isset($isActive) ? Array('name' => "isactive_c",'value'=>$isActive) : ''),
			(isset($paymentType) ? Array('name' => "paymenttype_c",'value'=>$paymentType) : ''),
			(isset($cartType) ? Array('name' => "carttype_c",'value'=>$cartType) : ''),
			(isset($userDemographicID) ? Array('name' => "userdemographicid_c",'value'=>$userDemographicID) : ''),
			(isset($transactionDate) ? Array('name' => "date_of_transaction_c",'value'=>$transactionDate) : ''),
			(isset($assetClass) ? Array('name' => "asset_class_c",'value'=>$assetClass) : ''),
			(isset($schemeSegmentType) ? Array('name' => "schemesegmenttype_c",'value'=>$schemeSegmentType) : ''),
			(isset($schemeName) ? Array('name' => "scheme_name_c",'value'=>$schemeName) : ''),
			(isset($folioNumber) ? Array('name' => "folionumber_c",'value'=>$folioNumber) : ''),
			(isset($price) ? Array('name' => "price_c",'value'=>$price) : ''),
			(isset($amount) ? Array('name' => "order_amount_c",'value'=>$amount) : ''),
			(isset($wishListID) ? Array('name' => "wishlistid_c",'value'=>$wishListID) : ''),
			(isset($quantity) ? Array('name' => "quantity_c",'value'=>$quantity) : ''),
			(isset($cycleDate) ? Array('name' => "cycledate_c",'value'=>$cycleDate) : ''),
			(isset($period) ? Array('name' => "period_c",'value'=>$period) : ''),
			(isset($isInitialPayment) ? Array('name' => "isinitialpayment_c",'value'=>$isInitialPayment) : ''),
			(isset($organizationName) ? Array('name' => "manufacturer_c",'value'=>$organizationName) : ''),
			(isset($schemeCode) ? Array('name' => "schemecode_c",'value'=>$schemeCode) : ''),
			(isset($withdrawalOn) ? Array('name' => "withdrawalon_c",'value'=>$withdrawalOn) : ''),
			(isset($assetType) ? Array('name' => "assettype_c",'value'=>$assetType) : ''),
			(isset($invoiceNumber) ? Array('name' => "order_number_c",'value'=>$invoiceNumber) : ''),
			(isset($invoiceDate) ? Array('name' => "invoicedate_c",'value'=>$invoiceDate) : ''),
			(isset($transactionReferenceNo) ? Array('name' => "transaction_reference_number_c",'value'=>$transactionReferenceNo) : ''),
			(isset($bankReferenceNo) ? Array('name' => "bankreferenceno_c",'value'=>$bankReferenceNo) : ''),
			(isset($invoiceAmount) ? Array('name' => "invoice_amount_c",'value'=>$invoiceAmount) : ''),
			(isset($paidAmount) ? Array('name' => "paidamount_c",'value'=>$paidAmount) : ''),
			(isset($nomineeFullName) ? Array('name' => "nomineefullname_c",'value'=>$nomineeFullName) : ''),
			(isset($nomineePanNo) ? Array('name' => "nomineepanno_c",'value'=>$nomineePanNo) : ''),
			(isset($nomineeRelationship) ? Array('name' => "nomineerelationship_c",'value'=>$nomineeRelationship) : ''),
			(isset($bankName) ? Array('name' => "bankname_c",'value'=>$bankName) : ''),
			(isset($ecsStatus) ? Array('name' => "ecsstatus_c",'value'=>$ecsStatus) : ''),
			(isset($isFeedsGenerated) ? Array('name' => "isfeedsgenerated_c",'value'=>$isFeedsGenerated) : ''),
			(isset($feedsGenerateOn) ? Array('name' => "feedsgenerateon_c",'value'=>$feedsGenerateOn) : ''),
			(isset($branchName) ? Array('name' => "branchname_c",'value'=>$branchName) : ''),
			(isset($chequeNo) ? Array('name' => "chequeno_c",'value'=>$chequeNo) : ''),
			(isset($investorECSMandateDetailID) ? Array('name' => "investorecsmandatedetailid_c",'value'=>$investorECSMandateDetailID) : ''),
			(isset($remark) ? Array('name' => "remark_c",'value'=>$remark) : ''),
			(isset($feedsStatus) ? Array('name' => "feedsstatus_c",'value'=>$feedsStatus) : ''),
			(isset($noofNCD) ? Array('name' => "noofncd_c",'value'=>$noofNCD) : ''),
			(isset($applicationNo) ? Array('name' => "applicationno_c",'value'=>$applicationNo) : ''),
			(isset($frequency) ? Array('name' => "frequency_c",'value'=>$frequency) : ''),
			(isset($isSystematicTransactionStopped) ? Array('name' => "issystematictransactionstopp_c",'value'=>$isSystematicTransactionStopped) : ''),
			(isset($utrno) ? Array('name' => "utrno_c",'value'=>$utrno) : ''),
			(isset($paymentGatway) ? Array('name' => "paymentgatway_c",'value'=>$paymentGatway) : ''),
			(isset($isAdvisory) ? Array('name' => "isadvisory_c",'value'=>$isAdvisory) : ''),
			(isset($amcBankName) ? Array('name' => "amcbankname_c",'value'=>$amcBankName) : ''),
			(isset($amcAccountNo) ? Array('name' => "amcaccountno_c",'value'=>$amcAccountNo) : ''),
			(isset($amcifscCode) ? Array('name' => "amcifsccode_c",'value'=>$amcifscCode) : ''),
			(isset($projectType) ? Array('name' => "projecttype_c",'value'=>$projectType) : ''),
			(isset($orderStatus) ? Array('name' => "orderstatus_c",'value'=>$orderStatus) : ''),
			(isset($accountno) ? Array('name' => "accountno_c",'value'=>$accountno) : ''),
			(isset($paymentStatus) ? Array('name' => "payment_status_c",'value'=>$paymentStatus) : ''),
			(isset($uniqueCustomerCode) ? Array('name' => "uniquecustomercode_c",'value'=>$uniqueCustomerCode) : ''),


		);
		/*****************redemption details***************************/
		if($cartType == 5){
			$redemption_details = array(
					(isset($transactionDate) ? Array('name' => "redemption_date",'value'=>$transactionDate) : ''),
					(isset($schemeName) ? Array('name' => "scheme_name",'value'=>$schemeName) : ''),
					(isset($folioNumber) ? Array('name' => "folio_number",'value'=>$folioNumber) : ''),
					(isset($amount) ? Array('name' => "redemption_amount",'value'=>$amount) : ''),
					(isset($feedsStatus) ? Array('name' => "redemption_status",'value'=>$feedsStatus) : ''),
					(isset($wishListDetailID) ? Array('name' => "wishlistid",'value'=>$wishListDetailID) : ''),
				);
		}
		/****************fetch contact id using customer code******************************/
		$get_unique_code_query = $db->query("select c.id,CONCAT(IFNULL(c.first_name,''),' ',IFNULL(cc.middle_name_c,''),' ',IFNULL(c.last_name,'')) as investor_name,ea.email_address as investor_emailid from contacts c join contacts_cstm cc join email_addr_bean_rel ebr on ebr.bean_id = c.id and ebr.deleted=0 join email_addresses ea on ea.id=ebr.email_address_id and ea.deleted=0 where c.id=cc.id_c and c.deleted=0 and cc.unique_customer_code_c = '$uniqueCustomerCode'");
		if($get_unique_code_query->num_rows > 0 ){
			//echo $uniqueCustomerCode."<br/>";
			$row_customer_id = $db->fetchByAssoc($get_unique_code_query);
			$customer_id = $row_customer_id['id'];
			$investor_name = $row_customer_id['investor_name'];
			$investor_emailid = $row_customer_id['investor_emailid'];
			/*******************duplicate check*********************/
			$get_orders_query = $db->query("select scrm_my_orders.id from scrm_my_orders join scrm_my_orders_cstm on scrm_my_orders.id=scrm_my_orders_cstm.id_c join contacts_scrm_my_orders_1_c on contacts_scrm_my_orders_1_c.contacts_scrm_my_orders_1scrm_my_orders_idb=scrm_my_orders.id join contacts on contacts.id=contacts_scrm_my_orders_1_c.contacts_scrm_my_orders_1contacts_ida join contacts_cstm on contacts_cstm.id_c=contacts.id where scrm_my_orders.deleted=0 and contacts.deleted=0 and contacts_scrm_my_orders_1_c.deleted=0 and contacts_cstm.unique_customer_code_c = '$uniqueCustomerCode' and scrm_my_orders_cstm.wishlistdetailid_c='$wishListDetailID'");
						if($get_orders_query->num_rows == 0){			
							$module = 'scrm_My_Orders';
							$order_details_list_1 = create_user($sessionID,$module,$order_details_list);
							$order_id = $order_details_list_1->id;
							/**********Establish relationship***************/
							$linkname = 'contacts_scrm_my_orders_1';
							$module = 'Contacts';
							$establish_relationship = establish_relationship($sessionID,$module,$linkname,$order_id,$customer_id);
						}else{
							$row_order_id = $db->fetchByAssoc($get_orders_query);
							$module = 'scrm_My_Orders';
							$order_details_list[] = array('name' => 'id','value' => $row_order_id['id']);
							$user_creation = create_user($sessionID,$module,$order_details_list);
						}	

			if($cartType == 5){
				$get_orders_redemption_query = $db->query("select scrm_redemption_details.id from scrm_redemption_details join contacts_scrm_redemption_details_1_c on contacts_scrm_redemption_details_1_c.contacts_scrm_redemption_details_1scrm_redemption_details_idb=scrm_redemption_details.id join contacts on contacts.id=contacts_scrm_redemption_details_1_c.contacts_scrm_redemption_details_1contacts_ida join contacts_cstm on contacts_cstm.id_c=contacts.id where scrm_redemption_details.deleted=0 and contacts.deleted=0 and contacts_scrm_redemption_details_1_c.deleted=0 and contacts_cstm.unique_customer_code_c = '$uniqueCustomerCode' and scrm_redemption_details.wishlistid='$wishListDetailID'");
						if($get_orders_redemption_query->num_rows == 0){			
							$module = 'scrm_Redemption_Details';
							$redemption_details[] = array('name' => 'name','value' => $investor_name);
							$redemption_details[] = array('name' => 'investor_email_id','value' => $investor_emailid);
							$order_redemption_details_list_1 = create_user($sessionID,$module,$redemption_details);
							$order_redemption_id = $order_redemption_details_list_1->id;
							/**********Establish relationship***************/
							$linkname = 'contacts_scrm_redemption_details_1';
							$module = 'Contacts';
							$establish_relationship = establish_relationship($sessionID,$module,$linkname,$order_redemption_id,$customer_id);
						}else{
							$row_order_redemption_id = $db->fetchByAssoc($get_orders_redemption_query);
							$module = 'scrm_Redemption_Details';
							$redemption_details[] = array('name' => 'id','value' => $row_order_redemption_id['id']);
							$redemption_details[] = array('name' => 'name','value' => $investor_name);
							$redemption_details[] = array('name' => 'investor_email_id','value' => $investor_emailid);
							$user_creation = create_user($sessionID,$module,$redemption_details);
						}
				}			
					$status = "Get Orders - $uniqueCustomerCode";
						$logMessage = "\n\nScheduler Result at $timestamp :- $status";
						fwrite($schedulerHandle, $logMessage);
					$responseData[$i]['batchID'] = $batchID;
					$responseData[$i]['uniqueCustomerCode'] = $uniqueCustomerCode;
					$responseData[$i]['UpdateType'] = '7';
					$responseData[$i]['uniqueID'] = $wishListDetailID;	
				$i++;
				//exit;
			}
	}
	send_response_data($responseData);
	return true;
}
/***********************GetNomineeDetails***********************************/
function GetNomineeDetails(){
	global $db, $sugar_config;
	$username = $sugar_config["webservice_username"];
	$password = $sugar_config["webservice_password"];
	/***************log file***************************/
	$schedulerLogFile = '/var/www/html/crm/WebsiteAPILogs/GetNomineeDetails.txt';  
	$schedulerHandle = fopen($schedulerLogFile, 'a');
	$timestamp = date('Y-m-d H:i:s',strtotime('+5 hours +30 minutes', strtotime('now')));
	$status = "CRON Run Successful! - Get Nominee Details";
	$logMessage = "\n\nScheduler Result at $timestamp :- $status";
	fwrite($schedulerHandle, $logMessage);
	/*************curl for getting goals data from 3rd party********************/
	$url = $sugar_config['GetNomineeDetails'];
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization:Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI',
											'Content-Type: application/json',
											'Content-Length: ' . strlen($postData)));
	$result = curl_exec($ch);
	curl_close($ch);
	$GetUserDataforCRM = json_decode($result, true);
	$GetNomineeDetails_data = $GetUserDataforCRM['data'];
	// echo '<pre>';print_r($GetNomineeDetails_data);exit;
	/******generating sugar session id*********/
	$loginResult = login($username, $password);
	$sessionID = $loginResult->id;
	$responseData = array();
	$i=0;
	foreach($GetNomineeDetails_data as $nomineedetails){
		$batchID =  $nomineedetails["batchID"];
		$uniqueCustomerCode =  $nomineedetails["uniqueCustomerCode"];
		$investorID =  $nomineedetails["investorID"];
		$fullName =  $nomineedetails["fullName"];
		$investorNomineeID =  $nomineedetails["investorNomineeID"];
		$relationship =  $nomineedetails["relationship"];
		$GetNomineeDetails_array = array(
				(isset($batchID) ? Array('name' =>  "batchid" ,'value' => $batchID) : ''), 
				(isset($uniqueCustomerCode) ? Array('name' =>  "uniquecustomercode" ,'value' => $uniqueCustomerCode) : ''), 
				(isset($investorID) ? Array('name' =>  "investorid" ,'value' => $investorID) : ''), 
				(isset($fullName) ? Array('name' =>  "fullname" ,'value' => $fullName) : ''), 
				(isset($investorNomineeID) ? Array('name' =>  "investornomineeid" ,'value' => $investorNomineeID) : ''), 
				(isset($relationship) ? Array('name' =>  "relationship" ,'value' => $relationship) : ''), 

			);

 			/****************fetch contact id using customer code******************************/
				$get_unique_code_query = $db->query("select id from contacts join contacts_cstm where id=id_c and deleted=0 and unique_customer_code_c = '$uniqueCustomerCode'");
				if($get_unique_code_query->num_rows > 0 ){
					//echo $uniqueCustomerCode."<br/>";
					$row_customer_id = $db->fetchByAssoc($get_unique_code_query);
					$customer_id = $row_customer_id['id'];
	 				/*******************duplicate check*********************/
	 				$get_nominees_query = $db->query("select scrm_nominees.id from scrm_nominees join contacts_scrm_nominees_1_c on contacts_scrm_nominees_1_c.contacts_scrm_nominees_1scrm_nominees_idb=scrm_nominees.id join contacts on contacts.id=contacts_scrm_nominees_1_c.contacts_scrm_nominees_1contacts_ida join contacts_cstm on contacts_cstm.id_c=contacts.id where scrm_nominees.deleted=0 and contacts.deleted=0 and contacts_scrm_nominees_1_c.deleted=0 and contacts_cstm.unique_customer_code_c = '$uniqueCustomerCode' and scrm_nominees.investornomineeid='$investorNomineeID'");
						if($get_nominees_query->num_rows == 0){			
							$module = 'scrm_Nominees';
							$nominees_list = create_user($sessionID,$module,$GetNomineeDetails_array);
							$nominee_id = $nominees_list->id;
							/**********Establish relationship***************/
							$linkname = 'contacts_scrm_nominees_1';
							$module = 'Contacts';
							$establish_relationship = establish_relationship($sessionID,$module,$linkname,$nominee_id,$customer_id);	
						}else{
							$row_nominees_id = $db->fetchByAssoc($get_nominees_query);
							$module = 'scrm_Nominees';
							$GetNomineeDetails_array[] = array('name' => 'id','value' => $row_nominees_id['id']);
							$user_creation = create_user($sessionID,$module,$GetNomineeDetails_array);
						}
						$status = "Get nomineedetails - $uniqueCustomerCode";
						$logMessage = "\n\nScheduler Result at $timestamp :- $status";
						fwrite($schedulerHandle, $logMessage);	
					$responseData[$i]['batchID'] = $batchID;
					$responseData[$i]['uniqueCustomerCode'] = $uniqueCustomerCode;
					$responseData[$i]['UpdateType'] = '9';
					$responseData[$i]['uniqueID'] = $investorNomineeID;			
					$i++;		
					
					}


				}
	send_response_data($responseData);	
	 return true;

}
/*********************END***************************************************/
/********************Get Call Back Request*********************/
function GetCallBackDetailsForCRM(){
	global $db, $sugar_config;
	$username = $sugar_config["webservice_username"];
	$password = $sugar_config["webservice_password"];
		/***************log file***************************/
	$schedulerLogFile = '/var/www/html/crm/WebsiteAPILogs/getcallbackdetailsforcrm.txt';  
	$schedulerHandle = fopen($schedulerLogFile, 'a');
	$timestamp = date('Y-m-d H:i:s',strtotime('+5 hours +30 minutes', strtotime('now')));
	$status = "CRON Run Successful! - Get CallBack Request";
	$logMessage = "\n\nScheduler Result at $timestamp :- $status";
	fwrite($schedulerHandle, $logMessage);
	/*************curl for getting goals data from 3rd party********************/
	$url = $sugar_config['getcallbackdetailsforcrm'];
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization:Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI',
											'Content-Type: application/json',
											'Content-Length: ' . strlen($postData)));
	$result = curl_exec($ch);
	curl_close($ch);
	$GetUserDataforCRM = json_decode($result, true);
	$GetCallBackDetailsForCRM = $GetUserDataforCRM['data'];
	// echo '<pre>';print_r($GetCallBackDetailsForCRM);exit;
	/******generating sugar session id*********/
	$loginResult = login($username, $password);
	$sessionID = $loginResult->id;
	$responseData = array();
	$i=0;
	foreach($GetCallBackDetailsForCRM as $callbackdetails){
		
				$batchID = $callbackdetails["batchID"];
				$callBackID = $callbackdetails["callBackID"];
				$uniqueCustomerCode = $callbackdetails["uniqueCustomerCode"];
				$callBackDateTime = $callbackdetails["callBackDateTime"];
				$callBackDateTime = date('Y-m-d H:i:s',strtotime("-5 hours, -30 minutes", strtotime($callBackDateTime)));
				$userName = $callbackdetails["userName"];
				$emailID = $callbackdetails["emailID"];
				$mobileNo = $callbackdetails["mobileNo"];
				$section = $callbackdetails["section"];
				$subSection = $callbackdetails["subSection"];
				$areaofInterest = $callbackdetails["areaofInterest"];
				$owner = $callbackdetails["owner"];

				$getcallbackrequestdetails = array(
						(isset($batchID) ?  Array('name' =>  "batchid" ,'value' => $batchID) : ' '),
						(isset($callBackID) ?  Array('name' => "callbackid" ,'value' => $callBackID ) : ' '),
						(isset($uniqueCustomerCode) ?  Array('name' => "uniquecustomercode" ,'value' => $uniqueCustomerCode ) : ' '),
						(isset($callBackDateTime) ?  Array('name' => "callbackdatetime" ,'value' => $callBackDateTime ) : ' '),
						(isset($userName) ?  Array('name' => "username" ,'value' => $userName ) : ' '),
						(isset($emailID) ?  Array('name' => "emailid" ,'value' => $emailID ) : ' '),
						(isset($mobileNo) ?  Array('name' => "mobileno" ,'value' => $mobileNo ) : ' '),
						(isset($section) ?  Array('name' => "section" ,'value' => $section ) : ' '),
						(isset($subSection) ?  Array('name' => "subsection" ,'value' => $subSection ) : ' '),
						(isset($areaofInterest) ?  Array('name' => "areaofinterest" ,'value' => $areaofInterest ) : ' '),
						(isset($owner) ?  Array('name' => "owner" ,'value' => $owner ) : ' '),
				);
				/****************fetch contact id using customer code******************************/
				$get_unique_code_query = $db->query("select id,assigned_user_id from contacts join contacts_cstm where id=id_c and deleted=0 and unique_customer_code_c = '$uniqueCustomerCode'");
				if($get_unique_code_query->num_rows > 0 ){
					//echo $uniqueCustomerCode."<br/>";
					$row_customer_id = $db->fetchByAssoc($get_unique_code_query);
					$customer_id = $row_customer_id['id'];
					$contact_assigned_user_id = $row_customer_id['assigned_user_id'];
					/*******************duplicate check*********************/
					$get_call_backrequest_query = $db->query("select scrm_callback_request.id from scrm_callback_request join contacts_scrm_callback_request_1_c on contacts_scrm_callback_request_1_c.contacts_scrm_callback_request_1scrm_callback_request_idb=scrm_callback_request.id join contacts on contacts.id=contacts_scrm_callback_request_1_c.contacts_scrm_callback_request_1contacts_ida join contacts_cstm on contacts_cstm.id_c=contacts.id where scrm_callback_request.deleted=0 and contacts.deleted=0 and contacts_scrm_callback_request_1_c.deleted=0 and contacts_cstm.unique_customer_code_c = '$uniqueCustomerCode' and scrm_callback_request.callbackid='$callBackID'");
						if($get_call_backrequest_query->num_rows == 0){			
							$module = 'scrm_Callback_Request';
							$callback_list = create_user($sessionID,$module,$getcallbackrequestdetails);
							$callback_id = $callback_list->id;
							/**********Establish relationship***************/
							$linkname = 'contacts_scrm_callback_request_1';
							$module = 'Contacts';
							$establish_relationship = establish_relationship($sessionID,$module,$linkname,$callback_id,$customer_id);	
							/**************create call record in crm***************************/
							$module = 'Calls';
							$get_call_parameters = array(
									array('name' => 'name', 'value' => 'Callback request from customer'),
									array('name' => 'status', 'value' => 'Planned'),
									array('name' => 'direction', 'value' => 'Outbound'),
									array('name' => 'description', 'value' => 'Callback request from customer'),
									array('name' => 'date_start', 'value' => $callBackDateTime),
									array('name' => 'parent_id', 'value' => $customer_id),
									array('name' => 'parent_type', 'value' => 'Contacts'),
									array('name' => 'reminder_time', 'value' => '600'),
									array('name' => 'email_reminder_time', 'value' => '600'),
									array('name' => 'duration_minutes', 'value' => '15'),
									array('name' => 'assigned_user_id', 'value' => $contact_assigned_user_id),
								);
							$call_record_crm = create_user($sessionID,$module,$get_call_parameters);
							$call_Record_id = $call_record_crm->id;
							/**********Establish relationship***************/
							$linkname = 'calls';
							$module = 'Contacts';
							$establish_relationship = establish_relationship($sessionID,$module,$linkname,$call_Record_id,$customer_id);	
						}else{
							$row_callrequest_id = $db->fetchByAssoc($get_call_backrequest_query);
							$module = 'scrm_Callback_Request';
							$get_call_parameters[] = array('name' => 'id','value' => $row_callrequest_id['id']);
							$user_creation = create_user($sessionID,$module,$get_call_parameters);
						}	
						$status = "CallBack Request - $uniqueCustomerCode";
						$logMessage = "\n\nScheduler Result at $timestamp :- $status";
						fwrite($schedulerHandle, $logMessage);		
					$responseData[$i]['batchID'] = $batchID;
					$responseData[$i]['uniqueCustomerCode'] = $uniqueCustomerCode;
					$responseData[$i]['UpdateType'] = '4';
					$responseData[$i]['uniqueID'] = $callBackID;			
					$i++;		
					//exit;
					}


				}
				send_response_data($responseData);	
			return true;

}
/**************************GetInvestorBankAccountForCRM****************************/
function GetInvestorBankAccountForCRM(){
	global $db, $sugar_config;
	$username = $sugar_config["webservice_username"];
	$password = $sugar_config["webservice_password"];
		/***************log file***************************/
	$schedulerLogFile = '/var/www/html/crm/WebsiteAPILogs/GetInvestorBankAccountForCRM.txt';  
	$schedulerHandle = fopen($schedulerLogFile, 'a');
	$timestamp = date('Y-m-d H:i:s',strtotime('+5 hours +30 minutes', strtotime('now')));
	$status = "CRON Run Successful! - Get Investor Bank Account";
	$logMessage = "\n\nScheduler Result at $timestamp :- $status";
	fwrite($schedulerHandle, $logMessage);
	/*************curl for getting goals data from 3rd party********************/
	$url = $sugar_config['GetInvestorBankAccountForCRM'];
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization:Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI',
											'Content-Type: application/json',
											'Content-Length: ' . strlen($postData)));
	$result = curl_exec($ch);
	curl_close($ch);
	$GetUserDataforCRM = json_decode($result, true);
	$GetInvestorBankAccountForCRM_data = $GetUserDataforCRM['data'];
	// echo '<pre>';print_r($GetInvestorBankAccountForCRM_data);exit;
	/******generating sugar session id*********/
	$loginResult = login($username, $password);
	$sessionID = $loginResult->id;
	$responseData = array();
	$i=0;
	foreach($GetInvestorBankAccountForCRM_data as $bankaccountdetails){
		
			$batchID =  $bankaccountdetails["batchID"];
			$uniqueCustomerCode =  $bankaccountdetails["uniqueCustomerCode"];
			$investorID =  $bankaccountdetails["investorID"];
			$bankName =  $bankaccountdetails["bankName"];
			$investorBankAccountDetailID =  $bankaccountdetails["investorBankAccountDetailID"];
			$accountNo =  $bankaccountdetails["accountNo"];
			$documentUploaded =  $bankaccountdetails["documentUploaded"];

		$GetinvestorbankDetails_array = array(
				(isset($batchID) ? Array('name' =>  "batchid" ,'value' => $batchID) : ''), 
				(isset($uniqueCustomerCode) ? Array('name' =>  "uniquecustomercode" ,'value' => $uniqueCustomerCode) : ''), 
				(isset($investorID) ? Array('name' =>  "investorid" ,'value' => $investorID) : ''), 
				(isset($bankName) ? Array('name' =>  "bankname" ,'value' => $bankName) : ''), 
				(isset($investorBankAccountDetailID) ? Array('name' =>  "investorbankaccountdetailid" ,'value' => $investorBankAccountDetailID) : ''), 
				(isset($accountNo) ? Array('name' =>  "accountno" ,'value' => $accountNo) : ''), 
				(isset($documentUploaded) ? Array('name' =>  "documentuploaded" ,'value' => $documentUploaded) : ''), 
			);

 			/****************fetch contact id using customer code******************************/
				$get_unique_code_query = $db->query("select id from contacts join contacts_cstm where id=id_c and deleted=0 and unique_customer_code_c = '$uniqueCustomerCode'");
				if($get_unique_code_query->num_rows > 0 ){
					//echo $uniqueCustomerCode."<br/>";
					$row_customer_id = $db->fetchByAssoc($get_unique_code_query);
					$customer_id = $row_customer_id['id'];
	 				/*******************duplicate check*********************/
	 				$get_bankdetails_query = $db->query("select scrm_bank_details.id from scrm_bank_details join contacts_scrm_bank_details_1_c on contacts_scrm_bank_details_1_c.contacts_scrm_bank_details_1scrm_bank_details_idb=scrm_bank_details.id join contacts on contacts.id=contacts_scrm_bank_details_1_c.contacts_scrm_bank_details_1contacts_ida join contacts_cstm on contacts_cstm.id_c=contacts.id where scrm_bank_details.deleted=0 and contacts.deleted=0 and contacts_scrm_bank_details_1_c.deleted=0 and contacts_cstm.unique_customer_code_c = '$uniqueCustomerCode' and scrm_bank_details.investorbankaccountdetailid='$investorBankAccountDetailID'");
						if($get_bankdetails_query->num_rows == 0){			
							$module = 'scrm_Bank_Details';
							$bankdetails_list = create_user($sessionID,$module,$GetinvestorbankDetails_array);
							$bankdetails_id = $bankdetails_list->id;
							/**********Establish relationship***************/
							$linkname = 'contacts_scrm_bank_details_1';
							$module = 'Contacts';
							$establish_relationship = establish_relationship($sessionID,$module,$linkname,$bankdetails_id,$customer_id);	
						}else{
							$row_bankdetails_id = $db->fetchByAssoc($get_bankdetails_query);
							$module = 'scrm_Bank_Details';
							$GetinvestorbankDetails_array[] = array('name' => 'id','value' => $row_bankdetails_id['id']);
							$user_creation = create_user($sessionID,$module,$GetinvestorbankDetails_array);
						}	
						$status = "Investor Bank Account - $uniqueCustomerCode";
						$logMessage = "\n\nScheduler Result at $timestamp :- $status";
						fwrite($schedulerHandle, $logMessage);		
					$responseData[$i]['batchID'] = $batchID;
					$responseData[$i]['uniqueCustomerCode'] = $uniqueCustomerCode;
					$responseData[$i]['UpdateType'] = '8';
					$responseData[$i]['uniqueID'] = $investorBankAccountDetailID;			
					$i++;		
						
					}
				}

		
	send_response_data($responseData);	
	 return true;

}
/*******************************END************************************************/
/*************************GetBudgetForCRM******************************************/
function GetBudgetForCRM(){
	global $db, $sugar_config;
	$username = $sugar_config["webservice_username"];
	$password = $sugar_config["webservice_password"];

	/***************log file***************************/
	$schedulerLogFile = '/var/www/html/crm/WebsiteAPILogs/GetBudgetForCRM.txt';  
	$schedulerHandle = fopen($schedulerLogFile, 'a');
	$timestamp = date('Y-m-d H:i:s',strtotime('+5 hours +30 minutes', strtotime('now')));
	$status = "CRON Run Successful! - Get Budget For CRM";
	$logMessage = "\n\nScheduler Result at $timestamp :- $status";
	fwrite($schedulerHandle, $logMessage);
	
	/*************curl for getting goals data from 3rd party********************/
	$url = $sugar_config['GetBudgetForCRM'];
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization:Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI',
											'Content-Type: application/json',
											'Content-Length: ' . strlen($postData)));
	$result = curl_exec($ch);
	curl_close($ch);
	$GetUserDataforCRM = json_decode($result, true);
	$GetBudgetForCRM_data = $GetUserDataforCRM['data'];
	 //echo '<pre>';print_r($GetBudgetForCRM_data);exit;
	/******generating sugar session id*********/
	$loginResult = login($username, $password);
	$sessionID = $loginResult->id;
	$responseData = array();
	$i=0;
	foreach($GetBudgetForCRM_data as $budgetdata){
		
			$batchID =  $budgetdata["batchID"];
			$uniqueCustomerCode =  $budgetdata["uniqueCustomerCode"];
			$demographic_id_c =  $budgetdata["userDemographicID"];
			$income =  $budgetdata["income"];
			$expenses =  $budgetdata["expenses"];
			$annualIncome =  $budgetdata["annualIncome"];
			

		$GetbudgetDetails_array = array(
				(isset($income) ? Array('name' =>  "monthly_income_details_c" ,'value' => $income) : ''), 
				(isset($expenses) ? Array('name' =>  "annual_expenses_c" ,'value' => $expenses) : ''), 
				(isset($annualIncome) ? Array('name' =>  "annual_income_c" ,'value' => $annualIncome) : ''), 
			);
			/****************fetch contact id using customer code******************************/
				$get_unique_code_query = $db->query("select id from contacts join contacts_cstm where id=id_c and deleted=0 and unique_customer_code_c = '$uniqueCustomerCode'");
				if($get_unique_code_query->num_rows > 0 ){
					//echo $uniqueCustomerCode."<br/>";
					$row_customer_id = $db->fetchByAssoc($get_unique_code_query);
					$customer_id = $row_customer_id['id'];
					$module = 'Contacts';
					$GetbudgetDetails_array[] = array('name' => 'id','value' => $customer_id);
					$user_creation = create_user($sessionID,$module,$GetbudgetDetails_array);
					$status = "Budget  - $uniqueCustomerCode";
					$logMessage = "\n\nScheduler Result at $timestamp :- $status";
					fwrite($schedulerHandle, $logMessage);	
	 			}
	 			
					$responseData[$i]['batchID'] = $batchID;
					$responseData[$i]['uniqueCustomerCode'] = $uniqueCustomerCode;
					$responseData[$i]['UpdateType'] = '10';
					$responseData[$i]['uniqueID'] = $demographic_id_c;			
					$i++;		
					
				}		
	send_response_data($responseData);	
	 return true;

}
/************************************END********************************************/
/**************************GET Tax max details****************************/
function GetTaxSummaryForCRM(){
	global $db, $sugar_config;
	$username = $sugar_config["webservice_username"];
	$password = $sugar_config["webservice_password"];

	/***************log file***************************/
	$schedulerLogFile = '/var/www/html/crm/WebsiteAPILogs/GetTaxSummaryForCRM.txt';  
	$schedulerHandle = fopen($schedulerLogFile, 'a');
	$timestamp = date('Y-m-d H:i:s',strtotime('+5 hours +30 minutes', strtotime('now')));
	$status = "CRON Run Successful! - Get Tax Summary For CRM";
	$logMessage = "\n\nScheduler Result at $timestamp :- $status";
	fwrite($schedulerHandle, $logMessage);
	
	/*************curl for getting goals data from 3rd party********************/
	$url = $sugar_config['GetTaxSummaryForCRM'];
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization:Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI',
											'Content-Type: application/json',
											'Content-Length: ' . strlen($postData)));
	$result = curl_exec($ch);
	curl_close($ch);
	$GetTaxSummaryForCRM = json_decode($result, true);
	$GetTaxSummaryForCRM_data = $GetTaxSummaryForCRM['data'];
	// echo '<pre>';print_r($GetTaxSummaryForCRM_data);exit;
	/******generating sugar session id*********/
	$loginResult = login($username, $password);
	$sessionID = $loginResult->id;
	$responseData = array();
	$i=0;
	foreach($GetTaxSummaryForCRM_data as $taxsummarydata){
		
			$batchID= $taxsummarydata['batchID'];
			$uniqueID= $taxsummarydata['uniqueID'];
			$uniqueCustomerCode= $taxsummarydata['uniqueCustomerCode'];
			$investorID= $taxsummarydata['investorID'];
			$taxYear= $taxsummarydata['taxYear'];
			$grossSalary= $taxsummarydata['grossSalary'];
			$taxableIncomeOnHouseRent= $taxsummarydata['taxableIncomeOnHouseRent'];
			$totalTaxTobePaid= $taxsummarydata['totalTaxTobePaid'];
			$taxableIncomeOnFDBonds= $taxsummarydata['taxableIncomeOnFDBonds'];
			$taxableIncomeOnEquityMutualFund= $taxsummarydata['taxableIncomeOnEquityMutualFund'];
			$taxableIncomeOnSaleOfFinancialInstruments= $taxsummarydata['taxableIncomeOnSaleOfFinancialInstruments'];
			$exemptionFrom80C= $taxsummarydata['exemptionFrom80C'];
			$exemptionFrom80D= $taxsummarydata['exemptionFrom80D'];
			$exemptionFrom80CCD= $taxsummarydata['exemptionFrom80CCD'];
			$exemptionFrom80E= $taxsummarydata['exemptionFrom80E'];
			$exemptionFrom80G= $taxsummarydata['exemptionFrom80G'];
			$exemptionFromHRA= $taxsummarydata['exemptionFromHRA'];
			$interestOnHousingLoan= $taxsummarydata['interestOnHousingLoan'];
			$taxDeductionAtSource= $taxsummarydata['taxDeductionAtSource'];
			$professionalTax= $taxsummarydata['professionalTax'];
			$taxableIncomeAfterDeduction= $taxsummarydata['taxableIncomeAfterDeduction'];
			$taxLiability= $taxsummarydata['taxLiability'];
			$taxThatYouCanSave= $taxsummarydata['taxThatYouCanSave'];
			$taxTobePaidAfterSaving= $taxsummarydata['taxTobePaidAfterSaving'];

			if(!empty($taxYear)){
				$split = str_split($taxYear, 4);
				$taxYear = implode('-', $split);
			}else{
				$taxYear = '';
			}

		$GetTaxSummaryForCRM_array = array(
				(isset($taxYear) ? Array('name' =>  "taxyear_c" ,'value' => $taxYear) : ''), 
				(isset($investorID) ? Array('name' =>  "investorid_c" ,'value' => $investorID) : ''), 
				(isset($grossSalary) ? Array('name' =>  "total_gross_salary_c" ,'value' => $grossSalary) : ''), 
				(isset($taxableIncomeOnHouseRent) ? Array('name' =>  "taxableincomeonhouserent_c" ,'value' => $taxableIncomeOnHouseRent) : ''), 
				(isset($totalTaxTobePaid) ? Array('name' =>  "totaltaxtobepaid_c" ,'value' => $totalTaxTobePaid) : ''), 
				(isset($taxableIncomeOnFDBonds) ? Array('name' =>  "taxable_income_c" ,'value' => $taxableIncomeOnFDBonds) : ''), 
				(isset($taxableIncomeOnEquityMutualFund) ? Array('name' =>  "taxable_income_equity_c" ,'value' => $taxableIncomeOnEquityMutualFund) : ''), 
				(isset($taxableIncomeOnSaleOfFinancialInstruments) ? Array('name' =>  "taxable_income_sales_c" ,'value' => $taxableIncomeOnSaleOfFinancialInstruments) : ''), 
				(isset($exemptionFrom80C) ? Array('name' =>  "exemptions_from_80c_c" ,'value' => $exemptionFrom80C) : ''), 
				(isset($exemptionFrom80D) ? Array('name' =>  "exemptions_from_80d_c" ,'value' => $exemptionFrom80D) : ''), 
				(isset($exemptionFrom80CCD) ? Array('name' =>  "exemptions_80ccd_c" ,'value' => $exemptionFrom80CCD) : ''), 
				(isset($exemptionFrom80E) ? Array('name' =>  "exemptions_80e_c" ,'value' => $exemptionFrom80E) : ''), 
				(isset($exemptionFrom80G) ? Array('name' =>  "exemptions_80g_c" ,'value' => $exemptionFrom80G) : ''), 
				(isset($exemptionFromHRA) ? Array('name' =>  "hra_c" ,'value' => $exemptionFromHRA) : ''), 
				(isset($interestOnHousingLoan) ? Array('name' =>  "interest_on_housing_loan_c" ,'value' => $interestOnHousingLoan) : ''), 
				(isset($taxDeductionAtSource) ? Array('name' =>  "tax_deducted_at_source_c" ,'value' => $taxDeductionAtSource) : ''), 
				(isset($professionalTax) ? Array('name' =>  "professional_tax_c" ,'value' => $professionalTax) : ''), 
				(isset($taxableIncomeAfterDeduction) ? Array('name' =>  "taxable_income_deduction_c" ,'value' => $taxableIncomeAfterDeduction) : ''), 
				(isset($taxLiability) ? Array('name' =>  "tax_liability_c" ,'value' => $taxLiability) : ''), 
				(isset($taxThatYouCanSave) ? Array('name' =>  "tax_that_you_an_save_c" ,'value' => $taxThatYouCanSave) : ''), 
				(isset($taxTobePaidAfterSaving) ? Array('name' =>  "tax_to_be_paid_after_saving_c" ,'value' => $taxTobePaidAfterSaving) : ''), 
			);

 			/****************fetch contact id using customer code******************************/
				$get_unique_code_query = $db->query("select id from contacts join contacts_cstm where id=id_c and deleted=0 and unique_customer_code_c = '$uniqueCustomerCode'");
				if($get_unique_code_query->num_rows > 0 ){
					echo $uniqueCustomerCode."<br/>";
					$row_customer_id = $db->fetchByAssoc($get_unique_code_query);
					$customer_id = $row_customer_id['id'];
					$module = 'Contacts';
					$GetTaxSummaryForCRM_array[] = array('name' => 'id','value' => $customer_id);
					$user_creation = create_user($sessionID,$module,$GetTaxSummaryForCRM_array);
	 			
	 				$status = "Tax Max Data  - $uniqueCustomerCode";
					$logMessage = "\n\nScheduler Result at $timestamp :- $status";
					fwrite($schedulerHandle, $logMessage);	
				}
					$responseData[$i]['batchID'] = $batchID;
					$responseData[$i]['uniqueCustomerCode'] = $uniqueCustomerCode;
					$responseData[$i]['UpdateType'] = '12';
					$responseData[$i]['uniqueID'] = $uniqueID;			
					$i++;		
					
				}

		
	send_response_data($responseData);	
	 return true;

}
/**************************GetLeadsForCRM****************************/
function GetLeadsForCRM(){
	global $db, $sugar_config;
	$username = $sugar_config["webservice_username"];
	$password = $sugar_config["webservice_password"];
		/***************log file***************************/
	$schedulerLogFile = '/var/www/html/crm/WebsiteAPILogs/GetLeadsForCRM.txt';  
	$schedulerHandle = fopen($schedulerLogFile, 'a');
	$timestamp = date('Y-m-d H:i:s',strtotime('+5 hours +30 minutes', strtotime('now')));
	$status = "CRON Run Successful! - Get Investor Bank Account";
	$logMessage = "\n\nScheduler Result at $timestamp :- $status";
	fwrite($schedulerHandle, $logMessage);
	/*************curl for getting goals data from 3rd party********************/
	$url = $sugar_config['GetLeadsForCRM'];
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization:Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI',
											'Content-Type: application/json',
											'Content-Length: ' . strlen($postData)));
	$result = curl_exec($ch);
	curl_close($ch);
	$GetUserDataforCRM = json_decode($result, true);
	$GetLeadsForCRM_data = $GetUserDataforCRM['data'];
	 //echo '<pre>';print_r($GetLeadsForCRM_data);exit;
	/******generating sugar session id*********/
	$loginResult = login($username, $password);
	$sessionID = $loginResult->id;
	$responseData = array();
	$i=0;
	foreach($GetLeadsForCRM_data as $getloansdata){
		
		$batchID = $getloansdata["batchID"];
		$uniqueCustomerCode = $getloansdata["uniqueCustomerCode"];
		$leadsID = $getloansdata["leadsID"];
		$loanType = $getloansdata["loanType"];
		$amountAppliedFor = $getloansdata["amountAppliedFor"];
		$numberOfYearsAppliedFor = $getloansdata["numberOfYearsAppliedFor"];
		$interestRateInput = $getloansdata["interestRateInput"];
		$typeofloanselected = $getloansdata["typeofloanselected"];
		$loanProviderSelected = $getloansdata["loanProviderSelected"];
		$name = $getloansdata["name"];
		$emailId = $getloansdata["emailId"];
		$dateofBirth = date('Y-m-d',strtotime($getloansdata["dateofBirth"]));
		$annualIncome = $getloansdata["annualIncome"];
		$panNo = $getloansdata["panNo"];
		$addressLine1 = $getloansdata["addressLine1"];
		$addressLine2 = $getloansdata["addressLine2"];
		$cityName = $getloansdata["cityName"];
		$cityinwhichpropertyisbased = $getloansdata["cityinwhichpropertyisbased"];
		$propertycost = $getloansdata["propertycost"];
		$currentEMI = $getloansdata["currentEMI"];
		$totalworkexperience = $getloansdata["totalworkexperience"];
		$coborrowerName = $getloansdata["coborrowerName"];
		$occupation = $getloansdata["occupation"];
		$monthlyIncome = $getloansdata["monthlyIncome"];
		$employmenttype = $getloansdata["employmenttype"];

		$GetloansforCRM_array = array(
			(!empty($batchID) ? Array('name' =>  "batchid",'value'=>$batchID) : ' '),
			(!empty($uniqueCustomerCode) ? Array('name' => "uniquecustomercode",'value'=>$uniqueCustomerCode) : ' '),
			(!empty($leadsID) ? Array('name' => "leadsid",'value'=>$leadsID) : ' '),
			(!empty($loanType) ? Array('name' => "loantype",'value'=>$loanType) : ' '),
			(!empty($amountAppliedFor) ? Array('name' => "amountappliedfor",'value'=>$amountAppliedFor) : ' '),
			(!empty($numberOfYearsAppliedFor) ? Array('name' => "numberofyearsappliedfor",'value'=>$numberOfYearsAppliedFor) : ' '),
			(!empty($interestRateInput) ? Array('name' => "interestrateinput",'value'=>$interestRateInput) : ' '),
			(!empty($typeofloanselected) ? Array('name' => "typeofloanselected",'value'=>$typeofloanselected) : ' '),
			(!empty($loanProviderSelected) ? Array('name' => "loanproviderselected",'value'=>$loanProviderSelected) : ' '),
			(!empty($name) ? Array('name' => "name",'value'=>$name) : ' '),
			(!empty($emailId) ? Array('name' => "emailid",'value'=>$emailId) : ' '),
			(!empty($dateofBirth) ? Array('name' => "dateofbirth",'value'=>$dateofBirth) : ' '),
			(!empty($annualIncome) ? Array('name' => "annualincome",'value'=>$annualIncome) : ' '),
			(!empty($panNo) ? Array('name' => "panno",'value'=>$panNo) : ' '),
			(!empty($addressLine1) ? Array('name' => "addressline1",'value'=>$addressLine1) : ' '),
			(!empty($addressLine2) ? Array('name' => "addressline2",'value'=>$addressLine2) : ' '),
			(!empty($cityName) ? Array('name' => "cityname",'value'=>$cityName) : ' '),
			(!empty($cityinwhichpropertyisbased) ? Array('name' => "cityinwhichpropertyisbased",'value'=>$cityinwhichpropertyisbased) : ' '),
			(!empty($propertycost) ? Array('name' => "propertycost",'value'=>$propertycost) : ' '),
			(!empty($currentEMI) ? Array('name' => "currentemi",'value'=>$currentEMI) : ' '),
			(!empty($totalworkexperience) ? Array('name' => "totalworkexperience",'value'=>$totalworkexperience) : ' '),
			(!empty($coborrowerName) ? Array('name' => "coborrowername",'value'=>$coborrowerName) : ' '),
			(!empty($occupation) ? Array('name' => "occupation",'value'=>$occupation) : ' '),
			(!empty($monthlyIncome) ? Array('name' => "monthlyincome",'value'=>$monthlyIncome) : ' '),
			(!empty($employmenttype) ? Array('name' => "employmenttype",'value'=>$employmenttype) : ' '),


			);

 			/****************fetch contact id using customer code******************************/
				$get_unique_code_query = $db->query("select id from contacts join contacts_cstm where id=id_c and deleted=0 and unique_customer_code_c = '$uniqueCustomerCode'");
				if($get_unique_code_query->num_rows > 0 ){
					echo $uniqueCustomerCode."<br/>";
					$row_customer_id = $db->fetchByAssoc($get_unique_code_query);
					$customer_id = $row_customer_id['id'];
					/*******************duplicate check*********************/
	 				$get_loans_query = $db->query("select scrm_loans.id from scrm_loans join contacts_scrm_loans_1_c on contacts_scrm_loans_1_c.contacts_scrm_loans_1scrm_loans_idb=scrm_loans.id join contacts on contacts.id=contacts_scrm_loans_1_c.contacts_scrm_loans_1contacts_ida join contacts_cstm on contacts_cstm.id_c=contacts.id where scrm_loans.deleted=0 and contacts.deleted=0 and contacts_scrm_loans_1_c.deleted=0 and contacts_cstm.unique_customer_code_c = '$uniqueCustomerCode' and scrm_loans.leadsid='$leadsID'");
						if($get_loans_query->num_rows == 0){			
							$module = 'scrm_Loans';
							$getloans_list = create_user($sessionID,$module,$GetloansforCRM_array);
							$loans_id = $getloans_list->id;
							/**********Establish relationship***************/
							$linkname = 'contacts_scrm_loans_1';
							$module = 'Contacts';
							$establish_relationship = establish_relationship($sessionID,$module,$linkname,$loans_id,$customer_id);		
						}else{
							$row_loans_id = $db->fetchByAssoc($get_loans_query);
							$module = 'scrm_Loans';
							$GetloansforCRM_array[] = array('name' => 'id','value' => $row_loans_id['id']);
							$user_creation = create_user($sessionID,$module,$GetloansforCRM_array);
						}	
						$status = "Loans Data - $uniqueCustomerCode";
						$logMessage = "\n\nScheduler Result at $timestamp :- $status";
						fwrite($schedulerHandle, $logMessage);		
					$responseData[$i]['batchID'] = $batchID;
					$responseData[$i]['uniqueCustomerCode'] = $uniqueCustomerCode;
					$responseData[$i]['UpdateType'] = '11';
					$responseData[$i]['uniqueID'] = $leadsID;			
					$i++;

						//exit;
					}
				}

		
	send_response_data($responseData);	
	 return true;

}
/**************************GetPaymentFailedForCRM****************************/
function GetPaymentFailedForCRM(){
	global $db, $sugar_config;
	$username = $sugar_config["webservice_username"];
	$password = $sugar_config["webservice_password"];


	/***************log file***************************/
	$schedulerLogFile = '/var/www/html/crm/WebsiteAPILogs/GetPaymentFailedForCRM.txt';  
	$schedulerHandle = fopen($schedulerLogFile, 'a');
	$timestamp = date('Y-m-d H:i:s',strtotime('+5 hours +30 minutes', strtotime('now')));
	$status = "CRON Run Successful! - Get Payment Failed Investor";
	$logMessage = "\n\nScheduler Result at $timestamp :- $status";
	fwrite($schedulerHandle, $logMessage);
	
	/*************curl for getting goals data from 3rd party********************/
	$url = $sugar_config['GetPaymentFailedForCRM'];
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization:Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI',
											'Content-Type: application/json',
											'Content-Length: ' . strlen($postData)));
	$result = curl_exec($ch);
	curl_close($ch);
	$GetPaymentFailedForCRM = json_decode($result, true);
	$GetPaymentFailedForCRM_data = $GetPaymentFailedForCRM['data'];
	 //echo '<pre>';print_r($GetPaymentFailedForCRM_data);exit;
	/******generating sugar session id*********/
	$loginResult = login($username, $password);
	$sessionID = $loginResult->id;
	$responseData = array();
	$i=0;
	foreach($GetPaymentFailedForCRM_data as $getpaymentfailure){
		
		$batchID = $getpaymentfailure["batchID"];
		$uniqueCustomerCode = $getpaymentfailure["uniqueCustomerCode"];
		$transactionSubType = $getpaymentfailure["transactionSubType"];
		$schemeName = $getpaymentfailure["schemeName"];
		$amount = $getpaymentfailure["amount"];
		$invoiceDate = date('Y-m-d',strtotime($getpaymentfailure["invoiceDate"]));
		

		$GetPaymentFailedForCRM_array = array(
			(!empty($transactionSubType) ? Array('name' => "transactionsubtype_c",'value'=>$transactionSubType) : ' '),
			(!empty($schemeName) ? Array('name' => "schemename_c",'value'=>$schemeName) : ' '),
			(!empty($amount) ? Array('name' => "amount_c",'value'=>$amount) : ' '),
			(!empty($invoiceDate) ? Array('name' => "invoicedate_c",'value'=>$invoiceDate) : ' '),
			
			);

 			/****************fetch contact id using customer code******************************/
				$get_unique_code_query = $db->query("select id from contacts join contacts_cstm where id=id_c and deleted=0 and unique_customer_code_c = '$uniqueCustomerCode'");
				if($get_unique_code_query->num_rows > 0 ){
					$row_customer_id = $db->fetchByAssoc($get_unique_code_query);
					$module = 'Contacts';
					$GetPaymentFailedForCRM_array[] = array('name' => 'id','value' => $row_customer_id['id']);
					$user_creation = create_user($sessionID,$module,$GetPaymentFailedForCRM_array);
					$status = "Payment Failure Data - $uniqueCustomerCode";
				$logMessage = "\n\nScheduler Result at $timestamp :- $status";
				fwrite($schedulerHandle, $logMessage);	
				}
						
				$responseData[$i]['batchID'] = $batchID;
				$responseData[$i]['uniqueCustomerCode'] = $uniqueCustomerCode;
				$responseData[$i]['UpdateType'] = '13';
							
				$i++;

						//exit;
		}
			
	send_response_data($responseData);	
	 return true;

}
/*******************************END************************************************/
/**************************GetEquityHoldingForCRM****************************/
function GetEquityHoldingForCRM(){
	global $db, $sugar_config;
	$username = $sugar_config["webservice_username"];
	$password = $sugar_config["webservice_password"];
	
	/***************log file***************************/
	$schedulerLogFile = '/var/www/html/crm/WebsiteAPILogs/GetEquityHoldingForCRM.txt';  
	$schedulerHandle = fopen($schedulerLogFile, 'a');
	$timestamp = date('Y-m-d H:i:s',strtotime('+5 hours +30 minutes', strtotime('now')));
	$status = "CRON Run Successful! - GetEquityHoldingForCRM";
	$logMessage = "\n\nScheduler Result at $timestamp :- $status";
	fwrite($schedulerHandle, $logMessage);
	
	/*************curl for getting goals data from 3rd party********************/
	$url = $sugar_config['GetEquityHoldingForCRM'];
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization:Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI',
											'Content-Type: application/json',
											'Content-Length: ' . strlen($postData)));
	$result = curl_exec($ch);
	curl_close($ch);
	$GetEquityHoldingForCRM = json_decode($result, true);
	$GetEquityHoldingForCRM_data = $GetEquityHoldingForCRM['data'];
	 //echo '<pre>';print_r($GetLeadsForCRM_data);exit;
	/******generating sugar session id*********/
	$loginResult = login($username, $password);
	$sessionID = $loginResult->id;
	$responseData = array();
	$i=0;
	foreach($GetEquityHoldingForCRM_data as $getequitydata){
		
		$batchID = $getequitydata["batchID"];
		$uniqueCustomerCode = $getequitydata["uniqueCustomerCode"];
		$stock = $getequitydata["stock"];
		$quantity = $getequitydata["quantity"];
		$currentValue = $getequitydata["currentValue"];
		$profitLossRs = $getequitydata["profitLossRs"];
		

		$GetEquityHoldingForCRM_array = array(
			(!empty($uniqueCustomerCode) ? Array('name' => "uniquecustomercode",'value'=>$uniqueCustomerCode) : ' '),
			(!empty($stock) ? Array('name' => "name",'value'=>$stock) : ' '),
			(!empty($quantity) ? Array('name' => "quantity",'value'=>$quantity) : Array('name' => "quantity",'value'=>0)),
			(!empty($profitLossRs) ? Array('name' => "profitlossrs",'value'=>$profitLossRs) : Array('name' => "profitlossrs",'value'=>0)),
			(!empty($currentValue) ? Array('name' => "purchase_value",'value'=>$currentValue) : Array('name' => "purchase_value",'value'=>0)),		
			);

 			/****************fetch contact id using customer code******************************/
				$get_unique_code_query = $db->query("select id from contacts join contacts_cstm where id=id_c and deleted=0 and unique_customer_code_c = '$uniqueCustomerCode'");
				if($get_unique_code_query->num_rows > 0 ){
					echo $uniqueCustomerCode."<br/>";
					$row_customer_id = $db->fetchByAssoc($get_unique_code_query);
					$customer_id = $row_customer_id['id'];
					/*******************duplicate check*********************/
	 				$get_equity_query = $db->query("select scrm_equity.id from scrm_equity join contacts_scrm_equity_1_c on contacts_scrm_equity_1_c.contacts_scrm_equity_1scrm_equity_idb=scrm_equity.id join contacts on contacts.id=contacts_scrm_equity_1_c.contacts_scrm_equity_1contacts_ida join contacts_cstm on contacts_cstm.id_c=contacts.id where scrm_equity.deleted=0 and contacts.deleted=0 and contacts_scrm_equity_1_c.deleted=0 and contacts_cstm.unique_customer_code_c = '$uniqueCustomerCode' and scrm_equity.name='$stock'");
						if($get_equity_query->num_rows == 0){			
							$module = 'scrm_Equity';
							$getequity_list = create_user($sessionID,$module,$GetEquityHoldingForCRM_array);
							$equity_id = $getequity_list->id;
							/**********Establish relationship***************/
							$linkname = 'contacts_scrm_equity_1';
							$module = 'Contacts';
							$establish_relationship = establish_relationship($sessionID,$module,$linkname,$equity_id,$customer_id);		
						}else{
							$row_equity_id = $db->fetchByAssoc($get_equity_query);
							$module = 'scrm_Equity';
							$GetEquityHoldingForCRM_array[] = array('name' => 'id','value' => $row_equity_id['id']);
							$user_creation = create_user($sessionID,$module,$GetEquityHoldingForCRM_array);
						}
					$status = "Equity Data - $uniqueCustomerCode";
					$logMessage = "\n\nScheduler Result at $timestamp :- $status";
					fwrite($schedulerHandle, $logMessage);			
					$responseData[$i]['batchID'] = $batchID;
					$responseData[$i]['uniqueCustomerCode'] = $uniqueCustomerCode;
								
					$i++;

					}
				}

		
	send_response_data($responseData);	
	 return true;

}
/*******************************END************************************************/
/**************************GetCartAbandonmentDetails****************************/
function GetCartAbandonmentDetails(){
	global $db, $sugar_config;
	$username = $sugar_config["webservice_username"];
	$password = $sugar_config["webservice_password"];
	
	/***************log file***************************/
	$schedulerLogFile = '/var/www/html/crm/WebsiteAPILogs/GetCartAbandonmentDetails.txt';  
	$schedulerHandle = fopen($schedulerLogFile, 'a');
	$timestamp = date('Y-m-d H:i:s',strtotime('+5 hours +30 minutes', strtotime('now')));
	$status = "CRON Run Successful! - GetCartAbandonmentDetails";
	$logMessage = "\n\nScheduler Result at $timestamp :- $status";
	fwrite($schedulerHandle, $logMessage);

	/*************curl for getting goals data from 3rd party********************/
	$url = $sugar_config['GetCartAbandonmentDetails'];
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	
	curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization:Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI',
											'Content-Type: application/json',
											'Content-Length: ' . strlen($postData)));
	$result = curl_exec($ch);
	curl_close($ch);
	$GetCartAbandonmentDetails = json_decode($result, true);
	$GetCartAbandonmentDetails_data = $GetCartAbandonmentDetails['data'];
	 //echo '<pre>';print_r($GetPaymentFailedForCRM_data);exit;
	/******generating sugar session id*********/
	$loginResult = login($username, $password);
	$sessionID = $loginResult->id;
	$responseData = array();
	$i=0;
	foreach($GetCartAbandonmentDetails_data as $getcartabandonment){
		
		$batchID = $getcartabandonment["batchID"];
		$uniqueCustomerCode = $getcartabandonment["uniqueCustomerCode"];
		$schemeName = $getcartabandonment["schemeName"];
		$amount = $getcartabandonment["amount"];
		$carttype = $getcartabandonment["cartType"];
		if(isset($getcartabandonment["invoiceDate"])){
			$invoiceDate = date('Y-m-d',strtotime($getcartabandonment["invoiceDate"]));
		}
		
		

		$GetCartAbandonmentDetails_array = array(
			(!empty($schemeName) ? Array('name' => "cart_scheme_name_c",'value'=>$schemeName) : ' '),
			(!empty($amount) ? Array('name' => "cart_amount_c",'value'=>$amount) : ' '),
			(isset($invoiceDate) ? Array('name' => "cart_invoice_date_c",'value'=>$invoiceDate) : Array('name' => "cart_invoice_date_c",'value'=>'')),
			(!empty($carttype) ? Array('name' => "cart_type_c",'value'=>$carttype) : ' '),
			
			);

 			/****************fetch contact id using customer code******************************/
				$get_unique_code_query = $db->query("select id from contacts join contacts_cstm where id=id_c and deleted=0 and unique_customer_code_c = '$uniqueCustomerCode'");
				if($get_unique_code_query->num_rows > 0 ){
					
					$row_customer_id = $db->fetchByAssoc($get_unique_code_query);
					$module = 'Contacts';
					$GetCartAbandonmentDetails_array[] = array('name' => 'id','value' => $row_customer_id['id']);
					$user_creation = create_user($sessionID,$module,$GetCartAbandonmentDetails_array);
					
					$status = "Cart Abandonment Data - $uniqueCustomerCode";
					$logMessage = "\n\nScheduler Result at $timestamp :- $status";
					fwrite($schedulerHandle, $logMessage);			
				
				}		
					// $responseData[$i]['batchID'] = $batchID;
					// $responseData[$i]['uniqueCustomerCode'] = $uniqueCustomerCode;
					// $responseData[$i]['UpdateType'] = '13';
							
					$i++;

						//exit;
					}
			
	//send_response_data($responseData);	
	 return true;

}
/*******************************END************************************************/

function send_response_data($responseData){
	global $sugar_config; 
$postData = json_encode($responseData);

$url = $sugar_config['updateusersstatus'];
/***************log file***************************/
$schedulerLogFile = '/var/www/html/crm/WebsiteAPILogs/updateusersstatus.txt';  
$schedulerHandle = fopen($schedulerLogFile, 'a');
$timestamp = date('Y-m-d H:i:s',strtotime('+5 hours +30 minutes', strtotime('now')));


$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization:Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI',
											'Content-Type: application/json',
											'Content-Length: ' . strlen($postData)));
$result = curl_exec($ch);
curl_close($ch);
$GetUserDataforCRM = json_decode($result, true);

 $logArray = print_r($GetUserDataforCRM, true);
        $logMessage = "\n\nScheduler UpdateUserStatus API at $timestamp :-\n$logArray";
        fwrite($schedulerHandle, $logMessage);
 $logArray = print_r($postData, true);
        $logMessage = "\n\nScheduler UpdateUser API response DATA at $timestamp :-\n$logArray";
        fwrite($schedulerHandle, $logMessage);
}

//contact creation
function create_user($sessionID,$module,$name_value_list){		
	$createuser = array(
                    "session" => $sessionID,
                    "module_name" => $module,
                    "name_value_list" => $name_value_list,
                );
              $setuserEntryID = call("set_entry", $createuser);
			  return $setuserEntryID;
}
function establish_relationship($sessionID,$module,$linkname,$relatedID,$moduleID){
		
	global $sugar_config;
  
	$set_relationships_parameters = array(
			   'session' => $sessionID,
			   'module_name' => $module,
			   'module_id' => $moduleID,
			   'link_field_name' => $linkname,
			   'related_ids' => array($relatedID),
	);
    return $set_relationship_result = call("set_relationship", $set_relationships_parameters);
    
}
//function to make cURL request
function call($method, $parameters)
{
		global $sugar_config;
		ob_start();
		
		$curl_request = curl_init();
		$curlURL = $sugar_config["webservice_url"];
        curl_setopt($curl_request, CURLOPT_URL, $curlURL);
        curl_setopt($curl_request, CURLOPT_POST, 1);
        curl_setopt($curl_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($curl_request, CURLOPT_HEADER, 1);
        curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, 0);
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

        $result = explode("\r\n\r\n", $result, 2);
        $response = json_decode($result[1]);
        ob_end_flush();

        return $response;
}
//login ------------------------------     
function login($username,$password){
    $login_parameters = array(
         "user_auth" => array(
              "user_name" => $username,
              "password" => md5($password),
              "version" => "1"
         ),
         "application_name" => "RestTest",
         "name_value_list" => array(),
    );

    $login_result = call("login", $login_parameters);
    return $login_result;
}

function getdropdown($sessionID,$module, $needle,$fieldname) {
  
	
    $getContactFields = array(
        'session' => $sessionID,
        'module_name' => $module,
    );
    $getdropdownresult = call('get_module_fields', $getContactFields)->module_fields;
	
	
	//Check whether the result is array or not. if not, initialize with empty array
    //$getdropdownvalues = $getdropdownresult->$fieldname->options;
    $getdropdownvalues = isset($getdropdownresult->$fieldname->options) ? $getdropdownresult->$fieldname->options : array();

    foreach ($getdropdownvalues as $getdropdownKey => $getdropdownValue) {
		if(!empty($getdropdownValue->value))
		{
			if (strpos(strtolower($getdropdownValue->value), strtolower($needle)) !== false || strpos(strtolower($needle), strtolower($getdropdownValue->value)) !== false) {
				return $getdropdownKey;
			} else {
				$return = '';
			}
		}
		else
		{
			$return = '';
		}
    }

    return $return;
}
/****************************************Reassignment Data _ START************************************/
function ReassignmentData(){
     $schedulerLogFile = '/var/www/html/crm/WebsiteAPILogs/reassignmentdata.txt';
    $schedulerHandle = fopen($schedulerLogFile, 'a');
    $timestamp = date('Y-m-d H:i:s', strtotime('+5 hours +30 minutes', strtotime('now')));
    $status = "CRON Run Successful! - ReassignmentData";
    $logMessage = "\n\nScheduler Result at $timestamp :- $status";
    fwrite($schedulerHandle, $logMessage);
	global $db, $app_list_strings,$sugar_config;
	date_default_timezone_set('UTC');
	$target = $sugar_config['users_assignment_target']; 
				
	//Handle Holidays list and Saturday and Sunday
	$date1            = date("Y-m-d");
	$time1            = date("H:i:s");
	//$yesterday        = date("Y-m-d", strtotime('yesterday'));
	 //If day equal monday then need to check from firday - Roshan Sarode
    $timestamp = time();
    if (date('D', $timestamp) === 'Mon') {
        $friday = strtotime('last Friday');
        $yesterday = date("Y-m-d", date('W', $friday) == date('W') ? $friday - 7 * 86400 : $friday);
    } else {
        $yesterday = date("Y-m-d", strtotime('yesterday'));
    }
	$day              = date("D");
	$holiday_query    = "select holiday_date from scrm_holidays_list where deleted = 0 order by holiday_date Desc";
	$holiday_result   = $db->query($holiday_query);
	
	$holiday_calender = array();
	while ($holiday_row = $db->fetchByAssoc($holiday_result)) {
		$holiday_date       = $holiday_row['holiday_date'];
		$holiday_calender[] = strtotime($holiday_date);
		$holiday = date("Y-m-d",strtotime($holiday_date));
		          if($holiday == $date1)
		          {
					  $is_holiday = true;
				  }
	}
	//~ if($time1 < date("H:i:s",strtotime("10:00:00")) || $time1 > date("H:i:s",strtotime("18:30:00")))	{
			   //~ $not_working = true;
	//~ }	
	if ($is_holiday || $day == 'Sat' || $day == 'Sun' ) {
		     return true;
	 }
	
		
	//End Holiday list caculation
		/*******************fetch the contact ids & respective gateway which are assigned to Dharmesh*******************/
	$fetch_contacts_data = $db->query("select contacts.id,contacts_cstm.gateway_c,contacts_cstm.product_interest_c from contacts join contacts_cstm on contacts.id=contacts_cstm.id_c where contacts.assigned_user_id='f084f5af-6e63-6490-371e-59ad17d73b2a' and contacts.date_entered>='$yesterday 13:00:00' AND contacts.date_entered <='$date1 04:29:59' and contacts.created_by='1' and contacts_cstm.gateway_c!='' and contacts_cstm.gateway_c NOT IN ('Corporate Channel','CSC- M.P Online','Offline Marketing') and contacts.deleted=0 order by date_entered desc");
	
	//$fetch_contacts_data = $db->query("select contacts.id,contacts_cstm.gateway_c from contacts join contacts_cstm on contacts.id=contacts_cstm.id_c where contacts.id='a8498467-6539-4ec5-306b-586c9aa7a5c9' and contacts.deleted=0 ");
	//$fetch_contacts_data = $db->query("select contacts.id,contacts_cstm.gateway_c from contacts join contacts_cstm on contacts.id=contacts_cstm.id_c where contacts.assigned_user_id='68ec618f-d98b-8f63-e0ad-584e574eabc7' and contacts.date_entered>='$yesterday 13:00:00' AND contacts.date_entered <='$date1 04:29:59' and contacts.created_by='1' and contacts_cstm.gateway_c!='' and contacts_cstm.gateway_c NOT IN ('Corporate Channel','CSC- M.P Online') and contacts.deleted=0 order by date_entered desc");
	while($result_contacts_data = $db->fetchByAssoc($fetch_contacts_data)){
		 $contact_id = $result_contacts_data['id'];
		 $contact_gateway = $result_contacts_data['gateway_c'];
                  $pro_interest = $result_contacts_data['product_interest_c']; 
		  $query = "SELECT distinct(su.user_id) FROM securitygroups sg JOIN securitygroups_users su ON su.securitygroup_id = sg.id JOIN users u ON su.user_id=u.id JOIN users_cstm uc ON u.id=uc.id_c JOIN acl_roles_users aru on aru.user_id=u.id and aru.deleted=0 WHERE sg.name = '$contact_gateway' AND u.status='Active' AND uc.availability_status_c='Available' AND sg.deleted =0 AND su.deleted=0 AND u.deleted=0 and aru.role_id='a8ab8653-5860-d896-7a78-58466a429bee'";
		 $result = $db->query($query);		
		 $users_count = $result->num_rows;
		 if($users_count > 0){
                            if (!empty($pro_interest)) {
                $product_assignment_query = "select * from assign_products where product_name='" . $pro_interest . "'";
                $product_assignment_result = $db->query($product_assignment_query);
                $row_products_result = $db->fetchByAssoc($product_assignment_result);
                $guid = unserialize(base64_decode($row_products_result['users_id']));

                $allusers = array();
                foreach ($guid as $uid) {
                     //If check user availability_status_c is aviailable start
                        $user_isavailable_query = "select * from users u JOIN users_cstm uc ON u.id=uc.id_c where id='" . $uid . "' and uc.availability_status_c='Available'";
                        $get_user_available_result = $db->query($user_isavailable_query);
                        if ($get_user_available_result->num_rows > 0) {
                            $allusers[] = $uid;
                        }
                       //If check user availability_status_c is aviailable end
                }
             
                $logArray = print_r($allusers, true);
                $logMessage = "\n\nAll Users of product wise assignement for product $pro_interest at $timestamp :-\n$logArray";
                fwrite($schedulerHandle, $logMessage);
              
            }
            //Product wise assignment changes by Roshan Sarode dt. 22-6-18 end
			$assigned_array = array();
            if ((empty($allusers) && empty($pro_interest))) {
                while ($users_row = $db->fetchByAssoc($result)) {
                    $assigned_array[] = $users_row['user_id'];
                    //                            $GLOBALS['log']->fatal("in array users" . print_r($users_row['user_id'], true));
                }
            } else if (!empty($allusers)) {
                        $assigned_array = $allusers;
            }
            if (!empty($assigned_array)) {

            $logArray = print_r($assigned_array, true);
            $logMessage = "\n\nProduct assigned Array at $timestamp :-\n$logArray";
            fwrite($schedulerHandle, $logMessage);
            $today = gmdate('Y-m-d');
			$assigned_user_count = array();
			$assigned_user_contacts_count = array();
			for($i=0;$i<sizeof($assigned_array);$i++){
				//select count of contacts assigned to each user_id 
				$records_query = "SELECT count(c.id) as count FROM contacts c LEFT JOIN contacts_cstm cc ON c.id = cc.id_c	WHERE  c.deleted =0 AND c.assigned_user_id = '".$assigned_array[$i]."' AND (date(cc.user_allocation_date_c) = '$today' OR disposition_c = '')";	
			//	$GLOBALS['log']->fatal($records_query);
				$records_result = $db->query($records_query);
				$row_records_result = $db->fetchByAssoc($records_result);
				//$assigned_user_contacts_count[$row_records_result['assigned_user_id']] = $row_records_result['count'];
				$assigned_user_count[] = $row_records_result['count'];
				$assigned_user_contacts_count[$row_records_result['count']] = $assigned_array[$i];
			}
			// exit;
			//$GLOBALS['log']->fatal(print_r($assigned_user_contacts_count,true)."user assignment testing");
			$get_least_count = min($assigned_user_count);
			if($get_least_count < $target){
				$assigned_user_id = $assigned_user_contacts_count[$get_least_count];
				if(empty($assigned_user_id)){
					$assigned_user_id=$assigned_array[array_rand($assigned_array)];
				}
				
		        //$user_allocation_date_c = date("Y-m-d H:i:s", strtotime("-5 hours, -30 minutes"));
		        $user_allocation_date_c = date("Y-m-d H:i:s");
				//$user_allocation_date_c = date("Y-m-d H:i:s", strtotime("+5 hours, +30 minutes", strtotime($user_allocation_date_c))); 
				//$db->query("update contacts join contacts_cstm on contacts.id=contacts_cstm.id_c set contacts.assigned_user_id='$assigned_user_id',contacts_cstm.user_allocation_date_c='$user_allocation_date_c' where contacts.id='$contact_id' and contacts.deleted=0");
				$contact  = BeanFactory::getBean('Contacts', $contact_id);
				$contact->assigned_user_id = $assigned_user_id;
				$contact->user_allocation_date_c = $user_allocation_date_c;
				$contact->do_not_run_logic_hook_c = true;
				$contact->save();
 $logArray = print_r($contact->assigned_user_id, true);
                $logMessage = "\n\n Id : $contact_id Contact assigned to at $timestamp :-\n$logArray";
                fwrite($schedulerHandle, $logMessage);				
				$db->query("update contacts join contacts_cstm on contacts.id=contacts_cstm.id_c set contacts_cstm.allocated_time_c='$user_allocation_date_c' where contacts.id='$contact_id' and contacts.deleted=0 and contacts_cstm.allocated_time_c IS NULL");
				
				
				$gateway = $GLOBALS['app_list_strings']['gateway_list'][$result_contacts_data['gateway_c']];
				/***********fetch securitygroup id from securitygroups*******************/
				$fetch_group_id = $db->query("select id from securitygroups where deleted=0 and name='$gateway'");
				$row_group_id = $db->fetchByAssoc($fetch_group_id);
				$group_id = $row_group_id['id'];
			
				/***************adding group to contacts**************/
				$add_groups = "insert into securitygroups_records(id,securitygroup_id,record_id,module,date_modified,deleted) values( UUID(),'$group_id','$contact_id','Contacts',NOW(),0)";
				$db->query($add_groups);
			}else{
				$query_user = $db->query("select id from users where user_name='Dharmesh' and deleted=0");
				$result_user = $db->fetchByAssoc($query_user);
				$assigned_user_id = $result_user['id'];
				$db->query("UPDATE contacts c  SET c.assigned_user_id =  '$assigned_user_id' WHERE  c.deleted =0 AND c.id='$contact_id' ");
			}
            } else {
//                while ($users_row = $db->fetchByAssoc($result)) {
//                    //Product wise assignment changes by Roshan Sarode dt. 22-6-18 start
//                    $assigned_array[] = $users_row['user_id'];
//                    //Product wise assignment changes by Roshan Sarode dt. 22-6-18 end
//                }
                $query_user = $db->query("select id from users where user_name='Dharmesh' and deleted=0");
                $result_user = $db->fetchByAssoc($query_user);
                $assigned_user_id = $result_user['id'];
                $db->query("UPDATE contacts c  SET c.assigned_user_id =  '$assigned_user_id' WHERE  c.deleted =0 AND c.id='$contact_id' ");
		}
            
        } else {
				$query_user = $db->query("select id from users where user_name='Dharmesh' and deleted=0");
				$result_user = $db->fetchByAssoc($query_user);
			    $assigned_user_id = $result_user['id'];
                $db->query("UPDATE contacts c  SET c.assigned_user_id =  '$assigned_user_id' WHERE  c.deleted =0 AND c.id='$contact_id' ");
				//exit; 
		}
	}
		return true; 

}
/****************************************Reassignment Data _ END************************************/


/* * **************************************LeadReassignment Data _ START*********************************** */

function LeadReassignmentData() {
    $schedulerLogFile = '/var/www/html/crm/WebsiteAPILogs/leadreassignmentdata.txt';
      $schedulerHandle = fopen($schedulerLogFile, 'a');
    $timestamp = date('Y-m-d H:i:s', strtotime('+5 hours +30 minutes', strtotime('now')));
    $status = "CRON Run Successful! - ReassignmentData";
    $logMessage = "\n\nScheduler Result at $timestamp :- $status";
    fwrite($schedulerHandle, $logMessage);
    global $db, $app_list_strings, $sugar_config;
//	date_default_timezone_set('UTC');
    $target = $sugar_config['users_assignment_target'];

    //Handle Holidays list and Saturday and Sunday
    $date1 = date("Y-m-d");
    $time1 = date("H:i:s");
    //$yesterday        = date("Y-m-d", strtotime('yesterday'));
    //If day equal monday then need to check from firday - Roshan Sarode
    $timestamp = time();
    if (date('D', $timestamp) === 'Mon') {
        $friday = strtotime('last Friday');
        $yesterday = date("Y-m-d", date('W', $friday) == date('W') ? $friday - 7 * 86400 : $friday);
    } else {
        $yesterday = date("Y-m-d", strtotime('yesterday'));
    }
    $day = date("D");
    $holiday_query = "select holiday_date from scrm_holidays_list where deleted = 0 order by holiday_date Desc";
    $holiday_result = $db->query($holiday_query);

    $holiday_calender = array();
    while ($holiday_row = $db->fetchByAssoc($holiday_result)) {
        $holiday_date = $holiday_row['holiday_date'];
        $holiday_calender[] = strtotime($holiday_date);
        $holiday = date("Y-m-d", strtotime($holiday_date));
        if ($holiday == $date1) {
            $is_holiday = true;
        }
    }
    if ($is_holiday || $day == 'Sat' || $day == 'Sun') {
        return true;
    }


    //End Holiday list caculation
    /*     * *****************fetch the contact ids & respective gateway which are assigned to Dharmesh****************** */
    $fetch_lead_query = "select leads.id,leads_cstm.gateway_c,leads_cstm.product_interest_c from leads join leads_cstm on leads.id=leads_cstm.id_c where leads.assigned_user_id='f084f5af-6e63-6490-371e-59ad17d73b2a' and leads.date_entered>='$yesterday 13:00:00' AND leads.date_entered <='$date1 04:29:59' and leads.created_by='1' and leads_cstm.gateway_c!='' and leads_cstm.gateway_c NOT IN ('CRM-CORPORATE','CRM- M.P ONLINE','CRM-OFFLINE') and leads.deleted=0 order by date_entered desc";
    $logMessage = "\n\n get Lead query at $timestamp :-\n$fetch_lead_query";
    fwrite($schedulerHandle, $logMessage);
    $fetch_leads_data = $db->query($fetch_lead_query);     //product
    while ($result_leads_data = $db->fetchByAssoc($fetch_leads_data)) {

        $logArray = print_r($result_leads_data, true);
        $logMessage = "\n\nLead Detail at $timestamp :-\n$logArray";
        fwrite($schedulerHandle, $logMessage);
        $lead_id = $result_leads_data['id'];
        $lead_gateway = $result_leads_data['gateway_c'];
        $gateway_c = $lead_gateway;
        switch ($gateway_c) {
            case 'CRM-5NANCE.COM': $gateway_c = '5nance.com';
                break;
            case 'CRM-CORPORATE': $gateway_c = 'Corporate Channel';
                break;
            case 'CRM-OFFLINE': $gateway_c = 'Offline Marketing';
                break;
            case 'CRM- M.P ONLINE': $gateway_c = 'CSC- M.P Online';
                break;
            case 'CRM-CSC': $gateway_c = 'CSC- Rajasthan emitra';
                break;
            case 'CRM-MARKETING': $gateway_c = 'Digital Marketing';
                break;
            case 'CRM-EMITRA': $gateway_c = 'CSC- Rajasthan emitra';
                break;
            case 'CRM-REFERENCE': $gateway_c = 'Digital Marketing';
                break;
            default: $gateway_c = '';
                break;
        }

//If multiple products then for getting 1st product interest by roshan dt. 28-09-2018 start
        $get_pro_interest = $result_leads_data['product_interest_c'];                                        //product
        $ld_product_interest = array_filter(explode(",", $get_pro_interest));
        $od_product_interest=array();
        foreach ($ld_product_interest as $v) {
            $od_product_interest[] = trim($v, "^");
        }
$pro_interest=$od_product_interest[0];
//If multiple products then for getting 1st product interest by roshan dt. 28-09-2018 end

        $query = "SELECT distinct(su.user_id) FROM securitygroups sg JOIN securitygroups_users su ON su.securitygroup_id = sg.id JOIN users u ON su.user_id=u.id JOIN users_cstm uc ON u.id=uc.id_c JOIN acl_roles_users aru on aru.user_id=u.id and aru.deleted=0 WHERE sg.name = '$gateway_c' AND u.status='Active' AND uc.availability_status_c='Available' AND sg.deleted =0 AND su.deleted=0 AND u.deleted=0 and aru.role_id='a8ab8653-5860-d896-7a78-58466a429bee'";
        $result = $db->query($query);
        $users_count = $result->num_rows;
        if ($users_count > 0) {
            if (!empty($pro_interest)) {
                $product_assignment_query = "select * from assign_products where product_name='" . $pro_interest . "'";
                $product_assignment_result = $db->query($product_assignment_query);
                $row_products_result = $db->fetchByAssoc($product_assignment_result);
                $guid = unserialize(base64_decode($row_products_result['users_id']));

                $allusers = array();
                foreach ($guid as $uid) {
                    //If check user availability_status_c is aviailable start
                        $user_isavailable_query = "select * from users u JOIN users_cstm uc ON u.id=uc.id_c where id='" . $uid . "' and uc.availability_status_c='Available'";
                        $get_user_available_result = $db->query($user_isavailable_query);
                        if ($get_user_available_result->num_rows > 0) {
                            $allusers[] = $uid;
                        }
                       //If check user availability_status_c is aviailable end
                }

                $logArray = print_r($allusers, true);
                $logMessage = "\n\nAll Users of product wise assignement for product $pro_interest at $timestamp :-\n$logArray";
                fwrite($schedulerHandle, $logMessage);
            }

            //Product wise assignment changes by Roshan Sarode dt. 22-6-18 end
            $assigned_array = array();
            if (!empty($allusers)) {
                $assigned_array = $allusers;
            } else {
                while ($users_row = $db->fetchByAssoc($result)) {
                    //Product wise assignment changes by Roshan Sarode dt. 22-6-18 start
                    $assigned_array[] = $users_row['user_id'];
                    //Product wise assignment changes by Roshan Sarode dt. 22-6-18 end
                }
            }

            $logArray = print_r($assigned_array, true);
            $logMessage = "\n\nProduct assigned Array at $timestamp :-\n$logArray";
            fwrite($schedulerHandle, $logMessage);
            $today = gmdate('Y-m-d');
            $assigned_user_count = array();
            $assigned_user_contacts_count = array();
            for ($i = 0; $i < sizeof($assigned_array); $i++) {
                //select count of contacts assigned to each user_id 
                $records_query = "SELECT count(l.id) as count FROM leads l LEFT JOIN leads_cstm lc ON l.id = lc.id_c	WHERE  l.deleted =0 AND l.assigned_user_id = '" . $assigned_array[$i] . "' AND (date(lc.user_allocation_date_c) = '$today' OR lc.disposition_c = 'Fresh_Fresh')";
                //	$GLOBALS['log']->fatal($records_query);
                $records_result = $db->query($records_query);
                $row_records_result = $db->fetchByAssoc($records_result);
                //$assigned_user_contacts_count[$row_records_result['assigned_user_id']] = $row_records_result['count'];
                $assigned_user_count[] = $row_records_result['count'];
                $assigned_user_contacts_count[$row_records_result['count']] = $assigned_array[$i];
            }
            // exit;
            //$GLOBALS['log']->fatal(print_r($assigned_user_contacts_count,true)."user assignment testing");
            $get_least_count = min($assigned_user_count);
            if ($get_least_count < $target) {
                $assigned_user_id = $assigned_user_contacts_count[$get_least_count];
                if (empty($assigned_user_id)) {
                    $assigned_user_id = $assigned_array[array_rand($assigned_array)];
                }

                //$user_allocation_date_c = date("Y-m-d H:i:s", strtotime("-5 hours, -30 minutes"));
                $user_allocation_date_c = date("Y-m-d H:i:s");
                //$user_allocation_date_c = date("Y-m-d H:i:s", strtotime("+5 hours, +30 minutes", strtotime($user_allocation_date_c))); 
                //$db->query("update contacts join contacts_cstm on contacts.id=contacts_cstm.id_c set contacts.assigned_user_id='$assigned_user_id',contacts_cstm.user_allocation_date_c='$user_allocation_date_c' where contacts.id='$contact_id' and contacts.deleted=0");
                $lead = BeanFactory::getBean('Leads', $lead_id);
                $lead->assigned_user_id = $assigned_user_id;
                $lead->user_allocation_date_c = $user_allocation_date_c;
				$lead->do_not_run_logic_hook_c = true;
                $lead->save();
                $logArray = print_r($lead->assigned_user_id, true);
                $logMessage = "\n\n Id : $lead_id Lead assigned to at $timestamp :-\n$logArray";
                fwrite($schedulerHandle, $logMessage);
//				$db->query("update leads join contacts_cstm on contacts.id=contacts_cstm.id_c set contacts_cstm.allocated_time_c='$user_allocation_date_c' where contacts.id='$contact_id' and contacts.deleted=0 and contacts_cstm.allocated_time_c IS NULL");


                $gateway = $GLOBALS['app_list_strings']['gateway_list'][$result_leads_data['gateway_c']];
                /*                 * *********fetch securitygroup id from securitygroups****************** */
                $fetch_group_id = $db->query("select id from securitygroups where deleted=0 and name='$gateway'");
                $row_group_id = $db->fetchByAssoc($fetch_group_id);
                $group_id = $row_group_id['id'];

                /*                 * *************adding group to contacts************* */
                $add_groups = "insert into securitygroups_records(id,securitygroup_id,record_id,module,date_modified,deleted) values( UUID(),'$group_id','$lead_id','Leads',NOW(),0)";
                $db->query($add_groups);
            } else {
                $query_user = $db->query("select id from users where user_name='Dharmesh' and deleted=0");
                $result_user = $db->fetchByAssoc($query_user);
                $assigned_user_id = $result_user['id'];
                $db->query("UPDATE leads l SET l.assigned_user_id =  '$assigned_user_id' WHERE  l.deleted =0 AND l.id='$lead_id' ");
            }
        } else {
            $query_user = $db->query("select id from users where user_name='Dharmesh' and deleted=0");
            $result_user = $db->fetchByAssoc($query_user);
            $assigned_user_id = $result_user['id'];
            $db->query("UPDATE leads l SET l.assigned_user_id =  '$assigned_user_id' WHERE  l.deleted =0 AND l.id='$lead_id' ");
            //exit; 
        }
    }
    return true;
}
/* * **************************************LeadReassignment Data _ END*********************************** */


/* * **************************************Product Reassignment Data _ START*********************************** */

function ProductReassignmentData() {
    $schedulerLogFile = '/var/www/html/crm/WebsiteAPILogs/productreassignmentdata.txt';
    $schedulerHandle = fopen($schedulerLogFile, 'a');
    $timestamp = date('Y-m-d H:i:s', strtotime('+5 hours +30 minutes', strtotime('now')));
    $status = "CRON Run Successful! - ProductReassignmentData";
    $logMessage = "\n\nScheduler Result at $timestamp :- $status";
    fwrite($schedulerHandle, $logMessage);
    global $db, $app_list_strings, $sugar_config;
    $target = $sugar_config['users_assignment_target'];
    //If the Agent is failed to meet Target, Re Assign users back to Poorti
    $db->query("UPDATE scrm_products p JOIN scrm_products_cstm pc ON pc.id_c = p.id SET p.assigned_user_id =  '68ec618f-d98b-8f63-e0ad-584e574eabc7' WHERE p.assigned_user_id <>  '68ec618f-d98b-8f63-e0ad-584e574eabc7' AND pc.sales_stage_c = 'User' AND pc.disposition_c = '' AND p.deleted =0 ");
    //Handle Holidays list and Saturday and Sunday
    $date1 = strtotime(date("Y-m-d"));
    $day = date("D");
    $holiday_query = "select holiday_date from scrm_holidays_list where deleted = 0 order by holiday_date";
    $holiday_result = $db->query($holiday_query);

    $holiday_calender = array();
    while ($holiday_row = $db->fetchByAssoc($holiday_result)) {
        $holiday_date = $holiday_row['holiday_date'];
        $holiday_calender[] = strtotime($holiday_date);
    }
    if ($day == 'Sat' || $day == 'Sun' || in_array($date1, $holiday_calender)) {
        return true;
    }
    //End Holiday list caculation
    /*     * *******************fetch the contacts data which are assigned to Poorti************************* */
    //Product wise assignment changes by Roshan Sarode dt. 22-6-18 start
     $pro_fetch_query = "select scrm_products.id,scrm_products_cstm.product_interest_c from scrm_products join scrm_products_cstm on scrm_products.id=scrm_products_cstm.id_c where scrm_products.assigned_user_id='68ec618f-d98b-8f63-e0ad-584e574eabc7' and scrm_products.created_by='1' and scrm_products.deleted=0 order by date_entered desc";
    $fetch_contacts_data = $db->query($pro_fetch_query);     //product
    $pro_count = $fetch_contacts_data->num_rows;   //product
    while ($result_contacts_data = $db->fetchByAssoc($fetch_contacts_data)) {
//print_r($result_contacts_data);
        $product_id = $result_contacts_data['id'];
        $pro_interest = $result_contacts_data['product_interest_c'];                                        //product
        $query = "SELECT su.user_id FROM securitygroups sg JOIN securitygroups_users su ON su.securitygroup_id = sg.id JOIN users u ON su.user_id=u.id JOIN users_cstm uc ON u.id=uc.id_c AND su.deleted =0 WHERE sg.deleted =0 AND su.deleted=0 AND u.deleted=0 AND uc.gateway_assigned_c='1' AND u.status='Active'";
        $result = $db->query($query);
        $users_count = $result->num_rows;

        if ($users_count > 0) {


            if (!empty($pro_interest)) {
                $product_assignment_query = "select * from assign_products where product_name='" . $pro_interest . "'";
                $product_assignment_result = $db->query($product_assignment_query);
                $row_products_result = $db->fetchByAssoc($product_assignment_result);
                $guid = unserialize(base64_decode($row_products_result['users_id']));

                $allusers = array();
                foreach ($guid as $uid) {
                     //If check user availability_status_c is aviailable start
                        $user_isavailable_query = "select * from users u JOIN users_cstm uc ON u.id=uc.id_c where id='" . $uid . "' and uc.availability_status_c='Available'";
                        $get_user_available_result = $db->query($user_isavailable_query);
                        if ($get_user_available_result->num_rows > 0) {
                            $allusers[] = $uid;
                        }
                       //If check user availability_status_c is aviailable end
                }

                $logArray = print_r($allusers, true);
                $logMessage = "\n\nAll Users of product wise assignement for product $pro_interest at $timestamp :-\n$logArray";
                fwrite($schedulerHandle, $logMessage);
            }
//            print_r($allusers);

            //Product wise assignment changes by Roshan Sarode dt. 22-6-18 end

            $assigned_array = array();
          if (empty($allusers)) {
                        while ($users_row = $db->fetchByAssoc($result)) {
                            $assigned_array[] = $users_row['user_id'];
                          
                        }
                    } else {
                        $assigned_array = $allusers;
                    }

            if (!empty($assigned_array)) {
                $assigned_array = array_unique($assigned_array);
            
//            echo "<pre>assigned array";
//            print_r($assigned_array);
            $logArray = print_r($assigned_array, true);
            $logMessage = "\n\nProduct assigned Array at $timestamp :-\n$logArray";
            fwrite($schedulerHandle, $logMessage);
            $today = gmdate('Y-m-d');
            $assigned_user_count = array();
            $assigned_user_contacts_count = array();
            for ($i = 0; $i < sizeof($assigned_array); $i++) {
                $records_query = "SELECT count(p.id) as count FROM scrm_products p LEFT JOIN scrm_products_cstm pc ON p.id = pc.id_c WHERE  pc.sales_stage_c	IN ('User', 'Suspect', 'Prospect', 'Hot Prospect') AND p.deleted =0 AND p.assigned_user_id = '" . $assigned_array[$i] . "' AND date(pc.user_allocation_date_c)='$today'";
                //	$GLOBALS['log']->fatal($records_query);
                $records_result = $db->query($records_query);
                $row_records_result = $db->fetchByAssoc($records_result);
                //$assigned_user_contacts_count[$row_records_result['assigned_user_id']] = $row_records_result['count'];
                $assigned_user_count[] = $row_records_result['count'];
                $assigned_user_contacts_count[$row_records_result['count']] = $assigned_array[$i];
            }



            //$GLOBALS['log']->fatal(print_r($assigned_user_contacts_count,true)."user assignment testing");
            if (count($assigned_user_count) >= 1) {
                $get_least_count = min($assigned_user_count);
            } else {
                $get_least_count = 0;
            }
            if ($get_least_count < $target) {
                $assigned_user_id = $assigned_user_contacts_count[$get_least_count];
                if (empty($assigned_user_id)) {
                    $assigned_user_id = $assigned_array[array_rand($assigned_array)];
                }
                $user_allocation_date_c = date("Y-m-d H:i:s");

                $product = BeanFactory::getBean('scrm_Products', $product_id);


                $product->assigned_user_id = $assigned_user_id;
                $product->user_allocation_date_c = $user_allocation_date_c;
                $product->save();


                $logArray = print_r($product->assigned_user_id, true);
                $logMessage = "\n\nProduct assigned to at $timestamp :-\n$logArray";
                fwrite($schedulerHandle, $logMessage);
                //echo $user_allocation_date_c = date("Y-m-d H:i:s", strtotime("+5 hours, +30 minutes", strtotime($user_allocation_date_c)));
                //$db->query("update contacts join contacts_cstm on contacts.id=contacts_cstm.id_c set contacts.assigned_user_id='$assigned_user_id',contacts_cstm.user_allocation_date_c='$user_allocation_date_c' where contacts.id='$product_id' and contacts.deleted=0");
            
                
                } 
//                else {
//                echo "here";
//                $db->query("UPDATE scrm_products p  SET p.assigned_user_id =  '68ec618f-d98b-8f63-e0ad-584e574eabc7' WHERE  p.deleted =0 AND p.id='$product_id' and p.assigned_user_id <>  '68ec618f-d98b-8f63-e0ad-584e574eabc7' ");
//            }
            }
        }


        //exit; 
    }
    return true;
}

/* * **************************************Product reassignment Data _ END*********************************** */


/******************************************User Productivity*****************************************/
function UserProductivity(){
	global $db;
	$today = date('Y-m-d 00:00:00');
	$today_date = date('Y-m-d H:i:s',strtotime('-5 hours -30 minutes', strtotime($today)));
	$fetch_contacts_data = $db->query("SELECT count( c.id ) AS count, c.assigned_user_id, cc.user_allocation_date_c FROM contacts c JOIN contacts_cstm cc ON cc.id_c = c.id WHERE c.deleted =0 AND cc.user_allocation_date_c >= '$today_date' AND c.assigned_user_id<>'' GROUP BY assigned_user_id");
	$assigned_array = array();
	while($result_contact_data = $db->fetchByAssoc($fetch_contacts_data)){
		 $assigned_array[$result_contact_data['assigned_user_id']][date('Y-m-d',strtotime($result_contact_data['user_allocation_date_c']))]['allocated_count'] = $result_contact_data['count'];
	}
	$fetch_modified_data = "SELECT COUNT( c.id ) AS count, c.assigned_user_id, c.date_modified FROM contacts c JOIN contacts_cstm cc ON cc.id_c = c.id WHERE c.deleted =0 AND DATE( c.date_modified ) =  '$today' AND DATE(cc.user_allocation_date_c) = '$today' AND cc.disposition_c <>  '' GROUP BY assigned_user_id";
	$result_modified_data = $db->query($fetch_modified_data);
	while($row_modified_data = $db->fetchByAssoc($result_modified_data)){
		$assigned_array[$row_modified_data['assigned_user_id']][date('Y-m-d',strtotime($row_modified_data['date_modified']))]['modified_count'] = $row_modified_data['count'];
	}
	foreach($assigned_array as $id=>$value){
		foreach($value as $date=>$count){
			$not_modified = $count['allocated_count'] - $count['modified_count'];
			$modified = $count['modified_count'];
			if(empty($modified)){
				$modified = '0';
			}

			//modified by pratik on 28112019 if value is blank default will be set to 0 (datatype is int) start
			//$allocated = $count['allocated_count']; ==> old code
			$allocated = (is_int($count['allocated_count'])?$count['allocated_count']:0);
			// end

			$fetch_user_data = "select id from scrm_user_assignment_rule where assigned_user_id='$id' and allocated_date='$date' and deleted=0";
			$result_user_data = $db->query($fetch_user_data);
			$row_user_data = $db->fetchByAssoc($result_user_data);
			$user_assignment_id = $row_user_data['id'];
			if(!empty($user_assignment_id)){
				$db->query("UPDATE scrm_user_assignment_rule set allocated_date='$date',assigned_count='$allocated',modified_count='$modified',not_modfied_count='$not_modified' where id='$user_assignment_id' and deleted=0");
			}else{
			$db->query("INSERT INTO `scrm_user_assignment_rule`(`id`, `name`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `description`, `deleted`, `assigned_user_id`,`allocated_date`, `assigned_count`, `modified_count`, `not_modfied_count`) VALUES (UUID(),'$date - $allocated',now(),now(),1,1,'',0,'$id','$date','$allocated','$modified','$not_modified')");
			}	
		}
	}
	return true;
}
/*****************************************User Productivity - END ***********************************/
function LoginAudit(){
	
		require_once('config.php');
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
 
if(file_exists('include/tcpdf/config/lang/eng.php')) {
	include_once('include/tcpdf/config/lang/eng.php'); 
} else {
	die('TCPDF lang not found');
}
if(file_exists('include/tcpdf/config/tcpdf_config.php')) {
	include_once('include/tcpdf/config/tcpdf_config.php');
} else {
	die('TCPDF config not found');
}
if(file_exists('include/tcpdf/tcpdf.php')) {
	include_once('include/tcpdf/tcpdf.php');
} else {
	die('TCPDF not found');
}


//pdf for crmaudit
class CRMAudit extends TCPDF {
	protected $from_date;
	protected $to_date;

    //~ public function Header() {
		//~ // Logo
		//~ $image_file = 'include/tcpdf/images/tcpdf_logo.gif';
		//~ $this->Image($image_file, 10, 1, 190, 'B', 'GIF', '', 'T', false, 300, '', false, false, 0, false, false, false);
	//~ }
	
	public function printPdf($from_date,$to_date) {
        // global $db;
		global $current_user,$app_list_strings,$sugar_config;

       
        $db = DBManagerFactory::getInstance();
		// create new PDF document
		$pdf = new CRMAudit(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Noresha Ankani');
		$pdf->SetTitle('PDF');
		$pdf->SetSubject('PDF');
		$pdf->SetKeywords('TCPDF, PDF, PDF, custom PDF');
		$pdf->SetFont('helvetica', '', 8, '', true);
		$pdf->SetHeaderData(PDF_HEADER_LOGO, 50,'','');
			// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		//set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetFooterMargin(10);
		
		//set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		//set image scale factor
		//~ $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		
		// Add a page
		$pdf->AddPage();

		//~ $pdf->setPrintHeader(false);
        $from_date = $from_date;
        $to_date = $to_date;
        $currentDate = intval(date('d',strtotime($to_date)));
        //echo $currentDate;exit;
        if($currentDate <= 7)
        {
			$from_date= date('Y-m-d', strtotime('first day of previous month'));
			$to_date= date('Y-m-d');
		}
        $module_list = $GLOBALS['moduleList'];
        $module_list = array("Contacts","Cases","Calls","Meetings");
        $module_list_lower = array_map('strtolower', $module_list);
        
        $loggedinquery="SELECT date(date_entered) as Logged_In_Date,count(users_sugar_id_c) as Unique_Users
                FROM  scrm_login_audit join scrm_login_audit_cstm on id=id_c where date(date_entered) BETWEEN '$from_date' and '$to_date' and deleted=0 
                group by Logged_In_Date";
        $query=$db->query($loggedinquery);
        while($row=$db->fetchByAssoc($query)){
            $data['loggedin'][$row['Logged_In_Date']] = $row['Unique_Users'];
        }

       	foreach ($module_list_lower as $module) {
       		$recordCreatedQuery="SELECT COUNT( m.id ) AS count, DATE( m.date_entered ) AS Date_Entered
                    FROM $module m
                    WHERE m.deleted =0 and date(m.date_entered) BETWEEN '$from_date' and '$to_date' 
                    GROUP BY DATE( m.date_entered ) ";
	        $query=$db->query($recordCreatedQuery);
	        while($row=$db->fetchByAssoc($query)){
	            $data[$module][$row['Date_Entered']] = $row['count'];
	        }
       	}
       
        // $module_list = array_intersect($GLOBALS['moduleList'],array_keys($GLOBALS['beanList']));
       

        $begin = new DateTime( $from_date);
        $end = new DateTime( $to_date );

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);
        $csvHeader = '';
        $header = '<tr><th align="center">Date</th>
            <th align="center"># of Unique Logins</th>';
        $csvHeader .= '"Date","# of Unique Logins",';
        foreach ($module_list as $module) {
            $header .= '<th align="center"># of New '.ucwords($app_list_strings["moduleList"][$module]).'</th>';
            $csvHeader .= '"# of New ' . ucwords($app_list_strings["moduleList"][$module]). '",';
        }
        $header .= '</tr>';
        $csvHeader .= "\n";
       
        $csvRow ='';
        foreach ( $period as $dt )
        {
            $date = $dt->format( "Y-m-d" );
            $tableRow .='<tr>';
            $tableRow .='<td align="center">'.$dt->format( "dS F Y (l)" ).'</td>';
            $csvRow .= '"' . $dt->format( "dS F Y (l)" ) . '",';
            $tableRow .='<td align="center">'.(!empty($data['loggedin'][$date]) ? $data['loggedin'][$date] : '0') .'</td>';
            $csvRow .= '"' . (!empty($data['loggedin'][$date]) ? $data['loggedin'][$date] : '0') . '",';
            foreach ($module_list_lower as $module) {
            	$tableRow .='<td align="center">'.(!empty($data[$module][$date]) ? $data[$module][$date] : '0') .'</td>';
            	$csvRow .= '"' . (!empty($data[$module][$date]) ? $data[$module][$date] : '0') . '",';
            }
            $tableRow .='</tr>'; 
            $csvRow .= "\n";
        }
//echo $tableRow;exit();
    ob_clean();
 //    header('Content-type: application/csv');
	// header('Content-Disposition: attachment; filename=crmaudit.csv');
	$csv = $csvHeader . $csvRow;
	file_put_contents("crmaudit.csv", $csv, LOCK_EX);
    $html =<<<HTML
        <!DOCTYPE html>
        <html>
        <head>

            
        </head>

        <body>
            <div style="padding-top:40px">
                <section>
                    

                    <table id="example" class="display" border="1" cellspacing="0" width="100%">
                            $header

                        <tbody>
                    $tableRow
                        </tbody>
                    </table>

                    
                        </div>

                    </div>
                </section>
            </div>

        </body>
       
        </html>
            
HTML;

		$pdf->writeHTML($html, true, false, false, false, '');
		ob_clean();		 	
        $pdf->Output('crmaudit.pdf', 'F');
		//$pdf->Output('crmaudit.pdf', 'I');
		
		$emails = array('aniket@simplecrm.com.sg','iliyas@simplecrm.com.sg');
		foreach($emails as $email){
			$this->sendEmail($email,$from_date,$to_date);
		}
		
		
	}
	
	
	
	
	public function sendEmail($email,$from_date,$to_date){
		
		global $current_user;
		//~ echo 'hi';exit;
		//echo $current_user->email1;exit;
		require_once('modules/Emails/Email.php');
		require_once('include/SugarPHPMailer.php');
		include_once('include/utils/db_utils.php'); 
		$emailObj = new Email();
		$mail = new SugarPHPMailer();
		$mail->setMailerForSystem();
		// $mail->From = $current_user->email1;
		// $mail->FromName = $current_user->full_name;
		$mail->From = 'noresha@simplecrm.com.sg';
		$mail->FromName = '5nance CRM';
		$mail->Subject = 'CRM Audit';
		$mail->Body = 'Hi,<br><br> Please find the attached crm audit from '.$from_date.' to '.$to_date;
		//$mail->Body = 'Hi,<br><br> Please find the attached crm audit';
		$mail->isHTML(true);
		//$mail->prepForOutbound();
		$mail->AddAddress($email);
		$mail->AddCC('noresha@simplecrm.com.sg');
		$mail->AddAttachment('crmaudit.pdf', 'crmaudit.pdf', 'base64', 'application/pdf');
		$mail->AddAttachment('crmaudit.csv', 'crmaudit.csv', 'base64', 'application/csv');
		// Prepare for sending
		//$mail->prepForOutbound();
		//$mail->setMailerForSystem();

		$mail->Send();
	}
	


	
}
$from_date = isset($_REQUEST['from_date']) ? $_REQUEST['from_date'] : date('Y-m-')."01";
$to_date = isset($_REQUEST['to_date']) ? $_REQUEST['to_date'] : date('Y-m-d');
$pdf = new CRMAudit();
$pdf->printPdf($from_date,$to_date);
return true;

}
/*******************************crm audit - end*******************************/
/****************************************Get States****************************************/
function GetState(){
	global $db, $sugar_config;
	$username = $sugar_config["webservice_username"];
	$password = $sugar_config["webservice_password"];
	$url = $sugar_config["getstate"];
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization:Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI',
											'Content-Type: application/json',
											'Content-Length: ' . strlen($postData)));
	$result = curl_exec($ch);
	curl_close($ch);
	$GetUserDataforCRM = json_decode($result, true);
	$GetUserData = $GetUserDataforCRM['data'];
	/******truncate the table*****************/
	$db->query("DELETE FROM state");
	foreach($GetUserData as $GetUserSet){
		$db->query("INSERT INTO state (id,name) VALUES ('".$GetUserSet['id']."','".$GetUserSet['name']."')");
	}
	return true;
}
/****************************************Get City****************************************/
function GetCity(){
	global $db, $sugar_config;
	$username = $sugar_config["webservice_username"];
	$password = $sugar_config["webservice_password"];
	$url = $sugar_config["getcity"];
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization:Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI',
											'Content-Type: application/json',
											'Content-Length: ' . strlen($postData)));
	$result = curl_exec($ch);
	curl_close($ch);
	$GetUserDataforCRM = json_decode($result, true);
	$GetUserData = $GetUserDataforCRM['data'];
	/******truncate the table*****************/
	$db->query("DELETE FROM city");
	foreach($GetUserData as $GetUserSet){
		$db->query("INSERT INTO city (id,name) VALUES ('".$GetUserSet['stateID'].'_'.$GetUserSet['id']."','".$GetUserSet['name']."')");
	}
	return true;

}
/****************************************Get pincode****************************************/
function GetPincode(){
	global $db, $sugar_config;
	$username = $sugar_config["webservice_username"];
	$password = $sugar_config["webservice_password"];
	$url = $sugar_config["getpostalcode"];
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization:Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI',
											'Content-Type: application/json',
											'Content-Length: ' . strlen($postData)));
	$result = curl_exec($ch);
	curl_close($ch);
	$GetUserDataforCRM = json_decode($result, true);
	$GetUserData = $GetUserDataforCRM['data'];
	$postal_code = array(''=>'',);
	foreach($GetUserData as $GetUserSet){
		$postal_code[$GetUserSet['stateID'].'_'.$GetUserSet['cityID'].'_'.$GetUserSet['id']]=$GetUserSet['postalCode'];
	}
	/******truncate the table*****************/
	$db->query("DELETE FROM pincode");
	foreach($GetUserData as $GetUserSet){
		$db->query("INSERT INTO pincode (id,name) VALUES ('".$GetUserSet['stateID'].'_'.$GetUserSet['cityID'].'_'.$GetUserSet['id']."','".$GetUserSet['postalCode']."')");
	}
	return true;
}
/********************************Active Users*************************************************/
function Active_Users(){
	global $db,$sugar_config;
	$username = $sugar_config["webservice_username"];
	$password = $sugar_config["webservice_password"];
	/***************log file***************************/
	$schedulerLogFile = '/var/www/html/crm/WebsiteAPILogs/getactiveusers.txt';  
	$schedulerHandle = fopen($schedulerLogFile, 'a');
	$timestamp = date('Y-m-d H:i:s',strtotime('+5 hours +30 minutes', strtotime('now')));
	$status = "CRON Run Successful! - Active Users";
	$logMessage = "\n\nScheduler Result at $timestamp :- $status";
	fwrite($schedulerHandle, $logMessage);
	
	/*************curl for getting user data from 3rd party********************/
	$url = $sugar_config['getactiveusers'];
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization:Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI',
											'Content-Type: application/json',
											'Content-Length: ' . strlen($postData)));
	$result = curl_exec($ch);
	curl_close($ch);
	$GetUserDataforCRM = json_decode($result, true);
	$GetUserData = $GetUserDataforCRM['data']['activeuserslist'];
	
	if (empty($GetUserData)) 
	{
	   $GetUserDataCRMStatus = array(
            'notice' => 'Returned empty data array.'
        );
         //update user status
		$db->query("Update contacts_cstm set online_activity_status_c='Inactive' where online_activity_status_c='Active'");
		$db->query("Update alerts set deleted='1' where deleted='0'");
        $logArray = print_r($GetUserDataCRMStatus, true);
        $logMessage = "\n\nScheduler Result at $timestamp :-\n$logArray";
        fwrite($schedulerHandle, $logMessage);
        return true;
    }
	
	$result_customer_code_array = $db->query("select contacts_cstm.unique_customer_code_c from contacts join contacts_cstm on contacts.id=contacts_cstm.id_c where contacts_cstm.online_activity_status_c='Active'");
	while($row_customer_code = $db->fetchByAssoc($result_customer_code_array))
	{
		$uniqueCustomerCode_array_crm[] = $row_customer_code['unique_customer_code_c'];
	}

	for($i=0;$i<sizeof($uniqueCustomerCode_array_crm);$i++)
	{
		//update user status
		$db->query("Update contacts_cstm set online_activity_status_c='Inactive' where unique_customer_code_c='".$uniqueCustomerCode_array_crm[$i]."' and online_activity_status_c='Active'");
		//$db->query("Update alerts set deleted='1' where deleted='0' and name='Active User Code - '".$uniqueCustomerCode_array_crm[$i]."'");
		$db->query("Update alerts set deleted='1' where deleted='0'");
	}
	foreach($GetUserData as $GetUserSet){
		$uniqueCustomerCode = $GetUserSet["uniqueCustomerCode"];
		if(!empty($uniqueCustomerCode)){
				//fetch information based on unique customer code
			$fetch_contact_data = $db->query("select contacts.id,contacts.assigned_user_id from contacts join contacts_cstm on contacts.id=contacts_cstm.id_c where contacts.deleted=0 and contacts_cstm.unique_customer_code_c='$uniqueCustomerCode'");
			$result_contact_data = $db->fetchByAssoc($fetch_contact_data);
			$contact_id = $result_contact_data['id'];
			$assigned_user = $result_contact_data['assigned_user_id'];
			
			//popup reminder to user
			$insert_popup = "INSERT INTO alerts  (id,name,date_entered,date_modified,modified_user_id,created_by,description,deleted,assigned_user_id,is_read,target_module,type,url_redirect) VALUES (UUID(),'Active User Code - $uniqueCustomerCode',NOW(),NOW(),'1','1','Kindly touch with user ASAP .','0','$assigned_user','0','Contacts','info','index.php?action=DetailView&module=Contacts&record=$contact_id')";
			$insert_popup_result = $db->query($insert_popup);
			
			//update user status
			$db->query("Update contacts_cstm set online_activity_status_c='Active' where id_c='$contact_id'");
			
			$status = "Active Users - $uniqueCustomerCode";
			$logMessage = "\n\nScheduler Result at $timestamp :- $status";
			fwrite($schedulerHandle, $logMessage);
		}
		}
	return true;	
}
/*
 * Author: Noresha Ankani
 * Date Created: 20/03/2017
 * Purpose: Case Escalation 
Requirements: 
   Escalation will work only in working hours
		a.	10 AM to 1PM – Escalation should happens
		b.	1PM to 2 PM – No Escalation
		c.  2PM to 6 PM – Escalation
		d.  6PM to 10AM(next day) – No Escalation
		e.  Weekends – Sat.Sun – No Escalation
 */
function Case_Escalation(){
	
global $db,$body,$body_main,$app_list_strings;
$escalationid="";
date_default_timezone_set('UTC');

global $sugar_config;
$schedulerLogFile = '/var/www/html/crm/WebsiteAPILogs/ticket_escalation.txt';  
$schedulerHandle = fopen($schedulerLogFile, 'a');
$timestamp = date('Y-m-d H:i:s',strtotime('+5 hours +30 minutes', strtotime('now')));
 
if(!empty($GLOBALS['app_list_strings']['teams_list']))
{
	global $db;
	/*******************get all teams escalation matrix parameters in foreach loop****************************/
	foreach($GLOBALS['app_list_strings']['teams_list'] as $key => $val)
    {
		$teams=$key;
		//fetching each escalation matrix for each team
		$query_level_minutes="SELECT escalation_minutes_level1_c,escalation_minutes_level2_c,escalation_minutes_level3_c,escalation_minutes_level4_c,id,email_template_1_c,email_template_2_c,email_template_3_c,email_template_4_c,user_id1_c,user_id2_c,user_id3_c,user_id_c FROM scrm_escalation_matrix INNER JOIN scrm_escalation_matrix_cstm ON scrm_escalation_matrix.id=scrm_escalation_matrix_cstm.id_c WHERE teams_c='$teams' AND deleted='0'";
		$result_level_minutes=$db->query($query_level_minutes);
		$row_level_minutes=$db->fetchByAssoc($result_level_minutes);
		$escalationminutes_level1=$row_level_minutes['escalation_minutes_level1_c'];
		$escalationminutes_level2=$row_level_minutes['escalation_minutes_level2_c'];
		$escalationminutes_level3=$row_level_minutes['escalation_minutes_level3_c'];
	 	$escalationminutes_level4=$row_level_minutes['escalation_minutes_level4_c'];
		$email_template_1=$row_level_minutes['email_template_1_c'];
		$email_template_2=$row_level_minutes['email_template_2_c'];
		$email_template_3=$row_level_minutes['email_template_3_c'];
		$email_template_4=$row_level_minutes['email_template_4_c'];
		$escalated_user_level1=$row_level_minutes['user_id1_c'];
		$escalated_user_level2=$row_level_minutes['user_id2_c'];
		$escalated_user_level3=$row_level_minutes['user_id3_c'];
		$escalated_user_level4=$row_level_minutes['user_id_c'];
		$escalationid=$row_level_minutes['id'];
		//fetching case details from cases and ticket counter should less than or equal to 8 for each team
		$query_dateentered="select cases.date_entered,cases.id,cases.assigned_user_id,cases.name,cases_cstm.escalation_level_1_checkbox_c,cases_cstm.escalation_level_2_checkbox_c,cases_cstm.escalation_level_3_checkbox_c,cases_cstm.escalation_level_4_checkbox_c,cases_cstm.assigned_time_c,cases_cstm.pending_counter_c as timer,cases_cstm.ticket_counter_c as ticket_counter from cases inner join cases_cstm on cases.id=cases_cstm.id_c inner join securitygroups_records on securitygroups_records.record_id=cases.id where cases.deleted='0' and cases.state='Open' and securitygroups_records.securitygroup_id='$teams' and securitygroups_records.deleted='0' and cases_cstm.ticket_counter_c <= 8";
		$result_dateentered=$db->query($query_dateentered);
		while($row_dateentered=$db->fetchByAssoc($result_dateentered))
		{
			$case_id=$row_dateentered['id'];
			$datecreated = $row_dateentered['assigned_time_c'];
			$case_assigned_user = $row_dateentered['assigned_user_id'];
			$case_subject = $row_dateentered['name'];
			$escalationminutes_level1_checkbox=$row_dateentered['escalation_level_1_checkbox_c'];
			$escalationminutes_level2_checkbox=$row_dateentered['escalation_level_2_checkbox_c'];
			$escalationminutes_level3_checkbox=$row_dateentered['escalation_level_3_checkbox_c'];
			$escalationminutes_level4_checkbox=$row_dateentered['escalation_level_4_checkbox_c'];
		    $actual_ticket_counter = $row_dateentered['ticket_counter'];
			
			$today_date= date('Y-m-d H:i:s');
			$current_date = date('Y-m-d H:i:s', strtotime('+5 hours +30 minutes', strtotime($today_date)));
			$dt = new DateTime($current_date);
			$time = $dt->format('H:i:s'); //current time
			$week_day = date('w',strtotime('+5 hours +30 minutes', strtotime($current_date))); //week day
			/***********if week day is sat/sun(weekends)********************************/
			if($week_day == 0 || $week_day == 6)
			{
				$datetime = new DateTime('today');
				$nextdate = $datetime->format('Y-m-d 10:00:00');		
				$week_day = date('w',strtotime('+5 hours +30 minutes', strtotime($nextdate)));
				if($week_day==6){
					$nextdate = date('Y-m-d H:i:s',strtotime(' + 2 day', strtotime($nextdate))); //add two days
				}else if($week_day == 0){
					$nextdate = date('Y-m-d H:i:s',strtotime(' + 1 day', strtotime($nextdate))); //add one day if sunday
				}
				$check_next_day = date('Y-m-d H:i:s',strtotime('-5 hours -30 minutes',strtotime($nextdate)));
				$update_ticket_counter = $db->query("update cases_cstm set assigned_time_c='$check_next_day',pending_counter_c='$actual_ticket_counter' where id_c='$case_id'");
			}
			/***********************week days (Mon - Fri)*********************************************/
			else
			{
				/*******************Timings 10 AM to 1 PM and 2 PM to 6 PM(escalation should happens)********************/
				if(($time >= '10:00:00' && $time < '13:00:00') || ($time > '14:00:00' && $time < '18:00:00'))
				{
					$date1             = new DateTime($datecreated);            
				    $date2             = new DateTime($today_date);            
					$diff              = $date2->diff($date1);            
		    		$totalhours      = $diff->h; 
		    		$timer = $row_dateentered['timer']; 
					if(!empty($timer))
					{
						$totalhours = $totalhours + $timer; 
					}
					/*********************update ticket counter every 1 hour*****************************/
					$db->query("update cases_cstm set ticket_counter_c='$totalhours' where id_c='$case_id'");

					if(!empty($escalationminutes_level1) && !empty($escalationminutes_level2) && !empty($escalationminutes_level3))
					{
							/***************************checking level 1 escalation hours*****************************/
							if(($totalhours == $escalationminutes_level1) && ($escalationminutes_level1_checkbox == 1))
							{
								//fetching user details - assigned user
								$fetch_reports_to_query = "select * from users where id ='$case_assigned_user' and deleted='0'";
								$fetch_reports_to_result=$db->query($fetch_reports_to_query);
								$fetch_reports_to_row = $db->fetchByAssoc($fetch_reports_to_result);
								$reports_to_supervisor = $fetch_reports_to_row['reports_to_id'];
								$assignedusername_old = $fetch_reports_to_row['first_name'].' '.$fetch_reports_to_row['last_name'];
								if(empty($reports_to_supervisor)){
									$escalated_user_level1 = $escalated_user_level1;
								}else{
									$escalated_user_level1 = $reports_to_supervisor;
								}	
										
								//escalated to level 1 user - update assigned user with level 1 user						
								$update_case_assigned_user = "update cases set assigned_user_id='$escalated_user_level1' where deleted='0' and id='$case_id'";
								$update_case_assigned_user_result = $db->query($update_case_assigned_user);
													
								//fetch user details - escalated user details
								$select_assigned_user = "SELECT * from users where id='$escalated_user_level1' and deleted='0'";
								$select_assigned_result = $db->query($select_assigned_user);
								$select_assigned_row  = $db->fetchByAssoc($select_assigned_result);
								$assignedusername = $select_assigned_row['first_name'].' '.$select_assigned_row['last_name'];
										
								//getting assigned user email
								$select_query = "SELECT ea.email_address  as email FROM email_addr_bean_rel eabr JOIN email_addresses ea ON eabr.email_address_id = ea.id WHERE eabr.bean_id = '$escalated_user_level1' and eabr.deleted='0'";
								$select_result = $db->query($select_query);
								$select_row = $db->fetchByAssoc($select_result);
								$assignedemail= $select_row['email'];
																				
								//fetching email template
								$emailtemplate_query="SELECT body_html,subject FROM email_templates WHERE id='$email_template_1'";
								$emailtemplate_result=$db->query($emailtemplate_query);
								$emailtemplate_row=$db->fetchByAssoc($emailtemplate_result);
								$body=$emailtemplate_row['body_html'];
								$subject=$emailtemplate_row['subject'];
								$needle = '$acase_';
								$matches = array_filter(str_word_count($body,1,'_$'),
								function($item) use ($needle) 
									{
										return (levenshtein($item,$needle,1,1,0) == 0);
									}
								);
								foreach ($matches as $values) 
								{
										$correctvariables=$values;
										$queryvariables=str_replace('$acase_',"",$correctvariables);
										$query_casevariables="SELECT $queryvariables FROM cases inner join cases_cstm on cases.id=cases_cstm.id_c where id='$case_id'";
										$result_casevariables=$db->query($query_casevariables);
										$row_casevariables=$db->fetchByAssoc($result_casevariables);
										$result_case=$row_casevariables[$queryvariables];
											
										$body= str_replace(array($correctvariables),array($result_case),$body);
										$body= str_replace('$sugarurl',$sugar_config['site_url'],$body);
										$body= str_replace('Open_New',$GLOBALS['app_list_strings']['case_status_dom'][$row_casevariables['status']],$body);
										$body= str_replace('$new_assigned_user_name',$assignedusername,$body);
										$body= str_replace('$old_assigned_user_name',$assignedusername_old,$body);
										$subject= str_replace(array($correctvariables),array($result_case),$subject);
								}
								//for sending email
								$sending_mail = mailInit($assignedemail, $assignedusername, $subject, $body);
								if(!empty($update_case_assigned_user_result))
								{
										//create record in escalation audit
										$recid=create_guid();
										$query = "INSERT INTO scrm_escalation_audit(id,name,date_entered,date_modified,modified_user_id,deleted) VALUES('$recid','$case_subject','$today_date','$today_date','$escalated_user_level1',0)";
										$result= $db->query($query);
										$query_cstm="INSERT INTO scrm_escalation_audit_cstm (id_c,level_c) VALUES ('$recid','Level1')";
										$result_cstm=$db->query($query_cstm);
										//create record in relationship-escalation matrix and escalation audit
										$idrelation=create_guid();
										$query_relation="INSERT INTO scrm_escalation_matrix_scrm_escalation_audit_1_c(id,date_modified,scrm_escala593_matrix_ida,scrm_escald34en_audit_idb) VALUES ('$idrelation','$today_date','$escalationid','$recid')";
										$result_relation=$db->query($query_relation);
										//create record in relationship table - case and escalation audit
										$caserelation = create_guid();
										$query_relation="INSERT INTO cases_scrm_escalation_audit_1_c(id,date_modified,cases_scrm_escalation_audit_1cases_ida,cases_scrm_escalation_audit_1scrm_escalation_audit_idb) VALUES ('$caserelation','$today_date','$case_id','$recid')";
													$result_relation=$db->query($query_relation);
								}
								//update escalation level checkbox and ticket status				
								$update_escalation_matrix_level1 = $db->query("update cases join cases_cstm on cases.id=cases_cstm.id_c set cases_cstm.escalation_level_1_checkbox_c=0,cases.status='Open_Escalated'  where cases.deleted=0 and cases_cstm.id_c='$case_id'");
							}
								
							/*****************************checking escalation level 2************************************/	
							if(($totalhours == $escalationminutes_level2) && ($escalationminutes_level2_checkbox == 1))
							{
								//fetching user details - assigned user details
								$fetch_reports_to_query = "select * from users where id ='$case_assigned_user' and deleted='0'";
								$fetch_reports_to_result=$db->query($fetch_reports_to_query);
								$fetch_reports_to_row = $db->fetchByAssoc($fetch_reports_to_result);
								$reports_to_supervisor = $fetch_reports_to_row['reports_to_id'];
								$assignedusername_old = $fetch_reports_to_row['first_name'].' '.$fetch_reports_to_row['last_name'];
								if(empty($reports_to_supervisor)){
									$escalated_user_level2 = $escalated_user_level2;
								}else{
									$escalated_user_level2 = $reports_to_supervisor;
								}	

								//update level 2 escalated user
								$update_case_assigned_user = "update cases set assigned_user_id='$escalated_user_level2' where  deleted='0' and id='$case_id'";
								$update_case_assigned_user_result = $db->query($update_case_assigned_user);
								
								//fetch user details - level 2 escalated user details
								$select_assigned_user = "SELECT * from users where id='$escalated_user_level2' and deleted='0'";
								$select_assigned_result = $db->query($select_assigned_user);
								$select_assigned_row  = $db->fetchByAssoc($select_assigned_result);
								$assignedusername = $select_assigned_row['first_name'].' '.$select_assigned_row['last_name'];
										
								//getting assigned user email
								$select_query = "SELECT ea.email_address  as email FROM email_addr_bean_rel eabr JOIN email_addresses ea ON eabr.email_address_id = ea.id WHERE eabr.bean_id = '$escalated_user_level2' and eabr.deleted='0'";
								$select_result = $db->query($select_query);
								$select_row = $db->fetchByAssoc($select_result);
								$assignedemail= $select_row['email'];
															
								//fetching email template
								$emailtemplate_query="SELECT body_html,subject FROM email_templates WHERE id='$email_template_2'";
								$emailtemplate_result=$db->query($emailtemplate_query);
								$emailtemplate_row=$db->fetchByAssoc($emailtemplate_result);
								$body=$emailtemplate_row['body_html'];
								$subject=$emailtemplate_row['subject'];
								$needle = '$acase_';
								$matches = array_filter(str_word_count($body,1,'_$'),
									function($item) use ($needle) 
									{
										return (levenshtein($item,$needle,1,1,0) == 0);
									}
								);
								foreach ($matches as $values) 
								{
									$correctvariables=$values;
									$queryvariables=str_replace('$acase_',"",$correctvariables);
									$query_casevariables="SELECT $queryvariables FROM cases inner join cases_cstm on cases.id=cases_cstm.id_c where id='$case_id'";
									$result_casevariables=$db->query($query_casevariables);
									$row_casevariables=$db->fetchByAssoc($result_casevariables);
									$result_case=$row_casevariables[$queryvariables];
									$body= str_replace(array($correctvariables),array($result_case),$body);
									$body= str_replace('$sugarurl',$sugar_config['site_url'],$body);
									$body= str_replace('Open_New',$GLOBALS['app_list_strings']['case_status_dom'][$row_casevariables['status']],$body);
									$body= str_replace('$new_assigned_user_name',$assignedusername,$body);
									$body= str_replace('$old_assigned_user_name',$assignedusername_old,$body);
									$subject= str_replace(array($correctvariables),array($result_case),$subject);
								}
								//for sending email
								$sending_mail = mailInit($assignedemail, $assignedusername, $subject, $body);
								if(!empty($update_case_assigned_user_result))
								{
									$recid=create_guid();
									$query = "INSERT INTO scrm_escalation_audit(id,name,date_entered,date_modified,modified_user_id,deleted) VALUES('$recid','$case_subject','$today_date','$today_date','$escalated_user_level2',0)";
									$result= $db->query($query);
									$query_cstm="INSERT INTO scrm_escalation_audit_cstm (id_c,level_c) VALUES ('$recid','Level2')";
									$result_cstm=$db->query($query_cstm);
									$idrelation=create_guid();
									$query_relation="INSERT INTO scrm_escalation_matrix_scrm_escalation_audit_1_c(id,date_modified,scrm_escala593_matrix_ida,scrm_escald34en_audit_idb) VALUES ('$idrelation','$today_date','$escalationid','$recid')";
									$result_relation=$db->query($query_relation);
									$caserelation = create_guid();
									$query_relation="INSERT INTO cases_scrm_escalation_audit_1_c(id,date_modified,cases_scrm_escalation_audit_1cases_ida,cases_scrm_escalation_audit_1scrm_escalation_audit_idb) VALUES ('$caserelation','$today_date','$case_id','$recid')";
									$result_relation=$db->query($query_relation);
								}
								//update level2 escalation checkbox for particular ticket
								$update_escalation_matrix_level2 = $db->query("update cases join cases_cstm on cases.id=cases_cstm.id_c set cases_cstm.escalation_level_2_checkbox_c=0,cases.status='Open_Escalated'  where cases.deleted=0 and cases_cstm.id_c='$case_id'");
							}
							/***************checking level 3 escalation************************************/
							if(($totalhours == $escalationminutes_level3) && ($escalationminutes_level3_checkbox == 1))
							{
								//fetching user details - assigned user details
								$fetch_reports_to_query = "select * from users where id ='$case_assigned_user' and deleted='0'";
								$fetch_reports_to_result=$db->query($fetch_reports_to_query);
								$fetch_reports_to_row = $db->fetchByAssoc($fetch_reports_to_result);
								$reports_to_supervisor = $fetch_reports_to_row['reports_to_id'];
								$assignedusername_old = $fetch_reports_to_row['first_name'].' '.$fetch_reports_to_row['last_name'];
								if(empty($reports_to_supervisor)){
									$escalated_user_level3 = $escalated_user_level3;
								}else{
									$escalated_user_level3 = $reports_to_supervisor;
								}	
										
								$update_case_assigned_user = "update cases set assigned_user_id='$escalated_user_level3' where deleted='0' and id='$case_id'";
								$update_case_assigned_user_result = $db->query($update_case_assigned_user);
								
								//fetch user details
								$select_assigned_user = "SELECT * from users where id='$escalated_user_level3' and deleted='0'";
								$select_assigned_result = $db->query($select_assigned_user);
								$select_assigned_row  = $db->fetchByAssoc($select_assigned_result);
								$assignedusername = $select_assigned_row['first_name'].' '.$select_assigned_row['last_name'];
										
								//getting assigned user email
								$select_query = "SELECT ea.email_address  as email FROM email_addr_bean_rel eabr JOIN email_addresses ea ON eabr.email_address_id = ea.id WHERE eabr.bean_id = '$escalated_user_level3' and eabr.deleted='0'";
								$select_result = $db->query($select_query);
								$select_row = $db->fetchByAssoc($select_result);
								$assignedemail= $select_row['email'];
												
								//fetching email template
								$emailtemplate_query="SELECT body_html,subject FROM email_templates WHERE id='$email_template_3'";
								$emailtemplate_result=$db->query($emailtemplate_query);
								$emailtemplate_row=$db->fetchByAssoc($emailtemplate_result);
								$body=$emailtemplate_row['body_html'];
								$subject=$emailtemplate_row['subject'];
								$needle = '$acase_';
								$matches = array_filter(str_word_count($body,1,'_$'),
									function($item) use ($needle) 
									{
										return (levenshtein($item,$needle,1,1,0) == 0);
									}
								);
								foreach ($matches as $values) 
								{
									$correctvariables=$values;
									$queryvariables=str_replace('$acase_',"",$correctvariables);
									$query_casevariables="SELECT $queryvariables FROM cases inner join cases_cstm on cases.id=cases_cstm.id_c where id='$case_id'";
									$result_casevariables=$db->query($query_casevariables);
									$row_casevariables=$db->fetchByAssoc($result_casevariables);
									$result_case=$row_casevariables[$queryvariables];
									$body= str_replace(array($correctvariables),array($result_case),$body);
									$body= str_replace('$sugarurl',$sugar_config['site_url'],$body);
									$body= str_replace('Open_New',$GLOBALS['app_list_strings']['case_status_dom'][$row_casevariables['status']],$body);
									$body= str_replace('$new_assigned_user_name',$assignedusername,$body);
									$body= str_replace('$old_assigned_user_name',$assignedusername_old,$body);
									$subject= str_replace(array($correctvariables),array($result_case),$subject);
								}
								
								//for sending email
								$sending_mail = mailInit($assignedemail, $assignedusername, $subject, $body);
								if(!empty($update_case_assigned_user_result))
								{
									$recid=create_guid();
									$query = "INSERT INTO scrm_escalation_audit(id,name,date_entered,date_modified,modified_user_id,deleted) VALUES('$recid','$case_subject','$today_date','$today_date','$escalated_user_level3',0)";
									$result= $db->query($query);
									$query_cstm="INSERT INTO scrm_escalation_audit_cstm (id_c,level_c) VALUES ('$recid','Level3')";
									$result_cstm=$db->query($query_cstm);
									$idrelation=create_guid();
									$query_relation="INSERT INTO scrm_escalation_matrix_scrm_escalation_audit_1_c(id,date_modified,scrm_escala593_matrix_ida,scrm_escald34en_audit_idb) VALUES ('$idrelation','$today_date','$escalationid','$recid')";
									$result_relation=$db->query($query_relation);
									$caserelation = create_guid();
									$query_relation="INSERT INTO cases_scrm_escalation_audit_1_c(id,date_modified,cases_scrm_escalation_audit_1cases_ida,cases_scrm_escalation_audit_1scrm_escalation_audit_idb) VALUES ('$caserelation','$today_date','$case_id','$recid')";
									$result_relation=$db->query($query_relation);
								}
								//update level 3 escalation
								$update_escalation_matrix_level2 = $db->query("update cases join cases_cstm on cases.id=cases_cstm.id_c set cases_cstm.escalation_level_3_checkbox_c=0,cases.status='Open_Escalated'  where cases.deleted=0 and cases_cstm.id_c='$case_id'");
							}
							/***************checking level4 escalation************************************/
							if(!empty($escalationminutes_level4)){
								if(($totalhours == $escalationminutes_level4) && ($escalationminutes_level4_checkbox == 1))
							{
								//fetching user details - assigned user details
								$fetch_reports_to_query = "select * from users where id ='$case_assigned_user' and deleted='0'";
								$fetch_reports_to_result=$db->query($fetch_reports_to_query);
								$fetch_reports_to_row = $db->fetchByAssoc($fetch_reports_to_result);
								$reports_to_supervisor = $fetch_reports_to_row['reports_to_id'];
								$assignedusername_old = $fetch_reports_to_row['first_name'].' '.$fetch_reports_to_row['last_name'];
								if(empty($reports_to_supervisor)){
									$escalated_user_level4 = $escalated_user_level4;
								}else{
									$escalated_user_level4 = $reports_to_supervisor;
								}		
								$update_case_assigned_user = "update cases set assigned_user_id='$escalated_user_level4' where deleted='0' and id='$case_id'";
								$update_case_assigned_user_result = $db->query($update_case_assigned_user);
								
								//fetch user details
								$select_assigned_user = "SELECT * from users where id='$escalated_user_level4' and deleted='0'";
								$select_assigned_result = $db->query($select_assigned_user);
								$select_assigned_row  = $db->fetchByAssoc($select_assigned_result);
								$assignedusername = $select_assigned_row['first_name'].' '.$select_assigned_row['last_name'];
										
								//getting assigned user email
								$select_query = "SELECT ea.email_address  as email FROM email_addr_bean_rel eabr JOIN email_addresses ea ON eabr.email_address_id = ea.id WHERE eabr.bean_id = '$escalated_user_level4' and eabr.deleted='0'";
								$select_result = $db->query($select_query);
								$select_row = $db->fetchByAssoc($select_result);
								$assignedemail= $select_row['email'];
												
								//fetching email template
								$emailtemplate_query="SELECT body_html,subject FROM email_templates WHERE id='$email_template_3'";
								$emailtemplate_result=$db->query($emailtemplate_query);
								$emailtemplate_row=$db->fetchByAssoc($emailtemplate_result);
								$body=$emailtemplate_row['body_html'];
								$subject=$emailtemplate_row['subject'];
								$needle = '$acase_';
								$matches = array_filter(str_word_count($body,1,'_$'),
									function($item) use ($needle) 
									{
										return (levenshtein($item,$needle,1,1,0) == 0);
									}
								);
								foreach ($matches as $values) 
								{
									$correctvariables=$values;
									$queryvariables=str_replace('$acase_',"",$correctvariables);
									$query_casevariables="SELECT $queryvariables FROM cases inner join cases_cstm on cases.id=cases_cstm.id_c where id='$case_id'";
									$result_casevariables=$db->query($query_casevariables);
									$row_casevariables=$db->fetchByAssoc($result_casevariables);
									$result_case=$row_casevariables[$queryvariables];
									$body= str_replace(array($correctvariables),array($result_case),$body);
									$body= str_replace('$sugarurl',$sugar_config['site_url'],$body);
									$body= str_replace('Open_New',$GLOBALS['app_list_strings']['case_status_dom'][$row_casevariables['status']],$body);
									$body= str_replace('$new_assigned_user_name',$assignedusername,$body);
									$body= str_replace('$old_assigned_user_name',$assignedusername_old,$body);
									$subject= str_replace(array($correctvariables),array($result_case),$subject);
								}
								
								//for sending email
								$sending_mail = mailInit($assignedemail, $assignedusername, $subject, $body);
								if(!empty($update_case_assigned_user_result))
								{
									$recid=create_guid();
									$query = "INSERT INTO scrm_escalation_audit(id,name,date_entered,date_modified,modified_user_id,deleted) VALUES('$recid','$case_subject','$today_date','$today_date','$escalated_user_level4',0)";
									$result= $db->query($query);
									$query_cstm="INSERT INTO scrm_escalation_audit_cstm (id_c,level_c) VALUES ('$recid','Level4')";
									$result_cstm=$db->query($query_cstm);
									$idrelation=create_guid();
									$query_relation="INSERT INTO scrm_escalation_matrix_scrm_escalation_audit_1_c(id,date_modified,scrm_escala593_matrix_ida,scrm_escald34en_audit_idb) VALUES ('$idrelation','$today_date','$escalationid','$recid')";
									$result_relation=$db->query($query_relation);
									$caserelation = create_guid();
									$query_relation="INSERT INTO cases_scrm_escalation_audit_1_c(id,date_modified,cases_scrm_escalation_audit_1cases_ida,cases_scrm_escalation_audit_1scrm_escalation_audit_idb) VALUES ('$caserelation','$today_date','$case_id','$recid')";
									$result_relation=$db->query($query_relation);
								}
								//update level4 escalation
								$update_escalation_matrix_level4 = $db->query("update cases join cases_cstm on cases.id=cases_cstm.id_c set cases_cstm.escalation_level_4_checkbox_c=0,cases.status='Open_Escalated'  where cases.deleted=0 and cases_cstm.id_c='$case_id'");
							}
							}
							
					}
				}
				/*******************************timings 1PM to 2PM (Lunch Break)******************************/
				else if($time > '13:00:00' && $time <='14:00:00')
				{
					/**************************lunch break - escalation should stop and start time is 2 PM**************/
					$datetime = new DateTime('today');
					$nextdate = $datetime->format('Y-m-d 14:00:00');
					$check_next_day = date('Y-m-d H:i:s',strtotime('-5 hours -30 minutes',strtotime($nextdate)));
					/**************update pending counter with ticket counter value************************************/
	 				$update_ticket_counter = $db->query("update cases_cstm set assigned_time_c='$check_next_day',pending_counter_c='$actual_ticket_counter' where id_c='$case_id'");
	 			}
	 			/*************************************timings 6PM to 12 AM************************************/
	 			else if($time > '18:00:00' && $time <= '23:59:59')
	 			{
					/************************escalation should stop******************************/
					/**********tickets are in pending status***************/
					$datetime = new DateTime('tomorrow');
					$nextdate = $datetime->format('Y-m-d 10:00:00');		
					$week_day = date('w',strtotime('+5 hours +30 minutes', strtotime($nextdate)));//set timer to nextday10
					if($week_day==6){
						$nextdate = date('Y-m-d H:i:s',strtotime(' + 2 day', strtotime($nextdate)));//weekday sat - +2days		
					}else if($week_day == 0){
						$nextdate = date('Y-m-d H:i:s',strtotime(' + 1 day', strtotime($nextdate)));//weekday sun - +1day
					}
					$check_next_day = date('Y-m-d H:i:s',strtotime('-5 hours -30 minutes',strtotime($nextdate)));
					$update_ticket_counter = $db->query("update cases_cstm set assigned_time_c='$check_next_day',pending_counter_c='$actual_ticket_counter' where id_c='$case_id'");
				}
				/********************timings 1AM to 10AM**********************************************/
				else if($time > '01:00:00' && $time < '10:00:00')
				{
					/************************escalation should stop******************************/
					$datetime = new DateTime('today');
					$nextdate = $datetime->format('Y-m-d 10:00:00');
					$check_next_day = date('Y-m-d H:i:s',strtotime('-5 hours -30 minutes',strtotime($nextdate)));
					$update_ticket_counter = $db->query("update cases_cstm set assigned_time_c='$check_next_day',pending_counter_c='$actual_ticket_counter' where id_c='$case_id'");
				}
			}
		}
	}
}
return "SUCCESS";
}
/********************setuptimer escalation*************************/
function setuptimer_escalation(){
	global $db;
	$query = "select id,ticket_counter_c as counter from cases join cases_cstm on id=id_c where deleted=0 and ticket_counter_c <= 8 and state='Open'";
	$result = $db->query($query);
	while($row = $db->fetchByAssoc($result)){
		$case_id = $row['id'];
		$ticket_counter = $row['counter'];
		/**********tickets are in pending status***************/
		$datetime = new DateTime('tomorrow');
		$nextdate = $datetime->format('Y-m-d 10:00:00');		
		$week_day = date('w',strtotime('+5 hours +30 minutes', strtotime($nextdate)));
		if($week_day==6){
			$nextdate = date('Y-m-d H:i:s',strtotime(' + 2 day', strtotime($nextdate)));			
		}else if($week_day == 0){
			$nextdate = date('Y-m-d H:i:s',strtotime(' + 1 day', strtotime($nextdate)));	
		}
		$check_next_day = date('Y-m-d H:i:s',strtotime('-5 hours -30 minutes',strtotime($nextdate)));
		$update_ticket_counter = $db->query("update cases_cstm set assigned_time_c='$check_next_day',pending_counter_c='$ticket_counter' where id_c='$case_id'");
	
	}
	return true;
}
/***********************END****************************************/
function mailInit($to, $toName, $subject, $body) {
    //~ // include Email class
    include_once('modules/Administration/Administration.php');
    include_once('include/SugarPHPMailer.php');
    include_once('include/utils/db_utils.php'); // for from_html function
    
    $emailObj = new Email(); 
	$defaults = $emailObj->getSystemDefaultEmail(); 
		
	$mail = new SugarPHPMailer(); 
	$mail->setMailerForSystem(); 
	$mail->From = $defaults['email']; 
	$mail->FromName = $defaults['name']; 
    $mail->ClearAllRecipients();
    $mail->ClearReplyTos();
    // Add recipient
    $mail->AddAddress($to,$toName);
    // Add subject
	$mail->Subject = $subject;
    // Add mail content
	$mail->isHTML(true); // set to true if content has html tags
	$mail->Body = from_html($body);
   
    //Send mail, log if there is error
	if ($mail->Send()) {
        return 'SUCCESS';
	} else {
     $GLOBALS['log']->fatal("ERROR: Mail sending failed!");
        return 'FAIL';
    }
} 
/******************case ageing************************/
function caseAgeing(){
	global $db;	
	//~ UPDATE cases as c,cases_cstm as cc set cc.case_ageing_c=DATEDIFF(c.date_modified,c.date_entered) WHERE c.id=cc.id_c and c.deleted=0 and c.state='Closed'
	$fetch_cases = "select cases.id,cases.date_entered from cases join cases_cstm on cases.id=cases_cstm.id_c where cases.state='Open' and cases.deleted=0";
	$result_cases = $db->query($fetch_cases);
	while($row_cases_data = $db->fetchByAssoc($result_cases)){
		$created_date = $row_cases_data['date_entered'];
		$today = date('Y-m-d H:m:s', strtotime('now'));
		$difference_in_days = floor(abs(strtotime($created_date) - strtotime($today)) / 86400);
		$case_id = $row_cases_data['id'];

		$update_case_aging = $db->query("update cases_cstm set case_ageing_c='$difference_in_days' where id_c='$case_id'");	
	}
	return true;
}
/*******************end*******************************/
?>
