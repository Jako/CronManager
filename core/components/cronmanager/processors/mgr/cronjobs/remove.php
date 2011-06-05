<?php

if(empty($scriptProperties['id'])) {
	return $modx->error->failure($modx->lexicon('cronmanager.error_remove'));
}

$cronjob = $modx->getObject('modCronjob', $scriptProperties['id']);
if(empty($cronjob)) {
	return $modx->error->failure($modx->lexicon('cronmanager.error_remove'));
}

if($cronjob->remove() == false) {
    return $modx->error->failure($modx->lexicon('cronmanager.error_remove'));
}

return $modx->error->success('', $cronjob);

?>