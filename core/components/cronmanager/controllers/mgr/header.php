<?php

$cronid = 0;
if ( isset($_REQUEST['cronjob']) && is_numeric($_REQUEST['cronjob']) ) {
    $cronid = $_REQUEST['cronjob'];
}

$modx->regClientStartupScript($cronmanager->config['jsUrl'].'mgr/cronmanager.js');
$modx->regClientStartupHTMLBlock('<script type="text/javascript">
Ext.onReady(function() {
    CronManager.config = '.$modx->toJSON($cronmanager->config).';
});
	var cronJobId = '.$cronid.';
	window.history.pushState(null, null, "?a=" + MODx.request.a + "&id=" + cronJobId );
</script>');
return '';

?>