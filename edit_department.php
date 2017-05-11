<?php
require_once 'classes/database.php';

$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include "edit_department_form.php";
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'classes/departments.php';
    $departments = new departments();

    require_once 'classes/common_functions.php';
    $commonFunctions = new common_functions();

    $departmentID = $commonFunctions->clearData($_POST['department_id']);
    $name = $commonFunctions->clearData($_POST['name']);

    $departments->editDepartment($departmentID, $name);
}

