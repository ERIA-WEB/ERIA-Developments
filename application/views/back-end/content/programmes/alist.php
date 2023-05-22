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
                    <h1 class="title"> List of Articles </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong> Programmes </strong></a>
                        </li>

                        <li class="active">
                            Articles List
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!--my comment-->

        <div class="clearfix"></div>
        <div class="col-lg-12">
            <?php $this->load->view('back-end/common/message'); ?>
            <section class="box ">
                <header class="panel_header">
                    <h2 class="title pull-left"> Articles List</h2>
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
                                        <th>No</th>
                                        <th> Title </th>
                                        <th> Image </th>
                                        <th> Post Date </th>
                                        <th class="text-center" width="10%">Duplicate Page</th>
                                        <th width="5%">Published </th>
                                        <th class="hidden-print text-center" width="7%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $results = $this->privilage->cacheManager($areaList->result(), 'programmes_a_list');
                                    $x = 0;
                                    foreach ($results as $id => $area) : $x++; ?>
                                    <tr>
                                        <td> <?php echo $x; ?> </td>
                                        <td> <?php echo $this->privilage->RemoveBS($area->title); ?></td>
                                        <td>
                                            <?php
                                                if (file_exists(FCPATH . $area->image_name) && $area->image_name != '') {
                                                    $img = base_url() . $area->image_name;
                                                } elseif (file_exists(FCPATH . '/resources/images' . $area->image_name) && $area->image_name != '') {
                                                    $img = base_url() . "/upload/news.jpg";
                                                } else {

                                                    $url_ = "https://www.eria.org" . $area->image_name;
                                                    $response = @file_get_contents($url_);

                                                    if ($response == false) {
                                                        $img = base_url() . "/upload/news.jpg";
                                                    } else {
                                                        if (strlen($response)) {
                                                            if (!empty($area->image_name)) {
                                                                $img = "https://www.eria.org/" . $area->image_name;
                                                            } else {
                                                                $img = base_url() . "/upload/news.jpg";
                                                            }
                                                        } else {
                                                            $img = base_url() . "/upload/news.jpg";
                                                        }
                                                    }
                                                }
                                                ?>
                                            <a href="#" class="pop">
                                                <img src="<?php echo $img; ?>" width="50">
                                            </a>
                                        </td>
                                        <td> <?php echo date('j F Y', strtotime($area->posted_date)); ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-target="#modal<?= $id ?>">
                                                Pages
                                            </button>
                                        </td>
                                        <td>
                                            <a data-toggle="modal" data-aid="<?= $area->article_id ?>"
                                                class="btn btn-info _pdf hidden" href="#myModal1">
                                                <i class="  fa fa-file-pdf-o "></i>
                                            </a>
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
                                        <td class="hidden-print">
                                            <?php
                                                $edit_action = $this->privilage->edit('edit', $session_user['user_id'], 'Programmes/editArt/', $area->article_id);
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
                                        $site_url = base_url().'system-content/Programmes/duplication_pages';
                                        $modal_duplication_page = $this->privilage->duplicationPage('articles', $area->article_id, $area->title, $id, $site_url, $area->uri);

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
<div style="z-index: 8888" class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"> Manage PDF </h4>
            </div>
            <div class="modal-body">
                <form method='post' action='' enctype="multipart/form-data">
                    <table class="table">
                        <tr>
                            <td>Title</td>
                            <td>:</td>
                            <td><input type="text" id="pdf_title" name="pdf_title" class="form-control">

                                <input type="hidden" id="aid" name="aid">
                                <input type="hidden" id="ptype" value="article" name="ptype">
                            </td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>:</td>
                            <td><input type="text" id="pdf_dis" name="pdf_dis" class="form-control"></td>
                        </tr>

                        <tr>
                            <td>PDF </td>
                            <td>:</td>
                            <td> <input type='file' name='file' id='file' class='form-control'> </td>
                        </tr>
                        <tr>
                            <td>Author/Editor </td>
                            <td>:</td>
                            <td>
                                <select id="author" name="author[]" class="" multiple>

                                    <?php foreach ($editor_->result() as $areaList) { ?>
                                    <option value="<?= $areaList->article_id ?>"><?= $areaList->title ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" id="error"> </td>
                            <td style="text-align:right"> <input type='button' class='btn btn-info' value='Upload'
                                    id='btn_upload'></td>
                        </tr>
                    </table>
                </form>
                <!-- Preview-->
                <div id='preview'></div>
            </div>
            <div class="modal-body3">
            </div>
            <div style="text-align:center" class="modal-footer pdf_dis">

            </div>
        </div>
    </div>
</div>
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

$('._pdf').click(function() {
    var aid = $(this).data('aid');
    $('#aid').val(aid);
    loadPDF(aid);

    $("#author").select2();
})
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
</script>
<script>
$(document).ready(function() {
    $('#btn_upload').click(function() {
        var fd = new FormData();
        var files = $('#file')[0].files[0];
        var pdf_title = $('#pdf_title').val();
        var pdf_dis = $('#pdf_dis').val();
        var aid = $('#aid').val();
        var ptype = $('#ptype').val();
        var author = $('#author').val();
        fd.append('file', files);
        fd.append('pdf_title', pdf_title);
        fd.append('pdf_dis', pdf_dis);
        fd.append('aid', aid);
        fd.append('ptype', ptype);
        fd.append('author', author);

        if (pdf_title != '' && pdf_dis != '') {

            $(this).closest('form').find("input[type=text],input[type=file], textarea").val("");

            // AJAX request
            $.ajax({
                url: '<?php echo base_url(); ?>system-content/Programmes/pdf',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response != 0) {
                        loadPDF(aid);
                    } else {
                        $('#error').html(
                            '<span style="color:red" >Please Check the pdf</span>');

                    }
                }
            });
        } else {

            $('#error').html('<span style="color:red" >Please Enter the pdf Details</span>');

        }
    });
});



