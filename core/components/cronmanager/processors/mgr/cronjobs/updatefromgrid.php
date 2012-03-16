<?php
/**
 * @var modX $modx
 * @var array $scriptProperties
 */

if(empty($scriptProperties['data'])) {
	return $modx->error->failure($modx->lexicon('cronmanager.error_update'));
}

$_DATA = $modx->fromJSON($scriptProperties['data']);
if(!is_array($_DATA)) {
	return $modx->error->failure($modx->lexicon('cronmanager.error_update'));
}

if(empty($_DATA['id'])) {
	return $modx->error->failure($modx->lexicon('cronmanager.error_update'));
}
/** @var $cronjob modCronjob */
$cronjob = $modx->getObject('modCronjob', $_DATA['id']);
if(empty($cronjob)) return $modx->error->failure($modx->lexicon('cronmanager.error_update'));

$cronjob->fromArray($_DATA);
if($cronjob->save() == false) {
    return $modx->error->failure($modx->lexicon('cronmanager.error_save'));
}

return $modx->error->success('', $cronjob);

?>