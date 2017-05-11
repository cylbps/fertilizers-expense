<?php
require_once 'classes/database.php';

$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

require_once 'classes/display.php';

require_once 'classes/departments.php';

$departments = new departments();

$departmentID = $_GET['id'];
$departmentsArr = $departments->getDepartment($departmentID);
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
                    window.location.href = "departments.php";
                }
            </script>
            <h2>Редактировать отделение</h2>
            <form name="edit_dep_exp" class="fert-dep-form" method="post" action="edit_department.php">
                <table>
                    <tr>
                        <td class="fert-dep-form-lb">Наименование:</td>
                        <td class="fert-dep-form-input" id="treated_area"><input type="text" name="name" value="<?= $departmentsArr[0]['name'] ?>"></td>
                    </tr>    
                    <tr>
                        <td class="fert-dep-form-lb"></td>
                        <td class="fert-dep-form-input"><input type="submit" value="Сохранить" class="save-btn">&nbsp;
                            <input type="button" value="Отмена" onclick="cancel();" class="cancel-btn">
                            <input name="department_id" type="hidden" value="<?= $departmentsArr[0]['id'] ?>">
                        </td>
                    </tr> 
                </table>
            </form>
        </div>
    </body>
</html>


