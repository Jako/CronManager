<?php
/**
 * Update cronjob
 *
 * @package cronmanager
 * @subpackage processors
 */

use TreehillStudio\CronManager\Processors\ObjectUpdateProcessor;

class CronManagerCronjobUpdateProcessor extends ObjectUpdateProcessor
{
    public $classKey = 'modCronjob';
    public $objectType = 'cronmanager.cronjob';

    /**
     * @return bool
     */
    public function beforeSave()
    {
        $this->object->set('minutes', $this->getProperty('minutes', 1));
        if (!$this->getProperty('nextrun')) {
            $this->object->set('nextrun');
        }

        return parent::beforeSave();
    }
}

return 'CronManagerCronjobUpdateProcessor';
