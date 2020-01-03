<?php
if (!define('sugarEntry'))
    define('sugarEntry', true);
require_once('include/entryPoint.php');
echo "hi";
echo $js=<<<dropdown
		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				 $.ajax({
					type:"get",
					//url: "http://122.169.109.21:9001/api/lookup/GetState",
					url: "http://122.169.109.21:9001/GetAllCity",
				//url: "http://122.169.109.21:9001/api/lookup/LookupPostalCode",
					beforeSend: function(jqXHR) {
						jqXHR.setRequestHeader("Authorization", "Crypto cxZEBsIOiyXi8fOi8MJZ/mNyLZf67V2CQLvG2McCei2f+X87ft7KquuxJPywhCzH");
					},
					success: function(suc) {
						var result = suc.data;	
						jsondata = new Array();						
						   $.each(result, function(index, el) { 
							   	//document.write("'" + el.id + "' => '" + el.name + "',"+"<br/>");						
							  	document.write("'" + el.stateID + "_" +el.cityID + "_" + el.id + "' => '" + el.postalCode + "',"+"<br/>");						
							//   	document.write("'" + el.stateID + "_" + el.id + "' => '" + el.name + "',"+"<br/>");						
								
							});
							JSON.stringify(jsondata);
							//console.log(print_r(jsondata));
						
						$.ajax({
						url: 'UserData.php',
						async: false,
						type: 'POST',
						data: jsondata,
						success: function( result ){

							console.log(result);
						}
					});
					},
					error: function (error) {
					},
				});
			});
		</script>
dropdown;
?>
