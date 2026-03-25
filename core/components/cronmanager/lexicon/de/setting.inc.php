<?php
/**
 * Setting Lexicon Entries for CronManager
 *
 * @package cronmanager
 * @subpackage lexicon
 */
$_lang['setting_cronmanager.cronjob_id'] = 'Cronjob-ID';
$_lang['setting_cronmanager.cronjob_id_desc'] = 'String, der als cronjob_id-Parameter zur Cronjob-URL hinzugefügt werden muss.';
$_lang['setting_cronmanager.daylight_saving'] = 'Sommerzeit berücksichtigen';
$_lang['setting_cronmanager.daylight_saving_desc'] = 'Bei der Berechnung des nächsten Ausführungszeitpunkts des Cron-Jobs die Sommerzeit berücksichtigen (wird nur verwendet, wenn der Abstand zwischen zwei Ausführungen mehr als 60 Minuten beträgt)';
$_lang['setting_cronmanager.debug'] = 'Debug';
$_lang['setting_cronmanager.debug_desc'] = 'Debug-Informationen im MODX Fehlerprotokoll ausgeben.';
$_lang['setting_cronmanager.pass_modcronjob'] = 'modCronjob übergeben';
$_lang['setting_cronmanager.pass_modcronjob_desc'] = 'Übergeben Sie die modCronjob-Instanz an das ausgeführte Snippet in der Snippet-Eigenschaft CronManagerJob. Deaktivieren Sie die Option, wenn das Cronjob-Snippet einen Fehler „Object of class modCronjob_mysql could not be converted to string“ auslöst.';
$_lang['setting_cronmanager.purge_running'] = 'Bereinigung der laufenden Cronjobs';
$_lang['setting_cronmanager.purge_running_desc'] = 'Anzahl der Minuten, nach denen laufende Cronjobs bereinigt werden, um nicht mehr reagierende Cronjobs zurückzusetzen.';
