<?php

//Controller class to make twitter api call and data handling of api response
class ContactsController extends SugarController{

function action_Popup(){
        if(!empty($_REQUEST['html']) && $_REQUEST['html'] == 'mail_merge'){
            $this->view = 'mailmergepopup';
        }else{
            $this->view = 'popup';
        }
    }
    
    function action_ValidPortalUsername()
    {
        $this->view = 'validportalusername';
    }

    function action_RetrieveEmail()
    {
        $this->view = 'retrieveemail';  
    }

    function action_ContactAddressPopup()
    {
        $this->view = 'contactaddresspopup';
    }
  
    function action_CloseContactAddressPopup()
    {
        $this->view = 'closecontactaddresspopup';
    }


               public function action_get_tweets() {


        global $sugar_config;

        $twitter_app_oauth_access_token        = $sugar_config['twitter_app_oauth_access_token'];
        $twitter_app_oauth_access_token_secret = $sugar_config['twitter_app_oauth_access_token_secret'];
        $twitter_app_consumer_key              = $sugar_config['twitter_app_consumer_key'];
        $twitter_app_consumer_secret           = $sugar_config['twitter_app_consumer_secret'];

            $twitter_handle   = $_REQUEST['twitter_handle'];

         // Twitter connection through api and data fetching in json format
         require_once('custom/include/twitter/twitter_api_php_master/TwitterAPIExchange.php');
     
        /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
        $settings = array(
                          'oauth_access_token'        => $twitter_app_oauth_access_token,
                  'oauth_access_token_secret' => $twitter_app_oauth_access_token_secret,
                  'consumer_key'              => $twitter_app_consumer_key,
                  'consumer_secret'           => $twitter_app_consumer_secret
                         );

//Fetch user details - start

$url1 = "https://api.twitter.com/1.1/users/show.json";
$requestMethod1 = "GET";

//https://api.twitter.com/1.1/account/verify_credentials.json

$getfield1 = "?screen_name=$twitter_handle";
$twitter1 = new TwitterAPIExchange($settings);
$string1 = json_decode($twitter1->setGetfield($getfield1)
->buildOauth($url1, $requestMethod1)
->performRequest(),$assoc = TRUE);

        $twitter_id                      = $string1['id'];
        $twitter_display_name            = $string1['name'];
        $twitter_screen_name             = $string1['screen_name'];
        $twitter_user_location           = $string1['location'];
        $twitter_followers_count         = $string1['followers_count'];
        $twitter_friends_count           = $string1['friends_count']; //following count
        $twitter_listed_count            = $string1['listed_count'];
        $twitter_account_created_at      = $string1['created_at'];
        $twitter_favourites_count        = $string1['favourites_count'];
        $twitter_utc_offset              = $string1['utc_offset'];
        $twitter_time_zone               = $string1['time_zone'];
        $twitter_geo_enabled             = $string1['geo_enabled'];
        $twitter_verified                = $string1['verified'];
        $twitter_statuses_count          = $string1['statuses_count']; //tweets count
        $twitter_language                = $string1['lang'];
        $twitter_profile_image_url       = $string1['profile_image_url'];
        $twitter_profile_image_url_https = $string1['profile_image_url_https'];
        $twitter_following               = $string1['following'];
      

//Fetch user details - end

    $url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
    $requestMethod = "GET";
    $count = 5;
    $getfield = "?screen_name=$twitter_handle&count=$count";

    $twitter = new TwitterAPIExchange($settings);
    $string = json_decode($twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest(),$assoc = TRUE);
    if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}

        $array_count = 0;

