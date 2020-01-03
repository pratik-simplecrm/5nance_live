 <?php  
	global $current_user;
    global $db;
    $login_user_id = $current_user->id;
 ?>
<html>
    <head>

    </head>  
    <body>
    <form name="frmsales" id="frmsales" action="" method="post">
        <input type="hidden" id="pathurl"  name="pathurl" value="<?php global $sugar_config;$url=$sugar_config['site_url'];{echo $url;}?>"/>
        <table width="100%" cellspacing="20" cellpadding="0" border="0" class="list view">    
        <th><h1><b>Reports</b></h1></th> 
			<tr class="evenListRowS1" height="20" id='my_leads'>
				<td class="nowrap" width="1%" style="padding-left:15px !important;">
				<a target="_blank" style="text-decoration: none" href="<?php echo $url ?>/index.php?module=scrm_Custom_Reports&action=multi_disposition_report"><span style ="font-family: Arial;font-size:15.5px;" ><b><span style="font-size:21px;">»</span>&nbsp;Multi Disposition Report</b></span></a> 
				</td>
			</tr>
                        <tr class="oddListRowS1" height="20" id='product_disposition'>
                <td class="nowrap" width="1%" style="padding-left:15px !important;">
                <a target="_blank" style="text-decoration: none" href="<?php echo $url ?>/index.php?module=scrm_Custom_Reports&action=multi_disposition_report_product"><span style ="font-family: Arial;font-size:15.5px;" ><b><span style="font-size:21px;">»</span>&nbsp;Product wise - Multi Disposition Report</b></span></a> 
                </td>
            </tr>   
                   <tr class="oddListRowS1" height="20" id='product_disposition'>
				<td class="nowrap" width="1%" style="padding-left:15px !important;">
				<a target="_blank" style="text-decoration: none" href="<?php echo $url ?>/index.php?module=scrm_Custom_Reports&action=responded_customer_report"><span style ="font-family: Arial;font-size:15.5px;" ><b><span style="font-size:21px;">»</span>&nbsp;Responded Customer Report</b></span></a> 
				</td>
			</tr>
       		
		  </table>
    </form>
</body>
</html>
