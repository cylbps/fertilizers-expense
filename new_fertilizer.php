<?php

require_once 'classes/database.php';
$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include "new_fertilizer_form.php";
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'classes/common_functions.php';
    $commonFunctions = new common_functions();

    require_once 'classes/fertilizers.php';
    $fertilizers = new fertilizers();

    $name = $commonFunctions->clearData($_POST['name']);

    $fertilizers->newFertilizer($name);
}

