<?php
require_once 'classes/database.php';

$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

require_once 'classes/cultures.php';
$cultures = new cultures();
$culturesArr = $cultures->getList();

require_once 'classes/display.php';
$display = new display();
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
            <div class="fert-exp-menu">
                <?= $display->actionMenu('cultures_action_form') ?> 
                <?= $display->commonDataItemsMenu('no') ?>
            </div>
            <h2>Культуры</h2>
            <div class="fert-cultures-list">
                <form class="cultures_action_form" name="cultures_action_form" action="culture_action.php" method="post">
                    <input type="hidden" id="form_action" name="form_action">
                    <table class="fert-cultures-list-table">
                        <tr>
                            <th></th>
                            <th>Наименование</th>
                        </tr> 
                        <?php
                        foreach ($culturesArr as $val) {
                            ?> 
                            <tr>
                                <td class="check"><input type="checkbox" name="selected_rows[]" value="<?= $val["id"] ?>"></td>
                                <td><a href="edit_culture.php?id=<?= $val["id"] ?>"><?= stripslashes($val["name"]) ?></a></td>
                            </tr>           
                            <?php
                        }
                        ?>   
                    </table>
                </form>
            </div>            
        </div>
    </body>
</html>            

