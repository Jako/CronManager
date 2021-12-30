<?php
/**
 * Create Cronjob
 *
 * @package cronmanager
 * @subpackage processors
 */

use TreehillStudio\CronManager\Processors\ObjectCreateProcessor;

class CronManagerCronjobCreateProcessor extends ObjectCreateProcessor
{
    public $classKey = 'modCronjob';
    public $objectType = 'cronmanager.cronjob';

    /**
     * {@inheritDoc}
     * @return bool
     */
    public function beforeSave()
    {
        $this->object->set('minutes', $this->getProperty('minutes', 1));

        return parent::beforeSave();
    }
}

return 'CronManagerCronjobCreateProcessor';
