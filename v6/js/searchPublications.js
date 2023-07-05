var base_url_front = $('.base_url_front').val();
$(document).ready(function() {
    var start = 0;
    var limit = 6;
    var reachedMax = false;

    $(document).on('click', '.n_related', function() {
        start = 0;
        limit = 6;

        var key = $(this).data("key");
        $('#key').val(key);

        $('#searchResult').html('');

        $('html, body').animate({
            scrollTop: $("#n_req").offset().top
        }, 1000);
    });

    $('#_msearch').click(function() {
        start = 0;
        limit = 6;
        $('#searchResult').html('');
        getPost_searchData();
    });

    $('#ldmrSearch').click(function() {
        getPost_searchData();
    })

    function getPost_searchData() {

        var publication = $('#topic').val();
        var region = $('#cb').val();
        var url = base_url_front+'Publications/loadinsideSearch';
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
                    $('#ldmrSearch').addClass('d-none');
                    $('#rowBtnLoadMore').addClass('d-none');
                } else {
                    $("#ldmrSearch").html("Load more");
                    start += limit;
                    $("#searchResult").append(response);
                    $('#rowBtnLoadMore').removeClass('d-none');
                }
            }
        });
    }
});
