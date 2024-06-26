<?php
        session_start();
        if (isset($_SESSION["submit"])){
            ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION["submit"];
                unset($_SESSION["submit"]);
                ?>
            </div>
            <?php
        }

        ?>

        <?php
        
        if (isset($_SESSION["edit"])){
            ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION["edit"];
                unset($_SESSION["edit"]);
                ?>
            </div>
            <?php
        }

        ?>

        <?php
       
       if (isset($_SESSION["delete"])){
           ?>
           <div class="alert alert-success">
               <?php
               echo $_SESSION["delete"];
               unset($_SESSION["delete"]);
               ?>
           </div>
           <?php
       }

       ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style><?php include('../style.css'); ?></style>
    <style><?php include('../CSS/report.css'); ?></style>
</head>
<body>


<div class="sidebar">
        <div class="logo-details">
            <i>xx</i>
            <span class="logo-name">Admin</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="../index.php">
                    <i>xx</i>
                    <span class="link-name">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link-name" href="../index.php">Dashboard</a></li>
                </ul>
            </li>
            
            <li>
                <div class="icon-link">
                    <a href="#">
                        <i>xx</i>
                        <span class="link-name">Users</span>
                    </a>
                    <i class="arrow">x</i>
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
                        <i>xx</i>
                        <span class="link-name">Projects</span>
                    </a>
                    <i class="arrow">x</i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link-name" href="#">Projects</a></li>
                    <li><a href="../Projects/create.php">Add New</a></li>
                    <li><a href="../Projects/project-list.php">List</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i>xx</i>
                    <span class="link-name">Tasks</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link-name" href="#">Tasks</a></li>
                </ul>
            </li>
            <li>
                <a href="../Report/report.php">
                    <i>xx</i>
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
                    <span>Logout</span>
                </div>
            </div> 
            <div class="table table-responsive">
                <h3>Report</h3>
                
            




        <div class="table-section">
            <div class="table-header">
                <p>Project Progress</p>   
                
                
            </div>
            <table width="100%">
                <thead>
                    <tr>
                        <th># No</th>
                        <th>Project</th>
                        <th>Task</th>
                        <th>Completed Task</th>
                        <th>Work Duration</th>
                        <th>Progress</th>
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
                            <td><?php echo $row["to_date"]; ?></td>
                            <td><?php echo $row["status"]; ?></td>
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
        
        
        


    <script type="text/javascript" src="../index.js"></script>



</body>
</html>