<?php 
/**
 * Asterisk SugarCRM Integration 
 * (c) KINAMU Business Solutions AG 2009
 * 
 * Parts of this code are (c) 2006. RustyBrick, Inc.  http://www.rustybrick.com/
 * Parts of this code are (c) 2008 vertico software GmbH  
 * Parts of this code are (c) 2009 abcona e. K. Angelo Malaguarnera E-Mail admin@abcona.de
 * http://www.sugarforge.org/projects/yaai/
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact KINAMU Business Solutions AG at office@kinamu.com
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 * 
 */

//if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

//require_once('include/utils.php');
//require_once('include/export_utils.php');

 //~ global $sugar_config;
 //~ global $locale;
session_start();
global $current_user, $db;

require_once('include/entryPoint.php');
$session_id = session_id();
$agentNo = $current_user->asterisk_ext_c;
$number = $_REQUEST['phoneNr'];
$user_id = $current_user->id;
//*Edited by akash

$query = "select uc.ameyo_campaign_id_c, uc.ameyosessionid_c from users_cstm uc join users u on u.id = uc.id_c where uc.id_c = '$user_id' and u.deleted = 0";
$result =$db->query($query);
$row=$db->fetchByAssoc($result);
//$number = '47';
$campaign_array = explode(',', $row['ameyo_campaign_id_c']); 
$campaignId = $campaign_array[0];
$campaignId = '2';
$ameyosessionId = $row['ameyosessionid_c'];  

$url = 'http://192.168.1.207:8888/ameyowebaccess/command?command=manual-dial&data={"campaignId":"'.$campaignId.'","sessionId":"'.$ameyosessionId.'","phone":"'.$number.'"}';
echo "<iframe src='$url' style='display:none;' id='iframe-for-call'><p>Your browser does not support iframes.</p></iframe>";
/*
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://192.168.1.207:8888/ameyowebaccess/command?command=manual-dial&data={"campaignId":"'.$campaignId.'","sessionId":"'.$ameyosessionId.'","phone":"'.$number.'"}');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, true);
$data = curl_exec($ch);*/

/*echo 'http://121.0.0.1:8888/ameyowebaccess/command?command=manualDialAPI&data={"campaignId":"'.$campaignId.'","sessionId":"'.$session_id.'","phone":"'.$agentNo.'","customerRecord":{"phone1":"'.$number.'"}'; exit;*/
//echo 'http://192.168.1.207:8888/ameyowebaccess/command?command=manualDialAPI&data={"campaignId":"'.$campaignId.'","sessionId":"'.$session_id.'","phone":"'.$agentNo.'","customerRecord":{"phone1":"'.$number.'"}'; exit;
//echo 'http://192.168.1.207:8888/ameyowebaccess/command?command=manual-dial&data={"campaignId":"'.$campaignId.'","sessionId":"'.$session_id.'","phone":"'.$agentNo.'","customerRecord":{"phone1":"'.$number.'"}'; exit;
//echo 'http://192.168.1.207:8888/ameyowebaccess/command?command=manual-dial&data={"campaignId":"'.$campaignId.'","sessionId":"'.$ameyosessionId.'","phone":"'.$number.'"}'; exit;
///file_get_contents('http://192.168.1.207:8888/ameyowebaccess/command?command=manual-dial&data={"campaignId":"'.$campaignId.'","sessionId":"'.$ameyosessionId.'","phone":"'.$number.'"}');


?>
