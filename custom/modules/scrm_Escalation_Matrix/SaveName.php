<?php

    if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
   
    class SaveName
    {
        function save_name($bean, $event, $arguments)
        {
			global $app_list_strings;
            //logic
            $team=$GLOBALS['app_list_strings']['teams_list'][$bean->teams_c];
            $bean->name=$team;
        }
    }

?>
