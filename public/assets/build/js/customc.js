
$('.datepickerMonthYear').daterangepicker({
    singleDatePicker: true,
    singleClasses: "picker_1",
    showDropdowns: true,
    // minDate: '06/01/2013',
    //maxDate: '06/30/2015',
    // minDate: '06/01/2013',
    //maxDate: '06/30/2015',
    minDate:new Date(),
    locale: {
        format: "DD-MMM-YYYY",
        cancelLabel: 'Clear'
    }
}).on('hide.daterangepicker', function (ev, picker) {
    $('.table-condensed tbody tr:nth-child(2) td').click();




});

$('.datepickerMonthYearTow').daterangepicker({
    singleDatePicker: true,
    singleClasses: "picker_1",
    showDropdowns: true,
    minDate:new Date(),
    // minDate: '06/01/2013',
    //maxDate: '06/30/2015',
    locale: {
        format: "DD-MMM-YYYY",
        cancelLabel: 'Clear'
    }
}).on('hide.daterangepicker', function (ev, picker) {
    $('.table-condensed tbody tr:nth-child(2) td').click();


});

// Datepicker
$(document).on('focus', '.datepickerMonthYearAppend', function(e){
    $(e.target).daterangepicker({
        singleDatePicker: true,
        singleClasses: "picker_1",
        showDropdowns: true,
        locale: {
            format: "DD-MM-YYYY"
        }
    })
}).on('show.daterangepicker', function () {
    $('.table-condensed tbody tr:nth-child(2) td').click();
});
