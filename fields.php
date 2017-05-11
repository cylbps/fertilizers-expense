<?php
require_once 'classes/database.php';

$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}
require_once 'classes/fields.php';
$fields = new fields();
$fieldsArr = $fields->getList();

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
                <?= $display->actionMenu('field_action_form') ?>
                <?= $display->commonDataItemsMenu('no') ?>
            </div>
            <h2>Поля</h2>
            <div class="fert-field-list">
                <form class="field-action-form" name="field_action_form" action="field_action.php" method="post">
                    <input type="hidden" id="form_action" name="form_action">
                    <table class="fert-field-list-table">
                        <tr>
                            <th></th>
                            <th>Наименование</th>
                            <th>Отделение</th>
                            <th>Площадь (га)</th>
                        </tr> 
                        <?php
                        foreach ($fieldsArr as $val) {
                            ?> 
                            <tr>
                                <td class="check"><input type="checkbox" name="selected_rows[]" value="<?= $val["id"] ?>"></td>
                                <td><a href="edit_field.php?id=<?= $val["id"] ?>"><?= $val["name"] ?></a></td>
                                <td><?= $val["dep_name"] ?></td>
                                <td><?= $val["total_area"] ?></td>
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

