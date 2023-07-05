var base_url_front = $('.base_url_front').val();
$(function() {
    $("#btnPrint").click(function() {
        var contents = $("#dvContents").html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";

        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument
            .document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html><head><title>DIV Contents</title>');
        frameDoc.document.write('</head><body>');
        //Append the external CSS file.

        frameDoc.document.write(
            '<link href="'+base_url_front+'resources/css/style.css" rel="stylesheet" type="text/css" />'
        );


        frameDoc.document.write(
            '<link href="'+base_url_front+'resources/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />'
        );

        frameDoc.document.write(
            '<link href="'+base_url_front+'resources/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />'
        );

        frameDoc.document.write(
            '<link href="'+base_url_front+'resources/plugins/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />'
        );

        frameDoc.document.write(
            '<link href="'+base_url_front+'resources/css/animate.min.css" rel="stylesheet" type="text/css" />'
        );

        frameDoc.document.write(
            '<link href="'+base_url_front+'resources/plugins/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" type="text/css" />'
        );

        frameDoc.document.write(
            '<link href="'+base_url_front+'resources/plugins/jquery-ui/smoothness/jquery-ui.min.css" rel="stylesheet" type="text/css" />'
        );

        frameDoc.document.write(
            '<link href="'+base_url_front+'resources/plugins/datatables/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />'
        );

        frameDoc.document.write(
            '<link href="'+base_url_front+'resources/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css" />'
        );



        frameDoc.document.write(
            '<link href="'+base_url_front+'resources/css/responsive.css" rel="stylesheet" type="text/css" />'
        );
        frameDoc.document.write(
            '<link href="'+base_url_front+'resources/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.min.css" rel="stylesheet" type="text/css" />'
        );

        frameDoc.document.write(
            '<link href="'+base_url_front+'resources/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet" type="text/css" />'
        );

        frameDoc.document.write(
            '<link href="'+base_url_front+'resources/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />'
        );
        //Append the DIV contents.
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function() {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
    });
});
