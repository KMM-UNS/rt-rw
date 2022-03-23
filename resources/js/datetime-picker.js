$(function () {
    $(':input.datetime-picker').datetimepicker({
        format: 'DD-MM-YYYY HH:mm'
    });

    $(':input.date-picker').datetimepicker({
        format: 'DD-MM-YYYY'
    });
});