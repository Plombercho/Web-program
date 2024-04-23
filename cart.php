<?php
session_start();
require 'dbConnection.php';

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'quantity' array is set in $_POST
    if (isset($_POST['quantity']) && is_array($_POST['quantity'])) {
        // Loop through each item in the quantity array
        foreach ($_POST['quantity'] as $itemId => $quantity) {
            // Ensure $itemId and $quantity are valid
            $itemId = intval($itemId);
            $quantity = intval($quantity);

            if ($itemId && $quantity > 0) {
                $update_query = "UPDATE users_items SET quantity = $quantity WHERE item_id = $itemId AND user_id = $user_id";
                mysqli_query($conn, $update_query) or die(mysqli_error($conn));
            }
        }
    }
}

$user_cart_query = "
    SELECT i.id, i.name, i.type, i.image_path, i.price, ui.quantity
    FROM items i 
    INNER JOIN users_items ui ON i.id = ui.item_id
    WHERE ui.user_id = $user_id AND ui.status = 'Added to cart'
";

$user_cart_result = mysqli_query($conn, $user_cart_query) or die(mysqli_error($conn));

$cart_items = [];
$total_price = 0;
$total_quantity = 0;
while ($row = mysqli_fetch_assoc($user_cart_result)) {
    $cart_items[] = $row;
    $total_price += $row['price'] * $row['quantity'];
    $total_quantity += $row['quantity'];
}

$_SESSION['cart_total_price'] = isset($_SESSION['cart_total_price']) ? $_SESSION['cart_total_price'] + $total_price : $total_price;

$new_total_payments = $total_price;

$update_total_payments_query = "UPDATE users SET total_payments = total_payments + $new_total_payments WHERE id = $user_id";
mysqli_query($conn, $update_total_payments_query) or die(mysqli_error($conn));
?>


<!DOCTYPE html>
<html>

<head>
    <title>Cart</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        h2 {
            text-align: center;
        }

        .container-form {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="wrap">
        <?php require 'header.php'; ?>
        <br>
        <div class="container">
            <form method="post">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>Номер на продукта</th>
                            <th>Име на продукта</th>
                            <th>Тип</th>
                            <th>Цена за 1</th>
                            <th>Количество</th>
                            <th>Общо</th>
                            <th></th>
                        </tr>
                        <?php foreach ($cart_items as $counter => $item): ?>
                            <tr>
                                <td>
                                    <?php echo $counter + 1 ?>
                                </td>
                                <td>
                                    <?php echo $item['name'] ?>
                                </td>
                                <td>
                                    <?php echo $item['type'] ?>
                                </td>
                                <td>
                                    <?php echo $item['price'] ?>
                                </td>
                                <td>
                                    <input type="number" min="1" name="quantity[<?php echo $item['id']; ?>]"
                                        value="<?php echo max(1, $item['quantity']); ?>">
                                </td>
                                <td>
                                    <?php echo max($item['price'], $item['price'] * $item['quantity']); ?>
                                </td> <!-- Total price for the item considering quantity -->
                                <td><a href="cart_remove.php?id=<?php echo $item['id']; ?>"
                                        class="btn btn-danger">Премахни</a></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <th><a href="index.php?id=<?php echo $user_id ?>" class="btn btn-small btn-secondary">Върни
                                    се в началото</a></th>
                            <th><button type="submit" class="btn btn-primary">Обнови количествата</button></th>
                            <th></th>
                            <th></th>
                            <th>Общо</th>
                            <th>$
                                <?php echo $total_price; ?>/-
                            </th>
                        </tr>
                    </tbody>
                </table>
            </form>
            <br><br><br><br>
            <div class="container-form">
                <h2>Въведи информация</h2>
                <form id="orderForm" method="post" onsubmit="return validatePayment()">
                    <label for="location">Място:</label>
                    <input type="text" id="location" name="location" placeholder="Въведи място" required>
                    <label for="location">Улица:</label>
                    <input type="text" id="street" name="location" placeholder="Въведи улица" required>
                    <label for="paymentMethod">Метод на плащане:</label>
                    <select id="paymentMethod" name="paymentMethod" required onchange="changeAction()">
                        <option value="">Избери</option>
                        <option value="cash">Плащане в брой</option>
                        <option value="paypal">Плати с Paypal</option>
                    </select>

                    <!-- Hidden field for total price -->
                    <input type="hidden" name="total_amount" value="<?php echo $total_price; ?>">
                    <!-- Hidden field for total quantity -->
                    <input type="hidden" name="total_quantity" value="<?php echo $total_quantity; ?>">

                    <button type="submit">Поръчай</button>
                </form>

            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br><br><br>
</div>
<?php require 'footer.php'; ?>

    <!-- loader for icons and animations-->
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


<script>
    function changeAction() {
        var paymentMethod = document.getElementById("paymentMethod").value;
        var form = document.getElementById("orderForm");

        if (paymentMethod === "cash") {
            form.action = "success.php";
        } else if (paymentMethod === "paypal") {
            form.action = "paypal_payment.php";
        }
    }

    function validatePayment() {
        var paymentMethod = document.getElementById("paymentMethod").value;
        var totalQuantity = <?php echo $total_quantity; ?>;

        if (paymentMethod === "") {
            alert("Моля избери метод на плащане.");
            return false;
        }

        if (totalQuantity <= 0) {
            alert("Няма продукти в количката. Моля, добавете продукти преди да продължите.");
            return false;
        }
        return true;
    }
</script>
