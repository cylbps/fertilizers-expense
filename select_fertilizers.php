<?php

require_once 'classes/fertilizers.php';
require_once 'classes/common_functions.php';

$cultureID = $_GET['culture_id'];

$fertilizers = new fertilizers();
$fertArr = $fertilizers->fertilizerToCulture($cultureID);

echo "<option></option>";
foreach ($fertArr as $val) {
    echo '<option value="'.$val['fert_id'].'">'.$val['name'].'</option>';
}


