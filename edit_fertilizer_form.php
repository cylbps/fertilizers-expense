<?php
if (!$validUser) {
    header("Location: 404.php");
}

require_once 'classes/fertilizers.php';

$fertilizerID = $_GET['id'];

$fertilizers = new fertilizers();
$fertilizerArr = $fertilizers->getFertilizer($fertilizerID);

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
                    window.location.href = "fertilizers.php";
                }
            </script>
            <h2>Редактировать удобрение</h2>
            <form name="edit_fertilizer_exp" class="fert-fertilizer-form" method="post" action="edit_fertilizer.php">
                <table>                
                    <tr>
                        <td class="fert-fertilizer-form-lb">Наименование:</td>
                        <td class="fert-fertilizer-form-input" id="treated_area">
                            <input type="text" name="name" value="<?= $fertilizerArr[0]['name'] ?>">
                        </td>
                    </tr>    
                    <tr>
                        <td class="fert-fertilizer-form-lb"></td>
                        <td class="fert-fertilizer-form-input"><input type="submit" value="Сохранить" class="save-btn">&nbsp;
                            <input type="button" value="Отмена" onclick="cancel();" class="cancel-btn">
                            <input name="fertilizer_id" type="hidden" value="<?= $fertilizerArr[0]['id'] ?>">
                        </td>
                    </tr> 
                </table>
            </form>
        </div>
    </body>
</html>

