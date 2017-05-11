<?php
require_once 'classes/database.php';

$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

require_once 'classes/display.php';
require_once 'classes/departments.php';
require_once 'classes/cultures.php';
require_once 'classes/fields.php';
require_once 'classes/fertilizers.php';

$departments = new departments();
$departmentsArr = $departments->getList();
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

            <h2>Новый расход</h2>
            <form name="new_fert_exp" class="fert-exp-form" method="post" action="new_expense.php">
                <table>         
                    <tr>
                        <td class="fert-exp-form-lb">Отделение:</td>
                        <td class="fert-exp-form-input">
                            <select name="department" onchange="javascript:selectSubObjects('fields', this.value);">
                                <option></option>
                                <?php
                                foreach ($departmentsArr as $val) {
                                    echo "<option value='{$val['id']}'>" . $val['name'] . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td class="errors"><?= $errors['department'] ?></td>
                    </tr>  
                    <tr>
                        <td class="fert-exp-form-lb">№ поля:</td>
                        <td class="fert-exp-form-input">
                            <select id="fields" name="field" onchange="javascript:selectSowings(this.value);">
                            </select>
                        </td>
                        <td class="errors"><?= $errors['field'] ?></td>
                    </tr>         
                    <tr>
                        <td class="fert-exp-form-lb">Культура:</td>
                        <td class="fert-exp-form-input">
                            <select name="sowing" id="sowings" onchange="javascript:selectSowingArea(this.value);">
                                <option></option>
                            </select>
                        </td>
                        <td class="errors"><?= $errors['sowing'] ?></td>                        
                    </tr> 
                    <tr>
                        <td class="fert-exp-form-lb">Удобрение:</td>
                        <td class="fert-exp-form-input">
                            <input type="hidden" id="fertilizer" name="fertilizer" value="">
                            <select id="fert_plan" name="fert_plan" onchange="javascript:selectFertilizer(this.value);">
                                <option value="empty"></option>
                            </select>
                        </td>
                        <td class="errors"><?= $errors['fert_plan'] ?></td>                         
                    </tr>         
                    <tr>
                        <td class="fert-exp-form-lb">Обработанная площадь (га):</td>
                        <td class="fert-exp-form-input" id="treated_area"><input type="text" id="treated_area_input" name="treated_area"></td>
                        <td class="errors"><?= $errors['treated_area'] ?></td> 
                    </tr>                    
                    <tr>
                        <td class="fert-exp-form-lb">Полощадь посева:</td>
                        <td class="fert-exp-form-input" id="sowing_area">
                            <input id="sowing_area_val" type="text" name="sowing_area"  readonly="readonly">
                        </td>
                    </tr> 
                    <tr>
                        <td class="fert-exp-form-lb">Вес (тонн):</td>
                        <td class="fert-exp-form-input" id="weight_td"><input type="text" id="weight" name="weight" onchange="javascript:selectDiviation(this.value);"></td>
                        <td class="errors"><?= $errors['weight'] ?></td> 
                    </tr>        
                    <tr>
                        <td class="fert-exp-form-lb">Отклонение от нормы (тонн):</td>
                        <td class="fert-exp-form-input" id="deviation_td"><input type="text" id="deviation_val" name="deviation_val" readonly="readonly"></td>
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
