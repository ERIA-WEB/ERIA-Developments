
$('#chooseSelectTemplate').on('change', function () {
    var value = $(this).val();
    if (value == 'template_file') {
        $('#templateCardFile').removeClass('hidden');
        $('#templateCardCode').addClass('hidden');

        $('#file_card').attr("required", "true");
        $('#summernoteTextArea').prop('required', false);
    } else {
        $('#templateCardCode').removeClass('hidden');
        $('#templateCardFile').addClass('hidden');

        $('#file_card').prop('required', false);
        $('#summernoteTextArea').attr("required", "true");
    }
});


$('.summernote').summernote({
    height: 1024,
    placeholder: 'Paste content here...',
    codemirror: {
        theme: 'monokai'
    }
});
