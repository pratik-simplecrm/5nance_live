<?php
if (!define('sugarEntry'))
    define('sugarEntry', true);
require_once('include/entryPoint.php');
require_once('config.php');
ReassignmentData_Update();
function ReassignmentData_Update() {
		global $db, $app_list_strings,$sugar_config;
		$today = gmdate('Y-m-d');
		/*********************fetch the contacts data which are modified today**************************/
		$fetch_contacts_data = $db->query("select contacts.id,contacts_cstm.unique_customer_code_c as customer_code,CONCAT(IFNULL(users.first_name,''),' ', IFNULL(users.last_name,'')) as user_name from contacts join contacts_cstm on contacts.id=contacts_cstm.id_c join users on users.id=contacts.assigned_user_id and users.deleted=0 where contacts.created_by='1' and contacts_cstm.gateway_c!='' and contacts.deleted=0 ");
		$contact_array = array();
		$i=0;
		while($result_contacts_data = $db->fetchByAssoc($fetch_contacts_data)){				
				$contact_array[$i]['unique_customer_id'] 	= $result_contacts_data['customer_code'];
				$contact_array[$i]['sales_advisor']	= $result_contacts_data['user_name'];
				$i++;
			}
			$contact_data = json_encode($contact_array);
			echo '<pre>';
			print_r($contact_data);
			return true;
		}
?>
