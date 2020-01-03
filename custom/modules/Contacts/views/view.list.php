<?php
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/

require_once('include/MVC/View/SugarView.php');

require_once('include/ListView/ListViewSmarty.php');

require_once('modules/MySettings/StoreQuery.php');
class ContactsViewList extends SugarView{
    var $type ='list';
    var $lv;
    var $searchForm;
    var $use_old_search;
    var $headers;
    var $seed;
    var $params;
    var $listViewDefs;
    var $storeQuery;
    var $where = '';
    function ViewList(){
        parent::SugarView();
    }


    function oldSearch(){

    }
    function newSearch(){

    }

    function listViewPrepare(){
        $module = $GLOBALS['module'];

        $metadataFile = $this->getMetaDataFile();

        if( !file_exists($metadataFile) )
            sugar_die($GLOBALS['app_strings']['LBL_NO_ACTION'] );

        require($metadataFile);

        $this->listViewDefs = $listViewDefs;

        if(!empty($this->bean->object_name) && isset($_REQUEST[$module.'2_'.strtoupper($this->bean->object_name).'_offset'])) {//if you click the pagination button, it will populate the search criteria here
            if(!empty($_REQUEST['current_query_by_page'])) {//The code support multi browser tabs pagination
                $blockVariables = array('mass', 'uid', 'massupdate', 'delete', 'merge', 'selectCount', 'request_data', 'current_query_by_page',$module.'2_'.strtoupper($this->bean->object_name).'_ORDER_BY' );
                if(isset($_REQUEST['lvso'])){
                    $blockVariables[] = 'lvso';
                }
                $current_query_by_page = unserialize(base64_decode($_REQUEST['current_query_by_page']));
                foreach($current_query_by_page as $search_key=>$search_value) {
                    if($search_key != $module.'2_'.strtoupper($this->bean->object_name).'_offset' && !in_array($search_key, $blockVariables)) {
                        if (!is_array($search_value)) {
                            $_REQUEST[$search_key] = $GLOBALS['db']->quote($search_value);
                        }
                        else {
                            foreach ($search_value as $key=>&$val) {
                                $val = $GLOBALS['db']->quote($val);
                            }
                            $_REQUEST[$search_key] = $search_value;
                        }
                    }
                }
            }
        }
        if(!empty($_REQUEST['saved_search_select'])) {
            if ($_REQUEST['saved_search_select']=='_none' || !empty($_REQUEST['button'])) {
                $_SESSION['LastSavedView'][$_REQUEST['module']] = '';
                unset($_REQUEST['saved_search_select']);
                unset($_REQUEST['saved_search_select_name']);

                //use the current search module, or the current module to clear out layout changes
                if(!empty($_REQUEST['search_module']) || !empty($_REQUEST['module'])){
                    $mod = !empty($_REQUEST['search_module']) ? $_REQUEST['search_module'] : $_REQUEST['module'];
                    global $current_user;
                    //Reset the current display columns to default.
                    $current_user->setPreference('ListViewDisplayColumns', array(), 0, $mod);
                }
            }
            else if(empty($_REQUEST['button']) && (empty($_REQUEST['clear_query']) || $_REQUEST['clear_query']!='true')) {
                $this->saved_search = loadBean('SavedSearch');
                $this->saved_search->retrieveSavedSearch($_REQUEST['saved_search_select']);
                $this->saved_search->populateRequest();
            }
            elseif(!empty($_REQUEST['button'])) { // click the search button, after retrieving from saved_search
                $_SESSION['LastSavedView'][$_REQUEST['module']] = '';
                unset($_REQUEST['saved_search_select']);
                unset($_REQUEST['saved_search_select_name']);
            }
        }
        $this->storeQuery = new StoreQuery();
        if(!isset($_REQUEST['query'])){
            $this->storeQuery->loadQuery($this->module);
            $this->storeQuery->populateRequest();
        }else{
            $this->storeQuery->saveFromRequest($this->module);
        }

        $this->seed = $this->bean;

        $displayColumns = array();
        if(!empty($_REQUEST['displayColumns'])) {
            foreach(explode('|', $_REQUEST['displayColumns']) as $num => $col) {
                if(!empty($this->listViewDefs[$module][$col]))
                    $displayColumns[$col] = $this->listViewDefs[$module][$col];
            }
        }
        else {
            foreach($this->listViewDefs[$module] as $col => $this->params) {
                if(!empty($this->params['default']) && $this->params['default'])
                    $displayColumns[$col] = $this->params;
            }
        }
        $this->params = array('massupdate' => true);
        if(!empty($_REQUEST['orderBy'])) {
           $this->params['orderBy'] = $_REQUEST['orderBy']; //echo $_REQUEST['sortOrder'];
            $this->params['overrideOrder'] = true;
            if(!empty($_REQUEST['sortOrder'])) $this->params['sortOrder'] = $_REQUEST['sortOrder'];
            
        }
        $this->lv->displayColumns = $displayColumns;

        $this->module = $module;

        $this->prepareSearchForm();

        if(isset($this->options['show_title']) && $this->options['show_title']) {
            $moduleName = isset($this->seed->module_dir) ? $this->seed->module_dir : $GLOBALS['mod_strings']['LBL_MODULE_NAME'];
            echo $this->getModuleTitle(true);
        }
    }

