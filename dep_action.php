<?php

require_once 'classes/database.php';

$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

require_once 'classes/departments.php';
$departments = new departments();

$formAction = $_POST['form_action'];
if (isset($_POST['selected_rows'])) {
    $selectedRows = $_POST['selected_rows'];
}

switch ($formAction) {
    case 'add' :
        header("Location: new_department.php");
        break;      
    case 'delete' :
        $departments->delDepartments($selectedRows);
        break;
    case 'edit' :
        if (isset($_POST['selected_rows'])) {
            header("Location: edit_department.php?id=$selectedRows[0]");
        }else {
            header("Location: departments.php");
        }
}

