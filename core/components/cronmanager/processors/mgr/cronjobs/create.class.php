<?php
/**
 * Create cronjob
 *
 * @package cronmanager
 * @subpackage processor
 */

class CronManagerCronjobCreateProcessor extends modObjectCreateProcessor
{
    public $classKey = 'modCronjob';
    public $languageTopics = array('cronmanager:default');
    public $objectType = 'cronmanager.cronjob';

    public function beforeSave()
    {
        $this->object->set('minutes', $this->getProperty('minutes', 1));
        $this->object->set('active', $this->getProperty('active', false));

        return parent::beforeSave();
    }
}

return 'CronManagerCronjobCreateProcessor';
