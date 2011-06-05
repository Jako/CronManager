<?php
/**
 * The base Cron Manager class
 * 
 * @package cronmanager
 * @subpackage components
 */

class CronManager
{
	public $modx;
	public $config = array();
	
	function __construct(modX &$modx,array $config = array()) {
		
		$this->modx =& $modx;
 
		$basePath = $this->modx->getOption('cronmanager.core_path',$config,$this->modx->getOption('core_path').'components/cronmanager/');
		$assetsUrl = $this->modx->getOption('cronmanager.assets_url',$config,$this->modx->getOption('assets_url').'components/cronmanager/');
		
		$this->config = array_merge(array(
			'basePath' => $basePath,
			'corePath' => $basePath,
			'modelPath' => $basePath.'model/',
			'processorsPath' => $basePath.'processors/',
			'chunksPath' => $basePath.'elements/chunks/',
			'jsUrl' => $assetsUrl.'js/',
			'cssUrl' => $assetsUrl.'css/',
			'assetsUrl' => $assetsUrl,
			'connectorUrl' => $assetsUrl.'connector.php',
		), $config);
		
		$this->modx->addPackage('cronmanager', $this->config['modelPath']);
	}
	
	public function initialize($ctx='web') {
		switch ($ctx) {
			case 'mgr':
				$this->modx->lexicon->load('cronmanager:default');
				
				if (!$this->modx->loadClass('cronmanagerControllerRequest',$this->config['modelPath'].'cronmanager/request/',true,true)) {
				   return 'Could not load controller request handler.';
				}
				
				$this->request = new cronmanagerControllerRequest($this);
				
				return $this->request->handleRequest();
			break;
		}
		return true;
	}
}

?>