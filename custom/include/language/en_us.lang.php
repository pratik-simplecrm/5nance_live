<?php
$GLOBALS['app_list_strings']['type_list']=array (
  'Hot' => 'Hot',
  'Warm' => 'Warm',
  'Cold' => 'Cold',
);
$app_strings['LBL_GROUPTAB3_1440738985'] = 'Sales';

$app_strings['LBL_GROUPTAB4_1440738985'] = 'Marketing';
$app_list_strings['moduleList']['Leads']='Leads';
$app_list_strings['moduleListSingular']['Leads']='Lead';
$app_list_strings['record_type_display']['Leads']='Lead';
$app_list_strings['parent_type_display']['Leads']='Lead';
$app_list_strings['record_type_display_notes']['Leads']='Lead';
$GLOBALS['app_list_strings']['source_list']=array (
   '' => '',
  'Call' => 'Phone',
  'Inbound_Email' => 'Inbound Email',
  'Facebook' => 'Facebook',
  'Twitter' => 'Twitter',
  'InPerson' => 'InPerson',
);
$GLOBALS['app_list_strings']['approval_status_dom']=array (
  '' => '',
  'Not Approved' => 'Not Approved',
  'Pending_Approval' => 'Pending Approval',
  'Approved' => 'Approved',
);




#$GLOBALS['app_list_strings']['teams_list']=array (
#  '' => '',
#  'Support_Group' => 'Support Group',
#  'Sales_Group' => 'Sales Group',
#);
$new_teams_array=array(
   ''=>'',
);
$db = DBManagerFactory::getInstance(); 
$result=$db->query("select id, name from securitygroups where deleted='0'");
while($row=$db->fetchRow($result)){$new_teams_array[$row['id']] = $row['name'];}
$GLOBALS['app_list_strings']['teams_list']=$new_teams_array;
$GLOBALS['app_list_strings']['escalation_minutes_level1_list']=array (
  '' => '',
  5 => '5',
  10 => '10',
  15 => '15',
  30 => '30',
  45 => '45',
  60 => '60',
);
$GLOBALS['app_list_strings']['escalation_minutes_level2_c_list']=array (
  '' => '',
  10 => '10',
  15 => '15',
  30 => '30',
  45 => '45',
  60 => '60',
);

/*
$GLOBALS['app_list_strings']['email_template_1_list']=array (
  '' => '',
  'Update_Custome' => 'Update Customer on the Issue',
  'Quote_Price' => 'Quote Price Negotiation',
  'Quote_Approved' => 'Quote Approved',
  'Quote_Not_Approved' => 'Quote Not Approved',
  'New_Quote' => 'New Quote for Approval',
  'Welcome_To_SimpleWorks' => 'Welcome To SimpleWorks',
  'Deadline_missed' => 'Deadline missed',
  'Case_Closure' => 'Case Closure',
  'Joomla_Account' => 'Joomla Account Creation',
  'Case_Creation' => 'Case Creation',
  'Contact_Case' => 'Contact Case Update',
  'User_Case_Update' => 'User Case Update',
  'System_password' => 'System-generated password email',
  'Forgot_Password_email' => 'Forgot Password email',
  'Event_Invite_Template' => 'Event Invite Template',
);
*/

$new_email_templates_array=array(
   ''=>'',
);
$db = DBManagerFactory::getInstance(); 
$result=$db->query("select id, name from email_templates where deleted='0'");
while($row=$db->fetchRow($result)){$new_email_templates_array[$row['id']] = $row['name'];}
$GLOBALS['app_list_strings']['email_template_1_list']=$new_email_templates_array; 




$GLOBALS['app_list_strings']['country_list']=array (
  '' => '',
);

$db = DBManagerFactory::getInstance(); 
$state_array=array(''=>'',);
$result=$db->query("select id, name from state");
while($row=$db->fetchRow($result)){$state_array[$row['id']] = $row['name'];}
$GLOBALS['app_list_strings']['state_list']=$state_array;

$city_data = array(''=>'',);
$db = DBManagerFactory::getInstance(); 
$result=$db->query("select id, name from city");
while($row=$db->fetchRow($result)){$city_data[$row['id']] = $row['name'];}
$GLOBALS['app_list_strings']['city_c_list']=$city_data;

$GLOBALS['app_list_strings']['quarter_list']=array (
  '' => '',
  1 => 'Q1',
  2 => 'Q2',
  3 => 'Q3',
  4 => 'Q4',
);

$GLOBALS['app_list_strings']['role1_0']=array (
  '' => '',
  'Marketing Manager' => 'Marketing Manager',
  'Support Rep' => 'Support Rep',
  'Support Manager' => 'Support Manager',
  'Sales Manager' => 'Sales Manager',
  'Sales Rep' => 'Sales Rep',
);

$GLOBALS['app_list_strings']['lead_simplecrm_status_list']=array (
  '' => '',
  'In_Review' => 'In Review',
  'Qualified' => 'Qualified',
  'Not_Qualified' => 'Not Qualified',
);
$GLOBALS['app_list_strings']['lead_partner_status_list']=array (
  '' => '',
  'In_Review' => 'In Review',
  'Accepted' => 'Accepted',
  'Rejected' => 'Rejected',
);
$GLOBALS['app_list_strings']['status_list']=array (
  '' => '',
  'New' => 'New',
  'Open' => 'Open - Close in 1 Month',
  'Open3' => 'Open - Close in 3 Month',
  'Open6' => 'Open - Close in 6 Month',
  'Converted' => 'Converted to Customer',
  'Dead' => 'Dead',
);
$GLOBALS['app_list_strings']['case_type_dom']=array (
  'Minor_Defect' => 'Service Request',
  'Defect' => 'Claim',
  'Change_Request' => 'Complaint',
  'Product_Enhancement_Request' => 'General Feedback',
  'Pre_Sales_Related' => 'Pre Sales Related',
  'Other' => 'Other',
);

$GLOBALS['app_list_strings']['type_0']=array (
  'HL' => 'Home Loan',
  'CL' => 'Car Loan',
  'SL' => 'Student Loan',
);

$GLOBALS['app_list_strings']['loan_type_list']=array (
  '' => '',
  'HL' => 'Home Loan',
  'CL' => 'Car Loan',
  'SL' => 'Student Loan',
);

$GLOBALS['app_list_strings']['category_list']=array (
  'Hot' => 'Hot',
  'Warm' => 'Warm',
);
$GLOBALS['app_list_strings']['lead_source_dom']=array (
  '' => '',
  'Cold Call' => 'Cold Call',
  'Existing Customer' => 'Existing Customer',
  'Self Generated' => 'Self Generated',
  'Employee' => 'Employee',
  'Partner' => 'Partner',
  'Public Relations' => 'Public Relations',
  'Direct Mail' => 'Direct Mail',
  'Conference' => 'Conference',
  'Trade Show' => 'Trade Show',
  'Web Site' => 'Web Site',
  'Word of mouth' => 'Word of mouth',
  'Email' => 'Email',
  'Campaign' => 'Campaign',
  'Other' => 'Other',
  'test' => 'test',
);
$GLOBALS['app_list_strings']['region_list']=array (
  '' => '',
  'Asia' => 'Asia',
  'Europe' => 'Europe',
  'Africa' => 'Africa',
);
$GLOBALS['app_list_strings']['country_0']=array (
  '' => '',
  'Asia_China' => 'China',
  'Asia_India' => 'India',
  'Asia_Iraq' => 'Iraq',
  'Asia_SaudiArabia' => 'Saudi Arabia',
  'Asia_Turkey' => 'Turkey',
  'Europe_Ukraine' => 'Ukraine',
  'Europe_Italy' => 'Italy',
  'Europe_Spain' => 'Spain',
  'Europe_England' => 'England',
  'Africa_SouthAfrica' => 'South Africa',
);
$GLOBALS['app_list_strings']['cstm_user_type_list']=array (
  '' => '',
  'Kiosk' => 'Kiosk',
  'Citizen' => 'Citizen',
);
$GLOBALS['app_list_strings']['cstm_gender_list']=array (
  '' => '',
  'Male' => 'Male',
  'Female' => 'Female',
);

