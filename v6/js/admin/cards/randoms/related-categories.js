
$("#other_topics").select2({
    placeholder: 'Choose Other Topics',
    allowClear: true
}).on('select2-open', function () {
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
});
