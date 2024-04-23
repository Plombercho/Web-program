<?php
session_start();
require 'dbConnection.php';

$sql = "SELECT * FROM messages ";
$result = mysqli_query($conn, $sql);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_message'])) {
    // Get the message ID to be deleted
    $message_id = $_POST['message_id'];

    // Prepare and execute the SQL query to delete the message
    $delete_query = "DELETE FROM messages WHERE id = $message_id";
    $delete_result = mysqli_query($conn, $delete_query);

    // Redirect to the same page to refresh the message list
    header("Location: {$_SERVER['PHP_SELF']}");
    exit;
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <!-- Add your CSS stylesheets or link to external stylesheets here -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- icons -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        .message {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            word-wrap: break-word;
            /* Wrap long words so they go on the next row, when they get to the end of the container */
        }

        .message h4 {
            margin-top: 0;
            font-size: 18px;
            color: #333;
        }

        .message p {
            margin-bottom: 5px;
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
    <div class="container" style="margin-top: 50px; text-align:">
        <?php
        // Check if the $result variable is set and has rows
        if (mysqli_num_rows($result) > 0) {
            // Output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='message'>";
                echo "<p><strong>Name:</strong> " . $row["name"] . "</p>";
                echo "<p><strong>Email:</strong> " . $row["email"] . "</p>";
                echo "<p><strong>Subject:</strong> " . $row["subject"] . "</p>";
                echo "<p><strong>Message:</strong> " . $row["message"] . "</p>";
                // Add hidden input field for message_id
                echo "<form method='post'>";
                echo "<input type='hidden' name='message_id' value='" . $row["id"] . "'>";
                echo "<input style='background-color: red' type='submit' name='remove_message' value='Изтрий'>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "<p>No messages found.</p>";
        }
        ?>
    </div>

</body>

</html>