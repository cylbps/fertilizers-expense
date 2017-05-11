<?php
require_once 'classes/database.php';
$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

require_once 'classes/fertilizer_expense.php';

$fertExpID = $_GET['id'];

$fertilizerExpense = new fertilizer_expense($fertExpID);

$fertilizerExpense->delFertilizerExpense($fertExpID);



