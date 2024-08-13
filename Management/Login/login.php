





<?php

include"../database/connect.php";

session_start();
$email = $password = "";
$remember = "";

if(isset($_POST["submit"])) {
    
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    if(isset($_POST["remember_me"])) {
        $remember = $_POST["remember_me"];
    }
    $select = "SELECT * FROM users WHERE email = '$email' && password = '$password'";
    

    $result =mysqli_query($conn, $select);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);

        if($row['user_role'] == 1) {
            if(isset($_POST["remember_me"])) {
                $remember = $_POST["remember_me"];
                setcookie("remember_email", $email,time() + 3600*24*365);
                setcookie("remember_me", $remember,time() + 3600*24*365);
            }
            else {
                setcookie("remember_email", "", time() - 3600*24*365);
                setcookie("remember_me", "", time() - 3600*24*365);
            }
            $_SESSION['admin_name'] = $row['first_name'];
            
            header('Location:../index.php');

        }elseif($row['user_role'] == 2){
            if(isset($_POST["remember_me"])) {
                $remember = $_POST["remember_me"];
                setcookie("remember_email", $email,time() + 3600*24*365);
                setcookie("remember_me", $remember,time() + 3600*24*365);
            }
            else {
                setcookie("remember_email", "", time() - 3600*24*365);
                setcookie("remember_me", "", time() - 3600*24*365);
            }

            $_SESSION['manager_name'] = $row['first_name'];
            header('Location:../Project Manager/home.php?');

        }elseif($row['user_role'] == 3){
            if(isset($_POST["remember_me"])) {
                $remember = $_POST["remember_me"];
                setcookie("remember_email", $email,time() + 3600*24*365);
                setcookie("remember_me", $remember,time() + 3600*24*365);
            }
            else {
                setcookie("remember_email", "", time() - 3600*24*365);
                setcookie("remember_me", "", time() - 3600*24*365);
            }

            $_SESSION['employee_name'] = $row['first_name'];
            header('Location:../Employee/home.php?');
        }
    
    }else {
        $error[] = 'Incorrect email or password';
    }
}
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style><?php include('../CSS/login.css'); ?></style>
</head>
<body>
    <form action="#" method="POST">
    <?php
     if(isset($error)){
        foreach($error as $error){
            echo'<span class="error-msg">' . $error . '</span>';
            };
        };
    ?>
    <div class="login">
        <h3>Task Management Application</h3>
        <div class="login-form">
            <div class="input-box">
                <input type="email" class="form-control" name="email" 
                value="<?php if(!empty($email)) {echo $email;} 
                elseif (isset($_COOKIE["remember_email"])) {echo $_COOKIE["remember_email"];} ?>" required placeholder="Email">
                <i class='bx bxs-envelope'></i>
            </div>
            <div class="input-box">
                <input type="password" class="form-control" name="password" required placeholder="Password">
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="sign-in">
                <div class="remember-me">
                    <label for="remember">
                        <input type="checkbox" id="remember" name="remember_me" 
                        <?php if(!empty($remember)) { ?> checked <?php } elseif(isset($_COOKIE["remember_me"])) { ?> checked <?php } ?>>
                        Remember Me
                    </label>
                </div>
                <div class="submit-button">
                <input type="submit" value="Sign in" name="submit">
                </div>
            </div>
        </div>
    </div>
    </form>
</body>
</html>