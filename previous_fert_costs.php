<?php
require_once 'classes/database.php';

$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

require_once 'classes/previous_fert_costs.php';
require_once 'classes/common_functions.php';
require_once 'classes/display.php';

$prevousFertCosts = new previous_fert_costs();
$prevousFertCostsArr = $prevousFertCosts->getList();
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
            <div class="previous-fert-costs-menu">
                <?= $display->actionMenu('previous_fert_costs_action_form') ?>
                <?= $display->commonDataItemsMenu('previous_costs') ?>
            </div>
            <h2>Удобрения</h2>
            <div class="previous-fert-costs-list">
                <form class="previous_fert_costs_action_form" name="previous_fert_costs_action_form" action="previous_fert_costs_action.php" method="post">
                    <input type="hidden" id="form_action" name="form_action">
                    <table class="previous-fert-costs-list-table">
                        <tr>
                            <th></th>
                            <th>Удобрение</th>
                            <th>Израсходовано (тонн)</th>
                        </tr> 
                        <?php
                        foreach ($prevousFertCostsArr as $val) {
                            ?> 
                            <tr>
                                <td class="check"><input type="checkbox" name="selected_rows[]" value="<?= $val["id"] ?>"></td>
                                <td><?= $val["name"] ?></td>
                                <td><?= $val["weight"] ?></td>
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

