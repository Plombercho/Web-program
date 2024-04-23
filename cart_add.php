<?php
session_start();
require 'dbConnection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Get the item ID from the URL parameter
$item_id = isset($_GET['id']) ? intval($_GET['id']) : null;

if (!$item_id) {
    echo "Invalid item ID.";
    exit;
}

$item_query = "SELECT * FROM items WHERE id = $item_id";
$item_result = mysqli_query($conn, $item_query);

if (!$item_result || mysqli_num_rows($item_result) == 0) {
    echo "Item not found.";
    exit;
}

$item_data = mysqli_fetch_assoc($item_result);

$add_to_cart_query = "INSERT INTO users_items (user_id, item_id, status) VALUES (?, ?, 'Added to cart')";
$statement = mysqli_prepare($conn, $add_to_cart_query);

if ($statement) {
    mysqli_stmt_bind_param($statement, 'ii', $user_id, $item_id);
    if (mysqli_stmt_execute($statement)) {
        header('Location: cart.php');
        exit();
    } else {
        echo "Error adding item to cart: " . mysqli_error($conn);
    }
} else {
    echo "Error preparing statement: " . mysqli_error($conn);
}

?>
