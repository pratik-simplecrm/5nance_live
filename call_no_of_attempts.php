<?php
exit;
if (!defined('sugarEntry'))
    define('sugarEntry', true);
require_once('include/entryPoint.php');
require_once('custom/include/language/en_us.lang.php');

require_once('config.php');

global $db, $sugar_config, $app_list_strings;

echo $sQuery = "select SQL_CALC_FOUND_ROWS * from(SELECT c.id as id,'scrm_Products' as table_name,c.first_name,c.last_name, cc.leadid_c as unique_customer_code_c, ea.email_address as email_address, c.phone_mobile as phone_mobile, cc.gateway_c as gateway_c, cc.campaign_type_c as campaign_type_c, u.user_name as user_name,pc.product_interest_c as product_interest_c,pc.product_sub_type_interest_c as product_sub_type_interest_c, p.date_entered as date_entered, pc.sales_stage_c as sales_stage_c, pc.next_call_planning_comments_c as next_call_planning_comments_c, cc.user_allocation_date_c as user_allocation_date_c, pc.disposition_c as latest_disposition,cc.qparam_c as publisher_subid,p.date_modified as date_modified,cc.utm_content_c as utm_content_c,cc.campaign_c as campaign_c, cc.source_c as source_c, p.id as required_id
    FROM scrm_products p LEFT JOIN scrm_products_cstm pc on p.id=pc.id_c LEFT JOIN contacts_scrm_products_1_c cp on p.id=cp.contacts_scrm_products_1scrm_products_idb LEFT JOIN contacts c on c.id=cp.contacts_scrm_products_1contacts_ida LEFT JOIN contacts_cstm cc on c.id=cc.id_c LEFT JOIN users u on u.id = c.assigned_user_id LEFT JOIN email_addr_bean_rel eabl  ON eabl.bean_id = c.id AND eabl.bean_module = 'Contacts' and eabl.primary_address = 1 and eabl.deleted=0 LEFT JOIN email_addresses ea ON (ea.id = eabl.email_address_id) where p.deleted=0 )a
union all
select * from(select c.id as id,'Contacts' as table_name,c.first_name,c.last_name,cc.leadid_c as unique_customer_code_c, ea.email_address as email_address, c.phone_mobile as phone_mobile, cc.gateway_c as gateway_c, cc.campaign_type_c as campaign_type_c, u.user_name as user_name,cc.product_interest_c as product_interest_c,cc.product_sub_type_interest_c as product_sub_type_interest_c, c.date_entered as date_entered, cc.sales_stage_c as sales_stage_c, cc.next_call_planning_comments_c as next_call_planning_comments_c, cc.user_allocation_date_c as user_allocation_date_c, cc.disposition_c as latest_disposition,cc.qparam_c as publisher_subid,c.date_modified as date_modified,cc.utm_content_c as utm_content_c,cc.campaign_c as campaign_c, cc.source_c as source_c,c.id as required_id from contacts c LEFT join contacts_cstm cc on c.id=cc.id_c LEFT join users u on u.id = c.assigned_user_id LEFT JOIN email_addr_bean_rel eabl  ON eabl.bean_id = c.id AND eabl.bean_module = 'Contacts' and eabl.primary_address = 1 and eabl.deleted=0 LEFT JOIN email_addresses ea ON (ea.id = eabl.email_address_id) where  c.deleted=0 )b ";


$rResult = $db->query($sQuery);

//$rResult = mysql_query($sQuery, $gaSql['link']) or die(mysql_error());

/* Data set length after filtering */
$sQuery = "SELECT FOUND_ROWS() as iFilteredTotal";
//$rResultFilterTotal = mysql_query($sQuery, $gaSql['link']) or die(mysql_error());
$rResultFilterTotal = $db->query($sQuery);
$aResultFilterTotal = $db->fetchByAssoc($rResultFilterTotal);
echo "<pre>";
print_r($aResultFilterTotal);
//$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
$i=1;
$disposition_list = $GLOBALS['app_list_strings']['disposition_list'];
$old_disposition_list = $GLOBALS['app_list_strings']['old_disposition_list'];
$disposition_list = array_merge($disposition_list, $old_disposition_list);
 while ($contact_row = $db->fetchByAssoc($rResult)) {
     echo "<br>No. of Records :".$i."<br>";
   $module_name=$contact_row['table_name'];
 //print_r($contact_row);
   $bean = BeanFactory::getBean($module_name, $contact_row['required_id']);

//$callquery='select * from calls where parent_type="'.$module_name.'" and parent_id="'.$contact_row['required_id'].'" and deleted="0"';   
//$callResult = $db->query($callquery);


    
    //If relationship is loaded
    if($module_name=='scrm_Products'){
    if ($bean->load_relationship('scrm_products_activities_1_calls')) {
        $my_calls = $bean->get_linked_beans('scrm_products_activities_1_calls', 'Calls');
    }
    }else{
   if ($bean->load_relationship('calls')) {
        $my_calls = $bean->get_linked_beans('calls', 'Calls');
         }
    }

    $array_call = '';
    
    foreach ($my_calls as $calls) {



        


        if (($calls->status == "Held" || $calls->status == "Missed" || $calls->status == "Not Held" )&& $calls->created_by != '1' && in_array(trim($calls->name), $disposition_list)) {

            $array_call[] = array(
                "name" => $calls->name,
                "date_start" => date('Y-m-d H:i:s', strtotime('+5 hours +30 minutes', strtotime(($calls->fetched_row['date_modified'])))),
                    // "date_start" => $calls->date_start,
            );
           
            
        }
    }
     echo "<br>Total Call :";
    if(!empty($array_call)){
        print_r($array_call);
    echo $no_of_attempts=count($array_call);
    }else{
        echo $no_of_attempts=0;
    }
    echo "<br>";
     if($module_name=='scrm_Products'){
    echo    $update_query="UPDATE scrm_products_cstm SET no_of_attempts_c ='".$no_of_attempts."'  WHERE id_c = '".$contact_row['required_id']."'";
     
    }else{
   echo    $update_query="UPDATE contacts_cstm SET no_of_attempts_c ='".$no_of_attempts."'  WHERE id_c = '".$contact_row['required_id']."'";
  
    }
       
    
     $updated_result   = $db->query($update_query);
        if($updated_result){
            echo "<br>Record Updated Successfully --->".$contact_row['required_id']."------------->Mobile No :".$contact_row['phone_mobile'];
             $i++;
        }else{
            echo "<br>Record Not Updated Successfully --->".$contact_row['required_id']."------------->Mobile No :".$contact_row['phone_mobile'];
        }
        echo "<br>";
    echo "--------------------------------------------------------------------***-------------------------------------------------------------------";
    $i++;
    
 }
?>