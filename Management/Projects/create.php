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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    

    <style><?php include('../style.css'); ?></style>
    <style><?php include('../CSS/create-project.css'); ?></style>
</head>
<body>
<div class="sidebar">
        <div class="logo-details">
        <i class="fa fa-user-circle" aria-hidden="true"></i>
            <span class="logo-name">Admin</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="../index.php">
                <i class="fa fa-home" aria-hidden="true"></i>
                    <span class="link-name">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link-name" href="../index.php">Dashboard</a></li>
                </ul>
            </li>
            
            <li>
                <div class="icon-link">
                    <a href="#">
                    <i class="fa fa-users" aria-hidden="true"></i>
                        <span class="link-name">Users</span>
                    </a>
                    <i class="arrow fa fa-angle-left" aria-hidden="true"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link-name" href="#">Users</a></li>
                    <li><a href="../users/user.php">Add New</a></li>
                    <li><a href="../users/user-list.php">List</a></li>
                </ul>
            </li>

            <li>
                <div class="icon-link">
                    <a href="#">
                    <i class="fa fa-database" aria-hidden="true"></i>
                        <span class="link-name">Projects</span>
                    </a>
                    <i class="arrow fa fa-angle-left" aria-hidden="true"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link-name" href="#">Projects</a></li>
                    <li><a href="../Projects/create.php">Add New</a></li>
                    <li><a href="../Projects/project-list.php">List</a></li>
                </ul>
            </li>
            <li>
                <a href="../Task/task-list.php">
                <i class="fa fa-tasks" aria-hidden="true"></i>
                    <span class="link-name">Tasks</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link-name" href="../Task/task-list.php">Tasks</a></li>
                </ul>
            </li>
            <li>
                <a href="../Report/report.php">
                <i class="fa fa-th-list" aria-hidden="true"></i>
                    <span class="link-name">Report</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link-name" href="../Report/report.php">Report</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="home-section">
        
            <div class="home-content">
                <i class="bx-menu">xx</i>
                <span class="text">Task Management </span>
            
                <div class="user">
                    <div class="bg-img"style="background-image: url(xx)"></div>
                    <span>xx</span>
                    <span><a href="../Login/log-out.php">Logout</a></span>
                </div>
            </div>
            <div class="wrapper">
            <h3>New Project</h3>
        <form action="" method="post">
            

            <div class="input-box">
                <div class="input-field">
                    <label for="" class="name">Name</label>
                    <input type="text" name="name" id="name">
                </div>
                <div class="input-field">
                    <label for="" class="status">Status</label>
                    <select name="status" id="status">
                        <option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Pending</option>
						<option value="3" <?php echo isset($status) && $status == 3 ? 'selected' : '' ?>>On-Hold</option>
						<option value="5" <?php echo isset($status) && $status == 5 ? 'selected' : '' ?>>Done</option>
                    </select>
                </div>
                <div class="input-field">
                    <label for="" class="from_date">From Date</label>
                    <input type="date" name="from_date" id="from_date" autocomplete="off" value="<?php echo isset($from_date) ? date("Y-m-d",strtotime($from_date)) : '' ?>">
                </div>
                <div class="input-field">
                    <label for="" class="to_date">To Date</label>
                    <input type="date" name="to_date" id="to_date" autocomplete="off" value="<?php echo isset($to_date) ? date("Y-m-d",strtotime($to_date)) : '' ?>">
                </div>

                <div class="input-field">
                    <label for="" class="manager">Project Manager</label>
                    <select name="manager" id="manager">
                        <option value="administrator">Administrator</option>
                        <option value="manager">Project Manager</option>
                        <option value="employee">Employee</option>
                    </select>
                </div>
                <div class="input-field">
                    <label for="" class="team_members">Project team members</label>
                    <select name="members" id="members">
                        <option value="administrator">Administrator</option>
                        <option value="manager">Project Manager</option>
                        <option value="employee">Employee</option>
                    </select>
                </div>
                <div class="input">
                <div class="input-field">
					<label for="" class="description">Description</label>
					<textarea name="description" id="" cols="50" rows="10" class="form-control">
					</textarea>
				</div>
                <div class="btn">
                    <input type="submit" value="Save" name="submit">
                    <input type="reset" value="Cancel" name="cancel">
                </div>
                </div>
                
            </div>
        </form>
    </div>
    

           

       
    </div>
        
        
        


    <script type="text/javascript" src="../index.js"></script>













</body>
</html>