<?php
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by Salesagility Ltd.
 * Copyright (C) 2011 - 2016 Salesagility Ltd.
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
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for  technical reasons, the Appropriate Legal Notices must
 * display the words  "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 ********************************************************************************/

/**
 * Reminder class
 *
 */
class Reminder extends Basic
{

    const UPGRADE_VERSION = '7.4.3';

    var $name;

    var $new_schema = true;
    var $module_dir = 'Reminders';
    var $object_name = 'Reminder';
    var $table_name = 'reminders';
    var $tracker_visibility = false;
    var $importable = false;
    var $disable_row_level_security = true;

	//NetCom start
	var $date_willexecute;
	//NetCom end
    var $popup;
    var $email;
    var $email_sent = false;
    var $timer_popup;
    var $timer_email;
    var $related_event_module;
    var $related_event_module_id;

    private static $remindersData = array();

    // ---- save and load remainders on EditViews

    /**
     * Save multiple reminders data from clients Meetings/Calls EditView.
     * Call this static function in save action.
     *
     * @param string $eventModule Event Bean module name (e.g. Meetings, Calls)
     * @param string $eventModuleId Event Bean GUID
     * @param string $remindersDataJson Remainders data as Json string from POST data.
     * @throws Exception throw an Exception if json format is invalid.
     */
    public static function saveRemindersDataJson($eventModule, $eventModuleId, $remindersDataJson)
    {
        $reminderData = json_decode($remindersDataJson);
        if (!json_last_error()) {
            Reminder::saveRemindersData($eventModule, $eventModuleId, $reminderData);
        } else {
            throw new Exception(json_last_error_msg());
        }
    }

    private static function saveRemindersData($eventModule, $eventModuleId, $remindersData)
    {
        $savedReminderIds = array();
        foreach ($remindersData as $reminderData) {
            if (isset($_POST['isDuplicate']) && $_POST['isDuplicate']) $reminderData->id = '';
            $reminderBean = BeanFactory::getBean('Reminders', $reminderData->id);
            $reminderBean->popup = $reminderData->popup;
            $reminderBean->email = $reminderData->email;
            $reminderBean->timer_popup = $reminderData->timer_popup;
            $reminderBean->timer_email = $reminderData->timer_email;
            $reminderBean->related_event_module = $eventModule;
            $reminderBean->related_event_module_id = $eventModuleId;
			//NetCom, nullify date_willexecute (NULL) so it can be updated on next fetch run
			$reminderBean->date_willexecute = NULL;
			//NetCom end
            $reminderBean->save();
            $savedReminderIds[] = $reminderBean->id;
            $reminderId = $reminderBean->id;
            Reminder_Invitee::saveRemindersInviteesData($reminderId, $reminderData->invitees);
        }
        $reminders = BeanFactory::getBean('Reminders')->get_full_list("", "reminders.related_event_module = '$eventModule' AND reminders.related_event_module_id = '$eventModuleId'");
        if ($reminders) {
            foreach ($reminders as $reminder) {
                if (!in_array($reminder->id, $savedReminderIds)) {
                    Reminder_Invitee::deleteRemindersInviteesMultiple($reminder->id);
                    $reminder->mark_deleted($reminder->id);
                    $reminder->save();
                }
            }
        }
        unset(self::$remindersData[$eventModule][$eventModuleId]);
    }

    /**
     * Load multiple reminders JSON data for related Event module EditViews.
     * Call this function in module display function.
     *
     * @param string $eventModule Related event module name (Meetings/Calls)
     * @param string $eventModuleId Related event GUID
     * @return string JSON string contains the remainders
     * @throws Exception
     */
    public static function loadRemindersDataJson($eventModule, $eventModuleId, $isDuplicate = false)
    {
        $remindersData = self::loadRemindersData($eventModule, $eventModuleId, $isDuplicate);
        $remindersDataJson = json_encode($remindersData);
        if (!$remindersDataJson && json_last_error()) {
            throw new Exception(json_last_error_msg());
        }
        return $remindersDataJson;
    }

    /**
     * Load multiple reminders data for related Event module EditViews.
     * Call this function in module display function.
     *
     * @param string $eventModule Related event module name (Meetings/Calls)
     * @param string $eventModuleId Related event GUID
     * @return array contains the remainders
     * @throws Exception
     */
    public static function loadRemindersData($eventModule, $eventModuleId, $isDuplicate = false)
    {
        if (!isset(self::$remindersData[$eventModule][$eventModuleId]) || !$eventModuleId || $isDuplicate) {
            $ret = array();
            $reminders = BeanFactory::getBean('Reminders')->get_full_list("reminders.date_entered", "reminders.related_event_module = '$eventModule' AND reminders.related_event_module_id = '$eventModuleId'");
            if ($reminders) {
                foreach ($reminders as $reminder) {
                    $ret[] = array(
                        'id' => $isDuplicate ? null : $reminder->id,
                        'popup' => $reminder->popup,
                        'email' => $reminder->email,
                        'timer_popup' => $reminder->timer_popup,
                        'timer_email' => $reminder->timer_email,
                        'invitees' => Reminder_Invitee::loadRemindersInviteesData($reminder->id, $isDuplicate),
                    );
                }
            }
            self::$remindersData[$eventModule][$eventModuleId] = $ret;
        }
        return self::$remindersData[$eventModule][$eventModuleId];
    }

