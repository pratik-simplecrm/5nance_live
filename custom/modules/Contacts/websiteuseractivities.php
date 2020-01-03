<?php
if (!define('sugarEntry'))
    define('sugarEntry', true);
require_once('include/entryPoint.php');
include_once('include/SugarPHPMailer.php');
include_once('include/utils/db_utils.php');
include('custom/include/language/en_us.lang.php');
include('include/language/en_us.lang.php');
global $db,$sugar_config;
if($_SERVER['PHP_AUTH_USER'] == '5nance' && $_SERVER['PHP_AUTH_PW'] == '5n@nce#123!')
{
		if(!empty($_REQUEST))
		{
			//post data from backend office
			$uniqueCustomerCode = $_REQUEST['uniqueCustomerCode'];
			$panno = str_replace('&#039;','', $_REQUEST['panno']);
			$investorname = str_replace('&#039;','', $_REQUEST['investorname']);
			$kyc_status = str_replace('&#039;','', $_REQUEST['kycstatus']);
			$investor_id = str_replace('&#039;','', $_REQUEST['investor_id']);
			$bank_name = str_replace('&#039;','', $_REQUEST['bankname']);
			$account_number = str_replace('&#039;','', $_REQUEST['accountno']);
			$document_submission_center = str_replace('&#039;','', $_REQUEST['submission_center']);
			$mandate_id = str_replace('&#039;','', $_REQUEST['mandateid']);

			$today_date= date('Y-m-d H:i:s');
			
			if(!empty($document_submission_center)){
				switch (strtolower($document_submission_center)) {
					case 'courier':
					$document_submission_center='Courier';
					break;
					case 'pickup':
					$document_submission_center='Pickup';
					break;
					case 'download':
					$document_submission_center='Download';
					break;
					default:
						$document_submission_center= '';
						break;
				}
			}

			if(!empty($uniqueCustomerCode))
			{
				//echo $uniqueCustomerCode;
				/************fetch contact details************************/
				$fetch_contact_details = "select * from contacts join contacts_cstm where id=id_c and deleted=0 and unique_customer_code_c='$uniqueCustomerCode'";
				$result_contact_details = $db->query($fetch_contact_details);
				if($result_contact_details->num_rows > 0)
				{

					$row_contact_details = $db->fetchByAssoc($result_contact_details);
					$customer_id = $row_contact_details['id'];
					$customer_mobile = $row_contact_details['phone_mobile'];
					$assigned_user_id = $row_contact_details['assigned_user_id'];

					if((!empty($panno) || $panno!=0) && (!empty($kyc_status)))
					{
						if(!empty($kyc_status)){
							switch (strtolower($kyc_status)) {
								case 'verified':
									$kyc_status = 'Verified';
									break;
								case 'not-verified':
									$kyc_status = 'Non_Verified';
									break;
								case 'non verified':
									$kyc_status = 'Non_Verified';
									break;
								case 'notverified':
									$kyc_status = 'Non_Verified';
									break;
								case 'nonverified':
									$kyc_status = 'Non_Verified';
									break;
								case 'Kyc Not verified':
									$kyc_status = 'Non_Verified';
									break;					
								default:
									$kyc_status='Non_Verified';
									break;
							}
						}
						/************check the unique customer code in CRM************************/
						$update_contact_kyc_details = $db->query("update contacts join contacts_cstm set kyc_verification_status_c='$kyc_status',date_modified='$today_date' where id=id_c and deleted=0 and unique_customer_code_c='$uniqueCustomerCode'");
						//popup reminder to user
						$insert_popup = "INSERT INTO alerts  (id,name,date_entered,date_modified,modified_user_id,created_by,description,deleted,assigned_user_id,is_read,target_module,type,url_redirect) VALUES (UUID(),'KYC status updated for the customer
						Mobile:$customer_mobile',NOW(),NOW(),'1','1','Kindly touch with user ASAP.','0','$assigned_user_id','0','Contacts','info','index.php?action=DetailView&module=Contacts&record=$customer_id')";
						$insert_popup_result = $db->query($insert_popup);
						$msg = array(
										'Success' => true,
										'Message' => 'Customer KYC is updated successfully'
									);
					}

					if((!empty($bank_name) || !empty($account_number)) && ($investor_id!=0))
					{
						/*****************check the uploaded cheque image************************/
						$update_cheque_status = $db->query("update contacts join contacts_cstm set uploaded_cheque_image_c='Yes',date_modified='$today_date' where id=id_c and deleted=0 and unique_customer_code_c='$uniqueCustomerCode'");
						//popup reminder to user
						$insert_popup = "INSERT INTO alerts  (id,name,date_entered,date_modified,modified_user_id,created_by,description,deleted,assigned_user_id,is_read,target_module,type,url_redirect) VALUES (UUID(),'Customer uploaded cheque image
						Mobile:$customer_mobile',NOW(),NOW(),'1','1','Kindly touch with user ASAP.','0','$assigned_user_id','0','Contacts','info','index.php?action=DetailView&module=Contacts&record=$customer_id')";
						$insert_popup_result = $db->query($insert_popup);
						$msg = array(
										'Success' => true,
										'Message' => 'Customer cheque info updated successfully'
									);
					}
					if(!empty($document_submission_center))
					{
						if(trim(strtolower($document_submission_center)=='download')){
							//echo 'document submission center updated successfully';
						/******************check document submission center**********************/
						$update_document_submisssion = $db->query("update contacts join contacts_cstm set document_submitted_center_c='Download',date_modified='$today_date' where id=id_c and deleted=0 and unique_customer_code_c='$uniqueCustomerCode'");
						//popup reminder to user
						$insert_popup = "INSERT INTO alerts  (id,name,date_entered,date_modified,modified_user_id,created_by,description,deleted,assigned_user_id,is_read,target_module,type,url_redirect) VALUES (UUID(),'Customer Downloaded account opening form
						Mobile:$customer_mobile',NOW(),NOW(),'1','1','Kindly touch with user ASAP.','0','$assigned_user_id','0','Contacts','info','index.php?action=DetailView&module=Contacts&record=$customer_id')";
						$insert_popup_result = $db->query($insert_popup);
						$msg = array(
										'Success' => true,
										'Message' => 'Document downloaded account opening form successfully'
									);
						}else{
							//echo 'document submission center updated successfully';
						/******************check document submission center**********************/
						$update_document_submisssion = $db->query("update contacts join contacts_cstm set document_submitted_center_c='$document_submission_center',date_modified='$today_date' where id=id_c and deleted=0 and unique_customer_code_c='$uniqueCustomerCode'");
						//popup reminder to user
						$insert_popup = "INSERT INTO alerts  (id,name,date_entered,date_modified,modified_user_id,created_by,description,deleted,assigned_user_id,is_read,target_module,type,url_redirect) VALUES (UUID(),'Customer updated document submitted center
						Mobile:$customer_mobile',NOW(),NOW(),'1','1','Kindly touch with user ASAP.','0','$assigned_user_id','0','Contacts','info','index.php?action=DetailView&module=Contacts&record=$customer_id')";
						$insert_popup_result = $db->query($insert_popup);
						$msg = array(
										'Success' => true,
										'Message' => 'Document submission center updated successfully'
									);
						}
						
					}

				}else{
					$msg = array(
								'Success' => false,
								'Message' => 'Customer is not found in CRM'
							);
				}

		}else{
			$msg = array(
		        'Success' => false,
		        'Message' => 'Please enter unique customer code'
		    );
		}
	}else{
		$msg = array(
	        'Success' => false,
	        'Message' => 'Oops! Something went wrong'
	    );
	}

}else{
		$msg = array(
	        'Success' => false,
	        'Message' => 'Authentication Failed'
	    );
}

echo json_encode($msg);

?>