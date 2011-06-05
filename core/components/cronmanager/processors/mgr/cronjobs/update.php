<?php

if(empty($scriptProperties['id'])) {
	return $modx->error->failure($modx->lexicon('cronmanager.error_update'));
}

$cronjob = $modx->getObject('modCronjob', $scriptProperties['id']);
if(empty($cronjob)) {
	return $modx->error->failure($modx->lexicon('cronmanager.error_update'));
}

if(isset($scriptProperties['minutes']) && empty($scriptProperties['minutes'])) { $scriptProperties['minutes'] = 1; }

$cronjob->fromArray($scriptProperties);
if($cronjob->save() == false) {
    return $modx->error->failure($modx->lexicon('cronmanager.error_update'));
}

return $modx->error->success('', $customers);

?>