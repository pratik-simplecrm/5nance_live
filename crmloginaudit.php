<?php
ini_set('display_errors', 1);
if (!define('sugarEntry'))
    define('sugarEntry', true);
require_once('include/entryPoint.php');
include_once('include/SugarPHPMailer.php');
include_once('include/utils/db_utils.php');
include('custom/include/language/en_us.lang.php');
include('include/language/en_us.lang.php');
	require_once('config.php');
//if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
 
if(file_exists('include/tcpdf/config/lang/eng.php')) {
	include_once('include/tcpdf/config/lang/eng.php'); 
} else {
	die('TCPDF lang not found');
}
if(file_exists('include/tcpdf/config/tcpdf_config.php')) {
	include_once('include/tcpdf/config/tcpdf_config.php');
} else {
	die('TCPDF config not found');
}
if(file_exists('include/tcpdf/tcpdf.php')) {
	include_once('include/tcpdf/tcpdf.php');
} else {
	die('TCPDF not found');
}


//pdf for crmaudit
class CRMAudit extends TCPDF {
	protected $from_date;
	protected $to_date;

    //~ public function Header() {
		//~ // Logo
		//~ $image_file = 'include/tcpdf/images/tcpdf_logo.gif';
		//~ $this->Image($image_file, 10, 1, 190, 'B', 'GIF', '', 'T', false, 300, '', false, false, 0, false, false, false);
	//~ }
	
