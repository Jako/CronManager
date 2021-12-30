<?php
/**
 * Get list snippets
 *
 * @package cronmanager
 * @subpackage processors
 */

use TreehillStudio\CronManager\Processors\ObjectGetListProcessor;

class CronMananagerSnippetGetListProcessor extends ObjectGetListProcessor
{
    public $classKey = 'modSnippet';
    public $defaultSortField = 'name';
    public $defaultSortDirection = 'ASC';
    public $objectType = 'cronmanager.snippet';

    public $search = ['name'];
    public $nameField = 'pagetitle';

    /**
     * @param xPDOObject $object
     * @return array
     */
    public function prepareRow(xPDOObject $object)
    {
        $ta = parent::prepareRow($object);
        if ($this->getProperty('combo', false) === 'true') {
            $ta['name'] = $ta['name'] . ' (' . $ta['id'] . ')';
        }

        return $ta;
    }
}

return 'CronMananagerSnippetGetListProcessor';
