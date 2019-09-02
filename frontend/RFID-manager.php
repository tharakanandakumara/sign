<?php
  session_start();
include 'logout.php';
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
    <title>Sufee Admin - HTML5 Admin Template</title>
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
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>RFID Manager</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
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
            <div class="col-md-6 offset-md-3">
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">Rfid Manager</h5>
                        <p class="card-text">Student should be added first.</p>
                        <form id="rfid">
                            <div class="notify_panel3"></div>
                            <div class="form-group">
                                <input id="indexno" name="indexNo" type="number" class="form-control" placeholder="Index No *" value="" required>
                            </div>
                            <div class="form-group">
                                <input id="rfidval" name="rfid" type="text" class="form-control" placeholder="rfid *" value="" required>
                            </div>
                            <input type="submit" class="btn-success" value="Add" />
                        </form>

                    </div>
                </div>



            </div>
        </div><!-- /#right-panel -->

        <!-- Right Panel -->

        <script src="../js/jquerymin.js"></script>
        <script type="text/javascript" src="../js/noty.min.js"></script>
        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
        <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="assets/js/main.js"></script>


        <script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
        <script src="assets/js/dashboard.js"></script>
        <script src="assets/js/widgets.js"></script>
        <script src="vendors/jqvmap/dist/jquery.vmap.min.js"></script>
        <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
        <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
        <script src="properties.js"></script>
        <script type="text/javascript" src="js/noty.min.js"></script>


        <script>
            $("#rfid").submit(function(event) {
                var web_token = "<?php echo $_SESSION['token'] ?>";
            var auth = "BEARER " + web_token;
                $index = $("#indexno").val();
                $rfidval = $("#rfidval").val();
                $token = "BEARER" +auth;
                if ($index == null) {


                } else {

                    event.preventDefault();


                    var jsonData = '{"rfid":"' + $rfidval + '"}'
                    //var data = JSON.stringify(jsonData);
                    console.log("data: " + jsonData)

                    var value = HttpManager(jsonData, "PUT", gOptions.serverUrl+':3000/protected/students/' + $index, $token)
                    if (value == "404") {
                        console.log("VALUE    " + value);
                        notifyMe('.notify_panel3', 'User not added : User Cannot Found', '0');
                    }if(value=="401"){
                        
                        console.log("VALUE    " + value);
                        notifyMe('.notify_panel3', 'User not added : User Cannot Found', '0');
                    }else{
                        notifyMe('.notify_panel3', 'RFID Value Entered', '1');
                    }
                    $("#indexno").val("")
                    $("#rfidval").val("")
                }

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

            function HttpManager($passed_data, $method, $url, $token) {

                var data = $passed_data;
                console.log("data:5555 " + data)
                var response_to = "";
                $.ajax({
                    type: $method,
                    url: $url,

                    data: data,
                    dataType: 'json',
                    contentType: 'application/json;charset=UTF-8',
                    async: false,
                    headers: {
                        Authorization: $token
                    },
                    success: function(response) {
                        if (response != null) {
                            return response;
                        }
                        //console.log("Success: ", msg)

                    },
                    statusCode: {
                        404: function() {
                            console.log("here");
                            //notifyMe('.notify_panel', 'Invalid Username', '0');
                            response_to = "404";
                        },
                        401: function() {
                            //notifyMe('.notify_panel', 'Invalid password', '0');
                            response_to = "401";
                        },
                        error: function(err) {
                            if (err.message != null) {
                                notifyMe('.notify_panel2', 'Student Exist', '1');
                            }
                            response_to = "error";
                        }
                    }
                });
                return response_to;

            }

            function notifyMe($classname, $message, $status) {

                if ($status == "1") {
                    statusnew = 'success';
                } else {
                    statusnew = 'error';
                }
                console.log(statusnew);
                var n = $($classname).noty({
                    text: $message,
                    theme: 'metroui',

                    type: statusnew,


                    animation: {
                        open: {
                            height: 'toggle'
                        },
                        close: {
                            height: 'toggle'
                        },
                        speed: 500
                    }
                });
                n.setTimeout(3000);
            }

        </script>

</body>

</html>
