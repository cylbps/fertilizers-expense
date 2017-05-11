<?php
require_once 'classes/database.php';
$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

require_once 'classes/display.php';

require_once 'classes/departments.php';
require_once 'classes/fields.php';

$departments = new departments();

$departmentsArr = $departments->getList();

$fieldID = $_GET['id'];

$fields = new fields();
$fieldsArr = $fields->getField($fieldID);

$departmentID = $fieldsArr[0]['department_id'];
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
            $display->mainMenu('common_data');
            ?>
        </div>
        <div class="content">
            <script>
                function cancel() {
                    window.location.href = "fields.php";
                }
            </script>
            <h2>Редактировать поле</h2>
            <form name="new_field_exp" class="fert-field-form" method="post" action="edit_field.php">
                <table>                
                    <tr>
                        <td class="fert-field-form-lb">Наименование:</td>
                        <td class="fert-field-form-input" id="treated_area">
                            <input type ="hidden" name="id" value="<?= $fieldID ?>">
                            <input type="text" name="name" value="<?= $fieldsArr[0]['field_name'] ?>">
                        </td>
                    </tr>         
                    <tr>
                        <td class="fert-field-form-lb">Отделение:</td>
                        <td class="fert-field-form-input">
                            <select name="department">
                                <option></option>
                                <?php
                                foreach ($departmentsArr as $val) {
                                    if ($val['id'] === $departmentID) {
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
                        <td class="fert-field-form-lb">Площадь (га):</td>
                        <td class="fert-field-form-input" id="area"><input type="text" name="total_area" value="<?= $fieldsArr[0]['total_area'] ?>"></td>
                    </tr>         
                    <tr>
                        <td class="fert-field-form-lb"></td>
                        <td class="fert-field-form-input"><input type="submit" value="Сохранить" class="save-btn">&nbsp;
                            <input type="button" value="Отмена" onclick="cancel();" class="cancel-btn">
                        </td>
                    </tr> 
                </table>
            </form>
        </div>
    </body>
</html>