<?php
require_once 'classes/database.php';

$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include "edit_culture_form.php";
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    require_once 'classes/cultures.php';
    require_once 'classes/common_functions.php';

    $commonFunctions = new common_functions();

    $cultureID = $commonFunctions->clearData($_POST['id'], "i");

    $name = $commonFunctions->clearData($_POST['name']);
    
    $cultures = new cultures();
    $cultures->editCulture($cultureID, $name);
}