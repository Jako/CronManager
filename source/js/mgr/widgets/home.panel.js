CronManager.panel.Home = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        cls: 'container home-panel' + ((CronManager.config.debug) ? ' debug' : ''),
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
            cls: 'cronmanager-panel',
            items: [{
                html: '<p>' + _('cronmanager.cronjobs_desc') + '</p>',
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
                    xtype: 'cronmanager-grid-cronjobs',
                    preventRender: true
                }]
            }]
        }, {
            cls: "treehillstudio_about",
            html: '<img width="146" height="40" src="' + CronManager.config.assetsUrl + 'img/mgr/treehill-studio-small.png"' + ' srcset="' + CronManager.config.assetsUrl + 'img/mgr/treehill-studio-small@2x.png 2x" alt="Treehill Studio">',
            listeners: {
                afterrender: function (component) {
                    component.getEl().select('img').on('click', function () {
                        var msg = '<span style="display: inline-block; text-align: center">© 2011-2019 by <a href="https://oostdesign.com/" target="_blank">OostDesign</a><br>' +
                            '<img src="' + CronManager.config.assetsUrl + 'img/mgr/treehill-studio.png" srcset="' + CronManager.config.assetsUrl + 'img/mgr/treehill-studio@2x.png 2x" alt="Treehill Studio" style="margin-top: 10px"><br>' +
                            '© 2019-2021 by <a href="https://treehillstudio.com" target="_blank">Treehill Studio</a>' +
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
