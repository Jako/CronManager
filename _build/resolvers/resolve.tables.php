<?php

if ($object->xpdo) {
	switch ($options[xPDOTransport::PACKAGE_ACTION]) {
		case xPDOTransport::ACTION_INSTALL:
			$modx =& $object->xpdo;
			$modelPath = $modx->getOption('cronmanager.core_path',null,$modx->getOption('core_path').'components/cronmanager/').'model/';
			$modx->addPackage('cronmanager', $modelPath);
 
			$manager = $modx->getManager();
 
			$manager->createObjectContainer('modCronjob');
			$manager->createObjectContainer('modCronjobLog');
 
			break;
		case xPDOTransport::ACTION_UPGRADE:
			break;
	}
}

?>