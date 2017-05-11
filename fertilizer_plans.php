<?php
require_once 'classes/database.php';
$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

require_once 'classes/fertilizer_plans.php';
$fertilizerPlans = new fertilizer_plans();
$fertilizerPlansArr = $fertilizerPlans->getList();

require_once 'classes/display.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles/styles.css">
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
            $display->mainMenu('fertilizer_expense');
            ?>
        </div>
        <div class="content">
            <div class="fert-exp-menu">
                <?= $display->actionMenu('fert_plans_action_form') ?>
                <?= $display->fertOtherItemsMenu('fertilizer_plans') ?>
            </div>
            <h2 class="h-print">Планы расхода удобрений</h2>
            <div class="fert-plans-list">
                <form class="fert_plans_action_form" name="fert_plans_action_form" action="fert_plans_action.php" method="post">
                    <input type="hidden" id="form_action" name="form_action">
                    <table class="fert-plans-list-table">
                        <tr>
                            <th class="check"></th>
                            <th>Культура</th>
                            <th>Удобрение</th>
                            <th>Норма (т/га)</th>
                        </tr> 
                        <?php
                        foreach ($fertilizerPlansArr as $val) {
                            ?> 
                            <tr>
                                <td class="check"><input type="checkbox" name="selected_rows[]" value="<?= $val["fert_plans_id"] ?>"></td>
                                <td><?= $val["cult_name"] ?></td>
                                <td><a href="edit_fert_plan.php?id=<?= $val["fert_plans_id"] ?>"><?= $val["fert_name"] ?></a></td>
                                <td><?= $val["norm"] ?></td>
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

