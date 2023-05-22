<style>
    @media (min-width: 768px) {
        .modal-dialog {
            max-width: 1330px;
            margin: 30px auto;
            width: 100%;
        }
    }
</style>
<div style="z-index: 8888;padding-right:0 !important;" class="modal modal-wide fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"> Manage PDF </h4>
            </div>
            <div class="modal-body">

                <form method='post' action='' enctype="multipart/form-data" id="formUploadFilePDF">
                    <table class="table">
                        <tr>
                            <td>Title</td>
                            <td>:</td>
                            <td>
                                <input type="text" id="pdf_title" name="pdf_title" class="form-control">
                                <input type="hidden" id="aid" name="aid">
                                <input type="hidden" id="ptype" value="article" name="ptype">
                            </td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>:</td>
                            <td>
                                <textarea id="pdf_dis" name="pdf_dis" class="form-control" style="height:80px;" placeholder="Desription"></textarea>
                                <!-- <input type="text" id="pdf_dis" name="pdf_dis" class="form-control"> -->
                            </td>
                        </tr>
                        <tr>
                            <td>PDF </td>
                            <td>:</td>
                            <td>
                                <input type='file' name='file' id='file' class='form-control'>
                                <br>
                                <span style="color: red; font-style:italic;">Size file pdf must be < 30 MB or You can divide it into parts.</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Author/Editor </td>
                            <td>:</td>
                            <td>
                                <!-- <input type="text" id="author_editor" class="form-control" readonly> -->
                                <select id="author" name="author[]" class="" multiple>
                                    <?php foreach ($editor_->result() as $areaList) { ?>
                                        <option value="<?php echo $areaList->article_id ?>"><?php echo $areaList->title ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Sort by order </td>
                            <td>:</td>
                            <td>
                                <input type='text' id='orderid_form' name='order_id' class='form-control' required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" id="error"> </td>
                            <td style="text-align:right"> <input type='button' class='btn btn-info' value='Upload' id='btn_upload'></td>
                        </tr>
                    </table>
                </form>
                <!-- Preview-->
                <div id="loading" class="text-center hidden">
                    <img src="<?php echo base_url() ?>upload/loading-bar-1.gif" class="w-100">
                </div>
                <div id="preview" class="pdf_dis" style="text-align: center;"></div>
            </div>
        </div>
    </div>
</div>