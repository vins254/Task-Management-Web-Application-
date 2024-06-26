





<?php

include"../database/connect.php";

session_start();


if(isset($_POST["submit"])) {
    
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    
    $select = "SELECT * FROM users WHERE email = '$email' && password = '$password'";
    

    $result =mysqli_query($conn, $select);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);

        if($row['user_role'] == 'Administrator') {
            $_SESSION['admin_name'] = $row['first_name'];
            header('Location:../index.php');

        }elseif($row['user_role'] == 'Project Manager'){

            $_SESSION['manager_name'] = $row['first_name'];
            header('Location:../index.php?');

        }elseif($row['user_role'] == 'Employee'){

            $_SESSION['employee_name'] = $row['first_name'];
            header('Location:../index.php?');
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
        <div class="login-form">
            <div class="input">
                <input type="email" class="form-control" name="email" required placeholder="Email">
            </div>
            <div class="input">
                <input type="password" class="form-control" name="password" required placeholder="Password">
            </div>
            <div class="sign_in">
                <div class="remember_me">
                    <input type="checkbox" id="remember">
                    <label for="remember">
                        Remember Me
                    </label>
                </div>
                <div class="submit_button">
                <input type="submit" value="Sign in" name="submit">
                </div>
            </div>
        </div>
    </div>
    </form>
</body>
</html>