<?php
class myorders{
	function myorders_summary($bean,$events,$arguments){
		global $db;
		/****************orders summarization*****************/
		$contact_id = $bean->id;
	    $bean->load_relationship('contacts_scrm_my_orders_1');		
		$my_orders = $bean->get_linked_beans('contacts_scrm_my_orders_1','scrm_My_Orders'); 
		$count = 1;
		foreach ( $my_orders as $orders ) { 
		  $order_id = $orders->id;
		  $transaction_subtype = $orders->transactionsubtype_c;
		  $assetClass = $orders->asset_class_c;
		  if(strtolower($transaction_subtype) == 'lumpsum'){
		  		$lumpusm_amount += $orders->invoice_amount_c;
		  		$lumpusm_orders += $count;
		  }else if(strtolower($transaction_subtype) == 'sip'){
		  		$sip_amount += $orders->invoice_amount_c;
		  		$sip_orders += $count;
		  }
		  if(strtolower($transaction_subtype) == 'lumpsum' && $assetClass == 'Deposit'){
		  	$no_of_fd_orders += $count;
		  	$fd_total_amount += $orders->invoice_amount_c;
		  }

		  $total_orders += $count;
		  $total_orders_amount += $orders->invoice_amount_c;
		}
		if(!empty($bean->id)){
			$contact_bean = new Contact();
			$contact_bean->retrieve($bean->id);
			$contact_bean->summarizing_total_sip_amount_c = $sip_amount;
			$contact_bean->summarizing_the_total_lumpsu_c = $lumpusm_amount;
			$contact_bean->summarizing_total_amount_c = $total_orders_amount;
			$contact_bean->summarizing_total_orders_c = $total_orders;
			$contact_bean->total_sip_orders_c = $sip_orders;
			$contact_bean->total_lumpsum_order_c = $lumpusm_orders;
			$contact_bean->no_of_fd_investment_orders_c = $no_of_fd_orders;
			$contact_bean->total_amount_fd_c = $fd_total_amount;
			$contact_bean->save();
		}
		
		
	}

}
?>