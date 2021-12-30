<?php
/**
 * Resolve system settings
 *
 * @package cronmanager
 * @subpackage build
 *
 * @var array $options
 * @var xPDOObject $object
 */

$success = true;
if ($object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            /** @var modX $modx */
            $modx = &$object->xpdo;
            /** @var modSystemSetting $settingObject */
            $settingObject = $modx->getObject('modSystemSetting', ['key' => 'cronmanager.cronjob_id']);
            if ($settingObject) {
                if ($settingObject->get('value') == '') {
                    $settingObject->set('value', md5(time()));
                    $settingObject->save();
                    $modx->log(xPDO::LOG_LEVEL_INFO, 'cronmanager.cronjob_id filled with a random string');
                }
            } else {
                $modx->log(xPDO::LOG_LEVEL_ERROR, 'cronmanager.cronjob_id setting was not found, so the setting could not be changed.');
                $success = false;
            }
            break;
        case xPDOTransport::ACTION_UNINSTALL:
            break;
    }
}
return $success;
