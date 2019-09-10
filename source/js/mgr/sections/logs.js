CronManager.page.Logs = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        buttons: [{
            text: _('cronmanager.log.btnback'),
            id: 'answers-btn-back',
            handler: function () {
                location.href = '?a=home&namespace=' + MODx.request.namespace;
            },
            scope: this
        }, '-', {
            text: _('help_ex'),
            handler: MODx.loadHelpPane
        }],
        components: [{
            xtype: 'cronmanager-panel-logs',
            renderTo: 'cronmanager-panel-logs',
            cronjob: MODx.request.id
        }]
    });
    CronManager.page.Logs.superclass.constructor.call(this, config);
};
Ext.extend(CronManager.page.Logs, MODx.Component);
Ext.reg('cronmanager-page-logs', CronManager.page.Logs);
