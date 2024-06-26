<?php
include"../database/connect.php";
if(isset($_POST["edit"])) {
    $name = $_POST['name'];
    $status = $_POST['status'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $project_manager = $_POST['project_manager'];
    $team_members = $_POST['team_members'];
    $description = $_POST['description'];
    $id = $_POST['id'];

    $sql = "UPDATE project SET name = '$name', status = '$status', from_date = '$from_date', to_date = '$to_date',  project_manager = '$project_manager', team_members = '$team_members', description = '$descrption' WHERE id = '$id'";

    $result =mysqli_query($conn, $sql);
    if ($result) {
        session_start();
        $_SESSION["edit"] = "Project Updated Successfully";
        header("Location:../Projects/project-list.php");
    }
    else {
        die("Error updating");
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
    <style><?php include('../CSS/edit-project.css'); ?></style>
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
        <header>
            <h3>Edit Details</h3>
            <div class="back">
                <a href="../Projects/project-list.php">Back</a>
            </div>
        </header>

        <?php
        if(isset($_GET["id"])) {
            $id = $_GET["id"];
            include("../database/connect.php");
            $sql = "SELECT * FROM users WHERE id = $id";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            ?>



            <form action="" method="post">

            <div class="input-box">
                <div class="input-field">
                    <label for="" class="name">Name</label>
                    <input type="text" name="name" id="name" value="<?php echo $row["first_name"]; ?>" placeholder="First Name">
                </div>
                <div class="input-field">
                    <label for="" class="status">Status</label>
                    <select name="status" id="status">
                        <option value="administrator" <?php if($row['status']=="Administrator"){echo "selected";} ?> >Administrator</option>
                        <option value="manager" <?php if($row['status']=="Project Manager"){echo "selected";} ?>>Project Manager</option>
                        <option value="employee" <?php if($row['status']=="Employee"){echo "selected";} ?> >Employee</option>
                    </select>
                </div>
                <div class="input-field">
                    <label for="" class="from_date">From Date</label>
                    <input type="date" name="from_date" id="from_date" value="<?php echo $row["from_date"]; ?>">
                </div>
                <div class="input-field">
                    <label for="" class="to_date">To Date</label>
                    <input type="date" name="to_date" id="to_date" value="<?php echo $row["to_date"]; ?>">
                </div>

                <div class="input-field">
                    <label for="" class="manager">Project Manager</label>
                    <select name="manager" id="manager">
                    <option value="administrator" <?php if($row['manager']=="Administrator"){echo "selected";} ?> >Administrator</option>
                        <option value="manager" <?php if($row['manager']=="Project Manager"){echo "selected";} ?>>Project Manager</option>
                        <option value="employee" <?php if($row['manager']=="Employee"){echo "selected";} ?> >Employee</option>
                    </select>
                </div>
                <div class="input-field">
                    <label for="" class="team_members">Project team members</label>
                    <select name="members" id="members">
                        <option value="administrator" <?php if($row['members']=="Administrator"){echo "selected";} ?> >Administrator</option>
                        <option value="manager" <?php if($row['members']=="Project Manager"){echo "selected";} ?>>Project Manager</option>
                        <option value="employee" <?php if($row['members']=="Employee"){echo "selected";} ?> >Employee</option>
                    </select>
                </div>
                <div class="input">
                <div class="input-field">
					<label for="" class="description">Description</label>
					<textarea name="description" id="" cols="30" rows="10" class="form-control" value="<?php echo $row["description"]; ?>">
					</textarea>
				</div>
                <div class="btn">
                    <input type="hidden" name="id" value='<?php echo $row["id"]; ?>'>
                    <input type="submit" value="Edit" name="edit">
                </div>
                </div>
                
                
                
                
                
            </div>
        </form>
    



        
        
        
        
        
        <?php
        }
        ?>
</div>


            
        

       
    </div>
        
        
        


    <script type="text/javascript" src="../index.js"></script>







        
        
   
</body>
</html>