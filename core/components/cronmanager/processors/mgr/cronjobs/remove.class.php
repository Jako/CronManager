<?php
/**
 * Remove cronjob
 *
 * @package cronmanager
 * @subpackage processors
 */

use TreehillStudio\CronManager\Processors\ObjectRemoveProcessor;

class CronManagerCronjobRemoveProcessor extends ObjectRemoveProcessor
{
    public $classKey = 'modCronjob';
    public $objectType = 'cronmanager.cronjob';
}

return 'CronManagerCronjobRemoveProcessor';
