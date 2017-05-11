<?php

require_once 'classes/database.php';
require_once 'classes/fertilizer_expense.php';

$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

require_once 'classes/common_functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include "edit_fert_exp_form.php";
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $commonFunctions = new common_functions();

    $fertExpID = $commonFunctions->clearData($_POST['id'], "i");
    $departmentID = $commonFunctions->clearData($_POST['department']);
    $fieldID = $commonFunctions->clearData($_POST['field']);
    $sowingID = $commonFunctions->clearData($_POST['sowing']);
    $fertilizerID = $commonFunctions->clearData($_POST['fertilizer']);
    $fertPlanID = $commonFunctions->clearData($_POST['fert_plan']);
    $treatedArea = $commonFunctions->clearData($_POST['treated_area']);
    $weight = $commonFunctions->clearData($_POST['weight']);
    $deviation = $commonFunctions->clearData($_POST['deviation_val']);

    $fertilizer_expense = new fertilizer_expense();

    $fertilizer_expense->editFertilizerExpense($fertExpID, $departmentID, 
    $fieldID, $sowingID, $fertilizerID, $fertPlanID, $treatedArea, $weight, $deviation);
}


/*$fertExpID = $_GET['id'];
$departmentID = trim(strip_tags($_POST['department']));
$fieldID = trim(strip_tags($_POST['field']));
$sowingID = trim(strip_tags($_POST['sowing']));
$fertilizerID = trim(strip_tags($_POST['fertilizer']));
$fertPlanID = trim(strip_tags($_POST['fert_plan']));
$treatedArea = trim(strip_tags($_POST['treated_area']));
$weight = trim(strip_tags($_POST['weight']));
$deviation = trim(strip_tags($_POST['deviation_val']));

$fertilizer_expense = new fertilizer_expense();

$fertilizer_expense->editFertilizerExpense($fertExpID, $departmentID, $fieldID, $sowingID, 
        $fertilizerID, $fertPlanID, $treatedArea, $weight, $deviation);*/



