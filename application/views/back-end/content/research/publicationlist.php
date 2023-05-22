<style>
.dataTables_info {
    margin-top: 0px !important;
}

.select2-container-multi .select2-choices {

    z-index: 9999999;
}
</style>
<section id="main-content">
    <section class="wrapper main-wrapper">
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="page-title">
                <div class="pull-left">
                    <h1 class="title"> List of Publication </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a><i class="fa fa-globe"></i><strong> Research & Publication </strong></a>
                        </li>
                        <li class="active">
                            List
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!--my comment-->
        <div class="clearfix"></div>
        <div class="col-lg-12">
            <?php $this->load->view('back-end/common/message'); ?>
            <section class="box">
                <header class="panel_header">
                    <h2 class="title pull-left"> Publication List</h2>
                    <div class="actions panel_actions pull-right">
                        <i class="box_toggle fa fa-chevron-down"></i>
                        <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                        <i class="box_close fa fa-times"></i>
                    </div>
                </header>
                <div class="content-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12" id="dvContents">
                            <table id="examples" style="font-size:12px;"
                                class="display table table-hover table-condensed" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center" width="50%">Title </th>
                                        <th class="text-center">Image</th>
                                        <th class="text-center">Post Date</th>
                                        <th class="text-center" width="5%">PDF</th>
                                        <th class="text-center" width="10%">Duplicate Page</th>
                                        <th class="text-center" width="5%">Published</th>
                                        <th class="text-center hidden-print">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $results = $this->privilage->cacheManager($areaList->result(), 'publications_list');
                                    $x = 0;
                                    foreach ($results as $id => $area) : $x++; ?>
                                    <tr>
                                        <td class="text-center"> <?php echo $x; ?> </td>
                                        <td> <?php echo $this->privilage->RemoveBS($area->title); ?></td>
                                        <td class="text-center">
                                            <?php
                                                if (file_exists(FCPATH . $area->image_name) && $area->image_name != '') {
                                                    $img = base_url() . $area->image_name;
                                                } elseif (file_exists(FCPATH . '/resources/images' . $area->image_name) && $area->image_name != '') {
                                                    $img = base_url() . "/upload/Publication.jpg";
                                                } else {

                                                    $url_ = "https://www.eria.org" . $area->image_name;
                                                    $response = @file_get_contents($url_);

                                                    if ($response == false) {
                                                        $img = base_url() . "/upload/Publication.jpg";
                                                    } else {
                                                        if (strlen($response)) {
                                                            if (!empty($area->image_name)) {
                                                                $img = "https://www.eria.org/" . $area->image_name;
                                                            } else {
                                                                $img = base_url() . "/upload/Publication.jpg";
                                                            }
                                                        } else {
                                                            $img = base_url() . "/upload/Publication.jpg";
                                                        }
                                                    }
                                                }
                                                ?>
                                            <a href="#" class="pop">
                                                <img src="<?php echo $img; ?>" width="30px">
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <?php echo date('j F Y', strtotime($area->posted_date)); ?>
                                        </td>
                                        <td class="text-center">
                                            <a data-toggle="modal" data-aid="<?php echo $area->article_id ?>"
                                                data-title="<?php echo $area->title ?>"
                                                data-author_editor="<?php echo $area->editor . ', ' . $area->author; ?>"
                                                class="btn btn-info _pdf" href="#myModal1">
                                                <i class="fa fa-file-pdf-o"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-target="#modal<?= $id ?>">
                                                Pages
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <?php $session_user = $this->session->userdata('logged_in'); ?>
                                            <?php
                                                if ($area->published == 0) {
                                                    $btnstatus = 'data-btn-ok-class="btn btn-success" data-status="1" data-btn-ok-label="Published" data-placement="left" class="btn btn-warning  pub-callback"';
                                                } else {
                                                    $btnstatus = 'data-btn-ok-class="btn btn-warrning" data-status="0" data-btn-ok-label="Un Published" data-placement="left" class="btn btn-success pub-callback"';
                                                }

                                                $status_action = $this->privilage->status('status', $session_user['user_id'], $area->article_id, $btnstatus);
                                                // get action status published
                                                echo $status_action['status'];
                                                ?>
                                        </td>
                                        <td class="text-center hidden-print">
                                            <?php
                                                $edit_action = $this->privilage->edit('edit', $session_user['user_id'], 'Research/editPub/', $area->article_id);
                                                $delete_action = $this->privilage->delete('delete', $session_user['user_id'], $area->article_id);
                                                // get action edit
                                                echo $edit_action['edit'];
                                                // get action delete
                                                echo $delete_action['delete'];
                                                ?>
                                            <a class="btn btn-success"
                                                href="<?php echo base_url() ?>system-content/Card/assignCard_article/<?php echo $area->article_id ?>">
                                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <?php
                                        $site_url = base_url().'system-content/Research/duplication_pages';
                                        $modal_duplication_page = $this->privilage->duplicationPage('publications', $area->article_id, $area->title, $id, $site_url, $area->uri);

                                        echo $modal_duplication_page;
                                    ?>

                                    <?php endforeach  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
