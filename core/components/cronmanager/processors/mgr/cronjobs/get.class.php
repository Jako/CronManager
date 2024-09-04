<?php
/**
 * Get list cronjob
 *
 * @package cronmanager
 * @subpackage processors
 */

use TreehillStudio\CronManager\Processors\ObjectGetProcessor;

class CronManagerCronjobGetProcessor extends ObjectGetProcessor
{
    public $classKey = 'modCronjob';
    public $objectType = 'cronmanager.cronjob';

    /**
     * {@inheritDoc}
     */
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
