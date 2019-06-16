<?php
// Check if the form was submitted
require 'aws/aws-autoloader.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
if($_SERVER["REQUEST_METHOD"] == "POST"){
   
    // Check if file was uploaded without errors
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
        $allowed =array("jpeg","jpg","png");
        $filename = $_POST["indexNo"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];
    $pos = strrpos($filename, '.');
if ($pos === false) 
{
    // file has no extension; do something special?
    $ext = ".jpg";
}
else
{
    // includes the period in the extension; do $pos + 1 if you don't want it
    $ext = substr($filename, $pos);
}
         $filename = $_POST["indexNo"].$ext;
       
         $newFilename = "test" . $ext;
        // Verify file extension
       
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $tmpd=explode('.',$_FILES['photo']['name']);
       $ext=strtolower(end($tmpd));
        if(in_array($ext, $allowed)=== false){
         die("E1100 : Please select a valid file format.");
      }
        
    
        // Verify file size - 5MB maximum
        $maxsize = 10 * 1024 * 1024;
        if($filesize > $maxsize) die("E1200 : File size is larger than the allowed limit.");
    
        // Verify MYME type of the file
        if(in_array($ext, $allowed)){
            // Check whether file exists before uploading it
            if(file_exists("../upload/" . $filename)){
                echo "E1300 : ".$filename . " is already exists.";
            } else{
                move_uploaded_file($_FILES["photo"]["tmp_name"], "../upload/" . $filename);
                
                // Uploading to Amazon
                
                    
    
    $bucketName = 'jvaz-images';
	$filePath = $filename;
	$keyName = basename($filePath);
	$IAM_KEY = 'AKIA5VMUHW55VXEZACTN';
	$IAM_SECRET = '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';
	
	// Set Amazon S3 Credentials
	$s3 = S3Client::factory(
		array(
			'credentials' => array(
				'key' => $IAM_KEY,
				'secret' => $IAM_SECRET
			),
			'version' => 'latest',
			'region'  => 'us-east-1'
		)
	);
  
  // The region matters. I'm using "US Ohio" so "us-east-2" is the corresponding
  // region code. You can google it or upload a file to the S3 bucket and look at
  // the public url. It will look like:
  // https://s3.us-east-2.amazonaws.com/YOUR_BUCKET_NAME/image.png
  // 
  // As you can see the us-east-2 in the url.
	try {
		// So you need to move the file on $filePath to a temporary place.
		// The solution being used: http://stackoverflow.com/questions/21004691/downloading-a-file-and-saving-it-locally-with-php
		if (!file_exists('/tmp/tmpfile')) {
			mkdir('/tmp/tmpfile',0777, true);
		}
		
		// Create temp file
		$tempFilePath = '../upload/' . $filename;
	
		// Put on S3
		$s3->putObject(
			array(
				'Bucket'=>$bucketName,
				'Key' =>  $keyName,
				'SourceFile' => $tempFilePath,
				'StorageClass' => 'REDUCED_REDUNDANCY'
			)
		);
        echo "Your file was uploaded successfully";
	} catch (S3Exception $e) {
         echo $e->getMessage();
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
               
            } 
        } else{
            echo "E1400 : There was a problem uploading your file. Please try again."; 
        }
    } else{
        echo "photo".$_FILES["photo"]; 
        echo "E1500 : " . $_FILES["photo"]["error"];
    }

}
?>
