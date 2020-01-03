<?php
//~ echo "ok";exit;
session_start();
if (!defined('sugarEntry') || !sugarEntry)
    die('Not A Valid Entry Point');


global $db, $sugar_config, $current_user;
$url      = $sugar_config['webservice_url'];
$username = $sugar_config['webservice_username'];
$password = $sugar_config['webservice_password'];

$fp      = fopen('php://input', 'r');
$rawData = json_decode(stream_get_contents($fp));

/*print_r($rawData); 
echo "<br>";
echo $rawData->userID;
echo "<br>";
echo $rawData->userStatus;
echo "<br>";
echo $rawData->dropStage;
echo "<br>";
echo $rawData->rejectionReason;*/
//exit;

/*$userID = $_REQUEST['userID'];
$userStatus = $_REQUEST['userStatus'];
$dropStage = $_REQUEST['dropStage'];
$rejectionReason = $_REQUEST['rejectionReason'];*/


//Input Parameters
$userID          = $rawData->userID;                  
$userStatus      = $rawData->userStatus;
$dropStage       = $rawData->dropStage;
$rejectionReason = $rawData->rejectionReason;
 
 $data11 = array('userID'=>$userID,'userStatus'=>$userStatus,'dropStage'=>$dropStage,'rejectionReason'=>$rejectionReason);
 $myfile = fopen("DisqulaifiedLog.txt","a");
 fwrite($myfile,date('Y-m-d H:i:s'));
 fwrite($myfile,print_r($data11, true));
 fwrite($myfile,'---------------------');
	


$contactId = '';
$default_rejected_user_id = '23fcf3fd-1d0e-bfce-dd15-5cffba732f9d';  // Rejected User Id
$sql    = "select id_c from contacts_cstm where unique_customer_code_c = " . $userID;
$result = $db->query($sql);
while ($row = $db->fetchByAssoc($result)) {
    $contactId = $row['id_c'];
}


