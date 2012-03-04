<?php
/**
 * The default lexicon topics for the Cron Manager
 *
 * @package cronmanager
 * @subpackage lexicon
 */

$_lang['cronmanager'] = "Cron Manager";
$_lang['cronmanager.desc'] = "Manage all your cronjobs via the manager interface.";
$_lang['cronmanager.search...'] = "Search...";
$_lang['cronmanager.cronjobs'] = "Cronjobs";
$_lang['cronmanager.cronjobs_desc'] = "Below you can add, modify or remove cronjob actions. Remember these cronjob actions are only working if the setup of the Cron Manager is followed successfull! See the documentation (or help button) for more details.";
$_lang['cronmanager.selectasnippet'] = "Please select a snippet";
$_lang['cronmanager.norecords'] = "There are no cronjob records found";

$_lang['cronmanager.create'] = "Create new cronjob";
$_lang['cronmanager.create.error_save'] = "Failed to save the new cronjob. Try it again!";
$_lang['cronmanager.search...'] = "Search...";
$_lang['cronmanager.id'] = "Cron ID";
$_lang['cronmanager.snippet'] = "Snippet";
$_lang['cronmanager.minutes'] = "Minutes";
$_lang['cronmanager.minutes_desc'] = "The number of minutes between the intervals this snippets needs to be executed. Minimum value is 1 minute.";
$_lang['cronmanager.properties'] = "Snippet properties";
$_lang['cronmanager.properties_desc'] = "You can enter a propertyset-name, enter key value pairs;<br /><ul><li>key: value</li><li>key2: value2</li></ul>or enter a raw json object.";
$_lang['cronmanager.lastrun'] = "Last run";
$_lang['cronmanager.nextrun'] = "Next run";
$_lang['cronmanager.runempty'] = "Cronjob not started yet";
$_lang['cronmanager.active'] = "Active";

$_lang['cronmanager.update'] = "Update cronjob";
$_lang['cronmanager.error_update'] = "Failed updating the cronjob. Please try it again!";
$_lang['cronmanager.viewlog'] = "View cron log";
$_lang['cronmanager.logview'] = "View the cronjob log for [[+snippet]]...";
$_lang['cronmanager.remove'] = "Remove cronjob";
$_lang['cronmanager.remove_confirm'] = "Are you sure you want to remove [[+snippet]] from the cronjob list?";
$_lang['cronmanager.error_remove'] = "Something is going wrong while removing the cronjob. Please try it again!";

// log part
$_lang['cronmanager.log'] = "Logs for cronjob";
$_lang['cronmanager.log.btnback'] = "Back to cronjobs";
$_lang['cronmanager.logs'] = "Cronjob logs";
$_lang['cronmanager.logs_desc'] = "View the logs for the selected cronjob.";
$_lang['cronmanager.log.norecords'] = "No log records found for this cronjob";
$_lang['cronmanager.log.date'] = "Logdate";
$_lang['cronmanager.log.message'] = "Log message";
$_lang['cronmanager.log.errorload'] = "Failed to load the cronjob for this log.";

$_lang['cronmanager.cronjob_err_ns'] = 'No cronjob ID set.';
$_lang['cronmanager.log_day'] = 'Day';
$_lang['cronmanager.log_error'] = 'Error';
$_lang['cronmanager.log_message'] = 'message';
$_lang['cronmanager.log_messages'] = 'messages';
$_lang['cronmanager.log_view_full'] = 'View the full log';
$_lang['cronmanager.logs_actions'] = 'Actions';
$_lang['cronmanager.logs_delete_selected'] = 'Delete selected logs';
$_lang['cronmanager.logs_delete_selected_confirm'] = 'Are you sure you want to permanently delete selected logs messages?';
$_lang['cronmanager.logs_filter_all'] = 'All logs';
$_lang['cronmanager.logs_filter_error'] = 'With error(s)';
$_lang['cronmanager.logs_filter_no_error'] = 'Without error';
$_lang['cronmanager.logs_purge_all'] = 'Purge all logs';
$_lang['cronmanager.logs_purge_confirm'] = 'Are you sure you want to purge this cronjob\'s logs without error?<br /><br /><p style="color: red; font-weight: bold; text-decoration: underline">Warning</p><br />Make sure your snippet/job correctly defines the error "status", otherwise all your logs for this job will be wiped.';
$_lang['cronmanager.logs_purge_no_err'] = 'Purge logs without error';
$_lang['cronmanager.logs_purge_nothing'] = 'Nothing to purge';
$_lang['cronmanager.logs_purge_success'] = '[[+total]] log(s) successfully purged.';
$_lang['cronmanager.logs_purge_title'] = 'Purge logs';

?>