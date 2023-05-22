<!DOCTYPE html>
<html>

<?php
$data_s = $this->session->userdata('logged_in');
$this->load->view('back-end/common/header');
?>

<body>
    <?php $this->load->view('back-end/common/topbar'); ?>
    <div class="page-container row-fluid">
        <?php
        $this->load->view('back-end/common/menu');
        $this->load->view($content);
        $this->load->view('back-end/common/right-panel');
        ?>
        <div class="chatapi-windows "></div>
    </div>
    <?php $this->load->view('back-end/common/footer'); ?>

    <script src="<?php echo base_url() ?>resources/plugins/jquery-ui/smoothness/jquery-ui.min.js"
        type="text/javascript"></script>
    <script src="<?php echo base_url() ?>resources/js/custome.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>resources/js/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>resources/js/caleran.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>resources/js/newcalendar.js" type="text/javascript"></script>
    <!-- <script src="<?php echo base_url() ?>vendor/ckeditor/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url() ?>vendor/ckeditor/ckeditor/adapters/jquery.js"></script>
    <script>
    $(document).ready(function() {
        $('#article_keywords').ckeditor();
    });
    </script> -->

    <script src="<?php echo base_url() ?>assets/tinymce/tinymce.min.js" type="text/javascript"></script>
    <!-- <script src="https://cdn.tiny.cloud/1/xsc1u8yhlpzgzdkqt417bgt01vzf7w9t29qt5wsw0wwvtvu6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
    <script>
    function example_image_upload_handler(blobInfo, success, failure, progress) {
        var xhr, formData;

        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', '<?php echo base_url(); ?>postAcceptor.php');

        xhr.upload.onprogress = function(e) {
            progress(e.loaded / e.total * 100);
        };

        xhr.onload = function() {
            var json;

            if (xhr.status === 403) {
                failure('HTTP Error: ' + xhr.status, {
                    remove: true
                });
                return;
            }

            if (xhr.status < 200 || xhr.status >= 300) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }

            json = JSON.parse(xhr.responseText);

            if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }

            success(json.location);
        };

        xhr.onerror = function() {
            failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
        };

        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());

        xhr.send(formData);
    };

    var BASE_URL = "<?php echo base_url(); ?>";
    var demoBaseConfig = {
        selector: ".mytextarea",
        toolbar: 'undo redo | image code',
        images_upload_handler: example_image_upload_handler,
        file_picker_types: 'file image media',
        relative_urls: false,
        remove_script_host: false,
        // file_picker_callback: function(cb, value, meta) {
        //     var input = document.createElement('input');

        //     input.setAttribute('type', 'file');

        //     /*
        //     Note: In modern browsers input[type="file"] is functional without
        //     even adding it to the DOM, but that might not be the case in some older
        //     or quirky browsers like IE, so you might want to add it to the DOM
        //     just in case, and visually hide it. And do not forget do remove it
        //     once you do not need it anymore.
        //     */

        //     input.onchange = function() {
        //         var file = this.files[0];

        //         var reader = new FileReader();
        //         reader.onload = function() {
        //             /*
        //             Note: Now we need to register the blob in TinyMCEs image blob
        //             registry. In the next release this part hopefully won't be
        //             necessary, as we are looking to handle it internally.
        //             */
        //             var id = '<?php echo base_url()."images/"; ?>blobid' + (new Date()).getTime();
        //             var blobCache = tinymce.activeEditor.editorUpload.blobCache;
        //             var base64 = reader.result.split(',')[1];
        //             var blobInfo = blobCache.create(id, file, base64);
        //             blobCache.add(blobInfo);


        //             /* call the callback and populate the Title field with the file name */
        //             cb(blobInfo.blobUri(), {
        //                 title: file.name
        //             });

        //         };
        //         reader.readAsDataURL(file);

        //     };

        //     input.click();
        // },
        plugins: [
            "image code",
            "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern imagetools"
        ],
        toolbar1: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
        toolbar2: "cut copy paste | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | preview | forecolor backcolor",
        toolbar3: "table | hr removeformat | subscript superscript | charmap fullscreen | ltr rtl | visualblocks template",

        menubar: true,
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
        templates: [],
        content_css: [
            '<?php echo base_url(); ?>/v6/css/custome_wyiswg.css'
        ],

        filemanager_crossdomain: false,
        filemanager_access_key: "<?php echo md5($_SESSION['admin_user']['username'].$_SERVER['REMOTE_ADDR'].date('Ymd')); ?>",
        external_filemanager_path: BASE_URL + "/addons/filemanager/",
        filemanager_title: "Media Gallery",
        external_plugins: {
            "filemanager": BASE_URL + "/addons/filemanager/plugin.min.js"
        },
        image_advtab: true,
        font_formats: 'Merriweather="Merriweather";Montserrat="Montserrat"', // , sans-serif;Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;SF Compact Text Light=sf_compact_textlight;SF Compact Text Light Italic=sf_compact_textlight_italic;SF Compact Text=sf_compact_textregular;SF Compact Text Italic=sf_compact_textitalic;SF Compact Text Medium=sf_compact_textmedium;SF Compact Text Medium Italic=sf_compact_textmedium_italic;SF Compact SemiBold=sf_compact_textsemibold;SF Compact Text SemiBold Italic=sf_compact_textSBdIt;SF Compact Text Bold=sf_compact_textbold;SF Compact Text Bold Italic=sf_compact_textbold_italic,
        fontsize_formats: '10px 12px 13px 14px 15px 16px 17px 24px 28px 36px'
    };

    tinymce.init(demoBaseConfig);
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        //If image edit link is clicked
        $(".editLinks").on('click', function(e) {
            e.preventDefault();
            $("#fileInput:hidden").trigger('click');
        });

        $(".editLink").on('click', function(e) {
            e.preventDefault();
            $("#fileInput:hidden").trigger('click');
        });


        //On select file to upload
        $("#fileInput").on('change', function() {
            var image = $('#fileInput').val();
            var img_ex = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

            //validate file type
            if (!img_ex.exec(image)) {
                alert('Please upload only .jpg/.jpeg/.png/.gif file.');
                $('#fileInput').val('');
                return false;
            } else {
                $('.uploadProcess').show();
                $('#uploadForm').hide();
                $("#picUploadForm").submit();
            }
        });
    });

    //After completion of image upload process
    function completeUpload(success, fileName) {
        if (success == 1) {
            $('#imagePreview').attr("src", "");
            $('#imagePreview').attr("src", fileName);
            $('#fileInput').attr("value", fileName);
            $('.uploadProcess').hide();
            location.reload();

        } else {
            $('.uploadProcess').hide();
            alert('There was an error during file upload!');
        }
        return true;
    }
    </script>
</body>

</html>