<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "task_application";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn){
    die("Could not connect to the database: " . mysqli_connect_error());
}
else{
    //echo "connected successfully";
}
?>