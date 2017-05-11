<?php

require_once 'classes/database.php';
$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include "new_previous_fert_cost_form.php";
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'classes/common_functions.php';
    $commonFunctions = new common_functions();

    require_once 'classes/previous_fert_costs.php';
    $prevousFertCosts = new previous_fert_costs();

    $fertilizerID = $commonFunctions->clearData($_POST['fertilizer']);
    $weight = $commonFunctions->clearData($_POST['weight']);

    $prevousFertCosts->newFertCosts($fertilizerID, $weight);
}

