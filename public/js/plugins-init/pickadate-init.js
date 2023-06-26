(function($) {
    "use strict"

    //date picker classic default
    $('.datepicker-default').pickadate({
        format: 'dd-mm-yyyy'
    });

    $('.datepicker-year').pickadate({
        format: 'yyyy',
        selectYears: true,
    });

})(jQuery);