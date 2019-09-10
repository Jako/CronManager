<?php
/**
 * Remove cronjob
 *
 * @package cronmanager
 * @subpackage processor
 */

class CronManagerCronjobRemoveProcessor extends modObjectRemoveProcessor
{
    public $classKey = 'modCronjob';
    public $languageTopics = array('cronmanager:default');
    public $objectType = 'cronmanager.cronjob';
}

return 'CronManagerCronjobRemoveProcessor';
