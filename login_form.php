<?php
if (session_status() !== 2) {
    session_start();
}
if (!empty($_SESSION['message'])) {
    $message = '<span class="message">' . $_SESSION['message'] . '</span><br>';
    session_destroy();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles/login.css">
        <link rel="shortcut icon" href="images/favicon.png" type="image/png">
        <title>Полевые работы</title>
    </head>
    <body>
        <div class="head">
            <h1>Полевые работы АО "АФ "Заречье"</h1>
        </div>
        <div class="login">
            <fieldset>
                <legend>Авторизация</legend>
                <?php if (isset($message)) echo $message; ?>
                <form method="post" action="login.php">
                    <table>
                        <tr>
                            <td>Имя пользователя:</td><td><input type="text" name="user"></td>
                        </tr>
                        <tr>
                            <td>Пароль:</td><td><input type="password" name="password"></td>
                        </tr>  
                        <tr>
                            <td></td><td><input type="submit" value="Войти"></td>
                        </tr>                     
                    </table>
                </form>
            </fieldset>
        </div>     
    </body>
</html>