<?php
require_once 'classes/database.php';
$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

require_once 'classes/display.php';
require_once 'classes/fertilizer_plans.php';
require_once 'classes/cultures.php';
require_once 'classes/fertilizers.php';

$fertPlanID = $_GET['id'];

$fertilizerPlans = new fertilizer_plans();
$fertilizerPlansArr = $fertilizerPlans->getFertPlan($fertPlanID);

$cultures = new cultures();
$culturesArr = $cultures->getList();

$fertilizers = new fertilizers();
$fertilizersArr = $fertilizers->getList();
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
            <script>
                function cancel() {
                    window.location.href = "fertilizer_plans.php";
                }
            </script>
            <h2>Редактировать план</h2>
            <form name="new_fert_plan_form_exp" class="fert-plan-form" method="post" action="edit_fert_plan.php">
                <table>                         
                    <tr>
                        <td class="fert-plan-form-lb">Культура:</td>
                        <td class="fert-plan-form-input">
                            <select name="culture">
                                <option></option>
                                <?php
                                foreach ($culturesArr as $val) {
                                    if ($val['id'] === $fertilizerPlansArr[0]['culture_id']) {
                                        echo "<option selected value='{$val['id']}'>" . $val['name'] . "</option>";
                                    } else {
                                        echo "<option value='{$val['id']}'>" . $val['name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="fert-plan-form-lb">Удобрение:</td>
                        <td class="fert-plan-form-input">
                            <select name="fertilizer">
                                <option></option>
                                <?php
                                foreach ($fertilizersArr as $val) {
                                    if ($val['id'] === $fertilizerPlansArr[0]['fert_id']) {
                                        echo "<option selected value='{$val['id']}'>" . $val['name'] . "</option>";
                                    } else {
                                        echo "<option value='{$val['id']}'>" . $val['name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>         
                    <tr>
                        <td class="fert-plan-form-lb">Норма (т/га):</td>
                        <td class="fert-plan-form-input" id="norm"><input type="text" name="norm" value="<?= $fertilizerPlansArr[0]['norm'] ?>"></td>
                    </tr>         
                    <tr>
                        <td class="fert-plan-form-lb"></td>
                        <td class="fert-plan-form-input"><input type="submit" value="Сохранить" class="save-btn">&nbsp;
                            <input type="button" value="Отмена" onclick="cancel();" class="cancel-btn">
                            <input type="hidden" id="id" name="id" value="<?= $fertilizerPlansArr[0]['id'] ?>">
                        </td>
                    </tr> 
                </table>
            </form>
        </div>
    </body>
</html>