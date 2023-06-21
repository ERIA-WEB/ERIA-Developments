<?php $editor_d = $editor_->result(); ?>
<style>
.dataTables_info {
    margin-top: -50px !important;
}
</style>
<section id="main-content" class=" ">
    <section class="wrapper main-wrapper">
        <?php // var_dump($areaList); 
        ?>
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="page-title">

                <div class="pull-left">
                    <h1 class="title"> Add Multimedia News </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong>Multimedia </strong></a>
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
        <div class="col-lg-12"><?php $this->load->view('back-end/common/message'); ?>
            <section class="box ">
                <header class="panel_header">
                    <h2 class="title pull-left"> Add Multimedia News </h2>
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
                                    value="<?php echo (isset($slider_row)) ? $slider_row->article_id : '' ?>" />
                                <div class="row">
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <div class="masonry-gallery">
                                                <div class="masonry-thumb" style="margin-left: 30%;">
                                                    <?php $path = (!isset($slider_row->image_name)) ? "/uploads/slides/slider.jpg" : $slider_row->image_name; ?>
                                                    <img id="placeholder" class="grayscale"
                                                        src="<?php echo base_url(); ?><?php echo $path; ?>" width="142"
                                                        alt="Sample Image">
                                                </div>
                                            </div>
                                        </fieldset>
                                        <div class="form-group">
                                            <?php
                                            $error = (form_error('image') === '') ? '' : 'error';
                                            $image = (set_value('image') == false && isset($slider_row)) ? $slider_row->image_name : set_value('image');
                                            ?>
                                            <label class="form-label" for="formfield1"> Image </label>
                                            <span style="font-size: 9px;font-style: italic;color: red;">(Please Using
                                                Dimensions 1200 X 510 PX*)</span>
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
                                            $title = (set_value('title') == false && isset($slider_row)) ? $slider_row->title : set_value('title');
                                            ?>
                                            <label class="form-label" for="formfield1"> Title </label>
                                            <span class="desc">e.g. "ERIA Holds Webinar on Agility and Resilience of
                                                Micro-Businesses Amidst and After the Pandemic."</span>
                                            <div class="controls">
                                                <i class=""></i>
                                                <input type="text" required="required"
                                                    value='<?php echo  $this->privilage->RemoveBS($title); ?>'
                                                    class="form-control" id="title" name="title">
                                                <?php echo form_error('title', '<span class="help-inline">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php
                                            $error = (form_error('catogery') === '') ? '' : 'error';
                                            $sub_experts = (set_value('catogery') == false && isset($slider_row)) ? $slider_row->sub_experts : set_value('catogery');
                                            ?>
                                            <label class="form-label" for="formfield1"> Multimedia Categories </label>
                                            <span class="desc">e.g. "Webinars"</span>
                                            <div class="controls">
                                                <i class=""></i>
                                                <select class="form-control" id="MultimediaCategories" name="catogery">
                                                    <option>Choose Multimedia Categories</option>
                                                    <?php foreach ($areaList as $areaList) { ?>
                                                    <option <?php if ($sub_experts == $areaList->ec_id) { ?> selected=""
                                                        <?php  } ?> value="<?php echo $areaList->ec_id; ?>">
                                                        <?php echo $areaList->category; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php echo form_error('menu_title', '<span class="help-inline">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php
                                            $error = (form_error('scat') === '') ? '' : 'error';
                                            $subcategorymultimedia = (set_value('scat') == false && isset($slider_row)) ? $slider_row->sub_dep_experts : set_value('scat');
                                            ?>
                                            <label class="form-label" for="formfield1"> Multimedia Sub Categories
                                            </label>
                                            <span class="desc">e.g. "Webinars"</span>
                                            <div class="controls">
                                                <select class="form-control" name="scat">
                                                    <!-- id="scat"-->
                                                    <option>Choose Multimedia Sub Categories</option>
                                                    <?php foreach ($sub_category_multimedia as $subcategory) { ?>
                                                    <option
                                                        <?php if ($subcategorymultimedia == $subcategory->es_id) { ?>
                                                        selected="" <?php  } ?>
                                                        value="<?php echo $subcategory->es_id; ?>">
                                                        <?php echo $subcategory->s_catogery; ?></option>
                                                    <?php } ?>
                                                </select>

                                                <?php echo form_error('scat', '<span class="help-inline">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <?php
                                            $error = (form_error('video_url') === '') ? '' : 'error';
                                            $video_url = (set_value('video_url') == false && isset($slider_row)) ? $slider_row->video_url : set_value('video_url');
                                            ?>
                                            <label id="LabelNameCategory" class="form-label" for="formfield1"> Video /
                                                Podcast / Webinar </label>
                                            <span style="font-size: 9px;font-style: italic;color: red;">( Please input
                                                IFRAME* )</span>
                                            <div class="controls">
                                                <i class=""></i>
                                                <textarea class="form-control mytextarea" id="video_url"
                                                    name="video_url"
                                                    style="height: 150px;"><?php echo $video_url; ?></textarea>
                                                <?php echo form_error('video_url', '<span class="help-inline">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <?php
                                            $error = (form_error('posted_date') === '') ? '' : 'error';
                                            $posted_date = (set_value('posted_date') == false && isset($slider_row)) ? $slider_row->posted_date : set_value('posted_date');
                                            ?>
                                            <label class="form-label" for="formfield1"> Post Date </label>
                                            <!-- <span class="desc">e.g. "12/12/2020"</span> -->
                                            <div class="controls">
                                                <input type="date" value="<?php echo $posted_date ?>"
                                                    class="form-control" id="posted_date" name="posted_date">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label" for="formfield1"> Topics </label>
                                            <span class="desc">e.g. "Title"</span>
                                            <div class="controls">
                                                <select class="" id="selectTopicinMultimedia" name="topics[]" multiple>
                                                    <?php foreach ($area_List->result() as $areaList) { ?>
                                                    <option <?php if (in_array($areaList->category_id, $topData)) { ?>
                                                        selected="" <?php  } ?>
                                                        value="<?php echo $areaList->category_id; ?>">
                                                        <?php echo $areaList->category_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php echo form_error('menu_title', '<span class="help-inline">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="formfield1"> Publication Types </label>
                                            <span class="desc">e.g. "Title"</span>
                                            <div class="controls">
                                                <i class=""></i>
                                                <select class="" id="s2example-7" name="mcatogery[]" multiple>
                                                    <?php foreach ($pubtypes->result() as $areaList) { ?>
                                                        <option <?php if (in_array($areaList->category_id, $_experts)) { ?> selected="" <?php  } ?> value="<?php echo $areaList->category_id; ?>"> <?php echo $areaList->category_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php echo form_error('mcatogery', '<span class="help-inline">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('footer_Content') === '') ? '' : 'error';
                                    $content = (set_value('footer_Content') == false && isset($slider_row)) ? $slider_row->content : set_value('content');
                                    ?>
                                    <label class="form-label" for="formfield1"> Content </label>
                                    <div class="controls">
                                        <i class=""></i>
                                        <textarea rows="5" style="height: 250px" id="summernote"
                                            class="form-control mytextarea" name="content"><?= $content ?></textarea>
                                        <?php echo form_error('content', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <?php
                                            $error = (form_error('editor') === '') ? '' : 'error';
                                            $editor = (set_value('editor') == false && isset($slider_row)) ? $slider_row->editor : set_value('editor');
                                            // var_dump($editor);
                                            ?>
                                            <label class="form-label" for="formfield1"> Editors </label>
                                            <span class="desc">e.g. "staff"</span>
                                            <div class="controls">
                                                <i class=""></i>
                                                <select id="branch" name="editor" class="">
                                                    <?php foreach ($editor_d as $areaList) { ?>
                                                    <option <?php if ($editor == $areaList->title) { ?> selected=""
                                                        <?php  } ?> value="<?= $areaList->title ?>">
                                                        <?= $areaList->title ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php echo form_error('editor', '<span class="help-inline">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php   ?>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('published') === '') ? '' : 'error';
                                    $published = (set_value('published') == false && isset($slider_row)) ? $slider_row->published : set_value('published');
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
                                    <span class="desc" style="font-style:italic;">
                                        *Type in article title and press enter</span>
                                    <div class="controls">
                                        <select id="relatedArticleInMultimedia" name="related[]" multiple>
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
                                    <span class="desc" style="font-style:italic;">*Type in article title and press
                                        enter</span>
                                    <div class="controls">
                                        <select id="relatedPublicationinMultimedia" name="related_publication[]"
                                            multiple>
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
                                    $meta_keywords = (set_value('meta_keywords') == false && isset($slider_row)) ? $slider_row->meta_keywords : set_value('meta_keywords');
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
                                    $meta_description = (set_value('meta_description') == false && isset($slider_row)) ? $slider_row->meta_description : set_value('meta_description');
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
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <img src="" class="imagepreview" style="width: 100%;">
            </div>
        </div>
    </div>
</div>
<!-- CORE JS FRAMEWORK - END -->
<script src="<?php echo base_url() ?>resources/js/jquery-1.11.2.min.js" type="text/javascript"></script>
<!-- <script src="<?php echo base_url() ?>resources/js/jquery.easing.min.js" type="text/javascript"></script> -->
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
<script src="https://code.jquery.com/jquery-latest.min.js"></script>

<script src="<?php echo base_url() ?>resources/plugins/select2/select2.min.js" type="text/javascript"></script>


<!-- Sidebar Graph - START -->
<script src="<?php echo base_url() ?>resources/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url() ?>resources/js/chart-sparkline.js" type="text/javascript"></script>

<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js" type="text/javascript">
</script>

<input type="hidden" class="base_url_front" value="<?= base_url(); ?>">
<script src="<?= base_url(); ?>v6/js/admin/news/m_article.js" type="text/javascript"></script>