    // ---- sending email reminders

    /**
     * Sending multiple email reminders.
     * Call in EmainReminder and use original EmailRemainder class for sending.
     *
     * @param EmailReminder $emailReminder Caller EmailReminder
     * @param Administration $admin Administration module for EmailRemainder->sendReminders() function
     * @param boolean $checkDecline (optional) Send email if user accept status is not decline. Default is TRUE.
     */
    public static function sendEmailReminders(EmailReminder $emailReminder, Administration $admin, $checkDecline = true)
    {
        if ($reminders = self::getUnsentEmailReminders()) {
            foreach ($reminders as $reminderId => $reminder) {
                $recipients = self::getEmailReminderInviteesRecipients($reminderId, $checkDecline);
                $eventBean = BeanFactory::getBean($reminder->related_event_module, $reminder->related_event_module_id);
                if ($eventBean && $emailReminder->sendReminders($eventBean, $admin, $recipients)) {
                    $reminder->email_sent = 1;
                    $reminder->save();
                }
            }
        }
    }

    private static function getEmailReminderInviteesRecipients($reminderId, $checkDecline = true)
    {
        $emails = array();
        $reminder = BeanFactory::getBean('Reminders', $reminderId);
        $eventModule = $reminder->related_event_module;
        $eventModuleId = $reminder->related_event_module_id;
        $event = BeanFactory::getBean($eventModule, $eventModuleId);
        if ($event && (!isset($event->status) || $event->status != 'Held')) {
            $invitees = BeanFactory::getBean('Reminders_Invitees')->get_full_list('', "reminders_invitees.reminder_id = '$reminderId'");
            foreach ($invitees as $invitee) {
                $inviteeModule = $invitee->related_invitee_module;
                $inviteeModuleId = $invitee->related_invitee_module_id;
                $personBean = BeanFactory::getBean($inviteeModule, $inviteeModuleId);
                // The original email reminders check the accept_status field in related users/leads/contacts etc. and filtered these users who not decline this event.
                if ($checkDecline && !self::isDecline($event, $personBean)) {
                    if (!empty($personBean->email1)) {
                        $arr = array(
                            'type' => $inviteeModule,
                            'name' => $personBean->full_name,
                            'email' => $personBean->email1,
                        );
                        $emails[] = $arr;
                    }
                }
            }
        }
        return $emails;
    }

    private static function getUnsentEmailReminders()
    {
        global $timedate;
        $reminders = array();
        $reminderBeans = BeanFactory::getBean('Reminders')->get_full_list('', "reminders.email = 1 AND reminders.email_sent = 0");
        if (!empty($reminderBeans)) {
            foreach ($reminderBeans as $reminderBean) {
                $eventBean = BeanFactory::getBean($reminderBean->related_event_module, $reminderBean->related_event_module_id);
                if($eventBean) {
                    $remind_ts = $timedate->fromUser($eventBean->date_start)->modify("-{$reminderBean->timer_email} seconds")->ts;
                    $now_ts = $timedate->getNow()->ts;
                    if ($now_ts >= $remind_ts) {
                        $reminders[$reminderBean->id] = $reminderBean;
                    }
                } else {
                    $reminderBean->mark_deleted($reminderBean->id);
                }
            }
        }
        return $reminders;
    }
	
	public static function addNotifications(jsAlerts $alert, $checkDecline = true, $forUserID = false)
	{
		if (defined('NETCOMTESTINGZ')) {
			self::addNotifications_test($alert,$checkDecline,$forUserID);
		}	
		else
		{
			self::addNotifications_prod($alert,$checkDecline);
		}
	}

    // ---- popup and alert reminders

