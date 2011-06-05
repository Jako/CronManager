CronManager.panel.Home = function(config) {
    config = config || {};
    Ext.apply(config,{
        border: false,
		baseCls: 'modx-formpanel',
		items: [{
            html: '<h2>' + _('cronmanager') + '</h2>',
			border: false,
			cls: 'modx-page-header'
        },{
            xtype: 'modx-tabs',
			bodyStyle: 'padding: 10px',
			defaults: { border: false, autoHeight: true },
			border: true,
			items: [{
                title: _('cronmanager.cronjobs'),
				defaults: { autoHeight: true },
				items: [{
                    html: '<p>' + _('cronmanager.cronjobs_desc') + '</p><br />',
					border: false
                },{
				   xtype: 'cronmanager-grid-cronjobs',
				   preventRender: true
				}]
            }]
        }]
    });
    CronManager.panel.Home.superclass.constructor.call(this,config);
};
Ext.extend(CronManager.panel.Home,MODx.Panel);
Ext.reg('cronmanager-panel-home',CronManager.panel.Home);