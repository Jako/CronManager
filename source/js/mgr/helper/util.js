CronManager.util.dateRenderer = function (format) {
    return function (v) {
        if (typeof v === 'string' && v !== '') {
            var format = (format) ? format : MODx.config.manager_date_format + ' ' + MODx.config.manager_time_format;
            var date = new Date(v.replace(/\s/, 'T'));
            return Ext.util.Format.date(date, format);
        } else {
            return v;
        }
    }
};

