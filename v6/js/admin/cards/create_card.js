var base_url_front = $('.base_url_front').val();
$('#chooseSelectTemplate').on('change', function () {
    var value = $(this).val();
    if (value == 'template_file') {
        $('#templateCardFile').removeClass('hidden');
        $('#templateCardCode').addClass('hidden');

        $('#file_card').attr("required", "true");
    } else {
        $('#templateCardCode').removeClass('hidden');
        $('#templateCardFile').addClass('hidden');

        $('#file_card').prop('required', false);

    }
});
