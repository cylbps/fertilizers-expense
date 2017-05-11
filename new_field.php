<?php

require_once 'classes/database.php';
$database = database::getInstance();
$validUser = $database->validUser();
if (! $validUser) {
    header("Location: 404.php");
} 

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include "new_field_form.php";
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'classes/fields.php';
    $fields = new fields();
    
    require_once 'classes/common_functions.php';
    $commonFunctions = new common_functions();    

    $name = $commonFunctions->clearData($_POST['name']);
    $departmentID = $commonFunctions->clearData($_POST['department']);
    $totalArea = $commonFunctions->clearData($_POST['total_area']);

    $fields->newField($name, $departmentID, $totalArea);    
}