</section>
<?php $this->load->view('back-end/content/research/modals/image-preview'); ?>
<?php $this->load->view('back-end/content/research/modals/manage-pdf'); ?>

<script src="<?php echo base_url() ?>resources/js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/js/jquery.easing.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/js/form-validation.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/perfect-scrollbar/perfect-scrollbar.min.js"
    type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/viewport/viewportchecker.js" type="text/javascript"></script>

<!-- CORE JS FRAMEWORK - END -->
<script src="<?php echo base_url() ?>resources/plugins/datatables/js/jquery.dataTables.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url() ?>resources/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"
    type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"
    type="text/javascript"></script>
<script
    src="<?php echo base_url() ?>resources/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.js"
    type="text/javascript"></script>

<!-- CORE TEMPLATE JS - START -->
<script src="<?php echo base_url() ?>resources/js/scripts.js" type="text/javascript"></script>
<!-- END CORE TEMPLATE JS - END -->

<!-- Sidebar Graph - START -->
<script src="<?php echo base_url() ?>resources/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url() ?>resources/js/chart-sparkline.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/select2/select2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/js/bootstrap-confirmation.min.js"></script>
<script src="<?php echo base_url() ?>resources/js/custome.js" type="text/javascript"></script>
<script>
var delete_id = null;
var delete_tr = null;
var name = null;

$('.confirmation-callback').click(function() {
    delete_id = $(this).data("id");
    name = $(this).data("area");
    delete_tr = $(this).closest('tr');

    confirmationCallbackDelete(delete_id, name, delete_tr);
});

