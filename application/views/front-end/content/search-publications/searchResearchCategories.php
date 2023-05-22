<style>
.check_flag {
    background-color: #e4f4f9;
}
</style>
<div class="container-fluid px-0">
    <form class="bottom-divider" id="form_id" method="post">
        <?php 
            $parse_url = trim(parse_url(current_url(), PHP_URL_PATH), '/');
            $urlArray = explode('/', $parse_url);
        ?>
        <input type="hidden" id="slug_" name="slug_" value="<?= end($urlArray); ?>">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button id="button-addon2" type="submit"
                                class="btn btn-link text-secondary border border-right-0">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                        <input type="search" id="key" name="key"
                            value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>" placeholder="Keywords"
                            aria-describedby="button-addon2" class="form-control border-left-0">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <input type="hidden" id="cato" value="all">
            <div class="col-md-6 mb-3">
                <div class="dropdown">
                    <button type="button" class="publication-collapsible profile-overView1 search-result-btn">Topics
                        <span id="countTopics"></span>
                    </button>
                    <div class="new_publication publicationcontent">
                        <div class="new_publication_inside">
                            <div class="check-btns">
                                <label class="container-check"> Select All
                                    <input type="checkbox" id="tall" value="">
                                    <span class="checkmark"></span>
                                </label>
                                <?php 
                                foreach ($topics as $ptypes) {
                                    if ($research_categories_data->category_name == $ptypes->category_name) {
                                        $checked_ = 'checked';
                                    } else {
                                        $checked_ = '';
                                    }

                                    echo '<label class="container-check">
                                                '.$ptypes->category_name.'
                                                <input class="tall" '.$checked_.' type="checkbox" name="research[]" value="'.$ptypes->category_id.'">
                                                <span class="checkmark"></span>
                                        </label>';
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="dropdown">
                    <input id="topic" type="hidden" value="all">
                    <button type="button"
                        class="publication-collapsible  profile-overView1 search-result-btn ">Publication Type <span
                            id="countPublicationType"></span>
                    </button>
                    <div class="new_publication publicationcontent">
                        <div class="new_publication_inside">
                            <div class="check-btns">
                                <label class="container-check"> Select All
                                    <input type="checkbox" id="pall" value="">
                                    <span class="checkmark"></span>
                                </label>
                                <?php foreach ($ptype as $ptypes) { ?>
                                <label class="container-check"> <?= $ptypes->category_name ?>
                                    <input class="pall" type="checkbox" name="research_type[]" id=""
                                        value="<?= $ptypes->category_id ?>">
                                    <span class="checkmark"></span>
                                </label>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="dropdown">
                    <input type="hidden" value="all" id="cb">
                    <button type="button" class="publication-collapsible  profile-overView1 search-result-btn ">Region
                        <span id="countRegion"></span>
                    </button>
                    <div class="new_publication publicationcontent">
                        <div class="new_publication_inside">
                            <div class="check-btns">
                                <label class="container-check"> Select All
                                    <input type="checkbox" id="rall" value="">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container-check">
                                    Brunei Darussalam <input class="rall" type="checkbox" name="region[]" id=""
                                        value="Brunei Darussalam"> <span class="checkmark"></span>
                                </label>
                                <label class="container-check">
                                    Cambodia <input type="checkbox" class="rall" name="region[]" id="" value="Cambodia">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container-check">
                                    Indonesia <input type="checkbox" class="rall" name="region[]" id=""
                                        value="Indonesia"> <span class="checkmark"></span>
                                </label>
                                <label class="container-check">
                                    Malaysia <input type="checkbox" class="rall" name="region[]" id="" value="Malaysia">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container-check">
                                    Lao PDR <input type="checkbox" class="rall" name="region[]" id="" value="Lao PDR">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container-check">
                                    Thiland <input type="checkbox" class="rall" name="region[]" id="" value="Thiland">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container-check">
                                    Myanmar <input type="checkbox" class="rall" name="region[]" id="" value="Myanmar">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container-check">
                                    Phillippines <input type="checkbox" class="rall" name="region[]" id=""
                                        value="Phillippines"> <span class="checkmark"></span>
                                </label>
                                <label class="container-check">
                                    Singapore <input type="checkbox" name="region[]" id="" value="Singapore"> <span
                                        class="checkmark"></span>
                                </label>
                                <label class="container-check">
                                    Viet Nam <input type="checkbox" class="rall" name="region[]" id="" value="Vietnam">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <button class="btn third-button w-100" id="_msearch" type="button">Search</button>
            </div>
        </div>
    </form>
</div>
<!-- <div style="display: none" class="row mt-4">
    <div class="col-md-0 py-2">
        <div class="sort-by">Sort by</div>
    </div>
    <div class="col-md-5 col-10">
        <div class="dropdown">
            <button class="btn bg-white border w-100" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Sort by<i class="fa fa-angle-down"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Ascending</a>
                <a class="dropdown-item" href="#"> Descending</a>

            </div>
        </div>
    </div>
</div> -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
    if (e.keyCode == 116 || e.keyCode == 82) {
        window.location.reload();
        sessionStorage.removeItem('params');
    }

    $('.profile-overView1').click(function() {
        $('.publicationcontent').show();
    });

    var start = 0;
    // var limit = 4;
    var dropselvalue = sessionStorage.getItem("params");
    var sessions_data = JSON.parse(dropselvalue);
    // console.log("start: " + sessions_data['start']);
    // console.log("limit: " + sessions_data['limit']);

    if (sessions_data != null) {
        var limit = sessions_data['limit'];
        var start_session = sessions_data['start'];

        limit += start_session;

        $('#ldmr').remove();
        $('#ldmrNextSession').removeClass('d-none');
        $('#limitNextSession').val(limit);
        $('#startNextSession').val(start_session);
    } else {
        var limit = 4;
    }

    getPost_searchData(start, limit);
    sessionStorage.removeItem('params');
    var reachedMax = false;

    $(document).on('click', '.n_related', function() {

        start = 0;
        limit = 4;

        var key = $(this).data("key");
        $('#key').val(key);

        $('#searchResult').html('');

        $('html, body').animate({
            scrollTop: $("#n_req").offset().top
        }, 1000);

        getPost_searchData(start, limit);
    });

    $('#_msearch').click(function() {
        $('.publicationcontent').hide();
        start = 0;
        limit = 4;
        $('#searchResult').html('');
        getPost_searchData(start, limit);
    });

    var start_ = parseInt($('#startNextSession').val());
    var limit_ = parseInt($('#limitNextSession').val());
    $('#ldmrNextSession').click(function() {
        start_ += limit_;
        // alert("start_next_session: " + start_ + ", limit_next_session: " +
        //     limit_);
        var arrSessions = '{"start":' + start_ + ', "limit":' + limit_ +
            '}';

        //here we save the item in the sessionStorage.
        sessionStorage.setItem("params", arrSessions);
        getPost_searchData(start_, limit_);
    });

    var start_click = 4;
    var limit_click = 4;
    $('#ldmr').click(function() {
        $.ajax({
            url: '<?= base_url() ?>Research/countLimitSession?start=' + start_click +
                "&limit=" +
                limit_click,
            method: 'GET',
            success: function(response) {
                // console.log("response : " + response);
                var data = JSON.parse(response);

                var startclick = data['startclick'];
                var limitclick = data['limitclick'];
                start_click += limit_click;
                var arrSessions = '{"start":' + startclick + ', "limit":' + limitclick +
                    '}';

                //here we save the item in the sessionStorage.
                sessionStorage.setItem("params", arrSessions);
                getPost_searchData(startclick, limitclick);

            }
        });

    });

    function getPost_searchData(start, limit) {
        var publication = $('#topic').val();
        var region = $('#cb').val();
        var url = '<?= base_url() ?>Research/loadinsideSearch';
        var key = $('#key').val();
        var cato = $('#cato').val();

        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'text',
            cache: false,
            data: $("#form_id").serialize() + "&start=" + start + "&limit=" + limit,
            success: function(response) {
                if (response == "") {
                    $(".loader-image").hide();
                    $('#ldmr').addClass('d-none');
                    // $("#ldmr").html("That's All");
                } else {
                    // $("#ldmr").html("Load more");

                    $('#normals').show();
                    $('#normal').hide();
                    // start += limit;

                    // var cookie = limit + start;
                    // console.log("cookies : " + cookie);
                    //here we save the item in the sessionStorage.
                    // sessionStorage.setItem("paramLimit", JSON.stringify(cookie));
                    $(".loader-image").show();
                    $("#searchResult").append(response);
                }
            }
        });
    }
});

$('.type').click(function() {
    var to = $(this).data("typed");
    var tm = $(this).data("tmd");

    $('.btty').html(tm);
    $('#topic').val(to);
});

$('.cnty').click(function() {
    var to = $(this).data("cnt");

    $('.reg').html(to);
    $('#cb').val(to);
});

$('.ncls').click(function() {
    var to = $(this).data("type");
    var nme = $(this).data("nme");
    // alert (to);
    $('.catos').html(nme);
    $('#cato').val(to);
})
</script>
<script>
$("#tall").click(function() {
    $('.tall').not(this).prop('checked', this.checked);
});

$("#pall").click(function() {
    $('.pall').not(this).prop('checked', this.checked);
});

$("#rall").click(function() {
    $('.rall').not(this).prop('checked', this.checked);
});
</script>
<script>
$(document).mouseup(function(e) {
    var container = $(".publication-collapsible");
    var co = $(".new_publication");

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0 && !co.is(e.target) && co.has(e.target)
        .length === 0) {
        $('.new_publication').css("max-height", "");
        $(".publication-collapsible").removeClass("publicationactive");
    }
});
</script>