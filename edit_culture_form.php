<?php
$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

require_once 'classes/display.php';

require_once 'classes/cultures.php';

$cultures = new cultures();

$cultureID = $_GET['id'];

$culturesArr = $cultures->getCulture($cultureID);
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
                    window.location.href = "cultures.php"
                }
            </script>
            <h2>Редактировать культуру</h2>
            <form name="edit_culture_exp" class="fert-cult-form" method="post" action="edit_culture.php">
                <table>                
                    <tr>
                        <td class="fert-cult-form-lb">Наименование:</td>
                        <td class="fert-cult-form-input" id="name"><input type="text" name="name" value="<?php if (!isset($message)) echo $culturesArr[0]['name'] ?>"></td>
                    </tr>    
                    <tr>
                        <td class="fert-cult-form-lb"></td>
                        <td class="fert-cult-form-input"><input type="submit" value="Сохранить" class="save-btn">&nbsp;
                            <input type="button" value="Отмена" onclick="cancel();" class="cancel-btn"><input name="id" type="hidden" value="<?= $cultureID ?>">
                        </td>
                    </tr> 
                </table>
            </form>
        </div>
    </body>
</html>

