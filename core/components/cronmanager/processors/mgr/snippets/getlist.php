<?php

$start = $modx->getOption('start', $scriptProperties, 0);
$limit = $modx->getOption('limit', $scriptProperties, 20);
$sort = $modx->getOption('sort', $scriptProperties, 'name');
$dir = $modx->getOption('dir', $scriptProperties, 'ASC');
$search = $modx->getOption('query', $scriptProperties,'');
$id = $modx->getOption('id', $scriptProperties, false);

$query = $modx->newQuery('modSnippet');
$query->sortby($sort, $dir);

if ($search !== '') {
    $query->where(array(
        'name:LIKE' => '%'.$search.'%'
    ));
} elseif ($id) {
    $query->where(array('id' => $id));
}

$count = $modx->getCount('modSnippet',$query);
$query->limit($limit, $start);

$snippets = $modx->getCollection('modSnippet', $query);

$list = array();
foreach($snippets as $snippet) {
	$list[] = $snippet->toArray();
}

return $this->outputArray($list, $count);

?>