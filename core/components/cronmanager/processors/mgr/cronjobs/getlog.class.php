<?php
class modCronjobLogGetListProcessor extends modObjectGetListProcessor {
    public $classKey = 'modCronjobLog';
    public $languageTopics = array('cronmanager:default');
    public $objectType = 'cronmanager.modcronjoblog';
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'DESC';

    public function prepareQueryBeforeCount(xPDOQuery $c) {
        $cronid = $this->getProperty('cronid');
        if (!empty($cronid)) {
            $c->where(array(
               'cronjob' => $cronid,
            ));
        }

        $error = $this->getProperty('error', 'all');
        if ($error != 'all') {
            $c->where(array('error' => $error));
        }

        $query = $this->getProperty('query');
        if(!empty($query)) {
            $c->andCondition(array(
                'message:LIKE' => '%'.$query.'%'
            ));
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
