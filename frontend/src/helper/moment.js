import moment from 'moment'

var mixin = {
    methods: {
        setDateFormat: function (date) {
            return moment(date, 'YYYY-MM-DD').format('MM-DD-YYYY hh:mm A');
        }
    }
};

export default mixin;