    /**
     * Show a popup and/or desktop notification alert for related users with related Event information.
     * Call in jsAlerts class and use original jsAlerts for show notifications.
     *
     * @global ??? $current_user
     * @global ??? $timedate
     * @global ??? $app_list_strings
     * @global ??? $db
     * @global ??? $sugar_config
     * @global ??? $app_strings
     * @param jsAlerts $alert caller jsAlerts object
     * @param boolean $checkDecline (optional) Send email if user accept status is not decline. Default is TRUE.
     * @return ???
     */
    public static function addNotifications_test(jsAlerts $alert, $checkDecline = true, $forUserID = false)
    {
        global $current_user, $timedate, $app_list_strings, $db, $sugar_config, $app_strings;
		//return;
		echo "\n\n\n\n".'TEST NETCOM'."\n";
		//print_r($app_list_strings);
		echo "\n\n\n\n";
        if (empty($forUserID)) {
            return;
        }
echo "\n\n\n\n".'TEST NETCOM'."\n";
        // Create separate variable to hold timedate value
        // These timedates need to be in the user time zone as the
        // datetime returned by the Bean below is in the user time zone
        $alertDateTimeNow = $timedate->getNow(true)->asDb(false);
		
		//print_r($app_list_strings);
		//$reminderMaxTime = $app_list_strings['reminder_max_time'];
		$reminderMaxTime = 9000;
        // cn: get a boundary limiter
        $dateTimeMax = $timedate->getNow(true)->modify("+{$reminderMaxTime} seconds")->asDb(false);
		$dateTimeMaxUnix = time()+$reminderMaxTime;
		
        $dateTimeNow = $timedate->getNow(true)->asDb(false);

        $dateTimeNow = $db->convert($db->quoted($dateTimeNow), 'datetime');
        $dateTimeMax = $db->convert($db->quoted($dateTimeMax), 'datetime');

        // Original jsAlert used to a meeting integration.

        ///////////////////////////////////////////////////////////////////////
        ////	MEETING INTEGRATION
        $meetingIntegration = null;
        if (isset($sugar_config['meeting_integration']) && !empty($sugar_config['meeting_integration'])) {
            if (!class_exists($sugar_config['meeting_integration'])) {
                require_once("modules/{$sugar_config['meeting_integration']}/{$sugar_config['meeting_integration']}.php");
            }
            $meetingIntegration = new $sugar_config['meeting_integration']();
        }
        ////	END MEETING INTEGRATION
        ///////////////////////////////////////////////////////////////////////
		//date_willexecute
        $popupReminders = BeanFactory::getBean('Reminders')->get_full_list('', "reminders.popup = 1");
		//$popupReminders = BeanFactory::getBean('Reminders')->get_full_list('', "reminders.popup = 1 AND (reminders.date_willexecute IS NULL OR reminders.date_willexecute >= ".$dateTimeMaxUnix.")");
		echo "\n\n\n\n".'<!-- '."\n";
		
		echo count($popupReminders);
		echo '-->'."\n\n\n\n";
		$start = microtime(true);
        if ($popupReminders) {
			$i_runs = 0;
            foreach ($popupReminders as $popupReminder) {
				
                $relatedEvent = BeanFactory::getBean($popupReminder->related_event_module, $popupReminder->related_event_module_id);
				
				/** UPDATE REMINDER EXECUTION TIME ************************************************************************************************/
				if (
					isset($popupReminder->fetched_row) &&
					array_key_exists('date_willexecute',$popupReminder->fetched_row) && 
					empty($popupReminder->fetched_row['date_willexecute']) &&
					$i_runs < 100 //update reminders 10 times, we dont want to overload anything
				){
					//we have column to save data
					$r = BeanFactory::getBean('Reminders', $popupReminder->id);
					//$r->date_willexecute = strtotime($relatedEvent->date_start);
					$r->date_willexecute = strtotime(str_replace('/', '-', $relatedEvent->date_start));	
					$db->query("update reminders set date_willexecute='".$r->date_willexecute."' where id='".$popupReminder->id."'");
					$r->save();
					unset($r);
					$i_runs++;
				}
				
				/** UPDATE REMINDER EXECUTION TIME END  ******************************************************************************************/
			
                if ($relatedEvent &&
                    (!isset($relatedEvent->status) || $relatedEvent->status == 'Planned') &&
                    (!isset($relatedEvent->date_start) || (strtotime($relatedEvent->date_start) >= strtotime(self::unQuoteTime($dateTimeNow)) && strtotime($relatedEvent->date_start) <= strtotime(self::unQuoteTime($dateTimeMax)))) &&
                    (!$checkDecline || ($checkDecline && !self::isDecline($relatedEvent, BeanFactory::getBean('Users', $forUserID))))
                ) {
					echo 'DA';
                    // The original popup/alert reminders check the accept_status field in related users/leads/contacts etc. and filtered these users who not decline this event.
                    $invitees = BeanFactory::getBean('Reminders_Invitees')->get_full_list('', "reminders_invitees.reminder_id = '{$popupReminder->id}' AND reminders_invitees.related_invitee_module_id = '{$forUserID}'");
                    if ($invitees) {
                        foreach ($invitees as $invitee) {
                            // need to concatenate since GMT times can bridge two local days
                            $timeStart = strtotime($db->fromConvert(isset($relatedEvent->date_start) ? $relatedEvent->date_start : date(TimeDate::DB_DATETIME_FORMAT), 'datetime'));
                            $timeRemind = $popupReminder->timer_popup;
                            $timeStart -= $timeRemind;

                            $url = 'index.php?action=DetailView&module=' . $popupReminder->related_event_module . '&record=' . $popupReminder->related_event_module_id;
                            $instructions = $app_strings['MSG_JS_ALERT_MTG_REMINDER_MEETING_MSG'];

                            if ($popupReminder->related_event_module == 'Meetings') {
                                ///////////////////////////////////////////////////////////////////
                                ////	MEETING INTEGRATION
                                if (!empty($meetingIntegration) && $meetingIntegration->isIntegratedMeeting($popupReminder->related_event_module_id)) {
                                    $url = $meetingIntegration->miUrlGetJsAlert((array)$popupReminder);
                                    $instructions = $meetingIntegration->miGetJsAlertInstructions();
                                }
                                ////	END MEETING INTEGRATION
                                ///////////////////////////////////////////////////////////////////
                            }

                            $meetingName = from_html(isset($relatedEvent->name) ? $relatedEvent->name : $app_strings['MSG_JS_ALERT_MTG_REMINDER_NO_EVENT_NAME']);
                            $desc1 = from_html(isset($relatedEvent->description) ? $relatedEvent->description : $app_strings['MSG_JS_ALERT_MTG_REMINDER_NO_DESCRIPTION']);
                            $location = from_html(isset($relatedEvent->location) ? $relatedEvent->location : $app_strings['MSG_JS_ALERT_MTG_REMINDER_NO_LOCATION']);

                            $relatedToMeeting = $alert->getRelatedName($popupReminder->related_event_module, $popupReminder->related_event_module_id);

                            $description = empty($desc1) ? '' : $app_strings['MSG_JS_ALERT_MTG_REMINDER_AGENDA'] . $desc1 . "\n";
                            $description = $description . "\n" . $app_strings['MSG_JS_ALERT_MTG_REMINDER_STATUS'] . (isset($relatedEvent->status) ? $relatedEvent->status : '') . "\n" . $app_strings['MSG_JS_ALERT_MTG_REMINDER_RELATED_TO'] . $relatedToMeeting;


                            if (isset($relatedEvent->date_start)) {
                                $time_dbFromConvert = $db->fromConvert($relatedEvent->date_start, 'datetime');
                                $time = $timedate->to_display_date_time($time_dbFromConvert);
                                if (!$time) {
                                    $time = $relatedEvent->date_start;
                                }
                                if (!$time) {
                                    $time = $app_strings['MSG_JS_ALERT_MTG_REMINDER_NO_START_DATE'];
                                }
                            } else {
                                $time = $app_strings['MSG_JS_ALERT_MTG_REMINDER_NO_START_DATE'];
                            }

                            // standard functionality
                            $alert->addAlert($app_strings['MSG_JS_ALERT_MTG_REMINDER_MEETING'], $meetingName,
                                $app_strings['MSG_JS_ALERT_MTG_REMINDER_TIME'] . $time,
                                $app_strings['MSG_JS_ALERT_MTG_REMINDER_LOC'] . $location .
                                $description .
                                $instructions,
                                $timeStart - strtotime($alertDateTimeNow),
                                $url
                            );
                        }
                    }
                }
            }
			echo microtime(true) - $start;
			
        }
    }

