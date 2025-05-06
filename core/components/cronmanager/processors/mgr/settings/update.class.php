<?php
/**
 * Update a system setting
 *
 * @package cronmanager
 * @subpackage processors
 */

// Compatibility between 2.x/3.x
if (file_exists(MODX_PROCESSORS_PATH . 'system/settings/update.class.php')) {
    require_once MODX_PROCESSORS_PATH . 'system/settings/update.class.php';
} elseif (!class_exists('modSystemSettingsUpdateProcessor')) {
    class_alias(\MODX\Revolution\Processors\System\Settings\Update::class, \modSystemSettingsUpdateProcessor::class);
}

/**
 * Class CronManagerSystemSettingsUpdateProcessor
 */
class CronManagerSystemSettingsUpdateProcessor extends modSystemSettingsUpdateProcessor
{
    public $checkSavePermission = false;
    public $languageTopics = ['setting', 'namespace', 'cronmanager:setting'];

    /**
     * {@inheritDoc}
     * @return bool
     */
    public function checkPermissions()
    {
        return !empty($this->permission) ? $this->modx->hasPermission($this->permission) || $this->modx->hasPermission('cronmanager_' . $this->permission) : true;
    }

    /**
     * {@inheritDoc}
     * @return bool
     */
    public function beforeSave()
    {
        $this->setProperty('namespace', 'cronmanager');
        $this->checkForBooleanValue();
        $this->checkCanSave();
        return parent::beforeSave();
    }

    /**
     * {@inheritDoc}
     * @return bool
     */
    public function afterSave()
    {
        $this->updateTranslations($this->getProperties());
        $this->clearCache();
        return parent::afterSave();
    }

    /**
     * Verify the namespace passed is a valid namespace
     */
    protected function checkCanSave()
    {
        $key = $this->getProperty('key');
        if (strpos($key, 'cronmanager.') !== 0) {
            $this->addFieldError('key', $this->modx->lexicon('cronmanager.systemsetting_key_err_nv'));
        }
        if (!$this->modx->hasPermission($this->permission) && !$this->modx->hasPermission('cronmanager_' . $this->permission)) {
            $this->addFieldError('usergroup', $this->modx->lexicon('cronmanager.systemsetting_usergroup_err_nv'));
        }
    }
}

return 'CronManagerSystemSettingsUpdateProcessor';
