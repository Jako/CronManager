<?php
/**
 * Remove selected cronjobs
 *
 * @package cronmanager
 * @subpackage processor
 */

class CronManagerCronjobRemoveselectedProcessor extends modProcessor
{
    public $languageTopics = array('cronmanager:default');
    public $objectType = 'cronmanager.cronjob';

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
