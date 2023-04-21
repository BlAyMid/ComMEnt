<?php
//Уничтожение сессии
session_start();
unset($_COOKIE[session_name()]);
unset($_COOKIE[session_id()]);
session_unset();
session_destroy();
function redirect($url)
{
    header('Location: ' . $url);
    exit();
}
redirect('/index.php');
exit;