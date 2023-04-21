<?php
//Подключение к базе
$servername = "localhost";
$database = "blmd";
$username = "root";
$password = "root";

$conn = mysqli_connect($servername, $username, $password, $database);

mysqli_close($conn);
?>