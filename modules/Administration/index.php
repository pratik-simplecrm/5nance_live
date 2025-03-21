<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.

 * SuiteCRM is an extension to SugarCRM Community Edition developed by Salesagility Ltd.
 * Copyright (C) 2011 - 2014 Salesagility Ltd.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for  technical reasons, the Appropriate Legal Notices must
 * display the words  "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 ********************************************************************************/

/*********************************************************************************

 * Description: TODO:  To be written.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

global $currentModule;
global $current_language;
global $current_user;
global $sugar_flavor;
global $db;
global $sugar_config;
        $user_id = $current_user->id;
        $user_info = "SELECT first_name,last_name from users where id='$user_id'";
        $result_info = $db->query($user_info);
        $row_info = $db->fetchByAssoc($result_info);
        $full_name = $row_info['first_name'].' '.$row_info['last_name'];

        $site_url = $sugar_config['site_url'];

        $var = "Hello $full_name,\n\nYou have requested for access to source code. By clicking on the OK button below, you hereby state that-\n\n\"I am $full_name and an authorized user of this software. I understand that impersonating another person or misrepresentation of facts is illegal and, if found to be in violation, legal action may be initiated against me.\"";
            $var2 = json_encode($var);

if (!is_admin($current_user) && !is_admin_for_any_module($current_user))
{
   sugar_die("Unauthorized access to administration.");
}
//for download source code
echo $js =<<<EOD
<script>
$(document).ready(function(){
$('#sourcecode').click(function(){
     var text= $var2;
             var result = confirm(text);
             //alert(result);
             if(result == true)
             {
                var text2 = "A download link of the latest updated version of your software is being sent to your registered email id shortly. If you do not receive the download link within 1 business day, please check your junk mail folder OR  contact downloads@simplecrm.com.sg for prompt resolution.";
                var result2 = confirm(text2);
                //alert(result2);
                if(result2 == true)
                {
             var full_name = '$full_name';
             var user_id  ='$user_id';
                $.ajax({
                               url: 'SendingEmail.php',
                               type: 'GET',
                               async: false,
                                data:
                               {
                                   full_name:full_name,
                                   user_id: user_id,
                                },
                                success:function(response)
                                {
                                     //alert($site_url+'/index.php?module=Users&action=DetailView&record='+$user_id);
                                     //location.href = $site_url+'/index.php?module=Users&action=DetailView&record='+$user_id;
                                }
                    });
                    var redirect = "$site_url/index.php?module=Users&action=DetailView&record=$user_id";
                    window.location.href=redirect;
                }
                if(result2 == false)
                {
                    var redirect = "$site_url/index.php?module=Users&action=DetailView&record=$user_id";
                    //alert(redirect);
                    window.location.href=redirect;
                }
            }
            if(result == false)
            {
                var redirect = "$site_url/index.php?module=Users&action=DetailView&record=$user_id";
                    window.location.href=redirect;
            }
    });
});
</script>
EOD;
//end download source code
echo getClassicModuleTitle(translate('LBL_MODULE_NAME','Administration'),
                      array(translate('LBL_MODULE_NAME','Administration')), false);

//get the module links..
require('modules/Administration/metadata/adminpaneldefs.php');
global $admin_group_header;  ///variable defined in the file above.


$tab = array();
$header_image = array();
$url = array();
$onclick = array();
$label_tab = array();
$id_tab = array();
$description = array();
$group = array();
$sugar_smarty = new Sugar_Smarty();
$values_3_tab = array();
$admin_group_header_tab = array();
$j=0;

foreach ($admin_group_header as $key=>$values) {
    $module_index = array_keys($values[3]);
    $addedHeaderGroups = array();
    foreach ($module_index as $mod_key=>$mod_val) {
        if(
        (!isset($addedHeaderGroups[$values[0]]))) {
            $admin_group_header_tab[]=$values;
            $group_header_value=get_form_header(translate($values[0],'Administration'),$values[1],$values[2]);
        	$group[$j][0] = '<h3>' . translate($values[0]) . '</h3>';
        	$addedHeaderGroups[$values[0]] = 1;
        	if (isset($values[4]))
    	       $group[$j][1] = '' . translate($values[4]) . '';
    	    else
    	       $group[$j][2] = '';
            $colnum=0;
            $i=0;
            $fix = array_keys($values[3]);
            if(count($values[3])>1){

                //////////////////
                $tmp_array = $values[3];
                $return_array = array();
                foreach ($tmp_array as $mod => $value){
                    $keys = array_keys($value);
                    foreach ($keys as $key){
                        $return_array[$key] = $value[$key];
                    }
                }
                $values_3_tab[]= $return_array;
                $mod = $return_array;
            }
           else {
                $mod = $values[3][$fix[0]];
    	        $values_3_tab[]= $mod;
           }

            foreach ($mod as $link_idx =>$admin_option) {
                if(!empty($GLOBALS['admin_access_control_links']) && in_array($link_idx, $GLOBALS['admin_access_control_links'])){
                    continue;
                }
                $colnum+=1;
                $header_image[$j][$i]= SugarThemeRegistry::current()->getImage($admin_option[0],'border="0" align="absmiddle"',null,null,'.gif',translate($admin_option[1],'Administration'));
                $url[$j][$i] = $admin_option[3];
                if(!empty($admin_option[5])) {
                	$onclick[$j][$i] = $admin_option[5];
                }
                $label = translate($admin_option[1],'Administration');
                if(!empty($admin_option['additional_label']))$label.= ' '. $admin_option['additional_label'];
                if(!empty($admin_option[4])){
                	$label = ' <font color="red">'. $label . '</font>';
                }

                $label_tab[$j][$i]= $label;
                $id_tab[$j][$i] = $link_idx;
                
                $description[$j][$i]= translate($admin_option[2],'Administration');

                if (($colnum % 2) == 0) {
                    $tab[$j][$i]= ($colnum % 2);
                }
                else {
                    $tab[$j][$i]= 10;
                }
                $i+=1;
            }

        	//if the loop above ends with an odd entry add a blank column.
        	if (($colnum % 2) != 0) {
        	    $tab[$j][$i]= 10;
        	}
        $j+=1;
    }
  }
}

$sugar_smarty->assign("VALUES_3_TAB", $values_3_tab);
$sugar_smarty->assign("ADMIN_GROUP_HEADER", $admin_group_header_tab);
$sugar_smarty->assign("GROUP_HEADER", $group);
$sugar_smarty->assign("ITEM_HEADER_IMAGE", $header_image);
$sugar_smarty->assign("ITEM_URL", $url);
$sugar_smarty->assign("ITEM_ONCLICK", $onclick);
$sugar_smarty->assign("ITEM_HEADER_LABEL",$label_tab);
$sugar_smarty->assign("ITEM_DESCRIPTION", $description);
$sugar_smarty->assign("COLNUM", $tab);
$sugar_smarty->assign('ID_TAB', $id_tab);

echo $sugar_smarty->fetch('modules/Administration/index.tpl');

?>
