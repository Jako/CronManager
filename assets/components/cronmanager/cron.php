<?php
/**
 * @var modX $modx
 */
require_once dirname(dirname(dirname(dirname(__FILE__)))).'/config.core.php';
require_once MODX_CORE_PATH.'config/'.MODX_CONFIG_KEY.'.inc.php';
require_once MODX_CONNECTORS_PATH.'index.php';

$corePath = $modx->getOption('cronmanager.core_path',null,$modx->getOption('core_path').'components/cronmanager/');
require_once $corePath.'model/cronmanager/cronmanager.class.php';
$modx->cronmanager = new CronManager($modx);
$modx->lexicon->load('cronmanager:default');
/**
 * Get time as a float in milliseconds
 */
if ( !function_exists('cronGetTime') ) {
    function cronGetTime() {
        $timer = explode( ' ', microtime() );
        //echo '<br />Time1: ',$timer[1],' time: ',$timer[0],' - ',$timer;
        $timer = $timer[1] + $timer[0];
        return $timer;
    }
}
$ex_start_time = cronGetTime();
$ex_end_time = cronGetTime();
$ex_time = round($ex_end_time - $ex_start_time,5);

$rundatetime = date('Y-m-d H:i:s');

// get all cronjobs wich needs to be runned
$cronjobs = $modx->getCollection('modCronjob', array(
	'nextrun' => null,
	'OR:nextrun:<=' => $rundatetime,
	'active' => true,
));
/** @var modCronjob $cronjob */
foreach($cronjobs as $cronjob) {
    // begin log:  this is incase snippet call would exit() or fatal error like used all memory we log that it started
    /** @var modCronjobLog $log */
    $log = $modx->newObject('modCronjobLog');
    $log->fromArray(array(
        'cronjob' => $cronjob->get('id'),
        'start_time' => date('Y-m-d H:i:s'),
        'logdate' => date('Y-m-d H:i:s'),
        'status' => 'Started',
        'message' => 'Start the snippet'
        
    ));
    if ( !$log->save() ) {
        $modx->log(modX::LOG_LEVEL_ERROR,'[CronManager] Log could not be saved: '.$cronjob->get('title').' ('.$cronjob->get('id').') at: '.date('Y-m-d H:i:s') );
    }
    $start_job = cronGetTime();
    
    $debug = (boolean) $cronjob->get('debug');
    if ( $debug ) {
        $modx->log(modX::LOG_LEVEL_ERROR,'[CronManager] Start job: '.$cronjob->get('title').' ('.$cronjob->get('id').')' );
    }
    
    // update nextrun:
    $set = $cronjob->get('set_nextrun');
    if ( $set == 'Load' ) {
        $cronjob->set('lastrun', $rundatetime);
        $cronjob->set('nextrun', date('Y-m-d H:i:s', (strtotime($rundatetime)+($cronjob->get('minutes')*60))));
        $cronjob->save();
    }
    
	$properties = $cronjob->get('properties');
	
	if(!empty($properties)) {
	
		// try to get a propertyset
        /** @var modPropertySet $propset */
		$propset = $modx->getObject('modPropertySet', array('name' => $properties));
		if(!empty($propset) && is_object($propset) && $propset instanceof modPropertySet) {
			$properties = $propset->getProperties();
		}
		// try if it is a json object
		else if(substr($properties, 0, 1) == '{' && substr($properties, (strlen($properties)-1), 1) == '}') {
			$props = $modx->fromJSON($properties);
			if(!empty($props) && is_array($props)) {
				$properties = $props;
			}
		}
		// then must be it a key value pair group
		else {
			$lines = explode("\n", $properties);
			$properties = array();
			foreach($lines as $line) {
				list($key, $value) = explode(':', $line);
				$properties[trim($key)] = trim($value);
			}
		}
	}
	// when empty, make it an array
	else {
		$properties = array();
	}
    if ( $debug ) {
        $modx->log(modX::LOG_LEVEL_ERROR,'[CronManager] Job: '.$cronjob->get('title').' ('.$cronjob->get('id').') properties: '.print_r($properties, true) );
    }
	/** @var modSnippet $snippet */
	$snippet = $cronjob->getOne('Snippet');
    /**
     * The snippet should return a json array :
     * array('error' => boolean, 'message' => string)
     * If not, the default output will be transformed
     *
     * This will allow to define if an error occurred and ease the process of filtering logs
     */
    try {
    	$response = $snippet->process($properties);
        if(substr($response, 0, 1) == '{' && substr($response, (strlen($response)-1), 1) == '}') {
            $response = json_decode($response, true);
        } else {
            $msg = $response;
            $response = array();
            $response['message'] = $msg;
        }
    } catch (Exception $e) {
        $response = array(
            'error' => '1',
            'message' => 'Error: '.$e->getMessage(),
        );
    }
    $end_job = cronGetTime();
    $ex_time = round($end_job - $start_job, 3);
    
	// update log data:
	$log->fromArray($response);
    $log->set('status', 'Completed');
	$log->set('logdate', date('Y-m-d H:i:s'));
    $log->set('execution_time', $ex_time);
    $log->set('memory_peak', round(memory_get_peak_usage()/(1024*1024), 3));
	$log->save();
    
	$cronjob->set('lastrun', $rundatetime);
	$cronjob->set('nextrun', date('Y-m-d H:i:s', (strtotime($rundatetime)+($cronjob->get('minutes')*60))));
	$cronjob->save();
    if ( $debug ) {
        $modx->log(modX::LOG_LEVEL_ERROR,'[CronManager] Job complete:  '.$cronjob->get('title').' ('.$cronjob->get('id').') ran in: '.$ex_time.' seconds' );
    }
    // purge logs:
    $purge = $cronjob->get('auto_clearlogs');
    if ( $purge > 0 ) {
        
        $criteria = array(
            'logdate:<=' => date('Y-m-d H:i:s', (strtotime($rundatetime)-($purge*60)) ),
            'cronjob' => $cronjob->get('id')
        );
        
        $total = $modx->removeCollection('modCronjobLog', $criteria);
        
        if ( $debug ) {
            $modx->log(modX::LOG_LEVEL_ERROR,'[CronManager] Removed job logs for: '.$cronjob->get('title').' ('.$cronjob->get('id').') a total of '.$total );
        }
    }
}

