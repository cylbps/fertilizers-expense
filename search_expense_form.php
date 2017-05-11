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
        <script src="datepicker.js"></script>
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

            <h2>Найти расходы</h2>
            <form name="new_fert_exp" class="fert-exp-search-form" method="post" action="search_expense.php">
                <table> 
                    <tr>
                        <td class="fert-exp-search-form-lb">Дата с:</td>
                        <td class="fert-exp-search-form-input"><input 
                                type="text" 
                                name="datfrom_in" 
                                value="" 
                                id="datfrom_in" 
                                size="10" 
                                autocomplete="off"  
                                onfocus="this.select();
                                    lcs(this)" 
                                onclick="event.cancelBubble = true;
                                    this.select();
                                    lcs(this)">
                        </td>
                    </tr> 
                    <tr>
                        <td class="fert-exp-search-form-lb">Дата по:</td>
                        <td class="fert-exp-search-form-input"><input 
                                type="text" 
                                name="datfrom_out" 
                                value="" 
                                id="datfrom_out" 
                                size="10" 
                                autocomplete="off"  
                                onfocus="this.select();
                                    lcs(this)" 
                                onclick="event.cancelBubble = true;
                                    this.select();
                                    lcs(this)">
                        </td>
                    </tr>                    
                    <tr>
                        <td class="fert-exp-search-form-lb">Отделение:</td>
                        <td class="fert-exp-search-form-input">
                            <select name="department" onchange="javascript:selectSubObjects('fields', this.value);">
                                <option></option>
                                <?php
                                foreach ($departmentsArr as $val) {
                                    echo "<option value='{$val['id']}'>" . $val['name'] . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>  
                    <tr>
                        <td class="fert-exp-search-form-lb">№ поля:</td>
                        <td class="fert-exp-search-form-input">
                            <select id="fields" name="field" onchange="javascript:selectSowings(this.value);">
                            </select>
                        </td>
                    </tr>         
                    <tr>
                        <td class="fert-exp-search-form-lb">Культура:</td>
                        <td class="fert-exp-search-form-input">
                            <select name="sowing" id="sowings" onchange="javascript:selectSowingArea(this.value);">
                                <option></option>
                            </select>
                        </td>                       
                    </tr> 
                    <tr>
                        <td class="fert-exp-search-form-lb">Удобрение:</td>
                        <td class="fert-exp-search-form-input">
                            <input type="hidden" id="fertilizer" name="fertilizer" value="">
                            <select id="fert_plan" name="fert_plan" onchange="javascript:selectFertilizer(this.value);">
                                <option value="empty"></option>
                            </select>
                        </td>                         
                    </tr> 
                    <tr>
                        <td class="fert-exp-search-form-lb-hidden"></td>
                        <td class="fert-exp-search-form-input-hidden" id="treated_area"><input type="hidden" id="treated_area_input" name="treated_area"></td>
                    </tr>                    
                    <tr>
                        <td class="fert-exp-search-form-lb-hidden"></td>
                        <td class="fert-exp-search-form-input-hidden" id="sowing_area">
                            <input id="sowing_area_val" type="hidden" name="sowing_area">
                        </td>
                    </tr> 
                    <tr>
                        <td class="fert-exp-search-form-lb-hidden"></td>
                        <td class="fert-exp-search-form-input-hidden" id="weight_td"><input type="hidden" id="weight" name="weight" onchange="javascript:selectDiviation(this.value);"></td>
                    </tr>        
                    <tr>
                        <td class="fert-exp-search-form-lb-hidden"></td>
                        <td class="fert-exp-search-form-input-hidden" id="deviation_td"><input type="hidden" id="deviation_val" name="deviation_val"></td>
                    </tr>         
                    <tr>                    
                    <tr>
                        <td class="fert-exp-search-form-lb"></td>
                        <td class="fert-exp-search-form-input"><input type="submit" value="Найти" class="search-expense-btn">&nbsp;
                            <input type="button" value="Отмена" onclick="cancel();" class="cancel-btn">
                        </td>
                    </tr>        
                </table>
            </form>
        </div>
    </body>
</html>

