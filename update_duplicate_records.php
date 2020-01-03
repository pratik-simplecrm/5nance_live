<?php

if (!define('sugarEntry'))
    define('sugarEntry', true);
require_once('include/entryPoint.php');
require_once('config.php');
ini_set('display_errors', 'On');
global $db, $app_list_strings, $sugar_config;



$contacts_query = "select count(*) as count,id,unique_customer_code_c,date_modified,modified_user_id,id_c,disposition_c from  contacts join contacts_cstm on id=id_c where contacts.deleted=1 and disposition_c!='' and contacts_cstm.unique_customer_code_c IN('6047','17006','8282','76348','16977','8221','76350','17039','15728','76348','15778','17038','17021','8166','8232','76350','17008','17020','76345','16997','8165','76348','76350','17043','76348','16996','8057','16992','76345','17050','17016','17022','17094','16986','17069','17097','8212','17089','17073','17095','17009','17035','8261','8049','8255','17028','76350','76345','8178','17077','8242','17034','8251','17051','17023','8181','15693','8290','18113','17040','8224','18172','17101','8256','8220','8176','8215','17033','17085','17001','8053','15731','18093','15710','8211','8184','15688','15676','18166','8190','15677','16993','8058','8284','15687','17091','18158','17003','15658','8183','8287','16989','8218','15673','16988','8208','8194','17031','75421','6057','75417','17037','72797','72797','72797','17045','8186','76033','76033','76033','76033','76033','76033','76033','76033','76033','8276','17029','17013','8243','8047','15692','76032','76032','76344','76032','76032','76032','76032','76032','76032','8185','16995','15709','16985','8291','15675','8160','16979','72796','72796','72796','15689','8288','15706','18176','17010','75425','8161','15655','17047','8162','16994','8250','8054','75416','8214','15672','15674','15653','6048','16980','15708','17049','15670','8285','15656','15690','8247','76346','76346','76346','8213','8289','75424','8192','15671','18140','17042','8171','8191','17017','8249','16984','8052','76034','76034','76034','76034','76034','76034','76034','76034','6046','76034','76034','76034','76034','15657','8277','15711','18177','15654','76031','76031','76031','76031','76031','76031','76031','76031','75419','76349','76349','76349','76349','8055','15764','15694','8203','17026','6058','8219','76347','76347','76347','8187','8167','8241','15691','75420','8228','8260','76035','76035','76035','76035','76035','76035','76035','76035','76035','17032','8179','76030','76030','76351','76030','76351','76030','76030','76030','76351','76351','76030','76030','8222') group by unique_customer_code_c having count>0 ";

$contacts_result = $db->query($contacts_query);

while ($contacts_row = $db->fetchByAssoc($contacts_result)) {

   $customer_code=$contacts_row['unique_customer_code_c'];
    echo "<br>";
    echo $contacts_row['count']."++++".$contacts_row['id']."==>".$contacts_row['unique_customer_code_c']."==>".$contacts_row['disposition_c'];
   if($contacts_row['count']>1){
       $multiple_contacts_query = "select id,unique_customer_code_c,date_modified,modified_user_id,id_c,disposition_c from  contacts join contacts_cstm on id=id_c where contacts.deleted=1 and disposition_c!=''  and contacts_cstm.unique_customer_code_c='".$customer_code."' ORDER BY date_modified desc limit 1";
       $multiple_contacts_result = $db->query($multiple_contacts_query);

$multiple_contacts_row = $db->fetchByAssoc($multiple_contacts_result);
      echo "<br>multiple-------------------------------------------------->".$multiple_contacts_row['id']."==>".$multiple_contacts_row['date_modified']."==>".$multiple_contacts_row['disposition_c'];
      $get_disposition=$multiple_contacts_row['disposition_c'];
      $get_date_modified=$multiple_contacts_row['date_modified'];
      $get_modified_user_id=$multiple_contacts_row['modified_user_id'];
    


}else{
	$multiple_contacts_query = "select id,unique_customer_code_c,date_modified,modified_user_id,id_c,disposition_c from  contacts join contacts_cstm on id=id_c where contacts.deleted=1 and disposition_c!=''  and contacts_cstm.unique_customer_code_c='".$customer_code."' ";
       $multiple_contacts_result = $db->query($multiple_contacts_query);
       $multiple_contacts_row = $db->fetchByAssoc($multiple_contacts_result);
        echo "<br>One-------------------------------------------------->".$multiple_contacts_row['id']."==>".$multiple_contacts_row['date_modified']."==>".$multiple_contacts_row['disposition_c'];
 
           $get_disposition=$multiple_contacts_row['disposition_c'];
           $get_date_modified=$multiple_contacts_row['date_modified'];
           $get_modified_user_id=$multiple_contacts_row['modified_user_id'];

}
echo "<br>";
echo "<br>";

 $id_query = "select id,disposition_c from contacts join contacts_cstm on id=id_c where contacts.deleted=0 and contacts_cstm.unique_customer_code_c='".$customer_code."'";
       $id_result = $db->query($id_query);
       $id_row = $db->fetchByAssoc($id_result);
       $get_id=$id_row['id'];
if(empty($id_row['disposition_c'])){
echo $contact_query_update = "UPDATE contacts c INNER JOIN contacts_cstm cc ON (c.id= cc.id_c)
SET cc.disposition_c = '$get_disposition', c.date_modified = '$get_date_modified', c.modified_user_id ='$get_modified_user_id'
WHERE c.id = '$get_id'";

			//$contact_result_update = $db->query($contact_query_update);
            if(isset($contact_result_update)){
                echo "updated Contact<br>";
            }
}
unset($get_disposition);
      unset($get_date_modified);
      unset($get_modified_user);
 // exit;
    
}
?>