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
                url: base_url_front + "system-content/About/deleter",
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
}


$(function () {
    $('.pop').on('click', function () {
        $('.imagepreview').attr('src', $(this).find('img').attr('src'));
        $('#imagemodal').modal('show');
    });
});


$('#photo').change(function () {
    var input = this;
    var name = $(this).val();

    $('#image').val(name);

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#placeholder').attr('src', e.target.result).attr('width', 142);
        };
        reader.readAsDataURL(input.files[0]);
    }
});



var delete_id = null;
var delete_tr = null;
var status = null;

$('.pub-callback').click(function () {
    delete_id = $(this).data("id");
    var status = $(this).data("status");
    delete_tr = $(this).closest('tr');

    statusCareer(delete_id, status, delete_tr);
});

function statusCareer(delete_id, status, delete_tr) {
    $('.pub-callback').confirmation({
        singleton: true,
        title: "Publish confirmation",
        onConfirm: function (event, element) {
            $.ajax({
                type: "POST",
                url: base_url_front + "system-content/research/publishR",
                data: {
                    id: delete_id,
                    pub: status,

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
