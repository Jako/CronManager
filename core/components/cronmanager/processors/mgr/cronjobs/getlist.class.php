<?php
/**
 * Get list cronjob
 *
 * @package cronmanager
 * @subpackage processor
 */

class CronManagerCronjobGetListProcessor extends modObjectGetListProcessor
{
    public $classKey = 'modCronjob';
    public $languageTopics = array('cronmanager:default');
    public $defaultSortField = 'snippet.name';
    public $defaultSortDirection = 'ASC';
    public $objectType = 'cronmanager.cronjob';

    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $query = $this->getProperty('query');
        if (!empty($query)) {
            $c->where(array(
                'Snippet.name:LIKE' => '%' . $query . '%'
            ));
        }
        $c->select($this->modx->getSelectColumns($this->classKey, $this->classKey));
        $c->leftJoin('modSnippet', 'Snippet');
        $c->select($this->modx->getSelectColumns('modSnippet', 'Snippet', 'snippet_', array('id', 'name')));
        return $c;
    }

    public function prepareRow(xPDOObject $object)
    {
        $ta = $object->toArray('', false, true);
        if (empty($ta['nextrun'])) {
            $ta['nextrun'] = '<em>' . $this->modx->lexicon('cronmanager.runempty') . '</em>';
        }
        if (empty($ta['lastrun'])) {
            $ta['lastrun'] = '<em>' . $this->modx->lexicon('cronmanager.runempty') . '</em>';
        }
        return $ta;
    }
}

return 'CronManagerCronjobGetListProcessor';
