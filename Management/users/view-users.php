<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style><?php include('../style.css'); ?></style>
    <style><?php include('../CSS/view-user.css'); ?></style>
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
                    <h3>User Details</h3>
                    <div class="back">
                        <a href="../users/user-list.php">Back</a>
                    </div>
                </header>
                <form action="#">
                <div class="user-details">
                    <?php
                    if(isset($_GET["id"])) {
                        $id = $_GET["id"];
                        include("../database/connect.php");
                        $sql = "SELECT * FROM users WHERE id = $id";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($result);
                    ?>
                    <div class="input">
                        <h3>First Name</h3>
                        <p><?php echo $row["first_name"]; ?></p>
                    </div>
                    <div class="input">
                        <h3>Last Name</h3>
                        <p><?php echo $row["last_name"]; ?></p>
                    </div>
                    <div class="input">
                        <h3>User Role</h>
                        <p><?php echo $row["user_role"]; ?></p>
                    </div>
                    <div class="input">
                        <h3>Email</h>
                        <p><?php echo $row["email"]; ?></p>
                    </div>
                    <div class="input">
                        <h3>Password</h3>
                        <p><?php echo $row["password"]; ?></p>
                    </div>
                    
                    
                    
                    <?php
                    }
                ?>
                </div>
                </form>
                
                    
               
                
        </div>




    </div>
        
        
        


    <script type="text/javascript" src="../index.js"></script>








    
</body>
</html>