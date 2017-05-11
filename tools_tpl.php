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
            $display->mainMenu();
            ?>
        </div>
        <div class="content">
            <div class="tools-menu">
                <ul>
                    <li><a href="users.php">Пользователи</a></li>
                </ul>
            </div>
        </div>
    </body>
</html>


