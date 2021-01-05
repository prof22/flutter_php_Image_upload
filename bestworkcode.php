<?php
error_reporting(1);
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
// if(isset($_POST['submit'])){
    $image = $_FILES["image"]["name"];
    $image2 = $_FILES["image2"]["name"];
    // $image3 = $_FILES["image3"]["name"];
    $title = $_POST['title'];

  
    // Make sure you have created this directory already
    $imagePath = "uploads/".$image;
    $imagePath2 = "uploads/".$image2;
    // $imagePath3 = "uploads/".$image3;

    move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
    move_uploaded_file($_FILES["image2"]["tmp_name"], $imagePath2);
    // move_uploaded_file($_FILES["image3"]["tmp_name"], $imagePath3);

    $sql = "INSERT INTO image_upload(title,images, image2) VALUES('".$title."','".$image."','".$image2."')";
    mysqli_query($db, $sql);
// } 
    
?>

<form method='post' action='' enctype='multipart/form-data'>
 <input type="text" name="title"><br>
  <input type='file' name='image' multiple /><br>
  <input type='file' name='image2' multiple /><br>
  <input type='file' name='image3' multiple />
  <input type='submit' value='Submit' name='submit' />
</form>