<?php
session_start();
//include 'logout.php';
//$_SESSION['token']=null;

if (!isset($_SESSION['token'])) {
    header("location: login.html");
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Joseph Vaz College Attendence System - Reports</title>
    <meta name="description" content="Joseph Vaz College Attendence System  - Reports">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="assets/css/jquery.datetimepicker.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/style_registration.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>

<body>
    <!-- Left Panel -->
    <?php include 'includes/left-menu.php' ?>

    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <?php include 'includes/header.php' ?>

        <div class="breadcrumbs">
            <div class="col-sm-6">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Daily Reports - Attendence By Class</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">

            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">

                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="fa fa-map-signs text-success border-success"></i>
                                <h5 id="attendenceDate" class="card-title">Select Date</h5>
                            </div>
                            <div class="stat-content dib">
                                <div>
                                    <span id="date-text-ymd1-1"></span>
                                </div>

                                <div id="demo1-1"></div>
                                <div id="grade_section">
                                    <div class="form-group">
                                        <div class="stat-icon dib"><i class="fa fa-map-signs text-success border-success"></i>
                                            <h5 id="attendenceDate" class="card-title"> SelectGrade </h5>
                                        </div>
                                        <select class="form-control" id="selected_grade">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                            <option>7</option>
                                            <option>8</option>
                                            <option>9</option>
                                            <option>10</option>
                                            <option>11</option>
                                            <option>12</option>
                                            <option>13</option>
                                        </select>
                                    </div>
                                </div>
                                <input id="fetchReports" type="submit" class="btnRegister" value="Fetch Reports" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <section id="chartCard" class="card">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-3">Attendence by Class</h4>
                                <canvas id="class-chart"></canvas>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header" id="report-title">
                                <strong class="card-title">Daily Attendance Report </strong>
                                <span id="report-date"></span>
                                <span id="report-grade"></span>
                            </div>
                            <div class="card-body">
                                <table id="class-daily-report-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Class</th>
                                            <th>Attendence</th>
                                        </tr>
                                    </thead>
                                    <tbody id="studentDataBody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <button id="export-report-excel" type="button" class="btn btn-success" style="margin: 5px">
                            Download Report - Excel
                        </button>
                        <button id="export-report-csv" type="button" class="btn btn-success" style="margin: 5px">
                            Download Report - CSV
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            /* stop form from submitting normally */
            var web_token = "<?php echo $_SESSION['token'] ?>";
            var auth = "BEARER " + web_token;
        </script>
        <!-- Right Panel -->
        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <script src="vendors/jquery/dist/jquery.min.js"></script>

        <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
        <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="assets/js/main.js"></script>

        <script src="assets/js/jquery.datetimepicker.js"></script>
        <script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
        <script src="assets/js/init-scripts/chart-js/chartjs-init.js"></script>
        <script src="assets/js/dashboard.js"></script>
        <script src="assets/js/widgets.js"></script>
        <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
        <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
        <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="vendors/jszip/dist/jszip.min.js"></script>
        <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
        <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        <script src="assets/js/init-scripts/data-table/datatables-init.js"></script>
        <script src="properties.js"></script>
        <!-- JS functions for fetching data from server -->
        <script src="js/class_reports.js"></script>
        <!-- Library for handle Excel export -->        
        <script src="js/xl-min.js"></script>

        <script>
            $(document).ready(function() {
                var initialSelectedGrade = '6';
                $('#selected_grade').val(initialSelectedGrade);
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();

                today = yyyy + '-' + mm + '-' + dd;
                getDataByDate(today, initialSelectedGrade);

                var selectedDate;

                function logEvent(type, date) {
                    $("<div class='log__entry'/>").hide().html("<strong>" + type + "</strong>: " + date).prependTo($('#eventlog')).show(200);
                }
                $('#clearlog').click(function() {
                    $('#eventlog').html('');
                });
                $("#fetchReports").click(function() {

                    var selectedGrade = $('#selected_grade').val();
                    getDataByDate(selectedDate, selectedGrade)
                });
                $('#demo1-1').datetimepicker({
                    date: new Date(),
                    viewMode: 'YMDHMS',
                    //date selection event
                    onDateChange: function() {
                        logEvent('onDateChange', this.getValue());
                        selectedDate = this.getText('YYYY-MM-DD');
                    },
                });

                $("#export-report-excel").click(function() {
                    var reportName = $('#report-title').text() + '.xlsx';
                    exportReport('class-daily-report-table', reportName.replace(/\s/g, ''), 'xlsx');
                });

                $("#export-report-csv").click(function() {
                    var reportName = $('#report-title').text() + '.csv';
                    exportReport('class-daily-report-table', reportName.replace(/\s/g, ''), 'csv');
                });
            });
            (function($) {
                "use strict";

                jQuery('#vmap').vectorMap({
                    map: 'world_en',
                    backgroundColor: null,
                    color: '#ffffff',
                    hoverOpacity: 0.7,
                    selectedColor: '#1de9b6',
                    enableZoom: true,
                    showTooltip: true,
                    values: sample_data,
                    scaleColors: ['#1de9b6', '#03a9f5'],
                    normalizeFunction: 'polynomial'
                });
            })(jQuery);
        </script>
    </div>
</body>

</html>