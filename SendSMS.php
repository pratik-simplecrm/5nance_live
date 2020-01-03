<?php
if(!define('sugarEntry')) {
	define('sugarEntry', true);
}
require_once('include/entryPoint.php');

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class SendSMS {
	public function send_sms_to_user($mobile_no, $message){
		try{
			//Message Details
			if(empty($mobile_no) || empty($message))
				return "mobile or message blank";
			$feedid = '346102';
			$sms_message = urlencode($message);

			// Login details
			$username = '9930314804';
			$pwd = 'pmwdp';

			// Sending SMS by using the above values
			$url= "http://bulkpush.mytoday.com/BulkSms/SingleMsgApi?feedid=$feedid&username=$username&password=$pwd&To=$mobile_no&Text=$sms_message";

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPGET, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$output = curl_exec($ch);
			curl_close($ch);
			$xml = simplexml_load_string($output);
			return $output;
		}
		catch(Exception $e){
			echo '\nCaught exception while sending sms : ',  $e->getMessage(), "\n";
		}
	}

}

