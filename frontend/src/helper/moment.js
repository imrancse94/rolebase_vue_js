import moment from 'moment'

export const setDateFormat = function (date) {
    return moment(date, 'YYYY-MM-DD').format('DD/MM/YYYY');
}