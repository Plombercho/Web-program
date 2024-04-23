<?php
session_start();
require 'dbConnection.php'; // Include the database connection file

// Delete user if delete request is sent
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_user'])) {
        $user_id = $_POST['user_id'];
        $delete_query = "DELETE FROM users WHERE id = $user_id";
        mysqli_query($conn, $delete_query);
        // You might want to delete related records from other tables here
    } elseif (isset($_POST['delete_admin'])) {
        $admin_id = $_POST['admin_id'];
        $delete_query = "DELETE FROM admin WHERE admin_id = $admin_id";
        mysqli_query($conn, $delete_query);
        
        // Reset auto-increment counter for admin_id
        mysqli_query($conn, "ALTER TABLE admin AUTO_INCREMENT = 1"); //this is here, because i have problem with admin id-s, after deleteing amdmin, his/her id is not deleted
        
        // Redirect to the same page to prevent form resubmission
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
        // You might want to delete related records from other tables here
    }
}

// Fetch users from the database
$query_users = "SELECT * FROM users";
$result_users = mysqli_query($conn, $query_users);

// Store users in an array
$users = array();
while ($row_users = mysqli_fetch_assoc($result_users)) {
    $users[] = $row_users;
}

// Fetch administrators from the database
$query_admins = "SELECT * FROM admin";
$result_admins = mysqli_query($conn, $query_admins);

// Store administrators in an array
$admins = array();
while ($row_admins = mysqli_fetch_assoc($result_admins)) {
    $admins[] = $row_admins;
}

// Create new administrator if add_admin request is sent
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_admin'])) {
        $admin_name = $_POST['admin_name'];
        $admin_email = $_POST['admin_email'];
        // $admin_password = mysqli_real_escape_string($conn, md5($_POST['admin_password'])); 
        $admin_password = $_POST['admin_password'];    // (it is admin_password because if it's not it try to hash user input password (maybe), but main reason in the id down in the input)

        // Hash the password                                                         //this password hesh is using Bcrypto
        $hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);

        //Insert new administrator into the database
        $insert_query = "INSERT INTO admin (name, email, password) VALUES ('$admin_name', '$admin_email', '$hashed_password')";
        mysqli_query($conn, $insert_query);

        // Redirect to the same page to prevent form resubmission
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    }
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
        /* Basic CSS Styles */

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h2 {
            margin-top: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            
        }

        th,
        td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
            background-color: white;
        }

        th {
            background-color: #f2f2f2;
            background-color: white;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .container-form {
            width: 50%;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
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
    <div class="container-form">
        <h2>Добави Администратор</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="admin_name">Name:</label>
            <input type="text" id="admin_name" name="admin_name" required><br><br>

            <label for="admin_email">Email:</label>
            <input type="email" id="admin_email" name="admin_email" required><br><br>

            <label for="admin_password">Password:</label>
            <input type="password" id="admin_password" name="admin_password" required><br><br> <!--(here is why upper thing shuld be admin_password instead only password because my id is admin password)-->

            <button type="submit" name="add_admin">Add Admin</button>
        </form>
    </div>
 
    <h2>Потребители</h2>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Потребителско Id</th>
                    <th>Име</th>
                    <th>Имейл</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td>
                            <?php echo $user['id']; ?>
                        </td>
                        <td>
                            <?php echo $user['name']; ?>
                        </td>
                        <td>
                            <?php echo $user['email']; ?>
                        </td>
                        <td>
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                <button class="btn-danger" type="submit" name="delete_user">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div>
        <h2>Администратори</h2>
        <div class="container">
            <table>
                <thead>
                    <tr>
                        <th>Администраторско Id</th>
                        <th>Име</th>
                        <th>Имейл</th>
                        <th>Действие</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($admins as $admin): ?>
                        <tr>
                            <td>
                                <?php echo $admin['admin_id']; ?>
                            </td>
                            <td>
                                <?php echo $admin['name']; ?>
                            </td>
                            <td>
                                <?php echo $admin['email']; ?>
                            </td>
                            <td>
                                <?php if($admin['admin_id'] == 1)
                                ?>
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <input type="hidden" name="admin_id" value="<?php echo $admin['admin_id']; ?>">
                                    <button class="btn-danger" type="submit" name="delete_admin">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>