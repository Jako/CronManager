<?php

require_once dirname(dirname(__FILE__)).'/model/cronmanager/cronmanager.class.php';
$cronmanager = new CronManager($modx);
return $cronmanager->initialize('mgr');

?>