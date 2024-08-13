<?php
include("../database/connect.php");
if(isset($_POST["edit"])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $user_role = $_POST['user_role'];
    $email = $_POST['email'];
    $id = $_POST['id'];

    $sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', user_role = '$user_role', email = '$email' WHERE id = '$id'";

    $result =mysqli_query($conn, $sql);
    if ($result) {
        session_start();
        $_SESSION["edit"] = "User Updated Successfully";
        header("Location:../users/user-list.php");
    }
    else {
        die("Error updating");
    }
}
?>
