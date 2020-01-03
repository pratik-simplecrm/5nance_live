<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
global $db;

if($_SERVER['PHP_AUTH_USER'] == 'products' && $_SERVER['PHP_AUTH_PW'] == '5n@nce@32!')
{
	$fp      = fopen('php://input', 'r');
 	$rawData = json_decode(stream_get_contents($fp));
 	$product_number = $rawData->ProductID;
  	$product_name = $rawData->ProductName;
  	$fetch_products_query = $db->query("select * from product_interest where id='$product_number'");
        if ($fetch_products_query->num_rows != 0) {
            $db->query("update product_interest set product_interest='$product_name' where id='$product_number'");
            $msg = array(
                'Success' => true,
                'Message' => 'Product interest updated Successfully',
            );
        } else {
            $db->query("INSERT INTO product_interest (id,product_interest) VALUES ('$product_number','$product_name')");
            $msg = array(
                'Success' => true,
                'Message' => 'Product interest created Successfully',
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