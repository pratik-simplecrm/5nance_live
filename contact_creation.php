<?php
if (!define('sugarEntry'))
    define('sugarEntry', true);
require_once('include/entryPoint.php');
include_once('include/SugarPHPMailer.php');
include_once('include/utils/db_utils.php');
include('custom/include/language/en_us.lang.php');
include('include/language/en_us.lang.php');
/*
echo date('Y-m-d H:i:s');exit;
*/
Contact_Creation();

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
	//echo '<pre>';print_r($GetUserData);exit;
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
	foreach($GetUserData as $GetUserSet){
		
		//$responseData = array();
		
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
//$productInterest = 'Term Insurance';
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
                if (in_array($productInterest, $GLOBALS['app_list_strings'][$product_list_name])) {
                    $product = $pinterest;
                    break;
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
			if($gateway == 'EXTERNALBO'){
				$gateway = 'Digital Marketing';
			}
			if(strpos($gateway,'-')!==false){
				$gateway_array = explode("-", $gateway);
				$gateway = $gateway_array[0];
			}
			$gateway = getdropdown($sessionID,"Contacts",$gateway,$fieldname);
			if($gateway == 'Corporate Channel'){
				$relatedCorporateAccount = $GetUserSet["publisherName"];
				//$publisherName = '';
			}
		}
		
		 $name_value_list = array(
					(!empty($salutation) ? array('name' => 'salutation','value' => $salutation) : ''),
					(!empty($first_name) ? array('name' => 'first_name','value' => trim($first_name)) : ''),
					(!empty($middle_name) ? array('name' => 'middle_name_c','value' => trim($middle_name)) : ''),
					(!empty($last_name) ? array('name' => 'last_name','value' => trim($last_name)) : ''),
					(!empty($emailID) ? array('name' => 'email1','value' => $emailID) : ''),
					(!empty($mobileNumber) ? array('name' => 'phone_mobile','value' => $mobileNumber) : ''),
					(!empty($uniqueCustomerCode) ? array('name' => 'unique_customer_code_c','value' => $uniqueCustomerCode) : ''),
					(!empty($address) ? array('name' => 'address_c','value' => $address) : ''),
					(!empty($city) ? array('name' => 'city_c','value' => $get_city_code) : ''),
					(!empty($state) ? array('name' => 'state_c','value' => $get_state_code) : ''),
					(!empty($pinCode) ? array('name' => 'postalcode_c','value' => $get_postal_code) : ''),
					(!empty($gateway) ? array('name' => 'gateway_c','value' => $gateway) : ''),
					(!empty($campaignType) ? array('name' => 'campaign_type_c','value' => $campaignType) : ''),
					(!empty($campaignSubType) ? array('name' => 'campaign_sub_type_c','value' => $campaignSubType) : ''),
					(!empty($relatedCorporateAccount) ? array('name' => 'related_corporate_account_c','value' => $relatedCorporateAccount) : ''),
					(!empty($relatedKioskAccount) ? array('name' => 'related_kiosk_account_c','value' => $relatedKioskAccount) : ''),
					(!empty($userType) ? array('name' => 'user_type_c','value' => $userType) : ''),
					(!empty($adoptionPercentage) ? array('name' => 'adoption_percentage_c','value' => $adoptionPercentage) : ''),
					(!empty($classificationOfTheAccountForPotential) ? array('name' => 'classification_accoun_c','value' => $classificationOfTheAccountForPotential) : ''),
					(!empty($publisherID) ? array('name' => 'publisher_id_c','value' => $publisherID) : ''),
					(!empty($publisherName) ? array('name' => 'publisher_name_c','value' => $publisherName) : ''),
					(!empty($userCreationDate) ? array('name' => 'date_entered','value' => $userCreationDate) : ''),
					(!empty($riskProfile) ? array('name' => 'risk_profiling_questions_c','value' => $riskProfile) : ''),
					(!empty($leadDate) ? array('name' => 'lead_generation_date_c','value' => $leadDate) : ''),
					(!empty($FirstCalledOn) ? array('name' => 'date_of_first_call_c','value' => $FirstCalledOn) : '0000-00-00 00:00:00'),
					(!empty($FirstDisposition) ? array('name' => 'status_of_first_call_c','value' => $FirstDisposition) : ''),
					(!empty($SecondCalledOn) ? array('name' => 'date_of_second_call_c','value' => $SecondCalledOn) : '0000-00-00 00:00:00'),
					(!empty($SecondDisposition) ? array('name' => 'status_of_second_call_c','value' => $SecondDisposition) : ''),
					(!empty($ThirdCalledOn) ? array('name' => 'date_of_third_call_c','value' => $ThirdCalledOn) : '0000-00-00 00:00:00'),
					(!empty($ThirdDisposition) ? array('name' => 'status_of_third_call_c','value' => $ThirdDisposition) : ''),
					(!empty($DateOfValidation) ? array('name' => 'date_of_validation_c','value' => $DateOfValidation) : ''),
					(!empty($Lastadvisor) ? array('name' => 'validation_exe_assigned_c','value' => $Lastadvisor) : ''),
					(!empty($Age) ? array('name' => 'age_of_the_user_c','value' => $Age) : ''),
					(!empty($Age) ? array('name' => 'age_c','value' => $Age) : ''),
					(!empty($AgreeToAssignAdvisor) ? array('name' => 'agreed_to_assign_c','value' => $AgreeToAssignAdvisor) : ''),
					(!empty($PrefferedDateToCall) ? array('name' => 'preferred_date_to_call_c','value' => $PrefferedDateToCall) : ''),
					(!empty($PrefferedTimeToCall) ? array('name' => 'preferred_date_to_time_c','value' => $PrefferedTimeToCall) : ''),
					(!empty($Gender) ? array('name' => 'gender_c','value' => $Gender) : ''),
					(!empty($comments) ? array('name' => 'comments_c','value' => $comments) : ''),
					(!empty($lastDisposition) ? array('name' => 'final_disposition_c','value' => $lastDisposition) : ''),
					(!empty($batchID) ? array('name' => 'batch_id_c','value' => $batchID) : ''),
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
				);
				/*************************check unique code exists or not******************************/
				if(!empty($uniqueCustomerCode)){
					$get_unique_code_query = $db->query("select id,date_modified,modified_user_id from contacts join contacts_cstm where id=id_c and deleted=0 and unique_customer_code_c = '$uniqueCustomerCode'");
					if($get_unique_code_query->num_rows == 0){
						$name_value_list[] = array('name' => 'disposition_c','value' => '');
						$module1 = 'Contacts';
	            $insert_customer_code = $db->query("INSERT INTO customer_code (customer_code) VALUES ('" . $uniqueCustomerCode . "')");
              
                $select_customer_code = $db->query("select customer_code from customer_code where customer_code = '" . $uniqueCustomerCode . "'");
               
                $status = "Inside 1st condition Inserted! - $insert_customer_code - Total Records : $select_customer_code->num_rows";
						$logMessage = "\n\nScheduler Result at $timestamp :- $status";
						fwrite($schedulerHandle, $logMessage);
                if ($select_customer_code->num_rows == 1) {
						$user_creation = create_user($sessionID,"Contacts",$name_value_list);
						$user_creation_object = $user_creation->entry_list;
						if(isset($user_creation_object->unique_customer_code_c->value)){
							$created_user="Function Worked Successfully, Response Array : ".print_r($user_creation,true);
							}else{
							$created_user="Function Doesn't Worked Successfully, Response Array : ".print_r($user_creation,true);
							}
						$status = "User Created Successfully! - $name - $created_user";
						$logMessage = "\n\nScheduler Result at $timestamp :- $status";
						fwrite($schedulerHandle, $logMessage);
					}
					}else{
						$row_unique_code = $db->fetchByAssoc($get_unique_code_query);
						$name_value_list[] = array('name' => 'id','value' => $row_unique_code['id']);
						$name_value_list[] = array('name' => 'date_modified','value' => $row_unique_code['date_modified']);
						$name_value_list[] = array('name' => 'modified_user_id','value' => $row_unique_code['modified_user_id']);
						$name_value_list[] = array('name' => 'update_date_modified','value' => 0);
						$name_value_list[] = array('name' => 'update_modified_by','value' => 0);
						
						// $GLOBALS['log']->fatal(print_r($name_value_list,true)."array name value list");
						$user_creation = create_user($sessionID,"Contacts",$name_value_list);
						echo '<pre>';print_r($user_creation);
						$user_creation_object = $user_creation->entry_list;
						$status = "User Updated Successfully! - $name";
						$logMessage = "\n\nScheduler Result at $timestamp :- $status";
						fwrite($schedulerHandle, $logMessage);
					}
					$user_creation_object = $user_creation->entry_list;
					$user_creation_id = $user_creation->id;
				}else{
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
				
				send_response_data($responseData);
				print_r($responseData);
			exit;
			}
					
					
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
function send_response_data($responseData){
	global $sugar_config; 
$postData = json_encode($responseData);

$url = $sugar_config['updateusersstatus'];
/***************log file***************************/
$schedulerLogFile = '/var/www/html/crm/WebsiteAPILogs/updateusersstatus_testing1.txt';  
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
print_r($GetUserDataforCRM);
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
              //~ print_r($setuserEntryID);
              //~ print_r($create_user);
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
	print_r($set_relationships_parameters);
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

    $getdropdownvalues = $getdropdownresult->$fieldname->options;

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
