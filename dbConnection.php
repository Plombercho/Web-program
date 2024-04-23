<?php
//all the variables defined here are accessible in all the files that include this one/ this is the connection of the localhost
$conn = mysqli_connect('localhost', 'root', '', 'diplomnadb') or die('connection failed');

?>

<?php
/* hosted localhost information!
$server = 'localhost';
$user = 'autoentu';
$password = 'f7PQz]z(eJ3P';
$database = 'autoentu_db';

$mysqli = new mysqli($server, $user, $password, $database);

if ($mysqli->connect_error) {
    echo 'Възникна грешка при връзката с базата данни';
}
*/
?>