function confirmationCallbackDelete(delete_id, name, delete_tr) {
    $('.confirmation-callback').confirmation({
        singleton: true,
        onConfirm: function(event, element) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>system-content/Research/deleter",
                data: {
                    id: delete_id,
                    name: name

                }
            }).done(function(json) {
                delete_tr.css("background-color", "#FF0000");
                delete_tr.fadeOut(1200, function() {
                    delete_tr.remove();
                    location.reload();
                });
            })
        }
    });
}
</script>
<script>
$(function() {
    $('.pop').on('click', function() {
        $('.imagepreview').attr('src', $(this).find('img').attr('src'));
        $('#imagemodal').modal('show');
    });
});
</script>
<script>
$('#photo').change(function() {
    var input = this;
    var name = $(this).val();
    $('#image').val(name);
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#placeholder').attr('src', e.target.result).attr('width', 142);
        };
        reader.readAsDataURL(input.files[0]);
    }
});
</script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
function loadPDF(id) {
    var tablede = '<img src="<?php echo base_url() ?>upload/loading-bar-1.gif" width="300px">';

    $('.pdf_dis').html(tablede);

    $('.pdf_dis').html(tablede);

    $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>system-content/Programmes/viewPdf",
        data: {
            id: id,
        },
    }).done(function(json) {

        var retuenValue = $.parseJSON(json);
        if (retuenValue.length != 0) {
            var tablede = '';

            tablede +=
                "<table id='tablePreviewPDF' style='font-size:12px;' class='display table table-hover table-condensed' cellspacing='0' width='100%'><thead><tr><th>Sort order</th><th >Title</th><th>Description</th><th> Author / Editor</th><th>PDF</th><th>Action</th></tr></thead><tbody>";
            var a = 0;
            for (var b = 0; b < retuenValue.length; b++) {
                a++;
                var nd = '';
                for (var j = 0; j < retuenValue[b]['author'].length; j++) {
                    nd += "<span>" + retuenValue[b]['author'][j]['title'] +
                        "&nbsp <a href='#' class='pd btn btn-danger' data-id='" + retuenValue[b]['author'][j][
                            'paid'
                        ] + "'  ><i class='fa fa-times'></i></a> </span><br>";
                }
                tablede += "<tr id='rowEdit" + retuenValue[b]['pdf_id'] + "'><td>" + retuenValue[b][
                        'order_id'
                    ] + "</td><td style='width:30%;text-align:left;'>" + retuenValue[b]['pdf_title'] +
                    "</td><td style='width:40%;text-align:left;'>" + retuenValue[b]['pdf_discription'] +
                    "</td><td style='width:16%;text-align:left;'>" + nd +
                    "</td><td style='width:5%;text-align:left;'><a target='_blank' href='<?php echo base_url() ?>" +
                    retuenValue[b]['pdf'] +
                    "' >pdf</a></td><td style='width:20%;text-align:left;'><a data-pid='" + retuenValue[b][
                        'pdf_id'
                    ] +
                    "' class='pdf_edit btn btn-primary'><i class='fa fa-pencil'></i></a>&nbsp <a data-pid='" +
                    retuenValue[b]['pdf_id'] +
                    "' class='pdf_del btn btn-danger'><i class='fa fa-times'  ></i></a></td></tr>";
            }

            tablede += "</tbody></table>";
            $('#tablePreviewPDF').DataTable();
        } else {
            var tablede = '';
        }


        $('.pdf_dis').html(tablede);

        /*
         ** View Edit PDF Row
         */
        $(document).on('click', '.pdf_edit', function() {

            var pid_ = $(this).data('pid');
            var aid = $('#aid').val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>system-content/programmes/editpdf",
                data: {
                    pid: pid_
                }
            }).done(function(json) {

                var valueDataPdf = $.parseJSON(json);
                // console.log(valueDataPdf);
                var templateEdit = '';
                var author = '';
                var all_author = '';
                for (var x = 0; x < valueDataPdf['author'].length; x++) {
                    author += "<option value='" + valueDataPdf['author'][x]['article_id'] +
                        "' selected>" + valueDataPdf['author'][x]['title'] + "</option>";
                }

                for (var z = 0; z < valueDataPdf['all_author'].length; z++) {
                    all_author += "<option value='" + valueDataPdf['all_author'][z][
                            'article_id'
                        ] + "'>" + valueDataPdf['all_author'][z]['title'] +
                        "</option>";
                }

                templateEdit = "<td><input type='text' name='orderid' value='" + valueDataPdf[
                        'order_id'] +
                    "'></td><td style='width:30%;text-align:left;'><input type='text' value='" +
                    valueDataPdf['pdf_title'] +
                    "' name='pdfTitle' class='form-control'></td><td style='width:40%;text-align:left;'><textarea id='pdfDiscription' name='pdfDiscription' class='form-control' style='height:235px;'>" +
                    valueDataPdf['pdf_discription'] +
                    "</textarea></td><td style='width:16%;text-align:left;'><select id='authorRows' name='authorRows[]' class='author_' multiple>" +
                    author + all_author +
                    "</select></td><td style='width:5%;text-align:left;'><input type='file' id='filePdf' name='filePdf'><input type='hidden' id='file_pdf_old' name='file_pdf_old' value='" +
                    valueDataPdf['pdf'] +
                    "'><a target='_blank' href='<?php echo base_url() ?>" + valueDataPdf[
                        'pdf'] +
                    "' >pdf</a></td><td style='width:20%;text-align:left;'><a id='pdf_update" +
                    valueDataPdf['pdf_id'] + "' data-pid='" + valueDataPdf['pdf_id'] +
                    "' class='pdf_update btn btn-primary'>ok</a>&nbsp <a data-pid='" +
                    valueDataPdf['pdf_id'] + "' id='pdf_cancel" + valueDataPdf['pdf_id'] +
                    "' class='pdf_cancel" + valueDataPdf['pdf_id'] +
                    " btn btn-danger'>cancel</a></td>";
                $('#rowEdit' + pid_ + '').html(templateEdit);
                $(".author_").select2();

                /*
                 ** View Cancel and back to PDF Row
                 */
                $("#pdf_cancel" + valueDataPdf['pdf_id'] + "").on('click', function() {
                    var pid_view = valueDataPdf['pdf_id'];
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>system-content/programmes/editpdf",
                        data: {
                            pid: pid_view
                        }
                    }).done(function(json) {

                        var valueDataViewPdf = $.parseJSON(json);
                        console.log(valueDataViewPdf);
                        var templateEditView = '';
                        var authorView = '';
                        for (var x = 0; x < valueDataViewPdf['author']
                            .length; x++) {
                            authorView += "<span>" + valueDataViewPdf['author'][
                                    x
                                ]['title'] +
                                "&nbsp <a href='#' class='pd btn btn-danger' data-id='" +
                                valueDataViewPdf['author'][x]['paid'] +
                                "'  ><i class='fa fa-times'></i></a> </span><br>";
                        }
                        templateEditView = "<td>" + valueDataViewPdf[
                                'order_id'] +
                            "</td><td style='width:30%;text-align:left;'>" +
                            valueDataViewPdf['pdf_title'] +
                            "</td><td style='width:40%;text-align:left;'>" +
                            valueDataViewPdf['pdf_discription'] +
                            "</td><td style='width:16%;text-align:left;'>" +
                            authorView +
                            "</td><td style='width:5%;text-align:left;'><a target='_blank' href='<?php echo base_url() ?>" +
                            valueDataViewPdf['pdf'] +
                            "' >pdf</a></td><td style='width:20%;text-align:left;'><a data-pid='" +
                            valueDataViewPdf['pdf_id'] +
                            "' class='pdf_edit btn btn-primary'><i class='fa fa-pencil'></i></a>&nbsp <a data-pid='" +
                            valueDataViewPdf['pdf_id'] +
                            "' class='pdf_del btn btn-danger'><i class='fa fa-times'></i></a></td>";
                        $("#rowEdit" + valueDataViewPdf['pdf_id'] + "").html(
                            templateEditView);
                    });
                });

                /*
                 ** Process Update Edit PDF Row
                 */
                $("#pdf_update" + valueDataPdf['pdf_id'] + "").on('click', function() {
                    var iDView = valueDataPdf['pdf_id'];
                    var order_id = $("input[name=orderid]").val();
                    var pdf_title = $("input[name=pdfTitle]").val();
                    var pdf_discription = $("#pdfDiscription").val();

                    var file_pdf = $('#filePdf').prop('files')[0];

                    var file_pdf_old = $('#file_pdf_old').val();
                    var article_id = $('#aid').val();

                    var valAuthor = $("#authorRows :selected").map((_, e) => e.value)
                        .get();

                    var form_data = new FormData();

                    form_data.append("author", valAuthor);
                    form_data.append("file", file_pdf);
                    form_data.append("id", iDView);
                    form_data.append("pdf_title", pdf_title);
                    form_data.append("pdf_discription", pdf_discription);

                    form_data.append("order_id", order_id);
                    form_data.append("article_id", article_id);
                    form_data.append("file_pdf_old", file_pdf_old);
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>system-content/programmes/updatepdf",
                        dataType: 'text',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        beforeSend: function() {
                            $("#preview").html(
                                '<img src="<?php echo base_url() ?>upload/loading-bar-1.gif" width="300px">'
                            );
                        },
                        success: function(form_data) {
                            // console.log(form_data);
                            var resultValueUpdate = $.parseJSON(form_data);
                            console.log(resultValueUpdate.length);
                            if (resultValueUpdate.length > 0) {
                                var tableResultUpdate = '';

                                tableResultUpdate +=
                                    "<table id='tablePreviewPDF' style='font-size:12px;' class='display table table-hover table-condensed' cellspacing='0' width='100%'><thead><tr><th>Sort order</th><th >Title</th><th>Description</th><th> Author / Editor</th><th>PDF</th><th>Action</th></tr></thead><tbody>";

                                var m = 0;
                                for (var n = 0; n < resultValueUpdate
                                    .length; n++) {
                                    m++;
                                    var lmn = '';
                                    for (var l = 0; l < resultValueUpdate[n]
                                        ['author'].length; l++) {
                                        lmn += "<span>" + resultValueUpdate[
                                                n]['author'][l]['title'] +
                                            "&nbsp <a href='#' class='pd btn btn-danger' data-id='" +
                                            resultValueUpdate[n]['author'][
                                                l
                                            ]['paid'] +
                                            "'  ><i class='fa fa-times'></i></a> </span><br>";
                                    }

                                    tableResultUpdate += "<tr id='rowEdit" +
                                        resultValueUpdate[n]['pdf_id'] +
                                        "'><td>" + resultValueUpdate[n][
                                            'order_id'
                                        ] +
                                        "</td><td style='width:30%;text-align:left;'>" +
                                        resultValueUpdate[n]['pdf_title'] +
                                        "</td><td style='width:40%;text-align:left;'>" +
                                        resultValueUpdate[n][
                                            'pdf_discription'
                                        ] +
                                        "</td><td style='width:16%;text-align:left;'>" +
                                        lmn +
                                        "</td><td style='width:5%;text-align:left;'><a target='_blank' href='<?php echo base_url() ?>" +
                                        resultValueUpdate[n]['pdf'] +
                                        "' >pdf</a></td><td style='width:20%;text-align:left;'><a data-pid='" +
                                        resultValueUpdate[n]['pdf_id'] +
                                        "' class='pdf_edit btn btn-primary'><i class='fa fa-pencil'></i></a>&nbsp <a data-pid='" +
                                        resultValueUpdate[n]['pdf_id'] +
                                        "' class='pdf_del btn btn-danger'><i class='fa fa-times'  ></i></a></td></tr>";
                                }

                                tableResultUpdate += "</tbody></table>";
                            } else {
                                var tableResultUpdate = '';
                            }

                            $('#tablePreviewPDF').DataTable();
                            $('#preview').html(tableResultUpdate);
                        },
                    });
                });
            });
        });
    });
}

