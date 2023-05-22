<section id="main-content">
    <section class="wrapper main-wrapper">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="page-title">
                <div class="pull-left">
                    <h1 class="title"> Add Card </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href="#"><i class="fa fa-globe"></i><strong>Card </strong></a>
                        </li>
                        <li class="active">
                            Add
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!--my comment-->
        <div class="clearfix"></div>
        <form id="login_form" method="POST" enctype="multipart/form-data" accept-charset="utf-8"
            action="<?php echo base_url(); ?>/system-content/card/insert_card_random">
            <div class="col-lg-12">
                <!-- start: Alert Message -->
                <style>
                .help-inline {
                    color: rgba(240, 80, 80, 1.0);
                    font-weight: 400;
                    font-size: 13px;
                }
                </style>
                <!-- end: Alert Message -->
                <section class="box">
                    <header class="panel_header">
                        <h2 class="title pull-left">Input Field Card</h2>
                        <div class="actions panel_actions pull-right">
                            <i class="box_toggle fa fa-chevron-down"></i>
                            <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                            <i class="box_close fa fa-times"></i>
                        </div>
                    </header>
                    <div class="content-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input type="hidden" name="ci_csrf_token" value="">
                                <input type="hidden" name="id" value="">
                                <div class="form-group">
                                    <label class="form-label" for="formfield1"> Title Card </label>
                                    <span class="desc">e.g. "Card template 1"</span>
                                    <div class="controls">
                                        <input type="text" required="required" value="" class="form-control" id="title"
                                            name="title" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="formfield1"> Upload Image</label>
                                    <span style="font-size: 9px;font-style: italic;color: red;">(Please Using Dimensions 1000 X 563 PX*)</span> 
                                    <div class="controls">
                                        <input type="file" name="file_card" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="formfield1">Link Image</label>
                                    <span class="desc">e.g. "Link Image"</span>
                                    <div class="controls">
                                        <input type="text" name="link_image" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="formfield1"> Published </label>
                                    <div style="width: 30px" class="controls">
                                        <input type="checkbox" value="1" class="form-control" id="published"
                                            name="published">
                                    </div>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-success">
                                        <i class="bImg fa fa-save "></i>
                                        Save</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
            <div class="col-lg-12">
                <!-- start: Alert Message -->
                <style>
                .help-inline {
                    color: rgba(240, 80, 80, 1.0);
                    font-weight: 400;
                    font-size: 13px;
                }
                </style>
                <!-- end: Alert Message -->
                <section id="templateCardCode" class="box hidden">
                    <header class="panel_header">
                        <h2 class="title pull-left"> Template Code Card </h2>
                        <div class="actions panel_actions pull-right">
                            <i class="box_toggle fa fa-chevron-down"></i>
                            <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                            <i class="box_close fa fa-times"></i>
                        </div>
                    </header>
                    <div class="content-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <textarea rows="5" id="summernoteTextArea" class="form-control mytextarea"
                                        name="template_content"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </form>
    </section>
</section>

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
<script src="<?php echo base_url() ?>resources/js/bootstrap-confirmation.min.js"></script>
<script src="<?php echo base_url() ?>resources/js/custome.js" type="text/javascript"></script>
<script>
$('#chooseSelectTemplate').on('change', function() {
    var value = $(this).val();
    if (value == 'template_file') {
        $('#templateCardFile').removeClass('hidden');
        $('#templateCardCode').addClass('hidden');

        $('#file_card').attr("required", "true");
        // $('#summernoteTextArea').prop('required', false);
    } else {
        $('#templateCardCode').removeClass('hidden');
        $('#templateCardFile').addClass('hidden');

        $('#file_card').prop('required', false);
        // $('#summernoteTextArea').attr("required", "true");

        // $('.summernote').on('summernote.init', function() {
        //     $('.summernote').summernote('codeview.activate');
        // }).summernote({
        //     height: 1024,
        //     placeholder: 'Paste content here...',
        //     codemirror: {
        //         theme: 'monokai'
        //     }
        // });
    }
});
</script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
// $('.summernote').summernote({
//     height: 1024,
//     placeholder: 'Paste content here...',
//     codemirror: {
//         theme: 'monokai'
//     }
// });
</script>