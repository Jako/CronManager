<?php
class modCronjobDeleteMultiProcessor extends modProcessor {
    public $ids = array();

    public function initialize() {
        $ids = $this->getProperty('ids');
        if (empty($ids)) return $this->failure();

        $this->ids = explode(',', $ids);

        return parent::initialize();
    }

    public function process() {
        $removed = $this->modx->removeCollection('modCronjobLog', array('id:IN' => $this->ids));
        if ($removed === false) {
            return $this->failure();
        }

        return $this->success();
    }
}

return 'modCronjobDeleteMultiProcessor';
