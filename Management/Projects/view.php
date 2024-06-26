








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    

    <style><?php include('../style.css'); ?></style>
    <style><?php include('../CSS/view-project.css'); ?></style>
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

            <div class="container">
                <header>
                    <h3>View Project</h3>
                    <div class="back">
                         <a href="../Projects/project-list.php">Back</a>
                    </div>
                </header>
                <form action="#">
                    <div class="project-details">
                    <?php
                        if(isset($_GET["id"])) {
                        $id = $_GET["id"];
                        include("../database/connect.php");
                        $sql = "SELECT * FROM project WHERE id = $id";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($result);
                    ?>
                    <div class="input">
                        <h3>Project Name</h3>
                        <p><?php echo $row["name"]; ?></p>
                    </div>
                
                    <div class="input">
                        <h3>From Date</h3>
                        <p><?php echo $row["from_date"]; ?></p> 
                    </div>
                    <div class="input">
                        <h3>To Date</h3>
                        <p><?php echo $row["to_date"]; ?></p>
                    </div>
                    <div class="input">
                        <h3>Project Manager</h3>
                        <p><?php echo $row["project_manager"]; ?></p>
                    </div>
                    <div class="input">
                        <h3>Project Team Member/s</h3>
                        <p><?php echo $row["team_members"]; ?></p>
                    </div>
                    <div class="input">
                        <h3>Description</h3>
                        <p><?php echo $row["description"]; ?></p>
                    </div>
                
                
                
                    <?php
                    }
                    ?>
                    </div>
                </form>
    

                <div class="wrapper">
                    <div class="close-btn">&times;</div>
                        <h3>New Task</h3>
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
                
                            
                        </form>
                    </div> 
                </div>


    <div class="table table-responsive">
    <div class="table-section">
            <div class="table-header">
            <h3>New Task</h3>
        
            <button id="show-task">+Add New Task</button>   
              
                
            </div>
            <table width="100%">
                <thead>
                    <tr>
                        <th># No</th>
                        <th>Task</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include("../database/connect.php");
                    $sql = "SELECT concat(name,' ',description) as project_name, status, from_date, to_date, id FROM project";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_array($result)) {
                    ?>

                        <tr>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["project_name"]; ?></td>
                            <td><?php echo $row["from_date"]; ?></td>
                            
                            <td><?php echo $row["status"]; ?></td>
                            <td>
                                <a href="../Projects/view.php?id=<?php echo $row["id"]; ?>">View</a>
                                <a href="../Projects/edit.php?id=<?php echo $row["id"]; ?>">Edit</a>
                                <a href="../Projects/delete.php?id=<?php echo $row["id"]; ?>">Delete</a>
                            </td>

                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        </div>
        </div>



    </div>
        
        
        


    <script type="text/javascript" src="../index.js"></script>
    <script type="text/javascript" src="../new-task.js"></script>



    
</body>
</html>