$GLOBALS['app_list_strings']['cstm_dnc_list']=array (
  '' => '',
  'Registered' => 'Registered',
  'Not Registered' => 'Not Registered',
);
$GLOBALS['app_list_strings']['exisiting_investments_list']=array (
  '' => '',
  'Equity' => 'Equity',
  'Mutual_Fund' => 'Mutual Fund',
  'Gold' => 'Gold',
  'Silver' => 'Silver',
  'Real_Estate' => 'Real Estate',
  'Deposites' => 'Deposites',
  'Bonds' => 'Bonds',
);
$GLOBALS['app_list_strings']['cstm_verified_list']=array (
  '' => '',
  'Yes' => 'Yes',
  'No' => 'No',
);
$GLOBALS['app_list_strings']['disposition_User_list']=array (
'' => '',
'Customer interested in our products'=>'Customer interested in our products',
'Prospect- Investor Ac Activated'=>'Prospect- Investor Ac Activated',
'Hot Prospect- Initial Payment pending/NACH awaited'=>'Hot Prospect- Initial Payment pending/NACH awaited',
'Converted to Customer'=>'Converted to Customer',
'Callback/Follow up'=>'Callback/Follow up',
'Not Contactable - Ringing'=>'Not Contactable - Ringing',
'Not Contactable - Busy'=>'Not Contactable - Busy',
'Not Contactable - Not Reachable/Temp Suspended'=>'Not Contactable - Not Reachable/Temp Suspended',
'Not Contactable - Wrong Number'=>'Not Contactable - Wrong Number',
'Not Contactable - Switched off'=>'Not Contactable - Switched off',
'Not Interested - In our Product/Services'=>'Not Interested - In our Product/Services',
'Not Interested - Financial Issues'=>'Not Interested - Financial Issues',
'Not Interested - Lost to Competition'=>'Not Interested - Lost to Competition',
'Not Interested - Reason Unknown'=>'Not Interested - Reason Unknown',
'Not Eligible - Document Issue'=>'Not Eligible - Document Issue',
'Not Eligible - Income Norms'=>'Not Eligible - Income Norms',
'Not Eligible - Company Norms'=>'Not Eligible - Company Norms',
'Not Eligible - Age Norms'=>'Not Eligible - Age Norms',
'Not Eligible - CIBIL Norms'=>'Not Eligible - CIBIL Norms',
'Not Eligible - Others'=>'Not Eligible - Others',
'Non Service Location'=>'Non Service Location',
'Not Contactable - Outbound Attempts Over'=>'Not Contactable - Outbound Attempts Over',
'Under Migration Process'=>'Under Migration Process',
);
$GLOBALS['app_list_strings']['disposition_Personal Loans_User_list']=array (
''=>'',
'Callback/Follow up'=>'Callback/Follow up',
'Not Contactable - Ringing'=>'Not Contactable - Ringing',
'Not Contactable - Busy'=>'Not Contactable - Busy',
'Not Contactable - Not Reachable/Temp Suspended'=>'Not Contactable - Not Reachable/Temp Suspended',
'Not Contactable - Switched off'=>'Not Contactable - Switched off',
'Prospect- Investor Ac Activated'=>'Prospect- Investor Ac Activated',
'Hot Prospect- Initial Payment pending/NACH awaited'=>'Hot Prospect- Initial Payment pending/NACH awaited',
'Opportunity - Sent to the Partner'=>'Opportunity - Sent to the Partner',
      //New Personal loan dispositions 29-8-18 start
    'Opportunity - Not Contactable' => 'Opportunity - Not Contactable',
    'Opportunity - Cibil Reject' => 'Opportunity - Cibil Reject',
    'Opportunity - Over Leveraged' => 'Opportunity - Over Leveraged',
    'Opportunity - Not Interested' => 'Opportunity - Not Interested',
    'Opportunity - Income Norms' => 'Opportunity - Income Norms',
    'Opportunity - Company Norms' => 'Opportunity - Company Norms',
    'Opportunity - Document Issue' => 'Opportunity - Document Issue',
    'Opportunity - Others' => 'Opportunity - Others',
    'Opportunity - Login' => 'Opportunity - Login',
    //New Personal loan dispositions 29-8-18 end  
'Not Interested - In our Product/Services'=>'Not Interested - In our Product/Services',
'Not Interested - Financial Issues'=>'Not Interested - Financial Issues',
'Not Interested - Lost to Competition'=>'Not Interested - Lost to Competition',
'Not Interested - Reason Unknown'=>'Not Interested - Reason Unknown',
'Not Eligible - Document Issue'=>'Not Eligible - Document Issue',
'Not Eligible - Income Norms'=>'Not Eligible - Income Norms',
'Not Eligible - Company Norms'=>'Not Eligible - Company Norms',
'Not Eligible - Age Norms'=>'Not Eligible - Age Norms',
'Not Eligible - CIBIL Norms'=>'Not Eligible - CIBIL Norms',
'Not Eligible - Others'=>'Not Eligible - Others',
'Non Service Location'=>'Non Service Location',
'Language Barrier'=>'Language Barrier',
'Not Eligible - Salary credit in Cash/Cheque'=>'Not Eligible - Salary credit in Cash/Cheque',
'Not Eligible - ITR Norms'=>'Not Eligible - ITR Norms',
'Not Eligible - Job Stability '=>'Not Eligible - Job Stability ',
'Not Eligible - EMI Bounce'=>'Not Eligible - EMI Bounce',
'Not Eligible - Foir Norms'=>'Not Eligible - Foir Norms',
'Not Eligible - Non Salaried Profile'=>'Not Eligible - Non Salaried Profile',
'Not Eligible - Residence Stability'=>'Not Eligible - Residence Stability',
'Not Eligible - Higher Loan Amount'=>'Not Eligible - Higher Loan Amount',
'Not Eligible - Negative Profile'=>'Not Eligible - Negative Profile',
'Not Interested - High ROI'=>'Not Interested - High ROI',
'Not Interested - No Requirement of Loan'=>'Not Interested - No Requirement of Loan',
'Converted to Customer'=>'Converted to Customer',
'Follow up for Referrals'=>'Follow up for Referrals',
'Converted to Customer - For Satisfaction Survey'=>'Converted to Customer - For Satisfaction Survey',
'Not Contactable - Wrong Number'=>'Not Contactable - Wrong Number',
'Not Contactable - Outbound Attempts Over'=>'Not Contactable - Outbound Attempts Over',
);
$GLOBALS['app_list_strings']['disposition_Personal Loans_Opportunity_list']=array (
'' => '',
'Prospect- Investor Ac Activated'=>'Prospect- Investor Ac Activated',
'Hot Prospect- Initial Payment pending/NACH awaited'=>'Hot Prospect- Initial Payment pending/NACH awaited',
'Opportunity - Sent to the Partner'=>'Opportunity - Sent to the Partner',
        //New Personal loan dispositions 29-8-18 start
    'Opportunity - Not Contactable' => 'Opportunity - Not Contactable',
    'Opportunity - Cibil Reject' => 'Opportunity - Cibil Reject',
    'Opportunity - Over Leveraged' => 'Opportunity - Over Leveraged',
    'Opportunity - Not Interested' => 'Opportunity - Not Interested',
    'Opportunity - Income Norms' => 'Opportunity - Income Norms',
    'Opportunity - Company Norms' => 'Opportunity - Company Norms',
    'Opportunity - Document Issue' => 'Opportunity - Document Issue',
    'Opportunity - Others' => 'Opportunity - Others',
    'Opportunity - Login' => 'Opportunity - Login',
    //New Personal loan dispositions 29-8-18 end  
'Not Interested - In our Product/Services'=>'Not Interested - In our Product/Services',
'Not Interested - Financial Issues'=>'Not Interested - Financial Issues',
'Not Interested - Lost to Competition'=>'Not Interested - Lost to Competition',
'Not Interested - Reason Unknown'=>'Not Interested - Reason Unknown',
'Not Eligible - Document Issue'=>'Not Eligible - Document Issue',
'Not Eligible - Income Norms'=>'Not Eligible - Income Norms',
'Not Eligible - Company Norms'=>'Not Eligible - Company Norms',
'Not Eligible - Age Norms'=>'Not Eligible - Age Norms',
'Not Eligible - CIBIL Norms'=>'Not Eligible - CIBIL Norms',
'Not Eligible - Others'=>'Not Eligible - Others',
'Non Service Location'=>'Non Service Location',
'Language Barrier'=>'Language Barrier',
'Converted to Customer'=>'Converted to Customer',
'Follow up for Referrals'=>'Follow up for Referrals',
'Converted to Customer - For Satisfaction Survey'=>'Converted to Customer - For Satisfaction Survey',
'Not Contactable - Wrong Number'=>'Not Contactable - Wrong Number',
'Not Contactable - Outbound Attempts Over'=>'Not Contactable - Outbound Attempts Over',
'Not Eligible - Salary credit in Cash/Cheque'=>'Not Eligible - Salary credit in Cash/Cheque',
'Not Eligible - ITR Norms'=>'Not Eligible - ITR Norms',
'Not Eligible - Job Stability'=>'Not Eligible - Job Stability',
'Not Eligible - EMI Bounce'=>'Not Eligible - EMI Bounce',
'Not Eligible - Foir Norms'=>'Not Eligible - Foir Norms',
'Not Eligible - Non Salaried Profile'=>'Not Eligible - Non Salaried Profile',
'Not Eligible - Residence Stability'=>'Not Eligible - Residence Stability',
'Not Eligible - Higher Loan Amount'=>'Not Eligible - Higher Loan Amount',
'Not Eligible - Negative Profile'=>'Not Eligible - Negative Profile',
'Not Interested - High ROI'=>'Not Interested - High ROI',
'Not Interested - No Requirement of Loan'=>'Not Interested - No Requirement of Loan',

);
$GLOBALS['app_list_strings']['disposition_Personal Loans_Disqualified_Lead_list']=array (
'' => '',
'Not Interested - In our Product/Services'=>'Not Interested - In our Product/Services',
'Not Interested - Financial Issues'=>'Not Interested - Financial Issues',
'Not Interested - Lost to Competition'=>'Not Interested - Lost to Competition',
'Not Interested - Reason Unknown'=>'Not Interested - Reason Unknown',
'Not Eligible - Document Issue'=>'Not Eligible - Document Issue',
'Not Eligible - Income Norms'=>'Not Eligible - Income Norms',
'Not Eligible - Company Norms'=>'Not Eligible - Company Norms',
'Not Eligible - Age Norms'=>'Not Eligible - Age Norms',
'Not Eligible - CIBIL Norms'=>'Not Eligible - CIBIL Norms',
'Not Eligible - Others'=>'Not Eligible - Others',
'Non Service Location'=>'Non Service Location',
'Not Contactable - Wrong Number'=>'Not Contactable - Wrong Number',
'Not Contactable - Outbound Attempts Over'=>'Not Contactable - Outbound Attempts Over',
'Not Eligible - Salary credit in Cash/Cheque'=>'Not Eligible - Salary credit in Cash/Cheque',
'Not Eligible - ITR Norms'=>'Not Eligible - ITR Norms',
'Not Eligible - Job Stability '=>'Not Eligible - Job Stability ',
'Not Eligible - EMI Bounce'=>'Not Eligible - EMI Bounce',
'Not Eligible - Foir Norms'=>'Not Eligible - Foir Norms',
'Not Eligible - Non Salaried Profile'=>'Not Eligible - Non Salaried Profile',
'Not Eligible - Residence Stability'=>'Not Eligible - Residence Stability',
'Not Eligible - Higher Loan Amount'=>'Not Eligible - Higher Loan Amount',
'Not Eligible - Negative Profile'=>'Not Eligible - Negative Profile',
'Not Interested - High ROI'=>'Not Interested - High ROI',
'Not Interested - No Requirement of Loan'=>'Not Interested - No Requirement of Loan',
'Language Barrier'=>'Language Barrier',
'Converted to Customer'=>'Converted to Customer',
'Follow up for Referrals'=>'Follow up for Referrals',
'Converted to Customer - For Satisfaction Survey'=>'Converted to Customer - For Satisfaction Survey',
      //New Personal loan dispositions 29-8-18 start
    'Opportunity - Not Contactable' => 'Opportunity - Not Contactable',
    'Opportunity - Cibil Reject' => 'Opportunity - Cibil Reject',
    'Opportunity - Over Leveraged' => 'Opportunity - Over Leveraged',
    'Opportunity - Not Interested' => 'Opportunity - Not Interested',
    'Opportunity - Income Norms' => 'Opportunity - Income Norms',
    'Opportunity - Company Norms' => 'Opportunity - Company Norms',
    'Opportunity - Document Issue' => 'Opportunity - Document Issue',
    'Opportunity - Others' => 'Opportunity - Others',
    'Opportunity - Login' => 'Opportunity - Login',
    //New Personal loan dispositions 29-8-18 end   
);
$GLOBALS['app_list_strings']['disposition_Personal Loans_Customer_list']=array (
'' => '',
'Converted to Customer'=>'Converted to Customer',
'Follow up for Referrals'=>'Follow up for Referrals',
'Converted to Customer - For Satisfaction Survey'=>'Converted to Customer - For Satisfaction Survey',

);
$GLOBALS['app_list_strings']['disposition_Personal Loans_Not_Contactable_list']=array (
'' => '',
'Not Contactable - Wrong Number'=>'Not Contactable - Wrong Number',
'Not Contactable - Outbound Attempts Over'=>'Not Contactable - Outbound Attempts Over',
);
$GLOBALS['app_list_strings']['disposition_Interested_Customer_list']=array (
  '' => '',
'Customer interested in our products'=>'Customer interested in our products',
'Prospect- Investor Ac Activated'=>'Prospect- Investor Ac Activated',
'Hot Prospect- Initial Payment pending/NACH awaited'=>'Hot Prospect- Initial Payment pending/NACH awaited',
'Converted to Customer'=>'Converted to Customer',
'Callback/Follow up'=>'Callback/Follow up',
'Not Contactable - Ringing'=>'Not Contactable - Ringing',
'Not Contactable - Busy'=>'Not Contactable - Busy',
'Not Contactable - Not Reachable/Temp Suspended'=>'Not Contactable - Not Reachable/Temp Suspended',
'Not Contactable - Wrong Number'=>'Not Contactable - Wrong Number',
'Not Contactable - Switched off'=>'Not Contactable - Switched off',
'Not Interested - In our Product/Services'=>'Not Interested - In our Product/Services',
'Not Interested - Financial Issues'=>'Not Interested - Financial Issues',
'Not Interested - Lost to Competition'=>'Not Interested - Lost to Competition',
'Not Interested - Reason Unknown'=>'Not Interested - Reason Unknown',
'Not Eligible - Document Issue'=>'Not Eligible - Document Issue',
'Not Eligible - Income Norms'=>'Not Eligible - Income Norms',
'Not Eligible - Company Norms'=>'Not Eligible - Company Norms',
'Not Eligible - Age Norms'=>'Not Eligible - Age Norms',
'Not Eligible - CIBIL Norms'=>'Not Eligible - CIBIL Norms',
'Not Eligible - Others'=>'Not Eligible - Others',
'Non Service Location'=>'Non Service Location',
'Not Contactable - Outbound Attempts Over'=>'Not Contactable - Outbound Attempts Over',
);
$GLOBALS['app_list_strings']['disposition_Opportunity_list']=array (
  '' => '',
  'Prospect- Investor Ac Activated'=>'Prospect- Investor Ac Activated',
  'Hot Prospect- Initial Payment pending/NACH awaited'=>'Hot Prospect- Initial Payment pending/NACH awaited',
  'Converted to Customer'=>'Converted to Customer',
'Callback/Follow up'=>'Callback/Follow up',
'Not Contactable - Ringing'=>'Not Contactable - Ringing',
'Not Contactable - Busy'=>'Not Contactable - Busy',
'Not Contactable - Not Reachable/Temp Suspended'=>'Not Contactable - Not Reachable/Temp Suspended',
'Not Contactable - Wrong Number'=>'Not Contactable - Wrong Number',
'Not Contactable - Switched off'=>'Not Contactable - Switched off',
'Not Interested - In our Product/Services'=>'Not Interested - In our Product/Services',
'Not Interested - Financial Issues'=>'Not Interested - Financial Issues',
'Not Interested - Lost to Competition'=>'Not Interested - Lost to Competition',
'Not Interested - Reason Unknown'=>'Not Interested - Reason Unknown',
'Not Eligible - Document Issue'=>'Not Eligible - Document Issue',
'Not Eligible - Income Norms'=>'Not Eligible - Income Norms',
'Not Eligible - Company Norms'=>'Not Eligible - Company Norms',
'Not Eligible - Age Norms'=>'Not Eligible - Age Norms',
'Not Eligible - CIBIL Norms'=>'Not Eligible - CIBIL Norms',
'Not Eligible - Others'=>'Not Eligible - Others',
'Non Service Location'=>'Non Service Location',
'Not Contactable - Outbound Attempts Over'=>'Not Contactable - Outbound Attempts Over',
);
$GLOBALS['app_list_strings']['disposition_Not_Contactable_list']=array (
  '' => '',
    'Callback/Follow up' => 'Callback/Follow up',
  'Not Contactable - Wrong Number' => 'Not Contactable - Wrong Number',
  'Not Contactable - Outbound Attempts Over' => 'Not Contactable - Outbound Attempts Over',
);
$GLOBALS['app_list_strings']['disposition_Customer_list']=array (
  '' => '',
  'Converted to Customer' => 'Converted to Customer',
); 
$GLOBALS['app_list_strings']['classification_account_list']=array (
  '' => '',
);
$GLOBALS['app_list_strings']['educational_details_list']=array (
  '' => '',
  'CA/CS/ICWA' => 'CA/CS/ICWA',
'M.A' => 'M.A',
'M.Arch' => 'M.Arch',
'M.Com' => 'M.Com',
'M.Sc/ M.S' => 'M.Sc/ M.S',
'M.Tech' => 'M.Tech',
'PG Diploma' => 'PG Diploma',
'MBA/ PGDBM' => 'MBA/ PGDBM',
'MCA' => 'MCA',
'MCM' => 'MCM',
'Medical- MS/MD' => 'Medical- MS/MD',
'MCM' => 'MCM',
'LLM' => 'LLM',
'PG-Others' => 'PG-Others',
'B.A' => 'B.A',
'B.Arch' => 'B.Arch',
'B.Des.' => 'B.Des.',
'B.El.Ed' => 'B.El.Ed',
'B.P.Ed' => 'B.P.Ed',
'B.U.M.S' => 'B.U.M.S',
'BAMS' => 'BAMS',
'BCA' => 'BCA',
'B.B.A/B.M.S' => 'B.B.A/B.M.S',
'B.Com' => 'B.Com',
'B.Ed' => 'B.Ed',
'BDS' => 'BDS',
'BFA' => 'BFA',
'BHM' => 'BHM',
'B.Pharma' => 'B.Pharma',
'B.Sc' => 'B.Sc',
'B.Tech/B.E.' => 'B.Tech/B.E.',
'BHMS' => 'BHMS',
'LLB' => 'LLB',
'MBBS' => 'MBBS',
'Diploma' => 'Diploma',
'BVSC' => 'BVSC',
'Undergraduate' => 'Undergraduate',
'Others' => 'Others',
);
$GLOBALS['app_list_strings']['product_sub_type_Loans_list']=array (
'' => '',
'Home Loan' => 'Home Loan',
'Personal Loan' => 'Personal Loan',
'Education Loan' => 'Education Loan',
);
$GLOBALS['app_list_strings']['product_sub_type_Insurance_list']=array (
'' => '',
'Term Insurance' => 'Term Insurance',
'Health Insurance' => 'Health Insurance',
'Motor Insurance' => 'Motor Insurance',
'Personal Accident' => 'Personal Accident',
'Health Insurance- Individual' => 'Health Insurance- Individual',
'Health Insurance- Family ' => 'Health Insurance- Family ',
'Travel Insurance- Single Trip' => 'Travel Insurance- Single Trip',
'Travel Insurance- Business Multi Trip' => 'Travel Insurance- Business Multi Trip',
'Motor Vehicle Insurance' => 'Motor Vehicle Insurance',
'Two Wheeler Insurance' => 'Two Wheeler Insurance',
'House Insurance' => 'House Insurance',
'Retirement Policy' => 'Retirement Policy',
'Endowment Policy' => 'Endowment Policy',
'Child Plan' => 'Child Plan',
'ULIP' => 'ULIP',
);
$GLOBALS['app_list_strings']['product_sub_type_Fixed_Deposits_list']=array (
'' => '',
'Fixed Deposits' => 'Fixed Deposits',
'Dewan Housing Finance Limited' => 'Dewan Housing Finance Limited',
'Mahindra and Mahindra Finance Service Ltd' => 'Mahindra and Mahindra Finance Service Ltd',
'Shriram Transport Finance Company Ltd' => 'Shriram Transport Finance Company Ltd',
);
$GLOBALS['app_list_strings']['product_sub_type_Gold_list']=array (
'' => '',
'Gold' => 'Gold',
'Gold SIP' => 'Gold SIP',
'Gold Coin' => 'Gold Coin',
);
$GLOBALS['app_list_strings']['product_sub_type_Credit_Card_list']=array (
'' => '',
'Credit Card' => 'Credit Card',
'American Express' => 'American Express',
);
$GLOBALS['app_list_strings']['investment_behaviour_segment_list']=array (
  '' => '',
  'First Time Customer' => 'First Time Customer',
'Buying through Offline Mode' => 'Buying through Offline Mode',
'Buying through Competitor Platform' => 'Buying through Competitor Platform',
);
$GLOBALS['app_list_strings']['occupational_details_list']=array (
  '' => '',
  'Self Employed' => 'Self Employed',
'Business Professional' => 'Business Professional',
'Salaried Professional' => 'Salaried Professional',
'Government Employee' => 'Government Employee',
'Home Maker' => 'Home Maker',
'Student' => 'Student',
);
$GLOBALS['app_list_strings']['total_employment_years_list']=array (
  '' => '',
);
$GLOBALS['app_list_strings']['financial_goals_list']=array (
  '' => '',
  'Retirement Planning' => 'Retirement Planning',
'Wealth Creation' => 'Wealth Creation',
'Child Education' => 'Child Education',
'Child marriage' => 'Child marriage',
'Buying a House' => 'Buying a House',
'Buying a second House' => 'Buying a second House',
'Higher Education' => 'Higher Education',
'Self Marriage' => 'Self Marriage',
'Buying a Car' => 'Buying a Car',
'Holiday Planning' => 'Holiday Planning',
'Buying Jewellery' => 'Buying Jewellery',
'Business' => 'Business',
);
$GLOBALS['app_list_strings']['exisiting_investments_0']=array (
  '' => '',
);
$GLOBALS['app_list_strings']['tax_planning_list']=array (
  '' => '',
  'Yes' => 'Yes',
  'No' => 'No',
);
$GLOBALS['app_list_strings']['family_members_numbers_list']=array (
  '' => '',
  1 => '1',
  2 => '2',
  3 => '3',
  4 => '4',
  5 => '5',
  6 => '6',
  7 => '7',
  8 => '8',
  9 => '9',
  10 => '10',
);
$GLOBALS['app_list_strings']['structure_of_family_list']=array (
  '' => '',
  'Adults' => 'Adults',
  'Children' => 'Children',
);

