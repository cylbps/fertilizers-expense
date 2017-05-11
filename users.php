<?php

require_once 'classes/database.php';

$database = database::getInstance();
if ($database->validUser()) {
    $validUser = TRUE;
    include 'users_tpl.php';
} 

