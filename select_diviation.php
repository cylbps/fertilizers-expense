<?php

require_once 'classes/database.php';
$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

if(isset($_GET['fert_plan']) && $_GET['fert_plan'] !== "") {
    $fertPlanID = $_GET['fert_plan'];    
} else {
    echo "Недостаточно данных для обработки запроса.";
    exit();
}

if(isset($_GET['weight']) && $_GET['weight'] !== "") {
    $weight = $_GET['weight'];   
} else {
    echo "Недостаточно данных для обработки запроса.";
    exit();
}

if(isset($_GET['sowing_area']) && $_GET['sowing_area'] !== "") {
    $sowingArea = $_GET['sowing_area'];   
} else {
    echo "Недостаточно данных для обработки запроса.";
    exit();
}

require_once 'classes/common_functions.php';
$common_function = new common_functions();

$fertPlan = $common_function->selectFertPlan($fertPlanID);
$fertPlan = "$fertPlan[0]";

bcscale(3);
$deviation = bcsub($weight, bcmul($sowingArea, $fertPlan));

echo '<input type="text" value="'.$deviation.'" name="deviation_val" id="deviation_val" readonly="readonly">';

