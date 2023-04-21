<?php
include_once '/var/www/blmd/components/db.php';
$data = $_POST;
session_start();
$login = $_SESSION['user'];
$company_name = $_SESSION['company-name'];
$time = date("Y-m-d H:i:s");

//Загрузка комментариев в базу
$name_form = $data['aside-data-name-inp'];
$inn_form = $data['aside-data-inn-inp'];
$info_form = $data['aside-data-info-inp'];
$boss_form = $data['aside-data-boss-inp'];
$street_form = $data['aside-data-street-inp'];
$number_form = $data['aside-data-number-inp'];
$company_form = $data['aside-data-company-inp'];

if (isset($name_form)) {
    $sql_post = "INSERT INTO comments VALUES ('$time','$login','$company_name','$name_form','','','','','','')";
    $conn = mysqli_connect($servername, $username, $password, $database);
    $result = mysqli_query($conn, $sql_post);
}

if (isset($inn_form)) {
    $sql_post = "INSERT INTO comments VALUES ('$time','$login','$company_name','','$inn_form','','','','','')";
    $conn = mysqli_connect($servername, $username, $password, $database);
    $result = mysqli_query($conn, $sql_post);
}
if (isset($info_form)) {
    $sql_post = "INSERT INTO comments VALUES ('$time','$login','$company_name','','','$info_form','','','','')";
    $conn = mysqli_connect($servername, $username, $password, $database);
    $result = mysqli_query($conn, $sql_post);
}
if (isset($boss_form)) {
    $sql_post = "INSERT INTO comments VALUES ('$time','$login','$company_name','','','','$boss_form','','','')";
    $conn = mysqli_connect($servername, $username, $password, $database);
    $result = mysqli_query($conn, $sql_post);
}
if (isset($street_form)) {
    $sql_post = "INSERT INTO comments VALUES ('$time','$login','$company_name','','','','','$street_form','','')";
    $conn = mysqli_connect($servername, $username, $password, $database);
    $result = mysqli_query($conn, $sql_post);
}
if (isset($number_form)) {
    $sql_post = "INSERT INTO comments VALUES ('$time','$login','$company_name','','','','','','$number_form','')";
    $conn = mysqli_connect($servername, $username, $password, $database);
    $result = mysqli_query($conn, $sql_post);
}
if (isset($company_form)) {
    $sql_post = "INSERT INTO comments VALUES ('$time','$login','$company_name','','','','','','','$company_form')";
    $conn = mysqli_connect($servername, $username, $password, $database);
    $result = mysqli_query($conn, $sql_post);
}



