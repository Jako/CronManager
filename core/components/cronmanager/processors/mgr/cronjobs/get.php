<?php

if(empty($_REQUEST['id'])) {
	return $modx->error->failure($modx->lexicon('cronmanager.log.errorload'));
}

$cronjob = $modx->getObject('modCronjob', $_REQUEST['id']);
if(!$cronjob) {
	return $modx->error->failure($modx->lexicon('cronmanager.log.errorload'));
}

$snippet = $cronjob->getOne('Snippet');
$cronjob->set('snippet_name', $snippet->get('name'));

return $modx->error->success('', $cronjob->toArray('', true));

?>