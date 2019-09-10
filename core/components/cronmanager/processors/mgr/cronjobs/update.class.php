<?php
/**
 * Update cronjob
 *
 * @package cronmanager
 * @subpackage processor
 */

class CronManagerCronjobUpdateProcessor extends modObjectUpdateProcessor
{
    public $classKey = 'modCronjob';
    public $languageTopics = array('cronmanager:default');
    public $objectType = 'cronmanager.cronjob';

    public function beforeSave()
    {
        $this->object->set('minutes', $this->getProperty('minutes', 1));

        return parent::beforeSave();
    }
}

return 'CronManagerCronjobUpdateProcessor';
