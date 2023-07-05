
var ascending = false;
$('.sortByPrice_').click(function () {
    $('.dis_p').html("Date");

    var sort, el = $('.sorteren')
    sort = el.find('.search-section').sort(el.hasClass('asc') ? asc_sort : dec_sort)
    el.toggleClass('asc')

    function asc_sort(a, b) {
        return ($(b).text()) < ($(a).text()) ? 1 : -1;
    }

    function dec_sort(a, b) {
        return ($(b).text()) > ($(a).text()) ? 1 : -1;
    }

    $(".sorteren").html(sort);
});

$('.sortByA_').click(function () {
    $('.dis_p').html("Relevance");

    var sort, el = $('.sorteren')
    sort = el.find('.search-section').sort(el.hasClass('asc') ? asc_sort : dec_sort)
    el.toggleClass('asc')

    function asc_sort(a, b) {
        return ($(b).text()) < ($(a).text()) ? 1 : -1;
    }

    function dec_sort(a, b) {
        return ($(b).text()) > ($(a).text()) ? 1 : -1;
    }

    $(".sorteren").html(sort)
});

$('.from_s').click(function () {
    var kword = $('.kword').val();
    var sort = $(this).data("sort");
    $('#sort').val(sort);
    $('.kword').val(kword);
    $('#s_form').submit();
    $('#s_form').serialize();

})


$('.ncount').click(function () {
    var id = $(this).data("pag");

    $('#limit').val(id);

    $('#s_form').submit();

})



$(document).ready(function () {

    $('.publicationcontent').css("max-height", "0");

    // replaceText();

    function replace_Text() {
        var searchword = $('#kword_search').val();
        var src_str = $(".new-high").html();
        var term = searchword;

        term = term.replace(/(\s+)/, "(<[^>]+>)*$1(<[^>]+>)*");

        var pattern = new RegExp("(" + term + ")", "gi");

        src_str = src_str.replace(pattern, "<mark>$1</mark>");
        src_str = src_str.replace(/(<mark>[^<>]*)((<[^>]+>)+)([^<>]*<\/mark>)/, "$1</mark>$2<mark>$4");

        $(".new-high").html(src_str);
    }

    var top_search = $('.top_search').offset().top;
    $(window).scroll(function () {

        $('.datepicker').hide();
        $('.publicationcontent').css("max-height", "0");

        var windowTop = $(window).scrollTop();
        var windowHeight = $('#test').height() - 420;

        if (100 < windowTop && windowTop < windowHeight) {
            $('.top_search').css('margin-top', '100px');
            $('.top_search').css('position', 'fixed');
        } else if (windowTop > windowHeight) {
            $('.top_search').css('position', 'relative');
            $('.top_search').css('margin-bottom', '57px');

        } else {
            $('.top_search').css('position', 'relative');
            $('.top_search').css('margin-top', '57px');
        }
    });
})
