<?php

require_once 'classes/entity.php';

class fertilizer_plans extends entity {

    public function getList() {
        $sql = "SELECT "
                . "fertilizer_plans.id as fert_plans_id, "
                . "fertilizer_plans.norm, "
                . "cultures.name as cult_name, "
                . "fertilizers.name as fert_name "
                . "FROM fertilizer_plans, cultures, fertilizers "
                . "WHERE fertilizer_plans.culture_id = cultures.id "
                . "AND fertilizer_plans.fertilizer_id = fertilizers.id "
                . "ORDER BY culture_id";

        /* echo $sql;
          exit; */

        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));

        $common = new common_functions();

        return $common->dbArrayAssoc($result);
    }
    
    public function newFertPlan($cultureID, $fertilizerID, $norm) {
        $sql = "INSERT INTO fertilizer_plans (culture_id, fertilizer_id, norm) "
                . "VALUES ($cultureID, $fertilizerID, $norm)";

        $this->connection->query($sql) or exit(mysqli_error($this->connection));
        header("Location: fertilizer_plans.php");
    }  
    
    public function delFertPlans($selected_rows) {
        foreach ($selected_rows as $val) {
            $sql = "DELETE FROM fertilizer_plans WHERE id = $val";
            $this->connection->query($sql) or exit(mysqli_error($this->connection));
        }

        header("Location: fertilizer_plans.php");
    } 
    
    public function getFertPlan($fertPlanID) {
        $sql = "SELECT "
                . "fertilizer_plans.id, "
                . "fertilizer_plans.culture_id, "
                . "fertilizer_plans.fertilizer_id as fert_id, "
                . "fertilizer_plans.norm, "
                . "cultures.name as cult_name, "
                . "fertilizers.name as fert_name "                
                . "FROM fertilizer_plans, cultures, fertilizers "
                . "WHERE fertilizer_plans.id = $fertPlanID "
                . "AND fertilizer_plans.culture_id = cultures.id "
                . "AND fertilizer_plans.fertilizer_id = fertilizers.id";


        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));
        
        $common = new common_functions();
        return $common->dbArrayAssoc($result);
    } 
    
    public function editFertPlan($id, $cultureID, $fertilizerID, $norm) {
        $sql = "UPDATE fertilizer_plans SET culture_id = $cultureID, "
                . "fertilizer_id = $fertilizerID, "
                . "norm = $norm "
                . "WHERE id = $id"; 
        
        /*echo $sql;
        exit;*/

        $this->connection->query($sql) or exit("Ошибка редактирования поля".mysqli_error($this->connection));
        header("Location: fertilizer_plans.php");       
    }

    public function fertPlanToSowing($sowingID) {
        $sql = "SELECT "
            . "fertilizer_plans.id as fert_plan_id, "
            . "fertilizer_plans.norm, "
            . "fertilizers.id fert_id, "
            . "fertilizers.name "
            . "FROM fertilizer_plans, fertilizers "
            . "WHERE culture_id = (SELECT culture_id FROM sowings WHERE sowings.id = $sowingID "
            . "AND fertilizer_plans.fertilizer_id = fertilizers.id)";
        
        //echo $sql;
        //exit;
        
        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));
        
        $common = new common_functions();
        return $common->dbArrayAssoc($result);        
    }
    
    public function searchFertPlan($cultureID, $fertilizerID) {
        $sql = "SELECT "
                . "fertilizer_plans.id as fert_plans_id, "
                . "fertilizer_plans.norm, "
                . "cultures.name as cult_name, "
                . "fertilizers.name as fert_name "
                . "FROM fertilizer_plans, cultures, fertilizers "
                . "WHERE fertilizer_plans.culture_id = cultures.id "
                . "AND fertilizer_plans.fertilizer_id = fertilizers.id ";
                if($cultureID) {
                    $sql .= "AND fertilizer_plans.culture_id = $cultureID ";
                }
                if($fertilizerID) {
                    $sql .= "AND fertilizer_plans.fertilizer_id = $fertilizerID ";
                }
                $sql .= "ORDER BY culture_id";

        /* echo $sql;
          exit; */

        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));

        $common = new common_functions();

        return $common->dbArrayAssoc($result);
    }
    
    public function getFertPlanNorm($cultureID, $fertilizerID) {
        $sql = "SELECT * "
                . "FROM fertilizer_plans "
                . "WHERE fertilizer_id = $fertilizerID "
                . "AND culture_id = $cultureID";
        
        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));

        return $result->fetch_row();        
    }

}
