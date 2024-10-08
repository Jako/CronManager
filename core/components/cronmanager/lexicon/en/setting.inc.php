<?php
/**
 * Setting Lexicon Entries for CronManager
 *
 * @package cronmanager
 * @subpackage lexicon
 */
$_lang['setting_cronmanager.cronjob_id'] = 'Cronjob ID';
$_lang['setting_cronmanager.cronjob_id_desc'] = 'String, that has to be added to the cronjob URL as cronjob_id parameter.';
$_lang['setting_cronmanager.debug'] = 'Debug';
$_lang['setting_cronmanager.debug_desc'] = 'Log debug information in the MODX error log.';
$_lang['setting_cronmanager.pass_modcronjob'] = 'Pass modCronjob';
$_lang['setting_cronmanager.pass_modcronjob_desc'] = 'Pass the modCronjob instance to the executed snippet in the CronManagerJob snippet property. Disable the option if the cronjob snippet throws an "Object of class modCronjob_mysql could not be converted to string" error.';
$_lang['setting_cronmanager.purge_running'] = 'Purge Running Cronjobs';
$_lang['setting_cronmanager.purge_running_desc'] = 'Number of minutes after which running cronjobs are cleaned up in order to reset cronjobs that are no longer responding.';
