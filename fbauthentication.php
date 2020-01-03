<?php 
/** 
  * Facebook authentication file, stores facebook page access token in config file.
  * Date    : Mar-07-2017
  * Author  : Nitheesh.R <nitheesh@simplecrm.com.sg> 
  * Facebook api version : 2.8
*/
session_start();

include 'config.php';
include 'config_override.php';

$page_access_token  = "";

$app_id             = $sugar_config['facebook_app_id'];
$app_secret         = $sugar_config['facebook_secret_id'];
$page_name          = $sugar_config['facebook_page_name'];
$page_id            = $sugar_config['facebook_page_id'];
$site_url           = $sugar_config['site_url'];
$last_character     = substr($site_url, -1); // returns last character
if ($last_character == '/') {
	$site_url = substr($site_url, 0, -1); //remove last character same as substr_replace($string, "", -1)
}

// required scope
$required_scope = 'public_profile,user_managed_groups,user_posts,ads_management,ads_read,email,manage_pages,publish_actions,publish_pages,read_insights,read_page_mailboxes,rsvp_event';

	
		$redirect_url = $site_url.'/fbauthentication.php';
		require_once "custom/include/facebook/autoload.php";

		use Facebook\FacebookSession;
		use Facebook\FacebookRequest;
		use Facebook\GraphUser;
		use Facebook\FacebookRedirectLoginHelper;

		FacebookSession::setDefaultApplication($app_id , $app_secret);
		$helper = new FacebookRedirectLoginHelper($redirect_url);

		try {
		  $session = $helper->getSessionFromRedirect();
		} catch(FacebookRequestException $ex) {
			echo "Error one";
		    die(" Error : " . $ex->getMessage());
		} catch(\Exception $ex) {
			echo "Error two";
		    die(" Error : " . $ex->getMessage());
		}

		if (!$session){
			$login_url = $helper->getLoginUrl( array( 'scope' => $required_scope ) );
			header("location:$login_url");
		}

		else{
		
			// Get a list of pages that this user admins; requires "manage_pages" permission
			$request = new FacebookRequest($session, 'GET', '/me/accounts?fields=name,access_token,perms');
			$pageList = $request->execute()
			  ->getGraphObject()
			  ->asArray();
				
			if (count($pageList) < 1) {
				
				echo "No data,you may do not have the access to generate access token";
			}
				
			$pageList_data = $pageList['data'];

			if (count($pageList_data) > 0) {

				for ($v=0; $v < count($pageList_data); $v++) { 

					$each_page       = $pageList_data[$v];
					$pageID          = $each_page->id;

					if ($pageID == $page_id) {
						$page_access_token = $each_page->access_token;
						break;
					}
				}

			}

		}

			if(!defined('sugarEntry')) define('sugarEntry', true);
			require_once('include/entryPoint.php');
			require_once('config.php');
			global $sugar_config;
		    require_once 'modules/Configurator/Configurator.php';

			if (!empty($page_access_token)) {
				/*
				// fb log
				$text = "save facebook_page_access_token from fbauthentication : ".$page_access_token;
				$myText = (string)$text;
				$myText = $myText."\n";
				$filename = "facebook/fblog.txt";
				$fh = fopen($filename, "a");
				fwrite($fh, $myText);
				fclose($fh);
				*/
				$configurator = new Configurator();
				$configurator->loadConfig(); // it will load existing configuration in config variable of object
				$configurator->config['facebook_page_access_token']  = $page_access_token;
				$configurator->saveConfig(); // save changes
							
				// $GLOBALS['log']->debug('fb_campaign page_access_token : '.$page_access_token);
				echo "Connected successfully and saved Access Token data";
			}

			if (empty($page_access_token)) {
				
				/*
				// fb log
				$text = "Can not save empty facebook_page_access_token from fbauthentication : ";
				$myText = (string)$text;
				$myText = $myText."\n";
				$filename = "facebook/fblog.txt";
				$fh = fopen($filename, "a");
				fwrite($fh, $myText);
				fclose($fh);
				*/
			}

?>

