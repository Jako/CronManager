<?php

$isLimit = !empty($scriptProperties['limit']);
$cronid = $modx->getOption('cronid', $scriptProperties, false);
$start = $modx->getOption('start', $scriptProperties, 0);
$limit = $modx->getOption('limit', $scriptProperties, 20);
$sort = $modx->getOption('sort', $scriptProperties, 'id');
$dir = $modx->getOption('dir', $scriptProperties, 'DESC');
$query = $modx->getOption('query', $scriptProperties, false);
 
// build query
$c = $modx->newQuery('modCronjobLog');
$c->where(array(
	'cronjob' => $cronid
));
if(!empty($query)) {
	$c->andCondition(array(
		'message:LIKE' => '%'.$query.'%'
	));
}

$count = $modx->getCount('modCronjobLog', $c);
$c->sortby($sort,$dir);

if($isLimit) {
	$c->limit($limit, $start);
}

$logs = $modx->getCollection('modCronjobLog', $c);
 
// iterate
$list = array();
foreach($logs as $log) {
    
	$logArray = $log->toArray();
	$logArray['logdate'] = strftime('%d-%m-%Y, %H:%M:%S', strtotime($logArray['logdate']));
	
	$list[] = $logArray;
}

return $this->outputArray($list, $count);

?>