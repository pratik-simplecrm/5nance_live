<?php
    /** 
      * Test file,to check Facebook integration
      * Date    : April-03-2017
      * Author  : Nitheesh.R <nitheesh@simplecrm.com.sg> 
      * Facebook api version : 2.8
    */
    
    include '../config.php';
    include '../config_override.php';

    $site_url                    = '';
    $facebook_page_access_token  = '';
    $app_id                      = '';
    $app_secret                  = '';
    $page_name                   = '';
    $page_id                     = '';
    $decoded_response            = array();

    $site_url                    = $sugar_config['site_url'];
    $facebook_page_access_token  = $sugar_config['facebook_page_access_token'];
    $app_id                      = $sugar_config['facebook_app_id'];
    $app_secret                  = $sugar_config['facebook_secret_id'];
    $page_name                   = $sugar_config['facebook_page_name'];
    $page_id                     = $sugar_config['facebook_page_id'];

    // PART - ONE

    if (empty($site_url)) {
        echo "site_url is missing.Please check the config file."."<br />";
    }
    else if (empty($facebook_page_access_token)) {
        echo "Facebook facebook_page_access_token is missing.Please check the config file."."<br />";
    }
    else if (empty($app_id)) {
        echo "Facebook app_id is missing.Please check the config file."."<br />";
    }
   else if (empty($app_secret)) {
        echo "Facebook app_secret is missing.Please check the config file."."<br />";
    }
    else if (empty($page_name)) {
        echo "Facebook page_name is missing.Please check the config file."."<br />";
    }
    else if (empty($page_id)) {
        echo "Facebook page_id is missing.Please check the config file."."<br />";
    }
    else if (!empty($facebook_page_access_token)) {
        echo "Facebook facebook_page_access_token is missing.Please check the config file."."<br />";

    } else{
	   echo "All config parameters are present";
    }



    // PART - TWO

    // Check fb access token validity.
    try {
        $graph_url = "https://graph.facebook.com/me?"
        . "access_token=" . $facebook_page_access_token;
        $response = curl_get_file_contents($graph_url);
        $decoded_response = json_decode($response);
    } catch (Exception $e) {
      echo 'Caught Exception: ',  $e->getMessage(), "\n";
    }

    /*
    echo "<pre>";
    print_r($decoded_response);
    echo "</pre>";
    */

    // Check for errors 
    if ($decoded_response->error) {
        // check to see if this is an oAuth error:
        if ($decoded_response->error->type == "OAuthException") {
            // Invalid access token
            echo "<br>Access token status : In valid access token"."<br><br>"."Error message : ".$decoded_response->error->message."<br><br>";

        }
        else {
            echo "<br>Other error has happened"."<br>"."Error message : ".$decoded_response->error->message;
        }
    } 
    else {
        // success
        echo "<br>Access token status : Valid Access token";
    }


   // note this wrapper function exists in order to circumvent PHP’s 
  //strict obeying of HTTP error codes.  In this case, Facebook 
  //returns error code 400 which PHP obeys and wipes out 
  //the response.
  function curl_get_file_contents($URL) {
    $c = curl_init();
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_URL, $URL);
    $contents = curl_exec($c);
    $err  = curl_getinfo($c,CURLINFO_HTTP_CODE);
    curl_close($c);
    if ($contents) return $contents;
    else return FALSE;
  }
    
?>