$(document).on("click", "._pdf", function() {
    var id = $(this).data('aid');
    var title = $(this).data('title');
    var author_editor = $(this).data('author_editor');

    $('#aid').val(id);
    $('#pdf_title').val(title);
    $('#author_editor').val(author_editor);

    loadPDF(id);

    $(".author_").select2();
})

// $(document).on('click', '.pdf_edit', function() {

//     var pid = $(this).data('pid');
//     var aid = $('#aid').val();

//     $.ajax({
//         type: "POST",
//         url: "<?php echo base_url(); ?>system-content/programmes/editpdf",
//         data: {
//             pid: pid
//         }
//     }).done(function(json) {
//         var valueDataPdf = $.parseJSON(json);
//         console.log(valueDataPdf['pdf_title'])
//         $('#pdf_title').val(valueDataPdf['pdf_title']);
//         $('#pdf_dis').val(valueDataPdf['pdf_discription']);
//     })
// });

$(document).on("click", ".pdf_del", function() {

    var pid = $(this).data('pid');
    var aid = $('#aid').val();
    delete_tr = $(this).closest('tr');

    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>system-content/Programmes/deletepdf",
        data: {
            pid: pid

        }
    }).done(function(json) {
        delete_tr.css("background-color", "#FF0000");
        delete_tr.fadeOut(1200, function() {
            delete_tr.remove();
        });
    })

    loadPDF(aid);

})

