if (MODx.grid.SettingsGrid) {
    CronManager.panel.Settings = function (config) {
        config = config || {};
        MODx.request.ns = 'cronmanager';
        Ext.applyIf(config, {
            id: 'cronmanager-panel-settings',
            title: _('cronmanager.settings'),
            items: [{
                html: '<p>' + _('cronmanager.settings_desc') + '</p>',
                border: false,
                cls: 'panel-desc'
            }, {
                xtype: 'cronmanager-grid-system-settings',
                id: 'cronmanager-grid-system-settings',
                cls: 'main-wrapper',
                preventSaveRefresh: true
            }]
        });
        CronManager.panel.Settings.superclass.constructor.call(this, config);
    };
    Ext.extend(CronManager.panel.Settings, MODx.Panel);
    Ext.reg('cronmanager-panel-settings', CronManager.panel.Settings);

    CronManager.grid.SystemSettings = function (config) {
        config = config || {};
        Ext.applyIf(config, {
            id: 'cronmanager-grid-systemsettings',
            url: CronManager.config.connectorUrl,
            baseParams: {
                action: 'mgr/settings/getlist',
                area: MODx.request.area || ''
            },
            save_action: 'mgr/settings/updatefromgrid',
            tbar: [],
            queryParam: (CronManager.config.modxversion >= 3) ? 'query' : 'key'
        });
        CronManager.grid.SystemSettings.superclass.constructor.call(this, config);
    };
    Ext.extend(CronManager.grid.SystemSettings, MODx.grid.SettingsGrid, {
        _showMenu: function (g, ri, e) {
            e.stopEvent();
            e.preventDefault();
            this.menu.record = this.getStore().getAt(ri).data;
            if (!this.getSelectionModel().isSelected(ri)) {
                this.getSelectionModel().selectRow(ri);
            }
            this.menu.removeAll();
            var m = [];
            if (this.menu.record.menu) {
                m = this.menu.record.menu;
            } else {
                m.push({
                    text: _('setting_update') || _('edit'),
                    handler: this.updateSetting
                });
            }
            if (m.length > 0) {
                this.addContextMenuItem(m);
                this.menu.showAt(e.xy);
            }
        },
        updateSetting: function (btn, e) {
            var r = this.menu.record;
            r.fk = Ext.isDefined(this.config.fk) ? this.config.fk : 0;
            var uss = MODx.load({
                xtype: 'modx-window-setting-update',
                url: CronManager.config.connectorUrl,
                action: 'mgr/settings/update',
                record: r,
                grid: this,
                listeners: {
                    success: {
                        fn: this.refresh,
                        scope: this
                    }
                }
            });
            uss.reset();
            uss.setValues(r);
            uss.show(e.target);
        },
        clearFilter: function () {
            var area = MODx.request.area || '';
            this.getStore().baseParams = this.initialConfig.baseParams;
            var filterArea = Ext.getCmp('modx-filter-area');
            filterArea = filterArea || this.topToolbar.getComponent('filter-area');
            if (filterArea) {
                filterArea.store.load();
                filterArea.reset();
            }
            var filterQuery = Ext.getCmp('modx-filter-' + this.config.queryParam)
            filterQuery = filterQuery || this.topToolbar.getComponent('filter-query');
            if (filterQuery) {
                filterQuery.reset();
            }
            this.getStore().baseParams.area = area;
            this.getStore().baseParams[this.config.queryParam] = '';
            this.getBottomToolbar().changePage(1);
        },
        filterByKey: function (tf, newValue) {
            this.getStore().baseParams[this.config.queryParam] = newValue;
            this.getBottomToolbar().changePage(1);
            return true;
        },
        filterByNamespace: function () {
            this.getStore().baseParams.area = '';
            this.getBottomToolbar().changePage(1);
            var filterArea = Ext.getCmp('modx-filter-area');
            filterArea = filterArea || this.topToolbar.getComponent('filter-area');
            if (filterArea) {
                var s = filterArea.store;
                s.removeAll();
                s.load();
                filterArea.setValue('');
            }
        },
        listeners: {
            afterrender: function (cmp) {
                var filterNamespace = Ext.getCmp('modx-filter-namespace');
                filterNamespace = filterNamespace || cmp.topToolbar.getComponent('filter-ns');
                if (filterNamespace) {
                    filterNamespace.hide();
                }
            }
        }
    });
    Ext.reg('cronmanager-grid-system-settings', CronManager.grid.SystemSettings);
}
