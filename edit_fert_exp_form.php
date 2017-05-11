<?php
require_once 'classes/database.php';

$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}
?>

<?php
require_once 'classes/fertilizer_expense.php';
require_once 'classes/fields.php';
require_once 'classes/sowings.php';
require_once 'classes/fertilizers.php';
require_once 'classes/fertilizer_plans.php';
require_once 'classes/departments.php';
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
            <script src="ajax_functions.js"></script>
            <script>
                var myReq = getXMLHTTPRequest();
            </script>
            <script>
                function cancel() {
                    window.location.href = "fertilizer_expense_full.php";
                }
            </script>
            <h2>Редактировать расход</h2>

            <?php
            $fertExpID = $_GET['id'];
            $fertilizerExpense = new fertilizer_expense();
            $fertArr = $fertilizerExpense->getFertilizerExpense($fertExpID);

            $fertDate = new DateTime($fertArr[0]['release_date']);

            $departments = new departments();
            $departmentsArr = $departments->getList();

            $fields = new fields();
            $fieldsArr = $fields->getFieldsOnDepartment($fertArr[0]['fert_dep_id']);

            $sowings = new sowings();
            $sowingsArr = $sowings->SowingsToField($fertArr[0]['fert_field_id']);

            $fertilizers = new fertilizers();
            $fertilizersArr = $fertilizers->getList();

            $fertilizerPlans = new fertilizer_plans();
            $fertPlansArr = $fertilizerPlans->fertPlanToSowing($fertArr[0]['sowing_id']);
            ?>
            <form name="edit_fert_exp" class="fert-exp-form" method="post" action="edit_fert_exp.php?id=<?= $fertExpID ?>">
                <table>
                    <tr>
                        <td class="fert-exp-form-lb">Дата:</td>
                        <td class="fert-exp-form-input" id="fert_release_date">
                            <input type="hidden" name="id" value="<?= $fertExpID ?>">
                            <input type="text" name="fert_release_date" readonly="readonly" value="<?= $fertDate->format('d.m.Y H:i:s') ?>">
                        </td>
                    </tr>       
                    <tr>
                        <td class="fert-exp-form-lb">Отделение:</td>
                        <td class="fert-exp-form-input">
                            <select name="department" onchange="javascript:selectSubObjects('fields', this.value);">
                                <option></option>
                                <?php
                                foreach ($departmentsArr as $val) {
                                    if ($val['id'] === $fertArr[0]['fert_dep_id']) {
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
                        <td class="fert-exp-form-lb">№ поля:</td>
                        <td class="fert-exp-form-input">
                            <select id="fields" name="field" onchange="javascript:selectSowings(this.value);">
                                <option></option>
                                <?php
                                foreach ($fieldsArr as $val) {
                                    if ($val['id'] === $fertArr[0]['fert_field_id']) {
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
                        <td class="fert-exp-form-lb">Культура:</td>
                        <td class="fert-exp-form-input">
                            <select name="sowing" id="sowings" onchange="javascript:selectSowingArea(this.value);">
                                <option></option>
                                <?php
                                foreach ($sowingsArr as $val) {
                                    if ($val['id'] === $fertArr[0]['sowing_id']) {
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
                        <td class="fert-exp-form-lb">Удобрение:</td>
                        <td class="fert-exp-form-input">
                            <input type="hidden" id="fertilizer" name="fertilizer" value="<?= $fertArr[0]['fertilizer_id'] ?>">
                            <select id="fert_plan" name="fert_plan" onchange="javascript:selectFertilizer(this.value);">
                                <option value="empty"></option>
                                <?php
                                foreach ($fertPlansArr as $val) {
                                    if ($val['fert_id'] === $fertArr[0]['fertilizer_id']) {
                                        echo '<option selected value="' . $val['fert_plan_id'] . '">' . $val['name'] . " (" . $val['norm'] . ')</option>';
                                    } else {
                                        echo '<option value="' . $val['fert_plan_id'] . '">' . $val['name'] . " (" . $val['norm'] . ')</option>';
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>  
                    <tr>
                        <td class="fert-exp-form-lb">Обработанная площадь (га):</td>
                        <td class="fert-exp-form-input" id="treated_area"><input type="text" id="treated_area_input" name="treated_area" value="<?= $fertArr[0]['treated_area'] ?>"></td>
                    </tr> 
                    <tr>
                        <td class="fert-exp-form-lb">Полощадь посева (га):</td>
                        <td class="fert-exp-form-input" id="sowing_area">
                            <input id="sowing_area_val" type="text" name="sowing_area" readonly="readonly" value="<?= $fertArr[0]['sow_area'] ?>">
                        </td>
                    </tr> 
                    <tr>
                        <td class="fert-exp-form-lb">Вес (тонн):</td>
                        <td class="fert-exp-form-input" id="weight_td">
                            <input type="text" id="weight" name="weight" onchange="javascript:selectDiviation(this.value);" value="<?= $fertArr[0]['weight'] ?>">
                        </td>
                    </tr> 
                    <tr>
                        <td class="fert-exp-form-lb">Отклонение от нормы (тонн):</td>
                        <td class="fert-exp-form-input" id="deviation_td">
                            <input type="text" name="deviation_val" readonly="readonly" value="<?= $fertArr[0]['deviation'] ?>">
                        </td>
                    </tr> 
                    <tr>
                        <td class="fert-exp-form-lb"></td>
                        <td class="fert-exp-form-input"><input type="submit" value="Сохранить" class="save-btn">&nbsp;
                            <input type="button" value="Отмена" onclick="cancel();" class="cancel-btn">
                        </td>
                    </tr>        
                </table>
            </form>
        </div>
    </body>
</html>

