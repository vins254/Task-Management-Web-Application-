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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style><?php @include('../style.css'); ?></style>
    <style><?php @include('../CSS/user-list.css'); ?></style>
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
                <i class="bx-menu fa fa-align-justify" aria-hidden="true"></i>
                <span class="text">Task Management </span>
            
                <div class="user">
                    <div class="bg-img"style="background-image: url(xx)"></div>
                    <span><i class="fa fa-user" aria-hidden="true"></i></span>
                    <span><a href="../Login/log-out.php">Logout</a></span>
                </div>
            </div> 


            <div class="table table-responsive">
                <div class="table-header">
                    <div class="header-add">
                        <a href="../users/user.php">+Add New User</a>
                    </div>
                    <div class="header-search">
                        <p>list users</p>
                        <input placeholder="search" />
                    </div>
                </div>
            
                <div class="table-section">
                    <table width="100%">
                        <thead>
                            <tr>
                                <th># No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include("../database/connect.php");
                                $i = 1;
                                $status = array('',"Administrator","Project Manager","Employee");
                                $sql = "SELECT concat(first_name,' ',last_name) as name, email, user_role, id FROM users";
                                $result = mysqli_query($conn, $sql);

                                while ($row = mysqli_fetch_array($result)) {
                            ?>

                            <tr>
                                <td><?php echo $i++ ?></td>
                                <td><?php echo $row["name"]; ?></td>
                                <td><?php echo $row["email"]; ?></td>
                                <td><?php echo $status[$row["user_role"]]; ?></td>
                                <td>
                                    <a href="../users/view-users.php?id=<?php echo $row["id"]; ?>">View</a>
                                    <a href="../users/edit.php?id=<?php echo $row["id"]; ?>">Edit</a>
                                    <a href="../users/delete.php?id=<?php echo $row["id"]; ?>">Delete</a>
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