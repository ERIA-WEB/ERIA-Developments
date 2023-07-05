var base_url_front = $('.base_url_front').val();
$(document).ready(function() {
    var topic_publication = $('#slug').val();

    var start_publications = 0;
    var limit_publications = 2;

    getPostPublicationData();

    $('#ldmrPublications').on('click', function() {
        getPostPublicationData();
    });

    function getPostPublicationData() {
        var url_publication = base_url_front+'Research/loadPublicationData';
        $.ajax({
            url: url_publication,
            method: 'POST',
            dataType: 'text',
            cache: false,
            data: {
                'topics': topic_publication,
                'start': start_publications,
                'limit': limit_publications,
            },
            success: function(response) {
                if (response == "") {
                    $('#ldmrPublications').addClass('d-none');
                } else {
                    $("#ldmrPublications").html("Load more");
                    start_publications += limit_publications;
                    $('#resultPublicationsData').append(response);

                }
            }
        });
    }
    var article_type = 'news';
    var uri = $('#uri').val();

    var start_recent = 0;
    var limit_recent = 4;
    getPostDataRecentArticle(article_type, uri, start_recent, limit_recent);

    $('#loadMoreRecentArticle').on('click', function() {
        var article_type = 'news';
        var uri = $('#uri').val();

        start_recent += limit_recent;
        getPostDataRecentArticle(article_type, uri, start_recent, limit_recent);
    });

    function getPostDataRecentArticle(article_type, uri, start_recent, limit_recent) {
        var url_recent = base_url_front+'Research/loadRecentArticles'
        $.ajax({
            url: url_recent,
            method: 'POST',
            dataType: 'text',
            cache: false,
            data: {
                article_type: article_type,
                uri: uri,
                start: start_recent,
                limit: limit_recent,
            },
            success: function(response) {
                if (response == "") {
                    // $(".loader-image").hide();
                    $('#loadMoreRecentArticle').addClass('d-none');
                } else {
                    $("#loadMoreRecentArticle").html("Load more");
                    start_recent += limit_recent;
                    // $(".loader-image").show();
                    $("#searchResultRecentArticle").append(response);
                }
            }
        });
    }
});
