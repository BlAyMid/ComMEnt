<?php
$_SESSION['display_header'] = "grid";
$_SESSION['title'] = "О нас";
include_once "/var/www/blmd/components/header.php";
?>

<main>
    <article class="center_row full-screen">
        <section>
            <p style="text-align: center">Здравствуйте, меня зовут Егор.</p>
            <p>Я выполнял данное тестовое задание.</p>
        </section>
        <section class="center_row">
            <p>Полезные ссылки:</p>
                <ul class="center_row">
                    <li><p>Telegram (связь со мной): <a href="https://t.me/blmzd" target="_blank">ТГ</a></p></li>
                    <li><p>Репозиторий с данным заданием: <a href="https://github.com/BlAyMid/ComMEnt" target="_blank">GitHub</a></p></li>
                    <li><p>Архив с данным заданием + пояснения: <a href="https://github.com/BlAyMid/ComMEnt/archive/refs/heads/master.zip" target="_blank">Архив</a></p></li>
                </ul>
        </section>
    </article>
</main>
</body>

<?php
include_once "/var/www/blmd/components/footer.php";
?>
