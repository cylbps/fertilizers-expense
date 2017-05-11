<?php
require_once 'classes/database.php';

$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

session_start();
    if ($_SESSION['valid_user']) {
        unset ($_SESSION['valid_user']); 
        header('Location: login_form.php');
    }
        
session_destroy();