	public static function addNotifications_prod(jsAlerts $alert, $checkDecline = true)
    {
        global $current_user, $timedate, $app_list_strings, $db, $sugar_config, $app_strings;

        if (empty($current_user->id)) {
            return;
        }
        // Create separate variable to hold timedate value
        // These timedates need to be in the user time zone as the
        // datetime returned by the Bean below is in the user time zone
        $alertDateTimeNow = $timedate->getNow(true)->asDb(false);

        // cn: get a boundary limiter
        $dateTimeMax = $timedate->getNow(true)->modify("+{$app_list_strings['reminder_max_time']} seconds")->asDb(false);
		
		//NetCom
		$dateTimeMaxUnix = time()+$app_list_strings['reminder_max_time'];
		//NetCom
        $dateTimeNow = $timedate->getNow(true)->asDb(false);

        $dateTimeNow = $db->convert($db->quoted($dateTimeNow), 'datetime');
        $dateTimeMax = $db->convert($db->quoted($dateTimeMax), 'datetime');

        // Original jsAlert used to a meeting integration.

        ///////////////////////////////////////////////////////////////////////
        ////	MEETING INTEGRATION
        $meetingIntegration = null;
        if (isset($sugar_config['meeting_integration']) && !empty($sugar_config['meeting_integration'])) {
            if (!class_exists($sugar_config['meeting_integration'])) {
                require_once("modules/{$sugar_config['meeting_integration']}/{$sugar_config['meeting_integration']}.php");
            }
            $meetingIntegration = new $sugar_config['meeting_integration']();
        }
        ////	END MEETING INTEGRATION
        ///////////////////////////////////////////////////////////////////////
		
		//NetCom
        //$popupReminders = BeanFactory::getBean('Reminders')->get_full_list('', "reminders.popup = 1");
		$popupReminders = BeanFactory::getBean('Reminders')->get_full_list('', "reminders.popup = 1 AND (reminders.date_willexecute IS NULL OR reminders.date_willexecute >= ".$dateTimeMaxUnix.")");
		//NetCom
        if ($popupReminders) {
			$i_runs = 0;
            foreach ($popupReminders as $popupReminder) {
                $relatedEvent = BeanFactory::getBean($popupReminder->related_event_module, $popupReminder->related_event_module_id);
				
				/** NetCom UPDATE REMINDER EXECUTION TIME ************************************************************************************************/
				if (
					isset($popupReminder->fetched_row) &&
					array_key_exists('date_willexecute',$popupReminder->fetched_row) && 
					empty($popupReminder->fetched_row['date_willexecute']) &&
					$i_runs < 40 //update reminders 40 times, we dont want to overload anything
				){
					//we have column to save data
					$r = BeanFactory::getBean('Reminders', $popupReminder->id);
					//$r->date_willexecute = strtotime($relatedEvent->date_start);
					$r->date_willexecute = strtotime(str_replace('/', '-', $relatedEvent->date_start));	
					$db->query("update reminders set date_willexecute='".$r->date_willexecute."' where id='".$popupReminder->id."'");
					$r->save();
					unset($r);
					$i_runs++;
				}
				/** NetCom UPDATE REMINDER EXECUTION TIME END  ******************************************************************************************/
				
				
                if ($relatedEvent &&
                    (!isset($relatedEvent->status) || $relatedEvent->status == 'Planned') &&
                    (!isset($relatedEvent->date_start) || (strtotime($relatedEvent->date_start) >= strtotime(self::unQuoteTime($dateTimeNow)) && strtotime($relatedEvent->date_start) <= strtotime(self::unQuoteTime($dateTimeMax)))) &&
                    (!$checkDecline || ($checkDecline && !self::isDecline($relatedEvent, BeanFactory::getBean('Users', $current_user->id))))
                ) {
                    // The original popup/alert reminders check the accept_status field in related users/leads/contacts etc. and filtered these users who not decline this event.
                    $invitees = BeanFactory::getBean('Reminders_Invitees')->get_full_list('', "reminders_invitees.reminder_id = '{$popupReminder->id}' AND reminders_invitees.related_invitee_module_id = '{$current_user->id}'");
                    if ($invitees) {
                        foreach ($invitees as $invitee) {
                            // need to concatenate since GMT times can bridge two local days
                            $timeStart = strtotime($db->fromConvert(isset($relatedEvent->date_start) ? $relatedEvent->date_start : date(TimeDate::DB_DATETIME_FORMAT), 'datetime'));
                            $timeRemind = $popupReminder->timer_popup;
                            $timeStart -= $timeRemind;

                            $url = 'index.php?action=DetailView&module=' . $popupReminder->related_event_module . '&record=' . $popupReminder->related_event_module_id;
                            $instructions = $app_strings['MSG_JS_ALERT_MTG_REMINDER_MEETING_MSG'];

                            if ($popupReminder->related_event_module == 'Meetings') {
                                ///////////////////////////////////////////////////////////////////
                                ////	MEETING INTEGRATION
                                if (!empty($meetingIntegration) && $meetingIntegration->isIntegratedMeeting($popupReminder->related_event_module_id)) {
                                    $url = $meetingIntegration->miUrlGetJsAlert((array)$popupReminder);
                                    $instructions = $meetingIntegration->miGetJsAlertInstructions();
                                }
                                ////	END MEETING INTEGRATION
                                ///////////////////////////////////////////////////////////////////
                            }

                            $meetingName = from_html(isset($relatedEvent->name) ? $relatedEvent->name : $app_strings['MSG_JS_ALERT_MTG_REMINDER_NO_EVENT_NAME']);
                            $desc1 = from_html(isset($relatedEvent->description) ? $relatedEvent->description : $app_strings['MSG_JS_ALERT_MTG_REMINDER_NO_DESCRIPTION']);
                            $location = from_html(isset($relatedEvent->location) ? $relatedEvent->location : $app_strings['MSG_JS_ALERT_MTG_REMINDER_NO_LOCATION']);

                            $relatedToMeeting = $alert->getRelatedName($popupReminder->related_event_module, $popupReminder->related_event_module_id);

                            $description = empty($desc1) ? '' : $app_strings['MSG_JS_ALERT_MTG_REMINDER_AGENDA'] . $desc1 . "\n";
                            $description = $description . "\n" . $app_strings['MSG_JS_ALERT_MTG_REMINDER_STATUS'] . (isset($relatedEvent->status) ? $relatedEvent->status : '') . "\n" . $app_strings['MSG_JS_ALERT_MTG_REMINDER_RELATED_TO'] . $relatedToMeeting;


                            if (isset($relatedEvent->date_start)) {
                                $time_dbFromConvert = $db->fromConvert($relatedEvent->date_start, 'datetime');
                                $time = $timedate->to_display_date_time($time_dbFromConvert);
                                if (!$time) {
                                    $time = $relatedEvent->date_start;
                                }
                                if (!$time) {
                                    $time = $app_strings['MSG_JS_ALERT_MTG_REMINDER_NO_START_DATE'];
                                }
                            } else {
                                $time = $app_strings['MSG_JS_ALERT_MTG_REMINDER_NO_START_DATE'];
                            }

                            // standard functionality
                            $alert->addAlert($app_strings['MSG_JS_ALERT_MTG_REMINDER_MEETING'], $meetingName,
                                $app_strings['MSG_JS_ALERT_MTG_REMINDER_TIME'] . $time,
                                $app_strings['MSG_JS_ALERT_MTG_REMINDER_LOC'] . $location .
                                $description .
                                $instructions,
                                $timeStart - strtotime($alertDateTimeNow),
                                $url
                            );
                        }
                    }
                }
            }
        }
    }

