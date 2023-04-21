<?php
    //Запуск сессии и передача данных в переменные
    session_start();

    $_SESSION['display_header'] = "grid";
    $_SESSION['title'] = "ComMEnt";

    include_once "/var/www/blmd/components/header.php";

    //Проверка на авторизацию
    if($_SESSION['verified'] === "false" or (empty($_SESSION['verified']))) {
        redirect('/index.php');
    } else {
        $sql_get = "SELECT name,inn,info,boss,street,number FROM company";

        $conn = mysqli_connect($servername, $username, $password, $database);
        $result = mysqli_query($conn, $sql_get);

        //Создание компаний для дальнейшего использования
        echo "<main class='full-screen'>";
        echo "<section id='company' style='display: flex; justify-content: center; flex-wrap: wrap'>" ;

        while($row = mysqli_fetch_array($result)) {
            $name = $row['name'];
            $inn = $row['inn'];
            $info = $row['info'];
            $boss = $row['boss'];
            $street = $row['street'];
            $number = $row['number'];

            echo "<section id=\"company-block\" class='center_row company-block' onclick='addNum(this);'>
                    <section id='company-block-name' class='center_full company-block-name'><p>$name</p></section>\n
                    <section id='company-block-inn' class='center_full company-block-data'><p>$inn</p></section>\n
                    <section id='company-block-info' class='center_full company-block-data'><p>$info</p></section>\n
                    <section id='company-block-boss' class='center_full company-block-data'><p>$boss</p></section>\n
                    <section id='company-block-street' class='center_full company-block-data'><p>$street</p></section>\n
                    <section id='company-block-number' class='center_full company-block-data'><p>$number</p></section>\n
                    </section>";
        }
        echo "</section>";

        //Регистрация новой компании
        if(isset($data['new-company'])) {
            $data_name = $data['name'];
            $data_inn = $data['inn'];
            $data_info = $data['info'];
            $data_boss = $data['boss'];
            $data_street = $data['street'];
            $data_number = $data['number'];
            $bool = 'no';

            $sql_post = "INSERT INTO company VALUES ('$data_name','$data_inn','$data_info','$data_boss','$data_street','$data_number')";

            $sql_get = "SELECT name,inn,info,boss,street,number FROM company";

            $conn = mysqli_connect($servername, $username, $password, $database);
            $result = mysqli_query($conn, $sql_get);

            while($row = mysqli_fetch_array($result)) {
                $name = $row['name'];
                $inn = $row['inn'];
                $info = $row['info'];
                $boss = $row['boss'];
                $street = $row['street'];
                $number = $row['number'];

                if ($data_name == $name) {
                    echo '<script type="text/javascript"> window.onload = function () { alert("Компания с таким названием уже зарегистрирована"); }</script>';
                    $bool = 'yes';
                    break;
                }
            }

            if ($bool == 'no') {
                mysqli_query($conn, $sql_post);
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }

        //Удаление компании
        if(isset($data['aside-data-btn-sure'])) {
            $company_name = trim($_SESSION['company-name']);
            $sql_get = "SELECT name FROM company";

            $conn = mysqli_connect($servername, $username, $password, $database);
            $result = mysqli_query($conn, $sql_get);
            while($row = mysqli_fetch_array($result)) {
                $name = $row['name'];

                if ($company_name == $name) {
                    $sql_post = "DELETE FROM company where name='".$company_name."'";
                    $conn = mysqli_connect($servername, $username, $password, $database);
                    $result = mysqli_query($conn, $sql_post);
                    echo "<meta http-equiv='refresh' content='0'>";
                }
            }
        }
        mysqli_close($conn);
    }

?>

<!DOCTYPE html>
    <section id="aside">
        <section id="aside-data">
            <section id="aside-data-name" class="aside_data">
                <section class="space">
                    <h1>Название</h1>
                    <p id="aside-data-name-comment-p" onclick="comment(this.element)">Прокомментировать</p>
                </section>
                <p id="aside-data-name-p" class="aside_p"></p>
                <form name="aside-data-name-form" id="name-form-form" class="center_full" style="display: none">
                    <label><input type="text" name="aside-data-name-inp" id="name-form-inp" class="input-send"></label>
                    <button type="submit" name="aside-data-name-btn">send</button>
                </form>
                <section id="aside-data-name-comment">
                    <!--Секция для получения в неё комментариев-->
                </section>
            </section>
            <section id="aside-data-inn" class="aside_data">
                <section class="space">
                    <h1>ИНН</h1>
                    <p id="aside-data-inn-comment-p" onclick="comment()">Прокомментировать</p>
                </section>
                <p id="aside-data-inn-p" class="aside_p"></p>
                <form name="aside-data-inn-form" id="inn-form-form" class="center_full" style="display: none">
                    <label><input type="text" name="aside-data-inn-inp" id="inn-form-inp" class="input-send"></label>
                    <button type="submit" name="aside-data-inn-btn">send</button>
                </form>
                <section id="aside-data-inn-comment">
                    <!--Секция для получения в неё комментариев-->
                </section>
            </section>
            <section id="aside-data-info" class="aside_data">
                <section class="space">
                    <h1>Общая информация</h1>
                    <p id="aside-data-info-comment-p" onclick="comment()">Прокомментировать</p>
                </section>
                <p id="aside-data-info-p" class="aside_p"></p>
                <form name="aside-data-info-form" id="info-form-form" class="center_full" style="display: none">
                    <label><input type="text" name="aside-data-info-inp" id="info-form-inp" class="input-send"></label>
                    <button type="submit" name="aside-data-info-btn">send</button>
                </form>
                <section id="aside-data-info-comment">
                    <!--Секция для получения в неё комментариев-->
                </section>
            </section>
            <section id="aside-data-boss" class="aside_data">
                <section class="space">
                    <h1>Генеральный директор</h1>
                    <p id="aside-data-boss-comment-p" onclick="comment()">Прокомментировать</p>
                </section>
                <p id="aside-data-boss-p" class="aside_p"></p>
                <form name="aside-data-boss-form" id="boss-form-form" class="center_full" style="display: none">
                    <label><input type="text" name="aside-data-boss-inp" id="boss-form-inp" class="input-send"></label>
                    <button type="submit" name="aside-data-boss-btn">send</button>
                </form>
                <section id="aside-data-boss-comment">
                    <!--Секция для получения в неё комментариев-->
                </section>
            </section>
            <section id="aside-data-street" class="aside_data">
                <section class="space">
                    <h1>Адрес</h1>
                    <p id="aside-data-street-comment-p" onclick="comment()">Прокомментировать</p>
                </section>
                <p id="aside-data-street-p" class="aside_p"></p>
                <form name="aside-data-street-form" id="street-form-form" class="center_full" style="display: none">
                    <label><input type="text" name="aside-data-street-inp" id="street-form-inp" class="input-send"></label>
                    <button type="submit" name="aside-data-street-btn">send</button>
                </form>
                <section id="aside-data-street-comment">
                    <!--Секция для получения в неё комментариев-->
                </section>
            </section>
            <section id="aside-data-number" class="aside_data">
                <section class="space">
                    <h1>Телефон</h1>
                    <p id="aside-data-number-comment-p" onclick="comment()">Прокомментировать</p>
                </section>
                <p id="aside-data-number-p" class="aside_p"></p>
                <form name="aside-data-number-form" id="number-form-form" class="center_full" style="display: none">
                    <label><input type="text" name="aside-data-number-inp" id="number-form-inp" class="input-send"></label>
                    <button type="submit" name="aside-data-number-btn">send</button>
                </form>
                <section id="aside-data-number-comment">
                    <!--Секция для получения в неё комментариев-->
                </section>
            </section>
            <section id="aside-data-comment" class="aside_data">
                <section class="space">
                    <h1>Ваше мнение о компании</h1>
                    <p id="aside-data-comment-comment-p" onclick="comment()">Прокомментировать</p>
                </section>
                <form name="aside-data-company-form" id="company-form-form" class="center_full" style="display: none">
                    <label><input type="text" name="aside-data-company-inp" id="company-form-inp" class="input-send"></label>
                    <button type="submit" name="aside-data-company-btn">send</button>
                </form>
                <section id="aside-data-company-comment">
                    <!--Секция для получения в неё комментариев-->
                </section>
            </section>
            <section id="aside-data-btn">
                <section class="center">
                    <button onclick="delete_aside();">Удалить</button>
                    <button id="aside-data-button" onclick="hide_aside();">Свернуть</button>
                </section>
                <section id="aside-data-btn-sure" style="display: none">
                    <section class="center">
                        <h1>Вы уверены?</h1>
                    </section>
                    <section class="center">
                        <form action="" method="post">
                            <button type="submit" name="aside-data-btn-sure">Да</button>
                        </form>
                        <button id="aside-data-btn-sure-non" onclick="delete_aside();">Нет</button>
                    </section>
                </section>
            </section>
        </section>
    </section>

    <!--Pop-up блок для регистрации компании-->
    <article id="create-company">
        <section class="center">
            <button onclick="new_company()">Новая компания</button>
        </section>
        <section id="create-company-popup">
            <form id="create-company-popup-form"  action="" method="post">
                <section>
                    <button onclick="new_company()">Назад</button>
                </section>
                <section class="input-login">
                    <label><input type="text" placeholder="Названия" name="name" maxlength="20" required></label>
                    <label><input type="text" placeholder="ИНН" name="inn" maxlength="40" required></label>
                    <label><input type="text" placeholder="Общая информация" name="info" maxlength="40" required></label>
                    <label><input type="text" placeholder="Генеральный директор" name="boss" maxlength="20" required></label>
                    <label><input type="text" placeholder="Адрес" name="street" maxlength="40" required></label>
                    <label><input type="text" placeholder="Телефон" name="number" maxlength="20" required></label>
                </section>
                <section>
                    <button type="submit" name="new-company">Готово</button>
                </section>
            </form>
        </section>
    </article>
</main>
</body>
    <script>
        <?php require_once("/var/www/blmd/script/js/main.js");?>
    </script>

<?php
    include_once "/var/www/blmd/components/footer.php";
?>