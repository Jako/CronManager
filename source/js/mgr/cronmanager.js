var cronmanager = function (config) {
    config = config || {};
    Ext.applyIf(config, {});
    cronmanager.superclass.constructor.call(this, config);
    return this;
};
Ext.extend(cronmanager, Ext.Component, {
    page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}
});
Ext.reg('cronmanager', cronmanager);

CronManager = new cronmanager();

MODx.config.help_url = 'https://jako.github.io/CronManager/usage/';