$GLOBALS['app_list_strings']['sales_stage_list']=array (
'User' => 'User',
'Interested_Customer' => 'Interested Customer',
'Opportunity' => 'Opportunity',
'Disqualified_Lead' => 'Disqualified Lead',
'Customer' => 'Customer',
'Not_Contactable' => 'Not Contactable',
);

$GLOBALS['app_list_strings']['disposition_Disqualified_Lead_list']=array (
  '' =>'',
'Not Interested - In our Product/Services'=>'Not Interested - In our Product/Services',
'Not Interested - Financial Issues'=>'Not Interested - Financial Issues',
'Not Interested - Lost to Competition'=>'Not Interested - Lost to Competition',
'Not Interested - Reason Unknown'=>'Not Interested - Reason Unknown',
'Not Eligible - Document Issue'=>'Not Eligible - Document Issue',
'Not Eligible - Income Norms'=>'Not Eligible - Income Norms',
'Not Eligible - Company Norms'=>'Not Eligible - Company Norms',
'Not Eligible - Age Norms'=>'Not Eligible - Age Norms',
'Not Eligible - CIBIL Norms'=>'Not Eligible - CIBIL Norms',
'Not Eligible - Others'=>'Not Eligible - Others',
'Non Service Location'=>'Non Service Location',
'Customer interested in our products'=>'Customer interested in our products',
'Prospect- Investor Ac Activated'=>'Prospect- Investor Ac Activated',
'Hot Prospect- Initial Payment pending/NACH awaited'=>'Hot Prospect- Initial Payment pending/NACH awaited',
'Converted to Customer'=>'Converted to Customer',
'Callback/Follow up'=>'Callback/Follow up',
'Not Contactable - Ringing'=>'Not Contactable - Ringing',
'Not Contactable - Busy'=>'Not Contactable - Busy',
'Not Contactable - Not Reachable/Temp Suspended'=>'Not Contactable - Not Reachable/Temp Suspended',
'Not Contactable - Wrong Number'=>'Not Contactable - Wrong Number',
'Not Contactable - Switched off'=>'Not Contactable - Switched off',
'Not Interested - In our Product/Services'=>'Not Interested - In our Product/Services',
);


$GLOBALS['app_list_strings']['sales_stage__Moves_to_Customer_list']=array (
'Converted to Customer' => 'Converted to Customer',
);
$GLOBALS['app_list_strings']['sales_stage__moves_to_Interested_list']=array (
'Customer interested in our products' => 'Customer interested in our products',
);
$GLOBALS['app_list_strings']['sales_stage__moves_to_Opportunity_list']=array (
'Prospect- Investor Ac Activated' => 'Prospect- Investor Ac Activated',
'Hot Prospect- Initial Payment pending/NACH awaited' => 'Hot Prospect- Initial Payment pending/NACH awaited',
);
$GLOBALS['app_list_strings']['sales_stage__moves_to_Not_Contactable_list']=array (
'Not Contactable - Wrong Number' => 'Not Contactable - Wrong Number',
'Not Contactable - Outbound Attempts Over' => 'Not Contactable - Outbound Attempts Over',
);
$GLOBALS['app_list_strings']['sales_stage__moves_to_Disqualified_list']=array (
'Not Interested - In our Product/Services'=>'Not Interested - In our Product/Services',
'Not Interested - Financial Issues'=>'Not Interested - Financial Issues',
'Not Interested - Lost to Competition'=>'Not Interested - Lost to Competition',
'Not Interested - Reason Unknown'=>'Not Interested - Reason Unknown',
'Not Eligible - Document Issue'=>'Not Eligible - Document Issue',
'Not Eligible - Income Norms'=>'Not Eligible - Income Norms',
'Not Eligible - Company Norms'=>'Not Eligible - Company Norms',
'Not Eligible - Age Norms'=>'Not Eligible - Age Norms',
'Not Eligible - CIBIL Norms'=>'Not Eligible - CIBIL Norms',
'Not Eligible - Others'=>'Not Eligible - Others',
'Non Service Location'=>'Non Service Location',
);

$GLOBALS['app_list_strings']['PL_sales_stage__Moves_to_Customer_list']=array (
'Converted to Customer'=>'Converted to Customer',
'Follow up for Referrals'=>'Follow up for Referrals',
'Converted to Customer - For Satisfaction Survey'=>'Converted to Customer - For Satisfaction Survey',
);

$GLOBALS['app_list_strings']['PL_sales_stage__moves_to_Opportunity_list']=array (
'Prospect- Investor Ac Activated'=>'Prospect- Investor Ac Activated',
'Hot Prospect- Initial Payment pending/NACH awaited'=>'Hot Prospect- Initial Payment pending/NACH awaited',
'Opportunity - Sent to the Partner'=>'Opportunity - Sent to the Partner',
      'Opportunity - Login'=>'Opportunity - Login',
);

$GLOBALS['app_list_strings']['PL_sales_stage__moves_to_Not_Contactable_list']=array (
'Not Contactable - Wrong Number'=>'Not Contactable - Wrong Number',
'Not Contactable - Outbound Attempts Over'=>'Not Contactable - Outbound Attempts Over',
);
$GLOBALS['app_list_strings']['PL_sales_stage__moves_to_Disqualified_list']=array (
'Not Interested - In our Product/Services'=>'Not Interested - In our Product/Services',
'Not Interested - Financial Issues'=>'Not Interested - Financial Issues',
'Not Interested - Lost to Competition'=>'Not Interested - Lost to Competition',
'Not Interested - Reason Unknown'=>'Not Interested - Reason Unknown',
'Not Eligible - Document Issue'=>'Not Eligible - Document Issue',
'Not Eligible - Income Norms'=>'Not Eligible - Income Norms',
'Not Eligible - Company Norms'=>'Not Eligible - Company Norms',
'Not Eligible - Age Norms'=>'Not Eligible - Age Norms',
'Not Eligible - CIBIL Norms'=>'Not Eligible - CIBIL Norms',
'Not Eligible - Others'=>'Not Eligible - Others',
'Non Service Location'=>'Non Service Location',
'Language Barrier'=>'Language Barrier',
'Not Eligible - Salary credit in Cash/Cheque'=>'Not Eligible - Salary credit in Cash/Cheque',
'Not Eligible - ITR Norms'=>'Not Eligible - ITR Norms',
'Not Eligible - Job Stability '=>'Not Eligible - Job Stability ',
'Not Eligible - EMI Bounce'=>'Not Eligible - EMI Bounce',
'Not Eligible - Foir Norms'=>'Not Eligible - Foir Norms',
'Not Eligible - Non Salaried Profile'=>'Not Eligible - Non Salaried Profile',
'Not Eligible - Residence Stability'=>'Not Eligible - Residence Stability',
'Not Eligible - Higher Loan Amount'=>'Not Eligible - Higher Loan Amount',
'Not Eligible - Negative Profile'=>'Not Eligible - Negative Profile',
'Not Interested - High ROI'=>'Not Interested - High ROI',
'Not Interested - No Requirement of Loan'=>'Not Interested - No Requirement of Loan',
     //New Personal loan dispositions 29-8-18 start
    'Opportunity - Not Contactable' => 'Opportunity - Not Contactable',
    'Opportunity - Cibil Reject' => 'Opportunity - Cibil Reject',
    'Opportunity - Over Leveraged' => 'Opportunity - Over Leveraged',
    'Opportunity - Not Interested' => 'Opportunity - Not Interested',
    'Opportunity - Income Norms' => 'Opportunity - Income Norms',
    'Opportunity - Company Norms' => 'Opportunity - Company Norms',
    'Opportunity - Document Issue' => 'Opportunity - Document Issue',
    'Opportunity - Others' => 'Opportunity - Others',
        //New Personal loan dispositions 29-8-18 end 
);
$GLOBALS['app_list_strings']['next_call_planning_comment_list']=array (
  0 => 'Customer interested in our products',
  1 => 'Prospect- Investor Ac Activated',
  2 => 'Hot Prospect- Initial Payment pending/NACH awaited',
  3 => 'Callback/Follow up',
  4 => 'Not Contactable - Ringing',
  5 => 'Not Contactable - Busy',
  6 => 'Not Contactable - Not Reachable/Temp Suspended',
  7 => 'Not Contactable - Switched off',
  8=>'Opportunity - Sent to the Partner',
  9=>'Follow up for Referrals',
  10 => 'Converted to Customer',          //For displaying next planning date to converted to customer disposition
    //New Personal loan dispositions 29-8-18 start
    11 => 'Opportunity - Login',
    //New Personal loan dispositions 29-8-18 end 
 );


$GLOBALS['app_list_strings']['cstm_lead_source_list'] = array (
'' => '',
'Digital Marketing' => 'Digital Marketing',
'M. P Online / CSC (E-Governance websites)' => 'M. P Online / CSC (E-Governance websites)',
'Corporate clients' => 'Corporate clients',
'Offline marketing' => 'Offline marketing',
'Affiliate marketing' => 'Affiliate marketing',
'Web forms in e-mail' => 'Web forms in e-mail',
'Lead forms on the website' => 'Lead forms on the website',
'Chat tool or website intelligence tool' => 'Chat tool or website intelligence tool',
'Site visitors browsing through Insurance quotes ' => 'Site visitors browsing through Insurance quotes ',
'Manual lead creation from Call back or Inbound sources' => 'Manual lead creation from Call back or Inbound sources',
'Referral lead creation' => 'Referral lead creation',
'Manual upload' => 'Manual upload',
);

$GLOBALS['app_list_strings']['primary_address_city_list']=array (
  '' => '',
);

$GLOBALS['app_list_strings']['country_c_list']=array (
  91 => 'India',
);

$postal_code = array(''=>'',);
$db = DBManagerFactory::getInstance(); 
$result=$db->query("select id, name from pincode");
while($row=$db->fetchRow($result)){$postal_code[$row['id']] = $row['name'];}
$GLOBALS['app_list_strings']['postalcode_list']=$postal_code;

$GLOBALS['app_list_strings']['classification_accoun_c_list']=array (
  '' => '',
  'Self' => 'Self',
  'Mother' => 'Mother',
  'Father' => 'Father',
  'Son' => 'Son',
  'Wife' => 'Wife',
  'Daughter' => 'Daughter',
  'Sister' => 'Sister',
  'Brother' => 'Brother',
  'Husband' => 'Husband',
);
$GLOBALS['app_list_strings']['no_of_adults_list']=array (
  '' => '',
  1 => '1',
  2 => '2',
  3 => '3',
  4 => '4',
  5 => '5',
  6 => '6',
  7 => '7',
  8 => '8',
  9 => '9',
  10 => '10',
);
$GLOBALS['app_list_strings']['payment_type_list']=array (
  'Mutual Funds_Lumpsum'=>'Lumpsum Investments',
'Mutual Funds_SIP'=>'SIP Investment',
'Mutual Funds_Lumpsum SIP'=>'Combination of Lumpsum and SIP Investment',
'Insurance_Monthly'=>'Monthly premium',
'Insurance_Quaterly'=>'Quaterly premium',
'Insurance_Halfyearly'=>'Half yearly premium',
'Insurance_Annual'=>'Annual premium',
'Equity_IP'=>'Investment Portfolio',
'Equity_Trading'=>'Trading',
'Gold_Lumpsum'=>'Lumpsum Investments',
'Gold_SIP'=>'SIP Investment',
'Gold_ETF'=>'Gold ETF',
'Gold_Coins'=>'Gold Coins',
'Fixed Deposits_Lumpsum'=>'Lumpsum',

);
$GLOBALS['app_list_strings']['life_stage_profiling_list']=array (
  '' => '',
  'Single_and_Unemployed' => 'Single and Unemployed',
  'Single_and_Employed' => 'Single and Employed',
  'Single_employed_with_dependant_parents' => 'Single, Employed with dependant Parents',
  'Married_without_children' => 'Married without Children',
  'Married_with_1_child' => 'Married with 1 Child',
  'Married_with_2_children' => 'Married with 2 Children',
  'Married_with_3_children' => 'Married with 3 Children',
  'Married_with_children_and_dependant_parents' => 'Married with Children and dependant Parents',
);

