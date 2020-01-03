<?php

    session_start();
        
//$GLOBALS['log']->fatal("single sign in  entry point: " . print_r($_REQUEST, true));
    if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
    
    global $db,$sugar_config,$current_user;
    $crmSessionId  = $_REQUEST['crmSessionId']; 
    $crtObjectId = $_REQUEST['crtObjectId'];
    $userId = $_REQUEST['userId'];
    $ameyosessionId = $_REQUEST['sessionId'];
    $campaignId = $_REQUEST['campaignId'];
    $lifetime = 86400;
    
    $query = "update users_cstm uc join users u on uc.id_c = u.id set uc.ameyo_campaign_id_c = '$campaignId', uc.ameyosessionid_c = '$ameyosessionId' where u.user_name = '$userId'";
    $result =$db->query($query);
	//$GLOBALS['log']->fatal("single sign in Query".$query);

    setcookie(session_name(), $crmSessionId, time()+$lifetime);
    $signinheader = $sugar_config['asterisk_signinheader'];
    header("Location: $signinheader");

 
