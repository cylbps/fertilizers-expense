<?php

require_once 'database.php';
require_once 'entity.php';

class common_functions extends entity {

    public function dbArray($data) {
        $arr = array();
        while ($row = $data->fetch_array()) {
            $arr[] = $row;
        }

        return $arr;
    }

    public function dbArrayAssoc($data) {
        $arr = array();
        while ($row = $data->fetch_assoc()) {
            $arr[] = $row;
        }

        return $arr;
    }

    public function selectSubObjects($list, $parentID) {
        if ($list and $parentID) {
            switch ($list) {
                case "fields" :
                    $sql = "SELECT * FROM fields WHERE department_id = $parentID ORDER BY name";
                    $result = $this->connection->query($sql) or exit(mysqli_error());

                    return $this->dbArrayAssoc($result);
            }
        }
    }

    public function selectSowingArea($sowingID) {
        $sql = "SELECT * FROM sowings WHERE id = $sowingID";
        $result = $this->connection->query($sql) or exit('<input type="text" name="treated_area" disabled="disabled">');

        return $this->dbArrayAssoc($result);
    }

    public function selectFertPlan($fertilizerID) {
        $sql = "SELECT norm FROM fertilizer_plans WHERE id = $fertilizerID";
        $result = $this->connection->query($sql) or exit(mysqli_error());
        $common = new common_functions();

        /* $val = $common->dbArrayAssoc($result);
          var_dump($val); */
        return $result->fetch_row();
    }

    public function selectSowings($fieldID) {
        $sql = "SELECT "
                . "sowings.id, "
                . "sowings.field_id, "
                . "sowings.culture_id as culture_id, "
                . "sowings.area, cultures.name "
                . "FROM sowings, cultures "
                . "WHERE sowings.culture_id = cultures.id "
                . "AND sowings.field_id = $fieldID";


        $result = $this->connection->query($sql) or exit(mysqli_error());

        return $this->dbArrayAssoc($result);
    }

    public function totalSowingsArea() {
        $sql = "SELECT SUM(area) "
                . "FROM fertilizer_expense, sowings "
                . "WHERE fertilizer_expense.sowing_id = sowings.id";

        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));

        $arr = $result->fetch_row();

        $val = $arr[0];

        return $val;
    }

    public function totalWeightFert() {
        $sql = "SELECT SUM(weight) "
                . "FROM fertilizer_expense";

        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));

        $arr = $result->fetch_row();

        $val = $arr[0];

        return $val;
    }
    
    public function totalTrAreaFert() {
        $sql = "SELECT SUM(treated_area) "
                . "FROM fertilizer_expense";

        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));

        $arr = $result->fetch_row();

        $val = $arr[0];

        return $val;
    }  
    
    public function totalFertilizerExpense() {
        $sql = "SELECT "
                . "fertilizer_id, "
                . "fertilizers.name, "
                . "SUM(weight), "
                . "SUM(treated_area) "
                . "FROM fertilizer_expense, fertilizers "
                . "WHERE fertilizers.id = fertilizer_id "
                . "GROUP BY fertilizer_id";
        
        $result = $this->connection->query($sql) or exit(mysqli_error($this->connection));

        return $this->dbArrayAssoc($result);        
    }
    
    public function clearData($data, $type="s") {
        switch ($type) {
            case "s" :
                return addslashes(trim(strip_tags($data)));
            case "f" :
                return (float)$data;
            case "i" :
                return (int)$data;                
        }
    }


}
