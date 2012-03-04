<?php
/**
 * Purges logs from the given Cronjob
 *
 * @var modX $modx
 * @var array $scriptProperties
 * @package cronmanager
 * @subpackage processors
 */
$cronjob = $modx->getOption('cronjob', $scriptProperties, false);
$error_only = (bool) $modx->getOption('error_only', $scriptProperties, true);

if (!$cronjob) {
    return $modx->error->failure($modx->lexicon('cronmanager.cronjob_err_ns'));
}

$criteria = array('cronjob' => $cronjob);
if ($error_only) {
    //$modx->log(modX::LOG_LEVEL_ERROR, 'error only');
    $criteria = array_merge($criteria, array('error' => 0));
} /*else {
    $modx->log(modX::LOG_LEVEL_ERROR, 'wipe all');
}*/

$total = $modx->removeCollection('modCronjobLog', $criteria);

if ($total >= 1) {
    $response = $modx->lexicon('cronmanager.logs_purge_success', array('total' => $total));
} else {
    $response = $modx->lexicon('cronmanager.logs_purge_nothing');
}
return $modx->error->success($response);