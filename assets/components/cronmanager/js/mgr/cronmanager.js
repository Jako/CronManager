var CronManager = function(config) {
    config = config || {};
    CronManager.superclass.constructor.call(this, config);
};
Ext.extend(CronManager,Ext.Component,{
    page:{},window:{},grid:{},tree:{},panel:{},combo:{},config: {}
});
Ext.reg('cronmanager', CronManager);
CronManager = new CronManager();
MODx.config.help_url = 'http://rtfm.modx.com/display/ADDON/CronManager';