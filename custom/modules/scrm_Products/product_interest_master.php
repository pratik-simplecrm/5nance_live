<?php

if (!define('sugarEntry'))
    define('sugarEntry', true);
require_once('include/entryPoint.php');
require_once('custom/include/language/en_us.lang.php');
//ini_set('display_errors','On');
global $db, $sugar_config;

$url = $sugar_config["webservice_url"];
$username = $sugar_config["webservice_username"];
$password = $sugar_config["webservice_password"];
global $db, $sugar_config;

if ($_SERVER['PHP_AUTH_USER'] == '5nance' && $_SERVER['PHP_AUTH_PW'] == '5n@nce#123!') {
    $fp = fopen('php://input', 'r');



    $session_id = generateSession($username, $password, $url);
    $rawData = json_decode(stream_get_contents($fp));

    $id = $rawData->id;
    $product_interest = $rawData->product_interest;





    //default_name_value_list_param for Lead
   


    foreach ($product_interest as $GetUserSet) {


        $select_query = $db->query("select * from product_interest where id='" . $GetUserSet['id'] . "'");
        if ($select_query->num_rows != 0) {
            $db->query("update product_interest set product_interest='" . $GetUserSet['name'] . "' where id='" . $GetUserSet['id'] . "'");
            $msg = array(
                'Success' => true,
                'Message' => 'Product interest updated Successfully',
            );
        } else {
            $db->query("INSERT INTO product_interest (id,product_interest) VALUES ('" . $GetUserSet['id'] . "','" . $GetUserSet['name'] . "')");
            $msg = array(
                'Success' => true,
                'Message' => 'Product interest created Successfully',
            );
        }
    }


    //	}
} else {
    $msg = array(
        'Success' => false,
        'Message' => 'Oops! Something went wrong'
    );
}
echo json_encode($msg);
exit;

//function to make cURL request
function call($method, $parameters, $url) {
    
    ob_start();
    $curl_request = curl_init();
    
    curl_setopt($curl_request, CURLOPT_URL, $url);
    curl_setopt($curl_request, CURLOPT_POST, 1);
    curl_setopt($curl_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($curl_request, CURLOPT_HEADER, 1);
    curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl_request, CURLOPT_SSL_VERIFYHOST, false);
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
    
    $result   = explode("\r\n\r\n", $result, 2);
    $response = json_decode($result[1]);
    ob_end_flush();
    
    return $response;
}
function generateSession($username, $password, $url) {

    $login_parameters = array(
        "user_auth" => array(
            "user_name" => $username,
            "password" => md5($password),
            "version" => "1"
        ),
        "application_name" => "Rest",
        "name_value_list" => array()
    );

    $login_result = call("login", $login_parameters, $url);

    //get session id
    $session_id = $login_result->id;
    return $session_id;
}

?>