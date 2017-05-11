<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include "login_form.php";
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'classes/common_functions.php';
    $commonFunctions = new common_functions();

    require_once 'classes/database.php';

    session_start();

// если зашли из формы
    $user = $commonFunctions->clearData($_POST['user']);
    $password = $commonFunctions->clearData($_POST['password']);

// проверяем параметры
    if ((!$user) || (!$password)) {
        $_SESSION['message'] = 'Неверный логин или пароль.';
        include 'login_form.php';
    } else {
        $database = database::getInstance();
        if (!$database->login($user, $password)) {
            $_SESSION['message'] = 'Неверный логин или пароль.';
            include 'login_form.php';
        } else {
            $_SESSION['valid_user'] = $user;
            header('Location: fertilizer_expense_full.php');
        }
    }
}
?>        

