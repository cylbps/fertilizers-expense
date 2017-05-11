<?php

require_once 'classes/fertilizer_plans.php';

$fertPlanID = $_GET['fert_plan_id'];

$fertilizer = new fertilizer_plans();

$fertArr = $fertilizer->getFertPlan($fertPlanID);

echo $fertArr[0]['fert_id'];

