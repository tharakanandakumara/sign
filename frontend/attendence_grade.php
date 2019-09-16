<?php
session_start();
//include 'logout.php';
//$_SESSION['token']=null;

if (!isset($_SESSION['token'])) {
    header("location: login.html");
}
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Joseph Vaz College - Admin Dashboard</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
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
                        <h1>Daily Reports - Attendence By Grade</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="row" >
                <div class="col-md-4">
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
                                    <input id="fetchReports" type="submit" class="btnRegister" value="Fetch Reports" />

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <section id="chartCard" class="card">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mb-3">Attendence by Grade </h4>
                                    <canvas id="team-chart"></canvas>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Student Attendance Report</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Grade</th>
                                            <th>Attendence</th>
                                        </tr>
                                    </thead>
                                    <tbody id="studentDataBody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script>
            /* stop form from submitting normally */
            var web_token = "<?php echo $_SESSION['token'] ?>";
            var auth = "BEARER " + web_token;
        </script>

        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <script src="attendence_get.js"></script>
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
        <script>
            $(document).ready(function() {
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();

                today = yyyy + '-' + mm + '-' + dd;
                getDataByDate(today, today);

                var selectedDate;

                function logEvent(type, date) {
                    $("<div class='log__entry'/>").hide().html("<strong>" + type + "</strong>: " + date).prependTo($('#eventlog')).show(200);
                }
                $('#clearlog').click(function() {
                    $('#eventlog').html('');
                });
                $("#fetchReports").click(function() {
                    getDataByDate(selectedDate, selectedDate)
                });
                $('#demo1-1').datetimepicker({
                    date: new Date(),
                    viewMode: 'YMDHMS',
                    //date selection event
                    onDateChange: function() {
                        logEvent('onDateChange', this.getValue());
                        // getDataByDate((this.getText('YYYY-MM-DD')), (this.getText('YYYY-MM-DD')))
                        selectedDate = this.getText('YYYY-MM-DD');
                    },
                    //clear button click event
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