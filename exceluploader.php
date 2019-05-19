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
                <img src="src/Logo.jpg" alt="" />
                <h3>Welcome</h3>
                <p>Joseph Vaz College - Student Registration</p>
                <button id="checkUser" type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">
                    Check Student
                </button>
                <button id="updateUser" type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicUpdateeModal">
                    Update Student
                </button>
                <button id="updateUser" type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicUpdateeModal">
                    Upload Excel
                </button>
                <br>
                <a id="logoutBtn" href="index.php?logout=1">Log Out</a>

            </div>
            <div class="col-md-9 register-right">
                <div class="notify_panel"></div>
                <form id="uploader" caction="upload-manager.php" method="post" enctype="multipart/form-data">
                    <h2>Upload File</h2>
                    <label for="fileSelect">Filename:</label>
                    <input type="file" name="photo" id="fileSelect" class="form-control">
                    <div class="form-group">
                        <button id="uploadBtn" type="submit" class="btn btn-primary login-btn btn-block">Upload</button>
                    </div>
                    <p><strong>Note:</strong> Only .xlsx file format allowed to a max size of 5 MB.</p>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('#uploader').submit(function(e) {
            e.preventDefault();


            $.ajax({
                type: "POST",
                url: "upload-manager.php",
                contentType: false,
                cache: false,
                processData: false,
                data: new FormData(this),
                // Update Url
                success: function(response) { // Setting Token

                    if (response) {
                        if (response == "Your file was uploaded successfully") {
                            console.log(response);
                            xltojson();
                        } else {
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
            //console.log("token : " + token);

            return false;
        });

        function xltojson() {
            var url = "http://ec2-18-234-208-163.compute-1.amazonaws.com/upload/test.xlsx";
            var oReq = new XMLHttpRequest();
            oReq.open("GET", url, true);
            oReq.responseType = "arraybuffer";

            oReq.onload = function(e) {
                var arraybuffer = oReq.response;

                /* convert data to binary string */
                var data = new Uint8Array(arraybuffer);
                var arr = new Array();
                for (var i = 0; i != data.length; ++i) arr[i] = String.fromCharCode(data[i]);
                var bstr = arr.join("");

                /* Call XLSX */
                var workbook = XLSX.read(bstr, {
                    type: "binary"
                });

                /* DO SOMETHING WITH workbook HERE */
                var first_sheet_name = workbook.SheetNames[0];
                /* Get worksheet */
                var worksheet = workbook.Sheets[first_sheet_name];
                var json = XLSX.utils.sheet_to_json(worksheet, {
                    raw: true
                })
                //json="{students:"+json+"}";
                console.log(JSON.stringify({
                    'students': json
                }));
                dataPoster(JSON.stringify({
                    'students': json
                }));
            }

            oReq.send();
        }

        function dataPoster(datatoPost) {
            $.ajax({
                type: "POST",
                url: "http://ec2-18-234-208-163.compute-1.amazonaws.com:3000/public/students/multiple",
                dataType: 'json',
                data: datatoPost,
                contentType: 'application/json;charset=UTF-8',
                // Update Url

                success: function(response) { // Setting Token

                    if (response) {
                        notifyMe('.notify_panel', response.message, '1');
                        deleteFile();
                    } else {
                        notifyMe('.notify_panel', 'Invalid Credentials Entered', '0');
                    }
                },
                statusCode: {
                    400: function(response) {
                        notifyMe('.notify_panel', response.responseJSON.message, '0');
                        deleteFile()
                    },
                    401: function(response) {
                        notifyMe('.notify_panel', response.responseJSON.message, '0');
                        deleteFile()
                    },
                    500: function(response) {
                        notifyMe('.notify_panel', response.responseJSON.message, '0');
                        deleteFile()
                    }

                }
            });
        }

        function deleteFile() {
           /* $.ajax({
                type: "POST",
                url: "deletefile.php",



                // Update Url

                success: function(response) { // Setting Token
                    console.log("deleted file")

                },
                error: function(err) {
                    console.log("delete unsuccess")
                }

            });
*/
        }

        function notifyMe($classname, $message, $status) {

            if ($status == "1") {
                statusnew = 'success';
            } else {
                statusnew = 'error';
            }

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
    <script src="js/notify.js"></script>
    <script src="js/xl-min.js"></script>
</head>

</html>
