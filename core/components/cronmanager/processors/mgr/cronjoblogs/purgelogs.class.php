<?php
/**
 * Purges logs from the given Cronjob
 *
 * @package cronmanager
 * @subpackage processors
 */

use TreehillStudio\CronManager\Processors\Processor;

class CronManagerPurgelogsProcessor extends Processor
{
    public $languageTopics = ['cronmanager:default'];

    public function process()
    {
        $cronjob = $this->getProperty('cronjob');
        $error_only = (bool)$this->getProperty('error_only', true);

        if (!$cronjob) {
            return $this->failure($this->modx->lexicon('cronmanager.log_cronjob_err_ns'));
        }

        $c = ['cronjob' => $cronjob];
        if ($error_only) {
            $c['error'] = 0;
        }

        $total = $this->modx->removeCollection('modCronjobLog', $c);

        if ($total === false) {
            return $this->failure($this->modx->lexicon('cronmanager.logs_purge_db_err'));
        }

        if ($total >= 1) {
            $response = $this->modx->lexicon('cronmanager.logs_purge_success', ['total' => $total]);
        } else {
            $response = $this->modx->lexicon('cronmanager.logs_purge_nothing');
        }
        return $this->success($response);
    }
}

return 'CronManagerPurgelogsProcessor';
