<?php
class modCronjobGetProcessor extends modObjectGetProcessor {
    /** @var modCronjob $object */
    public $object;
    public $classKey = 'modCronjob';
    public $languageTopics = array('cronmanager:default');
    public $objectType = 'cronmanager.modcronjob';

    public function beforeOutput() {
        /** @var $snippet modSnippet */
        $snippet = $this->object->getOne('Snippet');
        if ($snippet) $this->object->set('snippet_name', $snippet->get('name'));
    }
}

return 'modCronjobGetProcessor';
