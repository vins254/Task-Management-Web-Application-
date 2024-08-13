
<?php

include"../database/connect.php";



if(isset($_POST["submit"])) {
    $task = $_POST['name'];
    $status = $_POST['status'];
    
   
    
    $description = $_POST['description'];

    $qry = "INSERT INTO `tasks`(`task`, `description`, `status`) 
    VALUES ('$task','$description','$status')";

    $result =mysqli_query($conn, $qry);
    if ($result) {
        session_start();
        $_SESSION["submit"] = "Task Added Successfully";
        header("Location:../Projects/view.php");
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
    
    <style><?php include('../CSS/view-project.css'); ?></style>
</head>
<body>
<div class="wrapper">
                    <div class="close-btn">&times;</div>
                        <h3>New Task</h3>
                        <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                        <input type="hidden" name="project_id" value="<?php echo isset($_GET['pid']) ? $_GET['pid'] : '' ?>">
                            <div class="input-box">
                                <div class="input-field">
                                    <label for="" class="name">Task</label>
                                    <input type="text" name="name" id="name" value="<?php echo isset($task) ? $task : '' ?>" required>
                                </div>

                                <div class="input-field">
					                <label for="" class="description">Description</label>
					                <textarea name="description" id="" cols="50" rows="10" class="form-control">
                                        <?php echo isset($description) ? $description : '' ?>
					                </textarea>
				                </div>

                                <div class="input-field">
                                    <label for="" class="status">Status</label>
                                    <select name="status" id="status">
                                        <option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Pending</option>
						                <option value="2" <?php echo isset($status) && $status == 2 ? 'selected' : '' ?>>On-Progress</option>
						                <option value="3" <?php echo isset($status) && $status == 3 ? 'selected' : '' ?>>Done</option>
                                    </select>
                                </div>
                                <div class="btn">
                                    <input type="submit" value="Save" name="submit">
                                    <input type="reset" value="Cancel" name="cancel">
                                </div>
                            </div>
                
                            
                        </form>
                    </div> 
                </div>










                <script type="text/javascript" src="../new_task.js"></script>



</body>
</html>