<?php

require_once 'classes/database.php';
$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include "new_fert_plan_form.php";
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'classes/common_functions.php';
    $commonFunctions = new common_functions();

    require_once 'classes/fertilizer_plans.php';
    $fertilizePlans = new fertilizer_plans();

    $cultureID = $commonFunctions->clearData($_POST['culture'], "i");
    $fertilizerID = $commonFunctions->clearData($_POST['fertilizer'], "i");
    $norm = $commonFunctions->clearData($_POST['norm'], "f");

    $fertilizePlans->newFertPlan($cultureID, $fertilizerID, $norm);
}

