<?php
/**
 * Deletes multiple cronjob logs
 *
 * @var modX $modx
 * @var array $scriptProperties
 * @package cronmanager
 * @subpackage processors
 */
if (empty($scriptProperties['ids'])) return $modx->error->failure();
$logs = explode(',', $scriptProperties['ids']);
/** @var $modCronjobLog modCronjobLog */
foreach ($logs as $logId) {
    $modCronjobLog = $modx->getObject('modCronjobLog', $logId);
    if (empty($modCronjobLog)) continue;
    $modCronjobLog->remove();
}

return $modx->error->success();