<?php
/**
 * CronManager cron connector
 *
 * @package cronmanager
 * @subpackage connector
 *
 * @var modX $modx
 */

// For access without authorization
define('MODX_REQP', false);

require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
require_once MODX_CONNECTORS_PATH . 'index.php';

$corePath = $modx->getOption('cronmanager.core_path', null, $modx->getOption('core_path') . 'components/cronmanager/');
/** @var CronManager $cronmanager */
$cronmanager = $modx->getService('cronmanager', 'CronManager', $corePath . 'model/cronmanager/', [
    'core_path' => $corePath
]);

$_SERVER['HTTP_MODAUTH'] = $modx->user->getUserToken($modx->context->get('key'));

// Handle request
$modx->request->handleRequest([
    'processors_path' => $cronmanager->getOption('processorsPath'),
    'location' => '',
    'action' => 'web/cron/run'
]);
