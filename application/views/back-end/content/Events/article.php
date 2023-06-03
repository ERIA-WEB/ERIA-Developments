<style>
.dataTables_info {
    margin-top: -50px !important;
}

section.box {
    margin: 5px 0;
}

.form_agenda {
    /* border: 1px solid #333333; */
    padding: 10px;
    margin-top: 10px;
    margin-bottom: 10px;
}
</style>

<section id="main-content">
    <section class="wrapper main-wrapper">
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="page-title">
                <div class="pull-left">
                    <h1 class="title"> Events </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong>Events </strong></a>
                        </li>
                        <li class="active">
                            <?php
                                if (isset($slider_row->title)) {
                                    echo substr($slider_row->title, 0, 40)."..."; 
                                }
                                else {
                                    echo 'Add';
                                }
                                
                            ?>
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
                    <h2 class="title pull-left" style="width:87%;">
                        <?php
                                if (isset($slider_row->title)) {
                                    echo $slider_row->title; 
                                }
                                else {
                                    echo 'ADD EVENTS';
                                }
                                
                            ?>
                    </h2>
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
                                                <div class="masonry-thumb">
                                                    <?php $path = (!isset($slider_row->image_name)) ? "/uploads/events/slider.jpg" : $slider_row->image_name;
                                                    if ($path == "") {
                                                        $path = "/uploads/events/slider.jpg";
                                                    } else {
                                                        $path = $path;
                                                    }
                                                    ?>
                                                    <img id="placeholder" class="grayscale"
                                                        src="<?php echo base_url(); ?><?php echo $path; ?>">
                                                </div>
                                            </div>
                                        </fieldset>
                                        <div class="form-group">
                                            <?php
                                            $error = (form_error('image') === '') ? '' : 'error';
                                            $image = (set_value('image') == false && isset($slider_row)) ? $slider_row->image_name_2 : set_value('image');
                                            ?>
                                            <label class="form-label" for="formfield1"> Image </label>
                                            <span style="font-size: 9px;font-style: italic;color: red;">
                                                (Please Using Dimensions 1200 X 510 PX*)
                                            </span>
                                            <div class="controls">
                                                <input type="hidden" id="image" name="image" value="" />
                                                <input class="input-file form-control uniform_on focused" id="photo"
                                                    value="<?php echo $image; ?>" name="photo" type="file"
                                                    accept="image/*" placeholder="photo">
                                                <?php echo form_error('photo', '<span class="help-inline">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label" for="formfield1"> Thumbnail Image </label>
                                            <span style="font-size: 9px;font-style: italic;color: red;">
                                                (Please Using Dimensions 360 X 240 PX*)
                                            </span>
                                            <div class="controls">
                                                <label for="upload_image">
                                                    <?php 
                                                        if (!empty($slider_row->image_name_2)) {
                                                            $path = $slider_row->image_name_2;
                                                        } else {
                                                            $path = "/uploads/slides/slider.jpg";
                                                        }
                                                    ?>
                                                    <img src="<?= base_url() . $path ?>" id="uploaded_image"
                                                        class="img-responsive" style="width:350px;height:200px;" />
                                                    <div class="overlay">
                                                        <div class="text">Click to Upload Image thumbnails</div>
                                                    </div>
                                                    <input type="file" name="image" class="image" id="upload_image"
                                                        style="display:none">
                                                    <div id="resultThumbImage"></div>
                                                </label>
                                            </div>

                                            <div class="modal fade" id="modal" tabindex="-1" role="dialog"
                                                aria-labelledby="modalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalLabel">Crop Image Before
                                                                Upload</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="img-container">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <img src="" id="sample_image" />
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="preview"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel</button>
                                                            <button type="button" class="btn btn-primary"
                                                                id="crop">Crop</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php
                                            $error = (form_error('title') === '') ? '' : 'error';
                                            $title = (set_value('title') == false && isset($slider_row)) ? $slider_row->title : set_value('title');
                                            ?>
                                            <label class="form-label" for="formfield1"> Title </label>
                                            <span class="desc">e.g. "Innovation Policy in/for ASEAN' Study 2nd
                                                Workshop"</span>
                                            <div class="controls">
                                                <input type="text" required="required" value="<?php echo $title ?>"
                                                    class="form-control" id="title" name="title">
                                                <?php echo form_error('title', '<span class="help-inline">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php
                                            $error = (form_error('menu_title') === '') ? '' : 'error';
                                            //   $menu_title = (set_value('menu_title') == false && isset($slider_row)) ? $slider_row->menu_title : set_value('menu_title');
                                            ?>
                                            <label class="form-label" for="formfield1"> Category </label>
                                            <span class="desc">e.g. "ASEAN"</span>
                                            <div class="controls">
                                                <select class="" id="categoryEvents" name="catogery[]" multiple>
                                                    <?php foreach ($areaList->result() as $areaList) { ?>
                                                    <?php if ($areaList->published == 1) { ?>
                                                    <option <?php if (in_array($areaList->category_id, $catData)) { ?>
                                                        selected="" <?php  } ?>
                                                        value="<?php echo $areaList->category_id; ?>">
                                                        <?php echo $areaList->category_name; ?></option>
                                                    <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php
                                            $error = (form_error('posted_date') === '') ? '' : 'error';
                                            $posted_date = (set_value('posted_date') == false && isset($slider_row)) ? $slider_row->start_date : set_value('posted_date');
                                            ?>
                                            <label class="form-label" for="formfield1"> Event Date </label>
                                            <!-- <span class="desc">e.g. "12/12/2020"</span> -->
                                            <div class="controls">
                                                <input type="date" value="<?php echo $posted_date ?>"
                                                    class="form-control" id="start_date" name="start_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php
                                            $error = (form_error('end_date') === '') ? '' : 'error';
                                            $end_date = (set_value('end_date') == false && isset($slider_row)) ? $slider_row->end_date : set_value('end_date');
                                            ?>
                                            <label class="form-label" for="formfield1"> End Date </label>
                                            <!-- <span class="desc">e.g. "12/12/2021"</span> -->
                                            <div class="controls">

                                                <input type="date" value="<?php echo $end_date ?>" class="form-control"
                                                    id="end_date" name="end_date">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('footer_Content') === '') ? '' : 'error';
                                    $content = (set_value('footer_Content') == false && isset($slider_row)) ? $slider_row->content : set_value('content');
                                    ?>
                                    <label class="form-label" for="formfield1"> Content </label>
                                    <div class="controls">
                                        <textarea rows="5" style="height: 250px" id="summernote"
                                            class="form-control mytextarea" name="content"><?= $content ?></textarea>
                                        <?php echo form_error('content', '<span class="help-inline">', '</span>'); ?>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php
                                            $error = (form_error('tags') === '') ? '' : 'error';
                                            $tags = (set_value('tags') == false && isset($slider_row)) ? $slider_row->tags : set_value('tags');
                                            ?>
                                            <label class="form-label" for="formfield1"> Tags </label>
                                            <span class="desc">e.g. "asia"</span>
                                            <div class="controls">

                                                <input type="text" value="<?= $tags ?>" name="tags" id="tags"
                                                    data-role="tagsinput" class="form-control" />
                                                <?php echo form_error('tags', '<span class="help-inline">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php
                                            $error = (form_error('article_keywords') === '') ? '' : 'error';
                                            $article_keywords = (set_value('article_keywords') == false && isset($slider_row)) ? $slider_row->article_keywords : set_value('article_keywords');
                                            ?>
                                            <label class="form-label" for="formfield1"> Keywords </label>
                                            <span class="desc">e.g. "eria"</span>
                                            <div class="controls">

                                                <input type="text" value="<?= $article_keywords ?>"
                                                    name="article_keywords" id="article_keywords" data-role="tagsinput"
                                                    class="form-control" />
                                                <?php echo form_error('article_keywords', '<span class="help-inline">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php
                                            $error = (form_error('venue') === '') ? '' : 'error';
                                            $venue = (set_value('venue') == false && isset($slider_row)) ? $slider_row->venue : set_value('venue');
                                            ?>
                                            <label class="form-label" for="formfield1"> Venue </label>
                                            <span class="desc">e.g. "Jakarta or Hybrid event"</span>
                                            <div class="controls">

                                                <input type="text" value="<?= $venue ?>" name="venue" id="venue"
                                                    class="form-control" />
                                                <?php echo form_error('order_id', '<span class="help-inline">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php
                                            $error = (form_error('organizer') === '') ? '' : 'error';
                                            $organizer = (set_value('organizer') == false && isset($slider_row)) ? $slider_row->organizer : set_value('organizer');
                                            ?>
                                            <label class="form-label" for="formfield1"> Organizer </label>
                                            <span class="desc">e.g. "eria"</span>
                                            <div class="controls">

                                                <input type="text" name="organizer" id="organizer"
                                                    value="<?= $organizer ?>" class="form-control" />
                                                <?php echo form_error('order_id', '<span class="help-inline">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php
                                            $error = (form_error('major') === '') ? '' : 'error';
                                            $major = (set_value('major') == false && isset($slider_row)) ? $slider_row->major : set_value('major');
                                            ?>
                                            <label class="form-label" for="formfield1">Contact</label>
                                            <div class="controls">
                                                <input type="text" name="major" class="form-control"
                                                    value="<?= $major ?>">
                                                <!-- <select name="major" class="form-control">
                                                    <option value="">Select</option>
                                                    <?php foreach ($expert->result() as $ex) { ?>
                                                    <?php if ($ex->published == 1) { ?>
                                                    <option <?php if ($major == $ex->article_id) { ?> selected
                                                        <?php } ?> value="<?= $ex->article_id ?>"><?= $ex->title ?>
                                                    </option>
                                                    <?php } ?>
                                                    <?php } ?>
                                                </select> -->
                                                <?php echo form_error('order_id', '<span class="help-inline">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php
                                            $error = (form_error('order_id') === '') ? '' : 'error';
                                            $order_id = (set_value('order_id') == false && isset($slider_row)) ? $slider_row->order_id : set_value('order_id');
                                            ?>
                                            <label class="form-label" for="formfield1"> Contact Email </label>
                                            <span class="desc">e.g. "info@eria.com"</span>
                                            <div class="controls">

                                                <input type="text" value=" " class="form-control" />
                                                <?php echo form_error('order_id', '<span class="help-inline">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('published') === '') ? '' : 'error';
                                    $published = (set_value('published') == false && isset($slider_row)) ? $slider_row->published : set_value('published');
                                    ?>
                                    <label class="form-label" for="formfield1"> Published </label>
                                    <div style="width: 30px" class="controls">
                                        <input type="checkbox" value="1" <?php if ($published == 1) { ?> checked
                                            <?php } ?> class="form-control" id="published" name="published">
                                        <?php echo form_error('published', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div style="display: none" class="form-group">
                                    <?php
                                    $error = (form_error('meta_keywords') === '') ? '' : 'error';
                                    //    $meta_keywords = (set_value('meta_keywords') == false && isset($slider_row)) ? $slider_row->meta_keywords : set_value('meta_keywords');
                                    ?>
                                    <label class="form-label" for="formfield1"> Related </label>
                                    <span class="desc">e.g. "
                                        Type in article title and press enter "</span>
                                    <div class="controls">
                                        <?php echo form_error('meta_keywords', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group hidden">
                                    <?php
                                    $error = (form_error('old_url') === '') ? '' : 'error';
                                    $old_url = (set_value('old_url') == false && isset($slider_row)) ? $slider_row->old_url : set_value('old_url');
                                    ?>
                                    <label class="form-label" for="formfield1"> RSVP </label>
                                    <span class="desc" style="color:red;">e.g. " RSVP "</span>
                                    <div class="controls">
                                        <input type="text" value="<?= $old_url ?>" class="form-control" id="RSVP"
                                            name="RSVP">
                                        <?php echo form_error('RSVP', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('presentations') === '') ? '' : 'error';
                                    $presentations = (set_value('presentations') == false && isset($slider_row)) ? $slider_row->presentations : set_value('presentations');
                                    ?>
                                    <label class="form-label" for="formfield1"> Speakers (Experts) </label>
                                    <span class="desc" style="color:red;">e.g. " Fukunari Kimura "</span>
                                    <div class="controls">
                                        <!-- <input type="text" name="presentations" class="form-control"
                                        value="<?= $presentations ?>"> -->
                                        <select class="" id="peopleSelect" name="presentations[]" multiple>
                                            <?php if (isset($peoples)) { ?>
                                            <?php foreach ($peoples as $value) { ?>
                                            <?php if ($value->published == 1) { ?>
                                            <option <?php if (in_array($value->article_id, $peopleData)) { ?>
                                                selected="" <?php  } ?> value="<?php echo $value->article_id; ?>">
                                                <?php echo $value->title; ?></option>
                                            <?php } ?>
                                            <?php } ?>
                                            <?php } ?>
                                        </select>
                                        <!-- <input type="text" value="<?= $presentations ?>" class="form-control" style="display:none;" id="presentations" name="presentations">
                                        <?php echo form_error('presentations', '<span class="help-inline">', '</span>'); ?> -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('video_url') === '') ? '' : 'error';
                                    $video_url = (set_value('video_url') == false && isset($slider_row)) ? $slider_row->video_url : set_value('video_url');
                                    ?>
                                    <label class="form-label" for="formfield1"> Video URL </label>
                                    <span class="desc">e.g. " http: "</span>
                                    <div class="controls">
                                        <input type="text" value="<?= $video_url ?>" class="form-control" id="video_url"
                                            name="video_url">
                                        <?php echo form_error('video_url', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('video_url') === '') ? '' : 'error';
                                    $link_event_summary = (set_value('old_url') == false && isset($slider_row)) ? $slider_row->old_url : set_value('old_url');
                                    ?>
                                    <label class="form-label" for="formfield1"> Link event summary</label>
                                    <div class="controls">
                                        <input type="text" value="<?= $link_event_summary ?>" class="form-control"
                                            id="link_event_summary" name="link_event_summary">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="formfield1"> Related News</label>
                                    <span class="desc">e.g. "
                                        Type in News title and press enter "<br>
                                        <span style="font-size: 9px;font-style: italic;color: red;">News must be
                                            3*</span>
                                    </span>
                                    <div class="controls">

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
        <div class="col-lg-6" style="padding-right:5px;">
            <section class="box">
                <header class="panel_header">
                    <h2 class="title pull-left">Agenda</h2>
                    <div class="actions panel_actions pull-right">
                        <i class="box_toggle fa fa-chevron-down"></i>
                        <i class="box_setting fa fa-cog" data-toggle="modal" href="#agenda"></i>
                        <i class="box_close fa fa-times"></i>
                    </div>
                </header>
                <div class="content-body collapsed" style="padding: 15px; display: none;">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="pull-left">
                                <button type="button" id="add_form_button" class="btn btn-primary add_form_button">
                                    <i class="fa fa-plus"></i>
                                </button>
                                <!-- <button type="button" id="remove_form_button" class="btn btn-danger remove_form_button">
                                    <i class="fa fa-minus"></i>
                                </button> -->
                            </div>
                            <div class="clearfix"></div>
                            <form method="POST" enctype="multipart/form-data" accept-charset="utf-8"
                                action="<?php echo $action_event_agenda; ?>" class="form_agenda"
                                style="position:relative;">
                                <input type="hidden" name="id"
                                    value="<?php echo (isset($slider_row)) ? $slider_row->article_id : '' ?>" />
                                <input id="countAgendaList" type="hidden"
                                    value="<?= isset($agenda_list) ? count($agenda_list):0;?>">
                                <?php if (!empty($agenda_list)) { ?>
                                <?php foreach($agenda_list as $key => $value) { ?>
                                <div id="pageAgenda-<?= $key ?>" class="pageAgenda">
                                    <button type="button" id="remove_form_button-<?= $key ?>"
                                        class="btn btn-danger remove_form_button" data-key="<?= $key ?>"
                                        style="position:absolute;right:10px;">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <div class="form-group">
                                        <label class="form-label" for="formfield1">Title</label>
                                        <div class="controls">
                                            <input type="text" class="form-control" id="title_event_agenda"
                                                name="title_event_agenda[]"
                                                value="<?php echo $value->title ? $value->title : ''; ?>"
                                                placeholder="Please input field for title">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="formfield1">Content</label>
                                        <div class="controls">
                                            <textarea name="content[]"
                                                class="form-control mytextarea w-100"><?php echo $value->content ? $value->content : ''; ?></textarea>
                                        </div>
                                    </div>
                                    <hr style="border-top: 2px solid #333;">
                                </div>
                                <script src="<?php echo base_url() ?>resources/js/jquery-1.11.2.min.js"
                                    type="text/javascript"></script>
                                <script>
                                $(document).ready(function() {
                                    $("#remove_form_button-<?= $key ?>").click(function() {
                                        $("#pageAgenda-<?= $key ?>").remove();
                                    });
                                });
                                </script>
                                <?php } ?>
                                <?php } else { ?>
                                <div id="pageAgenda-100" class="pageAgenda">
                                    <button type="button" id="remove_form_button-100"
                                        class="btn btn-danger remove_form_button" data-key="100"
                                        style="position:absolute;right:10px;">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <div class="form-group">
                                        <label class="form-label" for="formfield1">Title</label>
                                        <div class="controls">
                                            <input type="text" class="form-control" id="title_event_agenda"
                                                name="title_event_agenda[]" placeholder="Please input field for title">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="formfield1">Content</label>
                                        <div class="controls">
                                            <textarea name="content[]" class="form-control mytextarea" cols="30"
                                                rows="10"></textarea>
                                        </div>
                                    </div>
                                    <hr style="border-top: 2px solid #333;">
                                </div>
                                <?php } ?>
                                <div class="agenda_form_content"></div>
                                <div class="pull-right" style="margin-top: 30px;">
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
        <div class="col-lg-6" style="padding-left:5px;">
            <section class="box">
                <header class="panel_header">
                    <h2 class="title pull-left">Events Details</h2>
                    <div class="actions panel_actions pull-right">
                        <i class="box_toggle fa fa-chevron-down"></i>
                        <i class="box_setting fa fa-cog" data-toggle="modal" href="#events-detail"></i>
                        <i class="box_close fa fa-times"></i>
                    </div>
                </header>
                <div class="content-body collapsed" style="padding: 15px; display: none;">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <form method="POST" enctype="multipart/form-data" accept-charset="utf-8"
                                action="<?php echo $action_event_detail; ?>">
                                <input type="hidden" name="id"
                                    value="<?php echo (isset($slider_row)) ? $slider_row->article_id : '' ?>" />
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label" for="formfield1">Title</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" id="title_event_detail"
                                                    name="title_event_detail"
                                                    value="<?php echo isset($agenda_detail) ? $agenda_detail->title: ''; ?>"
                                                    placeholder="Please input field for title">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="formfield1">Type</label>
                                            <span class="desc">e.g. " hybrid / in-person / offline "</span>
                                            <div class="controls">
                                                <input type="text" class="form-control" id="time_event_detail"
                                                    name="time_event_detail"
                                                    value="<?php echo isset($agenda_detail) ? $agenda_detail->type: ''; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="formfield1">Date</label>
                                            <div class="controls">
                                                <input type="date" class="form-control" id="date_event_detail"
                                                    name="date_event_detail"
                                                    value="<?php echo isset($agenda_detail) ? $agenda_detail->date: ''; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="formfield1">Time from</label>
                                            <div class="controls">
                                                <input type="time" class="form-control" id="time_from_event_detail"
                                                    name="time_from_event_detail"
                                                    value="<?php echo isset($agenda_detail) ? $agenda_detail->time_from: ''; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="formfield1">Time to</label>
                                            <div class="controls">
                                                <input type="time" class="form-control" id="time_to_event_detail"
                                                    name="time_to_event_detail"
                                                    value="<?php echo isset($agenda_detail) ? $agenda_detail->time_to: ''; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="formfield1">Zone Time</label>
                                            <span class="desc">e.g. " (Lao time, UTC+7) "</span>
                                            <div class="controls">
                                                <input type="text" class="form-control" id="zone_time_event_detail"
                                                    name="zone_time_event_detail"
                                                    value="<?php echo isset($agenda_detail) ? $agenda_detail->zone_time: ''; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="formfield1">Embed RSVP button</label>
                                            <div class="controls">
                                                <textarea name="embed_rsvp_event_detail" class="form-control" cols="30"
                                                    rows="3"
                                                    style="height:300px;"><?php echo isset($agenda_detail) ? $agenda_detail->emmbed_rsvp: ''; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="formfield1">Embed Google Calendar</label>
                                            <div class="controls">
                                                <textarea name="embed_google_calendar_event_detail" class="form-control"
                                                    cols="30"
                                                    rows="3"><?php echo isset($agenda_detail) ? $agenda_detail->emmbed_google_calendar: ''; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="formfield1">Embed Outlook Calendar</label>
                                            <div class="controls">
                                                <textarea name="embed_outlook_calendar_event_detail"
                                                    class="form-control" cols="30"
                                                    rows="3"><?php echo isset($agenda_detail) ? $agenda_detail->emmbed_outlook_calendar: ''; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-success">
                                                <i class="bImg fa fa-save "></i>
                                                Save</button>
                                        </div>
                                    </div>
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
<!-- CORE JS Table -->
<!-- <script src="<?php echo base_url() ?>resources/plugins/datatables/js/jquery.dataTables.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url() ?>resources/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"
    type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"
    type="text/javascript"></script> -->
<!-- <script
    src="<?php echo base_url() ?>resources/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.js"
    type="text/javascript"></script> -->

<!-- <script>
$(document).ready(function() {
    $('#tblEntAttributes').DataTable({
        order: [
            [2, 'desc']
        ],
    });
});
</script> -->
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
<link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />
<script src="https://unpkg.com/dropzone"></script>
<script src="https://unpkg.com/cropperjs"></script>
<script>
$(document).ready(function() {
    var $modal = $('#modal');
    var image = document.getElementById('sample_image');
    var cropper;

    $('#upload_image').change(function(event) {
        var files = event.target.files;
        var done = function(url) {

            image.src = url;

            $modal.modal('show');
        };

        if (files && files.length > 0) {
            reader = new FileReader();
            reader.onload = function(event) {
                done(reader.result);
            };
            reader.readAsDataURL(files[0]);
            //}
        }
    });

    $modal.on('shown.bs.modal', function() {
        cropper = new Cropper(image, {
            aspectRatio: 1.5,
            viewMode: 3,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function() {
        cropper.destroy();
        cropper = null;
    });

    $("#crop").click(function() {
        canvas = cropper.getCroppedCanvas({
            width: 350,
            height: 250,
        });

        canvas.toBlob(function(blob) {
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
                var base64data = reader.result;

                $.ajax({
                    url: "<?php echo base_url(); ?>system-content/Events/cropImageThumbnails",
                    method: "POST",
                    data: {
                        image: base64data
                    },
                    success: function(data) {
                        console.log(data);
                        $modal.modal('hide');
                        $('#uploaded_image').attr('src', '<?= base_url() ?>' +
                            data);
                        $('#resultThumbImage').html(
                            '<input type="hidden" name="thumb_image" value="' +
                            data + '">');

                    }
                });
            }
        });
    });

});
</script>
<script>
$("#relatedArticle").select2({
    placeholder: 'Choose your Related News',
    allowClear: true
}).on('select2-open', function() {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
});
</script>
<script>
$("#categoryEvents").select2({
    placeholder: 'Choose your Category',
    allowClear: true
}).on('select2-open', function() {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
});

$("#peopleSelect").select2({
    placeholder: 'Choose your People Experts',
    allowClear: true
}).on('select2-open', function() {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
});
</script>
<!-- Sidebar Graph - START -->
<script src="<?php echo base_url() ?>resources/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url() ?>resources/js/chart-sparkline.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js" type="text/javascript">
</script>

<script>
// Add Form
$(document).ready(function() {
    var max_fields = 0;
    var wrapper = $(".agenda_form_content");
    var add_form = $("#add_form_button");
    var remove_form = $("#remove_form_button");

    var i = parseInt(0) + parseInt($('#countAgendaList').val());
    $(add_form).click(function(e) {
        e.preventDefault();
        var total_fields = wrapper[0].childNodes.length;


        $(wrapper).append(
            '<div id="pageAgenda-' + i +
            '" class="pageAgenda"><button type="button" id="remove_form_button-' + i +
            '" class="btn btn-danger remove_form_button" style="position:absolute;right:10px;"><i class="fa fa-minus" ></i></button><div class="form-group"><label class="form-label" for="formfield1">Title</label ><div class="controls"><input type="text" class = "form-control" id = "title_event_agenda" name = "title_event_agenda[' +
            i +
            ']" placeholder="Please input field for title"></div></div><div class="form-group"><label class="form-label" for="formfield1">Content</label><div class="controls"><textarea name="content[]" class="form-control mytextarea" cols="30" rows="10"></textarea></div></div><hr style="border-top: 2px solid #333;"></div>'
        );

        $("#remove_form_button-" + i + "").click(function() {
            // $("#pageAgenda-" + i + "").remove();
            $(this).parent("div.pageAgenda").remove();
            $(this).remove();
        });

        i++;
        var demoBaseConfig = {
            selector: ".mytextarea",
            plugins: [
                "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern imagetools"
            ],

            toolbar1: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
            toolbar2: "cut copy paste | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | preview | forecolor backcolor",
            toolbar3: "table | hr removeformat | subscript superscript | charmap fullscreen | ltr rtl | visualblocks template",

            menubar: false,
            toolbar_items_size: 'medium',
            style_formats_autohide: true,

            style_formats: [{
                title: 'nomal',
                inline: 'table',
                classes: 'nomal'
            }, {
                title: 'Governing Board Table',
                selector: 'table',
                classes: 'governing-board'
            }, {
                title: 'Academic Advisory Table',
                selector: 'table',
                classes: 'academic-advisory'
            }, {
                title: 'research-networks',
                selector: 'table',
                classes: 'research-networks'
            }, {
                title: '2 Columns',
                inline: 'div',
                classes: 'col2'
            }, {
                title: 'No Padding Bottom',
                selector: 'p',
                classes: 'm-b-0'
            }, {
                title: 'List with 15px Bottom Padding',
                selector: 'ul',
                classes: 'ul-li-p-b-15'
            }, {
                title: 'PDF Icon',
                selector: 'p',
                classes: 'pdf'
            }, {
                title: 'H2 Download',
                selector: 'h2',
                classes: 'download'
            }, {
                title: 'row',
                selector: 'div,p',
                classes: 'row'
            }, {
                title: 'font17semibold',
                inline: 'span',
                classes: 'font17semibold'
            }, {
                title: 'Anchor with underline',
                selector: 'a',
                classes: 'with-underline'
            }, {
                title: 'Blue Button',
                selector: 'a',
                classes: 'bluebtn'
            }, {
                title: 'Image on Left',
                selector: 'img',
                classes: 'imageonleft'
            }],
            image_advtab: true,
            font_formats: 'Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;SF Compact Text Light=sf_compact_textlight;SF Compact Text Light Italic=sf_compact_textlight_italic;SF Compact Text=sf_compact_textregular;SF Compact Text Italic=sf_compact_textitalic;SF Compact Text Medium=sf_compact_textmedium;SF Compact Text Medium Italic=sf_compact_textmedium_italic;SF Compact SemiBold=sf_compact_textsemibold;SF Compact Text SemiBold Italic=sf_compact_textSBdIt;SF Compact Text Bold=sf_compact_textbold;SF Compact Text Bold Italic=sf_compact_textbold_italic',
            fontsize_formats: '10px 12px 13px 14px 16px 17px 24px 28px 36px'
        };

        tinymce.init(demoBaseConfig);
    });

    // var nums = $('.remove_form_button').data("key");

    // $("#remove_form_button-" + nums + "").click(function(e) {
    //     alert(nums);
    //     // var i;
    //     // var numbers = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 100];
    //     // for (i = 0; i < substr.length; ++i) {
    //     //     // do something with `substr[i]`
    //     // }
    //     $("#pageAgenda-" + nums + "").remove();
    //     // e.preventDefault();
    //     // var total_fields = wrapper[0].childNodes.length;
    //     // if (total_fields > 1) {
    //     //     wrapper[0].childNodes[total_fields - 1].remove();
    //     // }
    // });

    $("#remove_form_button-100").click(function() {
        $("#pageAgenda-100").remove();
    });
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
            $('#placeholder').attr('src', e.target.result).attr('width', 'auto');
        };
        reader.readAsDataURL(input.files[0]);
    }
});
$('#image_').change(function() {

    alert();

    var input = this;
    var name = $(this).val();

    $('#imageblow').val(name);

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#placeholdern').attr('src', e.target.result).attr('width', 142);
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
    // $('#article_keywords').summernote();
});
</script>