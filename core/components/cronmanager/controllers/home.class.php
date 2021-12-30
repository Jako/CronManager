<?php
/**
 * Home controller
 *
 * @package cronmanager
 * @subpackage controllers
 */

/**
 * Class CronManagerHomeManagerController
 */
class CronManagerHomeManagerController extends modExtraManagerController
{
    /** @var CronManager $cronmanager */
    public $cronmanager;

    /**
     * {@inheritDoc}
     */
    public function initialize()
    {
        $corePath = $this->modx->getOption('cronmanager.core_path', null, $this->modx->getOption('core_path') . 'components/cronmanager/');
        $this->cronmanager = $this->modx->getService('cronmanager', 'CronManager', $corePath . 'model/cronmanager/', [
            'core_path' => $corePath
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function loadCustomCssJs()
    {
        $assetsUrl = $this->cronmanager->getOption('assetsUrl');
        $jsUrl = $this->cronmanager->getOption('jsUrl') . 'mgr/';
        $jsSourceUrl = $assetsUrl . '../../../source/js/mgr/';
        $cssUrl = $this->cronmanager->getOption('cssUrl') . 'mgr/';
        $cssSourceUrl = $assetsUrl . '../../../source/css/mgr/';

        if ($this->cronmanager->getOption('debug') && ($this->cronmanager->getOption('assetsUrl') != MODX_ASSETS_URL . 'components/cronmanager/')) {
            $this->addCss($cssSourceUrl . 'cronmanager.css?v=v' . $this->cronmanager->version);
            $this->addJavascript($jsSourceUrl . 'cronmanager.js?v=v' . $this->cronmanager->version);
            $this->addJavascript($jsSourceUrl . 'helper/combo.js?v=v' . $this->cronmanager->version);
            $this->addJavascript($jsSourceUrl . 'widgets/home.panel.js?v=v' . $this->cronmanager->version);
            $this->addJavascript($jsSourceUrl . 'widgets/logs.panel.js?v=v' . $this->cronmanager->version);
            $this->addJavascript($jsSourceUrl . 'widgets/cronjobs.grid.js?v=v' . $this->cronmanager->version);
            $this->addJavascript($jsSourceUrl . 'widgets/cronjoblog.grid.js?v=v' . $this->cronmanager->version);
            $this->addLastJavascript($jsSourceUrl . 'sections/home.js?v=v' . $this->cronmanager->version);
            $this->addLastJavascript($jsSourceUrl . 'sections/logs.js?v=v' . $this->cronmanager->version);
        } else {
            $this->addCss($cssUrl . 'cronmanager.min.css?v=v' . $this->cronmanager->version);
            $this->addLastJavascript($jsUrl . 'cronmanager.min.js?v=v' . $this->cronmanager->version);
        }
        $this->addHtml('<script type="text/javascript">
        Ext.onReady(function() {
            CronManager.config = ' . json_encode($this->cronmanager->options, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . ';
            MODx.load({xtype: "cronmanager-page-home"});
        });
        </script>');
    }

    /**
     * {@inheritDoc}
     * @return string[]
     */
    public function getLanguageTopics()
    {
        return ['core:setting', 'cronmanager:default'];
    }

    /**
     * {@inheritDoc}
     * @param array $scriptProperties
     */
    public function process(array $scriptProperties = [])
    {
    }

    /**
     * {@inheritDoc}
     * @return string|null
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('cronmanager');
    }

    /**
     * {@inheritDoc}
     * @return string
     */
    public function getTemplateFile()
    {
        return $this->cronmanager->getOption('templatesPath') . 'home.tpl';
    }
}
