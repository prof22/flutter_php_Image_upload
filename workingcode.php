<?php
// Database configuration
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "images_uploads";

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

if(isset($_FILES["image"]["name"])) {
  
    // Make sure you have created this directory already
    $target_dir = "uploads/";
  
    // Generate a random name 
    $target_file = $target_dir . md5(time()) . '.' . $_POST['ext'];
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    $image = $_FILES["image"]["name"];
    if($check !== false) {
        
        $sql = "INSERT INTO `image_upload` (images) VALUES ('$image')";
       if(mysqli_query($db, $sql))
       {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo json_encode(['response' => "The image has been uploaded."]);
             }else {
            echo json_encode(["error" => "Sorry, there was an error uploading your file."]); 
          }
       }else{
        echo json_encode(["error" => "Sorry,Error Connecting to database"]); 
       }
       
    } else {
        echo json_encode(["error" => "File is not an image."]);
       
    }
}
 else {
     echo json_encode(["error" => "Please provide a image to upload"]);
}








?>