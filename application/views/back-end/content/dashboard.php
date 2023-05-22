<style>
    .customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    .customers td,
    .customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    .customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .customers tr:hover {
        background-color: #ddd;
    }

    .customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
    }
</style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Work', 11],
            ['Eat', 2],
            ['Commute', 2],
            ['Watch TV', 2],
            ['Sleep', 7]
        ]);

        var options = {
            title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Year', 'Sales', 'Expenses'],
            ['2004', 1000, 400],
            ['2005', 1170, 460],
            ['2006', 660, 1120],
            ['2007', 1030, 540]
        ]);

        var options = {
            title: 'Company Performance',
            curveType: 'function',
            legend: {
                position: 'bottom'
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
    }
</script>


<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawVisualization);

    function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['Month', 'Bolivia', 'Ecuador', 'Madagascar'],
            ['2004/05', 165, 938, 522],
            ['2005/06', 135, 1120, 599],
            ['2006/07', 157, 1167, 587],
            ['2007/08', 139, 1110, 615],
            ['2008/09', 136, 691, 629]
        ]);

        var options = {
            title: 'ERIA Dashboard',
            vAxis: {
                title: 'Cups'
            },
            hAxis: {
                title: 'Month'
            },
            seriesType: 'bars',
            series: {
                5: {
                    type: 'line'
                }
            }
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>


<section id="main-content" class=" ">
    <section class="wrapper main-wrapper">



        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>


            <?php $this->load->view('back-end/common/message'); ?>



            <div class="page-title">

                <div class="pull-left">
                    <h1 class="title"><?php  //var_dump($summery);

                                        ?>Dashboard</h1>
                </div>


            </div>
        </div>



        <!--my comment-->

        <div class="clearfix"></div>




        <div class="col-lg-12">
            <section class="box nobox">
                <div class="content-body">



                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12 ">


                            <div id="piechart_" style="height: 450px">

                                <h3 class="title pull-left"> LATEST NEWS </h3>

                                <table class="customers">
                                    <tr>
                                        <th>#</th>
                                        <th> Title </th>
                                    </tr>

                                    <?php
                                    $x = 0;
                                    foreach ($areaList->result() as $areaList) {
                                        $x++;

                                    ?>
                                        <tr>
                                            <td><?= $x ?></td>
                                            <td> <?php echo $areaList->title; ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>


                            </div>

                        </div>



                        <div class="col-md-6 col-sm-6 col-xs-12 ">

                            <div style="height: 450px" id="_curve_chart">

                                <h3 class="title pull-left"> LATEST MULTIMEDIA </h3>

                                <table class="customers">
                                    <tr>
                                        <th>#</th>
                                        <th> Title </th>
                                    </tr>

                                    <?php
                                    $x = 0;
                                    foreach ($mareaList->result() as $areaList) {
                                        $x++;

                                    ?>
                                        <tr>
                                            <td><?= $x ?></td>
                                            <td> <?php echo $areaList->title; ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>

                            </div>


                        </div>


                        <div class="col-md-4 col-sm-6 col-xs-12 ">


                            <div style="height: 450px" id="chart_div_"></div>

                        </div>






                    </div>
                </div>
            </section>
        </div>

        <div class="clearfix"></div>
























    </section>
</section>
<script src="<?php echo base_url() ?>resources/js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/js/jquery.easing.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/perfect-scrollbar/perfect-scrollbar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/viewport/viewportchecker.js" type="text/javascript"></script>



<!-- CORE JS FRAMEWORK - END -->
<script src="<?php echo base_url() ?>resources/plugins/jquery-ui/smoothness/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/datepicker/js/datepicker.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/daterangepicker/js/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/daterangepicker/js/daterangepicker.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>

<script src="<?php echo base_url() ?>resources/plugins/multi-select/js/jquery.multi-select.js" type="text/javascript"></script>

<script src="<?php echo base_url() ?>resources/plugins/multi-select/js/jquery.quicksearch.js" type="text/javascript"></script>

<script src="<?php echo base_url() ?>resources/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

<script src="<?php echo base_url() ?>resources/plugins/colorpicker/js/bootstrap-colorpicker.min.js" type="text/javascript"></script>

<script src="<?php echo base_url() ?>resources/plugins/tagsinput/js/bootstrap-tagsinput.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/plugins/select2/select2.min.js" type="text/javascript"></script>

<script src="<?php echo base_url() ?>resources/plugins/typeahead/typeahead.bundle.js" type="text/javascript"></script>

<script src="<?php echo base_url() ?>resources/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>

<script src="<?php echo base_url() ?>resources/plugins/datetimepicker/js/locales/bootstrap-datetimepicker.fr.js" type="text/javascript"></script>










<!-- CORE TEMPLATE JS - START -->
<script src="<?php echo base_url() ?>resources/js/scripts.js" type="text/javascript"></script>
<!-- END CORE TEMPLATE JS - END -->

<!-- Sidebar Graph - START -->
<script src="<?php echo base_url() ?>resources/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>resources/js/chart-sparkline.js" type="text/javascript"></script>