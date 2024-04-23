<?php
session_start();
require 'dbConnection.php';

$item_id = $_GET['id'];

$item_query = "
    SELECT *
    FROM items
    WHERE id = $item_id
";

$item_result = mysqli_query($conn, $item_query) or die(mysqli_error($conn));

$item = mysqli_fetch_assoc($item_result);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Item Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 800px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            display: flex;
        }

        .item-image {
            max-width: 100%;
            max-height: 400px;
            border-radius: 10%;
            object-fit: contain;
        }


        .item-details {
            width: 60%;
            padding: 20px;
        }

        .item-details p {
            margin: 0;
            padding: 10px 0;
        }

        .item-details p:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <div class="container">
        <img class="item-image" src="<?php echo $item['image_path'] ?>">
        <div class="item-details">
            <h2>
                <?php echo $item['name'] ?>
            </h2>
            <p><strong>Тип:</strong>
                <?php echo $item['type'] ?>
            </p>
            <p><strong>Описание:</strong>
                <?php echo $item['description'] ?>
            </p>
            <p><strong>Цена:</strong> $
                <?php echo $item['price'] ?>
            </p>
            <p>
                <?php
                if ($item['type'] == 'car_tool') {
                    ?>
                    <a href='car_tools.php' class="btn btn-primary btn-info">Назад</a>
                    <?php
                } else if ($item['type'] == 'car_accessory') {
                    ?>
                    <a href='car_accessories.php' class="btn btn-primary btn-info">Назад</a>
                    <?php
                } else if ($item['type'] == 'car_part') {
                    ?>
                    <a href='car_parts.php' class="btn btn-primary btn-info">Назад</a>
                    <?php
                }
                ?>
            </p>
        </div>
    </div>
</body>

</html>
