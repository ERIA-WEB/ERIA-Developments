var base_url_front = $('.base_url_front').val();
$(document).ready(function () {
    var $modal = $('#modal');
    var image = document.getElementById('sample_image');
    var cropper;

    $('#upload_image').change(function (event) {
        var files = event.target.files;
        var done = function (url) {

            image.src = url;

            $modal.modal('show');
        };

        if (files && files.length > 0) {
            reader = new FileReader();
            reader.onload = function (event) {
                done(reader.result);
            };
            reader.readAsDataURL(files[0]);
            //}
        }
    });

    $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
            aspectRatio: 1.5,
            viewMode: 3,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });

    $("#crop").click(function () {
        canvas = cropper.getCroppedCanvas({
            width: 350,
            height: 250,
        });

        canvas.toBlob(function (blob) {
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function () {
                var base64data = reader.result;

                $.ajax({
                    url: base_url_front + "system-content/Events/cropImageThumbnails",
                    method: "POST",
                    data: {
                        image: base64data
                    },
                    success: function (data) {
                        console.log(data);
                        $modal.modal('hide');
                        $('#uploaded_image').attr('src', base_url_front +
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


$("#relatedArticle").select2({
    placeholder: 'Choose your Related News',
    allowClear: true
}).on('select2-open', function () {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
});


$("#categoryEvents").select2({
    placeholder: 'Choose your Category',
    allowClear: true
}).on('select2-open', function () {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
});

$("#peopleSelect").select2({
    placeholder: 'Choose your People Experts',
    allowClear: true
}).on('select2-open', function () {
    // Adding Custom Scrollbar
    $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
});

// Add Form
$(document).ready(function () {
    var max_fields = 0;
    var wrapper = $(".agenda_form_content");
    var add_form = $("#add_form_button");
    var remove_form = $("#remove_form_button");

    var i = parseInt(0) + parseInt($('#countAgendaList').val());
    $(add_form).click(function (e) {
        e.preventDefault();
        var total_fields = wrapper[0].childNodes.length;


        $(wrapper).append(
            '<div id="pageAgenda-' + i +
            '" class="pageAgenda"><button type="button" id="remove_form_button-' + i +
            '" class="btn btn-danger remove_form_button" style="position:absolute;right:10px;"><i class="fa fa-minus" ></i></button><div class="form-group"><label class="form-label" for="formfield1">Title</label ><div class="controls"><input type="text" class = "form-control" id = "title_event_agenda" name = "title_event_agenda[' +
            i +
            ']" placeholder="Please input field for title"></div></div><div class="form-group"><label class="form-label" for="formfield1">Content</label><div class="controls"><textarea name="content[]" class="form-control mytextarea" cols="30" rows="10"></textarea></div></div><hr style="border-top: 2px solid #333;"></div>'
        );

        $("#remove_form_button-" + i + "").click(function () {
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

    $("#remove_form_button-100").click(function () {
        $("#pageAgenda-100").remove();
    });
});



$(function () {
    $('.pop').on('click', function () {
        $('.imagepreview').attr('src', $(this).find('img').attr('src'));
        $('#imagemodal').modal('show');
    });
});


$('#photo').change(function () {
    var input = this;
    var name = $(this).val();

    $('#image').val(name);

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#placeholder').attr('src', e.target.result).attr('width', 'auto');
        };
        reader.readAsDataURL(input.files[0]);
    }
});
$('#image_').change(function () {

    alert();

    var input = this;
    var name = $(this).val();

    $('#imageblow').val(name);

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#placeholdern').attr('src', e.target.result).attr('width', 142);
        };
        reader.readAsDataURL(input.files[0]);
    }
});

$(document).ready(function () {
    // $('#summernote').summernote();
    // $('#article_keywords').summernote();
});
