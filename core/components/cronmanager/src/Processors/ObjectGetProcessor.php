<?php
/**
 * Abstract get list processor
 *
 * @package cronmanager
 * @subpackage processors
 */

namespace TreehillStudio\CronManager\Processors;

use modObjectGetProcessor;
use modX;
use TreehillStudio\CronManager\CronManager;

/**
 * Class ObjectGetListProcessor
 */
class ObjectGetProcessor extends modObjectGetProcessor
{
    public $languageTopics = ['cronmanager:default'];

    /** @var CronManager $cronmanager */
    public $cronmanager;

    /**
     * {@inheritDoc}
     * @param modX $modx A reference to the modX instance
     * @param array $properties An array of properties
     */
    public function __construct(modX &$modx, array $properties = [])
    {
        parent::__construct($modx, $properties);

        $corePath = $this->modx->getOption('cronmanager.core_path', null, $this->modx->getOption('core_path') . 'components/cronmanager/');
        $this->cronmanager = $this->modx->getService('cronmanager', 'CronManager', $corePath . 'model/cronmanager/');
    }
}
