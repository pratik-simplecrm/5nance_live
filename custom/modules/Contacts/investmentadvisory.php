<?php
$investmentPeriod = $_REQUEST['investment_period'];
$investmentTye = $_REQUEST['investment_type'];
$investmentAmount = $_REQUEST['investment_amount'];
$RiskProfileID = $_REQUEST['risk_profile_id'];
switch ($investmentPeriod) {
	case 1:
		$period = 'TenureFrom=0&TenureTo=1';
		break;
	case 2:
		$period = 'TenureFrom=1&TenureTo=3';
		break;
	case 3:
		$period = 'TenureFrom=3&TenureTo=8';
		break;
	case 4:
		$period = 'TenureFrom=8&TenureTo=99';
		break;	
	default:
		$period = '';
		break;
}
switch ($investmentTye) {
	case 'SIP':
		$type = 'IsSIP=true';
		break;
	case 'LUMPSUM':
		$type = 'IsSIP=false';
		break;
	default:
		$type = '';
		break;
}

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.5nance.com/api/IdealPortfolio/GetIdealPortfolioProductDetails?RiskProfileID=".$RiskProfileID."&InvestmentAmount=".$investmentAmount."&".$period."&".$type,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "authorization: Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI",
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}