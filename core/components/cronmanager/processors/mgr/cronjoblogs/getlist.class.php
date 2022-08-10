<?php
/**
 * Get list cronjob log
 *
 * @package cronmanager
 * @subpackage processors
 */

use TreehillStudio\CronManager\Processors\ObjectGetListProcessor;

class CronManagerCronjoblogsGetListProcessor extends ObjectGetListProcessor
{
    public $classKey = 'modCronjobLog';
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'DESC';
    public $objectType = 'cronmanager.modcronjoblog';

    protected $search = ['message'];
    protected $nameField = 'cronjob';

    /**
     * {@inheritDoc}
     * @param xPDOQuery $c
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $c = parent::prepareQueryBeforeCount($c);

        $c->where([
            'cronjob' => $this->getProperty('cronjob')
        ]);

        $error = $this->getProperty('error', 'all');
        if ($error != 'all') {
            $c->where(['error' => $error]);
        }

        return $c;
    }

    /**
     * @param xPDOObject $object
     * @return array
     */
    public function prepareRow(xPDOObject $object)
    {
        $ta = $object->toArray('', false, true);
        $logdate = DateTime::createFromFormat('Y-m-d H:i:s', $ta['logdate']);
        $ta['logdate'] = ($logdate) ? $logdate->format('c') : $logdate;
        $ta['day'] = DateTime::createFromFormat('Y-m-d', $ta['logdate']);
        return $ta;
    }
}

return 'CronManagerCronjoblogsGetListProcessor';
