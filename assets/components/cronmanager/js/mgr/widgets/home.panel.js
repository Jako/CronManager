CronManager.panel.Home = function(config) {
    config = config || {};
    Ext.apply(config,{
        border: false,
		baseCls: 'modx-formpanel',
        cls: 'container',
		items: [{
            html: '<h2>' + _('cronmanager') + '</h2>',
			border: false,
			cls: 'modx-page-header'
        },{
			defaults: { autoHeight: true },
			items: [{
				html: '<p>' + _('cronmanager.cronjobs_desc') + '</p>',
				bodyCssClass: 'panel-desc',
				border: false
			},{
				xtype: 'cronmanager-grid-cronjobs',
				preventRender: true,
				cls: 'main-wrapper'
			}]
		}]
    });
    CronManager.panel.Home.superclass.constructor.call(this,config);
};

Ext.extend(CronManager.panel.Home,MODx.Panel);
Ext.reg('cronmanager-panel-home',CronManager.panel.Home);