<?php
class campaignsource{
	
	function campaignsource($bean, $event, $arguments){
		
		global $db,$current_user,$sugar_config;

		$campaignsource = $bean->campaign_type_c;
		if($campaignsource){
			/*****************fetch campaign id*********************************/
			$fetch_campaign_id = $db->query("select id from scrm_campaign_source where source_id='$campaignsource' and deleted=0");
			$result_campaing_id = $db->fetchByAssoc($fetch_campaign_id);
			$campaign_id = $result_campaing_id['id'];
			/*********************link lead with campaign**********************/
			$campaign_relationid = create_guid();
			$insert_relationship_query = "INSERT INTO leads_scrm_campaign_source_1_c (id, date_modified,deleted,leads_scrm_campaign_source_1leads_ida,leads_scrm_campaign_source_1scrm_campaign_source_idb) VALUES ('$campaign_relationid',now(),0,'".$bean->id."','$campaign_id')";
			$result_insert_relationship_query = $db->query($insert_relationship_query);
		}
		}
}

?>
