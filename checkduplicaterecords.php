<?php

if (!define('sugarEntry'))
    define('sugarEntry', true);
require_once('include/entryPoint.php');
require_once('config.php');
ini_set('display_errors', 'On');
global $db, $app_list_strings, $sugar_config;



$duplicate_query = "select id, unique_customer_code_c as customer_code,count(*) as count from contacts join contacts_cstm on id=id_c where deleted=0 and unique_customer_code_c!='' AND disposition_c = '' group by customer_code having count>1 ORDER BY date_modified DESC";
//and date_modified BETWEEN CURDATE() - INTERVAL 1 DAY AND CURDATE()
$duplicate_result = $db->query($duplicate_query);

while ($duplicate_row = $db->fetchByAssoc($duplicate_result)) {

    $customer_code = $duplicate_row['customer_code'];
    $count = $duplicate_row['count'];
    $first_customer_id = $duplicate_row['id'];
    echo "Customer Code - ".$customer_code;
    $fullrecord_query = "select id, unique_customer_code_c as customer_code from contacts join contacts_cstm on id=id_c where deleted=0 and unique_customer_code_c ='" . $customer_code . "' and id NOT IN ('$first_customer_id')";
    $fullrecord_result = $db->query($fullrecord_query);


    while ($getrecords = $db->fetchByAssoc($fullrecord_result)) {
        $contact_id = $getrecords['id']; 
  

        //Check Calls start
        $calls_id_query = "select calls_contacts.call_id as call_id from contacts, calls_contacts where contacts.deleted=0 and calls_contacts.deleted=0 and calls_contacts.contact_id=contacts.id and calls_contacts.contact_id='$contact_id'";
        $calls_id_result = $db->query($calls_id_query);

        while ($calls_id_row = $db->fetchByAssoc($calls_id_result)) {
           
            echo "Calls------>";
              echo  $calls_id_duplicate = $calls_id_row['call_id'];
             

//			//update Call id to existing contact
			 $update_call_id = "INSERT INTO calls_contacts( id, call_id, deleted, date_modified, contact_id ) VALUES (UUID(),'$calls_id_duplicate','0',NOW(),'$first_customer_id')";
			$update_call_result =$db->query($update_call_id);
                        if(isset($update_call_result)){
                            echo "===inserted=";
                        }
			
			 $call_query_update = "update calls_contacts set deleted = 1, date_modified = NOW() where call_id = '$calls_id_duplicate' and contact_id = '$contact_id'";
			$call_result_update = $db->query($call_query_update);
                        if(isset($update_call_result)){
                            echo "updated";
                        }
        }
        //Check Calls End
        //Check Tickets start
        $cases_id_query = "select contacts_cases.case_id as case_id from contacts, contacts_cases where contacts.deleted=0 and contacts_cases.deleted=0 and contacts_cases.contact_id=contacts.id and contacts_cases.contact_id='$contact_id'";
        $cases_id_result = $db->query($cases_id_query);

        while ($cases_id_row = $db->fetchByAssoc($cases_id_result)) {
             echo "Cases------>";
                echo   $cases_id_duplicate = $cases_id_row['case_id'];
            //update case id to existing contact
			 $update_case_id = "INSERT INTO contacts_cases( id, case_id, deleted, date_modified, contact_id ) VALUES (UUID(),'$cases_id_duplicate','0',NOW(),'$first_customer_id')";
			$update_case_result =$db->query($update_case_id);
			
                         if(isset($update_case_result)){
                            echo "===inserted=";
                        }
                        
			 $case_query_update = "update contacts_cases set deleted = 1, date_modified = NOW() where case_id = '$calls_id_duplicate' and contact_id = '$contact_id'";
			$case_result_update = $db->query($case_query_update);
                          if(isset($case_result_update)){
                            echo "updated";
                        }
                        
        }
        //Check Tickets End
        //Check Users start
        $users_id_query = "select contacts_users.user_id as user_id from contacts, contacts_users where contacts.deleted=0 and contacts_users.deleted=0 and contacts_users.contact_id=contacts.id and contacts_users.contact_id='$contact_id'";
        $users_id_result = $db->query($users_id_query);

        while ($users_id_row = $db->fetchByAssoc($users_id_result)) {
             echo "Users------>";
                echo   $users_id_duplicate = $users_id_row['user_id'];
            //update Users id to existing contact
			 $update_users_id = "INSERT INTO contacts_users( id, user_id, deleted, date_modified, contact_id ) VALUES (UUID(),'$users_id_duplicate','0',NOW(),'$first_customer_id')";
			$update_users_result =$db->query($update_users_id);
                          if(isset($update_users_result)){
                            echo "===inserted=";
                        }
			
			 $users_query_update = "update contacts_users set deleted = 1, date_modified = NOW() where user_id = '$users_id_duplicate' and contact_id = '$contact_id'";
			$users_result_update = $db->query($users_query_update);
                         if(isset($users_result_update)){
                            echo "updated";
                        }
            
        }
        //Check Users End
        //Check redemption details start
        $redemption_id_query = "select contacts_scrm_redemption_details_1_c.contacts_scrm_redemption_details_1scrm_redemption_details_idb as contacts_scrm_redemption_details_1scrm_redemption_details_idb from contacts, contacts_scrm_redemption_details_1_c where contacts.deleted=0 and contacts_scrm_redemption_details_1_c.deleted=0 and contacts_scrm_redemption_details_1_c.contacts_scrm_redemption_details_1contacts_ida=contacts.id and contacts_scrm_redemption_details_1_c.contacts_scrm_redemption_details_1contacts_ida='$contact_id'";
        $redemption_id_result = $db->query($redemption_id_query);

        while ($redemption_id_row = $db->fetchByAssoc($redemption_id_result)) {
             echo "Redemption------>";
             echo   $redemption_id_duplicate = $redemption_id_row['contacts_scrm_redemption_details_1scrm_redemption_details_idb'];
            //update redemption id to existing contact
			 $update_redemption_id = "INSERT INTO contacts_scrm_redemption_details_1_c( id, contacts_scrm_redemption_details_1scrm_redemption_details_idb, deleted, date_modified, contacts_scrm_redemption_details_1contacts_ida ) VALUES (UUID(),'$redemption_id_duplicate','0',NOW(),'$first_customer_id')";
			$update_redemption_result =$db->query($update_case_id);
                          if(isset($update_redemption_result)){
                            echo "===inserted=";
                        }
			
			 $redemption_query_update = "update contacts_scrm_redemption_details_1_c set deleted = 1, date_modified = NOW() where contacts_scrm_redemption_details_1scrm_redemption_details_idb = '$redemption_id_duplicate' and contacts_scrm_redemption_details_1contacts_ida = '$contact_id'";
			$redemption_result_update = $db->query($redemption_query_update);
                         if(isset($redemption_result_update)){
                            echo "updated";
                        }
        }
        //Check redemption details End
        //Check Meetings start
        $meetings_id_query = "select meetings_contacts.meeting_id as meeting_id from contacts, meetings_contacts where contacts.deleted=0 and meetings_contacts.deleted=0  and meetings_contacts.contact_id=contacts.id and meetings_contacts.contact_id='$contact_id'";
        $meetings_id_result = $db->query($meetings_id_query);

        while ($meetings_id_row = $db->fetchByAssoc($meetings_id_result)) {
              echo "Meetings------>";
               echo $meetings_id_duplicate = $meetings_id_row['meeting_id'];
//			//update meetings id to existing contact
			 $update_meetings_id = "INSERT INTO meetings_contacts( id, meeting_id, deleted, date_modified, contact_id ) VALUES (UUID(),'$meetings_id_duplicate','0',NOW(),'$first_customer_id')";
			$update_meetings_result =$db->query($update_meetings_id);
                           if(isset($update_meetings_result)){
                            echo "===inserted=";
                        }
			
			 $meetings_query_update = "update meetings_contacts set deleted = 1, date_modified = NOW() where call_id = '$meetings_id_duplicate' and contact_id = '$contact_id'";
			$meetings_result_update = $db->query($meetings_query_update);
                        if(isset($meetings_result_update)){
                            echo "updated";
                        }
        }
        //Check Meetings End
        //Check Opportunity start
        $opportunity_id_query = "select opportunities_contacts.opportunity_id as opportunity_id from contacts, opportunities_contacts where contacts.deleted=0 and opportunities_contacts.deleted=0 and opportunities_contacts.contact_id=contacts.id and opportunities_contacts.contact_id='$contact_id'";
        $opportunity_id_result = $db->query($opportunity_id_query);

        while ($opportunity_id_row = $db->fetchByAssoc($opportunity_id_result)) {
              echo "Opportunity------>";
            echo      $opportunity_id_duplicate = $meetings_id_row['opportunity_id'];
//			//update Call id to existing contact
			 $update_opportunity_id = "INSERT INTO opportunities_contacts( id, opportunity_id, deleted, date_modified, contact_id ) VALUES (UUID(),'$opportunity_id_duplicate','0',NOW(),'$first_customer_id')";
			$update_opportunity_result =$db->query($update_opportunity_id);
                          if(isset($update_opportunity_result)){
                            echo "===inserted=";
                        }
			
			 $opportunity_query_update = "update opportunities_contacts set deleted = 1, date_modified = NOW() where opportunity_id = '$opportunity_id_duplicate' and contact_id = '$contact_id'";
			$opportunity_result_update = $db->query($opportunity_query_update);
                         if(isset($opportunity_result_update)){
                            echo "updated";
                        }
        }
        //Check opportunity End
        //Check Document start
        $document_id_query = "select documents_contacts.document_id as document_id from contacts, documents_contacts where contacts.deleted=0 and documents_contacts.deleted=0 and documents_contacts.contact_id=contacts.id and documents_contacts.contact_id='$contact_id'";
        $document_id_result = $db->query($document_id_query);

        while ($document_id_row = $db->fetchByAssoc($document_id_result)) {
              echo "Document------>";
                 echo  $document_id_duplicate = $document_id_row['document_id'];
//			//update Document id to existing contact
			 $update_document_id = "INSERT INTO documents_contacts( id, document_id, deleted, date_modified, contact_id ) VALUES (UUID(),'$document_id_duplicate','0',NOW(),'$first_customer_id')";
			$update_document_result =$db->query($update_document_id);
                          if(isset($update_document_result)){
                            echo "===inserted=";
                        }
			
			 $document_query_update = "update documents_contacts set deleted = 1, date_modified = NOW() where document_id = '$document_id_duplicate' and contact_id = '$contact_id'";
			$document_result_update = $db->query($document_query_update);
                         if(isset($document_result_update)){
                            echo "updated";
                        }
        }
        //Check Document End
        //Check accounts End
        $account_id_query = "select accounts_contacts.account_id as account_id from contacts, accounts_contacts where contacts.deleted=0 and accounts_contacts.deleted=0 and accounts_contacts.contact_id=contacts.id and accounts_contacts.contact_id='$contact_id'";
        $account_id_result = $db->query($account_id_query);

        while ($account_id_row = $db->fetchByAssoc($account_id_result)) {
            echo "Account------>";
               echo $account_id_duplicate = $account_id_row['account_id'];
//			//update account id to existing contact
			 $update_account_id = "INSERT INTO accounts_contacts( id, account_id, deleted, date_modified, contact_id ) VALUES (UUID(),'$account_id_duplicate','0',NOW(),'$first_customer_id')";
			$update_account_result =$db->query($update_account_id);
                         if(isset($update_account_result)){
                            echo "===inserted=";
                        }
			
			 $account_query_update = "update accounts_contacts set deleted = 1, date_modified = NOW() where account_id = '$account_id_duplicate' and contact_id = '$contact_id'";
			$account_result_update = $db->query($account_query_update);
                          if(isset($account_result_update)){
                            echo "updated";
                        }
        }
        //Check accounts End
        //Check Orders start
        $orders_id_query = "select contacts_scrm_my_orders_1_c.contacts_scrm_my_orders_1scrm_my_orders_idb as contacts_scrm_my_orders_1scrm_my_orders_idb from contacts, contacts_scrm_my_orders_1_c where contacts.deleted=0 and contacts_scrm_my_orders_1_c.deleted=0 and contacts_scrm_my_orders_1_c.contacts_scrm_my_orders_1contacts_ida=contacts.id and contacts_scrm_my_orders_1_c.contacts_scrm_my_orders_1contacts_ida='$contact_id'";
        $orders_id_result = $db->query($orders_id_query);

        while ($orders_id_row = $db->fetchByAssoc($orders_id_result)) {
             echo "Orders------>";
             echo   $orders_id_duplicate = $orders_id_row['contacts_scrm_my_orders_1scrm_my_orders_idb'];
                
//			//update Orders id to existing contact
			 $update_orders_id = "INSERT INTO contacts_scrm_my_orders_1_c( id, contacts_scrm_my_orders_1scrm_my_orders_idb, deleted, date_modified, contacts_scrm_my_orders_1contacts_ida ) VALUES (UUID(),'$orders_id_duplicate','0',NOW(),'$first_customer_id')";
			$update_orders_result =$db->query($update_orders_id);
                         if(isset($update_orders_result)){
                            echo "===inserted=";
                        }
			
			 $orders_query_update = "update contacts_scrm_my_orders_1_c set deleted = 1, date_modified = NOW() where contacts_scrm_my_orders_1scrm_my_orders_idb = '$orders_id_duplicate' and contacts_scrm_my_orders_1contacts_ida = '$contact_id'";
			$orders_result_update = $db->query($orders_query_update);
             if(isset($orders_result_update)){
                            echo "updated";
                        }
        }
        //Check Orders End
        //Check SIP start
        $sip_id_query = "select contacts_scrm_sip_1_c.contacts_scrm_sip_1scrm_sip_idb as contacts_scrm_sip_1scrm_sip_idb from contacts, contacts_scrm_sip_1_c where contacts.deleted=0 and contacts_scrm_sip_1_c.deleted=0 and contacts_scrm_sip_1_c.contacts_scrm_sip_1contacts_ida=contacts.id and contacts_scrm_sip_1_c.contacts_scrm_sip_1contacts_ida='$contact_id'";
        $sip_id_result = $db->query($sip_id_query);

        while ($sip_id_row = $db->fetchByAssoc($sip_id_result)) {
             echo "SIP------>";
                echo   $sip_id_duplicate = $sip_id_row['contacts_scrm_sip_1scrm_sip_idb'];
//                
//			//update SIP id to existing contact
			 $update_sip_id = "INSERT INTO contacts_scrm_sip_1_c( id, contacts_scrm_sip_1scrm_sip_idb, deleted, date_modified, contacts_scrm_sip_1contacts_ida ) VALUES (UUID(),'$sip_id_duplicate','0',NOW(),'$first_customer_id')";
			$update_sip_result =$db->query($update_sip_id);
                          if(isset($update_sip_result)){
                            echo "===inserted=";
                        }
			
			 $sip_query_update = "update contacts_scrm_sip_1_c set deleted = 1, date_modified = NOW() where contacts_scrm_sip_1scrm_sip_idb = '$sip_id_duplicate' and contacts_scrm_sip_1contacts_ida = '$contact_id'";
			$sip_result_update = $db->query($sip_query_update);
                         if(isset($sip_result_update)){
                            echo "updated";
                        }
        }
        //Check SIP End
        //Check ECs Mandate start
        $ecs_mandate_id_query = "select contacts_scrm_ecs_mandate_1_c.contacts_scrm_ecs_mandate_1scrm_ecs_mandate_idb as contacts_scrm_ecs_mandate_1scrm_ecs_mandate_idb from contacts, contacts_scrm_ecs_mandate_1_c where contacts.deleted=0 and contacts_scrm_ecs_mandate_1_c.deleted=0 and contacts_scrm_ecs_mandate_1_c.contacts_scrm_ecs_mandate_1contacts_ida=contacts.id and contacts_scrm_ecs_mandate_1_c.contacts_scrm_ecs_mandate_1contacts_ida='$contact_id'";
        $ecs_mandate_id_result = $db->query($ecs_mandate_id_query);

        while ($ecs_mandate_id_row = $db->fetchByAssoc($ecs_mandate_id_result)) {
              echo "ECs Mandate------>";
              echo   $ecs_mandate_id_duplicate = $ecs_mandate_id_row['contacts_scrm_ecs_mandate_1scrm_ecs_mandate_idb'];
//                
			//update ECs Mandiate id to existing contact
			 $update_ecs_mandate_id = "INSERT INTO contacts_scrm_ecs_mandate_1_c( id, contacts_scrm_ecs_mandate_1scrm_ecs_mandate_idb, deleted, date_modified, contacts_scrm_ecs_mandate_1contacts_ida ) VALUES (UUID(),'$ecs_mandate_id_duplicate','0',NOW(),'$first_customer_id')";
			$update_ecs_mandate_result =$db->query($update_ecs_mandate_id);
                         if(isset($update_ecs_mandate_result)){
                            echo "===inserted=";
                        }
			
			 $ecs_mandate_query_update = "update contacts_scrm_ecs_mandate_1_c set deleted = 1, date_modified = NOW() where contacts_scrm_ecs_mandate_1scrm_ecs_mandate_idb = '$ecs_mandate_id_duplicate' and contacts_scrm_ecs_mandate_1contacts_ida = '$contact_id'";
			$ecs_mandate_result_update = $db->query($ecs_mandate_query_update);
                         if(isset($ecs_mandate_result_update)){
                            echo "updated";
                        }
        }
        //Check ECs Mandate End
        //Check My Goals start
        $goals_id_query = "select contacts_scrm_goals_1_c.contacts_scrm_goals_1scrm_goals_idb as contacts_scrm_goals_1scrm_goals_idb from contacts, contacts_scrm_goals_1_c where contacts.deleted=0 and contacts_scrm_goals_1_c.deleted=0 and contacts_scrm_goals_1_c.contacts_scrm_goals_1contacts_ida=contacts.id and contacts_scrm_goals_1_c.contacts_scrm_goals_1contacts_ida='$contact_id'";
        $goals_id_result = $db->query($goals_id_query);

        while ($goals_id_row = $db->fetchByAssoc($goals_id_result)) {
               echo "Goals------>";
              echo   $goals_id_duplicate = $goals_id_row['contacts_scrm_goals_1scrm_goals_idb'];
//                
			//update Goal id to existing contact
			 $update_goals_id = "INSERT INTO contacts_scrm_goals_1_c( id, contacts_scrm_goals_1scrm_goals_idb, deleted, date_modified, contacts_scrm_goals_1contacts_ida ) VALUES (UUID(),'$goals_id_duplicate','0',NOW(),'$first_customer_id')";
			$update_goals_result =$db->query($update_goals_id);
                         if(isset($update_goals_result)){
                            echo "===inserted=";
                        }
			
			 $goals_query_update = "update contacts_scrm_goals_1_c set deleted = 1, date_modified = NOW() where contacts_scrm_goals_1scrm_goals_idb = '$goals_id_duplicate' and contacts_scrm_goals_1contacts_ida = '$contact_id'";
			$goals_result_update = $db->query($goals_query_update);
                         if(isset($goals_result_update)){
                            echo "updated<br>";
                        }
        }
        //Check My Goals End
        //Check Bank Details start
        $bankdetail_id_query = "select contacts_scrm_bank_details_1_c.contacts_scrm_bank_details_1scrm_bank_details_idb as contacts_scrm_bank_details_1scrm_bank_details_idb from contacts, contacts_scrm_bank_details_1_c where contacts.deleted=0 and contacts_scrm_bank_details_1_c.deleted=0 and contacts_scrm_bank_details_1_c.contacts_scrm_bank_details_1contacts_ida=contacts.id and contacts_scrm_bank_details_1_c.contacts_scrm_bank_details_1contacts_ida='$contact_id'";
        $bankdetail_id_result = $db->query($bankdetail_id_query);

        while ($bankdetail_id_row = $db->fetchByAssoc($bankdetail_id_result)) {
               echo "Bank Details------>";
                  echo   $bankdetail_id_duplicate = $bankdetail_id_row['contacts_scrm_bank_details_1scrm_bank_details_idb'];
//                
//			//update bankdetail id to existing contact
			 $update_bankdetail_id = "INSERT INTO contacts_scrm_bank_details_1_c( id, contacts_scrm_bank_details_1scrm_bank_details_idb, deleted, date_modified, contacts_scrm_bank_details_1contacts_ida ) VALUES (UUID(),'$bankdetail_id_duplicate','0',NOW(),'$first_customer_id')";
			$update_bankdetail_result =$db->query($update_bankdetail_id);
                         if(isset($update_bankdetail_result)){
                            echo "===inserted=";
                        }
			
			 $bankdetail_query_update = "update contacts_scrm_bank_details_1_c set deleted = 1, date_modified = NOW() where contacts_scrm_bank_details_1scrm_bank_details_idb = '$bankdetail_id_duplicate' and contacts_scrm_bank_details_1contacts_ida = '$contact_id'";
			$bankdetail_result_update = $db->query($bankdetail_query_update);
                         if(isset($bankdetail_result_update)){
                            echo "updated";
                        }
        }
        //Check Bank Details End
        //Check Callback Request start
        $callbackrequest_id_query = "select contacts_scrm_callback_request_1_c.contacts_scrm_callback_request_1scrm_callback_request_idb as contacts_scrm_callback_request_1scrm_callback_request_idb from contacts, contacts_scrm_callback_request_1_c where contacts.deleted=0 and contacts_scrm_callback_request_1_c.deleted=0 and contacts_scrm_callback_request_1_c.contacts_scrm_callback_request_1contacts_ida=contacts.id and contacts_scrm_callback_request_1_c.contacts_scrm_callback_request_1contacts_ida='$contact_id'";
        $callbackrequest_id_result = $db->query($callbackrequest_id_query);

        while ($callbackrequest_id_row = $db->fetchByAssoc($callbackrequest_id_result)) {
             echo "Callback Request------>";
                echo   $callbackrequest_id_duplicate = $callbackrequest_id_row['contacts_scrm_callback_request_1scrm_callback_request_idb'];
//                
			//update Call Back Request id to existing contact
			 $update_callbackrequest_id = "INSERT INTO contacts_scrm_callback_request_1_c( id, contacts_scrm_callback_request_1scrm_callback_request_idb, deleted, date_modified, contacts_scrm_callback_request_1contacts_ida ) VALUES (UUID(),'$callbackrequest_id_duplicate','0',NOW(),'$first_customer_id')";
			$update_callbackrequest_result =$db->query($update_callbackrequest_id);
                        if(isset($update_callbackrequest_result)){
                            echo "===inserted=";
                        }
			
			 $callbackrequest_query_update = "update contacts_scrm_callback_request_1_c set deleted = 1, date_modified = NOW() where contacts_scrm_callback_request_1scrm_callback_request_idb = '$callbackrequest_id_duplicate' and contacts_scrm_callback_request_1contacts_ida = '$contact_id'";
			$callbackrequest_result_update = $db->query($callbackrequest_query_update);
                         if(isset($callbackrequest_result_update)){
                            echo "updated";
                        }
        }
        //Check Callback Request End
        //Check Nominees start
        $nominees_id_query = "select contacts_scrm_nominees_1_c.contacts_scrm_nominees_1scrm_nominees_idb as contacts_scrm_nominees_1scrm_nominees_idb from contacts, contacts_scrm_nominees_1_c where contacts.deleted=0 and contacts_scrm_nominees_1_c.deleted=0 and contacts_scrm_nominees_1_c.contacts_scrm_nominees_1contacts_ida=contacts.id and contacts_scrm_nominees_1_c.contacts_scrm_nominees_1contacts_ida='$contact_id'";
        $nominees_id_result = $db->query($nominees_id_query);

        while ($nominees_id_row = $db->fetchByAssoc($nominees_id_result)) {
              echo "Nominees------>";
            echo $nominees_id_duplicate = $nominees_id_row['contacts_scrm_nominees_1scrm_nominees_idb'];
//                
			//update Nominees id to existing contact
			 $update_nominees_id = "INSERT INTO contacts_scrm_nominees_1_c( id, contacts_scrm_nominees_1scrm_nominees_idb, deleted, date_modified, contacts_scrm_nominees_1contacts_ida ) VALUES (UUID(),'$nominees_id_duplicate','0',NOW(),'$first_customer_id')";
			$update_nominees_result =$db->query($update_nominees_id);
                         if(isset($update_nominees_result)){
                            echo "===inserted=";
                        }
			
			 $nominees_query_update = "update contacts_scrm_nominees_1_c set deleted = 1, date_modified = NOW() where contacts_scrm_nominees_1scrm_nominees_idb = '$nominees_id_duplicate' and contacts_scrm_nominees_1contacts_ida = '$contact_id'";
			$nominees_result_update = $db->query($nominees_query_update);
                          if(isset($nominees_result_update)){
                            echo "updated";
                        }
        }
        //Check Nominees End
        
           //Check Risk Profile Allocation start
        $riskprofile_id_query = "select contacts_scrm_risk_profile_1_c.contacts_scrm_risk_profile_1scrm_risk_profile_idb as contacts_scrm_risk_profile_1scrm_risk_profile_idb from contacts, contacts_scrm_risk_profile_1_c where contacts.deleted=0 and contacts_scrm_risk_profile_1_c.deleted=0 and contacts_scrm_risk_profile_1_c.contacts_scrm_risk_profile_1contacts_ida=contacts.id and contacts_scrm_risk_profile_1_c.contacts_scrm_risk_profile_1contacts_ida='$contact_id'";
        $riskprofile_id_result = $db->query($riskprofile_id_query);

        while ($riskprofile_id_row = $db->fetchByAssoc($riskprofile_id_result)) {
            echo "Risk Profile------>";
            echo $riskprofile_id_duplicate = $riskprofile_id_row['contacts_scrm_risk_profile_1scrm_risk_profile_idb'];
          
//			//update Risk Profile Allocation id to existing contact
			 $update_riskprofile_id = "INSERT INTO contacts_scrm_risk_profile_1_c( id, contacts_scrm_risk_profile_1scrm_risk_profile_idb, deleted, date_modified, contacts_scrm_risk_profile_1contacts_ida ) VALUES (UUID(),'$riskprofile_id_duplicate','0',NOW(),'$first_customer_id')";
			//$update_riskprofile_result =$db->query($update_riskprofile_id);
			 if(isset($update_riskprofile_result)){
                            echo "===inserted=";
                       }
			 $riskprofile_query_update = "update contacts_scrm_risk_profile_1_c set deleted = 1, date_modified = NOW() where contacts_scrm_risk_profile_1scrm_risk_profile_idb = '$riskprofile_id_duplicate' and contacts_scrm_risk_profile_1contacts_ida = '$contact_id'";
			//$riskprofile_result_update = $db->query($riskprofile_query_update);
                         if(isset($riskprofile_result_update)){
                           echo "updated";
                        }
        }
        //Check Risk Profile Allocation End
        
        
         //Check Loans start
        $loans_id_query = "select contacts_scrm_loans_1_c.contacts_scrm_loans_1scrm_loans_idb as contacts_scrm_loans_1scrm_loans_idb from contacts, contacts_scrm_loans_1_c where contacts.deleted=0 and contacts_scrm_loans_1_c.deleted=0 and contacts_scrm_loans_1_c.contacts_scrm_loans_1contacts_ida=contacts.id and contacts_scrm_loans_1_c.contacts_scrm_loans_1contacts_ida='$contact_id'";
        $loans_id_result = $db->query($loans_id_query);

        while ($loans_id_row = $db->fetchByAssoc($loans_id_result)) {
                echo "Loans------>";
            echo $loans_id_duplicate = $loans_id_row['contacts_scrm_loans_1scrm_loans_idb'];
//                
//			//update Loans Profile Allocation id to existing contact
			 $update_loans_id = "INSERT INTO contacts_scrm_loans_1_c( id, contacts_scrm_loans_1scrm_loans_idb, deleted, date_modified, contacts_scrm_loans_1contacts_ida ) VALUES (UUID(),'$loans_id_duplicate','0',NOW(),'$first_customer_id')";
			$update_loans_result =$db->query($update_loans_id);
                         if(isset($update_loans_result)){
                            echo "===inserted=";
                       }
			
			 $loans_query_update = "update contacts_scrm_loans_1_c set deleted = 1, date_modified = NOW() where contacts_scrm_loans_1scrm_loans_idb = '$loans_id_duplicate' and contacts_scrm_loans_1contacts_ida = '$contact_id'";
			$loans_result_update = $db->query($loans_query_update);
                         if(isset($loans_result_update)){
                           echo "updated";
                        }
        }
        //Check Loans End
        
           //Check Equity start
        $equity_id_query = "select contacts_scrm_equity_1_c.contacts_scrm_equity_1scrm_equity_idb as contacts_scrm_equity_1scrm_equity_idb from contacts, contacts_scrm_equity_1_c where contacts.deleted=0 and contacts_scrm_equity_1_c.deleted=0 and contacts_scrm_equity_1_c.contacts_scrm_equity_1contacts_ida=contacts.id and contacts_scrm_equity_1_c.contacts_scrm_equity_1contacts_ida='$contact_id'";
        $equity_id_result = $db->query($equity_id_query);

        while ($equity_id_row = $db->fetchByAssoc($equity_id_result)) {
                echo "Equity------>";
            echo $equity_id_duplicate = $equity_id_row['contacts_scrm_equity_1scrm_equity_idb'];
               
//			//update equity id to existing contact
			 $update_equity_id = "INSERT INTO contacts_scrm_equity_1_c( id, contacts_scrm_equity_1scrm_equity_idb, deleted, date_modified, contacts_scrm_equity_1contacts_ida ) VALUES (UUID(),'$equity_id_duplicate','0',NOW(),'$first_customer_id')";
			$update_equity_result =$db->query($update_equity_id);
                         if(isset($update_equity_result)){
                            echo "===inserted=";
                       }
			
			 $equity_query_update = "update contacts_scrm_equity_1_c set deleted = 1, date_modified = NOW() where contacts_scrm_equity_1scrm_equity_idb = '$equity_id_duplicate' and contacts_scrm_equity_1contacts_ida = '$contact_id'";
			$equity_result_update = $db->query($equity_query_update);
                         if(isset($equity_result_update)){
                           echo "updated";
                        }
        }
        //Check Equity End
        
        
        
        //delete contact_id duplicate
			$update_contact_id= "UPDATE contacts set deleted='1' where id='$contact_id'";
			$update_contact_result = $db->query($update_contact_id);
                        if(isset($update_contact_result)){
                            echo "----->".$contact_id."==deleted";
                        }
      echo  "<br/>";

    }

//exit;
    unset($customer_code);
}
?>

