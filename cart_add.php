<?php
session_start();
require 'dbConnection.php'; // Include the database connection file

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Get the user ID
$user_id = $_SESSION['user_id'];

// Get the item ID from the URL parameter
$item_id = isset($_GET['id']) ? intval($_GET['id']) : null;

// Validate item ID
if (!$item_id) {
    echo "Invalid item ID.";
    exit;
}

// Check if the item exists in the database
$item_query = "SELECT * FROM items WHERE id = $item_id";
$item_result = mysqli_query($conn, $item_query);

if (!$item_result || mysqli_num_rows($item_result) == 0) {
    echo "Item not found.";
    exit;
}

// Fetch the item details
$item_data = mysqli_fetch_assoc($item_result);

// Insert the item into the users_items table
$add_to_cart_query = "INSERT INTO users_items (user_id, item_id, status) VALUES (?, ?, 'Added to cart')";
$statement = mysqli_prepare($conn, $add_to_cart_query);

if ($statement) {
    mysqli_stmt_bind_param($statement, 'ii', $user_id, $item_id);
    if (mysqli_stmt_execute($statement)) {
        // Redirect to the cart page
        header('Location: cart.php');
        exit();
    } else {
        echo "Error adding item to cart: " . mysqli_error($conn);
    }
} else {
    echo "Error preparing statement: " . mysqli_error($conn);
}

?>
