<?php
    $_SESSION['display_header'] = "none";
    $_SESSION['title'] = "Регистрация";
    include_once "/var/www/blmd/components/header.php";

    //Регистрация + валидация
    if(isset($data['registration'])) {
        $data_login = $data['login'];
        $data_email = $data['email'];
        $data_password = $data['password'];
        $data_password_2 = $data['password_2'];
        $bool = 'yes';

        $sql_get = "SELECT login,email FROM users";
        $sql_post = "INSERT INTO users VALUES ('$data_login','$data_email','$data_password','$data_password_2')";
        $conn = mysqli_connect($servername, $username, $password, $database);

        $result = mysqli_query($conn, $sql_get);

        while($row = mysqli_fetch_array($result)) {
            $login = $row['login'];
            $email = $row['email'];

            if ($data_login == $login) {
                echo '<script type="text/javascript"> window.onload = function () { alert("Этот логин уже занят"); }</script>';
                $bool = 'no';
            }

            if ($data_email == $email) {
                echo '<script type="text/javascript"> window.onload = function () { alert("Этот email уже зарегистрирован"); }</script>';
                $bool = 'no';
            }
        }

        if ($data_password !== $data_password_2) {
            echo '<script type="text/javascript"> window.onload = function () { alert("Неправильно введен повторный пароль"); }</script>';
            $bool = 'no';
        }

        if ($bool == 'yes') {
            mysqli_query($conn, $sql_post);
            redirect('/index.php');
        }
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>

<main class="full-screen center_full">
    <form action="registration.php" method="post">
        <section class="center">
            <button onclick="back_to_index()">Назад</button>
        </section>
        <section>
            <section class="center_row input-login">
                <label><input type="text" name="login" placeholder="Логин" required></label>
                <label><input type="email" name="email" placeholder="Email" required></label>
            </section>
            <section class="center_row input-login">
                <label><input type="password" name="password" minlength="6" maxlength="12" placeholder="Пароль" required></label>
                <label><input type="text" name="password_2" placeholder="Повторение пароля" required></label>
            </section>
        </section>
        <section class="center">
            <button type="submit" name="registration">Далее</button>
        </section>
    </form>
</main>
</body>

<?php
    include_once "/var/www/blmd/components/footer.php";
?>
