<?php
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

/**
 * controller.php
 * @author SalesAgility (Andrew Mclaughlan) <support@salesagility.com>
 * Date: 06/03/15
 * Comments
 */
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class CasesController extends SugarController {

   public function action_get_kb_articles(){
        global $mod_strings;
        global $app_list_strings;
        $search = $_POST['search'];
        $status_list = $app_list_strings['aok_status_list'];

        $query = "SELECT id, name, description, status, sum(relevance)
                  FROM (
                        SELECT id, name, description, status, 10 AS relevance
                        FROM aok_knowledgebase
                        WHERE name = '".$search."'
                        AND deleted = '0'
                        UNION SELECT id, name, description, status, 5 AS relevance
                        FROM aok_knowledgebase
                        WHERE name LIKE '%".$search."%'
                        AND deleted = '0'
                        UNION SELECT id, name, description, status, 2 AS relevance
                        FROM aok_knowledgebase
                        WHERE description LIKE '%".$search."%'
                        AND deleted = '0'
                        )results
                    GROUP BY id
                    ORDER BY sum( relevance ) DESC
        ";

        $offset = 0;
        $limit = 30;

        $result = $GLOBALS['db']->limitQuery($query, $offset, $limit);
        if($result->num_rows != 0){
            echo '<table>';
            echo '<tr><th>'.$mod_strings['LBL_SUGGESTION_BOX_REL'].'</th><th>'.$mod_strings['LBL_SUGGESTION_BOX_TITLE'].'</th><th>'.$mod_strings['LBL_SUGGESTION_BOX_STATUS'].'</th></tr>';
            $count =1;
            while($row = $GLOBALS['db']->fetchByAssoc($result) )
            {
                echo '<tr class="kb_article" data-id="'.$row['id'].'">';
                echo '<td> &nbsp;'.$count.'</td>';
                echo '<td>'.$row['name'].'</td>';
                echo '<td>'.$status_list = $app_list_strings['aok_status_list'][$row['status']].'</td>';
                echo '</tr>';
                $count++;
            }
            echo '</table>';
        }
        else {
            echo $mod_strings['LBL_NO_SUGGESTIONS'];
        }
        die();
    }
    public function action_get_kb_article(){
        global $mod_strings;

        $article_id = $_POST['article'];
        $article = new AOK_KnowledgeBase();
        $article->retrieve($article_id);

        echo '<span class="tool-tip-title"><strong>'.$mod_strings['LBL_TOOL_TIP_TITLE'].'</strong>'.$article->name.'</span><br />';
        echo '<span class="tool-tip-title"><strong>'.$mod_strings['LBL_TOOL_TIP_BODY'].'</strong></span>'.html_entity_decode($article->description);

        if(!$this->IsNullOrEmptyString($article->additional_info)){
            echo '<hr id="tool-tip-separator">';
            echo '<span class="tool-tip-title"><strong>'.$mod_strings['LBL_TOOL_TIP_INFO'].'</strong></span><p id="additional_info_p">'.$article->additional_info.'</p>';
            echo '<span class="tool-tip-title"><strong>'.$mod_strings['LBL_TOOL_TIP_USE'].'</strong></span><br />';
            echo '<input id="use_resolution" name="use_resolution" class="button" type="button" value="'.$mod_strings['LBL_RESOLUTION_BUTTON'].'" />';
        }

       die();
    }
	public function action_addTemplate() {


				$drop_down_value   = $_REQUEST['drop_down_value'];//using get method

				global $db;


				$qry190="select description from scrm_sms_template where name = '$drop_down_value' and deleted = 0";

				$value190=$db->query($qry190);
				$check190  =   $get_values_row190=$db->fetchByAssoc($value190);
				if($check190)
				{
					$description=$get_values_row190['description'];	
				} 



				$data3= array();
				$data3['drop_down_value']   = $drop_down_value;
				$data3['description']       = $description;
				echo json_encode($data3);



			}   


			public function action_sendSms() {

				global $current_user;
				$current_user_id = $current_user->id;
				$current_user_full_name =$current_user->full_name;
				date_default_timezone_set('Asia/Kolkata');
				$time = date('d/m/Y @ H:i', time());

				$mobile    = $_REQUEST['mobile'];//using get method
				$id        = $_REQUEST['id']; 
				$full_name = $_REQUEST['full_name'];
				$name      = $_REQUEST['name'];
				$message   = $_REQUEST['message']; 
				$dd_value  = $_REQUEST['dd_value']; 

				$data= array();
				$data['mobile']        = $mobile;
				$data['id']            = $id;
				$data['full_name']     = $full_name;
				$data['name']          = $name;
				$data['message']       = $message;
				$data['dd_value']      = $dd_value;
				
				require_once('SendSMS.php');
				//$mobile = "91" . substr($mobile, -10);
				$message = $message;
				//$sms = new SendSMS();
				
				$mobile_no = "91" . substr($mobile, -10);


$sms = new SendSMS();
$result = $sms->send_sms_to_user($mobile_no, $message);
				//echo json_encode($result);
/*
				$Data = str_replace(' ', '+', $message);
				$feedid = '346102';
				$sms_message = urlencode($message);
				// Login details
				$username = '9930314804';
				$pwd = 'pmwdp';
				
				// Sending SMS by using the above values
				$url= "http://bulkpush.mytoday.com/BulkSms/SingleMsgApi?feedid=$feedid&username=$username&password=$pwd&To=$mobile&Text=$Data";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_HTTPGET, 1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$output = curl_exec($ch);
				curl_close($ch);
*/

				global $db;
				$query16 ="select * FROM scrm_sms_template WHERE name='$dd_value' and deleted = 0";
				$results16= $db->query($query16);
				$row16 = $db->fetchByAssoc($results16);

				if($row16){
					$temp_id = $row16['id'];
				}

				$message_send_to  = "Case"; 
				$objsms = BeanFactory::getBean('scrm_SMS');

				$SMSName = $objsms->name                                         = "SMS - ".$full_name." on ".$time;
				$objsms->description                                             = $message;
				$objsms->assigned_user_name                                      = $current_user_full_name;
				$objsms->assigned_user_id                                        = $current_user_id;
				$objsms->receipient_no_c                                         = $mobile_no;
				$objsms->message_send_to_c                          		     = $message_send_to;   
				//$objsms->leads_scrm_sms_1_name                    			     = $name;
				$objsms->cases_scrm_sms_1cases_ida                               = $id;
				//$objsms->scrm_sms_templates_scrm_sms_1_name                      = $dd_value;
				$objsms->scrm_sms_template_scrm_sms_1scrm_sms_template_ida       = $temp_id;

				$objsms->save();	

				echo json_encode($data);

			}


		public function action_create_records (){

			global $sugar_config; 
			global $db;

			$module             = $_REQUEST['module'];
			$action             = $_REQUEST['action'];
			$to_pdf             = $_REQUEST['to_pdf'];
			$case_name          = $_REQUEST['case_name'];
			$priority           = $_REQUEST['priority'];
			$twitter_handle_c   = $_REQUEST['twitter_handle_c'];
			$description        = $_REQUEST['description'];
			$case_status        = $_REQUEST['case_status'];	
			$status_id          = $_REQUEST['status_id'];
			$account_id         = $_REQUEST['account_id'];

			$case = new aCase();
			$case->name                    = $case_name;
			$case->status                  = $case_status;
			$case->description             = $description;  
			$case->tweet_id_c              = $status_id; 
			$case->twitter_handle_c        = $twitter_handle_c; 
			$case->priority                = $priority;
			$case->account_id              = $account_id;  

			$query1  =   "SELECT id_c FROM cases_cstm, cases WHERE id = id_c AND deleted = 0 AND  tweet_id_c  = '$status_id'";
			$value1  =   $db->query($query1);
			$check1  =   $get_values_row1  = $db->fetchByAssoc($value1);

			if(!$check1){
				$case->save();	
				$created = "y";
			}
			if($check1){
				$created = "n";
			}

			$sql = "SELECT id_c FROM cases_cstm, cases WHERE id = id_c AND deleted = 0 AND  tweet_id_c  = '$status_id'";
			$result = $db->query($sql);

			if($row6 = $db->fetchByAssoc($result)){
				$id_c = $row6['id_c'];                    
			}
			$data2= array();
			$data2['id_c']                = $id_c;
			$data2['created']             = $created;

			echo json_encode($data2);

		} 

    // Function for basic field validation (present and neither empty nor only white space
   private function IsNullOrEmptyString($question){
        return (!isset($question) || trim($question)==='');
    }



}
