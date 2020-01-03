<?php
if (!define('sugarEntry'))
    define('sugarEntry', true);
require_once('include/entryPoint.php');
ini_set('display_errors','On');
global $db, $sugar_config;
//$sugar_url = $sugar_config["site_url"];
$username = $sugar_config["webservice_username"];
$password = $sugar_config["webservice_password"];
echo "<pre>";
//$url = 'http://122.169.109.21:9001/getuserdataforcrm';
$url= "http://122.169.109.21:9001/getuserdataforcrm";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization:Crypto cxZEBsIOiyXi8fOi8MJZ/mNyLZf67V2CQLvG2McCei2f+X87ft7KquuxJPywhCzH',
										'Content-Type: application/json',
										'Content-Length: ' . strlen($postData)));
$result = curl_exec($ch);
curl_close($ch);
$GetUserDataforCRM = json_decode($result, true);
$GetUserData = $GetUserDataforCRM['data'];
$uniqueCustomerCode_array = array();
foreach($GetUserData as $GetUserSet)
{
	$uniqueCustomerCode_array[] = $GetUserSet['uniqueCustomerCode'];
}
print_r($uniqueCustomerCode_array);
$result_customer_code_array = $db->query("select contacts_cstm.unique_customer_code_c from contacts join contacts_cstm on contacts.id=contacts_cstm.id_c where contacts_cstm.online_activity_status_c='Active'");
while($row_customer_code = $db->fetchByAssoc($result_customer_code_array))
{
	$uniqueCustomerCode_array_crm[] = $row_customer_code['unique_customer_code_c'];
}

$unique_codes = array_intersect($uniqueCustomerCode_array,$uniqueCustomerCode_array_crm);
print_r($unique_codes);
for($i=0;$i<sizeof($uniqueCustomerCode_array);$i++)
{
	//echo $uniqu
	//echo "Update contacts_cstm set online_activity_status_c='Inactive' where unique_customer_code_c='".$uniqueCustomerCode_array[$i]."' and online_activity_status_c='Active'";
	//update user status
	echo $db->query("Update contacts_cstm set online_activity_status_c='Inactive' where unique_customer_code_c='".$uniqueCustomerCode_array[$i]."' and online_activity_status_c='Active'");
	
}
//exit;
//print_r($GetUserData); exit;
 if (empty($GetUserData)) {
	 //update user status
	$db->query("Update contacts_cstm set online_activity_status_c='Inactive' where online_activity_status_c='Active'");
	 echo "empty result";exit;
        $GetUserDataCRMStatus = array(
            'notice' => 'Returned empty data array.'
        );
        $schedulerHandle = fopen($schedulerLogFile, 'a');
        $timestamp = date('Y-M-d H:m:s', strtotime('now'));
        $logArray = print_r($GetUserDataCRMStatus, true);
        $logMessage = "\n\nScheduler Result at $timestamp :-\n$logArray";
        fwrite($schedulerHandle,"Hi");
        fwrite($schedulerHandle, $logMessage);
        print_r($GetUserDataCRMStatus);
        return false;
    }	

foreach($GetUserData as $GetUserSet){
//	$uniqueCustomerCode = $GetUserSet["uniqueCustomerCode"];
	$uniqueCustomerCode = '2766';
	
	//fetch information based on unique customer code
	$fetch_contact_data = $db->query("select contacts.id,contacts.assigned_user_id from contacts join contacts_cstm on contacts.id=contacts_cstm.id_c where contacts.deleted=0 and contacts_cstm.unique_customer_code_c='$uniqueCustomerCode'");
	$result_contact_data = $db->fetchByAssoc($fetch_contact_data);
	$contact_id = $result_contact_data['id'];
	$assigned_user = $result_contact_data['assigned_user_id'];
	
	//popup reminder to user
	$insert_popup = "INSERT INTO alerts  (id,name,date_entered,date_modified,modified_user_id,created_by,description,deleted,assigned_user_id,is_read,target_module,type,url_redirect) VALUES (UUID(),'Active User Code - $uniqueCustomerCode',NOW(),NOW(),'1','1','Kindly touch with user ASAP .','0','$assigned_user','0','Contacts','info','index.php?action=DetailView&module=Contacts&record=$contact_id')";
	$insert_popup_result = $db->query($insert_popup);
	
	//update user status
	$db->query("Update contacts_cstm set online_activity_status_c='Active' where id_c='$contact_id'");
		exit;	
}

?>

