<?php
/**
 * Abstract processor
 *
 * @package cronmanager
 * @subpackage processor
 */

namespace TreehillStudio\CronManager\Processors;

use modProcessor;
use modX;
use TreehillStudio\CronManager\CronManager;

/**
 * Class Processor
 */
abstract class Processor extends modProcessor
{
    public $languageTopics = ['cronmanager:default'];

    /** @var CronManager */
    public $cronmanager;

    /**
     * {@inheritDoc}
     * @param modX $modx A reference to the modX instance
     * @param array $properties An array of properties
     */
    function __construct(modX &$modx, array $properties = [])
    {
        parent::__construct($modx, $properties);

        $corePath = $this->modx->getOption('cronmanager.core_path', null, $this->modx->getOption('core_path') . 'components/cronmanager/');
        $this->cronmanager = $this->modx->getService('cronmanager', 'CronManager', $corePath . 'model/cronmanager/');
    }

    abstract public function process();

    /**
     * Get a boolean property.
     * @param string $k
     * @param mixed $default
     * @return bool
     */
    public function getBooleanProperty($k, $default = null)
    {
        return ($this->getProperty($k, $default) === 'true' || $this->getProperty($k, $default) === true || $this->getProperty($k, $default) === '1' || $this->getProperty($k, $default) === 1);
    }
}
