<style>
    .dataTables_info {
        margin-top: -50px !important;
    }
</style>
<section id="main-content" class=" ">
    <section class="wrapper main-wrapper">
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="page-title">
                <div class="pull-left">
                    <h1 class="title"> Add Article </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong>Database and Programmes </strong></a>
                        </li>

                        <li class="active">
                            Article
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!--my comment-->
        <div class="clearfix"></div>
        <div class="col-lg-12"><?php $this->load->view('back-end/common/message'); ?>
            <section class="box ">
                <header class="panel_header">
                    <h2 class="title pull-left"> Add Article </h2>
                    <div class="actions panel_actions pull-right">
                        <i class="box_toggle fa fa-chevron-down"></i>
                        <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                        <i class="box_close fa fa-times"></i>
                    </div>
                </header>
                <div class="content-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <form id="login_form" method="POST" enctype="multipart/form-data" accept-charset="utf-8" action="<?php echo $action; ?>">
                                <?php
                                $csrf = array(
                                    'name' => $this->security->get_csrf_token_name(),
                                    'hash' => $this->security->get_csrf_hash()
                                );
                                ?>
                                <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>" />
                                <input type="hidden" name="id" value="<?php echo (!empty($slider_row)) ? $slider_row->article_id : '' ?>" />
                                <fieldset>
                                    <div class="masonry-gallery">
                                        <div class="masonry-thumb" style="margin-left: 30%;">
                                            <?php
                                            if (!empty($slider_row)) {
                                                if (file_exists(FCPATH . $slider_row->image_name) && $slider_row->image_name != '') {
                                                    $img = base_url() . $slider_row->image_name;
                                                } elseif (file_exists(FCPATH . '/resources/images' . $slider_row->image_name) && $slider_row->image_name != '') {
                                                    $img = base_url() . "/upload/news.jpg";
                                                } else {

                                                    $url_ = "https://www.eria.org" . $slider_row->image_name;
                                                    $response = @file_get_contents($url_);

                                                    if ($response == false) {
                                                        $img = base_url() . "/upload/news.jpg";
                                                    } else {
                                                        if (strlen($response)) {
                                                            if (!empty($slider_row->image_name)) {
                                                                $img = "https://www.eria.org/" . $slider_row->image_name;
                                                            } else {
                                                                $img = base_url() . "/upload/news.jpg";
                                                            }
                                                        } else {
                                                            $img = base_url() . "/upload/news.jpg";
                                                        }
                                                    }
                                                }
                                            } else {
                                                $img = base_url() . "/upload/news.jpg";
                                            }
                                            ?>
                                            <img id="placeholder" class="grayscale" src="<?php echo $img; ?>" width="142" alt="Sample Image">
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('image') === '') ? '' : 'error';
                                    $image = (set_value('image') == false && !empty($slider_row)) ? $slider_row->image_name : set_value('image');
                                    ?>
                                    <label class="form-label" for="formfield1"> Image </label>
                                    <span style="font-size: 9px;font-style: italic;color: red;">(Please Using Dimensions 800 X 467 PX*)</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="hidden" id="image" name="image" value="" />
                                        <input class="input-file form-control uniform_on focused" id="photo" value="<?php echo $image; ?>" name="photo" type="file" accept="image/*" placeholder="photo">
                                        <?php echo form_error('photo', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('menu_title') === '') ? '' : 'error';
                                    $menu_title = (set_value('menu_title') == false && !empty($slider_row)) ? $slider_row->title : set_value('title');
                                    ?>
                                    <label class="form-label" for="formfield1"> Title </label>
                                    <span class="desc">e.g. "Ageing and Health in Vietname"</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="text" required="required" value="<?php echo $this->privilage->RemoveBS($menu_title); ?>" class="form-control" id="title" name="title">
                                        <?php echo form_error('title', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('menu_title') === '') ? '' : 'error';
                                    $posted_date = (set_value('menu_title') == false && !empty($slider_row)) ? $slider_row->posted_date : set_value('posted_date');
                                    ?>
                                    <label class="form-label" for="formfield1"> Posted Date </label>
                                    <!-- <span class="desc">e.g. "06-04-2021"</span> -->
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="date" value="<?php echo $posted_date ?>" class="form-control" id="posted_date" name="posted_date">
                                        <?php echo form_error('posted_date', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php $error = (form_error('menu_title') === '') ? '' : 'error'; ?>
                                    <label class="form-label" for="formfield1"> Categories </label>
                                    <span class="desc">e.g. "ASEAN/East Asia NTM Database"</span>
                                    <div class="controls">
                                        <select class="" id="s2example-2" name="catogery[]" multiple>
                                            <?php
                                            if (isset($catData->topic_id)) {
                                                $topicId = $catData->topic_id;
                                            } else {
                                                $topicId = '';
                                            }
                                            ?>
                                            <?php foreach ($catogery as $catogery) { ?>
                                                <?php if ($catogery->published == 1) { ?>
                                                <option <?php if ($catogery->category_id ==  $topicId) { ?> selected="" <?php  } ?> value="<?= $catogery->category_id ?>"><?= $catogery->category_name ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                        <?php echo form_error('menu_title', '<span class="help-inline">', '</span>'); ?>
                                        <span class="err" style="color:red; padding: 5px; display: none "> Category Field can't be empty </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php $error = (form_error('menu_title') === '') ? '' : 'error'; ?>
                                    <label class="form-label" for="formfield1"> Sub Categories </label>
                                    <span class="desc">e.g. "Programme Overview"</span>
                                    <div class="controls">
                                        <select class="" id="subCategory" name="subcategory[]" multiple>
                                            <?php
                                            if (isset($subCatData->topic_id)) {
                                                $subTopicId = $subCatData->topic_id;
                                            } else {
                                                $subTopicId = '';
                                            }
                                            ?>
                                            <?php foreach ($subcategory as $value) { ?>
                                                <?php if ($value->published == 1) { ?>
                                                <option <?php if ($value->category_id == $subTopicId) { ?> selected="" <?php  } ?> value="<?= $value->category_id ?>"><?= $value->category_name ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                        <?php echo form_error('menu_title', '<span class="help-inline">', '</span>'); ?>
                                        <span class="err" style="color:red; padding: 5px; display: none "> Category Field can't be empty </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('footer_Content') === '') ? '' : 'error';
                                    $short_des = (set_value('footer_Content') == false && !empty($slider_row)) ? $slider_row->short_des : set_value('short_des');
                                    ?>
                                    <label class="form-label" for="formfield1"> Short Description </label>
                                    <span class="desc">e.g. "The Longitudinal Study of Ageing and Health in Viet Nam (LSAHV)"</span>
                                    <div class="controls">
                                        <textarea rows="5" style="height: 250px" id="short_des1" class="form-control mytextarea" name="short_des"><?= $short_des ?></textarea>
                                        <?php echo form_error('short_des', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('footer_Content') === '') ? '' : 'error';
                                    $content = (set_value('footer_Content') == false && !empty($slider_row)) ? $slider_row->content : set_value('content');
                                    ?>
                                    <label class="form-label" for="formfield1"> Content </label>
                                    <span class="desc">e.g. "The Longitudinal Study of Ageing and Health in Viet Nam (LSAHV) is the first multi-actor longitudinal study on ageing in Viet Nam with information collected from older Vietnamese people, their current and potential caregivers, and adult children. The 2018 baseline data provides comprehensive"</span>
                                    <div class="controls">
                                        <textarea rows="5" style="height: 250px" id="summernote" class="form-control mytextarea" name="content"><?= $content ?></textarea>
                                        <?php echo form_error('content', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('tags') === '') ? '' : 'error';
                                    $tags = (set_value('tags') == false && !empty($slider_row)) ? $slider_row->tags : set_value('tags');
                                    ?>
                                    <label class="form-label" for="formfield1"> Tags </label>
                                    <span class="desc">e.g. "eria,asia"</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="text" value="<?= $tags ?>" name="tags" id="tags" data-role="tagsinput" class="form-control" />
                                        <?php echo form_error('tags', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('event_time') === '') ? '' : 'error';
                                    $event_time = (set_value('event_time') == false && !empty($slider_row)) ? $slider_row->event_time : set_value('event_time');
                                    ?>
                                    <label class="form-label" for="formfield1"> Time </label>
                                    <!-- <span class="desc">e.g. "12:12"</span> -->
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="time" value="<?= $event_time ?>" id="event_time" name="event_time" class="form-control" />
                                        <?php echo form_error('event_time', '<span class="help-inline">', '</span>'); ?>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('venue') === '') ? '' : 'error';
                                    $venue = (set_value('venue') == false && !empty($slider_row)) ? $slider_row->venue : set_value('venue');
                                    ?>
                                    <label class="form-label" for="formfield1"> Venue </label>
                                    <span class="desc">e.g. "Venue"</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="text" value="<?= $venue ?>" name="venue" id="venue" data-role="tagsinput" class="form-control" />
                                        <?php echo form_error('venue', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('published') === '') ? '' : 'error';
                                    $published = (set_value('published') == false && !empty($slider_row)) ? $slider_row->published : set_value('published');
                                    ?>
                                    <label class="form-label" for="formfield1"> Published </label>

                                    <div style="width: 30px" class="controls">
                                        <i class=""></i>
                                        <input type="checkbox" value="1" <?php if ($published == 1) { ?> checked <?php } ?> class="form-control" id="published" name="published">
                                        <?php echo form_error('published', '<span class="help-inline">', '</span>'); ?>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="formfield1"> Related Article</label>
                                    <span class="desc">e.g. "
                                        Type in article title and press enter "<br>
                                        <span style="font-size: 9px;font-style: italic;color: red;">Article must be 3*</span>
                                    </span>
                                    <div class="controls">
                                        <select class="" id="s2example-3" name="related[]" multiple>
                                            <?php foreach ($areaList->result() as $areaList) { ?>
                                                <option <?php if (in_array($areaList->article_id, $relatedData)) { ?> selected="" <?php  } ?> value="<?php echo $areaList->article_id; ?>"> <?php echo $this->privilage->RemoveBS($areaList->title); ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php echo form_error('related', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="formfield1"> Related Publication</label>
                                    <span class="desc">e.g. "
                                        Type in article title and press enter "<br>
                                        <span style="font-size: 9px;font-style: italic;color: red;">Publication must be 2*</span>
                                    </span>
                                    <div class="controls">
                                        <select id="s2example-4" name="related_publication[]" multiple>
                                            <?php foreach ($publicationList->result() as $publicationlist) { ?>
                                                <option <?php if (in_array($publicationlist->article_id, $relatedPublicationsData)) { ?> selected="" <?php  } ?> value="<?php echo $publicationlist->article_id; ?>"> <?php echo $this->privilage->RemoveBS($publicationlist->title); ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php echo form_error('related_publication', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('meta_keywords') === '') ? '' : 'error';
                                    $meta_keywords = (set_value('meta_keywords') == false && !empty($slider_row)) ? $slider_row->meta_keywords : set_value('meta_keywords');
                                    ?>
                                    <label class="form-label" for="formfield1"> Meta Keywords </label>
                                    <span class="desc">e.g. "new "</span>
                                    <div class="controls">
                                        <input type="text" value="<?= $meta_keywords ?>" class="form-control" id="meta_keywords" name="meta_keywords">
                                        <?php echo form_error('meta_keywords', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('meta_description') === '') ? '' : 'error';
                                    $meta_description = (set_value('meta_description') == false && !empty($slider_row)) ? $slider_row->meta_description : set_value('meta_description');
                                    ?>
                                    <label class="form-label" for="formfield1"> Meta Description </label>
                                    <span class="desc">e.g. "new "</span>
                                    <div class="controls">
                                        <input type="text" value="<?= $meta_description ?>" class="form-control" id="meta_description" name="meta_description">
                                        <?php echo form_error('meta_description', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-success">
                                        <i class="bImg fa fa-save "></i>
                                        Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
</section>
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <img src="" class="imagepreview" style="width: 100%;">
            </div>
        </div>
    </div>
</div>
<!-- CORE JS FRAMEWORK - END -->
<script src="<?php echo base_url() ?>resources/js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/js/jquery.easing.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/perfect-scrollbar/perfect-scrollbar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/viewport/viewportchecker.js" type="text/javascript"></script>


<script src="<?php echo base_url() ?>resources/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/js/form-validation.js" type="text/javascript"></script>

<script src="<?php echo base_url() ?>resources/js/scripts.js" type="text/javascript"></script>
<!-- END CORE TEMPLATE JS - END -->
<script src="<?php echo base_url() ?>resources/plugins/select2/select2.min.js" type="text/javascript"></script>

<script>
    $("#subCategory").select2({
        placeholder: 'Choose your Sub Category',
        allowClear: true
    }).on('select2-open', function () {
        // Adding Custom Scrollbar
        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
    });
</script>
<!-- Sidebar Graph - START -->
<script src="<?php echo base_url() ?>resources/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/js/chart-sparkline.js" type="text/javascript"></script>

<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js" type="text/javascript"></script>
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
    $(document).ready(function() {
        // $('#summernote').summernote();
        // $('#short_des1').summernote();
        // $('#article_keywords').summernote();
    });
    $('form').submit(function() {
        // Get the Login Name value and trim it
        var name = $.trim($('#s2example-2').val());

        // if (name === '') {

        //     $('.err').show();

        //     $("html, body").animate({
        //         scrollTop: 0
        //     }, "slow");
        //     return false;
        // } else {

        //     $('.err').hide();
        // }
    });
</script>