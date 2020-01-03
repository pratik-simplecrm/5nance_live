 <?php
 if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
		$mobile = $_REQUEST['mobile'];
		$email = $_REQUEST['email'];
		$name = $_REQUEST['name'];

		global $sugar_config;

		$url= $sugar_config['authentication'];
		$url= $url.'?name='.$email;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization:Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI',
												'Content-Type: application/json',
												'Content-Length: ' . strlen($postData)));
		$result = curl_exec($ch);
		curl_close($ch);
		$checkexituser = json_decode($result, true);
		
		if($checkexituser['valid']==1){
			/***************send otp**********************/
			$url= $sugar_config['mobileotp'];
			$url= $url.'?mobilenumber='.$mobile;
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch,CURLOPT_HTTPHEADER, array('Authorization:Crypto 4IilG3pP+ESLwADK0b4TboG2Okn54Fixu4dW9P7ayHpUSXgNHpz11CdZP5qXK0XI',
													'Content-Type: application/json',
													'Content-Length: ' . strlen($postData)));
			$result = curl_exec($ch);
			curl_close($ch);
			$getotpresult = json_decode($result, true);
			print_r($getotpresult['data']);
			//echo '<pre>';print_r($getotpresult);exit;
			/*******encoded otp*****************/
			//echo $getoptresult['data'];
		}else{
			echo 'no data';
		}
