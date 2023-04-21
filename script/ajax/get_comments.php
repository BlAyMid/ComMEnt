<?php
include_once '/var/www/blmd/components/db.php';
session_start();
$data = $_POST;
$comment = $data['get_comment'];
$_SESSION['company-name'] = $comment;

//Получение комменариев и выдача в виде json элемента
$sql_get = "SELECT date,login,name_company,name,inn,info,boss,street,number,comment_company FROM `comments`";
$conn = mysqli_connect($servername, $username, $password, $database);
$result = mysqli_query($conn, $sql_get);
$array = array();
while($row = mysqli_fetch_array($result)) {

    $name = $row['name_company'];

    if ($comment == $name) {
            array_push($array,$row['date'],$row['login'],$row['name_company'],
                $row['name'],$row['inn'],$row['info'],$row['boss'],$row['street'],$row['number'],$row['comment_company']);
    }
}
echo json_encode($array);