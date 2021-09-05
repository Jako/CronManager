<?php
/**
 * Get list snippets
 *
 * @package cronmanager
 * @subpackage processor
 */

class CronMananagerSnippetGetListProcessor extends modObjectGetListProcessor
{
    public $classKey = 'modSnippet';
    public $languageTopics = array('cronmanager:default');
    public $defaultSortField = 'name';
    public $defaultSortDirection = 'ASC';
    public $objectType = 'cronmanager.snippet';

    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $query = $this->getProperty('query');
        if (!empty($query)) {
            $c->where(array(
                'name:LIKE' => '%' . $query . '%'
            ));
        }
        return $c;
    }

    public function prepareQueryAfterCount(xPDOQuery $c)
    {
        $id = $this->getProperty('id', '');
        if ($id) {
            $c->where(array(
                'id:IN' => array_map('intval', explode(',', $id))
            ));
        }
        return $c;
    }

    public function beforeIteration(array $list)
    {
        if (!$this->getProperty('id') && $this->getProperty('combo', false) === 'true') {
            $empty = array(
                'id' => '',
                'pagetitle' => '',
            );
            $list[] = $empty;
        }

        return $list;
    }

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