	public function printPdf($from_date,$to_date) {
        // global $db;
		global $current_user,$app_list_strings,$sugar_config;

       
        $db = DBManagerFactory::getInstance();
		// create new PDF document
		$pdf = new CRMAudit(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Noresha Ankani');
		$pdf->SetTitle('PDF');
		$pdf->SetSubject('PDF');
		$pdf->SetKeywords('TCPDF, PDF, PDF, custom PDF');
		$pdf->SetFont('helvetica', '', 8, '', true);
		$pdf->SetHeaderData(PDF_HEADER_LOGO, 50,'','');
			// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		//set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetFooterMargin(10);
		
		//set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		//set image scale factor
		//~ $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		
		// Add a page
		$pdf->AddPage();

		//~ $pdf->setPrintHeader(false);
        $from_date = $from_date;
        $to_date = $to_date;
        $currentDate = intval(date('d',strtotime($to_date)));
        //echo $currentDate;exit;
        if($currentDate <= 7)
        {
			$from_date= date('Y-m-d', strtotime('first day of previous month'));
			$to_date= date('Y-m-d');
		}
        $module_list = $GLOBALS['moduleList'];
        $module_list = array("Contacts","Cases","Calls","Meetings");
        $module_list_lower = array_map('strtolower', $module_list);

        $loggedinquery="SELECT date(date_entered) as Logged_In_Date,count(users_sugar_id_c) as Unique_Users
                FROM  scrm_login_audit join scrm_login_audit_cstm on id=id_c where date(date_entered) BETWEEN '$from_date' and '$to_date' and deleted=0 
                group by date_entered";
        $query=$db->query($loggedinquery);
        while($row=$db->fetchByAssoc($query)){
            $data['loggedin'][$row['Logged_In_Date']] = $row['Unique_Users'];
        }

       	foreach ($module_list_lower as $module) {
       		$recordCreatedQuery="SELECT COUNT( m.id ) AS count, DATE( m.date_entered ) AS Date_Entered
                    FROM $module m
                    WHERE m.deleted =0 and date(m.date_entered) BETWEEN '$from_date' and '$to_date' 
                    GROUP BY DATE( m.date_entered ) ";
	        $query=$db->query($recordCreatedQuery);
	        while($row=$db->fetchByAssoc($query)){
	            $data[$module][$row['Date_Entered']] = $row['count'];
	        }
       	}
       
        // $module_list = array_intersect($GLOBALS['moduleList'],array_keys($GLOBALS['beanList']));
       

        $begin = new DateTime( $from_date);
        $end = new DateTime( $to_date );

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);
        $csvHeader = '';
        $header = '<tr><th align="center">Date</th>
            <th align="center"># of Unique Logins</th>';
        $csvHeader .= '"Date","# of Unique Logins",';
        foreach ($module_list as $module) {
            $header .= '<th align="center"># of New '.ucwords($app_list_strings["moduleList"][$module]).'</th>';
            $csvHeader .= '"# of New ' . ucwords($app_list_strings["moduleList"][$module]). '",';
        }
        $header .= '</tr>';
        $csvHeader .= "\n";
       
        $csvRow ='';
        foreach ( $period as $dt )
        {
            $date = $dt->format( "Y-m-d" );
            $tableRow .='<tr>';
            $tableRow .='<td align="center">'.$dt->format( "dS F Y (l)" ).'</td>';
            $csvRow .= '"' . $dt->format( "dS F Y (l)" ) . '",';
            $tableRow .='<td align="center">'.(!empty($data['loggedin'][$date]) ? $data['loggedin'][$date] : '0') .'</td>';
            $csvRow .= '"' . (!empty($data['loggedin'][$date]) ? $data['loggedin'][$date] : '0') . '",';
            foreach ($module_list_lower as $module) {
            	$tableRow .='<td align="center">'.(!empty($data[$module][$date]) ? $data[$module][$date] : '0') .'</td>';
            	$csvRow .= '"' . (!empty($data[$module][$date]) ? $data[$module][$date] : '0') . '",';
            }
            $tableRow .='</tr>'; 
            $csvRow .= "\n";
        }
//echo $tableRow;exit();
    ob_clean();
 //    header('Content-type: application/csv');
	// header('Content-Disposition: attachment; filename=crmaudit.csv');
	$csv = $csvHeader . $csvRow;
	file_put_contents("crmaudit.csv", $csv, LOCK_EX);
    $html =<<<HTML
        <!DOCTYPE html>
        <html>
        <head>

            
        </head>

        <body>
            <div style="padding-top:40px">
                <section>
                    

                    <table id="example" class="display" border="1" cellspacing="0" width="100%">
                            $header

                        <tbody>
                    $tableRow
                        </tbody>
                    </table>

                    
                        </div>

                    </div>
                </section>
            </div>

        </body>
       
        </html>
            
HTML;

		$pdf->writeHTML($html, true, false, false, false, '');
		ob_clean();		 	
        $pdf->Output('crmaudit.pdf', 'F');
		//$pdf->Output('crmaudit.pdf', 'I');
		
		$emails = array('noresha@simplecrm.com.sg','aniket@simplecrm.com.sg');
		foreach($emails as $email){
			$this->sendEmail($email,$from_date,$to_date);
		}
		
		
	}
	
	
	
	
	public function sendEmail($email,$from_date,$to_date){
		
		global $current_user;
		//~ echo 'hi';exit;
		//echo $current_user->email1;exit;
		require_once('modules/Emails/Email.php');
		require_once('include/SugarPHPMailer.php');
		include_once('include/utils/db_utils.php'); 
		$emailObj = new Email();
		$mail = new SugarPHPMailer();
		$mail->setMailerForSystem();
		// $mail->From = $current_user->email1;
		// $mail->FromName = $current_user->full_name;
		$mail->From = 'noresha@simplecrm.com.sg';
		$mail->FromName = '5nance CRM';
		$mail->Subject = 'CRM Audit';
		$mail->Body = 'Hi,<br><br> Please find the attached crm audit from '.$from_date.' to '.$to_date;
		//$mail->Body = 'Hi,<br><br> Please find the attached crm audit';
		$mail->isHTML(true);
		//$mail->prepForOutbound();
		$mail->AddAddress($email);
		$mail->AddAttachment('crmaudit.pdf', 'crmaudit.pdf', 'base64', 'application/pdf');
		$mail->AddAttachment('crmaudit.csv', 'crmaudit.csv', 'base64', 'application/csv');
		// Prepare for sending
		//$mail->prepForOutbound();
		//$mail->setMailerForSystem();

		$mail->Send();
	}
	


	
}
$from_date = isset($_REQUEST['from_date']) ? $_REQUEST['from_date'] : date('Y-m-')."01";
$to_date = isset($_REQUEST['to_date']) ? $_REQUEST['to_date'] : date('Y-m-d');
$pdf = new CRMAudit();
$pdf->printPdf($from_date,$to_date);
?>