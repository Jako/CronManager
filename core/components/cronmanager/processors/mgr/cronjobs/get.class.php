<?php
/**
 * Get list cronjob
 *
 * @package cronmanager
 * @subpackage processor
 */

class CronManagerCronjobGetProcessor extends modObjectGetProcessor
{
    public $classKey = 'modCronjob';
    public $languageTopics = array('cronmanager:default');
    public $objectType = 'cronmanager.cronjob';

    public function beforeOutput()
    {
        $snippet = $this->object->getOne('Snippet');
        if ($snippet) {
            $this->object->set('snippet_name', $snippet->get('name'));
        } else {
            $this->object->set('snippet_name', '');
        }
    }
}

return 'CronManagerCronjobGetProcessor';
