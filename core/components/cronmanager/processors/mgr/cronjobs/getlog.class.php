<?php
class modCronjobLogGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'modCronjobLog';
    public $languageTopics = array('cronmanager:default');
    public $objectType = 'cronmanager.modcronjoblog';
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'DESC';

    public function prepareQueryBeforeCount(xPDOQuery $c) {
        $cronjob = $this->getProperty('cronid');
        if ($cronjob) {
            $c->where(array('cronjob' => $cronjob));
        }

        $error = $this->getProperty('error', 'all');
        if ($error != 'all') {
            $c->where(array('error' => $error));
        }

        $query = $this->getProperty('query');
        if ($query) {
            $c->where(array('message:LIKE' => '%'. $query .'%'));
        }
        return $c;
    }

    public function prepareRow(xPDOObject $object) {
        $objectArray = $object->toArray();
        $objectArray['day'] = strftime('%Y-%m-%d', strtotime($objectArray['logdate']));

        return $objectArray;
    }
}

return 'modCronjobLogGetListProcessor';
