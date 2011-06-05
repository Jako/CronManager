<?php

$isLimit = !empty($scriptProperties['limit']);
$start = $modx->getOption('start', $scriptProperties, 0);
$limit = $modx->getOption('limit', $scriptProperties, 20);
$sort = $modx->getOption('sort', $scriptProperties, 'snippet');
$dir = $modx->getOption('dir', $scriptProperties, 'ASC');
 
// build query
$c = $modx->newQuery('modCronjob');
$count = $modx->getCount('modCronjob', $c);
$c->sortby($sort,$dir);

if($isLimit) {
	$c->limit($limit, $start);
}

$cronjobs = $modx->getCollection('modCronjob', $c);
 
// iterate
$list = array();
foreach($cronjobs as $cronjob) {
    
	$cronArray = $cronjob->toArray();
	
	// retrieves the snippet name
    $cronArray['snippet_name'] = 'Unknown';
	$snippet = $cronjob->getOne('Snippet');
	if(!empty($snippet)) {
		$cronArray['snippet_name'] = $snippet->get('name');
	}
	
	if(empty($cronArray['nextrun'])) {
		$cronArray['nextrun'] = '<i>'.$modx->lexicon('cronmanager.runempty').'</i>';
	} else {
		$cronArray['nextrun'] = strftime('%d-%m-%Y, %H:%M:%S', strtotime($cronArray['nextrun']));
	}
	
	if(empty($cronArray['lastrun'])) {
		$cronArray['lastrun'] = '<i>'.$modx->lexicon('cronmanager.runempty').'</i>';
	} else {
		$cronArray['lastrun'] = strftime('%d-%m-%Y, %H:%M:%S', strtotime($cronArray['lastrun']));
	}
	
	$list[] = $cronArray;
}

return $this->outputArray($list, $count);

?>