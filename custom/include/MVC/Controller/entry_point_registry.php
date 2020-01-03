<?php
// created: 2016-04-14 16:04:38

//~ $entry_point_registry['AsteriskController'] = array (
  //~ 'file' => 'custom/modules/Asterisk/include/controller.php',
  //~ 'auth' => true,
//~ );
//~ $entry_point_registry['AsteriskCallListener'] = array (
  //~ 'file' => 'custom/modules/Asterisk/include/callListener.php',
  //~ 'auth' => true,
//~ );
$entry_point_registry['AsteriskCallCreate'] = array (
  'file' => 'custom/modules/Asterisk/include/callCreate.php',
  'auth' => true,
);
$entry_point_registry['crmapi'] = array (
  'file' => 'crmapi.php',
  'auth' => false,
);
$entry_point_registry['autopopulate'] = array (
  'file' => 'custom/modules/Cases/autopopulate.php',
  'auth' => false,
);
$entry_point_registry['generateOTP'] = array (
  'file' => 'custom/modules/Leads/generateOTP.php',
  'auth' => false,
);
$entry_point_registry['investmentadvisory'] = array (
  'file' => 'custom/modules/Contacts/investmentadvisory.php',
  'auth' => false,
);
$entry_point_registry['GetUserActivities'] = array (
  'file' => 'custom/modules/Contacts/websiteuseractivities.php',
  'auth' => false,
);
$entry_point_registry['sendOTP'] = array (
  'file' => 'custom/modules/Leads/sendOTP.php',
  'auth' => false,
);
$entry_point_registry['lmsleadcreation'] = array (
  'file' => 'custom/modules/Leads/lmsleadcreation.php',
  'auth' => false,
);
$entry_point_registry['JustDialLeadToCRM'] = array (
  'file' => 'custom/modules/Leads/LeadCreationAPIJD.php',
  'auth' => false,
);
$entry_point_registry['dispositions_report_server_processing'] = array (
  'file' => 'custom/modules/scrm_Custom_Reports/views/dispositions_report_server_processing.php',
  'auth' => false,
);
$entry_point_registry['dispositions_report_server_processing_of_product'] = array (
  'file' => 'custom/modules/scrm_Custom_Reports/views/dispositions_report_server_processing_of_product.php',
  'auth' => false,
);

$entry_point_registry['GetPartnerDetails'] = array (
  'file' => 'custom/modules/Contacts/GetPartnerDetailsAPI.php',
  'auth' => false,
);
$entry_point_registry['PartnerContactCreation'] = array (
  'file' => 'custom/modules/Contacts/PartnerContactCreationAPI.php',
  'auth' => false,
);

$entry_point_registry['getallproducts'] = array (
  'file' => 'custom/modules/Administration/Assign_Products/getallproducts.php',
  'auth' => false,
);

$entry_point_registry['updateproductusers'] = array (
  'file' => 'custom/modules/Administration/Assign_Products/updateproductusers.php',
  'auth' => false,
);




$entry_point_registry['inboundScheduler'] = array (
  'file' => 'inboundScheduler.php',
  'auth' => false,
);

$entry_point_registry['Test'] = array (
  'file' => 'test.php',
  'auth' => false,
);

 $entry_point_registry['disqualifiedlead'] = array(
  'file' => 'custom/disqualifiedlead.php',
  'auth' => false
);

$entry_point_registry['createCallOnPriority'] = array(
  'file' => 'custom/createcallonpriority.php',
  'auth' => false
);
$entry_point_registry['getdisposition'] = array(
  'file' => 'custom/getdisposition.php',
  'auth' => false
);