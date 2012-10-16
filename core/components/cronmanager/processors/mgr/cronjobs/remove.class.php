<?php
class modCronjobRemoveProcessor extends modObjectRemoveProcessor {
    public $classKey = 'modCronjob';
    public $languageTopics = array('cronmanager:default');
    public $objectType = 'cronmanager.modcronjob';
}

return 'modCronjobRemoveProcessor';
