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
    <title>Student List</title>
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

    <style>
        .middle{
            text-align:  center;
            vertical-align: middle;
        }

        .bold{
            font-weight:  bold;
            vertical-align: middle;
        }
    </style>

</head>

<body>
    <div class="loader loader2" id="preloader"> <strong style="margin-left: 10px;">Loading Student List...</strong></div>
    <!-- Left Panel -->
    <?php include 'includes/left-menu.php' ?>
    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <?php include 'includes/header.php' ?>
        <!-- /header -->
        <!-- Header-->

        <!-- Report Table -->        
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="col-md-6" style="margin-top: 15px;">
                                    <strong class="card-title">Student List</strong>
                                </div>


                                <div class="col-md-6" style="text-align: right;">
                                    <button id="export-report-excel" type="button" class="btn btn-success" style="margin: 5px">
                                     <i class="fa fa-file-o"></i> Download Student List - Excel
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">                  
                                <table id="student-attendance" class="table table-hovered">
                                    <thead>
                                        <tr>
                                            <th class="">Student ID</th>
                                            <th class="">Full name</th>
                                            <th class="middle">Gender</th>
                                            <th class="middle">Grade</th>
                                            <th class="middle">Class</th>
                                            <th class="middle">Action</th>
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
            }, 1000); // set the time here
        });

        // get user token
        var web_token = "<?php echo $_SESSION['token'] ?>";
        var auth = "BEARER " + web_token;

        // get student data based on studentID
        $.ajax({
            type: "GET",
            url: gOptions.serverUrl + "/protected/students",
            dataType: 'json',
            contentType: 'application/json;charset=UTF-8',
            headers: {
                Authorization: auth
            },
            success: function (response) {
                //console.log("Student Profile response: ", response);
              

                // populate table:
                var i;
                var dataArray = response;
                var tbody = '';
                for (i = 0; i < dataArray.length; ++i) {
                    tbody += '<tr>';
                       tbody += '<td class="bold">'+dataArray[i].indexNo+'</td>';
                       tbody += '<td class="bold">'+dataArray[i].fullName+'</td>';
                       tbody += '<td class="middle">'+dataArray[i].gender+'</td>';
                       tbody += '<td class="middle">'+dataArray[i].grade+'</td>';
                       tbody += '<td class="middle">'+dataArray[i].section+'</td>';
                       tbody += '<td class="middle">';
                            tbody += '<a href="studentProfile.php?id='+dataArray[i].indexNo+'" title="Show student profile">';
                                tbody += '<i class="fa fa-address-card-o" style="font-size: 20px;"></i>';
                           tbody += '</a>';
                        tbody += '</td>';
                    tbody += '</tr>';
                }

                $('#student-attendance').find('tbody').html(tbody);
                $('#student-attendance').DataTable();

            },
            statusCode: {
            404: function () {
                alert('Students doesn\'t exist');
            },
        }
        });

        $("#export-report-excel").click(function() {
            var reportName = 'Student-List.xlsx';
            exportReport('student-attendance', reportName.replace(/\s/g, ''), 'xlsx');
        });

        $("#export-report-csv").click(function() {
            var reportName = 'testCSV.csv';
            exportReport('student-attendance', reportName.replace(/\s/g, ''), 'csv');
        });


    </script>

</body>

</html>
