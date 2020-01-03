<?php

if(!define('sugarEntry')) define('sugarEntry', true);
require_once('include/entryPoint.php');


//$request_headers[] = 'Authorization:Crypto cxZEBsIOiyXi8fOi8MJZ/mNyLZf67V2CQLvG2McCei2f+X87ft7KquuxJPywhCzH';
$request_headers[] = 'Authorization:Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI';


//~ $URL = "http://192.168.1.8:9001/api/lookup/GetState";
//~ $ch = curl_init();
//~ curl_setopt($ch, CURLOPT_URL, $URL);
//~ curl_setopt($ch, CURLOPT_GET, 0);
//~ curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
//~ curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//~ $output = curl_exec($ch);
//~ echo '<pre>';
//~ print_r($output);
//~
//~ if($errno = curl_errno($ch)) {
    //~ $error_message = curl_strerror($errno);
    //~ echo "cURL error ({$errno}):\n {$error_message}";
//~ }
//~
//~ exit;
	//~ curl_close($ch);
echo $js=<<<eof
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
$.ajax({
type: "GET",
//url: "http://122.169.109.21:9001/api/lookup/LookupPostalCode",  
//url: "http://122.169.109.21:9001/api/lookup/GetState",  
//url: "http://122.169.109.21:9001/getuserdataforcrm",  
url: "https://api.5nance.com/getuserdataforcrm",  
//url: "http://122.169.109.21:9001/GetAllCity",  
//url: "http://122.169.109.21:9001/getactiveusers",  
//url: "http://192.168.1.8:9001/getuserdataforcrm",
beforeSend: function(jqXHR){
jqXHR.setRequestHeader("Authorization", "Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI");
},
 crossDomain: true,
success: function (suc){
	var result = suc.data;
	
	document.write(result);
	
		$.ajax({
						url: 'UserData.php',
						async: false,
						type: 'POST',
						data: result,
						success: function( result ){

							console.log(result);
						}
					});
	
	//~ Object.keys(data).forEach(function(key) {
    //~ console.log(key, data[key]);
//~ });
	
//~ console.log(suc);
},
error: function(error){
console.log(error);
},
});
});
</script>
eof;


//~ echo $js=<<<eof
//~ <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
//~ <script type="text/javascript">
//~ 
//~ $(document).ready(function(){
//~ $.ajax({
//~ type: "GET",
//~ url: "http://122.169.109.21:9001/GetAllCity",  
//~ //url: "http://192.168.1.8:9001/getuserdataforcrm",
//~ beforeSend: function(jqXHR){
//~ jqXHR.setRequestHeader("Authorization", "Crypto cxZEBsIOiyXi8fOi8MJZ/mNyLZf67V2CQLvG2McCei2f+X87ft7KquuxJPywhCzH");
//~ },
 //~ crossDomain: true,
//~ success: function (suc){
	//~ 
	//~ data = suc['data'][0];
	//~ document.write(JSON.stringify(data));
	//~ 
	
	//~ 
//~ console.log(suc);
//~ },
//~ error: function(error){
//~ console.log(error);
//~ },
//~ });
//~ });
//~ </script>
//~ eof;
