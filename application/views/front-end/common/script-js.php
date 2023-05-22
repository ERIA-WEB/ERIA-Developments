<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

<script>
$(document).ready(function() {
    $(".showsearch").click(function() {
        $(".searchbar").toggleClass("searchbar-show");
        $("#searchbar-input").focus();
    });
})
</script>
<script>
$(document).ready(function() {
    $('#fechasiniestro').datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        autoclose: true,
        showOtherMonths: true,
        selectOtherMonths: true,
        autoclose: true,
        changeMonth: true,
        changeYear: true,
        changeMonth: true,
        changeYear: true,

        yearRange: "-90:+00"
    });

    $('#fechasiniestroa').datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        autoclose: true,
        showOn: "button",
        buttonImage: "images/cal.gif",
        buttonImageOnly: true,
        showOn: "both",
        showOtherMonths: true,
        selectOtherMonths: true,
        autoclose: true,
        changeMonth: true,
        changeYear: true,

        yearRange: "-90:+00"
    });

    $('.start').click(function() {
        $("#fechasiniestroa").datepicker("show");
    });

    $('#fechasiniestroa').click(function() {

    });

    $('#fechasiniestro').click(function() {

    });

    $('.end').click(function() {
        $("#fechasiniestro").datepicker("show");
    });
})
</script>
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

<!-- AuthorCarousel -->
<script>
$('#carouselExampleControls').carousel({
    interval: 1000000000
})


$('.carousel').carousel({
    interval: false,
});



$('.author .carousel .carousel-item').each(function() {
    var minPerSlide = 3;
    var next = $(this).next();
    if (!next.length) {
        next = $(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo($(this));

    for (var i = 0; i < minPerSlide; i++) {
        next = next.next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }

        next.children(':first-child').clone().appendTo($(this));
    }
});
</script>
<!-- Search bar toggle -->
<script></script>
<script>
$(document).ready(function() {
    $(window).scroll(function() {
        if ($(window).scrollTop() > 5) {
            $('div.programs-dropdown-content, div.multimedia-dropdown-content, div.events-dropdown-content, div.events-dropdown-content, div.recent-dropdown-content, div.publications-dropdown-content, div.asean-dropdown-content, div.research-dropdown-content')
                .removeClass("hide");
        } else {
            $('div.programs-dropdown-content, div.multimedia-dropdown-content, div.events-dropdown-content, div.events-dropdown-content, div.recent-dropdown-content, div.publications-dropdown-content, div.asean-dropdown-content, div.research-dropdown-content')
                .removeClass("hide");
        }
    });
});
</script>
<script>
var coll = document.getElementsByClassName("publication-collapsible ");
var i;

for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("publicationactive");
        var publicationcontent = this.nextElementSibling;
        if (publicationcontent.style.maxHeight) {
            publicationcontent.style.maxHeight = null;
        } else {
            publicationcontent.style.maxHeight = publicationcontent.scrollHeight + "px";
        }
    });
}
</script>
<script>
$(document).ready(function() {
    $(window).scroll(function() {
        if ($(window).scrollTop() > 5) {
            $('div.programs-dropdown-content, div.multimedia-dropdown-content, div.events-dropdown-content, div.events-dropdown-content, div.recent-dropdown-content, div.publications-dropdown-content, div.asean-dropdown-content, div.research-dropdown-content')
                .removeClass("hide");
        } else {
            $('div.programs-dropdown-content, div.multimedia-dropdown-content, div.events-dropdown-content, div.events-dropdown-content, div.recent-dropdown-content, div.publications-dropdown-content, div.asean-dropdown-content, div.research-dropdown-content')
                .removeClass("hide");


        }
    });
});


function myFunction() {
    var dots = document.getElementById("dots");
    var moreText = document.getElementById("more");
    var btnText = document.getElementById("myBtn");

    if (dots.style.display === "none") {
        dots.style.display = "inline";
        btnText.innerHTML = "Read more";
        moreText.style.display = "none";
    } else {
        dots.style.display = "none";
        btnText.innerHTML = "Read less";
        moreText.style.display = "inline";
    }
}
</script>
<script>
<?php $kword = null; ?>
var src_str = $(".hgh").html();
var term = '<?php echo $kword; ?>';

