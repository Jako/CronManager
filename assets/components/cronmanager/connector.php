<?php

require_once dirname(dirname(dirname(dirname(__FILE__)))).'/config.core.php';
require_once MODX_CORE_PATH.'config/'.MODX_CONFIG_KEY.'.inc.php';
require_once MODX_CONNECTORS_PATH.'index.php';
 
$corePath = $modx->getOption('cronmanager.core_path',null,$modx->getOption('core_path').'components/cronmanager/');
require_once $corePath.'model/cronmanager/cronmanager.class.php';
$modx->cronmanager = new CronManager($modx);
 
$modx->lexicon->load('cronmanager:default');
 
/* handle request */
$path = $modx->getOption('processorsPath',$modx->cronmanager->config,$corePath.'processors/');
$modx->request->handleRequest(array(
    'processors_path' => $path,
    'location' => '',
));

?>