    private static function unQuoteTime($timestr)
    {
        $ret = '';
        for ($i = 0; $i < strlen($timestr); $i++) {
            if ($timestr[$i] != "'") $ret .= $timestr[$i];
        }
        return $ret;
    }

    // --- test for accept status decline is?

    private static function isDecline(SugarBean $event, SugarBean $person)
    {
        return self::testEventPersonAcceptStatus($event, $person, 'decline');
    }

    private static function testEventPersonAcceptStatus(SugarBean $event, SugarBean $person, $acceptStatus = 'decline')
    {
        if ($acceptStats = self::getEventPersonAcceptStatus($event, $person)) {
            $acceptStatusLower = strtolower($acceptStatus);
            foreach ((array)$acceptStats as $acceptStat) {
                if (strtolower($acceptStat) == $acceptStatusLower) {
                    return true;
                }
            }
        }
        return false;
    }

    private static function getEventPersonAcceptStatus(SugarBean $event, SugarBean $person)
    {
        global $db;
        $rel_person_table_Key = "rel_{$person->table_name}_table";
        $rel_person_table_Value = "{$event->table_name}_{$person->table_name}";
        if (isset($event->$rel_person_table_Key) && $event->$rel_person_table_Key == $rel_person_table_Value) {
            $query = self::getEventPersonQuery($event, $person);
            $re = $db->query($query);
            $ret = array();
            while ($row = $db->fetchByAssoc($re)) {
                if (!isset($row['accept_status'])) {
                    return null;
                }
                $ret[] = $row['accept_status'];
            }
            return $ret;
        }
        return null;
    }

