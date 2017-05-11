<?php

require_once 'classes/database.php';

$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

require_once 'classes/sowings.php';
$sowings = new sowings();

$formAction = $_POST['form_action'];
if (isset($_POST['selected_rows'])) {
    $selectedRows = $_POST['selected_rows'];
}

switch ($formAction) {
    case 'add' :
        header("Location: new_sowing.php");
        break;     
    case 'delete' :
        $sowings->delSowings($selectedRows);
        break;
    case 'edit' :
        if (isset($_POST['selected_rows'])) {
            header("Location: edit_sowing.php?id=$selectedRows[0]");
        }else {
            header("Location: sowings.php");
        }
}

