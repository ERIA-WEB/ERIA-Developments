var base_url_front = $('.base_url_front').val();
$('.type').click(function() {
    var type = $(this).data("type");

    $('.publication').val(type);

    $('.publi').html(type);
});

$('.ath').click(function() {
    var type = $(this).data("id");
    var nm = $(this).data("nm");
    $('#author').val(type);

    $('.athd').html(nm);
});


$('.cnty').click(function() {
    var type = $(this).data("cnt");

    $('.region').val(type);

    $('.reg').html(type);
});


var ascending = false;

$('.sortByPrice').click(function() {
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

$('.sortByA').click(function() {
    var sort, el = $('.sorteren');
    sort = el.find('.search-section').sort(el.hasClass('asc') ? asc_sort : dec_sort);
    el.toggleClass('asc');

    function asc_sort(a, b) {
        return ($(b).text()) < ($(a).text()) ? 1 : -1;
    }

    function dec_sort(a, b) {
        return ($(b).text()) > ($(a).text()) ? 1 : -1;
    }

    $(".sorteren").html(sort)
});


$(document).ready(function() {
    var start = 0;
    var limit = 5;

    var reachedMax = false;

    getPost_searchData();

    $('#_msearch').click(function() {
        start = 0;
        limit = 5;
        $('#ty').val("");

        $('#searchResult').html('');

        getPost_searchData();

    })

    $('#ldmr').click(function() {
        getPost_searchData();
    })

    function getPost_searchData() {

        var publication = $('#publication').val();
        var author = $('#author').val();
        var region = $('#region').val();
        var url = base_url_front+'Publications/loadmSearch';

        var key = $('#keywords').val();
        var ty = $('#ty').val();

        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'text',
            cache: false,
            data: $("#form_id").serialize() + "&start=" + start + "&limit=" + limit,
            success: function(response) {
                // console.log(response);
                if (response == "") {

                    $(".loader-image").hide();
                    $("#ldmr").addClass("d-none");
                    // $("#searchResult").html('<h5>No result</h5>');
                } else {
                    $("#ldmr").removeClass("d-none");
                    $("#ldmr").html("Load more");
                    $('#normals').show();
                    $('#normal').hide();
                    start += limit;
                    $(".loader-image").show();
                    $("#searchResult").append(response);
                }
            }
        });
    }
});


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
