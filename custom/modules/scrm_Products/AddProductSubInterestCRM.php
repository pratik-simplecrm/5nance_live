<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
global $db;

if($_SERVER['PHP_AUTH_USER'] == 'products' && $_SERVER['PHP_AUTH_PW'] == '5n@nce@32!')
{
	$fp      = fopen('php://input', 'r');
 	$rawData = json_decode(stream_get_contents($fp));
 	$sub_product_number = $rawData->SubproductID;
    $sub_product_name = $rawData->SubproductName;
  	$ProductID = $rawData->ProductID;
  	$fetch_products_query = $db->query("select * from sub_product_interest where subproductid='$sub_product_number'");
        if ($fetch_products_query->num_rows != 0) {
            $db->query("update sub_product_interest set SubProductName='$sub_product_name' where subproductid='$sub_product_number'");
            $msg = array(
                'Success' => true,
                'Message' => 'Product interest updated Successfully',
            );
        } else {
            $db->query("INSERT INTO sub_product_interest (subproductid,SubProductName,productid) VALUES ('$sub_product_number','$sub_product_name','$ProductID')");
            $msg = array(
                'Success' => true,
                'Message' => 'Sub Product interest created Successfully',
            );
        }
			
	}else{
			$msg = array(
					'Success' => false,
					'Message' => 'Invalid Product',
									
				);
	}

	echo json_encode($msg);

?>