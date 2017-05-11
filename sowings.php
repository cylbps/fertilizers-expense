<?php
require_once 'classes/database.php';

$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

require_once 'classes/sowings.php';
require_once 'classes/common_functions.php';
require_once 'classes/display.php';

$sowigs = new sowings();
$sowingsArr = $sowigs->getList();

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
                <?= $display->actionMenu('sowing_action_form') ?>
                <?= $display->commonDataItemsMenu('no') ?>
            </div>
            <h2>Посевы</h2>
            <div class="fert-sowings-list">
                <form class="sowing_action_form" name="sowing_action_form" action="sowing_action.php" method="post">
                    <input type="hidden" id="form_action" name="form_action">
                    <table class="fert-sowings-list-table">
                        <tr>
                            <th></th>
                            <th>Поле</th>
                            <th>Культура</th>
                            <th>Площадь (га)</th>
                        </tr> 
                        <?php
                        foreach ($sowingsArr as $val) {
                            ?> 
                            <tr>
                                <td class="check"><input type="checkbox" name="selected_rows[]" value="<?= $val["sowing_id"] ?>"></td>
                                <td><?= $val["fields_name"] ?></td>
                                <td><a href="edit_sowing.php?id=<?= $val["sowing_id"] ?>"><?= $val["cultures_name"] ?></a></td>
                                <td><?= $val["area"] ?></td>
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

