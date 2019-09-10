CronManager.panel.Logs = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        cls: 'container home-panel' + ((CronManager.config.debug) ? ' debug' : ''),
        defaults: {
            collapsible: false,
            autoHeight: true
        },
        items: [{
            html: '<h2>' + _('cronmanager.log') + '</h2>' + ((CronManager.config.debug) ? '<div class="ribbon top-right"><span>' + _('cronmanager.debug_mode') + '</span></div>' : ''),
            border: false,
            cls: 'modx-page-header',
            listeners: {
                afterrender: {
                    fn: function (component) {
                        if (!config.cronjob) {
                            return;
                        }
                        MODx.Ajax.request({
                            url: CronManager.config.connectorUrl,
                            params: {
                                action: 'mgr/cronjobs/get',
                                id: config.cronjob
                            },
                            listeners: {
                                success: {
                                    fn: function (r) {
                                        var html = '<h2>' + _('cronmanager.log') + ': ' + r.object.snippet_name + ' (' + r.object.id + ')</h2>' + ((CronManager.config.debug) ? '<div class="ribbon top-right"><span>' + _('cronmanager.debug_mode') + '</span></div>' : '');
                                        component.body.update(html);
                                        this.fireEvent('ready', r.object);
                                    },
                                    scope: this
                                }
                            }
                        });
                    },
                    scope: this
                }
            }
        }, {
            defaults: {
                autoHeight: true
            },
            border: true,
            cls: 'cronmanager-panel',
            items: [{
                html: '<p>' + _('cronmanager.logs_desc') + '</p>',
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
                    xtype: 'cronmanager-grid-cronjoblog',
                    preventRender: true,
                    cronjob: config.cronjob
                }]
            }]
        }, {
            cls: "treehillstudio_about",
            html: '<img width="133" height="40" src="' + CronManager.config.assetsUrl + 'img/mgr/treehill-studio-small.png"' + ' srcset="' + CronManager.config.assetsUrl + 'img/mgr/treehill-studio-small@2x.png 2x" alt="Treehill Studio">',
            listeners: {
                afterrender: function (component) {
                    component.getEl().select('img').on('click', function () {
                        var msg = '<span style="display: inline-block; text-align: center">© 2011-2019 by <a href="https://oostdesign.com/" target="_blank">OostDesign</a><br>' +
                            '<img src="' + CronManager.config.assetsUrl + 'img/mgr/treehill-studio.png" srcset="' + CronManager.config.assetsUrl + 'img/mgr/treehill-studio@2x.png 2x" alt="Treehill Studio" style="margin-top: 10px"><br>' +
                            '© 2019 by <a href="https://treehillstudio.com" target="_blank">Treehill Studio</a>' +
                            '</span>';
                        Ext.Msg.show({
                            title: _('cronmanager') + ' ' + CronManager.config.version,
                            msg: msg,
                            buttons: Ext.Msg.OK,
                            cls: 'treehillstudio_window',
                            width: 330
                        });
                    });
                }
            }
        }]
    });
    CronManager.panel.Logs.superclass.constructor.call(this, config);
};
Ext.extend(CronManager.panel.Logs, MODx.FormPanel);
Ext.reg('cronmanager-panel-logs', CronManager.panel.Logs);
