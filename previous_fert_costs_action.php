<?php

require_once 'classes/database.php';

$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

require_once 'classes/previous_fert_costs.php';
$prevousFertCosts = new previous_fert_costs();

$formAction = $_POST['form_action'];
if (isset($_POST['selected_rows'])) {
    $selectedRows = $_POST['selected_rows'];
}

switch ($formAction) {
    case 'add' :
        header("Location: new_previous_fert_cost.php");
        break;     
    case 'delete' :
        $prevousFertCosts->delPreviousFertCosts($selectedRows);
        break;
    case 'edit' :
        if (isset($_POST['selected_rows'])) {
            header("Location: previous_fert_costs.php");
        }else {
            header("Location: previous_fert_costs.php");
        }
}