if ($contactId != '' && $userID != '') {
    if ($userStatus == 'Rejected') {
        $get_sales_stage_status = "Select `sales_stage_c` from contacts_cstm where id_c = '" . $contactId . "'";
        $resultSalesStage       = $db->query($get_sales_stage_status);
        $row10                  = $db->fetchByAssoc($resultSalesStage);
        $sales_stage_status     = $row10['sales_stage_c'];
        if ($sales_stage_status == 'Opportunity' || $sales_stage_status == 'Interested_Customer' || $sales_stage_status == 'Customer') {
           
          $query1 = "UPDATE `contacts_cstm` SET `status_c`='$userStatus',`drop_stage1_c`='$dropStage',`rejection_reason_c`='$rejectionReason' WHERE `id_c`='$contactId'";
           
			$result1 = $db->query($query1);
            if($result1)
            {
                   response($userStatus,$dropStage,$rejectionReason,$contactId,$myfile);
                    
            }
        } else {
			
					    $getRejectedcount = $db->query("select id_c from contacts_cstm where id_c = '" . $contactId . "' and status_c = 'Rejected'");
						$row_count = $getRejectedcount->num_rows;
						if($row_count == 0)
						{
							
							if(update_previous_assigned_userId($contactId,$myfile))
							{
								$query2 = "update `contacts_cstm` as A inner join `contacts` as B on A.id_c= B.id SET A.`status_c`='$userStatus',A.`drop_stage1_c`='$dropStage',A.`rejection_reason_c`='$rejectionReason',B.`assigned_user_id`='$default_rejected_user_id' where A.id_c = '$contactId'";
								$result2 = $db->query($query2);
								if($result2)
								{
									response2($userStatus,$dropStage,$rejectionReason,$default_rejected_user_id,$contactId,$myfile);
									
								}
							}else{
								$set_entry_parameters = array('assinedUserID'=>'Assigned User Id Is blank');
								fwrite($myfile,print_r($set_entry_parameters, true));
								fclose($myfile);
								$msg  = array(
												'Success' => false,
												'Message' => 'Sorry Unable to update record, Assigned User Id is blank'
											);
								echo json_encode($msg);
							}
						}else{
							
							$query13 = "UPDATE `contacts_cstm` SET `status_c`='$userStatus',`drop_stage1_c`='$dropStage',`rejection_reason_c`='$rejectionReason' WHERE `id_c`='$contactId'";
							$result13 = $db->query($query13);
							if($result13)
							{
								response3($userStatus,$dropStage,$rejectionReason,$contactId,$myfile);
								
							}
						}
							
							
						
                 
            } 
        
        
    } else if ($userStatus == 'Eligible') {
        
        $sql2    = "select id_c from contacts_cstm where (id_c = '" . $contactId . "' and status_c = 'Eligible') or (id_c='" . $contactId . "' And status_c='') or (id_c = '" . $contactId . "' and status_c = 'blank') or (id_c = '" . $contactId . "' and status_c IS NULL)";
      
        $result2 = $db->query($sql2);
        if ($row2 = $db->fetchByAssoc($result2)) {

            $query3 = "UPDATE `contacts_cstm` SET `status_c`='$userStatus',`drop_stage1_c`='$dropStage',`rejection_reason_c`='$rejectionReason' WHERE `id_c`='$contactId'";
            $result3 = $db->query($query3);
            if($result3)
            {
                response($userStatus,$dropStage,$rejectionReason,$contactId,$myfile);
            }

           
        } else {
            
             //Round Robin functionality
             $assigned_user_id1 = get_previous_assigned_userId($contactId);
            if ($assigned_user_id1 != '') {
                $checkUserAvailable       = "select id from users u JOIN users_cstm uc ON u.id = uc.id_c where u.status='Active'  AND uc.availability_status_c='Available' AND u.id = '" . $assigned_user_id1 . "'";
                //echo  $checkUserAvailable;
                $checkUserAvailableResult = $db->query($checkUserAvailable);
                if ($row = $db->fetchByAssoc($checkUserAvailableResult)) {

                    $query4 = "update `contacts_cstm` as A inner join `contacts` as B on A.id_c= B.id SET A.`status_c`='$userStatus',A.`drop_stage1_c`='$dropStage',A.`rejection_reason_c`='$rejectionReason',B.`assigned_user_id`='$assigned_user_id1' where A.id_c = '$contactId'";
                    $result4 = $db->query($query4);
                    if($result4)
                    {
                        response2($userStatus,$dropStage,$rejectionReason,$assigned_user_id1,$contactId,$myfile);
                        
                    }
                    
                } else {

                            //Round Robin functionality
                             $assigned_user_id_round_robin = reassignement();
							 $query8 = "update `contacts_cstm` as A inner join `contacts` as B on A.id_c= B.id SET A.`status_c`='$userStatus',A.`drop_stage1_c`='$dropStage',A.`rejection_reason_c`='$rejectionReason',B.`assigned_user_id`='$assigned_user_id_round_robin' where A.id_c = '$contactId'";
							$result8 = $db->query($query8);
							if($result8)
							{
							   response2($userStatus,$dropStage,$rejectionReason,$assigned_user_id_round_robin,$contactId,$myfile);
								 
							 }	 
							 
                            
                    }
            } else {
                         
                          // Round Robin functionality 
                          $assigned_user_id_round_robin = reassignement();
                          $query8 = "update `contacts_cstm` as A inner join `contacts` as B on A.id_c= B.id SET A.`status_c`='$userStatus',A.`drop_stage1_c`='$dropStage',A.`rejection_reason_c`='$rejectionReason',B.`assigned_user_id`='$assigned_user_id_round_robin' where A.id_c = '$contactId'";
                          $result8 = $db->query($query8);
                          if($result8)
                          {
                             response2($userStatus,$dropStage,$rejectionReason,$assigned_user_id_round_robin,$contactId,$myfile);
                               
                           } 
						   
                
                }
        }
    } else {
                //if apart from Eligible or Rejected status send then this code will be executed
                $query7 = "UPDATE `contacts_cstm` SET `status_c`='$userStatus',`drop_stage1_c`='$dropStage',`rejection_reason_c`='$rejectionReason' WHERE `id_c`='$contactId'";
                $result7 = $db->query($query7);
                if($result7)
                {
                    response($userStatus,$dropStage,$rejectionReason,$contactId,$myfile);
                }
        
    }
    
    
} else {
             //if contact id or user id is blank then this code will be exceuted
            $msg = array(
                'Success' => false,
                'Message' => 'Invalid Customer Record -> Customer ID not found in record'
            );
            echo json_encode($msg);
        }



function response($userStatus,$dropStage,$rejectionReason,$contactId,$myfile)
{
    //maintaing the log
    $set_entry_parameters = array('status_c'=>$userStatus,'drop_stage1_c'=>$dropStage,'rejection_reason_c'=>$rejectionReason,'id_c'=>$contactId);
    fwrite($myfile,print_r($set_entry_parameters, true));
    fclose($myfile);
    $msg           = array(
        'Success' => true,
        'Message' => 'Record Updated Successfully'
    );
    echo json_encode($msg);
}

function response2($userStatus,$dropStage,$rejectionReason,$assigned_user_id1,$contactId,$myfile)
{
    //maintaing the log
    $set_entry_parameters = array('status_c'=>$userStatus,'drop_stage1_c'=>$dropStage,'rejection_reason_c'=>$rejectionReason,'assigned_user_id'=>$assigned_user_id1,'id_c'=>$contactId);
    fwrite($myfile,print_r($set_entry_parameters, true));
    fclose($myfile);
    $msg           = array(
        'Success' => true,
        'Message' => 'Record Updated Successfully'
    );
    echo json_encode($msg);
}
function response3($userStatus,$dropStage,$rejectionReason,$contactId,$myfile)
{
    //maintaing the log
    $set_entry_parameters = array('status_c'=>$userStatus,'drop_stage1_c'=>$dropStage,'rejection_reason_c'=>$rejectionReason,'id_c'=>$contactId);
    fwrite($myfile,print_r($set_entry_parameters, true));
    fclose($myfile);
    $msg  = array(
					'Success' => true,
					'Message' => 'User is already rejected'
				);
	echo json_encode($msg);
}