function loadPDF(id) {
    var tablede = '<img src="<?php echo base_url() ?>upload/loading-bar-1.gif" width="200"  >';

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
                "<table id='example' style='font-size:12px;' class='    display table data' cellspacing='0' width='100%'><thead><tr><th>#</th><th>Title</th><th>Discription</th><th>PDF</th><th>Action</th></tr></thead><tbody>";

            var a = 0;
            for (var b = 0; b < retuenValue.length; b++) {
                a++;

                var nd = '';


                for (var j = 0; j < retuenValue[b]['author'].length; j++) {

                    nd += "<span><a href='#' class='pd' style='color:red' data-id='" + retuenValue[b]['author'][
                        j
                    ]['paid'] + "'  >X</a> &nbsp " + retuenValue[b]['author'][j]['title'] + "</span><br>";
                }



                tablede += "<tr><td>" + a + "</td><td style='text-align:left'>" + retuenValue[b]['pdf_title'] +
                    "<br>" + nd + "</td><td style='text-align:left' >" + retuenValue[b]['pdf_discription'] +
                    "</td><td style='text-align:left' ><a target='_blank' href='<?php echo base_url() ?>" +
                    retuenValue[b]['pdf'] + "' >pdf</a></td><td><a data-pid='" + retuenValue[b]['pdf_id'] +
                    "' class='pdf_del btn btn-danger'><i class='fa fa-times'  ></i></a></td></tr>";

            }
            tablede += "</tbody></table>";

        } else {
            var tablede = '';
        }

        $('.pdf_dis').html(tablede);



    })

}




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


$(document).on("click", ".pd", function() {

    var pid = $(this).data('id');
    var aid = $('#aid').val();

    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>system-content/Programmes/deletepdfAuthor",
        data: {
            pid: pid

        }
    }).done(function(json) {






    })


    loadPDF(aid);




})



$(document).ready(function() {



    $('#examples').DataTable({
        order: [
            [2, 'desc']
        ],
    });
});
</script>