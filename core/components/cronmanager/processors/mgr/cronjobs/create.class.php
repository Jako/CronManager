<?php
class modCronjobCreateProcessor extends modObjectCreateProcessor {
    public $classKey = 'modCronjob';
    public $languageTopics = array('cronmanager:default');
    public $objectType = 'cronmanager.modcronjob';

    public function beforeSet() {
        $minutes = $this->getProperty('minutes');
        if (!isset($minutes) || empty($minutes)) $this->setProperty('minutes', 1);
        $lastrun = $this->getProperty('lastrun');
        if (!isset($lastrun) || empty($lastrun)) $this->setProperty('lastrun', null);
        $nextrun = $this->getProperty('nextrun');
        if (!isset($nextrun) || empty($nextrun)) $this->setProperty('nextrun', null);
        $sortorder = $this->getProperty('sortorder');
        if (!isset($sortorder) || empty($sortorder)) $this->setProperty('sortorder', 0);
        $active = $this->getProperty('active');
        if (!isset($active) || empty($active)) $this->setProperty('active', 0);

        return parent::beforeSet();
    }
}

return 'modCronjobCreateProcessor';
