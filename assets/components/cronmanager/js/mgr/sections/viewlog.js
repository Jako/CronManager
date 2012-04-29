Ext.onReady(function() {
    MODx.load({ xtype: 'cronmanager-page-logs'});
});
 
CronManager.page.Logs = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        buttons: [{
			text: _('cronmanager.log.btnback'),
			id: 'answers-btn-back',
			handler: function() {
				location.href = '?a=' + MODx.request.a;
			},
			scope: this
		},'-',{
            text: _('help_ex'),
            handler: MODx.loadHelpPane
        }],
		components: [{
            xtype: 'cronmanager-panel-logs',
			renderTo: 'cronmanager-panel-logs-div',
			cronid: MODx.request.id
        }]
    });
    CronManager.page.Logs.superclass.constructor.call(this, config);
};
Ext.extend(CronManager.page.Logs, MODx.Component);
Ext.reg('cronmanager-page-logs', CronManager.page.Logs);