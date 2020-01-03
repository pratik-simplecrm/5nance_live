<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('modules/Contacts/views/view.detail.php');

class CustomContactsViewDetail extends ContactsViewDetail{
    public function display(){

        global $sugar_config;

        $aop_portal_enabled = !empty($sugar_config['aop']['enable_portal']) && !empty($sugar_config['aop']['enable_aop']);

        $this->ss->assign("AOP_PORTAL_ENABLED", $aop_portal_enabled);

        require_once('modules/AOS_PDF_Templates/formLetter.php');
        formLetter::DVPopupHtml('Contacts');
        
        /**********hiding subpanels*****************/
        echo $subpanel=<<<hiding_subpanel
        	<script>
        		$(document).ready(function(){
        			$('#whole_subpanel_cases').hide();
        			$('#whole_subpanel_contacts').hide();
        		});
        	</script>
hiding_subpanel;
        //~ echo $dependency=<<<dependency
	//~ <script>
		//~ $(document).ready(function(){
			//~ var structure_of_family = $('#structure_of_family_c').val();
			//~ if(structure_of_family == 'Adults'){
				//~ $('#no_of_adults_c').parent().parent().show();
				//~ $('#no_of_children_c').parent().parent().hide();
			//~ }else if(structure_of_family == 'Children'){
				//~ $('#no_of_adults_c').parent().parent().hide();
				//~ $('#no_of_children_c').parent().parent().show();
			//~ }else{
				//~ $('#no_of_adults_c').parent().parent().hide();
				//~ $('#no_of_children_c').parent().parent().hide();
			//~ }
		//~ });
	//~ </script>
//~ dependency;

// Twitter integration start

    $date_closed = date('Y-m-d', strtotime(' +30 day')); // current_date + 30 days
    global $sugar_config; global $db;
    $site_url = $sugar_config['site_url'];
    $id = $this->bean->id;
    $twitter_handle = $this->bean->twitter_handle_c;

$js1 = <<<BOC
<div id="imageLoading"></div>
<script src='cache/include/javascript/sugar_grp_yui_widgets.js'></script>
        <script type="text/javascript">
                
                $(document).ready(function() {

                var twitter_handle = '$twitter_handle';
                //Adding twitter icon, if twitter handle is present
        if(twitter_handle){     
$('#twitter_handle_c').append('<img id="contact_twitter_handle" width="20" height="15" src="custom/include/images/twitter_logo.png" >');
         }

        $('#contact_twitter_handle').on('click',function(){
            
        $('#myPopupStyle').remove();
        $('head').append('<link id="myPopupStyle" rel="stylesheet" type="text/css" href="custom/include/bootstrap/style.css" />');

$('#imageLoading').css('display','block'); 

var twitter_handle = '$twitter_handle';
var module='Contacts'; 
var action='get_tweets';
var to_pdf='true';  

if(twitter_handle){


$.ajax({

type: "GET", 
async: false,
url: "index.php",
data: 
{   
module:module,
action:action,
to_pdf:to_pdf,
twitter_handle:twitter_handle,
},//parameters
    
success: function(response)
{
//$('#imageLoading').css('display','none'); .fadeOut("slo
$('#imageLoading').fadeOut("slow");
objData  = jQuery.parseJSON(response);

twitter_data                =   objData.twitter_data;
got_twitter_data            =   objData.got_twitter_data;
result_count                =   objData.result_count;
twitter_display_name        =   objData.twitter_display_name;
twitter_profile_picture_url =   objData.twitter_profile_image_url;
       
if(got_twitter_data =='yes'){

var data = '<div style="width:100%;"><div id="favourites" class="tab-pane fade in active"><table style="margin-top:5px;" class="table table-bordered listViewEntriesTable"><thead><tr class="listViewHeaders"><th class="narrowWidthType" style="text-align:left;padding-left:2px;" >Published On</th><th class="narrowWidthType" style="text-align:left;padding-left:30px;">Message</th><th class="narrowWidthType" style="padding-left:30px;">Retweets</th><th class="narrowWidthType" style="padding-left:40px;">Favourites</th><th class="narrowWidthType" style="padding-right:35px;"><span>Actions</span></th><th></th></tr></thead><tbody class="listViewTableContents">'+twitter_data+'<tr class="listViewEntries mm_normal mm_clickable loadmore" data-maxid="m625691784786481151"><td></td><td></td><td></td><td><center><span class="more"></span></center></td><td></td><td></td></tr></tbody></table></div></div>';

YAHOO.SUGAR.MessageBox.show({msg: data, title: '<span style="padding-left:30px;"><a href="https://twitter.com/$twitter_handle" target="_blank" title="'+twitter_display_name+'"><img width="40" height="40" src="'+twitter_profile_picture_url+'"></a> <font color="#E2264D"> '+twitter_display_name+' </font> </span><span style="padding-left:30%;"><font color="#008080">Recent Tweets</font></span><img width="20" height="15" src="custom/include/images/twitter_logo.png" style="padding-left:5px;padding-bottom:4px;" id="contact_twitter_handle_popup"><input type="button" onclick="YAHOO.SUGAR.MessageBox.hide()" style="padding-left:10px;padding-right:10px;margin-left:42%;" value="X">', 
 
});

$('.container-close').hide();

$('.actions_dd').on('change', function() {

//var option_id = $(this).children(":selected").attr("id");
  var selector_id = $(this).attr("id");
 
var split           = selector_id.split('_');
var pattern         = split[0];
var res_array_count = split[1];
var hidu_data = $('#hids_'+res_array_count).val();
var split_hidu_data = hidu_data.split('abcd0123dcba');
var tweet                      = split_hidu_data[0];
var tweet                      = tweet.replace('<br/>',' ');
var status_id                  = split_hidu_data[1];
var published_date             = split_hidu_data[2];
var page_or_user_dispaly_name  = split_hidu_data[3];
var page_or_user_screen_name   = split_hidu_data[4];
var image_url                  = split_hidu_data[5];

var page_or_user_dispaly_name_split = page_or_user_dispaly_name.split(' ');
var page_or_user_dispaly_name_split1 = page_or_user_dispaly_name_split[0];
var page_or_user_dispaly_name_split2 = page_or_user_dispaly_name_split[1];
first_namee = page_or_user_dispaly_name_split1;
last_namee  = page_or_user_dispaly_name_split2;

if (page_or_user_dispaly_name_split2 == undefined || page_or_user_dispaly_name_split2 == null) {
first_namee = '';
last_namee  = page_or_user_dispaly_name_split1;
}

var desc = 'Tweet : '+tweet+', Tweeted by : '+page_or_user_dispaly_name+', Tweeted on : '+published_date+', Link to tweet : https://twitter.com/string/status/'+status_id;

var case_desc = '<p>Tweet : '+tweet+' </p><p>Tweeted by : '+page_or_user_dispaly_name+'</p><p>Tweeted on : '+published_date+'</p><p>Link to tweet : <a href="https://twitter.com/string/status/'+status_id+'" target="_blank">Tweet</a></p>';

var tweet                      = split_hidu_data[0];
var tweet                      = tweet.replace('<br/>',' ');
var status_id                  = split_hidu_data[1];
var published_date             = split_hidu_data[2];
var page_or_user_dispaly_name  = split_hidu_data[3];
var page_or_user_screen_name   = split_hidu_data[4];
var image_url                  = split_hidu_data[5];

var module_type = this.value;


if(module_type == 'Add Contact' ){

$('#imageLoading').css('display','block'); 

var module_name = 'Contacts';
var module =  module_name; 
var action = 'create_records';
var to_pdf = 'true';  
var first_name = first_namee;
var last_name  = last_namee;
var twitter_handle_c   = page_or_user_screen_name;
var lead_source        = "Twitter";
var description        = desc;
var status_id          = status_id;
var email              = "";
var salutation         = "";
var account_id         = "31a03ef8-38aa-4eb8-b538-55d6acffda3f"; 

$.ajax({
        type: "GET", 
        async: false,
        url: "index.php",
        data: 
        {   
               module:module,
               action:action,
               to_pdf:to_pdf,
               first_name:first_name,
               last_name:last_name,
               twitter_handle_c:twitter_handle_c,
               lead_source:lead_source,
               description:description,
                       status_id:status_id,
                       account_id:account_id,
              
        },//parameters  
            success: function(response)
            {

                    $('#imageLoading').fadeOut("slow"); 
                        $('.span_notification').remove();
            objData     = jQuery.parseJSON(response);
                        var rec_id  =   objData.id_c;
                        var created =   objData.created;

                        //alert(created);

                        var site_url = '$site_url';
                        var span_notify_id = 'notify_'+res_array_count;
                        var link_to_created_record = site_url+'/index.php?module='+module_name+'&action=DetailView&record='+rec_id;

if(created == 'y'){
$('#msg_'+res_array_count).append('<span id="'+span_notify_id+'" class="span_notification"  style="color:blue;padding-left:10px;"><b><a target="_blank" href="'+link_to_created_record+'" >Contact</a></b> created</span>');
}
if(created == 'n'){
$('#msg_'+res_array_count).append('<span id="'+span_notify_id+'" class="span_notification"  style="color:blue;padding-left:10px;"><b><a target="_blank" href="'+link_to_created_record+'" >Contact</a></b> Exists</span>');
}
                        }

});


// to clear selected value of dd
$(".actions_dd option:selected").removeAttr("selected");
}

if(module_type == 'Add Lead' ){
var module_name = 'Leads';
$('#imageLoading').css('display','block'); 
var module =  module_name; 
var action = 'create_records';
var to_pdf = 'true';  
var first_name = first_namee;
var last_name  = last_namee;
var twitter_handle_c   = page_or_user_screen_name;
var lead_source        = "Twitter";
var description        = desc;
var lead_status        = "New"; 
var status_id          = status_id;
$.ajax({
        type: "GET", 
        async: false,
        url: "index.php",
        data: 
        {   
               module:module,
               action:action,
               to_pdf:to_pdf,
               first_name:first_name,
               last_name:last_name,
               twitter_handle_c:twitter_handle_c,
               lead_source:lead_source,
               description:description,
               lead_status:lead_status,
                       status_id:status_id,
              

        },//parameters  
            success: function(response)
            {

                    $('#imageLoading').fadeOut("slow"); 
                        $('.span_notification').remove();
            objData     = jQuery.parseJSON(response);
                        var rec_id  =   objData.id_c;
                        var created =   objData.created;
                        var site_url = '$site_url';
                        var span_notify_id = 'notify_'+res_array_count;
                        var link_to_created_record = site_url+'/index.php?module='+module_name+'&action=DetailView&record='+rec_id;

if(created == 'y'){
$('#msg_'+res_array_count).append('<span id="'+span_notify_id+'" class="span_notification"  style="color:blue;padding-left:10px;"><b><a target="_blank" href="'+link_to_created_record+'" >Lead</a></b> created</span>');
}
if(created == 'n'){
$('#msg_'+res_array_count).append('<span id="'+span_notify_id+'" class="span_notification"  style="color:blue;padding-left:10px;"><b><a target="_blank" href="'+link_to_created_record+'" >Lead</a></b> Exists</span>');
}
                        }

});

// to clear selected value of dd
$(".actions_dd option:selected").removeAttr("selected");

}



if(module_type == 'Add Case' ){
var module_name = 'Cases';

$('#imageLoading').css('display','block'); 

var module =  module_name; 
var action = 'create_records';
var to_pdf = 'true'; 
var status_id          = status_id;
var twitter_handle_c   = page_or_user_screen_name;
var case_name          = 'Twitter : '+tweet;
var description        = case_desc; 
var priority           = "P2";      
var case_status        = "New";
var account_id         = "31a03ef8-38aa-4eb8-b538-55d6acffda3f";  

$.ajax({
        type: "GET", 
        async: false,
        url: "index.php",
        data: 
        {   
               module:module,
               action:action,
               to_pdf:to_pdf,
               twitter_handle_c:twitter_handle_c,
               description:description,
                       status_id:status_id,
               case_name:case_name,
               priority:priority,
               case_status:case_status,
               account_id:account_id,
              

        },//parameters  
            success: function(response)
            {

                    $('#imageLoading').fadeOut("slow");
                        $('.span_notification').remove();   
            objData     = jQuery.parseJSON(response);
                        var rec_id  =   objData.id_c;
                        var created =   objData.created;
                        var site_url = '$site_url';
                        var span_notify_id = 'notify_'+res_array_count;
                        var link_to_created_record = site_url+'/index.php?module='+module_name+'&action=DetailView&record='+rec_id;

if(created == 'y'){
$('#msg_'+res_array_count).append('<span id="'+span_notify_id+'" class="span_notification"  style="color:blue;padding-left:10px;"><b><a target="_blank" href="'+link_to_created_record+'" >Case</a></b> created</span>');
}
if(created == 'n'){
$('#msg_'+res_array_count).append('<span id="'+span_notify_id+'" class="span_notification"  style="color:blue;padding-left:10px;"><b><a target="_blank" href="'+link_to_created_record+'" >Case</a></b> Exists</span>');
}

                        }

});

// to clear selected value of dd
$(".actions_dd option:selected").removeAttr("selected");
}


if(module_type == 'Add Opportunity' ){

var module_name = 'Opportunities';

$('#imageLoading').css('display','block'); 

var module             =  module_name; 
var action             = 'create_records';
var to_pdf             = 'true'; 
var status_id          = status_id;
var twitter_handle_c   = page_or_user_screen_name;
var opportunity_name   = 'Twitter : '+tweet;
var description        = desc;      
var sales_stage        = "Prospecting"; 
var account_id         = "31a03ef8-38aa-4eb8-b538-55d6acffda3f"; 
var lead_source        = "Twitter"; 
var opportunity_type   = "New Business"; 
var amount             = "1000000";
var probability        = "30";
var date_closed        = "$date_closed";

$.ajax({
        type: "GET", 
        async: false,
        url: "index.php",
        data: 
        {   
               module:module,
               action:action,
               to_pdf:to_pdf,
               twitter_handle_c:twitter_handle_c,
               description:description,
                       status_id:status_id,
               account_id:account_id,
               opportunity_name:opportunity_name,
               sales_stage:sales_stage,
               lead_source:lead_source,
               opportunity_type:opportunity_type,
               amount:amount,
               probability:probability,
               date_closed:date_closed,

              

        },//parameters  
            success: function(response)
            {

                    $('#imageLoading').fadeOut("slow");
                        $('.span_notification').remove();   
            objData     = jQuery.parseJSON(response);
                        var rec_id  =   objData.id_c;
                        var created =   objData.created;
                        var site_url = '$site_url';
                        var span_notify_id = 'notify_'+res_array_count;
                        var link_to_created_record = site_url+'/index.php?module='+module_name+'&action=DetailView&record='+rec_id;

if(created == 'y'){
$('#msg_'+res_array_count).append('<span id="'+span_notify_id+'" class="span_notification"  style="color:blue;padding-left:10px;"><b><a target="_blank" href="'+link_to_created_record+'" >Opportunity</a></b> created</span>');
}
if(created == 'n'){
$('#msg_'+res_array_count).append('<span id="'+span_notify_id+'" class="span_notification"  style="color:blue;padding-left:10px;"><b><a target="_blank" href="'+link_to_created_record+'" >Opportunity</a></b> Exists</span>');
}

                        }

});

// to clear selected value of dd
$(".actions_dd option:selected").removeAttr("selected");
}


});   // on-change of action dd


}     // if = yes condition


if(got_twitter_data !='yes'){

YAHOO.SUGAR.MessageBox.show({msg: '<span style="color:red;">Error while connecting with Twitter</span>', title: '<span style="padding-left:5px;"><font color="#008080">Recent Tweets</font></span><a target="_blank" href="https://twitter.com/$twitter_handle"><img width="20" height="15" id="contact_twitter_handle_popup" style="padding-left:5px;padding-bottom:4px;" src="custom/include/images/twitter_logo.png"></a>', 
 
});

} // if != yes condition


}    // main ajax call success

}); // main ajax call

}  // if close

}); // on-click twitter image

}); //main close

function closePopup()
 {

    alert('close');
    //YAHOO.SUGAR.MessageBox.hide();

 }

        </script>
BOC;
          
echo $js1;
        
        // on click contact_twitter_handle
        // {echo $js1;}
        
        
        
//Twitter integration end


 /************sending sms*************************/
        global $mod_strings, $sugar_config,$current_user;
        global $db;
         
        $record_id = $this->bean->id;
        $baseUrl   = $sugar_config['site_url'] . '/index.php';
    
        // Send SMS - start
 
        $id         = $this->bean->id;
        $mobile     = $this->bean->phone_mobile;
        $customer_name = $this->bean->first_name.' '.$this->bean->middle_name_c.' '.$this->bean->last_name;
        $full_name = $customer_name;
        $agent_name = $current_user->first_name.' '.$current_user->last_name;
        $d = $this->view_object_map['d'];
        if($d=='2'){
            echo 'correct';
        }
 
        global $sugar_config;
        global $db;
 
        $query1="SELECT * FROM scrm_sms_template WHERE deleted=0";
        $result1 = $db->query($query1);
        $data1 = array();
        $a = 1;
 
        while($row1 = $db->fetchByAssoc($result1)){
            $data1[$a]['id'] = $row1['id'];
            $data1[$a]['name'] = $row1['name'];
            $data1[$a]['description'] = $row1['description'];
                    $a++;           
        }
 
        $res_count = count($data1);
 
        for($i=1;$i<=$res_count;$i++){
            $d= $data1[$i][name];
        }
 
        $val1 = $data1[1][name];
        foreach($data1 as $dddd){
            $n = $dddd[name];
            $ro .= '<option value="'.$n.'">'.$n.'</option>';
        }
 
        echo $send_sms_detail_view = <<<POU
    <!--    <div id="dialog" title="Dialog Title"><span style="color:green; font-size:15px;"></span></div>-->
        <script src='cache/include/javascript/sugar_grp_yui_widgets.js'></script>
        <script type="text/javascript">
        $(document).ready(function(){
 
 
            var mob = '$mobile';
            if(mob){
                // If mobile number exist add mobile icon
                $('td[field="phone_mobile"]').prepend('&nbsp;<img src=\"custom/include/images/mob3.png\" style=\" width:10px;height:17px;\" ></img>&nbsp;');
            }
                   
            var popup_data = '<div style="width:200px;padding-left:10px;"><br><input type="text" value="$mobile"  id="mobile" name="mobile" placeholder="Mobile No" style="width:100%;font-family: Helvetica, Arial, sans-serif; background:#FFFFEB;"><br><br><select style="width:100%; background:#FFFFEB;" id="sms_temp" name="sms_temp"><option selected="selected"  value="">Select SMS Template</option>$ro</select><br><br><textarea  rows="5" name="mob" id="mob"  style="width:100%;font-family: Helvetica, Arial, sans-serif; background:#FFFFEB;"></textarea><input type="button" value="Send" id="send_sms" style="font-family: Helvetica, Arial, sans-serif;background:green;color:white;margin-left:0%;margin-top:5%;margin-bottom:-5%;"><input type="button" value="Cancel" id="cancel_sms_send" style="font-family: Helvetica, Arial, sans-serif;background:#FF3535;color:white;margin-left:2%;margin-top:5%;margin-bottom:-5%;" onclick="YAHOO.SUGAR.MessageBox.hide();"></div>';
 
 
            $('td[field="phone_mobile"]').on('click',function(){

                $('#myPopupStyle').remove();
 
                $('#message_ackn').remove();
                $('#message_ackn_no').remove();     
 
                YAHOO.SUGAR.MessageBox.show({msg: popup_data, title: '<span style="padding-left:06%;"><font color="#ffffff">Send SMS</font></span>', });
 
 
                $('#sms_temp').on('change',function(){ 
                     
                    var drop_down_value = $(this).val();
                    var customer = '$customer_name';
                    var agent = '$agent_name';
                    if(drop_down_value!=''){
 
                        var module='Contacts'; 
                        var action='addTemplate';
                        var to_pdf='true';
 
                        $.ajax({
 
                            type: "GET", 
                            async: false,
                            url: "index.php",
                            data: 
                            {   
                            module:module,
                            action:action,
                            to_pdf:to_pdf,
                            drop_down_value:drop_down_value,
                            customer:customer,
                            agent: agent,
                            
                            },//parameters  
 
                            success: function(response)
                            {
                                //alert(response);
                            objData  = jQuery.parseJSON(response);
                            description     =       objData.description;
                            $('#mob').val(description).attr('readOnly', 'readOnly');
                            }
 
                        });
 
                    }
                    if(drop_down_value==''){
                    $('#mob').val('');
                    }
 
                });
 
                var dv = $('#sms_temp').val();
                var dv2 = $('#sms_temp :selected').text();
 
                $('#send_sms').on('click',function(){
             
                    var mobile = '$mobile';  
                    var id = '$id'; 
                    var full_name = '$full_name'
                    var name = '$name';
                    var message = document.getElementById('mob').value;
                    var dd_value=$('#sms_temp').val();
                     
 
                    if(mobile){
                        var module='Contacts'; 
                        var action='sendSms';
                        var to_pdf='true';
 
                        $.ajax({
 
                            type: "GET", 
                            async: false,
                            url: "index.php",
                            data: 
                            {   
                            module:module,
                            action:action,
                            to_pdf:to_pdf,
                            mobile:mobile,
                            id:id,
                            full_name:full_name,
                            name:name, 
                            message:message,
                            dd_value:dd_value,
 
                            },//parameters  
 
                            success: function(response)
                            {
                                //alert(response);
                            objData    =  jQuery.parseJSON(response);
                            mobile     =  objData.mobile;
                            }
 
                        });
 
                    } //if close
 
                    YAHOO.SUGAR.MessageBox.hide();
 
                    $('td[field="phone_mobile"]').append('<span id="message_ackn" style="color:green;  font-size:12px; padding-left:10px;"> SMS sent to </span><span id="message_ackn_no" style="color:#12ACDF;" >$mobile</span>');
 
                            setTimeout(function() {
                            $("#message_ackn").fadeOut().empty();
                            $("#message_ackn_no").fadeOut().empty();
                            }, 5000);
 
                });
 
 
            });
 
         
        });
        </script>
POU;
        // Send SMS - end

        parent::display();

    }
}
