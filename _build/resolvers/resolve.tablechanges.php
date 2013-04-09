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
            /**
             * 4/9/2013
             * 
             * ALTER TABLE `modx`.`modx_cronjobs`     
             * ADD COLUMN `title` VARCHAR(64) NULL COMMENT 'brief title' AFTER `id`,     
             * ADD COLUMN `description` MEDIUMTEXT NULL COMMENT 'description of what job is doing' AFTER `title`,     
             * ADD COLUMN `debug` INT(1) DEFAULT '0' NOT NULL COMMENT 'Boolean' AFTER `active`,     
             * ADD COLUMN `set_nextrun` SET('Load','Success') DEFAULT 'Success' NOT NULL COMMENT 'nextrun can be set on Load or on Success of job' AFTER `debug`,     
             * ADD COLUMN `auto_clearlogs` INT(0) DEFAULT '0' NOT NULL COMMENT '0 for never, UNIX timestamp' AFTER `set_nextrun`,    
             * CHANGE `active` `active` INT(1) DEFAULT '0' NOT NULL COMMENT 'Boolean';
             * 
             * ALTER TABLE `modx`.`modx_cronjobs_log`     
             * ADD COLUMN `start_time` DATETIME NOT NULL COMMENT 'Time that job is called' AFTER `error`,     
             * ADD COLUMN `memory_peak` FLOAT(10,3) NULL COMMENT 'Memory peak of job in MB' AFTER `start_time`,     
             * ADD COLUMN `status` SET('Started','Completed') DEFAULT 'Started' NULL COMMENT 'Set to complete after job is called' AFTER `memory_peak`,     
             * ADD COLUMN `execution_time` FLOAT(10,3) NULL COMMENT 'Caluclated time in miliseconds' AFTER `status`,    
             * CHANGE `logdate` `logdate` DATETIME NOT NULL COMMENT 'Time that job is complete';
             * 
             * ALTER TABLE `modx`.`modx_cronjobs_log` ADD INDEX `CronJog` (`cronjob`);
             * ALTER TABLE `modx`.`modx_cronjobs_log` ADD INDEX `Preformance` (`cronjob`, `memory_peak`, `status`, `execution_time`);
             * 
             * UPDATE modx_cronjobs_log 
                SET
                    start_time = logdate,
                    `status` = 'Completed'
                WHERE
                    start_time = '0000-00-00 00:00:00'
             * 
             */
            $modx->exec("ALTER TABLE {$modx->getTableName('modCronjob')} 
                ADD COLUMN `title` VARCHAR(64) NULL COMMENT 'brief title' AFTER `id`,
                ADD COLUMN `description` MEDIUMTEXT NULL COMMENT 'description of what job is doing' AFTER `title`,     
                ADD COLUMN `debug` INT(1) DEFAULT '0' NOT NULL COMMENT 'Boolean' AFTER `active`,     
                ADD COLUMN `set_nextrun` SET('Load','Success') DEFAULT 'Success' NOT NULL COMMENT 'nextrun can be set on Load or on Success of job' AFTER `debug`,     
                ADD COLUMN `auto_clearlogs` INT(0) DEFAULT '0' NOT NULL COMMENT '0 for never, number of minutes' AFTER `set_nextrun`;
                ");
            
            $modx->exec("ALTER TABLE {$modx->getTableName('modCronjobLog')} 
                ADD COLUMN `start_time` DATETIME NOT NULL COMMENT 'Time that job is called' AFTER `error`,     
                ADD COLUMN `memory_peak` FLOAT(10,3) NULL COMMENT 'Memory peak of job in MB' AFTER `start_time`,     
                ADD COLUMN `status` SET('Started','Completed') DEFAULT 'Started' NULL COMMENT 'Set to complete after job is called' AFTER `memory_peak`,     
                ADD COLUMN `execution_time` FLOAT(10,3) NULL COMMENT 'Caluclated time in miliseconds' AFTER `status`;
                ");
            // Add indexes:
            $modx->exec("ALTER TABLE {$modx->getTableName('modCronjobLog')} 
                ADD INDEX `CronJog` (`cronjob`);
                ");
            $modx->exec("ALTER TABLE {$modx->getTableName('modCronjobLog')} 
                ADD INDEX `Preformance` (`cronjob`, `memory_peak`, `status`, `execution_time`);
                ");
            // set defaults for existing data:
            $modx->exec("
                UPDATE {$modx->getTableName('modCronjobLog')}
                SET
                    `start_time` = `logdate`,
                    `status` = 'Completed'
                WHERE
                    `start_time` = '0000-00-00 00:00:00';
                ");
            
            break;
    }
}
return true;