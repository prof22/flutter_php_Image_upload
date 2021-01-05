<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "images_uploads";

// Create connection
try{
  $conn = new PDO("mysql:host=$server;dbname=$dbname","$username","$password");
  $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  die('Unable to connect with the database');
}
  
if(isset($_POST['submit'])){

    // Count total files
    $countfiles = count($_FILES['files']['name']);
   
    // Prepared statement
    $query = "INSERT INTO image_upload (title,images) VALUES(?,?)";
  
    $statement = $conn->prepare($query);
  
    // Loop all files
    for($i=0;$i<$countfiles;$i++){
  
      // File name
      $filename = $_FILES['files']['name'][$i];
  
      // Get extension
      @$ext = end((explode(".", $filename)));
  
      // Valid image extension
      $valid_ext = array("png","jpeg","jpg");
  
      if(in_array($ext, $valid_ext)){
  
        // Upload file
        if(move_uploaded_file($_FILES['files']['tmp_name'][$i],'uploads/'.$filename)){
  
          // Execute query
          $statement->execute(array($filename,'uploads/'.$filename));
  
        }
  
      }
   
    }
    echo "File upload successfully";
  }
?>


<form method='post' action='' enctype='multipart/form-data'>
  <input type='file' name='files[]' multiple />
  <input type='submit' value='Submit' name='submit' />
</form>