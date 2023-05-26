<?php $editor_d = $editor_->result(); ?>

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
                    <h1 class="title">Add News</h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong>News </strong></a>
                        </li>
                        <li class="active">Add</li>
                    </ol>
                </div>
            </div>
        </div>
        <!--my comment-->
        <div class="clearfix"></div>
        <div class="col-lg-12"><?php $this->load->view('back-end/common/message'); ?>
            <section class="box ">
                <header class="panel_header">
                    <h2 class="title pull-left"> Add News </h2>
                    <div class="actions panel_actions pull-right">
                        <i class="box_toggle fa fa-chevron-down"></i>
                        <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                        <i class="box_close fa fa-times"></i>
                    </div>
                </header>
                <div class="content-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <form id="login_form" method="POST" enctype="multipart/form-data" accept-charset="utf-8"
                                action="<?php echo $action; ?>">
                                <?php
                                $csrf = array(
                                    'name' => $this->security->get_csrf_token_name(),
                                    'hash' => $this->security->get_csrf_hash()
                                );
                                ?>
                                <input type="hidden" name="<?php echo $csrf['name']; ?>"
                                    value="<?php echo $csrf['hash']; ?>" />
                                <input type="hidden" name="id"
                                    value="<?php echo (!empty($slider_row)) ? $slider_row->article_id : '' ?>" />
                                <div class="row">
                                    <div class="col-lg-12">
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
                                                    <img id="placeholder" class="grayscale" src="<?php echo $img ?>"
                                                        width="142" alt="Sample Image">
                                                </div>
                                            </div>
                                        </fieldset>
                                        <div class="form-group">
                                            <?php
                                            $error = (form_error('image') === '') ? '' : 'error';
                                            $image = (set_value('image') == false && !empty($slider_row)) ? $slider_row->image_name : set_value('image');
                                            ?>
                                            <label class="form-label" for="formfield1"> Image </label>
                                            <span style="font-size: 9px;font-style: italic;color: red;">(Please Using
                                                Dimensions 800 X 450 PX*)</span>
                                            <div class="controls">
                                                <i class=""></i>
                                                <input type="hidden" id="image" name="image" value="" />
                                                <input class="input-file form-control uniform_on focused" id="photo"
                                                    value="<?php echo $image; ?>" name="photo" type="file"
                                                    accept="image/*" placeholder="photo">
                                                <?php echo form_error('photo', '<span class="help-inline">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <?php
                                            $error = (form_error('title') === '') ? '' : 'error';
                                            $title = (set_value('title') == false && !empty($slider_row)) ? $slider_row->title : set_value('title');
                                            ?>
                                            <label class="form-label" for="formfield1"> Title </label>
                                            <span class="desc">e.g. "ERIA's Former Economist Appointed as Deputy
                                                Secretary-General for ASEAN Economic Community"</span>
                                            <div class="controls">
                                                <i class=""></i>
                                                <input type="text" required="required"
                                                    value='<?php echo $this->privilage->RemoveBS($title); ?>'
                                                    class="form-control" id="title" name="title">
                                                <?php echo form_error('title', '<span class="help-inline">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <?php
                                            $error = (form_error('posted_date') === '') ? '' : 'error';
                                            $posted_date = (set_value('posted_date') == false && !empty($slider_row)) ? $slider_row->posted_date : set_value('posted_date');
                                            ?>
                                            <label class="form-label" for="formfield1"> Post Date </label>
                                            <!-- <span class="desc">e.g. "12/12/2020"</span> -->
                                            <div class="controls">
                                                <i class=""></i>
                                                <input type="date" required="required"
                                                    value="<?php echo $posted_date ?>" class="form-control"
                                                    id="posted_date" name="posted_date">
                                                <?php echo form_error('posted_date', '<span class="help-inline">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php
                                            $dataCategories = $areaList->result();
                                            $error = (form_error('catogery') === '') ? '' : 'error';
                                            ?>
                                            <label class="form-label" for="formfield1">Categories</label>
                                            <!-- <span class="desc">Choose category</span> -->
                                            <div class="controls">
                                                <select id="s2example-2" name="catogery[]" multiple>
                                                    <?php foreach ($dataCategories as $areaList) { ?>
                                                    <?php if ($areaList->published == 1) { ?>
                                                    <option <?php if (in_array($areaList->category_id, $catData)) { ?>
                                                        selected="" <?php  } ?>
                                                        value="<?php echo $areaList->category_id; ?>">
                                                        <?php echo $areaList->category_name; ?></option>
                                                    <?php } ?>
                                                    <?php } ?>
                                                </select>
                                                <span class="err" style="color:red; padding: 5px; display: none ">
                                                    Category Field can't be empty </span><!-- comment -->
                                                <?php echo form_error('catogery', '<span class="help-inline">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php
                                            $error = (form_error('topics') === '') ? '' : 'error';
                                            ?>
                                            <label class="form-label" for="formfield1">Topics</label>
                                            <span class="desc"></span>
                                            <div class="controls">
                                                <select id="s2example-3" name="topics[]" multiple>
                                                    <?php foreach ($area_List->result() as $areaList) { ?>
                                                    <?php if ($areaList->published == 1) { ?>
                                                    <option <?php if (in_array($areaList->category_id, $topData)) { ?>
                                                        selected="" <?php  } ?>
                                                        value="<?php echo $areaList->category_id; ?>">
                                                        <?php echo $areaList->category_name; ?></option>
                                                    <?php } ?>
                                                    <?php } ?>
                                                </select>
                                                <span class="err1" style="color:red; padding: 5px; display: none ">
                                                    Topic Field can't be empty </span>
                                                <?php echo form_error('topics', '<span class="help-inline">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="linkWebsite">
                                    <?php 
                                        echo '<div class="form-group">';
                                        $categories = $dataCategories;
                                        foreach ($categories as $value) {
                                            if ($value->published == 1) {
                                                if (in_array($value->category_id, $catData)) {
                                                    if ($value->category_id == 46) {
                                                        if (!empty($slider_row->link_website)) {
                                                            echo '<label class="form-label" for="formLinkWebsite">Link Website</label>
                                                                <span class="desc">This link for category "In The News"</span>
                                                                <div class="controls">
                                                                    <input type="text" name="link_website" id="linkwebsite" class="form-control" value="'.$slider_row->link_website.'" placeholder="Put your link url website" />
                                                                </div>';
                                                        } else {
                                                            echo '<label class="form-label" for="formLinkWebsite">Link Website</label>
                                                                <span class="desc">This link for category "In The News"</span>
                                                                <div class="controls">
                                                                    <input type="text" name="link_website" id="linkwebsite" class="form-control" placeholder="Put your link url website" />
                                                                </div>';
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        echo '</div>';
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('mcatogery') === '') ? '' : 'error';
                                    ?>
                                    <label class="form-label" for="formfield1">Multimedia Categories</label>
                                    <span class="desc">e.g. "Webinars"</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <select id="s2example-7" name="mcatogery[]" multiple>
                                            <?php foreach ($m_areaList as $areaList) { ?>
                                            <option <?php if (in_array($areaList->ec_id, $_multimedia)) { ?> selected=""
                                                <?php  } ?> value="<?php echo $areaList->ec_id; ?>">
                                                <?php echo $areaList->category; ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="err2" style="color:red; padding: 5px; display: none "> Multimedia
                                            Field can't be empty </span>
                                        <?php echo form_error('mcatogery', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('short_des') === '') ? '' : 'error';
                                    $short_des = (set_value('short_des') == false && !empty($slider_row)) ? $slider_row->short_des : set_value('short_des');
                                    ?>
                                    <label class="form-label" for="formfield1"> Short Description </label>
                                    <div class="controls">
                                        <textarea rows="5" style="height: 150px" class="form-control mytextarea"
                                            name="short_des"><?= $this->privilage->RemoveBS($short_des); ?></textarea>
                                        <?php echo form_error('short_des', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('footer_Content') === '') ? '' : 'error';
                                    $content = (set_value('footer_Content') == false && !empty($slider_row)) ? $slider_row->content : set_value('content');
                                    ?>
                                    <label class="form-label" for="formfield1"> Content </label>
                                    <div class="controls">
                                        <i class=""></i>
                                        <textarea rows="5" style="height: 250px" class="form-control mytextarea"
                                            name="content"><?= $this->privilage->RemoveBS($content); ?></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <?php
                                            $error = (form_error('editor') === '') ? '' : 'error';
                                            $editor = (set_value('editor') == false && !empty($slider_row)) ? $slider_row->editor : set_value('editor');
                                            ?>
                                            <label class="form-label" for="formfield1"> Author / Editors </label>
                                            <div class="controls">
                                                <i class=""></i>
                                                <select id="branch" name="editor" multiple>
                                                    <option value="">Select</option>
                                                    <?php foreach ($editor_d as $areaList) { ?>
                                                    <option <?php if ($editor == $areaList->title) { ?> selected=""
                                                        <?php  } ?> value="<?= $areaList->title ?>">
                                                        <?= $this->privilage->RemoveBS($areaList->title) ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php echo form_error('editor', '<span class="help-inline">', '</span>'); ?>
                                            </div>
                                        </div>
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
                                        <input type="checkbox" value="1" <?php if ($published == 1) { ?> checked
                                            <?php } ?> class="form-control" id="published" name="published">
                                        <?php echo form_error('published', '<span class="help-inline">', '</span>'); ?>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="formfield1"> Related Article</label>
                                    <span class="desc">e.g. "
                                        Type in article title and press enter "<br>
                                        <span style="font-size: 9px;font-style: italic;color: red;">Article must be
                                            3*</span>
                                    </span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <select class="" id="relatedArticle" name="related[]" multiple>
                                            <?php foreach ($related->result() as $areaList) { ?>
                                            <option <?php if (in_array($areaList->article_id, $relatedData)) { ?>
                                                selected="" <?php  } ?> value="<?php echo $areaList->article_id; ?>">
                                                <?php echo $this->privilage->RemoveBS($areaList->title); ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php echo form_error('related', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="formfield1"> Related Publication</label>
                                    <span class="desc">e.g. "
                                        Type in article title and press enter "<br>
                                        <span style="font-size: 9px;font-style: italic;color: red;">Article must be
                                            2*</span>
                                    </span>
                                    <div class="controls">
                                        <select id="relatedPublications" name="related_publication[]" multiple>
                                            <?php foreach ($publicationList->result() as $publicationlist) { ?>
                                            <option
                                                <?php if (in_array($publicationlist->article_id, $relatedPublicationsData)) { ?>
                                                selected="" <?php  } ?>
                                                value="<?php echo $publicationlist->article_id; ?>">
                                                <?php echo $this->privilage->RemoveBS($publicationlist->title); ?>
                                            </option>
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
                                        <i class=""></i>
                                        <input type="text" value="<?= $meta_keywords ?>" class="form-control"
                                            id="meta_keywords" name="meta_keywords">
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
                                        <i class=""></i>
                                        <input type="text" value="<?= $meta_description ?>" class="form-control"
                                            id="meta_description" name="meta_description">
                                        <?php echo form_error('meta_description', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <?php if (count($article_images) != 0) { ?>
                                <div class="form-group">
                                    <label class="form-label" for="formfield1">Gallery Images</label>
                                    <span class="desc" style="color: red;font-style: italic;">Dimensions Image must be:
                                        800px x 450px</span>
                                    <!-- Style Image Multiple -->
                                    <style>
                                    .preview-images-zone {
                                        width: 100%;
                                        border: 1px solid #ddd;
                                        min-height: 180px;
                                        /* display: flex; */
                                        padding: 5px 5px 0px 5px;
                                        position: relative;
                                        overflow: auto;
                                        background: #dddddd40;
                                    }

                                    .preview-images-zone>.preview-image:first-child {
                                        height: 185px;
                                        width: 185px;
                                        position: relative;
                                        margin-right: 5px;
                                    }

                                    .preview-images-zone>.preview-image {
                                        height: 185px;
                                        width: 185px;
                                        position: relative;
                                        margin-right: 5px;
                                        float: left;
                                        margin-bottom: 5px;
                                    }

                                    .preview-images-zone>.preview-image>.image-zone {
                                        width: 100%;
                                        height: 100%;
                                    }

                                    .preview-images-zone>.preview-image>.image-zone>img {
                                        width: 100%;
                                        height: 100%;
                                        object-fit: cover;
                                    }

                                    .preview-images-zone>.preview-image>.tools-edit-image {
                                        position: absolute;
                                        z-index: 100;
                                        color: #fff;
                                        bottom: 0;
                                        width: 100%;
                                        text-align: center;
                                        margin-bottom: 10px;
                                        display: none;
                                    }

                                    .preview-images-zone>.preview-image>.image-cancel {
                                        font-size: 18px;
                                        position: absolute;
                                        top: 0;
                                        right: 0;
                                        font-weight: bold;
                                        margin-right: 10px;
                                        cursor: pointer;
                                        display: none;
                                        z-index: 100;
                                    }

                                    .preview-image:hover>.image-zone {
                                        cursor: move;
                                        opacity: .5;
                                    }

                                    .preview-image:hover>.tools-edit-image,
                                    .preview-image:hover>.image-cancel {
                                        display: block;
                                    }

                                    .ui-sortable-helper {
                                        width: 90px !important;
                                        height: 90px !important;
                                    }

                                    .container {
                                        padding-top: 50px;
                                    }
                                    </style>
                                    <fieldset class="form-group">
                                        <a href="javascript:void(0)" onclick="$('#pro-image').click()"
                                            class="btn btn-primary"
                                            style="position: absolute;height: 37px;line-height: 2;width: 200px;">Upload
                                            Image</a>
                                        <input type="file" id="pro-image" name="image_gallery[]" style="opacity: 0;"
                                            accept="image/*" class="form-control" multiple>
                                    </fieldset>
                                    <div class="preview-images-zone">
                                        <?php foreach ($article_images as $key => $value) { ?>
                                        <div class="preview-image preview-show-<?php echo $key; ?>">
                                            <div class="image-cancel" data-no="<?php echo $key; ?>"
                                                data-image_id="<?php echo $value->image_id; ?>">
                                                <i class="fa fa-close"></i>
                                            </div>
                                            <div class="image-zone">
                                                <img id="pro-img-<?php echo $key; ?>"
                                                    src="<?php echo base_url(); ?><?php echo $value->image_name; ?>">
                                            </div>
                                        </div>
                                        <input type="hidden" name="image_name_old[]"
                                            value="<?php echo $value->image_name; ?>">
                                        <input type="hidden" id="image_id_old" class="image_id_old"
                                            name="image_id_old[]" value="<?php echo $value->image_id; ?>">
                                        <?php } ?>

                                    </div>
                                </div>
                                <?php } ?>
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-success"><i
                                            class="bImg fa fa-save "></i>Save</button>
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
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
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
<script src="<?php echo base_url() ?>resources/plugins/perfect-scrollbar/perfect-scrollbar.min.js"
    type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/viewport/viewportchecker.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/jquery-validation/js/jquery.validate.min.js"
    type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/jquery-validation/js/additional-methods.min.js"
    type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/js/form-validation.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/js/scripts.js" type="text/javascript"></script>
<!-- END CORE TEMPLATE JS - END -->
<script src="<?php echo base_url() ?>resources/plugins/select2/select2.min.js" type="text/javascript"></script>
<!-- Sidebar Graph - START -->
<script src="<?php echo base_url() ?>resources/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url() ?>resources/js/chart-sparkline.js" type="text/javascript"></script>

<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js" type="text/javascript">
</script>
<?php if (count($article_images) != 0) { ?>
<script>
$(document).ready(function() {
    document.getElementById('pro-image').addEventListener('change', readImage, true);

    $(".preview-images-zone").sortable();

    $(document).on('click', '.image-cancel', function() {
        let no = $(this).data('no');
        $(".preview-image.preview-show-" + no).remove();
        var form_data = new FormData();

        var image_id = $(this).data('image_id');
        // alert(image_id);

        form_data.append("image_id", image_id);

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>system-content/news/delete_gallery_image",
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            beforeSend: function() {
                $("#preview").html(
                    '<img src="<?php echo base_url() ?>upload/loading-bar-1.gif" position: absolute;top: 23%;bottom: 0;width: 100%;right: 0;left: 0;>'
                );
            },
            success: function(form_data) {
                var results = $.parseJSON(form_data);


                if (results.length > 0) {
                    // location.reload();


                    console.log(results.length);
                }

            },
        });

    });
});

var num = 4;

function readImage() {
    if (window.File && window.FileList && window.FileReader) {
        var files = event.target.files; //FileList object
        var output = $(".preview-images-zone");

        for (let i = 0; i < files.length; i++) {
            var file = files[i];
            if (!file.type.match('image')) continue;

            var picReader = new FileReader();

            picReader.addEventListener('load', function(event) {
                var picFile = event.target;
                var html = '<div class="preview-image preview-show-' + num + '">' +
                    '<div class="image-cancel" data-no="' + num + '">x</div>' +
                    '<div class="image-zone"><img id="pro-img-' + num + '" src="' + picFile.result +
                    '"></div>' +
                    '<div class="tools-edit-image"><a href="javascript:void(0)" data-no="' + num +
                    '" class="btn btn-light btn-edit-image">edit</a></div>' +
                    '</div>';

                output.append(html);
                num = num + 1;
            });

            picReader.readAsDataURL(file);
        }

    } else {
        console.log('Browser not support');
    }
}
</script>
<?php } ?>
<script>
$("#relatedArticle").select2({
    placeholder: 'Choose your Related Article',
    allowClear: true
}).on('select2-open', function() {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
});
</script>
<script>
$("#relatedPublications").select2({
    placeholder: 'Choose your Publication',
    allowClear: true
}).on('select2-open', function() {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
});
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
<script>
$('#s2example-2').change(function() {
    var count_categories = $(this).val().length;
    var value = $(this).val();
    if (count_categories == '1') {

        if (value == '46') {
            $('#linkWebsite').addClass('form-group');
            $('#linkWebsite').html(
                '<label class="form-label" for="formLinkWebsite">Link Website</label><span class="desc">This link for category "In The News"</span><div class="controls"><input type="text" name="link_website" id="linkwebsite" class="form-control" placeholder="Put your link url website" /></div>'
            );
        }
    } else {

        var i;
        for (i = 0; i < value.length; ++i) {
            if (value[i] == '46') {
                $('#linkWebsite').addClass('form-group');
                $('#linkWebsite').html(
                    '<label class="form-label" for="formLinkWebsite">Link Website</label><span class="desc">This link for category "In The News"</span><div class="controls"><input type="text" name="link_website" id="linkwebsite" class="form-control" placeholder="Put your link url website" /></div>'
                );
            }
        }
    }
});
</script>
<script>
$('form').submit(function() {

    // Get the Login Name value and trim it
    var name = $.trim($('#s2example-2').val());
    var top = $.trim($('#s2example-3').val());
    var multimedia = $.trim($('#s2example-7').val());

    // if (name === '') {
    //     $('.err').show();
    //     $("html, body").animate({
    //         scrollTop: 0
    //     }, "slow");
    //     $('.bImg').removeClass('fa-spinner fa-spin');
    //     return false;
    // }
    // else if (top === '') {
    //     $('.err1').show();

    //     $("html, body").animate({
    //         scrollTop: 0
    //     }, "slow");
    //     $('.bImg').removeClass('fa-spinner fa-spin');
    //     return false;
    // }
    // else if (multimedia === '') {
    //     $('.err2').show();
    //     $("html, body").animate({
    //         scrollTop: 0
    //     }, "slow");
    //     $('.bImg').removeClass('fa-spinner fa-spin');
    //     return false;
    // } 
    // else {
    //     $('.err').hide();
    //     $('.err1').hide();
    //     $('.bImg').removeClass('fa-spinner fa-spin');
    //     return true;
    // }
});
</script>