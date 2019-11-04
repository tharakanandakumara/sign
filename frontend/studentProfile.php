<?php
session_start();

include 'logout.php';

if (!isset($_SESSION['token'])) {
    header("location: login.html");
}
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Student Profile</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="css/spinner.css">
     <link rel="stylesheet" href="vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">


    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>
    <div class="loader loader2" id="preloader"> <strong style="margin-left: 10px;">Loading Student Profile...</strong></div>
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
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><strong>Student Profile</strong></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active"><a href="studentList.php">Search for next student <i class="fa fa-arrow-right"></i></a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student Profile -->
        <div class="content mt-3">
            <div class="col-xl-4">
                <section class="card">
                    <div class="twt-feed blue-bg">
                        <div class="corner-ribon black-ribon">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="media">
                            <a href="#">
                                <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="images/no-image.jpg">
                            </a>
                            <div class="media-body">
                                <h2 class="text-white display-6"><span id="fullname"></span></h2>
                                <p class="text-light">Student (<span id="gender"></span>)</p>
                            </div>
                        </div>
                    </div>
                    <div class="weather-category twt-category">
                        <ul>
                            <li>
                                <h5 id="presents">0</h5>
                                Presents
                            </li>
                            <li>
                                <h5 id="grade"></h5>
                                Grade
                            </li>
                            <li style="border-right: none;">
                                <h5 id="class"></h5>
                                Class
                            </li>
                        </ul>
                    </div>
                </section>
            </div>  

            <div class="col-xl-4 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib" style="margin-bottom: 0px;"><i class="ti-user text-primary border-primary"></i></div>
                            <div class="stat-icon dib" style="margin-top: 15px; margin-left: 5px; margin-bottom: 0px;">
                                <div><h3 class="display-6">Personal information</h3></div>
                            </div>
                            <hr>
                            <div class="dib">
                                <p><strong>Address:</strong> <span id="address"></span></p>
                                <p><strong>Contact No.:</strong> <span id="contact"></span></p>
                                <p><strong>DoB:</strong> <span id="dod"></span></p>
                                <p><strong>Initials:</strong> <span id="initials"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib" style="margin-bottom: 0px;"><i class="fa fa-book text-primary border-primary"></i></div>
                            <div class="stat-icon dib" style="margin-top: 15px; margin-left: 5px; margin-bottom: 0px;">
                                <div><h3 class="display-6">College information</h3></div>
                            </div>
                            <hr>
                            <div class="dib">
                                <p><strong>Student ID:</strong> <span id="indexNo"></span></p>
                                <p><strong>Grade:</strong> <span id="_grade"></span></p>
                                <p><strong>Class:</strong> <span id="_class"></span></p>
                                <p><strong>Language:</strong> <span id="language"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Report Table -->        
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="col-md-6" style="margin-top: 15px;">
                                    <strong class="card-title">Student Attendance Report</strong>
                                </div>


                                <div class="col-md-6" style="text-align: right;">
                                    <button id="export-report-excel" type="button" class="btn btn-success" style="margin: 5px">
                                     <i class="fa fa-file-o"></i> Download Report - Excel
                                    </button>
                                    <button id="export-report-csv" type="button" class="btn btn-success" style="margin: 5px">
                                     <i class="fa fa-file-o"></i> Download Report - CSV
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">                  
                                <table id="student-attendance" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Created on</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->

        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
     <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
      <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/js/init-scripts/data-table/datatables-init.js"></script>

    <!-- Library for handle Excel export -->        
    <script src="js/xl-min.js"></script>
    <script src="attendence_get.js"></script> 
    <script src="properties.js"></script>
    <script>

        $(window).load(function() {
            setTimeout(function() {
                $('#preloader').fadeOut('slow', function() {});
            }, 100); // set the time here
        });
       


        function urlParam(name){
            var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
            return results[1] || 0;
        }
        
        // get student id from URL
        var studentID = urlParam('id');

        // get user token
        var web_token = "<?php echo $_SESSION['token'] ?>";
        var auth = "BEARER " + web_token;

        // TODO: some security check for correct index number (lenght, isNumeric...)
        console.log(studentID);

        // get student data based on studentID
        $.ajax({
            type: "GET",
            url: gOptions.serverUrl + "/protected/students/"+studentID+"/attendance",
            dataType: 'json',
            contentType: 'application/json;charset=UTF-8',
            headers: {
                Authorization: auth
            },
            success: function (response) {
                //console.log("Student Profile response: ", response);
                //console.log(studentID);

                // Student POPULATING:
                $('#fullname').html(response.fullName);
                $('#gender').html(response.gender);
                $('#presents').html(response.attendance.length);
                $('#grade').html(response.grade);
                $('#class').html(response.section);

                // Personal Info populating
                $('#address').html(response.address);
                $('#contact').html(response.contactNo1);

                var date = new Date(response.DOB);
                $('#dod').html(date.getFullYear()+"/"+date.getMonth()+"/"+date.getDay());
                $('#initials').html(response.nameWithInitials);

                // College Info populating
                $('#indexNo').html(response.indexNo);
                $('#_grade').html(response.grade);
                $('#_class').html(response.section);
                $('#language').html(response.medium);

                // populate table:
                var i;
                var dataArray = response.attendance;
                var tbody = '';
                for (i = 0; i < dataArray.length; ++i) {

                    // attendance date:
                    var attendanceDate = new Date(dataArray[i].date);
                    attendanceDate = attendanceDate.getFullYear()+"/"+attendanceDate.getMonth()+"/"+attendanceDate.getDay();

                    var createdOn = new Date(dataArray[i].timestamp);
                    createdOn = createdOn.getFullYear()+"/"+createdOn.getMonth()+"/"+createdOn.getDay()+" "+createdOn.getHours()+":"+createdOn.getMinutes()+":"+createdOn.getSeconds();

                    tbody += '<tr>';
                        tbody += '<td>'+attendanceDate+'</td>';
                        tbody += '<td>'+dataArray[i].time+'</td>';
                        tbody += '<td>'+createdOn+'</td>';
                    tbody += '</tr>';
                }

                $('#student-attendance').find('tbody').html(tbody);
                $('#student-attendance').DataTable();

            },
            statusCode: {
            404: function () {
                alert('Student doesn\'t exist');
            },
        }
        });

        $("#export-report-excel").click(function() {
            var reportName = 'Student-Attendance-Report.xlsx';
            exportReport('student-attendance', reportName.replace(/\s/g, ''), 'xlsx');
        });

        $("#export-report-csv").click(function() {
            var reportName = 'Student-Attendance-Report.csv';
            exportReport('student-attendance', reportName.replace(/\s/g, ''), 'csv');
        });


    </script>

</body>

</html>
