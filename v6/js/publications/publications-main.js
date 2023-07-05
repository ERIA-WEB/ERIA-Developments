var base_url_front = $('.base_url_front').val();
// var slideIndex = 1;
// showSlides(slideIndex);

// function plus_pubSlides(n) {
//     showSlides(slideIndex += n);
// }

// function plusSlides(n) {
//     showSlides(slideIndex += n);
// }

// function currentSlide(n) {
//     showSlides(slideIndex = n);
// }

// function showSlides(n) {
//     var i;
//     // var slides = document.getElementsByClassName("mySlides");
//     // var dots = document.getElementsByClassName("dot");
//     var pdots = document.getElementsByClassName("pdots");

//     if (n > pdots.length) {
//         slideIndex = 1
//     }
//     if (n < 1) {
//         slideIndex = pdots.length
//     }

//     for (i = 0; i < pdots.length; i++) {
//         pdots[i].className = pdots[i].className.replace(" actives", "");
//     }

//     pdots[slideIndex - 1].className += " actives";
//     // slides[slideIndex-1].style.display = "block";
//     // dots[slideIndex-1].className += " actives";
// }
$(document).ready(function(e) {
    if (e.keyCode == 116 || e.keyCode == 82) {
        window.location.reload();
        sessionStorage.removeItem('param_publications');
    }

    var dropselvalue = sessionStorage.getItem("param_publications");
    var sessions_data = JSON.parse(dropselvalue);

    var start_ = 0;

    if (sessions_data != null) {
        var limit_ = sessions_data['limit'];
        var start_session = sessions_data['start'];

        limit_ += start_session;

        $('#ldmrLatestPublications').remove();
        $('#ldmrNextSession').removeClass('d-none');
        $('#limitNextSession').val(limit_);
        $('#startNextSession').val(start_session);
    } else {
        var limit_ = 4;
    }

    getPostLatestPublicationData(start_, limit_);
    sessionStorage.removeItem('param_publications');

    $('.profile-overView1').click(function() {
        $('.publicationcontent').show();

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
        sessionStorage.setItem("param_publications", arrSessions);
        getPostLatestPublicationData(start_, limit_);
    });

    var start_click = 4;
    var limit_click = 4;
    $('#ldmrLatestPublications').click(function() {
        $.ajax({
            url: base_url_front+'Publications/countLimitSession?start=' + start_click +
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
                sessionStorage.setItem("param_publications", arrSessions);
                getPostLatestPublicationData(startclick, limitclick);

            }
        });


    });

    function getPostLatestPublicationData(start_, limit_) {
        var publication = 'all'; // $('#topic').val()
        var url = base_url_front+'Publications/getDataLatestPublications';
        var key = ''; // $('#key').val()
        var cato = 'all'; // $('#cato').val()
        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'text',
            cache: false,
            data: {
                getData: 1,
                start: start_,
                limit: limit_,
                publication: publication,
                key: key,
                cato: cato
            },
            success: function(response) {
                if (response == "") {
                    $(".loader-image").hide();
                    $("#ldmrLatestPublications").html("That's All");
                } else {
                    $('.loadButton').show();

                    $("#ldmrLatestPublications").html("Load more");
                    $('#normals').show();
                    $('#normal').hide();
                    // start_ += limit_;
                    $(".loader-image").show();
                    $("#latest-publications").append(response); // publications
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
    $('.catos').html(nme);
    $('#cato').val(to);
});



if ($('.latest-1st-col').length > 4) {
    $('.latest-1st-col:gt(3)').hide();
    $('.show-more').show();
}

$('.show-more').on('click', function() {
    //toggle elements with class .ty-compact-list that their index is bigger than 2
    $('.latest-1st-col:gt(3)').toggle();
    //change text of show more element just for demonstration purposes to this demo
    $(this).html() === 'Load more' ? $(this).html('Load more') : $(this).html('Load more');
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


$("#tall").click(function() {
    $('.tall').not(this).prop('checked', this.checked);
});


$("#pall").click(function() {
    $('.pall').not(this).prop('checked', this.checked);
});


const highlightSwiper = new Swiper('.highlight-swiper', {
    slidesPerView: 1,
    loop: true,
    navigation: {
        nextEl: '#highlight-button-next',
        prevEl: '#highlight-button-prev',
    },
    pagination: {
        el: '#highlight-pagination',
    },
});
