<?php
require_once 'classes/database.php';

$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

require_once 'classes/departments.php';
$departments = new departments();
$departmentsArr = $departments->getList();

require_once 'classes/display.php';
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
            <div class="fert-exp-menu">
                <?= $display->actionMenu('dep_action_form') ?> 
                <?= $display->commonDataItemsMenu('no') ?>
            </div>
            <h2>Подразделения</h2>
            <div class="fert-dep-list">
                <form class="dep_action_form" name="dep_action_form" action="dep_action.php" method="post">
                    <input type="hidden" id="form_action" name="form_action">
                    <table class="fert-dep-list-table">
                        <tr>
                            <th></th>
                            <th>Наименование</th>
                        </tr> 
                        <?php
                        foreach ($departmentsArr as $val) {
                            ?> 
                            <tr>
                                <td class="check"><input type="checkbox" name="selected_rows[]" value="<?= $val["id"] ?>"></td>
                                <td><a href="edit_department.php?id=<?= $val["id"] ?>"><?= $val["name"] ?></a></td>
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