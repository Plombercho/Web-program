<?php
session_start();
require 'dbConnection.php';

$total_payments_query = "
    SELECT SUM(total_payments) AS total_payments
    FROM users
";

$total_payments_result = mysqli_query($conn, $total_payments_query) or die(mysqli_error($conn));

$total_payments_row = mysqli_fetch_assoc($total_payments_result);
$total_payments = $total_payments_row['total_payments'];

$total_users_query = "SELECT COUNT(*) AS total_users FROM users";
$total_users_result = mysqli_query($conn, $total_users_query) or die(mysqli_error($conn));
$total_users_row = mysqli_fetch_assoc($total_users_result);
$total_users = $total_users_row['total_users'];

$total_admins_query = "SELECT COUNT(*) AS total_admins FROM admin";
$total_admins_result = mysqli_query($conn, $total_admins_query) or die(mysqli_error($conn));
$total_admins_row = mysqli_fetch_assoc($total_admins_result);
$total_admins = $total_admins_row['total_admins'];

$total_items_query = "SELECT COUNT(*) AS total_items FROM items";
$total_items_result = mysqli_query($conn, $total_items_query) or die(mysqli_error($conn));
$total_items_row = mysqli_fetch_assoc($total_items_result);
$total_items = $total_items_row['total_items'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container-board {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        .container-board h2 {
            font-size: 28px;
            /* Увеличете размера на шрифта на заглавията */
            margin-bottom: 20px;
            /* Увеличете разстоянието между заглавията */
        }

        .container-board p {
            font-size: 20px;
            margin-bottom: 30px;
        }

        .container-board h2{
            border: 5px solid lightblue;
            padding: 20px;
            border-radius: 10px;
            background-color: white;
            margin-right: 12px;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="wrap">
        <?php
        require 'admin_header.php';
        require 'admin_navbar.php';
        ?>
    </div>
    <h1 style="text-align: center">Admin Dashboard</h1>

    <div class="container-board">
        <h2>Печалба: <?php echo $total_payments; ?>лв.</h2>
        <h2>потребители: <?php echo $total_users; ?></h2>
        <h2>администратори: <?php echo $total_admins; ?></h2>
        <h2>налични продукти: <?php echo $total_items; ?></h2>
    </div>
</body>

</html>
