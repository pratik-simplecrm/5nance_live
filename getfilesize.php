<?php
//log file to truncate if file size is more than 10MB
//getuserdataforcrm.txt
$log_file_0 = "/var/www/html/crm/WebsiteAPILogs/getuserdataforcrm.txt";
$getuserdataforcrm = fopen($log_file_0, "r+");
$filesize_userdata = round((filesize($log_file_0) / 1048576), 2);
if($filesize_userdata >= 10){
	ftruncate($getuserdataforcrm, 0);
}
fclose($getuserdataforcrm);
//updateadvisorname
$log_file_1 = "/var/www/html/crm/WebsiteAPILogs/updateadvisorname.txt";
$updateadvisorname = fopen($log_file_1, "r+");
$filesize_advisorlog = round((filesize($log_file_1) / 1048576), 2);
if($filesize_advisorlog >= 10){
	ftruncate($updateadvisorname, 0);
}

//getactiveusers.txt
$log_file_2 = "/var/www/html/crm/WebsiteAPILogs/getactiveusers.txt";
$getactiveusers = fopen($log_file_2, "r+");
$filesize_activeusers = round((filesize($log_file_2) / 1048576), 2);
if($filesize_activeusers >= 10){
	ftruncate($getactiveusers, 0);
}
fclose($getactiveusers);
//updateusersstatus
$log_file_3 = "/var/www/html/crm/WebsiteAPILogs/updateusersstatus.txt";
$updateusersstatus = fopen($log_file_3, "r+");
$filesize_updateuserlog = round((filesize($log_file_3) / 1048576), 2);
if($filesize_updateuserlog >= 10){
	ftruncate($updateusersstatus, 0);
}
fclose($updateusersstatus);
//ticket_escalation.txt
$log_file_4 = "/var/www/html/crm/WebsiteAPILogs/ticket_escalation.txt";
$ticket_escalation = fopen($log_file_4, "r+");
$filesize_escalation = round((filesize($log_file_4) / 1048576), 2);
if($filesize_escalation >= 10){
	ftruncate($ticket_escalation, 0);
}
fclose($ticket_escalation);

//getsipsetupforcrm.txt
$log_file_5 = "/var/www/html/crm/WebsiteAPILogs/getsipsetupforcrm.txt";
$getsipsetupforcrm = fopen($log_file_5, "r+");
$filesize_sipdetails = round((filesize($log_file_5) / 1048576), 2);
if($filesize_sipdetails >= 10){
	ftruncate($getsipsetupforcrm, 0);
}
fclose($getsipsetupforcrm);
//registeruser.txt
$log_file_6 = "/var/www/html/crm/WebsiteAPILogs/registeruser.txt";
$registeruser = fopen($log_file_6, "r+");
$filesize_registeruser = round((filesize($log_file_6) / 1048576), 2);
if($filesize_registeruser >= 10){
	ftruncate($registeruser, 0);
}
fclose($registeruser);
//mobileotp.txt
$log_file_7 = "/var/www/html/crm/WebsiteAPILogs/mobileotp.txt";
$mobileotp = fopen($log_file_7, "r+");
$filesize_mobileotp = round((filesize($log_file_7) / 1048576), 2);
if($filesize_mobileotp >= 10){
	ftruncate($mobileotp, 0);
}
fclose($mobileotp);


//getgoalslistdetails.txt
$log_file_8 = "/var/www/html/crm/WebsiteAPILogs/getgoalslistdetails.txt";
$getuserdataforcrm = fopen($log_file_8, "r+");
$filesize_goalslist = round((filesize($log_file_8) / 1048576), 2);
if($filesize_goalslist >= 10){
	ftruncate($getgoalslistdetails, 0);
}
fclose($getgoalslistdetails);

//getecsmandatesetup.txt
$log_file_10 = "/var/www/html/crm/WebsiteAPILogs/getecsmandatesetup.txt";
$getecsmandatesetup = fopen($log_file_10, "r+");
$filesize_mandate = round((filesize($log_file_10) / 1048576), 2);
if($filesize_mandate >= 10){
	ftruncate($getecsmandatesetup, 0);
}
fclose($getecsmandatesetup);
//getordersforcrm.txt
$log_file_11 = "/var/www/html/crm/WebsiteAPILogs/getordersforcrm.txt";
$getordersforcrm = fopen($log_file_11, "r+");
$filesize_orders= round((filesize($log_file_11) / 1048576), 2);
if($filesize_orders >= 10){
	ftruncate($getordersforcrm, 0);
}
fclose($getordersforcrm);
//GetNomineeDetails.txt
$log_file_12 = "/var/www/html/crm/WebsiteAPILogs/GetNomineeDetails.txt";
$GetNomineeDetails = fopen($log_file_12, "r+");
$filesize_nominee = round((filesize($log_file_12) / 1048576), 2);
if($filesize_nominee >= 10){
	ftruncate($GetNomineeDetails, 0);
}
fclose($GetNomineeDetails);
//getcallbackdetailsforcrm.txt
$log_file_13 = "/var/www/html/crm/WebsiteAPILogs/getcallbackdetailsforcrm.txt";
$getcallbackdetailsforcrm = fopen($log_file_13, "r+");
$filesize_callbackrequest = round((filesize($log_file_13) / 1048576), 2);
if($filesize_callbackrequest >= 10){
	ftruncate($getcallbackdetailsforcrm, 0);
}
fclose($getcallbackdetailsforcrm);
//GetInvestorBankAccountForCRM.txt
$log_file_14 = "/var/www/html/crm/WebsiteAPILogs/GetInvestorBankAccountForCRM.txt";
$GetInvestorBankAccountForCRM = fopen($log_file_14, "r+");
$filesize_account = round((filesize($log_file_14) / 1048576), 2);
if($filesize_account >= 10){
	ftruncate($GetInvestorBankAccountForCRM, 0);
}
fclose($GetInvestorBankAccountForCRM);
//GetLeadsForCRM.txt
$log_file_15 = "/var/www/html/crm/WebsiteAPILogs/GetLeadsForCRM.txt";
$GetLeadsForCRM = fopen($log_file_15, "r+");
$filesize_loans = round((filesize($log_file_15) / 1048576), 2);
if($filesize_loans >= 10){
	ftruncate($GetLeadsForCRM, 0);
}
fclose($GetLeadsForCRM);

?>