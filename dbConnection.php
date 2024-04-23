<?php
$server = 'localhost';
$user = 'autoentu';
$password = 'f7PQz]z(eJ3P';
$database = 'autoentu_db';

$conn = new mysqli($server, $user, $password, $database);

if ($conn->connect_error) {
    echo 'Възникна грешка при връзката с базата данни';
}
?>
