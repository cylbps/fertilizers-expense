<?php
require_once 'classes/database.php';
$database = database::getInstance();
if ($database->validUser()) {
    header('Location: fertilizer_expense_full.php');
} else {
    header('Location: login.php');
}
?>
