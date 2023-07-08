var base_url_front = $('.base_url_front').val();
var delete_id = null;
var delete_tr = null;
var name = null;

$('.confirmation-callback').click(function () {
    delete_id = $(this).data("id");
    var name = $(this).data("area");
    delete_tr = $(this).closest('tr');

    confirmationCallbackDelete(delete_id, name, delete_tr);
});

function confirmationCallbackDelete(delete_id, name, delete_tr) {
    $('.confirmation-callback').confirmation({
        singleton: true,
        onConfirm: function (event, element) {
            $.ajax({
                type: "POST",
                url: base_url_front + "system-content/About/deleteSubPageChild",
                data: {
                    id: delete_id,
                    name: name

                }
            }).done(function (json) {
                delete_tr.css("background-color", "#FF0000");
                delete_tr.fadeOut(1200, function () {
                    delete_tr.remove();
                    delete_tr.fadeOut(1200, function () {
                        location.reload();
                    });
                });
            })
        }
    });
}



$('.pub-callback').click(function () {
    delete_id = $(this).data("id");
    var status = $(this).data("status");

    delete_tr = $(this).closest('tr');

    publishR(delete_id, status, delete_tr);
});

function publishR(delete_id, status, delete_tr) {

    $('.pub-callback').confirmation({
        singleton: true,
        title: "Publish confirmation",
        onConfirm: function (event, element) {
            $.ajax({
                type: "POST",
                url: base_url_front + "system-content/About/publishR",
                data: {
                    id: delete_id,
                    pub: status
                }
            }).done(function (json) {
                delete_tr.css("background-color", "yellow");
                delete_tr.fadeOut(1200, function () {
                    location.reload();
                });
            })
        }
    });
}


$(document).ready(function () {
    $('#examples').DataTable();
});
