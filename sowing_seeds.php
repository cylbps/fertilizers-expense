<?php
require_once 'classes/database.php';

$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

require_once 'classes/sowing_seeds.php';
require_once 'classes/common_functions.php';
require_once 'classes/display.php';

$sowingSeeds = new sowing_seeds();
$sowingSeedsArr = $sowingSeeds->getList();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles/styles.css">
        <link rel="stylesheet" href="styles/common_data.css">
        <link rel="stylesheet" href="styles/sowing_seeds.css"> 
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
            $display->mainMenu('sowing_seeds');
            ?>
        </div>
        <div class="content">
            <div class="sowing-seeds-menu">
                <?= $display->actionMenu('sow_seeds_action_form') ?>
                <?= $display->sowSeedsOtherItemsMenu('no') ?>
            </div>
            <h2 class="h-print">Посев семян</h2>
            <div class="sowing-seeds-list">
                <form class="sow_seeds_action_form" name="sow_seeds_action_form" id="sow_seeds_action_form" action="#" method="post">
                    <input type="hidden" id="form_action" name="form_action">
                    <table class="sow-seeds-list-table">
                        <tr>
                            <th class="check"></th>
                            <th>Дата</th>
                            <th>Поле</th>
                            <th>Культура</th>
                            <th>Сорт</th>
                            <th>Репродукция</th>
                            <th>Засеянная площадь (га)</th>
                            <th>Вес (тонн)</th>
                            <th>Отклонение от нормы</th>
                        </tr> 
                        <?php
                        foreach ($sowingSeedsArr as $val) {
                            $date_val = $val["sow_seeds_date"];
                            $date = new DateTime($date_val);
                            ?> 
                            <tr>
                                <td class="check"><input type="checkbox" name="selected_rows[]" value="<?= $val["sow_seeds_id"] ?>"></td>
                                <td><?= $date->format('d.m.Y H:i:s') ?></td>
                                <td><?= $val["field_name"] ?></td>
                                <td><?= $val["culture_name"] ?></td>
                                <td><?= $val["grade_name"] ?></td>
                                <td><?= $val["sow_seeds_reproduction"] ?></td>
                                <td><?= $val["sow_seeds_sown_area"] ?></td>
                                <td><?= $val["sow_seeds_weight"] ?></td>
                                <td><?= $val["sow_seeds_deviation"] ?></td>
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


