<?php
/**
 * Remove selected cronjobs
 *
 * @package cronmanager
 * @subpackage processors
 */

use TreehillStudio\CronManager\Processors\Processor;

class CronManagerCronjobRemoveselectedProcessor extends Processor
{
    public $languageTopics = ['cronmanager:default'];

    public function process()
    {
        $logIds = $this->getProperty('ids');
        if (empty($logIds)) {
            return false;
        }
        $logIds = explode(',', $logIds);
        foreach ($logIds as $logId) {
            /** @var $modCronjobLog modCronjobLog */
            $modCronjobLog = $this->modx->getObject('modCronjobLog', $logId);
            if ($modCronjobLog) {
                $modCronjobLog->remove();
            }
        }
        return $this->success();
    }
}

return 'CronManagerCronjobRemoveselectedProcessor';
