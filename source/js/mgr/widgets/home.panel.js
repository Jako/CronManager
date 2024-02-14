CronManager.panel.Home = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        cls: 'container home-panel' + ((CronManager.config.debug) ? ' debug' : '') + ' modx' + CronManager.config.modxversion,
        defaults: {
            collapsible: false,
            autoHeight: true
        },
        items: [{
            html: '<h2>' + _('cronmanager') + '</h2>' + ((CronManager.config.debug) ? '<div class="ribbon top-right"><span>' + _('cronmanager.debug_mode') + '</span></div>' : ''),
            border: false,
            cls: 'modx-page-header'
        }, {
            defaults: {
                autoHeight: true
            },
            border: true,
            items: [{
                xtype: 'cronmanager-panel-overview'
            }]
        }, {
            cls: "treehillstudio_about",
            html: '<img width="146" height="40" src="' + CronManager.config.assetsUrl + 'img/mgr/treehill-studio-small.png"' + ' srcset="' + CronManager.config.assetsUrl + 'img/mgr/treehill-studio-small@2x.png 2x" alt="Treehill Studio">',
            listeners: {
                afterrender: function () {
                    this.getEl().select('img').on('click', function () {
                        var msg = '<span style="display: inline-block; text-align: center">&copy; 2011-2019 by <a href="https://oostdesign.com/" target="_blank">OostDesign</a><br>' +
                            '<img src="' + CronManager.config.assetsUrl + 'img/mgr/treehill-studio.png" srcset="' + CronManager.config.assetsUrl + 'img/mgr/treehill-studio@2x.png 2x" alt="Treehill Studio" style="margin-top: 10px"><br>' +
                            '&copy; 2019-2024 by <a href="https://treehillstudio.com" target="_blank">Treehill Studio</a>' +
                            '</span>';
                        Ext.Msg.show({
                            title: _('cronmanager') + ' ' + CronManager.config.version,
                            msg: msg,
                            buttons: Ext.Msg.OK,
                            cls: 'treehillstudio_window',
                            width: 358
                        });
                    });
                }
            }
        }]
    });
    CronManager.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(CronManager.panel.Home, MODx.Panel);
Ext.reg('cronmanager-panel-home', CronManager.panel.Home);

CronManager.panel.HomeTab = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        id: 'cronmanager-panel-' + config.tabtype,
        title: config.title,
        items: [{
            html: '<p>' + config.description + '</p>',
            border: false,
            cls: 'panel-desc'
        }, {
            layout: 'form',
            cls: 'x-form-label-left main-wrapper',
            defaults: {
                autoHeight: true
            },
            border: true,
            items: [{
                id: 'cronmanager-panel-' + config.tabtype + '-grid',
                xtype: 'cronmanager-grid-' + config.tabtype,
                preventRender: true
            }]
        }]
    });
    CronManager.panel.HomeTab.superclass.constructor.call(this, config);
};
Ext.extend(CronManager.panel.HomeTab, MODx.Panel);
Ext.reg('cronmanager-panel-hometab', CronManager.panel.HomeTab);

CronManager.panel.Overview = function (config) {
    config = config || {};
    this.ident = 'cronmanager-panel-overview-' + Ext.id();
    this.panelOverviewTabs = [{
        xtype: 'cronmanager-panel-hometab',
        title: _('cronmanager.cronjobs'),
        description: _('cronmanager.cronjobs_desc'),
        tabtype: 'cronjobs'
    }, {
        xtype: 'cronmanager-panel-hometab',
        title: _('cronmanager.cronjoblog'),
        description: _('cronmanager.cronjoblog_desc'),
        tabtype: 'cronjoblog'
    }];
    if (CronManager.config.is_admin) {
        this.panelOverviewTabs.push({
            xtype: 'cronmanager-panel-settings'
        })
    }
    Ext.applyIf(config, {
        id: this.ident,
        items: [{
            xtype: 'modx-tabs',
            border: true,
            stateful: true,
            stateId: 'cronmanager-panel-overview',
            stateEvents: ['tabchange'],
            getState: function () {
                return {
                    activeTab: this.items.indexOf(this.getActiveTab())
                };
            },
            autoScroll: true,
            deferredRender: true,
            forceLayout: false,
            defaults: {
                layout: 'form',
                autoHeight: true,
                hideMode: 'offsets'
            },
            items: this.panelOverviewTabs,
            listeners: {
                tabchange: function (o, t) {
                    if (t.xtype === 'cronmanager-panel-settings') {
                        Ext.getCmp('cronmanager-grid-system-settings').getStore().reload();
                    } else if (t.xtype === 'cronmanager-panel-hometab') {
                        if (Ext.getCmp('cronmanager-panel-' + t.tabtype + '-grid')) {
                            Ext.getCmp('cronmanager-panel-' + t.tabtype + '-grid').getStore().reload();
                        }
                    }
                }
            }
        }]
    });
    CronManager.panel.Overview.superclass.constructor.call(this, config);
};
Ext.extend(CronManager.panel.Overview, MODx.Panel);
Ext.reg('cronmanager-panel-overview', CronManager.panel.Overview);
