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

        $sql = "SELECT * FROM `category`";
       if(mysqli_query($db, $sql))
       {
          echo json_encode(['response' => "all."]);
             }else {
            echo json_encode(["error" => "Sorry, there was an error uploading your file."]); 
       }
      









?>