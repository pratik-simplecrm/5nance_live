<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
//~ ini_set('display_errors','On');
class Updatefullname_leads {
	public function Updatefullname_method_leads($bean, $event, $arguments) {
		
		/**************name concatenation with middle name*********************/
		if(!empty($bean->middle_name_c))
		{
			$bean->first_name = $bean->first_name.' '.$bean->middle_name_c;
		}

		global $current_user,$db;
		//print_r($bean);
		include_once(‘modules/ACLRoles/ACLRole.php’);
		$obj_ACLRole = new ACLRole();
		 $roles = $obj_ACLRole->getUserRoleNames($current_user->id);
		//~ print_r($roles);
		//~ exit;
		$user_ids= array();
		$current_userid = $current_user->id;

		//$contact = BeanFactory::getBean('Contacts',$bean->id);
		//echo '<pre>';print_r($contact);exit;
		if(!empty($roles))
		{
			$role = $roles[0]; 
		}else{
			$role = '';
		}
		switch($role)
		{
			case 'Advisors':

					if($bean->assigned_user_id == $current_userid)
				    {
				    	if(!empty($bean->phone_mobile))
				    	{
							$bean->phone_mobile = $bean->phone_mobile.'&nbsp;&nbsp;<img onclick="changeCss($(this));" src="custom/modules/Asterisk/include/call_active.gif" class="asterisk_placeCall" value="anrufen" style="cursor: pointer;transition: all .2s ease-in-out;"/>&nbsp;';
						}			    	
					}

			break;

			case 'Team Leader':
					$query="Select distinct(su1.user_id) from securitygroups_users su1 join users u on u.id=su1.user_id and u.deleted=0 join acl_roles_users aru on aru.user_id=u.id and aru.deleted=0 join acl_roles ar on ar.id=aru.role_id and ar.deleted=0 where su1.securitygroup_id in (Select su.securitygroup_id from securitygroups_users su where su.user_id='$current_user->id' and su.deleted = '0') and su1.deleted = '0' and ar.name='Advisors'";

					/*$query="Select distinct(su1.user_id) from securitygroups_users su1 where su1.securitygroup_id in (Select su.securitygroup_id from securitygroups_users su where su.user_id='$current_user->id' and su.deleted = '0') and su1.deleted = '0'";*/

				    $result =$db->query($query);
				    while($row=$db->fetchByAssoc($result))
				    {
				    	$user_ids[] = $row['user_id'];
				    }

				    if(in_array($bean->assigned_user_id, $user_ids) || $bean->assigned_user_id == $current_userid)
				    {
				    	if(!empty($bean->phone_mobile))
				    	{
							$bean->phone_mobile = $bean->phone_mobile.'&nbsp;&nbsp;<img onclick="changeCss($(this));" src="custom/modules/Asterisk/include/call_active.gif" class="asterisk_placeCall" value="anrufen" style="cursor: pointer;transition: all .2s ease-in-out;"/>&nbsp;';			    	
						}
					}

			break;
			
			case 'Sales Head':
			break;
		}
		/************** get assigned user list *********************/

	}
}

?>

