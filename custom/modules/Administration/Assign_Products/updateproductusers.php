<?php
if(!defined('sugarEntry')) define('sugarEntry', true);
require_once('include/entryPoint.php');
require_once('config.php');

	global $db, $sugar_config;
        
$querycheck = 'SELECT 1 FROM assign_products';
$query_result = $db->query($querycheck);
if ($query_result === FALSE) {
    $create_table = $db->query("create table assign_products(id int NOT NULL AUTO_INCREMENT,product_id VARCHAR(100) NOT NULL,product_name VARCHAR(250) NOT NULL,users_id LONGTEXT, date_modified VARCHAR(100), created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (id))");
}

$select_query = "SELECT * FROM assign_products WHERE product_id='" . $_POST['pid'] . "'";
$get_query = $db->query($select_query);
$data = $db->fetchByAssoc($get_query);

$get_query->num_rows;
$date_modified = date("d-m-Y h:i:s");

$pid= $_POST['pid'];
$pname= $_POST['product'];
$users= base64_encode(serialize($_POST['users']));
if ($get_query->num_rows == 0) {

 $insert="INSERT INTO assign_products (product_id,product_name, users_id, date_modified) VALUES ('" . $pid . "','".$pname."', '" . $users . "','" . $date_modified . "')";
    $content_query = $db->query($insert);
    if($content_query){
  echo $result="Users added successfully";
    }
} else {
 $update="Update assign_products SET users_id='" . $users . "',product_name='".$pname."',date_modified='" . $date_modified . "' where product_id='" . $data['product_id'] . "'";
    $content_query = $db->query($update);
     if($content_query){
  echo $result="Users Updated successfully";
    }
}

//$users_query = "SELECT * FROM assign_products WHERE product_id='" . $_POST['pid'] . "'";
//$get_users = $db->query($users_query);
//$data = $db->fetchByAssoc($get_users);
//
//     $guid=unserialize(base64_decode($data['users_id']));
//foreach($guid as $uid){
//    $users_query = "SELECT * FROM users WHERE id='" . $uid . "'";
//$get_users = $db->query($users_query);
//while($udata = $db->fetchByAssoc($get_users)){
//    $allusers[]=$udata['user_name'];
//}
//}

?>