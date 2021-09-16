<?php
/**
 * Get list cronjob
 *
 * @package cronmanager
 * @subpackage processor
 */

class CronManagerCronjoblogsGetListProcessor extends modObjectGetListProcessor
{
    public $classKey = 'modCronjobLog';
    public $languageTopics = array('cronmanager:default');
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'DESC';
    public $objectType = 'cronmanager.modcronjoblog';

    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $c->where(array(
            'cronjob' => $this->getProperty('cronjob')
        ));

        $query = $this->getProperty('query');
        if (!empty($query)) {
            $c->where(array(
                'message:LIKE' => '%' . $query . '%'
            ));
        }

        $error = $this->getProperty('error', 'all');
        if ($error != 'all') {
            $c->where(array('error' => $error));
        }

        return $c;
    }

    public function prepareRow(xPDOObject $object)
    {
        $ta = $object->toArray('', false, true);
        $ta['day'] = strftime('%Y-%m-%d', strtotime($ta['logdate']));
        return $ta;
    }
}

return 'CronManagerCronjoblogsGetListProcessor';
