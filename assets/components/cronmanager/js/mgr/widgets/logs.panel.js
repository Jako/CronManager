CronManager.panel.Logs = function(config) {
    config = config || {};
    Ext.apply(config,{
		url: CronManager.config.connectorUrl,
		baseCls: 'modx-formpanel',
        cls: 'container',
		items: [{
            html: '<h2>' + _('cronmanager.log') + '</h2>',
			border: false,
			id: 'cronmanager-logs-page-header',
			cls: 'modx-page-header'
        },{
			border: true,
			defaults: { autoHeight: true },
			items: [{
				html: '<p>' + _('cronmanager.logs_desc') + '</p>',
				bodyCssClass: 'panel-desc',
				border: false
			},{
				xtype: 'cronmanager-grid-cronjoblog',
				preventRender: true,
				cls: 'main-wrapper'
			}]
		}],
		listeners: {
			'setup': { fn: this.setup, scope: this }
		}
    });
    CronManager.panel.Logs.superclass.constructor.call(this,config);
};

Ext.extend(CronManager.panel.Logs, MODx.FormPanel, {
	setup: function() {
		if(!this.config.cronid) {
			return;
		}
		
		MODx.Ajax.request({
			url: this.config.url,
			params: {
				action: 'mgr/cronjobs/get',
				id: this.config.cronid
			},
			listeners: {
				'success': {
					fn: function(r) {
						Ext.getCmp('cronmanager-logs-page-header').getEl().update('<h2>' + _('cronmanager.log') + ': ' + r.object.snippet_name + ' (' + r.object.id + ')</h2>');
						this.fireEvent('ready', r.object);
					},
					scope: this
				}
			}
		});
	}
});

//Ext.extend(CronManager.panel.Logs,MODx.Panel);
Ext.reg('cronmanager-panel-logs',CronManager.panel.Logs);