$GLOBALS['app_list_strings']['online_activity_status_list']=array (
  '' => '',
  'Active' => 'Active',
  'Inactive' => 'Inactive',
);
$GLOBALS['app_list_strings']['total_employment_years_c_list']=array (
  '' => '',
  0 => '0',
  1 => '1',
  2 => '2',
  3 => '3',
  4 => '4',
  5 => '5',
  6 => '6',
  7 => '7',
  8 => '8',
  9 => '9',
  10 => '10',
  11 => '11',
  12 => '12',
  13 => '13',
  14 => '14',
  15 => '15',
  16 => '16',
  17 => '17',
  18 => '18',
  19 => '19',
  20 => '20',
  21 => '21',
  22 => '22',
  23 => '23',
  24 => '24',
  25 => '25',
  26 => '26',
  27 => '27',
  28 => '28',
  29 => '29',
  30 => '30',
  '30_Plus' => '30+',
);
$app_list_strings['moduleList']['Cases']='Tickets';
$app_list_strings['moduleListSingular']['Cases']='Ticket';
$app_list_strings['record_type_display']['Cases']='Ticket';
$app_list_strings['parent_type_display']['Cases']='Ticket';
$app_list_strings['record_type_display_notes']['Cases']='Ticket';
$GLOBALS['app_list_strings']['departments_c_list']=array (
   '' => '',
  'Operations Team' => 'Operations Team',	
   'Sales Team' => 'Sales Team',
	'Product Team' => 'Product Team',
	'Technology Team' => 'Technology Team',	
	'Marketing Team' => 'Marketing Team',	
	'General Advisory Team' => 'General Advisory Team',	
	'Legal Team' => 'Legal Team',
	'Customer Support Team' => 'Customer Support Team'
);
$GLOBALS['app_list_strings']['module_list']=array (
   '' => '',
  'Home Page' => 'Home Page',
  'Dashboard' => 'Dashboard',
  'Profile' => 'Profile',
  'Document upload' => 'Document upload',
  'My Money' => 'My Money',
  'My Investments' => 'My Investments',
  'My Goals' => 'My Goals',
  'Reports' => 'Reports',
  'Buy Products- Mutual funds' => 'Buy Products- Mutual funds',
  'Buy Products- Corporate Fixed Deposits' => 'Buy Products- Corporate Fixed Deposits',
  'Buy Products- Gold' => 'Buy Products- Gold',
  'Debentures' => 'Debentures',
  'Buy Products-Equity' => 'Buy Products-Equity',
  'PO- Lumpsum Investment' => 'PO- Lumpsum Investment',
  'PO-Retirement Planning' => 'PO-Retirement Planning',
  'Buy Poducts-Loans' => 'Buy Poducts-Loans',
  'PO- Tax Planning' => 'PO- Tax Planning',
  'PO-SIP' => 'PO-SIP',
  'PO- Tax Filing' => 'PO- Tax Filing',
  'Generic' => 'Generic',
  'Insurance' => 'Insurance',
);
$GLOBALS['app_list_strings']['query_type_list']=array (
   '' => '',
  'Complain' => 'Complain',
  'Query' => 'Query',
  'Request' => 'Request',
);
$GLOBALS['app_list_strings']['registrar_c_list']=array (
  '' => '',
'Cams'=>'Cams',
'Karvy'=>'Karvy',
'Franklin Templeton'=>'Franklin Templeton',
'Sundaram'=>'Sundaram',
'Bullion India'=>'Bullion India',
'Mahindra & Mahindra Finance Services Ltd'=>'Mahindra & Mahindra Finance Services Ltd',
'Dewan Housing Finance Ltd'=>'Dewan Housing Finance Ltd',
'Shriram Transport Finance Company Ltd'=>'Shriram Transport Finance Company Ltd',
'DHFL'=>'DHFL',
'Fullerton Personal Loan'=>'Fullerton Personal Loan',
'Religare Health Insurance'=>'Religare Health Insurance',
'HDFC Life'=>'HDFC Life'
);
$GLOBALS['app_list_strings']['sub_module_list']=array (
  '' => '',
  'Password Reset link' => 'Password Reset link',
'Not able to access PO on the home page' => 'Not able to access PO on the home page',
'APP not downloading on Android' => 'APP not downloading on Android',
'APP not downloading on iOS' => 'APP not downloading on iOS',
'Facebook Page' => 'Facebook Page',
'Twitter Page' => 'Twitter Page',
'FAQ' => 'FAQ',
'More queries on FAQ to be defined' => 'More queries on FAQ to be defined',
'More queries on FAQ to be defined' => 'More queries on FAQ to be defined',
'More queries on FAQ to be defined' => 'More queries on FAQ to be defined',
'Not receipt of response from customer support ID' => 'Not receipt of response from customer support ID',
'Issue in Valuation' => 'Issue in Valuation',
'Issue in Goal completion percentage' => 'Issue in Goal completion percentage',
'Issues with Networth calculation' => 'Issues with Networth calculation',
'Issues with My Orders' => 'Issues with My Orders',
'Personal Details - Change in Name' => 'Personal Details - Change in Name',
'Personal Details - Change in Email ID' => 'Personal Details - Change in Email ID',
'Personal Details - Change in Contact number' => 'Personal Details - Change in Contact number',
'Personal Details- Issue with Profile completion percentage' => 'Personal Details- Issue with Profile completion percentage',
'Personal Details- Not able to upload photograph' => 'Personal Details- Not able to upload photograph',
'Address- Incorrect address captured' => 'Address- Incorrect address captured',
'Address-change in address' => 'Address-change in address',
'Bank Account- Not able to add new bank account' => 'Bank Account- Not able to add new bank account',
'Bank Account- Incorrect account number captured' => 'Bank Account- Incorrect account number captured',
'Bank Account- Incorrect IFSC code captured' => 'Bank Account- Incorrect IFSC code captured',
'Bank Account- Auto Sync not working' => 'Bank Account- Auto Sync not working',
'Bank Account- Set Up Mandate' => 'Bank Account- Set Up Mandate',
'Bank Account- NACH form' => 'Bank Account- NACH form',
'Nomination- Modification in exisiting nominee' => 'Nomination- Modification in exisiting nominee',
'Nomination- Addition of new nominee' => 'Nomination- Addition of new nominee',
'Risk Profiling- Understanding risk profiling' => 'Risk Profiling- Understanding risk profiling',
'Risk Profiling- Wants to cancel existing risk profiling' => 'Risk Profiling- Wants to cancel existing risk profiling',
'PAN No. verification ' => 'PAN No. verification ',
'Income details' => 'Income details',
'Tax Residency outside India' => 'Tax Residency outside India',
'Download of Apl form & KYC form' => 'Download of Apl form & KYC form',
'Upload of Documents' => 'Upload of Documents',
'Courier of documents' => 'Courier of documents',
'POA and POI for account opening and KYC form' => 'POA and POI for account opening and KYC form',
'Wants to know about Master budget' => 'Wants to know about Master budget',
'Wants to know about budget categories' => 'Wants to know about budget categories',
'Wants to know about adding income catgories' => 'Wants to know about adding income catgories',
'Wants to know about adding expense categories' => 'Wants to know about adding expense categories',
'Wants to know about inter bank transfer' => 'Wants to know about inter bank transfer',
'Wants to know about wallets' => 'Wants to know about wallets',
'Wants to know about bank account synchronization' => 'Wants to know about bank account synchronization',
'Wants to know about planned Vs actual budget' => 'Wants to know about planned Vs actual budget',
'Not able to set master budget' => 'Not able to set master budget',
'Not able to add income categories' => 'Not able to add income categories',
'Not able to add expense categories' => 'Not able to add expense categories',
'Not able to edit wallets' => 'Not able to edit wallets',
'Not able to synchronize bank account' => 'Not able to synchronize bank account',
'Not able to add actual expenses' => 'Not able to add actual expenses',
'Not able to add actual income' => 'Not able to add actual income',
'Error in calculating budgets' => 'Error in calculating budgets',
'Error in Saving potential' => 'Error in Saving potential',
'Error in planned Vs actual budget' => 'Error in planned Vs actual budget',
'Wants to understand about Networth Calculation' => 'Wants to understand about Networth Calculation',
'Wants to add new assets to Portfolio' => 'Wants to add new assets to Portfolio',
'Wants to edit  assets in Portfolio' => 'Wants to edit  assets in Portfolio',
'Wants to add new liabilities to Portfolio' => 'Wants to add new liabilities to Portfolio',
'Wants to edit liabilities' => 'Wants to edit liabilities',
'Wants to add new Insurance Policy ' => 'Wants to add new Insurance Policy ',
'Wants to upload transactions in excel format' => 'Wants to upload transactions in excel format',
'Error in calculating Networth' => 'Error in calculating Networth',
'Error in representation of asset value' => 'Error in representation of asset value',
'Error in representation of liability value' => 'Error in representation of liability value',
'Errors in calculating returns' => 'Errors in calculating returns',
'Wants to know about goal planning' => 'Wants to know about goal planning',
'Wants to know about custom goal setting' => 'Wants to know about custom goal setting',
'Wants to understand calculations for monthly, yearly and annual investments required' => 'Wants to understand calculations for monthly, yearly and annual investments required',
'Tagging investments with goals' => 'Tagging investments with goals',
'Wants to understand cash flows' => 'Wants to understand cash flows',
'Not able to plan a goal' => 'Not able to plan a goal',
'Not able to tag exisiting investment with goals' => 'Not able to tag exisiting investment with goals',
'Not able to edit goals' => 'Not able to edit goals',
'Not able to delete goals' => 'Not able to delete goals',
'Not able to adjust goals' => 'Not able to adjust goals',
'Not able to adjust risk profile' => 'Not able to adjust risk profile',
'Wants to understand reports section' => 'Wants to understand reports section',
'Reports not populating' => 'Reports not populating',
'Not able to export reports in PDF format' => 'Not able to export reports in PDF format',
'Not able to export reports in excel format' => 'Not able to export reports in excel format',
'Wants to understand ideal recommended portfolio in Mutual Funds' => 'Wants to understand ideal recommended portfolio in Mutual Funds',
'Wants to invest outside the ideal recommended portfolio in Mutual Funds' => 'Wants to invest outside the ideal recommended portfolio in Mutual Funds',
'Not able to find the fund of choice in the recommended list of Mutual Funds' => 'Not able to find the fund of choice in the recommended list of Mutual Funds',
'Wants to invest lumpsum in Mutual Funds' => 'Wants to invest lumpsum in Mutual Funds',
'Wants to start SIP in Mutual Funds' => 'Wants to start SIP in Mutual Funds',
'Wants to start a new SIP in Mutual Funds' => 'Wants to start a new SIP in Mutual Funds',
'KYC form pickup request' => 'KYC form pickup request',
'Wants to Switch Funds' => 'Wants to Switch Funds',
'Wants to initiate SWP' => 'Wants to initiate SWP',
'Wants to initiate STP' => 'Wants to initiate STP',
'Wants to redeem exisiting investment' => 'Wants to redeem exisiting investment',
'Wants to know the time for allocation of units post purchase' => 'Wants to know the time for allocation of units post purchase',
'Wants to know the time in days for redemption of units' => 'Wants to know the time in days for redemption of units',
'Wants to get a printed statement for Mutual Fund Investments' => 'Wants to get a printed statement for Mutual Fund Investments',
'Delay in Mutual Fund redemption' => 'Delay in Mutual Fund redemption',
'Delay in Mutual Fund refund' => 'Delay in Mutual Fund refund',
'Wants to get an e-statement for Mutual Fund Investments' => 'Wants to get an e-statement for Mutual Fund Investments',
'Wants to set up an NACH mandate' => 'Wants to set up an NACH mandate',
'Wants to set up a new NACH mandate' => 'Wants to set up a new NACH mandate',
'Not able to download NACH mandate form' => 'Not able to download NACH mandate form',
'Courier pickup request for NACH mandate form' => 'Courier pickup request for NACH mandate form',
'Bank name not reflecting in the payment list' => 'Bank name not reflecting in the payment list',
'Not able to edit the cart' => 'Not able to edit the cart',
'Not able to delete the product already exisiting in the cart' => 'Not able to delete the product already exisiting in the cart',
'Investor account not activated despite all documentation' => 'Investor account not activated despite all documentation',
'Delay in activation of Investor account' => 'Delay in activation of Investor account',
'Investor account activation intimation mail not received' => 'Investor account activation intimation mail not received',
'Investor wants to have a discussion with Advisory team' => 'Investor wants to have a discussion with Advisory team',
'Investor wants to understand the methodology for Fund recommendation' => 'Investor wants to understand the methodology for Fund recommendation',
'Investor want a recommendation mail from advisory team' => 'Investor want a recommendation mail from advisory team',
'Amount deducted but confirmation is not received ' => 'Amount deducted but confirmation is not received ',
'Payment failure-Gateway related issues' => 'Payment failure-Gateway related issues',
'Payment failure-Bank related Issues' => 'Payment failure-Bank related Issues',
'Wants to know about corporate Fixed Desposits' => 'Wants to know about corporate Fixed Desposits',
'Wants to understand about the ratings corporate Fixed Deposits' => 'Wants to understand about the ratings corporate Fixed Deposits',
'Wants to understand about the interest rates of Fixed Desposits' => 'Wants to understand about the interest rates of Fixed Desposits',
'Wants to invest in corporate Fixed Deposits' => 'Wants to invest in corporate Fixed Deposits',
'Wants to start a new Fixed Deposit' => 'Wants to start a new Fixed Deposit',
'Want to premature withdraw a Fixed Deposit' => 'Want to premature withdraw a Fixed Deposit',
'Wants to withdraw a Fixed Deposit' => 'Wants to withdraw a Fixed Deposit',
'Wants to start a new investment in Gold' => 'Wants to start a new investment in Gold',
'Wants to do an additional purchase in Gold ' => 'Wants to do an additional purchase in Gold ',
'Wants to redeem exisiting investment in Gold' => 'Wants to redeem exisiting investment in Gold',
'Wants to renew exisiting investment in Gold' => 'Wants to renew exisiting investment in Gold',
'Gold units not allocated in the specified time' => 'Gold units not allocated in the specified time',
'Delay in gold redemption' => 'Delay in gold redemption',
'Delay in renewal of gold scheme' => 'Delay in renewal of gold scheme',
'Want to invest in Bond' => 'Want to invest in Bond',
'units allotment ' => 'units allotment ',
'Premature Withdrawal of funds' => 'Premature Withdrawal of funds',
'To be detailed' => 'To be detailed',
'Non receipt of allotment certificate' => 'Non receipt of allotment certificate',
'Partial allotment' => 'Partial allotment',
'Discrepancy of allotment in MY Invt ' => 'Discrepancy of allotment in MY Invt ',
'Wants to understand the process of Opening Equity trading account' => 'Wants to understand the process of Opening Equity trading account',
'Wants to understand about the equity account opening charges' => 'Wants to understand about the equity account opening charges',
'Wants to understand the brokerage structure' => 'Wants to understand the brokerage structure',
'Equity transaction on 5nance portal' => 'Equity transaction on 5nance portal',
'Call from Sushil Finance for account opening' => 'Call from Sushil Finance for account opening',
'Did not receive account opening form through courier' => 'Did not receive account opening form through courier',
'Delay in opening Equity trading account despite submitting the form and documents' => 'Delay in opening Equity trading account despite submitting the form and documents',
'Equity trading online account details not working' => 'Equity trading online account details not working',
'Equity investment under My Investment' => 'Equity investment under My Investment',
'Discrepany in Equity Valuation ' => 'Discrepany in Equity Valuation ',
'Wants to understand allocation in Lumpsum Investments' => 'Wants to understand allocation in Lumpsum Investments',
'Wants to understand the minimum lumpsum investment in a given fund' => 'Wants to understand the minimum lumpsum investment in a given fund',
'Wants to know about Retirement planning calculator' => 'Wants to know about Retirement planning calculator',
'Wants to understand cash flow in Retirement Calculator' => 'Wants to understand cash flow in Retirement Calculator',
'Wants to link his exisiting Investments in Retirement Calculator' => 'Wants to link his exisiting Investments in Retirement Calculator',
'Wants to apply for a home loan' => 'Wants to apply for a home loan',
'Wants to understand the status of home loan application' => 'Wants to understand the status of home loan application',
'Have not received any call from the Home loan partner ' => 'Have not received any call from the Home loan partner ',
'Wants to apply for a Personal loan' => 'Wants to apply for a Personal loan',
'Wants to understand the status of personal loan application' => 'Wants to understand the status of personal loan application',
'Have not received any call from the personal loan partner ' => 'Have not received any call from the personal loan partner ',
'Wants to apply for an Educational loan' => 'Wants to apply for an Educational loan',
'Wants to understand the status of Educational loan application' => 'Wants to understand the status of Educational loan application',
'Have not received any call from the Educational loan partner ' => 'Have not received any call from the Educational loan partner ',
'Wants to know about Tax planning calculator' => 'Wants to know about Tax planning calculator',
'Wants to have a comprehensive understand about tax calculation' => 'Wants to have a comprehensive understand about tax calculation',
'Wants to understand about tax saving instruments ' => 'Wants to understand about tax saving instruments ',
'Wants to invest in ELSS' => 'Wants to invest in ELSS',
'Not able to find the fund of choice in the recommended list of ELSS' => 'Not able to find the fund of choice in the recommended list of ELSS',
'Wants to buy in Health Insurance' => 'Wants to buy in Health Insurance',
'Wants to know the benefit of Health Insurance plan recommended' => 'Wants to know the benefit of Health Insurance plan recommended',
'Wants to cancel the Health Insurance policy purchased in the free look-up period' => 'Wants to cancel the Health Insurance policy purchased in the free look-up period',
'Wants a refund for the Cancelled Insurance policy' => 'Wants a refund for the Cancelled Insurance policy',
'Wants to understand the status of refund for the cancelled policy' => 'Wants to understand the status of refund for the cancelled policy',
'Procedure of filing the claim' => 'Procedure of filing the claim',
'Wants to file a claim for Healthcare policy' => 'Wants to file a claim for Healthcare policy',
'Wants to know the status of the claim for Healthcare policy' => 'Wants to know the status of the claim for Healthcare policy',
'Wants to know more about SIP calculator' => 'Wants to know more about SIP calculator',
'Wants to start a new SIP in Mutual Funds' => 'Wants to start a new SIP in Mutual Funds',
'Wants to cancel existing SIP' => 'Wants to cancel existing SIP',
'Wants to understand exit load' => 'Wants to understand exit load',
'Want to start a new SIP' => 'Want to start a new SIP',
'Wants to understand the minimum investment amount in a given fund' => 'Wants to understand the minimum investment amount in a given fund',
'Wants to know about e-tax filing process' => 'Wants to know about e-tax filing process',
'Facing problem in uploading form-16' => 'Facing problem in uploading form-16',
'Sales Complaint' => 'Sales Complaint',
'Returns on portfolio' => 'Returns on portfolio',
'Non receipt of policy document' => 'Non receipt of policy document',
'Renewal notification' => 'Renewal notification',
'Renewal policy not received' => 'Renewal policy not received',
'Medical requirement for Insurance' => 'Medical requirement for Insurance',
'Submission of Medical document' => 'Submission of Medical document',
' Underwriting case for policy' => ' Underwriting case for policy',
'Additional document for policy issuancce' => 'Additional document for policy issuancce',
'Portability of policy' => 'Portability of policy',
'PAN No. verification'=>'PAN No. verification',
'Wants to add new Insurance Policy'=>'Wants to add new Insurance Policy',
'Amount deducted but confirmation is not received'=>'Amount deducted but confirmation is not received',
'Wants to do an additional purchase in Gold'=>'Wants to do an additional purchase in Gold',
'units allotment'=>'units allotment',
'Discrepancy of allotment in MY Invt'=>'Discrepancy of allotment in MY Invt',
'Discrepany in Equity Valuation'=>'Discrepany in Equity Valuation',
'Have not received any call from the Home loan partner'=>'Have not received any call from the Home loan partner',
'Have not received any call from the personal loan partner'=>'Have not received any call from the personal loan partner',
'Have not received any call from the Educational loan partner'=>'Have not received any call from the Educational loan partner',
'Wants to understand about tax saving instruments'=>'Wants to understand about tax saving instruments',
'Underwriting case for policy'=>'Underwriting case for policy',
);
$GLOBALS['app_list_strings']['sub_module_Home_Page_list']=array (
  '' => '',
  'Password Reset link' => 'Password Reset link',
'Not able to access PO on the home page' => 'Not able to access PO on the home page',
'APP not downloading on Android' => 'APP not downloading on Android',
'APP not downloading on iOS' => 'APP not downloading on iOS',
'Facebook Page' => 'Facebook Page',
'Twitter Page' => 'Twitter Page',
'FAQ' => 'FAQ',
'More queries on FAQ to be defined' => 'More queries on FAQ to be defined',
'More queries on FAQ to be defined' => 'More queries on FAQ to be defined',
'More queries on FAQ to be defined' => 'More queries on FAQ to be defined',
'Not receipt of response from customer support ID' => 'Not receipt of response from customer support ID',

);
$GLOBALS['app_list_strings']['sub_module_Dashboard_list']=array (
  '' => '',
  'Issue in Valuation' => 'Issue in Valuation',
'Issue in Goal completion percentage' => 'Issue in Goal completion percentage',
'Issues with Networth calculation' => 'Issues with Networth calculation',
'Issues with My Orders' => 'Issues with My Orders',
);
$GLOBALS['app_list_strings']['sub_module_Profile_list']=array (
  '' => '',
  'Personal Details - Change in Name' => 'Personal Details - Change in Name',
'Personal Details - Change in Email ID' => 'Personal Details - Change in Email ID',
'Personal Details - Change in Contact number' => 'Personal Details - Change in Contact number',
'Personal Details- Issue with Profile completion percentage' => 'Personal Details- Issue with Profile completion percentage',
'Personal Details- Not able to upload photograph' => 'Personal Details- Not able to upload photograph',
'Address- Incorrect address captured' => 'Address- Incorrect address captured',
'Address-change in address' => 'Address-change in address',
'Bank Account- Not able to add new bank account' => 'Bank Account- Not able to add new bank account',
'Bank Account- Incorrect account number captured' => 'Bank Account- Incorrect account number captured',
'Bank Account- Incorrect IFSC code captured' => 'Bank Account- Incorrect IFSC code captured',
'Bank Account- Auto Sync not working' => 'Bank Account- Auto Sync not working',
'Bank Account- Set Up Mandate' => 'Bank Account- Set Up Mandate',
'Bank Account- NACH form' => 'Bank Account- NACH form',
'Nomination- Modification in exisiting nominee' => 'Nomination- Modification in exisiting nominee',
'Nomination- Addition of new nominee' => 'Nomination- Addition of new nominee',
'Risk Profiling- Understanding risk profiling' => 'Risk Profiling- Understanding risk profiling',
'Risk Profiling- Wants to cancel existing risk profiling' => 'Risk Profiling- Wants to cancel existing risk profiling',
'PAN No. verification ' => 'PAN No. verification ',
'Income details' => 'Income details',
'Tax Residency outside India' => 'Tax Residency outside India',
);
$GLOBALS['app_list_strings']['sub_module_Document_upload_list']=array (
  '' => '',
  'Download of Apl form & KYC form' => 'Download of Apl form & KYC form',
'Upload of Documents' => 'Upload of Documents',
'Courier of documents' => 'Courier of documents',
'POA and POI for account opening and KYC form' => 'POA and POI for account opening and KYC form',
);
$GLOBALS['app_list_strings']['sub_module_My_Money_list']=array (
  '' => '',
  'Wants to know about Master budget' => 'Wants to know about Master budget',
'Wants to know about budget categories' => 'Wants to know about budget categories',
'Wants to know about adding income catgories' => 'Wants to know about adding income catgories',
'Wants to know about adding expense categories' => 'Wants to know about adding expense categories',
'Wants to know about inter bank transfer' => 'Wants to know about inter bank transfer',
'Wants to know about wallets' => 'Wants to know about wallets',
'Wants to know about bank account synchronization' => 'Wants to know about bank account synchronization',
'Wants to know about planned Vs actual budget' => 'Wants to know about planned Vs actual budget',
'Not able to set master budget' => 'Not able to set master budget',
'Not able to add income categories' => 'Not able to add income categories',
'Not able to add expense categories' => 'Not able to add expense categories',
'Not able to edit wallets' => 'Not able to edit wallets',
'Not able to synchronize bank account' => 'Not able to synchronize bank account',
'Not able to add actual expenses' => 'Not able to add actual expenses',
'Not able to add actual income' => 'Not able to add actual income',
'Error in calculating budgets' => 'Error in calculating budgets',
'Error in Saving potential' => 'Error in Saving potential',
'Error in planned Vs actual budget' => 'Error in planned Vs actual budget',
);
$GLOBALS['app_list_strings']['sub_module_My_Investments_list']=array (
  '' => '',
  'Wants to understand about Networth Calculation' => 'Wants to understand about Networth Calculation',
'Wants to add new assets to Portfolio' => 'Wants to add new assets to Portfolio',
'Wants to edit  assets in Portfolio' => 'Wants to edit  assets in Portfolio',
'Wants to add new liabilities to Portfolio' => 'Wants to add new liabilities to Portfolio',
'Wants to edit liabilities' => 'Wants to edit liabilities',
'Wants to add new Insurance Policy ' => 'Wants to add new Insurance Policy ',
'Wants to upload transactions in excel format' => 'Wants to upload transactions in excel format',
'Error in calculating Networth' => 'Error in calculating Networth',
'Error in representation of asset value' => 'Error in representation of asset value',
'Error in representation of liability value' => 'Error in representation of liability value',
'Errors in calculating returns' => 'Errors in calculating returns',
);
$GLOBALS['app_list_strings']['sub_module_My_Goals_list']=array (
  '' => '',
  'Wants to know about goal planning' => 'Wants to know about goal planning',
'Wants to know about custom goal setting' => 'Wants to know about custom goal setting',
'Wants to understand calculations for monthly, yearly and annual investments required' => 'Wants to understand calculations for monthly, yearly and annual investments required',
'Tagging investments with goals' => 'Tagging investments with goals',
'Wants to understand cash flows' => 'Wants to understand cash flows',
'Not able to plan a goal' => 'Not able to plan a goal',
'Not able to tag exisiting investment with goals' => 'Not able to tag exisiting investment with goals',
'Not able to edit goals' => 'Not able to edit goals',
'Not able to delete goals' => 'Not able to delete goals',
'Not able to adjust goals' => 'Not able to adjust goals',
'Not able to adjust risk profile' => 'Not able to adjust risk profile',

);
$GLOBALS['app_list_strings']['sub_module_Reports_list']=array (
  '' => '',
  'Wants to understand reports section' => 'Wants to understand reports section',
'Reports not populating' => 'Reports not populating',
'Not able to export reports in PDF format' => 'Not able to export reports in PDF format',
'Not able to export reports in excel format' => 'Not able to export reports in excel format',
);
$GLOBALS['app_list_strings']['sub_module_Buy_Products-_Mutual_funds_list']=array (
  '' => '',
  'Wants to understand ideal recommended portfolio in Mutual Funds' => 'Wants to understand ideal recommended portfolio in Mutual Funds',
'Wants to invest outside the ideal recommended portfolio in Mutual Funds' => 'Wants to invest outside the ideal recommended portfolio in Mutual Funds',
'Not able to find the fund of choice in the recommended list of Mutual Funds' => 'Not able to find the fund of choice in the recommended list of Mutual Funds',
'Wants to invest lumpsum in Mutual Funds' => 'Wants to invest lumpsum in Mutual Funds',
'Wants to start SIP in Mutual Funds' => 'Wants to start SIP in Mutual Funds',
'Wants to start a new SIP in Mutual Funds' => 'Wants to start a new SIP in Mutual Funds',
'KYC form pickup request' => 'KYC form pickup request',
'Wants to Switch Funds' => 'Wants to Switch Funds',
'Wants to initiate SWP' => 'Wants to initiate SWP',
'Wants to initiate STP' => 'Wants to initiate STP',
'Wants to redeem exisiting investment' => 'Wants to redeem exisiting investment',
'Wants to know the time for allocation of units post purchase' => 'Wants to know the time for allocation of units post purchase',
'Wants to know the time in days for redemption of units' => 'Wants to know the time in days for redemption of units',
'Wants to get a printed statement for Mutual Fund Investments' => 'Wants to get a printed statement for Mutual Fund Investments',
'Delay in Mutual Fund redemption' => 'Delay in Mutual Fund redemption',
'Delay in Mutual Fund refund' => 'Delay in Mutual Fund refund',
'Wants to get an e-statement for Mutual Fund Investments' => 'Wants to get an e-statement for Mutual Fund Investments',
'Wants to set up an NACH mandate' => 'Wants to set up an NACH mandate',
'Wants to set up a new NACH mandate' => 'Wants to set up a new NACH mandate',
'Not able to download NACH mandate form' => 'Not able to download NACH mandate form',
'Courier pickup request for NACH mandate form' => 'Courier pickup request for NACH mandate form',
'Bank name not reflecting in the payment list' => 'Bank name not reflecting in the payment list',
'Not able to edit the cart' => 'Not able to edit the cart',
'Not able to delete the product already exisiting in the cart' => 'Not able to delete the product already exisiting in the cart',
'Investor account not activated despite all documentation' => 'Investor account not activated despite all documentation',
'Delay in activation of Investor account' => 'Delay in activation of Investor account',
'Investor account activation intimation mail not received' => 'Investor account activation intimation mail not received',
'Investor wants to have a discussion with Advisory team' => 'Investor wants to have a discussion with Advisory team',
'Investor wants to understand the methodology for Fund recommendation' => 'Investor wants to understand the methodology for Fund recommendation',
'Investor want a recommendation mail from advisory team' => 'Investor want a recommendation mail from advisory team',
'Amount deducted but confirmation is not received ' => 'Amount deducted but confirmation is not received ',
'Payment failure-Gateway related issues' => 'Payment failure-Gateway related issues',
'Payment failure-Bank related Issues' => 'Payment failure-Bank related Issues',
);
$GLOBALS['app_list_strings']['sub_module_Buy_Products-_Corporate_Fixed_Deposits_list']=array (
  '' => '',
  'Wants to know about corporate Fixed Desposits' => 'Wants to know about corporate Fixed Desposits',
'Wants to understand about the ratings corporate Fixed Deposits' => 'Wants to understand about the ratings corporate Fixed Deposits',
'Wants to understand about the interest rates of Fixed Desposits' => 'Wants to understand about the interest rates of Fixed Desposits',
'Wants to invest in corporate Fixed Deposits' => 'Wants to invest in corporate Fixed Deposits',
'Wants to start a new Fixed Deposit' => 'Wants to start a new Fixed Deposit',
'Want to premature withdraw a Fixed Deposit' => 'Want to premature withdraw a Fixed Deposit',
'Wants to withdraw a Fixed Deposit' => 'Wants to withdraw a Fixed Deposit',
);
$GLOBALS['app_list_strings']['sub_module_Buy_Products-_Gold_list']=array (
  '' => '',
  'Wants to start a new investment in Gold' => 'Wants to start a new investment in Gold',
'Wants to do an additional purchase in Gold ' => 'Wants to do an additional purchase in Gold ',
'Wants to redeem exisiting investment in Gold' => 'Wants to redeem exisiting investment in Gold',
'Wants to renew exisiting investment in Gold' => 'Wants to renew exisiting investment in Gold',
'Gold units not allocated in the specified time' => 'Gold units not allocated in the specified time',
'Delay in gold redemption' => 'Delay in gold redemption',
'Delay in renewal of gold scheme' => 'Delay in renewal of gold scheme',
);
$GLOBALS['app_list_strings']['sub_module_Debentures_list']=array (
  '' => '',
  'Want to invest in Bond' => 'Want to invest in Bond',
'units allotment ' => 'units allotment ',
'Premature Withdrawal of funds' => 'Premature Withdrawal of funds',
'To be detailed' => 'To be detailed',
'Non receipt of allotment certificate' => 'Non receipt of allotment certificate',
'Partial allotment' => 'Partial allotment',
'Discrepancy of allotment in MY Invt ' => 'Discrepancy of allotment in MY Invt ',

);
$GLOBALS['app_list_strings']['sub_module_Buy_Products-Equity_list']=array (
  '' => '',
  'Wants to understand the process of Opening Equity trading account' => 'Wants to understand the process of Opening Equity trading account',
'Wants to understand about the equity account opening charges' => 'Wants to understand about the equity account opening charges',
'Wants to understand the brokerage structure' => 'Wants to understand the brokerage structure',
'Equity transaction on 5nance portal' => 'Equity transaction on 5nance portal',
'Call from Sushil Finance for account opening' => 'Call from Sushil Finance for account opening',
'Did not receive account opening form through courier' => 'Did not receive account opening form through courier',
'Delay in opening Equity trading account despite submitting the form and documents' => 'Delay in opening Equity trading account despite submitting the form and documents',
'Equity trading online account details not working' => 'Equity trading online account details not working',
'Equity investment under My Investment' => 'Equity investment under My Investment',
'Discrepany in Equity Valuation ' => 'Discrepany in Equity Valuation ',
);
$GLOBALS['app_list_strings']['sub_module_PO-_Lumpsum_Investment_list']=array (
  '' => '',
  'Wants to understand allocation in Lumpsum Investments' => 'Wants to understand allocation in Lumpsum Investments',
'Wants to understand the minimum lumpsum investment in a given fund' => 'Wants to understand the minimum lumpsum investment in a given fund',
);
$GLOBALS['app_list_strings']['sub_module_PO-Retirement_Planning_list']=array (
  '' => '',
  'Wants to know about Retirement planning calculator' => 'Wants to know about Retirement planning calculator',
'Wants to understand cash flow in Retirement Calculator' => 'Wants to understand cash flow in Retirement Calculator',
'Wants to link his exisiting Investments in Retirement Calculator' => 'Wants to link his exisiting Investments in Retirement Calculator',
);
$GLOBALS['app_list_strings']['sub_module_Buy_Poducts-Loans_list']=array (
  '' => '',
  'Wants to apply for a home loan' => 'Wants to apply for a home loan',
'Wants to understand the status of home loan application' => 'Wants to understand the status of home loan application',
'Have not received any call from the Home loan partner ' => 'Have not received any call from the Home loan partner ',
'Wants to apply for a Personal loan' => 'Wants to apply for a Personal loan',
'Wants to understand the status of personal loan application' => 'Wants to understand the status of personal loan application',
'Have not received any call from the personal loan partner ' => 'Have not received any call from the personal loan partner ',
'Wants to apply for an Educational loan' => 'Wants to apply for an Educational loan',
'Wants to understand the status of Educational loan application' => 'Wants to understand the status of Educational loan application',
'Have not received any call from the Educational loan partner ' => 'Have not received any call from the Educational loan partner ',
);
$GLOBALS['app_list_strings']['sub_module_PO-_Tax_Planning_list']=array (
  '' => '',
  'Wants to know about Tax planning calculator' => 'Wants to know about Tax planning calculator',
'Wants to have a comprehensive understand about tax calculation' => 'Wants to have a comprehensive understand about tax calculation',
'Wants to understand about tax saving instruments ' => 'Wants to understand about tax saving instruments ',
'Wants to invest in ELSS' => 'Wants to invest in ELSS',
'Not able to find the fund of choice in the recommended list of ELSS' => 'Not able to find the fund of choice in the recommended list of ELSS',
'Wants to buy in Health Insurance' => 'Wants to buy in Health Insurance',
'Wants to know the benefit of Health Insurance plan recommended' => 'Wants to know the benefit of Health Insurance plan recommended',
'Wants to cancel the Health Insurance policy purchased in the free look-up period' => 'Wants to cancel the Health Insurance policy purchased in the free look-up period',
'Wants a refund for the Cancelled Insurance policy' => 'Wants a refund for the Cancelled Insurance policy',
'Wants to understand the status of refund for the cancelled policy' => 'Wants to understand the status of refund for the cancelled policy',
'Procedure of filing the claim' => 'Procedure of filing the claim',
'Wants to file a claim for Healthcare policy' => 'Wants to file a claim for Healthcare policy',
'Wants to know the status of the claim for Healthcare policy' => 'Wants to know the status of the claim for Healthcare policy',
);
$GLOBALS['app_list_strings']['sub_module_PO-SIP_list']=array (
  '' => '',
  'Wants to know more about SIP calculator' => 'Wants to know more about SIP calculator',
'Wants to start a new SIP in Mutual Funds' => 'Wants to start a new SIP in Mutual Funds',
'Wants to cancel existing SIP' => 'Wants to cancel existing SIP',
'Wants to understand exit load' => 'Wants to understand exit load',
'Want to start a new SIP' => 'Want to start a new SIP',
'Wants to understand the minimum investment amount in a given fund' => 'Wants to understand the minimum investment amount in a given fund',
);
$GLOBALS['app_list_strings']['sub_module_PO-_Tax_Filing_list']=array (
  '' => '',
  'Wants to know about e-tax filing process' => 'Wants to know about e-tax filing process',
'Facing problem in uploading form-16' => 'Facing problem in uploading form-16',
);
$GLOBALS['app_list_strings']['sub_module_Generic_list']=array (
  '' => '',
  'Sales Complaint' => 'Sales Complaint',
'Returns on portfolio' => 'Returns on portfolio',
);
$GLOBALS['app_list_strings']['sub_module_Insurance_list']=array (
  '' => '',
  'Non receipt of policy document' => 'Non receipt of policy document',
'Renewal notification' => 'Renewal notification',
'Renewal policy not received' => 'Renewal policy not received',
'Medical requirement for Insurance' => 'Medical requirement for Insurance',
'Submission of Medical document' => 'Submission of Medical document',
' Underwriting case for policy' => ' Underwriting case for policy',
'Additional document for policy issuancce' => 'Additional document for policy issuancce',
'Portability of policy' => 'Portability of policy',
);
$GLOBALS['app_list_strings']['case_status_dom']=array (
  'Open_New' => 'New',
  'Open_Reassigned' => 'Reassigned',
  'Open_Escalated' => 'Escalated',
  'Open_Reopen' => 'Reopen',
  'Open_Pending Input' => 'Pending Input',
  'Closed_Closed' => 'Closed',
  'Closed_Rejected' => 'Rejected',
  'Closed_Duplicate' => 'Duplicate',
);
$GLOBALS['app_list_strings']['manufacturer_name_Buy_Products-_Mutual_funds_list']=array (
  '' => '',
  'Birla Sun Life Mutual Fund'=>'Birla Sun Life Mutual Fund',
'HDFC Mutual Fund'=>'HDFC Mutual Fund',
'IDFC Mutual Fund'=>'IDFC Mutual Fund',
'Reliance Mutual Fund'=>'Reliance Mutual Fund',
'Axis Mutual Fund'=>'Axis Mutual Fund',
'Franklin Templeton Mutual Fund'=>'Franklin Templeton Mutual Fund',
'Indiabulls Mutual Fund'=>'Indiabulls Mutual Fund',
'Taurus Mutual Fund'=>'Taurus Mutual Fund',
'LIC NOMURA Mutual Fund'=>'LIC NOMURA Mutual Fund',
'Canara Robeco Mutual Fund'=>'Canara Robeco Mutual Fund',
'Mirae Asset Mutual Fund'=>'Mirae Asset Mutual Fund',
'DSP BlackRock Mutual Fund'=>'DSP BlackRock Mutual Fund',
'Sundaram Mutual Fund'=>'Sundaram Mutual Fund',
'ICICI Prudential Mutual Fund'=>'ICICI Prudential Mutual Fund',
'Peerless Mutual Fund'=>'Peerless Mutual Fund',
'SBI Mutual Fund'=>'SBI Mutual Fund',
'Tata Mutual Fund'=>'Tata Mutual Fund',
'UTI Mutual Fund'=>'UTI Mutual Fund',
'BOI AXA Mutual Fund'=>'BOI AXA Mutual Fund',
'BNP Paribas Mutual Fund'=>'BNP Paribas Mutual Fund',
'PRINCIPAL Mutual Fund'=>'PRINCIPAL Mutual Fund',
'Kotak Mahindra Mutual Fund'=>'Kotak Mahindra Mutual Fund',
'DHFL Pramerica Mutual Fund'=>'DHFL Pramerica Mutual Fund',
'Religare Invesco Mutual Fund'=>'Religare Invesco Mutual Fund'
);
$GLOBALS['app_list_strings']['manufacturer_name_Buy_Products-_Corporate_Fixed_Deposits_list']=array (
  '' => '',
'Mahindra & Mahindra Finance Services Ltd'=>'Mahindra & Mahindra Finance Services Ltd',
'Dewan Housing Finance Ltd'=>'Dewan Housing Finance Ltd',
'Shriram Transport Finance Company Ltd'=>'Shriram Transport Finance Company Ltd'

);
$GLOBALS['app_list_strings']['manufacturer_name_Buy_Products-_Gold_list']=array (
  'Bullion India' => 'Bullion India'
);
$GLOBALS['app_list_strings']['manufacturer_name_Buy_Products-_Loans_list']=array (
  'DHFL' => 'DHFL',
  'Fullerton Personal Loan' => 'Fullerton Personal Loan'  
);
$GLOBALS['app_list_strings']['manufacturer_name_Insurance_list']=array (
  'Religare Health Insurance'=>'Religare Health Insurance',
	'HDFC Life'=>'HDFC Life'
);

