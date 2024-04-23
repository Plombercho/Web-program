<?php
$server = 'localhost';
$user = 'autoentu';
$password = 'f7PQz]z(eJ3P';
$database = 'autoentu_db';

$mysqli = new mysqli($server, $user, $password, $database);

if ($mysqli->connect_error) {
    echo 'Възникна грешка при връзката с базата данни';
}
?>
