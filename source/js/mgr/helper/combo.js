CronManager.combo.Snippets = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        name: 'snippet',
        hiddenName: 'snippet',
        displayField: 'name',
        valueField: 'id',
        fields: ['id', 'name'],
        pageSize: 20,
        minChars: 1,
        editable: true,
        triggerAction: 'all',
        typeAhead: true,
        forceSelection: true,
        selectOnFocus: false,
        url: CronManager.config.connectorUrl,
        baseParams: {
            action: 'mgr/snippets/getlist',
            combo: true
        },
        emptyText: _('cronmanager.selectasnippet')
    });
    CronManager.combo.Snippets.superclass.constructor.call(this, config);
};
Ext.extend(CronManager.combo.Snippets, MODx.combo.ComboBox);
Ext.reg('cronmanager-combo-snippets', CronManager.combo.Snippets);

CronManager.combo.Error = function (config) {
    config = config || {};

    Ext.applyIf(config, {
        store: new Ext.data.SimpleStore({
            fields: ['d', 'v'],
            data: [
                [_('cronmanager.logs_filter_all'), 'all'],
                [_('cronmanager.logs_filter_no_error'), '0'],
                [_('cronmanager.logs_filter_error'), '1']
            ]
        }),
        displayField: 'd',
        valueField: 'v',
        value: 'all',
        mode: 'local',
        name: 'error',
        hiddenName: 'error',
        triggerAction: 'all',
        editable: false,
        selectOnFocus: false,
        listWidth: 0
    });
    CronManager.combo.Error.superclass.constructor.call(this, config);
};
Ext.extend(CronManager.combo.Error, Ext.form.ComboBox);
Ext.reg('cronmanager-combo-error', CronManager.combo.Error);