        foreach($string as $items){

        $time_and_date_of_tweet = $items['created_at']; // $Published_date  
        $time_and_date_of_tweet_split = split(" ", $time_and_date_of_tweet);
    $time_and_date_of_tweet_split['0'];
    $time_and_date_of_tweet_split['1'];
    $time_and_date_of_tweet_split['2'];
    $time_and_date_of_tweet_split['3'];
    $time_and_date_of_tweet_split['5'];
    $time = $time_and_date_of_tweet_split['3'];
    $time_corrected = date('H:i:s', strtotime('+330 minutes', strtotime($time))); // for time_zone : +5:30
    $time_and_date_of_tweet_correct = $time_and_date_of_tweet_split['0']." ".$time_and_date_of_tweet_split['2']."-".$time_and_date_of_tweet_split['1']."-".$time_and_date_of_tweet_split['5']." ".$time_corrected;

    $time_and_date_of_tweet_correct = $time_and_date_of_tweet_split['2']."-".$time_and_date_of_tweet_split['1']."-".$time_and_date_of_tweet_split['5']." ".$time_corrected;

        $Published_date           = $time_and_date_of_tweet_correct;
        $tweet            = $items['text']; // $message
        $message          = $tweet;
        $tweet_id         = $items['id'];
        $tweeted_by           = $items['user']['name'];
        $tweeted_by_id        = $items['user']['id'];
        $tweeted_by_screen_name   = $items['user']['screen_name'];
        $tweeted_by_location      = $items['user']['location'];
        $tweeted_by_description   = $items['user']['description'];
        $tweet_lang           = $items['lang'];
        $tweet_source         = $items['source'];
        $retweet_count        = $items['retweet_count'];  //  $retweets_count
        $actual_retweet_count     = $retweet_count; 
        $favorite_count       = $items['favorite_count']; // $favourites_count
        $actual_favorite_count    = $favorite_count; 

        $retweeted_status = $items['retweeted_status'];
        $arr_length = count($retweeted_status);

        // retweet some other tweet
    if($arr_length != 0){

    $retweeted_status_id                                  = $items['retweeted_status']['id']; // $status_id
    $retweeted_status_created_at                          = $items['retweeted_status']['created_at'];
    $retweeted_status_text                                = $items['retweeted_status']['text']; // $data_content
    $retweeted_status_source                              = $items['retweeted_status']['source'];
    $retweeted_status_lang                                = $items['retweeted_status']['lang'];
    $retweeted_status_favorited                           = $items['retweeted_status']['favorited'];
    $retweeted_status_retweeted                           = $items['retweeted_status']['retweeted'];
    $retweeted_status_user_name                           = $items['retweeted_status']['user']['name']; // $page_or_user_dispaly_name
    $retweeted_status_user_id                             = $items['retweeted_status']['user']['id'];
        $retweeted_status_user_screen_name                    = $items['retweeted_status']['user']['screen_name']; // $page_or_user_screen_name
        $retweeted_status_user_location                       = $items['retweeted_status']['user']['location']; 
        $retweeted_status_user_description                    = $items['retweeted_status']['user']['description']; 
    $retweeted_status_user_profile_image_url              = $items['retweeted_status']['user']['profile_image_url']; // $image_url
        $retweeted_status_user_screen_profile_image_url_https = $items['retweeted_status']['user']['profile_image_url_https']; // $image_url
                     
        $retweeted_status_user_profile_profile_background_image_url         = $items['retweeted_status']['profile_background_image_url']; 
        $retweeted_status_user_profile_profile_background_image_url_https   = $items['retweeted_status']['profile_background_image_url_https']; 

        $retweeted_status_user_profile_profile_sidebar_border_color         = $items['retweeted_status']['profile_sidebar_border_color']; 
      
        $retweeted_status_user_profile_profile_use_background_image         = $items['retweeted_status']['profile_use_background_image']; 
        $retweeted_status_user_profile_followers_count                      = $items['retweeted_status']['followers_count']; 
        $retweeted_status_user_profile_friends_count                        = $items['retweeted_status']['friends_count']; //following count
        $retweeted_status_user_profile_listed_count                         = $items['retweeted_status']['listed_count']; 
        $retweeted_status_user_profile_created_at                           = $items['retweeted_status']['created_at']; 
        $retweeted_status_user_profile_favourites_count                     = $items['retweeted_status']['favourites_count']; 
        $retweeted_status_user_profile_utc_offset                           = $items['retweeted_status']['utc_offset']; 
        $retweeted_status_user_profile_time_zone                            = $items['retweeted_status']['time_zone']; 
       
       
        $retweeted_status_user_profile_statuses_count                       = $items['retweeted_status']['statuses_count']; //tweets count
        $retweeted_status_user_profile_lang                                 = $items['retweeted_status']['lang']; 
        $retweeted_status_user_profile_following                            = $items['retweeted_status']['following']; 
        $retweeted_status_is_quote_status                                   = $items['retweeted_status']['is_quote_status']; 
        $retweeted_status_retweet_count                                     = $items['retweeted_status']['retweet_count']; 
        $retweeted_status_favorite_count                                    = $items['retweeted_status']['favorite_count']; 

        $status_id = $retweeted_status_id;
        //$data_content = $retweeted_status_text;
        $page_or_user_dispaly_name = $retweeted_status_user_name;
        $page_or_user_screen_name = $retweeted_status_user_screen_name;
        $image_url = $retweeted_status_user_profile_image_url;
    $actual_retweet_count  = $retweeted_status_retweet_count;
    $actual_favorite_count = $retweeted_status_favorite_count;

    }

    if($arr_length == 0){

        $is_quote_status = $items['is_quote_status'];

    // tweet newly with some other tweet(quoted tweet).
    if( $is_quote_status == 1 ){

        $quoted_status_id                                  = $items['quoted_status']['id']; // $status_id
        $quoted_status_created_at                          = $items['quoted_status']['created_at'];
        $quoted_status_text                                = $items['quoted_status']['text']; // $data_content
        $quoted_status_source                              = $items['quoted_status']['source']; 
        $quoted_status_retweet_count                       = $items['quoted_status']['retweet_count']; 
        $quoted_status_favorite_count                      = $items['quoted_status']['favorite_count']; 
        $quoted_status_is_quote_status                     = $items['quoted_status']['is_quote_status']; 
        $quoted_status_user_name                           = $items['quoted_status']['user']['name']; // $page_or_user_dispaly_name
        $quoted_status_user_id                             = $items['quoted_status']['user']['id'];
        $quoted_status_user_screen_name                    = $items['quoted_status']['user']['screen_name']; // $page_or_user_screen_name
        $quoted_status_user_profile_image_url              = $items['quoted_status']['user']['profile_image_url']; // $image_url
        $quoted_status_user_screen_profile_image_url_https = $items['quoted_status']['user']['profile_image_url_https']; // $image_url

        $quoted_status_tweeted_by_profile_location                           = $items['quoted_status']['user']['location'];
        $quoted_status_tweeted_by_profile_description                        = $items['quoted_status']['user']['description'];
        $quoted_status_tweeted_by_profile_followers_count                    = $items['quoted_status']['user']['followers_count'];
        $quoted_status_tweeted_by_profile_friends_count                      = $items['quoted_status']['user']['friends_count']; // following_count
        $quoted_status_tweeted_by_profile_listed_count                       = $items['quoted_status']['user']['listed_count'];
        $quoted_status_tweeted_by_profile_created_at                         = $items['quoted_status']['user']['created_at'];
        $quoted_status_tweeted_by_profile_favourites_count                   = $items['quoted_status']['user']['favourites_count'];
        $quoted_status_tweeted_by_profile_utc_offset                         = $items['quoted_status']['user']['utc_offset'];
        $quoted_status_tweeted_by_profile_time_zone                          = $items['quoted_status']['user']['time_zone'];
        $quoted_status_tweeted_by_profile_statuses_count                     = $items['quoted_status']['user']['statuses_count']; // tweets
        $quoted_status_tweeted_by_profile_lang                               = $items['quoted_status']['user']['lang'];
        $quoted_status_tweeted_by_profile_profile_background_image_url       = $items['quoted_status']['user']['profile_background_image_url'];
        $quoted_status_tweeted_by_profile_profile_background_image_url_https = $items['quoted_status']['user']['profile_background_image_url_https'];
        $quoted_status_tweeted_by_profile_profile_banner_url                 = $items['quoted_status']['user']['profile_banner_url'];
        $quoted_status_tweeted_by_profile_following                          = $items['quoted_status']['user']['following'];

        $status_id = $quoted_status_id;
        //$data_content = $quoted_status_text;
        $page_or_user_dispaly_name = $quoted_status_user_name;
        $page_or_user_screen_name = $quoted_status_user_screen_name;
        $image_url = $quoted_status_user_profile_image_url;
        $actual_retweet_count  = $quoted_status_retweet_count;
        $actual_favorite_count = $quoted_status_favorite_count;

    }

    if( $is_quote_status != 1 ){

        $tweeted_user_name                                     = $items['user']['name']; // $page_or_user_dispaly_name
        $tweeted_by_user_id                                    = $items['user']['id'];
        $tweeted_by_screen_name                                = $items['user']['screen_name']; // $page_or_user_screen_name
        $tweeted_by_profile_image_url                          = $items['user']['profile_image_url']; // $image_url
        $tweeted_by_profile_image_url_https                    = $items['user']['profile_image_url_https']; // $image_url
        $tweeted_by_profile_location                           = $items['user']['location'];
        $tweeted_by_profile_description                        = $items['user']['description'];
        $tweeted_by_profile_followers_count                    = $items['user']['followers_count'];
        $tweeted_by_profile_friends_count                      = $items['user']['friends_count']; // following_count
        $tweeted_by_profile_listed_count                       = $items['user']['listed_count'];
        $tweeted_by_profile_created_at                         = $items['user']['created_at'];
        $tweeted_by_profile_favourites_count                   = $items['user']['favourites_count'];
        $tweeted_by_profile_utc_offset                         = $items['user']['utc_offset'];
        $tweeted_by_profile_time_zone                          = $items['user']['time_zone'];
        $tweeted_by_profile_statuses_count                     = $items['user']['statuses_count']; // tweets
        $tweeted_by_profile_lang                               = $items['user']['lang'];
        $tweeted_by_profile_profile_background_image_url       = $items['user']['profile_background_image_url'];
        $tweeted_by_profile_profile_background_image_url_https = $items['user']['profile_background_image_url_https'];
        $tweeted_by_profile_profile_banner_url                 = $items['user']['profile_banner_url'];
        $tweeted_by_profile_following                          = $items['user']['following'];

        $tweet                                   = $items['text']; // $data_content
        $tweet_id                                = $items['id']; // $status_id
    $tweet_retweet_count                     = $items['retweet_count'];
    $tweet_favorite_count                    = $items['favorite_count'];
    $tweet_is_quote_status                   = $items['is_quote_status'];
    $tweet_lang                              = $items['lang'];
    $tweet_source                            = $items['source'];

        $status_id = $tweet_id;
        //$data_content = $tweet;
        $page_or_user_dispaly_name = $tweeted_user_name;
        $page_or_user_screen_name = $tweeted_by_screen_name;
        $image_url = $tweeted_by_profile_image_url;
    $actual_retweet_count  = $tweet_retweet_count;
    $actual_favorite_count = $tweet_favorite_count;

    }

    } 
    
           $array_count++;

       //$message = str_replace("'", "\'", $message); // Replaces all ' with \'.
       //$message = str_replace ('"','\"', $message ) ;
           $message = preg_replace("/(\r?\n){2,}/", "\n\n", $message);
       $message = preg_replace("/[\r\n]{2,}/", "\n\n", $message);
       $message = preg_replace("/[\r\n]+/", "\n", $message);
       $message = wordwrap($message,60, ' <br/>', true); //comment this line or increase the rate, if the data(message) is too much large or having "
       $message = nl2br($message);
       $message = preg_replace('/[ \t]+/', ' ', preg_replace('/[\r\n]+/', "\n", $message));
       $message = preg_replace( "/\r|\n/", "", $message );
       $message = str_replace(array("\r", "\n"), '', $message);
           //for removing bad data
           $message = filter_var($message, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

        $hids  = "hids_".$array_count;
        $trs   = "trs_".$array_count;
        $msg   = "msg_".$array_count;
        $tds   = "tds_".$array_count;
        $sels  = "sels_".$array_count;

$hid_data = $message."abcd0123dcba".$status_id."abcd0123dcba".$Published_date."abcd0123dcba".$page_or_user_dispaly_name."abcd0123dcba".$page_or_user_screen_name."abcd0123dcba".$image_url;

        //$remove = array("\n", "\r\n", "\r");
       // $str = str_replace($remove, ' ', $str);

   //echo $val = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

$tbody .= '<tr id="'.$trs.'" class="listViewEntries mm_normal mm_clickable"><td class="narrowWidthType table_padding_margin">'.$Published_date.'</td><td class="narrowWidthType table_padding_margin table_message_padding"><span id="'.$msg.'" ><span><a title="'.$page_or_user_dispaly_name.'" target="_blank" href="https://twitter.com/'.$page_or_user_screen_name.'"><img width="20" height="20" src="'.$image_url.'"></a></span>&nbsp;&nbsp;<span><a class="feedText" style="text-decoration:none;color:inherit" data-trigger="hover" data-placement="top" rel="popover" data-content="'.$data_content.'" target="_blank" href="https://twitter.com/string/status/'.$status_id.'">'.$message.'</a></span></span></td><td><center> '.$actual_retweet_count.'</center></td><td><center>'.$actual_favorite_count.'</center></td><td id="'.$tds.'" class="narrowWidthType table_padding_margin"><div class="actions"><select class="actions_dd" id="'.$sels.'" style="color:green; margin-left:10px;"><option id="nothing" name="nothing" value=""></option><option id="actions_add_lead" name="actions_add_lead" style=" margin-top:5px;margin-bottom:5px;font-size:14px;" value="Add Lead">Add Lead</option><option value="Add Contact" id="actions_add_contact" name="actions_add_contact" style=" margin-top:5px;margin-bottom:5px;font-size:14px;" >Add Contact</option><option  id="actions_add_opportunities" name="actions_add_opportunities" value="Add Opportunity" style=" margin-top:5px;margin-bottom:5px;font-size:14px;" >Add Opportunity</option><option id="actions_add_case" name="actions_add_case" value="Add Case" style=" margin-top:5px;margin-bottom:5px;font-size:14px;" >Add Case</option></select></div></td><td></td></tr><tr><input type="hidden" value="'.$hid_data.'" id="'.$hids.'"></tr>';


        }
                $data= array();
                $data['result_count']                = $array_count;
                $data['twitter_data']                = $tbody;
                $data['got_twitter_data']            = "yes";
                $data['twitter_display_name']        = $twitter_display_name;
                $data['twitter_profile_image_url']   = $twitter_profile_image_url;
            echo json_encode($data);
           }    


