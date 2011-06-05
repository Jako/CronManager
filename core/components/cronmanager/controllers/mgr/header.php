<?php

$modx->regClientStartupScript($cronmanager->config['jsUrl'].'mgr/cronmanager.js');
$modx->regClientStartupHTMLBlock('<script type="text/javascript">
Ext.onReady(function() {
    CronManager.config = '.$modx->toJSON($cronmanager->config).';
});
</script>');
return '';

?>