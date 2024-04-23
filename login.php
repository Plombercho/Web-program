<?php

include 'dbConnection.php';
session_start();

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $select_admin = mysqli_query($conn, "SELECT * FROM `admin` WHERE email = '$email'") or die('Admin query failed');

    if(mysqli_num_rows($select_admin) > 0){
        $row = mysqli_fetch_assoc($select_admin);
        if(password_verify($password, $row['password'])) {  
            $_SESSION['admin_id'] = $row['id'];
            header('location: admin_dashboard.php');
            exit();
        }
    }

    $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('User query failed');

    if(mysqli_num_rows($select_user) > 0){
        $row = mysqli_fetch_assoc($select_user);
        if(password_verify($password, $row['password'])) { {  
            $_SESSION['user_id'] = $row['id'];
            header('location: index.php');
            exit();
        }
    }

    $message[] = 'Incorrect email or password!';
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/loginStyle.css">

</head>
<body>

<div class="form-container">
    <form action="" method="post" enctype="multipart/form-data">
        <h3>Login Now</h3>
        <?php
        if(isset($message)){
            foreach($message as $msg){
                echo '<div class="message">'.$msg.'</div>';
            }
        }
        ?>
        <input type="email" name="email" placeholder="Enter Email" class="box" required>
        <input type="password" name="password" placeholder="Enter Password" class="box" required>
        <input type="submit" name="submit" value="Login Now" class="btn">
        <p>Don't have an account? <a href="register.php">Register Now</a></p>
    </form>
</div>

</body>
</html>
