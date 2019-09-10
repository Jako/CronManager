CronManager.grid.CronJobLog = function (config) {
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
    this.sm = new Ext.grid.CheckboxSelectionModel();
    this.ident = 'cronmanager-cronjoblog' + Ext.id();
    Ext.applyIf(config, {
        id: this.ident + '-cronmanager-grid-cronjoblog',
        url: CronManager.config.connectorUrl,
        baseParams: {
            action: 'mgr/cronjoblogs/getlist',
            cronjob: config.cronjob
        },
        fields: ['id', 'logdate', 'message', 'day', 'error'],
        paging: true,
        remoteSort: true,
        autoExpandColumn: 'message',
        grouping: true,
        groupBy: 'day',
        sortBy: 'logdate',
        sortDir: 'DESC',
        singleText: _('cronmanager.log_message'),
        pluralText: _('cronmanager.log_messages'),
        sm: this.sm,
        emptyText: _('cronmanager.log.norecords'),
        columns: [this.sm, {
            header: _('cronmanager.log_error'),
            dataIndex: 'error',
            width: 20,
            renderer: function (value, cell) {
                switch (value) {
                    case '':
                        return '-';
                    case false:
                        cell.css = 'green';
                        return _('no');
                    case true:
                        cell.css = 'red';
                        return _('yes');
                }
            },
            hidden: true
        }, {
            header: _('cronmanager.log_day'),
            dataIndex: 'day',
            width: 30,
            hidden: true
        }, {
            header: _('cronmanager.log.date'),
            dataIndex: 'logdate',
            width: 40,
            sortable: true,
            renderer: Ext.util.Format.dateRenderer(MODx.config.manager_date_format + ' ' + MODx.config.manager_time_format)
        }, {
            header: _('cronmanager.log.message'),
            dataIndex: 'message',
            renderer: function (value) {
                return '<pre>' + String(value).replace(/&/g, '&amp;')
                        .replace(/</g, '&lt;')
                        .replace(/>/g, '&gt;')
                        .replace(/"/g, '&quot;')
                        .substr(0, 100) + ((value.length > 100) ? ' ...' : '') +
                    '</pre>';
            },
            width: 300,
            sortable: true
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
            xtype: 'tbsplit',
            text: _('cronmanager.logs_actions'),
            menu: [{
                text: _('cronmanager.logs_purge_no_err'),
                handler: this.purgeLogs,
                scope: this
            }],
            handler: function (btn) {
                btn.showMenu();
            }
        }, '->', {
            xtype: 'cronmanager-combo-error',
            submitValue: false,
            listeners: {
                select: {
                    fn: this.filter,
                    scope: this
                }
            }
        }, {
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
    if (config.grouping) {
        Ext.applyIf(config, {
            view: new Ext.grid.GroupingView({
                forceFit: true,
                hideGroupedColumn: true,
                enableGroupingMenu: false,
                enableNoGroups: false,
                scrollOffset: 0,
                groupTextTpl: '{text} ({[values.rs.length]} {[values.rs.length > 1 ? "'
                    + (config.pluralText || _('records')) + '" : "'
                    + (config.singleText || _('record')) + '"]})'
            })
        });
    }
    CronManager.grid.CronJobLog.superclass.constructor.call(this, config)
};
Ext.extend(CronManager.grid.CronJobLog, MODx.grid.Grid, {
    getMenu: function (cfg) {
        var m = [];
        if (this.getSelectionModel().getCount() > 1) {
            // Multiple rows selected
            var rs = this.getSelectionModel().getSelections();
            m.push({
                text: _('cronmanager.logs_delete_selected'),
                handler: function () {
                    var cs = this.getSelectedAsList();
                    if (cs === false) {
                        return false;
                    }
                    MODx.msg.confirm({
                        title: _('cronmanager.logs_delete_selected'),
                        text: _('cronmanager.logs_delete_selected_confirm'),
                        url: this.config.url,
                        params: {
                            action: 'mgr/cronjoblogs/removeselected',
                            ids: cs
                        },
                        listeners: {
                            success: {
                                fn: function (r) {
                                    this.refresh();
                                },
                                scope: this
                            }
                        }
                    });
                }
            });
        } else {
            // Single row selected
            m.push({
                text: _('cronmanager.log_view_full'),
                handler: this.viewLog
            });
        }
        this.addContextMenuItem(m);
    },
    viewLog: function (btn, e) {
        var fullLog = MODx.load({
            xtype: 'cronmanager-window-fulllog',
            record: this.menu.record,
            listeners: {
                success: {
                    fn: this.refresh,
                    scope: this
                }
            }
        });
        fullLog.setValues(this.menu.record);
        fullLog.show(e.target);
    },
    purgeLogs: function () {
        var grid = Ext.getCmp(this.ident + '-cronmanager-grid-cronjoblog');
        if (!grid) {
            return false;
        }
        MODx.msg.confirm({
            title: _('cronmanager.logs_purge_title'),
            text: _('cronmanager.logs_purge_confirm'),
            url: grid.url,
            params: {
                action: 'mgr/cronjoblogs/purgelogs',
                cronjob: grid.baseParams.cronjob
            },
            listeners: {
                success: {
                    fn: function (r) {
                        grid.refresh();
                    },
                    scope: this
                }
            }
        });
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
        s.baseParams.error = 'all';
        Ext.getCmp(this.ident + '-cronmanager-filter-search').reset();
        this.getBottomToolbar().changePage(1);
        this.refresh();
    },
    filter: function (cb, rec) {
        var s = this.getStore();
        s.baseParams.error = rec.data.v;
        this.getBottomToolbar().changePage(1);
        this.refresh();
    },
    buttonColumnRenderer: function () {
        var values = {
            action_buttons: [
                {
                    className: 'fulllog',
                    icon: 'eye',
                    text: _('cronmanager.log_view_full')
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
                case 'fulllog':
                    this.viewLog(record, e);
                    break;
                default:
                    break;
            }
        }
    }
});
Ext.reg('cronmanager-grid-cronjoblog', CronManager.grid.CronJobLog);


CronManager.window.FullLog = function (config) {
    config = config || {};

    Ext.applyIf(config, {
        title: config.record.logdate,
        fields: [{
            xtype: 'textarea',
            name: 'message',
            anchor: '100%',
            readOnly: true,
            height: '150'
        }],
        buttons: [{
            text: _('close'),
            scope: this,
            handler: function () {
                this.close();
            }
        }],
        keys: []
    });
    CronManager.window.FullLog.superclass.constructor.call(this, config);
};
Ext.extend(CronManager.window.FullLog, MODx.Window);
Ext.reg('cronmanager-window-fulllog', CronManager.window.FullLog);
