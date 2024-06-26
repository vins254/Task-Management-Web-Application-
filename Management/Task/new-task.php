<?php

include"../database/connect.php";

if(isset($_POST["submit"])) {
    $name = $_POST['name'];
    $status = $_POST['status'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $project_manager = $_POST['project_manager'];
    $team_members = $_POST['team_members'];
    $description = $_POST['description'];

    $sql = "INSERT INTO `project`(`id`, `name`, `status`, `from_date`, `to_date`, `project_manager`, `team_members`, `description`) 
    VALUES (NULL,'$name','$status','$from_date','$to_date','$project_manager','$team_members','$description')";

    $result =mysqli_query($conn, $sql);
    if ($result) {
        session_start();
        $_SESSION["submit"] = "User Added Successfully";
        header("Location:../Projects/project-list.php");
    }
    else {
        echo "Failed: " . mysqli_error($conn);
    }
}
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <style><?php include('../CSS/new-task.css'); ?></style>
</head>
<body>
<div class="wrapper">
    <h3>New Project</h3>
    <form action="" method="post">
        <div class="input-box">
            <div class="input-field">
                <label for="" class="name">Task</label>
                <input type="text" name="name" id="name">
            </div>

            <div class="input-field">
					<label for="" class="description">Description</label>
					<textarea name="description" id="" cols="50" rows="10" class="form-control">
					</textarea>
				</div>

                <div class="input-field">
                    <label for="" class="status">Status</label>
                    <select name="status" id="status">
                        <option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Pending</option>
						<option value="3" <?php echo isset($status) && $status == 3 ? 'selected' : '' ?>>On-Hold</option>
						<option value="5" <?php echo isset($status) && $status == 5 ? 'selected' : '' ?>>Done</option>
                    </select>
                </div>
                <div class="btn">
                    <input type="submit" value="Save" name="submit">
                    <input type="reset" value="Cancel" name="cancel">
                </div>
                </div>
                
            </div>
        </form>
    </div>













</body>
</html>