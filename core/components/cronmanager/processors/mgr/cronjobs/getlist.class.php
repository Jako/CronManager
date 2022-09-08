<?php
/**
 * Get list cronjob
 *
 * @package cronmanager
 * @subpackage processors
 */

use TreehillStudio\CronManager\Processors\ObjectGetListProcessor;

class CronManagerCronjobGetListProcessor extends ObjectGetListProcessor
{
    public $classKey = 'modCronjob';
    public $defaultSortField = 'Snippet.name';
    public $defaultSortDirection = 'ASC';
    public $objectType = 'cronmanager.cronjob';

    protected $search = ['Snippet.name'];
    protected $nameField = 'snippet_name';

    /**
     * {@inheritDoc}
     * @param xPDOQuery $c
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $c = parent::prepareQueryBeforeCount($c);

        $c->select($this->modx->getSelectColumns($this->classKey, $this->classKey));
        $c->leftJoin('modSnippet', 'Snippet');
        $c->select($this->modx->getSelectColumns('modSnippet', 'Snippet', 'snippet_', ['id', 'name']));

        return $c;
    }

    /**
     * @param xPDOObject $object
     * @return array
     */
    public function prepareRow(xPDOObject $object)
    {
        $ta = $object->toArray('', false, true);
        if (empty($ta['nextrun'])) {
            $ta['nextrun'] = '<em>' . $this->modx->lexicon('cronmanager.runempty') . '</em>';
        } else {
            $nextrun = DateTime::createFromFormat('Y-m-d H:i:s', $ta['nextrun']);
            $ta['nextrun'] = ($nextrun) ? $nextrun->format('Y-m-d H:i:s') : $nextrun;
        }
        if (empty($ta['lastrun'])) {
            $ta['lastrun'] = '<em>' . $this->modx->lexicon('cronmanager.runempty') . '</em>';
        }else {
            $lastrun = DateTime::createFromFormat('Y-m-d H:i:s', $ta['lastrun']);
            $ta['lastrun'] = ($lastrun) ? $lastrun->format('Y-m-d H:i:s') : $lastrun;
        }
        return $ta;
    }
}

return 'CronManagerCronjobGetListProcessor';
