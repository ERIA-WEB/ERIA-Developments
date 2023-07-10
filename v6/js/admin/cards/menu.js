
$('.change_f').change(function () {
    var heading = $(this).find(':selected').data('title');
    var tasean = $(this).find(':selected').data('class');
    var img = $(this).find(':selected').data('img');
    var iclass = $(this).find(':selected').data('iclass');

    $('.' + iclass).attr('src', img);
    $('.' + tasean).html(heading);
});
