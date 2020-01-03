=== Facebook Campaign Integration Plugin ===
Contributors: Nitheesh.R

== Description ==

Facebook Campaign plugin for integration between Facebook and CRM.
Creates Leads in CRM from Facebook Campaign.

We need the following things for Facebook Campaign Integration and lead creation.

	1. Facebook Page
	2. Facebook Developer App
	3. Secured callback URL(https)
	4. Campaign(s) which is linked with Facebook page
	5. Webserver with PHP 
	   PHP version >  5.4

== Installation ==

  * Go to the admin panel of the CRM.
  * Upload the plugin file through module loader.
  * Do quick repair and rebuild 

    The following files/ folders will move to CRM after installing the facebook plugin 
   
	1. custom/include/css
	2. custom/Extension/modules/Administration/Ext/Administration
	3. custom/modules/Administration
	4. themes/SuiteR/images
	5. custom/include/facebook
	6. facebook
	7. webhook.php
	8. fbauthentication.php
	9. fbleadcreation.php

    Please make sure proper permissions to the newly added files and folders 
    Recommended file permission is 775.


== Facebook Configuration ==

After the installation, there will be a Facebook configuration link in the admin page of the CRM.

Go to the admin page and click on the Facebook Configuration link and fill and save the required fields.

	1. Facebook Page ID     - ID of Facebook page
	2. Facebook Page Name   - Name of Facebook page
	3. App ID               - App ID of the Facebook App which is created from developers.facebook.com
	4. Secret ID            - App secret ID of the Facebook App which is created from developers.facebook.com


Facebook Authentication and Page subscription

	* Authenticate the integration by login into the Facebook
	* Run the facebook authentication url in browser - https://crm.advancesuite.in/SuiteCRM/fbauthentication.php
	* After successful authentication, a valid page access token will be saved in config file. - please make sure 
	  that proper permission is given for writting data into config.php/config_override.php file.
	* Subscribe the page by running the subscription url in browser
	  - https://crm.advancesuite.in/SuiteCRM/facebook/platform.php

== CRM Leads module Change ==

Add two fields through studio to store campaign related informations.

1. facebook_campaign_name
Data Type: 	    TextField
Field Name: 	facebook_campaign_name

2. facebook_campaign_id
Data Type: 	    TextField
Field Name: 	facebook_campaign_id

