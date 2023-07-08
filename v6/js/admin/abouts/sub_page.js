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

$(document).ready(function () {


    $('._pdf').click(function () {

        loadPDF(10);

    })




    $('#btn_upload').click(function () {



        var fd = new FormData();
        var files = $('#file')[0].files[0];





        var pdf_title = $('#pdf_title').val();
        var pdf_dis = $('#pdf_dis').val();
        var aid = $('#aid').val();
        var ptype = $('#ptype').val();



        fd.append('file', files);
        fd.append('pdf_title', pdf_title);
        fd.append('pdf_dis', pdf_dis);
        fd.append('aid', aid);
        fd.append('ptype', ptype);




        if (pdf_title != '') {

            $(this).closest('form').find("input[type=text],input[type=file], textarea").val("");

            // AJAX request
            $.ajax({
                url: base_url_front + 'system-content/About/pdf',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function (response) {


                    if (response != 0) {

                        loadPDF(aid);

                    } else {

                        $('#error').html('<span style="color:red" >Please Check the pdf</span>');

                    }
                }
            });
        } else {

            $('#error').html('<span style="color:red" >Please Enter the pdf Details</span>');

        }
    });
});


function loadPDF(id) {



    var tablede = '<img src="' + base_url_front + 'upload/loading-bar-1.gif" width="200"  >';

    $('.pdf_dis').html(tablede);

    $('.pdf_dis').html(tablede);

    $.ajax({
        type: "POST",
        url: "'+base_url_front+'system-content/About/viewPdf",
        data: {
            id: id,


        },
    }).done(function (json) {


        var retuenValue = $.parseJSON(json);


        if (retuenValue.length != 0) {
            var tablede = '';
            tablede += "<table id='example' style='font-size:12px;' class='    display table data' cellspacing='0' width='100%'><thead><tr><th>#</th><th>Title</th><th>PDF</th><th>Action</th></tr></thead><tbody>";

            var a = 0;
            for (var b = 0; b < retuenValue.length; b++) {
                a++;

                tablede += "<tr><td>" + a + "</td><td>" + retuenValue[b]['heading'] + "</td><td><a target='_blank' href='" + base_url_front + "" + retuenValue[b]['pdf'] + "' >pdf</a></td><td><a data-pid='" + retuenValue[b]['pid'] + "' class='pdf_del btn btn-danger'><i class='fa fa-times'  ></i></a></td></tr>";

            }
            tablede += "</tbody></table>";

        } else {
            var tablede = '';
        }

        $('.pdf_dis').html(tablede);



    })

}



$(document).on("click", ".pdf_del", function () {

    var pid = $(this).data('pid');

    delete_tr = $(this).closest('tr');

    $.ajax({
        type: "POST",
        url: base_url_front + "system-content/About/deletepdf",
        data: {
            pid: pid

        }
    }).done(function (json) {


        delete_tr.css("background-color", "#FF0000");
        delete_tr.fadeOut(1200, function () {
            delete_tr.remove();
        });



    })

    loadPDF(10);

})
