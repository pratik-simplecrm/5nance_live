<?php

/*
 * Script:    DataTables server-side script for PHP and MySQL
 * Copyright: 2010 - Allan Jardine
 * License:   GPL v2 or BSD (3-point)
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

/* Array of database columns which should be read and sent back to DataTables. Use a space where
 * you want to insert a non-database field (for example a counter or static image)
 */
if (!defined('sugarEntry'))
    define('sugarEntry', true);
require_once('include/entryPoint.php');
require_once('config.php');

global $db, $sugar_config;
$aColumns = array('product_interest', 'id');
$bColumns = array('product_interest');

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "id";
$sTable='product_interest';

/*
 * Paging
 */
$sLimit = "";
if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
    $sLimit = "LIMIT " . addslashes($_GET['iDisplayStart']) . ", " .
            addslashes($_GET['iDisplayLength']);
}


/*
 * Ordering
 */
if (isset($_GET['iSortCol_0'])) {
    $sOrder = "ORDER BY  ";
    for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
        if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
            $sOrder .= $aColumns[intval($_GET['iSortCol_' . $i])] . "
				 	" . addslashes($_GET['sSortDir_' . $i]) . ", ";
        }
    }

    $sOrder = substr_replace($sOrder, "", -2);
    if ($sOrder == "ORDER BY") {
        $sOrder = "";
    }
}


$sWhere = "";
if ($_GET['sSearch'] != "") {
    $sWhere = "(";
    for ($i = 0; $i < count($bColumns); $i++) {
        $sWhere .= $bColumns[$i] . " LIKE '%" . addslashes($_GET['sSearch']) . "%' OR ";
    }
   
    $sWhere = substr_replace($sWhere, "", -3);
    $sWhere .= ') AND';
}

/* Individual column filtering */
for ($i = 0; $i < count($bColumns); $i++) {
    if ($_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
        if ($sWhere == "") {
            $sWhere = "WHERE ";
        } else {
            $sWhere .= " AND ";
        }
        $sWhere .= $bColumns[$i] . " LIKE '%" . addslashes($_GET['sSearch_' . $i]) . "%' ";
    }
}



$sQuery = "select SQL_CALC_FOUND_ROWS DISTINCT id,product_interest from product_interest " . $sOrder . " " . $sLimit . "";
$rResult = $db->query($sQuery);

/* Data set length after filtering */

$sQuery = "SELECT FOUND_ROWS() as iFilteredTotal";
$rResultFilterTotal = $db->query($sQuery);
$aResultFilterTotal = $db->fetchByAssoc($rResultFilterTotal);
$iFilteredTotal = $aResultFilterTotal['iFilteredTotal'];

/* Total data set length */
$sQuery = "     SELECT COUNT(id) as iTotal
		FROM   product_interest ";
$itotalquery = $db->query($sQuery);
$aResultTotal = $db->fetchByAssoc($itotalquery);
$iTotal = $aResultTotal['iTotal'];

/*
 * Output
 */
$output = array(
    "sEcho" => intval($_GET['sEcho']),
    "iTotalRecords" => $iTotal,
    "iTotalDisplayRecords" => $iFilteredTotal,
    "aaData" => array()
);


while ($aRow = $db->fetchByAssoc($rResult)) {
    
    
    $users_query = "SELECT * FROM assign_products WHERE product_id='" . $aRow["id"] . "'";
$get_users = $db->query($users_query);
$data = $db->fetchByAssoc($get_users);

     $guid=unserialize(base64_decode($data['users_id']));

//$Uquery = "SELECT * from users where deleted=0";
$Uquery = "SELECT distinct(su.user_id) as id, u.user_name as user_name FROM securitygroups sg JOIN securitygroups_users su ON su.securitygroup_id = sg.id JOIN users u ON su.user_id=u.id JOIN users_cstm uc ON u.id=uc.id_c JOIN acl_roles_users aru on aru.user_id=u.id and aru.deleted=0 WHERE u.status='Active'  AND uc.availability_status_c='Available' AND sg.deleted =0 AND su.deleted=0 AND u.deleted=0 and aru.role_id='a8ab8653-5860-d896-7a78-58466a429bee'";
$uresult = $db->query($Uquery);

while ($getresult = $db->fetchByAssoc($uresult)) {
    if(in_array($getresult['id'],$guid)){
         $show_selected.="<li name='attributes' id='".$getresult['id']."' class='list_element'>".$getresult['user_name']."</li>";
   
    }else{
         $allusers.="<li name='attributes' id='".$getresult['id']."' class='list_element'>".$getresult['user_name']."</li>";
    }
   
   
}

    $row = array();
    for ($i = 0; $i < count($aColumns); $i++) {
        if ($aColumns[$i] == "id") {
            /* Special output formatting for 'version' column */
//            $row[] = '<select name="user_list_'.$aRow["id"].'" id="user_list_'.$aRow["id"].'" class="user_list" data-product="'.$aRow['product_interest'].'" multiple="multiple">'.$allusers.'</select> ';
            $row[] ='<div class="show_user_list" id="show_user_list_'.$aRow["id"].'"><script> $("table.products-table").find("ul.sortable_'.$aRow["id"].'").sortable({
    connectWith: "ul.sortable_'.$aRow["id"].'"
        });
function setMenusDivHeight($attributeDivs) {
        return $attributeDivs.css("min-height", "110px");
}

 setMenusDivHeight($("table.products-table").find("ul.sortable_'.$aRow["id"].'")).sortable({
  connectWith: "ul.sortable_'.$aRow["id"].'",
 
});        
</script>
<input type="hidden" id="user_list_'.$aRow["id"].'" data-product="'.$aRow['product_interest'].'" >
<ul id="unassigned_attributes_'.$aRow["id"].'" class="sortable_'.$aRow["id"].' ">'.$allusers.'</ul></div>';
            $row[] ='<div class="show_user_list" id="show_user_list_'.$aRow["id"].'"><ul id="assigned_attributes_'.$aRow["id"].'" class="sortable_'.$aRow["id"].' ">'.$show_selected.'</ul></div>';
             $row[] = "<a href='javascript:void(0)' class='update-users-button' id='product_" . $aRow['id'] . "' name='product_" . $aRow['id'] . "' title='Update'><i class='fa fa-lg fa-pencil-square-o' aria-hidden='true'></i></a>";
        } else if ($aColumns[$i] == "product_interest") {
            /* Special output formatting for 'version' column */
            $row[] = "<a href='javascript:void(0)'  target='_blank'>" . $aRow[$aColumns[$i]] . "</a>";
        } else if ($aColumns[$i] != ' ') {
            /* General output */
            $row[] = $aRow[$aColumns[$i]];
        }
    }

    $output['aaData'][] = $row;
    $n++;
    unset($allusers);
    unset($show_selected);
}

echo json_encode($output);
?>
