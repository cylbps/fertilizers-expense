<?php
require_once 'classes/database.php';
$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

require_once 'classes/fertilizer_expense.php';
require_once 'classes/common_functions.php';
require_once 'classes/display.php';
require_once 'classes/previous_fert_costs.php';

$fertilizerExpense = new fertilizer_expense();
$fertArray = $fertilizerExpense->getList();

$commonFunctions = new common_functions();
$totalSowingsArea = $commonFunctions->totalSowingsArea();

$totalWeightFert = $commonFunctions->totalWeightFert();

$totalTrAreaFert = $commonFunctions->totalTrAreaFert();

$totalArr = $commonFunctions->totalFertilizerExpense();

$prevousFertCosts = new previous_fert_costs();
$prevousFertCostsArr = $prevousFertCosts->getList();

$previousWeightFertCost = $prevousFertCosts->prevousWeightFertCost();

$totalWeightFertCost = $prevousFertCosts->totalWeightFertCost();

date_default_timezone_set('Etc/GMT-3');
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
                <?= $display->actionMenu('fert_action_form') ?>
                <?= $display->fertOtherItemsMenu('no') ?>
            </div>
            <h2 class="h-print">Расход удобрений</h2>
            <div class="fert-exp-list">
                <form class="fert_action_form" name="fert_action_form" id="fert_action_form" action="fert_action.php" method="post">
                    <input type="hidden" id="form_action" name="form_action">
                    <table class="fert-exp-list-table">
                        <tr>
                            <th class="check"></th>
                            <th>Дата</th>
                            <th>Удобрение</th>
                            <th>Отделение</th>
                            <th>№ поля</th>
                            <th>Культура</th>
                            <th>Обработанная площадь (га)</th>
                            <th>Площадь посева (га)</th>
                            <th>Вес (тонн)</th> 
                            <th>Отклонение от нормы (тонн)</th>
                        </tr> 
                        <?php
                        foreach ($fertArray as $val) {
                            $date_val = $val["release_date"];
                            $date = new DateTime($date_val);
                            ?> 
                            <tr>
                                <td class="check"><input type="checkbox" name="selected_rows[]" value="<?= $val["fert_exp_id"] ?>"></td>
                                <td><?= $date->format('d.m.Y H:i:s') ?></td>
                                <td><a href="edit_fert_exp.php?id=<?= $val["fert_exp_id"] ?>"><?= $val["fert_name"] ?></a></td>
                                <td><?= $val["dep_name"] ?></td>
                                <td><?= $val["field_name"] ?></td>
                                <td><?= $val["cname"] ?></td>
                                <td><?= $val["treated_area"] ?></td>
                                <td><?= $val["sow_area"] ?></td>
                                <td><?= $val["weight"] ?></td>
                                <td><?php
                                    if ($val["deviation"] != 0)
                                        echo '<div class="fert-dev-td">' . $val['deviation'] . "</div>";
                                    else
                                        echo $val['deviation']
                                        ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>   
                    </table>
                </form>
                <div class="total_fert_exp">
                    <p>Итоги</p>
                    <table>
                        <tr>
                            <th>Удобрение</th>
                            <th>Внесено (тонн)</th>
                            <th>Предыдущие расходы</th>
                            <th>Обработанная площадь (га)</th>
                        </tr> 
                        <?php
                        foreach ($totalArr as $val) {
                            ?>
                            <tr>
                                <td><?= $val["name"] ?></td>
                                <?php
                                $prevFert = 0;
                                foreach ($prevousFertCostsArr as $prevVal) {
                                    if ($val["fertilizer_id"] === $prevVal["fertilizer_id"]) {
                                        $prevFert = $prevVal["weight"];
                                        break;
                                    }
                                }
                                ?>
                                <td><?= $val["SUM(weight)"] ?></td>
                                <td><?= number_format($prevFert, 3, '.', ' ') ?></td>
                                <td><?= $val["SUM(treated_area)"] ?></td>
                            </tr> 
                            <?php
                        }
                        ?>
                        <tfoot>
                            <tr>
                                <td class="total_td">Всего:</td>
                                <td class="total_td"><?= $totalWeightFert ?></td>
                                <td class="total_td"><?= $totalWeightFertCost ?></td>
                                <td class="total_td"><?= $totalTrAreaFert ?></td>
                            </tr>
                            <tr>
                                <td class="total_td">Итого (тонн):</td>
                                <td class="total_td" colspan="3"><?= number_format($totalWeightFert + $totalWeightFertCost, 3, '.', ' ') ?></td>
                            </tr>                            
                        </tfoot> 
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>