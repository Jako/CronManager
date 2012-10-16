<?php
class modCronjobGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'modCronjob';
    public $languageTopics = array('cronmanager:default');
    public $objectType = 'cronmanager.modcronjob';
    public $defaultSortField = 'snippet';
    public $defaultSortDirection = 'ASC';

    public function prepareRow(xPDOObject $object) {
        $objectArray = $object->toArray();

        $objectArray['snippet_name'] = 'Unknown';
        /** @var $snippet modSnippet */
        $snippet = $object->getOne('Snippet');
        if(!empty($snippet)) {
            $objectArray['snippet_name'] = $snippet->get('name');
        }

        if(empty($objectArray['nextrun'])) {
            $objectArray['nextrun'] = '<i>'. $this->modx->lexicon('cronmanager.runempty') .'</i>';
        }

        if(empty($objectArray['lastrun'])) {
            $objectArray['lastrun'] = '<i>'. $this->modx->lexicon('cronmanager.runempty') .'</i>';
        }

        return $objectArray;
    }
}

return 'modCronjobGetListProcessor';
