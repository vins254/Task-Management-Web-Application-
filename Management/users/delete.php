<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    include("../database/connect.php");
    $sql = "DELETE FROM users WHERE id = '$id'";
    if(mysqli_query($conn, $sql)) {
        session_start();
        $_SESSION["delete"] = "User Deleted Successfully";
        header("Location:../users/user-list.php");
    }
}


?>