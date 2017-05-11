<?php
require_once 'classes/database.php';
$database = database::getInstance();
$validUser = $database->validUser();
if (!$validUser) {
    header("Location: 404.php");
}

require_once 'classes/fertilizer_expense.php';
require_once 'classes/departments.php';
require_once 'classes/common_functions.php';

// Массив ошибок
$errors = array(
    'department' => '',
    'field' => '',
    'sowing' => '',
    'fert_plan' => '',
    'fertiliser' => '',
    'treated_area' => '',
    'weight' => '',
    'deviation_val' => ''
);

// Массив значений формы
$form_values = array(
    'department' => '',
    'field' => '',
    'sowing' => '',
    'fert_plan' => '',
    'fertiliser' => '',
    'treated_area' => '',
    'weight' => '',
    'deviation_val' => ''
);

$departments = new departments();
$departmentsArr = $departments->getList();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include "new_expense_form.php";
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    /* if($_POST['department'] === "") {
      $errors['department'] = 'Выберите подразделение';
      }
      if(!isset($_POST['field'])) {
      $errors['field'] = 'Выберите поле';
      }
      if($_POST['sowing'] === "") {
      $errors['sowing'] = 'Выберите культуру';
      }
      if($_POST['fert_plan'] === "empty") {
      $errors['fert_plan'] = 'Выберите удобрение';
      }
      if($_POST['treated_area'] === "") {
      $errors['treated_area'] = 'Укажите обработанную площадь';
      }
      if($_POST['weight'] === "") {
      $errors['weight'] = 'Укажите вес';
      }
      include "new_expense_form.php"; */
    
    $commonFunctions = new common_functions();
    
    $fertilizer_expense = new fertilizer_expense();

    $departmentID = $commonFunctions->clearData($_POST['department'], "i");
    $fieldID = $commonFunctions->clearData($_POST['field'], "i");
    $sowingID = $commonFunctions->clearData($_POST['sowing'], "i");
    $fertPlanID = $commonFunctions->clearData($_POST['fert_plan'], "i");
    $fertilizerID = $commonFunctions->clearData($_POST['fertilizer'], "i");
    $treatedArea = $commonFunctions->clearData($_POST['treated_area'], "f");
    $weight = $commonFunctions->clearData($_POST['weight'], "f");
    $deviation = $commonFunctions->clearData($_POST['deviation_val'], "f");

    $fertilizer_expense->newFertilizerExpense($departmentID, $fieldID, 
    $sowingID, $fertilizerID, $fertPlanID, $treatedArea, $weight, $deviation);
}