    private function upgradeEventPersonQuery(SugarBean $event, $person_table)
    {
        $eventIdField = strtolower($event->object_name) . '_id';
        $query = "
			SELECT * FROM {$event->table_name}_{$person_table}
			WHERE
				{$eventIdField} = '{$event->id}' AND
				deleted = 0
		";
        return $query;
    }

    private static function getEventPersonQuery(SugarBean $event, SugarBean $person)
    {
        $eventIdField = array_search($event->table_name, $event->relationship_fields);
        if (!$eventIdField) {
            $eventIdField = strtolower($event->object_name . '_id');
        }
        $personIdField = strtolower($person->object_name) . '_id';
        $query = "
			SELECT * FROM {$event->table_name}_{$person->table_name}
			WHERE
				{$eventIdField} = '{$event->id}' AND
				{$personIdField} = '{$person->id}' AND
				deleted = 0
		";
        return $query;
    }

    // --- user preferences as default values in reminders

    /**
     * Default values for Reminders from User Preferences
     * @return string JSON encoded default values
     * @throws Exception on json_encode error
     */
    public static function loadRemindersDefaultValuesDataJson()
    {
        $ret = json_encode(self::loadRemindersDefaultValuesData());
        if (!$ret && json_last_error()) {
            throw new Exception(json_last_error_msg());
        }
        return $ret;
    }

