<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
//~ ini_set("display_errors","On");

class leadstatusupdate {
	
	public function leadstatusupdate(&$bean, $event, $args) {
			$dispositon = $bean->disposition_c;
			$explode_disposition = explode('_', $dispositon);
			$dispositon_key = $explode_disposition[0];
			$bean->status = $dispositon_key;
		}
	}
?>