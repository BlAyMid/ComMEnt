<?php
    //Создание сессии и передача данных
    session_start();
    $_SESSION['verified'] = "false";
    $_SESSION['sessionID'] = session_id();
    $_SESSION['display_header'] = "none";
    $_SESSION['title'] = "Вход";

    //Подключение компонентов
    include "components/header.php";
    include "components/main.php";
    include "components/footer.php";

    //Пост запрос авторизация
    if(isset($data['btn-login'])) {
            $data_login = $data['login'];
            $data_password = $data['password'];

            $sql = "SELECT login,password FROM users";
            $conn = mysqli_connect($servername, $username, $password, $database);
            $result = mysqli_query($conn, $sql);

            //Цикл для проверки на соответствие базе
            while($row = mysqli_fetch_array($result)) {
                $login = $row['login'];
                $password = $row['password'];

                if ($data_login == $login and $data_password == $password) {
                    $_SESSION['verified'] = "true";
                    $_SESSION['user'] = $data_login;
                    redirect('/pages/home.php');
                } else {
                    echo '<script type="text/javascript"> window.onload = function () { alert("Вы неправильно ввели логин или пароль"); }</script>';
                }
            }
            mysqli_close($conn);
    }
?>


