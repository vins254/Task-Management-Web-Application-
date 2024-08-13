<?php
        session_start();
        include("../database/connect.php"); 
        $i = 1;
        $stat = ["Pending","Started","On-Progress","On-Hold","Over Due","Done"];
        $result = $conn->query("SELECT t.*, p.name as project_name, p.from_date, p.to_date, p.status as project_status FROM tasks t JOIN project p ON t.project_id = p.id");



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
    
    <style><?php include('../style.css'); ?></style>
    <style><?php include('../CSS/task-list.css'); ?></style>
</head>
<body>
<div class="sidebar">
        <div class="logo-details">
        <i class="fa fa-user-circle" aria-hidden="true"></i>
            <span class="logo-name">Admin</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="./home.php">
                <i class="fa fa-home" aria-hidden="true"></i>
                    <span class="link-name">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link-name" href="./home.php">Dashboard</a></li>
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
                    
                    <li><a href="./project-list.php">List</a></li>
                </ul>
            </li>
            <li>
                <a href="./task-list.php">
                    <i class="fa fa-tasks" aria-hidden="true"></i>
                    <span class="link-name">Tasks</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link-name" href="./task-list.php">Tasks</a></li>
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
                <h3>Task List</h3>
                
            




        <div class="table-section">
            <div class="table-header">
                  
                <input placeholder="search" />
                
            </div>
            <table width="100%">
                 <colgroup>
					<col width="5%">
					<col width="15%">
					<col width="20%">
					<col width="15%">
					<col width="15%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
				</colgroup>
                <thead>
                    <tr>
                        <th># No</th>
                        <th>Project</th>
                        <th>Task</th>
                        <th>Project Started</th>
                        <th>Project Due Date</th>
                        <th>Project Status</th>
                        <th>Task Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $row['project_name']; ?></td>
                            <td>
                                <b><?php echo $row['task']; ?></b> <br>
                                <small><?php echo $row['description']; ?></small>
                            </td>
                            <td><?php echo date("F d, Y", strtotime($row['from_date'])); ?></td>
                            <td><?php echo date("F d, Y", strtotime($row['to_date'])); ?></td>
                            
                            <td><?php echo $stat[$row['project_status']]; ?></td>
                            <td><?php echo $stat[$row['status']]; ?></td>
                            <td>
                            <a href="newprogress.php?project_id=<?php echo $row['project_id']; ?>&task_id=<?php echo $row['id']; ?>">Add Productivity</a>    
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