CronManager.grid.CronJobs = function (config) {
    config = config || {};
    this.buttonColumnTpl = new Ext.XTemplate('<tpl for=".">'
        + '<tpl if="action_buttons !== null">'
        + '<ul class="action-buttons">'
        + '<tpl for="action_buttons">'
        + '<li><i class="icon {className} icon-{icon}" title="{text}"></i></li>'
        + '</tpl>'
        + '</ul>'
        + '</tpl>'
        + '</tpl>', {
        compiled: true
    });
    this.ident = 'cronmanager-cronjobs' + Ext.id();
    Ext.applyIf(config, {
        id: this.ident + '-cronmanager-grid-cronjobs',
        url: CronManager.config.connectorUrl,
        baseParams: {
            action: 'mgr/cronjobs/getlist'
        },
        save_action: 'mgr/cronjobs/updatefromgrid',
        autosave: true,
        fields: ['id', 'snippet', 'snippet_name', 'properties', 'minutes', 'nextrun', 'lastrun', 'active', 'sortorder'],
        paging: true,
        remoteSort: true,
        autoExpandColumn: 'snippet',
        emptyText: _('cronmanager.norecords'),
        columns: [{
            header: _('cronmanager.snippet'),
            dataIndex: 'snippet_name',
            sortable: true
        }, {
            header: _('cronmanager.minutes'),
            dataIndex: 'minutes',
            sortable: false,
            width: 40,
            editor: {
                xtype: 'numberfield',
                minValue: 1,
                description: _('cronmanager.minutes_desc'),
                allowNegative: false
            }
        }, {
            header: _('cronmanager.lastrun'),
            dataIndex: 'lastrun',
            sortable: false
        }, {
            header: _('cronmanager.nextrun'),
            dataIndex: 'nextrun',
            sortable: false,
            editor: {
                xtype: 'xdatetime',
                dateFormat: MODx.config.manager_date_format,
                timeFormat: MODx.config.manager_time_format
            }
        }, {
            header: _('cronmanager.active'),
            dataIndex: 'active',
            sortable: false,
            width: 40,
            renderer: MODx.grid.Grid.prototype.rendYesNo,
            editor: {
                xtype: 'combo-boolean'
            }
        }, {
            header: _('id'),
            dataIndex: 'id',
            sortable: true,
            hidden: true,
            width: 25
        }, {
            renderer: {
                fn: this.buttonColumnRenderer,
                scope: this
            },
            width: 30
        }],
        tbar: [{
            text: _('cronmanager.create'),
            cls: 'primary-button',
            handler: this.createCronjob
        }, '->', {
            xtype: 'textfield',
            id: this.ident + '-cronmanager-filter-search',
            emptyText: _('search') + '…',
            submitValue: false,
            listeners: {
                change: {
                    fn: this.search,
                    scope: this
                },
                render: {
                    fn: function (cmp) {
                        new Ext.KeyMap(cmp.getEl(), {
                            key: Ext.EventObject.ENTER,
                            fn: function () {
                                this.fireEvent('change', this);
                                this.blur();
                                return true;
                            },
                            scope: cmp
                        });
                    },
                    scope: this
                }
            }
        }, {
            xtype: 'button',
            id: this.ident + '-cronmanager-filter-clear',
            cls: 'x-form-filter-clear',
            text: _('filter_clear'),
            listeners: {
                click: {
                    fn: this.clearFilter,
                    scope: this
                }
            }
        }]
    });
    CronManager.grid.CronJobs.superclass.constructor.call(this, config)
};
Ext.extend(CronManager.grid.CronJobs, MODx.grid.Grid, {
    getMenu: function () {
        var m = [];
        m.push({
            text: _('cronmanager.update'),
            handler: this.updateCronjob
        });
        m.push('-');
        m.push({
            text: _('cronmanager.viewlog'),
            handler: this.viewLog
        });
        m.push('-');
        m.push({
            text: _('cronmanager.remove'),
            handler: this.removeCronjob
        });
        this.addContextMenuItem(m);
    },
    createCronjob: function (btn, e) {
        this.createUpdateCronjob(btn, e, false);
    },
    updateCronjob: function (btn, e) {
        this.createUpdateCronjob(btn, e, true);
    },
    createUpdateCronjob: function (btn, e, isUpdate) {
        var r;
        if (isUpdate) {
            if (!this.menu.record || !this.menu.record.id) {
                return false;
            }
            r = this.menu.record;
        } else {
            r = {
                parameter: '{}'
            };
        }
        var createUpdateCronjob = MODx.load({
            xtype: 'cronmanager-window-cronjob-create-update',
            isUpdate: isUpdate,
            title: (isUpdate) ? _('cronmanager.update') : _('cronmanager.create'),
            record: r,
            listeners: {
                success: {
                    fn: this.refresh,
                    scope: this
                }
            }
        });
        createUpdateCronjob.fp.getForm().setValues(r);
        createUpdateCronjob.show(e.target);
    },
    removeCronjob: function () {
        if (!this.menu.record) {
            return false;
        }
        MODx.msg.confirm({
            title: _('cronmanager.remove'),
            text: _('cronmanager.remove_confirm', {
                snippet: '<b>' + this.menu.record.snippet_name + '</b>'
            }),
            url: this.config.url,
            params: {
                action: 'mgr/cronjobs/remove',
                id: this.menu.record.id
            },
            listeners: {
                success: {
                    fn: this.refresh,
                    scope: this
                }
            }
        });
    },
    viewLog: function (btn, e) {
        if (!this.menu.record || !this.menu.record.id) return false;
        location.href = '?a=logs&namespace=' + CronManager.config.namespace + '&id=' + this.menu.record.id;
    },
    search: function (tf) {
        var s = this.getStore();
        s.baseParams.query = tf.getValue();
        this.getBottomToolbar().changePage(1);
        this.refresh();
    },
    clearFilter: function () {
        var s = this.getStore();
        s.baseParams.query = '';
        Ext.getCmp(this.ident + '-cronmanager-filter-search').reset();
        this.getBottomToolbar().changePage(1);
        this.refresh();
    },
    buttonColumnRenderer: function () {
        var values = {
            action_buttons: [
                {
                    className: 'update',
                    icon: 'pencil-square-o',
                    text: _('cronmanager.update')
                },
                {
                    className: 'viewlog',
                    icon: 'list-ul',
                    text: _('cronmanager.viewlog')
                },
                {
                    className: 'remove',
                    icon: 'trash-o',
                    text: _('cronmanager.remove')
                }
            ]
        };
        return this.buttonColumnTpl.apply(values);
    },
    onClick: function (e) {
        var t = e.getTarget();
        var elm = t.className.split(' ')[0];
        if (elm === 'icon') {
            var act = t.className.split(' ')[1];
            var record = this.getSelectionModel().getSelected();
            this.menu.record = record.data;
            switch (act) {
                case 'remove':
                    this.removeCronjob(record, e);
                    break;
                case 'update':
                    this.updateCronjob(record, e);
                    break;
                case 'viewlog':
                    this.viewLog(record, e);
                    break;
                default:
                    break;
            }
        }
    }
});
Ext.reg('cronmanager-grid-cronjobs', CronManager.grid.CronJobs);

