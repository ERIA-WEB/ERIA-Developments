var base_url_front = $('.base_url_front').val();
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
            url: base_url_front+'Research/countLimitSession?start=' + start_click +
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
        var url = base_url_front+'Research/loadinsideSearch';
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


$("#tall").click(function() {
    $('.tall').not(this).prop('checked', this.checked);
});

$("#pall").click(function() {
    $('.pall').not(this).prop('checked', this.checked);
});

$("#rall").click(function() {
    $('.rall').not(this).prop('checked', this.checked);
});


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
