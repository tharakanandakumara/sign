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
    <meta name="description" content="Grade Mothly Report">
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

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <?php include 'includes/header.php' ?>

        <div class="breadcrumbs">
            <div class="col-sm-6">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Monthly Reports - Attendence By Class</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">

            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <span id="selectionErrors"></span>
                        <div class="stat-widget-one">

                            <div id="yearCard">
                                <div class="stat-icon dib"><i class="fa fa-map-signs text-success border-success"></i>
                                    <h5 id="attendenceDate" class="card-title">Select Year</h5>
                                </div>
                                <select class="form-control" id="year" onchange="selectYear()">
                                    <option>Year</option>
                                </select>
                            </div>

                            <div id="monthCard" style="display:none">
                                <div class="stat-icon dib"><i class="fa fa-map-signs text-success border-success"></i>
                                    <h5 id="attendenceDate" class="card-title">Select Month</h5>
                                </div>
                                <select class="form-control" id="month" onchange="selectMonth()">
                                    <!-- <option>Month</option> -->
                                </select>
                            </div>
                            <div id="gradeCard" style="display:none">
                                <div class="stat-icon dib"><i class="fa fa-map-signs text-success border-success"></i>
                                    <h5 id="attendenceDate" class="card-title">Select Grade</h5>
                                </div>
                                <select class="form-control" id="grade" onchange="selectGrade()">
                                    <option>Grade</option>
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

                            <div id="classCard" style="display:none">
                                <div class="stat-icon dib"><i class="fa fa-map-signs text-success border-success"></i>
                                    <h5 id="attendenceDate" class="card-title">Select Class</h5>
                                </div>
                                <select class="form-control" id="classDropdown">
                                </select>
                            </div>
                        </div>
                        <input id="fetchReports" type="submit" class="btnRegister" value="Fetch Reports" />
                    </div>
                </div>
            </div>


            <div class="col-xl-8">
                <section id="chartCard" class="card">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-3">Monthly Attendence by Date</h4>
                                <canvas id="class-chart"></canvas>
                            </div>
                        </div>
                    </div>
                </section>
            </div>



            <div class="content mt-3">
                <div class="animated fadeIn">
                    <div class="row">

                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header" id="report-title">
                                    <strong class="card-title">Monthly Attendance Report</strong>
                                    <span id="report-year"></span>
                                    <span id="report-month"></span>
                                    <span id="report-class"></span>
                                </div>
                                <div class="card-body">
                                    <table id="class-monthly-report-table" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
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
        </div>

        <script>
            /* stop form from submitting normally */
            var web_token = "<?php echo $_SESSION['token'] ?>";
            var auth = "BEARER " + web_token;
            document.getElementById("fetchReports").disabled = true;
        </script>
        <!-- Right Panel -->
        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <!-- JS functions for fetching data from server -->
        <script src="js/class_reports.js"></script>
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
        <!-- Library for handle Excel export -->
        <script src="js/xl-min.js"></script>

        <script>
            $(document).ready(function() {
                document.getElementById("monthCard").style.display = "none";

                // generate the select year dropdown
                yearGenerator();

                $("#fetchReports").click(function() {

                    var month = $('#month').val();
                    var year = $('#year option:selected').text();
                    var grade = $('#grade option:selected').text();
                    var selectedClass = $('#classDropdown option:selected').text();
                    var month = parseInt(month) < 9 ? "0" + (parseInt(month) + 1) : (parseInt(month) + 1);
                    var fromDate = "" + year + "-" + month + "-01";
                    var toDate = "" + year + "-" + month + "-31";
                    console.log("fromDate: ", fromDate);
                    console.log("month, year: ", month + year)

                    getDataByMonth(fromDate, toDate, year, month, selectedClass);
                });

                $("#export-report-excel").click(function() {
                    var reportName = $('#report-title').text() + '.xlsx';
                    exportReport('class-monthly-report-table', reportName.replace(/\s/g, ''), 'xlsx');
                });

                $("#export-report-csv").click(function() {
                    var reportName = $('#report-title').text() + '.csv';
                    exportReport('class-monthly-report-table', reportName.replace(/\s/g, ''), 'csv');
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

            function selectYear() {
                console.log("selectYear function");
                var year = document.getElementById("year");
                var selectedYear = year.options[year.selectedIndex].value;

                if (selectedYear == "Year") {
                    $('#selectionErrors').text('Select an year');
                    document.getElementById("monthCard").style.display = "none";
                    document.getElementById("gradeCard").style.display = "none";
                    document.getElementById("classCard").style.display = "none";
                } else {
                    $('#selectionErrors').text(' ');
                    monthGenerator(selectedYear);
                    document.getElementById("monthCard").style.display = "inherit";
                    document.getElementById("gradeCard").style.display = "inherit";
                }
            }

            function selectMonth() {
                console.log("selectMonth function");
                // var month = document.getElementById("month");
                // var selectedMonth = month.options[month.selectedIndex].value;

                // if (selectedMonth == "Month") {
                // $('#selectionErrors').text('Select a month');
                // document.getElementById("gradeCard").style.display = "none";
                // document.getElementById("classCard").style.display = "none";
                // } else {
                // $('#selectionErrors').text(' ');
                // document.getElementById("gradeCard").style.display = "inherit";
                // }
            }

            function selectGrade() {
                console.log("selectGrade function");
                var grade = document.getElementById("grade");
                var selectedGrade = grade.options[grade.selectedIndex].value;

                if (selectedGrade == "Grade") {
                    $('#selectionErrors').text('Select a grade');
                    document.getElementById("classCard").style.display = "none";
                } else {
                    $('#selectionErrors').text(' ');
                    document.getElementById("classCard").style.display = "inherit";
                    var classDropdown = document.getElementById("classDropdown");
                    classGenerator(selectedGrade, classDropdown);
                    document.getElementById("fetchReports").disabled = false;
                }
            }

            /**
             * function to generate years and append to select year dropdown
             */
            function yearGenerator() {
                // difference of years from 2019
                var difference = 0;
                try {
                    var min = new Date().getFullYear();
                    difference = min - 2019;
                    if (difference < 0) {
                        $('#selectionErrors').text("Please adjust your computer's date/time");
                    }
                    var select = document.getElementById('year');
                    for (var i = 0; i <= difference; i++) {
                        var opt = document.createElement('option');
                        opt.value = 2019 + i;
                        opt.innerHTML = 2019 + i;
                        select.appendChild(opt);
                    }
                } catch (error) {
                    console.log("error: ", error)
                    $('#selectionErrors').text("Please adjust your computer's date/time");
                }
            }

            /**
             * function to generate months and append to select month dropdown
             */
            function monthGenerator(selectedYear) {

                var month = new Array();
                month[0] = "January";
                month[1] = "February";
                month[2] = "March";
                month[3] = "April";
                month[4] = "May";
                month[5] = "June";
                month[6] = "July";
                month[7] = "August";
                month[8] = "September";
                month[9] = "October";
                month[10] = "November";
                month[11] = "December";

                var select = document.getElementById('month');
                select.options.length = 0;

                // get reports from last month
                // var thisMonth = new Date().getMonth() - 1;

                // get reports from this month
                var thisMonth = new Date().getMonth();

                var thisYear = new Date().getFullYear();
                if (selectedYear == thisYear) {
                    for (var i = 0; i <= thisMonth; i++) {
                        var opt = document.createElement('option');
                        opt.value = i;
                        opt.innerHTML = month[i];
                        select.appendChild(opt);
                    }
                } else {
                    // document.getElementById("month").removeChild("option");
                    for (var i = 0; i <= 11; i++) {
                        var opt = document.createElement('option');
                        opt.value = i;
                        opt.innerHTML = month[i];
                        select.appendChild(opt);
                    }
                }
            }
        </script>
</body>

</html>