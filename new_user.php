<?php

require_once 'classes/database.php';

$database = database::getInstance();
if ($database->validUser()) { 
    $validUser = TRUE;
    include 'new_user_tpl.php';
} 