$GLOBALS['app_list_strings']['manufacturer_name_c_list']=array (
  '' => '',
  'Birla Sun Life Mutual Fund'=>'Birla Sun Life Mutual Fund',
'HDFC Mutual Fund'=>'HDFC Mutual Fund',
'IDFC Mutual Fund'=>'IDFC Mutual Fund',
'Reliance Mutual Fund'=>'Reliance Mutual Fund',
'Axis Mutual Fund'=>'Axis Mutual Fund',
'Franklin Templeton Mutual Fund'=>'Franklin Templeton Mutual Fund',
'Indiabulls Mutual Fund'=>'Indiabulls Mutual Fund',
'Taurus Mutual Fund'=>'Taurus Mutual Fund',
'LIC NOMURA Mutual Fund'=>'LIC NOMURA Mutual Fund',
'Canara Robeco Mutual Fund'=>'Canara Robeco Mutual Fund',
'Mirae Asset Mutual Fund'=>'Mirae Asset Mutual Fund',
'DSP BlackRock Mutual Fund'=>'DSP BlackRock Mutual Fund',
'Sundaram Mutual Fund'=>'Sundaram Mutual Fund',
'ICICI Prudential Mutual Fund'=>'ICICI Prudential Mutual Fund',
'Peerless Mutual Fund'=>'Peerless Mutual Fund',
'SBI Mutual Fund'=>'SBI Mutual Fund',
'Tata Mutual Fund'=>'Tata Mutual Fund',
'UTI Mutual Fund'=>'UTI Mutual Fund',
'BOI AXA Mutual Fund'=>'BOI AXA Mutual Fund',
'BNP Paribas Mutual Fund'=>'BNP Paribas Mutual Fund',
'PRINCIPAL Mutual Fund'=>'PRINCIPAL Mutual Fund',
'Kotak Mahindra Mutual Fund'=>'Kotak Mahindra Mutual Fund',
'DHFL Pramerica Mutual Fund'=>'DHFL Pramerica Mutual Fund',
'Religare Invesco Mutual Fund'=>'Religare Invesco Mutual Fund',
'Bullion India'=>'Bullion India',
'Mahindra & Mahindra Finance Services Ltd'=>'Mahindra & Mahindra Finance Services Ltd',
'Dewan Housing Finance Ltd'=>'Dewan Housing Finance Ltd',
'Shriram Transport Finance Company Ltd'=>'Shriram Transport Finance Company Ltd',
'DHFL'=>'DHFL',
'Fullerton Personal Loan'=>'Fullerton Personal Loan',
'Religare Health Insurance'=>'Religare Health Insurance',
'HDFC Life'=>'HDFC Life'
);

