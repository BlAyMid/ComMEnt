<?php
    //Передача данных в переменные
    $display_header = $_SESSION['display_header'];
    $title = $_SESSION['title'];
    $data = $_POST;

    //функция редиректа для использования в других файлах
    function redirect($url)
    {
        header('Location: ' . $url);
        exit();
    }

    require_once '/var/www/blmd/components/db.php';
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $title; ?> </title>
    <link rel="stylesheet" href="/style/css/style.css" type="text/css">
    <link rel="stylesheet" href="/style/css/style1920x1080.css" media="screen and (max-width: 1920px) and (max-height: 1080px)" type="text/css"> <!--компьютер fullhd(1920x1080)!-->
    <link rel="stylesheet" href="/style/css/style1366x768.css" media="screen and (max-width: 1366px) and (max-height: 768px)" type="text/css"> <!--компьютер(1366х768)!-->
    <link rel="stylesheet" href="/style/css/style1280x1024.css" media="screen and (max-width: 1280px) and (max-height: 1024px)" type="text/css"> <!--!-->
    <link rel="stylesheet" href="/style/css/style1280x800.css" media="screen and (max-width: 1280px) and (max-height: 800px)" type="text/css"> <!--!-->
    <link rel="stylesheet" href="/style/css/style800x1280.css" media="screen and (max-width: 800px) and (max-height: 1280px)" type="text/css"> <!--!-->
    <link rel="stylesheet" href="/style/css/style1024x768.css" media="screen and (max-width: 1024px) and (max-height: 768px)" type="text/css"> <!--!-->
    <link rel="stylesheet" href="/style/css/style768x1024.css" media="screen and (max-width: 768px) and (max-height: 1024px)" type="text/css"> <!---->
    <link rel="stylesheet" href="/style/css/style640x480.css" media="screen and (max-width: 640px) and (max-height: 480px)" type="text/css"> <!--!-->
    <link rel="stylesheet" href="/style/css/style414x896.css" media="screen and (max-width: 414px) and (max-height: 896px)" type="text/css"> <!--!-->
    <link rel="stylesheet" href="/style/css/style360x800.css" media="screen and (max-width: 360px) and (max-height: 800px)" type="text/css"> <!--!-->
    <link rel="stylesheet" href="/style/css/style360x640.css" media="screen and (max-width: 360px) and (max-height: 640px)" type="text/css"> <!--!-->
</head>

<body class="full-screen">
<header>
    <nav style="display: <?php echo $display_header; ?>">
        <ul>
            <li><a href="#">Лого</a></li>
            <li><a href="/pages/about.php">О нас</a></li>
            <li><a href="/pages/home.php">Компании</a></li>
            <li><a href="/components/exit.php">Выход</a></li>
        </ul>
    </nav>
</header>