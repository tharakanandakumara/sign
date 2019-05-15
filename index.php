<?php 
    session_start();
include 'logout.php';
//$_SESSION['token']=null;
    if(!isset($_SESSION['token'])){
header("location: login.html");
    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="style.css" rel="stylesheet" id="bootstrap-css">
    <script src="js/jquerymin.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/noty.min.js"></script>

    <script type="text/javascript" src="js/jquery.serializejson.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <div class="container register">
        <div class="row">
            <div class="col-md-3 register-left">
                <img src="src/logo.jpg" alt="" />
                <h3>Welcome</h3>
                <p>Joseph Vaz College - Student Registration!</p>
                <button id="checkUser" type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">
                    Check Student
                </button>
                <button id="updateUser" type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicUpdateeModal">
                    Update Student
                </button>
                <a id="logoutBtn" href="index.php?logout=1">Log Out</a>

            </div>
            <div class="col-md-9 register-right">
                <form id="studentreg" data-toggle="validator" role="form">
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
                                                <input name="section" type="text" class="form-control" placeholder="Section/Class" value="" required>
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
            </div>
        </div>
    </div>
    <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Enter Student Index Number</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="notify_panel2"></div>
                <form id="studentreg" data-toggle="validator" role="form">
                    <div class="modal-body">

                        <div class="form-group">
                            <input id="checkIndexNumber" name="checkIndexNumber" type="text" class="form-control" placeholder="Index Number" value="" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="tag-form-submit" type="button" class="btn btn-success">Enter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="basicUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">Update Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="notify_panel"></div>
                <form id="studentupdate" data-toggle="validator" role="form">
                    <div class="modal-body">


                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                <div class="row register-form">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input id="studIndex" name="indexNo" type="number" class="form-control" placeholder="Index No *" value="">
                                        </div>
                                        <button id="indexGrabber" type="button" class="btn btn-secondary" data-dismiss="modal">Populate</button>
                                    </div>
                                    <br>
                                    <div class="col-md-6">


                                        <div class="form-group">
                                            <input name="initials" type="text" class="form-control" placeholder="Initials *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input name="lastName" type="text" class="form-control" placeholder="Last Name *" value="">
                                        </div>
                                        <div class="form-group">
                                            <input name="fullName" type="text" class="form-control" placeholder="Full Name *" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="dob">DOB</label>
                                            <input name="DOB" id="dob " type="date" class="form-control" value="">
                                        </div>
                                        <div class="form-group">
                                            <input name="address" type="text" class="form-control" placeholder="Adress *" value="" />
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
                                                    <input name="section" type="text" class="form-control" placeholder="Section/Class" value="" required>
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

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="update-form-submit" type="button" class="btn btn-primary">Enter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        /* stop form from submitting normally */
        var web_token = "<?php echo $_SESSION['token'] ?>";
        $("#studentreg").submit(function(event) {
            event.preventDefault();

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
                url: "http://localhost:3000/public/students",
                headers: {
                    'Authorization': web_token,
                },
                data: data,
                dataType: 'json',
                contentType: 'application/json;charset=UTF-8',
                success: function(response) {
                    if (response.indexNo != null) {
                        notifyMe('.notify_panel3', 'User added', '1');
                        $('#studentreg')[0].reset();
                    }
                    console.log("Success: ", msg)

                },
                error: function(err) {

                    notifyMe('.notify_panel3', 'User not added :' + err, '0');
                    alert(err);
                },
            });
        });



        $('#checkUser').click(function() {
            $('#basicExampleModal').modal({
                show: true
            });
        });
        $('#updateUser').click(function() {
            $('#basicUpdateModal').modal({
                show: true
            });
        });
        $('#update-form-submit').on('click', function(e) {

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

            var sindex = $("#studIndex").val();
            console.log(sindex);
            e.preventDefault();

            $.ajax({
                type: "PUT",
                url: "http://localhost:3000/public/students",
                data: data,
                dataType: 'json',
                contentType: 'application/json;charset=UTF-8',
                success: function(response) {
                    if (response.indexNo != null) {
                        notifyMe('.notify_panel', 'User added', '1');
                    }
                    console.log("Success: ", msg);

                },
                error: function(err) {
                    console.log("Error: ", err)
                    alert(err);
                },
            });
            return false;
        });
        $('#indexGrabber').on('click', function(e) {

            var sindex = $("#studIndex").val();
            console.log(sindex);
            e.preventDefault();
            $.ajax({
                type: "GET",
                headers: {
                    'Authorization': web_token,
                },
                url: "http://localhost:3000/protected/students/" + sindex,
                data: {

                },

                success: function(response) {
                    console.log(response)
                    if (response.indexNo != null) {
                        console.log(response)

                        populate('#studentupdate', response);

                    } else {

                        notifyMe('.notify_panel', 'User does not exist', '0');
                        $('#studentupdate')[0].reset();
                    }
                },
                error: function(err) {
                    notifyMe('.notify_panel', 'User does not exist', '0');

                    $('#studentupdate')[0].reset();
                }
            });
            return false;
        });
        $('#tag-form-submit').on('click', function(e) {
            var cindex = $("#checkIndexNumber").val();
            e.preventDefault();
            $.ajax({
                type: "GET",
                headers: {
                    'Authorization': web_token,
                },
                url: "http://localhost:3000/protected/students/" + cindex,
                data: {

                },

                success: function(response) {

                    if (response.indexNo != null) {
                        notifyMe('.notify_panel2', 'Student Exist', '1');
                    } else {
                        notifyMe('.notify_panel2', 'Student does not exist', '0');
                    }
                },
                error: function(err) {
                    notifyMe('.notify_panel2', 'Student does not exist', '0');
                }
            });
            return false;
        });
        // Populate update modal
        function populate(frm, data) {
            $.each(data, function(key, value) {
                if (key == "DOB") {
                    datevalue = convertDate(value);
                    console.log(datevalue);
                    $('#DOB').val(datevalue);

                }
                var $ctrl = $('[name=' + key + ']', frm);
                if ($ctrl.is('select')) {

                    $("option", $ctrl).each(function() {

                        if (this.value == value) {

                            this.selected = true;
                        }
                    });
                } else {
                    switch ($ctrl.attr("type")) {
                        case "text":
                        case "hidden":
                        case "textarea":
                            $ctrl.val(value);
                            break;
                        case "radio":
                        case "checkbox":
                            $ctrl.each(function() {
                                if ($(this).attr('value') == value) {
                                    $(this).attr("checked", value);
                                }
                            });
                            break;
                    }
                }
            });


        };

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
    <script src="js/notify.js"></script>
</head>

</html>