    public function action_create_records (){

        global $sugar_config; 
        global $db;

        $module             = $_REQUEST['module'];
        $action             = $_REQUEST['action'];
        $to_pdf             = $_REQUEST['to_pdf'];
        $first_name         = $_REQUEST['first_name'];
        $last_name          = $_REQUEST['last_name'];
        $twitter_handle_c   = $_REQUEST['twitter_handle_c'];
        $lead_source        = $_REQUEST['lead_source'];
        $description        = $_REQUEST['description'];
        $status_id          = $_REQUEST['status_id'];
        $account_id         = $_REQUEST['account_id'];

        $contact = new Contact();
        $contact->first_name              = $first_name;
        $contact->last_name               = $last_name;
        $contact->lead_source             = $lead_source;
        $contact->description             = $description;  
        $contact->tweet_id_c              = $status_id; 
        $contact->twitter_handle_c        = $twitter_handle_c;  
        $contact->account_id              = $account_id;     

        //$query1  =   "SELECT id_c FROM contacts_cstm, contacts WHERE id = id_c AND deleted = 0 AND  tweet_id_c  = '$status_id'";
        $query1  =   "SELECT id_c FROM contacts_cstm, contacts WHERE id = id_c AND deleted = 0 AND  twitter_handle_c  = '$twitter_handle_c' AND lead_source = '$lead_source'";

        $value1  =   $db->query($query1);
        $check1  =   $get_values_row1  = $db->fetchByAssoc($value1);

        if(!$check1){
            $contact->save();   
            $created = "y";
        }
        if($check1){
            $created = "n";
        }

        $sql = "SELECT id_c FROM contacts_cstm, contacts WHERE id = id_c AND deleted = 0 AND  twitter_handle_c  = '$twitter_handle_c' AND lead_source = '$lead_source'";
        $result = $db->query($sql);

        if($row6 = $db->fetchByAssoc($result)){
            $id_c = $row6['id_c'];                    
        }
        $data2= array();
        $data2['id_c']                = $id_c;
        $data2['created']             = $created;

        echo json_encode($data2);

    }  
    
    
    /************sending sms from list view********************************/
    function action_sms()
    {
        global $sugar_config, $db;
        //Get selected records Ids from list view
        if (!empty($_REQUEST['uid'])) {
            $recordIds = explode(',', $_REQUEST['uid']);
            $cid_list  = '';
            foreach ($recordIds as $contact_id) {
                $cid_list .= "'" . $contact_id . "',";
            }
            $cid_list      = substr($cid_list, 0, -1);
            $query         = "SELECT id,phone_mobile FROM contacts WHERE deleted = 0 AND id IN ($cid_list)";
            $result        = $db->query($query);
            $mobile_number = '';
            $mobiledata_array = array();
            while ($row = $db->fetchByAssoc($result)) {
                if (!empty($row['phone_mobile'])) {
                    $mobiledata_array[$row['id']] =$row['phone_mobile'];
                    // $mobile_number .= $row['phone_mobile'] . ',';
                    // $data = trim($mobile_number, ",");
                }
            }
            //~ echo "<pre>";
            //~ print_r($mobile_numbers);
            $dln                                     = 10000;
            $this->view_object_map['dln']            = $dln;
            $this->view_object_map['recordIds']      = $recordIds;
            $this->view_object_map['mobile_numbers'] = $mobiledata_array;
            $this->view                              = 'list';
        }
    }
    public function action_addTemplate()
    {
        $drop_down_value = $_REQUEST['drop_down_value']; //using get method
        $customer = $_REQUEST['customer']; //using get method
        $agent = $_REQUEST['agent']; //using get method
        global $db;
        $qry190   = "select description from scrm_sms_template where name = '$drop_down_value' and deleted= 0 ";
        $value190 = $db->query($qry190);
        $check190 = $get_values_row190 = $db->fetchByAssoc($value190);
        if ($check190) {
            $description = $get_values_row190['description'];            
        } 
        if(isset($customer)){
             $description = str_replace('&lt;customer&gt;',$customer,$description);
        }else{
             $description = str_replace('&lt;customer&gt;','Customer',$description);
        } 
        $description = str_replace('&lt;agent&gt;',$agent,$description);     
        $data3                    = array();
        $data3['drop_down_value'] = $drop_down_value;
        $data3['description']     = $description;
        
        echo json_encode($data3);
    }
    public function action_sendSmss()
    {
        global $current_user,$db;
                
                $current_user_id = $current_user->id;
                $current_user_full_name =$current_user->full_name;
                date_default_timezone_set('Asia/Kolkata');
                $time = date('d/m/Y @ H:i', time());
        $mobile            = $_REQUEST['mobile']; //using get method
        $id                = $_REQUEST['id'];
        $mob_nos           = $_REQUEST['mob_nos'];
        $full_name         = $_REQUEST['full_name'];
        $name              = $_REQUEST['name'];
        $message           = $_REQUEST['message'];
        $dd_value          = $_REQUEST['dd_value'];
        $idd               = $_REQUEST['result'];
        $status            = 1;
        $data              = array();
        $data['mobile']    = $mobile;
        $data['id']        = $id;
        $data['full_name'] = $full_name;
        $data['name']      = $name;
        $data['message']   = $message;
        $data['mob_nos ']  = $mob_nos;
        $data['dd_value']  = $dd_value;
        $data['status']    = $status;
    
        $mob_nos = str_replace('&quot;', '"', $mob_nos);
        $mob_nos_data = json_decode($mob_nos,true);
        foreach ($mob_nos_data as $key => $value) {
            require_once('SendSMS.php');
            $message   = $message;
            $mobile_no = "91" . substr($value, -10);
            $sms       = new SendSMS();
            $result    = $sms->send_sms_to_user($mobile_no, $message);
             if($result){    
                          

                $query16 ="select * FROM scrm_sms_template WHERE name='$dd_value' and deleted = 0";
                $results16= $db->query($query16);
                $row16 = $db->fetchByAssoc($results16);

                if($row16){
                    $temp_id = $row16['id'];
                }

                $message_send_to  = "User"; 
                $objsms = BeanFactory::getBean('scrm_SMS');

                $SMSName = $objsms->name                                         = "SMS - ".$full_name." on ".$time;
                $objsms->description                                             = $message;
                $objsms->assigned_user_name                                      = $current_user_full_name;
                $objsms->assigned_user_id                                        = $current_user_id;
                $objsms->receipient_no_c                                         = $mobile_no;
                $objsms->message_send_to_c                                       = $message_send_to;   
                $objsms->contacts_scrm_sms_1contacts_ida                               = $key;
                $objsms->scrm_sms_template_scrm_sms_1scrm_sms_template_ida       = $temp_id;

                $objsms->save();    
            }
           // $GLOBALS['log']->fatal($result, "SMS output");
            $result         = "Message sent sucessfully";
            $data['result'] = $result;
           
        }
        echo json_encode($data);
    }
    /**************End -send sms from listview*****************************/
    /********************send sms from detailsview*************************/
    public function action_sendSms() {
                global $current_user,$db;
                
                $current_user_id = $current_user->id;
                $current_user_full_name =$current_user->full_name;
                date_default_timezone_set('Asia/Kolkata');
                $time = date('d/m/Y @ H:i', time());

                $mobile    = $_REQUEST['mobile'];//using get method
                $id        = $_REQUEST['id']; 
                $full_name = $_REQUEST['full_name'];
                $name      = $_REQUEST['name'];
                $message   = $_REQUEST['message']; 
                $dd_value  = $_REQUEST['dd_value']; 

                $data= array();
                $data['mobile']        = $mobile;
                $data['id']            = $id;
                $data['full_name']     = $full_name;
                $data['name']          = $name;
                $data['message']       = $message;
                $data['dd_value']      = $dd_value;
                
                require_once('SendSMS.php');
                $message = $message;
                $mobile_no = "91" . substr($mobile, -10);
                $sms = new SendSMS();
                $result = $sms->send_sms_to_user($mobile_no, $message);
            if($result){    
                $query16 ="select * FROM scrm_sms_template WHERE name='$dd_value' and deleted = 0";
                $results16= $db->query($query16);
                $row16 = $db->fetchByAssoc($results16);

                if($row16){
                    $temp_id = $row16['id'];
                }

                $message_send_to  = "User"; 
                $objsms = BeanFactory::getBean('scrm_SMS');

                $SMSName = $objsms->name                                         = "SMS - ".$full_name." on ".$time;
                $objsms->description                                             = $message;
                $objsms->assigned_user_name                                      = $current_user_full_name;
                $objsms->assigned_user_id                                        = $current_user_id;
                $objsms->receipient_no_c                                         = $mobile_no;
                $objsms->message_send_to_c                                       = $message_send_to;   
                $objsms->contacts_scrm_sms_1contacts_ida                               = $id;
                $objsms->scrm_sms_template_scrm_sms_1scrm_sms_template_ida       = $temp_id;

                $objsms->save();    
            }
                echo json_encode($data);

            }
} 
