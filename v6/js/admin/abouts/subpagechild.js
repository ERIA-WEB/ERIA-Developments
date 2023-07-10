var base_url_front = $('.base_url_front').val();
var delete_id = null;
var delete_tr = null;
var name = null;

$('.confirmation-callback').click(function () {
    delete_id = $(this).data("id");
    var name = $(this).data("area");
    delete_tr = $(this).closest('tr');
});

$('.confirmation-callback').confirmation({
    singleton: true,
    onConfirm: function (event, element) {
        $.ajax({
            type: "POST",
            url: base_url_front + "system-content/user/deleteUser",
            data: {
                id: delete_id,
                name: name

            }
        }).done(function (json) {
            delete_tr.css("background-color", "#FF0000");
            delete_tr.fadeOut(1200, function () {
                delete_tr.remove();
            });
        })
    }
});
