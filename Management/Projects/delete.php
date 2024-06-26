<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    include("../database/connect.php");
    $sql = "DELETE FROM project WHERE id = '$id'";
    if(mysqli_query($conn, $sql)) {
        session_start();
        $_SESSION["delete"] = "Project Deleted Successfully";
        header("Location:../Projects/project-list.php");
    }
}


?>