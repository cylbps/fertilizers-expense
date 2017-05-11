<?php

require_once 'classes/fertilizer_plans.php';

$sowingID = $_GET['sowing_id'];

$fertilizerPlans = new fertilizer_plans();
$fertPlansArr = $fertilizerPlans->fertPlanToSowing($sowingID);

echo "<option></option>";
foreach ($fertPlansArr as $val) {
    echo '<option value="'.$val['fert_plan_id'].'">'.$val['name']." (".$val['norm'].')</option>';
}

