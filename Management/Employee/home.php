<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "task_application";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn){
    die("Could not connect to the database: " . mysqli_connect_error());
}
else{
    //echo "connected successfully";
}

session_start();

if(!isset($_SESSION['employee_name'])){
    header('location:../Login/login.php');
    exit();
};




$projects_result = $conn->query("SELECT  p.id, p.name, p.to_date, p.status, COUNT(t.id) AS total_tasks, SUM(t.status = 2) AS completed_tasks FROM project p LEFT JOIN tasks t ON p.id = t.project_id GROUP BY p.id");
$stat = ["Pending","Started","On-Progress","On-Hold","Over Due","Done"];


$projects_count_result = $conn->query("SELECT COUNT(*) AS total FROM project");
$projects_count = $projects_count_result->fetch_assoc()['total'];

$tasks_count_result = $conn->query("SELECT COUNT(*) AS total FROM tasks");
$tasks_count = $tasks_count_result->fetch_assoc()['total'];

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
        

       
            <div class="page-header">
                <h2><?php echo $_SESSION['employee_name'] ?></h2>
                <small>Home / Dashboard</small>
            </div>

            <div class="page-content">
                <div class="cards">
                    <div class="card">
                        <div class="card-head">
                            <h2><?php echo $projects_count; ?></h2>
                            <span><i class="fa fa-database" aria-hidden="true"></i></span>
                        </div>
                    
                        <p>Total Projects</p>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h2><?php echo $tasks_count; ?></h2>
                            <span><i class="fa fa-tasks" aria-hidden="true"></i></span>
                        </div>
                        <p>Total Tasks</p>
                    
                    </div>

                </div>



                <div class="records table-responsive">
                    <div class="record-header">
                        <span>Project progress</span>
                    </div>

                    <div>
                        <table width="100%">
                            <colgroup>
                                <col width="5%">
                                <col width="30%">
                                <col width="35%">
                                <col width="15%">
                                <col width="15%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th># No</th>
                                    <th>Project</th>
                                    <th>Progress</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $i = 1; 
                                while ($project = $projects_result->fetch_assoc()) { 
                                    $progress = ($project['total_tasks'] > 0) ? ($project['completed_tasks'] / $project['total_tasks']) * 100 : 0;
                            ?>
                                <tr>
                                    <td> <?php echo $i++ ?></td>
                                    <td>
                                        <b><?php echo $project['name']; ?></b><br>
                                        <small>Due: <?php echo date("F d, Y", strtotime($project['to_date'])); ?></small>
                                    </td>
                                    <td>
                                        <div style="width: 100%; background-color: #e0e0e0;">
                                            <div style="width: <?php echo $progress; ?>%; background-color: green; color: white;">
                                                <?php echo number_format($progress, 2); ?>%
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo $stat[$project['status']]; ?></td>
                                    <td><a href="./view-project.php?id=<?php echo $project["id"]; ?>">View</a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        
        
        
    </div>

    <script type="text/javascript" src="../index.js"></script>

</body>
</html>