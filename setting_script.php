<?php
session_start();
require 'dbConnection.php';

// Get inputs from the form
$old_password = mysqli_real_escape_string($conn, $_POST['oldPassword']);
$new_password = mysqli_real_escape_string($conn, $_POST['newPassword']);
$user_id = $_SESSION['user_id'];

// Fetch the hashed password from the database
$get_password_query = "SELECT password FROM users WHERE id='$user_id'";
$get_password_result = mysqli_query($conn, $get_password_query) or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($get_password_result);
$hashed_password = $row['password'];

// Verify old password
if (password_verify($old_password, $hashed_password)) {
    // Hash the new password
    $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the password in the database
    $update_password_query = "UPDATE users SET password='$hashed_new_password' WHERE id='$user_id'";
    $update_password_result = mysqli_query($conn, $update_password_query) or die(mysqli_error($conn));

    echo "Your password has been updated.";
    ?>
    <meta http-equiv="refresh" content="3;url=index.php" />
    <?php
} else {
    // Old password does not match
    ?>
    <script>
        window.alert("Wrong password!!");
    </script>
    <meta http-equiv="refresh" content="1;url=settings.php" />
    <?php
}
?>
