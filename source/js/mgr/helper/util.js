CronManager.util.dateRenderer = function (format) {
    return function (v) {
        if (typeof v === 'string' && v !== '' && Date.parseDate(v, 'Y-m-d H:i:s')) {
            var format = (format) ? format : MODx.config.manager_date_format + ' ' + MODx.config.manager_time_format;
            v = Date.parseDate(v, 'Y-m-d H:i:s');
            return Ext.util.Format.date(v, format);
        } else {
            return v;
        }
    }
};
