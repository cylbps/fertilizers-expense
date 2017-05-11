<?php
require_once 'classes/database.php';
$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

require_once 'classes/cultures.php';
$cultures = new cultures();

$formAction = $_POST['form_action'];
if (isset($_POST['selected_rows'])) {
    $selectedRows = $_POST['selected_rows'];
}

switch ($formAction) {
    case 'add' :
        header("Location: new_culture.php");
        break;     
    case 'delete' :
        $cultures->delCultures($selectedRows);
        break;
    case 'edit' :
        if (isset($_POST['selected_rows'])) {
            header("Location: edit_culture.php?id=$selectedRows[0]");
        }else {
            header("Location: cultures.php");
        }
}

