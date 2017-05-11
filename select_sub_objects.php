<?php

require_once 'classes/common_functions.php';

$list = $_GET['list'];
$parentID = $_GET['parentid'];

$subObject = new common_functions();

$subArr = $subObject->selectSubObjects($list, $parentID);

echo "<option></option>";
foreach ($subArr as $val) {
    echo "<option value={$val['id']}>{$val['name']}</option>";
}


