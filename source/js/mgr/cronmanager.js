var cronmanager = function (config) {
    config = config || {};
    cronmanager.superclass.constructor.call(this, config);
};
Ext.extend(cronmanager, Ext.Component, {
    initComponent: function () {
        this.stores = {};
        this.ajax = new Ext.data.Connection({
            disableCaching: true,
        });
    }, page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, util: {}, form: {}
});
Ext.reg('cronmanager', cronmanager);

CronManager = new cronmanager();

MODx.config.help_url = 'https://jako.github.io/CronManager/usage/';
