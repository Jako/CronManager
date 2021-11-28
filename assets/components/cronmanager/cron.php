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

require_once dirname(__FILE__, 4) . '/config.core.php';
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
require_once MODX_CONNECTORS_PATH . 'index.php';

$corePath = $modx->getOption('cronmanager.core_path', null, $modx->getOption('core_path') . 'components/cronmanager/');
/** @var CronManager $cronmanager */
$cronmanager = $modx->getService('cronmanager', 'CronManager', $corePath . 'model/cronmanager/', array(
    'core_path' => $corePath
));

// Check cronjob_id in no cli mode
if (php_sapi_name() != 'cli' &&
    (!isset($_REQUEST['cronjob_id']) || $_REQUEST['cronjob_id'] !== $cronmanager->getOption('cronjob_id'))
) {
    $modx->log(xPDO::LOG_LEVEL_ERROR, 'The request parameter for cron.php is not set or not equal to the system setting cronmanager.cronjob_id.', '', 'CronManager');
    return '';
}

$rundatetime = date('Y-m-d H:i:s');
$success = true;

// Get all cronjobs, wich needs to be runned
$c = $modx->newQuery('modCronjob');
$c->where(array(
    'active' => true,
));
if (!isset($_REQUEST['force']) || !$_REQUEST['force']) {
    $c->where(array(
        array(
            'nextrun' => null,
            'OR:nextrun:<=' => $rundatetime,
        ),
    ));
}
if (isset($_REQUEST['job']) && $_REQUEST['job']) {
    $c->where(array('id' => intval($_REQUEST['job'])));
}
$c->sortby('nextrun');
$c->limit(1);
$c->prepare();
$test = $c->toSQL();

/** @var modCronjob $cronjob */
while ($cronjob = $modx->getObject('modCronjob', $c)) {
    $properties = $cronjob->get('properties');
    if (!empty($properties)) {
        /** @var modPropertySet $propset */
        $propset = $modx->getObject('modPropertySet', array('name' => $properties));
        if (!empty($propset) && $propset instanceof modPropertySet) {
            $properties = $propset->getProperties();
        } elseif (json_decode($properties)) {
            $tempProps = json_decode($properties, true);
            $properties = (!empty($tempProps) && is_array($tempProps)) ? $tempProps : array();
        } else {
            $lines = explode("\n", $properties);
            $properties = array();
            foreach ($lines as $line) {
                list($key, $value) = explode(':', $line);
                $properties[trim($key)] = trim($value);
            }
        }
    } else {
        $properties = array();
    }
    $properties['CronManager'] = '1';
    if ($cronmanager->getOption('pass_modcronjob')) {
        $properties['CronManagerJob'] = $cronjob;
    }

    if ($cronmanager->getOption('debug')) {
        $modx->log(xPDO::LOG_LEVEL_ERROR, 'CronManager Job: ' . $cronjob->get('title') . ' (' . $cronjob->get('id') . ') properties: ' . print_r($properties, true), '', 'CronManager');
    }
    $modx->resource = $modx->getObject('modResource', $modx->getOption('site_start'));

    /** @var modSnippet $snippet */
    $snippet = $cronjob->getOne('Snippet');
    /**
     * The snippet should output a json array: array('error' => boolean,
     * 'message' => string). If this is not the case, the snippet output is set
     * as message. This makes it possible to indicate in the snippet output
     * whether an error has occurred. This makes it easier to filter logs.
     */
    try {
        $response = $snippet->process($properties);
        if (json_decode($response)) {
            $response = json_decode($response, true);
        } else {
            $response = array(
                'error' => false,
                'message' => ($response) ?: 'No snippet output!'
            );
        }
    } catch (Exception $e) {
        $response = array(
            'error' => true,
            'message' => 'Error: ' . $e->getMessage(),
        );
        $success = false;
    }

    // Add result to log
    /** @var modCronjobLog $log */
    $log = $modx->newObject('modCronjobLog');
    $log->fromArray($response);
    $log->set('logdate', $rundatetime);
    $logs = array($log);

    $cronjob->set('lastrun', $rundatetime);
    $cronjob->set('nextrun', date('Y-m-d H:i:s', (strtotime($rundatetime) + ($cronjob->get('minutes') * 60))));
    $cronjob->addMany($logs);
    $cronjob->save();

    if (isset($_REQUEST['force']) && $_REQUEST['force']) {
        $c->where(array(
            array(
                'nextrun' => null,
                'OR:nextrun:<=' => $rundatetime,
            ),
        ));
    }
};

if (php_sapi_name() != 'cli') {
    @session_write_close();
    if (isset($_REQUEST['force']) && $_REQUEST['force']) {
        exit(json_encode(array(
            'success' => true
        )));
    } else {
        exit($rundatetime);
    }
} else {
    exit($success ? 0 : 1);
}
