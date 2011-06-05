CronManager.panel.Home = function(config) {
    config = config || {};
    Ext.apply(config,{
		url: CronManager.config.connectorUrl,
        border: false,
		baseCls: 'modx-formpanel',
		items: [{
            html: '<h2>' + _('cronmanager.log') + '</h2>',
			border: false,
			id: 'cronmanager-logs-page-header',
			cls: 'modx-page-header'
        },{
            xtype: 'modx-tabs',
			bodyStyle: 'padding: 10px',
			defaults: { border: false, autoHeight: true },
			border: true,
			items: [{
                title: _('cronmanager.logs'),
				defaults: { autoHeight: true },
				items: [{
                    html: '<p>' + _('cronmanager.logs_desc') + '</p><br />',
					border: false
                },{
				   xtype: 'cronmanager-grid-cronjoblog',
				   preventRender: true
				}]
            }]
        }],
		listeners: {
			'setup': { fn: this.setup, scope: this }
		}
    });
    CronManager.panel.Home.superclass.constructor.call(this,config);
};

Ext.extend(CronManager.panel.Home, MODx.FormPanel, {
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

//Ext.extend(CronManager.panel.Home,MODx.Panel);
Ext.reg('cronmanager-panel-home',CronManager.panel.Home);