    /**
     * Default values for Reminders from User Preferences
     * @return array default values
     */
    public static function loadRemindersDefaultValuesData()
    {
        global $current_user;

        $preferencePopupReminderTime = $current_user->getPreference('reminder_time');
        $preferenceEmailReminderTime = $current_user->getPreference('email_reminder_time');
        $preferencePopupReminderChecked = $current_user->getPreference('reminder_checked');
        $preferenceEmailReminderChecked = $current_user->getPreference('email_reminder_checked');

        return array(
            'popup' => $preferencePopupReminderChecked,
            'email' => $preferenceEmailReminderChecked,
            'timer_popup' => $preferencePopupReminderTime,
            'timer_email' => $preferenceEmailReminderTime,
        );
    }

    // --- upgrade

    /**
     * Reminders upgrade, old reminders migrate to multiple-reminders.
     * @throws Exception unknown event type or any error
     */
    public static function upgrade()
    {
        self::upgradeUserPreferences();
        self::upgradeEventReminders('Calls');
        self::upgradeEventReminders('Meetings');
        self::upgradeRestoreReminders();
    }

    private static function upgradeRestoreReminders()
    {
        if ($reminders = BeanFactory::getBean('Reminders')->get_full_list('', 'reminders.deleted = 1')) {
            foreach ($reminders as $reminder) {
                $reminder->deleted = 0;
                $reminder->save();
            }
        }
        if ($reminderInvitees = BeanFactory::getBean('Reminders_Invitees')->get_full_list('', 'reminders_invitees.deleted = 1')) {
            foreach ($reminderInvitees as $invitee) {
                $invitee->deleted = 0;
                $invitee->save();
            }
        }
        global $db;
        $q = "UPDATE reminders SET deleted = 0";
        $db->query($q);
        $q = "UPDATE reminders_invitees SET deleted = 0";
        $db->query($q);
    }

    private static function upgradeUserPreferences()
    {
        $users = User::getActiveUsers();
        foreach ($users as $user_id => $user_name) {
            $user = new User();
            $user->retrieve($user_id);

            $preferencePopupReminderTime = $user->getPreference('reminder_time');
            $preferenceEmailReminderTime = $user->getPreference('email_reminder_time');

            $preferencePopupReminderChecked = $preferencePopupReminderTime > -1;
            $preferenceEmailReminderChecked = $preferenceEmailReminderTime > -1;
            $user->setPreference('reminder_checked', $preferencePopupReminderChecked);
            $user->setPreference('email_reminder_checked', $preferenceEmailReminderChecked);

        }
    }

	/**
	 * @param string $eventModule 'Calls' or 'Meetings'
	 */
    private static function upgradeEventReminders($eventModule)
    {
        global $db;

        $eventBean = BeanFactory::getBean($eventModule);
        $events = $eventBean->get_full_list('', "{$eventBean->table_name}.date_start >  {$db->convert('', 'today')} AND ({$eventBean->table_name}.reminder_time != -1 OR ({$eventBean->table_name}.email_reminder_time != -1 AND {$eventBean->table_name}.email_reminder_sent != 1))");
        if ($events) {
			foreach ($events as $event) {

                $oldReminderPopupChecked = false;
                $oldReminderPopupTimer = null;
                if ($event->reminder_time != -1) {
                    $oldReminderPopupChecked = true;
                    $oldReminderPopupTimer = $event->reminder_time;
                }

                $oldReminderEmailChecked = false;
                $oldReminderEmailTimer = null;
                if ($event->email_reminder_time != -1) {
                    $oldReminderEmailChecked = true;
                    $oldReminderEmailTimer = $event->email_reminder_time;
                }

                $oldReminderEmailSent = $event->email_reminder_sent;

                if (($oldInvitees = self::getOldEventInvitees($event)) && ($event->reminder_time != -1 || ($event->email_reminder_time != -1 && $event->email_reminder_sent != 1))) {

                    self::migrateReminder(
                        $eventModule,
                        $event->id,
                        $oldReminderPopupChecked,
                        $oldReminderPopupTimer,
                        $oldReminderEmailChecked,
                        $oldReminderEmailTimer,
                        $oldReminderEmailSent,
                        $oldInvitees
                    );

                }
            }
        }

    }


    private static function getOldEventInvitees(SugarBean $event)
    {
        global $db;
        $ret = array();
        $persons = array('users', 'contacts', 'leads');
        foreach ($persons as $person) {
            $query = self::upgradeEventPersonQuery($event, $person);
            $re = $db->query($query);
            while ($row = $db->fetchByAssoc($re)) {
                $ret[] = $row;
            }
        }
        return $ret;
    }

