CronManager.util.dateRenderer = function (dateFormat) {
    return function (value) {
        if (typeof value === 'string' && value !== '' && Date.parseDate(value, 'Y-m-d H:i:s')) {
            var format = (dateFormat) ? dateFormat : MODx.config.manager_date_format + ' ' + MODx.config.manager_time_format;
            value = Date.parseDate(value, 'Y-m-d H:i:s');
            return Ext.util.Format.date(value, format);
        } else {
            return value;
        }
    }
};
