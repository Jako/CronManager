Ext.onReady(function() {
    MODx.load({ xtype: 'cronmanager-page-home'});
});
 
CronManager.page.Home = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        buttons: [{
            text: _('help_ex'),
            handler: MODx.loadHelpPane
        }],
		components: [{
            xtype: 'cronmanager-panel-home'
            ,renderTo: 'cronmanager-panel-home-div'
        }]
    });
    CronManager.page.Home.superclass.constructor.call(this,config);
};
Ext.extend(CronManager.page.Home,MODx.Component);
Ext.reg('cronmanager-page-home',CronManager.page.Home);