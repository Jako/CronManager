CronManager.panel.Home = function(config) {
    config = config || {};
    Ext.apply(config,{
        border: false,
		baseCls: 'modx-formpanel',
        cls: 'container',
		id: 'cronmanager-panel-tabs',
		items: [{
            html: '<h2>' + _('cronmanager') + '</h2>',
			border: false,
			cls: 'modx-page-header'
        },{
			xtype: 'modx-tabs',
			defaults: { border: false, autoHeight: true },
			border: true,
			id: 'cronmanager-tabs',
			items: [{
				title: _('cronmanager.cronjobs'),
				defaults: { autoHeight:true },
				items: [{
					html: '<p>' + _('cronmanager.cronjobs_desc') + '</p>',
					bodyCssClass: 'panel-desc',
					border: false
				},{
					xtype: 'cronmanager-grid-cronjobs',
					preventRender: true,
					cls: 'main-wrapper'
				}]
			},{
				title: _('cronmanager.logs'),
				defaults: { autoHeight:true },
				id: 'CronJobLogTab',
				items: [{
					html: '<p>' + _('cronmanager.logs_desc') + '</p>',
					bodyCssClass: 'panel-desc',
					border: false
				},{
					xtype: 'cronmanager-grid-cronjoblog',
					preventRender: true,
					cls: 'main-wrapper'
				}]
			}]
		}]
    });
    CronManager.panel.Home.superclass.constructor.call(this,config);
};

Ext.extend(CronManager.panel.Home,MODx.Panel);
Ext.reg('cronmanager-panel-home',CronManager.panel.Home);