<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
global $db;

if($_SERVER['PHP_AUTH_USER'] == 'customer_products' && $_SERVER['PHP_AUTH_PW'] == '5n@nce@32!')
{
	$fp      = fopen('php://input', 'r');
 	$rawData = json_decode(stream_get_contents($fp));
  $uniqueCustomerCode = $rawData->uniqueCustomerCode;
  $productInterestID = $rawData->productInterestID;
 	$productSubInterestID = $rawData->productSubInterestID;
 	$productInteractionID = $rawData->InteractionID;
 	$CampaignType = $rawData->CampaignType;
 	$UTMCampaignID = $rawData->UTMCampaignID;
 	$Source = $rawData->Source;
 	//fetch product interest
 	$fetch_product_interest = "select product_interest from product_interest where id='$productInterestID'";
 	$result_product_interest = $db->query($fetch_product_interest);
 	$row_product_interest = $db->fetchByAssoc($result_product_interest);
	$fetch_sub_product_interest = "select SubProductName from sub_product_interest where subproductid='$productSubInterestID'";
 	$result_sub_product_interest = $db->query($fetch_sub_product_interest);
 	$row_sub_product_interest = $db->fetchByAssoc($result_sub_product_interest);
 	$productSubInterestNAME = $row_sub_product_interest['SubProductName'];

  $product_interest_name = $GLOBALS['app_list_strings']['product_interest_c_list'][$productInterestID];
 //echo	$sub_product_interest_name = $GLOBALS['app_list_strings']['sub_product_interest_c_list'][$productSubInterestNAME];
 	$sub_product_interest_name = $row_product_interest['product_interest'].'_'.$productSubInterestNAME;
  	if($productInteractionID == 0){
  		//fetch customer
  		$select_customer_query = "select id,assigned_user_id,CONCAT(IFNULL(first_name,''),' ',IFNULL(last_name,'')) as customer_name from contacts join contacts_cstm on id=id_c where deleted=0 and unique_customer_code_c='$uniqueCustomerCode'";
  		$result_customer_query = $db->query($select_customer_query);
  		$row_customer_query = $db->fetchByAssoc($result_customer_query);
      $contact_id = $row_customer_query['id'];
  		$contact_assigned_user_id = $row_customer_query['assigned_user_id'];
  		$contact_name = $row_customer_query['customer_name'];
  		$name = $contact_name.' - '.$row_product_interest['product_interest'].' - '.$productSubInterestNAME;
  		if($contact_id){
  			//insert product interest
  			$today_time = date('Y-m-d H:i:s');
  			$product_interest_time = date('Y-m-d H:i:s',strtotime('-5 hours -30 minutes',strtotime($today_time)));
  			$product_interest_id = create_guid();
  			$insert_product_interest = "INSERT INTO `scrm_products`(`id`, `name`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `description`, `deleted`, `assigned_user_id`) VALUES ('$product_interest_id','$name','$product_interest_time','$product_interest_time','$contact_assigned_user_id','1','',0,'$contact_assigned_user_id')";
  			$result_product_interest = $db->query($insert_product_interest);
       // echo "INSERT INTO `scrm_products_cstm`(`id_c`, `product_interest_c`,`product_sub_type_interest_c`) VALUES ('$product_interest_id','$product_interest_name','$sub_product_interest_name')";
  			$insert_product_interest_cstm = "INSERT INTO `scrm_products_cstm`(`id_c`, `product_interest_c`,`product_sub_type_interest_c`,`campaign_type_c`,`utm_campaign_id_c`,`source_c`) VALUES ('$product_interest_id','".$row_product_interest['product_interest']."','".$sub_product_interest_name."','$CampaignType','$UTMCampaignID','$Source')";
  			$result_product_interest_cstm = $db->query($insert_product_interest_cstm);
  			$product_relationship = create_guid();
  			$insert_product_relationship = "INSERT INTO `contacts_scrm_products_1_c`(`id`, `date_modified`, `deleted`, `contacts_scrm_products_1contacts_ida`, `contacts_scrm_products_1scrm_products_idb`) VALUES ('$product_relationship',NOW(),0,'$contact_id','$product_interest_id')";
  			$result_product_relationship = $db->query($insert_product_relationship);
  			$msg = array(
                'Success' => true,
                'Message' => 'User Product interest added Successfully',
            );
  		}
  	}
  	
			
	}else{
			$msg = array(
					'Success' => false,
					'Message' => 'Invalid Data',
									
				);
	}

	echo json_encode($msg);

?>