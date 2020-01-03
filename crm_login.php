<?php
 
// fetching xml request
$dataPOST = trim(file_get_contents('php://input'));
$dataPOST = $_REQUEST['requestXml'];
$xmlData = simplexml_load_string($dataPOST);
$command = $xmlData->command;
if ($command == 'login') {
    $user_ID = $xmlData->userId;
    $password = $xmlData->password;
   
    $url = "http://13.127.100.216/crm/service/v4_1/rest.php";

    $username = "$user_ID";
    $password = "$password";

    //login ----------------------------------------------------- 
    $login_parameters = array(
        "user_auth" => array(
            "user_name" => $username,
            "password" => md5($password),
            "version" => "1"
        ),
        "application_name" => "RestTest",
        "name_value_list" => array(),
    );

    $login_result = call("login", $login_parameters, $url);
    $session_id = $login_result->id;
     
        if (!(empty($session_id))) {
    
            $xml = "<response>
                                       <status>success</status>
                                       <message>Auth Successful</message>
                                       <crmSessionId>" . $session_id . "</crmSessionId>
                                    </response>";
        } else {
            $xml = "<response>
                               <status>failed</status>
                               <message>Incorrect Password</message>
                               <crmSessionId></crmSessionId>
                             </response>";
            
        }
    

    echo $xml;
    
} else if ($command == 'logout') {
    $crmSessionID = $xmlData->crmSessionId;

    $xml = "<response>
            <status>success</status>
            <message></message>
          </response>";

    echo $xml;
}

//function to make cURL request
function call($method, $parameters, $url) {
    ob_start();
    $curl_request = curl_init();

    curl_setopt($curl_request, CURLOPT_URL, $url);
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

?>
