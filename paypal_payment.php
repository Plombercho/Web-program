<?php 
session_start();
require 'dbConnection.php';
$user_id=$_SESSION['user_id'];
$confirm_query="update users_items set status='Confirmed' where user_id=$user_id";
$confirm_query_result=mysqli_query($conn,$confirm_query) or die(mysqli_error($conn));
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // check if total amount and total quantity exist
    if(isset($_POST['total_amount']) && isset($_POST['total_quantity']) && is_numeric($_POST['total_amount'])) {
        $total_amount = $_POST['total_amount'];
        $total_quantity = $_POST['total_quantity'];


        $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; // URL to PayPal paying page
        $business_email = 'viktor_veli@abv.bg'; // PayPal mail

        // Generate payment data to PayPal
        $data = array(
            'cmd' => '_xclick',
            'business' => $business_email,
            'amount' => $total_amount,
            'quantity' => $total_quantity,
            'currency_code' => 'USD',
        );

        // Preparing data for redirection
        $query_string = http_build_query($data);
        $paypal_redirect_url = $paypal_url . '?' . $query_string;

        header("Location: $paypal_redirect_url");
        exit();
    } else {
        echo "Грешка: Невалидна обща сума за плащане.";
    }
} else {
    // Ако заявката не е POST, изведете грешка
    echo "Грешка: Невалидна заявка.";
}
?>
