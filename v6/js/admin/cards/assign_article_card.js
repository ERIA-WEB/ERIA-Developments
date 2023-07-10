var base_url_front = $('.base_url_front').val();
$('.assig_order').change(function () {

    var num = $(this).val();
    var page = $('option:selected', this).data('page');
    var id = $('#id').val();

    $.ajax({
        type: 'POST',
        url: base_url_front + "system-content/Card/assign_Cart",
        data: {
            id: id,
            num: num,
            page: page

        },
        beforeSend: function () {
            // setting a timeout
            $('#loading').removeClass('hidden');

            $('#tblCards').addClass('hidden');

        },
        success: function (data) {
            $('#tblCards').removeClass('hidden');
        },
        error: function (xhr) { },
        complete: function () {
            $('#loading').addClass('hidden');
        },
        dataType: 'html'
    });
})
