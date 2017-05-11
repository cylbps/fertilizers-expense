<?php
require_once 'classes/database.php';

$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

require_once 'classes/common_functions.php';
require_once 'classes/display.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles/styles.css">
        <link rel="stylesheet" href="styles/common_data.css">
        <title>Полевые работы</title>
        <script src="lib.js"></script>
    </head>
    <body>
        <div class="head">
            <div class="top-panel">
                <?php
                $display = new display();
                $display->topMenu();
                ?>
                <h1>Полевые работы АО "АФ "Заречье"</h1>
            </div> 
            <?php
            $display->mainMenu('common_data');
            ?>
        </div>
        <div class="content">
            <div class="common-data-menu">
                <?= $display->commonDataItemsMenu('no') ?>
            </div>
            <div class="common-data-list">
                    <table class="common-data-list-table">
                        <tr>
                            <th>Наименование</th>
                        </tr> 
                        <tr>
                            <td><a href="departments.php">Подразделения</a></td>
                        </tr>                          
                        <tr>
                            <td><a href="fields.php">Поля</a></td>
                        </tr>  
                        <tr>
                            <td><a href="cultures.php">Культуры</a></td>
                        </tr>
                        <tr>
                            <td><a href="fertilizers.php">Удобрения</a></td>
                        </tr>
                        <tr>
                            <td><a href="sowings.php">Посевы</a></td>
                        </tr>
                    </table>
            </div>
        </div>
    </body>
</html>            


