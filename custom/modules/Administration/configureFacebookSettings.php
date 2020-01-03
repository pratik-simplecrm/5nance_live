<?php 
	require_once('config.php');
	global $sugar_config;
?>

<link rel="stylesheet" type="text/css" href="custom/include/css/fb_settings.css">

<div class="col-md-6">
   <form id="update-settings" method="post" action="index.php?module=Administration&action=configureFacebookSettings">
	  <table id="fbb_tbl" class="table tbl_main_style">

		<thead>
		 <tr><th colspan="2" class="tbl_th_style"> <img width="20" height="20" src="themes/SuiteR/images/fb_settings_home.png"><label class="margin_style"> Facebook Configuration </label> </th></tr>
		 </thead>
		 <tbody>

<?php if($_GET['success']){?>
	<tr><td colspan="2"><p id="message" type="text" name="message" class="msg_style">Facebook settings updated successfully!</p></td></tr>
		<script type="text/javascript">
		//var elem1 = document.getElementById("message");
		//elem1.data ='';
		</script>
	<?php 
}
?>

<tr><td><label class="tbl_td_label">Page ID </label></td><td><input id="page_id" type="text" class="tbl_td_input form-control" name="page_id" value="<?php echo $sugar_config['facebook_page_id'];?>"></td></tr>
<tr><td><label class="tbl_td_label" >Page Name </label></td><td><input id="page_name" type="text" class="tbl_td_input form-control" name="page_name" value="<?php echo $sugar_config['facebook_page_name'];?>"></td class="color_style"></tr>
<tr><td><label class="tbl_td_label" >App ID </label></td><td><input id="app_id" type="text" class="tbl_td_input form-control" name="app_id" value="<?php echo $sugar_config['facebook_app_id'];?>"></td></tr>
<tr><td><label class="tbl_td_label">Secret ID </label></td><td><input id="secret_id" type="text" class="tbl_td_input form-control" name="secret_id" value="<?php echo $sugar_config['facebook_secret_id'];?>"></td></tr>
<tr><td><label class="tbl_td_label">Leads Keywords </label></td><td><textarea class="tbl_td_input form-control" name="keywords_lead" id="keywords_lead"><?php echo $sugar_config['facebook_keywords_lead'];?></textarea></td></tr>
<tr><td><label class="tbl_td_label">Cases Keywords </label></td><td><textarea class="tbl_td_input form-control" name="keywords_case" id="keywords_case"><?php echo $sugar_config['facebook_keywords_case'];?></textarea></td></tr>

<td colspan="2" class="action_td_style">
<a href="index.php?module=Administration&action=index" class="txt_decoration">
<input type="button"  value="Cancel" id="cancel_btn"> </a>  <input type="submit"  value="Update" id="update_btn"></td>
		</tbody>
	  </table>
	</form>
</div>

<?php 
			if(isset($_POST['page_id'])){ 

				require_once 'modules/Configurator/Configurator.php';
				$configurator = new Configurator();
				$configurator->loadConfig(); // it will load existing configuration in config variable of object

				$configurator->config['facebook_service_url']      = $_POST['facebook_service_url'];
				$configurator->config['facebook_page_id']          = $_POST['page_id'];
				$configurator->config['facebook_page_name']        = $_POST['page_name'];
				$configurator->config['facebook_app_id']           = $_POST['app_id'];
				$configurator->config['facebook_secret_id']        = $_POST['secret_id'];

				// htmlspecialchars($_POST['keywords_lead']);
				$configurator->config['facebook_keywords_lead']    = $_POST['keywords_lead']; 
				// htmlspecialchars($_POST['keywords_case']);
				$configurator->config['facebook_keywords_case']    = $_POST['keywords_case'];

				$configurator->saveConfig(); // save changes
				//header("Location: index.php?module=Administration&action=configureFacebookSettings&success=true"); 
				//header("Location: index.php?module=Administration&action=index&success=true"); 

				?>
						
<script type="text/javascript">
	   alert('Facebook settings updated successfully!');
	   window.location.href = "index.php?module=Administration&action=index&success=true";
	   //window.location.reload();
</script>

<?php
}
?>