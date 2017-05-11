<?php
require_once 'classes/database.php';
$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

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
            $display->mainMenu('common_data');
            ?>
        </div>
        <div class="content">
            <script>
                function cancel() {
                    window.location.href = "previous_fert_costs.php";
                }
            </script>
            <h2>Новое удобрение</h2>
            <form name="new_fertilizer_exp" class="fert-fertilizer-form" method="post" action="new_fertilizer.php">
                <table>                
                    <tr>
                        <td class="fert-fertilizer-form-lb">Наименование:</td>
                        <td class="fert-fertilizer-form-input" id="treated_area"><input type="text" name="name"></td>
                    </tr>    
                    <tr>
                        <td class="fert-fertilizer-form-lb"></td>
                        <td class="fert-fertilizer-form-input"><input type="submit" value="Сохранить" class="save-btn">&nbsp;
                            <input type="button" value="Отмена" onclick="cancel();" class="cancel-btn">
                        </td>
                    </tr> 
                </table>
            </form>
        </div>
    </body>
</html>
