<?php 
    session_start();
//include 'logout.php';
//$_SESSION['token']=null;

    if(!isset($_SESSION['token'])){
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
    <title>Grade Monthly Report</title>
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
    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <?php include 'includes/header.php' ?>
        <!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-6">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Attendence By Grade - Monthly Report</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">

            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                    <span class="badge badge-pill badge-success">Success</span> You successfully read this important alert message.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

            <div class="col-xl-8">
                <section id="chartCard" class="card">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-3">Attendence by Grade </h4>
                                <canvas id="class-chart"></canvas>
                            </div>
                        </div>
                    </div>


                </section>

                <!--<section class="card">
                    <div class="twt-feed blue-bg">
                        <div class="corner-ribon black-ribon">
                            <i class="fa fa-user"></i>
                        </div>
                        

                        <div class="media">
                            <a href="#">
                                <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="images/admin.jpg">
                            </a>
                            <div class="media-body">
                                <h2 class="text-white display-6">Jim Doe</h2>
                                <p class="text-light">Student</p>
                            </div>
                        </div>
                    </div>
                    <div class="weather-category twt-category">
                        <ul>
                            <li class="active">
                                <h5>24</h5>
                                Presents
                            </li>
                            <li>
                                <h5>10 B</h5>
                                Class
                            </li>
                            <li>
                                <h5>3645</h5>
                                Followers
                            </li>
                        </ul>
                    </div>
                  

                </section>-->
            </div>




            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <span id="selectionErrors"></span>
                        <div class="stat-widget-one">

                            <div class="stat-icon dib"><i class="fa fa-map-signs text-success border-success"></i>
                                <h5 id="attendenceDate" class="card-title">Select Year</h5>
                            </div>
                            <select class="form-control" id="year" onchange="selectedYear()">
                                <option>Year</option>

                            </select>
                            <div id="monthCard" style="display:none">
                                <div class="stat-icon dib"><i class="fa fa-map-signs text-success border-success"></i>
                                    <h5 id="attendenceDate" class="card-title">Select Month</h5>
                                </div>
                                <select class="form-control" id="month" onchange="selectedMonth()">

                                </select>
                            </div>
                            <div id="gradeCard" style="display:none">
                                <div class="stat-icon dib"><i class="fa fa-map-signs text-success border-success"></i>
                                    <h5 id="attendenceDate" class="card-title">Select Grade</h5>
                                </div>
                                <select class="form-control" id="grade">
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

                    </div>
                    <input id="fetchReports" type="submit" class="btnRegister" value="Fetch Reports" />
                </div>
            </div>






            <div class="content mt-3">
                <div class="animated fadeIn">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong class="card-title">Student Attendece Report</strong>
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
                </div><!-- .animated -->
            </div><!-- .content -->





        </div><!-- /#right-panel -->
        <script>
            /* stop form from submitting normally */
            var web_token = "<?php echo $_SESSION['token'] ?>";
            var auth = "BEARER " + web_token;
            document.getElementById("fetchReports").disabled = true;

        </script>
        <!-- Right Panel -->
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
                document.getElementById("monthCard").style.display = "none";
                
                yearGenerator();

                var selectedDate;

                function logEvent(type, date) {
                    $("<div class='log__entry'/>").hide().html("<strong>" + type + "</strong>: " + date).prependTo($('#eventlog')).show(200);
                }
                $('#clearlog').click(function() {
                    $('#eventlog').html('');
                });
                $("#fetchReports").click(function() {
                    
                    var month=$('#month').val();
                    var year=$('#year option:selected').text();
                    var grade=$('#grade option:selected').text();
                    month="0"+(parseInt(month)+1);
                    var fromDate=""+year+"-"+month+"-01";
                    var toDate=""+year+"-"+month+"-31";
                    console.log(fromDate);
                    console.log(month+year)

                    getDatabyMonth(fromDate, toDate,grade);
                });
                $('#demo1-1').datetimepicker({
                    //date: new Date(),
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

            function selectedYear() {
                console.log("here1");
                var year = document.getElementById("year");
                var selectedYear = year.options[year.selectedIndex].value;

                if (selectedYear == "Year") {
                    console.log("here");
                    $('#selectionErrors').text('Select a Year');
                    document.getElementById("monthCard").style.display = "none";

                } else {
                   
                    $('#selectionErrors').text(' ');
                    monthGenerator(selectedYear);

                    document.getElementById("monthCard").style.display = "inherit";
                   

                }
            }
            function selectedMonth(){
                 document.getElementById("gradeCard").style.display = "inherit";
                 document.getElementById("fetchReports").disabled = false;
            }

            function yearGenerator() {
                var difference = 0;
               
                try {
                    var min = new Date().getFullYear();
                    difference = min - 2019;
                    console.log("diff" + difference);
                    if (difference < 0) {
                        $('#selectionErrors').text('Please adjust your computers date time');
                    }
                    select = document.getElementById('year');
                    for (var i = 0; i <= difference; i++) {
                        var opt = document.createElement('option');
                        opt.value = 2019 + i;
                        opt.innerHTML = 2019 + i;
                        select.appendChild(opt);
                    }
                } catch (error) {
                    console.log(error);
                    $('#selectionErrors').text('Please adjust your computers date time');
                }

            }

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

                select = document.getElementById('month');
                select.options.length = 0;
              
                var thisMonth = new Date().getMonth() - 1;
                var thisYear = new Date().getFullYear();
                console.log(month);
                if (selectedYear == thisYear) {
                    console.log("hello");
                    for (var i = 0; i <= thisMonth; i++) {
                        var opt = document.createElement('option');
                        opt.value = i;
                        opt.innerHTML = month[i];
                        select.appendChild(opt);
                    }

                } else {
                    document.getElementById("month").removeChild("option");
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