$GLOBALS['app_list_strings']['escalation_level_list']=array (
  '' => '',
  'Level1' => 'Level 1',
  'Level2' => 'Level 2',
  'Level3' => 'Level 3',
  'Level4' => 'Level 4',
);
$GLOBALS['app_list_strings']['meeting_status_dom']=array (
  'Planned' => 'Planned',
  'Held' => 'Held',
  'Not Held' => 'Not Held',
);

$GLOBALS['app_list_strings']['disposition_0']=array (
  '' => '',
  'Interested' => 'First Meeting Confirmed',
  'Didnt meet/Unreachable' => 'Didnt meet/Unreachable',
  'Rescheduled' => 'Rescheduled',
  'Not Interested' => 'Not Interested',
  'Second meet needed' => 'Second meet needed',
  'Reference' => 'Reference',
);

$GLOBALS['app_list_strings']['non_office_menu_list']=array (
  '' => '',
  1 => 'Investment',
  2 => 'Investment',
  3 => 'Loan',
  'playNonOfficeHoursMenu_en' => ' ',
  4 => 'Customer Support',
  'playNonOfficeHoursMenu_hn' => ' ',
);
$GLOBALS['app_list_strings']['language_list']=array (
  '' => '',
  1 => 'English',
  2 => 'हिन�?दी',
);