    function listViewProcess(){
        $this->processSearchForm();
        $this->lv->searchColumns = $this->searchForm->searchColumns;

        if(!$this->headers)
            return;
        if(empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false){
            $this->lv->ss->assign("SEARCH",true);
            $this->lv->setup($this->seed, 'include/ListView/ListViewGeneric.tpl', $this->where, $this->params);
            $savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
            echo $this->lv->display();
        }
        
         $dln = $this->view_object_map['dln'];
        $recordIds = $this->view_object_map['recordIds'];
		$mobile_number = $this->view_object_map['mobile_numbers'];
		$mobile_numbers = json_encode($mobile_number);
       
        $mobile_data = array_values($mobile_number);
        $mobile_data = implode(',', $mobile_data);
		
		 global $current_user, $db, $sugar_config;
		 $agent_name = $current_user->first_name.' '.$current_user->last_name;
		 $site_url = $sugar_config['site_url'];
		$fetch_sms_templates="SELECT * FROM scrm_sms_template WHERE deleted=0";
		$result_sms_templates = $db->query($fetch_sms_templates);
		$data_templates = array();
		$a = 1;

		while($sms_templates_rows = $db->fetchByAssoc($result_sms_templates)){
			$data_templates[$a]['id'] = $sms_templates_rows['id'];
			$data_templates[$a]['name'] = $sms_templates_rows['name'];
			$data_templates[$a]['description'] = $sms_templates_rows['description'];
					$a++;           
		}
		foreach($data_templates as $template){
			$sms_template = $template['name'];
			$templates .= '<option value="'.$sms_template.'">'.$sms_template.'</option>';
		}
		echo $js=<<<popup
		<script src='cache/include/javascript/sugar_grp_yui_widgets.js'></script>
		<script>
    $(document).ready(function() {
        var popup_data = '<div style="width:200px;padding-left:10px;"><br><input type="text" value="$mobile_data"  id="mobile" name="mobile" placeholder="Mobile No" style="width:100%;font-family: Helvetica, Arial, sans-serif; background:#FFFFEB;"><br><br><select style="width:100%; background:#FFFFEB;" id="sms_temp" name="sms_temp"><option selected="selected"  value="">Select SMS Template</option>$templates</select><br><br><textarea  rows="5" name="mob" id="mob"  style="width:100%;font-family: Helvetica, Arial, sans-serif; background:#FFFFEB;"></textarea><input type="button" value="Send" id="send_sms" style="font-family: Helvetica, Arial, sans-serif;background:green;color:white;margin-left:0%;margin-top:5%;margin-bottom:-5%;"><input type="button" value="Cancel" id="cancel_sms_send" style="font-family: Helvetica, Arial, sans-serif;background:#FF3535;color:white;margin-left:2%;margin-top:5%;margin-bottom:-5%;" onclick="YAHOO.SUGAR.MessageBox.hide();"></div>';

        if ('$dln' == 10000) {
            YAHOO.SUGAR.MessageBox.show({
                msg: popup_data,
                title: '<span style="padding-left:06%;"><font color="#ffffff">Send SMS</font></span>',
            });

            $("#mob").bind("keyup", function(e) {

                var characters_left = max_length - $(e.currentTarget).val().length;
                //alert(characters_left);


                if (characters_left == 0) {
                    //	$('#cancel_sms_send').append('Limit your message up to 160 characters only.');
                    alert('Reached maximum limit of message');
                    e.preventDefault();
                }
                if (characters_left < 0) {
                    // Maximum exceeded
                    this.value = this.value.substring(0, max_length);
                }

            });



            $('#sms_temp').on('change', function() {

                var drop_down_value = $(this).val();
				var agent = '$agent';
                if (drop_down_value != '') {

                    var module = 'Contacts';
                    var action = 'addTemplate';
                    var to_pdf = 'true';

                    $.ajax({
                        type: "GET",
                        async: false,
                        url: "index.php",
                        data: {
                            module: module,
                            action: action,
                            to_pdf: to_pdf,
                            drop_down_value: drop_down_value,
							agent : agent,

                        }, //parameters	
                        success: function(response) {
                            objData = jQuery.parseJSON(response);
                            description = objData.description;
                            $('#mob').val(description).attr('readOnly', 'readOnly');


                        }
                    });
                }
                if (drop_down_value == '') {
                    $('#mob').val('');
                }

            });
            $('#send_sms').on('click', function() {

                var mobile = '$mobile';
                var id = '$recordIds';

                //alert('$mobile_numbers');
                var full_name = '$full_name';
                var name = '$name';

                var message = document.getElementById('mob').value;
                var dd_value = $('#sms_temp').val();
                var stuff = {
                    'key1': 'value1',
                    'key2': 'value2'
                };

                var jArray = new Array($t);

                if ('$mobile_numbers') {
                    var module = 'Contacts';
                    var action = 'sendSmss';
                    var mob_nos = '$mobile_numbers';
                    var to_pdf = 'true';
                   // console.log(mob_nos);
                    var success_sms_status_template = '<div style="width:150px;height:20px;padding-left:10px;"><input type="button" value="OK" id="sms_status_ok" style="font-family: Helvetica, Arial, sans-serif;background:skyblue;color:white;margin-left:175px;margin-top:10px;" onclick="closePopup()"></div>';

                    $.ajax({
                        type: "GET",
                        async: false,
                        url: "index.php",
                        data: {
                            module: module,
                            action: action,
                            to_pdf: to_pdf,
                            mobile: mobile,
                            id: id,
                            full_name: full_name,
                            name: name,
                            result: jArray,
                            mob_nos: mob_nos,
                            message: message,
                            dd_value: dd_value,


                        }, //parameters	
                        success: function(response) {


                            objData = jQuery.parseJSON(response);

                            status = objData.status;
                            if (status == 1) {

                                YAHOO.SUGAR.MessageBox.hide();
                                YAHOO.SUGAR.MessageBox.show({
                                    msg: '<div id="success_sms_status" style="margin-left:30px; padding-top:20px; color:green;">Successfully Sent SMS</div>' + success_sms_status_template,
                                    title: 'SMS Status',

                                });

                            }
                            if (status != 1) {

                                YAHOO.SUGAR.MessageBox.hide();
                                YAHOO.SUGAR.MessageBox.show({
                                    msg: '<div id="failed_sms_status" style="margin-left:10px; padding-top:10px; color:red;">SMS Not Sent.Please check the number.</div>' + success_sms_status_template,
                                    title: 'SMS Status',

                                });
                            }
                        }
                    });

                } //if close
                var currentURL = document.URL;
                var site_url = '$site_url';
            });
        }

    });

    function closePopup() {

        YAHOO.SUGAR.MessageBox.hide();
        var site_url = '$site_url';
        window.location = site_url + '/index.php?module=Contacts&action=index';

    }
</script>
popup;
        
    }
    function prepareSearchForm()
    {
        $this->searchForm = null;

        //search
        $view = 'basic_search';
        if(!empty($_REQUEST['search_form_view']) && $_REQUEST['search_form_view'] == 'advanced_search')
            $view = $_REQUEST['search_form_view'];
        $this->headers = true;

        if(!empty($_REQUEST['search_form_only']) && $_REQUEST['search_form_only'])
            $this->headers = false;
        elseif(!isset($_REQUEST['search_form']) || $_REQUEST['search_form'] != 'false')
        {
            if(isset($_REQUEST['searchFormTab']) && $_REQUEST['searchFormTab'] == 'advanced_search')
            {
                $view = 'advanced_search';
            }
            else
            {
                $view = 'basic_search';
            }
        }

        $this->use_old_search = true;
        if ((file_exists('modules/' . $this->module . '/SearchForm.html')
                && !file_exists('modules/' . $this->module . '/metadata/searchdefs.php'))
            || (file_exists('custom/modules/' . $this->module . '/SearchForm.html')
                && !file_exists('custom/modules/' . $this->module . '/metadata/searchdefs.php')))
        {
            require_once('include/SearchForm/SearchForm.php');
            $this->searchForm = new SearchForm($this->module, $this->seed);
        }
        else
        {
            $this->use_old_search = false;
            require_once('include/SearchForm/SearchForm2.php');

            $searchMetaData = SearchForm::retrieveSearchDefs($this->module);

            $this->searchForm = $this->getSearchForm2($this->seed, $this->module, $this->action);
            $this->searchForm->setup($searchMetaData['searchdefs'], $searchMetaData['searchFields'], 'SearchFormGeneric.tpl', $view, $this->listViewDefs);
            $this->searchForm->lv = $this->lv;
        }
    }