$(document).ready(function() {

    $('#btn_upload').click(function() {

        $(':input[type="button"]').prop('disabled', true);
        // setting a timeout
        $('#loading').removeClass('hidden');
        $('#preview').addClass('hidden');

        var fd = new FormData();
        var files = $('#file')[0].files[0];
        var pdf_title = $('#pdf_title').val();
        var pdf_dis = $('#pdf_dis').val();
        var aid = $('#aid').val();
        var ptype = $('#ptype').val();
        var author = $('#author').val();
        var order_id = $('#orderid_form').val();

        fd.append('file', files);
        fd.append('pdf_title', pdf_title);
        fd.append('pdf_dis', pdf_dis);
        fd.append('aid', aid);
        fd.append('ptype', ptype);
        fd.append('author', author);
        fd.append('order_id', order_id);

        if (pdf_title != '' && pdf_dis != '') {

            $(this).closest('form').find("input[type=text],input[type=file], textarea, select, ul, li")
                .val("");
            $('#formUploadFilePDF')[0].reset();
            // AJAX request

            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>system-content/Programmes/pdf",
                data: fd,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $("#author").select2("val", "");
                    // setting a timeout
                    $('#loading').removeClass('hidden');

                    $('#preview').addClass('hidden');

                },
                success: function(response) {
                    $(':input[type="button"]').prop('disabled', false);
                    if (response != 0) {
                        $('#preview').removeClass('hidden');
                        loadPDF(aid);
                    } else {
                        $('#error').html(
                            '<span style="color:red" >Please Check the pdf</span>');
                    }
                },
                error: function(xhr) {},
                complete: function() {
                    $('#loading').addClass('hidden');
                    $(':input[type="button"]').prop('disabled', false);
                },
                dataType: 'html'
            });
        } else {

            $('#error').html('<span style="color:red" >Please Enter the pdf Details</span>');

        }
    });
});
</script>
<script>
$(document).ready(function() {
    $('#summernote').summernote();
    $('#article_keywords').summernote();
});
</script>
<script>
var delete_id = null;
var delete_tr = null;
var status = null;

$('.pub-callback').click(function() {
    delete_id = $(this).data("id");
    status = $(this).data("status");
    delete_tr = $(this).closest('tr');

    publishR(delete_id, status, delete_tr);
});

function publishR(delete_id, status, delete_tr) {
    $('.pub-callback').confirmation({
        singleton: true,
        title: "Publish confirmation",
        onConfirm: function(event, element) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>system-content/research/publishR",
                data: {
                    id: delete_id,
                    pub: status

                }
            }).done(function(json) {
                delete_tr.css("background-color", "yellow");
                delete_tr.fadeOut(1200, function() {
                    location.reload();
                });
            })
        }
    });
}

$(document).ready(function() {
    $('#examples').DataTable({
        order: [
            [2, 'desc']
        ],
    });
    $('#tablePreviewPDF').DataTable();
    $("#author").select2();
});
</script>