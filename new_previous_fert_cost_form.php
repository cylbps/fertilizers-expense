<?php
require_once 'classes/database.php';
$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

require_once 'classes/display.php';
require_once 'classes/fertilizers.php';

$fertilizers = new fertilizers();
$fertilizersArr = $fertilizers->getList();
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
            <script>
                function cancel() {
                    window.location.href = "previous_fert_costs.php";
                }
            </script>
            <h2>Новый расход удобрения</h2>
            <form name="new_previous_fert_cost_form" class="previous-fert-cost-form" method="post" action="new_previous_fert_cost.php">
                <table>                
                    <tr>
                        <td class="previous-fert-cost-form-lb">Удобрение:</td>
                        <td class="previous-fert-cost-form-input" id="treated_area">
                            <select id="fertilizer" name="fertilizer">
                                <option value="empty"></option>
                                <?php
                                foreach ($fertilizersArr as $val) {
                                    echo '<option value="' . $val['id'] . '">' . $val['name'].'</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>  
                    <tr>
                        <td class="fert-fertilizer-form-lb">Израсходовано (тонн):</td>
                        <td class="fert-fertilizer-form-input" id="weight"><input type="text" name="weight"></td>
                    </tr>                      
                    <tr>
                        <td class="previous-fert-cost-form-lb"></td>
                        <td class="previous-fert-cost-form-input"><input type="submit" value="Сохранить" class="save-btn">&nbsp;
                            <input type="button" value="Отмена" onclick="cancel();" class="cancel-btn">
                        </td>
                    </tr>                  
                </table>
            </form>
        </div>
    </body>
</html>
