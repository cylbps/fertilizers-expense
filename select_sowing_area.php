<?php

require_once 'classes/common_functions.php';

$sowingID = $_GET['sowing_id'];

$sowingArea = new common_functions();

$sowingArr = $sowingArea->selectSowingArea($sowingID);

foreach ($sowingArr as $val) {
    echo '<input id="sowing_area_val" type="text" value="' . $val['area'] . 
            '" readonly="readonly">';
}