    function processSearchForm(){
        if(isset($_REQUEST['query']))
        {
            // we have a query
            if(!empty($_SERVER['HTTP_REFERER']) && preg_match('/action=EditView/', $_SERVER['HTTP_REFERER'])) { // from EditView cancel
                $this->searchForm->populateFromArray($this->storeQuery->query);
            }
            else {
                $this->searchForm->populateFromRequest();
            }

            $where_clauses = $this->searchForm->generateSearchWhere(true, $this->seed->module_dir);

            if (count($where_clauses) > 0 )$this->where = '('. implode(' ) AND ( ', $where_clauses) . ')';
            $GLOBALS['log']->info("List View Where Clause: $this->where");
        }
        if($this->use_old_search){
            switch($view) {
                case 'basic_search':
                    $this->searchForm->setup();
                    $this->searchForm->displayBasic($this->headers);
                    break;
                 case 'advanced_search':
                    $this->searchForm->setup();
                    $this->searchForm->displayAdvanced($this->headers);
                    break;
                 case 'saved_views':
                    echo $this->searchForm->displaySavedViews($this->listViewDefs, $this->lv, $this->headers);
                   break;
            }
        }else{
            echo $this->searchForm->display($this->headers);
        }
    }
    function preDisplay(){
        $this->lv = new ListViewSmarty();
        $this->lv->actionsMenuExtraItems[] = $this->buildMyMenuItem();
    }
    function display(){
        if(!$this->bean || !$this->bean->ACLAccess('list')){
            ACLController::displayNoAccess();
        } else {
            $this->listViewPrepare();
            $this->listViewProcess();
        }
        
        global $current_user, $db;
        
        echo $js=<<<HIDE
				<script>
				$(document).ready(function(){
					$("a.dblclick").dblclick(function (e) { return false; });
					$("#advanced_search_link").on("click", function(event) {
						event.preventDefault();
					});
					
				});
				</script>
HIDE;
        
    }

      /**
       *
       * @return SearchForm
       */
    protected function getSearchForm2($seed, $module, $action = "index")
    {
        // SearchForm2.php is required_onced above before calling this function
        // hence the order of parameters is different from SearchForm.php
        return new SearchForm($seed, $module, $action);
    }
    
    //For Adding the Button in List view
     protected function buildMyMenuItem()
		{
        global $app_strings;

        return $EOHTML = <<<EOHTML
        <li>
		<a class="menuItem" style="width: 150px;" href="#" id="sms" name="sms" onmouseover='hiliteItem(this,"yes");'
        onmouseout='unhiliteItem(this);'
        onclick="sugarListView.get_checks();
        if(sugarListView.get_checks_count() &lt; 1) {
            alert('{$app_strings['LBL_LISTVIEW_NO_SELECTED']}');
            return false;
        }
        document.MassUpdate.action.value='sms';
        document.MassUpdate.submit();">SMS</a>
        </li>
EOHTML;
		}
    
}







?>