    /**
     * @param string $eventModule 'Calls' or 'Meetings'
     * @param string $eventModuleId
     * @param bool $oldReminderPopupChecked
     * @param int $oldReminderPopupTimer
     * @param bool $oldReminderEmailChecked
     * @param int $oldReminderEmailTimer
     * @param array $oldInvitees
     */
    private static function migrateReminder($eventModule, $eventModuleId, $oldReminderPopupChecked, $oldReminderPopupTimer, $oldReminderEmailChecked, $oldReminderEmailTimer, $oldReminderEmailSent, $oldInvitees)
    {

        $reminder = BeanFactory::getBean('Reminders');
        $reminder->popup = $oldReminderPopupChecked;
        $reminder->email = $oldReminderEmailChecked;
        $reminder->email_sent = $oldReminderEmailSent;
        $reminder->timer_popup = $oldReminderPopupTimer;
        $reminder->timer_email = $oldReminderEmailTimer;
        $reminder->related_event_module = $eventModule;
        $reminder->related_event_module_id = $eventModuleId;
        $reminder->save();
        $reminderId = $reminder->id;
        self::migrateReminderInvitees($reminderId, $oldInvitees);

        self::removeOldReminder($eventModule, $eventModuleId);
    }

    private static function migrateReminderInvitees($reminderId, $invitees)
    {
        $ret = array();
        foreach ((array)$invitees as $invitee) {
            $newInvitee = BeanFactory::getBean('Reminders_Invitees');
            $newInvitee->reminder_id = $reminderId;
            $newInvitee->related_invitee_module = self::getRelatedInviteeModuleFromInviteeArray($invitee);
            $newInvitee->related_invitee_module_id = self::getRelatedInviteeModuleIdFromInviteeArray($invitee);
            $newInvitee->save();
        }
        return $ret;
    }

    private static function getRelatedInviteeModuleFromInviteeArray($invitee)
    {
        if (array_key_exists('user_id', $invitee)) {
            return 'Users';
        }
        if (array_key_exists('lead_id', $invitee)) {
            return 'Leads';
        }
        if (array_key_exists('contact_id', $invitee)) {
            return 'Contacts';
        }
        // TODO:!!!!
        throw new Exception('Unknown invitee module type');
        //return null;
    }

    private static function getRelatedInviteeModuleIdFromInviteeArray($invitee)
    {
        if (array_key_exists('user_id', $invitee)) {
            return $invitee['user_id'];
        }
        if (array_key_exists('lead_id', $invitee)) {
            return $invitee['lead_id'];
        }
        if (array_key_exists('contact_id', $invitee)) {
            return $invitee['contact_id'];
        }
        // TODO:!!!!
        throw new Exception('Unknown invitee type');
        //return null;
    }

    /**
     * @param string $eventModule 'Calls' or 'Meetings'
     * @param string $eventModuleId
     */
    private static function removeOldReminder($eventModule, $eventModuleId)
    {
        $event = BeanFactory::getBean($eventModule, $eventModuleId);
        $event->reminder_time = -1;
        $event->email_reminder_time = -1;
        $event->email_reminder_sent = 0;
        $event->save();
    }

    // --- reminders list on detail views

    /**
     * Return a list of related reminders for specified event (Calls/Meetings). Call it from DetailViews.
     * @param SugarBean $event a Call or Meeting Bean
     * @return mixed|string|void output of list (html)
     * @throws Exception on json error in Remainders
     */
    public static function getRemindersListView(SugarBean $event)
    {
        global $mod_strings, $app_list_strings;
        $tpl = new Sugar_Smarty();
        $tpl->assign('MOD', $mod_strings);
        $tpl->assign('reminder_time_options', $app_list_strings['reminder_time_options']);
        $tpl->assign('remindersData', Reminder::loadRemindersData($event->module_name, $event->id));
        $tpl->assign('remindersDataJson', Reminder::loadRemindersDataJson($event->module_name, $event->id));
        $tpl->assign('remindersDefaultValuesDataJson', Reminder::loadRemindersDefaultValuesDataJson());
        $tpl->assign('remindersDisabled', json_encode(true));
        return $tpl->fetch('modules/Reminders/tpls/reminders.tpl');
    }

    /*
     * @todo implenent it
     */
    public static function getRemindersListInlineEditView(SugarBean $event)
    {
        // TODO: getEditFieldHTML() function in InlineEditing.php:218 doesn't pass the Bean ID to this custom inline edit view function but we have to know which Bean are in the focus to editing.
        if (!$event->id) {
            throw new Exception("No GUID for edit.");
        }
    }

}

?>
