<?php
class Mydashboard{
	
	public function getusername($id,$no)
	{
		global $db, $sugar_config;
		$id=$this->getuserid($id,$no);
		$result = $db->query("SELECT * FROM users WHERE id='".$id."' and deleted='0' ");
		$row = $db->fetchByAssoc($result);

		$name= $row['first_name']." ".$row['last_name'];
		
		echo json_encode(array(
       'name' => $name,
       'id' => $id,
       
   ));
	
	}
	
		public function getuserid($id,$no)
	{
		$id= substr($id, $no);
		return $id;
	}	
	
	
	
	
	   //~ public function aclrole_userlist($id,$no="NULL")
   //~ {
		//~ global $db, $sugar_config;
		//~ 
		//~ 
		//~ 
//~ 
		//~ echo '<ul id="user_list_id">';
		//~ echo '<li></li>';
//~ 
		//~ $aclrole_list = $db->query("select * from  acl_roles_users where role_id='".$id."' and deleted='0'");
		//~ while ($aclrolerow = $db->fetchByAssoc($aclrole_list)) {
		//~ $result = $db->query("select * from users where id='".$aclrolerow['user_id']."' and deleted='0' and deleted='0' and id!='".$id."'");
		//~ while ($row = $db->fetchByAssoc($result)) {
		//~ echo "<li><lable><input type='checkbox' name='aclrole_list[]' value='".$row['id']."' class='aclrole_checkbox' id='aclrole_list_".$row['id']."'> ".$row['first_name']." ".$row['last_name']."</lable></li>";
		//~ }
		//~ }
		//~ echo '</ul>';
	//~ }
		//~ public function securitygroup_userlist($id,$no="NULL")
	//~ {
		//~ global $db, $sugar_config;
		//~ echo '<ul id="user_list_id">';
		//~ echo '<li><label><input type="checkbox" id="securitygroup_select_all"/> Selecct All</label></li>';
//~ 
		//~ $securitygroups_list = $db->query("select * from  securitygroups_users where securitygroup_id='".$id."' and deleted='0'");
		//~ while ($securitygroupsrow = $db->fetchByAssoc($securitygroups_list)) {
		//~ $result = $db->query("select * from users where id='".$securitygroupsrow['user_id']."' and deleted='0' and id!='".$id."'");
		//~ while ($row = $db->fetchByAssoc($result)) {
		//~ echo "<li><lable><input type='checkbox' name='securitygroupuser_list[]' value='".$row['id']."' class='securitygroup_checkbox' id='securitygroupuser_list_".$row['id']."'> ".$row['first_name']." ".$row['last_name']."</lable></li>";
		//~ }
		//~ }
		//~ echo '</ul>';		
	//~ }
	//~ 
	
	
	
	}
?>
