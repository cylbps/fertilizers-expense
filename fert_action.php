<?php
require_once 'classes/database.php';

$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

require_once 'classes/fertilizer_expense.php';
$fertilizerExpense = new fertilizer_expense();

$formAction = $_POST['form_action'];
if (isset($_POST['selected_rows'])) {
    $selectedRows = $_POST['selected_rows'];
}

switch ($formAction) {
    case 'add' :
        header("Location: new_expense.php");
        break;    
    case 'delete' :
        $fertilizerExpense->delFertilizerExpense($selectedRows);
        break;
    case 'edit' :
        if (isset($_POST['selected_rows'])) {
            header("Location: edit_fert_exp.php?id=$selectedRows[0]");
            break;
        }else {
            header("Location: fertilizer_expense_full.php");
        }
        break;
    case 'search' :
        header("Location: search_expense.php");
        break;
    case 'del_search' :
        header("Location: fertilizer_expense_full.php");
        break;    
}