$GLOBALS['app_list_strings']['disposition_c_list']=array (
   '' => '',
  'Fresh_Fresh' => 'Fresh',
  'Followup_Call_Back' => 'Asked to callback',
  'Followup_out_of_coverage' => 'Mobile Out of Coverage Area',
  'Followup_Ringing' => 'Ringing',
  'Followup_Switched_Off' => 'Switched Off',
  'Valid_Interested_Candidate' => 'Interested Candidate',
  'Invalid_Wrong_Data' => 'Wrong Data',
  'Invalid_Duplicate_Data' => 'Duplicate Lead',
  'Invalid_Invalid_OTP' => 'Invalid OTP',
  'Invalid_Did_not_fill_form' => 'Did not fill form',
  'Invalid_Not_Interested' => 'Not Interested',
  'Invalid_Language_Barrier' => 'Language Barrier',
  'Test_Data' => 'Test Data',
);

$campaign_type_list=array(
   ''=>'',
);
$db = DBManagerFactory::getInstance(); 
$result=$db->query("select source_id, name from scrm_campaign_source where deleted='0'");
while($row=$db->fetchRow($result)){$campaign_type_list[$row['source_id']] = $row['name'];}
$GLOBALS['app_list_strings']['campaign_type_list']=$campaign_type_list;
$campaign_sub_type_list=array(
   ''=>'',
);
$result=$db->query("select source_id, content from scrm_campaign_source where deleted='0'");
while($row=$db->fetchRow($result)){$campaign_sub_type_list[$row['source_id'].'_'.$row['content']] = $row['content'];}
$GLOBALS['app_list_strings']['sub_campaign_type_list']=$campaign_sub_type_list;



$GLOBALS['app_list_strings']['scrm_calls_calltype_list2']=array (
  '' => '',
  'inbound.call.dial' => 'Inbound Call Dial',
  'outbound.auto.dial' => 'Outbound Call Dial',
  'outbound.callback.dial' => 'Outbound Callback Dial',
  'outbound.auto.preview.dial' => 'Outbound Auto Preview Dial',
  'outbound.manual.dial' => 'Outbound Manual Call',
  'outbound.manual.preview.dial' => 'Outbound Manual Preview Dial',
  'outbound.manual.dial' => 'Outbound Manual Dial',
  'click.to.call.dial' => 'Click to Dial Call',
  'auto.dial.customer' => 'Auto Dial',
  'inbound.dial.customer' => 'Inbound Call',
  'manual.dial.customer' => 'Manual Dial And Transefer to user',
  'inbound.call.dial.corporate' => 'Corporate Inbound Call Dial',
  'outbound.auto.dial.corporate' => 'Corporate Outbound Call Dial',
  'outbound.callback.dial.corporate' => 'Corporate Outbound Callback Dial',
  'outbound.auto.preview.dial.corporate' => 'Corporate Outbound Auto Preview Dial',
  'outbound.manual.dial.corporate' => 'Corporate Outbound Manual Call',
  'outbound.manual.preview.dial.corporate' => 'Corporate Outbound Manual Preview Dial',
  'outbound.manual.dial.corporate' => 'Corporate Outbound Manual Dial',
  'click.to.call.dial.corporate' => 'Corporate Click to Dial Call',
  'auto.dial.customer.corporate' => 'Corporate Auto Dial',
  'inbound.dial.customer.corporate' => 'Corporate Inbound Call',
  'manual.dial.customer.corporate' => 'Corporate Manual Dial And Transefer to user',
);
$GLOBALS['app_list_strings']['scrm_calls_laststatus']=array (
  '' => '',
  'AMD' => 'AMD',
  'ATTEMPT_FAILED' => 'ATTEMPT FAILED',
  'BUSY' => 'BUSY',
  'CALL_DROP' => 'CALL DROP',
  'CALL_HANGUP' => 'CALL HANGUP',
  'CALL_NOT_PICKED' => 'CALL NOT PICKED',
  'FAILED' => 'FAILED',
  'NO_ANSWER' => 'NO ANSWER',
  'NUMBER_FAILURE' => 'NUMBER FAILURE',
  'NUMBER_TEMP_FAILURE' => 'NUMBER TEMP FAILURE',
  'PROVIDER_FAILURE' => 'NUMBER FAILURE',
  'PROVIDER_TEMP_FAILURE' => 'PROVIDER TEMP FAILURE',
   'SIT INTERCEPT' => 'SIT INTERCEPT', 
   'SIT_NOCIRCUIT' => 'SIT NOCIRCUIT',
   'SIT_REORDER' => 'SIT REORDER',
   'SIT_VACANT' => 'SIT VACANT',
    'SYSTEM_ERROR'=> 'SYSTEM ERROR',
);
$GLOBALS['app_list_strings']['scrm_calls_campaignid_list']=array (
  'Invoage Inbound Campaign' => 'Invoage Inbound Campaign',
  'Invoage Outbound Campaign' => 'Invoage Outbound Campaign',
  'Campaign No 3' => 'Campaign No 3',
  'Campaign No 4' => 'Campaign No 4',
  'Campaign No 5' => 'Campaign No 5',
  1 => 'Invoage Outbound Campaign',
  2 => 'Invoage Inbound Campaign',
  3 => 'Campaign No 3',
  4 => 'Campaign No 4',
  5 => 'Campaign No 5',
);
$GLOBALS['app_list_strings']['non_office_menu_list']=array (
  '' => '',
  1 => 'Investment',
  2 => 'Insurance',
  3 => 'Loan',
  'playNonOfficeHoursMenu_en' => ' ',
  4 => 'Customer Support',
  'playNonOfficeHoursMenu_hn' => ' ',
);
$GLOBALS['app_list_strings']['lead_status_dom']=array (
    'Fresh' => 'Fresh',
  'Followup' => 'Followup',
  'Valid' => 'Valid',
  'Invalid' => 'Invalid',
  'Test' => 'Test Data',
);
$app_list_strings['moduleList']['Accounts']='Related Corporate Accounts';
$app_list_strings['moduleListSingular']['Accounts']='Related Corporate Account';
$app_list_strings['record_type_display']['Accounts']='Related Corporate Account';
$app_list_strings['parent_type_display']['Accounts']='Related Corporate Account';
$app_list_strings['record_type_display_notes']['Accounts']='Related Corporate Account';

$GLOBALS['app_list_strings']['kyc']=array (
  '' => '',
  'Yes' => 'Yes',
  'No' => 'No',
);
$GLOBALS['app_list_strings'][' investor_acct_creation_month_list ']=array (
   '' => '',
  'January' => 'January',
  'February' => 'February',
  'March' => 'March',
  'April' => 'April',
  'May' => 'May',
  'June' => 'June',
  'July' => 'July',
  'August' => 'August',
  'September' => 'September',
  'October' => 'October',
  'November' => 'November',
  'December' => 'December',
);
$GLOBALS['app_list_strings']['auto_activation_list']=array (
  '' => '',
  'Yes' => 'Yes',
  'No' => 'No',
);
$GLOBALS['app_list_strings']['investment_type_list']=array (
  '' => '',
  'LUMPSUM' => 'LUMPSUM',
  'SIP' => 'SIP',
);
$GLOBALS['app_list_strings']['investment_period_list']=array (
    '' => '',
  1 => '0-1 year',
  2 => '1-3 year',
  3 => '3-8 year',
  4 => 'more than 8 years',
);
$app_list_strings['moduleList']['scrm_Bank_Details']='Investor Bank Account';
$app_list_strings['moduleListSingular']['scrm_Bank_Details']='Investor Bank Account';
$GLOBALS['app_list_strings']['uploaded_cheque_image_list']=array (
  '' => '',
  'Yes' => 'Yes',
  'No' => 'No',
);

$GLOBALS['app_list_strings']['kyc_verification_status_list']=array (
  '' => '',
  'Verified' => 'Verified',
  'Non_Verified' => 'Not Verified',
);
$GLOBALS['app_list_strings']['document_submitted_cente_list']=array (
  '' => '',
  'Courier' => 'Courier',
  'Pickup' => 'Pickup',
  'Download' => 'Download',
);
$GLOBALS['app_list_strings']['product_sub_type_interest_list']=array (
   '' => '',
  'Home Loan' => 'Home Loan',
'Personal Loan' => 'Personal Loan',
'Education Loan' => 'Education Loan',
'FIT-SIP' => 'FIT-SIP',
'Mutual Fund' => 'Mutual Fund',
'Loan Genie' => 'Loan Genie',
'Tax-Max' => 'Tax-Max',
'Equity-ELSS' => 'Equity-ELSS',
'Equity Oriented-Balanced Funds' => 'Equity Oriented-Balanced Funds',
'Equity- Banks and Financial Services' => 'Equity- Banks and Financial Services',
'Equity- Infrastructure' => 'Equity- Infrastructure',
'Equity-Thematic' => 'Equity-Thematic',
'Equity-Pharma' => 'Equity-Pharma',
'Equity- Information Technology' => 'Equity- Information Technology',
'Equity- FMCG' => 'Equity- FMCG',
'Equity-Others' => 'Equity-Others',
'Equity-Diversified' => 'Equity-Diversified',
'Large Cap Funds' => 'Large Cap Funds',
'Mid Cap Funds' => 'Mid Cap Funds',
'Small Cap Funds' => 'Small Cap Funds',
'Liquid Funds' => 'Liquid Funds',
'Gold ETF' => 'Gold ETF',
'Debt Long Term' => 'Debt Long Term',
'Debt Short Term' => 'Debt Short Term',
'Ultra Short Debt Term ' => 'Ultra Short Debt Term ',
'Index Funds' => 'Index Funds',
'Capital Protection Fund' => 'Capital Protection Fund',
'Fund Of Funds- Equity Oriented' => 'Fund Of Funds- Equity Oriented',
'Fund Of Funds-Debt Oriented' => 'Fund Of Funds-Debt Oriented',
'Fund Of Funds- Hybrid Oriented' => 'Fund Of Funds- Hybrid Oriented',
'Fund Of Funds- Commodity Oriented' => 'Fund Of Funds- Commodity Oriented',
'Arbitrage Funds' => 'Arbitrage Funds',
'Term Insurance' => 'Term Insurance',
'Health Insurance' => 'Health Insurance',
'Motor Insurance' => 'Motor Insurance',
'Health Insurance- Individual' => 'Health Insurance- Individual',
'Health Insurance- Family ' => 'Health Insurance- Family ',
'Travel Insurance- Single Trip' => 'Travel Insurance- Single Trip',
'Travel Insurance- Business Multi Trip' => 'Travel Insurance- Business Multi Trip',
'Motor Vehicle Insurance' => 'Motor Vehicle Insurance',
'Two Wheeler Insurance' => 'Two Wheeler Insurance',
'House Insurance' => 'House Insurance',
'Personal Accident' => 'Personal Accident',
'Retirement Policy' => 'Retirement Policy',
'Endowment Policy' => 'Endowment Policy',
'Child Plan' => 'Child Plan',
'ULIP' => 'ULIP',
'Dewan Housing Finance Limited' => 'Dewan Housing Finance Limited',
'Mahindra and Mahindra Finance Service Ltd' => 'Mahindra and Mahindra Finance Service Ltd',
'Shriram Transport Finance Company Ltd' => 'Shriram Transport Finance Company Ltd',
'Fixed Deposits' => 'Fixed Deposits',
'Gold' => 'Gold',
'Credit Card' => 'Credit Card',
'Gold SIP' => 'Gold SIP',
'Gold Coin' => 'Gold Coin',
'American Express' => 'American Express',
);
$GLOBALS['app_list_strings']['firstinvestor_list']=array (
  '' => '',
  'yes' => 'Yes',
  'no' => 'No',
);
$GLOBALS['app_list_strings']['is_1st_time_investor_list']=array (
  'is_1st_time_investor' => 'is_1st_time_investor',
  'Yes' => 'Yes',
);
$GLOBALS['app_list_strings']['authorize_to_call_list']=array (
  'Yes' => 'Yes',
  'No' => 'No',
);
$GLOBALS['app_list_strings']['old_disposition_list']=array (
  '' => '',
  'B2B2C- Converted and registered on platform' => 'B2B2C- Converted and registered on platform',
'B2B2C- Converted to transacting partner' => 'B2B2C- Converted to transacting partner',
'B2B2C- Follow Up for Business Generation' => 'B2B2C- Follow Up for Business Generation',
'B2B2C- Interested in conversion to transacting partner' => 'B2B2C- Interested in conversion to transacting partner',
'Call drop due to network' => 'Call drop due to network',
'Client has not initiated any registration on the website' => 'Client has not initiated any registration on the website',
'Client is busy and has asked to call back later' => 'Client is busy and has asked to call back later',
'Client is travelling and has asked to call back later' => 'Client is travelling and has asked to call back later',
'Converted to Customer' => 'Converted to Customer',
'Converted- Credit card issued' => 'Converted- Credit card issued',
'Converted- Invested in Debentures' => 'Converted- Invested in Debentures',
'Converted- Invested in Equity' => 'Converted- Invested in Equity',
'Converted- Invested in Fixed Deposits' => 'Converted- Invested in Fixed Deposits',
'Converted- Invested in Gold' => 'Converted- Invested in Gold',
'Converted- Invested in Mutual Funds' => 'Converted- Invested in Mutual Funds',
'Converted- Loan Disbursed' => 'Converted- Loan Disbursed',
'Converted- Purchased Insurance' => 'Converted- Purchased Insurance',
'Converted-Invested in Bonds' => 'Converted-Invested in Bonds',
'Cross selling- Different product category' => 'Cross selling- Different product category',
'Follow up for Internal Survey-Customer Satisfaction' => 'Follow up for Internal Survey-Customer Satisfaction',
'Follow up for Referrals' => 'Follow up for Referrals',
'Follow up for Survey-Others' => 'Follow up for Survey-Others',
'Follow up for Test Marketing' => 'Follow up for Test Marketing',
'Followup - For conversion to Hot Prospect' => 'Followup - For conversion to Hot Prospect',
'Followup - For conversion to prospect' => 'Followup - For conversion to prospect',
'Followup - For conversion to suspect' => 'Followup - For conversion to suspect',
'Followup - For documentation' => 'Followup - For documentation',
'Followup - For Payment' => 'Followup - For Payment',
'Hot Prospect- Highly Interested' => 'Hot Prospect- Highly Interested',
'Language barrier' => 'Language barrier',
'Not interested due to Financial Issues- Not ready to spend now' => 'Not interested due to Financial Issues- Not ready to spend now',
'Not interested in any products or services we offer' => 'Not interested in any products or services we offer',
'Not interested in discussing his financial objectives with us' => 'Not interested in discussing his financial objectives with us',
'Not interested now but may be in the future' => 'Not interested now but may be in the future',
'Number temporarily disconnected' => 'Number temporarily disconnected',
'Phone not reachable' => 'Phone not reachable',
'Phone switched off' => 'Phone switched off',
'Product and services offered does not fulfill his requirement' => 'Product and services offered does not fulfill his requirement',
'Prospect- Very Interested' => 'Prospect- Very Interested',
'Ringing not picking up' => 'Ringing not picking up',
'Suspect- Interested in products and services' => 'Suspect- Interested in products and services',
'Test data created by employees' => 'Test data created by employees',
'Test data created by vendors' => 'Test data created by vendors',
'Upselling- Same product category' => 'Upselling- Same product category',
'Wrong Number-Identity mismatch' => 'Wrong Number-Identity mismatch',
);

