<?php
$editor_d = $editor_->result();
$aut_d = $author_->result();
?>
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
                    <h1 class="title"> Publication </h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href=" "><i class="fa fa-globe"></i><strong> Research </strong></a>
                        </li>
                        <li class="active">
                            Publication
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
                    <h2 class="title pull-left"> Add Publication </h2>
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
                                <fieldset>
                                    <div class="masonry-gallery">
                                        <div class="masonry-thumb text-center">
                                            <?php
                                            if (!empty($slider_row)) {
                                                if (file_exists(FCPATH . $slider_row->image_name) && $slider_row->image_name != '') {
                                                    $img = base_url() . $slider_row->image_name;
                                                } elseif (file_exists(FCPATH . '/resources/images' . $slider_row->image_name) && $slider_row->image_name != '') {
                                                    $img = base_url() . "/upload/Publication.jpg";
                                                } else {

                                                    $url_ = "https://www.eria.org" . $slider_row->image_name;
                                                    $response = @file_get_contents($url_);

                                                    if ($response == false) {
                                                        $img = base_url() . "/upload/Publication.jpg";
                                                    } else {
                                                        if (strlen($response)) {
                                                            if (!empty($slider_row->image_name)) {
                                                                $img = "https://www.eria.org/" . $slider_row->image_name;
                                                            } else {
                                                                $img = base_url() . "/upload/Publication.jpg";
                                                            }
                                                        } else {
                                                            $img = base_url() . "/upload/Publication.jpg";
                                                        }
                                                    }
                                                }
                                            } else {
                                                $img = base_url() . "/upload/Publication.jpg";
                                            }
                                            ?>
                                            <img id="placeholder" class="grayscale" src="<?php echo $img; ?>"
                                                style="width:100%;max-width:150px;" alt="Sample Image">
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('image') === '') ? '' : 'error';
                                    $image = (set_value('image') == false && !empty($slider_row)) ? $slider_row->image_name : set_value('image');
                                    ?>
                                    <label class="form-label" for="formfield1"> Image </label>
                                    <span style="font-size: 9px;font-style: italic;color: red;">(Please Using Dimensions
                                        800px x 450px*)</span>
                                    <div class="controls">
                                        <input type="hidden" id="image_old" name="image_old"
                                            value="<?php echo $image; ?>" />
                                        <input class="input-file form-control uniform_on focused" id="photo"
                                            name="photo" type="file" accept="image/*" placeholder="photo">
                                        <?php echo form_error('photo', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <fieldset>
                                    <div class="masonry-gallery">
                                        <div class="masonry-thumb text-center">
                                            <?php
                                            if (!empty($slider_row)) {
                                                if (file_exists(FCPATH . $slider_row->thumbnail_image) && $slider_row->thumbnail_image != '') {
                                                    $img = base_url() . $slider_row->thumbnail_image;
                                                } elseif (file_exists(FCPATH . '/resources/images' . $slider_row->image_name) && $slider_row->thumbnail_image != '') {
                                                    $img = base_url() . "/upload/Publication.jpg";
                                                } else {

                                                    $url_ = "https://www.eria.org" . $slider_row->image_name;
                                                    $response = @file_get_contents($url_);

                                                    if ($response == false) {
                                                        $img = base_url() . "/upload/Publication.jpg";
                                                    } else {
                                                        if (strlen($response)) {
                                                            if (!empty($slider_row->thumbnail_image)) {
                                                                $img = "https://www.eria.org/" . $slider_row->thumbnail_image;
                                                            } else {
                                                                $img = base_url() . "/upload/Publication.jpg";
                                                            }
                                                        } else {
                                                            $img = base_url() . "/upload/Publication.jpg";
                                                        }
                                                    }
                                                }
                                            } else {
                                                $img = base_url() . "/upload/Publication.jpg";
                                            }
                                            ?>
                                            <img id="placeholder" class="grayscale" src="<?= $img; ?>"
                                                alt="Sample Image" style="width:100%;max-width:150px;">
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('thumbnail_image') === '') ? '' : 'error';
                                    $thumbnail_image = (set_value('thumbnail_image') == false && !empty($slider_row)) ? $slider_row->thumbnail_image : set_value('thumbnail_image');
                                    ?>
                                    <label class="form-label" for="formfield1"> Thumbnail </label>

                                    <span style="font-size: 9px;font-style: italic;color: red;">(Please Using Dimensions
                                        490 X 280 PX*)</span>
                                    <div class="controls">
                                        <input type="hidden" id="thumbnail_image_old" name="thumbnail_image_old"
                                            value="<?= $thumbnail_image; ?>" />
                                        <input class="input-file form-control uniform_on focused" id="thumbnail_image"
                                            name="thumbnail_image" type="file" accept="image/*" placeholder="photo">
                                        <?php echo form_error('thumbnail_image', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('menu_title') === '') ? '' : 'error';
                                    $pub_type = (set_value('pub_type') == false && !empty($slider_row)) ? $slider_row->pub_type : set_value('pub_type');
                                    ?>
                                    <label class="form-label" for="formfield1">Type</label>
                                    <span class="desc"></span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input style="width: 25px;float: left;margin-right: 15px;margin-top: -6px;"
                                            type="checkbox" <?php if ($pub_type == 1 || $pub_type == 3) { ?> checked
                                            <?php } ?> value="1" class="form-control" id="category_name"
                                            name="pub_type[]">Publication
                                        <?php echo form_error('category_name', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input
                                            style="width: 25px;float: left;margin-right: 15px;margin-top: -6px;margin-left: 0px;"
                                            type="checkbox" <?php if ($pub_type == 2 || $pub_type == 3) { ?> checked
                                            <?php } ?> value="2" class="form-control" id="" name="pub_type[]">Research
                                        <?php echo form_error('pub_type', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('menu_title') === '') ? '' : 'error';
                                    $titles = (set_value('title') == false && !empty($slider_row)) ? $slider_row->title : set_value('title');
                                    ?>
                                    <label class="form-label" for="formfield1"> Title </label>
                                    <span class="desc">e.g. "Comprehensive Mapping of FTAs in ASEAN and East
                                        Asia"</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="text" required="required"
                                            value="<?php echo str_replace('"', '', $titles);     ?>"
                                            class="form-control" id="title" name="title">
                                        <?php echo form_error('title', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('menu_title') === '') ? '' : 'error';
                                    $posted_date = (set_value('posted_date') == false && !empty($slider_row)) ? $slider_row->posted_date : set_value('posted_date');
                                    ?>
                                    <label class="form-label" for="formfield1"> Posted Date</label>
                                    <span class="desc"></span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="date" required="required" value="<?php echo $posted_date ?>"
                                            class="form-control" id="posted_date" name="posted_date">
                                        <?php echo form_error('posted_date', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="formfield1"> Topics </label>
                                    <span class="desc" style="font-style:italic;">*Type in topics and press enter</span>
                                    <div class="controls">
                                        <select class="" id="topicPublications" name="topics[]" multiple>
                                            <?php foreach ($topics->result() as $areaList) { ?>
                                            <?php if ($areaList->published == 1) { ?>
                                            <option <?php if (in_array($areaList->category_id, $topData)) { ?>
                                                selected="" <?php  } ?> value="<?php echo $areaList->category_id; ?>">
                                                <?php echo $areaList->category_name; ?></option>
                                            <?php } ?>
                                            <?php } ?>
                                        </select>
                                        <?php echo form_error('menu_title', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="formfield1"> Publication Types </label>
                                    <span class="desc" style="font-style:italic;">*Type in publication types and press
                                        enter</span>
                                    <div class="controls">
                                        <select class="" id="PublicationTypes" name="catogery[]" multiple>
                                            <?php foreach ($pubtypes->result() as $areaList) { ?>
                                            <?php if ($areaList->published == 1) { ?>
                                            <option <?php if (in_array($areaList->category_id, $catData)) { ?>
                                                selected="" <?php  } ?> value="<?php echo $areaList->category_id; ?>">
                                                <?php echo $areaList->category_name; ?></option>
                                            <?php } ?>
                                            <?php } ?>
                                        </select>
                                        <?php echo form_error('menu_title', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group hidden">
                                    <!-- temporary hide -->
                                    <?php
                                    $error = (form_error('catogery') === '') ? '' : 'error';
                                    // $sub_experts = (set_value('catogery') == false && !empty($slider_row)) ? $slider_row->sub_experts : set_value('catogery');
                                    ?>
                                    <label class="form-label" for="formfield1"> Multimedia Categories </label>
                                    <span class="desc">e.g. "Webinars"</span>
                                    <div class="controls">
                                        <select class="" id="s2example-7" name="mcatogery[]" multiple>
                                            <?php foreach ($areaListd as $areaList) { ?>
                                            <option <?php if (in_array($areaList->ec_id, $sub_experts)) { ?> selected=""
                                                <?php  } ?> value="<?php echo $areaList->ec_id; ?>">
                                                <?php echo $areaList->category; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php echo form_error('mcatogery', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('footer_Content') === '') ? '' : 'error';
                                    $content = (set_value('footer_Content') == false && !empty($slider_row)) ? $slider_row->content : set_value('content');
                                    ?>
                                    <label class="form-label" for="formfield1"> Content </label>
                                    <div class="controls">
                                        <textarea rows="5" style="height: 250px" id="summernote"
                                            class="form-control mytextarea" name="content"><?= $content ?></textarea>
                                        <?php echo form_error('content', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('tags') === '') ? '' : 'error';
                                    $tags = (set_value('tags') == false && !empty($slider_row)) ? $slider_row->tags : set_value('tags');
                                    ?>
                                    <label class="form-label" for="formfield1"> Tags </label>
                                    <span class="desc">e.g. "ASEAN, Cambodia"</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="text" value="<?= $tags ?>" name="tags" id="tags"
                                            data-role="tagsinput" class="form-control" />
                                        <?php echo form_error('tags', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('editor') === '') ? '' : 'error';
                                    $editor = (set_value('editor') == false && !empty($slider_row)) ? $slider_row->editor : set_value('editor');
                                    ?>
                                    <label class="form-label" for="formfield1">Editor(s)</label>
                                    <div class="controls">
                                        <select id="branch" name="editor[]" class="" multiple>
                                            <?php
                                            if (!empty($editor)) {
                                                $editor_data = explode(', ', $editor);

                                                foreach ($editor_data as $value) {
                                                    echo '<option value="' . $value . '" selected>' . $value . '</option>';
                                                }
                                            }
                                            ?>
                                            <?php foreach ($editor_d as $areaList) { ?>
                                            <option <?php if (in_array($areaList->article_id, $eData)) { ?> selected=""
                                                <?php  } ?> value="<?= $areaList->title ?>"><?= $areaList->title ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                        <?php echo form_error('editor', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('editor') === '') ? '' : 'error';
                                    $editor = (set_value('editor') == false && !empty($slider_row)) ? $slider_row->editor : set_value('editor');
                                    ?>
                                    <label class="form-label" for="formfield1">Highlighted Editor(s)</label>
                                    <div class="controls">
                                        <select id="h_editor" name="h_editor[]" class="h_editor" multiple>
                                            <?php foreach ($editor_d as $areaList) { ?>
                                            <option <?php if (in_array($areaList->article_id, $ehData)) { ?> selected=""
                                                <?php  } ?> value="<?= $areaList->article_id ?>"><?= $areaList->title ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                        <?php echo form_error('editor', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('author') === '') ? '' : 'error';
                                    $author = (set_value('author') == false && !empty($slider_row)) ? $slider_row->author : set_value('author');
                                    ?>
                                    <label class="form-label" for="formfield1"> Authors </label>
                                    <div class="controls">
                                        <select id="author" name="author[]" class="select_multiple1" multiple>
                                            <?php
                                            if (!empty($author)) {
                                                $author_data = explode(', ', $author);

                                                foreach ($author_data as $value) {
                                                    echo '<option value="' . $value . '" selected>' . $value . '</option>';
                                                }
                                            }
                                            ?>
                                            <?php foreach ($aut_d as $areaList) { ?>
                                            <option value="<?= $areaList->title ?>"><?= $areaList->title ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php echo form_error('author', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('author') === '') ? '' : 'error';
                                    $author = (set_value('author') == false && !empty($slider_row)) ? $slider_row->author : set_value('author');
                                    ?>
                                    <label class="form-label" for="formfield1"> Highlighted Author(s) </label>
                                    <div class="controls">
                                        <select id="h_author" name="h_author[]" class="" multiple>
                                            <?php foreach ($aut_d as $areaList) { ?>
                                            <option <?php if (in_array($areaList->article_id, $ahData)) { ?> selected=""
                                                <?php  } ?> value="<?= $areaList->article_id ?>"><?= $areaList->title ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                        <?php echo form_error('author', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('venue') === '') ? '' : 'error';
                                    $venue = (set_value('venue') == false && !empty($slider_row)) ? $slider_row->venue : set_value('venue');
                                    ?>
                                    <label class="form-label" for="formfield1"> Locations </label>
                                    <span class="desc">e.g. "100"</span>
                                    <div class="controls">
                                        <select name="venue[]" id="venue" multiple>
                                            <?php foreach ($country->result() as $country) { ?>
                                            <option value="<?= $country->venue ?>"
                                                <?php if (strpos($venue, $country->venue)) { ?> selected <?php } ?>>
                                                <?= $country->venue ?></option>
                                            <?php } ?>country
                                        </select>
                                        <?php echo form_error('venue', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('start_date') === '') ? '' : 'error';
                                    $start_date = (set_value('start_date') == false && !empty($slider_row)) ? $slider_row->start_date : set_value('start_date');
                                    ?>
                                    <label class="form-label" for="formfield1"> Update </label>
                                    <!-- <span class="desc">e.g. "100"</span> -->
                                    <div class="controls">
                                        <input type="date" value="<?= $start_date ?>" name="start_date" id="start_date"
                                            class="form-control" />
                                        <?php echo form_error('start_date', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('doc_no') === '') ? '' : 'error';
                                    $doc_no = (set_value('doc_no') == false && !empty($slider_row)) ? $slider_row->doc_no : set_value('doc_no');
                                    ?>
                                    <label class="form-label" for="formfield1"> Doc No. </label>
                                    <span class="desc">e.g. "100"</span>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input type="text" value="<?php echo $doc_no ?>" class="form-control"
                                            id="doc_no" name="doc_no">
                                        <?php echo form_error('doc_no', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div style="display:none" class="form-group">
                                    <?php
                                    $error = (form_error('period') === '') ? '' : 'error';
                                    $period = (set_value('period') == false && !empty($slider_row)) ? $slider_row->period : set_value('period');
                                    ?>
                                    <label class="form-label" for="formfield1"> Period </label>
                                    <span class="desc">e.g. "100"</span>
                                    <div class="controls">
                                        <input type="text" value="<?php echo $period ?>" class="form-control"
                                            id="period" name="period">
                                        <?php echo form_error('period', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('menu_title') === '') ? '' : 'error';
                                    $article_status = (set_value('article_status') == false && !empty($slider_row)) ? $slider_row->article_status : set_value('article_status');
                                    ?>
                                    <label class="form-label" for="formfield1"> Status </label>
                                    <!-- <span class="desc">e.g. "Title"</span> -->
                                    <div class="controls">
                                        <i class=""></i>
                                        <input style="width: 25px;float: left;margin-right: 15px;margin-top: -6px;"
                                            type="radio" <?php if ($article_status == 0) { ?> checked <?php } ?>
                                            value="0" class="form-control" id="article_status" name="article_status">
                                        Ongoing
                                        <?php echo form_error('article_status', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                    <div class="controls">
                                        <i class=""></i>
                                        <input style="width: 25px;float: left;margin-right: 15px;margin-top: -6px;"
                                            type="radio" <?php if ($article_status == 1) { ?> checked <?php } ?>
                                            value="1" class="form-control" id="article_status" name="article_status">
                                        Report
                                        <?php echo form_error('article_status', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('highlight') === '') ? '' : 'error';
                                    $highlight = (set_value('highlight') == false && !empty($slider_row)) ? $slider_row->highlight : set_value('highlight');
                                    ?>
                                    <label class="form-label" for="formfield1"> Highlight ? </label>
                                    <!-- <span class="desc">e.g. "100"</span> -->
                                    <div style="width: 30px" class="controls">
                                        <i class=""></i>
                                        <input type="checkbox" value="1" <?php if ($highlight == 1) { ?> checked
                                            <?php } ?> class="form-control" id="highlight" name="highlight">
                                        <?php echo form_error('highlight', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $error = (form_error('published') === '') ? '' : 'error';
                                    $published = (set_value('published') == false && !empty($slider_row)) ? $slider_row->published : set_value('published');
                                    ?>
                                    <label class="form-label" for="formfield1"> Published ? </label>
                                    <div style="width: 30px" class="controls">
                                        <input type="checkbox" value="1" <?php if ($published == 1) { ?> checked
                                            <?php } ?> class="form-control" id="published" name="published">
                                        <?php echo form_error('published', '<span class="help-inline">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group hidden">
                                    <label class="form-label" for="formfield1"> Related Article</label>
                                    <span class="desc" style="font-style:italic;">*Type in article title and press
                                        enter</span>
                                    <div class="controls">
                                        <select class="" id="s2example-1" name="related[]" multiple>
                                            <?php foreach ($related->result() as $areaList) { ?>
                                            <option <?php if (in_array($areaList->article_id, $relatedData)) { ?>
                                                selected="" <?php  } ?> value="<?php echo $areaList->article_id; ?>">
                                                <?php echo $areaList->title; ?></option>
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
                                        <select id="relatedPublication" name="related_publication[]" multiple>
                                            <?php foreach ($publicationList->result() as $publicationlist) { ?>
                                            <option
                                                <?php if (in_array($publicationlist->article_id, $relatedPublicationsData)) { ?>
                                                selected="" <?php  } ?>
                                                value="<?php echo $publicationlist->article_id; ?>">
                                                <?php echo $publicationlist->title; ?></option>
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
<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script src="<?php echo base_url() ?>resources/plugins/select2/select2.min.js" type="text/javascript"></script>


<!-- Sidebar Graph - START -->
<script src="<?php echo base_url() ?>resources/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript">
</script>
<script src="<?php echo base_url() ?>resources/js/chart-sparkline.js" type="text/javascript"></script>

<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js" type="text/javascript">
</script>
<!-- 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css"
    integrity="sha512-0V10q+b1Iumz67sVDL8LPFZEEavo6H/nBSyghr7mm9JEQkOAm91HNoZQRvQdjennBb/oEuW+8oZHVpIKq+d25g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"
    integrity="sha512-zP5W8791v1A6FToy+viyoyUUyjCzx+4K8XZCKzW28AnCoepPNIXecxh9mvGuy3Rt78OzEsU+VCvcObwAMvBAww=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<input type="hidden" class="base_url_front" value="<?= base_url(); ?>">
<script src="<?= base_url(); ?>v6/js/admin/research/publication.js" type="text/javascript"></script>