<!--<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    include("../database/connect.php");
    $sql = "DELETE FROM project WHERE id = '$id'";
    if(mysqli_query($conn, $sql)) {
        session_start();
        $_SESSION["delete"] = "Project Deleted Successfully";
        header("Location:./project-list.php");
    }
}


?>-->

<?php
include("../database/connect.php");

$id = $_GET['id'];

// Delete tasks
$conn->query("DELETE FROM tasks WHERE project_id = $id");
// Delete project
$conn->query("DELETE FROM project WHERE id = $id");

session_start();
$_SESSION["delete"] = "Project Deleted Successfully";
header("Location:./project-list.php");
?>