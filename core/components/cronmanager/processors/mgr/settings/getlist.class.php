<?php
/**
 * Get list system settings
 *
 * @package cronmanager
 * @subpackage processors
 */

// Compatibility between 2.x/3.x
if (file_exists(MODX_PROCESSORS_PATH . 'system/settings/getlist.class.php')) {
    require_once MODX_PROCESSORS_PATH . 'system/settings/getlist.class.php';
} elseif (!class_exists('modSystemSettingsUpdateProcessor')) {
    class_alias(\MODX\Revolution\Processors\System\Settings\GetList::class, \modSystemSettingsGetListProcessor::class);
}

class CronManagerSystemSettingsGetlistProcessor extends modSystemSettingsGetListProcessor
{
    public $languageTopics = ['setting', 'namespace', 'cronmanager:setting'];
    public $objectType = 'setting';
    public $primaryKeyField = 'key';

    /**
     * {@inheritDoc}
     * @return array
     */
    public function prepareCriteria()
    {
        return ['namespace' => 'cronmanager'];
    }
}

return 'CronManagerSystemSettingsGetlistProcessor';
