<?php
// Check if the form was submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
   
    // Check if file was uploaded without errors
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
        // $allowed = array("xlsx" => "application/octet-stream");
        $allowed = array(
            "xls" => array( "application/vnd.ms-excel" ),
            "xlsx" => array(
                "application/vnd.ms-excel",
                "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
            )
        );
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];
    $pos = strrpos($filename, '.');
if ($pos === false) 
{
    // file has no extension; do something special?
    $ext = "";
}
else
{
    // includes the period in the extension; do $pos + 1 if you don't want it
    $ext = substr($filename, $pos);
}
         $newFilename = "test" . $ext;
        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
       
        if(!array_key_exists($ext, $allowed)) die("E1100 : Please select a valid file format.");
    
        // Verify file size - 5MB maximum
        $maxsize = 20 * 1024 * 1024;
        if($filesize > $maxsize) die("E1200 : File size is larger than the allowed limit.");
    

        // Verify MYME type of the file
      
        // if(in_array($filetype, $allowed)){

            // Check whether file exists before uploading it
            if(file_exists("upload/" . $filename)){
                echo "E1300 : ".$filename . " is already exists.";
            } else{
                
                move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/" . $newFilename);
              //echo  $_FILES['photo']['error'];
                echo "S1200 : Your file was uploaded successfully :".$newFilename;
            } 
    
    } else{
        echo "E1500 : " . $_FILES["photo"]["error"];
    }
}
?>
