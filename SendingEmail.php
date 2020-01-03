<?php
if(!defined('sugarEntry')) define('sugarEntry', true);
require_once('include/entryPoint.php');
global $db;
global $sugar_config;
$full_name = $_GET['full_name'];
$user_id = $_GET['user_id'];

$user_info ="SELECT E_table.email_address FROM email_addresses E_table JOIN email_addr_bean_rel EB_table ON EB_table.email_address_id=E_table.id WHERE EB_table.bean_id='".$user_id."' AND EB_table.bean_module='Users'";
$result_info = $db->query($user_info);
$row_info = $db->fetchByAssoc($result_info);
$email_id  = $row_info['email_address'];
$site_url = $sugar_config['site_url'];
require_once('include/SugarPHPMailer.php');
		$emailObj = new Email();
		$defaults = $emailObj->getSystemDefaultEmail();
		$mail = new SugarPHPMailer();
		$mail->setMailerForSystem();
		$email = 'downloads@simplecrm.com.sg';
		$mail->From = $defaults['email'];
		$mail->From .= 'Content-type: text/html\r\n';
		$mail->FromName = $defaults['name'];
		$subject = 'Request to send the source code';
		$mail->Subject = $subject;
		$mail->IsHTML(true);
		$body = <<<EOD
		<p style = "margin-bottom: 0in;">Hi Team, </p>
<p style = "margin-bottom: 0in;">We got a request for source code. </span></p>
<p style = "margin-bottom: 0in;">Details are as follows: </span></p>
<p style = "margin-bottom: 0in;">Instance: $site_url</span></p>
<p style = "margin-bottom: 0in;">User Email Id: $email_id</a></p>
<p style = "margin-bottom: 0in;">Kindly do the needful.</a></p>
<p style = "margin-bottom: 0in;">&nbsp;</p>
<p style = "margin-bottom: 0in;">Regards,</span></p>
<p style = "margin-bottom: 0in;">Team SimpleCRM</span></p>
		
EOD;
$mail->Body = $body;
		$mail->prepForOutbound();
		$mail->AddAddress($email);
		//$mail->AddBCC('gagandeep.singh@techliveconnect.com');
		//@$mail->Send();
		$GLOBALS['log']->fatal('Email:'.$email);
		if (!$mail->Send()){
			$GLOBALS['log']->fatal('Email Send : Error Info:'.$mail->ErrorInfo);
                }

?>
