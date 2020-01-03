<?php

if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class scrm_Escalation_MatrixViewDetail extends ViewDetail {   
function scrm_Escalation_MatrixViewDetail() {
 		parent::ViewDetail();
 	}

    public function display() {

		//$id = $_REQUEST['record'];
         $js1 = <<<YUO
	<script>
	//var j=0,k=0;
	$(document).ready(function(){
		var escalationlevel = $('#escalation_level_c').val();
		//alert(escalationlevel);
		if(escalationlevel.indexOf('Level1') != -1){
			
			$('#detailpanel_2').show();
		}
		else{
			$('#detailpanel_2').hide();
		}
		if(escalationlevel.indexOf('Level2') != -1){
			
			$('#detailpanel_3').show();
		}
		else{
			$('#detailpanel_3').hide();
		}
		if(escalationlevel.indexOf('Level3') != -1){
			
			$('#detailpanel_4').show();
		}
		else{
			$('#detailpanel_4').hide();
		}
		if(escalationlevel.indexOf('Level4') != -1){
			
			$('#detailpanel_5').show();
		}
		else{
			$('#detailpanel_5').hide();
		}
});
	</script>
YUO;
echo $js1;
parent::display();
	}
}
