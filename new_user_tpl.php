<?php
require_once 'classes/display.php';
if (!$validUser) {
    header("Location: 404.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles/styles.css">
        <title>Заголовок</title>
    </head>
    <body>
        <div class="head">
            <div class="top-panel">
                <?php
                $display = new display();
                $display->topMenu();
                ?>
                <h1>Заголовок</h1>
            </div>
            <?php
            if ($database->validUser()) {
                $display->mainMenu();
            }
            ?>
        </div>
        <div class="content">
            <div class="tools-menu">
                <ul>
                    <li><a href="users.php">Пользователи</a></li>
                </ul>                
            </div>
            <p>Новый пользователь</p>
            <form class="new-user-form">
                <table class="new-user-table">
                    <tr>
                        <td><label class="login-label" for="login">Логин: </label></td>
                        <td><input type="text" name="login"></td>
                    </tr>
                    <tr>
                        <td><label class="password-label" for="password">Пароль: </label></td>
                        <td><input type="password" name="password"></td>
                    </tr>                   
                </table>
                <input class="add-user-btn" type="submit" value="Сохранить">
            </form>
            <form class="cancel-new-user" action="users.php">
                <input class="cancel-new-employee-btn" type="submit" value="Отмена">
            </form>
        </div>
    </body>
</html>




