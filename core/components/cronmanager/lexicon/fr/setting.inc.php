<?php
/**
 * Setting Lexicon Entries for CronManager
 *
 * @package cronmanager
 * @subpackage lexicon
 */
$_lang['setting_cronmanager.cronjob_id'] = 'ID Cronjob';
$_lang['setting_cronmanager.cronjob_id_desc'] = 'Chaîne, qui doit être ajoutée à l’url de cronjob comme paramètre cronjob_id.';
$_lang['setting_cronmanager.daylight_saving'] = 'Prendre en compte l’heure d’été';
$_lang['setting_cronmanager.daylight_saving_desc'] = 'Lors du calcul de la prochaine exécution de la tâche cron, prendre en compte l’heure d’été (utilisé uniquement si l’intervalle entre deux exécutions est supérieur à 60 minutes)';
$_lang['setting_cronmanager.debug'] = 'Débogage';
$_lang['setting_cronmanager.debug_desc'] = 'Enregistrer les informations de débogage dans le journal des erreurs du MODX.';
$_lang['setting_cronmanager.pass_modcronjob'] = 'Passer le modCronjob';
$_lang['setting_cronmanager.pass_modcronjob_desc'] = 'Passer l’instance de modCronjob au snippet exécuté dans la propriété du snippet CronManagerJob. Désactivez cette option si le snippet cronjob génère une erreur “Object of class modCronjob_mysql could not be converted to string”.';
$_lang['setting_cronmanager.purge_running'] = 'Nettoyage des cronjobs en cours';
$_lang['setting_cronmanager.purge_running_desc'] = 'Nombre de minutes après lesquelles les tâches cron en cours d’exécution sont supprimées afin de réinitialiser celles qui ne répondent plus.';
