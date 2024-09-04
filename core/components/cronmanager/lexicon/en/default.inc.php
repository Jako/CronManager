<?php
/**
 * Default Lexicon Entries for CronManager
 *
 * @package cronmanager
 * @subpackage lexicon
 */
$_lang['cronmanager'] = 'CronManager';
$_lang['cronmanager.active'] = 'Active';
$_lang['cronmanager.create'] = 'Create New Cronjob';
$_lang['cronmanager.cronjoblog'] = 'Logs';
$_lang['cronmanager.cronjoblog_desc'] = 'Below you can view cronjob the log of all cronjobs of CronManager.';
$_lang['cronmanager.cronjobs'] = 'Cronjobs';
$_lang['cronmanager.cronjobs_desc'] = 'Below you can add, modify or remove cronjob actions. They will only work if the CronManager setup is followed. The documentation (or help button) has more details.';
$_lang['cronmanager.debug_mode'] = 'Debug Mode';
$_lang['cronmanager.job_started'] = 'Cronjob executed';
$_lang['cronmanager.job_started_message'] = 'The cronjob [[+id]] has been executed.';
$_lang['cronmanager.jobs_started'] = 'Cronjobs executed';
$_lang['cronmanager.jobs_started_message'] = 'The cronjobs have been executed.';
$_lang['cronmanager.lastrun'] = 'Last Run';
$_lang['cronmanager.log.date'] = 'Logdate';
$_lang['cronmanager.log.message'] = 'Log Message';
$_lang['cronmanager.log.norecords'] = 'No log records found for this cronjob';
$_lang['cronmanager.log_day'] = 'Day';
$_lang['cronmanager.log_error'] = 'Error';
$_lang['cronmanager.log_message'] = 'message';
$_lang['cronmanager.log_messages'] = 'messages';
$_lang['cronmanager.log_view_full'] = 'View Full Log Message';
$_lang['cronmanager.logs_actions'] = 'Actions';
$_lang['cronmanager.logs_delete_selected'] = 'Delete Selected Log Entries';
$_lang['cronmanager.logs_delete_selected_confirm'] = 'Permanently delete [[+n]] log messages?';
$_lang['cronmanager.logs_delete_selected_confirm_one'] = 'Permanently delete this log message?';
$_lang['cronmanager.logs_delete_selected_one'] = 'Delete This Log Entry';
$_lang['cronmanager.logs_filter_all'] = 'All Logs';
$_lang['cronmanager.logs_filter_error'] = 'With Error(s)';
$_lang['cronmanager.logs_filter_no_error'] = 'Without Error';
$_lang['cronmanager.logs_purge_confirm'] = 'Purge the logs of this cronjob that don’t contain errors?<br><br><span class="red">Warning:</span> Make sure that your snippet/job correctly outputs the `error` status in a JSON object, otherwise all logs for this cronjob will be wiped.';
$_lang['cronmanager.logs_purge_db_err'] = 'Attempted to purge logs but a query error occurred. See the MODX and/or server logs for more information.';
$_lang['cronmanager.logs_purge_no_err'] = 'Purge Logs Without Error';
$_lang['cronmanager.logs_purge_nothing'] = 'Nothing to purge';
$_lang['cronmanager.logs_purge_success'] = '[[+total]] log(s) purged.';
$_lang['cronmanager.logs_purge_title'] = 'Purge Logs';
$_lang['cronmanager.menu'] = 'CronManager';
$_lang['cronmanager.menu_desc'] = 'Manage cronjobs within the manager';
$_lang['cronmanager.minutes'] = 'Minutes';
$_lang['cronmanager.minutes_desc'] = 'How often this snippet has to be executed. Minimum one minute.';
$_lang['cronmanager.nextrun'] = 'Next Run';
$_lang['cronmanager.norecords'] = 'There are no cronjob records found';
$_lang['cronmanager.properties'] = 'Snippet Properties';
$_lang['cronmanager.properties_desc'] = 'You can enter a propertyset name, enter key value pairs<br><ul><li>key: value</li><li>key2: value2</li></ul>or enter a JSON object in raw form.';
$_lang['cronmanager.remove'] = 'Remove Cronjob';
$_lang['cronmanager.remove_confirm'] = 'Are you sure you want to remove [[+snippet]] from the cronjob list?';
$_lang['cronmanager.run_job'] = 'Run Cronjob';
$_lang['cronmanager.run_job_confirm'] = 'Are you sure you want to run the cronjob [[+id]]?';
$_lang['cronmanager.run_jobs'] = 'Run Cronjobs';
$_lang['cronmanager.run_jobs_confirm'] = 'Are you sure you want to run the cronjobs?';
$_lang['cronmanager.runempty'] = 'Cronjob not started yet';
$_lang['cronmanager.running'] = 'Running';
$_lang['cronmanager.selectasnippet'] = 'Please select a snippet';
$_lang['cronmanager.settings'] = '<i class="icon icon-cog"></i>';
$_lang['cronmanager.settings_desc'] = 'Edit the settings of CronManager. You can edit the value of a system setting by double-clicking on the ‘Value’ table cell or by right-clicking in the table cell.';
$_lang['cronmanager.snippet'] = 'Snippet';
$_lang['cronmanager.systemsetting_key_err_nv'] = 'You can only edit settings with the prefix cronmanager.';
$_lang['cronmanager.systemsetting_usergroup_err_nv'] = 'Only users with a settings permission or settings_cronmanager permission can change the settings.';
$_lang['cronmanager.update'] = 'Update Cronjob';
$_lang['cronmanager.viewlog'] = 'View Cron Log';
$_lang['cronmanager.viewlog_title'] = 'View Cron Log for [[+snippet]]';
