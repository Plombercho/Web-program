<?php
session_start();
require 'check_if_added.php';
require 'dbConnection.php';

$search_term = '';
$search_message = '';

if (isset($_GET['search'])) {
    $search_term = $_GET['search'];

    // Prepare and execute search query
    if (!empty($search_term)) {
        $search_query = "SELECT * FROM items WHERE (name LIKE ? OR type LIKE ?) AND type = 'car_part'";
        $search_statement = mysqli_prepare($conn, $search_query);

        if ($search_statement) {
            // Bind parameters
            $search_param = "%$search_term%";
            mysqli_stmt_bind_param($search_statement, "ss", $search_param, $search_param);

            // Execute query
            mysqli_stmt_execute($search_statement);

            // Get search results
            $search_result = mysqli_stmt_get_result($search_statement);

            // Output search results
            if (mysqli_num_rows($search_result) > 0) {
                $search_message = "резултати от търсене на '$search_term'";
            } else {
                $search_message = "няма намерени резултати от търсене на '$search_term'";
            }
        } else {
            echo "Error in preparing search statement: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Нашите услуги</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/image-resizisng.css">
    <style>
        .image-container {
            width: 100%;
            height: 200px;
            /*Set the fixed height for all images*/
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image-container img {
            width: 100%;
            height: 100%;/ *Ensure the image fills the container height* / object-fit: cover;
        }

        h4 {
            font-size: 15px;
        }

        p {
            font-size 5px
        }

        body {
            background-color: rgb(245, 250, 255);
        }
    </style>
</head>

<body>
    <div class="wrap">
        <?php require 'header.php'; ?>
        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                    aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fa fa-bars"></span> Меню</button>
                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a href="index.php" class="nav-link">Автосервиз</a></li>
                        <?php
                        if (isset($_SESSION['user_id'])) {
                            ?>
                            <li class="nav-item"><a href="contact.php" class="nav-link">Контакти</a></li>
                            <li class="nav-item"><a href="car_accessories.php" class="nav-link">Аксесоари</a></li>
                            <li class="nav-item active"><a href="car_parts.php" class="nav-link">Части</a></li>
                            <li class="nav-item"><a href="car_tools.php" class="nav-link">Инструменти</a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <form action="#" class="searchform order-lg-last">
                    <div class="form-group d-flex">
                        <?php
                        if (isset($_SESSION['user_id'])) {
                            ?>
                            <a style="margin-right:100px; font-size: 19px" href="cart.php"><span
                                    class="fa fa-shopping-cart"></span>Количка</a>
                            <div class="form-group d-flex ">
                                <input type="text" name="search" class="form-control pl-3" placeholder="Търсене">
                                <button type="submit" class="form-control search"><span
                                        class="fa fa-search"></span></button>
                            </div>
                            <?php
                        } else {
                            ?>
                            <a style="padding-right:22px; font-size: 19px" href="register.php"><span
                                    class="fa fa-file-text-o"></span>
                                Регистрация</a>
                            <a style="padding-right:22px; font-size: 19px" href="login.php"><span
                                    class="fa fa-sign-in"></span>
                                Вход</a>
                            <?php
                        }
                        ?>
                    </div>
                </form>
            </div>
        </nav>
    </div>
    <div style="margin-top: 50px; margin-left: 40px; margin-bottom: 50px; margin-right: 40px" class="row">
        <!-- Searching content-->
        <?php
        if (isset($search_result)) {
            if (mysqli_num_rows($search_result) > 0) {
                while ($row = mysqli_fetch_assoc($search_result)) {
                    echo '<div class="col-md-2" style="margin-bottom: 25px">';
                    echo '<div class="thumbnail text-center" style="background-color: #00FFFF; border-style: solid; border-width: 2px; border-color: lightblue; border-radius: 5px">';
                    echo '<div class="image-container">';
                    echo '<img src="' . $row["image_path"] . '" alt="' . $row["name"] . '" class="item-image">';
                    echo '</div>';
                    echo '<div class="caption">';
                    echo '<h4>' . $row["name"] . '</h4>';
                    echo '<p>Цена: <sup>$</sup>' . $row["price"] . '</p>';
                    echo '<a style="margin-bottom: 5px" href="item_details.php?id=' . $row["id"] . '" class="btn btn-info" name="add" value="add">Виж повече</a>';
                    if (check_if_added_to_cart($row['id'])) {
                        echo '<a href="#" class="btn btn-block disabled">Добавено в количката</a>';
                    } else {
                        echo '<a href="cart_add.php?id=' . $row['id'] . '" class="btn btn-block btn-primary" name="add" value="add">Добави в количката</a>';
                    }
                    // You can add additional conditions or buttons based on your requirements here
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
                echo '</div>';
            } else {
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<div class="col-md-12">';
                echo '<h2>' . $search_message . '</h2>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            // Item printing down here:
            $desired_type = "car_part";
            $item_query = "SELECT id, name, type, image_path, price FROM items WHERE type = '$desired_type'";
            $item_result = mysqli_query($conn, $item_query);

            if ($item_result && mysqli_num_rows($item_result) > 0) {
                while ($item = mysqli_fetch_assoc($item_result)) {
                    echo '<div class="col-md-2" style="margin-bottom: 25px">';
                    echo '<div class="thumbnail text-center" style="background-color: #00FFFF; border-style: solid; border-width: 2px; border-color: lightblue; border-radius: 5px">';
                    echo '<div class="image-container">';
                    echo '<img src="' . $item['image_path'] . '" alt="' . $item['name'] . '" class="item-image">';
                    echo '</div>';
                    echo '<div class="caption">';
                    echo '<h4>' . $item['name'] . '</h4>';
                    echo '<p>Price: ' . $item['price'] . 'лв</p>';
                    echo '<a href="item_details.php?id=' . $item['id'] . '" class="btn btn-info" name="add" value="add">Виж повече</a>';
                    if (check_if_added_to_cart($item['id'])) {
                        echo '<a href="#" class="btn btn-block btn-success disabled">Добавено в количката</a>';
                    } else {
                        echo '<a href="cart_add.php?id=' . $item['id'] . '" class="btn btn-block btn-primary" name="add" value="add">Добави в количката</a>';
                    }
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
                echo '</div>';
            } else {
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<div class="col-md-12">';
                echo 'Няма намерени продукти от посочения тип.';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        }
        ?>
    </div>
    <!-- END LAYER FOR SELL-->

    <?php require 'footer.php'; ?>

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg></div>


    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery.timepicker.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/scrollax.min.js"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="js/google-map.js"></script>
    <script src="js/main.js"></script>
</body>

</html>