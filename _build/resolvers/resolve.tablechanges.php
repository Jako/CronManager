<?php
/**
 * Modify table changes
 *
 * @var modX $modx
 */
if ($object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_UPGRADE:
            $modx =& $object->xpdo;
            $modelPath = $modx->getOption('cronmanager.core_path', null, $modx->getOption('core_path').'components/cronmanager/').'model/';
            $modx->addPackage('cronmanager', $modelPath);

            $manager = $modx->getManager();

            $manager->addField('modCronjobLog', 'error');

            break;
    }
}
return true;