if (term) {
    term = term.replace(/(\s+)/, "(<[^>]+>)*$1(<[^>]+>)*");
    var pattern = new RegExp("(" + term + ")", "gi");

    src_str = src_str.replace(pattern, "<mark>$1</mark>");
    src_str = src_str.replace(/(<mark>[^<>]*)((<[^>]+>)+)([^<>]*<\/mark>)/, "$1</mark>$2<mark>$4");

    $(".hgh").html(src_str);
}
</script>
<script>
$(document).ready(function() {
    $('.refreshCaptcha').on('click', function() {
        $.get('<?php echo base_url() . 'captcha/refresh'; ?>', function(data) {
            $('#captImg').html(data);
        });
    });
    $('.subscribe_email').on('click', function() {
        var email = $('#subscribe_email_box').val();

        var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        if (testEmail.test(email)) {

            var url = '<?= base_url() ?>Home/sentEmail';


            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'text',
                cache: false,
                data: {
                    email: email
                },
                success: function(response) {


                    if (response) {
                        $('.stext').html(' Thank you for subscribing to our letter');
                        $('#subscribeModal').modal('show');
                        $('#subscribe_email_box').val('');

                    } else {
                        $('.stext').html(' Please Enter different email this already used');
                        $('#subscribeModal').modal('show');
                        $('#subscribe_email_box').val('');
                    }




                }
            })
        }
        // Do whatever if it passes.
        else {

            $('.stext').html(' Please Enter valid email');
            $('#subscribeModal').modal('show');
        }
    })



});
</script>
<script>
var coll = document.getElementsByClassName("career-op-collapse ");
var i;

for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("careeropcollapseactive");
        var careeropcontent = this.nextElementSibling;
        if (careeropcontent.style.maxHeight) {
            careeropcontent.style.maxHeight = null;
        } else {
            careeropcontent.style.maxHeight = careeropcontent.scrollHeight + "px";
        }
    });
}
</script>
<script>
$(window).scroll(function() {
    var winTop = $(window).scrollTop();
    if (winTop >= 1) {
        var top_bar_s_height = $('.sticky_cha').height() - 30;
        $('.top__bar__s').css({
            height: top_bar_s_height,
            display: 'block',
        });
        $('.main-nav').addClass('sticky_cha').removeClass('top');
        $('.logo-description').addClass('logo-description-scrol').removeClass('logo-description-top');
        $('.header-img').addClass('logo-scrol').removeClass('logo-top');
        $('.small-sub-nav').hide();
        $('.main-nav-headings').css('padding-top', '60px');
        $('.logo-scrol').css('top', '37px');

    } else if (winTop <= 0) {
        var top_bar_s_height = $('.sticky_cha').height() - 30;
        $('.top__bar__s').css({
            height: top_bar_s_height,
            display: 'none',
        });
        $('.main-nav').addClass('top').removeClass('sticky_cha');
        $('.logo-description').addClass('logo-description-top').removeClass('logo-description-scrol');
        $('.header-img').addClass('logo-top').removeClass('logo-scrol');
        $('.small-sub-nav').show();
        $('.main-nav-headings').css('padding-top', '20px');

    }

});
</script>


<script>
$('#_email').click(function() {


    var emailN = $('#emailN').val();

    var url = '<?= base_url() ?>Home/sentEmail';


    $.ajax({
        url: url,
        method: 'POST',
        dataType: 'text',
        cache: false,
        data: {
            email: emailN
        },
        success: function(response) {


            if (response) {
                $('#_error').hide();
                $('#subscribeModal').modal('show');

            } else {
                $('#_error').show();
            }


        }
    });



})
</script>
<script>
var slider = document.querySelector(".slide-wr");
$('div.input').click(function() {


    var $scroller = $('.carousel-inner');

    var ccls = this.className;




    if (ccls.indexOf("active_") > 0) {
        $(this).removeClass('active_');
    } else {
        $(this).addClass('active_');
    }


    var cy = $(this).data('year');



    var tdot = document.getElementsByClassName("input_");
    var atdot = document.getElementsByClassName("active_");



    if (atdot.length == 0) {

        $('.slide').fadeIn();
    } else {



        for (i = 0; i < tdot.length; i++) {


            var c = tdot[i].className;




            if (c.indexOf("active_") == 0) {
                $('.slide').fadeIn();
            } else if (c.indexOf("active_") > 0) {

                //alert ($('.' + tdot[i].getAttribute('data-year')));

                $('.' + tdot[i].getAttribute('data-year')).fadeIn();

                if (cy == tdot[i].getAttribute('data-year')) {
                    var scrollTo = $('.' + tdot[i].getAttribute('data-year'))
                        // change its bg

                        // retrieve its position relative to its parent
                        .position().left;
                    console.log(scrollTo);
                    // simply update the scroll of the scroller
                    // $('.scroller').scrollLeft(scrollTo);
                    // use an animation to scroll to the destination
                    $scroller
                        .animate({
                            'scrollLeft': scrollTo
                        }, 500);
                }


            } else {
                $('.' + tdot[i].getAttribute('data-year')).fadeOut();
            }

            var c = 0;
            var left = slider.style.transform.split("%")[0].split("(")[1];
            if (left) {
                var num = Number(left) + Number(c);
            } else {
                var num = Number(c);
            }

            slider.style.transform = `translateX(${num}%)`;


        }

    }



})
</script>