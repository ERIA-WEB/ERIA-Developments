<style>
iframe {
    width: 100% !important;
}

@media screen and (max-width: 767px) {
    .btn-highlight1 {
        width: 100%;
    }
}
</style>

<?php if (isset($catData)) { ?>
<div class="container experts-detail-page db-program-topic section-top">
    <div class="row mt-3">
        <div class="col-md-4">
            <?php $this->load->view('front-end/common/dbleft'); ?>
        </div>
        <!-- right section -->
        <div class="col-md-8 col-12">
            <div class="container px-0 mb-4">
                <div class="Database-Programmes-tittle mb-2">
                    <?php if ($catData) { ?>
                    <?php echo ucwords($catData->category_name);  ?>
                </div>
                <hr>
                <div class="phara-database">
                    <?php echo $catData->description; ?>
                    <?php } ?>
                </div>
                <hr>
            </div>
            <!-- drop sort -->
            <div class="container px-0 related-article">
                <h3 id="relatedArticles" class="font-merriweather text-blue mb-3 d-none">Related articles</h3>
                <div id="searchResult"></div>
                <div id="loadButton" class="loadButton" style="padding: 10px; text-align: center" class="d-none">
                    <button class="btn third-button d-none" id="ldmr">Load more </button>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>
$(document).ready(function() {
    var start = 0;
    var limit = 4;

    var reachedMax = false;

    getPost_searchData();

    $('#_msearch').click(function() {
        start = 0;
        limit = 5;

        $('.rhead').html("Search Result");

        $('#searchResult').html('');

        getPost_searchData();
    });

    $('#ldmr').click(function() {
        getPost_searchData();
    });

    function getPost_searchData() {
        var sd = $('#fechasiniestroa').val();
        var ed = $('#fechasiniestro').val();

        var region = $('#region').val();
        var url = '<?php echo base_url() ?>Programmes/loadmSearch';
        var key = $('#key').val();

        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'text',
            cache: false,
            data: {
                getData: 1,
                start: start,
                limit: limit,
                region: region,
                key: key,
                sd: sd,
                ed: ed
            },
            success: function(response) {
                if (response == "") {
                    $(".loader-image").hide();
                    $('#ldmr').addClass('d-none');
                    // $("#ldmr").html("End");
                    $("#relatedArticles").addClass('d-none');
                    $(".loadButton").addClass('d-none');
                    $("#loadButton").addClass('d-none');
                } else {
                    $("#ldmr").html("Load More");
                    $('#ldmr').removeClass('d-none');
                    $('#normals').show();
                    $('#normal').hide();
                    start += limit;
                    $(".loader-image").show();
                    $("#searchResult").append(response);
                    $("#loadButton").removeClass('d-none');
                    $("#relatedArticles").removeClass('d-none');
                }
            }
        });
    }

})
</script>
<script>
$('.cnty').click(function() {
    var type = $(this).data("cnt");
    $('.region').val(type);
    $('.reg').html(type);
})
</script>
<?php } else { ?>
<?php $this->load->view('front-end/content/404/notFound'); ?>
<?php } ?>