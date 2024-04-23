<?php 
session_start();
require 'dbConnection.php';
$user_id=$_SESSION['user_id'];
$confirm_query="update users_items set status='Confirmed' where user_id=$user_id";
$confirm_query_result=mysqli_query($conn,$confirm_query) or die(mysqli_error($conn));
?>

<?php
// Проверка за съществуване на POST заявката
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверка за съществуване на общата сума
    if(isset($_POST['total_amount']) && isset($_POST['total_quantity']) && is_numeric($_POST['total_amount'])) {
        $total_amount = $_POST['total_amount'];
        $total_quantity = $_POST['total_quantity'];

        // Редирект към страницата на PayPal с необходимите параметри
        $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; // URL на страницата на PayPal за плащане
        $business_email = 'viktor_veli@abv.bg'; // Тук посочете вашия PayPal имейл

        // Генериране на данни за плащане към PayPal
        $data = array(
            'cmd' => '_xclick',
            'business' => $business_email,
            'amount' => $total_amount,
            'quantity' => $total_quantity,
            'currency_code' => 'USD', // Валутен код
            // Добавете още параметри по необходимост
        );

        // Подготовка на данните за пренасочване
        $query_string = http_build_query($data);
        $paypal_redirect_url = $paypal_url . '?' . $query_string;

        // Пренасочване към страницата на PayPal
        header("Location: $paypal_redirect_url");
        exit();
    } else {
        // Ако общата сума липсва или не е числено значение, изведете грешка
        echo "Грешка: Невалидна обща сума за плащане.";
    }
} else {
    // Ако заявката не е POST, изведете грешка
    echo "Грешка: Невалидна заявка.";
}
?>