function reassignement()
{
    
    //1)auto allocation to advisors on real time in round robin fashion until to reach advisors target. 2) Once target reached data will goes to the resp. managers(Dharmesh)
    global $db, $sugar_config, $current_user;
    

    $assigned_user_id_round_robin = '';
	$target = $sugar_config['users_assignment_target']; //maximum user limit
                    //~ $target = 2;
    // this query check all avialable or active users
	$query = "SELECT distinct(su.user_id) FROM securitygroups sg JOIN securitygroups_users su ON su.securitygroup_id = sg.id JOIN users u ON su.user_id=u.id JOIN users_cstm uc ON u.id=uc.id_c JOIN acl_roles_users aru on aru.user_id=u.id and aru.deleted=0 WHERE sg.name IN('IFA Channel','CSC- Rajasthan emitra','External Outsourcing Agency (SAAR)','Operations Team,Sales Team','Product Team','Technology Team','Legal Team','Marketing Team','General Advisory Team','Offline Marketing','CSC- M.P Online','Corporate Channel','iOS APP','Android APP','5nance.com','Digital Marketing') AND u.status='Active'  AND uc.availability_status_c='Available' AND sg.deleted =0 AND su.deleted=0 AND u.deleted=0 and aru.role_id='a8ab8653-5860-d896-7a78-58466a429bee'";

	$result = $db->query($query);		
	$users_count = $result->num_rows;
	if($users_count > 0)
    {
		$assigned_array=array();
		while($users_row = $db->fetchByAssoc($result))
		{
				$assigned_array[] = $users_row['user_id'];
		} 
  						
		$today = date('Y-m-d');
		$assigned_user_count = array();
		$assigned_user_contacts_count = array();
		for($i=0;$i<sizeof($assigned_array);$i++)
		{
                // finding the count of each advisors
				$records_query = "SELECT count(c.id) as count FROM contacts c LEFT JOIN contacts_cstm cc ON c.id = cc.id_c	WHERE  c.deleted =0 AND c.assigned_user_id = '".$assigned_array[$i]."' AND (date(cc.user_allocation_date_c ) = '$today' OR disposition_c = '')";	
				$records_result = $db->query($records_query);
				$row_records_result = $db->fetchByAssoc($records_result);
				$assigned_user_count[] = $row_records_result['count'];
                 $assigned_user_contacts_count[$row_records_result['count']] = $assigned_array[$i];
		}
		$get_least_count = min($assigned_user_count);  // finding the user having minimum number of count
		if($get_least_count < $target)
		{
			$assigned_user_id_round_robin = $assigned_user_contacts_count[$get_least_count];
			if(empty($assigned_user_id_round_robin))
			{
                // if count is less than target count then randomly get the user and that user become assigned user
				$assigned_user_id_round_robin=$assigned_array[array_rand($assigned_array)];  
			}
		}
		else
			{
                // Default assign to dharmesh
				$query_user = $db->query("select id from users where user_name='Dharmesh' and deleted=0");
				$result_user = $db->fetchByAssoc($query_user);
				$assigned_user_id_round_robin = $result_user['id'];
			}
	}
    else
    {
			$query_user = $db->query("select id from users where user_name='Dharmesh' and deleted=0");
			$result_user = $db->fetchByAssoc($query_user);
			$assigned_user_id_round_robin = $result_user['id'];
    }
    return $assigned_user_id_round_robin;
}
function update_previous_assigned_userId($contactId,$myfile)
{
	//echo $contactId;
    global $db, $sugar_config, $current_user;
    
    $q1 = "SELECT `assigned_user_id` FROM `contacts` WHERE `id`='$contactId'";
	$query1 = $db->query($q1);
	$data1 = $db->fetchByAssoc($query1);
    $prv_assigned_USERID = $data1['assigned_user_id'];
    if(!empty($prv_assigned_USERID))
    {
		fwrite($myfile,print_r($prv_assigned_USERID, true));
        fclose($myfile);
        $update_previous_assigned_id = "UPDATE `contacts_cstm` SET `previous_assigned_userid_c`='$prv_assigned_USERID' WHERE `id_c`='$contactId'";
        $response = $db->query($update_previous_assigned_id);
        if($response){
            return true;
        }
    }

}
function get_previous_assigned_userId($contactId)
{
    global $db, $sugar_config, $current_user;
    
    $get_pre_assID = "SELECT `previous_assigned_userid_c` FROM `contacts_cstm` WHERE `id_c`='$contactId'";
	$Result = $db->query($get_pre_assID);
	$data2 = $db->fetchByAssoc($Result);
    return $data2['previous_assigned_userid_c'];
    
}

?>    