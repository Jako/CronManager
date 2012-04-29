<?php
/**
 * The default lexicon topics for the Cron Manager
 *
 * @package cronmanager
 * @subpackage lexicon
 */

$_lang['cronmanager'] = "Cron Manager";
$_lang['cronmanager.desc'] = "Gérez vos tâches cron depuis le manager.";
$_lang['cronmanager.search...'] = "Rechercher…";
$_lang['cronmanager.cronjobs'] = "Tâches cron";
$_lang['cronmanager.cronjobs_desc'] = "Ci-dessous, vous pouvez ajouter, modifier ou supprimer des tâches pour cron. Notez que ces tâches ne seront effectives que si vous avez convenablement installé Cron Manager! Consultez la documentation (ou le bouton d'aide) pour plus d'informations.";
$_lang['cronmanager.selectasnippet'] = "Veuillez choisir un snippet";
$_lang['cronmanager.norecords'] = "Pas de tâche trouvée";

$_lang['cronmanager.create'] = "Créer une nouvelle tâche cron";
$_lang['cronmanager.create.error_save'] = "Erreur lors de l'enregistrement de la tâche. Veuillez ré-essayer!";
$_lang['cronmanager.search...'] = "Rechercher…";
$_lang['cronmanager.id'] = "ID Cron";
$_lang['cronmanager.snippet'] = "Snippet";
$_lang['cronmanager.minutes'] = "Minute(s)";
$_lang['cronmanager.minutes_desc'] = "Interval, en minutes, durant lequel ce snippet doit être éxecuté. La valeur minimale est 1 minute.";
$_lang['cronmanager.properties'] = "Propriétés du snippet";
$_lang['cronmanager.properties_desc'] = "Vous pouvez entrer le nom d'un set de propriétés, un jeu de clé-valeur;<br /><ul><li>clé: valeur</li><li>clé2: valeur2</li></ul>ou un objet JSON.";
$_lang['cronmanager.lastrun'] = "Dernière exécution";
$_lang['cronmanager.nextrun'] = "Prochaine exécution";
$_lang['cronmanager.runempty'] = "Tâche pas encore démarrée";
$_lang['cronmanager.active'] = "Active";

$_lang['cronmanager.update'] = "Mettre à jour la tâche cron";
$_lang['cronmanager.error_update'] = "Erreur lors de la mise à jour de la tâche. Veuillez ré-essayer!";
$_lang['cronmanager.viewlog'] = "Consulter le log de cron";
$_lang['cronmanager.logview'] = "Consulter le log de cron pour [[+snippet]]…";
$_lang['cronmanager.remove'] = "Supprimer la tâche cron";
$_lang['cronmanager.remove_confirm'] = "Êtes-vous sûr de vouloir supprimer [[+snippet]] de la liste de tâches cron ?";
$_lang['cronmanager.error_remove'] = "Une erreur est survenue lors de la suppression de la tâche. Veuillez ré-essayer!";

// log part
$_lang['cronmanager.log'] = "Logs des tâches cron";
$_lang['cronmanager.log.btnback'] = "Retour aux tâches";
$_lang['cronmanager.logs'] = "Logs de la tâche";
$_lang['cronmanager.logs_desc'] = "Consultez les logs de la tâche sélectionnée.";
$_lang['cronmanager.log.norecords'] = "Aucune entrée de log pour cette tâche";
$_lang['cronmanager.log.date'] = "Date du log";
$_lang['cronmanager.log.message'] = "Message de log";
$_lang['cronmanager.log.errorload'] = "Impossible d'exécuter la tâche pour ce log.";

$_lang['cronmanager.cronjob_err_ns'] = 'Aucun ID de cronjob de défini.';
$_lang['cronmanager.log_day'] = 'Jour';
$_lang['cronmanager.log_error'] = 'Erreur';
$_lang['cronmanager.log_message'] = 'message';
$_lang['cronmanager.log_messages'] = 'messages';
$_lang['cronmanager.log_view_full'] = 'Voir le log complet';
$_lang['cronmanager.logs_actions'] = 'Actions';
$_lang['cronmanager.logs_delete_selected'] = 'Supprimer les logs sélectionnés';
$_lang['cronmanager.logs_delete_selected_confirm'] = 'Êtes-vous sûr de vouloir supprimer de manière définitive les messages de logs sélectionnés ?';
$_lang['cronmanager.logs_filter_all'] = 'Tous les logs';
$_lang['cronmanager.logs_filter_error'] = 'Avec erreur(s)';
$_lang['cronmanager.logs_filter_no_error'] = 'Sans erreur';
$_lang['cronmanager.logs_purge_all'] = 'Purger tous les logs';
$_lang['cronmanager.logs_purge_confirm'] = 'Êtes-vous sûr de vouloir purger les logs sans erreur de ce cronjob ?<br /><br /><p style="color: red; font-weight: bold; text-decoration: underline">Attention</p><br />Assurez-vous que votre snippet définisse correctement le « statut » des erreurs, sinon tous les logs de ce cronjob seront purgés.';
$_lang['cronmanager.logs_purge_no_err'] = 'Purger les logs sans erreur';
$_lang['cronmanager.logs_purge_nothing'] = 'Aucun log à purger';
$_lang['cronmanager.logs_purge_success'] = '[[+total]] log(s) purgé(s) avec succès.';
$_lang['cronmanager.logs_purge_title'] = 'Purger les logs';

?>