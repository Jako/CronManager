<?php

$modx->regClientStartupScript($modx->config['manager_url'].'assets/modext/util/datetime.js');
$modx->regClientStartupScript($cronmanager->config['jsUrl'].'mgr/combos.js');
$modx->regClientStartupScript($cronmanager->config['jsUrl'].'mgr/widgets/cronjobs.grid.js');
$modx->regClientStartupScript($cronmanager->config['jsUrl'].'mgr/widgets/home.panel.js');
$modx->regClientStartupScript($cronmanager->config['jsUrl'].'mgr/sections/index.js');
$modx->regClientStartupScript($cronmanager->config['jsUrl'].'mgr/widgets/cronjoblog.grid.js');
$modx->regClientStartupScript($cronmanager->config['jsUrl'].'mgr/widgets/logs.panel.js');
 
return '<div id="cronmanager-panel-home-div"></div><div id="cronmanager-panel-logs-div"></div>';

?>