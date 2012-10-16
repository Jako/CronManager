<?php
class modCronjobLogPurgeProcessor extends modObjectGetListProcessor {
    public $classKey = 'modCronjobLog';
    public $languageTopics = array('cronmanager:default');
    public $objectType = 'cronmanager.modcronjoblog';
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'DESC';

    public function process() {
        $msg = $this->purge();
        return $this->success($msg);
    }

    /**
     * Returns an array of criteria to be used with removeCollection
     *
     * @return array The criteria
     */
    public function getCriteria() {
        $criteria = array();
        $cronjob = $this->getProperty('cronjob');
        if (!$cronjob) {
            return $this->failure($this->modx->lexicon('cronmanager.cronjob_err_ns'));
        }
        $criteria['cronjob'] = $cronjob;

        $errorOnly = $this->getProperty('error_only', true);
        if ($errorOnly) {
            $criteria['error'] = false;
        }
        return $criteria;
    }

    /**
     * Removes the desired logs and returns the result
     *
     * @return string The result :)
     */
    public function purge() {
        $total = $this->modx->removeCollection($this->classKey, $this->getCriteria());

        if ($total >= 1) {
            $response = $this->modx->lexicon('cronmanager.logs_purge_success', array('total' => $total));
        } else {
            $response = $this->modx->lexicon('cronmanager.logs_purge_nothing');
        }

        return $response;
    }
}

return 'modCronjobLogPurgeProcessor';
