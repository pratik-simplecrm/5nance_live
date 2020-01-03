<?php


    if(!defined('sugarEntry')) define('sugarEntry', true);
/**
 *  @copyright SimpleCRM http://www.simplecrm.com.sg
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU AFFERO GENERAL PUBLIC LICENSE
 * along with this program; if not, see http://www.gnu.org/licenses
 * or write to the Free Software Foundation,Inc., 51 Franklin Street,
 * Fifth Floor, Boston, MA 02110-1301  USA
 *
 * @author SimpleCRM <info@simplecrm.com.sg>
 */

require_once('include/entryPoint.php');
require_once('config.php');

include('custom/include/language/en_us.lang.php');
session_start();
	global $db, $sugar_config;
     
					$query = "SELECT distinct(su.user_id) FROM securitygroups sg JOIN securitygroups_users su ON su.securitygroup_id = sg.id JOIN users u ON su.user_id=u.id JOIN users_cstm uc ON u.id=uc.id_c JOIN acl_roles_users aru on aru.user_id=u.id and aru.deleted=0 WHERE u.status='Active'  AND uc.availability_status_c='Available' AND sg.deleted =0 AND su.deleted=0 AND u.deleted=0 and aru.role_id='a8ab8653-5860-d896-7a78-58466a429bee'";
         //Product wise assignment changes by Roshan Sarode dt. 22-6-18 end

					$result = $db->query($query);		
					$users_count = $result->num_rows;
                if ($users_count > 0) {
                    $assigned_array = array();
                      
                        while ($users_row = $db->fetchByAssoc($result)) {
                            $assigned_array[] = $users_row['user_id'];
                          
                        }
                  
						$today = date('2018-07-09');
						$assigned_user_count = array();
						$assigned_user_contacts_count = array();
						for($i=0;$i<sizeof($assigned_array);$i++)
						{
							$records_query = "SELECT count(c.id) as count FROM contacts c LEFT JOIN contacts_cstm cc ON c.id = cc.id_c	WHERE  c.deleted =0 AND c.assigned_user_id = '".$assigned_array[$i]."' AND (date(cc.user_allocation_date_c ) = '$today' OR disposition_c = '')";	
							$records_result = $db->query($records_query);
							$row_records_result = $db->fetchByAssoc($records_result);
							$assigned_user_count[] = $row_records_result['count'];
							$assigned_user_contacts_count[$row_records_result['count']] = $assigned_array[$i];
						}
                                                echo "<pre>";
                                                print_r($assigned_user_contacts_count);
                }
						