(function ($) {
    "use strict"

    // Daterange picker
    $('.input-daterange-datepicker').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
        buttonClasses: ['btn', 'btn-sm'],
        startDate: moment().startOf('month'),
        endDate: moment().endOf('month'),
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        alwaysShowCalendars: true
    });
})(jQuery);
