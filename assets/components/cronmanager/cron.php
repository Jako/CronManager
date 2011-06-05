<?php

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

foreach($cronjobs as $cronjob) {

	$properties = $cronjob->get('properties');
	
	if(!empty($properties)) {
	
		// try to get a propertyset
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
	
	$snippet = $cronjob->getOne('Snippet');
	$message = $snippet->process($properties);
	
	// add log run
	$logs = array();
	$log = $modx->newObject('modCronjobLog');
	$log->set('message', $message);
	$log->set('logdate', $rundatetime);
	$logs[] = $log;
	
	$cronjob->set('lastrun', $rundatetime);
	$cronjob->set('nextrun', date('Y-m-d H:i:s', (strtotime($rundatetime)+($cronjob->get('minutes')*60))));
	$cronjob->addMany($logs);
	$cronjob->save();
}

?>