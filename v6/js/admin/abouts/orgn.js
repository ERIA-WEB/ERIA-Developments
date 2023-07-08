var base_url_front = $('.base_url_front').val();
// Add Form
$(document).ready(function () {
    var max_fields = 0;
    var wrapper = $(".form_peoples");
    var add_form = $("#add_form_button");

    if ($('#count_key').val() != 0) {
        var i = $('#count_key').val() - 1;
    } else {
        var i = $('#count_key').val();
    }

    $(add_form).click(function (e) {
        e.preventDefault();
        var total_fields = wrapper[0].childNodes.length;

        $.ajax({
            type: "POST",
            url: base_url_front + "system-content/About/getAllPeople",
            data: {
                published: 1
            }
        }).done(function (json) {
            ++i;
            $(wrapper).append(
                '<div class="col-md-6"><label class="form-label">Peoples</label><select class="form-control" name="people_id[' +
                i + '][people]">' + json +
                '</select></div><div class="col-md-6"><label class="form-label">Sort order</label><input type="number" class="form-control" name="people_id[' +
                i + '][sort]"></div>'
            );
        });
    });
});


$("#peoples").select2({
    placeholder: 'Choose People',
    allowClear: true
}).on('select2-open', function () {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
});



var delete_id = null;
var delete_tr = null;
var name = null;

$('.confirmation-callback').click(function () {
    delete_id = $(this).data("id");
    var name = $(this).data("area");
    delete_tr = $(this).closest('tr');

    confirmationCallback(delete_id, name, delete_tr);
});

function confirmationCallback(delete_id, name, delete_tr) {
    $('.confirmation-callback').confirmation({

        singleton: true,

        onConfirm: function (event, element) {
            $.ajax({
                type: "POST",
                url: base_url_front + "system-content/About/deleteorg",
                data: {
                    id: delete_id,
                    name: name
                }
            }).done(function (json) {
                delete_tr.css("background-color", "#FF0000");
                delete_tr.fadeOut(1200, function () {
                    delete_tr.remove();
                    location.reload();
                });
            });
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

    statusData(delete_id, status, delete_tr);

});

function statusData(delete_id, status, delete_tr) {
    $('.pub-callback').confirmation({
        singleton: true,
        title: "Publish confirmation",
        onConfirm: function (event, element) {
            $.ajax({
                type: "POST",
                url: base_url_front + "system-content/about/publishO",
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