CronManager.window.CreateUpdateCronjob = function (config) {
    config = config || {};
    this.ident = config.ident || 'cucronjob' + Ext.id();
    Ext.applyIf(config, {
        id: this.ident,
        url: CronManager.config.connectorUrl,
        action: (config.isUpdate) ? 'mgr/cronjobs/update' : 'mgr/cronjobs/create',
        width: 400,
        autoHeight: true,
        closeAction: 'close',
        cls: 'modx-window cronmanager-window',
        fields: [{
            items: [{
                layout: 'column',
                items: [{
                    columnWidth: .6,
                    layout: 'form',
                    items: [{
                        xtype: 'cronmanager-combo-snippets',
                        fieldLabel: _('cronmanager.snippet'),
                        name: 'snippet',
                        anchor: '100%',
                        allowBlank: false
                    }]
                }, {
                    columnWidth: .2,
                    layout: 'form',
                    items: [{
                        xtype: 'numberfield',
                        fieldLabel: _('cronmanager.minutes'),
                        description: _('cronmanager.minutes_desc'),
                        name: 'minutes',
                        anchor: '100%',
                        value: 60,
                        minValue: 1,
                        allowBlank: false,
                        allowNegative: false
                    }]
                },{
                    columnWidth: .2,
                    layout: 'form',
                    items: [{
                        xtype: 'xcheckbox',
                        fieldLabel: _('cronmanager.active'),
                        name: 'active',
                        hiddenName: 'active',
                        anchor: '100%'
                    }]
                }]
            }]
        }, {
            xtype: 'textarea',
            fieldLabel: _('cronmanager.properties'),
            description: _('cronmanager.properties_desc'),
            name: 'properties',
            anchor: '100%',
            allowBlank: true,
            grow: true,
            growMax: 200
        }, {
            xtype: 'hidden',
            name: 'id'
        }]
    });
    CronManager.window.CreateUpdateCronjob.superclass.constructor.call(this, config);
};
Ext.extend(CronManager.window.CreateUpdateCronjob, MODx.Window);
Ext.reg('cronmanager-window-cronjob-create-update', CronManager.window.CreateUpdateCronjob);
