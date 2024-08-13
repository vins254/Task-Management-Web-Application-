<?php
@include '../database/connect.php';
$i = 1;
$stat = ["Pending","Started","On-Progress","On-Hold","Over Due","Done"];

$projects_result = $conn->query("SELECT p.*, 
    (SELECT COUNT(*) FROM tasks t WHERE t.project_id = p.id) as total_tasks,
    (SELECT COUNT(*) FROM tasks t WHERE t.project_id = p.id AND t.status = 2) as completed_tasks,
    (SELECT SUM(TIMESTAMPDIFF(MINUTE, pr.start_time, pr.end_time)) FROM productivity pr WHERE pr.project_id = p.id) as work_duration
FROM project p");


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
    <style><?php include('../CSS/report.css'); ?></style>
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
                    <li><a href="./new-project.php">Add New</a></li>
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
            <li>
                <a href="./report.php">
                <i class="fa fa-th-list" aria-hidden="true"></i>
                    <span class="link-name">Report</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link-name" href="./report.php">Report</a></li>
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
                <h3>Report</h3>
                
            




        <div class="table-section">
            <div class="table-header">
                <p>Project Progress</p>   
                <button onclick="window.print()">Print Report</button>
                
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
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        while ($project = $projects_result->fetch_assoc()) { 
                        $progress = ($project['total_tasks'] > 0) ? ($project['completed_tasks'] / $project['total_tasks']) * 100 : 0;
                    ?>

                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td>
                                <b><?php echo $project['name']; ?></b><br>
                                <small>(Due: <?php echo date("F d, Y", strtotime($project['to_date'])); ?>)</small>
                            </td>
                            <td><?php echo $project['total_tasks']; ?></td>
                            <td><?php echo $project['completed_tasks']; ?></td>
                            <td><?php echo $project['work_duration']; ?></td>
                            <td>
                                <div style="width: 100%; background-color: #f3f3f3;">
                                    <div style="width: <?php echo $progress; ?>%; background-color: #4caf50; text-align: center; color: white;">
                                        <?php echo number_format($progress, 2); ?>%
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?php echo $stat[$project['status']]; ?>
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