$GLOBALS['app_list_strings']['availability_status_c_list']=array (
  '' => '',
  'Available' => 'Available',
  'Not_Available' => 'Not Available',
);
$GLOBALS['app_list_strings']['is_first_time_inverstor_list']=array (
  '' => '',
  'Yes' => 'Yes',
  'No' => 'No',
);

$GLOBALS['app_list_strings']['do_you_have_internet_banking_list']=array (
  '' => '',
  'Yes' => 'Yes',
  'No' => 'No',
);
$GLOBALS['app_list_strings']['referral_type_list']=array (
  '' => '',
  'Existing_Customer_Reference' => 'Existing Customer Reference',
  'Referral_Drive' => 'Referral Drive',
  'Self_Referral' => 'Self-Referral',
  'Not_Applicable' => 'Not Applicable',
);
$GLOBALS['app_list_strings']['bank_account_list']=array (
  '' => '',
  'Yes' => 'Yes',
  'No' => 'No',
);
$GLOBALS['app_list_strings']['pan_card_list']=array (
  '' => '',
  'Yes' => 'Yes',
  'No' => 'No',
);
$GLOBALS['app_list_strings']['first_time_investor_list']=array (
  '' => '',
  'Yes' => 'Yes',
  'No' => 'No',
);
$GLOBALS['app_list_strings']['internet_banking_list']=array (
  '' => '',
  'Yes' => 'Yes',
  'No' => 'No',
);
$GLOBALS['app_list_strings']['investor_occupation_list']=array (
  '' => '',
  'Business' => 'Business',
  'Farmer' => 'Farmer',
  'Government_Public_Service' => 'Government/Public Service',
  'House_wife' => 'House wife',
  'Private_Service' => 'Private Service',
  'Professional' => 'Professional',
  'Retired' => 'Retired',
  'Self_Employed' => 'Self Employed',
  'Daily_wage_earner' => 'Daily Wage Earner',
);
$app_list_strings['moduleList']['AOS_Products']='Old Products';
$app_list_strings['moduleListSingular']['AOS_Products']='Old Products';
$GLOBALS['app_list_strings']['gateway_list']=array (
  '' => '',
  '5nance.com' => '5nance.com',
  'Digital Marketing' => 'Digital Marketing',
  'Offline Marketing' => 'Offline Marketing',
  'Corporate Channel' => 'Corporate Channel',
  'Android APP' => 'Android APP',
  'iOS APP' => 'iOS APP',
  'CSC- M.P Online' => 'CSC- MPONLINE',
  'CSC- Rajasthan emitra' => 'CSC- Rajasthan emitra',
  'IFA Channel' => 'IFA Channel',
  'PERSONALLOAN' => 'PERSONAL LOAN',
);
$GLOBALS['app_list_strings']['gateway_0']=array (
  '' => '',
  'CRM-5NANCE.COM' => 'CRM-5NANCE.COM',
  'CRM-OFFLINE' => 'CRM-OFFLINE',
  'CRM-CORPORATE SALES' => 'CRM-CORPORATE SALES',
  'CRM- M.P ONLINE' => 'CRM- M.P ONLINE',
  'CRM-EMITRA' => 'CRM-EMITRA',
  'CRM-REFERENCE' => 'CRM-REFERENCE',
  'CRM-MARKETING' => 'DIGITAL MARKETING',
);
$GLOBALS['app_list_strings']['next_comment_list']=array (
  0 => 'Customer interested in our products',
  1 => 'Prospect- Investor Ac Activated',
  2 => 'Hot Prospect- Initial Payment pending/NACH awaited',
  3 => 'Converted to Customer',
  4 => 'Callback/Follow up',
  5 => 'Not Contactable - Ringing',
  6 => 'Not Contactable - Busy',
  7 => 'Not Contactable - Not Reachable/Temp Suspended',
  8 => 'Not Contactable - Wrong Number',
  9 => 'Not Contactable - Switched off',
  10 => 'Not Interested - In our Product/Services',
  11 => 'Not Interested - Financial Issues',
  12 => 'Not Interested - Lost to Competition',
  13 => 'Not Interested - Reason Unknown',
  14 => 'Not Eligible - Document Issue',
  15 => 'Not Eligible - Income Norms',
  16 => 'Not Eligible - Company Norms',
  17 => 'Not Eligible - Age Norms',
  18 => 'Not Eligible - CIBIL Norms',
  19 => 'Not Eligible - Others',
  20 => 'Non Service Location',
  21 => 'Not Contactable - Outbound Attempts Over',
  22 => 'Language Barrier',
  23 => 'Not Eligible - Salary credit in Cash/Cheque',
  24 => 'Not Eligible - ITR Norms',
  25 => 'Not Eligible - Job Stability ',
  26 => 'Not Eligible - EMI Bounce',
  27 => 'Not Eligible - Foir Norms',
  28 => 'Not Eligible - Non Salaried Profile',
  29 => 'Not Eligible - Residence Stability',
  30 => 'Not Eligible - Higher Loan Amount',
  31 => 'Not Eligible - Negative Profile',
  32 => 'Not Interested - High ROI',
  33 => 'Not Interested - No Requirement of Loan',
  34 => 'Follow up for Referrals',
  35 => 'Converted to Customer - For Satisfaction Survey',
  36 => 'Opportunity - Not Contactable',
  37 => 'Opportunity - Cibil Reject',
  38 => 'Opportunity - Over Leveraged',
  39 => 'Opportunity - Not Interested',
  40 => 'Opportunity - Income Norms',
  41 => 'Opportunity - Company Norms',
  42 => 'Opportunity - Document Issue',
  43 => 'Opportunity - Others',
);
$GLOBALS['app_list_strings']['disposition_list']=array (
  '' => '',
  'Customer interested in our products' => 'Customer interested in our products',
  'Under Migration Process' => 'Under Migration Process',
  'Callback/Follow up' => 'Callback/Follow up',
  'Not Contactable - Ringing' => 'Not Contactable - Ringing',
  'Not Contactable - Busy' => 'Not Contactable - Busy',
  'Not Contactable - Not Reachable/Temp Suspended' => 'Not Contactable - Not Reachable/Temp Suspended',
  'Not Contactable - Switched off' => 'Not Contactable - Switched off',
  'Prospect- Investor Ac Activated' => 'Prospect- Investor Ac Activated',
  'Hot Prospect- Initial Payment pending/NACH awaited' => 'Hot Prospect- Initial Payment pending/NACH awaited',
  'Opportunity - Sent to the Partner' => 'Opportunity - Sent to the Partner',
  'Opportunity - Not Contactable' => 'Opportunity - Not Contactable',
  'Opportunity - Cibil Reject' => 'Opportunity - Cibil Reject',
  'Opportunity - Over Leveraged' => 'Opportunity - Over Leveraged',
  'Opportunity - Not Interested' => 'Opportunity - Not Interested',
  'Opportunity - Income Norms' => 'Opportunity - Income Norms',
  'Opportunity - Company Norms' => 'Opportunity - Company Norms',
  'Opportunity - Document Issue' => 'Opportunity - Document Issue',
  'Opportunity - Others' => 'Opportunity - Others',
  'Opportunity - Login' => 'Opportunity - Login',
  'Converted to Customer' => 'Converted to Customer',
  'Not Contactable - Wrong Number' => 'Not Contactable - Wrong Number',
  'Not Contactable - Outbound Attempts Over' => 'Not Contactable - Outbound Attempts Over',
  'Not Interested - In our Product/Services' => 'Not Interested - In our Product/Services',
  'Not Interested - Financial Issues' => 'Not Interested - Financial Issues',
  'Not Interested - Lost to Competition' => 'Not Interested - Lost to Competition',
  'Not Interested - Reason Unknown' => 'Not Interested - Reason Unknown',
  'Not Eligible - Document Issue' => 'Not Eligible - Document Issue',
  'Not Eligible - Income Norms' => 'Not Eligible - Income Norms',
  'Not Eligible - Company Norms' => 'Not Eligible - Company Norms',
  'Not Eligible - Age Norms' => 'Not Eligible - Age Norms',
  'Not Eligible - CIBIL Norms' => 'Not Eligible - CIBIL Norms',
  'Not Eligible - Others' => 'Not Eligible - Others',
  'Non Service Location' => 'Non Service Location',
  'Language Barrier' => 'Language Barrier',
  'Not Eligible - Salary credit in Cash/Cheque' => 'Not Eligible - Salary credit in Cash/Cheque',
  'Not Eligible - ITR Norms' => 'Not Eligible - ITR Norms',
  'Not Eligible - Job Stability ' => 'Not Eligible - Job Stability ',
  'Not Eligible - EMI Bounce' => 'Not Eligible - EMI Bounce',
  'Not Eligible - Foir Norms' => 'Not Eligible - Foir Norms',
  'Not Eligible - Non Salaried Profile' => 'Not Eligible - Non Salaried Profile',
  'Not Eligible - Residence Stability' => 'Not Eligible - Residence Stability',
  'Not Eligible - Higher Loan Amount' => 'Not Eligible - Higher Loan Amount',
  'Not Eligible - Negative Profile' => 'Not Eligible - Negative Profile',
  'Not Interested - High ROI' => 'Not Interested - High ROI',
  'Not Interested - No Requirement of Loan' => 'Not Interested - No Requirement of Loan',
  'Follow up for Referrals' => 'Follow up for Referrals',
  'Converted to Customer - For Satisfaction Survey' => 'Converted to Customer - For Satisfaction Survey',
);

$GLOBALS['app_list_strings']['product_sub_type_Mutual_Funds_list']=array (
  '' => '',
  'FIT-SIP' => 'FIT-SIP',
  'Mutual Fund' => 'Mutual Fund',
  'Loan Genie' => 'Loan Genie',
  'Tax-Max' => 'Tax-Max',
  'Equity-ELSS' => 'Equity-ELSS',
  'Equity Oriented-Balanced Funds' => 'Equity Oriented-Balanced Funds',
  'Equity- Banks and Financial Services' => 'Equity- Banks and Financial Services',
  'Equity- Infrastructure' => 'Equity- Infrastructure',
  'Equity-Thematic' => 'Equity-Thematic',
  'Equity-Pharma' => 'Equity-Pharma',
  'Equity- Information Technology' => 'Equity- Information Technology',
  'Equity- FMCG' => 'Equity- FMCG',
  'Equity-Others' => 'Equity-Others',
  'Equity-Diversified' => 'Equity-Diversified',
  'Large Cap Funds' => 'Large Cap Funds',
  'Mid Cap Funds' => 'Mid Cap Funds',
  'Small Cap Funds' => 'Small Cap Funds',
  'Liquid Funds' => 'Liquid Funds',
  'Gold ETF' => 'Gold ETF',
  'Debt Long Term' => 'Debt Long Term',
  'Debt Short Term' => 'Debt Short Term',
  'Ultra Short Debt Term ' => 'Ultra Short Debt Term ',
  'Index Funds' => 'Index Funds',
  'Capital Protection Fund' => 'Capital Protection Fund',
  'Fund Of Funds- Equity Oriented' => 'Fund Of Funds- Equity Oriented',
  'Fund Of Funds-Debt Oriented' => 'Fund Of Funds-Debt Oriented',
  'Fund Of Funds- Hybrid Oriented' => 'Fund Of Funds- Hybrid Oriented',
  'Fund Of Funds- Commodity Oriented' => 'Fund Of Funds- Commodity Oriented',
  'Arbitrage Funds' => 'Arbitrage Funds',
  'SIP' => 'SIP',
);
$GLOBALS['app_list_strings']['marital_status_c_list']=array (
  'blank' => '',
  'Married' => 'Married',
  'Single' => 'Single',
);

$GLOBALS['app_list_strings']['marital_status_c_0']=array (
  'blank' => '',
  'Married' => 'Married',
  'Single' => 'Single',
);

$GLOBALS['app_list_strings']['marital_status_c_1']=array (
  'blank' => '',
  'Married' => 'Married',
  'Single' => 'Single',
);

$GLOBALS['app_list_strings']['status_c_list']=array (
  'blank' => '',
  'Eligible' => 'Eligible',
  'Rejected' => 'Rejected',
);
$GLOBALS['app_list_strings']['product_interest_list']=array (
  '' => '',
  'Loans' => 'Loans',
  'Mutual Funds' => 'Mutual Funds',
  'Equity' => 'Equity',
  'Insurance' => 'Insurance',
  'Fixed Deposits' => 'Fixed Deposits',
  'Gold' => 'Gold',
  'Credit Card' => 'Credit Card',
  'Bonds' => 'Bonds',
  'Debentures' => 'Debentures',
  'Goals' => 'Goals',
);