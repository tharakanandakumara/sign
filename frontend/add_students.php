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
                        <h1>Add Students</h1>
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

            <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                    <span class="badge badge-pill badge-success">Success</span> You successfully read this important alert message.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

            <form id="studentreg" enctype="multipart/form-data">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="notify_panel3"></div>
                        <h3 class="register-heading">Student Registration</h3>
                        <div class="row register-form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="indexNo" type="number" class="form-control" placeholder="Index No *" value="" required>
                                </div>
                                <div class="form-group">
                                    <input name="initials" type="text" class="form-control" placeholder="Initials *" value="" required>
                                </div>
                                <div class="form-group">
                                    <input name="lastName" type="text" class="form-control" placeholder="Last Name *" value="" required>
                                </div>
                                <div class="form-group">
                                    <input name="fullName" type="text" class="form-control" placeholder="Full Name *" value="" required>
                                </div>

                                <div class="form-group">
                                    <input type="file" name="photo" id="fileSelect" accept="image/*">
                                </div>
                                <div class="form-group">
                                    <label for="dob">DOB</label>
                                    <input name="DOB" id="dob " type="date" class="form-control" value="" required>
                                </div>
                                <div class="form-group">
                                    <input name="address" type="text" class="form-control" placeholder="Adress *" value="" required>
                                </div>
                                <div class="form-group">
                                    <div class="maxl">
                                        <label class="radio inline">
                                            <input type="radio" name="gender" value="male" checked>
                                            <span> Male </span>
                                        </label>
                                        <label class="radio inline">
                                            <input type="radio" name="gender" value="female">
                                            <span>Female </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <select name="grade" class="form-control" required>
                                            <option value="" class="hidden" selected disabled> Grade</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <input name="class" type="text" class="form-control" placeholder="Section/Class" value="" required>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <select name="medium" class="form-control" required>
                                        <option value="" class="hidden" selected disabled> Medium</option>
                                        <option value="Sinhala">Sinhala</option>
                                        <option value="English">English</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="number" minlength="10" maxlength="10" name="homeTel" class="form-control" placeholder="Home Tel *" value="" required>
                                </div>
                                <div class="form-group">
                                    <input name="guardianName" type="text" class="form-control" placeholder="Guardian Name" value="">
                                </div>
                                <div class="form-group">
                                    <input name="guardianAddress" type="text" class="form-control" placeholder="Guardian Adress" value="">
                                </div>
                                <div class="form-group">
                                    <input name="guardianRelationship" type="text" class="form-control" placeholder="Guardian Relationship" value="">
                                </div>
                                <div class="form-group">
                                    <input name="guardianContact" type="text" class="form-control" placeholder="Guardian Contact" value="">
                                </div>

                                <input type="submit" class="btnRegister" value="Register" />
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <h3 class="register-heading">Apply as a Hirer</h3>
                        <div class="row register-form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="First Name *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Last Name *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="text" maxlength="10" minlength="10" class="form-control" placeholder="Phone *" value="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password *" value="" />
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Confirm Password *" value="" />
                                </div>
                                <div class="form-group">
                                    <select class="form-control">
                                        <option class="hidden" selected disabled>Please select your Sequrity Question</option>
                                        <option>What is your Birthdate?</option>
                                        <option>What is Your old Phone Number</option>
                                        <option>What is your Pet Name?</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="`Answer *" value="" />
                                </div>
                                <input type="submit" class="btnRegister" value="Register" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>



        </div><!-- /#right-panel -->

        <!-- Right Panel -->
        <script src="js/jquerymin.js"></script>
        <script type="text/javascript" src="js/jquery.serializejson.min.js"></script>

        <script type="text/javascript" src="js/noty.min.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="properties.js"></script>
        <!--
        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
        <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="assets/js/main.js"></script>


        <script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
        <script src="assets/js/dashboard.js"></script>
        <script src="assets/js/widgets.js"></script>
        <script src="vendors/jqvmap/dist/jquery.vmap.min.js"></script>
        <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
        <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script> -->

        <script>
            /* stop form from submitting normally */
            var web_token = "<?php echo $_SESSION['token'] ?>";
            var auth = "BEARER " + web_token;
            var fileInput = document.getElementById('fileSelect');
            var file = fileInput.files[0];
            var data = new FormData(this);
            data.append('file', file);

            // POST Request to add User
            $("#studentreg").submit(function(event) {
                event.preventDefault();

                uploadImage();



            });

            function uploadImage() {

                $.ajax({
                    type: "POST",
                    url: "image_upload_manager.php",
                    contentType: false,
                    cache: false,
                    processData: false,
                    data:  new FormData(studentreg),

                    // Update Url
                    success: function(response) { // Setting Token

                        if (response) {
                            if (response == "Your file was uploaded successfully") {
                                notifyMe('.notify_panel3', response, '1');
                                uploadForm();

                            } else {
                                console.log("Data " + data);
                                var res = response.split(':');
                                notifyMe('.notify_panel', res[1], '0');
                                console.log(response);
                                //error notification here
                            }

                        } else {
                            // notifyMe('.notify_panel', 'Invalid Credentials Entered', '0');
                        }
                    },
                    statusCode: {
                        404: function() {
                            //notifyMe('.notify_panel', 'Invalid Username', '0');
                        },
                        401: function() {
                            //notifyMe('.notify_panel', 'Invalid password', '0');
                        }
                    }
                });
            }

            function uploadForm() {
                $.fn.serializeObject = function() {
                    var o = {};
                    var a = this.serializeArray();
                    $.each(a, function() {
                        if (o[this.name] !== undefined) {
                            if (!o[this.name].push) {
                                o[this.name] = [o[this.name]];
                            }
                            o[this.name].push(this.value || '');
                        } else {
                            o[this.name] = this.value || '';
                        }
                    });
                    return o;
                };
                var data = JSON.stringify($('#studentreg').serializeObject());
                console.log("data: " + data)

                $.ajax({
                    type: "POST",
                    url: gOptions.serverUrl + ":3000/protected/students",
                    data: data,
                    dataType: 'json',
                    headers: {
                        Authorization: auth
                    },
                    contentType: 'application/json;charset=UTF-8',
                    success: function(response) {
                        if (response.indexNo != null) {
                            notifyMe('.notify_panel3', 'User added', '1');
                            $('#studentreg')[0].reset();
                        }
                        console.log("Success: ", response)
                    },
                    error: function(err) {
                        notifyMe('.notify_panel3', 'User not added :' + err, '0');
                        alert(err);
                    },
                });
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

            function convertDate(dateval) {
                var date = new Date(dateval);
                var day = date.getDate();
                var year = date.getFullYear();
                var month = date.getMonth() + 1;
                var dateStr = month + "/" + day + "/" + year;
                return dateStr;
            }

        </script>

</body>

</html>
