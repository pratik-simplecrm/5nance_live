<?php 
	require_once('config.php');
	global $sugar_config;
?>

<link rel="stylesheet" type="text/css" href="custom/include/css/fb_settings.css">

<div class="col-md-6">
   <form id="update-settings" method="post" action="index.php?module=Administration&action=configureCSEmailSettings">
	  <table id="fbb_tbl" class="table tbl_main_style">

		<thead>
		 <tr><th colspan="2" class="tbl_th_style"> <img width="20" height="20" src="custom/include/images/CS_email.png"><label class="margin_style"> Corporate Sales Email Configuration </label> </th></tr>
		 </thead>
		 <tbody>
   
<?php if($_GET['success']){?>
	<tr><td colspan="2"><p id="message" type="text" name="message" class="msg_style">Corporate Sales email settings updated successfully!</p></td></tr>
		<script type="text/javascript">
		//var elem1 = document.getElementById("message");
		//elem1.data ='';
		</script>
	<?php 
}
?>

<tr><td></td><td><input id="page_id" type="hidden" class="tbl_td_input form-control" name="page_id" value="<?php echo $sugar_config['facebook_page_id'];?>"></td></tr>

<tr><td><label class="tbl_td_label" >Email Address</label></td><td><input id="cs_email" type="text" class="tbl_td_input form-control" name="cs_email" value="<?php echo $sugar_config['cs_email'];?>"></td></tr>



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
				$configurator->config['cs_email']           = $_POST['cs_email'];
				$configurator->saveConfig(); 

				?>
						
<script type="text/javascript">
	   alert('Corporate Sales email settings updated successfully!');
	   window.location.href = "index.php?module=Administration&action=index&success=true";
	   //window.location.reload();
</script>

<?php
}
?>
