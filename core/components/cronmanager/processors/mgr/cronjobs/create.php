<?php

$cronjob = $modx->newObject('modCronjob');

if(!isset($scriptProperties['minutes']) || empty($scriptProperties['minutes'])) { $scriptProperties['minutes'] = 1; }
if(!isset($scriptProperties['lastrun']) || empty($scriptProperties['lastrun'])) { $scriptProperties['lastrun'] = null; }
if(!isset($scriptProperties['nextrun']) || empty($scriptProperties['nextrun'])) { $scriptProperties['nextrun'] = null; }
if(!isset($scriptProperties['sortorder']) || empty($scriptProperties['sortorder'])) { $scriptProperties['sortorder'] = 0; }
if(!isset($scriptProperties['active']) || empty($scriptProperties['active'])) { $scriptProperties['active'] = false; }

$cronjob->fromArray($scriptProperties);

/* save */
if($cronjob->save() == false) {
    return $modx->error->failure($modx->lexicon('cronmanager.create.error_save'));
}


return $modx->error->success('', $cronjob);

?>