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

$rundatetime = date('Y-m-d H:i:s');

// get all cronjobs wich needs to be runned
$cronjobs = $modx->getCollection('modCronjob', array(
	'nextrun' => null,
	'OR:nextrun:<=' => $rundatetime,
	'active' => true,
));
/** @var modCronjob $cronjob */
foreach($cronjobs as $cronjob) {

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
	/** @var modSnippet $snippet */
	$snippet = $cronjob->getOne('Snippet');
    /**
     * The snippet should return a json array :
     * array('error' => boolean, 'message' => string)
     * If not, the default output will be transformed
     *
     * This will allow to define if an error occurred and ease the process of filtering logs
     */
	$response = $snippet->process($properties);
    if(substr($response, 0, 1) == '{' && substr($response, (strlen($response)-1), 1) == '}') {
        $response = json_decode($response, true);
    } else {
        $msg = $response;
        $response = array();
        $response['message'] = $msg;
    }

	// add log run
	$logs = array();
    /** @var modCronjobLog $log */
	$log = $modx->newObject('modCronjobLog');
	$log->fromArray($response);
	$log->set('logdate', $rundatetime);
	$logs[] = $log;
	
	$cronjob->set('lastrun', $rundatetime);
	$cronjob->set('nextrun', date('Y-m-d H:i:s', (strtotime($rundatetime)+($cronjob->get('minutes')*60))));
	$cronjob->addMany($logs);
	$cronjob->save();
}

?>