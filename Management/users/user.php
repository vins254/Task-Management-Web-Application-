
<?php

include"../database/connect.php";

if(isset($_POST["submit"])) {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $user_role = $_POST['user_role'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    $conf_password = md5($_POST['conf_password']);
    $select = "SELECT * FROM users WHERE email = '$email' && password = '$password'";
    

    $result =mysqli_query($conn, $select);
    if(mysqli_num_rows($result) > 0){
        $error[] = "User already exists!";
    }
    else {
        if($password != $conf_password){
            $error[] = "Password not matched";
        }
        else 
        {
            $sql = "INSERT INTO users (id, first_name, last_name, user_role, email, password)
            VALUES (NULL, '$first_name', '$last_name','$user_role','$email','$password')";
            $insert =mysqli_query($conn, $sql);
            if ($insert) {
                session_start();
                $_SESSION["view"] = "User Added Successfully";
                header("Location:../users/user-list.php");
            }
            else {
                echo "Failed: " . mysqli_error($conn);
            }
        }

    }
    
};
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
    <style><?php include('../CSS/new-user.css'); ?></style>
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


            <div class="wrapper">
                <h3>New User</h3>
                <form action="" method="post">
                    <?php
                    if(isset($error)){
                        foreach($error as $error){
                            echo'<span class="error-msg">' . $error . '</span>';
                        };
                    };
                    ?>


                    <div class="input-box">
                        <div class="input-field">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" id="first_name" placeholder="First Name">
                        </div>
                        <div class="input-field">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" placeholder="Last Name">
                        </div>

                        <div class="input-field">
                            <label for="user_role">User Role</label>
                            <select name="user_role" id="user_role">
                                <option value="3" <?php echo isset($user_role) && $user_role == 3 ? 'selected' : '' ?>>Employee</option>
								<option value="2" <?php echo isset($user_role) && $user_role == 2 ? 'selected' : '' ?>>Project Manager</option>
								<option value="1" <?php echo isset($user_role) && $user_role == 1 ? 'selected' : '' ?>>Administrator</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" placeholder="Email">
                        </div>
                
                        <div class="input-field">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" placeholder="Password">
                        </div>
                        <div class="input-field">
                            <label for="conf_password">Confirm Password</label>
                            <input type="password" name="conf_password" id="password2" placeholder="Confirm Password">
                        </div>
                        <div class="btn">
                            <input type="submit" value="Save" name="submit">
                            <input type="reset" value="Cancel" name="cancel">
                        </div>
                    </div>
                </form>
            </div>
        

       
    </div>
        
        
        


    <script type="text/javascript" src="../index.js"></script>





    
</body>
</html>