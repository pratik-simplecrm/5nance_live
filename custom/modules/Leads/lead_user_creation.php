<?php

class UserCreation {

    function usercreationmethod($bean, $event, $arguments) {
        global $db, $sugar_config;
        $email = $bean->email1;
        $mobile = $bean->phone_mobile;
        //campaign and gateway
        $campaign = $bean->campaign_type_c;
        $gateway = $bean->gateway_c;
        //gateway -- Marketing
        //campaign -- auto validated
// 		if($gateway == 'CRM-MARKETING'){
// 			if($bean->lead_assignment_check_c==1){
// 				//$GLOBALS['log']->fatal($gateway."gateway testing");
// 				/***********check auto validations***************************/
// 			$query = "select auto_validated_c,id from scrm_campaign_source join scrm_campaign_source_cstm on id=id_c where deleted=0 and source_id='$campaign'";
// 			$result = $db->query($query);
// 			$row = $db->fetchByAssoc($result);
// 			$auto_validate_check = $row['auto_validated_c'];
// 			if($auto_validate_check == '1'){
// 				/********convert to contact*********************/
// 				if($bean->converted == 0){
// 					//Auto Conversion of Contact			
// 					$contact = new Contact();		
// 					$contact->first_name = $bean->first_name;
// 					$contact->middle_name_c = $bean->middle_name_c;
// 					$contact->last_name = $bean->last_name;
// 					$email = $bean->email1;
// 					$contact->phone_mobile = $bean->phone_mobile;
// 					$contact->unique_customer_code_c = $usercreationresult['id'];
// 					$gateway_leads = $bean->gateway_c;
// 					switch ($gateway_leads) {
// 						case 'CRM-5NANCE.COM':	$gateway_leads = '5nance.com'; break;
// 						case 'CRM-CORPORATE':	$gateway_leads = 'Corporate Channel'; break;
// 						case 'CRM-OFFLINE':	$gateway_leads = 'Offline Marketing'; break;
// 						case 'CRM- M.P ONLINE':	$gateway_leads = 'CSC- M.P Online'; break;
// 						case 'CRM-CSC':	$gateway_leads = 'CSC- Rajasthan emitra'; break;
// 						case 'CRM-MARKETING':	$gateway_leads = 'Digital Marketing'; break;
// 						case 'CRM-EMITRA':	$gateway_leads = 'CSC- Rajasthan emitra'; break;
// 						case 'CRM-REFERENCE':	$gateway_leads = 'Digital Marketing'; break;
// 						default: $gateway_leads = '';	break;
// 					}
// 					$contact->gateway_c = $gateway_leads;
// 					$contact->campaign_type_c = $GLOBALS['app_list_strings']['campaign_type_list'][$bean->campaign_type_c];
// 					$contact->campaign_sub_type_c = $GLOBALS['app_list_strings']['sub_campaign_type_list'][$bean->campaign_sub_type_c];
// 					$contact->id = '';
// 					$contact->save(false);
// 					$contactid = $contact->id;
// 					//Inserting Email Address
// 					$emailaddress_id = create_guid();
// 					$email_insert_query = "INSERT INTO  email_addresses (id,email_address,date_created,date_modified,deleted) VALUES ('$emailaddress_id' ,'$email',now(),now(),0)"; 
// 					$email_insert_result = $db->query($email_insert_query);
// 					//Email Address
// 					$insert_query = "INSERT INTO  email_addr_bean_rel (id,email_address_id, bean_id,bean_module,primary_address,reply_to_address,date_created,date_modified, deleted) VALUES (UUID(),'$emailaddress_id','$contactid','Contacts',1,0,now(),now(),0)"; 
// 					$insert_result = $db->query($insert_query);  
// 					$bean->disposition_c  = 'Valid_Interested_Candidate';	
// 					$insert_query_lead = "UPDATE leads join leads_cstm on leads.id=leads_cstm.id_c SET contact_id='$contactid',converted='1',status='Valid',disposition_c='Valid_Interested_Candidate' Where id = '".$bean->id."' and deleted='0'"; 
// 					$insert_result_lead = $db->query($insert_query_lead); 
// 					$bean->lead_assignment_check_c = 0;
// 				}
// 		}else{
// 			if($bean->created_by == '1'){
// 						/***********assigns to team leader**********************/
// 				// $fetch_team_leader = $db->query("select users.id from users join acl_roles_users on users.id=acl_roles_users.user_id and acl_roles_users.deleted=0 join acl_roles on acl_roles.id=acl_roles_users.role_id and acl_roles.deleted=0 where users.deleted=0 and acl_roles.name='Call Center Team Leader'");
// 				// $result_team_leader = $db->fetchByAssoc($fetch_team_leader);
// 				$db->query("update leads join leads_cstm on id=id_c set assigned_user_id='1',lead_assignment_check_c=0 where deleted=0 and id='".$bean->id."'");
// 			//	$bean->lead_assignment_check_c = 0;
// 				//$bean->save();
// 			}else{
// 				global $current_user;
// 				$db->query("update leads join leads_cstm on id=id_c set assigned_user_id='".$current_user->id."',lead_assignment_check_c=0 where deleted=0 and id='".$bean->id."'");
// 			}
// 		}
// 			}
// 	}
// //		else{
        //$GLOBALS['log']->fatal("entereing to this");
        $otpdata = $bean->encrypted_otp_c;
        if (empty($bean->first_name)) {
            $fullname = $bean->last_name;
        } else {
            $fullname = $bean->first_name . ' ' . $bean->last_name;
        }
        $otp = $bean->otp_c;
        $gateway = $bean->gateway_c;
        switch ($gateway) {
            case 'CRM-5NANCE.COM': $gateway = '9';
                break;
            case 'CRM-CORPORATE': $gateway = '10';
                break;
            case 'CRM-OFFLINE': $gateway = '11';
                break;
            case 'CRM- M.P ONLINE': $gateway = '12';
                break;
            case 'CRM-CSC': $gateway = '13';
                break;
            case 'CRM-MARKETING': $gateway = '14';
                break;
            case 'CRM-EMITRA': $gateway = '14';
                break;
            case 'CRM-REFERENCE': $gateway = '14';
                break;
            case 'CRM-CORPORATE SALES': $gateway = '10';
                break;
            default: $gateway = '';
                break;
        }
        /*         * *********post data**************** */
        if (!empty($otp)) {
            $url = $sugar_config['registeruser'];
            $data = array(
                'FullName' => $fullname,
                'UserName' => $email,
                'MobileNumber' => $mobile,
                'OTP' => $otp,
                'VerifiedMobileNo' => $mobile,
                'EncryptedOTP' => $otpdata,
                'projecttypeid' => $gateway,
                'callingfrom' => 'crm',
            );
            $postData = json_encode($data);
            $GLOBALS['log']->fatal(print_r($postData, true) . "testing");
//print_r($postData);exit; 
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_POST, count($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization:Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI',
                'Content-Type: application/json',
                'Content-Length: ' . strlen($postData)));
            $result = curl_exec($ch);
            curl_close($ch);
            $usercreationresult = json_decode($result, true);
            //print_r($usercreationresult);exit;
            $GLOBALS['log']->fatal(print_r($postData, true) . "OTP result");
            $GLOBALS['log']->fatal(print_r($usercreationresult, true) . "OTP result");
            $GLOBALS['log']->fatal($usercreationresult['message'] . "OTP result");
            if ($usercreationresult['message'] == 'User Registered') {
                if ($bean->converted == 0) {

                    //Auto Conversion of Contact		
                    $query = "select * from contacts join contacts_cstm on id=id_c where deleted=0 and unique_customer_code_c='" . $usercreationresult['id'] . "'";
                    $result = $db->query($query);
                    $contact_count = $result->num_rows;
                    $contact_row = $db->fetchByAssoc($result);

 $GLOBALS['log']->fatal("Contact Count :" . $contact_count );
                    if ($contact_count == 0) {
                        $insert_customer_code = $db->query("INSERT INTO customer_code (customer_code) VALUES ('" . $usercreationresult['id'] . "')");
                       $select_customer_code = $db->query("select customer_code from customer_code where customer_code = '" . $usercreationresult['id'] . "'");
                        if ($select_customer_code->num_rows == 1) {
  $GLOBALS['log']->fatal("Contact Count :" . $contact_count . ": Inserted result :". $bean->phone_mobile);
                        $contact = new Contact();
                        $contact->id = '';
                        $GLOBALS['log']->fatal("Contact Count :" . $contact_count . ": Inserted result");




                        $contact->first_name = $bean->first_name;
                        $contact->middle_name_c = $bean->middle_name_c;
                        $contact->last_name = $bean->last_name;
                        $email = $bean->email1;
                        $contact->phone_mobile = $bean->phone_mobile;
                        $contact->unique_customer_code_c = $usercreationresult['id'];


                        $product_interest_c = explode(",", str_replace("^", "", $bean->product_interest_c));
                        $product_sub_interest_c = explode(",", str_replace("^", "", $bean->product_sub_interest_c));



                        $contact->product_interest_c = $product_interest_c[0];
                        $contact->product_sub_type_interest_c = $product_sub_interest_c[0];

                        unset($product_interest_c[0]);
                        unset($product_sub_interest_c[0]);

                        $gateway_leads = $bean->gateway_c;
                        switch ($gateway_leads) {
                            case 'CRM-5NANCE.COM': $gateway_leads = '5nance.com';
                                break;
                            case 'CRM-CORPORATE': $gateway_leads = 'Corporate Channel';
                                break;
                            case 'CRM-OFFLINE': $gateway_leads = 'Offline Marketing';
                                break;
                            case 'CRM- M.P ONLINE': $gateway_leads = 'CSC- M.P Online';
                                break;
                            case 'CRM-CSC': $gateway_leads = 'CSC- Rajasthan emitra';
                                break;
                            case 'CRM-MARKETING': $gateway_leads = 'Digital Marketing';
                                break;
                            case 'CRM-EMITRA': $gateway_leads = 'CSC- Rajasthan emitra';
                                break;
                            case 'CRM-REFERENCE': $gateway_leads = 'Digital Marketing';
                                break;
                            case 'CRM-CORPORATE SALES': $gateway_leads = 'Corporate Channel';
                                break;
                            default: $gateway_leads = '';
                                break;
                        }
                        $contact->gateway_c = $gateway_leads;
                        $campaign_type_c = $GLOBALS['app_list_strings']['campaign_type_list'][$bean->campaign_type_c];
                        $campaign_sub_type_c = $GLOBALS['app_list_strings']['sub_campaign_type_list'][$bean->campaign_sub_type_c];
                        $contact->campaign_c = $bean->source_c;
                        $justdial_category_c = $bean->justdial_category_c;
                        $contact->monthly_income_details_c = $bean->monthly_income_details_c;
                        $contact->source_of_income_c = $bean->source_of_income_c;
                        $contact->comments_c = $bean->description;
                        $contact->campaign_city_c = $bean->campaign_city_c;
                        $contact->state_c = $bean->state_c;
                        $contact->city_c = $bean->city_dependent_c;
                        $contact->annual_income_c = $bean->annual_income_c;
                        $contact->age_c = $bean->age_c;
                        $contact->assigned_user_id = $bean->assigned_user_id;
                        $contact->leadid_c = $bean->leadid_c;
                        $contact->lead_generation_date_c = $bean->date_entered;


                        $contact->save(false);
                        $contactid = $contact->id;
                        //$GLOBALS['log']->fatal("UPDATE contacts join contacts_cstm on id=id_c set gateway_c='$gateway_leads',campaign_type_c='$campaign_type_c',campaign_sub_type_c='$campaign_sub_type_c',justdial_category_c='$justdial_category_c' where deleted=0 and id='$contactid'");
                        $db->query("UPDATE contacts join contacts_cstm on id=id_c set gateway_c='$gateway_leads',campaign_type_c='$campaign_type_c',campaign_sub_type_c='$campaign_sub_type_c',justdial_category_c='$justdial_category_c' where deleted=0 and id='$contactid'");
                        // $GLOBALS['log']->fatal($product_interest_c[0]."PRODUCT INTEREST");
                        // $GLOBALS['log']->fatal($product_sub_interest_c[0]."PRODUCT SUB INTEREST");
                        // $GLOBALS['log']->fatal($gateway_leads."GATEWAY LEADS");
                        // $GLOBALS['log']->fatal($GLOBALS['app_list_strings']['campaign_type_list'][$bean->campaign_type_c]."CAMPAING TYPE LEADS");
                        // $GLOBALS['log']->fatal($GLOBALS['app_list_strings']['sub_campaign_type_list'][$bean->campaign_sub_type_c]."CAMPAING SUBTYPE LEADS");
                        // $GLOBALS['log']->fatal(print_r($contact,true)."CONTACT CREATION BEAN");
                        //Creating products under subpanel of contact



                        foreach ($product_sub_interest_c as $psubint) {
                            foreach ($product_interest_c as $pint) {
                                if (in_array($psubint, $GLOBALS['app_list_strings']['product_sub_type_' . str_replace(" ", "_", $pint) . '_list'])) {
                                    //    echo $psubint . "==" . $pint . "<br>";

                                    $product = new scrm_Products();

                                    $product->name = $bean->first_name . " " . $bean->middle_name_c . " " . $bean->last_name . "-" . $pint . "-" . $psubint;
                                    $product->product_interest_c = $pint;
                                    $product->product_sub_type_interest_c = $psubint;
                                    $product->sales_stage_c = "User";
                                    $product->disposition_c = "";

                                    $product->assigned_user_id = $bean->assigned_user_id;
                                    $product->assigned_user_name = $bean->assigned_user_name;
                                    $product->created_by_link = $bean->assigned_user_id;
                                    $product_id = $product->save();
                                    $contact->load_relationship('contacts_scrm_products_1');
                                    $contact->contacts_scrm_products_1->add($product_id);

                                    //                        $insert_query_relationship = "INSERT INTO contacts_scrm_products_1_c (id,date_modified, deleted, contacts_scrm_products_1contacts_ida, contacts_scrm_products_1scrm_products_idb) VALUES (UUID(),now(),0,'$bean->id','$product_id')";
                                    //                        $insert_result_relationship = $db->query($insert_query_relationship);
                                    break;
                                }
                            }
                        }

                        foreach ($product_interest_c as $pint) {
                            if (!array_key_exists('product_sub_type_' . str_replace(" ", "_", $pint) . '_list', $GLOBALS['app_list_strings'])) {
                                $product = new scrm_Products();
                                $product->name = $bean->first_name . " " . $bean->middle_name_c . " " . $bean->last_name . " - " . $pint . " - " . $psubint;
                                $product->product_interest_c = $pint;
                                $product->product_sub_type_interest_c = "";
                                $product->sales_stage_c = "User";
                                $product->disposition_c = "";

                                $product->assigned_user_id = $bean->assigned_user_id;
                                $product->assigned_user_name = $bean->assigned_user_name;
                                $product->created_by_link = $bean->assigned_user_id;
                                $product_id = $product->save();
                                $contact->load_relationship('contacts_scrm_products_1');
                                $contact->contacts_scrm_products_1->add($product_id);
                            }
                        }
                        /*                         * ************END-Product Creation******************** */
                        //Inserting Email Address
                        $emailaddress_id = create_guid();
                        $email_insert_query = "INSERT INTO  email_addresses (id,email_address,date_created,date_modified,deleted) VALUES ('$emailaddress_id' ,'$email',now(),now(),0)";
                        $email_insert_result = $db->query($email_insert_query);

                        //Email Address
                        $insert_query = "INSERT INTO  email_addr_bean_rel (id,email_address_id, bean_id,bean_module,primary_address,reply_to_address,date_created,date_modified, deleted) VALUES (UUID(),'$emailaddress_id','$contactid','Contacts',1,0,now(),now(),0)";
                        $insert_result = $db->query($insert_query);
                        $bean->disposition_c = 'Valid_Interested_Candidate';
                        $insert_query_lead = "UPDATE leads join leads_cstm on leads.id=leads_cstm.id_c SET contact_id='$contactid',converted='1',status='Valid',disposition_c='Valid_Interested_Candidate' Where id = '" . $bean->id . "' and deleted='0'";
                        $insert_result_lead = $db->query($insert_query_lead);
                    }
                }
                }
            } else {
                // $bean->disposition_c  = 'Invalid_Invalid_OTP';	
                // $bean->status  = 'Invalid';	
                // $bean->save();
            }
        }
    }

    // $LeadUpdateBean = BeanFactory::getBean('Leads',$bean->id);
    // $LeadUpdateBean->save();
    // //$bean->save();
//	}
}

?>
