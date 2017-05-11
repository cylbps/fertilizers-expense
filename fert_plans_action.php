<?php

require_once 'classes/database.php';

$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

require_once 'classes/fertilizer_plans.php';
$fertilizerPlans = new fertilizer_plans();

$formAction = $_POST['form_action'];
if (isset($_POST['selected_rows'])) {
    $selectedRows = $_POST['selected_rows'];
}

switch ($formAction) {
    case 'add' :
        header("Location: new_fert_plan.php");
        break;     
    case 'delete' :
        $fertilizerPlans->delFertPlans($selectedRows);
        break;
    case 'edit' :
        if (isset($_POST['selected_rows'])) {
            header("Location: edit_fert_plan.php?id=$selectedRows[0]");
        }else {
            header("Location: fertilizer_plans.php");
        }
        break;
    case  'search' :
        header("Location: search_fert_plan.php");
        break;
    case 'del_search' :
        header("Location: fertilizer_plans.php");
        break;
}

