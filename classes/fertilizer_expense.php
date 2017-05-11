<?php
require_once 'entity.php';
require_once 'classes/common_functions.php';

class fertilizer_expense extends entity {

    public function getList() {

        $sql = "SELECT "
                . "fertilizer_expense.id as fert_exp_id, "
                . "fertilizer_expense.release_date, "
                . "fertilizer_expense.department_id as fert_dep_id, "
                . "fertilizer_expense.field_id as fert_field_id, "
                . "fertilizer_expense.fertilizer_id, "
                . "fertilizer_expense.weight, "
                . "fertilizer_expense.treated_area, "
                . "fertilizer_expense.sowing_id, "
                . "fertilizer_expense.deviation, "
                . "fertilizers.name as fert_name, "
                . "cultures.id as culture_id, "
                . "cultures.name as cname, "
                . "departments.name as dep_name, "
                . "fields.name as field_name, "
                . "sowings.area as sow_area "
                . "FROM fertilizer_expense, departments, cultures, "
                . " fields, fertilizers, sowings "
                . "WHERE fertilizer_expense.department_id = departments.id "
                . "AND fertilizer_expense.field_id = fields.id  "
                . "AND sowings.culture_id = cultures.id "
                . "AND fertilizer_expense.sowing_id = sowings.id "
                . "AND fertilizer_expense.fertilizer_id = fertilizers.id "
                . "ORDER BY fertilizer_expense.release_date";

        /*echo $sql;
        exit;*/

        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));

        $common = new common_functions();

        return $common->dbArrayAssoc($result);
    }

    public function totalArea($field_id) {
        $sql = "SELECT total_area FROM fields WHERE id = $field_id";
        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));

        $row = $result->fetch_assoc();
        $total_area = $row['total_area'];
        return $total_area;
    }

    public function newFertilizerExpense($departmentID, $fieldID, $sowingID, $fertilizerID, $fertPlanID, $treatedArea, $weight, $deviation) {
        $sql = "INSERT INTO fertilizer_expense (department_id, "
                . "field_id, sowing_id, fertilizer_id, fert_plan_id, treated_area, weight, "
                . " deviation) VALUES ($departmentID, "
                . "$fieldID, $sowingID, $fertilizerID, $fertPlanID, $treatedArea, $weight, $deviation)";

        /* echo $sql;
          exit; */

        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));
        header("Location: fertilizer_expense_full.php");
    }

    public function editFertilizerExpense($fertExpID, $departmentID, $fieldID, $sowingID, $fertilizerID, $fertPlanID, $treatedArea, $weight, $deviation) {
        $sql = "UPDATE fertilizer_expense SET department_id = $departmentID, "
                . "field_id = $fieldID, "
                . "sowing_id = $sowingID, "
                . "fertilizer_id = $fertilizerID, "
                . "fert_plan_id = $fertPlanID, "
                . "treated_area = $treatedArea, "
                . "weight = $weight, "
                . "deviation = $deviation "
                . "WHERE id = $fertExpID";

        $this->connection->query($sql) or exit(mysqli_error($this->connection));
        header("Location: fertilizer_expense_full.php");
    }

    public function delFertilizerExpense($selected_rows) {
        foreach ($selected_rows as $val) {
            $sql = "DELETE FROM fertilizer_expense WHERE id = $val";
            $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));
        }

        header("Location: fertilizer_expense_full.php");
    }

    public function getFertilizerExpense($fertExpID) {
        $sql = "SELECT "
                . "fertilizer_expense.id as fert_exp_id, "
                . "fertilizer_expense.release_date, "
                . "fertilizer_expense.department_id as fert_dep_id, "
                . "fertilizer_expense.field_id as fert_field_id, "
                . "fertilizer_expense.fertilizer_id, "
                . "fertilizer_expense.fert_plan_id, "
                . "fertilizer_expense.weight, "
                . "fertilizer_expense.treated_area, "
                . "fertilizer_expense.sowing_id, "
                . "fertilizer_expense.deviation, "
                . "fertilizers.name as fert_name, "
                . "cultures.name as cname, "
                . "departments.name as dep_name, "
                . "fields.name as field_name, "
                . "sowings.area as sow_area "
                . "FROM fertilizer_expense, departments, cultures, "
                . " fields, fertilizers, sowings "
                . "WHERE fertilizer_expense.department_id = departments.id "
                . "AND fertilizer_expense.field_id = fields.id "
                . "AND sowings.culture_id = cultures.id "
                . "AND fertilizer_expense.sowing_id = sowings.id "
                . "AND fertilizer_expense.fertilizer_id = fertilizers.id "
                . "AND fertilizer_expense.id = $fertExpID";

        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));

        $common = new common_functions();

        return $common->dbArrayAssoc($result);
    }

    public function searchExpense($datFromIn, $datFromOut, $departmentID, $fieldID, $sowingID, $fertilizerID) {

        $sql = "SELECT "
                . "fertilizer_expense.id as fert_exp_id, "
                . "fertilizer_expense.release_date, "
                . "fertilizer_expense.department_id as fert_dep_id, "
                . "fertilizer_expense.field_id as fert_field_id, "
                . "fertilizer_expense.fertilizer_id, "
                . "fertilizer_expense.weight, "
                . "fertilizer_expense.treated_area, "
                . "fertilizer_expense.sowing_id, "
                . "fertilizer_expense.deviation, "
                . "fertilizers.name as fert_name, "
                . "cultures.name as cname, "
                . "departments.name as dep_name, "
                . "fields.name as field_name, "
                . "sowings.area as sow_area "
                . "FROM fertilizer_expense, departments, cultures, "
                . " fields, fertilizers, sowings "
                . "WHERE fertilizer_expense.department_id = departments.id "
                . "AND fertilizer_expense.field_id = fields.id "
                . "AND sowings.culture_id = cultures.id "
                . "AND fertilizer_expense.sowing_id = sowings.id "
                . "AND fertilizer_expense.fertilizer_id = fertilizers.id ";
        if ($datFromIn) {
            $dateInStr = new DateTime($datFromIn);
            $sql.= "AND fertilizer_expense.release_date >= '" . $dateInStr->format("Y-m-d") . "' ";
        }
        if ($datFromOut) {
            $dateOutStr = new DateTime($datFromOut);
            $sql.= "AND fertilizer_expense.release_date <= '" . $dateOutStr->format("Y-m-d 24:00:00") . "' ";
        }

        if ($departmentID) {
            $sql.= "AND fertilizer_expense.department_id = $departmentID ";
        }

        if ($fieldID) {
            $sql.= "AND fertilizer_expense.field_id = $fieldID ";
        }

        if ($sowingID) {
            $sql.= "AND fertilizer_expense.sowing_id = $sowingID ";
        }

        if ($fertilizerID) {
            $sql.= "AND fertilizer_expense.fertilizer_id = $fertilizerID ";
        }

        $sql.= "ORDER BY fertilizer_expense.release_date";

        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));

        $common = new common_functions();

        return $common->dbArrayAssoc($result);
    }

    public function totalFertilizerExpenseParam($datFromIn, $datFromOut, $departmentID, $fieldID, $sowingID, $fertilizerID) {
        $sql = "SELECT "
                . "fertilizer_id, "
                . "fertilizers.name, "
                . "SUM(weight), "
                . "SUM(treated_area) "
                . "FROM fertilizer_expense, fertilizers "
                . "WHERE fertilizers.id = fertilizer_id ";
        if ($datFromIn) {
            $dateInStr = new DateTime($datFromIn);
            $sql.= "AND fertilizer_expense.release_date >= '" . $dateInStr->format("Y-m-d") . "' ";
        }
        
        if ($datFromOut) {
            $dateOutStr = new DateTime($datFromOut);
            $sql.= "AND fertilizer_expense.release_date <= '" . $dateOutStr->format("Y-m-d 24:00:00") . "' ";
        }

        if ($departmentID) {
            $sql.= "AND fertilizer_expense.department_id = $departmentID ";
        }

        if ($fieldID) {
            $sql.= "AND fertilizer_expense.field_id = $fieldID ";
        }

        if ($sowingID) {
            $sql.= "AND fertilizer_expense.sowing_id = $sowingID ";
        }

        if ($fertilizerID) {
            $sql.= "AND fertilizer_expense.fertilizer_id = $fertilizerID ";
        }
        
        $sql.= "GROUP BY fertilizer_id";

        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));
        
        $commonFunctions = new common_functions();

        return $commonFunctions->dbArrayAssoc($result);
    }
    
    public function totalWeightFertParam($datFromIn, $datFromOut, $departmentID, $fieldID, $sowingID, $fertilizerID) {
        $sql = "SELECT SUM(weight) "
                . "FROM fertilizer_expense "
                . "WHERE 1 = 1 ";
        if ($datFromIn) {
            $dateInStr = new DateTime($datFromIn);
            $sql.= "AND fertilizer_expense.release_date >= '" . $dateInStr->format("Y-m-d") . "' ";
        }
        
        if ($datFromOut) {
            $dateOutStr = new DateTime($datFromOut);
            $sql.= "AND fertilizer_expense.release_date <= '" . $dateOutStr->format("Y-m-d 24:00:00") . "' ";
        }

        if ($departmentID) {
            $sql.= "AND fertilizer_expense.department_id = $departmentID ";
        }

        if ($fieldID) {
            $sql.= "AND fertilizer_expense.field_id = $fieldID ";
        }

        if ($sowingID) {
            $sql.= "AND fertilizer_expense.sowing_id = $sowingID ";
        }

        if ($fertilizerID) {
            $sql.= "AND fertilizer_expense.fertilizer_id = $fertilizerID ";
        }
        
        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));

        $arr = $result->fetch_row();

        $val = $arr[0];

        return $val;
    } 
    
    public function totalTrAreaFertParam($datFromIn, $datFromOut, $departmentID, $fieldID, $sowingID, $fertilizerID) {
        $sql = "SELECT SUM(treated_area) "
                . "FROM fertilizer_expense "
                . "WHERE 1 = 1 ";
        if ($datFromIn) {
            $dateInStr = new DateTime($datFromIn);
            $sql.= "AND fertilizer_expense.release_date >= '" . $dateInStr->format("Y-m-d") . "' ";
        }
        
        if ($datFromOut) {
            $dateOutStr = new DateTime($datFromOut);
            $sql.= "AND fertilizer_expense.release_date <= '" . $dateOutStr->format("Y-m-d 24:00:00") . "' ";
        }

        if ($departmentID) {
            $sql.= "AND fertilizer_expense.department_id = $departmentID ";
        }

        if ($fieldID) {
            $sql.= "AND fertilizer_expense.field_id = $fieldID ";
        }

        if ($sowingID) {
            $sql.= "AND fertilizer_expense.sowing_id = $sowingID ";
        }

        if ($fertilizerID) {
            $sql.= "AND fertilizer_expense.fertilizer_id = $fertilizerID ";
        }
        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));

        $arr = $result->fetch_row();

        $val = $arr[0];

        return $val;
    } 

}
