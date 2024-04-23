<?php
session_start();
require 'dbConnection.php'; // Include the database connection file

// Check if the form is submitted for item removal
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_item'])) {
    $itemIdToRemove = $_POST['item_id'];

    // Prepare and execute SQL statement to remove the item
    $stmt = $conn->prepare("DELETE FROM items WHERE id = ?");
    $stmt->bind_param("i", $itemIdToRemove);
    $stmt->execute();

    // Check if the item is removed successfully
    if ($stmt->affected_rows > 0) {
        $message = "Item removed successfully.";
    } else {
        $message = "Failed to remove item.";
    }

    // Close statement
    $stmt->close();
}

// Check if the form is submitted for item addition
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Collect form data
    $name = $_POST['name'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Handle image upload
    $targetDirectory = "images/"; // Specify the target directory
    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]); // Specify the file path
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $message = "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        $message = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $message = "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        // Fetch the last item ID from the items table
        $lastItemIdQuery = "SELECT MAX(id) as last_id FROM items";
        $lastItemIdResult = $conn->query($lastItemIdQuery);
        $lastItemIdRow = $lastItemIdResult->fetch_assoc();
        $lastItemId = $lastItemIdRow['last_id'];

        // Increment the last item ID to generate the new item ID
        $newItemId = $lastItemId + 1;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // Prepare and execute SQL statement
            $stmt = $conn->prepare("INSERT INTO items (id, name, type, description, image_path, price) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssd", $newItemId, $name, $type, $description, $targetFile, $price);
            $stmt->execute();

            // Check if the item is added successfully
            if ($stmt->affected_rows > 0) {
                $message = "Item added successfully.";
            } else {
                $message = "Failed to add item.";
            }

            // Close statement
            $stmt->close();
        } else {
            $message = "Sorry, there was an error uploading your file.";
        }
    }
}

// // // Check if the form is submitted for item update
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
//     // Collect form data
//     $itemIdToUpdate = $_POST['id'];
//     $name = $_POST['name'];
//     $type = $_POST['type'];
//     $description = $_POST['description'];
//     $price = $_POST['price'];

//     // Prepare and execute SQL statement to update the item
//     $stmt = $conn->prepare("UPDATE items SET name = ?, type = ?, description = ?, price = ? WHERE id = ?");
//     $stmt->bind_param("ssssi", $name, $type, $description, $price, $itemIdToUpdate);
//     $stmt->execute();

//     // Check if the item is updated successfully
//     if ($stmt->affected_rows > 0) {
//         $message = "Item updated successfully.";
//     } else {
//         $message = "Failed to update item.";
//     }
// }

// Fetch all items from the database
$sql = "SELECT * FROM items";
$result = $conn->query($sql);

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        table {
            margin-top: 20px;
            text-align: center;
            width: 100%;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        .centering {
            text-align: center;
        }

        .container-form {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg fill="#333" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/><path d="M0 0h24v24H0z" fill="none"/></svg>');
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 20px;
            padding-right: 40px;
        }

        input[type="file"] {
            padding: 10px;
            margin-bottom: 20px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
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
    <div class="centering container-form">
        <h2>Добави продукт</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
            enctype="multipart/form-data">
            <label>Име:</label><br>
            <input type="text" name="name" required><br><br>

            <label>Тип:</label><br>
            <select name="type" required>
                <option value="car_tool">Инструмент</option>
                <option value="car_part">Част</option>
                <option value="car_accessory">Аксесоар</option>
            </select><br><br>

            <label>Описание:</label><br>
            <input type="text" name="description" required><br><br>

            <label>Снимка:</label><br>
            <input type="file" name="image" accept="image/*" required><br><br>

            <label>Цена:</label><br>
            <input type="number" name="price" required><br><br>

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
    <div class="centering">
        <h2 style="text-align: center">Всички продукти</h2>
        <table>
            <thead>
                <tr>
                    <th>Име</th>
                    <th>Тип</th>
                    <th>Описание</th>
                    <th>Цена</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['type'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "<td>";
                        echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                        echo "<input type='hidden' name='item_id' value='" . $row['id'] . "'>";
                        echo "<input style='background-color: red' type='submit' name='remove_item' value='Изтрий'>";
                       // echo "<input style='background-color: red; margin-top: 30px' type='submit' name='update' value='Промени'>"; //doesn't work for now!
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No items found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php if (isset($message)): ?>
        <p>
            <?php echo $message; ?>
        </p>
    <?php endif; ?>
</body>

</html>
