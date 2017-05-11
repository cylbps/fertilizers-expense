<?php

require_once 'classes/common_functions.php';

$common_functions = new common_functions();

$fieldID = $_GET['field_id'];

$sowingsArr = $common_functions->selectSowings($fieldID);

echo "<option></option>";
foreach ($sowingsArr as $val) {
    echo '<option value="'.$val['id'].'">'.$val['name'].'</option>';
}


//echo "<option value='1'>Поле1</option><option value='2'>Поле2</option>";

