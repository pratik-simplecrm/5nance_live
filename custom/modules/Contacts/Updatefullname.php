<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
//~ ini_set('display_errors','On');
class Updatefullname {
	public function Updatefullname_method($bean, $event, $arguments) {
		
		/**************name concatenation with middle name*********************/
		if(!empty($bean->middle_name_c))
		{
			$bean->first_name = $bean->first_name.' '.$bean->middle_name_c;
		}
	}
}

?>
