<?php
class ConversionClass{
	
	function ConversionMethod($bean, $event, $arguments){
		
		global $db,$current_user,$sugar_config;
		
		if((($bean->status == 'Valid')||($bean->fetched_row['status']=='Valid')) && ($bean->converted == 0)){
				
				//Auto Conversion of Contact			
					$contact = new Contact();		
					$contact->first_name = $bean->first_name;
					$contact->middle_name_c = $bean->middle_name_c;
					$contact->last_name = $bean->last_name;
					$email = $bean->email1;
					$contact->phone_mobile = $bean->phone_mobile;
					$contact->unique_customer_code_c = $usercreationresult['id'];
					$gateway_leads = $bean->gateway_c;
					switch ($gateway_leads) {
						case 'CRM-5NANCE.COM':	$gateway_leads = '5nance.com'; break;
						case 'CRM-CORPORATE':	$gateway_leads = 'Corporate Channel'; break;
						case 'CRM-OFFLINE':	$gateway_leads = 'Offline Marketing'; break;
						case 'CRM- M.P ONLINE':	$gateway_leads = 'CSC- M.P Online'; break;
						case 'CRM-CSC':	$gateway_leads = 'CSC- Rajasthan emitra'; break;
						case 'CRM-MARKETING':	$gateway_leads = 'Digital Marketing'; break;
						case 'CRM-EMITRA':	$gateway_leads = 'CSC- Rajasthan emitra'; break;
						case 'CRM-REFERENCE':	$gateway_leads = 'Digital Marketing'; break;
						default: $gateway_leads = '';	break;
					}
					$contact->gateway_c = $gateway_leads;
					$contact->campaign_type_c = $GLOBALS['app_list_strings']['campaign_type_list'][$bean->campaign_type_c];
					$contact->campaign_sub_type_c = $GLOBALS['app_list_strings']['sub_campaign_type_list'][$bean->campaign_sub_type_c];
					$contact->id = '';
					$contact->save(false);
					$contactid = $contact->id;
					//Inserting Email Address
					$emailaddress_id = create_guid();
					$email_insert_query = "INSERT INTO  email_addresses (id,email_address,date_created,date_modified,deleted) VALUES ('$emailaddress_id' ,'$email',now(),now(),0)"; 
					$email_insert_result = $db->query($email_insert_query);
					
					//Email Address
					$insert_query = "INSERT INTO  email_addr_bean_rel (id,email_address_id, bean_id,bean_module,primary_address,reply_to_address,date_created,date_modified, deleted) VALUES (UUID(),'$emailaddress_id','$contactid','Contacts',1,0,now(),now(),0)"; 
					$insert_result = $db->query($insert_query);  
					$bean->disposition_c  = 'Valid_Interested_Candidate';	
					$insert_query_lead = "UPDATE leads join leads_cstm on leads.id=leads_cstm.id_c SET contact_id='$contactid',converted='1',status='Valid',disposition_c='Valid_Interested_Candidate' Where id = '".$bean->id."' and deleted='0'"; 
					$insert_result_lead = $db->query($insert_query_lead); 

		}
	}
}

?>
